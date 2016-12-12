<?php
global $user,$base_url;
$userId=arg(1);
if(arg(2)){
$dest = arg(2);
}else{
$dest = null;
}
$advisor_uid = base64_encode($userId);
$user_passion = getUserPassionList($userId);
$location = array();
$desc = array();
foreach ($passeports as $key => $value) {
  if(!empty($value['location'])){
      $location[] = $value['location'];
  }
  $description[] = $value['description'];
}
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/stylesheet/for-head-foot.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/gloobers.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/landing_page.css','file');
drupal_add_css(drupal_get_path('theme',  $GLOBALS['theme']) .'/css/owl.carousel.css','file');

$userdetails = user_load(array('uid' => $userId));

if($commisson['commission']!="")
{
	$comm=$commisson['commission'];
}
else if(variable_get('commission')!="")
{
	$comm=variable_get('commission');
}
else
{
	$comm="0.0";
}

$totalProfit=getTotalAmountEarnedByUser($userId);
$profit=$totalProfit['grand_profit']-($totalProfit['refund_total']+$totalProfit['trans_fees_total']);
$banner_path=$userdetails->picture->uri;
($banner_path)?$banner_path:'';
$banner_Style="user_dashboard_banner";
$banner_profile_Style="experience_topranked";
$countryName=getcountryname($userdetails->field_country['und'][0]['iso2']);
$city=$userdetails->field_city['und'][0]['value'];
$state=$userdetails->field_state['und'][0]['value'];
$country=$userdetails->field_country['und'][0]['value'];
$google_map=googleMap($country, $city, $state, "");	
$queryfb=db_select('fboauth_users','fb');
$queryfb->fields('fb',array('uid','fbid'));
$queryfb->condition('uid',$user->uid);
$resultfb=$queryfb->execute();
$facebook_login=$resultfb->fetchAssoc();
$facebook_user_name = getUserDetails(arg(1));
$facebook_user_name=explode(' ',$facebook_user_name['name']);
$facebook_user_name_first=$facebook_user_name[0];

$query=db_select('gbl_users_meta','u');
$query->fields('u',array('occupation','confirm_status','language','mobile','about_yourself'));
$query->condition('uid',arg(1));
$result=$query->execute();
$Main_user_data=$result->fetchAll(PDO::FETCH_ASSOC);

?>


<section class="user-sec nopadding">
<div class="container nopadding">
<div class="col-md-12 col-sm-12 col-xs-12 nopadding">
<div class="profilepageblock">
<?php if(!empty($cover_pic)){ ?>
	<?php $style = "cover_pic";  print '<img src="' . image_style_url($style, $cover_pic) . '" alt="" title="" />'; ?>
<?php } else { ?>
	<img src="<?php echo  $base_url.'/sites/all/themes/gloobers_new/images/user/' ?>user-profile.jpg" alt="" title="" />
<?php } ?>
<div class="userprodata">
<div class="userpicimg">
<?php if($banner_path !=''){  ?>
	<img src="<?php print image_style_url($banner_profile_Style,$banner_path); ?>" alt="" title="" />
<?php  }else{ ?>
	<img src="<?php echo $base_url.'/sites/all/themes/gloobers_new/images/no-profile-male-img.jpg'; ?>" alt="" title="" />
<?php } ?>
</div> <!--End UserPicImg -->
<h3>
<?php if(strlen($userdetails->field_first_name['und'][0]['value']) > 10){
$dots = '..';
}
else{
$dots = '';
}
substr($userdetails->field_first_name['und'][0]['value'],0,10).$dots;
$name = $userDetails->field_first_name['und'][0]['value']; 
$firstName=$userdetails->field_first_name['und'][0]['value'];
echo (trim($firstName, "%20"))?(trim($firstName, "%20")):$facebook_user_name_first;
?>
</h3>
<h4> <?php if(!empty($loc)){echo $loc;} ?>  </h4>
</div> <!-- End UserProData -->
<?php if(($user->uid) && ($userId !=$user->uid)){ ?>
<div class="sendbuttonblock"><a href="javascript:void(0)" onclick="sendrequest_user()" class="actionbtn btnselect button">Send request</a>
<!--<a href="javascript:void(0)" onclick="forward_request('<?php echo base64_encode($value['uid']); ?>','<?php echo $advisor_data->field_first_name['und'][0]['value']; ?>')" class="actionbtn btnselect">Send request</a> -->
</div> <!-- End SendButtonBlock -->
<?php } ?>
<div class="mask"></div>
</div> <!-- End ProfilePagePlock -->
</div> <!-- End Col -->
</div> <!-- End Container -->
<div class="container">
<div class="about-matt">
<h2>About <?php if(strlen(trim($userdetails->field_first_name['und'][0]['value'],"%20")) > 10){
$dots = '..';
}
else{
	$dots = '';
}
echo substr(trim($userdetails->field_first_name['und'][0]['value'],"%20"),0,10).$dots;  
?></h2>

<div class="col-md-12 col-sm-12 col-xs-12">
<p>
<?php echo ucfirst($userdetails->field_about_yourself['und'][0]['safe_value']); ?>
</p>
</div>

 <?php

 if(empty($facebook_login)){

	if($Main_user_data[0]['confirm_status']=='yes'){ $userEmail='Verified';}else{$userEmail='Not Verified';}

 }else{

	$userEmail='Verified';

 }

 ?>
<div class="col-md-12 col-sm-12 col-xs-12">
<?php if(!empty($facebook_login)){ ?>
<div class="col-lg-6 col-sm-6 col-xs-12"> 
<div class="verifications_title"> Facebook</div>  <div class="verifications_cont"><?php echo $userEmail; ?></div>
</div>
<?php } ?>

<div class="col-lg-6 col-sm-6 col-xs-12">
<div class="verifications_title"> Email</div>  <div class="verifications_cont"><?php echo $userEmail; ?></div>
</div>
</div>
</div>
</div>

<section class="passions bg-back2">
<div class="container">
<h3>Travel passions </h3>
<div class="row">
<div class="grid">
<div id="owl-demo" class="owl-carousel owl-theme">
<?php 
if($user_passion){
foreach($user_passion as  $userpassion) { 
	$file   = file_load($userpassion['fid']);
	$imgpath = $file->uri;
	$style = 'passion_image';
	$file_thumb   = file_load($userpassion['fid_thumb']);
	$imgpath_thumb = $file_thumb->uri;
?>

	<div class="item"> 
		<figure class="effect-layla">
			<img alt="img06" src="<?php print image_style_url($style,$imgpath); ?>">
			<figcaption>
				<?php if($file_thumb){ ?>
				<!-- <div class="contblock"> <i><img alt=" " src="<?php print file_create_url($imgpath_thumb); ?>"></i>  </div> -->
				<?php } ?>
				<h2><?php echo $userpassion['passion']; ?></h2>
			</figcaption>     
		</figure> 
	</div>
<?php  }
}else{
	echo "<div class='no-results'>No travel passions</center></div>";
} ?>
</div>
</div>
</div>
</div>
</section>


<div class="dr-wrapper">
<div class="mapinfo">
<h2>Passeport</h2>
<div class="col-md-12 col-sm-12 col-xs-12">
<div class="col-md-4 col-sm-4 col-xs-12 mapblock">
<p>Hometown <br />
<span><?php if(!empty($loc)){echo $loc;}?></span></p>
</div>

<div class="col-md-4 col-sm-4 col-xs-12 mapblock">
<p>Countries visited <br />
<span><?php echo  sizeof($passeports);?></span></p>
</div>

<div class="col-md-4 col-sm-4 col-xs-12 mapblock">
<p>Reviews <br/>
<span><?php echo $reviewCount; ?></span></p>
</div>

<!-- <div id="map_canvas"> </div> -->
<div id="map_canvas"  class="map" style="width: 900px; height: 400px; "><iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d55373193.96960599!2d79.985516139203!3d32.104080806377034!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1434543140626" width="100%" height="300" frameborder="0" style="border:0"></iframe></div>

</div>
</div>
</div>

<div class="bg-back2">
<div class="dr-wrapper">
<div class="col-lg-12 nopadding">
<div class="list-stuf">
<h2>Listings</h2>
<?php 
$userListing = getuserlistdata($userId);
if(empty($userListing)){
echo "<div class='no-results'>";
echo "<p>No Listing Results</p>";
echo "</div>";
}

foreach($userListing as $userListin){
$photos = getPhotosData($userListin['eid']);
$file=unserialize($photos[0]['value1']);
$file=file_load($file['fid']);
$Imgpath_listing=($file->uri)?$file->uri:'';					
$style_imgPath_list='user_dashboard_listing';
?>

<div class="col-md-4 col-sm-6 col-xs-12 about-mattonlist marginb20">
<div class="sectionlist">
<div class="blocklist">
<?php if($Imgpath_listing !=''){  ?>
<a href="<?php echo $base_url; ?>/experience/<?php echo $userListin['eid']; ?>"><img src="<?php print image_style_url($style_imgPath_list,$Imgpath_listing); ?>" alt=" "></a>
<?php  }else{ ?>
<img height="240" src="<?php echo $base_url.'/'.drupal_get_path('theme',$GLOBALS['theme']);?>/images/dumy_list_image.jpg" alt="Dumy Experience image">
<?php } ?>

<div class="listpro"> 
<?php if($banner_path !=''){  ?>
<img src="<?php print image_style_url($banner_profile_Style,$banner_path); ?>" alt=" "> 
<?php  }else{ ?>
<img src="<?php echo $base_url.'/'.drupal_get_path('theme',$GLOBALS['theme']);?>/images/no-profile-male-img.jpg" alt="Dumy Experience image">
<?php } ?>
</div>
</div>

<div class="listname">
<h3><a href="<?php echo $base_url; ?>/experience/<?php echo $userListin['eid']; ?>"><?php echo (strlen($userListin['title'])<=30)?$userListin['title']: substr($userListin['title'], 0,30).'...'; ?></a></h3>
<p><?php if($userListin['address1'] && $userListin['country']){ echo $userListin['address1'].', '; ?><?php echo $userListin['country']; } ?> <span><?php echo $userListin['state']; ?></span> </p>
</div>
</div>
</div>
<?php } ?>
</div>
</div>
</div>
</div>

<!-- <div class="dr-wrapper">
<div class="col-md-12 col-sm-12 col-xs-12  nopadding">
<div class="guide-travel">
<h2>Travel guides</h2>
<?php ?>
<?php  
$travelguidedata=travel_guide($userId);
if(!empty($travelguidedata)) { 
$i=1;
?>
<?php foreach($travelguidedata as $data){ 
if($i<3){ 
?>

<div class="col-md-6 col-sm-6 col-xs-12 travelblock" style="margin-bottom:10px;"> 
<?php $file = file_load($data['fid']);
$imgurl = $file->uri; 
$style = "guide_image";
if(!empty($imgurl)){  
echo '<img alt=" " src="'.image_style_url($style, $imgurl).'"></a>';
}else{
echo '<img src="'.$base_url . '/' . drupal_get_path('theme', 'gloobers'). '/images/thumb1.jpg">';
}
?>                       
<?php }else{ ?>
<div class="col-md-6 col-sm-6 col-xs-12 travelblock" id="travelblock" style="margin-bottom:10px; display:none;"> 
<?php $file = file_load($data['fid']);
$imgurl = $file->uri; 
$style = "guide_image";
if(!empty($imgurl)){  
echo '<img alt=" " src="'.image_style_url($style, $imgurl).'"></a>';
}else{
echo '<img src="'.$base_url . '/' . drupal_get_path('theme', 'gloobers'). '/images/thumb1.jpg">';
}
?>                       
<?php   } ?>

<div class="listdetail">
<div class="click"><a class="listicon" href="#"><span></span><span></span><span></span></a></div>
<div class="listview" style="display:none;">
<ul>
<li><a href="#"><i class="fa fa-link"></i>Recommend to a friend</a></li>
<li><a href="#"><i class="fa fa-heart"></i>Add to wishlist</a></li>
<li><a href="#"><i class="fa fa-plus"></i>Add to guide</a></li>
<li><a href="#"><i class="fa fa-eye"></i>View details</a></li>
<li><a href="#"><i class="fa fa-flag-o"></i>Report this listing</a></li>
<li><a href="#"><i class="fa fa-arrows-h"></i>Embed on my website</a></li>
</ul>
</div>
</div>

<div class="guidesec">
<h3><?php echo $data['title']; ?></h3>
<p class="text"><?php echo $data['description']; ?></p>
<div class="topspace">
<p>Recommended for<br>
<span><?php echo triptype($data['recommended_for']); ?></span></p>
</div>
</div>

</div>
<?php  $i++; }  ?>

<?php }else { echo "<p><center>No Travel guides Created</center></p>";} ?>

<?php if(!empty($travelguidedata) && sizeof($travelguidedata)>2){  ?>
<div class="guidelink">
<p><a href="javascript:void(0)">And  more travel guides</a></p>
</div>
<?php } ?>
</div>
</div> -->

<div class="list-stuf review-outr">
<div class="dr-wrapper">
<div class="col-lg-12 nopadding">

<h2>Reviews <span>( <?php echo $reviewCount; ?> Reviews )</span></h2>

<?php 

//echo "<pre>";Print_r($allReviews);exit;

foreach($allReviews as $allReview){

$detail = getOverviewData($allReview['listing_id']);
if($detail){
//echo "<pre>";Print_r($detail);//exit;
//$photos = getPhotosData($allReview['eid']);
$photos = getPhotosData($allReview['listing_id']);

$file=unserialize($photos[0]['value1']);

$file=file_load($file['fid']);

$Imgpath_listing=($file->uri)?$file->uri:'';					

$style_imgPath_list='user_dashboard_listing';



?>

<div class="col-md-4 col-sm-6 col-xs-12 marginb20">

<div class="sectionlist review-design">

<div class="blocklist"> 
<?php if($Imgpath_listing !=''){  ?>
<img src="<?php print image_style_url($style_imgPath_list,$Imgpath_listing); ?>" alt=" ">
<?php  }else{ ?>
<img src="<?php echo $base_url.'/'.drupal_get_path('theme',$GLOBALS['theme']);?>/images/dumy_list_image.jpg" alt="Dumy Experience image">
<?php 	} ?>

<div class="listpro"> 
<?php if($allReview['uri'] !=''){  ?>
<img src="<?php print image_style_url($banner_profile_Style,$allReview['uri']); ?>" alt=" ">
<?php  }else{ ?>
<img src="<?php echo $base_url.'/'.drupal_get_path('theme',$GLOBALS['theme']);?>/images/no-profile-male-img.jpg" alt="Dumy Experience image">
<?php  } ?>
</div>

</div>

<div class="listname">
<div class="img-outr">
<div class="img-inner">
<?php if($banner_path){  ?>
<img src="<?php print image_style_url($banner_profile_Style,$banner_path); ?>" alt="" title="" />
<?php  }else{ ?>
<img src="<?php echo $base_url.'/sites/all/themes/gloobers_new/images/no-profile-male-img.jpg'; ?>" alt="" title="" />
<?php  } ?>

</div>
<div class="date-star">
<span><?php echo date('D d',strtotime($allReview['rcreated'])) ?> </span>
<?php
if($allReview['passion_categories']){
    $pason_cat=unserialize($allReview['passion_categories']);
        $pason_cat_data='';
        foreach($pason_cat as $pason_cat){
         $pason_cat_data+=$pason_cat;
        }
        $pason_cat_avg=ceil($pason_cat_data/4);
        for($a=$pason_cat_avg; $a>=1; $a--){
         echo '<i class="fa fa-star" aria-hidden="true"></i>';
        }
        for($a=5-$pason_cat_avg; $a>=1; $a--){
         echo '<i class="fa fa-star-o" aria-hidden="true"></i>';         
        }
}

?>
</div>

 <p><?php echo (strlen($allReview['comments'])<100)? $allReview['comments']: substr($allReview['comments'], 0,100).'...' ?></p>
 </div>

</div>
</div> 


<!--  <div class="sectionlist">

<div class="blocklist"> 
<?php if($Imgpath_listing !=''){  ?>
<img src="<?php print image_style_url($style_imgPath_list,$Imgpath_listing); ?>" alt=" ">
<?php  }else{ ?>
<img src="<?php echo $base_url.'/'.drupal_get_path('theme',$GLOBALS['theme']);?>/images/dumy_list_image.jpg" alt="Dumy Experience image">
<?php 	} ?>

<div class="listpro"> 
<?php if($allReview['uri'] !=''){  ?>
<img src="<?php print image_style_url($banner_profile_Style,$allReview['uri']); ?>" alt=" ">
<?php  }else{ ?>
<img src="<?php echo $base_url.'/'.drupal_get_path('theme',$GLOBALS['theme']);?>/images/no-profile-male-img.jpg" alt="Dumy Experience image">
<?php  } ?>
</div>

</div>

<div class="listname">
<h3><?php echo (strlen($detail['title'])<=30)?$detail['title']: substr($detail['title'], 0,30).'...'; ?></h3>
<p><?php echo $detail['city']; ?>, <?php echo $detail['country']; ?> <span><?php echo $detail['state']; ?></span> </p>
</div>
</div>  -->
</div>
<?php }} ?>

</div>
</div>
</div>
</div>
</div>
</section>
<!--MODAL FOR MESSAGE AND SEND REQUEST TO SELECTED ADVISOR-->

<div  class="modal fade" id="modal_advisor_request" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="advisor_request_form" name="advisor_request_form"   method="post">  
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Advisor Request</h4>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Recipient:</label>
                        <input type="text" class="form-control" id="recipient-name" readonly="readonly" name="recipient-name" value="<?php echo (trim($firstName, "%20"))?(trim($firstName, "%20")):$facebook_user_name_first; ?>" />
                    </div>

                    <div class="form-group">
                        <label for="message-text" class="control-label">Message:</label>
                        <textarea class="form-control" id="message-text" required="required" name="message"></textarea><div class="error">Please write message.</div>
                        <input type="hidden" value="<?php echo $filter_advisor_input; ?>" name="filter_advisor_input" id="filter_advisor_input" />
                        <input type="hidden" name="advisor_uid" id="advisor_uid">
                    </div>
                </div>

                <div class="modal-footer">
				<?php if(!empty($loc)){$loc;}?>
                   <!--  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                    <input type="button" onclick="Create_req('<?php echo $advisor_uid ?>','<?php echo ($dest)?$dest:$loc ?>')" class="btn btn-primary" value="Send message" data-loading-text="Sending..." />
                </div>
            </form>
        </div>
    </div>
</div> <!--END OF MODAL-->
<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/js/owl.carousel.js"></script>
<script>
var jq=jQuery.noConflict();
jq(document).ready(function(){
jq(".guidelink a").click(function(){
    jq(".travelblock").show();
    jq(".guidelink").hide();
  });
var locations=<?php echo json_encode($location); ?>;

	var loc_desc_all=<?php echo json_encode($description); ?>;

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
			case "I've been there in a family trip":

                var pinColor = "84a366";

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

	    var width = jQuery(window).width();
        var height = jQuery(window).height();      
         
        if(width>="1900"){          
           var maxZoomvar = 5;

        } else if(width>="1340") {           
           var maxZoomvar = 15;

        }else {           
           var maxZoomvar = 15;

        }

        if(height>="980"){         
           var maxZoomvar = 5;

        } else if(height>="630") {           
           var maxZoomvar = 15;

        } else {          
           var maxZoomvar = 15;

        }
        console.log("maxZoomvar:"+maxZoomvar);


	if(locations.length>0){

		var mapOptions = {
			minZoom: 3,
			maxZoom: maxZoomvar,
			center: new google.maps.LatLng(markers[0].lat, markers[0].lng),
			mapTypeId: 'terrain'

		};
	

	}else{

        var mapOptions = {
        zoom: 16,  
        center: new google.maps.LatLng(51.5, -0.2),
        minZoom: 3,
        maxZoom: maxZoomvar,
        mapTypeId: 'terrain'

        }

		map = new google.maps.Map(jq('#map_canvas')[0], mapOptions);

	}

	

    var infoWindow = new google.maps.InfoWindow();

    var latlngbounds = new google.maps.LatLngBounds();

	var map = new google.maps.Map(jq('#map_canvas')[0], mapOptions);

    var i = 0;

	if(locations.length>0){

    var interval = setInterval(function () {

		var data = markers[i];

		/* }else{

			markers[0] = {"lat":0,"lng":0,"color":'ffffff','description':'N/A'};

			var data = markers[0];

		}	 */	

				

        var myLatlng = new google.maps.LatLng(data.lat, data.lng);

		icon = "http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + data.color;

       

	   var marker = new google.maps.Marker({

            position: myLatlng,

            map: map,

            animation: google.maps.Animation.DROP,

            icon: new google.maps.MarkerImage(icon)

        });

        // (function (marker, data){

        //     google.maps.event.addListener(marker, "click", function (e) {

        //         infoWindow.setContent(data.description);

        //         infoWindow.open(map, marker);

        //     });

        // })(marker, data);

        latlngbounds.extend(marker.position);

        i++;

        if (i == markers.length) {

            clearInterval(interval);

            var bounds = new google.maps.LatLngBounds();

            map.setCenter(latlngbounds.getCenter());

            map.fitBounds(latlngbounds);

        }

    }, 80);

	}
});

jQuery(document).ready(function(event) {
	var owl = jQuery("#owl-demo");
	jQuery('.error').hide();
	owl.owlCarousel({
		items : 4, //10 items above 1000px browser width
		itemsDesktop : [1000,3], //5 items between 1000px and 901px
		itemsDesktopSmall : [900,2], // betweem 900px and 601px
		itemsTablet: [600,1], //2 items between 600 and 0
		itemsMobile : false // itemsMobile disabled - inherit from itemsTablet option
	});
 
	//Travel-Guide Listing()
	jQuery(".listicon").click(function (event) {
		event.preventDefault();
		jQuery(this).parent().next(".listview").slideToggle(400);
	}); // End
});

function sendrequest_user() {
   //jQuery('#modal_advisor_request').addClass('in');
    jQuery('#modal_advisor_request').modal(); 
}
function Create_req(advisor,destination){
	var message=jQuery('#message-text').val();
	var advisor=advisor;
	var destination=destination;
	destination = destination || "";
	if(message==''){
	jQuery('.error').show();
		return false;
	}else{
		jQuery('.error').hide();
		jQuery.ajax({
                type: 'POST',
                url: $baseUrl + '/advice/ajax/post_request',
                data: {'advisor_uid':advisor,'destination':destination,'message':message},
                beforeSend: function () {
                    preLoading('show', 'load-screen');
                },
                    success: function (result) {
                    var res = jQuery.parseJSON(result);
					//alert(res.status);
                	if (res.status == 'success') {
                    	preLoading('hide', 'load-screen');
                    	jQuery.notify(res.message, {globalPosition: 'top center', className: 'success'});
						jQuery('#modal_advisor_request').removeClass('in');
						
                    	
                	} else {
                    	preLoading('hide', 'load-screen');
                    	jQuery.notify(res.message, {globalPosition: 'top center', className: 'error'});
						jQuery('#modal_advisor_request').removeClass('in');
						
                	}
                    },
                });  
	}
} 
</script>