<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Pages;

use App\Models\Page;
use App\Models\PageCategory;
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

    public ?Page $pageModel = null;

    #[Validate('required|string|max:255')]
    public $title = '';

    #[Validate('required|exists:page_categories,id')]
    public $category_id = '';

    #[Validate('required|string')]
    public $content = '';

    #[Validate('nullable|image|max:2048')]
    public $cover_image = null;

    #[Validate('required|boolean')]
    public $is_published = true;

    public $meta_title = '';
    public $meta_description = '';
    public $meta_keywords = '';
    
    // Add Category
    public $showAddCategory = false;
    public $new_category_name = '';

    public function mount(string $uuid = null)
    {
        if ($uuid) {
            $this->pageModel = Page::where('uuid', $uuid)->firstOrFail();
            $this->title = $this->pageModel->title;
            $this->category_id = $this->pageModel->page_category_id;
            $this->content = $this->pageModel->content;
            $this->is_published = (bool) $this->pageModel->is_published;
            $this->meta_title = $this->pageModel->meta_title;
            $this->meta_description = $this->pageModel->meta_description;
            $this->meta_keywords = $this->pageModel->meta_keywords;
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'page_category_id' => $this->category_id,
            'content' => $this->content,
            'is_published' => $this->is_published,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
            'updated_by' => Auth::user()?->name ?? 'System',
        ];

        if ($this->cover_image) {
            $data['cover_image'] = $this->cover_image->store('page-covers', 'public');
        }

        if ($this->pageModel) {
            $this->pageModel->update($data);
            session()->flash('message', 'Halaman berhasil diperbarui.');
        } else {
            $data['created_by'] = Auth::user()?->name ?? 'System';
            Page::create($data);
            session()->flash('message', 'Halaman berhasil dibuat.');
        }

        return redirect()->route('admin.pages.index');
    }

    public function addCategory()
    {
        $this->validate([
            'new_category_name' => 'required|string|max:255|unique:page_categories,name',
        ]);

        $category = PageCategory::create([
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
        return view('livewire.admin.pages.editor', [
            'categories' => PageCategory::orderBy('name')->get(),
        ]);
    }
}
