function load_as_lightbox(){ 
	var DocumentHeight = $(document).height();
	$('.as_lightbox_wrapper').css('height', DocumentHeight); // Set document height for As_Lightbox wrapper
}
function ShowLightBox(DivId){
	$('.as_lightbox_wrapper').show(); // Show the wrapper
	$('#'+DivId+'').show('slow'); // Show the Lightbox div, you can use another jQuery view functions such as fadeIn, fadeToggle for animations
}
function HideLightBox(DivId){
	$('.as_lightbox_wrapper').hide('slow'); // Hide the As_Lightbox wrapper
	$('#'+DivId+'').hide(); // Hide the div
}
$(document).ready(function(){
	load_as_lightbox(); // call this function after document loads
	$('#Show_Lightbox').click(function(){
		ShowLightBox('Simple_Lightbox'); // call the As_Lightbox show function
		return false;
	});
	$('#as_lightbox_close').click(function(){
		HideLightBox('Simple_Lightbox'); // call the As_Lightbox close function
		return false;
	});
});
