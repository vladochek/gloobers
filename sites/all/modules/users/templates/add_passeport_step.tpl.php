<?php 
global $user,$base_url; 
$location = array();
$desc = array();
foreach ($passeports as $key => $value){
	$location[] = $value['location'];
	$description[] = $value['description'];
}
$default_location = file_get_contents('http://freegeoip.net/json/'.$_SERVER['REMOTE_ADDR']);
$default_location=json_decode($default_location);
$default_longitude=$default_location->longitude;
$default_latitude=$default_location->latitude;
$default_country=$default_location->country_name;
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/stylesheet/for-head-foot.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/landing_page.css','file');
drupal_add_js(drupal_get_path('theme', $GLOBALS['theme']) .'/js/advisor.js','file');

?>
 <!--Steps HTML  Here--> 

<section class="steps modified_steps">
<div class="container">
<article>
<h1>Create your passeport </h1>
<p>Enter the destinations in which you can help other travelers. </p>
</article>

<div class="about_profile">
<div class="row">
<div class="search_place">


<form style="display: inline;" class="tagsfilter">
 <div class="row">
   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
   <input name="tags5"  id="_trip_loction" onblur="if (this.placeholder == ''){this.placeholder = 'Destination'; }" onfocus="if(this.placeholder == 'Destination'){this.placeholder = '';}" value="<?php if($_REQUEST['tags5']){ echo $_REQUEST['tags5']; } ?>" autocomplete="off" type="text" placeholder="Destination" /></div>
		  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"> 
			  <select class="select_box"  tabindex="1">
			  <?php foreach($passeport_types as $passeport_type){ ?>
			  			<option value="<?php echo $passeport_type['description']; ?>"> <?php echo $passeport_type['description']; ?> </option>
			  <?php } ?>
			  </select> 
		  </div>
		   <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
		   <a href="javascript:void(0);" class="button pull-right" onclick="add_passeport();"> Add </a>
		   </div>   
   </div>  
   <div class="row">                       
   <div id="createElementHandlerBox">
    <?php 
//get_passeport();
	if(!empty($passeports)){ 
			foreach($passeports as $passeport)
			{
				echo '<span  class="tagmanagerTag" tag="'.$passeport['location'].'">'.$passeport['location'].'<a class="tagmanagerRemoveTag" title="Remove" onclick="Delete_passeport(this);" id="'.$passeport['location'].'"  href="javascript:void(0);">x</a></span>';
			

			}
			
	}?>
   </div>
   </div>
 </form>
 </div>
</div>
<div class="row">
 <!--<div class="map"> <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d55373193.96960599!2d79.985516139203!3d32.104080806377034!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1434543140626" width="100%" height="300" frameborder="0" style="border:0"></iframe></div>-->
  
 <div id="map_canvas"  class="map" style="width: 900px; height: 400px; "><iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d55373193.96960599!2d79.985516139203!3d32.104080806377034!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1434543140626" width="100%" height="300" frameborder="0" style="border:0"></iframe></div>

 </div>
<div class="row submitrow">
<div class="pull-right"><a href="<?php  echo $base_url;?>/user/step4" class="latter">Do this later </a> <a href= "<?php  echo $base_url;?>/user/step4" class="button pull-right"> Next </a> </div>
</div>
</div>
</div>
</section>

<div id="get_passeport" style="display:none;"></div>
<script type="text/javascript">

jQuery(document).ready(function(){

	var locations=<?php echo json_encode($location); ?>;
	var def_loc='<?php echo $default_country ?>';
	
	var loc_desc_all=<?php echo json_encode($description); ?>;
	var markers = new Array();
	if(locations.length>0){
	for(var x = 0; x < locations.length; x++){
	
		switch (loc_desc_all[x]){
            case "I live there":
                var pinColor = "88FF88";
				break;
            case "I've been living there":
                var pinColor = "FF9933";
				break;
            case "I've been there in a business trip":
                var pinColor = "0099FF";
				break;
            case "I've been there in a romantic trip":
                var pinColor = "FF0000";
				break;
			case "I've been there with a group":
                var pinColor = "0000CC";
				break;
			case "I've been there in a lone exploration":
                var pinColor = "3366CC";
				break;
			case "I've been trip with A friend":
				var pinColor = "ffe4c4";
				break;
				
		}
		
		var myUrl = 'http://maps.googleapis.com/maps/api/geocode/json?address='+locations[x]+'&sensor=false';
		jQuery.ajax({
		  url: myUrl,
		  dataType: 'json',
		  async: false,
		  success: function(data) {
			p = data.results[0].geometry.location;			
			markers[x] = {"lat":p.lat,"lng":p.lng,"color":pinColor};
			
		  }
		});

	}
	}else{
		var pinColor = "3366CC";
		var myUrl = 'http://maps.googleapis.com/maps/api/geocode/json?address='+def_loc+'&sensor=false';
//		jQuery.ajax({
//		  url: myUrl,
//		  dataType: 'json',
//		  async: false,
//		  success: function(data) {
//                      
//			p = data.results[0].geometry.location;			
//			markers[0] = {"lat":p.lat,"lng":p.lng,"color":pinColor};
//			
//		  }
//		});
	}
	//if(locations.length>0){
	
		var mapOptions = {
			center: new google.maps.LatLng(markers[0].lat, markers[0].lng),
			minZoom: 2,
			maxZoom: 15,
			mapTypeId: 'terrain'
		};
	
	//}
	
    var infoWindow = new google.maps.InfoWindow();
    var latlngbounds = new google.maps.LatLngBounds();
	var map = new google.maps.Map(jq('#map_canvas')[0], mapOptions);
    var i = 0;
	//if(locations.length> (-1)){
    var interval = setInterval(function () {
		var data = markers[i];
		var myLatlng = new google.maps.LatLng(data.lat, data.lng);
		icon = "http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + data.color;
       
	   var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            animation: google.maps.Animation.DROP,
            icon: new google.maps.MarkerImage(icon)
        });
      
        latlngbounds.extend(marker.position);
        i++;
        if (i == markers.length) {
            clearInterval(interval);
            var bounds = new google.maps.LatLngBounds();
            map.setCenter(latlngbounds.getCenter());
            map.fitBounds(latlngbounds);
        }
    }, 80);
	//}

});


function insertMap(){
	
	get_passeport();
	var Updated_passeport=document.getElementById("get_passeport").innerHTML;
	var getContants=Updated_passeport.split('|');
	var locationsall=getContants[0];
	var locations=Array();
	var locdesc=getContants[1];
	var loc_desc_all=Array();
	locations = jQuery.parseJSON(locationsall);
	loc_desc_all = jQuery.parseJSON(locdesc);
	var markers = new Array();
	
	for(var x = 0; x < locations.length; x++){
		switch (loc_desc_all[x]){
            case "I live there":
                var pinColor = "88FF88";
				break;
            case "I've been living there":
                var pinColor = "FF9933";
				break;
            case "I've been there in a business trip":
                var pinColor = "0099FF";
				break;
            case "I've been there in a romantic trip":
                var pinColor = "FF0000";
				break;
			case "I've been there with a group":
                var pinColor = "0000CC";
				break;
			case "I've been there in a lone exploration":
                var pinColor = "3366CC";
				break;
			case "I've been trip with A friend":
				var pinColor = "ffe4c4";
				break;
				
		}
		
		var myUrl = 'http://maps.googleapis.com/maps/api/geocode/json?address='+locations[x]+'&sensor=false';
		  jQuery.ajax({
		  url: myUrl,
		  dataType: 'json',
		  async: false,
		  success: function(data) {
                      
			p = data.results[0].geometry.location;			
			markers[x] = {"lat":p.lat,"lng":p.lng,"color":pinColor};
			
		  }
		});

	}
	//if(locations!=''){
		var mapOptions = {
			center: new google.maps.LatLng(markers[0].lat, markers[0].lng),
			minZoom: 2,
			maxZoom: 15,
			mapTypeId: 'terrain'
		};
	/* }else{
		 var myOptions = {
			zoom: 1,
			center: new google.maps.LatLng(0, 0),
			mapTypeId: 'terrain'
		};
        map = new google.maps.Map(jq('#map_canvas')[0], myOptions);
	
	} */
    var infoWindow = new google.maps.InfoWindow();
    var latlngbounds = new google.maps.LatLngBounds();
	var map = new google.maps.Map(jq('#map_canvas')[0], mapOptions);
    var i = 0;
    var interval = setInterval(function () {
        var data = markers[i];		
        var myLatlng = new google.maps.LatLng(data.lat, data.lng);
        icon = "http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + data.color;
        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            animation: google.maps.Animation.DROP,
            icon: new google.maps.MarkerImage(icon)
        });
        
        latlngbounds.extend(marker.position);
        i++;
        if (i == markers.length) {
            clearInterval(interval);
            var bounds = new google.maps.LatLngBounds();
            map.setCenter(latlngbounds.getCenter());
            map.fitBounds(latlngbounds);
        }
    }, 80);
	jQuery('#_trip_loction').attr('placeholder','Destination');
	jQuery('#_trip_loction').attr('value','');
}
function get_passeport(){
	
		var location =jQuery('#_trip_loction').val();
		var description =jQuery('.select_box').val();
		jQuery.ajax({
				url: $baseUrl + '/ajax/user/getpasseport',
				type: 'post',
				async: false,
				success: function (result) {
                                    
					var response = result;
					jQuery('#get_passeport').html(result);
				},
		});
		
}
	
function add_passeport(){
	
	var location =jQuery('#_trip_loction').val();
	
	if(location==''){
		alert('Please fill location');
		jQuery('#_trip_loction').attr('placeholder','Destination');
		jQuery('#_trip_loction').attr('value','');
		return false;
	}else{
		var description =jQuery('.select_box').val();
		jQuery.ajax({
			url: $baseUrl + '/ajax/user/addpasseport',
			type: 'post',
			async:false,
			data: {location:location, description:description},
			success: function (result) {
				jQuery('#createElementHandlerBox').html(result);
				jQuery('#_trip_loction').val('');
			},
		});
		insertMap();
	}
}
	
function Delete_passeport(location){
	var location2 =jQuery(location).parent().attr('tag');
	jQuery.ajax({
		url: $baseUrl + '/ajax/user/deletepasseport',
		type: 'post',
		async: false,
		data: {location:location2},
		success: function (result) {
			jQuery('#createElementHandlerBox').html(result);
		}
	});
	Delete_map(location);
}
function Delete_map(location){
	get_passeport();
	var Updated_passeport=document.getElementById("get_passeport").innerHTML
	var getContants=Updated_passeport.split('|');
	var locationsall=getContants[0];
	var locationsAll=Array();
	var locdesc=getContants[1];
	var locDesc=Array();
	locationsAll = jQuery.parseJSON(locationsall);
	locDesc = jQuery.parseJSON(locdesc);
	
	//var value_del_select=jQuery.inArray(location_select,locationsAll);
	
	//var locations_removed = locationsAll.splice(value_del_select,1);
	//var locDesc_removed = locDesc.splice(value_del_select,1);
	/* alert(locationsAll.length);
	alert(locDesc); */
	var markers = new Array();
	
	for(var x = 0; x < locationsAll.length; x++){
		switch (locDesc[x]){
            case "I live there":
                var pinColor = "88FF88";
				break;
            case "I've been living there":
                var pinColor = "FF9933";
				break;
            case "I've been there in a business trip":
                var pinColor = "0099FF";
				break;
            case "I've been there in a romantic trip":
                var pinColor = "FF0000";
				break;
			case "I've been there with a group":
                var pinColor = "0000CC";
				break;
			case "I've been there in a lone exploration":
                var pinColor = "3366CC";
				break;
		}
		
		var myUrl = 'http://maps.googleapis.com/maps/api/geocode/json?address='+locationsAll[x]+'&sensor=false';
		  jQuery.ajax({
		  url: myUrl,
		  dataType: 'json',
		  async: false,
		  success: function(data) {
                      alert(data);
			p = data.results[0].geometry.location;			
			markers[x] = {"lat":p.lat,"lng":p.lng,"color":pinColor};
					//set_value(markers);
                      
		  }
		});

	}
	if(locationsAll.length > 0){
		var mapOptions = {
        center: new google.maps.LatLng(markers[0].lat, markers[0].lng),
        zoom: 1,
        mapTypeId: 'terrain'
		};
	}else{
		 var myOptions = {
			zoom: 1,
			center: new google.maps.LatLng(0, 0),
			mapTypeId: 'terrain'
		};
		 map = new google.maps.Map(jq('#map_canvas')[0], myOptions);
    }
	
    var infoWindow = new google.maps.InfoWindow();
    var latlngbounds = new google.maps.LatLngBounds();
   // var map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);
	var map = new google.maps.Map(jq('#map_canvas')[0], mapOptions);
    var i = 0;
	if(locationsAll.length > 0){
    var interval = setInterval(function () {
        
		
			var data = markers[i];			
			var myLatlng = new google.maps.LatLng(data.lat, data.lng);
			icon = "http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + data.color;
			var marker = new google.maps.Marker({
				position: myLatlng,
				map: map,
				animation: google.maps.Animation.DROP,
				icon: new google.maps.MarkerImage(icon)
			});
		
		// (function (marker, data){
  //           google.maps.event.addListener(marker, "click", function (e) {
  //               infoWindow.setContent(data.description);
  //               infoWindow.open(map, marker);
  //           });
  //       })(marker, data);
        latlngbounds.extend(marker.position);
        i++;
        if(i == markers.length){
            clearInterval(interval);
            var bounds = new google.maps.LatLngBounds();
            map.setCenter(latlngbounds.getCenter());
            map.fitBounds(latlngbounds);
        }
    }, 80);
	}
}
</script>

<script type="text/javascript">
    
    jQuery(document).ready(function() {
      jQuery("html").niceScroll();
	  //jQuery(".select").selectbox();
      
      });
     /*  jQuery(function () {
      jQuery(".select_box").selectbox();
    }); */ // When the browser is ready...
 
  </script>
