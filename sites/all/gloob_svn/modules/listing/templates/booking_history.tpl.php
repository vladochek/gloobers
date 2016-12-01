<?php
global $base_url;
drupal_add_css(drupal_get_path('theme', 'gloobers2') .'/css/colorbox.css','file');
drupal_add_js(drupal_get_path('theme', 'gloobers2') .'/js/jquery.colorbox.js',array('scope' => 'footer'));
?>
<div class="dm-dashboard-wrapper mytrips">
<h2>My Trips</h2>
<?php
print'<div class="search-list-booking view-customer">';
echo drupal_render($searchForm);
print '</div>';
if(count($bookings)>0)
{
?>

<div class="col-lg-12">
 <div class="main-box clearfix">
  <header class="main-box-header clearfix">
              <h2 class="pull-left">Booking Details (<?php echo $bookingsCount;?> Results Found)</h2></br>
			    
             
  </header>
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
				  foreach($bookings as $booking)
				  {
				  $totalRefundAmount=$commission=$refundpercent=0;
				  $policyinfo="";
				 // $travellerInfo=user_load($booking['uid']);
				  $pricingData = getPricingData($booking['lid']);
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
				 // echo "expireddatetime-------------".$expiredDate."-------------"."currentdatetime---".$Currentdatetime."---------";
				  //$refundAmount=((100-$commission)*$booking['grand_total'])/100;
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
					 print_r($quantityDetails); */
				  
				  ?>
                    <tr>
                      <td><?php echo $i;?></td>
                      <td><?php echo $booking['booking_id'];?></td>					 
					  <td><a href="<?php echo url('experience/view/'.$booking['lid']);?>"><?php echo $booking['title'];?></a></td>					  
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
					  <td class="text-center"><?php echo date("d, F Y H:i:s",$booking['created']);?> </td>
                      <td  class="text-right">
					  <?php
					  
					  if($totalRefundAmount>0 && $booking['booking_status']=='booked')
					  {				  
					  ?>
					  <a class="table-link inline cboxElement cancel-booking" href="#cancelBooking<?php echo $booking['id'];?>">Cancel Booking</a>
					  <?php
					  }
					  ?>
					  <a class="table-link inline" href="#details<?php echo $booking['id'];?>"> <span class="fa-stack"> <i class="fa fa-square fa-stack-2x"></i> <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i> </span> </a></td>
                    </tr>
					 <div style='display:none'>
					 <div id="cancelBooking<?php echo $booking['id'];?>" class="cancelBooking" style='padding:10px; background:#fff;'>
					 <div class="site-commssion"><label>Amount Paid</label><span><?php echo '$'.sprintf("%.2f",$booking['grand_total']);?></span></div>
					 <div class="site-commssion"><label>Gloobers Commission</label><span><?php $commissonAmount=$commission*$booking['grand_total'];echo "(-)".'$'.sprintf("%.2f",(($commissonAmount)/100));?></span></div>
					 <div class="site-commssion"><label>Refund Amount (<?php echo  $refundpercent.'%'." x "." $".sprintf("%.2f",$refundAmount);?>)</label><span><?php echo "$".sprintf("%.2f",$totalRefundAmount);?></span></div>
					 <div class="refund-message">
					<?php echo drupal_render($cancelForm);?>
					 </div>
					 <script>
					 var jq = jQuery.noConflict();
						jq(document).ready(function(){
						jq('#cancelBooking<?php echo $booking['id'];?>').find(".bid").val(<?php echo $booking['id']; ?>);
						jq('#cancelBooking<?php echo $booking['id'];?>').find(".lid").val(<?php echo $booking['lid']; ?>);
						});
					 </script>
					 </div>
					  <div  class="booking-details"id='details<?php echo $booking['id']; ?>' style='padding:10px; background:#fff;'>
					  <!------------------------------------------------------------------------------------>
					<div class="left-col-payment-pop">
                	<h1>Booking Summary</h1>
                	
                    <div class="booking-summry">
                    
                    	<div class="row-sum">
						<?php
						$otherDetails=unserialize($booking['other_details']);
						  /*  echo "<pre>";
						print_r($otherDetails);  */
						if($booking['arrive_at_date']!="")
						{
						?>
                            <div class="col-sum half">
                                <label>Arrival Date</label>
								
                                <p><?php echo date("d, F Y",strtotime($booking['arrive_at_date']))." ".$booking['arrive_at_time'];?></p>
                            </div><!-- col ends -->
                        <?php
                         }
						 if(isset($otherDetails['check-out-date']) || isset($otherDetails['check-out-time']))
						 {
                         ?> 						 
                            <div class="col-sum half f-right">
                                <label>Departure Date</label>
                                <p><?php echo $otherDetails['check-out-date']." ".$otherDetails['check-out-time']; ?></p>
                            </div><!-- col ends -->
                           </div><!-- row-sum ends -->
						 <?php
                          }
                          ?>						  
                            <div class="row-sum">
                                <label>Number Of Participants</label>
								<?php
								
								$participantsum=0;
								$partdetail=array();
								foreach($quantityDetails as  $key=>$value)
								{
								$details=explode("|",$key);								
								$str="";
								if($details[0]=='group')
								{
								array_push($partdetail,$value." ".'Persons in Group');
								//$str.=$value." ".'Persons in Group';
								}
								else
								{
								array_push($partdetail,$value." ".$details[0]);
								//$str.=$value." ".$details;
								}								
								$participantsum+=$value;
								
								}								
								$str = implode(",",$partdetail);
								?>
                                <p><?php echo $participantsum .' ( '.$str.' ) ';?></p>
                            </div><!-- col ends -->
                        
                        
                        <div class="row-sum">
                              <label>Deal Title</label>
                                <p><?php echo ucwords($booking['title']);?></p>
                                <p><?php //$booking['state'].",".$booking['country'];?></p>
                         </div><!-- row-sum ends -->
                         <?php
                          if($booking['booking_id'])
                         {
						 ?>						  
                         <div class="row-sum">
                              <label>Booking Confirmation Code</label>
                                <p><?php echo $booking['booking_id'];?></p>                               
                         </div>						 
                        <?php
                        }				
                    
                         if($policyType)
                         {
						 ?>						  
                         <div class="row-sum">
                              <label>Cancellation Policy</label>
                                <p><?php echo ucwords($policyType);?></p>   
                                <?php echo $policyinfo;?>  								
                         </div>						 
                        <?php
                        }
						if($rulesDetail['agreement'])
                         {
						 ?>						  
                         <div class="row-sum">
                              <label>Aggrement</label>
                                <p><?php echo $rulesDetail['agreement'];?></p>                               
                         </div>						 
                        <?php
                        }						
                        ?>						
 						
                            
                    </div><!-- booking summry -->
					<div class="user-details booking-summry">
					  <div class="col-sum half"> 
					    <label>Name</label>   <p><?php echo $otherDetails['first_name']." ".$otherDetails['last_name'];?></p>
					  </div>
					  <div class="col-sum half f-right">
					    <label>Email</label>   <p><?php echo $otherDetails['email']; ?></p>
					  </div>
					  <div class="col-sum half">
					    <label>Phone Number</label>   <p><?php echo $otherDetails['phone_number'];?></p>
					  </div>
					  <div class="col-sum half f-right">
					    <label>Address</label>   <p><?php echo ($otherDetails['address'])?$otherDetails['address'].",":'';
						echo $otherDetails['city'].",".$otherDetails['state'].",".$otherDetails['country']."  ".$otherDetails['zipcode'];?></p>
					  </div>
					  <?php
                      if($otherDetails['company'])
                      {
                      ?>
					   <div class="col-sum half">
					    <label>Company</label>   <p><?php echo $otherDetails['company'];?></p>
					  </div>
                      <?php
                        }   					  
					  ?>
					</div>
					<!------------------------------------------------------------------------------>
						<?php
/******************************************************************************************************************/
                             /* if($pricingData[0]["price_type"] == 'PER_DAY' || $pricingData[0]["price_type"] == 'PER_MINUTE' || $pricingData[0]["price_type"] == 'PER_HOUR'){
							
								if($schedulingData["bookingMode"] != 'INVENTORY' && $schedulingData["durationType"] == 'Any'){
									if($pricingData[0]["price_type"] == 'PER_MINUTE'){
										$bookingDateTime = strtotime($booking["arrive_at_date"]);
									}
									else if($pricingData[0]["price_type"] == 'PER_HOUR'){
										$bookingDateTime = strtotime($booking["arrive_at_date"]);
									}
									else if($pricingData[0]["price_type"] == 'PER_DAY'){
										$bookingDateTime = strtotime($booking["arrive_at_date"])+24*60*60;
									} */
/******************************************************************************************************************/

						
						$additionalSum = 0;
						$extras = getProductExtraData($booking['lid']);
						if($booking["additional_services"]){
						
						$additional =unserialize($booking["additional_services"]);
						
					?>
					<div class="amount-chart">
                     	<p class="head">Additional Services</p>
                        	<div class="chart-table">
                             		  <div class="chart-row head">
                                	<div class="chart-col">
                                    	<p><b>Service</b></p>
                                    </div><!-- chart col ends -->
                                    
                                    <div class="chart-col">
                                    	<p><b>Quantity</b></p>
                                    </div><!-- chart col ends -->
                                    
                                    <div class="chart-col">
                                    	<p><b>Price(in $)</b></p>
                                    </div><!-- chart col ends -->
                                    
                                    <div class="chart-col">
                                    	<p><b>Subtotal</b></p>
                                    </div><!-- chart col ends -->
                                </div><!-- row ends -->
								<?php 
								 /* echo "<pre>";
								print_r($extras);
								echo "<hr>";
								print_r($additional); */ 
								foreach($extras as $key=>$value){
						

								foreach($additional as $services)
								{
										if ($services['meta_id'] == $value['meta_id']) {									
										
											$extras = unserialize($value["value1"]);
											$additionalSum = $additionalSum+($extras["price"]*$services['qty']);
											
								?>           
										  <div class="chart-row">
											<div class="chart-col">
											 <p><?php echo $extras["title"]; ?></p>
											</div><!-- col ends -->
											
											<div class="chart-col">
											 <p> <?php echo $services['qty'] ?></p>
											</div><!-- col ends -->
											
											<div class="chart-col">
											 <p> <?php echo "$".$extras["price"]; ?></p>
											</div><!-- col ends -->
											
											<div class="chart-col">
											 <p>$<?php echo $extras["price"]*$services['qty']; ?></p>
											</div><!-- col ends -->
										  </div><!-- row ends -->       
								<?php 
										}
									}
								}
                               ?>								
                            </div> <!-- table ends -->	
					</div>
				<?php 
					}
				?>
					<!------------------------------------------------------------------------------------>
					
					
					<div class="amount-chart">
                     	<p class="head">Payments</p>
                        	<div class="chart-table">
                             		  <div class="chart-row head">
                                	<div class="chart-col">
                                    	<p><b>Item</b></p>
                                    </div><!-- chart col ends -->
                                    
                                    <div class="chart-col">
									<?php 
										if($pricingData[0]["price_type"] == 'PER_DAY' || $pricingData[0]["price_type"] == 'PER_MINUTE' || $pricingData[0]["price_type"] == 'PER_HOUR'){
											if($schedulingData["bookingMode"] != 'INVENTORY'){
												if($pricingData[0]["price_type"] == 'PER_DAY'){
													echo '<p><b>Days</b></p>';
												}
												else if($pricingData[0]["price_type"] == 'PER_MINUTE'){
													echo '<p><b>Minutes</b></p>';
												}
												else if($pricingData[0]["price_type"] == 'PER_HOUR'){
													echo '<p><b>Hours</b></p>';
												}
											}
											else{
												echo '<p><b>Quantity</b></p>';
											}
										}
										else{
											echo '<p><b>Quantity</b></p>';
										}
									?>
                                    </div><!-- chart col ends -->
                                  
                                 
                                    
                                    <div class="chart-col">
                                    	<p><b>Price</b></p>
                                    </div><!-- chart col ends -->
                                    
                                    <div class="chart-col">
                                    	<p><b>Subtotal</b></p>
                                    </div><!-- chart col ends -->
                                </div><!-- row ends -->
                                
                  <!-------------------------------------------------------------------------------------------------->
				  <!-------------------------------------------------------------------------------------------------->
				  <div class="chart-row">
								<?php                         
								$sum = 0;
								foreach($quantityDetails as $key=>$value){
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
									$key = explode("|",$key);
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
							?>
									<div class="chart-col">
										<p><?php echo $quantity; ?> <?php echo $key[0]; ?></p>
										
									</div>
									<div class="chart-col">
										<p class="duration"> <?php echo $value; ?></p>
									</div>
									<div class="chart-col">
										<!--<p><?php //echo ($schedulingData['durationType'] == 'Any')?1:$DurationOption[1]["durationValue"]; ?></p>-->
										<p> <?php echo $key[1]; ?></p>
									</div>
									<div class="chart-col">
										<p class="total">$<?php echo $amount; ?></p>
									
									</div>
							<?php
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
							?>
									<div class="chart-col">
										<p><?php echo $quantity; ?> <?php echo $key[0]; ?></p>
										
									</div>
									<div class="chart-col">
										<p class="duration"> <?php echo $value; ?></p>
									</div>
									<div class="chart-col">
										<!--<p><?php //echo ($schedulingData['durationType'] == 'Any')?1:$DurationOption[1]["durationValue"]; ?></p>-->
										<p> <?php echo $key[1]; ?></p>
									</div>
									<div class="chart-col">
										<p class="total">$<?php echo $amount; ?></p>
										
									</div>
							<?php
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
							?>
									<div class="chart-col">
										<p><?php echo $quantity; ?> <?php echo $key[0]; ?></p>
										
									</div>
									<div class="chart-col">
										<p class="duration"> <?php echo $value; ?></p>
									</div>
									<div class="chart-col">
										<!--<p><?php //echo ($schedulingData['durationType'] == 'Any')?1:$DurationOption[1]["durationValue"]; ?></p>-->
										<p> <?php echo $key[1]; ?></p>
									</div>
									<div class="chart-col">
										<p class="total">$<?php echo $amount; ?></p>
										
									</div>		
							<?php
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
							?>
									<div class="chart-col">
										<p><?php echo $quantity; ?> <?php echo $key[0]; ?></p>
										
									</div>
									<div class="chart-col">
										<p class="duration"> <?php echo $value; ?></p>
									</div>
									<div class="chart-col">
										<!--<p><?php //echo ($schedulingData['durationType'] == 'Any')?1:$DurationOption[1]["durationValue"]; ?></p>-->
										<p> <?php echo $key[1]; ?></p>
									</div>
									<div class="chart-col">
										<p class="total">$<?php echo $amount; ?></p>
										
									</div>		
							<?php
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
							?>
									<div class="chart-col">
										<p><?php echo $quantity; ?> <?php echo $key[0]; ?></p>
										
									</div>
									<div class="chart-col">
										<p class="duration"> <?php echo $value; ?></p>
									</div>
									<div class="chart-col">
										<!--<p><?php //echo ($schedulingData['durationType'] == 'Any')?1:$DurationOption[1]["durationValue"]; ?></p>-->
										<p> <?php echo $key[1]; ?></p>
									
									</div>
									<div class="chart-col">
										<p class="total">$<?php echo $amount; ?></p>
										
									</div>		
							<?php
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
							?>	
									<div class="chart-col">
										<p><?php echo $quantity; ?> <?php echo $key[0]; ?></p>
									
									</div>
									<div class="chart-col">
										<p class="duration"> <?php echo $value; ?></p>
									</div>
									<div class="chart-col">
										<!--<p><?php //echo ($schedulingData['durationType'] == 'Any')?1:$DurationOption[1]["durationValue"]; ?></p>-->
										<p> <?php echo $key[1]; ?></p>
									</div>
									<div class="chart-col">
										<p class="total">$<?php echo $amount; ?></p>
										
									</div>		
							<?php
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

							?>
									<div class="chart-col">
										<p><?php if($key[0] == 'group') echo 'Person in '; echo $key[0]; ?></p>
									</div>
									<div class="chart-col">
										<p><?php echo $value; ?></p>
									</div>
									<div class="chart-col">
										<p> <?php echo $textLabel; ?></p>
									</div>
									<div class="chart-col">
										<p>$<?php echo $amount; ?></p>
									</div>
							<?php
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
							?>
									<div class="chart-col">
										<p><?php echo $key[0]; ?></p>
									</div>
									<div class="chart-col">
										<p><?php echo $value; ?></p>
									</div>
									<div class="chart-col">
										<p> <?php echo $textLabel; ?></p>
									</div>
									<div class="chart-col">
										<p>$<?php echo $amount; ?></p>
									</div>
							<?php 
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
							?>
									<div class="chart-col">
										<p><?php echo $key[0]; ?></p>
									</div>
									<div class="chart-col">
										<p> <?php echo $value; ?></p>
									</div>
									<div class="chart-col">
										<p> <?php echo $textLabel; ?></p>
									</div>
									<div class="chart-col">
										<p>$<?php echo $amount; ?></p>
									</div>
							<?php 
									}
									
									$sum = $sum+$amount;
								}
							?>
                                      
                            </div> <!-- table ends -->
                  <!-------------------------------------------------------------------------------------------------->
                                      
                           
                            
                            <div class="total-charg">
                            <?php
							if($booking['additional_cost'])
							{
							?>
							<div class="charg-row">
                                	<p>Additional Charges</p>
                                     <span><?php echo '$'.$booking['additional_cost'];?></span> 
                                </div><!-- row ends -->
							<?php
							}
							?>
                            	<div class="charg-row">
                                	<p>SUB TOTAL</p>
                                     <span><?php echo '$'.$booking['total_cost'];?></span> 
                                </div><!-- row ends -->
                                <?php
								if($booking['security'])
								{
								?>
                                <div class="charg-row">
                                	<p>SECURITY DEPOSIT</p>
                                     <span><?php echo ($booking['security'])?'$'.$booking['security']:'$0';?></span> 
                                </div><!-- row ends -->
                                <?php
								}
								if($booking['discount'])
								{
								?>
								 <div class="charg-row">
                                	<p>Discount</p>
                                     <span>(-)<?php echo ($booking['discount'])?'$'.$booking['discount']:'$0';?></span> 
                                </div><!-- row ends -->
								<?php
								}
								?>
                                <div class="charg-row">
                                	<p>GRAND TOTAL</p>
                                     <span><?php echo '$'.$booking['grand_total'];?></span> 
                                </div><!-- row ends -->
                                
                            </div><!-- charg ends -->
                            
                    </div><!-- links ends -->
					
                    	 
                </div><!-- col ends -->
					  <!------------------------------------------------------------------------------------>
					  
					  
					  
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
print '<div class="no-results"><p>No Booking Details Found</p></div>';
}
?>
</div>
<script>
var jq=jQuery.noConflict();
jq(window).load(function(){

var checkin = jq("#edit-search-filter").datepicker({
format:"yyyy-mm-dd",
  onRender: function() {
   // return date.valueOf() < now.valueOf() ? 'disabled' : '';
  }
}).on('changeDate', function(ev) {  
  checkin.hide();
  
}).data('datepicker');

});
</script>