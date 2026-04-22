<?php

declare(strict_types=1);

namespace App\Livewire\Public;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class ServicesIndex extends Component
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
        $categories = ServiceCategory::orderBy('name')->get();

        $services = Service::with('category')
            ->where('is_active', true)
            ->when($this->search !== '', function ($query): void {
                $query->where(function ($searchQuery): void {
                    $searchQuery
                        ->where('title', 'like', "%{$this->search}%")
                        ->orWhere('content', 'like', "%{$this->search}%");
                });
            })
            ->when($this->category !== 'all', function ($query): void {
                $query->whereHas('category', function ($categoryQuery): void {
                    $categoryQuery->where('slug', $this->category);
                });
            })
            ->orderBy('order')
            ->paginate(12);

        return view('livewire.public.services-index', [
            'services' => $services,
            'categories' => $categories,
        ]);
    }
}
