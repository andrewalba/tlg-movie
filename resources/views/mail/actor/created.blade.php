@component('mail::message')
# New Actor Record Created

The following Actor was added to the application.

Name
: {{ $actor->name }}

Rating
: {{ $actor->rating }}

@if($actor->alternative_name)
Alternative Name
: {{ $actor->alternative_name }}
@endif

Thanks,<br>
{{ config('app.name') }}
@endcomponent
