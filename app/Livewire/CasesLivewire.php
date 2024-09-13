<?php

namespace App\Livewire;

use App\Models\Agency;
use App\Models\Complains;
use App\Models\ComplainStatus;
use App\Models\ForeignAgency;
use Livewire\Component;

class CasesLivewire extends Component
{
    public array $detail;

    public array $praList = [];

    public ?string $pra = null;

    public array $fraList = [];

    public ?string $fra = null;

    public string $status = '';

    protected $listeners = ['editCase' => 'edit'];

    public function mount()
    {
        $this->praList = Agency::query()->select(['id', 'name'])->get()->toArray();
    }

    public function render()
    {
        $this->fraList = ForeignAgency::query()
            ->select(['id', 'agency_name'])
            ->where('agency_id', $this->pra)
            ->get()
            ->toArray();
        if ($this->fraList == []) {
            $this->fra = '';
        }

        return view('livewire.cases');
    }

    public function edit($id)
    {
        $this->detail = Complains::query()->find($id)->toArray();
        $this->pra = $this->detail['agency_id'];
        $this->fra = $this->detail['foreign_agency_id'];
        $complainStatus = ComplainStatus::query()->where('complain_id', $this->detail['id'])->first();
        $this->status = $complainStatus ? $complainStatus->status : '';
    }

    public function assign()
    {
        $complain = Complains::query()->find($this->detail['id']);
        $complain->agency = Agency::query()->findOrFail($this->pra)->name;
        $complain->agency_id = $this->pra;
        $complain->foreign_agency = ForeignAgency::query()->findOrFail($this->fra)->agency_name;
        $complain->foreign_agency_id = $this->fra;
        $complain->save();

        ComplainStatus::query()->create([
            'complain_id' => $this->detail['id'],
            'status' => $this->status,
        ]);

        $this->dispatch('refreshDatatable');
    }
}
