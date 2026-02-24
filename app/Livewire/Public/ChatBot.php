<?php

namespace App\Livewire\Public;

use Livewire\Component;

class ChatBot extends Component
{
    public $isOpen = false;
    public $message = '';
    public $chatHistory = [];

    public function toggleChat()
    {
        $this->isOpen = !$this->isOpen;
    }

    public function render()
    {
        return view('livewire.public.chat-bot');
    }
}
