<?php

namespace App\Livewire\Component;

use App\Models\ForeignAgency;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FRAComponent extends Component
{
    public string $fraKey = '';

    public array $fra = [];

    public function render(): Factory|View|Application
    {
        $this->fra = ForeignAgency::query()
            ->select(['id', 'agency_name'])
            ->where('agency_id', Auth::user()->agency_id)
            ->get()
            ->toArray();

        return view('livewire.component.f-r-a-component');
    }

    public function addFRA()
    {
        ForeignAgency::create([
            'agency_id' => Auth::user()->agency_id,
            'agency_name' => $this->fraKey,
        ]);

        $this->fraKey = '';
        $this->fra = ForeignAgency::query()
            ->select(['id', 'agency_name'])
            ->where('agency_id', Auth::user()->agency_id)
            ->get()
            ->toArray();
    }

    public function deleteFRA($id)
    {
        ForeignAgency::destroy($id);
        $this->fra = ForeignAgency::query()
            ->select(['id', 'agency_name'])
            ->where('agency_id', Auth::user()->agency_id)
            ->get()
            ->toArray();
    }
}
