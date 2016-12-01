<?php
global $base_url,$user;
 //echo $base_url.'/sites/all/themes/gloobers_new/images/passion/1.png';exit;
//echo $base_url.'sites/all/theme/gloobers_new/';exit;
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

/************Css Files**************/
drupal_add_css(drupal_get_path('theme', $GLOBALS['theme']) .'/css/bootstrap.min.css','file');  
drupal_add_css(drupal_get_path('theme', $GLOBALS['theme']) .'/css/gloobers.css','file');  
drupal_add_css(drupal_get_path('theme', $GLOBALS['theme']) .'/css/responsive.css','file');  
drupal_add_css(drupal_get_path('theme', $GLOBALS['theme']) .'/css/meanmenu.css','file');  
drupal_add_css(drupal_get_path('theme', $GLOBALS['theme']) .'/css/font-awesome.css','file');  
drupal_add_css(drupal_get_path('theme', $GLOBALS['theme']) .'/css/bootstrap-datetimepicker.min.css',array('scope' => 'footer'));
?>
<section class="list-sec">
  <div class="dr-wrapper">
    <div class="col-lg-12">
      <h1>Select Your Passion</h1>
    </div>
  </div>
</section>
<div class="dr-wrapper">
  <div class="col-lg-12 passview">
  <?php 
  foreach($passionlist as $passionlis){

		$file 	= file_load($passionlis['fid']);
		$imgpath = $file->uri;
		//echo "<pre>";Print_r($passionlist);exit;
		$style = 'passion_image';
		$file_thumb 	= file_load($passionlis['fid_thumb']);
		$imgpath_thumb = $file_thumb->uri;
		$userpassions=getuserspassion($passionlis['pid'],$user->uid);
		if($userpassions=='0'){$class='';}else{$class='selected_img';}
			
			
  ?>
    <div class="col-xs-12 col-sm-4 col-md-4 passblock" onclick="insertPassionate('<?php echo $passionlis['pid']; ?>');"> 

		<img src="<?php print image_style_url($style,$imgpath); ?>" class="<?php echo $class; ?>" id="img_<?php echo $passionlis['pid']; ?>" alt=" ">
		  <div class="contblock"> 
			  <i>
				<img src="<?php print file_create_url($imgpath_thumb); ?>"  alt=" ">
			  </i>
			<h2><?php echo $passionlis['passion']; ?></h2>
		  </div>
    </div>
    <?php } ?>
  </div>
</div>

<script type="text/javascript">


	function insertPassionate(passionId){
	
		var test=jQuery( "#img_"+ passionId).hasClass( "selected_img" );
		if(test==true){
			jQuery( "#img_"+ passionId ).removeClass( "selected_img" );
		}else{
			jQuery( "#img_"+ passionId ).addClass( "selected_img" );
		}
		
		jQuery.ajax({
		
			 url:'<?php $base_url?>/gloob/ajax/adduserpassion',
			 type:'post',
			 data:{ passionid:passionId,'isAjax':1},
			 success: function(result){
				/* if(result=='del'){
					alert('passion removed successfully.');
				}else{				
					alert('passion added successfully.');
				} */
			 }
		 });

	}
	

</script>