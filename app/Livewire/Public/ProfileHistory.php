<?php

declare(strict_types=1);

namespace App\Livewire\Public;

use App\Models\Page;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class ProfileHistory extends Component
{
    public ?Page $page = null;

    public function mount(): void
    {
        $this->page = Page::query()
            ->where('is_published', true)
            ->where(function ($query): void {
                $query->where('slug', 'sejarah')
                    ->orWhere('slug', 'sejarah-ltdka')
                    ->orWhere('slug', 'sejarah-dsitd')
                    ->orWhere('title', 'like', '%sejarah%');
            })
            ->whereHas('category', function ($query): void {
                $query->where('slug', 'profil');
            })
            ->latest('updated_at')
            ->first();
    }

    public function render(): View
    {
        return view('livewire.public.profile-history', [
            'page' => $this->page,
        ]);
    }
}
