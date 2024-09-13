<div>
    <livewire:toaster/>
    <div class="card mt-5">
        <div class="card-body">
            <div class="card-title mb-4 d-flex flex-row">
                <h3>Documents of <strong>{{ $candidate['fullname'] }}</strong></h3>
                <x-a-button class="btn btn-success ml-3">
                    <x-slot name="others">
                        data-bs-toggle="modal" data-bs-target="#documentModal" wire:click="$set('details', [])"
                    </x-slot>
                    <i class="fas fa-upload"></i> Upload Document
                </x-a-button>
            </div>
            <div class="row">
                <div class="col-12" wire:ignore>
                    <x-throwexceptions::gridjs name="documentTable" :table="$tableDocument"/>
                </div>
            </div>
        </div>
    </div>

    <x-modalform id="documentModal" modal-title="Document Upload">
        <div class="row">
            <div class="col-md-12 mb-3">
                <label>Type Of Document</label>
                <input type="text" class="form-control" wire:model.live="details.type">
                @error('details.type') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-12 mb-3 d-flex flex-column">
                <label>File</label>
                <div wire:loading wire:target="details.docu">
                    Loading...
                    <div class="spinner-border" role="status">
                        <span class="sr-only"></span>
                    </div>
                </div>
                <form wire:loading.remove>
                    <input type="file" wire:model.live="details.docu">
                    @error('details.docu') <span class="text-danger">{{ $message }}</span> @enderror
                </form>
            </div>
        </div>
        <x-slot name="button">
            <x-a-button click="store">Upload</x-a-button>
        </x-slot>
    </x-modalform>

    @push('scripts')
        <script>
            window.addEventListener('uploadDocument', path => {
                console.log(path);
                documentTable.forceRender();
            })
        </script>
    @endpush
</div>
