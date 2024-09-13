<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
    <a href="{{ $link ?? '#'}}" class="btn btn-info px-3 m-0"
            @isset($modal)
                 data-bs-toggle="modal"
                data-bs-target="#{{ $modal }}"
            @endisset
            @isset($listener)
                onclick="Livewire.emit('{{ $listener }}', {'id' : {{ $id }}})"
            @endisset
    >
        <i class="fas fa-pencil"></i>
    </a>
</div>
