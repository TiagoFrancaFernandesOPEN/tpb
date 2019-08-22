
// tinymce functions
function removeEditor(id){
	if(tinymce.get(id) != null){
		tinymce.get(id).remove();
	}
}
function addEditor(id){
	tinymce.init({
    	selector: '#'+id,
    	plugins: 'link image code',
    	relative_urls: false,
  	});
}

// Menu

function openMenuTop() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}