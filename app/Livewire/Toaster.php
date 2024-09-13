<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class Toaster extends Component
{
    public $message = '';

    public function render()
    {
        return view('livewire.toaster');
    }

    #[On('callToaster')]
    public function toast($detail)
    {
        $this->message = $detail['message'];
        $this->js("$('.toast').toast('show')");
        $this->js("$('.modal').modal('hide')");
        $this->dispatch('pg:eventRefresh-default');
    }
}
