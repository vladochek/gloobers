document.getElementById("edit-cancel").type="button";
document.getElementById("edit-next").type="button";

var placeSearch, autocomplete,marker,map,location_info;

var jq=jQuery.noConflict();
	jq(document).ready(function(){
	/***************************************************************************************************************/
	jq(".inline").colorbox({inline:true, width:"50%"});
	jq(".inline-map").colorbox({inline:true, width:"40%"});
	validate();	
    jq('#edit-address1, #edit-city, #edit-state').keyup(validate);
	function validate(){
    if (jq('#edit-address1').val().length   >   0   &&
        jq('#edit-city').val().length  >   0   &&
        jq('#edit-state').val().length    >   0) {
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
					jq(".address-details").append("<span>"+addressline1+"</span><br/><span>"+addressline2+"</span><br/><span>"+countryline+"</span>");
					
				}
			});
	}
	jq("#edit-wrong-address").click(function(){
	getaddressByAjax();
	});
	/***************************************************************************************************************/
	
	
	jq("#edit-cancel").click(function(){
		jq( "#cboxClose" ).trigger( "click" );
	});

	
	
	jq("#edit-next").click(function(){
	google.maps.event.addDomListener(window, 'load', initialize);
	var geocoder = new google.maps.Geocoder();
	//jq(".no-listing").hide();
    //jq( "#cboxClose" ).trigger( "click" );
	
	var address1=document.getElementById('edit-address1').value;
	var address2=document.getElementById('edit-address2').value;	
	var city    =document.getElementById('edit-city').value;	
	var state   =document.getElementById('edit-state').value;	
	var zipcode   =document.getElementById('edit-zipcode').value;	
	var country   =document.getElementById('edit-country').value;
		
	var address =(address1)?address1+",":"";	
	address += (address2)?address2+",":"";
	address += (city)?city+",":"";
	address += (state)?state+",":"";
	address += (zipcode)?zipcode+",":"";
	address += (country)?country:"";

    geocoder.geocode( { 'address': address}, function(results, status) {
	  if (status == google.maps.GeocoderStatus.OK) {	 
		var latitude = results[0].geometry.location.lat();
		//alert(latitude);
		var longitude = results[0].geometry.location.lng();
		//alert(longitude);
		 /* jq.get( 
      // Callback URL.
      "<?php echo $base_url; ?>/update_product_list/"+"<?php echo arg(3);?> "+"/"+address1+"/"+address2+"/"+city+"/"+state+"/"+zipcode+"/"+country+"/"+latitude+"/"+longitude
    ); */
	 jq.get( $baseURL+"/update_product_list/"+$productId+"/"+address1+"/"+address2+"/"+city+"/"+state+"/"+zipcode+"/"+country+"/"+latitude+"/"+longitude, function() {
	 var location_info = new google.maps.LatLng(latitude,longitude);	
    initializeMap(location_info,address1,address2,city,state,zipcode,country);
	jq(".alert-message .message").text("");
	jq(".alert-message").append("<span class='message'>Your changes has been saved.</span>");
	jq(".alert-message .message").delay(15000).fadeOut('slow');
})
		/* var location_info = new google.maps.LatLng(latitude,longitude);	 */
	
	   } 
	   else
	   {  
	   
	  var  addressdetail1=(address1)?address1+",":"";
	  addressdetail1 += (address2)?address2+",":"";
	  var addressCityDetails=(city)?city+",":"";
	   addressCityDetails+= (state)?state+",":"";
	   var countryDetails=(country)?country+" ":" ";
	   countryDetails +=(zipcode)?zipcode:"";
	   jq("#wrong-address-details").append("<span>"+addressdetail1+"</span><br/><span>"+addressCityDetails+"</span><br/><span>"+countryDetails+"</span>")
	   jq("#wrong-address").trigger( "click" );
	   jq(".no-listing").show();
	   //alert('cannot determine location');
	   }

	/* initializeMap(location_info,address1,address2,city,state,zipcode,country);
	jq(".alert-message .message").text("");
	jq(".alert-message").append("<span class='message'>Your changes has been saved.</span>");
	jq(".alert-message .message").delay(15000).fadeOut('slow'); */
	
		});
		
	});
	
initialize();

	
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
    center: location_info
  };
//alert(location_info);
  map = new google.maps.Map(document.getElementById('map-canvas'),
          mapOptions);


  marker = new google.maps.Marker({
    map:map,
	draggable:true,
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
			jq(".address-details").append("<span>"+addressline1+"</span><br/><span>"+addressline2+"</span><br/><span>"+countryline+"</span>");
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
		} 
  for(var i=0; i < place.address_components.length; i++)
  {
	var addr = place.address_components[i];
	//alert(addr.toSource());
		
		if(addr.types[0] == "route")
		{
		    if(place.name !=addr.long_name)
		    {
			long_addr = long_addr+', '+addr.long_name;
			document.getElementById('edit-address1').value = long_addr;
			}
		}
		else if(addr.types[0] == "sublocality_level_1")
		{
		     if(place.name !=addr.long_name)
		    {
			long_addr = long_addr+', '+addr.long_name;
			document.getElementById('edit-address1').value = long_addr;
			}
		}
		else if(addr.types[0] == "sublocality_level_2")
		{
		
		  if(place.name !=addr.long_name)
		   {
		   document.getElementById('edit-address2').value = addr.long_name;
			//long_addr = long_addr+', '+addr.long_name;
			//document.getElementById('edit-address1').value = long_addr;
		  }
		}
		else if(addr.types[0] == "locality")
		{
			document.getElementById('edit-city').value = addr.long_name;
		}
		else if(addr.types[0] == "administrative_area_level_1")
		{
			document.getElementById('edit-state').value = addr.long_name;
		}
		else if(addr.types[0] == "postal_code")
		{
			document.getElementById('edit-zipcode').value = addr.long_name;
		}
		else if(addr.types[0] == "country")
		{
			document.getElementById('edit-country').value = addr.long_name;
		}
		else
		{
		document.getElementById('edit-zipcode').value = "";
		document.getElementById('edit-address2').value = "";
		}
		
  }

  
}
<!----------------------------------------------------------------------------->
});
