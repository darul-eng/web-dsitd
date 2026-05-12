<?php

declare(strict_types=1);

namespace App\Livewire\Public;

use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class NewsIndex extends Component
{
    use WithPagination;

    public string $search = '';
    public string $category = 'all';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingCategory(): void
    {
        $this->resetPage();
    }

    public function render(): View
    {
        $categories = NewsCategory::orderBy('name')->get();

        $news = News::with(['category', 'author'])
            ->published()
            ->when($this->search !== '', function ($query): void {
                $query->where(function ($q): void {
                    $q->where('title', 'like', "%{$this->search}%")
                      ->orWhere('content', 'like', "%{$this->search}%");
                });
            })
            ->when($this->category !== 'all', function ($query): void {
                $query->whereHas('category', function ($q): void {
                    $q->where('slug', $this->category);
                });
            })
            ->orderByDesc('published_at')
            ->paginate(12);

        return view('livewire.public.news-index', [
            'news'       => $news,
            'categories' => $categories,
        ]);
    }
}
