<style>
.pac-container {   
    z-index:9999 !important ;
}
.alert-message .message{
	color:green;
	font-weight:bold;
}
.map-canvas-outer{float:left; height:450px}
/* .map-canvas-outer .gm-style{ position:inherit !important; height:350px !important;} */
.add-listing-address.btn.btn-dark.btn-gradient a,.edit-listing-address.btn.btn-dark.btn-gradient a,.edit-address-save.btn.btn-dark.btn-gradient a{color:#fff;text-decoration:none;}


</style>
<?php 
	global $user,$base_url;
	//drupal_add_css(drupal_get_path('theme', 'gloobers2') .'/css/colorbox.css','file');
    //drupal_add_js(drupal_get_path('theme', 'gloobers2') .'/js/jquery.colorbox.js', 'file');

	if(!empty($photos)){
?>
<div class="photos-wrapper">
<?php
		$i = 1;
		foreach($photos as $photo){
			$photo 	= unserialize($photo["value1"]);
			$style 	= "thumbnail";
			$file 	= file_load($photo["fid"]);
			$imgpath = $file->uri;
?>
	<div id="photo-content<?php echo $i++; ?>" class="photo-content">
	<div class="plupload_file_action1">
		<input type="hidden" class="fileID" value="<?php echo $photo["fid"]; ?>">
		<div class="plupload_action_icon ui-icon ui-icon-circle-minus"> </div>
	</div>
		<div class="image"><img src="<?php print image_style_url($style, $imgpath) ?>"></div>
		<div class="text">
			<input type="hidden" class="fileID" value="<?php echo $photo["fid"]; ?>">
			<textarea class="highlights"><?php echo $photo["text"]; ?></textarea>
		</div>
	</div>
<?php 
		}
?>
</div>
<?php 
	}
if(!$addressListing && !$subscriptionListing){
?>
<div class="product-form-wrapper<?php if($subscriptionListing){?> subscription-form-wrapper<?php }?>">
<?php

	print drupal_render($productForm);
?>
</div>

<?php 
}
/*************************************************Add google map in location************************************************************/
/* if(strpos('product/add/location',$url)>=0) */
if($addressListing)
	{
		//print_r($productDetail); die;

/* 	echo "<pre>";
	print_r($productDetail); die; */
		if((($productDetail['address1'] != "") && ($productDetail['city'] != "") && ($productDetail['state']!= "") && ($productDetail['country']!= "")&&($productDetail['latitude'] != "") && ($productDetail['longitude'] != "")))
			{

	
			print '<div class="address-wrapper"><img alt="Google Static Map" src="http://maps.googleapis.com/maps/api/staticmap?center='.$productDetail['latitude'].','.$productDetail['longitude'].'&zoom=16&scale=false&size=600x300&maptype=roadmap&sensor=false&format=png&visual_refresh=true&markers=color:red|'.$productDetail['latitude'].','.$productDetail['longitude'].'">';
			//print all address details
			print '<div class="address-detail">';
			print $productDetail['address1'].",".$productDetail['address2']."<br/>";
			print $productDetail['city'].",".$productDetail['state'].",".$productDetail['country']." ".$productDetail['zipcode'];
			print '</div>';
			print '<div class="add-listing-address btn btn-dark btn-gradient"><a  class="inline" href="#address-form">'.t('Edit Address').'</a></div></div>';
			
			}
			else
			{	
			
			print '<div class="no-listing">';
			
			print '<div class="map-pin"><img src='.$GLOBALS["base_url"].'/'. drupal_get_path("theme",$GLOBALS["theme"]).'/images/staticmap.png'.' /></div>';					
			
			print '<div class="address-detail">This listing has no address.</div>';
			print '<div class="add-listing-address btn btn-dark btn-gradient"><a  class="inline" href="#address-form">'.t('Add Address').'</a></div>';
			print '</div>';
				
			}
			print '<a class="inline" href="#no-address-found" id="wrong-address"></a>';
		    print '<a class="inline-map" href="#dm-map-div" id="edit-wrong-address"></a>';
			/*******************************************************************************/
			
		  
			print '<div class="add-address" style="display:none;">';
			print '<div id="dm-map-div" style="padding:10px; background:#fff;">';
            print '<div class="alert-message" style="float:left;margin-bottom:15px;"></div><div class=map-canvas-outer>';
            print '<h4>'.t('Drag pin to update your location.').'</h4>';			
			print  '<div id="map-canvas" style="width:500px;height:300px;"> </div>';	
			print   '<div class="address-details"></div>';		  
			print '<div class="edit-listing-address btn btn-dark btn-gradient"><a class ="inline" href="#address-form">'.t('Edit Address').'</a></div>' ;		  
			print '<div class="edit-address-save btn btn-dark btn-gradient"><a  href="'.url("product/add/location/".arg(3)).'">'.t('Finish').'</a></div>' ;		  
			print '</div>';
		  
		  print '</div>';
			/**********************************************************************/
				print '<div id="address-form" style="padding:10px; background:#fff;">';				
				echo  drupal_render($addressform);
				print '</div>';
				/**********************************************************************/	
			   print '<div id="no-address-found" style="padding:10px; background:#fff;">';
				   print '<h2>Location Not Found</h2></br>
				   <h4>Would you like to manually pin this listing\'s location on a map?</h4>';
				   print '<p>We couldn\'t automatically find this listing\'s location, but if the address below is correct you can manually pin its location on the map instead.</p>';
				   print '<div id="wrong-address-details"></div>';
					   print '<div class="edit-listing-address btn btn-dark btn-gradient"><a class ="inline" href="#address-form">'.t('Edit Address').'</a></div>' ;
					 //  print '<div class="pin-on-map"><a href ="#pin-map">'.t('Pin On Map').'</a></div>';
			   print  '</div>';
			   /**********************************************************************/
          		   
			print '</div>';
			
			/*******************************************************************************/
}
if(!$subscriptionListing){

?>


<div class="helpbox">
	<h2>Help text</h2>
    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p> <p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
    
</div>


<?php
}
/*************************************************************************************************************/
	if($extrasListing){
?>
<div class="row product-extra">
        <div class="col-md-12">
          <div class="panel">
            <div class="panel-heading">
              <div class="panel-title"> Product Extras </div>
            </div>
            <div class="panel-body">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Name and description</th>
                      <th>Type</th>
                      <th>Cost</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
				<?php 
					foreach($extras as $extra){
						$extra1 	= unserialize($extra["value1"]);
				?>
                    <tr>
                      <td><?php echo $extra1["title"]; ?><br/><?php echo $extra1["description"]; ?></td>
                      <td><?php echo $extra1["price-key"]; ?></td>
                      <td><?php echo $extra1["price-type"]; ?><?php echo $extra1["price"]; ?></td>
                      <td><a href="<?php echo $base_url; ?>/product/extra/edit/<?php echo $extra["listing_id"]; ?>/<?php echo $extra["meta_id"]; ?>">Change</a> | <a href="<?php echo $base_url; ?>/product/extra/delete/<?php echo $extra["listing_id"]; ?>/<?php echo $extra["meta_id"]; ?>">Remove</a></td>
                    </tr>
				<?php 
					}
				?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
</div>

<?php }
if($subscriptionListing){

?>

<div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1">
          <hr class="alt">
          <div class="pricing-tables margin-top-lg text-center row">
            <div class="col-sm-4 col-md-3 hero-plan">
              <div class="pricing-plan margin-none">
                <div class="pricing-title btn-blue4">
                  <h3>GOLD</h3>
                  <span class="pricing-subtitle">Most Popular</span> </div>
                <div class="pricing-info"> <span class="currency-sign">$</span>
                  <h2>59</h2>
                  <h6>Per Month</h6>
                </div>
                
                <a href="#" class="btn btn-blue4">Sign up</a> </div>
            </div>
            <div class="col-sm-4 col-md-3 hero-plan">
              <div class="pricing-plan margin-none">
                <div class="pricing-title btn-blue">
                  <h3>SILVER</h3>
                  <span class="pricing-subtitle">Most Popular</span> </div>
                <div class="pricing-info"> <span class="currency-sign">$</span>
                  <h2>29</h2>
                  <h6>Per Month</h6>
                </div>
                
                <a href="#" class="btn btn-blue">Sign up</a> </div>
            </div>
            <div class="col-sm-4 col-md-3 hero-plan">
              <div class="pricing-plan margin-none">
                <div class="pricing-title btn-green">
                  <h3>CLASSIC FREE</h3>
                  <span class="pricing-subtitle">Totally Free</span> </div>
                <div class="pricing-info"> <!--<span class="currency-sign">$</span>
                  <h2>59</h2>
                  <h6>Per Month</h6>-->
                </div>
                
                <a href="#" class="btn btn-green">Sign up</a> </div>
            </div>
            
          </div>
        </div>
      </div>
<?php }?> 


  
<script>
	var jq=jQuery.noConflict();
	jq(document).ready(function(){
		/* jq(".nav-tabs li").click(function(){
			var target = jq(this).find("a").attr("id");
			switch(target){
				case "product_details":
					break;
				case "product_service":

					break;	
				case "product_rules":

					break;
				case "product_pricing":

					break;	
				case "product_subscription":

					break;
				case "product_extra":

					break;	
				case "product_amenities":

					break;
				case "product_location":

					break;	
				case "product_scheduling":
					break;
					
			}
			jq( "#product-add-form" ).submit();
		}); */
	}); 
</script>	
<script>
var jq = jQuery.noConflict();
    jq(function () {	
		jq(".plupload_file_action1").click(function(){
		/* return false; */
			var fileID = jq(this).find(".fileID").val();
			var menuchahidihaiid = jq(this).parent().attr("id");

			jConfirm("Are you sure you wish to delete this photo? It's a nice one! ", 'Delete Photo', function(r) {
				if (r == true)
				{
					jq.ajax({
						beforeSend: function(){
							jq("#"+menuchahidihaiid).parent().append('<span style="color:green;font-weight:bold;font-size:15px;" class="ajax-running">Deleting...</span>');
						},
						complete: function(){
							jq("#"+menuchahidihaiid).parent().find(".ajax-complete").delay(1500).fadeOut('slow');
							jq("#"+menuchahidihaiid).delay(3000).fadeOut('slow');
						},
						type: "POST",
						url: "<?php echo $base_url;?>/product/add/images?action=delete-photo",
						data: { "fileID": fileID}
					})
					.done(function( data ) {
						jq("#"+menuchahidihaiid).parent().find(".ajax-running").hide();
						jq("#"+menuchahidihaiid).parent().append('<span style="color:green;font-size:15px;font-weight:bold;" class="ajax-complete">Deleted</span>');
					});
					
/* 					self.removeFile($(e.target).closest('.plupload_file').attr('id'));
					e.preventDefault(); */
				}

			});	
		});
		
			jq( ".highlights" ).blur(function() {	
				var fileID = jq(this).parent().find('.fileID').val();
				var customText = jq(this).val();
			
				var menuchahidihaiid = jq(this).parent().parent().attr("class");
				jq.ajax({
					beforeSend: function(){
						jq("."+menuchahidihaiid).parent().append('<span style="color:green;font-weight:bold;font-size:15px;" class="ajax-running">Saving...</span>');
					},
					complete: function(){
						jq("."+menuchahidihaiid).parent().find(".ajax-complete").delay(2000).fadeOut('slow');
					},
					type: "POST",
					url: "<?php echo $base_url;?>/product/add/images?action=add-text",
					data: { "fileID": fileID, "customText": customText }
				})
				.done(function( data ) {
					jq("."+menuchahidihaiid).parent().find(".ajax-running").hide();
					jq("."+menuchahidihaiid).parent().append('<span style="color:green;font-size:15px;font-weight:bold;" class="ajax-complete">Saved</span>');
				});
			});
			
})
 
</script>
</script>	
<script src="http://yui.yahooapis.com/3.17.2/build/yui/yui-min.js"></script>
<script>
YUI().use('pjax', function (Y) {
	var pjax = new Y.Pjax({
		container: '.container',
		contentSelector: '.content',
		linkSelector: '#product_photos,#product_overview,#product_amenities,#product_location'
		});
		pjax.on('navigate', function (e) {
			this.get('container').addClass('add-product-loading');
		});
		pjax.on(['error', 'load'], function (e) {
			this.get('container').removeClass('add-product-loading');
		});
	});
</script>
<script>

	var jq=jQuery.noConflict();
	jq(document).ready(function(){
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
				url: "<?php echo $base_url; ?>/product/ajax/getProductDetail",
				dataType: "json",
				data: "productId=" + encodeURI("<?php echo arg(3);?>"),
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
	
	});
</script>
<script>
document.getElementById("edit-cancel").type="button";
document.getElementById("edit-next").type="button";

var placeSearch, autocomplete,marker,map,location_info;

var jq=jQuery.noConflict();
	jq(document).ready(function(){
	
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
	 jq.get( "<?php echo $base_url; ?>/update_product_list/"+"<?php echo arg(3);?> "+"/"+address1+"/"+address2+"/"+city+"/"+state+"/"+zipcode+"/"+country+"/"+latitude+"/"+longitude, function() {
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

	
  function initializeMap(location_info='',address1='',address2='',city='',state='',zipcode='',country='') {
  
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
		alert(str);
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
     
      "<?php echo $base_url; ?>/update_product_list/"+"<?php echo arg(3);?>"+"/"+address1+"/"+address2+"/"+city+"/"+state+"/"+zipcode+"/"+country+"/"+newLatitude+"/"+newLongitude
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
</script>