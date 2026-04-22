<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Services;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.admin')]
class Editor extends Component
{
    use WithFileUploads;

    public ?Service $serviceModel = null;
    public ?int $oldOrder = null;

    #[Validate('required|string|max:255')]
    public $title = '';

    #[Validate('required|exists:service_categories,id')]
    public $category_id = '';

    #[Validate('required|string')]
    public $content = '';

    #[Validate('nullable|image|max:1024')]
    public $icon = null;

    #[Validate('nullable|url')]
    public $external_link = '';

    #[Validate('required|boolean')]
    public $is_active = true;

    #[Validate('required|integer')]
    public $order = 0;

    public $meta_title = '';
    public $meta_description = '';
    public $meta_keywords = '';

    // Add Category
    public $showAddCategory = false;
    public $new_category_name = '';

    public function mount(string $uuid = null)
    {
        if ($uuid) {
            $this->serviceModel = Service::where('uuid', $uuid)->firstOrFail();
            $this->title = $this->serviceModel->title;
            $this->category_id = $this->serviceModel->service_category_id;
            $this->content = $this->serviceModel->content;
            $this->external_link = $this->serviceModel->external_link;
            $this->is_active = (bool) $this->serviceModel->is_active;
            $this->order = $this->serviceModel->order;
            $this->oldOrder = $this->serviceModel->order;
            $this->meta_title = $this->serviceModel->meta_title;
            $this->meta_description = $this->serviceModel->meta_description;
            $this->meta_keywords = $this->serviceModel->meta_keywords;
        }
    }

    public function save()
    {
        $this->validate();

        // Auto-assign order for new service
        if (!$this->serviceModel) {
            $maxOrder = Service::max('order') ?? 0;
            $this->order = $maxOrder + 1;
        } else {
            // Handle reordering when order changed
            $orderChanged = $this->oldOrder !== (int)$this->order;

            if ($orderChanged) {
                $this->reorderServices($this->oldOrder, (int)$this->order);
            }
        }

        $data = [
            'title' => $this->title,
            'service_category_id' => $this->category_id,
            'content' => $this->content,
            'external_link' => $this->external_link,
            'is_active' => $this->is_active,
            'order' => $this->order,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
        ];

        $service = $this->serviceModel ?? new Service();

        if ($this->icon) {
            $data['icon'] = $service->uploadAsset($this->icon, 'services', $service->icon);
        }

        if ($this->serviceModel) {
            $this->serviceModel->update($data);
            session()->flash('message', 'Layanan berhasil diperbarui.');
        } else {
            Service::create($data);
            session()->flash('message', 'Layanan berhasil ditambahkan.');
        }

        return redirect()->route('admin.services.index');
    }

    public function addCategory()
    {
        $this->validate([
            'new_category_name' => 'required|string|max:255|unique:service_categories,name',
        ]);

        $category = ServiceCategory::create([
            'name' => $this->new_category_name,
            'slug' => Str::slug($this->new_category_name),
        ]);

        $this->category_id = $category->id;
        $this->new_category_name = '';
        $this->showAddCategory = false;

        $this->dispatch('swal:success', message: 'Kategori baru berhasil ditambahkan.');
    }

    private function reorderServices(int $oldOrder, int $newOrder)
    {
        // Get all services except the current one
        $otherServices = Service::where('id', '!=', $this->serviceModel->id)
            ->orderBy('order')
            ->get();

        // Validate new order stays within bounds
        $maxOrder = $otherServices->count() + 1;
        if ($newOrder < 1) {
            $newOrder = 1;
        } elseif ($newOrder > $maxOrder) {
            $newOrder = $maxOrder;
        }

        // Build new order list by inserting current service at desired position
        $orderedServices = [];
        $currentServiceInserted = false;

        foreach ($otherServices as $index => $service) {
            $position = $index + 1;

            // Insert current service at the desired position
            if (!$currentServiceInserted && $position >= $newOrder) {
                $orderedServices[] = $this->serviceModel;
                $currentServiceInserted = true;
            }

            $orderedServices[] = $service;
        }

        // If not inserted yet, add at the end
        if (!$currentServiceInserted) {
            $orderedServices[] = $this->serviceModel;
        }

        // Update all services with new sequential order
        foreach ($orderedServices as $index => $service) {
            $newOrderValue = $index + 1;

            if ($service->id === $this->serviceModel->id) {
                $this->order = $newOrderValue;
            } else {
                $service->update(['order' => $newOrderValue]);
            }
        }
    }

    public function getMaxOrder(): int
    {
        $total = Service::count();

        // For existing service, max is total count (service already included)
        // For new service, max is total + 1
        if ($this->serviceModel) {
            return max($total, 1);
        }

        return max($total + 1, 1);
    }

    public function render()
    {
        return view('livewire.admin.services.editor', [
            'categories' => ServiceCategory::orderBy('name')->get(),
            'maxOrder' => $this->getMaxOrder(),
        ]);
    }
}
