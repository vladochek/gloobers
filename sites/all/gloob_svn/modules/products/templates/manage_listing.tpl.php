<div class="manage-listing">
<h2>My Listings</h2>
<?php

global $base_url;
print'<div class="search-list">';
$searchForm=drupal_get_form('search_listing_form');
echo drupal_render($searchForm);
print '</div>';
?>
<div class="add-listing">
<a href="<?php echo url('product/add/overview');?>" class="btn btn-blue2 btn-gradient form-submit"><i class="fa fa-plus"></i>Add new Listing</a>
</div>
<?php
if($listings)
{

foreach ($listings as $list)
{
$unserializedata="";
$stepsCompleted=$photodata=$subscriptionData=$policyData=$amenitiesData=$schedulingData=$productExtraData=$pricingData=$locationData=0;
$listingMeta=getListingMetaData($list['eid']);
/**********************************************/
$amenties=getAmentiesByproduct($list['eid']);
$amenties = unserialize($amenties["value1"]);
if($amenties)
{
$amenitiesData=1;
}
/***********************/
$price=getPricingData($list['eid']);
if($price)
{
$pricingData=1;
}
/***********************/
$scheduling=getSchedulingData($list['eid']);
if($scheduling)
{
$schedulingData=1;
}
/********************************************/
$extras = getProductExtraData($list['eid']);
if($extras)
{
$productExtraData=1;
}
/********************************************/
$rulesDetail=getRulesDetails($list['eid']);
$rulesDetail=unserialize($rulesDetail["value1"]);
if($rulesDetail)
{
$policyData=1;
}
/********************************************/

if($listingMeta)
{

	foreach($listingMeta as $metadata)
	{
		if($metadata['key1']=='photo_data')
		{
		$photodata=1;
		$unserializedata=unserialize($metadata['value1']);
		}
		/* elseif($metadata['key1']=='product_subscription_data')
		{
		$subscriptionData=1;
		} */
		/* elseif($metadata['key1']=='product_cancellation_data')
		{
		$policyData=1;
		} */
		/* elseif($metadata['key1']=='amenities')
		{
		$amenitiesData=1;
		} */
		/* elseif($metadata['key1']=='product_pricing_data')
		{
		$pricingData=1;
		} */
		/* elseif($metadata['key1']=='product_scheduling_data')
		{
		$schedulingData=1;
		} */
		/* elseif($metadata['key1'] ==	'product_extra')
		{
		$productExtraData=1;
		} */
	}
}
if(!empty($list['longitude']) && !empty($list['latitude']) )
{
$locationData=1;
}
$stepsCompleted=7-($photodata+$subscriptionData+$policyData+$amenitiesData+$schedulingData+$productExtraData+$pricingData+$locationData);
$bookingCount=getBookingCustomersCount($list['eid']);
print '<div class="listing-info">';
	print '<div class="listing-left-sec">';
	if($unserializedata)
	{
    $file = file_load($unserializedata['fid']);
	$style 	= "thumbnail";
    $imgpath = $file->uri;
	print '<img src="'.image_style_url($style,$imgpath).'" alt="listing-image">';
   
	}
	else
	{
	
	print '<img src="'.$base_url.'/'.variable_get('file_public_path', conf_path() . '/files/pictures/no_image.png').'" alt="listing-image" width="100px" height="100px">';
	}
	print '</div>';
	print '<div class="listing-edit-info">';
	print  '<div class="listing-data">';
	print  '<h2><a href="'.url('experience/view/'.$list['eid']).'" class="">'.ucfirst($list['title']).'</a></h2>';
	print  '<span>'.substr($list['short_description'],0,150)."....".'</span>';
	print '</div>';
			
			
			
			
			print '<div class="listing-visibility">';
				if($list['visibility_status'])
				{
				print '<select name="type" id="listing-visible'.$list['eid'].'" class="form-control form-select listing-visible">
				<option selected="selected" value="1">Listed</option>
				<option value="0">Unlisted</option></select>';
				}
				else
				{
				print '<select name="type" id="listing-visible'.$list['eid'].'" class="form-control form-select listing-visible">
				<option value="1">Listed</option>
				<option selected="selected" value="0">Unlisted</option></select>';
				}
			?>
			<script>
				jQuery.noConflict();
				jQuery(document).ready(function() {
				jQuery("#listing-visible<?php echo $list['eid'];?>").on('change',function(){
				jQuery.ajax({
				type: "POST",
				url: "<?php echo $base_url; ?>/product/manage/",
				data: "typeId=" + encodeURI(<?php echo $list['eid'];?>)+"&status="+jQuery(this).val(),
				success: function(msg){
					if(msg==1)
					{
					jQuery("#listing-visible<?php echo $list['eid'];?>").parent().next().next().next(".list-message").find(".list-span").remove();
					jQuery("#listing-visible<?php echo $list['eid'];?>").parent().next().next().next(".list-message").append("<span class='list-span'>Product has been Listed Successfully</span>");
					}
					else if(msg==0)
					{
					jQuery("#listing-visible<?php echo $list['eid'];?>").parent().next().next().next(".list-message").find(".list-span").remove();
					jQuery("#listing-visible<?php echo $list['eid'];?>").parent().next().next().next(".list-message").append("<span class='list-span'>Product has been UnListed Successfully</span>");
					}
				}
				});
				});
				});
				</script>
			<?php
		print '</div>';
			print '<div class="view-customer">';		
			print '<a href="'.$base_url.'/bookings?search_filter='.$list['eid'].'" class="btn btn-blue4 btn-gradient form-submit">View Reservatons ('.$bookingCount.')</a>';
			print '</div>';
			print '<div class="listing-header-message">';
			//print '<a href="'.url('product/add/overview/'.$list['eid']).'" class="btn btn-host">'.($stepsCompleted)? $stepsCompleted ." "'steps to list':'List is Complete</a>';
			//if($stepsCompleted)
			//{
			 print '<a href="'.url('product/add/overview/'.$list['eid']).'" class="btn btn-blue4 btn-gradient form-submit">Edit Listing</a>';
			//}
			
			print '</div>';
		print '<div class="list-message"></div>';
	print '</div>';
print '</div>';

}
print'<div class="pagination">';
echo $pagination;
print '</div>';
}
else
{
print '<div class="listing-info">';
print '<div class="no-listing">';
print '<h4>No Result found</h4>';
print '</div></div>';
}
?>
</div>