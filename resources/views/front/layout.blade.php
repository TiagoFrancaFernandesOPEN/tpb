@include ('front/_includes/top')

@hasSection('content')
{{-- @yield('content', View::make('front/resources/contacts_res')) --}}
<div class="uk-container uk-container-center uk-margin-bottom">
@yield('content')
</div>
@endif

@hasSection('footer')
<div class="uk-container uk-container-center uk-margin-bottom">
@yield('footer')
</div>
@endif

@include ('front/_includes/footer')