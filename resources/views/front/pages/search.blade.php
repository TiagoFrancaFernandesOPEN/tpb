@extends('front/layout')

@section('title')

@section('content')
<ul>
  @foreach ($results as $r)
<li>
  <a href="#{{ $r['id'] }}">{{ $r['fname'] }} {{ $r['lname'] }} ({{ $r['number'] }}) | {{ $r['email'] }}</a>
</li>
  @endforeach
</ul>

@endsection