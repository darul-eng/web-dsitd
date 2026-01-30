<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Jumbotrons;

use App\Models\Jumbotron;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class Index extends Component
{
    use WithFileUploads;

    public $showForm = false;
    public $editingId = null;

    public $title = '';
    public $description = '';
    public $image = null;
    public $link_url = '';
    public $order = 0;
    public $is_active = true;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'image' => 'nullable|image|max:2048',
        'link_url' => 'nullable|url',
        'order' => 'required|integer',
        'is_active' => 'required|boolean',
    ];

    public function create()
    {
        $this->resetForm();
        $this->showForm = true;
    }

    public function edit(int $id)
    {
        $item = Jumbotron::findOrFail($id);
        $this->editingId = $id;
        $this->title = $item->title;
        $this->description = $item->description;
        $this->link_url = $item->link_url;
        $this->order = $item->order;
        $this->is_active = $item->is_active;
        $this->showForm = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'description' => $this->description,
            'link_url' => $this->link_url,
            'order' => $this->order,
            'is_active' => $this->is_active,
        ];

        if ($this->image) {
            $data['image_path'] = $this->image->store('jumbotrons', 'public');
        }

        if ($this->editingId) {
            Jumbotron::find($this->editingId)->update($data);
            session()->flash('message', 'Banner berhasil diperbarui.');
        } else {
            if (!$this->image) {
                $this->addError('image', 'Gambar wajib diunggah untuk banner baru.');
                return;
            }
            Jumbotron::create($data);
            session()->flash('message', 'Banner berhasil ditambahkan.');
        }

        $this->resetForm();
        $this->showForm = false;
    }

    public function delete(int $id)
    {
        Jumbotron::findOrFail($id)->delete();
        session()->flash('message', 'Banner berhasil dihapus.');
    }

    public function toggleActive(int $id)
    {
        $item = Jumbotron::findOrFail($id);
        $item->is_active = !$item->is_active;
        $item->save();
    }

    public function resetForm()
    {
        $this->editingId = null;
        $this->title = '';
        $this->description = '';
        $this->image = null;
        $this->link_url = '';
        $this->order = 0;
        $this->is_active = true;
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.admin.jumbotrons.index', [
            'items' => Jumbotron::orderBy('order')->orderBy('created_at', 'desc')->get(),
        ]);
    }
}
