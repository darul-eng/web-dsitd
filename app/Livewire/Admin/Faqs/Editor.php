<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Faqs;

use App\Models\Faq;
use App\Models\FaqCategory;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

#[Layout('layouts.admin')]
class Editor extends Component
{
    public ?Faq $faqModel = null;

    #[Validate('required|string')]
    public $question = '';

    #[Validate('required|string')]
    public $answer = '';

    #[Validate('required|exists:faq_categories,id')]
    public $faq_category_id = '';

    #[Validate('required|integer')]
    public $order = 0;

    #[Validate('required|boolean')]
    public $is_published = true;

    // New Category
    public $showAddCategory = false;
    public $new_category_name = '';

    public function mount(int $id = null)
    {
        if ($id) {
            $this->faqModel = Faq::findOrFail($id);
            $this->question = $this->faqModel->question;
            $this->answer = $this->faqModel->answer;
            $this->faq_category_id = $this->faqModel->faq_category_id;
            $this->order = $this->faqModel->order;
            $this->is_published = $this->faqModel->is_published;
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'question' => $this->question,
            'answer' => $this->answer,
            'faq_category_id' => $this->faq_category_id,
            'order' => $this->order,
            'is_published' => $this->is_published,
        ];

        if ($this->faqModel) {
            $this->faqModel->update($data);
            session()->flash('message', 'FAQ berhasil diperbarui.');
        } else {
            Faq::create($data);
            session()->flash('message', 'FAQ berhasil ditambahkan.');
        }

        return redirect()->route('admin.faqs.index');
    }

    public function addCategory()
    {
        $this->validate([
            'new_category_name' => 'required|string|max:255|unique:faq_categories,name',
        ]);

        $cat = FaqCategory::create(['name' => $this->new_category_name]);
        $this->faq_category_id = $cat->id;
        $this->new_category_name = '';
        $this->showAddCategory = false;
    }

    public function render()
    {
        $categories = FaqCategory::orderBy('name')->get();
        return view('livewire.admin.faqs.editor', [
            'categories' => $categories,
        ]);
    }
}
