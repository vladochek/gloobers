<?php
drupal_add_css(drupal_get_path('theme', 'gloobers') .'/css/slimmenu.css','file'); 
drupal_add_css(drupal_get_path('theme', 'gloobers') .'/css/jquery-ui.css','file'); 
drupal_add_css(drupal_get_path('theme', 'gloobers') .'/css/responsiveslides-experience.css','file'); 
drupal_add_css(drupal_get_path('theme', 'gloobers') .'/css/demo-experience.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers') .'/css/responsive-styles.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers') .'/css/jquery.fs.stepper.css','file');  
drupal_add_css(drupal_get_path('theme', 'gloobers') .'/css/colorbox.css','file');  
drupal_add_css(drupal_get_path('theme', 'gloobers') .'/css/jRating.jquery.css','file');  
drupal_add_css(drupal_get_path('theme', 'gloobers') .'/css/bootstrap-datetimepicker.min.css','file');  
drupal_add_css(drupal_get_path('theme', 'gloobers') .'/css/jquery.timepicker.css','file');  
drupal_add_css(drupal_get_path('theme', 'gloobers') .'/css/jquery.calendarPicker.css','file');  


drupal_add_js(drupal_get_path('theme', 'gloobers') .'/js/jquery-ui.js',array('scope' => 'footer'));
drupal_add_js(drupal_get_path('theme', 'gloobers') .'/js/responsiveslides.js',array('scope' => 'footer'));
/* drupal_add_js(drupal_get_path('theme', 'gloobers') .'/js/jquery.slimmenu.js',array('scope' => 'footer')); */
drupal_add_js(drupal_get_path('theme', 'gloobers') .'/js/jquery.fs.stepper.js',array('scope' => 'footer'));
drupal_add_js(drupal_get_path('theme', 'gloobers') .'/js/jquery.screwdefaultbuttonsV2.js',array('scope' => 'footer'));
drupal_add_js(drupal_get_path('theme', 'gloobers') .'/js/jquery.colorbox.js',array('scope' => 'footer'));
drupal_add_js(drupal_get_path('theme', 'gloobers') .'/js/jRating.jquery.js',array('scope' => 'footer'));
drupal_add_js(drupal_get_path('theme', 'gloobers') .'/js/custom.js',array('scope' => 'footer'));
drupal_add_js(drupal_get_path('theme', 'gloobers') .'/js/bootstrap-datetimepicker.min.js',array('scope' => 'footer'));
drupal_add_js(drupal_get_path('theme', 'gloobers') .'/js/jquery.timepicker.js',array('scope' => 'footer'));
drupal_add_js(drupal_get_path('theme', 'gloobers') .'/js/jquery.calendarPicker.js',array('scope' => 'footer'));

$userDetails = user_load($OverviewData["uid"]);

global $base_url;

/*  echo "<pre>";
print_r($scheduleSessionData); die;  */

?>

        <!-- ======================  slider ========================= -->
        
        	<div class="dr-full-slider dr-full-banner">
  
				<?php 
					$i = 1;
					$photos1 = array_shift($photos);
					foreach($photos1 as $photo){
					$photo 	= unserialize($photo);
					//$style 	= "thumbnail";
					$style 	= "listing_banner";			
					$file 	= file_load($photo["fid"]);
					$imgpath = $file->uri;
				?>
                  <img src="<?php print image_style_url($style,$imgpath); ?>" alt="">
				<?php
				}
				 ?>
            
                    <div class="add-photo">
                    	<div class="dr-full-width-wrapper">
                            
								<?php 
									$i = 1;
									foreach($photos as $photo){
										$photo 	= unserialize($photo["value1"]);
										$file 	= file_load($photo["fid"]);
										$imgpath = $file->uri;

								?>
                                <a <?php if($i>1) echo "style='display:none;' "; ?> title="<?php echo $photo["text"];  ?>" class="group1" href="<?php echo image_style_url('popup',$imgpath); ?>" ><button class="photo-btn" style="cursor:pointer;"><i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/cam-ico.png" alt="icon" /></i><span>More Pictures</span><i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/plus-ico.png" alt="ico" /></i></button></a>
								<?php 
									$i++;
									}
								?>
							
                         </div><!-- full width wrapper --> 
                        <div class="bottom-border"></div>       
                    </div><!-- add photot -->
                    
            </div><!-- slider -->
            
            
  <!-- ======================  title tab ========================= -->  

  	<div class="dr-title-tab">
    	<div class="dr-full-width-wrapper">
        	<div class="title-profile">
            	<div class="dr-profile">
                	<div class="title-dp">
					<?php 
						if($userDetails->picture != ""){
							$file 	= file_load($userDetails->picture->fid);
							$imgpath = $file->uri;
					?>
                    	<img src="<?php print file_create_url($imgpath); ?>" alt="display pic" />
					<?php 
						}
						else{
					?>
						<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/no-profile-male-img.jpg" alt="display pic" />
					<?php 
						}
					?>
					</div><!-- dp ends -->
                    	
					<a href="#">
						<?php 
							if($userDetails->field_first_name["und"][0]["value"] != ""){
								echo $userDetails->field_first_name["und"][0]["value"]." ".$userDetails->field_last_name["und"][0]["value"];
							}
							else{
								echo $userDetails->name;
							}
						?>
					</a>
                
                </div><!-- dr-profile ends -->
                	<div class="profile-title">
                    	<h5><?php echo ucwords($OverviewData["title"]); ?></h5>
                        <p> <?php echo $OverviewData["city"]; ?>, <?php echo $OverviewData["country"]; ?>, <a href="#"><?php echo $experienceType['experience_type']; ?></a></p>
                    
                           <!-- <ul class="profile-rating">
                            	<li><p><?php echo $reviewsCount; ?></p></li>
								<?php 
									foreach($SuperAverage1 as $average){
								?>
									<div class="basic" data-average="<?php echo $average->average_avg; ?>" data-id="1"></div>
								<?php 
								}
								?>
                            </ul> -->
                            
                              <ul class="profile-rating">
                            	<li><p>26</p></li>
                                <li><i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="rate me" /></i></li>
                                <li><i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="rate me" /></i></li>
                                <li><i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="rate me" /></i></li>
                                <li><i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="rate me" /></i></li>
                                <li><i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="rate me" /></i></li>
                            </ul><!-- profile rating -->
                    </div><!-- profile -title -->
              </div><!-- profil ends -->
              
              	<div class="title-session">
                	<div class="session-block active title-share">
                    	<p>share</p>
                        <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/plane-ico.png" alt="icon" /></span>
                        <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/drop-ico.png" alt="icon" /></i>
                    </div><!-- share -->
                    <form name="booking-form" id="booking-form" method="post" action="<?php echo $base_url;?>/booking/summary">
                		<div class="session-block title-date booking-date">
							<div id="member" class="toggle-div">
								<p>Select Date</p>
								<span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/cal-ico.png" alt="icon" /></span>
								<i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/drop-gray-ico.png" alt="icon" /></i>
							</div>
							<div class="total-members">
								<ul class="select-membr">
									<li><p>Date
									<?php 
										/* if() */
									?>
									</p></li>
									<li><input id="datetimepicker2" type="text" class="inputDate" placeholder="Select Date" name="booking-on" />			</li>
								</ul>
							</div>			
                        </div><!-- date -->
                        
                        	<div class="session-block title-date stepper-count">
                                <div id="member" class="toggle-div">
                                     <p>
										<?php
									
										if($pricingData[0]['quantity_required']==1)
										{
										$minQtyRequired=$pricingData[0]['quantity_min'];
										$maxQtyRequired=$pricingData[0]['quantity_max'];
										}
											if($pricingData[0]["price_type"] == 'PER_PERSON'){
												 $qtylabel='Participants';
												echo $qtylabel;
											}
											else if($pricingData[0]["price_type"] == 'PER_ITEM'){
											$qtylabel='Items';
											echo $qtylabel;
											}
											else{
											$qtylabel=($pricingData[0]['quantity_label_plural'] != '')?$pricingData[0]['quantity_label_plural']:'Participants';
												echo $qtylabel;
											}
										?>
									 </p>
									 
									<span class="quantity">0</span>
									
                                    <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/user-ico.png" alt="cal"/></span>
                                    <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/drop-gray-ico.png" alt="icon" /></i>
                                </div>
                                
                                	<!-- ============ toggle ============= -->
                                    <div class="total-members">
                                    	<ul class="select-membr">
										<?php
											$i = 1;
											foreach($pricingData as $price){
												$label="";
												$min = $price["quantity_min"];
												$max = $price["quantity_max"];
												$optionType = '';
												if($price["price_type"] == "PER_PERSON"){
													if($price["price_option_type"] == "everyone"){
												
														$label = "Quantity(Price $".$price['price'].")"; 
													}
													else if($price["price_option_type"] == "group"){
														if($price["min"] != "" && $price["max"] == ""){
														
															$min = $price["min"];
															$max = $price["max"];
															$label = "Person In Group <br/>Min. Person(".$price['min'].")<br/> Price $".$price['price']." ".$price['price_group_type']; 
														}
														else if($price["max"] != "" && $price["min"] == ""){
														
															$min = $price["min"];
															$max = $price["max"];
															$label = "Person In Group <br/>Max. Person(".$price['max'].") <br/>Price $".$price['price']." ".$price['price_group_type']; 
														}
														else if($price["max"] != "" && $price["min"] != ""){
														
															$min = $price["min"];
															$max = $price["max"];
															$label = "Person In Group <br/>".$price['min']." to $".$price['max']." <br/>Price $".$price['price']." ".$price['price_group_type']; 
														}
														else{
														
															$min = $price["min"];
															$max = $price["max"];
															$label = "Person In Group <br/>Price $".$price['price']." ".$price['price_group_type']; 
														}
													}
													else{
													
																					
													
														$label = ucwords($price['price_option_type'])." (Price $".$price['price'].")"; 
													}
													$optionType = $price["price_option_type"];
												}
												else if($price["price_type"] == "PER_ITEM"){
												$item=1;
													$label = $price["label"];
													$optionType = $label;
												}
												else if($price["price_type"] == "FIXED"){
												$fixed=1;
													if($i>1) continue;
													$label = ($price["quantity_label_plural"])?$price["quantity_label_plural"]:'Participants';
													$optionType = $label;
												}
												else{
													if($i>1) continue;
													$label = ($price["quantity_label_plural"])?$price["quantity_label_plural"]:'Participants';
													$optionType = $label;													
												}
										?>
												<li><p><?php echo $label; ?></p></li>
												<li><input name="participants[<?php echo $optionType."|".$price["price"]; ?>]" class="input-number1" <?php // if($min != "") echo "min=".$min; else echo "min=0"; ?> <?php // if($max != "") echo "max=".$max; ?> type="number" placeholder="0" <?php if($min != "") echo "value=".$min; else echo "value=0"; ?> /></li>
										<?php
											$i++;
											}
										?>
                                       </ul>
                                    </div><!-- total members ends -->
                                    
                         </div><!-- user -->
<!--						<div class="session-block title-date">
                                <div id="duration" class="toggle-div">
									<p>Duration</p>
                                    <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/alarm-ico.png" alt="cal"/></span>
                                    <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/drop-gray-ico.png" alt="icon" /></i>
                                </div>
                                

                                    <div class="total-members">
                                    	<ul class="select-membr">
											<li><p>Duration</p></li>
											<li>
												<select>
													<option>First</option>
													<option>Second</option>
													<option>Third</option>
												</select>
											</li>
										</ul>
                                    </div>
						</div>      

						<div class="session-block title-date">
                                <div id="preferred-time" class="toggle-div">
									<p>Preferred time</p>
                                    <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/alarm-ico.png" alt="cal"/></span>
                                    <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/drop-gray-ico.png" alt="icon" /></i>
                                </div>
                                

                                    <div class="total-members">
                                    	<ul class="select-membr">
											<li><p>Time</p></li>
											<li>
												<select>
													<option>12:55PM</option>
													<option>1:55PM</option>
												</select>
											</li>
										</ul>
                                    </div>
						</div> -->
						
                         <div class="session-block title-time title-session">
							<?php 
								if($calendarDetail["bookingMode"] == "INVENTORY")
								{
							?>
							 <div id="session" class="toggle-div">
                                <p>choose your session</p>
                                <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/clock-ico.png" alt="cal"/></span>
                                <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/drop-gray-ico.png" alt="icon" /></i>
							</div>
								<div class="total-members session-total-members">
								<div id="dsel1" style="width:239px"></div>
									<ul class="select-membr">
										<!--<li><p>Date</p></li>
										<li><input id="datetimepicker3" type="text" class="inputDate" placeholder="<?php echo date('Y-m-d'); ?>" name="booking-on" />			</li>-->
										<li><p>Time</p></li>
										<li>
											<input name="session-time" id="session-time" value="<?php echo ($scheduleSessionData[0]["startTime"] != '')?$scheduleSessionData[0]["startTime"]:'9am'; ?>" />
										</li>
									</ul>
								</div>
							<?php 
								}
								else{
							?>
								 <div id="session" class="toggle-div">
									<p>choose your time</p>
									<span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/clock-ico.png" alt="cal"/></span>
									<i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/drop-gray-ico.png" alt="icon" /></i>
								</div>
							<?php 
							if($calendarDetail["bookingTimeMode"] == 'FIXED'){
								$bookingFixedTimes = unserialize($calendarDetail["bookingFixedTimes"]);
							?>
								<div class="total-members session-total-members">
									<ul class="select-membr">
										<li><p>Preferred Time</p></li>
										<li>
											<select id="preferred-time" name="preferred-time">
												<?php
													foreach($bookingFixedTimes as $times){
														$option = str_replace(" ","-",$times);
												?>
													<option value=<?php echo $option; ?>><?php echo $times; ?></option>
												<?php 
													}
												?>
											</select>
										</li>
									</ul>
								</div>
							<?php 
							}
							else{
							?>
								<div class="total-members session-total-members">
									<ul class="select-membr">
										<li><p>Time</p></li>
										<li>
											<input name="session-time" id="session-time" value="<?php echo ($scheduleSessionData[0]["startTime"] != '')?$scheduleSessionData[0]["startTime"]:'9:00AM'; ?>" />
										</li>
									</ul>
								</div>									
							<?php 
								}
							}
							?>
						 </div><!-- session -->
                         
                         <div class="session-block title-price">
                         <div class="top-border"></div>
                                <small>From</small>
                                <h4><?php echo $basePrice["price"]; ?>$</h4>
                                <button class="btn-bg book-now">book now</button>
                         </div><!-- session -->
						 
						 <input type="hidden" name="listing_id" value="<?php echo $OverviewData["eid"]; ?>">
						  <?php $_SESSION['listing_id']=$OverviewData["eid"]; ?>
						 <input type="hidden" name="session-date" id="session-date">
					</form>
					
                </div><!-- session ends -->
            
            
        
        </div><!-- wrapper ends -->    
    </div><!-- ttile ends -->        
            
        <div class="discription-article">
            <div class="dr-full-width-wrapper">
                <div class="article-row">
                    <div class="article-block">
                    	<div class="article-block-head">
                        	<i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/hl-ico.png" alt="highlight" /></i><h3>Highlights</h3>
                        </div><!-- head ends -->
                        
                        	<div class="content-block">
                            	<p><?php echo $OverviewData["short_description"]; ?></p>
                                <ul>
                                	<li><p><span>Duration : </span> <?php echo ($calendarDetail["duration"] != '')?$calendarDetail["duration"]:'Not defined'; ?> <?php echo ($calendarDetail["duration"] != '')?$calendarDetail["durationUnit"]:''; ?></p></li>
                                    <!--<li><p><span>Expected arrival time : </span><?php echo ($rulesDetail['expected_arrival_time'] != '')?$rulesDetail['expected_arrival_time']:'Not defined'; ?></p></li>-->
                                    <li><p><span>Cancellation policy : </span><?php echo ($rulesDetail['cancellation_policies_type'] != '')?$rulesDetail['cancellation_policies_type']:'Not defined';?></p></li>
                                 </ul>
                                 
                                 	<div class="ancher-block">
                                    	<a href="javascript:void(0)">+ More</a>
                                    </div><!-- ancher block -->
                                    
                            </div><!-- cont ends -->
                    
                    </div><!-- block1 ends -->
                    
                    <div class="article-block">
                    	<div class="article-block-head">
                        	<i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/clip-ico.png" alt="highlight" /></i><h3>Description</h3>
                        </div><!-- head ends -->
                        
                        	<div class="content-block">
                            	<p><?php echo $OverviewData["brief_description"]; ?></p>
                                                                
                                 	<div class="ancher-block">
                                    	<a href="javascript:void(0)">+ More</a>
                                    </div><!-- ancher block -->
                                    
                            </div><!-- cont ends -->
                    
                    </div><!-- block2 ends -->
                
                </div><!-- row ends -->
                
                 <div class="article-row">
                    <div class="article-block">
                    	<div class="article-block-head">
                        	<i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/include-ico.png" alt="highlight" /></i><h3>Included in price</h3>
                        </div><!-- head ends -->
                        <?php 
						if($amentiesdata)
						{
						?>
                        	<div class="content-block">
                            	 
                                <ul class="included-price">
                                	<li><p><?php echo $amentiesdata["whats_included"]; ?></p></li>
									<?php 
										foreach($amentiesdata["whats_included_extra"] as $key=>$value){
									?>
									<li><p><?php echo $value; ?></p></li>		
									<?php 
										}
									?>
                                	<li><p style="text-decoration: line-through;background:none;"><?php echo $amentiesdata["whats_excluded"]; ?></p></li>
									<?php 
										foreach($amentiesdata["whats_excluded_extra"] as $key=>$value){
									?>
									<li><p style="text-decoration: line-through;background:none;"><?php echo $value; ?></p></li>		
									<?php 
										}
									?>
                                 </ul>
                                 
                                 	<div class="ancher-block">
                                    	<a href="javascript:void(0)">+ More</a>
                                    </div><!-- ancher block -->
                                    
                            </div><!-- cont ends -->
						<?php
                         }
						 else
						 {
                         ?>
						 <div class="content-block">
						 <p>No Amenities Included</p>
						 </div>
						 
                          <?php
                            }
                            ?>   							
                    
                    </div><!-- block3 ends -->
                    
                    <div class="article-block">
                    	<div class="article-block-head">
                        	<i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/check-ico.png" alt="highlight" /></i><h3>Optional services</h3>
                        </div><!-- head ends -->
                        <?php
						if($extras)
						{
						?>
                        	<div class="content-block">
                            	 
                                <ul class="optional-services">
								<?php 
									foreach($extras as $key=>$value){
										$extras = unserialize($value["value1"]);
/*  										echo "<pre>";
										print_r($value);  */
								?>
                                	<li>
                                    	<div class="check-left"><input type="hidden" class="service-id" value="<?php echo $value["meta_id"] ?>"> <input class="check-box" type="checkbox" /><p><span><?php echo $extras["title"]; ?> :</span>+ $<?php echo $extras["price"]; ?></p></div>
                                    	<div class="check-right"><input min="0" type="number" placeholder="0" class="quantity" /></div>
										
                                    </li>
								<?php 
									}
								?>
                                 </ul>
                                 
                            </div><!-- cont ends -->
                    <?php
					}
					else
					{
					?>
					<div class="content-block">
					<p>No Optional Services Included</p>
					</div>
					<?php
					}
					?>
                    </div><!-- block3 ends -->
                    
                 </div> <!-- row -->
                 
                 <div class="article-row">
                 	<div class="article-block">
                    	<div class="article-block-head">
                        	<i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/exp-ico.png" alt="highlight" /></i><h3>Experience Requirements</h3>
                        </div><!-- head ends -->
                        <?php
					/* 	echo "<pre>";
						print_r($rulesDetail);
						die; */
						if($rulesDetail["experience_rules"])
						{
						$values=unserialize($rulesDetail["experience_rules"]);
						
						$values=array_filter($values);
						
						if(count($values)>0)
						{
					
						?>
                        	<div class="content-block">
                            	<ul class="exp-req">
						    <?php
							 foreach($values as $value)	
							  {						 
							?>						
										<li><p><?php echo $value;?></p></li>
							<?php
							}
							?>						
                              
                                 </ul>
							<!--<p><?php echo $rulesDetail["experience_rules"]; ?></p>-->
                                                                
                                 	<div class="ancher-block">
                                    	<a href="javascript:void(0)">+ More</a>
                                    </div><!-- ancher block -->
                                    
                            </div><!-- cont ends -->
                    <?php
					}else
					{
					
					?>
						<div class="content-block">
						<p>No Experience Requirements found</p>
						</div>
					<?php
					}
					}
					?>
					
					
                    </div><!-- block2 ends -->
                    
                    <div class="article-block">
                    	<div class="article-block-head">
                        	<i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/safety-ico.png" alt="highlight" /></i><h3>Safety</h3>
                        </div><!-- head ends -->
                        <?php
						if($amentiesdata["safety_precautions"])
						{
						?>
                        	<div class="content-block">
                            	<p><?php echo $amentiesdata["safety_precautions"]; ?></p>
                                                                
                                 	<div class="ancher-block">
                                    	<a href="javascript:void(0)">+ More</a>
                                    </div><!-- ancher block -->
                                    
                            </div><!-- cont ends -->
                    <?php
					}
					else
					{
					?>
					<div class="content-block">
					<p>No Safety Precautions Available</p>
					</div>
					<?php
					}
					?>
                    </div><!-- block2 ends -->
                 </div><!-- row-->  
                 
                 <div class="article-row">
                 	<div class="article-block">
                    	<div class="article-block-head">
                        	<i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/hl-ico.png" alt="highlight" /></i><h3>Other details</h3>
                        </div><!-- head ends -->
                        <?php
						if($rulesDetail["other_information"])
						{
						?>
                        	<div class="content-block">
                            	<p><?php echo $rulesDetail["other_information"]; ?></p>
                                                                
                                 	<div class="ancher-block">
                                    	<a href="javascript:void(0)">+ More</a>
                                    </div><!-- ancher block -->
                                    
                            </div><!-- cont ends -->
                    <?php
					}
					else
					{
					?>
					<div class="content-block">
					<p>No Other Details Provided yet</p>
					</div>
					<?php
					}
					?>
                    </div><!-- block1 ends -->
                    
                    <div class="article-block">
                    	<div class="article-block-head">
                        	<i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/paper-ico.png" alt="highlight" /></i><h3>Cancellation policies</h3>
                        </div><!-- head ends -->
                        <?php
						$output="";
						switch($rulesDetail['cancellation_policies_type'])
						{
						case "Relaxed";
						$output='<p>'.t('Guests will receive a full refund if they cancel at least two weeks before the start of their reservation.').'</p>';
						break;
						case "Flexible";
						$output='<p>'.t('Guests will receive their full refundable deposit plus:').'</p><p>'.t('A 50% refund of their paid rental costs if they cancel at least four weeks before the start of their reservation. OR').'</p><p>'.t('A 25% refund of their paid rental costs if they cancel up to two weeks before the start of their reservation.').'</p>';
						break;
						case "Moderate";
						$output='<p>'.t('Guests will receive their full refundable deposit, plus a 50% refund of their paid rental costs, if they cancel at least four weeks before the start of their reservation.').'</p>';
						break;
						case "Strict";
						$output='<p>'.t('Guests will receive their full refundable deposit plus:').'</p><p>'.t('A 50% refund of their paid rental costs if they cancel at least eight weeks before the start of their reservation OR').'</p><p>'.t('A 25% refund of their paid rental costs if they cancel up to four weeks before the start of their reservation.').'</p>';
						break;
						case "Super-Strict";
						$output='<p>'.t('If the guest cancels, any money they have paid cannot be refunded.').'</p>';
						break;
						case "Custom";
						$output='<p>'.t('Guests will receive their full refundable deposit:').'</p><p>'.t($rulesDetail['amount_week'].'% refund of their paid rental costs if they cancel at least '.$rulesDetail['amount_week_rental']." ".$rulesDetail['amount_week_select']. ' prior to reservation. OR').'</p><p>'.t($rulesDetail['amount_day'].'% refund of their paid rental costs if they cancel at least '.$rulesDetail['amount_day_rental']." ".$rulesDetail['amount_day_select'].'  prior to reservation').'</p>';
						break;
						default:
						$output="";
						break;
						}
						?>
                        	<div class="content-block">
                            	<?php
								echo $output;
								?>
                                                                
                                 	<div class="ancher-block">
                                    	<a href="javascript:void(0)">+ More</a>
                                    </div><!-- ancher block -->
                                    
                            </div><!-- cont ends -->
                    
                    </div><!-- block2 ends -->
                 </div><!-- row -->
                 
                 <div class="article-row">
                 	<div class="article-block full-width-block">
                    	<div class="article-block-head">
                        	<i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/loc-ico.png" alt="highlight" /></i><h3>Location</h3>
                        </div><!-- head ends -->
                        <?php
						if($OverviewData['about_area'])
						{
						?>
                        	<div class="content-block">
                            	<p><?php echo $OverviewData['about_area']; ?></p>
                                  
                            </div><!-- cont ends -->
						<?php
                          }
                         ?>						  
                    
                    </div><!-- block2 ends -->
                 </div><!-- last row ends -->
                
                
            </div><!-- wrapper ends -->
        </div><!-- dedscription article close -->    
            
     <!-- ======================================================= Map Article ================================================ -->
     <div class="dr-map-article map-wrapper">
     	<div class="location-filter">
        	<ul class="short-search-map">
            	<li><input class="check-box2" type="checkbox" /> <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/exp-loc-ico.png" alt="loc" /></i><p>Experiences</p></li>
                <li><input class="check-box2" type="checkbox" /> <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/home-ico.png" alt="loc" /></i><p>Vaction Rentals</p></li>
                <li><input class="check-box2" type="checkbox" /> <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/knif-ico.png" alt="loc" /></i><p>Restaurents</p></li>
                <li class="last-child"><input class="check-box2" type="checkbox" /> <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/bed-ico.png" alt="loc" /></i><p>Hotels</p></li>
            </ul>
        
        		<div class="nearby-loc">
                	<p>NEARBY Listings</p><i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/loc-w-ico.png" alt="loc" /></i>
                </div><!-- neerby loc -->
          </div><!-- loc filter -->	 
     <div class="dr-map-article" id="map-canvas">
		
    </div><!-- map article -->    
            <div class="nearby-places">
			<?php
			if($nearPlaces)
			{
			?>
            <ul>
			
			<?php
				$i = 1;
				$markers = array();
				$str = "";
				foreach($nearPlaces as $places){
					if($places->eid == arg(2)) continue;
					$markers[0] = $places->title;
					$markers[1] = $places->latitude;
					$markers[2] = $places->longitude;
					$markers[3] = $i;
					$i++;
					$str .= json_encode($markers).",";
					$basePrice = getBasePrice($places->eid);
			?>
            	<li>
                	<a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/hotel-thumb.png" alt="place" /></a>
                        <div class="place-info">
                        	<ul class="info-ul">
                        	 	<li><small><?php echo number_format($places->distance, 2);; ?>km away</small></li>
                                <li><p><?php echo $places->title; ?></p></li>
                                <li>
                                	<i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="rate" /></i>
                                    <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="rate" /></i>
                                    <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="rate" /></i>
                                    <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="rate" /></i>
                                    <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="rate" /></i>
                                </li>
                        	</ul>
                        </div>
                        
                        <div class="place-price-info">
                        	<p><?php echo ($basePrice["price"])?$basePrice["price"]:0; ?> $<!--<i class="fa fa-eur"></i>--></p>
                           <!-- <span>/ partic.</span> -->
                        
                        </div><!-- price info -->          
                   
                </li> <!-- near place -->
             <?php 
				}
				

			 ?>      
               
            </ul>
			<?php
			}
			else
			{
			?>
			<h2>No deals Found in nearby places</h2>
			<?php
			}
			?>
            </div><!-- neerby-places -->   
	</div>
     <!-- ============================================= reviews n guids ============================================= -->
     <div class="article-row dr-bottom-article">
     	<div class="dr-full-width-wrapper">
        
        	<div class="article-block reviews r-right">
                	<div class="article-block-head">
                       <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/prsn-ico.png" alt="highlight" /></i><h3>Get in touch</h3>
                    </div><!-- head ends -->
                    
                    	<div class="admin-profile">
                        	<div class="admin-pro-dp">
                            	<div class="admin-photo">
									<?php 
										if($userDetails->picture != ""){
											$file 	= file_load($userDetails->picture->fid);
											$imgpath = $file->uri;
									?>
										<img src="<?php print file_create_url($imgpath); ?>" alt="display pic" />
									<?php 
										}
										else{
									?>
										<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/no-profile-male-img.jpg" alt="display pic" />
									<?php 
										}
									?>
                                </div><!-- dp ends -->
                             </div><!-- pro ends -->  
                             <div class="profile-details">
                             	<a href="#"><?php

								if($userDetails->field_first_name["und"][0]["value"] != ""){
									echo $userDetails->field_first_name["und"][0]["value"]." ".$userDetails->field_last_name["und"][0]["value"];
								}
								else{
									echo $userDetails->name;
								}

								?></a>
                                <p>Tel-Aviv, Israel</p>
                                <p><span>Member since <?php echo date('M',$userDetails->created) ?> <?php echo date('Y',$userDetails->created) ?></span></p>
                                <div class="admin-review">
                                	<a href="#">Reviews</a>
                                	<p><?php echo $userReviewsCount; ?></p>
                                </div><!-- admin-review -->
                                	<!-- <div class="admin-frnds">
                                    	<a href="#">Friends (24)</a>
                                        <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/frnds-ico.png" alt="frnds" /></i>
                                    </div>-->
                             
                             </div><!-- details ends -->
                             
                             <div class="admin-contacts">
                             	<a href="#">Contact</a>
                             </div><!-- admin-contacts-->      
                             
                             	<div class="admin-info">
                                	<p><?php echo ($userDetails->field_about_yourself)?$userDetails->field_about_yourself["und"][0]["value"]:''; ?></p>
														
                                           <a href="javascript:void(0)">+ More</a>             

                                </div><!-- admin info close -->                        
						                     
                        </div><!-- admin-->
                        
                        	<div class="admin-social-block">
                            	<div class="col-block">
                                	<div class="block-row">
                                         <div class="col-left">
                                            <p>Email Address</p>
                                            <a href="#">Verified</a>
                                           </div>
                                           <div class="col-right"> 
                                        	<span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/mail-ico.png" alt="mail ico" /></span>
                                           </div><!-- col-right --> 
                                    </div><!-- row ends -->
                                    
                                    <div class="block-row">
                                         <div class="col-left">
                                            <p>Phone Number</p>
                                            <a href="#"><i></i> <i></i> <i></i> <i></i> <i></i> <i></i> <i></i> <i></i> <i></i><small>54</small>Verified</a>
                                           </div>
                                           <div class="col-right"> 
                                        	<span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/phon-ico.png" alt="mail ico" /></span>
                                           </div><!-- col-right --> 
                                    </div><!-- row ends -->
                                    
                                    <!--  <div class="block-row">
                                       <div class="col-left">
                                            <p>Facebook</p>
                                            <a href="#"><small>157 Friends</small></a>
                                           </div>
                                           <div class="col-right"> 
                                        	<span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/fb-ico.png" alt="mail ico" /></span>
                                           </div>
                                    </div>-->
                                	<div class="block-row">
                                         <div class="col-left">
                                            <p>Google+</p>
                                            <a href="#">Validated</a>
                                           </div>
                                           <div class="col-right"> 
                                        	<span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/g-plus-ico.png" alt="mail ico" /></span>
                                           </div><!-- col-right --> 
                                    </div><!-- row ends -->                               
                                </div><!-- block close -->
                                
                                <div class="col-block">

                                    
                                    <div class="block-row">
                                         <div class="col-left">
                                            <p>Twitter</p>
                                            <a href="#">Validated</a>
                                           </div>
                                           <div class="col-right"> 
                                        	<span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/twt-ico.png" alt="mail ico" /></span>
                                           </div><!-- col-right --> 
                                    </div><!-- row ends -->
                                    
                                    <div class="block-row">
                                         <div class="col-left">
                                            <p>Positively Reviewed</p>
                                            <a href="#"><small>16 Reviews</small></a>
                                           </div>
                                           <div class="col-right"> 
                                        	<span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/like-ico.png" alt="mail ico" /></span>
                                           </div><!-- col-right --> 
                                    </div><!-- row ends -->
                                
                                </div><!-- block close -->                           
                            
                            </div><!-- social block-->
                        	
                            <div class="view-pro">
                            	<a href="#">View full profile +</a>
                            </div><!-- view -->
                        
                        
                 </div><!-- article block touch ends -->
        
        	<!--<div class="article-block reviews col-left">
            	<div class="article-block-head">
                   <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/revw-ico.png" alt="highlight" /></i><h3>Reviews</h3>
                </div>
                
                	<div class="review-rating">
                   		<div class="review-cal">
                        	<p><?php echo $reviewsCount; ?></p>
                            <h5>review</h5>
								<?php 
									foreach($SuperAverage as $average){
								?>
										<div class="basic3" data-average="<?php echo $average->average_avg; ?>" data-id="1"></div>
									<?php 
										if($average->average_avg > 3){
									?>
										<div class="basic2" data-average="<?php echo ($average->average_avg-3); ?>" data-id="1"></div>
								<?php
										}
									}
								?>
                        </div> 
                        <?php 
							foreach($reviewsAverage as $average){
						?>
                        	<div class="review-rating-cell r-border">
                            	<ul>
                                    <li>
                                        <p>ACCURACY</p>
                                            <span>
												<div class="basic" data-average="<?php echo $average->accuracy_avg; ?>" data-id="1"></div>
                                            </span>
                                     </li>
                                      <li>
                                        <p>CLEANLINESS</p>
                                            <span>
												<div class="basic" data-average="<?php echo $average->cleanliness_avg; ?>" data-id="1"></div>
                                            </span>
                                     </li>
                                      <li>
                                        <p>CHECK IN</p>
                                            <span>
												<div class="basic" data-average="<?php echo ($average->check_in_avg)?$average->check_in_avg:''; ?>" data-id="1"></div>
                                            </span>
                                     </li>
                                      
                                </ul>
                            
                            </div>
                            
                            <div class="review-rating-cell">
                            	<ul>
                                    <li>
                                        <p>COMMUNICATION</p>
                                            <span>
												<div class="basic" data-average="<?php echo $average->communication_avg; ?>" data-id="1"></div>
                                            </span>
                                     </li>
                                      <li>
                                        <p>LOCATION</p>
                                            <span>
												<div class="basic" data-average="<?php echo $average->location_avg; ?>" data-id="1"></div>
                                            </span>
                                     </li>
                                      <li>
                                        <p>VALUE</p>
                                            <span>
												<div class="basic" data-average="<?php echo $average->value_avg; ?>" data-id="1"></div>
                                            </span>
                                     </li>
                                      
                                </ul>
                            
                            </div>
						<?php }?>
                   </div>
				<div class="review-wrapper">
                <?php 
					foreach($reviews as $review){
						$userDetails = user_load($review["uid"]);
				?>
                   <div class="blogger-block">
                        <div class="blogger-profile">
                        	<div class="blogger-dp">
								<?php 
									if($userDetails->picture->fid != ""){
										$file 	= file_load($userDetails->picture->fid);
										$imgpath = $file->uri;
								?>
									<img src="<?php print file_create_url($imgpath); ?>" alt="display pic" />
								<?php 
									}
									else{
								?>
									<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/no-profile-male-img.jpg" alt="display pic" />
								<?php 
									}
								?>
                        	</div>
                            <a href="#">
								<?php
									if($userDetails->field_first_name["und"][0]["value"] != ""){
										echo $userDetails->field_first_name["und"][0]["value"]." ".$userDetails->field_last_name["und"][0]["value"];
									}
									else{
										echo $userDetails->name;
									}
								?>
							</a>
                        </div> 
                        	<div class="blog-description">
                            	<p><?php echo $review["comments"];  ?></p> 
									<div class="description-detail">
                                    	<span><?php echo date('F, Y',strtotime($review["created"])) ?></span>
                                        <a href="javascript:void(0)">+ More</a>                                     
                                    </div>
                            </div>
                   
                   </div>
				<?php 
					}
				?>
				</div>
				<?php 
					if($reviewsCount> 2){
				?>
                    <div class="blog-pagination">
						<?php 
							for($i = 1; $i <= ceil($reviewsCount/2); $i++)
							{
						?>
							<a class="<?php if($i == 1) echo 'active'; else ''; ?>" href="javascript:void(0)"><?php echo $i; ?></a>
						<?php 
							}
						?>
                    </div>
				<?php 
				}
				?>
            </div>-->
        	<div class="article-block reviews col-left">
            	<div class="article-block-head">
                   <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/revw-ico.png" alt="highlight" /></i><h3>Reviews</h3>
                </div><!-- head ends -->
                
                	<div class="review-rating">
                   		<div class="review-cal">
                        	<p>26</p>
                            <h5>review</h5>
                            <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="star ico" /></i>
                            <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="star ico" /></i>
                            <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="star ico" /></i>
                            <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="star ico" /></i>
                            <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="star ico" /></i>
                        </div> 
                        
                        	<div class="review-rating-cell r-border">
                            	<ul>
                                    <li>
                                        <p>ACCURACY</p>
                                            <span>
                                            <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="star ico" /></i>
                                            <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="star ico" /></i>
                                            <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="star ico" /></i>
                                            <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="star ico" /></i>
                                            <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="star ico" /></i>
                                            </span>
                                     </li>
                                      <li>
                                        <p>CLEANLINESS</p>
                                            <span>
                                            <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="star ico" /></i>
                                            <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="star ico" /></i>
                                            <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="star ico" /></i>
                                            <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="star ico" /></i>
                                            <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="star ico" /></i>
                                            </span>
                                     </li>
                                      <li>
                                        <p>CHECK IN</p>
                                            <span>
                                            <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="star ico" /></i>
                                            <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="star ico" /></i>
                                            <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="star ico" /></i>
                                            <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="star ico" /></i>
                                            <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="star ico" /></i>
                                            </span>
                                     </li>
                                      
                                </ul>
                            
                            </div><!-- review rating cell -->
                            
                            <div class="review-rating-cell">
                            	<ul>
                                    <li>
                                        <p>COMMUNICATION</p>
                                            <span>
                                            <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="star ico" /></i>
                                            <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="star ico" /></i>
                                            <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="star ico" /></i>
                                            <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="star ico" /></i>
                                            <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="star ico" /></i>
                                            </span>
                                     </li>
                                      <li>
                                        <p>LOCATION</p>
                                            <span>
                                            <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="star ico" /></i>
                                            <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="star ico" /></i>
                                            <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="star ico" /></i>
                                            <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="star ico" /></i>
                                            <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="star ico" /></i>
                                            </span>
                                     </li>
                                      <li>
                                        <p>VALUE</p>
                                            <span>
                                            <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="star ico" /></i>
                                            <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="star ico" /></i>
                                            <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="star ico" /></i>
                                            <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="star ico" /></i>
                                            <i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="star ico" /></i>
                                            </span>
                                     </li>
                                      
                                </ul>
                            
                            </div><!-- review rating cell -->
                    
                   </div><!-- rating ends -->
                   
                   <div class="blogger-block">
                        <div class="blogger-profile">
                        	<div class="blogger-dp">
                            	<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/dp1.png" alt="profile" />
                        	</div><!-- dp ends -->
                            <a href="#">Dieter</a>
                        </div> <!-- profile -->
                        	<div class="blog-description">
                            	<p>Gal's appartment is very well situated in the heart of Tel Aviv. The beach is very near, restaurants and clubs as well. <br />
I would definately recommend this place. It's rather small but very functionally arranged. Compliments on the fact that it was spotlessly clean. Towels (for bathroom and beach) are available. Except for maybe a small</p> 
									<div class="description-detail">
                                    	<span>August 2013</span>
                                        <a href="#">+ More</a>                                     
                                    </div><!-- detail ends -->
                            </div><!-- diescription -->
                   
                   </div><!-- blogger  -block ends -->
                   
                   <div class="blogger-block">
                        <div class="blogger-profile">
                        	<div class="blogger-dp">
                            	<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/dp2.png" alt="profile" />
                        	</div><!-- dp ends -->
                            <a href="#">Dieter</a>
                        </div> <!-- profile -->
                        	<div class="blog-description">
                            	<p>Clean, nicely decorated and compact apartment. Great location. Great shower. Great bed. Very nice host. Answered all our questions very quickly. Would recommend to everyone. Excellent.</p> 
									<div class="description-detail">
                                    	<span>May 2013</span>
                                        <a href="#">+ More</a>                                     
                                    </div><!-- detail ends -->
                            </div><!-- diescription -->
                   
                   </div><!-- blogger  -block ends -->
                   
                   <div class="blogger-block">
                        <div class="blogger-profile">
                        	<div class="blogger-dp">
                            	<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/dp3.png" alt="profile" />
                        	</div><!-- dp ends -->
                            <a href="#">Dieter</a>
                        </div> <!-- profile -->
                        	<div class="blog-description">
                            	<p>Clean, nicely decorated and compact apartment. Great location. Great shower. Great bed. Very nice host. Answered all our questions very quickly. Would recommend to everyone. Excellent.</p> 
									<div class="description-detail">
                                    	<span>May 2013</span>
                                        <a href="#">+ More</a>                                     
                                    </div><!-- detail ends -->
                            </div><!-- diescription -->
                   
                   </div><!-- blogger  -block ends -->
            
                    <div class="blog-pagination">
                    	<a class="active" href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#">&gt;</a>
                    
                    </div><!-- blog pagination -->
            
            </div>            
             </div>
     </div>
  <?php 
  if(isset($minQtyRequired) && isset($maxQtyRequired) )
 {
 
?>
<script>
var minQty=<?php echo $minQtyRequired;?>;
var maxQty=<?php echo $maxQtyRequired;?>;
var errMsg="<?php echo $minQtyRequired.' to '.$maxQtyRequired." ".$qtylabel.' are allowed';?>";
</script>
<?php
 }
  ?>
  
    <script>
	function updateViewsCount(){
	var listingID = <?php echo arg(2); ?>;
		jQuery.ajax({
			type: 'POST',
			async:false,
			url : "<?php echo $base_url; ?>/experience/updateViewsCount",
			data : {'listingID':listingID},
			success: function(data){
				
			},
			error: function(data){
				console.log("ajax error occured…"+data);
			}
		})
	}
	
	updateViewsCount();
	
	var $selectedDate = new Date();
    // You can also use "$(window).load(function() {"
    jQuery(function () {
	
      // Slideshow 1
      jQuery("#slider1").responsiveSlides({
        maxwidth: 1920,
        speed: 800,
		auto: true,
        pager: false,

      });
 
    });
  </script>
  <!-- stepper -->
		<script>
			jQuery(document).ready(function() {
				jQuery("input[type=number]").stepper();
				var additional = new Array();
				jQuery(".book-now").click(function(){
					jQuery(".optional-services").find('.check-box').each(function(index){
						if(jQuery(this).is(":checked")){
							var serviceID = jQuery(this).parent().parent().find(".service-id").val();
							var qty = jQuery(this).parent().parent().next('.check-right').find(".quantity").val();
							jQuery("#booking-form").append("<input type='hidden' name='additional-services["+qty+"]' value='"+serviceID+"'>");
						}
					});
/* 					jQuery(".stepper").find("input").each(function(index){
						alert(jQuery(this).val());
					}); */
					if(jQuery("#datetimepicker2").val() == ''){
						jQuery(".booking-date").append('<span class="form-error">Please select booking date</span>');
						return false;
					}
					else{
					var stepperCount=findTotalQty();
						if(stepperCount<1)
						{
						jQuery(".stepper-count .quantity").text("");
						jQuery(".stepper-count").append('<span class="form-error">Please select quantity</span>');
						return false;
						}
						else
						{
						
						if((minQty!=null) && (maxQty!= null))
						{
							if(stepperCount<minQty || stepperCount>maxQty)
							{
							jQuery(".stepper-count .quantity").text("");
							jQuery(".stepper-count").find(".form-error").remove();
							jQuery(".stepper-count").append('<span class="form-error">'+errMsg+'</span>');
							return false
							}
							else
							{
							jQuery(".stepper-count").find(".form-error").remove();
							jQuery(".stepper-count .quantity").text(stepperCount);
							}
						
						}
					jQuery(".stepper-count").find(".form-error").remove();
					jQuery(".stepper-count .quantity").text(stepperCount);					
					}				
					
						jQuery(".booking-date").find(".form-error").remove();
						jQuery("#booking-form").submit();
					}
					
					
				});
			});
		</script>
 <!-- stepper -->   
 <!-- check box -->
	 <script type="text/javascript">
		jQuery(function(){
		
			jQuery('input:radio').screwDefaultButtons({
				image: 'url("<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/radioSmall.jpg")',
				width: 43,
				height: 43
			});
			
			jQuery('.check-box').screwDefaultButtons({
				image: 'url("<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/icheck.png")',
				width: 22,
				height: 23
			});
			jQuery('.check-box2').screwDefaultButtons({
				image: 'url("<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/icheck2.png")',
				width: 22,
				height: 23
			});
 	});
	</script>
  <script type="text/javascript">
jQuery( "#search-out" ).click(function() {
	jQuery( "#short-search" ).toggle( "slow", function() {
	 
	});
});
jQuery( ".toggle-div" ).click(function() {
	jQuery(this).next( ".total-members" ).toggle( "slow", function() {
	 
	});
	var sum = 0;
	sum=findTotalQty();
	if(sum>0)
	{
	jQuery(".stepper-count").find(".form-error").remove();
	jQuery('.toggle-div').find('.quantity').text(sum);
	
	}
});
	
function findTotalQty()
{
var sum = 0;
jQuery(".total-members").find('.stepper-input').each(function( index ) {
		var qty = jQuery(this).val();
					
		if(jQuery(this).attr('name').indexOf('family-of-three') > 0)
		{
			qty = qty*3;
		}
		else if(jQuery(this).attr('name').indexOf('family-of-four') > 0)
		{
			qty = qty*4;
		}
		else if(jQuery(this).attr('name').indexOf('family-of-five') > 0)
		{
			qty = qty*5;
		}		
		sum = sum+parseInt(qty);
	});
return sum;	
}
</script>
 <script>
jQuery(function() {
var $ = jQuery;
<?php 
if($calendarDetail["bookingMode"] == "INVENTORY"){
?>
var availableDates = []; 
<?php 
foreach($scheduleSessionData as $data){

	if($data["repeatPeriodBy"] == "DoNOt"){
?>
	var startDate = '<?php echo $data["startDate"]; ?>', 
	endDate  = '<?php echo $data["startDate"]; ?>';    
	for (var d = new Date(startDate); d <= new Date(endDate); d.setDate(d.getDate() + 1)) {
			availableDates.push($.datepicker.formatDate('dd-mm-yy', d));
	}	

<?php 
	}
	else{
		$reapeatDaysTime = unserialize($data["reapeatDaysTime"]);
		if(count($reapeatDaysTime)>0){
			foreach($reapeatDaysTime as $repeat){
?>
				var startDate = '<?php echo $data["startDate"]; ?>', 
				endDate  = '<?php echo $data["endRepeatDate"]; ?>'; 
				var weekday = new Array(7);
				weekday[0]=  "Sunday";
				weekday[1] = "Monday";
				weekday[2] = "Tuesday";
				weekday[3] = "Wednesday";
				weekday[4] = "Thursday";
				weekday[5] = "Friday";
				weekday[6] = "Saturday";
				for (var d = new Date(startDate); d <= new Date(endDate); d.setDate(d.getDate() + 1)) {
					if(weekday[d.getDay()] == "<?php echo $repeat['on']; ?>"){
						availableDates.push($.datepicker.formatDate('dd-mm-yy', d));
					}
				}
<?php 
			}
		}
		else{
?>
					var startDate = '<?php echo $data["startDate"]; ?>', 
					endDate  = '<?php echo $data["endRepeatDate"]; ?>';  
					for (var d = new Date(startDate); d <= new Date(endDate); d.setDate(d.getDate() + 1)) {
						availableDates.push($.datepicker.formatDate('dd-mm-yy', d));
					} 
<?php
		}
	}
	
?>
/* 	for (var d = new Date(startDate); d <= new Date(endDate); d.setDate(d.getDate() + 1)) {
		availableDates.push($.datepicker.formatDate('dd-mm-yy', d));
	}  */

	function available(date) {
		if(date.getDate()<10){
			var cdate = '0'+date.getDate();
		}
		else{
			var cdate = date.getDate();
		}
		if(date.getMonth()<9){
			var cmonth = '0'+(date.getMonth()+1);
		}
		else{
			cmonth = '';
			cmonth = parseInt(date.getMonth()+1);
		}
		dmy = cdate + "-" + cmonth + "-" + date.getFullYear();
		if ($.inArray(dmy, availableDates) != -1) {
		return [true, "Available","Available"];
		} else {
		return [false,"unAvailable","unAvailable"];
		}
	} 
<?php 
}
?>
	var cal = '';
	var calendarPicker1 = jQuery("#dsel1").calendarPicker({
    monthNames:["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    dayNames: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
    //useWheel:true,
    //callbackDelay:500,
    years:0,
    months:1,
    days:2,
	date:new Date(),
	disableDays:availableDates,
    //showDayArrows:false,
    callback:function(cal) {
	var monthdate = cal.currentDate.getFullYear()+'-'+(parseInt(cal.currentDate.getMonth())+1)+'-'+cal.currentDate.getDate();
	var clickedDate = cal.currentDate.getDate()+'-'+(parseInt(cal.currentDate.getMonth())+1)+'-'+cal.currentDate.getFullYear();

	if(availableDates.indexOf(clickedDate) > -1){
		jQuery.ajax({
			url : "<?php echo $base_url; ?>/session/timings",
			type: "POST",
			data : {'cdate':monthdate,'listing_id':<?php echo arg(2); ?>},
			success: function(data)
			{
				var data = jQuery.parseJSON(data);
				if(data.repeatPeriodBy == 'Minute'){
					jQuery('#session-time').timepicker({ 'step': parseInt(data.repeatEvery) });
				}
				else if(data.repeatPeriodBy == 'Hourly'){
					jQuery('#session-time').timepicker({ 'step': (parseInt(data.repeatEvery)*60) });
				}
				else{
					jQuery('#session-time').timepicker({ 'step': 60 });
				}
				jQuery("#session-date").val(data.date);
				jQuery("#datetimepicker2").val(data.date);
		
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
		 
			}
		});
	}
    }});
	$('#datetimepicker2').datepicker({ 
		beforeShowDay: available,
		minDate: 0,
		onSelect: function(date) {
		
			jQuery(".booking-date").find(".form-error").remove();
			
			var sdate = date.split('/');
			var selecteddate=sdate[2]+"-"+sdate[0]+"-"+sdate[1];
			
			var cal = '';
			var calendarPicker1 = jQuery("#dsel1").calendarPicker({
			monthNames:["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
			dayNames: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
			//useWheel:true,
			//callbackDelay:500,
			years:0,
			months:1,
			days:2, 
			date:new Date(sdate[2],parseInt(sdate[0])-1,sdate[1]),
			disableDays:availableDates,
			//showDayArrows:false,
			callback:function(cal) {
			if(cal.currentDate.getDate()<10){
				var cdate = '0'+cal.currentDate.getDate();
			}
			else{
				var cdate = cal.currentDate.getDate();
			}
			if(cal.currentDate.getMonth()<9){
				var cmonth = '0'+(cal.currentDate.getMonth()+1);
			}
			else{
				cmonth = '';
				cmonth = parseInt(cal.currentDate.getMonth()+1);
			}
		
			var monthdate = cal.currentDate.getFullYear()+'-'+cmonth+'-'+cdate;
			var clickedDate = cdate+'-'+cmonth+'-'+cal.currentDate.getFullYear();

			if(availableDates.indexOf(clickedDate) > -1){
				jQuery.ajax({
					url : "<?php echo $base_url; ?>/session/timings",
					type: "POST",
					data : {'cdate':monthdate,'listing_id':<?php echo arg(2); ?>},
					success: function(data)
					{
						var data = jQuery.parseJSON(data);
						if(data.repeatPeriodBy == 'Minute'){
							jQuery('#session-time').timepicker({ 'step': parseInt(data.repeatEvery) });
						}
						else if(data.repeatPeriodBy == 'Hourly'){
							jQuery('#session-time').timepicker({ 'step': (parseInt(data.repeatEvery)*60) });
						}
						else{
							jQuery('#session-time').timepicker({ 'step': 60 });
						}
						
						jQuery("#session-date").val(data.date);
						jQuery("#datetimepicker2").val(data.date);
				
					},
					error: function (jqXHR, textStatus, errorThrown)
					{
				 
					}
				});
			}
			  //jQuery("#session-date").val(clickedDate);
			  jQuery("#session-date").val(selecteddate);
			}}
			
			);		
		}
	});
	$('#datetimepicker3').datepicker({ beforeShowDay: available,minDate: 0});
<?php 
}
else{
?>
 $('#datetimepicker2').datepicker({minDate: 0,onSelect: function(date) {jQuery(".booking-date").find(".form-error").remove();}});
 $('#datetimepicker3').datepicker({minDate: 0});
<?php 
}

if($scheduleSessionData[0]["repeatPeriodBy"] == 'Minute'){
?>
 $('#session-time').timepicker({ 'step': <?php echo $scheduleSessionData[0]["repeatEvery"]; ?> });
<?php 
}
else if($scheduleSessionData[0]["repeatPeriodBy"] == 'Hourly'){
?>
  $('#session-time').timepicker({ 'step': <?php echo ($scheduleSessionData[0]["repeatEvery"]*60); ?> });
<?php 
}
else{
?>
$('#session-time').timepicker({ 'step': 60 });
<?php 
}
?>
/* $('#datetimepicker2').datetimepicker({
	pickTime: false
});

$('#datetimepicker3').datetimepicker({
	pickTime: false
});

$('#session-time').datetimepicker({
  pickDate: false
}); */




	jQuery('.short-search-map').slimmenu(
	{
		resizeWidth: '900',
		collapserTitle: 'Short Search',

		animSpeed:'medium',
		indentChildren: true,
		childrenIndenter: '&raquo;'
	});
	jQuery('.sign-in').slimmenu(
	{
		resizeWidth: '567',
		collapserTitle: 'Log On',
		 
		animSpeed:'medium',
		indentChildren: true,
		childrenIndenter: '&raquo;'
	});
	
	jQuery(".basic").jRating({
		bigStarsPath: "<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/icons/stars.png",
		isDisabled : true,
		length : 5,
		type:'small'
	});
	
	jQuery(".basic3").jRating({
		bigStarsPath: "<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/icons/star-gray.png",
		isDisabled : true,
		 length : 3,
		 rateMax : 3,
		 type:'small'
	});
	
	jQuery(".basic2").jRating({
		bigStarsPath: "<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/icons/star-gray.png",
		isDisabled : true,
		 length : 2,
		 rateMax : 2,
		 type:'small'
	});
	
});

function initialize() {
	var marker;
	var circle;
	var currentlatlng = new google.maps.LatLng(<?php echo $OverviewData["latitude"]; ?>,<?php echo $OverviewData["longitude"]; ?>);
	var mapOptions = {
		zoom: 12,
		draggable:false,
		scrollwheel: false,
        navigationControl: false,
        mapTypeControl: false,
        scaleControl: false,
		center: new google.maps.LatLng(<?php echo $OverviewData["latitude"]; ?>,<?php echo $OverviewData["longitude"]; ?>)
	}
	var map = new google.maps.Map(document.getElementById('map-canvas'),
	mapOptions);
    
	if (currentlatlng) {

		map.panTo(currentlatlng);
		setMarker(marker,map,currentlatlng,circle);
	}
	setMarkers(map, beaches);
}

/**
 * Data for the markers consisting of a name, a LatLng and a zIndex for
 * the order in which these markers should display on top of each
 * other.
 */
var beaches = [<?php echo $str; ?>];

function setMarkers(map, locations) {

  var image = {
    url: "<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/exp-loc-ico.png",
    // This marker is 20 pixels wide by 32 pixels tall.
    size: new google.maps.Size(40, 52),
    // The origin for this image is 0,0.
    origin: new google.maps.Point(0,0),
    // The anchor for this image is the base of the flagpole at 0,32.
    anchor: new google.maps.Point(0, 32)
  };

  var shape = {
      coords: [1, 1, 1, 20, 18, 20, 18 , 1],
      type: 'poly'
  };
  var infowindow = new google.maps.InfoWindow({
      maxWidth: 200
  });

  
  for (var i = 0; i < locations.length; i++) {
    var beach = locations[i];
    var myLatLng = new google.maps.LatLng(beach[1], beach[2]);
    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        icon: image,
        shape: shape,
        title: beach[0],
        zIndex: beach[3]
    });
	google.maps.event.addDomListener(marker, 'click', function() {
		infowindow.setContent(this.title);
		infowindow.open(map,this);

	});
  }
}

function setMarker(marker,map,currentlatlng,circle) {
    if (marker != undefined)
        marker.setMap(null);

    marker = new google.maps.Marker({
        position: currentlatlng,
        draggable: false,
        map: map
    });
    if (marker) {
        google.maps.event.addDomListener(marker, "dragend", function () {
            currentlatlng = marker.getPosition();
            drawCircle();
        });
        drawCircle(map,currentlatlng,circle);
    }
}  

function drawCircle(map,currentlatlng,circle) {

    if (circle != undefined)
        circle.setMap(null);

    var radius = 2500;

	var options = {
        strokeColor: '#0599e5',
        strokeOpacity: 1.0,
        strokeWeight: 1,
        fillColor: '#0599e5',
        fillOpacity: 0.5,
        map: map,
        center: currentlatlng,
        radius: radius
    };
    circle = new google.maps.Circle(options);
	
} 

google.maps.event.addDomListener(window, 'load', initialize);

/* jQuery(".blog-pagination a").on('click',function(){
	var page = jQuery(this).text();
	jQuery(".review-wrapper").append("<span class='loading'><img src='<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/loading_1.gif'/></span>");
	jQuery.ajax({
		url : "<?php echo $base_url; ?>/listing/review",
		type: "POST",
		data : {'page':page,'listing_id':<?php echo arg(2); ?>},
		success: function(data)
		{
			jQuery(".review-wrapper").html(data);
	
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
	 
		}
	});
	jQuery(".blog-pagination a").removeClass("active");
	jQuery(this).addClass("active");
}); */

</script>

<!-- ========= toggle listing =============== -->

