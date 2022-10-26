@component('mail::message')
# Introduction

Dear {{$email}},
You are now registered to CMU Alumni system.

@component('mail::button', ['url' => env('APP_URL')])
Visit site
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
