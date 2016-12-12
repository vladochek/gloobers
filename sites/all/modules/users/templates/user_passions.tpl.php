<?php
global $base_url,$user;
$OverviewData=getOverviewData($_SESSION['listing_id']);
$photos = getPhotosData($_SESSION['listing_id']);
$userDetails = user_load($OverviewData["uid"]);	
$schedulingData=getSchedulingData($_SESSION['listing_id']);
$current_path=current_path();
/************Js Files**************/
/* drupal_add_js(drupal_get_path('theme', $GLOBALS['theme']) . '/js/autocomplete.js', array('scope' => 'footer'));
drupal_add_js(drupal_get_path('theme', $GLOBALS['theme']) .'/js/jquery.js','file');

drupal_add_js(drupal_get_path('theme', $GLOBALS['theme']) .'/js/jquery.nicescroll.min.js','file');
drupal_add_js(drupal_get_path('theme', $GLOBALS['theme']) .'/js/tagmanager.js','file');
drupal_add_js(drupal_get_path('theme', $GLOBALS['theme']) .'/js/jquery.selectbox-0.2.js','file'); */

/************Css Files**************/
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/stylesheet/for-head-foot.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/landing_page.css','file');
drupal_add_css(drupal_get_path('theme', $GLOBALS['theme']) .'/css/bootstrap-tagsinput.css','file');  


?>


<!--Steps HTML  Here--> 
<section class="steps modified_steps">
<div class="container">
<article>
<h1><?php if($current_path=='user/editpassions'){ echo "Edit"; }else{ echo "Select"; } ?> your travel passions  </h1>
<p>Tell your friends your travel passions so they can give you their best recommendations.</p>
</article>

<div class="about_profile">
<div class="row">
<div class="grid">
<?php 
//echo "<pre>";Print_r($passionlist);exit;
  foreach($passionlist as $passionlis){

		$file 	= file_load($passionlis['fid']);
		$imgpath = $file->uri;
		
		$style = 'passion_image';
		$file_thumb 	= file_load($passionlis['fid_thumb']);
		$imgpath_thumb = $file_thumb->uri;
		$userpassions=getuserspassion($passionlis['pid'],$user->uid);
		if($userpassions=='0'){$class='';}else{$class='selected_img';}
			
		//echo $imgpath;exit;	
  ?>
	<div class="col-xs-12 col-sm-4 col-md-3" onclick="insertPassionate('<?php echo $passionlis['pid']; ?>');"> 
					<figure class="effect-layla <?php echo $class; ?>" id="img_<?php echo $passionlis['pid']; ?>">
						<img src="<?php print image_style_url($style,$imgpath); ?>" class=""  alt=" ">
						<figcaption>
                        
							<!-- <div class="contblock"> 
							<?php if($passionlis['fid_thumb']){ ?><i>
							<img src="<?php print file_create_url($imgpath_thumb); ?>"  alt=" "></i>
							<?php } ?>
							</div> -->
							 <h2><?php echo ucfirst(strtolower($passionlis['passion'])); ?></h2>
						</figcaption>			
					</figure> 
					</div>
    <?php } ?>
	</div>
</div>
<?php if($current_path=='user/editpassions'){ ?>
<div class="row">
<div class="pull-right"> <a href="<?php //echo $base_url; ?>/user_profile" class="button pull-right"> Back to profile page </a> </div>
<?php }else{ ?>
<div class="row submitrow">
<div class="pull-right"><a href="<?php echo $base_url; ?>/user/step5" class="latter">Do this later </a> <a href="<?php echo $base_url; ?>/user/step5" class="button pull-right"> Next </a> </div>
</div>
<?php } ?>

</div>
</div>
</section>

<script type="text/javascript">


	function insertPassionate(passionId){
	
		var test=jQuery( "#img_"+ passionId).hasClass( "selected_img" );
		if(test==true){
			jQuery( "#img_"+ passionId ).removeClass( "selected_img" );
		}else{
			jQuery( "#img_"+ passionId ).addClass( "selected_img" );
		}
		
		jQuery.ajax({
		
			 url:'<?php echo $base_url; ?>/ajax/adduserpassion',
			 type:'post',
			 data:{ passionid:passionId,'isAjax':1},
			 success: function(result){
				
			 }
		 });

	}
	

</script>