<div class="{{ $wrapper ?? '' }}">
    <input type="{{ $type ?? 'text' }}"
           class="{{ isset($type) ? ($type == 'file' ? 'form-input' :'form-control') : 'form-control' }}"
           {{ $attr ?? '' }}
           wire:model.live="{{ $model }}">
</div>
