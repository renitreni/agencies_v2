<div>
    @push('breadcrumbs')
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Deprive</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Deprive</h6>
    @endpush
    <livewire:toaster/>
    <div class="card mt-5">
        <div class="card-body">
            <div class="card-title mb-4 d-flex flex-row">
                <h3>Deprive</h3>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="row">
                        <div class="col-12">
                            <input class="form-control" wire:model.live="keyword" wire:keyup.debounce="searchAgency">
                        </div>
                        <div class="col-12 mt-2">
                            <ul class="list-group">
                                @foreach($this->agencies as $agency)
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-between">
                                            <div>{{ $agency['name'] }}</div>
                                            <button type="button" wire:click="showDeprive({{ $agency['id'] }})"
                                                    class="btn btn-sm btn-info mb-0">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    @if($agencyModel)
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $agencyModel['name'] }}</h5>
                                <div class="card-text">
                                    <div class="d-flex flex-row justify-content-between">
                                        <select class="form-select" wire:model.live="route">
                                            <option value="">-- Select Feature --</option>
                                            @foreach($routes as $item)
                                                <option value="{{ $item }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                        <button type="button" wire:click="addDeprived"
                                                class="mb-0 btn btn-sm btn-success">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <ul class="list-group list-group-flush">
                                @foreach($deprived as $item)
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-between">
                                            <div>{{ $item['feature'] }}</div>
                                            <button type="button" wire:click="deleteDeprive({{ $item['id'] }})"
                                                    class="btn btn-sm btn-danger mb-0">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
