<?php

namespace App\Livewire;

use App\Models\Deployment;
use App\Models\User;
use Livewire\Component;

class DeploymentLivewire extends Component
{
    protected $listeners = ['editDeploy' => 'bind'];

    public $detail;

    public array $accounts = [];

    public array $params = [];

    public function mount()
    {
        $this->params['account'] = Auth::id();

        $this->accounts = User::query()
            ->select(['id', 'email'])
            ->where('agency_id', Auth::user()->agency_id)
            ->get()
            ->toArray();
        session()->put('export', $this->params);
    }

    public function render()
    {
        return view('livewire.deployment-livewire');
    }

    public function bind($value)
    {
        $this->detail = Deployment::where('voucher_id', $value['id'])->first()?->toArray() ?? [];
        $this->detail['voucher_id'] = $value['id'];

        $this->dispatch('deploy-modal');
    }

    public function store()
    {
        Deployment::updateOrCreate(
            ['voucher_id' => $this->detail['voucher_id'] ?? null],
            $this->detail
        );

        $this->dispatch('deploy-modal');
        $this->dispatch('refreshDatatable');
        $this->dispatch('callToaster', ['message' => 'Deployment Status Updated!']);
    }

    public function updatedParams()
    {
        session()->put('export', $this->params);
        $this->dispatch('outsideFilter', $this->params);
    }

    public function resetDates()
    {
        $this->params['deployed_from'] = null;
        $this->params['deployed_to'] = null;
    }
}
