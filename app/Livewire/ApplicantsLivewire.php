<?php

namespace App\Livewire;

use App\Models\Candidate;
use Gridjs\ApplicantTableGridjs;
use Livewire\Component;

class ApplicantsLivewire extends Component
{
    protected $listeners = ['bindDetails' => 'bind'];

    public $details = [];

    public string $status = '';

    public function render()
    {
        return view('livewire.applicants-livewire');
    }

    public function bind($id)
    {
        $this->dispatch('tableApplicantRender');
        $this->details = Candidate::query()->where('id', decrypt($id))->with(['tags'])->get()[0]->toArray();
    }

    public function detach($slug)
    {
        $candidate = Candidate::query()->find($this->details['id']);
        $candidate->detachTag($slug);

        $this->details = Candidate::query()->where('id', $this->details['id'])->with(['tags'])->get()[0]->toArray();
        $this->dispatch('tableApplicantRender');
    }

    public function addStatus()
    {
        $this->validate([
            'status' => 'required|max:50'
        ]);

        $candidate = Candidate::query()->find($this->details['id']);
        $candidate->attachTag($this->status);

        $this->status  = '';
        $this->details = Candidate::query()->where('id', $this->details['id'])->with(['tags'])->get()[0]->toArray();
        $this->dispatch('tableApplicantRender');
    }
}
