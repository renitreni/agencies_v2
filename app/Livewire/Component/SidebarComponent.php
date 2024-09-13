<?php

namespace App\Livewire\Component;

use App\Models\Deprive;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SidebarComponent extends Component
{
    public array $deprive = [];

    public function mount()
    {
        $this->deprive = Deprive::query()
            ->where('agency_id', Auth::user()->agency_id)
            ->toBase()
            ->pluck('feature')
            ->toArray();
    }

    public function render()
    {
        return view('livewire.component.sidebar-component');
    }
}
