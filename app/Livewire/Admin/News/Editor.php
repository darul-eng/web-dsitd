<?php

declare(strict_types=1);

namespace App\Livewire\Admin\News;

use App\Models\News;
use App\Models\NewsCategory;
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

    public function render()
    {
        return view('livewire.admin.news.editor', [
            'categories' => NewsCategory::orderBy('name')->get(),
        ]);
    }
}
