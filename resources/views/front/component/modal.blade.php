{{-- <a href="#{{ $id }}" uk-toggle>Open</a> --}}
<div id="{{ $id }}" uk-modal>
  <div class="uk-modal-dialog">

    <button class="uk-modal-close-default" type="button" uk-close></button>

    <div class="uk-modal-header">
      {{ $header }}
    </div>

    <div class="uk-modal-body" uk-overflow-auto>
      {{ $body }}
    </div>

    <div class="uk-modal-footer uk-text-right">
      @foreach ($buttons as $b)
        {{--
          $bs[0] = class
          $bs[1] = type
          $bs[2] = text
          --}}
        <button class="uk-button uk-button-default {{ $b['class'] }}" type="{{ $b['type'] }}">{{ $b['text'] }}</button>
      @endforeach
      <button class="uk-button uk-button-default uk-modal-close" type="button">Close</button>
    </div>

  </div>
</div>

{{--
  //Como Usar
@component ('front/component/modal', [
  'id'=>'nomemodal3','header'=>'Header3 aqui','body'=>'Corpo3 aqui',
  'buttons'=>
    [
      array('class1','button', 'Botão1'),
      array('class2','button', 'Botão2'),
      array('class3','button', 'Botão3')
    ]
  ])
@endcomponent
--}}