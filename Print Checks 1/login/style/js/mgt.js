$( document ).ready(function() {
  // Handler for .ready() called.
	/* off-canvas sidebar toggle */
	$('[data-toggle=offcanvas]').click(function() {
		$('.row-offcanvas').toggleClass('active');
		$('.collapse').toggleClass('in').toggleClass('hidden-xs').toggleClass('visible-xs');
	});
});
function numberOnly(id){
	var access = false;
	var myId = document.getElementById(id);
	var myVal = myId.value;
	if(isNaN(myVal)){ //if true and not a number
		myId.style.border = "2px solid red";
		myId.parentElement.nextElementSibling.classList.remove("hide");
		myId.parentElement.nextElementSibling.style.color = "red";
		return access = false;
	}else{ //if number
		myId.style.border = "initial";
		myId.parentElement.nextElementSibling.classList.add("hide");
		return access = true;
	}
}
// print specific part printContent(id)
function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}
//show the loading image when refreshing the page or loading something
 window.onload = setTimeout(function(){ 
		document.getElementById("loading").style.display = "none";
		document.getElementById("hideAndShow").style.display = "block"
	}, 3000);