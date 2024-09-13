<?php

namespace App\Livewire;

use App\Models\Candidate;
use App\Models\Document;
use Gridjs\DocumentTableGridjs;
use Livewire\Component;
use Livewire\WithFileUploads;

class ApplicantDocsLivewire extends Component
{
    use WithFileUploads;

    public array $details = [];

    protected $queryString = ['candidate_id'];

    public string $candidate_id = '';

    public array $candidate = [];

    protected $listeners = ['destroyDocs' => 'destroy'];

    public function mount()
    {
        $this->candidate = Candidate::find(decrypt($this->candidate_id))->toArray();
    }

    public function render()
    {
        return view('livewire.applicant-docs-livewire', [
            'tableDocument' => app(DocumentTableGridjs::class)->make(route('docs.get')),
        ]);
    }

    public function store()
    {
        $this->validate([
            'details.docu' => 'required',
            'details.type' => 'required',
        ]);

        $path = $this->details['docu']->store('documents', 'public');

        Document::query()->insert([
            'candidate_id' => $this->candidate['id'],
            'filename' => $this->details['docu']->getClientOriginalName(),
            'path' => $path,
            'type' => ucwords($this->details['type']),
            'created_by' => Auth::id(),
        ]);

        $this->dispatch('uploadDocument', ['path' => $path]);
        $this->dispatch('callToaster', ['message' => 'Document Uploaded!']);
        $this->details = [];
    }

    public function destroy($id)
    {
        Document::query()->find($id)->delete();

        $this->dispatch('uploadDocument', ['path' => '']);
        $this->dispatch('callToaster', ['message' => 'Document Deleted!']);
        $this->details = [];
    }
}
