<?php

declare(strict_types=1);

namespace App\Livewire\Public;

use App\Models\Page;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class ProfileVisionMission extends Component
{
    public ?Page $page = null;

    public function mount(): void
    {
        $this->page = Page::query()
            ->where('is_published', true)
            ->where(function ($query): void {
                $query->where('slug', 'visi-misi')
                    ->orWhere('slug', 'visi-dan-misi')
                    ->orWhere('title', 'like', '%visi%')
                    ->orWhere('title', 'like', '%misi%');
            })
            ->whereHas('category', function ($query): void {
                $query->where('slug', 'profil');
            })
            ->latest('updated_at')
            ->first();
    }

    public function render(): View
    {
        return view('livewire.public.profile-vision-mission', [
            'page' => $this->page,
        ]);
    }
}
