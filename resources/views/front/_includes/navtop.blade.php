@php ($menu = [
// ['name'=>'Name','url'=>'url1','icon'=>'star','target'=>'_self'],

])
@php ($routes = Route::getRoutes())
@foreach ($routes as $r)
{{-- @if ($r->uri == "" || $r->uri == "/" ) --}}
@if (strpos($r->uri, 'api/') !== false)
  @continue
@elseif (strpos($r->uri, '{') !== false)
  @continue
@elseif (strpos($r->uri, 'contacts/') !== false)
  @continue
@else
@php ($ar = ['name'=>$r->uri,'url'=>$r->uri,'target'=>'_self'])
  @php (array_push($menu, $ar))
@endif
@endforeach
<div class="uk-container-box uk-container-center uk-margin-bottom">  
  <div class="topnav" id="myTopnav">
    <a href="#home" class="active logo">TPB <span class="fullName">Tiago's Phones Book'</span></a>
     @foreach ($menu as $m)
        @php ($name = isset($m['name']) ? $m['name'] : '')
        @php ($name = $name == '/' ? 'home' : $name)
        @php ($url = isset($m['url']) ? $m['url'] : '#')
        @php ($target = isset($m['target']) ? $m['target'] : '_self')
          <a href="{{ URL::to('/').'/'.$url }}" target="{{ $target }}">{{ $name }}</a>
      @endforeach    
    <form id="form-cont-easy-autocomplete" class="uk-search uk-search-default" 
    action="{{ route('front.searchform') }}" method="post">
        @csrf
        <span class="uk-search-icon-flip" uk-search-icon></span>
        <input id="search-ajax-post" name="phrase" 
          class="uk-search-input uk-input uk-form-success uk-form-width-medium"
          type="search" placeholder="Search...">

    </form>
    <a href="javascript:void(0);" class="icon" onclick="openMenuTop()">☰</a>
  </div>
</div>