<?php
global $user,$base_url;$front_end_theme_common_path='gloobers_new';drupal_add_css(drupal_get_path('theme', $GLOBALS['theme']) .'/css/colorbox.css','file');$Common_part_from_frontENd='gloobers_new';?>
<div class="dm-dashboard-wrapper mytrips">
<h2 class="pagehead">My Trips</h2>
<p class="subtitle">Your next journey starts here</p>
<?php
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/stylesheet/for-head-foot.css','file');
$userdetails=user_load($user->uid);
$username = $userdetails->field_first_name["und"][0]["value"] .' '.$userdetails->field_last_name["und"][0]["value"];
//echo "<pre>";print_r($userdetails);die;
$subtotal_counting=array();
//print'<div class="search-list-booking view-customer">';
//echo drupal_render($searchForm);
//print '</div>';
if($bookingsCount>0)
{
?>
<div class="col-lg-12">
 <div class="main-box clearfix">
	<div class="main-box-header clearfix">
				  <h2 class="pull-left">Booking Details (<?php echo $bookingsCount;?> Results Found)</h2>
	</div>
<div class="main-box-body clearfix">
              <div class="table-responsive clearfix">
                <table class="table table-hover">
                  <thead>
                    <tr> 
                      <th>Sr.no</th>					
                      <th><span>Booking Id</span></th>
                      <th><span>Deal Title</span></th>
                      <th><span>Amount</span></th>
                      <th class="text-center"><span>Booking Status</span></th>
                      <th class="text-center"><span>Check in Date</span></th>
					  <th class="text-right">Booking detail</th>
            
                    </tr>
                  </thead>
                  <tbody>
				  <?php
				  if(isset($_GET['page']))
				  {
				  $pageno=$_GET['page'];
				  $noOfRecords=10;
				  $i=$noOfRecords*$pageno+1;
				  }
				  else
				  {
				  $i=1;
				  }
				  foreach($bookings as $booking)
				  {

				  $userDetail_book=user_load($booking['uid']);
				  $listing_id=$booking['lid'];
				  $OverviewData = getOverviewData($listing_id);
				  $userDetails=user_load($OverviewData['uid']);
				
				  $Get_user_pass=get_user_passeport_hometown();
				  $totalRefundAmount=$commission=$refundpercent=0;
				  $policyinfo="";
				  $pricingData = getPricingData($booking['lid']);
				  $photosData=getPhotosData($booking['lid']);
				  $schedulingData=getSchedulingData($booking['lid']);
				  $rulesDetail=getRulesDetails($booking['lid']);
	              $rulesDetail=unserialize($rulesDetail["value1"]);
				  $comm=getCommisionByuserForBooking($booking['lid']);
				  
				  if($comm['commission']!="")
					{
					$commission=$comm['commission'];
					}
					else if(variable_get('commission')!="")
					{
					$commission=variable_get('commission');
					}
					else
					{
					$commission="0.0";
					}
				  $policyType=$rulesDetail['cancellation_policies_type'];
				
				  $Currentdatetime=date("Y-m-d H:i:s");
				  $arrivalDate = date("Y-m-d",strtotime($booking['arrive_at_date']));
				  $arrivalTime=$booking['arrive_at_time'];
	
				  $pos= strpos($arrivalTime,"-");
				  if($pos>0)
				  {
				  $arrivalTime=substr_replace($arrivalTime, '', $pos,-2);
				  }
				  $time_in_24_hour_format  = date("H:i", strtotime($arrivalTime));
				  $arrivaldatetime=date('Y-m-d H:i:s', strtotime($arrivalDate."".$time_in_24_hour_format));
				  $refundAmount=((100-$commission)*$booking['grand_total'])/100;
				  switch($policyType)
				  {
				  case 'Relaxed':
				  $expiredDate=date('Y-m-d H:i:s', strtotime($arrivaldatetime. ' - 14 day'));
				  if(strtotime($expiredDate) >= strtotime($Currentdatetime))
				  {	
				  $refundpercent=100; 
				  $totalRefundAmount=$refundAmount;
				  }
				  $policyinfo='Guests will receive a full refund if they cancel at least two weeks before the start of their reservation.';
				  break;
				  case 'Flexible':
					  $expiredDate=date('Y-m-d H:i:s', strtotime($arrivaldatetime. ' - 14 day'));
					  $expiredDate_4Weeks=date('Y-m-d H:i:s', strtotime($arrivaldatetime. ' - 28 day'));				  
					  if(strtotime($expiredDate) >= strtotime($Currentdatetime))
					  {	
					  $refundpercent=25; 				  
					  $totalRefundAmount=($refundpercent*$refundAmount)/100;
					  }
					  else if(strtotime($expiredDate_4Weeks) >= strtotime($Currentdatetime))
					  {
					  $refundpercent=50;
					  $totalRefundAmount=($refundpercent*$refundAmount)/100;
					  }
				  $policyinfo='A 50% refund of their paid rental costs if they cancel at least four weeks before the start of their reservation OR<br>A 25% refund of their paid rental costs if they cancel up to two weeks before the start of their reservation.';
				  break;
				  case 'Moderate':
					  $expiredDate_4Weeks=date('Y-m-d H:i:s', strtotime($arrivaldatetime. ' - 28 day'));
					  $refundpercent=50;
					  if(strtotime($expiredDate_4Weeks) >= strtotime($Currentdatetime))
					  {
					  $totalRefundAmount=($refundpercent*$refundAmount)/100;
					  }
				  $policyinfo='Guests will receive their full refundable deposit, a 50% refund of their paid rental costs, if they cancel at least four weeks before the start of their reservation.';
				  break;
				  case 'Strict':
					  $expiredDate_8Weeks=date('Y-m-d H:i:s', strtotime($arrivaldatetime. ' - 56 day'));
					  if(strtotime($expiredDate_8Weeks) >= strtotime($Currentdatetime))
					  {
					  $refundpercent=50;
					  $totalRefundAmount=($refundpercent*$refundAmount)/100;
					  }
				  $policyinfo='A 50% refund of their paid rental costs if they cancel at least eight weeks before the start of their reservation OR<br>A 25% refund of their paid rental costs if they cancel up to four weeks before the start of their reservation.';
				  break;
				  case 'Super-Strict':
				  $totalRefundAmount=0;
				  $refundpercent=0;
				  $policyinfo='If the guest cancels, any money they have paid cannot be refunded.';
				  break;
				  case 'Custom':
                  if(($rulesDetail['amount_week_select']=='weeks') || ($rulesDetail['amount_week_select']=='months'))
                  {				  
					  if($rulesDetail['amount_week_select']=='weeks')
					  {
					  $weeksCount=$rulesDetail['amount_week_rental']*7;
					  $expiredDate=date('Y-m-d H:i:s', strtotime($arrivaldatetime. ' - '.$weeksCount.' day'));						  				 
					  }
				   else if($rulesDetail['amount_week_select']=='months')
					  {
					  $expiredDate=date('Y-m-d H:i:s', strtotime($arrivaldatetime. ' - '.$rulesDetail['amount_week_rental'].' month'));
					  }
					if(strtotime($expiredDate) >= strtotime($Currentdatetime))
					   {
					   $refundpercent=$rulesDetail['amount_week'];
					   $totalRefundAmount=($refundpercent*$refundAmount)/100;
					   }		  
				  }
				  else if($rulesDetail['amount_day_select']=='days')
				  {
				  $expiredDate=date('Y-m-d H:i:s', strtotime($arrivaldatetime. ' - '.$rulesDetail['amount_day_rental'].' month'));
				  if(strtotime($expiredDate) >= strtotime($Currentdatetime))
				   {
				   $refundpercent=$rulesDetail['amount_day'];
				   $totalRefundAmount=($refundpercent*$refundAmount)/100;
				   }
				  }				  
				  $policyinfo='Guests will receive their full refundable deposit:<br>A '.$rulesDetail['amount_week'].'% refund of their paid rental costs if they cancel at least '.$rulesDetail['amount_week_rental']." ".$rulesDetail['amount_week_select'].' prior to reservation. OR <br>A '.$rulesDetail['amount_day'].' % refund of their paid rental costs if they cancel at least '.$rulesDetail['amount_day_rental']." ".$rulesDetail['amount_day_select'].' prior to reservation.';
				  break;
				  default:
				  $policyinfo="";
				  $totalRefundAmount=0;
				  break;
				  } 
				
					$booking_status=explode("_",$booking['booking_status']);
                    $bookingClass="";
                     switch($booking['booking_status'])
                     {
					  case "pending":		
			           $bookingClass='label-info';
		              break;
					  case "completed":		
			           $bookingClass='label-success';
		              break;
					  case "refund_request":		
			           $bookingClass='label-warning';
		              break;
					  case "refunded":		
			           $bookingClass='label-info';
		              break;
					  case "booked":		
			           $bookingClass='label-success';
		              break;
					  default:
					   $bookingClass="";
					   break;
					 } 
					//Print_r(unserialize($booking['quantity_details']));exit;
					 $quantityDetails=unserialize($booking['quantity_details']);
					 //echo "<pre>";Print_r($quantityDetails);exit;
				  
				  
				  ?>
                    <tr>
                      <td><?php echo $i;?></td>
                      <td><?php echo $booking['booking_id'];?></td>					 
					  <td><a href="<?php echo url('experience/'.$booking['lid']);?>"><?php echo $booking['title'];?></a></td>					  
                      <td><?php echo '$'.$booking['grand_total'];?></td>
                      <?php 
                      if(isset($booking_status[1])&&$booking_status[1]!="")
					  {
                      ?>					   
                      <td class="text-center"><span class="label <?php echo $bookingClass;?>"><?php echo ucwords($booking_status[0]." ".$booking_status[1]); ?></span></td>
                      <?php
					  }
					  else
					  {
					  ?>
					  <td class="text-center"><span class="label <?php echo $bookingClass;?>"><?php echo ucwords($booking_status[0]); ?></span></td>
					  <?php
					  }
					  ?>
					  <td class="text-center"><?php echo date("d, F Y",strtotime($booking['arrive_at_date']))." ".$booking['arrive_at_time']; ?></td>
                      <td  class="text-right">
					  <?php		
								  
					 if($totalRefundAmount>0 && $booking['booking_status']=='booked' )
					  {
					  ?>
					  <a class="table-link inline cboxElement cancel-booking" href="#cancelBooking<?php echo $booking['id'];?>">Cancel Booking</a>
			    <?php } ?>
					  <a class="table-link inline" href="#details<?php echo $booking['id'];?>">View booking details  </a></td>
                    </tr>
					 <div class="Cancel_Form" style='display:none'>
						<section id="cancelBooking<?php echo $booking['id'];?>" class="cancel_popup cancelBooking"> 
						<div class="">
						<div class="">
						<div class="cancel_popup_main">
						<div class="cancel_popup_title col-sm-12">
						<h4> Cancel reservation </h4>
						 </div>
						 <div class="cancel-content"> 
						 <div class="cancel-left-section-content">
						 <div class="col-sm-5"> 
						 <p><span>Amount Paid : </span><?php echo ' $'.sprintf("%.2f",$booking['grand_total']);?></p>
						 <p><span>Gloobers Commission :</span><?php $commissonAmount=$commission*$booking['grand_total'];echo "(-)".'$'.sprintf("%.2f",(($commissonAmount)/100));?></p>
						 <p><span>Net Amount :</span><?php echo " $".sprintf("%.2f",$refundAmount); ?></p>
						 <p><span>Refund Amount :</span>(<?php echo  $refundpercent.'%'." x "." $".sprintf("%.2f",$refundAmount);?>)<?php echo "=$".sprintf("%.2f",$totalRefundAmount);?></p>
						</div>
						 </div>
						  <div class="col-sm-7">
						   <div class="cancel-right-section-content">
						   <?php //echo drupal_render($cancelForm); ?>	

			<!--- CUSTOM FORM-->
			<!-- <form method="post"> -->
			<div><input type="hidden" value="641" name="bid" class="bid">
			<input type="hidden" value="192" name="lid" class="lid">
			<div class="form-item form-type-textarea form-item-cancel-request">
			<label for="edit-cancel-request">Reason for cancellation </label>
			<div class="form-textarea-wrapper resizable textarea-processed resizable-textarea"><textarea rows="5" cols="60" name="cancel_request" id="edit-cancel-request" placeholder="I got better deal" class="form-control form-textarea cancel-text-<?php echo $booking['id']; ?>"></textarea><div class="grippie"></div></div>
			</div>
			<input type="submit" class="form-submit" value="Proceed" name="op" id="edit-submit" onClick="booking_cancel(<?php echo $booking['id'].','.$booking['lid']; ?>);"><input type="hidden" value="form-Qr-FARAG1tT9Ow144MQN_7s-TikRoHPIdJMKlJYEIzc" name="form_build_id" >
			<input type="hidden" value="I5IVvJoYxmKKNPIdDJF6Esec5mC8HD7AajhyXt5u7c4" name="form_token">
			<input type="hidden" value="cancel_request_form" name="form_id">
			</div>
			<!-- </form> -->

			<!--CUSTOM FORM ENDS-->

						   </div>
						</div>
						 </div>
						 </div>
						</div>
						</div>
						</section>
			
					 <script type="text/javascript">
						var jq = jQuery.noConflict();
						jq(document).ready(function(){
						jq('#cancelBooking<?php echo $booking['id'];?>').find(".bid").val(<?php echo $booking['id']; ?>);
						jq('#cancelBooking<?php echo $booking['id'];?>').find(".lid").val(<?php echo $booking['lid']; ?>);
						});
					 </script>
					  <div  class="booking-details" id='details<?php echo $booking['id']; ?>' style='padding:10px; background:#fff;'>
					<section class="">
<div class="">
<div class="">
<!-- Resrvation pop HTML start here --> 
 <div class="reservation_popup_main">
 <div class="reservation_popup_title row">
  <div class="reservation_popup_title_left col-sm-4">
   <h4><?php if (!empty($username)){ echo ucwords($username);} ?></h4>
  </div>
  <div class="reservation_popup_title_right col-sm-8">
   <h4>Reservation Summary</h4>
  </div>
 </div>
 <div class="reservation_popup_content row">
  <div class="img-section col-sm-3">
  <?php 
		$OverviewData = getOverviewData($booking['lid']);
		$file = file_load($OverviewData['main_img_fid']);
        $imgpath = $file->uri;                
        $reservation_popup_listing_img = 'reservation_popup_listing_img';
  
  if(!empty($OverviewData['main_img_fid'])){ ?>
  
		<img  src="<?php print image_style_url($reservation_popup_listing_img, $imgpath); ?>" alt="place" onerror="this.onerror=null;this.src='<?php echo $base_url . '/' . drupal_get_path('theme', 'gloobers_new') . '/images/default_images/banner-thumb_img.jpg'; ?>'" />

  <?php }else if(!empty($photosData[0])){ 
			$ImagePopup=unserialize($photosData[0]['value1']);
			$fileId=$ImagePopup['fid'];
			$filePopup = file_load($fileId);
			$filePopupURI = $filePopup->uri;   
?>
	<img  src="<?php print image_style_url($reservation_popup_listing_img, $filePopupURI); ?>" alt="place" onerror="this.onerror=null;this.src='<?php echo $base_url . '/' . drupal_get_path('theme', 'gloobers_new') . '/images/default_images/banner-thumb_img.jpg'; ?>'" />
  
<?php }else{ 
  ?>
		<img src="<?php print $base_url.'/'.drupal_get_path('theme','gloobers_new').'/images/default_images/banner-listing_img.jpg'; ?>" alt="listing-image" width="100%" height="121px;" onerror="this.onerror=null;this.src='<?php echo $base_url . '/' . drupal_get_path('theme', 'gloobers_new') . '/images/default_images/banner-thumb_img.jpg'; ?>'" >
<?php
		} ?>
  </div>
  <div class="col-sm-4">
   <h5><span class="linkprop"><?php echo ucwords($booking['title']);?></span></h5>  
   <p><?php $listing_addrss=''; if($booking['address1']){$listing_addrss .= $booking['address1'].',';}if($booking['city']){$listing_addrss .= $booking['city'].',';}if($booking['state']){$listing_addrss .= $booking['state'].',';}if($booking['country']){$listing_addrss .= $booking['country'].',';}if($booking['zipcode']){$listing_addrss .= $booking['zipcode'];} echo rtrim($listing_addrss,','); //echo $Get_user_pass; ?></p>
  </div>
  <div class="col-sm-3">
      <h5>Date</h5>
   <p>
   <?php if($booking['arrive_at_date']!=""){ ?>
  
     <label>Arrival Date</label>
	<?php echo date("d, F Y",strtotime($booking['arrive_at_date']))." ".$booking['arrive_at_time'];?>
   
   <?php }  ?>
    </p><p>
   <?php
	if(isset($otherDetails['check-out-date']) || isset($otherDetails['check-out-time'])){ ?> 						 
    
     <label>Departure Date</label>
     <p><?php echo $otherDetails['check-out-date']." ".$otherDetails['check-out-time']; ?></p>
   
   
	<?php } ?>
   </p> 
  </div>
  <div class="col-sm-2">
  <?php

	$Travelers_title ="Items";

	if (array_key_exists('Adult', $quantityDetails) || array_key_exists('Child', $quantityDetails)) {
	$Travelers_title ="Travelers";
	}

  ?>
        <h5><?php echo $Travelers_title; ?></h5>
		
   <p>
   <?php
	$total_qty=array();
	foreach($quantityDetails as  $key=>$value){
								
		$total_qty[]=$value['qty'];
	}
	$total_qty=array_sum($total_qty);
	if($Travelers_title=="Travelers"){
		echo $total_qty.' x <i class="fa fa-user"></i><br/>';
	}	
	foreach($quantityDetails as  $key=>$value){
		echo $value['qty'].' '.$key.'<br/>';
	}
	?>
</p>
  </div>
 </div>
 <?php  
		$profile_pic_id=$userDetail_book->picture->fid;
		$profile_pic=file_load($profile_pic_id);
		$DP_url=$profile_pic->uri;
 ?>
 <div class="row">
  <div class="col-sm-6">
   <div class="reservation_contact_title">
    <h4>Contact</h4>
   </div>
   <div class="reservation_contact_content">
    <div class="row">
     <div class="col-sm-4">
      <div class="reservation_contact_img">
	  <?php   if(!empty($DP_url)){

	  	$style = "homepage_header";
	   print '<a href="/profile/'.$userDetail_book->uid.'" target="_blank"><img class="img-responsive img-circle" src="' . image_style_url($style, $DP_url) . '"></a>';
	  ?>			
		<?php    }else{  ?>
			<img class="img-responsive img-circle"  src="<?php echo $base_url . '/' . drupal_get_path('theme', $Common_part_from_frontENd) . '/images/no-profile-male-img.jpg'; ?>" alt="place" />
	  
		<?php   }  ?>
	  
	  </div>
     </div>
     <div class="col-sm-8">
      <div class="reservation_contact_inner">
       <p class="text-center"><span class="copycol_blue"><?php echo $userDetail_book->field_first_name['und'][0]['value'].' '.$userDetail_book->field_last_name['und'][0]['value']; ?></span><br/>
     <?php echo $userDetails->field_phone_number['und'][0]['value'];  ?><br/>
      <?php $about_urself=$userDetails->field_about_yourself['und'][0]['value'];
     echo (strlen($about_urself) <= 90 ? $about_urself : substr($about_urself, 0,90).'...');
      ?></p>
      </div>
     </div>
    </div>
    <div class="row">
     <div class="col-sm-12">
      <div class="reservation_contact_inner">
       <h5>Cancellation policy</h5>
       <?php 
		 if(empty($policyType)){
			$policyType="No cancellation policy is available";
		} else {
			$policyType = $policyType.':';
		}

		if(empty($policyinfo)){
			$policyinfo="";
		}

		?>
       <p class="text-center"><?php echo $policyType.'</b>'.$policyinfo;?></p>
      </div>
     </div>
    </div>
   </div>
  </div>
  <div class="col-sm-6">
   <div class="additional_services">
    
	
	<?php
	
	$additionalSum = 0;
	$extras = getProductExtraData($booking['lid']);
	if($booking["additional_services"]){
	
		$additional =unserialize($booking["additional_services"]);
	?>
	<div class="additional_services_inner">
	<h4>Additional Services</h4>
	<?php foreach($additional as $addition){ ?>
		  
			
			<div class="additional_services_list row">
			 <div class="col-xs-9 col-sm-10">
			 <p><?php echo $addition["title"]; ?></p>
			 </div>
			 <div class="col-xs-3 col-sm-2">
			 <p><?php  echo ($pricingData[0]['currency_type'])?$pricingData[0]['currency_type']:'$'.$addition["price"]*$addition['qty']; ?></p>
			 </div>
			</div>
		   
					
								
		  <?php } 
			echo "</div>";
		} ?>
   
    <div class="additional_services_inner">
     <h4>Deposit</h4>
     <div class="additional_services_list row">
     <div class="col-xs-9 col-sm-10">
     <p>Gloobers will retrieve this deposit only if a reclaim is open</p>
     </div>
     <div class="col-xs-3 col-sm-2">
       <p>$<?php echo isset($booking['security'])&& !empty($booking['security'])?$booking['security']:'0';?></p>
     </div>
    </div>
    </div>
<div class="additional_services_inner">
     <h4>Total Amount</h4>

     <div class="additional_services_list row">
	 <?php    
								$sum = 0;
								foreach($quantityDetails as $key=>$value){
								
									if($pricingData[0]["price_type"] == 'PER_DAY' || $pricingData[0]["price_type"] == 'PER_MINUTE' || $pricingData[0]["price_type"] == 'PER_HOUR'){
										
										if($schedulingData["bookingMode"] != 'INVENTORY'){
											if($schedulingData["durationType"] == 'Any'){
												if($otherDetails["duration"]){
													$duration = explode(" ",$otherDetails["duration"]);
													$value = $duration[0];
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
									$schedulingPriceData = array();
									if($schedulingData["bookingMode"] == 'INVENTORY'){
										$schedulingDataPrice = getSchedulingDataPrice(isset($otherDetails['session-date'])?$otherDetails['session-date']:$booking['arrive_at_date'],$booking['lid']);
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
								
								if($pricingData[0]['price_type'] == 'PER_PERSON'){
										
											$amount=$value['qty']*$value['price'];
											$subtotal_counting[]=$amount;
							?>
								<div class="col-xs-9 col-sm-10">
								 <p><?php echo  $key; ?></p>
								 </div>
								 <div class="col-xs-3 col-sm-2">
								 <p>$<?php echo $amount; ?></p>
								 </div>	
							<?php
									}
									else if($pricingData[0]['price_type'] == 'FIXED'){
											
											$amount=$value['price'];
											$subtotal_counting[]=$amount;
							?>
									 <div class="col-xs-9 col-sm-10">
									 <p><?php echo  $key; ?></p>
									 </div>
									 <div class="col-xs-3 col-sm-2">
									 <p>$<?php echo $amount; ?></p>
									 </div>	
							<?php 
									}
									else if($pricingData[0]['price_type'] == 'PER_ITEM'){
											$amount=$value['qty']*$value['price'];
											$subtotal_counting[]=$amount;
							?>
									 <div class="col-xs-9 col-sm-10">
									 <p><?php echo  $key; ?></p>
									 </div>
									 <div class="col-xs-3 col-sm-2">
									 <p>$<?php echo $amount; ?></p>
									 </div>	
							<?php 
									}
								}
							?>
								<?php
								
								if($booking['additional_cost'])
								{
								?>
								<div class="col-xs-9 col-sm-10">
								<p>Additional Charges</p>
								</div>
								<div class="col-xs-3 col-sm-2">
								<p><?php echo '$'.$booking['additional_cost'];?></p>
								</div>
								<?php
								 
								 }
								
								?>
								<div class="col-xs-9 col-sm-10">
                                	<p>Total cost:</p></div>
                                     <div class="col-xs-3 col-sm-2"><p>$<?php echo $booking['total_cost'];?></p> 
                                </div>
								<div class="col-xs-9 col-sm-10">
                                	<p>Gloobers services tax(3%) :</p></div>
                                     <div class="col-xs-3 col-sm-2"><p>$<?php echo $booking['service_tax'];?></p> 
                                </div>
								
								<?php
								
								if($booking['discount'])
								{
								?>
								<div class="col-xs-9 col-sm-10">
                                	<p>Discount</p></div>
                                     <div class="col-xs-3 col-sm-2"><p>(-)<?php echo ($booking['discount'])?'$'.$booking['discount']:'$0';?></p> 
                                </div><!-- row ends -->
								<?php
								}
								?>								
							</div>
     
    </div>
 
						
                </div>
    <div class="additional_services_inner">
     <div class="additional_services_list">
      <div class="total_price">
		<?php 

		$subtotal = array_sum($subtotal_counting); 
		$discount = $booking['discount'];
       	$additional_cost = $booking['additional_cost'];
       	//$result = ((($subtotal+$additional_cost) - $discount));	
       	$result= $booking['grand_total'];
      ?>
		 <div class="col-xs-9 col-sm-10 padding_left padding_right">
          <h4 class="text-left">Grand Total:</h4>
		  </div>
          <div class="col-xs-3 col-sm-2 padding_left padding_right">
		  <h4 class="text-right"><?php echo '$'.$result; unset($subtotal_counting);?></h4>
		  </div>
		</div>
     </div>
    </div>
   </div>
  </div>
 </div>
 </div>
<!-- Resrvation pop HTML start here -->
</div>
</div>
</section>
					</div>

			</div>
			</div>

			<script>
				var jq = jQuery.noConflict();
                jq(document).ready(function(){
					jq(".inline").colorbox({inline:true, width:"50%"});
				});
			</script>
					
				<?php
                	$i++;
				}			
                ?>	                  
                    
                  </tbody>
                </table>
              </div>
            </div>
		</div>
	</div>
 </div>	
<div class="pagination"><?php echo $pagination;?></div> 
<?php
}
else
{
print '<div class="no-results"><p>You haven\'t any trip yet.</p></div>';
}
?>
</div>
<script type="text/javascript" src="<?php echo $GLOBALS['base_url'].'/'.drupal_get_path('theme', $front_end_theme_common_path); ?>/js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['base_url'].'/'.drupal_get_path('theme', $front_end_theme_common_path); ?>/js/jquery.selectbox-0.2.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
	$(".select_box").selectbox();
});
</script>


<script type="text/javascript">
jQuery(window).load(function(){

	var checkin = jQuery("#edit-search-filter").datepicker({
	format:"yyyy-mm-dd",
	  onRender: function() {
	   // return date.valueOf() < now.valueOf() ? 'disabled' : '';
	  }
	}).on('changeDate', function(ev) {  
	  checkin.hide();
	  
	}).data('datepicker');

});

</script>

<script>

function booking_cancel(bid,lid){

		console.log(jQuery('.cancel-text-'+bid).val());

		jQuery.ajax({

		type: "POST",

		url: "<?php echo $base_url; ?>/mytrips/cancel_booking/",

		data: "bid="+bid+"&lid="+lid+"&text_msg="+jQuery('.cancel-text-'+bid).val(),

		success: function(msg){		
			
			if(msg){
				location.reload();
			}
		}

		});

}
</script>