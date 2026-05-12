<?php

declare(strict_types=1);

namespace App\Livewire\Public;

use App\Models\Service;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class ServiceShow extends Component
{
    public Service $service;

    public function mount(Service $service): void
    {
        $this->service = $service->load('category');
    }

    public function render(): View
    {
        return view('livewire.public.service-show');
    }
}
