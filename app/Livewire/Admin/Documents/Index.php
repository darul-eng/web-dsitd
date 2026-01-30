<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Documents;

use App\Models\Document;
use App\Models\DocumentCategory;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class Index extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $category = '';
    public $showForm = false;
    public $editingId = null;

    // Form fields
    public $title = '';
    public $description = '';
    public $category_id = '';
    public $file = null;
    public $is_public = true;

    // Add Category
    public $showAddCategory = false;
    public $new_category_name = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'category' => ['except' => ''],
    ];

    public function create()
    {
        $this->resetForm();
        $this->showForm = true;
    }

    public function edit(int $id)
    {
        $doc = Document::findOrFail($id);
        $this->editingId = $id;
        $this->title = $doc->title;
        $this->description = $doc->description;
        $this->category_id = $doc->document_category_id;
        $this->is_public = (bool) $doc->is_public;
        $this->showForm = true;
    }

    public function save()
    {
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:document_categories,id',
            'is_public' => 'required|boolean',
        ];

        if (!$this->editingId) {
            $rules['file'] = 'required|file|max:10240'; // Max 10MB
        } else {
            $rules['file'] = 'nullable|file|max:10240';
        }

        $this->validate($rules);

        $data = [
            'title' => $this->title,
            'description' => $this->description,
            'document_category_id' => $this->category_id,
            'is_public' => $this->is_public,
        ];

        if ($this->file) {
            $data['file_path'] = $this->file->store('documents', 'public');
            $data['file_type'] = $this->file->getClientOriginalExtension();
            $data['file_size'] = $this->file->getSize();
        }

        if ($this->editingId) {
            Document::find($this->editingId)->update($data);
            session()->flash('message', 'Dokumen berhasil diperbarui.');
        } else {
            Document::create($data);
            session()->flash('message', 'Dokumen berhasil diunggah.');
        }

        $this->resetForm();
        $this->showForm = false;
    }

    public function delete(int $id)
    {
        $doc = Document::findOrFail($id);
        Storage::disk('public')->delete($doc->file_path);
        $doc->delete();
        session()->flash('message', 'Dokumen berhasil dihapus.');
    }

    public function resetForm()
    {
        $this->editingId = null;
        $this->title = '';
        $this->description = '';
        $this->category_id = '';
        $this->file = null;
        $this->is_public = true;
        $this->showAddCategory = false;
        $this->new_category_name = '';
    }

    public function addCategory()
    {
        $this->validate([
            'new_category_name' => 'required|string|max:255|unique:document_categories,name',
        ]);

        $category = DocumentCategory::create([
            'name' => $this->new_category_name,
            'slug' => \Illuminate\Support\Str::slug($this->new_category_name),
        ]);

        $this->category_id = $category->id;
        $this->new_category_name = '';
        $this->showAddCategory = false;
        
        $this->dispatch('swal:success', message: 'Kategori baru berhasil ditambahkan.');
    }

    public function render()
    {
        $documents = Document::with(['category'])
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->when($this->category, function ($query) {
                $query->where('document_category_id', $this->category);
            })
            ->latest()
            ->paginate(10);

        $categories = DocumentCategory::orderBy('name')->get();

        return view('livewire.admin.documents.index', [
            'documents' => $documents,
            'categories' => $categories,
        ]);
    }
}
