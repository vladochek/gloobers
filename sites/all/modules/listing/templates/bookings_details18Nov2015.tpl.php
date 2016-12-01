<?php

global $base_url,$user;

drupal_add_css(drupal_get_path('theme', 'gloobers2') .'/css/colorbox.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/stylesheet/for-head-foot.css','file');
drupal_add_js(drupal_get_path('theme', 'gloobers2') .'/js/jquery.colorbox.js',array('scope' => 'footer'));
?>

<div class="dm-dashboard-wrapper">

<h2>My Reservations</h2>

<?php

$userDetails=user_load($user->uid);

//echo "<pre>";Print_r($userDetails);exit;

print'<div class="search-list-booking">';

//$searchForm=drupal_get_form('search_listing_form');

echo drupal_render($searchForm);

print '</div>';

if(count($bookings)>0)

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

                      <th><span>Deal Title</span></th>

                      <th><span>Booked By</span></th>

                      <th><span>Amount Paid</span></th>

					  <th><span>Commisson</span></th>

                      <th><span>Site Earned</span></th>

                      <th><span>Owner Earned</span></th>

                      <th class="text-center"><span>Booking Status</span></th>

                      <th class="text-center"><span>Booking Date</span></th>

                      <th class="text-right">View Details</th>

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

				  //echo "<pre>";Print_r($bookings);exit;

				  foreach($bookings as $booking)

				  {

				 

					$otherDetails=unserialize($booking['other_details']);

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

				  

				  $travellerInfo=user_load($booking['uid']);

				  $extras = getProductExtraData($booking['lid']);

				  //echo "<pre>";Print_r($travellerInfo);exit;

				 

				  $pricingData = getPricingData($booking['lid']);
				  $rulesDetail=getRulesDetails($booking['lid']);
	              $rulesDetail=unserialize($rulesDetail["value1"]);

				  $schedulingData=getSchedulingData($booking['lid']);

					  if($travellerInfo->field_first_name["und"][0]["value"] != ""){

							$travellername=ucwords($travellerInfo->field_first_name["und"][0]["value"]."   ".$travellerInfo->field_last_name["und"][0]["value"]);

								}

							else{

							$travellername =ucwords($travellerInfo->name);

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

					 $quantityDetails=unserialize($booking['quantity_details']);

					 

					/* echo "<pre>";

					 print_r($quantityDetails);exit; */

				  $siteProfit=($commission*$booking['grand_total'])/100;

				  $ownerProfit=((100-$commission)*$booking['grand_total'])/100;

				  ?>

                    <tr>

					<td><?php echo $i;?></td>

                      <td><a href="<?php echo $base_url.'/experience/'.$booking['eid'];?>"><?php echo ucfirst($booking['title']); ?></a></td>

                      <td><a href="<?php echo $base_url ?>/profile/<?php echo $travellerInfo->uid; ?>"><?php echo $travellername;?></a></td>

                      <td><?php echo ($booking['grand_total'])?'$'.$booking['grand_total']:0 ;?></td>

					  <td><?php echo $commission.'%' ;?></td>

                      <td><?php echo ($siteProfit)?'$'.$siteProfit:"$0" ;?></td>

                      <td><?php echo ($ownerProfit)?'$'.$ownerProfit:"$0" ;?></td>

					  <?php

						 if(isset($booking_status[1]) && $booking_status[1]!="")

						 {					 

					  ?>

                      <td class="text-center"><span class="label <?php echo $bookingClass;?>"><?php echo ucwords($booking_status[0]." ".$booking_status[1]); ?></span></td>

                      <?php 

						}else{

					  ?>

					  <td class="text-center"><span class="label <?php echo $bookingClass;?>"><?php echo ucwords($booking_status[0]); ?></span></td>

					  <?php					  

						}

					  ?>

					  <td class="text-center"><?php echo date("d, F Y H:i:s",$booking['created']);?> </td>

                      <td style="width: 15%;" class="text-right"><a class="table-link inline" href="#details<?php echo $booking['id'];?>"> <span class="fa-stack"> <i class="fa fa-square fa-stack-2x"></i> <i class="fa fa-eye fa-stack-1x fa-inverse"></i> </span> </a></td>

                    </tr>

					 <div style='display:none'>

					  <div  class="booking-details"id='details<?php echo $booking['id']; ?>' style='padding:10px; background:#fff;'>

					  <!-- End -->

<section>

<div>



<!-- Resrvation pop HTML start here --> 

 <div class="reservation_popup_main">

 <div class="reservation_popup_title">

  <div class="reservation_popup_title_left col-sm-4"> <h4><?php echo $booking['booking_id']; ?></h4> </div>

  <div class="reservation_popup_title_right col-sm-8"> <h4>Reservation Summary</h4> </div>

 </div>

 <div class="reservation_popup_content">

  <div class="img-section col-sm-3">

  <?php 

		$OverviewData = getOverviewData(5);

		$file = file_load($OverviewData['main_img_fid']);

        $imgpath = $file->uri;                

        $reservation_popup_listing_img = 'reservation_popup_listing_img';

  

  if(!empty($OverviewData['main_img_fid'])){ ?>

  

		<img  src="<?php print image_style_url($reservation_popup_listing_img, $imgpath); ?>" onerror="this.onerror=null;this.src='<?php echo $base_url . '/' . drupal_get_path('theme', $Common_part_from_frontENd) . '/images/banner-thumb_img.jpg'; ?>'" alt="place" onerror="this.onerror=null;this.src='<?php echo $base_url . '/' . drupal_get_path('theme', $Common_part_from_frontENd) . '/images/banner-thumb_img.jpg'; ?>'"  />



  <?php }else{  ?>

		<img src="<?php print $base_url.'/'.drupal_get_path('theme','gloobers_new').'/images/default_images/banner-listing_img.jpg'; ?>" alt="listing-image" width="100%" height="121px;" onerror="this.onerror=null;this.src='<?php echo $base_url . '/' . drupal_get_path('theme', 'gloobers_new') . '/images/banner-thumb_img.jpg'; ?>'" >


<?php
		} ?>

  </div>

  <div class="col-sm-4">

   <h5><a href="<?php echo $base_url; ?>/experience/<?php echo $booking['lid']; ?>"><?php echo ucwords($booking['title']);?></a></h5>

   <p><?php echo $Get_user_pass; ?></p>

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

        <h5>Travellers</h5>

		

   <p>

   <?php

	$total_qty=array();

	foreach($quantityDetails as  $key=>$value){

								

		$total_qty[]=$value['qty'];

	}

	$total_qty=array_sum($total_qty);

	echo $total_qty.' x <i class="fa fa-user"></i><br/>';

	foreach($quantityDetails as  $key=>$value){

		echo $value['qty'].' '.$key.'<br/>';

	}

	?>

</p>

  </div>

 </div>

 <?php  

		$profile_pic_id=$userDetails->picture->fid;

		$profile_pic=file_load($profile_pic_id);

		$DP_url=$profile_pic->uri;

 ?>

 <div class="col-md-12">

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
	   print '<img class="img-responsive img-circle" src="' . image_style_url($style, $DP_url) . '">';
	  ?>

			<!-- <img class="img-responsive img-circle" onerror="this.onerror=null;this.src='<?php //echo $base_url . '/' . drupal_get_path('theme', 'gloobers_new') . '/images/no-profile-male-img.jpg'; ?>'" src="<?php //print $DP_url; ?>" alt="place" />
 -->
		<?php    }else{  ?>

			<img class="img-responsive img-circle"  src="<?php echo $base_url . '/' . drupal_get_path('theme', 'gloobers_new') . '/images/no-profile-male-img.jpg'; ?>" alt="place" />

	  

		<?php   }  ?>

	  

	  </div>

     </div>

     <div class="col-sm-8">

      <div class="reservation_contact_inner">
       <p>
       <span>
       <?php echo $userDetails->field_first_name['und'][0]['value'].' '.$userDetails->field_last_name['und'][0]['value']; ?>
       </span>
		<?php echo $userDetails->field_phone_number['und'][0]['value'];  ?>
		<?php //echo $userDetails->field_about_yourself['und'][0]['value'];?>
      </p>
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
		//echo "<pre>";print_r($additional);
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
    </div>

  </div>

 </div>

 <div class="col-md-12">
 <div class="row">
  <div class="col-md-12">
      <div class="reservation_contact_inner">
       <h5>Cancellation policy</h5>
       <p class="text-left"><b><?php echo $policyType.':</b>'.$policyinfo;?></p>
      </div>
    </div>
 </div>
</div>

<div class="col-md-12">
<div class="row">
<div class="col-md-6 col-md-offset-3">
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

							<div class="col-xs-9 col-sm-10 charg-row">

									 <p>Additional Charges</p>

									 </div>

									 <div class="col-xs-3 col-sm-2">

									 <p>$<?php echo $booking['additional_cost'] ? $booking['additional_cost']: '0' ;?></p> 

									 </div>	


							<?php

							}

							?>
							<div class="col-xs-9 col-sm-10">
                                	<p>Grand Total :</p></div>
                                     <div class="col-xs-3 col-sm-2"><p><?php echo $booking['total_cost'];?></p> 
                                </div>
                
                <?php

								

								if($booking['discount'])

								{

								?>

								<div class="col-xs-9 col-sm-10">

                                	<p>Discount</p></div>

                                     <div class="col-xs-3 col-sm-2">
                                     <p>(-)<?php echo ($booking['discount'])?'$'.$booking['discount']:'$0';?></p> 
									</div>
                                </div><!-- row ends -->

								<?php

								}

								?>								

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
      	<h4 class="text-right"><?php echo '$'.$result;

							unset($subtotal_counting);

														?>

								</h4>

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

</section>

					 

					 </div>

					

					

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

	<?php

		print '<div class="pagination">'.$pagination.'</div>';

     }

 

	 else

	 {

     ?>

	 <div class="no-results"><p>No Booking Details Found</p></div>

     <?php

      }

      ?>  	  

		</div>	

<script type="text/javascript">

		var jq = jQuery.noConflict();

       jq(document).ready(function(){

	   jq(".inline").colorbox({inline:true, width:"50%"});

				jq("#edit-type").change(function(){

							jq.ajax({

							type: "POST",

							url: "<?php echo $base_url; ?>/product/ajax/getList",

						//dataType: "json",

							data: "typeId=" + encodeURI(jq(this).val()),

								success: function(msg){

								jq('#edit-search-filter').html("");

									if(msg!="")

									{



									jq.each(msg,function(index,val){

									jq('#edit-search-filter').append("<option value="+index+">"+val+"</option>");

									});

									}

									else

									{

									jq('#edit-search-filter').append("<option value=0>No Deal Data Found</option>");

									}

								}

							});

						});

					/****************************************************************************/

            

							jq.ajax({

							type: "POST",

							url: "<?php echo $base_url; ?>/product/ajax/getList",

						//dataType: "json",

							data: "typeId=" + encodeURI(jq("#edit-type").val()),

								success: function(msg){

								jq('#edit-search-filter').html("");

									if(msg!="")

									{
									var url = window.location.href;
										var search_filter = getUrlParameter('search_filter');
										if(!search_filter){search_filter='';}
										jq('#edit-search-filter').append("<option value=''>All</option>");
										jq.each(msg,function(index,val){
											if(parseInt(search_filter)==parseInt(index)){

												var selected='selected';

											}else{
												var selected='';

											}
								
									jq('#edit-search-filter').append("<option "+selected+" value="+index+">"+val+"</option>");

									});
									}

									else

									{

									jq('#edit-search-filter').append("<option value=0>No Deal Data Found</option>");

									}

								}

							});

									

					});


var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};
</script>