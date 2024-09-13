@component('mail::message')
Alert Message

This is to notify you an Urgent Rescue send through Tabang System.

{{--@component('mail::button', ['url' => ''])--}}
{{--Button Text--}}
{{--@endcomponent--}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
