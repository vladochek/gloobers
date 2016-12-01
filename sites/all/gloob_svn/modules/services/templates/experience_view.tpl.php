<link rel="stylesheet" type="text/css" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="http://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="fonts/glyphicons_pro/glyphicons.min.css" />

<?php
global $base_url
?>

<div class="tab-block margin-bottom-lg">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#overview" data-toggle="tab"><i class="fa fa-pencil text-blue2"></i>Overview</a></li>
                  <li><a href="#photos" data-toggle="tab"><i class="fa fa-file-image-o text-blue2"></i>Photos</a></li>
                  <li><a href="#amenities" data-toggle="tab"><i class="fa fa-bus text-blue2"></i>Amenities</a></li>
                  <li><a href="#location" data-toggle="tab"><i class="fa fa-map-marker text-blue2"></i>Location</a></li>
                  <li><a href="#pricing" data-toggle="tab"><i class="fa fa-usd text-blue2"></i>Pricing</a></li>
                  <li><a href="#calendar" data-toggle="tab"><i class="fa fa-calendar text-blue2"></i>Calendar</a></li>
                  <li><a href="#additional-services" data-toggle="tab"><i class="fa fa-plus-square-o text-blue2"></i>Additional Services</a></li>
                  <li><a href="#rules" data-toggle="tab"><i class="fa fa-lock text-blue2"></i>Rules and Policies</a></li>
                 <!-- <li><a href="#boost" data-toggle="tab"><i class="fa fa-paypal text-blue2"></i>Boost your listing</a></li> -->            
                  
                </ul>
                <div class="tab-content">
                <div id="overview" class="tab-pane active">
				<div>
				<p><label><b>Title - </b></label>    <span><?php echo $OverviewData['title'];?></span>  </p>
				</div>
				<div>
				<?php
				$experienceType=getExperienceListingTypeById($OverviewData['experience_type']);
							
				?>
				<p><label><b>Experience Type - </b></label>     <span><?php  echo $experienceType['experience_type'];?></span>	</p>			
				</div>
				<?php
				$experienceCategory=getExperienceCategoryDataById($OverviewData['experience_category']);
				if($experienceCategory)
				{
				?>				
				<div>
				
				<p><label><b>Experience Category - </b></label>     <span><?php  echo $experienceCategory['category_name'];?></span></p>
				</div>
				  <?php 
				  }						  
				  ?>
				<div>
				<p><label><b>HighLight - </b></label>    <span><?php echo $OverviewData['short_description'];?></span>  </p>
				</div>
				<?php
				if($OverviewData['brief_description'])
				{
				?>
				<div>
				<p><label><b>Long Description - </b></label>    <span><?php echo $OverviewData['brief_description'];?></span>  </p>
				</div>
				<?php
				}
				?>
              
              </div>
			  <div id="photos" class="tab-pane">
			  <!--------------------------------------------------------------------------------------->
			  <div class="panel-body">
              <div class="mixitups">
                <ul id="Grid">
				<?php
				$path = drupal_get_path('module', 'services');
				foreach($photos as $photo){
			    $photo 	= unserialize($photo["value1"]);
			    $style 	= "medium";
			    $file 	= file_load($photo["fid"]);
			    $imgpath = $file->uri;			
              
				?>
                  <li class="mix  mix_all"><img src="<?php print image_style_url($style, $imgpath) ;?>" alt="..." height="220px" width="220px"/></li>
                 
                  <?php
				  }
				  ?>
                </ul>
              </div>
            </div>
			  <!--------------------------------------------------------------------------------------->
	     </div>
			 <div id="amenities" class="tab-pane">
			 <!--------------------------------------------------------------------->
			 <b>Amenities Included and excluded</b>
			 <div class="content-block">
                            	 
                                <ul class="included-price">
								<?php
								
								?>
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
                                                                                                    
                            </div><!-- cont ends -->
			 <!--------------------------------------------------------------------->
			 <?php  
			 if($amentiesdata['safety_precautions']){
			 ?>
			 
				<p><b>Safety Precautions - </b><?php echo $amentiesdata['safety_precautions']; ?></p>
			 <?php
               }
               ?>			   
			</div> 
			  
			  <div id="location" class="tab-pane">
			  <p><label><b>Address -  </b></label>  <span></span><?php echo ($OverviewData["address1"])?$OverviewData["address1"].',':'';?><?php echo ($OverviewData["city"])?$OverviewData["city"].',':''?><?php echo $OverviewData["country"]; ?></p>
			  <?php
			  if($OverviewData['about_area'])
			  {
			  ?>
			  <p><label><b>About area -</b></label>  <span><?php echo $OverviewData['about_area']; ?></span></p>
			  <?php
			  }
			  if($OverviewData['direction'])
			  {
			  ?>
			    <p><label><b>How to get to  place-</b></label>  <span><?php echo $OverviewData['direction']; ?></span></p>
			  <?php
			  }
			  ?>
		 </div>
	  <div id="pricing" class="tab-pane">
	  <!------------------------------------------------------------------------------->
	  <?php 
	 /*  echo "<pre>";
	  print_r($seasonalPrice); */
	  if($seasonalPrice)
	  {
	  ?>
	  <b>Special Seasonal Price</b>
	  <div class="row product-extra">
        <div class="col-md-12">
          <div class="panel">           
            <div class="panel-body">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Rate Label</th>
                      <th>Price</th>
                      <th>Date</th>                                          
                    </tr>
                  </thead>
                  <tbody>
				<?php 
					foreach($seasonalPrice as $price){
				  ?>
                    <tr>
                      <td><?php echo $price["rate_label"]; ?></td>
					  <td><?php echo $price["rate_price"]; ?></td>
                      <td><?php echo $price["from_to_date"]; ?></td>                                       
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
	  
	  <?php
	  }
	  ?>
	  <!------------Product Pricing------------>
	  <h4>Pricing</h4>
	  <?php
	  if(count($pricingData)>0)
	  {
	  foreach($pricingData as $key=>$val){
	 /*  echo "<pre>";
	  print_r($val); */
	  
	   if($val["label"] != null){
				$title = $val["label"];
			}
			else if($val["price_option_type"] != null){
			 if($val['price_group_type']!="")
			{
			$group_type="(".ucwords($val['price_group_type']).")";
			$title = ucwords($val["price_option_type"])." ".$group_type;
			}
			else
			{
			$title = ucwords($val["price_option_type"]);
			$group_type="";
			} 
				
			}
			else if($val["min"] != null){
			if($val['price_type']=='PER_DAY')
			{
			$type='days';
			}
			else if($val['price_type']=='PER_MINUTE')
			{
			$type='minutes';
			}
			else if($val['price_type']=='PER_HOUR')
			{
			$type='hours';
			}
			else
			{
			$type="";
			}
			
				$title = $val["min"] ." to ". $val["max"] ." ".$type."(".$val['price_group_type'].")";
			}
		echo '<p><b>'.$title." -  </b>".'$'.$val['price'].'</p>';	
	  ?>
	  <?php
	  }
	  }
	  ?>
	  
	  <!----------------Special Offer------------------------>
	  <h4>Offers a Discounts</h4>
	  <?php
	  if($earlyBirdData)
	  {	  
	  ?>
	  <p><b>Early Birds</b></p>
	  <p> If booking <?php echo $earlyBirdData['time_value']." ".$earlyBirdData['time_key']  ;?> prior to Arrival date <?php echo $earlyBirdData['amount']." ".$earlyBirdData['discount_by'];?>  on total Amount</p>
	  <?php  
	  }
	  if($LastMinuteData)
	  {
	  ?>
	  <p><b>Last Minute Offer</b></p>
	  <p> If booking <?php echo $LastMinuteData['time_value']." ".$LastMinuteData['time_key']  ;?> prior to Arrival date <?php echo $LastMinuteData['amount']." ".$LastMinuteData['discount_by'];?>  on total Amount</p>
	  <?php
	  }
	  if($offer_24_Data)
	  {
	 
	   $priceData=unserialize($offer_24_Data['amount']);

     $dateData=unserialize($offer_24_Data['date']);
	  ?>
	   <div class="row">
	   <div class="col-md-12">
              <div class="panel">
                <div class="panel-heading">
                  <div class="panel-title"> <i class="fa fa-table"></i> 24 Hour Offer</div>
                </div>
                <div class="panel-body">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                       <th>Booking made on </th>
                        <th>Amount (in%) concession on total amount</th>
                        </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><?php echo $dateData['offer_24_hour_offer_date'];?></td>
                        <td><?php echo $priceData['offer_24_hour_price_value'];?></td>
                       </tr>
					 <?php
					 
					 if(count($dateData['24_hour_offer_date_extra'])>0)
                     { 
					 foreach($dateData['24_hour_offer_date_extra'] as $key=>$value)
					 {
                     ?>
					 <tr>
                        <td><?php echo $value;?></td>
                        <td><?php echo $priceData['24_hour_offer_price_value_extra'][$key];?></td>
                       </tr>
                     <?php
					 }
                      }
                      ?>  					  
                                            
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
	      </div>
	  <?php
	  }
	  ?>
	  <!-------------------------------------------------------------------------------->
	 </div>
  <div id="calendar" class="tab-pane">
  <?php
  if($schedulingData)
  {
  //echo "<pre>";
  //print_r($schedulingData);
  if($schedulingData['bookingMode']=='DATE_ENQUIRY')
  {
  if($schedulingData['bookingTimeMode']=='FIXED')
  {
	  print '<p><b>Dates available  - </b>  Any date</p>';
	  $durationTime=unserialize($schedulingData['bookingFixedTimes']);
	   $str="";
		   foreach($durationTime as $key=>$value)
		  {
		  $str.="'".date("H:i", strtotime($value))."'".",";
		  } 	
	  ?>
	  
	  <p><b> Times available - </b> Fixed times</p>
	  <?php
		  if(isset($schedulingData['duration']))
		  {
		  ?>
		  <p><b> Estimated duration - </b> <?php echo $schedulingData['duration']." ".$schedulingData['durationUnit']; ?></p>
		  <?php
		  }
	  ?>
	  <input type="text" id="datetimepicker3" class="fixed-time-datepicker"/>
	   <script>
		var jq=jQuery.noConflict();
		var now=new Date();
		jq(document).ready(function(){
		jq('#datetimepicker3').datetimepicker({
		inline:true,
		minDate:now,
		allowTimes:[<?php   echo $str;?>],
		});
		});
	</script>
  <?php
  }
  else if($schedulingData['bookingTimeMode']=='TIME_ENQUIRY' || $schedulingData['bookingTimeMode']=='NO_TIME' )
	  {
	  ?>
	  <p><b> Times available - </b>Any time / Time not required for booking</p>
		  <?php
		  if(isset($schedulingData['duration']))
		  {
		  ?>
		  <p><b> Estimated duration - </b> <?php echo $schedulingData['duration']." ".$schedulingData['durationUnit']; ?></p>
		  <?php
		  }
		  ?>
	  <input type="text" id="any-time" class="fixed-time-datepicker"/>
	  <script>
	  var jq=jQuery.noConflict();
		var now=new Date();
		jq(document).ready(function(){
		jq('#any-time').datetimepicker({
		inline:true,
		minDate:now,
		});
		});
	  </script>	
	  <?php
	  }
  }
  else if($schedulingData['bookingMode']=='NO_DATE')
  {
  ?>
  <p><b>Date not required for booking</b></p>
  <?php
  if(isset($schedulingData['duration']))
  {
  ?>
  <p><b> Estimated duration - </b> <?php echo $schedulingData['duration']." ".$schedulingData['durationUnit']; ?></p>
  <?php
  }
  }
  else if($schedulingData['bookingMode']=='INVENTORY')
  {
  ?>
  <p><b>Dates available -</b>Fixed Date and Time</p>
  <?php
  //echo "<pre>";
  //print_r($sessiondata);
  if($sessiondata['defaultQuantity']!=null)
  {
  ?>
  <p><b> Availability - </b>(Limited)   <b><?php echo $sessiondata['defaultQuantity'];?></b></p>
  <?php
  }
  else
  {
  ?>
   <p><b> Availability - </b>(UnLimited)</p>
  <?php
  }
  if(isset($schedulingData['duration']))
  {
  ?>
  <p><b> Estimated duration - </b> <?php echo $schedulingData['duration']." ".$schedulingData['durationUnit']; ?></p>
  <?php
  }
  ?>
  <p><h4>Session Availability</h4></p>
  <p><b>From - </b><?php echo $sessiondata['startDate']."  ".$sessiondata['startTime'];?>  <b>TO - </b> <?php echo $sessiondata['endDate']."  ".$sessiondata['endTime'];?></p>
  <?php
  if($schedulingData['is_all_day']==1)
  {
  ?>
  <p><b>Add Day Event</b></p>
  <?php
  }
 if(!empty($scheduleSessionData)){
?>
<div class="row product-schedules-listing">
        <div class="col-md-12">
          <div class="panel">
            <div class="panel-heading">
              <div class="panel-title"> Session schedules </div>
            </div>
            <div class="panel-body">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Starts on</th>
                      <th>Limited to</th>
                      <th>Price</th>
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
  ?>
 <!-- <p><b>Session Repeat - </b> </p>-->
  <?php
  }
  ?>  
  <?php
  
  }
  ?> 
	
  </div>
  <div id="additional-services" class="tab-pane">
				  <!------------------------------------------------------------------------------>
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
                      <th>Name</th>
                      <th>Description</th>
                      <th>Type</th>
                      <th>Cost</th>                    
                    </tr>
                  </thead>
                  <tbody>
				<?php 
					foreach($extras as $extra){
						$extra1 	= unserialize($extra["value1"]);
				?>
                    <tr>
                      <td><?php echo $extra1["title"]; ?></td>
					  <td><?php echo $extra1["description"]; ?></td>
                      <td><?php echo $extra1["price-key"]; ?></td>
                      <td><?php echo $extra1["price"]; ?>  <?php echo $extra1["price-type"]; ?></td>                     
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
				  <!------------------------------------------------------------------------------->
     </div>
				  <div id="rules" class="tab-pane">
				  <?php
				   /*  echo "<pre>";
				  print_r($rulesDetail); */  				  
				  ?>
				  <p><b> Experience Requirements - </b><?php echo $rulesDetail['experience_rules']; ?></p>
				  <p><b> Other Information       - </b><?php echo $rulesDetail['other_information'] ;?></p>
				  <p><span><b>Expected Arrival Time - </b><?php echo $rulesDetail['expected_arrival_time']; ?></span>      <span><b>Expected Departure Time - </b></span><?php echo $rulesDetail['expected_dept_time']; ?></p>
				  <p><b> Security Deposit        - </b><?php echo $rulesDetail['security_deposit'];  if($rulesDetail['security_options']=='booking_%'){echo '%';} else echo '$'; ?></p>
                  <p><b> Cancellation Policies  - </b><?php echo $rulesDetail['cancellation_policies_type'] ;?></p>
				  <?php  
				  if($rulesDetail['cancellation_policies_type']=="Custom")
				  {				  
				  ?>
				  <p>
				 <b> Guests will receive their full refundable deposit plus:</b></br>
				<p> <?php echo $rulesDetail['amount_week'];?>  (in %) refund of their paid rental costs if they cancel at least <?php echo $rulesDetail['amount_week_rental']." " .$rulesDetail['amount_week_select'];?>  prior to reservation </p>
				<p> <?php echo $rulesDetail['amount_day'];?>  (in %) refund of their paid rental costs if they cancel at least <?php echo $rulesDetail['amount_day_rental']." " .$rulesDetail['amount_day_select'];?>  prior to reservation </p>
				
				</p>
				  <?php
				  }
				  ?>
                  <p><b> Agreement           - </b><?php echo $rulesDetail['agreement'] ;?></p>
				   
                  </div>
				  <!--<div id="boost" class="tab-pane">
                    <p><b>TAB FOUR - </b>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
                  </div>-->
                </div>
              </div>
           
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> -->
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script> 
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script> 
			  