<div class="d-grid">
    @isset($link)
        <a href="{{ $link }}" class="btn btn-sm btn-outline-secondary px-1 m-0" {!! $attr ?? '' !!}>
            {!! html_entity_decode($label) !!}
        </a>
    @else
        <button type="button" class="btn btn-sm btn-outline-secondary px-1 m-0" {!! $attr ?? '' !!}>
            {!! html_entity_decode($label) !!}
        </button>
    @endisset

</div>
