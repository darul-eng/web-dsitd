<?php

declare(strict_types=1);

namespace App\Livewire\Admin\News;

use App\Models\News;
use App\Models\NewsCategory;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $category = '';
    public $status = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'category' => ['except' => ''],
        'status' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete(string $uuid)
    {
        $news = News::where('uuid', $uuid)->firstOrFail();
        $news->delete();

        session()->flash('message', 'Berita berhasil dihapus.');
    }

    public function render()
    {
        $news = News::with(['category', 'author'])
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->when($this->category, function ($query) {
                $query->where('news_category_id', $this->category);
            })
            ->when($this->status, function ($query) {
                $query->where('status', $this->status);
            })
            ->latest()
            ->paginate(10);

        $categories = NewsCategory::orderBy('name')->get();

        return view('livewire.admin.news.index', [
            'newsItems' => $news,
            'categories' => $categories,
        ]);
    }
}
