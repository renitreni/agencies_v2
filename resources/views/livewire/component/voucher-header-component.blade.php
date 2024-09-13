<div>
    <button type="button" class="btn btn-outline-secondary ms-3" data-bs-toggle="modal" data-bs-target="#headerModal">
       <i class="fas fa-layer-group"></i> Headers
    </button>

    <!-- Modal -->
    <div class="modal fade" id="headerModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="headerModalLabel"
         aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Headers</h5>
                    <button type="button" class=headerModal data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Header Name"
                                       aria-label="Agency username" aria-describedby="button-addon2"
                                       wire:model.live="keyword">
                                <button class="btn btn-outline-success m-0" type="button" id="button-addon2"
                                        wire:click="store">
                                    ADD
                                </button>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <ul class="list-group">
                                @foreach($headers as $item)
                                    <li class="list-group-item d-flex flex-row justify-content-between">
                                        <div>{{ $item['header_name'] }}</div>
                                        <button class="btn btn-sm btn-danger m-0"
                                                wire:click="delete({{ $item['id'] }})">
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
                </div>
            </div>
        </div>
    </div>
</div>
