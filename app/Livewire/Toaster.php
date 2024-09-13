<?php

namespace App\Livewire;

use Livewire\Component;

class Toaster extends Component
{
    protected $listeners = ['callToaster' => 'toast'];

    public $message = '';

    public function render()
    {
        return view('livewire.toaster');
    }

    public function toast($attribute)
    {
        $this->dispatch('refreshDatatable');
        $this->message = $attribute['message'];
        $this->dispatch('toaster-js');
        $this->dispatch('refreshDatatable');
    }
}
