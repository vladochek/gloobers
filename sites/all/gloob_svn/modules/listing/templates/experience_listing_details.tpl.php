<?php
global $user,$base_url;
$userDetails=user_load($OverviewData['uid']);
$experienceType=getExperienceListingTypeById($OverviewData['experience_type']);
/*************************Added Css Files**********************************/ 
drupal_add_css(drupal_get_path('theme', $GLOBALS['theme']) .'/styles/slider.css','file');
drupal_add_css(drupal_get_path('theme', $GLOBALS['theme']) .'/styles/bootstrap-datetimepicker.min.css','file');
drupal_add_css(drupal_get_path('theme', $GLOBALS['theme']) .'/styles/jssorslider.css','file');
drupal_add_css(drupal_get_path('theme', $GLOBALS['theme']) .'/css/jquery.timepicker.css','file');

/*************************Added Js Files**********************************/ 
drupal_add_js(drupal_get_path('theme', $GLOBALS['theme']) .'/js/moment.js',array('scope' => 'footer')); 
drupal_add_js(drupal_get_path('theme', $GLOBALS['theme']) .'/js/bootstrap-datetimepicker.js',array('scope' => 'footer')); 
drupal_add_js(drupal_get_path('theme', $GLOBALS['theme']) .'/js/circle-progress.js',array('scope' => 'footer')); 
//drupal_add_js(drupal_get_path('theme', $GLOBALS['theme']) .'/js/jquery_004.js',array('scope' => 'footer'));  
drupal_add_js(drupal_get_path('theme', $GLOBALS['theme']) .'/js/experience.js',array('scope' => 'footer')); 
drupal_add_js(drupal_get_path('theme', $GLOBALS['theme']) .'/js/jssor.js',array('scope' => 'footer')); 
drupal_add_js(drupal_get_path('theme', $GLOBALS['theme']) .'/js/jssor.slider.js',array('scope' => 'footer')); 
drupal_add_js(drupal_get_path('theme', $GLOBALS['theme']) .'/js/jquery.timepicker.js',array('scope' => 'footer'));

?>
<section class="topbar">
  <div class="dr-wrapper">
    <div class="links">
      <ul>
        <li><a href="<?php echo $base_url;?>">Home</a></li>
        <li>-</li>
        <li><a href="#">Ouganda</a></li>
        <li>-</li>
        <li><a href="#">Experience</a></li>
        <li>-</li>
        <li><?php print t(ucfirst($OverviewData['title']));?></li>
      </ul>
    </div>
  </div>
</section>
<div class="dr-wrapper">
  <section class="inner-sec">
    <div class="col-lg-12 toprap">
      <div class="col-xs-12 col-sm-6 col-md-5 nopadding heading">
        <h1><?php print t(ucfirst($OverviewData['title'])).' '; ?><br><span><?php print t(ucfirst($OverviewData['city'])).', '; ?><?php print t(ucfirst($OverviewData['country'])); ?><br>
          </span> <span class="nature"><?php echo $experienceType['experience_type'];?></span></h1>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-2 review"> <i class="fa fa-star gold"></i><i class="fa fa-star gold"></i><i class="fa fa-star gold"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
        <p>(<?php echo sizeof($reviews);?> reviews)</p>
      </div>
    </div>
    <div class="col-lg-12 nopadding">
      <div class="col-xs-12 col-sm-12 col-md-9">
        <div class="leftcolbar">
          <div data-example-id="togglable-tabs" role="tabpanel" class="bs-example bs-example-tabs">
            <ul role="tablist" class="nav nav-tabs" id="myTab">
              <li class="active" role="presentation"><a aria-expanded="true" aria-controls="photos" data-toggle="tab" role="tab" id="photos-tab" href="#photos">Photos</a></li>
              <li role="presentation" class=""><a aria-controls="Map" data-toggle="tab" id="Map-tab" role="tab" href="#Map" aria-expanded="false">Map</a></li>
              <li role="presentation" class=""><a aria-controls="Calendar" data-toggle="tab" id="Calendar-tab" role="tab" href="#Calendar" aria-expanded="false">Calendar</a></li>
            </ul>
          </div>
          <div class="tab-content" id="myTabContent">
            <div aria-labelledby="photos-tab" id="photos" class="tab-pane fade active in" role="tabpanel">
              <div class="row">
                <div class="col-md-12 nopadding">
                
	<div id="slider1_container" style="position: relative; width: 720px;height: 480px; overflow: hidden;">

        <!-- Loading Screen -->
        <div u="loading" style="position: absolute; top: 0px; left: 0px;">
            <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
                background-color: #000; top: 0px; left: 0px;width: 100%;height:100%;">
            </div>
            <div style="position: absolute; display: block; background: url(../img/loading.gif) no-repeat center center;
                top: 0px; left: 0px;width: 100%;height:100%;">
            </div>
        </div>

        <!-- Slides Container -->
        <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 720px; height: 480px;
            overflow: hidden;">
			<?php
            foreach($photos as $photo){
					$photo 	= unserialize($photo["value1"]);
					$file 	= file_load($photo["fid"]);
					$imgpath = $file->uri;
					$style = 'experience_slider';
					$style_thumb = 'experience_slider_thumb';
			
			?>
			<div>
                <img src="<?php print image_style_url($style,$imgpath); ?>" alt="place" />
                <img u="thumb" src="<?php print image_style_url($style_thumb,$imgpath); ?>" />
            </div>
			<?php      
			}
			?>
        </div>
       
        <!-- Thumbnail Navigator Skin Begin -->
        <div u="thumbnavigator" class="jssort07" style="position: absolute; width: 720px; height: 100px; left: 0px; bottom: 0px; overflow: hidden; ">
            <div style=" background-color: #000; filter:alpha(opacity=30); opacity:.3; width: 100%; height:100%;"></div>
            <!-- Thumbnail Item Skin Begin -->
            
            <div u="slides" style="cursor: move;">
                <div u="prototype" class="p" style="POSITION: absolute; WIDTH: 99px; HEIGHT: 66px; TOP: 0; LEFT: 0;">
                    <div u="thumbnailtemplate" class="i" style="position:absolute;"></div>
                    <div class="o">
                    </div>
                </div>
            </div>
            <!-- Arrow Left -->
            <span u="arrowleft" class="jssora11l" style="width: 37px; height: 37px; top: 123px; left: 8px;">
            </span>
            <!-- Arrow Right -->
            <span u="arrowright" class="jssora11r" style="width: 37px; height: 37px; top: 123px; right: 8px">
            </span>
            <!-- Arrow Navigator Skin End -->
        </div>
        <!-- ThumbnailNavigator Skin End -->
        
        <!-- Trigger -->
    </div>
                </div>
              </div>
		 </div>
            <div aria-labelledby="Map-tab" id="Map" class="tab-pane fade" role="tabpanel">
              <div class="mappanel" id="map-canvas"> </div>
            </div>
            <div aria-labelledby="Calendar-tab" id="Calendar" class="tab-pane fade" role="tabpanel">
              <div class="calenpanel"></div>
            </div>	  
              <div class="over-sec">
                <h2>Overview</h2>
                <div class="col-xs-12 col-sm-4 col-md-4">
                  <div class="colone">
                    <p>Reviews <br>
                      <span><?php echo sizeof($reviews);?></span></p>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                  <div class="colone">
                    <p>Duration <br>
                      <span><?php echo !empty($calendarDetail['duration'])?$calendarDetail['duration'].' ':'No duration '; ?><?php print t( !empty($calendarDetail['durationUnit'])?$calendarDetail['durationUnit']:''); ?></span></p>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                  <div class="colone">
                    <p>Cancellation Policy<br>
                      <span class="flex"><?php print t(!empty($calendarDetail['cancellation_policies_type'])?$rulesDetail['cancellation_policies_type']:'No policy selected'); ?></span></p>
                  </div>
                </div>
                <h3>Recommended For</h3>
                <div class="circles">
                  <div class="first circle">
                    <canvas></canvas>
                    <strong>98<i>%</i></strong><span>Foodies</span> </div>
                  <div class="second circle">
                    <canvas></canvas>
                    <strong>73<i>%</i></strong><span>Budget Travellor</span> </div>
                  <div class="third circle">
                    <canvas></canvas>
                    <strong>73<i>%</i></strong><span>TrendSeter</span> </div>
                  <div class="forth circle">
                    <canvas></canvas>
                    <strong>67<i>%</i></strong> <span>Students</span></div>
                </div>
              </div>
              <div class="col-lg-12 nopadding">
                <div class="desc-sec hideContent" id="description_read_more">
                  <h2>Description</h2>
				  <div class="read-more-head"><p><?php print t($OverviewData['brief_description']); ?></p></div>
                  <?php
                 $descriptionCount=strlen($OverviewData['brief_description']);
                 if($descriptionCount>100)
				  {				  
				  ?>
				  <p class="center">
				  <a class="read-more" href="javascript:void(0)">Read More</a></p>
				  <?php 
				  }
				  ?>
                </div>
              </div>
              <div class="col-lg-12 nopadding">
                <div class="desc-sec">
                  <div class="col-xs-12 col-sm-6 col-md-6 listing-sec">
                    <h2>Included In Price</h2>
                    <ul>
                      <li><span class="fa fa-check"></span><?php echo $amentiesdata['whats_included']; ?></li>
                    <?php 
					if(!empty($amentiesdata['whats_included_extra'])){
						foreach($amentiesdata['whats_included_extra'] as $extrainc){
						?>
						<li><span class="fa fa-check"></span><?php echo $extrainc; ?></li>
					<?php	
						}
					}?>
					</ul>
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-6 listing-sec">
                    <h2>Experience Requirements</h2>
					<?php
					if($rulesDetail['experience_rules'])
					{	
 					$experience_requirement=unserialize($rulesDetail['experience_rules']); 
					print '<ul>';
					if($experience_requirement)
					{
					?>
                    
					<?php  foreach($experience_requirement as $experience_requiremen){?>
                      <li><span class="fa fa-check"></span><?php echo $experience_requiremen; ?></li>
					<?php } ?>                    
                    
					<?php 
					}
					}
					else
					{
						print '<li>No experience Requirements.</li>';
					}
					?>
					</ul>
                  </div>
                </div>
              </div>
              <div class="col-lg-12 nopadding">
                <div class="desc-sec">
                  <div class="imgsec"> 
				  <?php 
				   if($userDetails->picture != ""){
			        $file 	= file_load($userDetails->picture->fid);
			        $imgpath = $file->uri;
			        $style="experience_topranked";
		            print  '<img src="'.image_style_url($style,$imgpath).'" alt="display pic">';
					  }
					  else
					  {
						print '<img src="'.base_path() . drupal_get_path('theme',$GLOBALS['theme']).'/images/no-profile-male-img.jpg" alt="display pic" />';
					  }
					  ?>
                    <h2><?php echo  $userDetails->name;?><br>
                      <span>Contact</span></h2>
                  </div>
                  <p><?php print($userDetails->field_about_yourself)?$userDetails->field_about_yourself['und'][0]['value']:t('No more information for owner.');?></p>
				  <div class="col-xs-12 col-sm-4 col-md-4 colone">
                    <p>Response Rate<br>
                      <span>98%</span></p>
                  </div>
                  <div class="col-xs-12 col-sm-4 col-md-4 colone">
                    <p>Languages<br>
                      <span>Francais, English,<br>
                      Espanol</span></p>
                  </div>
                  <div class="col-xs-12 col-sm-4 col-md-4 colone">
                    <p>Response Time<br>
                      <span>Within 24 hours</span></p>
                  </div>
                </div>
              </div>
              <div class="col-lg-12 nopadding">
                <div class="desc-sec">
                  <h2>Other Information</h2>
					<p> <?php echo ($rulesDetail['other_information'])?$rulesDetail['other_information']:t('No other information found.'); ?></p>
                </div>
              </div>
              <div class="col-lg-12 nopadding">
                <div class="desc-sec desc-sec2">
                  <h2>Cancellation Policies</h2>
                  <?php 
				  if(!empty($calendarDetail['cancellation_policies_type'])){
				switch ($calendarDetail['cancellation_policies_type']) {
					case "Relaxed":
						print '<p>'.t('Guests will receive a full refund if they cancel at least two weeks before the start of their reservation.').'</p>';
						break;
					case "Flexible":
						print '<p>'.t('Guests will receive their full refundable deposit :').'</p><p>'.t('A 50% refund of their paid rental costs if they cancel at least four weeks before the start of their reservation. OR').'</p><p>'.t('A 25% refund of their paid rental costs if they cancel up to two weeks before the start of their reservation.').'</p>';
						break;
					case "Moderate":
						print '<p>'.t('Guests will receive their full refundable deposit.</p><p> A 50% refund of their paid rental costs, if they cancel at least four weeks before the start of their reservation.').'</p>';
						break;
					case "Strict":
						print '<p>'.t('Guests will receive their full refundable deposit :').'</p><p>'.t('A 50% refund of their paid rental costs if they cancel at least eight weeks before the start of their reservation OR').'</p><p>'.t('A 25% refund of their paid rental costs if they cancel up to four weeks before the start of their reservation.').'</p>';
						break;
					case "Super-Strict":
						print '<p>'.t('If the guest cancels, any money they have paid cannot be refunded.').'</p>';
						break;
					case "Custom":
						print '<p>'.t('Guests will receive their full refundable deposit:').'</p><p>'.t($rulesDetail['amount_week'].'% refund of their paid rental costs if they cancel at least '.$rulesDetail['amount_week_rental']." ".$rulesDetail['amount_week_select']. ' prior to reservation. OR').'</p><p>'.t($rulesDetail['amount_day'].'% refund of their paid rental costs if they cancel at least '.$rulesDetail['amount_day_rental']." ".$rulesDetail['amount_day_select'].'  prior to reservation').'</p>';
						break;
					default:
					print '<p>'.t('No Cancellation policy.').'</p>';
					}
				}
				else
				{
				print '<p>'.t('No Cancellation policy.').'</p>';
				}
				  
				   ?>
				  
               
                </div>
              </div>
			  <?php
               if(!empty($calendarDetail['cancellation_policies_type'])){			  
			  ?>
			   <div class="col-lg-12 nopadding">
                <div class="bookingpanel">
                  <div class="progress">
                    <div class="progress-bar progress-bar-success" role="progressbar" style="width:40%">
                      <div class="value1"><i class="fa fa-map-marker"></i> 100%</div>
                    </div>
                    <div class="progress-bar progress-bar-warning" role="progressbar" style="width:30%">
                      <div class="value2"><i class="fa fa-map-marker"></i> 50%</div>
                    </div>
                    <div class="progress-bar progress-bar-danger" role="progressbar" style="width:30%">
                      <div class="value3"><i class="fa fa-map-marker"></i> 0%</div>
                      <div class="value4"><i class="fa fa-map-marker"></i></div>
                    </div>
                  </div>
                  <div class="status-bar">
                    <div class="onesec">
                      <p>Booking Date</p>
                    </div>
                    <div class="onesec">
                      <p>15 Days to Service</p>
                    </div>
                    <div class="onesec">
                      <p>7 Days to Service</p>
                    </div>
                    <div class="onesec">
                      <p>Service Date</p>
                    </div>
                  </div>
                </div>
              </div>
			  <?php 
			   }
			   ?>
              <div class="col-lg-12 nopadding">
                <div class="ratingsec">
                  <h3>Reviews<br>
                    <span>( <?php echo sizeof($reviews)." ".t('reviews');?>  )</span></h3>
                  <div class="ratsec">
                    <label>Overall</label>
                    <i class="fa fa-star gold"></i><i class="fa fa-star gold"></i><i class="fa fa-star gold"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> </div>
                  <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="ratingpart">
                      <label>Professionalism</label>
                      <i class="fa fa-star gold"></i><i class="fa fa-star gold"></i><i class="fa fa-star gold"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> </div>
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="ratingpart">
                      <label>Communication</label>
                      <i class="fa fa-star gold"></i><i class="fa fa-star gold"></i><i class="fa fa-star gold"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> </div>
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="ratingpart">
                      <label>Money/Value</label>
                      <i class="fa fa-star gold"></i><i class="fa fa-star gold"></i><i class="fa fa-star gold"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> </div>
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="ratingpart">
                      <label>Safety</label>
                      <i class="fa fa-star gold"></i><i class="fa fa-star gold"></i><i class="fa fa-star gold"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> </div>
                  </div>
                </div>
              </div>
           
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-3 nopadding">
        <aside class="sidesec">
          <div class="colheight">
            <div class="booking-sec">
			<form action="post" href=""	>
              <div class="booksec">
                <div class="price">
                  <h2><span>From</span> $<?php echo (isset($OverviewData['base_price']))? $OverviewData['base_price'] : 0; ?></h2>
                </div>
                <div class="rowbook">
                  <div class="datesec">
                    <label>Date</label>
                    <input name="date" type="text" autocomple="false"  readonly="readonly"  data-date-format="YYYY/MM/DD" id="avail-dates">
                  </div>
                  <div class="travelsec">
					<label>Avail Time</label>
					<div class="demo">							
						<span><input id="time-select" type="text" class="time" /></span>
					</div>
					<!--<label>Travelers</label>
                    <span>
                    <select name="input_travelers" onchange="getTravelers(this.value,'PER_PERSON')">
                      <option>Select</option>
					  <option value="1">1 Adult</option>
                      <option value="2">2 Adult</option>
                      <option value="3">3 Adult</option>
                      <option value="4">4 Adult</option>
                      <option value="5">5 Adult</option>
                    </select>
					</span>-->
					</div>
                </div>
				<div class="rowbook">
					<div class="datesec">
						<label>Person Type</label>
						<span>
						<select id="person_type_box" name="input_person_type" onchange="getTravelers('PER_PERSON')">
							<option>Select</option>
							<?php
							foreach($pricingData as $personType): 
							if($personType['price_type']=='PER_PERSON'){ ?>
								<option value="<?php echo $personType['price_option_type']; ?>"><?php echo ucfirst($personType['price_option_type']); ?></option>
							<?php }
							endforeach;
							?>
						</select>
						</span>
				    </div>
					
					<div class="travelsec">
						<label>Quantity</label>
						<span>
							<select id="person_qty" name="input_travelers"  onchange="getTravelers('PER_PERSON')">
								<option value="0">0</option>
								<option value="1" selected="selected">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
							</select>
						</span>
					</div>
				</div>
                <div id="customOrderDetails">
					<div id="orderCalculationDetailsView"></div>  
					<div id="orderGrandTotalDetails"></div>
				</div>
				<input id="security_deposit_hidden" type="hidden" value="<?php echo round($rulesDetail['security_deposit'],2); ?>">
              </div>
              <div class="buttons from_order_submit_btn" style="display:none;">
                <div class="booknow"><a href="<?php echo $base_url;?>/booking/summary">Book Now</a></div>
                <div class="recomm"><a data-whatever="" data-target="#recommend" data-toggle="modal" href="#">Recommend</a></div>
              </div>
			  </form>
            </div>
          </div>
		  <?php
		if($extras)
            {	
		
		  ?>
          <div class="optionalsec">
            <h2>Optional Services</h2>
            <div class="servsec">
              <div class="colbar">
                <div class="serv">&nbsp;</div>
                <div class="priceqty">
                  <label>Price</label>
                  <label class="quality">Quantity</label>
                </div>
              </div>
			  <?php
              foreach($extras as $key=>$value){
		      $extras = unserialize($value["value1"]);			  
			  ?>
              <div class="colbar">
                <div class="serv"> <span>
                 <input type="hidden" class="service-id" value="<?php echo $value["meta_id"] ?>"> 
				 <input data-three-state="false" value="<?php echo $value["meta_id"] ?>" data-toggle="checkbox-x" id="service-<?php echo $value["meta_id"] ?>" class="" style="display: none;">
                  </span> <?php echo $extras["title"]; ?></div>
                <div class="priceqty">
                  <label><?php echo '$'.$extras["price"]; ?></label>
                  <span>
                  <select name="optional-select form-control">
				  <?php 
				  for($i=1;$i<10;$i++)
				  {
				 print '<option>'.$i.'</option>';
				  }  				  
                  ?>				  
                  </select>
                  </span> </div>
              </div>
			  <?php
			  } 
              ?>			  
              </div>
          </div>
		  <?php 
			}
			?>
          <div class="listpanel">
            <h2><?php echo  $userDetails->name."'s ".t('Other Listing');?></h2>
            <?php
			//echo "<pre>";Print_r();exit;
			if(!empty($userDetails->picture))
			   {$fid=$userDetails->picture->fid;
				$file 	= file_load($fid);
				$imgpath = $file->uri;
				$style = 'experience_topranked';
				}
				
				$photo_first=unserialize($photos[0]['value1']);
				$file_first = file_load($photo_first['fid']);
				$imgpath_first = $file_first->uri;
				$style_first = 'experience_topranked_large';
			foreach($topRankedListing as $topRankedListin){
			
					$experienceType = getExperienceListingTypeById($topRankedListin['experience_type']);
			?>
			<div class="listgrid">
              <div class="blkstuff"> <img alt=" " class="img-height" src="<?php print image_style_url($style_first,$imgpath_first); ?>">
                <div class="clientpic"><img alt=" " src="<?php print image_style_url($style,$imgpath); ?>"></div>
              </div>
              <div class="sechead">
                <h2><?php echo $topRankedListin['title']; ?></h2>
                <p><?php echo ($topRankedListin['city'])?$topRankedListin['city'].', ':'N/A'.', '; ?><?php echo ($topRankedListin['country'])?$topRankedListin['country'].' ':'N/A'.' '; ?><span><?php echo $experienceType['experience_type']; ?></span></p>
              </div>
            </div>
			<?php } 
			if($topRankedListingCount>3)
			{
			
            print '<p class="addmore"><a href="#">And '.($topRankedListingCount-3).' more</a></p>';
			
			}
			?>
          </div>
          <div class="listpanel">
            <h2>Similar Listing</h2>
            <?php 
			//echo "<pre>";Print_r($topListingAccToPlace);exit;
			foreach($topListingAccToPlace as $topListingAccToPlac){ 
			$experienceType = getExperienceListingTypeById($topListingAccToPlac['experience_type']);
			?>
			<div class="listgrid">
              <div class="blkstuff"> <img alt=" " class="img-height" src="<?php print image_style_url($style_first,$imgpath_first); ?>">
                <div class="clientpic"><img alt=" " src="<?php print image_style_url($style,$imgpath); ?>"></div>
			</div>
              <div class="sechead">
                <h2><?php echo $topListingAccToPlac['title']; ?></h2>
                <p><?php echo ($topListingAccToPlac['city'])?$topListingAccToPlac['city'].', ':'N/A'.', '; ?><?php echo ($topListingAccToPlac['country'])?$topListingAccToPlac['country'].' ':'N/A'.' '; ?><span><?php echo $experienceType['experience_type']; ?></span></p>
              </div>
            </div>
			<?php } ?>
            
            
          </div>
        </aside>
      </div>
    </div>
    <div class="reviewsec">
      <div class="col-lg-12 nopadding">
        <div class="col-xs-12 col-sm-12 col-md-8 nopadding">
          <div class="reviewleft">
            <div class="transbar">
              <input type="button" value="Translate With Google" name=" ">
            </div>
            <div class="col-lg-12 nopadding">
              <div class="revblock">
                <div class="col-xs-12 col-sm-2 col-md-2">
                  <div class="leftimg"> <img src="<?php print base_path() . drupal_get_path('theme', $GLOBALS['theme']); ?>/images/experience/clientpic.JPG" alt=" ">
                    <p>Doum's</p>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-10 col-md-10">
                  <div class="colright">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut ali deserunt mollit anim id est laborum.</p>
                    <p><span>December 2014</span></p>
                  </div>
                </div>
                <div class="revblock">
                  <p class="btnsee"><a href="#">See More Reviews</a></p>
                </div>
              </div>
            </div>
            <div class="col-lg-12 nopadding">
              <div class="revblock">
                <div class="col-xs-12 col-sm-2 col-md-2">
                  <div class="leftimg"> <img src="<?php print base_path() . drupal_get_path('theme', $GLOBALS['theme']); ?>/images/experience/clientpic.JPG" alt=" ">
                    <p>Doum's</p>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-10 col-md-10">
                  <div class="colright">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut ali deserunt mollit anim id est laborum.</p>
                    <p><span>December 2014</span></p>
                  </div>
                </div>
                <div class="revblock">
                  <p class="btnsee"><a href="#">See More Reviews</a></p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4">
          <div class="reviewright">
            <div class="recomfor">
              <h3>Recommends For</h3>
              <div class="rowvar">
                <div class="coll"> <span><img src="<?php print base_path() . drupal_get_path('theme', $GLOBALS['theme']); ?>/images/experience/icon6.png" alt=" "></span>
                  <p>Outdoor Activities</p>
                </div>
                <div class="coll"> <span><img src="<?php print base_path() . drupal_get_path('theme', $GLOBALS['theme']); ?>/images/experience/icon7.png" alt=" "></span>
                  <p>Adrenalyne</p>
                </div>
                <div class="coll"> <span><img src="<?php print base_path() . drupal_get_path('theme', $GLOBALS['theme']); ?>/images/experience/icon8.png" alt=" "></span>
                  <p>Local Cultures</p>
                </div>
                <div class="coll"> <span><img src="<?php print base_path() . drupal_get_path('theme', $GLOBALS['theme']); ?>/images/experience/icon9.png" alt=" "></span>
                  <p>Trendsetters</p>
                </div>
              </div>
            </div>
            <div class="recomfor">
              <h3>Recommends For</h3>
              <div class="rowvar">
                <div class="coll"> <span><img src="<?php print base_path() . drupal_get_path('theme', $GLOBALS['theme']); ?>/images/experience/icon6.png" alt=" "></span>
                  <p>Outdoor Activities</p>
                </div>
                <div class="coll"> <span><img src="<?php print base_path() . drupal_get_path('theme', $GLOBALS['theme']); ?>/images/experience/icon7.png" alt=" "></span>
                  <p>Adrenalyne</p>
                </div>
                <div class="coll"> <span><img src="<?php print base_path() . drupal_get_path('theme', $GLOBALS['theme']); ?>/images/experience/icon8.png" alt=" "></span>
                  <p>Local Cultures</p>
                </div>
                <div class="coll"> <span><img src="<?php print base_path() . drupal_get_path('theme', $GLOBALS['theme']); ?>/images/experience/icon9.png" alt=" "></span>
                  <p>Trendsetters</p>
                </div>
               </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<script>
var circle, map,cityCircle;
	function initializeMap()   
    {
        var centerLatlng = new google.maps.LatLng(<?php echo $OverviewData['latitude'].",".$OverviewData['longitude'] ?>);

        map = new google.maps.Map(document.getElementById('map-canvas'), {
            'zoom': 15,
            'center': centerLatlng,
            'mapTypeId': google.maps.MapTypeId.ROADMAP,
			 disableDefaultUI: true
        });     
map.setOptions({draggable: false,scrollwheel: false,click:false,dblclick:false,panControl: false,disableDoubleClickZoom: true});		
	 var populationOptions = {
      strokeColor: '#FF0000',
      strokeOpacity: 0.1,
      strokeWeight: 1,
      fillColor: '#FF0000',
      fillOpacity: 0.2,
      map: map,
      //center: citymap[city].center,
	  center:centerLatlng,
      radius: 500
    };
		cityCircle = new google.maps.Circle(populationOptions);	
         /*********************************************************************/
		 google.maps.event.addListenerOnce(map, 'idle', function(){
        google.maps.event.trigger(map, 'resize');
        map.setCenter(centerLatlng);
    });
         /*********************************************************************/
    		
    };
		 google.maps.event.addDomListener(window, 'load', initializeMap);

	jQuery('a[href="#Map"]').on('shown.bs.tab', function() {		
		 if(!jQuery(this).hasClass('map-open')){
		   initializeMap();
		   jQuery(this).addClass('map-open');
		 }
	});
	
	/*
	*@description: Find all travelers according to diffrent conditions 
	like PER_PERSON , ITEMS etc
	*/
	function getTravelers(type){
		
		var qty = jQuery('#person_qty').val();
		var subcat = jQuery('#person_type_box').val();
		var date  = jQuery('#datetimepicker1').val()+''+jQuery('#input_avail_time').val();
		
		if(qty<=0){
			jQuery('.tblBlock_'+subcat).remove();
			calculateGrandTotal();
			return false;
		}
		
		jQuery.ajax({
			 url:'<?php $base_url?>/gloob/experience/ajax/getOrder',
			 type:'post',
			 data:{ id:'<?php echo arg(1);?>',date:date,qty:qty,'isAjax':1,type:type,subcat:subcat},
			 success: function(data){
				 var res  = jQuery.parseJSON(data);
				 console.log(res);
				 if(jQuery('.tblBlock_'+subcat).length>0){
					//Override the node
					var html = '<div class="col"><label>'+(qty)+' x '+(subcat)+'</label><label class="small grand_total_price" for="'+res.calculated_price+'">$'+(res.calculated_price)+'</label></div>';
					jQuery('.tblBlock_'+subcat).html(html);
				 }else{
					//Create a node
					var html = '<div class="col tblBlock_'+subcat+'"><label>'+(qty)+' x '+(subcat)+'</label><label class="small grand_total_price" for="'+res.calculated_price+'">$'+(res.calculated_price)+'</label></div>';
					jQuery('#orderCalculationDetailsView').append(html);
				 }
				 calculateGrandTotal();
			 }
		 });
	}
	
	function calculateGrandTotal(){
			
	   var grandTotal = 0;		
	   jQuery('.grand_total_price').each(function(){
		   grandTotal+=parseInt(jQuery(this).attr('for'));
	   });
	   
	   html= '<div class="col">\n\
				  <label>Deposit</label>\n\
				  <label class="small">$'+jQuery('#security_deposit_hidden').val()+'</label>\n\
			  </div>\n\
			<div class="col">\n\
			  <label><span>Gross Total</span></label>\n\
			  <label class="small"><span>$'+grandTotal+'</span></label>\n\
			</div>';	
	   jQuery('#orderGrandTotalDetails').html(html);
	   jQuery('.from_order_submit_btn').fadeIn();
	   
	}
	//
	jQuery("#avail-dates").on("dp.change",function (e) {
	var date = (e.delegateTarget.value);
	if(date!="")
	{
	var d = new Date(date);
    var curr_date = d.getDate();
    var curr_month = d.getMonth()+1;
    var curr_year = d.getFullYear();
    var monthdate=	curr_year+'-'+curr_month+'-'+curr_date;
    jQuery.ajax({
			url : "<?php echo $base_url; ?>/session/timings",
			type: "POST",
			data : {'cdate':monthdate,'listing_id':<?php echo arg(1); ?>},
			success: function(data)
			{   var data = jQuery.parseJSON(data);
                 	if(Object.getOwnPropertyNames(data.fixedTime).length===0)
					{
						var fixedTime=0;
					}
                    else 
                    {
						var fixedTime=1;
                    }						
					jQuery('#time-select').timepicker('remove');//to reset timepicker
					if(data.repeatPeriodBy == 'Minute'){
					
					jQuery('#time-select').timepicker({'setTime':data.startAvailTime, 'minTime': data.startAvailTime,'maxTime': data.endAvailTime,'step':  parseInt(data.repeatEvery) });
					}
					else if(data.repeatPeriodBy == 'Hourly'){
					  jQuery('#time-select').timepicker({'setTime':data.startAvailTime, 'minTime': data.startAvailTime,'maxTime': data.endAvailTime,'step':(parseInt(data.repeatEvery)*60)});
	
					}
					else if(fixedTime)//if fixed time available
					{
						var timeslots = [];
						jQuery.each(data.fixedTime,function(index,value){
							var timeSlotsObj = {label:value,className:'shibby',value:value};
							timeslots.push(timeSlotsObj);
						});
						
						jQuery('#time-select').timepicker({
						'noneOption': timeslots,
							minTime:0,
							maxTime:0,
							'disableTimeRanges': [
								['12am','12pm']  
							],
						});

					}						
					else{						
                        	jQuery('#time-select').timepicker({'step':30});
					}
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
		     console.log(errorThrown);
			}
	 
	     });
	}		
	
   });
  
   
</script>
 <script>
jQuery(function() {
var $ = jQuery;
var availableDates = []; 
<?php
 
if($calendarDetail["bookingMode"] == "INVENTORY"){
	$availableDate=array();
	foreach($scheduleSessionData as $data){
		  $repeatEvery  = ($data["repeatEvery"]) ? $data["repeatEvery"] : 1;
		  $startDate=$data["startDate"];
		  $endRepeatDate=($data["endRepeatDate"])?$data["endRepeatDate"]:$data["endDate"];//either end date or end repeat date which ever is bigger is considered here
		/*********************************************************************/
        $reapeatDaysTime = unserialize($data["reapeatDaysTime"]);
		switch($data["repeatPeriodBy"])
        {
		 case "DoNOt":
			 while(strtotime($startDate)<=strtotime($endRepeatDate))
			{	
				$startDate = date("m/d/Y", strtotime($startDate));			
				array_push($availableDate,$startDate);
				$startDate = date("Y-m-d", strtotime($startDate));
				$startDate = strtotime( $startDate . " +1 day " );
				$startDate = date("Y-m-d", $startDate);
			}
		 break;
		 case "Daily":
			  while(strtotime($startDate)<=strtotime($endRepeatDate))
			{	
				$startDate = date("m/d/Y", strtotime($startDate));			
				array_push($availableDate,$startDate);
				$startDate = date("Y-m-d", strtotime($startDate));
				$startDate = strtotime( $startDate . " +".$repeatEvery." day " );
				$startDate = date("Y-m-d", $startDate);
			}
		 break;
		 case "Weekly":
		 $avail=array();
		$dates=array();
		$regularArr=array();
		foreach($reapeatDaysTime as $repeat){//get all days on which event is repeating
			$avail[]=$repeat['on'];	
		}		
		$stamp=strtotime($data["startDate"]);
		$dayNumber = date("z",$stamp); //get date number eg:308
		$dayNumber2 = date("z",strtotime($data["endRepeatDate"])); 		
			for($i=$dayNumber;$i<=$dayNumber2;$i++){			
				$day = date("l",$stamp); //give week day eg:Thursday
				if(in_array($day,$avail)){
					if(@$regularArr[$day]){ $regularArr[$day]++; } else { $regularArr[$day]=1; } 
					if($repeatEvery>1)
						{	
						if(($regularArr[$day]%$repeatEvery) == 1){
						$availableDate[]=date("m/d/Y",$stamp); 
						}
					} 
					else 
					{
						$availableDate[]=date("m/d/Y",$stamp); 
					}
				}
				$stamp = $stamp+86400;			
			 }
		 break;
		 case "MONTHLY":
			 while(strtotime($startDate)<=strtotime($endRepeatDate))
			{	
				$startDate = date("m/d/Y", strtotime($startDate));			
				array_push($availableDate,$startDate);
				$startDate = date("Y-m-d", strtotime($startDate));
				$startDate = strtotime( $startDate . " +".$repeatEvery." month " );
				$startDate = date("Y-m-d", $startDate);
			}
		 break;
		 case "YEARLY":
			 while(strtotime($startDate)<=strtotime($endRepeatDate))
			{	
				$startDate = date("m/d/Y", strtotime($startDate));			
				array_push($availableDate,$startDate);
				$startDate = date("Y-m-d", strtotime($startDate));
				$startDate = strtotime( $startDate . " +".$repeatEvery." year " );
				$startDate = date("Y-m-d", $startDate);
			}
		 break;
		 default:
		 $avail=array();
		$dates=array();
		$regularArr=array();
		foreach($reapeatDaysTime as $repeat){//get all days on which event is repeating
			$avail[]=$repeat['on'];	
		}	
		$stamp=strtotime($data["startDate"]);
		$dayNumber = date("z",$stamp); //get date number eg:308
		$dayNumber2 = date("z",strtotime($data["endRepeatDate"]));
		for($i=$dayNumber;$i<=$dayNumber2;$i++){
          $day = date("l",$stamp); //give week day eg:Thursday
				if(in_array($day,$avail)){
					if(@$regularArr[$day]){ $regularArr[$day]++; } else { $regularArr[$day]=1; } 
					$availableDate[]=date("m/d/Y",$stamp); 
					
				}
				$stamp = $stamp+86400;			
		}		 
		 break;
        }
			  if(count($availableDate))
			{
				foreach($availableDate as $date)
				{
					?>				
					availableDates.push(moment("<?php echo $date;?>"));				
					<?php
				}			
			}
	  }		
	}
	/* else if($calendarDetail["bookingMode"]=='DATE_ENQUIRY')
	{
	}
    else if($calendarDetail["bookingMode"]=='NO_DATE')
    {
    } 	 */	
	else 
	{
	?>
	var availableDates=[];
    <?php	
	}

?>

var dateToday = new Date();
jQuery('#avail-dates').datetimepicker({
		pickTime: false,
		minDate: dateToday,
		defaultDate:dateToday,
		enabledDates: availableDates
         
   });

});
</script>