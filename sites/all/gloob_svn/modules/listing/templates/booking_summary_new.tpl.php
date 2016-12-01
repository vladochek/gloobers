<?php
global $base_url;
//echo "<pre>";Print_r($_SESSION['order']);exit;
$forms=drupal_get_form('booking_summary_form');
$OverviewData=getOverviewData($_SESSION['listing_id']);
$photos = getPhotosData($_SESSION['listing_id']);
$userDetails = user_load($OverviewData["uid"]);	
$schedulingData=getSchedulingData($_SESSION['listing_id']);

/************Js Files**************/
drupal_add_js(drupal_get_path('theme', $GLOBALS['theme']) .'/js/html5shiv.js',array('scope' => 'footer'));
drupal_add_js(drupal_get_path('theme', $GLOBALS['theme']) .'/js/moment.js',array('scope' => 'footer'));
drupal_add_js(drupal_get_path('theme', $GLOBALS['theme']) .'/js/bootstrap-datetimepicker.js',array('scope' => 'footer'));
drupal_add_js(drupal_get_path('theme', $GLOBALS['theme']) .'/js/jquery.meanmenu.js',array('scope' => 'footer'));
if(isset($postedData['participants'])){
	$_SESSION['postedData'] = $postedData;
}
/************Css Files**************/
drupal_add_css(drupal_get_path('theme', $GLOBALS['theme']) .'/css/bootstrap.min.css','file');  
drupal_add_css(drupal_get_path('theme', $GLOBALS['theme']) .'/css/gloobers.css','file');  
drupal_add_css(drupal_get_path('theme', $GLOBALS['theme']) .'/css/responsive.css','file');  
drupal_add_css(drupal_get_path('theme', $GLOBALS['theme']) .'/css/meanmenu.css','file');  
drupal_add_css(drupal_get_path('theme', $GLOBALS['theme']) .'/css/font-awesome.css','file');  
drupal_add_css(drupal_get_path('theme', $GLOBALS['theme']) .'/css/bootstrap-datetimepicker.min.css',array('scope' => 'footer'));
$style='summary_img_style';
//echo $_SESSION['order']['imagepath'];exit;
?>
<script type="text/javascript">
jQuery.noConflict();	
jQuery(document).ready(function() {
jQuery(".creditmessage").fadeOut(7000);
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
			 companyname: {
				required: true,
			},
			street : {
				required: true,
			},
			city : {
				required: true,
			},	
			zip	: {
				required: true,
			},
			state: {
				required: true,
			},
			number: {
				required: true,
				number:true
			}
		}
    });
}); 
</script>
<div class="dr-wrapper">
  <section class="summary-sec">
    <h1>Reservation Details</h1>
    <div class="col-lg-12 reserv-detail nopadding">
      <div class="col-xs-12 col-sm-12 col-md-6 leftcolimg nopadding">
		<img src="<?php print image_style_url($style,$_SESSION['order']['imagepath']);?>" alt=" "></div>
      <div class="col-xs-12 col-sm-12 col-md-6 nopadding rightcolsec">
        <div class="col-lg-12 rdetail">
          <div class="col-xs-7 col-sm-7 col-md-7 nopadding">
            <h2><?php echo $_SESSION['order']['title']; ?></h2>
            <p><?php echo $_SESSION['order']['city'].', '.$_SESSION['order']['country'].' - '.$_SESSION['order']['listing_type']; ?></p>
          </div>
          <div class="col-xs-5 col-sm-5 col-md-5 leftborder">
            <h2>Gross price($)</h2>
            <p><?php  echo $_SESSION['order']['gross_price']; ?></p>
          </div>
          <div> </div>
        </div>
        <div class="col-lg-12 rdetail bgcolor">
          <div class="col-xs-7 col-sm-7 col-md-7 nopadding">
            <h2>Date</h2>
            <p><?php  echo $_SESSION['order']['date']; ?></p>
          </div>
          <div class="col-xs-5 col-sm-5 col-md-5 leftborder">
            <h2>Travellers</h2>
            <p><?php echo $_SESSION['order']['qty']; ?></p>
          </div>
          <div> </div>
        </div>
        <div class="col-lg-12 rdetail">
          <div class="col-xs-7 col-sm-7 col-md-7 nopadding">
            <h2>Additionnal Service</h2>
            <p>Service Name - Quantity</p>
          </div>
          <div class="col-xs-5 col-sm-5 col-md-5 leftborder">
            <h2>Price Per Person</h2>
            <p>$Amount</p>
          </div>
          <div> </div>
        </div>
        <div class="col-lg-12 rdetail bgcolor">
          <div class="col-xs-7 col-sm-7 col-md-7 nopadding">
            <h2>Cancellation Policy</h2>
            <p><span><?php  echo ($rulesDetail['cancellation_policies_type'])?$rulesDetail['cancellation_policies_type']:'No policy selected'; ?></span></p>
          </div>
          <div class="col-xs-5 col-sm-5 col-md-5 leftborder">
            <h2>Deposit</h2>
            <p><?php  echo $_SESSION['order']['deposit'];  ?></p>
          </div>
          <div> </div>
        </div>
        <div class="col-lg-12 rdetail">
          <div class="col-xs-7 col-sm-7 col-md-7 nopadding">
            <h2 class="gross">Gross Total</h2>
            <p>Click <a href="<?php echo $base_url;?>/booking/usecredits"><< Use My Credits >></a> To Cut The Price.</p>
			<p class="creditmessage"><?php echo ($_SESSION['credit_message'])?$_SESSION['credit_message']:''; ?></p>
          </div>
		  <?php   
		  $disscounted=$_SESSION['order']['disscount'];
		  ($disscounted)?$disscounted:0;
		  $paybleprice=$_SESSION['order']['gross_price']-$disscounted; ?>
          <div class="col-xs-5 col-sm-5 col-md-5 leftborder">
            <h2 class="amount">$<?php echo sprintf('%.2f',$paybleprice);?></h2>
            <p>&nbsp;</p>
          </div>
          <div> </div>
        </div>
      </div>
      <div class="btnpanel">
		<a class="btnsend modified_send" href="<?php echo $base_url;?>/booking/usecredits">USE MY CREDITS</a>
		<a class="btncncl modified_cancel" href="<?php echo $base_url;?>/experience/<?php echo $_SESSION['order']['eid'] ?>">MODIFY RESERVATION</a>
        <!--<input name="" class="btnsend" value="USE MY CREDITS" type="submit">
        <input name="" class="btncncl" value="MODIFY RESERVATION" type="submit">
      -->
	  </div>
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
        <div class="msgclient"> <img src="../<?php echo drupal_get_path('theme', 'gloobers_new');?>/images/clientpic.JPG" alt=" ">
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
