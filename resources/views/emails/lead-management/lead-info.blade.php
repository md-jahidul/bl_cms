@component('mail::message')
    Dear X

    {{ $data['message'] }}


{{--@component('mail::button', ['url' => ''])--}}

@endcomponent
{{--Thanks,<br>--}}
{{--{{ config('app.name') }}--}}
{{--@endcomponent--}}
