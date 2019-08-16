@php ($uikit="assets/uikit")
<!DOCTYPE html>
<html>
<head>
  <title>@yield('title', SITE_NAME)</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  @yield('inside_head')
  
  <link rel="stylesheet" href="assets/css/style.css" />
  
  <!-- Mobirise Icons -->
  <link rel="stylesheet" href="assets/mobiriseicons/mobirise/style.css">

  <!-- Uikit Css Framework -->
  <link rel="stylesheet" href="{{ $uikit }}/css/uikit.min.css" />
  <script src="{{ $uikit }}/js/uikit.min.js"></script>
  {{-- <script src="{{ $uikit }}/js/uikit-icons.min.js"></script> --}}

  <script src="assets/js/jquery-3.4.1.min.js"></script>
</head>
<body>