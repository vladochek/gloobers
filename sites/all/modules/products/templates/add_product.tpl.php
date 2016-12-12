<?php
global $user,$base_url;
$current_path=current_path();
drupal_add_js(drupal_get_path('theme', $GLOBALS['theme']) .'/js/jquery.sticky.js',array('scope' => 'footer'));
drupal_add_js(drupal_get_path('theme', $GLOBALS['theme']) .'/js/help-text.js', 'file');
drupal_add_js(drupal_get_path('theme', $GLOBALS['theme']) .'/js/jquery.validate.min.js',array('scope' => 'footer'));
drupal_add_js(drupal_get_path('theme', $GLOBALS['theme']) .'/js/additional-methods.js', array('scope' => 'footer'));
drupal_add_js(drupal_get_path('theme', $GLOBALS['theme']) .'/js/experience-list-validate.js',array('scope' => 'footer'));
drupal_add_js(drupal_get_path('theme', $GLOBALS['theme']) .'/js/jquery.jqEasyCharCounter.min.js',array('scope' => 'footer'));
drupal_add_css(drupal_get_path('theme', $GLOBALS['theme']) .'/css/easy-responsive-tabs.css');
$productId=arg(3);


//if(!empty($photos)){
if (strpos($_SERVER['REQUEST_URI'], '/product/add/photos') !== false){
?>
<script type="text/javascript">
jQuery( document ).ready(function(){
jQuery('#product-details-form').addClass('Calenderform');
//var photos_size=jQuery('.photo-content').size();

});
</script>
<div class="col-md-12 col-sm-12 col-xs-12"><h2 class="pagehead">Photos</h2>
						</div>
<div class="photos-wrapper">
<?php

	$i = 1;
	$overviewData = getOverviewData($productId);
		foreach($photos as $photo){
			$imgpath="";
			$photo 	= unserialize($photo["value1"]);
			$style 	= "medium";
			$file 	= file_load(trim($photo["fid"]));
			$imgpath = $file->uri;
			if($overviewData['main_img_fid']==$photo["fid"]){$class='checkedMain';}else{$class='';}

?>
	<div id="photo-content<?php echo $i++; ?>" class="photo-content">
		<div class="plupload_star_action1">
			<div class="plupload_star_icon  phpuplC_<?php echo $photo["fid"]; ?>" onclick="setmainimg('<?php echo $photo["fid"]; ?>');"><i class="fa fa-star <?php echo $class; ?>"></i><p>Set as main </p></div>
		</div>
		<div class="plupload_file_action1">
			<input type="hidden" class="fileID" value="<?php echo $photo["fid"]; ?>">
			<div class="plupload_action_icon ui-icon ui-icon-circle-minus"> </div>
			<p>Delete</p>
		</div>
		<div class="image"><img src="<?php print image_style_url($style, $imgpath) ?>"></div>
		<div class="text">
			<input type="hidden" class="fileID" value="<?php echo $photo["fid"]; ?>">
			<textarea class="highlights" placeholder="What are the highlights of this photo?"><?php echo $photo["text"]; ?></textarea>
		</div>
	</div>
<?php
		}
?>
</div>
<?php
	}
if(!$addressListing && !$subscriptionListing && !$calendar && !$success){
?>
<?php

	print drupal_render($productForm);
?>

<?php
}
/* Add google map in location */
if($addressListing){  $addrs='';$addrs='';
		if((($productDetail['address1'] != "") || ($productDetail['state']!= "") || ($productDetail['country']!= "") || ($productDetail['latitude'] != "") && ($productDetail['longitude'] != "")))
			{	print '<div class="bs_location_saf" data-sticky_parent="">
					<div class="bs_top_location">
					<div class="col-md-12 col-sm-12 col-xs-12">
					<h2 class="pagehead">Location</h2>						
					</div></div> </div>';
			}
			else
			{
			print '<div class="col-md-12 col-sm-12 col-xs-12"><h2 class="pagehead">Location</h2>
						</div>';
			}

			print '<div class="add-address">';
			print '<div id="dm-map-div">';

			print '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12"><div id="address-form">';
			echo  drupal_render($addressform);
			print '</div></div>
				
			</div>';
			/**********************************************************************/

}
//Session Edit Code
if(strpos($_SERVER['REQUEST_URI'],'product/session/edit') !== false){
	print drupal_render($SessionForm);
}
if(!$subscriptionListing && !$success && !$payment){
if(!$addressListing){
?>

<div class="col-xs-12 col-sm-12 col-md-3 help_right" id="helpBar" data-sticky_column="">
	<div class="help_block">
	<div class="heading_help">HELP</div>

    <?php
	if($overViewListing)
	{
	?>
		<div class="edit-product-type-help" style="display:none;">
		<p><b><?php print t('Experience Type');?></b></p>
		<p><?php print t('Select Experience Type');?></p>
		</div>
		<!--<div class="product_category-help" style="display:none;">
		<p><?php //print t('Experience category');?></p>
		<p><?php//print t('Select Experience category corresponding to Experience Type');?></p>
		</div>-->
		<div class="product_name-help" style="display:none;">
		<p><b><?php print t('Experience title');?></b></p>
		<p><?php print t('Experience title is Required');?></p>
		<p><?php print t('Maximum 35 characters are allowed');?></p>
		</div>
		<div class="short_description-help" style="display:none;">
		<p><b><?php print t('Highlight');?></b></p>
		<p><?php print t('Give Highlights of Trip');?></p>
		<p><?php print t('Maximum 500 characters are allowed');?></p>
		</div>
		<div class="expect-help long_description-help" style="display:none;">
		<p><b><?php print t('Long Description');?></b></p>
		<p><?php print t('Add a longer description of your experience.');?></p>
		<p><?php print t('This is the long description of your event and all related things of event.');?></p>
		<p><?php print t('Formatting is not allowed so please use plain text.');?></p>
		</div>
		<div class="itinerary-help" style="display:none;">
		<p><b><?php print t('Itinerary ');?></b></p>
		<p><?php print t('Add planned route for journey.');?></p>
		</div>
		<div class="communication-help" style="display:none;">
		<p><b><?php print t('Communication with travelers');?></b></p>
		<p><?php print t('Communication channels available for travelers');?></p>
		</div>

  <?php
  }
  elseif($photosListing)
  {
  ?>
  <style>
  #topbar {margin-top:60px;}
  </style>
 <p><b><?php print t('Images'); ?></b></p>
 <p><?php print t('You can add several images that will appear as a gallery to your customers.');?></p>
 <p><?php print t('The first image you add will become your cover image.');?></p>
 <p><?php print t('High resolution photos taken with cameras are generally too big must be resized before you upload.');?></p>
 <p><strong><?php print t('Max file size is 5Mb.');?></strong><br/><strong><?php print t('Minimum recommended image size is 1920 x 602 px.');?></strong></p>
  <?php
  }
  elseif($amenitiesList)
  {
  ?>

  <!--<h4><?php print t('Amenities');?></h4>
  <p><?php print t('Amenities at Experience listings.');?></p>-->
  <div class="safety_precautions-help" style="display:none">
  <p><b><?php print t('Safety Precautions');?></b></p>
  <p><?php print t('Safety precautions provided to Travellers');?></p>
  </div>
  <div class="whats_included-help amenities-extra-included-help whats_included" style="display:none">
  <p><b><?php print t('Amenities Included');?></b></p>
  <!--<p>Amenities Included</p>-->
  </div>
  <div class="amenities-excluded-help amenities-extra-excluded-help" style="display:none">
  <p><b><?php print t('Amenities Excluded');?></b></p>
  <p>Amenities Excluded</p>
  </div>

  <?php
  }
  elseif($Calendernew)
  {

  ?>
	<div class="SESSION_SEATS-help" style="display:none;">
		<p><b>Limited</b> </p>
		<p>
		Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>

	</div>
	<div class="FREE_SALE-help" style="display:none;">
		<p><b>Unlimited</b>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>

	</div>
	<div class="YEARLY-help" style="display:none;">
		<p><b>Yearly</b> </p>
		<p>
		Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>

	</div>
	<div class="MONTHLY-help" style="display:none;">
		<p><b>Monthly</b> </p>
		<p>
		Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>

	</div>
	<div class="Daily-help" style="display:none;">
		<p><b>Daily</b> </p>
		<p>
		Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>

	</div>
	<div class="Hourly-help" style="display:none;">
		<p><b>Hourly</b></p>
		<p>
		Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>

	</div>
	<div class="Minute-help" style="display:none;">
		<p><b>Minute</b></p>
		<p>
		Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>

	</div>
	<div class="Weekly-help" style="display:none;">
		<p><b>Weekly</b> </p>
		<p>
		Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>

	</div>
	<div class="edit-session-endrepeatdate-help" style="display:none;">
		<p><b>Untill Repeate period</b> </p>
		<p>
		Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>

	</div>

	<div class="INVENTORY-help" style="display:none;">
		<p><b>Fixed dates &amp; times</b></p>
		<p>
		Allows you to select dates and times when this product is available.</p>
		<p>Gives you the flexibility to change the price and availability for each date/time, and to blackout dates.</p>
	</div>
	<div class="DATE_ENQUIRY-help" style="display:none;">
		<p><b>Any date</b></p>
		<p>
		This means that a date is required, but the customer can choose any they wish.</p>
		<p>You cannot limit availability, blackout dates or vary your prices per period if you select this option.</p>
	</div>

	<div class="NO_DATE-help" style="display:none;">
		<p><b>Date not required</b></p>
		<p>
		For example if you sell open tickets that do not require a specific date.</p>

	</div>
	<div class="AUTOCONFIRM-help" style="display:none;">
		<p><b><?php print t('Automatically');?></b></p>
		<p>
			<?php print t('Your customer\'s orders will be automatically confirmed. This is the recommended option if you use gloobers to manage availability for this product, because your products can never be overbooked.');?>
		</p>
	</div>
	<div class="MANUAL-help" style="display:none;">
		<p><b><?php print t('Manually');?></b></p>
		<p><?php print t('Orders placed by your customers will have a "Pending supplier" status. You must manually review and confirm each order.');?>
		</p>
	</div>
	<div class="schedule_type-help edit-product-duration-help" style="display:none;">
		<p><b><?php print t('Estimated duration');?></b></p>
		<p>This is the estimated duration of this event.</p>
			<p>Please note that this is for informational purposes only and is an approximate figure. Customers will see this as a guide only.</p>
	</div>
	<div class="edit-session-startdate-help" style="display:none;">
		<p><b><?php print t('Start Date');?></b></p>
		<p>This is starting date of event.</p>
	</div>
	<div class="edit-session-starttime-help" style="display:none;">
		<p><b><?php print t('Start Time');?></b></p>
		<p>This is starting time of event.</p>
	</div>
	<div class="edit-session-enddate-help" style="display:none;">
		<p><b><?php print t('End Date');?></b></p>
		<p>This is end date of event.</p>
	</div>
	<div class="edit-session-endtime-help" style="display:none;">
		<p><b><?php print t('End Time');?></b></p>
		<p>This is end time of event.</p>
	</div>
	<div class="offer_24_hour_offer_Data_date-help" style="display:none;">
		<p><b><?php print t('24 hour date');?></b></p>
		<p>This is 24 hour offer date.</p>
	</div>
	<div class="offer_24_hour_offer_Data_price-help" style="display:none;">
		<p><b><?php print t('24 hour price');?></b></p>
		<p>This is 24 hour offer price value that apply on booking.</p>
	</div>
	<!---------------Last Minute----------------->
  <div class="edit-last-minutes-time-value-help" style="display:none;">
		<p><b><?php print t('Last minute offer');?></b></p>
		<p><?php print t('This offer can be applied when number of days less than 7 days or 144 hours.');?></p>
  </div>
  <div class="edit-last-minutes-price-value-help" style="display:none;">
	<p><b><?php print t('Price');?></b></p>
		<p><?php print t('price will be implemented according to % or amount.');?></p>
  </div>

	<!--------Early Birds------------>
   <div class="edit-early-birds-time-value-help" style="display:none;">
		<p><b><?php print t('Early birds time');?></b></p>
		<p><?php print t('Here you can select offer time in days,week or month.But for early days you need to set atleast 7 days.');?></p>
   </div>
   <div class="edit-early-birds-price-value-help" style="display:none;">
		<p><b><?php print t('Price');?></b></p>
		<p><?php print t('You can set the price of early bird offer here.');?></p>
   </div>
  <div class="early_birds_price_type-help" style="display:none;">
		<p><b><?php print t('Price');?></b></p>
		<p><?php print t('888');?></p>
  </div>
  <div class="schedule_type_early_bids-help" style="display:none;">
		<p><b><?php print t('Apply to schedule');?></b></p>
		<p><?php print t('Lorem Ipsum is simply dummy text of the printing and typesetting industry.');?></p>
  </div>
	<?php
  }
  elseif($pricingList)
  {
  ?>
  <div class="PER_PERSON-help" style="display:none;">
		<p><b><?php print t('Price Type');?></b></p>
		<p><?php print t('Per Person');?></p>
  </div>
  <div class="PER_ITEM-help" style="display:none;">
		<p><b><?php print t('Price Type');?></b></p>
		<p><?php print t('Per Item');?></p>
  </div>
  <div class="season_rate_label-help" style="display:none;">
		<p><b><?php print t('Rate Label');?></b></p>
		<p><?php print t('Rate Label');?></p>
  </div>
   <div class="season_rate_amount-help" style="display:none;">
		<p><b><?php print t('Price');?></b></p>
		<p><?php print t('Enter the amount that will be charged.');?></p>
		<p>For example: <strong>25.00</strong></p>
  </div>
  <div class="high_season_rate_dates-help" style="display:none;">
		<p><b><?php print t('From - To');?></b></p>
		<p><?php print t('price available period');?></p>
  </div>
  <div class="product_pricing_quantity-help" style="display:none;">
		<p><b><?php print t('Quantity Required');?></b></p>
		<p><?php print t('Quantity allowed for deal');?></p>
  </div>
  <div class="product_pricing_type-help" style="display:none;">
		<p><b><?php print t('Product pricing');?></b></p>
		<p><?php print t('industry.');?></p>
  </div>
  <div class="product_pricing_key-help" style="display:none;">
		<p><b><?php print t('Product pricing for');?></b></p>
		<p><?php print t('industry2.');?></p>
  </div>
  <div class="product_pricing_value-help" style="display:none;">
		<p><b><?php print t('Price');?></b></p>
		<p><?php print t('Enter the amount that will be charged.');?></p>
  </div>
  <div class="schedule_type-help" style="display:none;">
		<p><b><?php print t('Apply to schedule');?></b></p>
		<p><?php print t('Availability is determined by the sessions you create in your calendar. If you don\'t create sessions this product will not be available.');?></p>
  </div>
  <div class="product_pricing_quantity_type-help" style="display:none;">
		<p><b><?php print t('Apply to schedule');?></b></p>
		<p><?php print t('industry33.');?></p>
  </div>
  <div class="quantity_min-help" style="display:none;">
		<p><b><?php print t('Minimum Quantity');?></b></p>
		<p><?php print t('Enter the minimum number of persons can arrive.');?></p>
  </div>
  <div class="quantity_max-help" style="display:none;">
		<p><b><?php print t('Maximum Quantity');?></b></p>
		<p><?php print t('Enter the maximum number of persons can arrive');?></p>
  </div>
 <!-- Early Birds -->
   <div class="early_birds_time_value-help" style="display:none;">
		<p><b><?php print t('Early birds time');?></b></p>
		<p><?php print t('Here you can select offer time in days,week or month.But for early days you need to set atleast 7 days.');?></p>
  </div>
  <div class="early_birds_time_type-help" style="display:none;">
		<p><b><?php print t('Maximum Quantity');?></b></p>
		<p><?php print t('Lorem Ipsum is simply dummy text of the printing and typesetting industry.');?></p>
  </div>
  <div class="early_birds_price_value-help" style="display:none;">
		<p><b><?php print t('Price');?></b></p>
		<p><?php print t('You can set the price of early bird offer here.');?></p>
  </div>
  <div class="early_birds_price_type-help" style="display:none;">
		<p><b><?php print t('Price');?></b></p>
		<p><?php print t('888');?></p>
  </div>
  <div class="schedule_type_early_bids-help" style="display:none;">
		<p><b><?php print t('Apply to schedule');?></b></p>
		<p><?php print t('Lorem Ipsum is simply dummy text of the printing and typesetting industry.');?></p>
  </div>
 <!-- Last Minute -->
  <div class="last_minutes_time_value-help" style="display:none;">
		<p><b><?php print t('Apply to schedule');?></b></p>
		<p><?php print t('Lorem Ipsum is simply dummy text of the printing and typesetting industry.');?></p>
  </div>
  <div class="schedule_type_last_minutes-help" style="display:none;">
		<p><b><?php print t('Apply to schedule');?></b></p>
		<p><?php print t('Lorem Ipsum is simply dummy text of the printing and typesetting industry.');?></p>
  </div>
  <div class="last_minutes_time_type-help" style="display:none;">
	<p><b><?php print t('Price');?></b></p>
		<p><?php print t('Lorem Ipsum is simply dummy text of the printing and typesetting industry.');?></p>
  </div>
  <div class="last_minutes_price_type-help" style="display:none;">
	<p><b><?php print t('Price');?></b></p>
	<p><?php print t('Lorem Ipsum is simply dummy text of the printing and typesetting industry.');?></p>
  </div>
	<!-- 24 Hour Offer -->
	  <div class="edit-offer-24-hour-offer-date-help" style="display:none;">
		<p><b><?php print t('Price');?></b><p>
		<p><?php print t('Lorem Ipsum is simply dummy text of the printing and typesetting industry.');?></p>
	  </div>
	  <div class="24_hour_offer_price_value-help" style="display:none;">
		<p><b><?php print t('Price');?></b></p>
		<p><?php print t('Lorem Ipsum is simply dummy text of the printing and typesetting industry.');?></p>
	  </div>
	  <div class="24_hour_offer_price_type-help" style="display:none;">
		<p><b><?php print t('Price');?></b></p>
		<p><?php print t('Lorem Ipsum is simply dummy text of the printing and typesetting industry.');?></p>
	  </div>
	  <div class="schedule_type_24_hours-help" style="display:none;">
		<p><b><?php print t('Apply to schedule');?></b></p>
		<p><?php print t('Lorem Ipsum is simply dummy text of the printing and typesetting industry.');?></p>
	  </div>
  <?php
  }elseif($extrasListing)
  {
  ?>
  <div class="extra_service-help" style="display:none;">
	<p><b><?php print t('Optional Service');?></b></p>
	<p><?php print t('This will be the additional services provided in the experience event.');?></p>
  </div>
   <div class="extra_price_type-help" style="display:none;">
	<p><b><?php print t('Price');?></b></p>
	<p><?php print t('Lorem Ipsum is simply dummy text of the printing and typesetting industry.');?></p>
  </div>
  <div class="extra_price_value-help" style="display:none;">
	<p><b><?php print t('Price');?></b></p>
	<p><?php print t('This will be price according to each service.');?></p>
  </div>
  <div class="extra_price_key-help" style="display:none;">
	<p><b><?php print t('Price');?></b></p>
	<p><?php print t('Lorem Ipsum is simply dummy text of the printing and typesetting industry.');?></p>
  </div>
  <div class="product_extra_description-help" style="display:none;">
	<p><b><?php print t('Description');?></b></p>
	<p><?php print t('Please add some description of additional service.');?></p>
  </div>
  <?php
  }elseif($rulesList)
  {
  ?>
  <div class="edit-security-deposit-help" style="display:none;">
	<p><b><?php print t('Security Deposit');?></b></p>
	<p><?php print t('Lorem Ipsum is simply dummy text of the printing and typesetting industry.');?></p>
  </div>
  <div class="edit-experience-rules--help" style="display:none;">
	<p><b><?php print t('Experience Rules');?></b></p>
	<p><?php print t('This is set some rules to experience listings of canceling policy.');?></p>
  </div>
	<div class="policies-Relaxed-help" style="display:none;">
		 <p><b><?php print t('Relaxed');?></b></p>
		 <p><?php print t('Guests will receive a full refund if they cancel at least two weeks before the start of their reservation.');?></p>
	 </div>
	 <div class="policies-Flexible-help" style="display:none;">
		 <p><b><?php print t('Flexible');?></b></p>
		 <p><?php print t('Guests will receive their full refundable deposit:');?></p>
		 <ul>
		 <li><?php print t('A 50% refund of their paid rental costs if they cancel at least four weeks before the start of their reservation; OR');?></li>
		 <li><?php print t('A 25% refund of their paid rental costs if they cancel up to two weeks before the start of their reservation.');?></li>
		 </ul>
	 </div>
	 <div class="policies-Moderate-help" style="display:none;">
		<p><b><?php print t('Moderate');?></b></p>
		<p><?php print t('Guests will receive their full refundable deposit:- <br>A 50% refund of their paid rental costs, if they cancel at least four weeks before the start of their reservation.');?></p>
	 </div>
	 <div class="policies-Strict-help" style="display:none;">
		<p><b><?php print t('Strict');?></b></p>
		<p><?php print t('Guests will receive their full refundable deposit:');?></p>
		 <ul>
		 <li><?php print t('A 50% refund of their paid rental costs if they cancel at least eight weeks before the start of their reservation; OR');?></li>
		 <li><?php print t('A 25% refund of their paid rental costs if they cancel up to four weeks before the start of their reservation.');?></li>
		</ul>
	 </div>
	  <div class="policies-Super-Strict-help" style="display:none;">
	  <p><b><?php print t('Super-Strict');?></b></p>
	  <p><?php print t('If the guest cancels, any money they have paid cannot be refunded.');?></p>
	  </div>
	  <div class="agreement-help" style="display:none;">
		<p><b><?php print t('Agreement');?></b></p>
		<p><?php print t('Lorem Ipsum is simply dummy text of the printing and typesetting industry.');?></p>
	  </div>
	  <div class="other_information-help" style="display:none;">
		<p><b><?php print t('Other Information');?></b></p>
		<p><?php print t('This is the other information of the listing.');?></p>
	  </div>
   <?php
  }
  ?>
</div></div>
<div class="clearfix"></div>

<?php
}
}

if($Calendernew){
	$scheduleSessionData='';
if(!empty($scheduleSessionData)){
?>
<div class="marg_bottom_80 col_wrap border_btm">
            <div class="col-xs-12 col-sm-12 col-md-12">
		 <div class="help-block boader_class">
            <div class="heading_help">My Schedules</div>

            <table class="table2">
			<thead>
			  <tr>
				<th>Start/End date</th>
				<th>Price type</th>
				<th>Person type/Item name</th>
				<th>Price($)</th>
				<th colspan="5">Actions</th>
			  </tr>
			</thead>
    <tbody>
			<?php  //Updated 17-02-2016
			//echo "<pre>";Print_r($scheduleSessionData);exit;
					foreach($scheduleSessionData as $data){
					$priceData = unserialize($data["pricingData"]);
						$string = "";$price_type = "";

						foreach($priceData as $key=>$val){
							/*if(isset($val["schedulePrice"])){
								$price_type = $val["price_type"];
								$string .= $val["price_type"]." ".$val["schedulePrice"]."<br/>";
								//$string .= $val["price_type"]." ".$val["schedulePrice"]."<br/>";
							}*/
							if($val["price_type"]=="PER_PERSON") {
								$price_type = "PER PERSON";
								$type_string .= ucfirst($val["price_option_type"]).'<br>';
								$p_i_price .= $val["price"].'<br>';
							}	else {
								$price_type = "PER ITEM";
								$type_string .= $val["label"].'<br>';
								$p_i_price .= $val["price"].'<br>';
							}
						}
				?>
                    <tr>
                      <td><?php /* echo "<pre>";
					  print_r($data); */
					  if($data["startDate"] !=''){
						/*echo date('D,M',strtotime($data["startDate"]))." ".date('d,Y',strtotime($data["startDate"])); ?><br/><?php if ($data["repeatPeriodBy"] != "DoNOt") echo "Repeat ".$data['repeatPeriodBy']." until ". date('D,M',strtotime($data["endRepeatDate"]))." ".date('d,Y',strtotime($data["endRepeatDate"]));*/

						echo $data["startDate"]; ?><br/>
						<?php if ($data["repeatPeriodBy"] != "DoNOt") echo "Repeat ".$data['repeatPeriodBy']." until ".$data["endRepeatDate"];
					  }else{
						echo $data["startDate"]=date('Y-m-d');

					  }					  ?>
					  </td>
					  <td>
					  	<?php echo $price_type; ?>
					  </td>
					   <td>
					  	<?php echo $type_string; ?>
					  </td>
					  <td>
					  	<?php echo $p_i_price; ?>
					  </td>

					  <td><a onclick="return confirm('Are you sure?')" href="<?php echo $base_url; ?>/product/session/delete/<?php echo $data["listing_id"]; ?>/<?php echo $data["se_id"]; ?>">Remove</a></td>

					   <td>
					   <?php

					   if((strtotime($data["endRepeatDate"])>=strtotime(date('Y-m-d')))) { ?>
					   <a href="<?php echo $base_url; ?>/product/session/edit/<?php echo $data["listing_id"]; ?>/<?php echo $data["se_id"]; ?>">Edit</a>
					   <?php }else if(($data["bookingMode"] == 'NO_DATE')){ ?>
					   <a onclick="alert('You can not edit this session on perticular date as in this no date required so first remove this session and create new session with date ranges.');">Edit</a>

					   <?php }else { ?>
					   <a onclick="alert('As the session date is past, You can not edit this session');" style="cursor:pointer">Edit</a>
					   <?php  } ?>
					   </td>
					   <td><a href="javascript:void(0)" class = "session_view_link" ses-data = "<?php echo $data["listing_id"].'/'.$data["se_id"]; ?>" >View</a></td>
					   <?php if($data["bookingMode"] != 'NO_DATE'){ ?>
					   <td><a href="javascript:void(0)" class = "session_editdats_link" ses-data = "<?php echo $data["listing_id"].'/'.$data["se_id"]; ?>" >Edited Date</a></td>
					   <?php } ?>
                    </tr>
		<?php $price_type ='';$type_string = '' ;$p_i_price = '';} //echo "<pre>";Print_r($priceData);exit; // End Updated 17-02-2016	?>

    </tbody>
  </table>
</div>
</div>
</div>

<script>
jQuery('.pos_static').addClass('margin_remove');
</script>

<?php } }
if($subscriptionListing){
	drupal_add_css(drupal_get_path('theme', $GLOBALS['theme']) .'/css/rangeSlider.css');

	$slidemin=0;
	$slidemax=100;

	$Classic='';$Silver='';$Gold='';
	$Classic_id='';$Silver_id='';$Gold_id='';

	if($packages){
	$slidemax = $packages[0]['price'];
	$slidemin = $packages[2]['price'];

	$Classic=$packages[2]['price'];
	$Silver=$packages[1]['price'];
	$Gold=$packages[0]['price'];

	$Classic_id=$packages[2]['id'];
	$Silver_id=$packages[1]['id'];
	$Gold_id=$packages[0]['id'];
	}


?>
	<div class="account_setting_page">
		<div class="main_wrapper">
  <div class="ranking_plan_title">
   <h3>Ranking plan</h3>
  </div>
  <div class="range_select">
  <div class="range_price"><div class="range_currency">&#36;</div><div class="out_put_range price_range_data">0</div><div class="range_period">&#47;mo</div></div>
  <div class="comission_reservation">&#43;20&#37; fix commission per reservation</div>
    <!--  <input name="range" id="slider_range" type="range" min='<?php echo $slidemin; ?>' max='<?php echo $slidemax; ?>' value='<?php echo $slidemin; ?>' data-rangeSlider> -->

    <div style="position: relative;">

	    <div>
	        <input type="text" id="price_range_bar" value="" type="range" name="range" />
	    </div>

	</div>

     <div class="range_class">
     <div class="economy_class">Economy</div>
     <div class="business_class">Business</div>
     <div class="premiere_class">Premiere</div>
     </div>
     <div class="range_perc"><output></output></div>
     <div class="range_content price_range_content">The more bookings you get, the highest you show up</div>
	 <fieldset class="marg_bottom_80"></fieldset>
	   <fieldset class="full_width_fix">
	   <div class="range_content"><a href=<?php echo $baseUrl.'/product/add/payment/'.arg(3).'/'.$Classic_id; ?> class="generated_link" >Publish</a></div></fieldset>

  </div>
 </div>

<link rel="stylesheet" href="<?php print $GLOBALS['base_url'] . '/sites/all/themes/gloobers2/css/rangeslidercss/normalize.css' ?>">
<link rel="stylesheet" href="<?php print $GLOBALS['base_url'] . '/sites/all/themes/gloobers2/css/rangeslidercss/ion.rangeSlider.css' ?>">
<link rel="stylesheet" href="<?php print $GLOBALS['base_url'] . '/sites/all/themes/gloobers2/css/rangeslidercss/ion.rangeSlider.skinFlat.css' ?>">


 <?php
	//drupal_add_js(drupal_get_path('theme', $GLOBALS['theme']) .'/js/rangeSlider.js');
 ?>
 <script>

jQuery(document).ready(function(){

jQuery("#price_range_bar").ionRangeSlider({
    type: "single",
    values: ["one", "two", "three"]
});

jQuery(".irs-single, .irs-max, .irs-min").remove();

jQuery("#price_range_bar").on("input change", function() {


   	var slider_width =jQuery('.irs-slider').attr('style');
    slider_width=slider_width.substr('6');
   	var check_data=slider_width.replace(';', ' ');

    console.log(check_data);

	   if(jQuery.trim(check_data)=='0%'){

	   	console.log('1');
	    jQuery('input[type="range"]').val(<?php echo $Classic; ?>);
		jQuery('output').html('');
		jQuery('.price_range_data').html(<?php echo $Classic; ?>);
		jQuery('.price_range_content').html('The more bookings you get, the highest you show up.');
		assign_pack('<?php echo $Classic_id; ?>');

		jQuery('.irs-bar').css('width','0%');
		jQuery('.irs-slider').css('left','0%');


	   /*}else  if(jQuery.trim(check_data)=='48.4721%' || jQuery.trim(check_data)=='48.4211%'){*/
	   } else if(jQuery.trim(check_data)>='40%' && jQuery.trim(check_data)<'80%'){

	  	console.log('2');
	  	jQuery('input[type="range"]').val(<?php echo $Silver; ?>);
		jQuery('output').html('35%');
		jQuery('.price_range_data').html(<?php echo $Silver; ?>);
		jQuery('.price_range_content').html('more exposure than Economy listings.');
		assign_pack('<?php echo $Silver_id; ?>');

		jQuery('.irs-bar').css('width',check_data);
		jQuery('.irs-slider').css('left',check_data);

	   }
	   /* else if(jQuery.trim(check_data)=='96.9442%' || jQuery.trim(check_data)=='96.8421%'){*/
	   	else if(jQuery.trim(check_data)>='80%'){

	  	console.log('3');
	  	jQuery('input[type="range"]').val(<?php echo $Gold; ?>);
		jQuery('output').html('75%');
		jQuery('.price_range_data').html(<?php echo $Gold; ?>);
		jQuery('.price_range_content').html('more exposure than Economy listings.');
		assign_pack('<?php echo $Gold_id; ?>');

		jQuery('.irs-bar').css('width',check_data);
		jQuery('.irs-slider').css('left',check_data);

	   }

});

});

</script>
	</div>


<?php }

if(($calendar)){ ?>
<div id="createEventModal" class="modal br-model-sept" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h3 id="myModalLabel1">Availability</h3>
    </div>
    <div class="modal-body">
    <form id="createAppointmentForm" class="form-horizontal">
        <div class="control-group">
            <label class="control-label" for="when">Available dates:</label>
            <div class="controls controls-row dr-dollara" id="when" style="margin-top:5px;">
            </div>
        </div>
        <div class="control-group">
			<div class="event-status">
				<label><input type="radio" name="status" id="available"><span class="dr-common">Available</span></label>
				<label><input type="radio" name="status" id="unavailable"><span class="dr-common">Unavailable</span></label>
			</div>
        </div>
        <div class="control-group">
            <div class="controls dr-dollar">
				<div class=" form-type-textfield form-item-product-pricing-value ">
					<input type="text" maxlength="128" size="60" value="" name="product_pricing_value" id="edit-product-pricing-value" class="form-control themePrice form-text" placeholder="Price">
				</div>
				<input type="hidden" id="apptStartTime"/>
				<input type="hidden" id="apptEndTime"/>
				<input type="hidden" id="apptAllDay" />
            </div>
        </div>
        <div class="control-group">
			<div class="event-status">
				<textarea class="notes dr-textarea" placeholder="Notes..." name="notes"></textarea>
			</div>
        </div>
    </form>
    </div>
    <div class="modal-footer">
		<button class="btn del-btn" data-dismiss="modal" aria-hidden="true">Delete</button>
        <button class="btn br-cancel-btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
        <button type="submit" class="btn btn-primary" id="submitButton">Save</button>
    </div>
</div>
<script type="text/javascript">

	jQuery(document).ready(function () {
		jQuery("#available").click(function(){
			jQuery('.form-item-product-pricing-value').show();
		});
	jQuery("#unavailable").click(function(){
			jQuery('.form-item-product-pricing-value').hide();
		});

  jQuery('#submitButton').on('click', function(e){
    // We don't want this to act as a link so cancel the link action
    e.preventDefault();
	doSubmit();
  });

  function doSubmit(){
    jQuery("#createEventModal").modal('hide');
	var StartTime =  jQuery('#apptStartTime').val()
	var EndTime = jQuery('#apptEndTime').val()
	var AllDay = jQuery('#apptAllDay').val()
	var price = jQuery('#edit-product-pricing-value').val();
	var notes = jQuery('.notes').val();
	var cstatus = jQuery('input[name=status]:radio:checked').attr("id");
	jQuery.ajax({
		type: "POST",
		url: "<?php echo $base_url;?>/product/calendar?action=add",
		data: { "price": price,"notes":notes,"AllDay": AllDay,"EndTime":EndTime,"StartTime":StartTime,"cstatus":cstatus}
	})
	.done(function( data ) {

	data=jQuery.parseJSON(data);
		if(data.cstatus == "available"){

			var Ecolor = "#3366CC";
			var ETcolor = "#fff";
			var ETtitle = "Price: $"+price+"  Notes: "+notes;
		}
		else{

			var Ecolor = "#898989";
			var ETcolor = "#000";
			var ETtitle = "Notes: "+notes;
		}
		jQuery("#calendar").fullCalendar('renderEvent',
			{
				color: Ecolor,
				textColor: ETcolor,
				title: ETtitle,
				description: price+"-"+notes+"-"+data.cstatus,
				start: new Date(jQuery('#apptStartTime').val()),
				end: new Date(jQuery('#apptEndTime').val()),
				allDay: (jQuery('#apptAllDay').val() == "true"),
				eventRender: function(event, element) {
					alert(element.find('span.fc-event-title').text());
					element.find('span.fc-event-title').html(element.find('span.fc-event-title').text());
				},
			},
			true);
	});
   }

});
</script>
<?php
}
if($payment){
	$packageDetails = getPackageDetails(arg(4));
//echo $packageDetails["price"];exit;
	$_SESSION['packageID'] = $packageDetails["id"];
	$_SESSION['price'] = $packageDetails["price"];
	if($_SESSION['packageID']==3){
		$cls_vr=9;
	}else{
		$cls_vr=3;
	}
	if($packageDetails["price"]!=0){
?>
	<div class="col-xs-12 col-sm-12 col-md-<?php echo $cls_vr; ?> help_right" id="helpBar_subscribe" data-sticky_column="">
				<div class="help_block">
					<div class="heading_help">Package details</div>
					<div class="package-help">
						<ul>
							<li><b>Package: </b><?php echo $packageDetails["title"]; ?></li>
							<li><b>Price: </b>$<?php echo $packageDetails["price"]; ?> per month </li>
							<li><b><?php echo $packageDetails["description"]; ?></b></li>
						</ul>
					</div>
				  </div>
	</div>
<?php } ?>
<script>
function validate_booking()
{
//alert(jQuery('form input[type=checkbox]:checked').size());
if(jQuery("#edit-terms-checkbox-terms").prop('checked') == true){
    //do something
jQuery(".form-checkboxes .error-message").remove();
}else{
	jQuery(".form-checkboxes .error-message").remove();
	jQuery(".form-type-checkbox").append('<div class="error-message" style="color: red;float: left;width: 100%;"><span>Please Accept Terms and Conditions</span></div>');
	return false;
}


 return true;
}
 jQuery(function() {
jQuery("#package-payment-form").validate({
		rules: {
		    first_name :"required",
			last_name: "required",
			city: "required",
			country: "required",
			credit_varification_no:"required",
			credit_card_no: {
				  required: true,
				  number: true
				},
			email:{
			required: true,
			email: true
			},


		},

});
});

jQuery(window).load(function(){
jQuery("#package-payment-form")[0].reset();
jQuery("#edit-credit-card-no").val('');
jQuery("#edit-credit-varification-no").val('');
});


</script>
<?php
}

if($productId)
{
if($overViewListing)
{
$values = getOverviewData($productId);
$experienceCategoryData=getExperienceCategoryDataById($values['experience_category']);
?>
<script>
	var jq=jQuery.noConflict();
	jq(document).ready(function(){
	//sesonal_price_div_show
	jq('#edit-product-category').html("");
	/* jq('#edit-product-category').append('<option value="<?php echo $experienceCategoryData['cid'];?>"><?php echo $experienceCategoryData['category_name'];?></option>'); */
	jq.ajax({
				type: "GET",
				url: "<?php echo $base_url; ?>/product/ajax/getExperienceCategory",
				//dataType: "json",
				data: "typeId=" + encodeURI(<?php echo $values['experience_type'];?>),
				success: function(msg){
					//eval(msg);

					jq('#edit-product-category').html("");

					if(msg !="0")
					{

					//jq('#edit-product-category').append(msg);
					jq.each(msg,function(index,val){
						var sel="";
					if(index == <?php echo $values['experience_category']?>)
					{

						sel="selected";
					}
					jq('#edit-product-category').append("<option value='"+index+"' "+sel+">"+val+"</option>");
					});
					}
					else
					{


					jq('#edit-product-category').append('<option value="0">No Category Found</option>');
					}

				}
			});
	});
</script>
<?php
}
}
 //echo $success;exit;
 if(($success) || (arg(4)==3))
{
?>

	<div class="thankyou-bg">
            <div class="dr-full-width-wrapper">
                <div class="thank-you-container">
                    <div class="content-text">
					<h2 class="pagehead">Congratulations...</h2>
					<p class="subtitle">Your listing is now live</p>
					<div class="cheer-more">
					<a class="btn" href="<?php echo url('experience/'.arg(3));?>">Preview listing</a>
					<a class="btn" href="<?php echo url('manage/listing');?>">My listings</a>
					<a class="btn" href="<?php echo url('product/add/overview');?>">Create new listing</a>	</div>

                    </div>
                </div>
            </div>
    </div>


<?php
}

$eid=arg(3);
$sessionData=getListExtraPrice($eid);

/*if(!empty($sessionData) && isset($sessionData)){
$checkBoxSession='<input type="checkbox" name="sesonal_price_checked" checked id="sesonal_price_checked_id" class="sesonal_price_checked css-checkbox" value="1" />';
}else{
$checkBoxSession='<input type="checkbox" name="sesonal_price_checked" id="sesonal_price_checked_id" class="sesonal_price_checked css-checkbox" value="1" />';
}
*/
?>

<!-- Updated 10-02-2016 -->
<?php
 if (strpos($_SERVER['REQUEST_URI'], '/product/add/Calendernew') !== false) { ?>

<?php } ?>
<!--End Updated 10-02-2016, End Updated 17-02-2016, End Updated 19-02-2016 -->

<?php
	$listId=arg(3);
	$sessId=arg(4);
	$scheduleSessionData = getScheduleSessionPerData($listId,$sessId);
?>

<!-- Updated 10-02-2016 -->
<?php if (strpos($_SERVER['REQUEST_URI'], '/product/session/edit') !== false) { ?>

<!--EDIT SESSION POPUP -->
<div class="eventpopup_lightbox_new edit-session_calander">
<div class="eventpopup_panel">
<div class="closepopup"><i class="fa fa-remove"></i></div>
<!-- Updated 19-02-2016 -->
<div class="popup_title edit_pop_header"><h2>Edit session</h2></div>
<!-- End Updated 19-02-2016 -->
<form id="edit_session_id" accept-charset="UTF-8" action="" name="edit_session" method="post"  novalidate="novalidate">
<div class="col-md-12 col-sm-12 col-xs-12">
 <div class="edit_calander_session">
  <span class="labeltext">Edit pricing for this session</span>
 </div>
</div>
<input type="hidden" name="edited_date" id="edited_date_session" value="" />
<input type="hidden" name="edited_time" id="edited_time_session" value="" />
<fieldset class="col_wrap">
	<!-- Per person Pricing -->
	<div class="col-md-6 col-sm-6 col-xs-6 person_type_input">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<!-- <h3>Adult Amount</h3>-->
			<div class="person_type per_adult">
			  <div class="per_adult">Per adult</div>
	  <i class="side_icon adult_icon"><svg xml:space="preserve" style="enable-background:new 0 0 137.8 219.8;" viewBox="0 0 137.8 219.8" y="0px" x="0px" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg" id="Layer_1" version="1.1">
	<g id="XMLID_4_">
	<circle r="18.1" cy="34.3" cx="70.3" class="st0" id="XMLID_15_"/>
	<path d="M123.2,80.7L95.8,53.4c-0.8-0.8-1.9-1.1-3-1l0,0H70.3H46.2l0,0c-1.1,0-2.2,0.2-3.1,1L15.8,80.7
	c-0.7,0.7-1,1.6-1,2.5c0,0.9,0.3,1.8,1,2.5l27.4,27.4c0.8,0.8,2,1.1,3.1,0.9v0.4h-3v28h3v52.2c0,5.5,4.4,9.9,9.9,9.9h0
	c5.5,0,9.9-4.4,9.9-9.9v-52.2h7.7v52.2c0,5.5,4.4,9.9,9.9,9.9h0c5.5,0,9.9-4.4,9.9-9.9v-52.2h2.2v-28h-3v-0.3
	c1.1,0.2,2.2-0.1,3-0.9l27.4-27.4c0.7-0.7,1-1.6,1-2.5C124.2,82.4,123.9,81.4,123.2,80.7z M41.3,83.3l5-5v9.9L41.3,83.3z
	M92.8,88.2v-9.9l4.9,4.9L92.8,88.2z" class="st0" id="XMLID_6_"/>
	</g>
	</svg></i>
			</div>
		</div>
		<div class="col-md-12 col-sm-12 col-xs-12">
			<!-- <h3>Adult Amount</h3>-->
			<div class="input-group">
						<div class="input-group-addon">$</div>
						<input type="text" placeholder="Amount" name="adult_price" />
			</div>
		</div>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-6 person_type_input">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<!-- <h3>Adult Amount</h3>-->
			<div class="person_type per_adult">
			  <div class="per_adult">Per child</div>
	  <i class="side_icon adult_icon"><img alt="" class="edit_per_child" src="http://staging.gloobers.net/sites/all/themes/gloobers2/images/child.svg"></i>
			</div>
		</div>
		<div class="col-md-12 col-sm-12 col-xs-12">
			<!-- <h3>Adult Amount</h3>-->
			<div class="input-group">
						<div class="input-group-addon">$</div>
						<input type="text" placeholder="Amount" name="child_price"/>
			</div>
		</div>
	</div>

	<!--item section-->
		<div class="col-md-6 col-sm-6 col-xs-6 item_type_input">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="person_type per_adult">
			  <div class="per_adult">Item</div>
			</div>
		</div>
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="input-group">
						<div class="input-group-addon">$</div>
						<input type="text" placeholder="Amount" name="item_price"/>
			</div>
		</div>
	</div>
	<fieldset class="col_wrap">
		<div class="col-md-12 col-sm-12 col-xs-12">
		  <div class="col-md-12 col-sm-12 col-xs-12">
		   <div class="checkbox">
			<label><input type="checkbox" name="price_checkbox" value="checked">Edit pricing for the entire day</label>
			</div>
		  </div>
		</div>
	</fieldset>
</fieldset>


<fieldset class="col_wrap popup_btn_bottom"><input name="submit" type="button" class="submit_btn_session_edit submit_btn" value="Update"></fieldset>
</form>

</div> <!-- End EventPopUp_Panel -->
</div> <!-- End EventPopUp_Lightbox -->

<?php   }  ?>

<style>
input.error, textarea.error, select.error {
    border: 2px solid red !important;
}
</style>
<script>
	jq(document).ready(function(){

		/* custom tab for openning days and sessions hours */

	jQuery('body').on('click', '#tabs-container .weekday_menu',function(event){

		event.preventDefault();

		id=jQuery(this).closest('.sessions_tabs_menu').attr('data-id');

		if(jQuery('#session_startTime_'+id).text()=='Select time'){

			alert("Please select session time first");
			return false;
		}

		selected_day=jQuery(this).find(".css-checkbox").val();
		selected_time=jQuery('#session_startTime_'+id).text();

		count_div=jQuery('.sessions_tabs_menu').length;
		session_exists='';
		if(jQuery(this).hasClass('day_active')){
			 jQuery(this).removeClass("day_active");
			 jQuery(this).find(".css-checkbox").prop( "checked", false );

		}else {
				if(count_div>1){
				jQuery('.session_timepicker').each(function(){

				jQuery(this).closest('.offer_icon_left').next('.hour_session_content_right').find('.sessions_tabs_menu li').each(function(){

					each_id=jQuery(this).closest('.sessions_tabs_menu').attr('data-id');
					checkday='';each_selected_time='';

					if(jQuery(this).hasClass('day_active')){

						each_selected_time=jQuery('#session_startTime_'+each_id).text();
						checkday=jQuery(this).find('.css-checkbox').val();

						//convert both time into timestamp
						var stt = new Date("November 13, 2013 " + selected_time);
						stt = stt.getTime();
						var endt = new Date("November 13, 2013 " + each_selected_time);
						endt = endt.getTime();

						if( (selected_day==checkday) && (stt==endt)){
							session_exists='yes';
						}
					}
				})
			})
			}

			if(session_exists){
				alert('Session time '+selected_time+' already selected for weekday '+selected_day);
			} else {
				jQuery(this).addClass("day_active");
				jQuery(this).find(".css-checkbox").prop( "checked", true );
			}
		}

		});



	jq("#product-photos-form #edit-save").attr('disabled','disabled');
	jq('#edit-product-type').on('change', function(){
		jq.ajax({
			type: "GET",
			url: "<?php echo $base_url; ?>/product/ajax/getExperienceCategory",
			data: "typeId=" + encodeURI(this.value),
			success: function(msg){
				jq('#edit-product-category').html("");
				if(msg !=0){
					jq.each(msg,function(index,val){
						jq('#edit-product-category').append("<option value='"+index+"'>"+val+"</option>");
					});
				}else{
					jq('#edit-product-category').append('<option value="0">No Category Found</option>');
				}
			}
		});

	});

	function characterCount(elementId,maxchar,maxCharsWarning){
		jq('#'+elementId).jqEasyCounter({
			'maxChars': maxchar,
			'maxCharsWarning': maxCharsWarning,
			'msgFontSize': '12px',
			'msgFontColor': '#000',
			'msgFontFamily': 'Verdana',
			'msgTextAlign': 'right',
			'msgWarningColor': '#F00',
			'msgAppendMethod': 'insertAfter'
		});
	}
	characterCount('edit-short-description',500,490);
	characterCount('edit-product-name',35,30);
	characterCount('edit-expect',2000,1950);
	var nowTemp = new Date();
	var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

	jQuery('.session_startdt').each(function(){

		var id=jQuery(this).attr('data-val');

        var checkin = jQuery('#edit-session-startdate_new_'+id).datepicker({
        format:'yyyy-mm-dd',
		beforeShowDay: function (date) {
			return date.valueOf() >= now.valueOf();
		},
		autoclose: true

	}).on('changeDate', function (ev){
		if(ev.date){
			//if (ev.date.valueOf() > checkout.datepicker("getDate").valueOf() || !checkout.datepicker("getDate").valueOf()) {

				var newDate = new Date(ev.date);
				newDate.setDate(newDate.getDate());
				checkout.datepicker("update", newDate);

			//}
			idd=jQuery(this).attr('data-val');
			jQuery('#edit-session-enddate_new_'+idd).focus();
			jQuery('#edit-session-enddate_new_'+idd).closest('.select_date_from').addClass('active');
			jQuery('#select_from_date_'+idd).html(jQuery('#edit-session-startdate_new_'+idd).val());
			jQuery('#select_to_date_'+idd).html(jQuery('#edit-session-enddate_new_'+idd).val());
	   }



	});

	var checkout = jQuery('#edit-session-enddate_new_'+id).datepicker({
			format:'yyyy-mm-dd',
			beforeShowDay: function (date){
			if (!checkin.datepicker("getDate").valueOf()) {
				return date.valueOf() >= new Date().valueOf();
			} else {
				return date.valueOf() > checkin.datepicker("getDate").valueOf();
			}
		},
		autoclose: true

	}).on('changeDate', function (ev) {
		if(ev.date){
			id_end=jQuery(this).attr('data-val');
			jQuery('#select_to_date_'+id_end).html(jQuery('#edit-session-enddate_new_'+id_end).val());
		}
	});


	jQuery('#edit-session-startdate_new_0').on('click',function(){
	jQuery(this).closest('.select_date_from').addClass('active');

	});
	jQuery('#edit-session-enddate_new_0').on('click',function(){
	jQuery(this).closest('.select_date_from').addClass('active');

	});
 });


   jQuery('.session_from_dtpicker').each(function(){

    	var p=jQuery(this).attr('data-val');

    	var checkin = jQuery('#session_from_'+p).datepicker({
        format:'yyyy-mm-dd',
		beforeShowDay: function (date) {
			return date.valueOf() >= now.valueOf();
		},
		autoclose: true

	}).on('changeDate', function (ev){

		if(ev.date){

			//if (ev.date.valueOf() > checkout.datepicker("getDate").valueOf() || !checkout.datepicker("getDate").valueOf()) {

				var newDate = new Date(ev.date);
				newDate.setDate(newDate.getDate());
				checkout.datepicker("update", newDate);

			//}
			idd=jQuery(this).attr('data-val');
			jQuery('#session_to_'+idd).focus();
			jQuery('#session_to_'+idd).closest('.select_date_from').addClass('active');
			jQuery('#season_from_date_'+idd).html(jQuery('#session_from_'+idd).val());
			jQuery('#season_to_date_'+idd).html(jQuery('#session_to_'+idd).val());

		}

	});

	var checkout = jQuery('#session_to_'+p).datepicker({
			format:'yyyy-mm-dd',
			beforeShowDay: function (date){
			if (!checkin.datepicker("getDate").valueOf()) {
				return date.valueOf() >= new Date().valueOf();
			} else {
				return date.valueOf() > checkin.datepicker("getDate").valueOf();
			}
		},
		autoclose: true

	}).on('changeDate', function (ev) {
		if(ev.date){
			id_end=jQuery(this).attr('data-val');
			jQuery('#season_to_date_'+id_end).html(jQuery('#session_to_'+id_end).val());
	    }
	});


	jQuery('#session_from_0').on('click',function(){
	 	jQuery(this).closest('.select_date_from').addClass('active');

	});
	jQuery('#session_to_0').on('click',function(){
		jQuery(this).closest('.select_date_from').addClass('active');

	});



    });


	var Hours24Date = jQuery('.offer_24_hour_offer_Data_date').datepicker({
			format:'yyyy-mm-dd',
			beforeShowDay: function (date) {
				return date.valueOf() >= now.valueOf();
			},
			startDate:now,
			autoclose: true
	});



    /*remove date period*/
	jQuery('body').on('click', '.session-from-to .remove_period',function(){
	jQuery(this).closest('.availability_main').remove();
	jQuery(this).remove();
	});
	/*remove seasonal period*/
	jQuery('body').on('click', '.sesonal_price_div_show .remove_person_period',function(){
    jQuery(this).closest('.remove_this_seasonal').remove();
    jQuery(this).remove();
  	});
  	/*remove session period*/
  	jQuery('body').on('click', '#tabs-container .remove_session_link',function(){
		session_header_add=1;
		jQuery(this).closest('.sessions_tab_content').remove();

		jQuery('.sessions_tab_content').find('div:first').find('h3').each(function(){
		jQuery(this).html('Session '+session_header_add+'<span class="form-required"> *</span>');
		session_header_add++;
		});
	});

});
</script>

<script type="text/javascript">
	var jq=jQuery.noConflict();
    jq(document).ready(function(){
        //Horizontal Tab
       jq('#parentHorizontalTab').easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion
            width: 'auto', //auto or any width like 600px
            fit: true, // 100% fit in a container
            tabidentify: 'hor_1', // The tab groups identifier
            activate: function(event){ // Callback function if tab is switched
                var $tab = jq(this);
                var $info = jq('#nested-tabInfo');
                var $name = jq('span', $info);
                $name.text($tab.text());
                $info.show();
            }
        });
		// Child Tab
        jq('#ChildVerticalTab_1').easyResponsiveTabs({
            type: 'vertical',
            width: 'auto',
            fit: true,
            tabidentify: 'ver_1', // The tab groups identifier
            activetab_bg: '#fff', // background color for active tabs in this group
            inactive_bg: '#F5F5F5', // background color for inactive tabs in this group
            active_border_color: '#c1c1c1', // border color for active tabs heads in this group
            active_content_border_color: '#5AB1D0' // border color for active tabs contect in this group so that it matches the tab head border
        });
		//Vertical Tab
        jq('#parentVerticalTab').easyResponsiveTabs({
            type: 'vertical', //Types: default, vertical, accordion
            width: 'auto', //auto or any width like 600px
            fit: true, // 100% fit in a container
            closed: 'accordion', // Start closed if in accordion view
            tabidentify: 'hor_1', // The tab groups identifier
            activate: function(event){ // Callback function if tab is switched
                var $tab = jq(this);
                var $info = jq('#nested-tabInfo2');
                var $name = jq('span', $info);
                $name.text($tab.text());
                $info.show();
            }
        });

		////////////////////////////////////////////////////////////////

		jQuery('#edit-session_starttime').timepicker({

		showMeridian: true,
		minuteStep: 1,
		showInputs: true,
		}).on('changeTime.timepicker', function(e) {

		jQuery('#session_startTime').html(jQuery('#edit-session_starttime').val());
		jQuery(this).closest('.offer_icon_left').addClass('active');

		});


		////////////////////////////////////////////////////////////////
		var repeate_by_session=jQuery('#edit-session-repeatperiod').val();
		if(repeate_by_session=='DoNOt'){ jQuery('.repeat_everyminute_condition').hide();}
		if(jQuery('#24_hour_offer_check').prop('checked')==false){
			jQuery('.24_hours_disscount').hide();
		}else{
			jQuery('.24_hours_disscount').show();
		}
		if(jQuery('#last_minutes_check').prop('checked')==false){
			jQuery('.last_minute_checked_show').hide();
		}else{
			jQuery('.last_minute_checked_show').show();
		}
		if(jQuery('#early_birds_check').prop('checked')==false){
			jQuery('.early_bird_discount_show').hide();
		}else{
			jQuery('.early_bird_discount_show').show();
		}
		jQuery('.early-birds-hour-offer').css('display','block');
		if(jQuery('.day_disscount').val()=='%'){
			jQuery('#offer_24_hour_offer_Data_price').attr('onkeyup','minmaxPrice(this.value,0,100);');
		}else{
			jQuery('#offer_24_hour_offer_Data_price').removeAttr('onkeyup','minmaxPrice(this.value,0,100);');
		}

		jQuery('.day_disscount').on('change', function(){
			if(jQuery(this).val()=='%'){
				jQuery('#offer_24_hour_offer_Data_price').attr('onkeyup','minmaxPrice(this.value,0,100);');
				return false;
			}else{
				jQuery('#offer_24_hour_offer_Data_price').removeAttr('onkeyup','minmaxPrice(this.value,0,100);');
				return false;
			}
		});
	});
	jQuery('#edit-all-day-session-all-day').click(function(){
		jQuery('.All_day').toggle();
	});

	jQuery('#last_minutes_check').click(function(){
		if(jQuery('#last_minutes_check').prop('checked')==false){
			jQuery('#last_minutes_disscount').hide();
		}else{
			jQuery('#last_minutes_disscount').show();
		}
	});

	jQuery('.edit-listing-address').click(function(){
		jQuery('.alert-message').find('.message').hide();
		jQuery('#address-form').show();
		jQuery('.map-canvas-outer').hide();
		jQuery('.right_maps').show();
	});

	function setmainimg(fid){
		jQuery.ajax({
			type: "POST",
			url: "<?php echo $base_url; ?>/product/ajax/setmainimg",
			data: "fid=" + encodeURI(fid)+"&listingId="+encodeURI(<?php echo $productId;?>),
			success: function(result){
				if(result=='1'){
				jQuery(".plupload_star_icon i").removeClass("checkedMain");
				jQuery(".phpuplC_"+fid+" i").addClass("checkedMain");
				}else{
				alert('Sorry!! this image cannot set as main image.')
				}
			}
        });
	}

	function default_quanity(value){
		var min=jQuery('#edit-quantity-min').val();
		var max=jQuery('#edit-quantity-max').val();
		if(value == '0'){
			jQuery('#edit-quantity-min').attr("value", "1");
			jQuery('#edit-quantity-max').attr("value", "1");
		}
	}

	function setUntilDate(){
		var endDate=jQuery('#edit-session-enddate').val();
		jQuery('#edit-session-endrepeatdate').datepicker({
				startDate: endDate,
		});
	}

	function assign_pack(id,title){
		var list_id='<?php echo arg(3); ?>';
		if(list_id){
		jQuery('.generated_link').attr('href',$baseUrl+'/product/add/payment/'+<?php echo arg(3); ?>+'/'+id);
		}
	}

	jQuery('.select_pack').click(function(){
		jQuery('.ranking_classes_box').removeClass('active');
		jQuery(this).parent('.ranking_classes_box').addClass('active');
	});

	function check_photo_validate(){
		jQuery.ajax({
			type: "post",
			url: "<?php echo $base_url; ?>/product/ajax/checkImagecounter",
			data: {listing_id:'<?php echo arg(3); ?>'},
			success: function(result){
				alert(result);
			}
		});
	}

	function minmaxCancel(value, min, max){
		if(parseInt(value) < min || isNaN(value)){
			return 0;
		}else if(parseInt(value) > max){
			return max;
		}else{
			return value;
		}
	}

	function minmaxPrice(value, min, max){
		if(parseInt(value) < min || isNaN(value)){
			return 0;
		}else if(parseInt(value) > max){
			return max;
		}else{
			return value;
		}
	}
</script>
<!-- 6april2016 -->
<?php if (strpos($_SERVER['REQUEST_URI'], '/product/add/overview') !== false) { ?>
<script>

	jQuery(document).ready(function(){
		var status='active';
		function edit_product_type(){
			if(jQuery("#edit-product-type").val()==''){
	 		jQuery("#edit-product-type").addClass('error');
	 		jQuery("#edit-product-type").next().addClass("error");
	 		jQuery("#edit-product-type").next('.error').next('.form-required').remove();
	 		jQuery("#edit-product-type").next('.error').after("<span class='form-required'>Experience Type is required</span>");
	 		status='inactive';
		 	} else{
		 		jQuery("#edit-product-type").next().removeClass("error");
		 		jQuery("#edit-product-type").next().next('.form-required').remove();
		 		status='active';

		 	}
		}
		 jQuery(".add_over_exp").click(function(){
		 	edit_product_type();

			if(status=='inactive'){
			console.log(status);
			return false;

			}

		 });

		 jQuery("#edit-product-type").change(function(){
		 	edit_product_type();
		 });


	});
</script>
<?php }?>
<?php if (strpos($_SERVER['REQUEST_URI'], '/product/add/payment') !== false) { ?>
<script>

	// When the browser is ready...
  jQuery(function() {
	var status='active';

  	function zip_codefn(){
	  	var zipcode=jQuery.trim(jQuery("#edit-zipcode").val());
		if(zipcode!='') {
			if(jQuery.isNumeric(zipcode)){
			jQuery("#edit-zipcode").next('.error').remove();
			jQuery("#edit-zipcode").removeClass('error');
			status='active';
		} else {
			jQuery("#edit-zipcode").addClass('error');
			jQuery("#edit-zipcode").next('.error').remove();
			jQuery("#edit-zipcode").after('<label for="edit-zipcode" class="error">Zipcode must be numeric.</label>');
			status='inactive';
		}
		}
  	}

  	function country_codefn(){
  	var country =jQuery("#edit-country").next().find('.sbSelector').html();
	  	if(country=='- Select -'){
			jQuery("#edit-country").next().addClass('error');
			jQuery("#edit-country").next().next('.error').remove();
			jQuery("#edit-country").next().after('<label for="edit-state" class="error">This field is required.</label>');
		} else {
			jQuery("#edit-country").next().removeClass('error');
			jQuery("#edit-country").next().next('.error').remove();
		}
  	}

	  jQuery("#edit-country").change(function(){
	  	country_codefn();
	  });

	jQuery("#edit-zipcode").blur(function(){
		zip_codefn();
		if(status=='inactive'){
			return false;
		}

	});

	jQuery(".package-validate").click(function(){

		if(jQuery('#edit-state').val()==''){
			jQuery("#edit-state").addClass('error');
			jQuery("#edit-state").next().remove()
			jQuery("#edit-state").after('<label for="edit-state" class="error">This field is required.</label>');
		} else{
			jQuery("#edit-state").next().remove();
		}
		country_codefn();
		zip_codefn();
		if(status=='inactive'){
			return false;
		}

	});

  });


</script>
<?php }?>

<?php if (strpos($_SERVER['REQUEST_URI'], '/product/add/location') !== false) { ?>
<script>

	// When the browser is ready...
  jQuery(function() {
	$latitude='<?php echo $productDetail['latitude'] ?>';
	$longitude='<?php echo $productDetail['longitude'] ?>';
	$base_url='<?php echo $base_url; ?>';
	console.log($latitude);
	console.log($longitude);
	if($latitude!='' && $longitude!=''){

		jQuery('#product-location-info-form').find('div:first').before('<div class="col-xs-12 col-sm-12 col-md-5 pull-right"><div class="right_maps"><div class=map-canvas-outer><div id="map-canvas" style="width:500px;height:300px;"> </div></div</div></div>');


	} else {
		jQuery('#product-location-info-form').find('div:first').before('<div class="col-xs-12 col-sm-12 col-md-5 pull-right"><div class="right_maps"><img alt="Google Static Map" src="'+$base_url+'/sites/all/themes/gloobers2/images/staticmap.jpg"></div></div>');
	}

	jQuery('#product-location-info-form').find('.col-xs-12.col-sm-12.col-md-5.pull-right + div').addClass('outer_location');
	jQuery('.outer_location .row .map_fields_style').removeClass('custom_six custom_sevan custom_five');

  });


</script>
<?php }?>

<?php if (strpos($_SERVER['REQUEST_URI'], '/product/add/extra') !== false) { ?>
<script>

	// When the browser is ready...
jQuery(function() {

jQuery('body').on('click','.add_more_optional', function(e){

	jQuery(this).parent().prev().after('<fieldset class="no-margin col-xs-10 col-md-10"><div class="col-xs-12 col-sm-12 col-md-6 padding-left-none"><div class="form-item form-type-textfield form-item-extra-service"><label for="edit-extra-service">Service title  <span title="This field is required." class="form-required">*</span></label><input type="text" maxlength="128" placeholder="Enter title here" title="Optional Service" size="60" name="extra_service[]" id="edit-extra-service" class=" form-text required" value=""></div></div><div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 padding_left"><label>Rate <span class="form-required" title="This field is required.">*</span></label><div class="rate_input_field"><div class="form-item form-type-textfield form-item-extra-price-value"><input type="text" placeholder="Amount" class="form-text required" maxlength="128" size="60" value="" name="extra_price_value[]" id="edit-extra-price-value"></div></div><div class="rate_icon_right"><div class="form-item form-type-select form-item-extra-price-type"><select name="extra_price_type[]" id="edit-extra-price-type" class=" form-select" sb="31044461"><option value="$">$</option><option value="%">%</option></select></div></div></div><div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 padding_left padding_right"><label>Choice</label><div class="form-item form-type-select form-item-extra-price-key"><select name="extra_price_key[]" id="edit-extra-price-key" class=" form-select" sb="83196746"><option value="per-quantity">Per quantity</option><option value="per-order">Per order</option></select></div></div></fieldset><div class="remove_services"><a class="Remove_optional">Remove</a></div>');

	jQuery("select").selectbox();

	jQuery("input[name='extra_service[]").on('keypress',function(){
	jQuery(this).next().remove();

	});

	jQuery("input[name='extra_price_value[]").on('keypress',function(){
	jQuery(this).next().remove();

	});

});

jQuery("#product-extra-form").on('click', '.Remove_optional', function() {
	console.log('test');
	jQuery(this).parent().prev().remove();
	jQuery(this).parent().remove();
});

});


</script>
<?php }?>

<?php  if (strpos($_SERVER['REQUEST_URI'], '/product/add/Calendernew') !== false) { ?>
<script>
jQuery('#helpBar').hide();
jQuery(".inner_setting_page").find('#messages').find('ul li:first').nextAll().remove();
</script>
<?php } ?>
