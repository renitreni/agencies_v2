<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
    <a href="{{ route('applicant.form', ['candidate_id' => encrypt($candidateId)]) }}" class="btn btn-primary">
        <i class="fas fa-edit"></i>
    </a>
    <a href="{{ route('applicant-docs-livewire', ['candidate_id' => encrypt($candidateId)]) }}" class="btn btn-info">
        <i class="fas fa-paperclip"></i>
    </a>
    <a href="#" onclick="window.Livewire.emit('bindDetails', '{{ encrypt($candidateId) }}')" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#statusModal">
        <i class="fas fa-award"></i>
    </a>
</div>
