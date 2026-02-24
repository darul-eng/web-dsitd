<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Galleries;

use App\Models\Gallery;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class Index extends Component
{
    use WithPagination;

    public $search = '';

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function delete(string $uuid)
    {
        $gallery = Gallery::where('uuid', $uuid)->firstOrFail();
        // Delete images from disk
        foreach($gallery->images as $img) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($img->image_path);
        }
        if ($gallery->cover_image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($gallery->cover_image);
        }
        $gallery->delete();

        session()->flash('message', 'Album galeri berhasil dihapus.');
    }

    public function toggleStatus(string $uuid)
    {
        $gallery = Gallery::where('uuid', $uuid)->firstOrFail();
        $gallery->is_published = !$gallery->is_published;
        $gallery->save();
    }

    public function render()
    {
        $galleries = Gallery::with(['category', 'images'])
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(12);

        return view('livewire.admin.galleries.index', [
            'galleries' => $galleries,
        ]);
    }
}
