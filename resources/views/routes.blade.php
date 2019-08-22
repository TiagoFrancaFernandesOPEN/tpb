@php ($routes = Route::getRoutes())
@foreach ($routes as $r)
    @if ($r->uri == "" || $r->uri == "/" )
    {{-- @if (strpos($r->uri, 'api/') !== false) --}}
    @continue
    @else
    <a href=" {{ $r->uri }} "> {{ $r->uri }} </a> | 
    @endif
@endforeach