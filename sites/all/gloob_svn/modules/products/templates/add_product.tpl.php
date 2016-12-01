<?php 
	global $user,$base_url;
	//drupal_add_css(drupal_get_path('theme', 'gloobers2') .'/css/colorbox.css','file');
    //drupal_add_js(drupal_get_path('theme', 'gloobers2') .'/js/jquery.colorbox.js', 'file');
	drupal_add_js(drupal_get_path('theme', 'gloobers2') .'/js/jquery.sticky.js',array('scope' => 'footer'));
    drupal_add_js(drupal_get_path('theme', 'gloobers2') .'/js/help-text.js', 'file');
    drupal_add_js(drupal_get_path('theme', 'gloobers2') .'/js/jquery.validate.min.js',array('scope' => 'footer'));
    drupal_add_js(drupal_get_path('theme', 'gloobers2') .'/js/additional-methods.js', array('scope' => 'footer'));
     drupal_add_js(drupal_get_path('theme', 'gloobers2') .'/js/experience-pricing-validate.js',array('scope' => 'footer'));	
     drupal_add_js(drupal_get_path('theme', 'gloobers2') .'/js/experience-list-validate.js',array('scope' => 'footer'));
	 drupal_add_js(drupal_get_path('theme', 'gloobers2') .'/js/jquery.jqEasyCharCounter.min.js',array('scope' => 'footer'));

	if(!empty($photos)){
?>
<style>

.helpbox
{
right:34px !important;
}

</style>
<div class="photos-wrapper">
<?php

	$i = 1;
		foreach($photos as $photo){
		$imgpath="";
			$photo 	= unserialize($photo["value1"]);
			
			//$style 	= "thumbnail";
			$style 	= "medium";			
			$file 	= file_load(trim($photo["fid"]));		
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
if(!$addressListing && !$subscriptionListing && !$calendar && !$success){
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

		if((($productDetail['address1'] != "") && ($productDetail['city'] != "") && ($productDetail['state']!= "") && ($productDetail['country']!= "")&&($productDetail['latitude'] != "") && ($productDetail['longitude'] != "")))
			{

	
			print '<div class="address-wrapper product-form-wrapper"><img alt="Google Static Map" src="http://maps.googleapis.com/maps/api/staticmap?center='.$productDetail['latitude'].','.$productDetail['longitude'].'&zoom=16&scale=false&size=600x300&maptype=roadmap&sensor=false&format=png&visual_refresh=true&markers=color:red|'.$productDetail['latitude'].','.$productDetail['longitude'].'">';
			//print all address details
			print '<div class="address-detail">';
			print $productDetail['address1'].",".$productDetail['address2']."<br/>";
			print $productDetail['city'].",".$productDetail['state'].",".$productDetail['country']." ".$productDetail['zipcode'];
			print '</div>';
			print '<div class="add-listing-address btn btn-dark btn-gradient"><a  class="inline" href="#address-form">'.t('Edit Address').'</a></div></div>';
		    print '<div class="product-form-wrapper">';
			echo drupal_render($directionform);
			print '</div>';			
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
if(!$subscriptionListing && !$success && !$payment){

?>

</div>
<div class="helpbox">
	<h2>Help text</h2>
	
    <?php 
	if($overViewListing)
	{
	?>
	
		<div class="product_type-help" style="display:none;">
		<h4><?php print t('Experience Type');?></h4>
		<p><?php print t('Select Experience Type');?></p>
		</div>
		<div class="product_category-help" style="display:none;">
		<h4><?php print t('Experience category');?></h4>
		<p><?php print t('Select Experience category corresponding to Experience Type');?></p>
		</div>
		<div class="product_name-help" style="display:none;">
		<h4><?php print t('Experience title');?></h4>
		<p><?php print t('Experience title is Required');?></p>
		<p><?php print t('Maximum 35 characters are allowed');?></p>
		</div>
		<div class="short_description-help" style="display:none;">
		<h4><?php print t('Highlight');?></h4>
		<p><?php print t('Give Highlights of Trip');?></p>
		<p><?php print t('Maximum 500 characters are allowed');?></p>
		</div>
		<div class="expect-help" style="display:none;">
		<h4><?php print t('Long Description');?></h4>
		<p><?php print t('Add a longer description of your experience.');?></p>
		<p><?php print t('This must be at least 100 characters long, but can be up to 2,000 characters if needed.');?></p>
		<p><?php print t('Formatting is not allowed so please use plain text.');?></p>
		</div>
		<div class="itinerary-help" style="display:none;">
		<h4><?php print t('Itinerary ');?></h4>
		<p><?php print t('Add planned route for journey.');?></p>
		</div>
		<div class="communication-help" style="display:none;">
		<h4><?php print t('Communication with travelers');?></h4>
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
  <h4><?print t('Images');?></h4>
 <p><?php print t('You can add several images that will appear as a gallery to your customers.');?></p>
 <p><?php print t('The first image you add will become your cover image.');?></p>
 <p><?php print t('High resolution photos taken with cameras are generally too big must be resized before you upload.');?></p>
 <p><strong><?php print t('Max file size is 5Mb.');?></strong><br><strong><?php print t('Recommended image size is 1930 x 1260 px.');?></strong></p>
  <?php
  }
  elseif($amenitiesList)
  {
  ?>
  <!--<h4><?print t('Amenities');?></h4>
  <p><?php print t('Amenities at Experience listings.');?></p>-->
  <div class="safety_precautions-help" style="display:none">
  <h4><?php print t('Safety Precautions');?></h4>
  <p>Safety precautions provided to Travellers</p>
  </div>
  <div class="amenities-included-help amenities-extra-included-help" style="display:none">
  <h4><?php print t('Amenities Included');?></h4>
  <p>Amenities Included</p>
  </div>
  <div class="amenities-excluded-help amenities-extra-excluded-help" style="display:none">
  <h4><?php print t('Amenities Excluded');?></h4>
  <p>Amenities Excluded</p>
  </div>
  <?php
  }
  elseif($addressListing)
  {
  ?>
  <h4><?print t('Address');?></h4>
  <p><?php print t('Your exact address is shared with people');?></p>
  <?php
  }
  elseif($schedulingList)
  {
  ?>
  <div class="form-item-Product-bookingMode-help" style="display:none;">
		<h4><?php print t('Dates available');?></h4>
		<p><?php print t('You can choose from:');?></p>
          <ul>
				<li>
					<strong>Fixed dates &amp; times</strong> <br>
					<p>Allows you to select dates and times when this product is available.</p>
					<p>Gives you the flexibility to change the price and availability for each date/time, and to blackout dates.</p>
				</li>
				<li>
					<strong>Any date</strong> <br>
					<p>This means that a date is required, but the customer can choose any they wish.</p>
					<p>You cannot limit availability, blackout dates or vary your prices per period if you select this option.</p>
				</li>
				<li>
					<strong>Date not required</strong>
					<p>For example if you sell open tickets that do not require a specific date.</p>
			    </li>
		   </ul>
		
		</div>
	<div class="confirm_booking_type-help" style="display:none;">
		<h4><?php print t('Confirm bookings');?></h4>
		<ul>
			<li>
				<p><strong>Automatically</strong><br>
				Your customer's orders will be automatically confirmed. This is the recommended option if you use gloobers to manage availability for this product, because your products can never be overbooked.</p>
			</li>
			<li>
				<p><strong>Manually</strong><br>
				Orders placed by your customers will have a "Pending supplier" status. You must manually review and confirm each order.</p>
			</li>
		</ul>			
		</div>
	  <div class="schedule_type-help" style="display:none;">
		<h4><?php print t('Estimated duration');?></h4>
		<p>This is the estimated duration of this product. You can choose products that run across:</p>
		<ul>
			<li>Minutes</li>
			<li>Hours</li>
			<li>Days</li>
		</ul>

	 <p>Please note that this is for informational purposes only and is an approximate figure. Customers will see this as a guide only.</p>
   </div>	
  
  <?php
  }
  elseif($pricingList)
  {
  ?>

  <div class="season_rate_label-help" style="display:none;">
		<h4><?php print t('Rate Label');?></h4>
		<p><?php print t('Rate Label');?></p>	
  </div>
   <div class="season_rate_amount-help" style="display:none;">
		<h4><?php print t('Price');?></h4>
		<p><?php print t('Enter the amount that will be charged.');?></p>	
		<p>For example: <strong>25.00</strong></p>	
  </div>
  <div class="high_season_rate_dates-help" style="display:none;">
		<h4><?php print t('From - To');?></h4>
		<p><?php print t('price available period');?></p>	
  </div>
  <div class="product_pricing_quantity-help" style="display:none;">
		<h4><?php print t('Quantity Required');?></h4>
		<p><?php print t('Quantity allowed for deal');?></p>	
  </div>
  <div class="product_pricing_type-help" style="display:none;">
		<h4><?php print t('Product pricing');?></h4>
		<p><?php print t('Lorem Ipsum is simply dummy text of the printing and typesetting industry.');?></p>	
  </div>
  <div class="product_pricing_key-help" style="display:none;">
		<h4><?php print t('Product pricing for');?></h4>
		<p><?php print t('Lorem Ipsum is simply dummy text of the printing and typesetting industry.');?></p>	
  </div>
  <div class="product_pricing_value-help" style="display:none;">
		<h4><?php print t('Price');?></h4>
		<p><?php print t('Enter the amount that will be charged.');?></p>	
  </div>
   <div class="schedule_type-help" style="display:none;">
		<h4><?php print t('Apply to schedule');?></h4>
		<p><?php print t('Availability is determined by the sessions you create in your calendar. If you don\'t create sessions this product will not be available.');?></p>	
  </div>
  <div class="product_pricing_quantity_type-help" style="display:none;">
		<!--<h4><?php print t('Apply to schedule');?></h4>-->
		<p><?php print t('Lorem Ipsum is simply dummy text of the printing and typesetting industry.');?></p>	
  </div>
  <div class="quantity_min-help" style="display:none;">
		<h4><?php print t('Minimum Quantity');?></h4>
		<p><?php print t('Enter the minimum range of days used for this price.');?></p>	
  </div>
  <div class="quantity_max-help" style="display:none;">
		<h4><?php print t('Maximum Quantity');?></h4>
		<p><?php print t('Enter the maximum range of days used for this price.');?></p>	
  </div>  
  <div class="quantity_max-help" style="display:none;">
		<h4><?php print t('Maximum Quantity');?></h4>
		<p><?php print t('Enter the maximum range of days used for this price.');?></p>	
  </div>
  <!---------------------------------Early Birds------------------------------------------------------->
   <div class="early_birds_time_value-help" style="display:none;">
		<!--<h4><?php print t('Maximum Quantity');?></h4>-->
		<p><?php print t('Lorem Ipsum is simply dummy text of the printing and typesetting industry.');?></p>	
  </div> 
  <div class="early_birds_time_type-help" style="display:none;">
		<!--<h4><?php print t('Maximum Quantity');?></h4>-->
		<p><?php print t('Lorem Ipsum is simply dummy text of the printing and typesetting industry.');?></p>	
  </div>
  <div class="early_birds_price_value-help" style="display:none;">
		<h4><?php print t('Price');?></h4>
		<p><?php print t('Lorem Ipsum is simply dummy text of the printing and typesetting industry.');?></p>	
  </div>
  <div class="early_birds_price_type-help" style="display:none;">
		<!--<h4><?php print t('Price');?></h4>-->
		<p><?php print t('Lorem Ipsum is simply dummy text of the printing and typesetting industry.');?></p>	
  </div>
  <div class="schedule_type_early_bids-help" style="display:none;">
		<!--<h4><?php print t('Apply to schedule');?></h4>-->
		<p><?php print t('Lorem Ipsum is simply dummy text of the printing and typesetting industry.');?></p>	
  </div>
 <!-------------------------------------Last Minute----------------------------------------------------------------->
  <div class="last_minutes_time_value-help" style="display:none;">
		<!--<h4><?php print t('Apply to schedule');?></h4>-->
		<p><?php print t('Lorem Ipsum is simply dummy text of the printing and typesetting industry.');?></p>	
  </div>
  <div class="schedule_type_last_minutes-help" style="display:none;">
		<!--<h4><?php print t('Apply to schedule');?></h4>-->
		<p><?php print t('Lorem Ipsum is simply dummy text of the printing and typesetting industry.');?></p>	
  </div>
  <div class="last_minutes_time_type-help" style="display:none;">
	<h4><?php print t('Price');?></h4>
		<p><?php print t('Lorem Ipsum is simply dummy text of the printing and typesetting industry.');?></p>	
  </div>
  <div class="last_minutes_price_type-help" style="display:none;">
	<!--<h4><?php print t('Price');?></h4>-->
	<p><?php print t('Lorem Ipsum is simply dummy text of the printing and typesetting industry.');?></p>	
  </div>
 <!----------------------24 Hour Offer-------------------------------------------------------------------------------->
<div class="24_hour_offer_date-help" style="display:none;">
	<!--<h4><?php print t('Price');?></h4>-->
	<p><?php print t('Lorem Ipsum is simply dummy text of the printing and typesetting industry.');?></p>	
  </div>
  <div class="24_hour_offer_price_value-help" style="display:none;">
	<h4><?php print t('Price');?></h4>
	<p><?php print t('Lorem Ipsum is simply dummy text of the printing and typesetting industry.');?></p>	
  </div>
  <div class="24_hour_offer_price_type-help" style="display:none;">
	<!--<h4><?php print t('Price');?></h4>-->
	<p><?php print t('Lorem Ipsum is simply dummy text of the printing and typesetting industry.');?></p>	
  </div>
  <div class="schedule_type_24_hours-help" style="display:none;">
	<h4><?php print t('Apply to schedule');?></h4>
	<p><?php print t('Lorem Ipsum is simply dummy text of the printing and typesetting industry.');?></p>	
  </div>
  <?php
  }elseif($extrasListing)
  {
  ?>
   <div class="extra_service-help" style="display:none;">
	<!--<h4><?php print t('Other Services');?></h4>-->
	<p><?php print t('Lorem Ipsum is simply dummy text of the printing and typesetting industry.');?></p>	
  </div>
   <div class="extra_price_type-help" style="display:none;">
	<h4><?php print t('Price');?></h4>
	<p><?php print t('Lorem Ipsum is simply dummy text of the printing and typesetting industry.');?></p>	
  </div>
  <div class="extra_price_value-help" style="display:none;">
	<h4><?php print t('Price');?></h4>
	<p><?php print t('Lorem Ipsum is simply dummy text of the printing and typesetting industry.');?></p>	
  </div>
  <div class="extra_price_key-help" style="display:none;">
	<!--<h4><?php print t('Price');?></h4>-->
	<p><?php print t('Lorem Ipsum is simply dummy text of the printing and typesetting industry.');?></p>	
  </div> 
  <div class="product_extra_description-help" style="display:none;">
	<h4><?php print t('Description');?></h4>
	<p><?php print t('Lorem Ipsum is simply dummy text of the printing and typesetting industry.');?></p>	
  </div>
  <?php
  }elseif($rulesList)
  {
  ?>
  <div class="experience-require-help" style="display:none;">
	<h4><?php print t('Experience Rules');?></h4>
	<p><?php print t('Lorem Ipsum is simply dummy text of the printing and typesetting industry.');?></p>	
  </div>
<!--  <div class="experience_manual-help" style="display:none;">
	<h4><?php print t('Experience Manual');?></h4>
	<p><?php print t('Lorem Ipsum is simply dummy text of the printing and typesetting industry.');?></p>	
  </div>-->
 <!-------------------------------------------------------------------------------------------------------------------------->
<div class="policies-Relaxed-help" style="display:none;">
 <h4><?php print t('Relaxed');?></h4>
  <p><?php print t('Guests will receive a full refund if they cancel at least two weeks before the start of their reservation.');?></p>
 </div>
 <div class="policies-Flexible-help" style="display:none;">
 <h4><?php print t('Flexible');?></h4>
 <p><?php print t('Guests will receive their full refundable deposit:');?></p>
 <ul>
 <li><?php print t('A 50% refund of their paid rental costs if they cancel at least four weeks before the start of their reservation; OR');?></li>
 <li><?php print t('A 25% refund of their paid rental costs if they cancel up to two weeks before the start of their reservation.');?></li>
 </ul>
 
 </div>
  <div class="policies-Moderate-help" style="display:none;">
 <h4><?php print t('Moderate');?></h4>
 <p><?php print t('Guests will receive their full refundable deposit:- <br>A 50% refund of their paid rental costs, if they cancel at least four weeks before the start of their reservation.');?></p>
 </div>
 <div class="policies-Strict-help" style="display:none;">
 <h4><?php print t('Strict');?></h4>
  <p><?php print t('Guests will receive their full refundable deposit:');?></p>
 <ul>
 <li><?php print t('A 50% refund of their paid rental costs if they cancel at least eight weeks before the start of their reservation; OR');?></li>
 <li><?php print t('A 25% refund of their paid rental costs if they cancel up to four weeks before the start of their reservation.');?></li>

 </ul>

 </div>
 <div class="policies-Super-Strict-help" style="display:none;">
 <h4><?php print t('Super-Strict');?></h4>
 <p><?php print t('If the guest cancels, any money they have paid cannot be refunded.');?></p>
 </div>
 <div class="agreement-help" style="display:none;">
	<h4><?php print t('Agreement');?></h4>
	<p><?php print t('Lorem Ipsum is simply dummy text of the printing and typesetting industry.');?></p>	
  </div>
  <div class="other_information-help" style="display:none;">
	<h4><?php print t('Other Information');?></h4>
	<p><?php print t('Lorem Ipsum is simply dummy text of the printing and typesetting industry.');?></p>	
  </div>
   <?php
  }
  ?> 
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
						if($extra1["price-type"] == '%'){
							$cost = $extra1["price"].'%';
						}
						else{
							$cost = '$'.$extra1["price"];
						}
				?>
                    <tr>
                      <td><?php echo $extra1["title"]; ?><br/><?php echo $extra1["description"]; ?></td>
                      <td><?php echo $extra1["price-key"]; ?></td>
                      <td><?php echo $cost; ?></td>
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
if(!empty($scheduleSessionData)){
?>
<div class="row product-schedules-listing">
        <div class="col-md-12">
          <div class="panel">
            <div class="panel-heading">
              <div class="panel-title"> Your schedules </div>
            </div>
            <div class="panel-body">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Starts on</th>
                      <th>Limited to</th>
                      <th>Price</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
				<?php 
					foreach($scheduleSessionData as $data){
					$priceData = unserialize($data["pricingData"]);
						$string = "";
						foreach($priceData as $key=>$val){
							if(isset($val["schedulePrice"])){
								$string .= $val["title"]." ".$val["schedulePrice"]."<br/>";
							}
							else{
								$string .= $val["title"]." ".$val["basePrice"]."<br/>";
							}
						}
				?>
                    <tr>
                      <td><?php echo date('D,M',strtotime($data["startDate"]))." ".date('d,Y',strtotime($data["startDate"])); ?><br/><?php if ($data["repeatPeriodBy"] != "DoNOt") echo "Repeat ".$data['repeatPeriodBy']." until ".$data["endRepeatDate"]; ?></td>
                      <td><?php echo $data["defaultQuantity"]; ?></td>
                      <td><?php echo $string; ?></td>
                      <td><a onclick="return confirm('Are you sure?')"" href="<?php echo $base_url; ?>/product/session/delete/<?php echo $data["listing_id"]; ?>/<?php echo $data["se_id"]; ?>">Remove</a></td>
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
          <div class="pricing-tables margin-top-lg text-center">
           <?php 
				$i = 1;
				foreach($packages as $package){
					$class1 = '';
					$class2 = 'btn-light2';
					if($i == 2){
						$class1 = 'hero-plan';
						$class2 = 'btn-blue';				
					}
		   ?> 
			<div class="col-sm-4 <?php echo $class1; ?>">
              <div class="pricing-plan">
                <div class="pricing-title <?php echo $class2; ?>">
                  <h3><?php echo $package["title"]; ?></h3>
                </div>
                <div class="pricing-info"> <span class="currency-sign">$</span>
                  <h2><?php echo $package["price"]; ?></h2>
                  <h6>Per Month</h6>
                </div>
                <div class="pricing-features">
                  <ul>
                    <li><b><?php echo $package["description"]; ?> </b></li>
                  </ul>
                </div>
                <div class="pricing-icons">
                </div>
                <a href="<?php echo $base_url; ?>/product/add/payment/<?php echo arg(3); ?>/<?php echo $package["id"]; ?>" class="btn btn-large btn-dark">Sign up</a> </div>
            </div>
			<?php 
				$i++;
				}
			?>
          </div>
        </div>
      </div>

<?php }
/*******************************************************************************/
if($calendar){
drupal_add_css(drupal_get_path('theme', 'gloobers2') .'/css/bootstrap-combined.min-local.css','file');
drupal_add_js(drupal_get_path('theme', 'gloobers2') .'/js/fullcalendar.js',array('scope' => 'footer'));

?>
<!--<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/js/bootstrap.min.js" type="text/javascript"></script>-->
 <div id="calendar"></div>

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
				<div class="form-item form-type-textfield form-item-product-pricing-value ">
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
<script>
	jQuery(document).ready(function () {

	var calendar = jQuery('#calendar').fullCalendar({
		editable: true,
        selectable: true,
      //header and other values
      select: function(start, end, allDay) {
			endtime = jQuery.fullCalendar.formatDate(end,'ddd, MMM d, h:mm tt');
			starttime = jQuery.fullCalendar.formatDate(start,'ddd, MMM d, h:mm tt');
			var mywhen = starttime + ' - ' + endtime;
			jQuery('#createEventModal #apptStartTime').val(start);
			jQuery('#createEventModal #apptEndTime').val(end);
			jQuery('#createEventModal #apptAllDay').val(allDay);
			jQuery('#createEventModal #when').text(mywhen);
			jQuery('.del-btn').hide();
			jQuery('#createEventModal').modal('show');
			jQuery('#edit-product-pricing-value').val("");   
			jQuery('.notes').val(""); 
			jQuery('#available').attr("checked",true);
			jQuery('.form-item-product-pricing-value').show();   
    },
    eventRender: function (event, element) {
        element.attr('href', 'javascript:void(0);'); //disable the event href
        element.click(function() {
			endtime = jQuery.fullCalendar.formatDate(event._end,'ddd, MMM d, h:mm tt');
			starttime = jQuery.fullCalendar.formatDate(event._start,'ddd, MMM d, h:mm tt');
			var mywhen = starttime + ' - ' + endtime;
			jQuery('#createEventModal #apptStartTime').val(endtime);
			jQuery('#createEventModal #apptEndTime').val(starttime);
			jQuery('#createEventModal #apptAllDay').val(event.allDay);
			jQuery('#createEventModal #when').text(mywhen);
			var data = event.description.split("-");
			jQuery('#edit-product-pricing-value').val(data[0]);   
			jQuery('.notes').val(data[1]);
			jQuery('.del-btn').show();
			jQuery('#'+data[2]).attr("checked",true); 
			jQuery('#createEventModal').modal('show');
			if (jQuery("#unavailable").is(":checked")) {
			   jQuery('.form-item-product-pricing-value').hide();   
			}
			jQuery('.del-btn').click(function(){
				if(confirm("Are you sure, you want to delete this event?")){
					jQuery('#calendar').fullCalendar('removeEvents', event._id);
				}
			});
        }); 
    }
    });

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
/* 	echo "<pre>";
	print_r($packageDetails); */
	$_SESSION['packageID'] = $packageDetails["id"];
	$_SESSION['price'] = $packageDetails["price"];
?>
<div class="helpbox">
	<h2>Package details</h2>
	<span class="pricing-features">
	  <ul>
		<li>Package: <b><?php echo $packageDetails["title"]; ?></b></li>
		<li>Price: <b>$<?php echo $packageDetails["price"]; ?> per month </b></li>
		<li><b><?php echo $packageDetails["description"]; ?></b></li>
	  </ul>
	</span>
</div>
<script>
 function validate_booking()
{
if(!jQuery('input[type=checkbox]:checked').length) {     
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
			//state: "required",
			//zipcode: "required",
			/* phone_number:{
			required: true,
			digits: true,
			minlength: 10,			
			}, */        			
			email:{
			required: true,
			email: true
			},	
		
						
		},
});
});
</script>
<?php
}
/*******************************************************************************/
$productId=arg(3);
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
					
					//jq('#edit-product-category').html("");
					jq('#edit-product-category').append('<option value="0">No Category Found</option>');
					}
					
				}
			});
	});
</script>
<?php
}
}
 
 if($success)
{
?>
 
 <div class="thankyou-bg">
             	<div class="dr-full-width-wrapper">
                	<div class="thank-you-container">
                    	<div class="content-text">
                        	<div class="cheer-head"><h3>Cheer Up! Your List has been validated with success </h3></div>
                            <div class="cheer-more"> 
							<a class="btn btn-blue2" href="<?php echo url('experience/view/'.arg(3));?>">View your Listing</a>
                             <a class="btn btn-blue2" href="<?php echo url('manage/listing');?>">Manage your All Listings</a>
                             <a class="btn btn-blue2" href="<?php echo url('product/add/overview');?>">Add new Listing</a>	</div>								 
                             
                        </div>
                    </div>
                </div>
             </div>
			 

<?php
}
?>
<script>

	var jq=jQuery.noConflict();
	jq(document).ready(function(){
	jq("#product-photos-form #edit-save").attr('disabled','disabled');
	jq('#edit-product-type').on('change', function() {

	
	jq.ajax({
				type: "GET",
				url: "<?php echo $base_url; ?>/product/ajax/getExperienceCategory",
				//dataType: "json",
				data: "typeId=" + encodeURI(this.value),
				success: function(msg){
					//eval(msg);
					jq('#edit-product-category').html("");
					
					if(msg !=0)
					{
				    
					//jq('#edit-product-category').append(msg);
					jq.each(msg,function(index,val){
					jq('#edit-product-category').append("<option value='"+index+"'>"+val+"</option>");
					});
					}
					else
					{
					
					//jq('#edit-product-category').html("");
					jq('#edit-product-category').append('<option value="0">No Category Found</option>');
					}
					
				}
			});

});
/**************On Focus out experience title exist or not******************************/
	
	jq("#edit-product-name").blur(function (e) {
	var	values=jq(this).val();
	jq("#edit-product-name").next('span').remove();
		if(values!="")
		{
		jq.ajax({
				type: "POST",
				url: "<?php echo $base_url; ?>/product/ajax/getExperienceTitle",
				//dataType: "json",
				data: "title=" + encodeURI(values)+"&productId="+encodeURI(<?php echo $productId;?>),
				success: function(msg){
				if(msg==1)
				{
				jq("#edit-product-name").next('span').remove();
				jq("#edit-product-name").addClass("error");
				jq("#edit-product-name").after('<span class="form-required" >Title Already Exist</span>');
				}
				else
				{
				
				jq("#edit-product-name").next('span').remove();
				jq("#edit-product-name").removeClass("error");
				jq("#edit-product-name").after('<span style="color:green;font-weight:600;" >This Title is Available</span>');
				}
			}
            });			
		}
          else
        {
		jq("#edit-product-name").next('span').remove();
        }		
	});
	/************************************************************************/
function characterCount(elementId,maxchar,maxCharsWarning)
	{
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
	/**********************************************************************************/
var nowTemp = new Date();
var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
jQuery('.session-from-to div input').each(function() {

 if(jQuery(this).attr('id') == 'edit-session-enddate')
 {
	var checkin = jQuery('#edit-session-startdate').datepicker({
	format:'yyyy-mm-dd',

		beforeShowDay: function (date) {
			return date.valueOf() >= now.valueOf();
		},
		autoclose: true

	}).on('changeDate', function (ev) {
		if (ev.date.valueOf() > checkout.datepicker("getDate").valueOf() || !checkout.datepicker("getDate").valueOf()) {

			var newDate = new Date(ev.date);
			newDate.setDate(newDate.getDate());
			checkout.datepicker("update", newDate);

		}
		jQuery('#edit-session-enddate')[0].focus();
	});


	var checkout = jQuery('#edit-session-enddate').datepicker({
	format:'yyyy-mm-dd',
		beforeShowDay: function (date) {
			if (!checkin.datepicker("getDate").valueOf()) {
				return date.valueOf() >= new Date().valueOf();
			} else {
				return date.valueOf() > checkin.datepicker("getDate").valueOf();
			}
		},
		autoclose: true

	}).on('changeDate', function (ev) {
		if (ev.date.valueOf() > untildate.datepicker("getDate").valueOf() || !untildate.datepicker("getDate").valueOf()) {

			var newDate = new Date(ev.date);
			newDate.setDate(newDate.getDate());
			untildate.datepicker("update", newDate);

		}
		jQuery('#edit-session-endrepeatdate')[0].focus();
	});
	var untildate = jQuery('#edit-session-endrepeatdate').datepicker({
	format:'yyyy-mm-dd',
		beforeShowDay: function (date) {
			if (!checkout.datepicker("getDate").valueOf()) {
				return date.valueOf() >= new Date().valueOf();
			} else {
				return date.valueOf() > checkout.datepicker("getDate").valueOf();
			}
		},
		autoclose: true

	}).on('changeDate', function (ev) {});

}
else
{
	var checkin = jQuery('#edit-session-startdate').datepicker({
        format:'yyyy-mm-dd',
		beforeShowDay: function (date) {
			return date.valueOf() >= now.valueOf();
		},
		autoclose: true

	}).on('changeDate', function (ev) {
		if (ev.date.valueOf() > checkout.datepicker("getDate").valueOf() || !checkout.datepicker("getDate").valueOf()) {

			var newDate = new Date(ev.date);
			newDate.setDate(newDate.getDate());
			checkout.datepicker("update", newDate);

		}
		jQuery('#edit-session-enddate')[0].focus();
	});


	var checkout = jQuery('#edit-session-enddate').datepicker({
	format:'yyyy-mm-dd',
		beforeShowDay: function (date) {
			if (!checkin.datepicker("getDate").valueOf()) {
				return date.valueOf() >= new Date().valueOf();
			} else {
				return date.valueOf() > checkin.datepicker("getDate").valueOf();
			}
		},
		autoclose: true

	}).on('changeDate', function (ev) {});
}	 
});
/*******************************************************************************************************/
	}); 
</script>	
<script>
jQuery.noConflict();
    jQuery(window).load(function(){
      jQuery(".helpbox ").sticky({ topSpacing:80});
    });
  </script>


