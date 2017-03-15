<?php
$OverviewData=getOverviewData($_SESSION['listing_id']);
$photos = getPhotosData($_SESSION['listing_id']);
$userDetails = user_load($OverviewData["uid"]);	
$rulesDetail=getRulesDetails($_SESSION['listing_id']);
$schedulingData=getSchedulingData($_SESSION['listing_id']);
$rulesDetail=unserialize($rulesDetail["value1"]);
drupal_add_js(drupal_get_path('theme', 'gloobers2') .'/js/jquery.validate.min.js',array('scope' => 'footer'));
if(isset($postedData['participants'])){
	$_SESSION['postedData'] = $postedData;
}
global $base_url;
drupal_add_css(drupal_get_path('theme', 'gloobers') .'/css/jquery.timepicker.css','file');  
drupal_add_js(drupal_get_path('theme', 'gloobers') .'/js/jquery.timepicker.js',array('scope' => 'footer'));
?>
 <div class="dr-form-width-wrapper">
         	<div class="dr-paymnet-form">
		<form name="booking-info" id="booking-info" method="POST" action="<?php echo $base_url;?>/booking/payment">
			
            <div class="left-col-payment-outer">
            
            	<div class="left-col-payment">
                	<h1>Booking Summary</h1>
                	
                    <div class="booking-summry">
                    
                    	<div class="row-sum">
                            <div class="col-sum">
                                <label>Check-in</label>
                                <p><?php echo date('d, F Y',strtotime($_SESSION['postedData']["booking-on"])).' '.$_SESSION['postedData']["session-time"]; ?></p>
								<input type="hidden" name="booking-on" value="<?php echo isset($_SESSION['postedData']["booking-on"])?date('d, F Y',strtotime($_SESSION['postedData']["booking-on"])):''; ?>">
							</div><!-- col ends -->
						<?php 
							if(isset($_SESSION['postedData']["session-date"]) && $_SESSION['postedData']["session-date"] != '')
							{
						?>                           
                            <div class="col-sum">
                                <label>Session</label>
                                <p><?php echo date('d, F Y',strtotime($_SESSION['postedData']["session-date"]))." ".$_SESSION['postedData']["session-time"]; ?></p>
								<input type="hidden" name="session-date" value="<?php echo isset($_SESSION['postedData']["session-date"])?date('d, F Y',strtotime($_SESSION['postedData']["session-date"]))." ".$_SESSION['postedData']["session-time"]:''; ?>">
							</div><!-- col ends -->
                        <?php 
							}
						?>    
                            <div class="col-sum">
                                <label>Quantity</label>
								<?php 
									foreach($_SESSION['postedData']["participants"] as $key=>$value){
									if($value>0)
									{
									$key = explode("|",$key);
								?>
								<p><?php echo ucwords($key[0]); ?> : <?php echo ($value != '')?$value:0;
								if($key[0] == 'group') echo ' person'; ?></p>
								<input type="hidden" name="participants[<?php echo $key[0]; ?>-<?php echo $key[1]; ?>]" value="<?php echo ($value != '')?$value:0; ?>">
								<?php 
									}
								}	
									$_SESSION['participants']=serialize($_SESSION['postedData']["participants"]);
								?>
                            </div><!-- col ends -->
                        </div><!-- row-sum ends -->
					<div class="row-sum">
						<?php 
						$_SESSION['booking-on']=$_SESSION['postedData']["booking-on"];
						$_SESSION['booking-on_time']=($_SESSION['postedData']["session-time"])?$_SESSION['postedData']["session-time"]:$_SESSION['postedData']["preferred-time"];
							if($schedulingData["bookingTimeMode"] == 'FIXED'){
								$bookingFixedTimes = unserialize($schedulingData["bookingFixedTimes"]);
						?>
						 <div class="col-sum">
							<label>Preferred Time</label>
							<p><?php echo $_SESSION['postedData']["preferred-time"] ?></p>
							<input type="hidden" name="preferred-time" value="<?php echo $_SESSION['postedData']["preferred-time"]; ?>">
						</div>
						<?php 
						}
							if($pricingData[0]["price_type"] == 'PER_DAY' || $pricingData[0]["price_type"] == 'PER_MINUTE' || $pricingData[0]["price_type"] == 'PER_HOUR'){
								
								if($schedulingData["bookingMode"] != 'INVENTORY' && $schedulingData["durationType"] == 'Any'){
									if($pricingData[0]["price_type"] == 'PER_MINUTE'){
										$bookingDateTime = strtotime($_SESSION['postedData']["booking-on"]);
									}
									else if($pricingData[0]["price_type"] == 'PER_HOUR'){
										$bookingDateTime = strtotime($_SESSION['postedData']["booking-on"]);
									}
									else if($pricingData[0]["price_type"] == 'PER_DAY'){
										$bookingDateTime = strtotime($_SESSION['postedData']["booking-on"])+24*60*60;
									}
						?>
							<div class="row-sum">
								<label>Check-out</label>
								<input type="hidden" name="price_type" id="price_type" value="<?php echo $pricingData[0]["price_type"]; ?>">
								<p>Select Date <input id="datetimepicker2" type="text" class="inputDate" placeholder="<?php echo date('Y-m-d',$bookingDateTime); ?>" name="check-out" value="<?php echo date('Y-m-d',$bookingDateTime); ?>" /></p>
						<?php 
								if($pricingData[0]["price_type"] == 'PER_MINUTE' || $pricingData[0]["price_type"] == 'PER_HOUR'){
						?>		
								<p>Select Time <input type="text" name="session-time" placeholder="Time" id="session-time" /></p>
						<?php 
								}
						?>
							</div>
						<?php 
								}
								else if($schedulingData["bookingMode"] != 'INVENTORY' && $schedulingData["durationType"] == 'LIST'){
									$DurationOption = unserialize($schedulingData["DurationOption"]);
						?>
							<div class="row-sum">
								<label>Duration</label>
								<p><span>Select Duration</span><select name="durationValue" id="durationValue">
									<?php
										foreach($DurationOption as $option){
											$title = '';
											if($pricingData[0]["price_type"] == 'PER_DAY'){
												$title = $option['durationValue']." days";
											}
											else if($pricingData[0]["price_type"] == 'PER_MINUTE'){
												$title = $option['durationValue']." minutes";
											}
											else if($pricingData[0]["price_type"] == 'PER_HOUR'){
												$title = $option['durationValue']." hours";
											}
									?>
										<option value="<?php echo $option['durationValue']; ?>"><?php echo $option['durationLabel']." ( ".$title." )"; ?></option>
									<?php 
										}
									?>
								</select></p>
							</div>
						<?php
								}
							}
						?> 
					</div>
                        <div class="row-sum">
                              <label>Deal Title</label>
                                <p><?php echo $OverviewData["title"]; ?></p>
                                <p><?php echo $OverviewData['city']; ?>, <?php echo $OverviewData['country']; ?></p>
                         </div><!-- row-sum ends -->
                         
                         <div class="row-sum">
                              <label>Itinerary</label>
								<?php 
								?>
                                <p><?php echo ($OverviewData['direction'] != '')?$OverviewData['direction']:'No itinerary information provided'; ?></p>
                         </div><!-- row-sum ends -->
                         
                         <div class="row-sum">
                              <label>Cancellation Policies</label>
                                <p><?php echo ($rulesDetail["cancellation_policies_type"] != '')?$rulesDetail["cancellation_policies_type"]:'No cancellation policies provided'; ?></p>
                                 
                         </div><!-- row-sum ends -->
                         
                         <div class="row-sum">
                              <label>Requirements</label>
							  <?php
                              if($rulesDetail["experience_rules"])
                                {
								$rulesValues=unserialize($rulesDetail["experience_rules"]);
                                }
							$rulesValues=array_filter($rulesValues);
                              if(count($rulesValues)>0)
							{ 								
							  ?>
							  <ul class="exp-req">
						    <?php
							
							 foreach($rulesValues as $value)	
							  {						 
							?>						
										<li><p><?php echo $value;?></p></li>
							<?php
							 }							
							?>	
                              
                                 </ul>
							<?php
                            }
							else
							{
							?>
							<p>No Experience Requirement</p>
                            <?php
                            }
                             ?>							
 							
                                <!--<p><?php echo ($rulesDetail["experience_rules"] != '')?$rulesDetail["experience_rules"]:'No requirements required'; ?></p>-->
                         </div><!-- row-sum ends -->
                        
                            
                    </div><!-- booking summry -->
                    	 
                </div><!-- col ends -->
            </div>   
        <!-- ===================== right col ======================== -->
        		
                <div class="right-sidebar">
                	<!--<h1>Booking Summary</h1>-->
                    
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
                        </div><!-- profile ends -->
                    </div><!-- selction ends -->
                	<div class="short-links">
                            <p><b>Owner:</b>
                            <?php 
							if($userDetails->field_first_name["und"][0]["value"] != ""){
								echo ucwords($userDetails->field_first_name["und"][0]["value"]." ".$userDetails->field_last_name["und"][0]["value"]);
							}
							else{
								echo ucwords($userDetails->name);
							}
						?>
						</p>
						<!--<p><b>Email:</b>   <?php echo $userDetails->mail;?></p>-->
					</div>
					<?php 
						$additionalSum = 0;
						if(isset($_SESSION['postedData']["additional-services"])){
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
                                    	<p><b>Price (in $)</b></p>
                                    </div><!-- chart col ends -->
                                    
                                    <div class="chart-col">
                                    	<p><b>Subtotal</b></p>
                                    </div><!-- chart col ends -->
                                </div><!-- row ends -->
							<?php 
								foreach($extras as $key=>$value){
									$qty = array_search($value['meta_id'], $_SESSION['postedData']["additional-services"]);
									if ($qty) {
										$extras = unserialize($value["value1"]);
										$additionalSum = $additionalSum+($extras["price"]*$qty);					 
							?>           
                                	  <div class="chart-row">
                                    	<div class="chart-col">
                                         <p><?php echo $extras["title"]; ?></p>
                                        </div><!-- col ends -->
                                        
                                        <div class="chart-col">
                                         <p> <?php echo $qty ?></p>
                                        </div><!-- col ends -->
                                        
                                        <div class="chart-col">
                                         <p>$ <?php echo $extras["price"]; ?></p>
                                        </div><!-- col ends -->
                                        
                                        <div class="chart-col">
                                         <p>$<?php echo $extras["price"]*$qty; ?></p>
                                        </div><!-- col ends -->
                                      </div><!-- row ends -->       
                            <?php 
									}
								}
								 $i=0;				
								foreach ($_POST["additional-services"] as $key=>$value)
								{
								$additional[$i]['meta_id']=$value;
								$additional[$i]['qty']=$key;
								$i++;
								} 
								$_SESSION["additional-services"]=serialize($additional);
								$_SESSION['additional-services-amount']= $additionalSum;
							?> 
							
                            </div> <!-- table ends -->	
					</div>
				<?php 
					}
				?>
				<input type="hidden" name="additional-services-amount" id="additional-services-amount" value=<?php echo $additionalSum; ?>>
                    <div class="amount-chart">
                     	<p class="head">Payment Details</p>
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
                                
                            <div class="chart-row">
								<?php                         
								$sum = 0;
								foreach($_SESSION['postedData']["participants"] as $key=>$value){
								
								if($value>0)
								{
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
												if($pricingData[0]["price_type"] == 'PER_MINUTE'){
													$value = 15;
												}
												else{
													$value = 1;
												}
												$duration = $value;
											}
											else{
												$DurationOption = unserialize($schedulingData["DurationOption"]);
												$value = $DurationOption[0]['durationValue'];
												$duration = $value;
											}
										}
									}
									$key = explode("|",$key);
									$schedulingPriceData = array();
									if($schedulingData["bookingMode"] == 'INVENTORY'){
										$schedulingDataPrice = getSchedulingDataPrice(isset($_SESSION['postedData']['session-date'])?$_SESSION['postedData']['session-date']:$_SESSION['postedData']['booking-on'],$_SESSION['postedData']['listing_id']);
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
										<input type="hidden" class="quantity" value="<?php echo $quantity; ?>">
									</div>
									<div class="chart-col">
										<p class="duration"> <?php echo $value; ?></p>
									</div>
									<div class="chart-col">
										<!--<p><?php //echo ($schedulingData['durationType'] == 'Any')?1:$DurationOption[1]["durationValue"]; ?></p>-->
										<p>  $<?php echo $key[1]; ?></p>
										<input type="hidden" class="durationPrice" value="<?php echo $key[1]; ?>">
									</div>
									<div class="chart-col">
										<p class="total">$<?php echo $amount; ?></p>
										<input type="hidden" class="durationTotalPrice" value="<?php echo $amount; ?>">
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
										<input type="hidden" class="quantity" value="<?php echo $quantity; ?>">
									</div>
									<div class="chart-col">
										<p class="duration"> <?php echo $value; ?></p>
									</div>
									<div class="chart-col">
										<!--<p><?php //echo ($schedulingData['durationType'] == 'Any')?1:$DurationOption[1]["durationValue"]; ?></p>-->
										<p> $<?php echo $key[1]; ?></p>
										<input type="hidden" class="durationPrice" value="<?php echo $key[1]; ?>">
									</div>
									<div class="chart-col">
										<p class="total">$<?php echo $amount; ?></p>
										<input type="hidden" class="durationTotalPrice" value="<?php echo $amount; ?>">
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
										<input type="hidden" class="quantity" value="<?php echo $quantity; ?>">
									</div>
									<div class="chart-col">
										<p class="duration"> <?php echo $value; ?></p>
									</div>
									<div class="chart-col">
										<!--<p><?php //echo ($schedulingData['durationType'] == 'Any')?1:$DurationOption[1]["durationValue"]; ?></p>-->
										<p>$<?php echo $key[1]; ?></p>
										<input type="hidden" class="durationPrice" value="<?php echo $key[1]; ?>">
									</div>
									<div class="chart-col">
										<p class="total">$<?php echo $amount; ?></p>
										<input type="hidden" class="durationTotalPrice" value="<?php echo $amount; ?>">
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
										<input type="hidden" class="quantity" value="<?php echo $quantity; ?>">
									</div>
									<div class="chart-col">
										<p class="duration"><?php echo $value; ?></p>
									</div>
									<div class="chart-col">
										<!--<p><?php //echo ($schedulingData['durationType'] == 'Any')?1:$DurationOption[1]["durationValue"]; ?></p>-->
										<p>$<?php echo $key[1]; ?></p>
										<input type="hidden" class="durationPrice" value="<?php echo $key[1]; ?>">
									</div>
									<div class="chart-col">
										<p class="total">$<?php echo $amount; ?></p>
										<input type="hidden" class="durationTotalPrice" value="<?php echo $amount; ?>">
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
										<input type="hidden" class="quantity" value="<?php echo $quantity; ?>">
									</div>
									<div class="chart-col">
										<p class="duration"> <?php echo $value; ?></p>
									</div>
									<div class="chart-col">
										<!--<p><?php //echo ($schedulingData['durationType'] == 'Any')?1:$DurationOption[1]["durationValue"]; ?></p>-->
										<p>$<?php echo $key[1]; ?></p>
										<input type="hidden" class="durationPrice" value="<?php echo $key[1]; ?>">
									</div>
									<div class="chart-col">
										<p class="total">$<?php echo $amount; ?></p>
										<input type="hidden" class="durationTotalPrice" value="<?php echo $amount; ?>">
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
										<input type="hidden" class="quantity" value="<?php echo $quantity; ?>">
									</div>
									<div class="chart-col">
										<p class="duration"> <?php echo $value; ?></p>
									</div>
									<div class="chart-col">
										<!--<p><?php //echo ($schedulingData['durationType'] == 'Any')?1:$DurationOption[1]["durationValue"]; ?></p>-->
										<p>$<?php echo $key[1]; ?></p>
									</div>
									<div class="chart-col">
										<p class="total">$<?php echo $amount; ?></p>
										<input type="hidden" class="durationTotalPrice" value="<?php echo $amount; ?>">
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
										<p> <?php echo $value; ?></p>
									</div>
									<div class="chart-col">
										<p>$<?php echo $textLabel; ?></p>
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
										<p> <?php echo $value; ?></p>
									</div>
									<div class="chart-col">
										<p>$<?php echo $textLabel; ?></p>
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
										<p>$<?php echo $textLabel; ?></p>
									</div>
									<div class="chart-col">
										<p>$<?php echo $amount; ?></p>
									</div>
							<?php 
									}
									
									$sum = $sum+$amount;
								}	
							}
							?>
                                      
                            </div> <!-- table ends -->
                            
                            <div class="total-charg">
                            
                            	<div class="charg-row">
                                	<p>SUB TOTAL</p>
                                     <span class="sum">$ <?php echo $sum; ?></span> 
                                     <input type="hidden" class="sum" value="<?php echo $sum; ?>">
                                </div><!-- row ends -->
							<?php 
								if($additionalSum){
							?>
                             	<div class="charg-row">
                                	<p>ADDITIONAL SERVICES</p>
                                     <span>$ <?php echo $additionalSum; ?></span> 
                                </div><!-- row ends --> 
							<?php 
								}
							?>
                                <div class="charg-row">
                                	<p>SECURITY DEPOSIT</p>
                                     <span class="deposit">	
									 <?php
										$totalWithoutSecurity = $sum+$additionalSum;
										if($rulesDetail["security_options"] == "amount_in_$"){
											$securityDeposit = ($rulesDetail["security_deposit"] != '')?$rulesDetail["security_deposit"]:0;
										}
										else{
											$securityDeposit = ($rulesDetail["security_deposit"] != '')?($totalWithoutSecurity*$rulesDetail["security_deposit"])/100:0;
										}
										echo '$'.$securityDeposit;
										?>
									</span> 
									<input type="hidden" value="<?php echo $rulesDetail["security_options"]; ?>" id="deposit">
                                </div><!-- row ends -->
                                
                                <div class="charg-row">
                                	<p>GRAND TOTAL</p>
                                     <span class="grand-total-amount">$ <?php echo $securityDeposit+$totalWithoutSecurity; ?></span> 
                                </div><!-- row ends -->
							<?php			
								$_SESSION['Security']=$securityDeposit;
								$_SESSION['total_amount']=$securityDeposit+$totalWithoutSecurity;
								//$_SESSION['total_amount']=$securityDeposit+$totalWithoutSecurity;
							?>            
                            </div><!-- charg ends -->
                    <input type="hidden" name="security-dep" id="security-dep" value="<?php echo $securityDeposit; ?>">
                    <input type="hidden" name="duration" id="duration" value="<?php echo $duration; ?>">
					<input type="hidden" name="total-amount" id="total-amount" value="<?php echo ($sum+$securityDeposit+$additionalSum); ?>">
					<input type="hidden" name="listing_id" value="<?php echo isset($_POST["listing_id"])?$_POST["listing_id"]:''; ?>">        
                    </div><!-- links ends -->
                    <div class="booking-confermation">
                    	<p class="confirmed">As soon as you will complete your payment your reservation wil be confirmed</p>
                    </div>   
					<div class="submit-booking">
						<input type="submit" value="Book Now" name="op" id="edit-submit" class="list-btn btn-bg form-submit">  
                     </div>   
                    
                    
                </div><!-- sidebar ends -->
        		    
            </div><!-- from ends -->   
		</form>
         </div><!-- full width wrapper ends --> 
</div>

<script>
var $ = jQuery;
var $extraDuration = 0;
var $parsed_date = '';
jQuery(function() {
	var preferredTime = '<?php echo isset($_SESSION['postedData']["preferred-time"])?$_SESSION['postedData']["preferred-time"]:0;?>';
<?php
	if($pricingData[0]["price_type"] == 'PER_MINUTE'){
		$maxDuration = ceil(($schedulingData['maxDuration']/(24*60)));

?>
	
	if(preferredTime != 0){
		var preferredTime1 = preferredTime.split('-');
		if(preferredTime1[1] == 'AM'){
			var min = preferredTime1[0];
		}
		else{
			var min = preferredTime1[0].split(':');
			if(min[0] == 12){
				var minVlaue = parseInt(min[0]);
			}
			else{
				var minVlaue = (parseInt(min[0])+12);
			}
			min = minVlaue+':'+min[1];
		}
		min = min.split(':');
		var totalDuration = parseInt(min[0])+<?php echo ($schedulingData['maxDuration'] != '')?$schedulingData['maxDuration']:0; ?>;
		if(parseInt(totalDuration)>24){
			$extraDuration = 1; 
			$parsed_date = new Date(<?php echo date("Y",strtotime($_SESSION['postedData']["booking-on"])); ?>, <?php echo date("m",strtotime($_SESSION['postedData']["booking-on"])); ?>-1, <?php echo date("d",strtotime($_SESSION['postedData']["booking-on"])); ?>+$extraDuration+<?php echo ($maxDuration-1); ?>);
			var $ = jQuery;
			$('#datetimepicker2').datepicker('destroy');
			DatePicker($parsed_date);
		}
		jQuery('#session-time').timepicker(
		{
			'step': 15 ,
			minTime: new Date(0, 0, 0, min[0], parseInt(min[1])+15, 0),
			maxTime: new Date(0, 0, 0, min[0], parseInt(min[1])+<?php echo $schedulingData['maxDuration']; ?>, 0),
		});
		jQuery('#session-time').val(preferredTime1[0]+preferredTime1[1]);
	}
	else{
		<?php
			$min = substr($_SESSION['postedData']['session-time'],0,-2);
			$min = explode(':',$min);
			$minTime = substr($_SESSION['postedData']['session-time'],-2);
			if($maxDuration>1){ 
		?>
			jQuery('#session-time').timepicker(
			{
				'step': 15 ,
				minTime: new Date(0, 0, 0, <?php $min = substr($_SESSION['postedData']['session-time'],0,-2);$min = explode(':',$min); echo $min[0]; ?>, <?php echo $min[1]+15; ?>, 0),
				
			});	
		<?php } else{ ?>
			jQuery('#session-time').timepicker(
			{
				'step': 15 ,
				minTime: new Date(0, 0, 0, <?php $min = substr($_SESSION['postedData']['session-time'],0,-2);$min = explode(':',$min); echo $min[0]; ?>, <?php echo $min[1]+15; ?>, 0),
				maxTime: new Date(0, 0, 0, <?php $min = substr($_SESSION['postedData']['session-time'],0,-2);$min = explode(':',$min); echo $min[0]; ?>,<?php echo $schedulingData['maxDuration']+$min[1]; ?>, 0),
			});			
		<?php } ?>
		jQuery('#session-time').val('<?php echo $min[0].":".($min[1]+15).' '.$minTime; ?>');
	}
<?php
}
else if($pricingData[0]["price_type"] == 'PER_HOUR'){
		$maxDuration = ceil(($schedulingData['maxDuration']/(24)));
?>
	if(preferredTime != 0){
		var preferredTime1 = preferredTime.split('-');
		if(preferredTime1[1] == 'AM'){
			var min = preferredTime1[0];
		}
		else{
			var min = preferredTime1[0].split(':');
			if(min[0] == 12){
				var minVlaue = parseInt(min[0]);
			}
			else{
				var minVlaue = (parseInt(min[0])+12);
			}
			min = minVlaue+':'+min[1];
		}
		min = min.split(':');
		var totalDuration = parseInt(min[0])+<?php echo ($schedulingData['maxDuration'] != '')?$schedulingData['maxDuration']:0; ?>;
		if(parseInt(totalDuration)>24){
			$extraDuration = 1; 
			$parsed_date = new Date(<?php echo date("Y",strtotime($_SESSION['postedData']["booking-on"])); ?>, <?php echo date("m",strtotime($_SESSION['postedData']["booking-on"])); ?>-1, <?php echo date("d",strtotime($_SESSION['postedData']["booking-on"])); ?>+$extraDuration+<?php echo ($maxDuration-1); ?>);
			var $ = jQuery;
			$('#datetimepicker2').datepicker('destroy');
			DatePicker($parsed_date);
		}
		if((<?php echo $schedulingData['maxDuration']; ?>+parseInt(min[0]))<24){
			jQuery('#session-time').timepicker(
			{
				'step': 60 ,
				minTime: new Date(0, 0, 0, parseInt(min[0])+1, min[1], 0),
				maxHour: <?php echo ($schedulingData['maxDuration'] != '')?$schedulingData['maxDuration']:24; ?>,
				maxTime: new Date(0, 0, 0, <?php echo $schedulingData['maxDuration']; ?>+parseInt(min[0]), min[1], 0)
			});
		}
		else{
			jQuery('#session-time').timepicker(
			{
				'step': 60 ,
				minTime: new Date(0, 0, 0, parseInt(min[0])+1, min[1], 0),
				maxHour: <?php echo ($schedulingData['maxDuration'] != '')?$schedulingData['maxDuration']:24; ?>,
				maxTime: new Date(0, 0, 0, 24, 0, 0)
			});		
		}
		jQuery('#session-time').val(preferredTime1[0]+preferredTime1[1]);
	}
	else{
		<?php 
			$min = substr($_SESSION['postedData']['session-time'],0,-2);
			$min = explode(':',$min);
			$minTime = substr($_SESSION['postedData']['session-time'],-2);
			if($minTime == 'AM'){
				if($min[0] != 12){
					$showMin = $min[0]+1;
				}
				else{
					$showMin = 1;
				}
			}
			else{
				if($min[0] != 12){
					$showMin = $min[0]+1+12;
				}
				else{
					$showMin = $min[0]+1;
				}
			}
		?>
		jQuery('#session-time').timepicker(
		{
			'step': 60 ,
			minTime: new Date(0, 0, 0, <?php echo $showMin; ?>, <?php echo ($min[1] != '')?$min:0; ?>, 0),
			maxTime: new Date(0, 0, 0, <?php echo $showMin; ?>,<?php echo $schedulingData['maxDuration']*60; ?>, 0),
		});	
		jQuery('#session-time').val('<?php echo $showMin.":".$min[1].' '.$minTime; ?>');
	}
<?php
}
else if($pricingData[0]["price_type"] == 'PER_DAY'){
		$maxDuration = $schedulingData['maxDuration'];
?>
	jQuery('#session-time').timepicker({ 'step': 60 });
<?php 
}

if($maxDuration < 1){
	$maxDuration = 1;
}
?>
$parsed_date = new Date(<?php echo date("Y",strtotime($_SESSION['postedData']["booking-on"])); ?>, <?php echo date("m",strtotime($_SESSION['postedData']["booking-on"])); ?>-1, <?php echo date("d",strtotime($_SESSION['postedData']["booking-on"])); ?>+$extraDuration+<?php echo ($maxDuration-1); ?>);

jQuery("#preferred-time").on('change',function(){

<?php
if($pricingData[0]["price_type"] == 'PER_MINUTE'){
?>
	var Ttime = jQuery(this).val();
	var preferredTime1 = Ttime.split('-');
	if(preferredTime1[1] == 'AM'){
		var min = preferredTime1[0];
	}
	else{
		var min = preferredTime1[0].split(':');
		var minVlaue = (parseInt(min[0])+12);
		min = minVlaue+':'+min[1];
	}
	min = min.split(':');
	var totalDuration = parseInt(min[0])+<?php echo ($schedulingData['maxDuration'] != '')?$schedulingData['maxDuration']:0; ?>;
	if(parseInt(totalDuration)>24){
		$extraDuration = 1; 
		$parsed_date = new Date(<?php echo date("Y",strtotime($_SESSION['postedData']["booking-on"])); ?>, <?php echo date("m",strtotime($_SESSION['postedData']["booking-on"])); ?>-1, <?php echo date("d",strtotime($_SESSION['postedData']["booking-on"])); ?>+$extraDuration+<?php echo ($maxDuration-1); ?>);
		var $ = jQuery;
		$('#datetimepicker2').datepicker('destroy');
		DatePicker($parsed_date);
	}
	$('#session-time').timepicker('remove');
	jQuery('#session-time').timepicker(
	{
		'step': 15 ,
		minTime: new Date(0, 0, 0, min[0], parseInt(min[1])+15, 0),
		maxTime: new Date(0, 0, 0, min[0], parseInt(min[1])+<?php echo $schedulingData['maxDuration']; ?>, 0),
	});
	jQuery('#session-time').val(preferredTime1[0]+preferredTime1[1]);
<?php 
}
else if($pricingData[0]["price_type"] == 'PER_HOUR'){
?>
	var Ttime = jQuery(this).val();
	var preferredTime1 = Ttime.split('-');
	if(preferredTime1[1] == 'AM'){
		var min = preferredTime1[0];
	}
	else{
		var min = preferredTime1[0].split(':');
		var minVlaue = (parseInt(min[0])+12);
		min = minVlaue+':'+min[1];
	}
	min = min.split(':');
	var totalDuration = parseInt(min[0])+<?php echo ($schedulingData['maxDuration'] != '')?$schedulingData['maxDuration']:0; ?>;
	if(parseInt(totalDuration)>24){
		$extraDuration = 1; 
		$parsed_date = new Date(<?php echo date("Y",strtotime($_SESSION['postedData']["booking-on"])); ?>, <?php echo date("m",strtotime($_SESSION['postedData']["booking-on"])); ?>-1, <?php echo date("d",strtotime($_SESSION['postedData']["booking-on"])); ?>+$extraDuration+<?php echo ($maxDuration-1); ?>);
		var $ = jQuery;
		$('#datetimepicker2').datepicker('destroy');
		DatePicker($parsed_date);
	}
	$('#session-time').timepicker('remove');
	jQuery('#session-time').timepicker(
	{
		'step': 60 ,
		minTime: new Date(0, 0, 0, parseInt(min[0])+1, min[1], 0),
		maxTime: new Date(0, 0, 0, min[0], parseInt(min[1])+<?php echo $schedulingData['maxDuration']*60; ?>, 0),
	});
	jQuery('#session-time').val(preferredTime1[0]+preferredTime1[1]);
<?php 
}
?>
});

<?php
	if($pricingData[0]["price_type"] == 'PER_MINUTE'){
		$bookingDateTime = strtotime($_SESSION['postedData']["booking-on"]);
	}
	else if($pricingData[0]["price_type"] == 'PER_HOUR'){
		$bookingDateTime = strtotime($_SESSION['postedData']["booking-on"]);
	}
	else if($pricingData[0]["price_type"] == 'PER_DAY'){
		$bookingDateTime = strtotime($_SESSION['postedData']["booking-on"])+24*60*60;
	}
	
?>
DatePicker($parsed_date);

jQuery("#session-time").change(function(){
	var $ = jQuery;
	var toDAte = jQuery("#datetimepicker2").val().split('-');
	var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
	var firstDate = new Date(<?php echo date("Y",strtotime($_SESSION['postedData']["booking-on"])); ?>,<?php echo (date("m",strtotime($_SESSION['postedData']["booking-on"]))-1); ?>,<?php echo date("d",strtotime($_SESSION['postedData']["booking-on"])); ?>);
	var secondDate = new Date(toDAte[0],parseInt(toDAte[1]-1),toDAte[2]);

	var diffDays = Math.round(Math.abs((secondDate.getTime() - firstDate.getTime())/(oneDay)));
		
		
	var preferredTime = '<?php echo isset($_SESSION['postedData']["preferred-time"])?$_SESSION['postedData']["preferred-time"]:0;?>';
	var bookingTime = jQuery(this).val();
	if($("#price_type").val() == 'PER_HOUR'){
		if(preferredTime != 0){
			preferredTime = preferredTime.replace("-", ""); 
			changeCalculation(bookingTime,preferredTime,diffDays);			
		}		
		else{
			var fromTime = "<?php echo $_SESSION['postedData']["session-time"]; ?>";
			changeCalculation(bookingTime,fromTime,diffDays);
			
		}	
	}
	else if($("#price_type").val() == 'PER_MINUTE'){
		if(preferredTime != 0){
			changeCalculation(bookingTime,preferredTime,diffDays);		
		}
		else{
			var fromTime = "<?php echo $_SESSION['postedData']["session-time"]; ?>";
			changeCalculation(bookingTime,fromTime,diffDays);		
			
		}	
	}
});


});



function DatePicker($parsed_date){
		var $ = jQuery;
		$('#datetimepicker2').datepicker('destroy');
		$("#datetimepicker2").datepicker({
			dateFormat: 'yy-mm-dd',
			minDate: new Date('<?php echo date("Y/m/d",$bookingDateTime); ?>'),
			maxDate: $parsed_date,
			onSelect: function(date) {
				date = date.split('-');
				var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
				var firstDate = new Date(<?php echo date("Y",strtotime($_SESSION['postedData']["booking-on"])); ?>,<?php echo (date("m",strtotime($_SESSION['postedData']["booking-on"]))-1); ?>,<?php echo date("d",strtotime($_SESSION['postedData']["booking-on"])); ?>);
				var secondDate = new Date(date[0],parseInt(date[1]-1),date[2]);

				var diffDays = Math.round(Math.abs((secondDate.getTime() - firstDate.getTime())/(oneDay)));
				if($("#price_type").val() == 'PER_DAY'){
					getPriceByQuantity(diffDays);
				}
				else if($("#price_type").val() == 'PER_MINUTE'){
/* 					if(preferredTime){
						changeCalculation(bookingTime,preferredTime,diffDays);			
					}
					else{
						changeCalculation(bookingTime,preferredTime,diffDays);		
						
					}	 */
				}
				else if($("#price_type").val() == 'PER_HOUR'){
					var preferredTime = '<?php echo isset($_SESSION['postedData']["preferred-time"])?$_SESSION['postedData']["preferred-time"]:0;?>';
					var fromTimeArray = preferredTime.slice(0,-3).split(':');
					var bookingTime = jQuery("#session-time").val();
					jQuery('#session-time').timepicker('remove');
					if(diffDays>0){
						
						if(preferredTime.indexOf("AM") >= 0){
							
							var mxhour = <?php echo $schedulingData['maxDuration']; ?>-(24-parseInt(fromTimeArray[0]));
						}
						else{
							var mxhour = <?php echo $schedulingData['maxDuration']; ?>-(12-parseInt(fromTimeArray[0]));
						}
						jQuery('#session-time').timepicker(
						{
							'step': 60 ,
							maxHour: mxhour,
							maxTime: new Date(0, 0, 0, mxhour, 0, 0),
						});
					}
					else{
						jQuery('#session-time').timepicker(
						{
							'step': 60 ,
							minTime: new Date(0, 0, 0, (parseInt(fromTimeArray[0])+1), fromTimeArray[1], 0),
							maxHour: <?php echo ($schedulingData['maxDuration'] != '')?$schedulingData['maxDuration']:24; ?>,
							maxTime: new Date(0, 0, 0, 24, 0, 0)
						});						
					}
/* 					if(preferredTime){
						changeCalculation(bookingTime,preferredTime,diffDays);			
					}
					else{
						changeCalculation(bookingTime,preferredTime,diffDays);		
						
					}	 */
				}
			},
		});
}

function changeCalculation(bookingTime,preferredTime,diffDays){
	var bookingTimeArray = bookingTime.slice(0,-2).split(':');
	var fromTimeArray = preferredTime.slice(0,-2).split(':');
	if(diffDays>0){
		
		if(preferredTime.indexOf("AM") >= 0){
			if(bookingTime.indexOf("AM") >= 0){
				var timeDiffernceInHours = parseInt(bookingTimeArray[0])+(12-parseInt(fromTimeArray[0]));
			}
			else{
				var timeDiffernceInHours = parseInt(bookingTimeArray[0])+(24-parseInt(fromTimeArray[0]));
			}
		}
		else{
			if(bookingTime.indexOf("AM") >= 0){
				if(bookingTimeArray[0] == 12){
					var timeDiffernceInHours = parseInt(12-parseInt(fromTimeArray[0]));
				}
				else{
					var timeDiffernceInHours = parseInt(bookingTimeArray[0])+(12-parseInt(fromTimeArray[0]));
				}
			}
			else{
				var timeDiffernceInHours = parseInt(bookingTimeArray[0])+(24-parseInt(fromTimeArray[0]));
			}
		}	
	}
	else{
		if(preferredTime.indexOf("AM") >= 0){
			if(bookingTime.indexOf("AM") >= 0){
				var timeDiffernceInHours = parseInt(bookingTimeArray[0])-parseInt(fromTimeArray[0]);
			}
			else{
				if(bookingTimeArray[0] == 12){
					var timeDiffernceInHours = parseInt(bookingTimeArray[0])-parseInt(fromTimeArray[0]);
				}
				else{
					var timeDiffernceInHours = parseInt(parseInt(bookingTimeArray[0])+12)-parseInt(fromTimeArray[0]);
				}
			}
		}
		else{
			if(fromTimeArray[0] == 12){
				var timeDiffernceInHours = parseInt(parseInt(bookingTimeArray[0])+12)-parseInt(fromTimeArray[0]);
			}
			else{
				var timeDiffernceInHours = parseInt(bookingTimeArray[0])-parseInt(fromTimeArray[0]);
			}
		}		
	}
	var totalTimeDifferece = timeDiffernceInHours;
	if($("#price_type").val() == 'PER_MINUTE'){
		if(fromTimeArray[0] == bookingTimeArray[0]){
			totalTimeDifferece = parseInt(bookingTimeArray[1])-parseInt(fromTimeArray[1]);
		}
		else{
			if(timeDiffernceInHours>1){
				totalTimeDifferece = ((60-parseInt(fromTimeArray[1]))+parseInt(bookingTimeArray[1]))+(parseInt(timeDiffernceInHours)-1)*60;
			}
			else{
				totalTimeDifferece = (60-parseInt(fromTimeArray[1]))+parseInt(bookingTimeArray[1]);
			}
		}
	}
	getPriceByQuantity(totalTimeDifferece);
/* 	var text = $(".payment ul .calculation p").text();
	text = text.split('X');
	$(".payment ul .calculation p").text(text[0]+'X'+text[1]+'X'+totalTimeDifferece+":");
	var price = parseInt(text[0])*parseInt(text[1])*totalTimeDifferece;
	$(".payment ul .calculation span").text("$"+price);
	
	var security = $("#security-dep").val();
	var additional = $("#additional-services-amount").val();

	var totalAmonut = parseInt(price)+parseInt(security)+parseInt(additional);
	$(".total-amount").text("$"+totalAmonut);
	$("#total-amount").val(totalAmonut); */
}

function getPriceByQuantity(totalTimeDifferece){
	jQuery.ajax({
		url : "<?php echo $base_url; ?>/experience/pricing",
		type: "POST",
		data : {'qty':totalTimeDifferece,'listing_id':<?php echo $_SESSION['postedData']["listing_id"]; ?>},
		success: function(data)
		{
			var data = jQuery.parseJSON(data);
			var text = $(".payment ul .calculation p").text();
			var durationPrice = $(".durationPrice").val();
			var quantity = $(".quantity").val();
			var sum = $(".sum").val();
			text = text.split('X');
			if(data.price){
				if(data.gtype == 'EACH'){
					$(".chart-col .duration").text("x "+totalTimeDifferece);
					var durationTotalPrice = parseInt(totalTimeDifferece)*parseInt(quantity)*parseInt(data.price);
				}
				else{
					$(".chart-col .duration").text("x 1");
					var durationTotalPrice = parseInt(data.price)*parseInt(quantity);	
				}
			}
			else{
				$(".chart-col .duration").text("x "+totalTimeDifferece);
				/* alert(totalTimeDifferece+"=="+quantity+"==="+durationPrice); */
				var durationTotalPrice = parseInt(totalTimeDifferece)*parseInt(quantity)*parseInt(durationPrice);
			}
			var securityDeposit = $("#security-dep").val();
			var additional = $("#additional-services-amount").val();
			$("#duration").val(totalTimeDifferece);
			var depositType = $("#deposit").val();
			if(depositType.length > 0){
				var totalWithoutSecurity = parseInt(durationTotalPrice)+parseInt(additional);
				if(depositType == "amount_in_$"){
					securityDeposit = $("#security-dep").val();
				}
				else{
					securityDeposit = (parseInt(totalWithoutSecurity)*parseInt(<?php echo $rulesDetail["security_deposit"]; ?>))/100;
				}
				$(".charg-row .deposit").text("$"+securityDeposit);
			}
			var grandTotal = parseInt(durationTotalPrice)+parseInt(securityDeposit)+parseInt(additional);

			$(".chart-col .total").text("$ "+durationTotalPrice);
			$(".charg-row .sum").text("$"+durationTotalPrice);
			$(".charg-row .grand-total-amount").text("$"+grandTotal);
			$("#total-amount").val(grandTotal);

		},
		error: function (jqXHR, textStatus, errorThrown)
		{
	 
		}
	});
}
jQuery("#durationValue").change(function(){
	getPriceByQuantity(jQuery(this).val());
});
</script>