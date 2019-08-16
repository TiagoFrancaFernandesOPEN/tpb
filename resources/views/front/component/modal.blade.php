<a href="#{{ $id }}" uk-toggle>Open</a>
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
      {{-- <button class="uk-button uk-button-primary" type="button">Edit</button>
      <button class="uk-button uk-button-default uk-modal-close" type="button">Close</button> --}}
      @foreach ($ar as $a)
      <button class="uk-button uk-button-default uk-modal-close" type="button">{{ $a }}</button>
      @endforeach
    </div>

  </div>
</div>