{{-- @extends('front/layout')

@section('title')

@section('inside_head')
@endsection

@section('content')
@endsection

@section('scripts_before_end_body')
  @component ('front/component/modal', [
    'id'=>'nomemodal3','header'=>'Header3 aqui','body'=>'Corpo3 aqui',
    'buttons'=>
      [
        ['class'=>'class1','type'=>'button', 'text'=>'Botão1'],
        ['class'=>'class2','type'=>'button', 'text'=>'Botão2'],
        ['type'=>'button', 'text'=>'Botão3']
      ]
    ])
  @endcomponent
@endsection --}}

@extends('front/layout')

@section('title', 'Loading')
@section('content')

  @component ('front/component/loading',
  [
    'img'=>'https://i.gifer.com/ZhKG.gif',
    'text'=>'Carregando...'
  ])
  @endcomponent

@endsection