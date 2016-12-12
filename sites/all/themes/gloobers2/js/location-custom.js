//document.getElementById("edit-cancel").type="button";
document.getElementById("edit-next").type="button";

var placeSearch, autocomplete,marker,map,location_info;

var jq=jQuery.noConflict();
	jq(document).ready(function(){
	/***************************************************************************************************************/
	//jq(".inline").colorbox({inline:true, width:"50%"});
	//jq(".inline-map").colorbox({inline:true, width:"40%"});
	validate();	
    jq('#edit-address1, #edit-city, #edit-state, #edit-zipcode').keyup(validate);
	function validate(){
    if (jq('#edit-address1').val().length   >   0   &&
        jq('#edit-city').val().length  >   0 &&
        jq('#edit-zipcode').val().length  >   0 ) {
        jq("#edit-next").attr("disabled", false);
    }
    else {
        jq("#edit-next").attr("disabled", true);
    }
}
	
	function getaddressByAjax()
	{
	jq.ajax({
				type: "GET",
				url: $baseURL+"/product/ajax/getProductDetail",
				dataType: "json",
				data: "productId=" + encodeURI($productId),
				success: function(msg){
					//eval(msg);
					var address1=msg.address1;
					var address2=msg.address2;
					var  city =msg.city;
					var state =msg.state;
					var country =msg.country;
					var zipcode =msg.zipcode;
					var addressline1=address1+","
					addressline1+=(address2)?address2+"":"";
					var addressline2=(city)?city+",":""
					addressline2+=(state)?state:"";
					var countryline= country+" "+zipcode;
					jq(".address-details").text("");
					jq(".address-details").html("<span>"+addressline1+"</span><br/><span>"+addressline2+"</span><br/><span>"+countryline+"</span>");
					
				}
			});
	}
	jq("#edit-wrong-address").click(function(){
	//getaddressByAjax();
	});
	/***************************************************************************************************************/
	

	function update_map() {
		var address1=document.getElementById('edit-address1').value;
		//var address2=document.getElementById('edit-address2').value;	
		var address2='';	
		var city    =document.getElementById('edit-city').value;	
		var state   =document.getElementById('edit-state').value;	
		var zipcode   =document.getElementById('edit-zipcode').value;	
		var country   =document.getElementById('edit-country').value;
		var itinerary = document.getElementById('edit-itinerary').value;	

		var address =(address1)?address1+",":"";	
		address += (address2)?address2+",":"";
		address += (city)?city+",":"";
		address += (state)?state+",":"";
		address += (zipcode)?zipcode+",":"";
		address += (country)?country:"";

		google.maps.event.addDomListener(window, 'load', initialize);
		var geocoder = new google.maps.Geocoder();

		geocoder.geocode( { 'address': address}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {	 
			var latitude = results[0].geometry.location.lat();		
			var longitude = results[0].geometry.location.lng();

			var location_info = new google.maps.LatLng(latitude,longitude);	
			initializeMap(location_info,address1,address2,city,state,zipcode,country);
			jq('.map-canvas-outer').show();				

			} 
		});
	}	
		
	
	function update_listing_address(edit_pressed) {
	jq('#load-screen').show();	
	jq("#edit-next").attr("disabled", true);
	google.maps.event.addDomListener(window, 'load', initialize);
	var geocoder = new google.maps.Geocoder();
	
	var address1=document.getElementById('edit-address1').value;
	//var address2=document.getElementById('edit-address2').value;	
	var address2='';	
	var city    =document.getElementById('edit-city').value;	
	var state   =document.getElementById('edit-state').value;	
	var zipcode   =document.getElementById('edit-zipcode').value;	
	var country   =document.getElementById('edit-country').value;
	var itinerary = document.getElementById('edit-itinerary').value;	
		
	var address =(address1)?address1+",":"";	
	address += (address2)?address2+",":"";
	address += (city)?city+",":"";
	address += (state)?state+",":"";
	address += (zipcode)?zipcode+",":"";
	address += (country)?country:"";

    geocoder.geocode( { 'address': address}, function(results, status) {
	  if (status == google.maps.GeocoderStatus.OK) {	 
		var latitude = results[0].geometry.location.lat();		
		var longitude = results[0].geometry.location.lng();		

		jq.get($baseURL+"/update_product_list/"+$productId+"/"+address1+"/"+address2+"/"+city+"/"+state+"/"+zipcode+"/"+country+"/"+latitude+"/"+longitude+"/"+itinerary)
		.success(function(result) {			
					
			var location_info = new google.maps.LatLng(latitude,longitude);	
			initializeMap(location_info,address1,address2,city,state,zipcode,country);

			jq('#load-screen').hide();

			if(edit_pressed=='edit_pressed'){
				var url = window.location.pathname;
				var list_id = url.substring(url.lastIndexOf('/') + 1);	
				redirect_url=$baseURL+'/product/add/Calendernew/'+list_id;		
				window.location.href = jQuery.trim(redirect_url);
			}
			
		})
		.error(function(jqXHR, textStatus, errorThrown) { 
			alert('Request failed! Please try again');
	   		jq(".edit-listing-address").trigger( "click" );
	   		jq('#load-screen').hide();
	   		jq("#edit-next").attr("disabled", false);
		});		
	
	   } 
	   else
	   {  	   
			var  addressdetail1=(address1)?address1+",":"";
			addressdetail1 += (address2)?address2+",":"";
			var addressCityDetails=(city)?city+",":"";
			addressCityDetails+= (state)?state+",":"";
			var countryDetails=(country)?country+" ":" ";
			countryDetails +=(zipcode)?zipcode:"";

			alert('can not determine location');
			jq(".edit-listing-address").trigger( "click" );
			jq('#load-screen').hide();
			jq("#edit-next").attr("disabled", false);
	   }	
 });
		
};


	jq("#edit-next").click(function(){
		update_listing_address('edit_pressed');		
  });	
	
initialize();

update_map();

	
  function initializeMap(location_info,address1,address2,city,state,zipcode,country) {
  
  var geocoder = new google.maps.Geocoder();
  	function geocodePosition(pos) {
	  geocoder.geocode({
		latLng: pos
	  }, function(responses) {
	  alert(responses);
		if (responses && responses.length > 0) {
		  updateMarkerAddress(responses[0].formatted_address);
		} else {
		  updateMarkerAddress('Cannot determine address at this location.');
		}
	  });
	}
	
	function updateMarkerAddress(str) {
		//
		//alert(str);
		document.getElementById('address').innerHTML = str;
	}
        google.maps.event.addDomListener(window, 'resize', function() {
        map.setCenter(location_info);
        });
  var mapOptions = {
    zoom: 16,
    center: location_info,
    minZoom: 1,
 	maxZoom: 15
  };
//alert(location_info);
  map = new google.maps.Map(document.getElementById('map-canvas'),
          mapOptions);


  marker = new google.maps.Marker({
    map:map,
	//draggable:true,
    position: location_info,
	animation: google.maps.Animation.DROP,
  });
 /*************************************************/
 google.maps.event.addListenerOnce(map, 'idle', function(){
        google.maps.event.trigger(map, 'resize');
        map.setCenter(location_info);
    });
/******************************************************/	
  google.maps.event.addListener(marker, 'click', toggleBounce);
  jq( "#edit-wrong-address").trigger( "click" );

  google.maps.event.addListener(marker, 'dragend', function(event) {
  var newLatitude=event.latLng.lat();
  //alert(newLatitude);
  var newLongitude=event.latLng.lng();
  
  var latLng = new google.maps.LatLng(newLongitude, newLatitude);
  
 // geocodePosition(marker.getPosition());
  
 	  geocoder.geocode({
		latLng: marker.getPosition()
	  }, function(responses) {
		if (responses && responses.length > 0) {
		var arrAddress = responses[0].address_components;
		for (ac = 0; ac < arrAddress.length; ac++) {

			if (arrAddress[ac].types[0] == "sublocality_level_2") { address1 = arrAddress[ac].long_name; }
			if (arrAddress[ac].types[0] == "route") { address2 = arrAddress[ac].short_name; }
			if (arrAddress[ac].types[0] == "locality") { city = arrAddress[ac].long_name; }
			if (arrAddress[ac].types[0] == "administrative_area_level_1") { state = arrAddress[ac].short_name; }
			if (arrAddress[ac].types[0] == "country") { country = arrAddress[ac].long_name; }
			if (arrAddress[ac].types[0] == "postal_code") { zipcode = arrAddress[ac].short_name; }
		}
			var addressline1=address1+","
			addressline1+=(address2)?address2+"":"";
			var addressline2=(city)?city+",":""
			addressline2+=(state)?state:"";
			var countryline= country+" "+zipcode;
			jq(".address-details").text("");
			jq(".address-details").html("<span>"+addressline1+"</span><br/><span>"+addressline2+"</span><br/><span>"+countryline+"</span>");
		  jq.get( 
     
      $baseURL+"/update_product_list/"+$productId+"/"+address1+"/"+address2+"/"+city+"/"+state+"/"+zipcode+"/"+country+"/"+newLatitude+"/"+newLongitude
    );
		} else {
		 // updateMarkerAddress('Cannot determine address at this location.');
		}
	  });
});

}
 

function toggleBounce() {

  if (marker.getAnimation() != null) {
    marker.setAnimation(null);
  } else {
    marker.setAnimation(google.maps.Animation.BOUNCE);
  }
}

<!-----------------Get address autosearch ------------------------------------------------------------>

	function initialize() {

  // Create the autocomplete object, restricting the search
  // to geographical location types.
  autocomplete = new google.maps.places.Autocomplete(
      /** @type {HTMLInputElement} */
	  (document.getElementById('edit-address1')),
      { types: ['geocode'] });

  google.maps.event.addListener(autocomplete, 'place_changed', function() {
    fillInAddress();

    update_listing_address();
///////////////
//validate();	
   // jq('#edit-address1, #edit-city, #edit-state').keyup(validate);
	if (jq('#edit-address1').val().length   >   0   &&
        jq('#edit-city').val().length  >   0   &&
        jq('#edit-state').val().length    >   0) {
        jq("#edit-next").attr("disabled", false);
    }
    else {
        jq("#edit-next").attr("disabled", true);
    }
//////////////////
  });
  }
  
  function fillInAddress() {
  
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();
  //alert(place.toSource());
  adresses = place.address_components;
  //alert(place.name);
  var long_addr = '';
  
   if(place.name)
		{
			long_addr = place.name;
			
			document.getElementById('edit-address1').value = long_addr;
			//alert(jQuery('#edit-address1').val());
		} 

	var edit_address2='';
	var edit_city='';
	var edit_state='';
	var edit_zipcode='';
	var edit_country='';

  for(var i=0; i < place.address_components.length; i++)
  {
	var addr = place.address_components[i];
	//alert(addr.toSource());
		
		if(addr.types[0] == "route")
		{
		    if(place.name !=addr.long_name)
		    {
			//long_addr = long_addr+', '+addr.long_name;
			
			//document.getElementById('edit-address1').value = long_addr;
			//alert(jQuery('#edit-address1').val());
			}
		}
		else if(addr.types[0] == "sublocality_level_1")
		{
		     if(place.name !=addr.long_name)
		    {
			long_addr = long_addr+', '+addr.long_name;
			//alert(long_addr + '2222');
			document.getElementById('edit-address1').value = long_addr;
			//alert(jQuery('#edit-address1').val());
			}
		}
		else if(addr.types[0] == "sublocality_level_2")
		{
		
		  if(place.name !=addr.long_name)
		   {
		   //document.getElementById('edit-address2').value = addr.long_name;
			//long_addr = long_addr+', '+addr.long_name;
			//document.getElementById('edit-address1').value = long_addr;
			//var edit_address2='edit_address2';
		  }
		}
		else if(addr.types[0] == "administrative_area_level_2"){
			document.getElementById('edit-city').value = addr.long_name;			
			var edit_city='edit_city';
		}
		else if(addr.types[0] == "locality" || addr.types[0] == "premise" || addr.types[1] == "locality")
		{
			document.getElementById('edit-city').value = addr.long_name;			
			var edit_city='edit_city';

		} 
		else if(addr.types[0] == "administrative_area_level_1")
		{
			document.getElementById('edit-state').value = addr.long_name;
			var edit_state='edit_state';
	
		}
		else if(addr.types[0] == "postal_code")
		{
			document.getElementById('edit-zipcode').value = addr.long_name;
			var edit_zipcode='edit_zipcode';

		}
		else if(addr.types[0] == "country")
		{
			//document.getElementById('edit-country').value = addr.long_name;	
			jQuery('#edit-country').append('<option value="'+addr.long_name+'">'+addr.long_name+'</option>');
			document.getElementById('edit-country').value=addr.long_name;
				
			var edit_country='edit_country';
		}
		else
		{
		//document.getElementById('edit-zipcode').value = "";
		//document.getElementById('edit-address2').value = "";
		}		
  }

	 // if(edit_address2==''){
	  	//document.getElementById('edit-address2').value = "";
	 // }

	  	
	  if(edit_city==''){
	  	document.getElementById('edit-city').value = "";
	  }

		
	  if(edit_state==''){
	  	document.getElementById('edit-state').value = "";
	  }

		
	  if(edit_zipcode==''){
	  	document.getElementById('edit-zipcode').value = "";
	  }

	  if(edit_country==''){
	  	document.getElementById('edit-country').value = "";
	  }
  
}
});
