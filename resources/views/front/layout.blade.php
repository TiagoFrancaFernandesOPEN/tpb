@include ('front/_includes/top')
@include ('front/_includes/navtop')

@yield('content', View::make('front/resources/contacts_res'))

@include ('front/_includes/footer')