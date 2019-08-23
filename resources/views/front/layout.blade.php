@include ('front/_includes/top')

@hasSection('content')
<div class="uk-container-box uk-container-center uk-margin-top uk-margin-bottom uk-margin-large-bottom">
@yield('content')
</div>
@endif

@hasSection('footer')
<div class="uk-container uk-container-center uk-margin-bottom">
@yield('footer')
</div>
@endif

@include ('front/_includes/footer')