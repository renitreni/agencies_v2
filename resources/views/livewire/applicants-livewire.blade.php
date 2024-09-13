<div>
    @push('breadcrumbs')
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Applicants</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Applicants</h6>
    @endpush
    <livewire:toaster/>
    <div class="card mt-5">
        <div class="card-body">
            <div class="card-title mb-4 d-flex flex-row">
                <h3>Applicants</h3>
                <x-a-button class="btn btn-success ms-3" href="{{ route('applicant.form') }}">
                    <i class="fas fa-plus"></i> Add Applicant
                </x-a-button>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="row mb-4 mx-2">
                    </div>
                </div>
                <div class="col-12" wire:ignore>
                    <livewire:candidate-table/>
                </div>
            </div>
        </div>
    </div>
    <x-modalform id="statusModal" modal-title="Status of {{ $details['fullname'] ?? '' }}">
        <div class="row">
            <div class="col-md-12 mb-3">
                <label>Enter a Status</label>
                <input type="text" class="form-control" wire:model.live="status">
                @error('status') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="col-md-12 mb-3">
                <h6>Statuses</h6>
                <ul class="list-group">
                    @isset($this->details['tags'])
                        @foreach($this->details['tags'] as $value)
                            <li class="list-group-item d-flex justify-content-between">
                                <label>{{ $value['name']['en'] }}</label>
                                <a href="#" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash" wire:click="detach('{{ $value['name']['en'] }}')"></i>
                                </a>
                            </li>
                        @endforeach
                    @endisset
                </ul>
            </div>
        </div>
        <x-slot name="button">
            <a href="#" class="btn btn-primary" wire:click="addStatus">Save Status</a>
        </x-slot>
    </x-modalform>
</div>
