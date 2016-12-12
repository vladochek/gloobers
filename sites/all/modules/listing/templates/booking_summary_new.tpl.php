<?php
global $user,$base_url;
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/gloobers.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/stylesheet/for-head-foot.css','file');
$forms=drupal_get_form('booking_summary_form');
$OverviewData=getOverviewData($_SESSION['order']['eid']);
$photos = getPhotosData($_SESSION['order']['eid']);
$userDetails = user_load($OverviewData["uid"]);	
$schedulingData=getSchedulingData($_SESSION['order']['eid']);
$rulesDetail = getRulesDetails($_SESSION['order']['eid']);
$rulesDetail = unserialize($rulesDetail["value1"]);
if($rulesDetail['security_options']=='amount_in_$'){
	$currencY_dollar='$';
}else{
	$currencY_dollar='';
	$currencY_percentage='%';
}
$service_tax=variable_get('service_tax');
$style='summary_img_style';
$Currency='$';
?>
<script type="text/javascript">
jQuery.noConflict();	
jQuery(document).ready(function() {
//jQuery(".creditmessage").fadeOut(7000);
jQuery('#booking_summary_form').validate({

		 rules: {
			 cardholdername: {
				required: true,

			 },
			 securitycode: {
				required: true,
				number:true
			 },
			creditcardno: {
				required: true,
				number:true
			 },
			 email:{
				 required: true,
				 email: true,
			 },
			street : {
				required: true,
			},
			city : {
				required: true,
			},	
			zip	: {
				required: true,				
				number:true
			},
			/*state: {
				required: true,
			},*/
			number: {
				required: true,
				number:true
			}
		}
    });
	var imagePath="<?php print image_style_url($style,$_SESSION['order']['imagepath']);?>";
	jQuery(".reserv-detail").css("background", 'url('+imagePath+')0 0 no-repeat');

}); 
</script>


<div class="dr-wrapper">
	<section class="summary-sec">
		<h1>Reservation Details</h1>
		<div class="col-lg-12 reserv-detail nopadding">
		<div class="col-xs-12 col-sm-12 col-md-6 leftcolimg nopadding">
			<?php //$style = "reservation_summary_style"; ?>
			<!--img style="display:block" src="<?php //print image_style_url($style,$_SESSION['order']['imagepath']);?>" alt=" "-->
		</div>
      <div class="col-xs-12 col-sm-12 col-md-6 nopadding rightcolsec">
        <div class="col-lg-12 rdetail">
          <div class="col-xs-7 col-sm-7 col-md-7 nopadding leftborder">
            <h2><?php echo $_SESSION['order']['title']; ?></h2>
            <p><?php echo $_SESSION['order']['city'].', '.$_SESSION['order']['country'].' - '.$_SESSION['order']['listing_type']; ?></p>
          </div>
          <div class="col-xs-5 col-sm-5 col-md-5 rightborder">
            <h2>Gross price($)</h2>
            <p>
				<?php  
					$used_globies=$_SESSION['order']['used_gloobies'];
					$personPrize=$_SESSION['order']['subtotal']['person_total'];
					$itemPrize=$_SESSION['order']['subtotal']['item_total'];
					$Mainsubtotal=$_SESSION['order']['Mainsubtotal'];
					if(isset($itemPrize)){
						$grossPrice=$itemPrize;
					}else{
						$grossPrice=$personPrize;
					}
					if(isset($_SESSION['order']['subtotal']['services_total'])){
					$servicePrize=$_SESSION['order']['subtotal']['services_total'];
					}else{
					$servicePrize=0;
					}
					$totalAmount=($grossPrice+$servicePrize);
					echo "<b>Total Amount:</b> $".$totalAmount.'<br/>';

					if($_SESSION['order']['disscountOfferApply']){
						$dissCountBy=$_SESSION['order']['disscountOfferApply']['disscountBy'];
						$Amt=$_SESSION['order']['disscountOfferApply']['amount'];
						$OfferType=$_SESSION['order']['disscountOfferApply']['offerType'];
						$disscountedAmount=$_SESSION['order']['disscountOfferApply']['disscountedAmount'];
					}
					if(empty($disscountedAmount)) {
						$disscountedAmount=0;
					}
					//echo $used_globies;exit;
					if($used_globies){
					$used_globies=$used_globies;
					}else{
					$used_globies='0';
					}
					if($OfferType){$OfferType=$OfferType;}else{$OfferType='N/A';}
					if(($Amt) && ($dissCountBy>0)){$amtDiss=$Amt.$dissCountBy;}else{$amtDiss='N/A';}
					echo "<b>Offer Apply: </b>".$OfferType.'<br/>';
					echo "<b>Offer By:</b> $".$disscountedAmount.'<br/>';
					$PaybleAmt=($totalAmount-$disscountedAmount);
					echo "<b>Payble amount:</b> $".$PaybleAmt.'<br/>';
					echo "<b>Gloobers services tax:</b> ".$service_tax.'%'.'<br/>';
					$payamount_tax_price=($PaybleAmt*$service_tax)/100;
					$payamount_tax_price=sprintf('%.2f',$payamount_tax_price);
					$Gross_total=($PaybleAmt+$payamount_tax_price);
					echo "<b>Payment amount with tax:</b> $".$Gross_total.'<br/>';
					//echo "<b>Gloobies Used:</b> ".($used_globies)?$used_globies:'0'.'<br/>';
					echo "<b>Gloobies Used:</b> ".'$'.$used_globies.'<br/>';
					$payamount_net=($Gross_total-$used_globies);
					echo "<b>Net Gross price:</b> $".sprintf('%.2f',$payamount_net);							
				?>
			</p>
          </div>
          <div> </div>
        </div>
        <div class="col-lg-12 rdetail bgcolor">
          <div class="col-xs-7 col-sm-7 col-md-7 nopadding leftborder">
            <h2>Date</h2>
            <p><?php  echo $_SESSION['order']['dateNew']; ?></p>
          </div>
          <div class="col-xs-5 col-sm-5 col-md-5 rightborder">
          <p>
				<?php 
					$quantity=array();
					if(isset($_SESSION['order']['person_type'])){
						echo '<h2>Travellers</h2>';
					foreach($_SESSION['order']['person_type'] as $qty){
					
						$quantity[]=$qty['qty'];
					}
					}else if($_SESSION['order']['item_type']){
						echo '<h2>Total Items</h2>';
						foreach($_SESSION['order']['item_type'] as $qty){
					
						$quantity[]=$qty['qty'];
					}

					}					
					$quantity=array_sum($quantity);
					echo $quantity; 
				?>
                </p>
          </div>
          <div> </div>
        </div>
        <div class="col-lg-12 rdetail">
          <div class="col-xs-7 col-sm-7 col-md-7 nopadding leftborder">
            <h2>Additional Service</h2>
			
            <?php  
					$additional_Service_prize=array();
					if(isset($_SESSION['order']['optional_services'])){ 
						foreach($_SESSION['order']['optional_services'] as $otherservices){
							echo '<p>'.$otherservices['title'].' - '.$otherservices['qty'].' - $'.$otherservices['total'].'</p>';
							$additional_Service_prize[]=$otherservices['total'];
						}
					}else{
						echo '<p>N/A</p>';
						
					}
					$total_additional_prize=array_sum($additional_Service_prize);
			?>
          </div>
          <div class="col-xs-5 col-sm-5 col-md-5 rightborder">            
			<?php 
			if(isset($_SESSION['order']['person_type'])){
				echo '<h2>Price Per Person</h2>';
				foreach($_SESSION['order']['person_type']  as $persontypes=>$persondata){
				echo "<p>";
					echo ucfirst($persontypes).' - $'.$persondata['price'].'';
				echo "</p>";
				}
			}else{
				echo '<h2>Total Price</h2>';
				foreach($_SESSION['order']['item_type']  as $persontypes=>$persondata){
				echo "<p>";
					echo ucfirst($persontypes).' - $'.$persondata['price'].'';
				echo "</p>";
				}
			}
			?>			
          </div>
          <div> </div>
        </div>
        <div class="col-lg-12 rdetail bgcolor">
          <div class="col-xs-7 col-sm-7 col-md-7 nopadding leftborder">
            <h2>Cancellation Policy</h2>
            <p><span><?php  echo ($rulesDetail['cancellation_policies_type'])?$rulesDetail['cancellation_policies_type']:'No policy selected'; ?></span></p>
          </div>
          <div class="col-xs-5 col-sm-5 col-md-5 rightborder">
            <h2>Deposit</h2>
            <p><?php 

         echo $_SESSION['order']['deposit']?($currencY_dollar.$_SESSION['order']['deposit'].$currencY_percentage):($Currency.'0');
             ?></p>  
          </div>
          <div> </div>
        </div>
		
		<?php if(isset($_SESSION['order']['availOfferList']) && !empty($_SESSION['order']['availOfferList'])) { ?>
		<div class="col-lg-12 rdetail bgcolor">
          <div class="col-xs-7 col-sm-7 col-md-7 leftborder nopadding">
            <h2>Discount Type</h2>
            <p><span><?php  echo $_SESSION['order']['availOfferList']['offer_type']; ?></span></p>
          </div>
          <div class="col-xs-5 col-sm-5 col-md-5">
            <h2>Discount</h2>
            <p><?php if(!empty($_SESSION['order']['availOfferList']['amout'])){ echo $Currency.$_SESSION['order']['availOfferList']['amout']; }else{ echo $Currency.'0'; } ?></p>
          </div>
          <div> </div>
        </div>
		<?php }?>
        <div class="col-lg-12 rdetail">
          <div class="col-xs-7 col-sm-7 col-md-7 nopadding leftborder">
            <h2 class="gross">Gross Total</h2>
			<p class="creditmessage"><?php echo (isset($_SESSION['creditDetail']['credit_message']))? $_SESSION['creditDetail']['credit_message']:''; ?></p>
          </div>
		  <div class="col-xs-5 col-sm-5 col-md-5 rightborder">
            <h2 class="amount">$<?php echo sprintf('%.2f',$payamount_net);?></h2>
            <p>&nbsp;</p>
          </div>
          <div> </div>
        </div>
      </div>
    
    </div> 
<div class="btnpanel">
		<?php //if($MaxUsedCredits > 0) {?>
		<!--<a class="btnsend modified_send"  data-toggle="modal" data-target="#recommend">USE MY CREDITS</a>
		<?php //} else { ?>
		<a class="btnsend" href="javascript:void(0)">NO CREDITS</a>-->
		<?php  //} ?>
		<a class="btncncl modified_cancel" href="<?php echo $base_url;?>/experience/<?php echo $_SESSION['order']['eid'].((isset($_SESSION['order']['availOfferList']))? '?offer='.base64_encode($_SESSION['order']['availOfferList']['offer_type']) : ''); ?>">Modify Reservation</a>
     
	  </div>
	<form id="<?php echo $forms['#form_id']; ?>"  accept-charset="UTF-8" method="<?php echo $forms['#method']; ?>" action="<?php echo $forms['#action']; ?>">
  
    <div class="col-lg-12 nopadding">
      <div class="paymntsec">
        <h2>Payment</h2>
        <p>Even If  You Can Pay The Entire Reservation Amount With Your Credits, We Will Need To Verify You Credit Card For The 
          Deposit Amount.</p>
      <div class="col-lg-12 formbar">
         
			<?php echo drupal_render($forms['booking_summary']['paymenttype']); ?>
          <div class="col-md-6">
            <label>&nbsp;</label>
            <img src="<?php echo $base_url.'/'.drupal_get_path('theme', 'gloobers_new');?>/images/cards.png" alt=" "></div>
        </div>
        <div class="col-lg-12 formbar">
			  <?php echo drupal_render($forms['booking_summary']['creditdata']); ?>
			  <?php echo drupal_render($forms['booking_summary']['creditcardno']); ?>
        </div>

        <div class="col-lg-12 formbar">
          <div class="col-md-6 nopadding">
            <div class="col-lg-12 nopadding">
             <?php echo drupal_render($forms['booking_summary']['expirationmonth']); ?>
      			 <?php echo drupal_render($forms['booking_summary']['expirationyear']); ?>
      			 <?php echo drupal_render($forms['booking_summary']['securitycode']); ?>
            </div>
          </div>
			   <?php echo drupal_render($forms['booking_summary']['cardholdername']); ?> 
          
        </div>
      </div>
    </div>
    <div class="col-lg-12 nopadding">
      <div class="billsec">
        <h2>Billing</h2>
        <div class="col-lg-12 formbar">
			<?php echo drupal_render($forms['booking_summary']['companyname']); ?> 
			<?php echo drupal_render($forms['booking_summary']['email']); ?> 
        </div>
        <div class="col-lg-12 formbar">
			  <?php echo drupal_render($forms['booking_summary']['firstname']); ?> 
			  <?php echo drupal_render($forms['booking_summary']['lastname']); ?> 
        </div>
        <div class="col-lg-12 formbar">
          
		  <?php echo drupal_render($forms['booking_summary']['street']); ?> 
          <div class="col-md-6 nopadding">
            <div class="col-lg-12 nopadding">
			  <?php echo drupal_render($forms['booking_summary']['number']); ?> 
             <?php echo drupal_render($forms['booking_summary']['apt']); ?> 
            </div>
          </div>
        </div>
        <div class="col-lg-12 formbar">
          <div class="col-md-6 nopadding">
            <div class="col-lg-12 nopadding">
              <?php echo drupal_render($forms['booking_summary']['city']); ?> 
              <?php echo drupal_render($forms['booking_summary']['zip']); ?> 
            </div>
          </div>
          <div class="col-md-6 nopadding">
            <div class="col-lg-12 nopadding">
              <?php echo drupal_render($forms['booking_summary']['state']); ?> 
              <?php echo drupal_render($forms['booking_summary']['country']); ?> 
            </div>
          </div>
        </div>
      </div>
	  
	<div class="msgsec">
        <div class="msgclient"> 
		   <?php
		   if (!empty($userDetails->picture)) {
                            $fid = $userDetails->picture->fid;
							//echo $fid;exit;
                            $file = file_load($fid);
                            $imgpath = $file->uri;
							$imgpath=($imgpath)?$imgpath:'';
                            $style = 'experience_topranked';
                            $src = image_style_url($style,$imgpath);
            }
			if($imgpath !=''){
			?>
				<img alt="profile pic" src="<?php echo $src; ?>">  
			<?php }else{ ?>
				<img alt="no profile pic" src="<?php echo $base_url.'/'.drupal_get_path('theme',$GLOBALS['theme']);?>/images/no-profile-male-img.jpg">  
			<?php } ?>
			<h2>Leave A Message</h2>
        </div>
        <br class="clear"/>
        <p>Any Other Information You Would Like To Share WIth The Owner. Special Request Or Information About Your Arrival.</p>
		<?php echo drupal_render($forms['booking_summary']['message']); ?>
    </div>
	  
	<?php echo drupal_render($forms['booking_summary']['submit']); ?> 
	<input type="hidden" value="<?php echo $forms['form_build_id']['#value'];?>" name="form_build_id">
    <input type="hidden" value="<?php echo $forms['form_token']['#default_value'];?>" name="form_token">
	<input type="hidden" value="<?php echo $forms['#form_id']; ?>" name="form_id">
	</div>
	</section>
	
</div></form>

<script>
jQuery(window).load(function(){ 
  jQuery("#booking_summary_form")[0].reset();  
  jQuery("#edit-creditcardno").val('');
  jQuery("#edit-securitycode").val('');
});
</script>