<?php

namespace App\Livewire;

use App\Models\Participants;
use App\Models\Rescue;
use App\Models\Responds;
use Livewire\Component;

class RescuesLivewire extends Component
{
    public string $recipient = '';

    public array $respond = [];

    public array $recipients = [];

    public $listeners = ['bindFeedback' => 'feedback'];

    public function render()
    {
        $this->dispatch('refreshComponent');
        $this->recipients = Participants::all()->toArray();

        return view('livewire.rescues-livewire');
    }

    public function feedback($reportID)
    {
        $this->respond = Responds::query()->where('rescue_id', $reportID)->get()->toArray();

        if (count($this->respond) == 0) {
            $this->respond = [
                'rescue_id' => $reportID,
                'status' => '',
                'feedback' => '',
            ];
        } else {
            $this->respond = $this->respond[0];
        }
    }

    public function submitFeedback()
    {
        $this->respond['inserted_by'] = Auth::id();

        Responds::query()->updateOrCreate(['rescue_id' => $this->respond['rescue_id']], $this->respond);
        $this->dispatch('callToaster', ['message' => 'Feedback has been submitted!']);
    }

    public function addRecipient()
    {
        $this->validate([
            'recipient' => 'required|email',
        ]);

        Participants::query()->create([
            'email' => $this->recipient,
            'can_receive' => 1,
        ]);

        $this->recipient = '';
    }

    public function deleteEmail($id)
    {
        Participants::destroy($id);
    }

    public function deleteFeedback()
    {
        Responds::query()->where('rescue_id', $this->respond['rescue_id'])->delete();
        Rescue::query()->find($this->respond['rescue_id'])->delete();

        $this->dispatch('callToaster', ['message' => 'Feedback has been deleted!']);
    }
}
