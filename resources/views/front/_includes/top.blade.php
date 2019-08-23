<!DOCTYPE html>
<html>
  <head>
  @hasSection('title')
  <title>{{ SITE_NAME }} | @yield('title')</title>
  @else
  <title>{{ SITE_NAME }}</title>
  @endif
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- API URL -->
  <script> var BASE_URL_API = '{{ URL::to('/').'/api/' }}';</script>
  <script> var BASE_URL = '{{ URL::to('/').'/' }}';</script>
  <script src="{{ asset('') }}assets/js/jquery-3.4.1.min.js"></script>
  <script src="{{ asset('') }}assets/js/loading.js"></script>
<!-- Uikit Css Framework -->
  <link rel="stylesheet" href="{{ asset('') }}assets/uikit/css/uikit.min.css" />
<!-- Mobirise Icons -->
  {{-- <link rel="stylesheet" href="{{ asset('') }}assets/mobiriseicons/mobirise/style.css"> --}}
  <link rel="stylesheet" href="{{ asset('') }}assets/css/style.css" />
  @include ('front/_includes/inside_header')
</head>
<body>
@include ('front/_includes/in_open_body')