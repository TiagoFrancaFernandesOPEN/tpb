@extends('front/layout')

@section('title')

@section('inside_head')
@endsection

@section('content')
@endsection

@section('scripts_before_end_body')

  {{-- @component ('front/component/modal')
    @slot('id','nomemodal')
    @slot('header','Header aqui')
    @slot('body')
    Corpo aqui
    @endslot
  @endcomponent

  @component ('front/component/modal')
    @slot('id','nomemodal2')
    @slot('header','Header2 aqui')
    @slot('body')
    Corpo2 aqui
    @endslot
  @endcomponent --}}

  @component ('front/component/modal', [
    'id'=>'nomemodal3','header'=>'Header3 aqui','body'=>'Corpo3 aqui',
    'ar'=>array('class1 class2','button', 'Botão')
    // class type text
    ])
  @endcomponent

@endsection
