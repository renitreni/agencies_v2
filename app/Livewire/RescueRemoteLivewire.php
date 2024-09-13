<?php

namespace App\Livewire;

use App\Events\AlertSystemEvent;
use App\Mail\RescueMailNotifier;
use App\Models\Candidate;
use App\Models\Participants;
use App\Models\Rescue;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class RescueRemoteLivewire extends Component
{
    public string $code = '';

    public array $candidate = [];

    public $form;

    public function render()
    {
        return view('livewire.rescue-remote-livewire')->layout('layouts.guest');
    }

    public function showDetails()
    {
        $this->validate([
            'code' => 'required|exists:candidates,code',
        ]);

        $this->candidate = Candidate::query()
                                    ->selectRaw('candidates.*, v.status')
                                    ->where('code', $this->code)
                                    ->join('vouchers as v', 'v.id', '=', 'candidates.voucher_id')
                                    ->first()
                                    ->toArray();
    }

    public function rescue()
    {
        $emails = Participants::all()->pluck('email')->toArray();
        Mail::send(new RescueMailNotifier($emails));
        event(new AlertSystemEvent());
        Rescue::query()->updateOrCreate(['ip_address' => request()->ip()], [
            'candidate_id' => $this->candidate['id'],
            'ip_address' => request()->ip(),
            'actual_latitude' => $this->form['actual_latitude'],
            'actual_longitude' => $this->form['actual_longitude']
        ]);

        $this->dispatch('callToaster', ['message' => 'Alert has been submitted!']);
    }

    public function showComplaintForm()
    {
        $this->validate([
            'code' => 'required|exists:candidates,code',
        ]);
        $candidate = Candidate::query()->selectRaw('agency_id')->where('code', $this->code)->first();
        return redirect()->to(route('complaint-form-livewire', ['agencyId' => $candidate->agency_id]));
    }
}
