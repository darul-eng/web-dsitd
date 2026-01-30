<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Faqs;

use App\Models\Faq;
use App\Models\FaqCategory;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $category = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'category' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete(int $id)
    {
        Faq::destroy($id);
        session()->flash('message', 'FAQ berhasil dihapus.');
    }

    public function render()
    {
        $faqs = Faq::with('category')
            ->when($this->search, function ($query) {
                $query->where('question', 'like', '%' . $this->search . '%')
                      ->orWhere('answer', 'like', '%' . $this->search . '%');
            })
            ->when($this->category, function ($query) {
                $query->where('faq_category_id', $this->category);
            })
            ->orderBy('faq_category_id')
            ->orderBy('order')
            ->paginate(15);

        $categories = FaqCategory::orderBy('name')->get();

        return view('livewire.admin.faqs.index', [
            'faqs' => $faqs,
            'categories' => $categories,
        ]);
    }
}
