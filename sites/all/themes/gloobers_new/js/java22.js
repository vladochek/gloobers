//create a form
jQuery(document).ready(function(){
	var esc_key	 =	document.getElementById('glooberUp').getAttribute('class');
	var button_key	 =	document.getElementById('glooberUp').getAttribute('name');
	var button_key_url	 =	document.getElementById('glooberUp').getAttribute('data-url');
	printHTML(esc_key,button_key,button_key_url);
});
function printHTML(pid,button,button_key_url){
	var f = document.createElement("iframe");
	f.setAttribute('src',button);
	f.setAttribute('height','100%');
	f.setAttribute('id','recommendFrame');
	f.setAttribute('width','100%');
	f.style.border="none";
	document.getElementById('glooberUp').appendChild(f); //pure javascript
	jQuery('#recommendFrame').find('body').append('<a href="http://staging.gloobers.net"></a>');
	//jQuery('iframe').contents().find('body').append('<a href="'+button_key_url+'"><img src="'+button+'" ></a>');
	//jQuery('#playerup').html();

}