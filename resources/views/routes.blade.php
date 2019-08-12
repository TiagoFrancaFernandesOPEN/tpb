@php ($routes = Route::getRoutes())
@foreach ($routes as $r)
    @if ($r->uri == "api/user" || $r->uri == "/" )
    @continue
    @else
    <a href=" {{ $r->uri }} "> {{ $r->uri }} </a> | 
    @endif
@endforeach
<hr>
