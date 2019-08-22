@php ($text = isset($text) ? $text : 'Loading...')
@php ($img = isset($img) ? $img : 'assets/img/loading.gif')

<style>
#loadingImg {
		-webkit-animation: rotation 1s infinite linear;
}

@-webkit-keyframes rotation {
		from {
				-webkit-transform: rotate(0deg);
		}
		to {
				-webkit-transform: rotate(359deg);
		}
}
</style>



<div id="spinnerContainer">
  <div class="spinnerCentreBox">
    <div id="spinnerIcon">
      {{-- <img src="{{ $img }}" /> --}}      
      <span>
        <svg  id="loadingImg" width="40" height="40" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="clock"><circle fill="none" stroke="#000" stroke-width="1.1" cx="10" cy="10" r="9"></circle><rect x="9" y="4" width="1" height="7"></rect><path fill="none" stroke="#000" stroke-width="1.1" d="M13.018,14.197 L9.445,10.625"></path></svg>
      </span>
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