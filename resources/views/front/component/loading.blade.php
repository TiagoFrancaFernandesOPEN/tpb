@section ('inside_head')
  <!-- Start Loading component -->
  <link rel="stylesheet" href="assets/css/animate.css">
  <style> 
    #spinnerContainer
    {
      width:100%;
      height:700px;
      position:relative;
      background:#fff;
    }
    
    .spinnerCentreBox
    {
      width: 100%;
      height: 700px;
      position: relative;
      background: #fff;
      background: #ddb3e4;
      top: 0;
      /* left: 0; */
      height: 100%;
      position: fixed;
      z-index: 1000;
      overflow-x: hidden;
      transition: 0.5s;
      /* width: 0; */
    }
    #spinnerIcon{
      font-size: 3em;
      padding: 15% 15%;
      color: #331837;
      text-shadow: #ca7b1a 6px 5px 20px;
      font-family: monospace;
    }
    #spinnerIcon img {
      margin-left: 20%;
      width: 2em;
    }
    .display-none{display:none !important}
  </style>
  <script src="assets/js/loading.js"></script>
@endsection

@php ($text = isset($text) ? $text : 'Loading...')
@php ($img = isset($img) ? $img : 'assets/img/loading.gif')

<div id="spinnerContainer">
  <div class="spinnerCentreBox">
    <div id="spinnerIcon">
      <img src="assets/img/loading.gif" />
      <span id="loadingText">{{ $text }}</span>
    </div>
  </div>
</div>

{{-- 
  //Using:
@component ('front/component/loading',
[
  'img'=>'https://i.gifer.com/ZhKG.gif',
  'text'=>'Carregando...'
])
@endcomponent
  --}}