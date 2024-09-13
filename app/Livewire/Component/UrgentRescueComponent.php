<?php

namespace App\Livewire\Component\Component;

use App\Models\Rescue;
use Livewire\Component;

class UrgentRescueComponent extends Component
{
    public int $rescueCount = 0;

    public array $recues = [];

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function render()
    {
        $this->dispatch('refreshDatatable');
        $this->rescueCount = Rescue::query()
            ->leftJoin('responds as rs', 'rs.rescue_id', '=', 'rescues.id')
            ->whereNull('rs.rescue_id')
            ->orWhere('rs.status', '<>', 'resolved')
            ->count();

        return view('livewire.component.urgent-rescue-component');
    }

    public function showRecues()
    {
        $this->recues = Rescue::query()
            ->leftJoin('responds as rs', 'rs.rescue_id', '=', 'rescues.id')
            ->whereNull('rs.rescue_id')
            ->orWhere('rs.status', '<>', 'resolved')
            ->with(['candidate'])
            ->get()
            ->toArray();
    }
}
