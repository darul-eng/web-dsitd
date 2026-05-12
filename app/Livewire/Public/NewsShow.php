<?php

declare(strict_types=1);

namespace App\Livewire\Public;

use App\Models\News;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class NewsShow extends Component
{
    public News $news;

    public function mount(News $news): void
    {
        if ($news->status !== 'published') {
            abort(404);
        }
        $this->news = $news->load(['category', 'author']);
        
        // Increment view count
        $news->increment('views_count');
    }

    public function render(): View
    {
        return view('livewire.public.news-show');
    }
}
