<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Pages;

use App\Models\Page;
use App\Models\PageCategory;
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
        $page = Page::where('uuid', $uuid)->firstOrFail();
        $page->delete();

        session()->flash('message', 'Halaman berhasil dihapus.');
    }

    public function render()
    {
        $pages = Page::with(['category'])
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->when($this->category, function ($query) {
                $query->where('page_category_id', $this->category);
            })
            ->when($this->status !== '', function ($query) {
                $query->where('is_published', $this->status === 'published');
            })
            ->latest()
            ->paginate(10);

        $categories = PageCategory::orderBy('name')->get();

        return view('livewire.admin.pages.index', [
            'pages' => $pages,
            'categories' => $categories,
        ]);
    }
}
