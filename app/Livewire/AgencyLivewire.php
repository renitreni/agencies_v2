<?php

namespace App\Livewire;

use App\Models\Agency;
use Livewire\Component;
use Livewire\WithFileUploads;

class AgencyLivewire extends Component
{
    use WithFileUploads;

    public array $details = [];

    protected $listeners = ['bindAgencyDetails' => 'bind'];

    public function render()
    {
        return view('livewire.agency-livewire');
    }

    public function bind($attr)
    {
        $this->details = Agency::query()->where('id', $attr['id'])->get()->toArray()[0];
    }

    public function store()
    {
        $this->validate([
            'details.photo'   => 'required|image|max:1024',    // 1MB Max
            'details.address' => 'required',
            'details.name'    => 'required',
            'details.poea'    => 'required',
            'details.cr_no'   => 'required',
            'details.status'  => 'required',
        ]);

        $path = $this->details['photo']->store('agency', 'public');

        Agency::query()->create([
            'name'       => $this->details['name'],
            'address'    => $this->details['address'],
            'logo_path'  => $path,
            'poea'       => $this->details['poea'],
            'cr_no'      => $this->details['cr_no'],
            'status'     => $this->details['status'],
            'owner_name'      => $this->details['owner_name'],
            'contact_number'     => $this->details['contact_number'],
            'created_by' => auth()->id(),
        ]);

        $this->dispatch('callToaster', ['message' => 'New Agency has been Added!']);
        $this->details = [];
    }

    public function edit()
    {
        $this->validate([
            'details.address' => 'required|required', // 1MB Max
            'details.name'    => 'required|required',
            'details.poea'    => 'required|required',
            'details.cr_no'   => 'required|required',
            'details.status'  => 'required|required',
        ]);

        $path = null;
        if (isset($this->details['photo'])) {
            $this->validate([
                'details.photo' => 'image|max:1024',
            ]);
            $path = $this->details['photo']->store('agency', 'public');
        }

        Agency::query()
            ->where('id', $this->details['id'])
            ->update([
                'name'       => $this->details['name'],
                'address'    => $this->details['address'],
                'logo_path'  => $path ?? $this->details['logo_path'],
                'poea'       => $this->details['poea'],
                'cr_no'      => $this->details['cr_no'],
                'status'     => $this->details['status'],
                'owner_name'      => $this->details['owner_name'],
                'contact_number'     => $this->details['contact_number'],
                'created_by' => auth()->id(),
            ]);

        $this->dispatch('callToaster', ['message' => 'Agency has been Updated!']);
        $this->details = [];
    }

    public function delete()
    {
        Agency::query()->where('id', $this->details['id'])->delete();

        $this->dispatch('callToaster', ['message' => 'Agency has been Updated!']);
        $this->details = [];
    }
}
