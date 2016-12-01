<?php global $base_url;
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/stylesheet/for-head-foot.css','file');
?>

<div class="manage-listing">

<h2 class="pagehead">My listings</h2>

<p class="subtitle">Manage your listings</p>

<div class="manage_listing_class">

<?php

$front_end_theme_Common_data='gloobers_new';

print'<div class="search-list">';

$searchForm=drupal_get_form('search_listing_form');

echo drupal_render($searchForm);

print '</div>';

if($listings)

{

foreach($listings as $list)

{

$unserializedata="";

$stepsCompleted=$photodata=$subscriptionData=$policyData=$amenitiesData=$schedulingData=$productExtraData=$pricingData=$locationData=0;

$listingMeta=getListingMetaData($list['eid']);

$amenties=getAmentiesByproduct($list['eid']);

$amenties = unserialize($amenties["value1"]);

if($amenties)

{

	$amenitiesData=1;

}

$price=getPricingData($list['eid']);

if($price)

{

	$pricingData=1;

}

$scheduling=getSchedulingData($list['eid']);

if($scheduling)

{

	$schedulingData=1;

}

$extras = getProductExtraData($list['eid']);

if($extras)

{

	$productExtraData=1;



}

$rulesDetail=getRulesDetails($list['eid']);

$rulesDetail=unserialize($rulesDetail["value1"]);

if($rulesDetail)

{

	$policyData=1;

}

if($listingMeta)

{

	foreach($listingMeta as $metadata)

	{

		if($metadata['key1']=='photo_data')

		{

		$photodata=1;

		$unserializedata=unserialize($metadata['value1']);

		}

	}

}

if(!empty($list['longitude']) && !empty($list['latitude']))

{

	$locationData=1;

}

$stepsCompleted=7-($photodata+$subscriptionData+$policyData+$amenitiesData+$schedulingData+$productExtraData+$pricingData+$locationData);

$bookingCount=getBookingCustomersCount($list['eid']);

	print '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">';

	 print '<div class="new_listing">';

	if($unserializedata)

	{

		$file = file_load($unserializedata['fid']);

		$style 	= "manage_listing_image";

		$imgpath = $file->uri;

		print '<img src="'.image_style_url($style,$imgpath).'" alt="listing-image">';

	}

	else

	{

		print '<img src="'.$base_url.'/'.drupal_get_path('theme',$front_end_theme_Common_data).'/images/listing_img.jpg" alt="listing-image" >';

	}

	print '<div class="listinfo">';

	print  '<h2><a href="'.url('experience/'.$list['eid']).'" class="">'.ucfirst($list['title']).'</a></h2>';

	

	// if(!empty($list['brief_description'])){

	// 	if(strlen($list['brief_description'])>=150){ $dots='....';}else{$dots='';}

	// 	print  '<p>'.substr($list['brief_description'],0,150).$dots.'</p>';

	// }

	$listing_location='';	
	if($list['city']){$listing_location .= ucfirst($list['city']). ', ';}
	if($list['state']){$listing_location.=ucfirst($list['state']). ', ';}
	if($list['country']){$listing_location.=ucfirst($list['country']);}
	print '<p> '.(strlen($listing_location) <= 30 ? $listing_location : substr($listing_location, 0,30).'...').'</p>';	

?>            

            

<script>

jQuery.noConflict();

function visbily_linkfn(id,status){

		jQuery.ajax({

		type: "POST",

		url: "<?php echo $base_url; ?>/product/manage/",

		data: "typeId=" +id+"&status="+status,

		success: function(msg){
			
			if(msg==1)	{		
			alert('Listing published successfully')	
				jQuery('#Listing_'+id).text('Unpublish Listing');

			} 

			else if(msg==0)	{		
				alert('Listing unpublished successfully')
				jQuery('#Listing_'+id).text('Publish Listing');
			}

			jQuery('#Listing_'+id).attr('onclick','visbily_linkfn('+id+','+msg+')');

		}

		});

}
</script>



<?php



print '<div class="editfield">';

print '<a href="javascript:void(0);" id="Listing_'.$list['eid'].'" onClick="visbily_linkfn('.$list['eid'].','.$list['visibility_status'].');">';
print ($list['visibility_status'])? 'Unpublish Listing':'Publish Listing';
print'</a>';

print '<a href="'.$base_url.'/bookings?search_filter='.$list['eid'].'">View Reservations ('.$bookingCount.')</a>';

print '<a href="'.url('product/add/overview/'.$list['eid']).'" >Edit Listing</a>';

print '</div>';

print '</div>';

print '</div>';

print '<div class="list-message"></div>';

print '</div>';

}

?>

</div>

<div class="clearfix"></div>





<div class="add-listing">

<a href="<?php echo url('product/add/overview');?>" class="btn btn-blue2 btn-gradient form-submit">Create Listing</a>

</div>



<?php

print'<div class="col-md-12 col-sm-12 col-xs-12 text-center"><div class="pagination">';

echo $pagination;

print '</div></div>';

}

else

{ ?>

	<div class="add-listing">

<a href="<?php echo url('product/add/overview');?>" class="btn btn-blue2 btn-gradient form-submit">Create Listing</a>

</div>

<?php //print '<div class="listing-info"><div class="no-listing blankrow"><h4>No Result found</h4></div></div>';

}

?>

</div>