{{-- <a href="#{{ $id }}" uk-toggle>Open</a> --}}
<div id="{{ $id }}" uk-modal>
  <div class="uk-modal-dialog">

    <button class="uk-modal-close-default" type="button" uk-close></button>

    <div class="uk-modal-header">
      {!! $header !!}
    </div>

    <div class="uk-modal-body" uk-overflow-auto>
      {!! $body !!}
    </div>

    <div class="uk-modal-footer uk-text-right">
      @foreach ($buttons as $b)
        @php ($class = isset($b['class']) ? $b['class'] : '')
        @php ($type = isset($b['type']) ? $b['type'] : '')
        @php ($text = isset($b['text']) ? $b['text'] : '')        
      <button class="uk-button uk-button-default {{ $class }}" type="{{ $type }}">{{ $text }}</button>

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
      ['class'=>'class1','type'=>'button', 'text'=>'Botão1'],
      ['class'=>'class2','type'=>'button', 'text'=>'Botão2'],
      ['class'=>'class3','type'=>'button', 'text'=>'Botão3']
    ]
  ])
@endcomponent
--}}