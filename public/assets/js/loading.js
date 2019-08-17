function waitAndRun(delay, runIt){
	setTimeout(function() {
		runIt();
  }, delay);
  //Use:
  //waitAndRun(2000, function teste(){console.log('a')})
}
function spinnerStart(){
  var state = document.readyState;
  if (state == 'loaded' || state == 'complete')
  {
    jQuery('#spinnerContainer').hide();
  }else
    { jQuery('#spinnerContainer').show(); }

  //before load
  window.onbeforeunload = function () { jQuery('#spinnerContainer').show(); }  
  //after loaded
  jQuery(window).on('load', function(){
  jQuery('#spinnerIcon').addClass('bounceOutUp');
  jQuery('#spinnerIcon').addClass('animated');
    waitAndRun(500,  function run(){
      jQuery('#spinnerContainer').addClass('fadeOut');
      jQuery('#spinnerContainer').addClass('animated');
        waitAndRun(500, function run(){
          jQuery('#spinnerContainer').hide();
          jQuery('#spinnerIcon').removeClass('fadeOut');
          jQuery('#spinnerIcon').removeClass('animated');
          jQuery('#spinnerContainer').removeClass('fadeOut');
          jQuery('#spinnerContainer').removeClass('animated');
        });
    });
  });
}
spinnerStart();