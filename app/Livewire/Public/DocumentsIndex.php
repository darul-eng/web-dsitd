<?php

declare(strict_types=1);

namespace App\Livewire\Public;

use App\Models\Document;
use App\Models\DocumentCategory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class DocumentsIndex extends Component
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
        $categories = DocumentCategory::orderBy('name')->get();

        $documents = Document::with('category')
            ->where('is_public', true)
            ->when($this->search !== '', function ($query): void {
                $query->where(function ($q): void {
                    $q->where('title', 'like', "%{$this->search}%")
                      ->orWhere('description', 'like', "%{$this->search}%");
                });
            })
            ->when($this->category !== 'all', function ($query): void {
                $query->whereHas('category', function ($q): void {
                    $q->where('slug', $this->category);
                });
            })
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('livewire.public.documents-index', [
            'documents'  => $documents,
            'categories' => $categories,
        ]);
    }
}
