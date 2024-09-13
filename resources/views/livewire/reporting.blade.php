<div>
    <livewire:toaster/>
    <div class="container-fluid mt-5">
        <div class="row justify-content-center">
            @if(!$candidate)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <div class="card-title text-white">
                                OFW Reporting
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-column">
                                <label>Enter your code: </label>
                                <div class="d-flex flex-row">
                                    <input type="text" class="form-control me-2" wire:model.live="code">
                                    <button class="btn btn-primary h-100 m-0" wire:click="showDetails">Submit</button>
                                </div>
                                @error('code')<span
                                    class="badge badge-sm bg-gradient-danger mt-2">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-12"></div>
            @if($candidate)
                @if($candidate['status'] == 'deployed')
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header bg-primary">
                                <div class="card-title text-white">
                                    OFW Reporting
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 border-bottom">
                                        <div class="row">
                                            <div class="col-md-3 d-flex justify-content-start justify-content-md-end">
                                                <label class="m-0 my-auto">Name</label>
                                            </div>
                                            <div class="col-md-auto"><strong>{{ $candidate['first_name'] }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 border-bottom">
                                        <div class="row">
                                            <div class="col-md-3 d-flex justify-content-start justify-content-md-end">
                                                <label class="m-0 my-auto">Passport</label>
                                            </div>
                                            <div class="col-md-auto"><strong>{{ $candidate['passport'] }}</strong></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 border-bottom">
                                        <div class="row">
                                            <div class="col-md-3 d-flex justify-content-start justify-content-md-end">
                                                <label class="m-0 my-auto">Last Report</label>
                                            </div>
                                            <div class="col-md-auto">
                                            <span class="badge badge-sm bg-gradient-info mt-2">
                                                @isset($this->latest_report->created_at)
                                                    {{ \Carbon\Carbon::parse($this->latest_report->created_at)->diffForHumans()}}
                                                @else
                                                    No Reports Yet
                                                @endif
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12 mt-4">
                                        <label>Salary Received</label>
                                        <select class="form-select" wire:model.live="salary_received">
                                            <option value="">Select Option</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                        @error('salary_received')
                                        <span class="badge badge-sm bg-gradient-danger mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>                                    
                                    <div class="col-md-12 mt-4">
                                        <label>Salary Date</label>
                                        <input type="date" class="form-control" wire:model.live='salary_date'>
                                        @error('salary_date')
                                        <span class="badge badge-sm bg-gradient-danger mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mt-4">
                                        <label>Remarks</label>
                                        <textarea class="form-control" wire:model.live="remarks"></textarea>
                                        @error('remarks')
                                        <span class="badge badge-sm bg-gradient-danger mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-end">
                                <button class="btn btn-secondary me-2" wire:click="resetValues">Exit</button>
                                <button class="btn btn-success" wire:click="submitReport">Submit</button>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header bg-primary">
                                <div class="card-title text-white">
                                    Sorry, only deployed OFW could access this.
                                </div>
                            </div>
                            <div class="card-body">
                                Section not available
                            </div>
                            <div class="card-footer d-flex justify-content-end">
                                <button class="btn btn-secondary me-2" wire:click="resetValues">Exit</button>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
