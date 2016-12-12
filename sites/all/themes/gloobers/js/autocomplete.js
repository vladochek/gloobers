
var placeSearch, autocomplete,marker,map,location_info;

var jq=jQuery.noConflict();
	jq(document).ready(function(){

	
	

initialize();

 

<!-----------------Get address autosearch ------------------------------------------------------------>

	function initialize() {

	var autocomplete1 = new google.maps.places.Autocomplete(
	/** @type {HTMLInputElement} */
	(document.getElementById('home-destination4')),
	{ types: ['geocode'] });
	
	//var autocomplete2 = new google.maps.places.Autocomplete(
	/** @type {HTMLInputElement} */
	//(document.getElementById('list-destination4')),
	//{ types: ['geocode'] });
	/***************************************************************/
   adviceLocationAutocomplete = new google.maps.places.Autocomplete(
	/** @type {HTMLInputElement} */
	(document.getElementById('edit-location')),
	{ types: ['geocode'] });
	/********************************************************************/
	google.maps.event.addListener(autocomplete1, 'place_changed', function() {

	});
	/* google.maps.event.addListener(autocomplete2, 'place_changed', function() {

	}); */
	google.maps.event.addListener(adviceLocationAutocomplete, 'place_changed', function() {

	});

  }
  


function split( val ) {
return val.split( /,\s*/ );
}
function extractLast( term ) {
return split( term ).pop();
}
jq( ".exp-type" )
// don't navigate away from the field on tab when selecting an item
.bind( "keydown", function( event ) {
if ( event.keyCode === jq.ui.keyCode.TAB &&
jq( this ).autocomplete( "instance" ).menu.active ) {
event.preventDefault();
}
})
.autocomplete({
minLength: 0,
source: function( request, response ) {
// delegate back to autocomplete, but extract the last term
response( jq.ui.autocomplete.filter(
$availableTags, extractLast( request.term ) ) );
},
focus: function() {
// prevent value inserted on focus
return false;
},
select: function( event, ui ) {
var terms = split( this.value );
// remove the current input
terms.pop();
// add the selected item
terms.push( ui.item.value );
// add placeholder to get the comma-and-space at the end
terms.push( "" );
this.value = terms.join( ", " );
return false;
}
});
});
