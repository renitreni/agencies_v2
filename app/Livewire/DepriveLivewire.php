<?php

namespace App\Livewire;

use App\Models\Agency;
use App\Models\Deprive;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class DepriveLivewire extends Component
{
    public array $agencies = [];

    public array $agencyModel = [];

    public array $deprived = [];

    public array $routes = [];

    public string $route = '';

    public string $keyword = '';

    public function mount()
    {
        foreach (Route::getRoutes() as $value) {
            if ($value->getName()) {
                $this->routes[] = $value->getName();
            }
        }
    }

    public function render()
    {
        return view('livewire.deprive-livewire');
    }

    public function searchAgency()
    {
        $this->agencies = Agency::query()
                                ->select(['name', 'id'])
                                ->where('name', 'LIKE', "%{$this->keyword}%")
                                ->get()
                                ->toArray();
    }

    public function showDeprive($id)
    {
        $this->keyword     = '';
        $this->agencyModel = Agency::query()->find($id)->toArray();
        $this->deprived    = Deprive::query()->where('agency_id', $id)->get()->toArray();
    }

    public function addDeprived()
    {
        Deprive::query()->updateOrCreate(['feature' => $this->route, 'agency_id' => $this->agencyModel['id']],
            [
                'feature' => $this->route,
                'agency_id' => $this->agencyModel['id'],
            ]);
        $this->deprived = Deprive::query()->where('agency_id', $this->agencyModel['id'])->get()->toArray();
        $this->route    = '';
    }

    public function deleteDeprive($id)
    {
        Deprive::destroy($id);
        $this->deprived = Deprive::query()->where('agency_id', $this->agencyModel['id'])->get()->toArray();
    }
}
