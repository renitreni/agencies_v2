<?php

namespace App\Livewire;

use App\Models\Agency;
use App\Models\Complains;
use App\Models\ForeignAgency;
use Livewire\Component;
use Livewire\WithFileUploads;

class ComplaintFormLivewire extends Component
{
    use WithFileUploads;

    public ?int $agencyId = null;

    protected $queryString = ['agencyId'];

    public mixed $agency;

    public array $fraList = [];

    public array $form = [];

    public function mount()
    {
        $this->agency = Agency::query()->select(['name', 'id'])->findOrFail($this->agencyId);
    }

    public function render()
    {
        $this->fraList = ForeignAgency::query()
            ->select(['id', 'agency_name'])
            ->where('agency_id', $this->agency->id)
            ->orderBy('agency_name')
            ->get()
            ->toArray();

        return view('livewire.complaint-form-livewire')->layout('layouts.guest');
    }

    public function store()
    {
        $this->validate([
            'form.full_name' => 'required|max:500',
            'form.image1' => 'image|max:20000',
            'form.image2' => 'image|max:20000',
            'form.image3' => 'image|max:20000',
            'form.complaint' => 'required|max:500',
            'form.actual_latitude' => 'required',
            'form.actual_longitude' => 'required',
        ]);

        if (isset($this->form['foreign_agency_id'])) {
            $this->form['foreign_agency'] = ForeignAgency::query()->find($this->form['foreign_agency_id'])->agency_name;
        }
        if (isset($this->form['image1'])) {
            $this->form['image1'] = $this->form['image1']->store('evidences', 'public');
        }
        if (isset($this->form['image2'])) {
            $this->form['image2'] = $this->form['image2']->store('evidences', 'public');
        }
        if (isset($this->form['image3'])) {
            $this->form['image3'] = $this->form['image3']->store('evidences', 'public');
        }
        if (isset($this->form['agency_id'])) {
            $this->form['agency_id'] = Agency::query()->find($this->form['agency_id'])->name;
        }

        $this->form['agency_id'] = $this->agency->id;
        $this->form['agency'] = $this->agency->name;

        Complains::query()->create($this->form);

        $this->form = [];

        $this->dispatch('callToaster', ['message' => 'Complaint has been submitted!']);
    }
}
