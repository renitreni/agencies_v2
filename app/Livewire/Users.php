<?php

namespace App\Livewire;

use App\Models\Agency;
use App\Models\Information;
use App\Models\User;
use Livewire\Component;

class Users extends Component
{
    public array $agencies = [];

    public array $details = [];

    public $listeners = ['bindUserDetails' => 'bind'];

    public function mount()
    {
        $this->agencies = Agency::list();
    }

    public function render()
    {
        return view('livewire.users');
    }

    public function store()
    {
        $this->validate([
            'details.agency_id' => 'required',
            'details.name' => 'required',
            'details.role' => 'required',
            'details.email' => 'required|email',
            'details.password' => 'required|confirmed',
        ]);

        $information = Information::query()->create($this->details);

        $final = array_merge($this->details, [
            'information_id' => $information['id'],
            'created_by' => Auth::id(),
        ]);
        User::query()->create($final);

        $this->details = [];
        $this->dispatch('callToaster', ['message' => 'New User has been Added!']);
    }

    public function bind($attribute)
    {
        $this->details = app(User::class)->tableQuery()->where('users.id', $attribute['id'])->get()->toArray()[0];
    }

    public function edit()
    {
        $this->validate([
            'details.agency_id' => 'required',
            'details.name' => 'required',
            'details.role' => 'required',
            'details.email' => 'required|email',
        ]);

        Information::query()
            ->where('id', $this->details['id'])
            ->update([
                'name' => $this->details['name'],
                'email' => $this->details['email'],
                'created_by' => Auth::id(),

                //            'national_id' => $this->details['national_id'],
                //            'tin' => $this->details['tin'],
                //            'address_line_1' => $this->details['address_line_1'],
                //            'address_line_2' => $this->details['address_line_2'],
                //            'city' => $this->details['city'],
                //            'zip_code' => $this->details['zip_code'],
                //            'contact_name' => $this->details['contact_name'],
                //            'phone' => $this->details['phone'],
                //            'fax' => $this->details['fax'],
                //            'status' => $this->details['status'],
                //            'type' => $this->details['type'],
                //            'poea' => $this->details['poea'],
            ]);

        User::query()->where('id', $this->details['id'])->update([
            'email' => $this->details['email'],
            'role' => $this->details['role'],
            'agency_id' => $this->details['agency_id'],
            'information_id' => $this->details['id'],
        ]);

        $this->details = [];
        $this->dispatch('callToaster', ['message' => 'User has been updated!']);
    }

    public function delete()
    {
        Information::query()->where('id', $this->details['id'])->delete();
        User::query()->where('id', $this->details['prime_id'])->delete();

        $this->details = [];
        $this->dispatch('callToaster', ['message' => 'User has been deleted!']);
    }
}
