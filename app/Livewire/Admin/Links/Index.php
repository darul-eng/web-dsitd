<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Links;

use App\Models\Link;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class Index extends Component
{
    public $showForm = false;
    public $editingId = null;

    public $title = '';
    public $url = '';
    public $category = 'external';
    public $order = 0;

    protected $rules = [
        'title' => 'required|string|max:255',
        'url' => 'required|string|max:255',
        'category' => 'required|string',
        'order' => 'required|integer',
    ];

    public function create()
    {
        $this->resetForm();
        $this->showForm = true;
    }

    public function edit(int $id)
    {
        $link = Link::findOrFail($id);
        $this->editingId = $id;
        $this->title = $link->title;
        $this->url = $link->url;
        $this->category = $link->category;
        $this->order = $link->order;
        $this->showForm = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'url' => $this->url,
            'category' => $this->category,
            'order' => $this->order,
        ];

        if ($this->editingId) {
            Link::find($this->editingId)->update($data);
            session()->flash('message', 'Link berhasil diperbarui.');
        } else {
            Link::create($data);
            session()->flash('message', 'Link berhasil ditambahkan.');
        }

        $this->resetForm();
        $this->showForm = false;
    }

    public function delete(int $id)
    {
        Link::findOrFail($id)->delete();
        session()->flash('message', 'Link berhasil dihapus.');
    }

    public function resetForm()
    {
        $this->editingId = null;
        $this->title = '';
        $this->url = '';
        $this->category = 'external';
        $this->order = 0;
    }

    public function render()
    {
        return view('livewire.admin.links.index', [
            'links' => Link::orderBy('category')->orderBy('order')->get(),
        ]);
    }
}
