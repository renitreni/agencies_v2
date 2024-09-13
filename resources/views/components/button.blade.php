
<button type="button" class="{{ $class ?? 'btn btn-success' }} me-2" {{ $others ?? '' }}
        @isset($click) wire:click="{{ $click }}" @endisset>
    {{ $slot }}
</button>
