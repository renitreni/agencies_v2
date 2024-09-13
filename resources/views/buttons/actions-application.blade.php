<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
    <a href="{{ $link ?? '#'}}" class="btn btn-info"
       @isset($modal)
       data-bs-toggle="modal"
       data-bs-target="#{{ $modal }}"
       @endisset
       @isset($listener)
       wire:click="$dispatch('{{ $listener }}', {'id' : {{ $id }}})"
        @endisset
    >
        <i class="fas fa-pencil"></i>
    </a>
    <a class="btn btn-danger">

    </a>
</div>
