var placeSearch, autocomplete,marker,map,location_info;
var jq=jQuery.noConflict();
jq(document).ready(function(){
initialize();
/********************** Get address autosearch ********************************/

	function initialize() {
		var home_autocomplete = new google.maps.places.Autocomplete(
		/** @type {HTMLInputElement} */
		(document.getElementById('edit-keys')),
		{ types: ['geocode'] });
			google.maps.event.addListener(home_autocomplete, 'place_changed', function() {
			});	
		}
	});