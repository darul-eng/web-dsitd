<?php

declare(strict_types=1);

namespace App\Livewire\Public;

use App\Models\Service;
use App\Models\News;
use App\Models\Jumbotron;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Home extends Component
{
    public $systemOperational = true;
    public $uptimeRate = '99.98';

    public function mount()
    {
        // Initial state
    }

    public function render()
    {
        $services = Service::where('is_active', true)->orderBy('order')->take(6)->get();
        $banners = Jumbotron::where('is_active', true)->orderBy('order')->get();
        $latestNews = News::published()->latest()->take(3)->get();

        return view('livewire.public.home', [
            'services' => $services,
            'banners' => $banners,
            'latestNews' => $latestNews,
        ]);
    }

    public function toggleSystemStatus()
    {
        // This could be polled or updated in real-time
        $this->systemOperational = !$this->systemOperational;
    }
}
