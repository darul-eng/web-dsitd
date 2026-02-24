<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Services;

use App\Models\Service;
use App\Models\ServiceCategory;
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
        $service = Service::where('uuid', $uuid)->firstOrFail();
        $service->delete();

        session()->flash('message', 'Layanan berhasil dihapus.');
    }

    public function toggleStatus(string $uuid)
    {
        $service = Service::where('uuid', $uuid)->firstOrFail();
        $service->is_active = !$service->is_active;
        $service->save();
    }

    public function render()
    {
        $services = Service::with(['category'])
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->when($this->category, function ($query) {
                $query->where('service_category_id', $this->category);
            })
            ->when($this->status !== '', function ($query) {
                $query->where('is_active', $this->status === 'active');
            })
            ->orderBy('order')
            ->latest()
            ->paginate(10);

        $categories = ServiceCategory::orderBy('name')->get();

        return view('livewire.admin.services.index', [
            'services' => $services,
            'categories' => $categories,
        ]);
    }
}
