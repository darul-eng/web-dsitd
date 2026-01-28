<?php

declare(strict_types=1);

namespace App\Livewire\Admin\News;

use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.admin')]
class Editor extends Component
{
    use WithFileUploads;

    public ?News $news = null;

    public bool $isGeneratingAI = false;

    #[Validate('required|string|max:255')]
    public $title = '';

    #[Validate('required|exists:news_categories,id')]
    public $category_id = '';

    #[Validate('required|string')]
    public $content = '';

    #[Validate('nullable|image|max:2048')]
    public $cover_image = null;

    #[Validate('required|in:draft,published,archived')]
    public $status = 'draft';

    public $contentImages = []; // Temporarily hold images during Trix upload

    public $meta_title = '';
    public $meta_description = '';
    public $meta_keywords = '';
    
    // Add Category
    public $showAddCategory = false;
    public $new_category_name = '';

    public function mount(string $uuid = null)
    {
        if ($uuid) {
            $this->news = News::where('uuid', $uuid)->firstOrFail();
            $this->title = $this->news->title;
            $this->category_id = $this->news->news_category_id;
            $this->content = $this->news->content;
            $this->status = $this->news->status;
            $this->meta_title = $this->news->meta_title;
            $this->meta_description = $this->news->meta_description;
            $this->meta_keywords = $this->news->meta_keywords;
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'news_category_id' => $this->category_id,
            'content' => $this->content,
            'status' => $this->status,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
            'updated_by' => Auth::user()?->name ?? 'System',
        ];

        if ($this->cover_image) {
            $data['cover_image'] = $this->cover_image->store('news-covers', 'public');
        }

        if ($this->status === 'published' && (!$this->news || !$this->news->published_at)) {
            $data['published_at'] = now();
        }

        if ($this->news) {
            $this->news->update($data);
            session()->flash('message', 'Berita berhasil diperbarui.');
        } else {
            $data['user_id'] = Auth::id();
            News::create($data);
            session()->flash('message', 'Berita berhasil diterbitkan.');
        }

        return redirect()->route('admin.news.index');
    }

    public function generateAI()
    {
        if (empty($this->title)) {
            $this->addError('title', 'Masukkan judul berita terlebih dahulu untuk menggunakan fitur AI.');
            return;
        }

        $apiKey = config('services.gemini.key') ?? env('GEMINI_API_KEY');
        
        if (!$apiKey) {
            $this->dispatch('swal:error', message: 'API Key AI belum dikonfigurasi.');
            return;
        }

        $this->isGeneratingAI = true;

        try {
            $model = "gemini-2.5-flash"; // Menggunakan model yang stabil

            $prompt = "Buatkan narasi berita profesional dalam Bahasa Indonesia berdasarkan judul berikut:\n\n" .
                      "\"{$this->title}\"\n\n" .
                      "Berikan respon dalam format JSON murni dengan struktur berikut:\n" .
                      "{\n" .
                      "  \"content\": \"isi berita dalam format HTML (gunakan <p>, <strong>, dll)\",\n" .
                      "  \"meta_title\": \"judul untuk SEO (maks 60 karakter)\",\n" .
                      "  \"meta_description\": \"deskripsi untuk SEO (maks 160 karakter)\",\n" .
                      "  \"meta_keywords\": \"kata kunci SEO (dipisahkan koma)\",\n" .
                      "}\n\n" .
                      "Pastikan content HTML memiliki struktur:\n" .
                      "1. Paragraf pembuka dengan lokasi dan lead (contoh: <p><strong>Jakarta</strong> — Pembukaan berita...)</p>\n" .
                      "2. 3-4 paragraf isi berita\n" .
                      "3. Paragraf penutup dengan ringkasan\n" .
                      "4. Hashtag relevan di akhir\n\n" .
                      "Berikan HANYA JSON murni tanpa markdown blocks.";

            $response = Http::timeout(60)
                ->withoutVerifying()
                ->post("https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}", [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => $prompt]
                            ]
                        ]
                    ],
                    'generationConfig' => [
                        'temperature' => 0.7,
                        'maxOutputTokens' => 2048,
                        'response_mime_type' => 'application/json',
                    ]
                ]);

            if ($response->successful()) {
                $data = $response->json();
                $textResponse = $data['candidates'][0]['content']['parts'][0]['text'] ?? '';

                if (empty($textResponse)) {
                    $this->dispatch('swal:error', message: 'AI tidak memberikan respon valid.');
                    return;
                }

                $jsonResponse = json_decode($textResponse, true);
                
                if (isset($jsonResponse['content'])) {
                    $this->content = $jsonResponse['content'];
                    $this->meta_title = $jsonResponse['meta_title'] ?? '';
                    $this->meta_description = $jsonResponse['meta_description'] ?? '';
                    $this->meta_keywords = $jsonResponse['meta_keywords'] ?? '';

                    $this->dispatch('content-updated', content: $this->content);
                    $this->dispatch('swal:success', message: 'Narasi berita dan optimasi SEO berhasil disusun oleh AI.');
                } else {
                    $this->dispatch('swal:error', message: 'Format respon AI tidak sesuai.');
                }
            } else {
                $statusCode = $response->status();
                $errorMsg = $response->json('error.message') ?? 'Terjadi kesalahan pada server AI.';

                if ($statusCode === 429) {
                    $this->dispatch('swal:error', message: 'Rate limit tercapai. Silakan tunggu beberapa menit dan coba lagi.');
                } else {
                    $this->dispatch('swal:error', message: 'Gagal memanggil AI (HTTP ' . $statusCode . '): ' . $errorMsg);
                }
            }
        } catch (\Exception $e) {
            $this->dispatch('swal:error', message: 'Kesalahan sistem AI: ' . $e->getMessage());
        } finally {
            $this->isGeneratingAI = false;
        }
    }

    public function addCategory()
    {
        $this->validate([
            'new_category_name' => 'required|string|max:255|unique:news_categories,name',
        ]);

        $category = NewsCategory::create([
            'name' => $this->new_category_name,
            'slug' => Str::slug($this->new_category_name),
        ]);

        $this->category_id = $category->id;
        $this->new_category_name = '';
        $this->showAddCategory = false;
        
        $this->dispatch('swal:success', message: 'Kategori baru berhasil ditambahkan.');
    }

    public function render()
    {
        return view('livewire.admin.news.editor', [
            'categories' => NewsCategory::orderBy('name')->get(),
        ]);
    }
}
