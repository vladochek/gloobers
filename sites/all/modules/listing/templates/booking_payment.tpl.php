<?php
$OverviewData=getOverviewData($_SESSION['listing_id']);
$photos = getPhotosData($_SESSION['listing_id']);
$userDetails = user_load($OverviewData["uid"]);	
$schedulingData=getSchedulingData($_SESSION['listing_id']);
$rulesDetail=getRulesDetails($_SESSION['listing_id']);
$rulesDetail=unserialize($rulesDetail["value1"]);
$pricingData = getPricingData($_SESSION['listing_id']);
drupal_add_js(drupal_get_path('theme', 'gloobers2') .'/js/jquery.validate.min.js',array('scope' => 'footer'));	
$postedData = $_SESSION["postedData"];
/* echo "<pre>";
print_r($postedData);
die;    */

$offers = getOffersAndDiscountsData($_SESSION['listing_id']);
$_SESSION['total_amount'] = isset($_POST['total-amount'])?$_POST['total-amount']:0;
?>
<style>
.error-message span{color:red;font-size:13px;padding:15px 0 0;float:left}
</style>
<div class="dr-form-width-wrapper">

         	<div class="dr-paymnet-form">
            	<div class="left-col-payment-outer">
					<?php
                    print drupal_render($bookingForm);
                    ?>
                		
                </div><!-- col ends -->
                
        <!-- ===================== right col ======================== -->
        		
                <div class="right-sidebar">
                	<h1>Booking Summary</h1>
                    
                    <div class="selection-view">
					<?php
					$photos1 = array_shift($photos);
					if($photos1)
					{
					foreach($photos1 as $photo){
					$photo 	= unserialize($photo);
					//$style 	= "thumbnail";
					$style 	= "booking_image";			
					$file 	= file_load($photo["fid"]);
					$imgpath = $file->uri;
					
					?>
					
                    	<img src="<?php print image_style_url($style,$imgpath); ?>" alt="list image" />
					<?php
                    }
					}
                    ?>					
                        
                        <div class="owner-profile">
                          <div class="owner-dp">
                            	<?php 
						   if($userDetails->picture != ""){
							$file 	= file_load($userDetails->picture->fid);
							$imgpath = $file->uri;
					      ?>
                    	<img src="<?php print file_create_url($imgpath); ?>" alt="Owner pic" />
					<?php 
						}
						else{
					?>
						<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/no-profile-male-img.jpg" alt="Owner pic" />
					<?php 
						}
					?>
                            </div><!-- dp -->
                            <div class="owner-name">
                            <p>Owner :
                            <?php 
							if($userDetails->field_first_name["und"][0]["value"] != ""){
								echo ucwords($userDetails->field_first_name["und"][0]["value"]." ".$userDetails->field_last_name["und"][0]["value"]);
							}
							else{
								echo ucwords($userDetails->name);
							}
						?>
						</p>
                            </div><!-- name -->
                        </div><!-- profile ends -->
                    </div><!-- selction ends -->
                	
                    <div class="short-links">
                     <p><b>Title:</b>   <?php echo $OverviewData['title'];?></p>
                     <p><b> Type of Product:</b>  	<?php echo ucwords($OverviewData['list_type']);?> </p>
                     <p><b>Cancellation Policy:</b><?php echo ($rulesDetail['cancellation_policies_type'] != '')?$rulesDetail['cancellation_policies_type']:'No policies defined';?></p>
					<?php 
						if(isset($_POST['check-out'])){
							$_SESSION['check-out'] = $_POST['check-out'];
							$_SESSION['check-out-time'] = $_POST['session-time'];
							//$_SESSION['booking-on'] = $_POST['booking-on'];
					?>
						<p><b>Check-in:</b> <?php echo $postedData["booking-on"]; ?></p>					
						<p><b>Check-out:</b> <?php echo date('d, F Y',strtotime($_SESSION["check-out"])); if(isset($_POST["session-time"])) {$_SESSION['session-time'] = $_POST["session-time"]; echo ' '.$_SESSION['session-time'];} ?></p>
					<?php 
						}
					?>
					 <?php 
/* 							echo '<pre>';
							print_r($postedData); die; */
							foreach($postedData["participants"] as $key=>$value){
							if($value>0)
							{
								$key = explode("|",$key);
								if($key[0] == 'group'){
						?>
							<p><b><?php echo ucwords($key[0]); ?>:</b> <?php echo ($value != '')?$value:0; ?> person</p>
							<p><b><?php echo ucwords($key[0]); ?> Price:</b> $<?php echo ($key[1] != '')?$key[1]:0; ?> (Per person)</p>
						<?php
								}
								else{
						?>
							<p><b><?php echo ucwords($key[0]); ?>:</b> <?php echo ($value != '')?$value:0; ?></p>
							<p><b>Price Per <?php echo ucwords($key[0]); ?>:</b> $<?php echo ($key[1] != '')?$key[1]:0; ?></p>
						<?php
								}	
							}
						}	
						?>
					<?php
						$durationVal = 0;
						$durationVal = isset($_POST['duration'])?$_POST['duration']:$_SESSION["durationValue"];
						if($durationVal){
							/* $_SESSION['duration'] = $durationVal; */
							if($pricingData[0]["price_type"] == 'PER_MINUTE'){
								if($durationVal > 1){
									$type = 'minutes';
								}
								else{
									$type = 'minute';
								}
							}
							else if($pricingData[0]["price_type"] == 'PER_HOUR'){
								if($durationVal > 1){
									$type = 'hours';
								}
								else{
									$type = 'hour';
								}
							}
							else if($pricingData[0]["price_type"] == 'PER_DAY'){
								if($durationVal > 1){
									$type = 'days';
								}
								else{
									$type = 'day';
								}
							}
							
							if(isset($_POST["durationValue"])){
								$duration = $_POST["durationValue"];
							}
							else{
								$duration = $durationVal;
							}
					?>
                     <p><b>Duration:</b> <?php echo $duration; ?> <?php echo $type; ?></p>
					<?php 
						$_SESSION['duration'] = $duration.' '.$type;
						}
					?>

					<?php                         
						$sum = 0;
						foreach($postedData["participants"] as $key=>$value){
							if($value == ''){
								$value = 0;
								$quantity = 0;
							}
							else{
								$quantity = $value;
							}
							if($pricingData[0]["price_type"] == 'PER_DAY' || $pricingData[0]["price_type"] == 'PER_MINUTE' || $pricingData[0]["price_type"] == 'PER_HOUR'){
								
								if($schedulingData["bookingMode"] != 'INVENTORY'){
									if($schedulingData["durationType"] == 'Any'){
										if(isset($_SESSION['duration'])){
											$duration = explode(" ",$_SESSION['duration']);
											$value = $duration[0];
										}
										else if(isset($_SESSION["durationValue"])){
											$value = $_SESSION["durationValue"];
										}
										else{
											$value = 1;
										}
									}
									else{
										$DurationOption = unserialize($schedulingData["DurationOption"]);
										$value = $DurationOption['durationValue'];
									}
								}
							}
							$key = explode("|",$key);
							$schedulingPriceData = array();
							if($schedulingData["bookingMode"] == 'INVENTORY'){
								$schedulingDataPrice = getSchedulingDataPrice(isset($postedData['session-date'])?$postedData['session-date']:$postedData['booking-on'],$postedData['listing_id']);
								$schedulingDataPrice = unserialize($schedulingDataPrice);
								foreach($schedulingDataPrice as $data){
									if(isset($data['schedulePrice']) && $data['schedulePrice'] != ''){
										$schedulingPriceData[$data['schedulePrice']] = $data['title'];
									}
									else if(isset($data['price']) && $data['price'] != ''){
										$schedulingPriceData[$data['price']] = $data['price_option_type'];
									}
									else{
										$schedulingPriceData[$data['basePrice']] = $data['title'];
									}
								}
							}
							if($pricingData[0]['price_type'] == 'PER_MINUTE'){
								if($pricingData[0]['price_group_type'] == 'EACH'){
									if(count($schedulingPriceData)>0){
					/* 								$basePrice = array_search($key[0],$schedulingPriceData);
										$amount = $basePrice*$value;
										$textLabel = $basePrice; */
										$amount = $key[1]*$value*$quantity;
										$textLabel = $key[1];
									}
									else{
										$amount = $key[1]*$value*$quantity;
										$textLabel = $key[1];
									}
								}
								else{
									if(count($schedulingPriceData)>0){
					/* 								$basePrice = array_search($key[0],$schedulingPriceData);
										$amount = $basePrice*$value;
										$textLabel = $basePrice; */
										$amount = $key[1]*$value*$quantity;
										$textLabel = $key[1];
									}
									else{
										$amount = $key[1]*$value*$quantity;
										$textLabel = $key[1];
									}
								}
							}
							else if($pricingData[0]['price_type'] == 'PER_HOUR'){
								if($pricingData[0]['price_group_type'] == 'EACH'){
									if(count($schedulingPriceData)>0){
					/* 								$basePrice = array_search($key[0],$schedulingPriceData);
										$amount = $basePrice*$value;
										$textLabel = $basePrice; */
										$amount = $key[1]*$value*$quantity;
										$textLabel = $key[1];
									}
									else{
										$amount = $key[1]*$value*$quantity;
										$textLabel = $key[1];
									}
								}
								else{
									if(count($schedulingPriceData)>0){
					/* 								$basePrice = array_search($key[0],$schedulingPriceData);
										$amount = $basePrice*$value;
										$textLabel = $basePrice; */
										$amount = $key[1]*$value*$quantity;
										$textLabel = $key[1];
									}
									else{
										$amount = $key[1]*$value*$quantity;
										$textLabel = $key[1];
									}
								}
							}
							else if($pricingData[0]['price_type'] == 'PER_DAY'){
								if($pricingData[0]['price_group_type'] == 'EACH'){
									if(count($schedulingPriceData)>0){
					/* 								$basePrice = array_search($key[0],$schedulingPriceData);
										$amount = $basePrice*$value;
										$textLabel = $basePrice; */
										$amount = $key[1]*$value*$quantity;
										$textLabel = $key[1];
									}
									else{
										$amount = $key[1]*$value*$quantity;
										$textLabel = $key[1];
									}
								}
								else{
									if(count($schedulingPriceData)>0){
					/* 								$basePrice = array_search($key[0],$schedulingPriceData);
										$amount = $basePrice*$value;
										$textLabel = $basePrice; */
										$amount = $key[1]*$value*$quantity;
										$textLabel = $key[1];
									}
									else{
										$amount = $key[1]*$value*$quantity;
										$textLabel = $key[1];
									}
								}
							}
							else if($pricingData[0]['price_type'] == 'PER_PERSON'){
								foreach($pricingData as $price){

									if($key[0] == 'group' && $price['price_group_type'] == 'per-person'){
										if(count($schedulingPriceData)>0){
											$basePrice = array_search($key[0],$schedulingPriceData);
											if($basePrice){
												$amount = $basePrice*$value;
												$textLabel = $basePrice;
											}
											else{
												$amount = $key[1]*$value;
												$textLabel = $key[1];								
											}
										}
										else{
											$amount = $key[1]*$value;
											$textLabel = $key[1];
										}
									}
									else if($key[0] == 'group' && $price['price_group_type'] == 'TOTAL'){
										if(count($schedulingPriceData)>0){
											$basePrice = array_search($key[0],$schedulingPriceData);
											if($basePrice){
												$amount = $basePrice*$value;
												$textLabel = $basePrice;
											}
											else{
												$amount = $key[1]*$value;
												$textLabel = $key[1];								
											}
										}
										else{
											$amount = $key[1]*$value;
											$textLabel = $key[1];
										}
									}
									else if($key[0] != 'group'){
										if(count($schedulingPriceData)>0){
											$basePrice = array_search($key[0],$schedulingPriceData);
											if($basePrice){
												$amount = $basePrice*$value;
												$textLabel = $basePrice;
											}
											else{
												$amount = $key[1]*$value;
												$textLabel = $key[1];								
											}
										}
										else{
											$amount = $key[1]*$value;
											$textLabel = $key[1];
										}
									}
								}
							}
							else if($pricingData[0]['price_type'] == 'FIXED'){
									if(count($schedulingPriceData)>0){
										$basePrice = array_search($key[1],$schedulingPriceData);
										if($basePrice){
											$amount = $basePrice*$value;
											$textLabel = $basePrice;
										}
										else{
											$amount = $key[1]*$value;
											$textLabel = $key[1];								
										}
									}
									else{
										$amount = $key[1]*$value;
										$textLabel = $key[1];
									}
							}
							else if($pricingData[0]['price_type'] == 'PER_ITEM'){
									if(count($schedulingPriceData)>0){
										$basePrice = array_search($key[1],$schedulingPriceData);
										if($basePrice){
											$amount = $basePrice*$value;
											$textLabel = $basePrice;
										}
										else{
											$amount = $key[1]*$value;
											$textLabel = $key[1];								
										}
									}
									else{
										$amount = $key[1]*$value;
										$textLabel = $key[1];
									}
							}
							
							$sum = $sum+$amount;
						}
					?>
					
					
                     <p><b>Additional Service Amount:</b> <?php echo ($_SESSION['additional-services-amount'])?'$'.$_SESSION['additional-services-amount']:'$0';?></p>
                     
                     <div class="grand-total">
                     <p>SUB TOTAL <span><?php echo '$'.($sum+$_SESSION['additional-services-amount']); ?></span></p>
					  <?php $_SESSION['sub_total']=$sum;?>
                     <p>SECURITY DEPOSIT <span>	
					 <?php
						$totalWithoutSecurity = $sum+$_SESSION['additional-services-amount'];
						if($rulesDetail["security_options"] == "amount_in_$"){
							$securityDeposit = ($rulesDetail["security_deposit"] != '')?$rulesDetail["security_deposit"]:0;
						}
						else{
							$securityDeposit = ($rulesDetail["security_deposit"] != '')?($totalWithoutSecurity*$rulesDetail["security_deposit"])/100:0;
						}
						echo '$'.$securityDeposit;
						
						$_SESSION['Security']=$securityDeposit;
					?>
					</span> </p>
                    <?php 
						$grandTotal = $sum+$_SESSION['additional-services-amount']+$_SESSION['Security'];
						$_SESSION['total_amount'] = $grandTotal;
					?>
				   <?php 
						$earlyDiscountAmt = $lastDiscountAmt = $dailyDiscountAmt = 0;
						$start = date('Y-m-d');
						$end = date('Y-m-d',strtotime($_SESSION['booking-on']));

/* 						$date1=date_create($start);
						$date2=date_create($end);
						$diff=date_diff($date1,$date2);
						$days = $diff->days; */
/* 						$diff = abs(strtotime($end) - strtotime($start));
						$years = floor($diff / (365*60*60*24));
						$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); */
						$days = round(abs(strtotime($end) - strtotime($start))/86400);

						$hours = $days*24;
						$weeks = floor($days / 7);
						$months = floor($days / 30.5);
						if(!empty($offers)){
							foreach($offers as $offer){
								if($offer['offer_type'] == '24 Hour Offer'){
									$dates = unserialize($offer['date']);
									$discount = unserialize($offer['amount']);

									if($dates["offer_24_hour_offer_date"] == date('Y-m-d')){
										if($offer["discount_by"] == '%'){
											$dailyDiscountAmt = ($grandTotal*$discount['offer_24_hour_price_value'])/100;
										}
										else{
											$dailyDiscountAmt = $discount['offer_24_hour_price_value'];
										}
									}
									foreach($dates["24_hour_offer_date_extra"] as $key=>$value){
										if($value == date('Y-m-d')){
											if($offer["discount_by"] == '%'){
												$dailyDiscountAmt = ($grandTotal*$discount['24_hour_offer_price_value_extra'][$key])/100;
											}
											else{
												$dailyDiscountAmt = $discount['24_hour_offer_price_value_extra'][$key];
											}											
										}
									}
								}
								if($offer['offer_type'] == 'Early Birds'){
									$timeKey = $offer['time_key'];
									$timeValue = $offer['time_value'];
									if($timeKey == 'day'){
										if($days >= $timeValue){
											if($offer["discount_by"] == '%'){
												$earlyDiscountAmt = ($grandTotal*$offer['amount'])/100;
											}
											else{
												$earlyDiscountAmt = $offer['amount'];
											}											
										}										
									}
									else if($timeKey == 'week'){
										if($weeks >= $timeValue){
											if($offer["discount_by"] == '%'){
												$earlyDiscountAmt = ($grandTotal*$offer['amount'])/100;
											}
											else{
												$earlyDiscountAmt = $offer['amount'];
											}											
										}
									}
									else{
										if($months >= $timeValue){
											if($offer["discount_by"] == '%'){
												$earlyDiscountAmt = ($grandTotal*$offer['amount'])/100;
											}
											else{
												$earlyDiscountAmt = $offer['amount'];
											}											
										}									
									}
								}
								if($offer['offer_type'] == 'Last Minute'){
									$timeKey = $offer['time_key'];
									$timeValue = $offer['time_value'];	
									if($timeKey == 'day'){
										if($days >= $timeValue){
											if($offer["discount_by"] == '%'){
												$lastDiscountAmt = ($grandTotal*$offer['amount'])/100;
											}
											else{
												$lastDiscountAmt = $offer['amount'];
											}											
										}										
									}
									else{
										if($hours >= $timeValue){
											if($offer["discount_by"] == '%'){
												$lastDiscountAmt = ($grandTotal*$offer['amount'])/100;
											}
											else{
												$lastDiscountAmt = $offer['amount'];
											}											
										}									
									}									
								}
							}

							if($dailyDiscountAmt){
								$_SESSION['discount'] = $dailyDiscountAmt;
							}
							else{
								if($weeks < 1){
									if(($dailyDiscountAmt) && ($dailyDiscountAmt>$lastDiscountAmt)){
										$_SESSION['discount'] = $dailyDiscountAmt;
									}
									else{
										$_SESSION['discount'] = $lastDiscountAmt;
									}
								}
								else{
									if($weeks == 1){
										if(($lastDiscountAmt) && ($lastDiscountAmt>$earlyDiscountAmt)){
											$_SESSION['discount'] = $lastDiscountAmt;
										}
										else{
											$_SESSION['discount'] = $earlyDiscountAmt;
										}
									}
									else{
										$_SESSION['discount'] = $earlyDiscountAmt;
									}
								}
							}
							$_SESSION['total_amount'] = $grandTotal-$discountAmt;
							if($_SESSION['discount']){
					?>
								<p>Discount <span>(-)<?php  echo '$'.($_SESSION['discount']);?></span>  </p>
					<?php
							}
						}
					?>					 
					 <p>GROSS TOTAL <span><?php  echo '$'.($grandTotal-$_SESSION['discount']);?></span>  </p>
                        
                    </div>
                    <div class="booking-confermation">
                    	<p>As soon as you will complete your payment your reservation will be confirmed</p>
                    </div>
                    </div>
                
                        <div class="side-map">
                        <img alt="Google Static Map" src="http://maps.googleapis.com/maps/api/staticmap?center=<?php echo $OverviewData['latitude'].','.$OverviewData['longitude'];?>&zoom=16&scale=false&size=350x250&maptype=roadmap&sensor=false&format=png&visual_refresh=true&markers=color:red|<?php echo $OverviewData['latitude'].','.$OverviewData['longitude'];?>">
                        </div>
                
                </div>
        		 
                
                 
                        
            </div>    
         </div>
            
 <script>
 function validate_booking()
{
	if(!jQuery('input[type=checkbox]:checked').length) {  
		  
		jQuery(".error-message").remove();	 	  
		jQuery(".form-type-checkbox").append('<div class="error-message"><span>Please Accept Terms and Conditions</span></div>');
		 return false;
	} else {
		jQuery(".error-message").remove();	 	  
		return true;
	}
}

 jQuery(function() {
 if(jQuery(".form-item-payment-type select").val()=="credit-card")
 {
 jQuery(".credit-card-details").show();
 }
 else{
  jQuery(".credit-card-details").hide();
 }
 jQuery(".form-item-payment-type select").change(function()
 {
 if(jQuery(".form-item-payment-type select").val()=="credit-card")
 {
 jQuery(".credit-card-details").show();
 }
 else{
  jQuery(".credit-card-details").hide();
 }
 });
 
 /* if(jQuery("#edit-terms-checkbox-terms").is(":checked"))  
{
  jQuery('#edit-submit').removeAttr('disabled');
}
else
{
  jQuery('#edit-submit').attr('disabled','disabled');
}
 jQuery("#edit-terms-checkbox-terms").click(function(){
    if(jQuery("#edit-terms-checkbox-terms").is(":checked"))  
  {
  jQuery('#edit-submit').removeAttr('disabled');
  }
  else
  {
  jQuery('#edit-submit').attr('disabled','disabled');
  }

});  */

/******************************************************************************/
jQuery("#booking-details-form").validate({
		rules: {
		    first_name :"required",
			last_name: "required",
			city: "required",
			country: "required",
			//state: "required",
			zipcode: "required",
			phone_number:{
			required: true,
			digits: true,
			minlength: 10,			
			},        			
			email:{
			required: true,
			email: true
			},	
		
						
		},
		submitHandler: function(form) {
			if(validate_booking()){
				jQuery('#edit-submit').attr('disabled','disabled');
				form.submit();		 
			}
			return false;
		}
});		
 });
 </script>
  
  	 
  
  