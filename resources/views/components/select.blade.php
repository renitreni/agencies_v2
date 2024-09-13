<div>
    <select class="form-select" wire:model.live="{{ $model }}">
        <option value="">-- Select --</option>
        {{ $slot }}
    </select>
</div>
