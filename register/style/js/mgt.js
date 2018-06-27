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
//show And Hide Info
// function showInfo(clickonid, showid){
	// // document.getElementById(clickonid).addEventListener("keydown", function(){
		// // document.getElementById(showid).style.display = "block"
	// // });
		// if (document.getElementById(showid).style.display === 'block') {
			// document.getElementById(showid).style.display = 'none';
		// } else {
				// document.getElementById(showid).style.display = 'block';
		// }
// }
// print specific part printContent(id)
function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}
// when hovering over any information
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
  // $('[data-toggle="tooltip"]').css("backgroundColor","green");
})