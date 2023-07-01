@component('mail::message')
# New Movie Record Created

The following movie was added to the application.

*Title*
: {{ $movie->title }}

*Year*
: {{ $movie->year }}

@if($movie->score)
*Score*
: {{ $movie->score }}
@endif

@if($movie->rating)
*Rating*
: {{ $movie->rating }}
@endif

@if($movie->image)
*Image*
: ![{{ $movie->title }}]({{ $movie->image }})
@endif


Thanks,<br>
{{ config('app.name') }}
@endcomponent
