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
            $this->meta_title = $this->serviceModel->meta_title;
            $this->meta_description = $this->serviceModel->meta_description;
            $this->meta_keywords = $this->serviceModel->meta_keywords;
        }
    }

    public function save()
    {
        $this->validate();

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

        if ($this->icon) {
            $data['icon'] = $this->icon->store('service-icons', 'public');
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

    public function render()
    {
        return view('livewire.admin.services.editor', [
            'categories' => ServiceCategory::orderBy('name')->get(),
        ]);
    }
}
