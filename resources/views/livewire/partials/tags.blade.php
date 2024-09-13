<div class="d-flex flex-wrap">
    @isset($value['tags'])
        @foreach($value['tags'] as $value)
            <span class="badge badge-pill badge-primary">{{ $value['name']['en'] }}</span>
        @endforeach
    @endisset
</div>
