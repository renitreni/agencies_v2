<div>
    @push('breadcrumbs')
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Rescues</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Rescues</h6>
    @endpush
    <livewire:toaster/>
    <div class="card mt-5">
        <div class="card-body">
            <div class="card-title mb-4 d-flex flex-row">
                <h3>Rescues</h3>
                <a href="{{ route('rescue') }}" target="_blank" class="btn btn-outline-info ms-2">Rescue Page</a>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary ms-2" data-bs-toggle="modal"
                        data-bs-target="#recipientModal">
                    Recipients
                </button>
            </div>
            <livewire:rescue-table/>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true"
         wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="feedbackModalLabel">Feedback</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="row">
                            <div class="col-12">
                                <label>Status</label>
                                <select class="form-select" wire:model.live="respond.status">
                                    <option value="">Select Option</option>
                                    <option value="resolved">Resolved</option>
                                    <option value="pending">Pending</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label>Please indicate below</label>
                                <textarea class="form-control" rows="8" wire:model.live="respond.feedback"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click="submitFeedback">Save changes</button>
                    <button type="button" class="btn btn-danger" wire:click="deleteFeedback">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="recipientModal" tabindex="-1" aria-labelledby="recipientModalLabel"
         aria-hidden="true"  data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="recipientModalLabel">Recipients</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Add recipient</label>
                            <input class="form-control" wire:model.live="recipient">
                            @error('recipient') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-12 mt-3">
                            <ul class="list-group list-group-flush">
                                @foreach($recipients as $item)
                                    <li class="list-group-item d-flex flex-row justify-content-between">
                                        <span>{{ $item['email'] }}</span>
                                        <button class="btn btn-sm btn-danger" wire:click="deleteEmail({{$item['id']}})">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click="addRecipient">Add</button>
                </div>
            </div>
        </div>
    </div>
</div>
