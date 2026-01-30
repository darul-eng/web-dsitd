<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Galleries;

use App\Models\Gallery;
use App\Models\GalleryCategory;
use App\Models\GalleryImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

#[Layout('layouts.admin')]
class Editor extends Component
{
    use WithFileUploads;

    public ?Gallery $galleryModel = null;

    #[Validate('required|string|max:255')]
    public $title = '';

    #[Validate('nullable|string')]
    public $description = '';

    #[Validate('nullable|integer')]
    public $gallery_category_id = null;

    #[Validate('nullable|image|max:1024')]
    public $cover_image = null;

    #[Validate('required|boolean')]
    public $is_published = true;

    // Multi upload
    #[Validate(['images.*' => 'image|max:2048'])]
    public $images = [];

    // Category
    public $showAddCategory = false;
    public $new_category_name = '';

    public function mount(string $uuid = null)
    {
        if ($uuid) {
            $this->galleryModel = Gallery::with('images')->where('uuid', $uuid)->firstOrFail();
            $this->title = $this->galleryModel->title;
            $this->description = $this->galleryModel->description;
            $this->gallery_category_id = $this->galleryModel->gallery_category_id;
            $this->is_published = (bool) $this->galleryModel->is_published;
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'description' => $this->description,
            'gallery_category_id' => $this->gallery_category_id ?: null,
            'is_published' => $this->is_published,
            'user_id' => Auth::id(),
        ];

        if ($this->cover_image) {
            $data['cover_image'] = $this->cover_image->store('galleries/covers', 'public');
        }

        if ($this->galleryModel) {
            $this->galleryModel->update($data);
            $gallery = $this->galleryModel;
            session()->flash('message', 'Album galeri berhasil diperbarui.');
        } else {
            $gallery = Gallery::create($data);
            session()->flash('message', 'Album galeri berhasil dibuat.');
        }

        if ($this->images) {
            foreach ($this->images as $file) {
                $path = $file->store('galleries/photos', 'public');
                GalleryImage::create([
                    'gallery_id' => $gallery->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('admin.galleries.index');
    }

    public function removeImage(int $id)
    {
        $img = GalleryImage::findOrFail($id);
        \Illuminate\Support\Facades\Storage::disk('public')->delete($img->image_path);
        $img->delete();
        $this->galleryModel->load('images');
    }

    public function addCategory()
    {
        $this->validate([
            'new_category_name' => 'required|string|max:255|unique:gallery_categories,name',
        ]);

        $cat = GalleryCategory::create(['name' => $this->new_category_name]);
        $this->gallery_category_id = $cat->id;
        $this->new_category_name = '';
        $this->showAddCategory = false;
    }

    public function render()
    {
        $categories = GalleryCategory::orderBy('name')->get();
        return view('livewire.admin.galleries.editor', [
            'categories' => $categories,
        ]);
    }
}
