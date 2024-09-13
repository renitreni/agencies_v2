<div class="d-grid">
    <button type="button" class="btn btn-sm btn-primary m-0" wire:click="$dispatch('{{ $listener }}', {{ $id }})"
            data-bs-toggle="modal" data-bs-target="#{{ $modal ?? '' }}">
        {!! $label !!}
    </button>
</div>
