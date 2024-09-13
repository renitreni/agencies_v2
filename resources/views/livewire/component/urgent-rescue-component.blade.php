<div>
@if($rescueCount)
    <!-- partial -->
        <div class="content-wrapper">
            <div class="alert alert-danger d-flex justify-content-center">
                <h5 class="text-white font-weight-bold">
                    URGENT RESCUE!
                </h5>
                <button data-bs-toggle="modal" data-bs-target="#urgentModal" wire:click="showRecues"
                        class="btn btn-link ms-2 p-0 my-0 text-info">Show Details
                </button>
            </div>
        </div>
    @endif

<!-- Modal -->
    <div class="modal fade" id="urgentModal" tabindex="-1" aria-labelledby="urgentModalLabel"
         aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="urgentModalLabel">Urgent Responses</h5>
                    <button type="button" class="btn-close bg-dark" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @foreach($this->recues as $item)
                            <div class="col-12 border">
                                <div class="row">
                                    <div class="col-6">
                                        OFW Name
                                    </div>
                                    <div class="col-6 font-weight-bold">
                                        {{ $item['candidate']['last_name'] }},
                                        {{ $item['candidate']['first_name'] }}
                                    </div>
                                    <div class="col-6">
                                        Passport
                                    </div>
                                    <div class="col-6 font-weight-bold">
                                        {{ $item['candidate']['passport'] }}
                                    </div>
                                    <div class="col-6">
                                        IP Address
                                    </div>
                                    <div class="col-6 font-weight-bold">
                                        {{ $item['ip_address'] }}
                                    </div>
                                    <div class="col-6">
                                        Location
                                    </div>
                                    <div class="col-6 font-weight-bold">
                                        lat: {{ $item['actual_latitude'] }}
                                        long: {{ $item['actual_longitude'] }}
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="d-grid">
                                            <a href="{{ route('map', ['latitude' => $item['actual_latitude'],'longitude' => $item['actual_longitude'],]) }}"
                                               target="_blank"
                                               class="btn btn-primary">
                                                Locate
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
