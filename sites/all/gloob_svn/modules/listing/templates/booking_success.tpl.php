<?php
$postedData = $_SESSION['postedData'];
$schedulingData=getSchedulingData($_SESSION['listing_id']);
$pricingData = getPricingData($_SESSION['listing_id']);
$OverviewData=getOverviewData($_SESSION['listing_id']);
$photos = getPhotosData($_SESSION['listing_id']);
$userDetails = user_load($OverviewData["uid"]);	
$rulesDetail=getRulesDetails($_SESSION['listing_id']);
$extras = getProductExtraData($_SESSION['listing_id']);
$rulesDetail=unserialize($rulesDetail["value1"]);
drupal_add_js(drupal_get_path('theme', 'gloobers2') .'/js/jquery.validate.min.js',array('scope' => 'footer'));	
drupal_add_js(drupal_get_path('theme', 'gloobers') .'/js/jQuery.print.js',array('scope' => 'footer'));		
drupal_add_css(drupal_get_path('theme', 'gloobers') .'/css/tkt-css.css');		
/* echo "<pre>";
print_r($_SESSION);
die; */
global $base_url;
?>
 <div class="dr-form-width-wrapper">
         	<div class="dr-paymnet-form">
            <div class="congrtts-text">
            	 <h1>Thanks For Travelling with Gloobers</h1>
                 <p> Cheer Up! Your Reservation has been validated with success  </p>
            </div><!-- congrets text -->
		<div id="divToPrint">	
            <div class="left-col-payment-outer">
            
            	<div class="left-col-payment">
                	<h1>Booking Summary (Booking ID: <?php echo arg(2); ?>)</h1>
                	
                    <div class="booking-summry">
                    
                    	<div class="row-sum">
                            <div class="col-sum">
                                <label>Check-in</label>
                                <p><?php echo date('d, F Y',strtotime($postedData["booking-on"])).' '.$postedData["session-time"]; ?></p>
								
							</div><!-- col ends -->
						<?php 
							if(isset($postedData["session-date"]) && $postedData["session-date"] != '')
							{
						?>                           
                            <div class="col-sum">
                                <label>Session</label>
                                <p><?php echo date('d, F Y',strtotime($postedData["session-date"]))." ".$postedData["session-time"]; ?></p>
								
							</div><!-- col ends -->
                        <?php 
							}
						?>    
                            <div class="col-sum">
                                <label>Quantity</label>
								<?php 
									foreach($postedData["participants"] as $key=>$value){
									$key = explode("|",$key);
								?>
								<p><?php echo ucwords($key[0]); ?> : <?php echo ($value != '')?$value:0;  if($key[0] == 'group') echo ' person'; ?></p>
								<?php 
									}
									$_SESSION['participants']=serialize($postedData["participants"]);
								?>
                            </div><!-- col ends -->
                        </div><!-- row-sum ends -->
					<div class="row-sum">
						<?php 
						$_SESSION['booking-on']=$postedData["booking-on"];
						$_SESSION['booking-on_time']=$postedData["session-time"];
							if($schedulingData["bookingTimeMode"] == 'FIXED'){
								$bookingFixedTimes = unserialize($schedulingData["bookingFixedTimes"]);
						?>
						 <div class="col-sum">
							<label>Preferred Time</label>
							<p><?php echo $postedData["preferred-time"] ?></p>
						</div>
						<?php 
						}
							if($pricingData[0]["price_type"] == 'PER_DAY' || $pricingData[0]["price_type"] == 'PER_MINUTE' || $pricingData[0]["price_type"] == 'PER_HOUR'){
							
								if($schedulingData["bookingMode"] != 'INVENTORY' && $schedulingData["durationType"] == 'Any'){
									if($pricingData[0]["price_type"] == 'PER_MINUTE'){
										$bookingDateTime = strtotime($postedData["booking-on"]);
									}
									else if($pricingData[0]["price_type"] == 'PER_HOUR'){
										$bookingDateTime = strtotime($postedData["booking-on"]);
									}
									else if($pricingData[0]["price_type"] == 'PER_DAY'){
										$bookingDateTime = strtotime($postedData["booking-on"])+24*60*60;
									}
						?>
							<div class="col-sum">
								<label>Check-out</label>
								<p><?php echo date('d, F Y',strtotime($_SESSION["check-out"])).' '.$_SESSION['session-time']; ?></p>
						<?php 
								if($pricingData[0]["price_type"] == 'PER_MINUTE' || $pricingData[0]["price_type"] == 'PER_HOUR'){
						?>		
								<!--<p><?php echo $postedData["session-time"] ?></p>-->
						<?php 
								}
						?>
							</div>
						<?php 
								}
								else if($schedulingData["bookingMode"] != 'INVENTORY' && $schedulingData["durationType"] == 'LIST'){
									$DurationOption = unserialize($schedulingData["DurationOption"]);
						?>
							<div class="col-sum">
								<label>Duration</label>
								<p><?php echo $_SESSION['duration']; ?></p>
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
						$imgpath = '';
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
					
					</div>
					<?php 
						$additionalSum = 0;
						if(isset($postedData["additional-services"])){
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
								foreach($extras as $key=>$value){
									$qty = array_search($value['meta_id'], $postedData["additional-services"]);
									if ($qty) {
										$extrasVal = unserialize($value["value1"]);
										$additionalSum = $additionalSum+($extrasVal["price"]*$qty);					 
							?>           
                                	  <div class="chart-row">
                                    	<div class="chart-col">
                                         <p><?php echo $extrasVal["title"]; ?></p>
                                        </div><!-- col ends -->
                                        
                                        <div class="chart-col">
                                         <p> <?php echo $qty ?></p>
                                        </div><!-- col ends -->
                                        
                                        <div class="chart-col">
                                         <p> <?php echo $extrasVal["price"]; ?></p>
                                        </div><!-- col ends -->
                                        
                                        <div class="chart-col">
                                         <p>$<?php echo $extrasVal["price"]*$qty; ?></p>
                                        </div><!-- col ends -->
                                      </div><!-- row ends -->       
                            <?php 
									}
								}
								 $i=0;				
								foreach ($_GET["additional-services"] as $key=>$value)
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
										<p> <?php echo $key[1]; ?></p>
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
										<p> <?php echo $key[1]; ?></p>
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
										<p> <?php echo $key[1]; ?></p>
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
										<p> <?php echo $key[1]; ?></p>
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
										<p> <?php echo $key[1]; ?></p>
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
										<p>$ <?php echo $key[1]; ?></p>
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
										<p> <?php echo ucwords($value); ?></p>
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
										<p><?php echo ucwords($key[0]); ?></p>
									</div>
									<div class="chart-col">
										<p> <?php echo $value; ?></p>
									</div>
									<div class="chart-col">
										<p>$ <?php echo $textLabel; ?></p>
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
										<p><?php echo ucwords($key[0]); ?></p>
									</div>
									<div class="chart-col">
										<p> <?php echo $value; ?></p>
									</div>
									<div class="chart-col">
										<p>$ <?php echo $textLabel; ?></p>
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
                            
                            <div class="total-charg">
                            
                            	<div class="charg-row">
                                	<p>SUB TOTAL</p>
                                     <span class="sum">$<?php echo $sum; ?></span> 
                                     <input type="hidden" class="sum" value="<?php echo $sum; ?>">
                                </div>
							<?php 
								if($additionalSum){
							?>
                             	<div class="charg-row">
                                	<p>ADDITIONAL SERVICES</p>
                                     <span>$<?php echo $additionalSum; ?></span> 
                                </div>
							<?php 
								}
							?>
                                <div class="charg-row">
                                	<p>SECURITY DEPOSIT</p>
                                     <span>	
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
                                </div>
								<?php 
									if(isset($_SESSION['discount'])){
								?>
									<div class="charg-row">
										<p>DISCOUNT</p>
										 <span class="grand-total-amount">(-)$<?php echo $_SESSION['discount']; ?></span> 
									</div>
								<?php 
									}
								?>								
                                <div class="charg-row">
                                	<p>GRAND TOTAL</p>
                                     <span class="grand-total-amount">$ <?php echo ($securityDeposit+$totalWithoutSecurity-$_SESSION['discount']); ?></span> 
                                </div>
							<?php			
								$_SESSION['Security']=$securityDeposit;
								$_SESSION['total_amount']=$securityDeposit+$totalWithoutSecurity-$_SESSION['discount'];
							?>            
                            </div><!-- charg ends -->
                    </div><!-- links ends -->
  					<div class="submit-booking">
						<input onclick="PrintDiv();" type="button" value="Print Ticket" name="op" id="edit-submit" class="list-btn btn-bg form-submit">  
                     </div>                 
                    
                </div><!-- sidebar ends -->
        		    
            </div><!-- from ends -->   
         </div>
</div><!-- full width wrapper ends --> 
<!-- ticket HTML ------------------------>
<div style="display:none;">
	<div class="dr-tkt-outer" id="ele2">
    	<div class="tkt-info-col">
        	<div class="tkt-header">
            	<a class="brand-icon">
               		<img src="<?php print $base_url .'/'. drupal_get_path('theme', 'gloobers'); ?>/images/brand.png" alt="gloobers" />
                </a><!-- icon ends -->
                
                	<div class="tkt-number">
                    	<p><?php echo arg(2); ?></p>
                    </div><!-- tkt number -->
            </div><!-- header ends -->
            	<div class="gen-tkt-info">
                	<p><?php echo $OverviewData['title']; ?>,</p>
                    <p><?php echo date('d, F Y',strtotime($postedData["booking-on"])).' '.$postedData["session-time"]; ?></p>
                    <p><?php echo $OverviewData['address1']; ?>, <?php echo $OverviewData['city']; ?>, <?php echo $OverviewData['country']; ?></p>
                </div><!-- info ends -->
                	<div class="travel-term"><p><span>Terms And Conditions Apply</span></p></div>
                    <div class="tkt-manuals">
                    	<div class="col-left-info">
                        	<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. LoremIpsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                        </div><!-- left ends -->
                    		<div class="col-right-info">
                       	    <img src="<?php print $base_url .'/'. drupal_get_path('theme', 'gloobers'); ?>/images/bar-cod-tkt.png" width="276" height="66" alt="bar code" />
                            </div><!-- col right info -->  
                                              
                    </div><!-- tkt manuals ends -->
       	    </div><!-- tkt-info col nds -->
    
    
    		<!-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ user end part \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ -->
            
            <div class="dr-user-col">
            	<div class="dr-flip">
           		 <div class="right-info">
            	<div class="tkt-number">
               	  <p><?php echo arg(2); ?></p>
                    
                    <p><img src="<?php print $base_url .'/'. drupal_get_path('theme', 'gloobers'); ?>/images/brand-black.png" /></p>
                    
                    <p class="head"><span>Venue</span></p>
                    <p><span><?php echo $OverviewData['address1']; ?>, <?php echo $OverviewData['city']; ?>, <?php echo $OverviewData['country']; ?></span></p>
                    
                </div><!-- number ends -->
            </div><!-- right info ends -->
             <div class="bar-code">
               	    	<img src="<?php print $base_url .'/'. drupal_get_path('theme', 'gloobers'); ?>/images/bar-code-user.png" alt="bar code" />
                    </div><!-- code ends -->
                    
                    	<div class="dr-event-time">
                        	<div class="dr-col-half">
                            	<p>Date &amp; Time</p>
                                <p><span><?php echo date('d, F Y',strtotime($postedData["booking-on"])).' '.$postedData["session-time"]; ?></span></p>
                            </div><!-- col half -->
                            <div class="dr-col-half">
                            	<p>Quantity</p>
								<?php 
									foreach($postedData["participants"] as $key=>$value){
									$key = explode("|",$key);
								?>
								<p><?php echo ucwords($key[0]); ?> : <?php echo ($value != '')?$value:0;  if($key[0] == 'group') echo ' person'; ?></p>
								<?php 
									}
									$_SESSION['participants']=serialize($postedData["participants"]);
								?>
                            </div><!-- col half -->
					<?php 
						$additionalSum = 0;
						if(isset($postedData["additional-services"])){
					?>
					<div class="right-sidebar" style="width:100%">
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
									foreach($extras as $key=>$value){
										$qty = array_search($value['meta_id'], $postedData["additional-services"]);
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
											 <p> <?php echo $extras["price"]; ?></p>
											</div><!-- col ends -->
											
											<div class="chart-col">
											 <p>$<?php echo $extras["price"]*$qty; ?></p>
											</div><!-- col ends -->
										  </div><!-- row ends -->       
								<?php 
										}
									}
									 $i=0;				
									foreach ($_GET["additional-services"] as $key=>$value)
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
					</div>
				<?php 
					}
				?>                   
                        </div><!-- event time ends -->
                    
                    
            	</div><!-- flip ends-->
            </div><!-- user col ends -->
    
    </div><!-- uter ends -->
</div>	
<script type='text/javascript'>
            //<![CDATA[
            jQuery(function() {
                jQuery(".submit-booking").find('input').on('click', function() {
                    //Print ele2 with custom options
                    jQuery("#ele2").print({
                        //Use Global styles
                        globalStyles : true,

                        //Add link with attrbute media=print
                        mediaPrint : true,

                        //Custom stylesheet
                        stylesheet : "<?php print $base_url .'/'. drupal_get_path('theme', 'gloobers'); ?>/css/tkt-css.css",

                        //Print in a hidden iframe
                        iframe : false,
                    });
                });

           });
            //]]>
</script>