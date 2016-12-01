<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"  xmlns:og="http://ogp.me/ns#"  xmlns:fb="https://www.facebook.com/2008/fbml">
<?php
	global $base_url,$base_path,$user,$global; 
	$current_path = current_path(); 
	$path = current_path();

//22april2016//
$timezone=date_default_timezone_get();
date_default_timezone_set($timezone);
//end 22april2016//

if($user->uid){
  //22april2016//
$timezonefile=fopen("timezone.text",a);
fwrite($timezonefile,$user->uid.'='.$timezone.PHP_EOL);
fclose($timezonefile);
//end 22april2016//
}


	 if(!$user->uid)
	 {	 

	 $user_login_form = drupal_get_form('user_login_block');
	 $attribute=array('class'=>'test');
	 $arr=array_merge($user_login_form['#submit'],$attribute);
	 $register_form = drupal_get_form('user_register_form');
	 } 
	$link = fboauth_action_link_properties('connect');
	$string = "";
	foreach($link['query'] as $key=>$value){
	$string .=$key."=".$value;
	$string .="&";
	}
	$n = strlen($string);
	$query = substr($string,0,($n-1)); 
	$current_path = current_path();	
?>
<head>
	<?php print $head; ?>
	<title><?php print $head_title; ?></title>
	<?php print $styles; ?>
	<?php if(($path != 'user/step5')){ print $scripts; } ?>
	<?php 

if(($path == 'user/step5')){

 ?>
 <script>
 $baseUrl="<?php echo $base_url; ?>";
 $globalThemeUrl = '<?php echo drupal_get_path('theme', 'gloobers_new'); ?>';
 </script>
<script type="text/javascript" src="<?php echo $base_url; ?>/sites/all/themes/gloobers_new/js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>/sites/all/themes/gloobers_new/js/jquery.zclip.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>/sites/all/themes/gloobers_new/js/jquery.zclip.min.js"></script>
<script>
	jQuery(document).on('click','#copy-dynamic',function(){

		jQuery('#copy-dynamic').zclip({
			//path:$baseUrl+'/'+$globalThemeUrl+'/images/ZeroClipboard.swf',
			path:'http://davidwalsh.name/demo/ZeroClipboard.swf',
			
				copy:function(){
					return	jQuery('#dynamic').val();
				}
			});
		});
		if (window.console && window.console.firebug) {
		   if (! ('console' in window) || !('firebug' in console)) {
			var names = ['log', 'debug', 'info', 'warn', 'error', 'assert', 'dir', 'dirxml', 'group', 'groupEnd', 'time', 'timeEnd', 'count', 'trace', 'profile', 'profileEnd'];
			window.console = {};
			for (var i = 0; i < names.length; ++i) window.console[names[i]] = function() {};
			}
		}
</script>
<?php  } ?>
  
 <!--script src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyCrieeAcc8gUAxrnmM9dCO33N8X77-hkhs&libraries=places&language=en"
        async defer></script--> 
		
		<script src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyA9ZXW_xxCYbGV5hAN13jO2yquESD3MY10 &libraries=places&language=en"
        async defer></script>

  <!--script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script-->
 

<?php 

if($current_path=='finder'){
 $imgpath= $base_url . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/images/default_images/banner-listing_img.jpg';

}
$query=db_select('gbl_experience_list','m')
			->fields('m',array('main_img_fid','title'))
			->condition('eid',arg(1));
$result=$query->execute();
$mainImg=$result->fetchAll(PDO::FETCH_ASSOC);
if(!empty($mainImg[0]['main_img_fid'])){

	$metalisitngFid=$mainImg[0]['main_img_fid'];
}else{
	$photo = getPhotosData(arg(1));
	$photo = unserialize($photo[0]["value1"]);
	$metalisitngFid=$photo["fid"];
}

if(strpos($current_path,'experience') !== false){

  $file = file_load($metalisitngFid);
  $style = "sharing_listing_image";
  $Img_uri = $file->uri;
  if(file_exists($Img_uri)){
    $imgpath=$Img_uri;
    $Img_Name = $file->filename; ?>
    <img class="image_print" style="display:none" src="<?php print image_style_url($style, $imgpath); ?>" alt="" title="" />
  <?php }else{
    $imgpath=$Img_uri;
    $Img_Name = 'banner-listing_img.jpg';
  }	
}
?>
<script>
	$baseURL = "<?php echo $base_url;?>";
</script>
<title>Gloobers</title>
<meta charset="utf-8" />
<!--meta tags Here-->
<meta property="fb:admins" content="<?php echo $user->uid; ?>" />
<meta property="fb:app_id" content='1494427384207396' /> 
<meta property="og:type"   content="website" /> 

<?php 
if((strpos($_SERVER['REQUEST_URI'],'/experience/') !== false)){ ?>
<meta name="og:url" content="http://gloobers.com<?php echo $_SERVER['REQUEST_URI']; ?>" />
<meta name="og:title" content='<?php echo $mainImg[0]['title']; ?>' />
<meta name="og:description" content='Be friendly - Travel for free. Travel for free thanks to your helpful recommendations. Drop us your email and be the first to know when we launch. Stay tuned on.' />
<meta property="og:image" content="http://gloobers.com/sites/default/files/styles/sharing_listing_image/public/products/<?php echo $Img_Name; ?>" /> 

<!-- Twitter Tags -->
<meta name="twitter:site" content="http://gloobers.com<?php echo $_SERVER['REQUEST_URI']; ?>">
<meta name="twitter:url" content="http://gloobers.com<?php echo $_SERVER['REQUEST_URI']; ?>" />
<meta name="twitter:title" content="<?php echo $mainImg[0]['title']; ?>">
<meta name="twitter:description" content="Be friendly - Travel for free. Travel for free thanks to your helpful recommendations. Drop us your email and be the first to know when we launch. Stay tuned on.">
<meta name="twitter:creator" content="@Gloobers">
<!-- Twitter Summary card images must be at least 120x120px -->
<meta name="twitter:image:src" content="http://gloobers.com/sites/default/files/styles/sharing_listing_image/public/products/<?php echo $Img_Name; ?>" /> 
<!-- END TWITTER -->

<!--Google + -->
<meta itemprop="name" content="<?php echo $mainImg[0]['title']; ?>" />
<meta itemprop="description" content="Be friendly - Travel for free. Travel for free thanks to your helpful recommendations. Drop us your email and be the first to know when we launch. Stay tuned on." />
<meta itemprop="image" content="http://gloobers.com/sites/default/files/styles/sharing_listing_image/public/products/<?php echo $Img_Name; ?>" /> 

<!-- END Google+ -->
<?php }else if((strpos($_SERVER['REQUEST_URI'],'/advisor_listing_results/') !== false)){ ?>
<meta name="og:url" content="http://gloobers.com<?php echo $_SERVER['REQUEST_URI']; ?>" />
<meta name="og:title" content='Gloobers advisor request' />
<meta name="og:description" content='Be friendly - Travel for free. Travel for free thanks to your helpful recommendations. Drop us your email and be the first to know when we launch. Stay tuned on.' />
<meta property="og:image" content="http://gloobers.com/sites/all/themes/gloobers_new/images/2meta.png" /> 

<!-- Twitter Tags -->
<meta name="twitter:site" content="http://gloobers.com<?php echo $_SERVER['REQUEST_URI']; ?>">
<meta name="twitter:title" content="Gloobers advisor request">
<meta name="twitter:description" content="Be friendly - Travel for free. Travel for free thanks to your helpful recommendations. Drop us your email and be the first to know when we launch. Stay tuned on.">
<meta name="twitter:creator" content="@Gloobers">
<!-- Twitter Summary card images must be at least 120x120px -->
<meta name="twitter:image" content="http://gloobers.com/sites/all/themes/gloobers_new/images/2meta.png" /> 
<!-- END TWITTER -->

<!--Google + -->
<meta itemprop="name" content="Gloobers advisor request" />
<meta itemprop="description" content="Be friendly - Travel for free. Travel for free thanks to your helpful recommendations. Drop us your email and be the first to know when we launch. Stay tuned on." />
<meta itemprop="image" content="http://gloobers.com/sites/all/themes/gloobers_new/images/2meta.png" /> 

<!-- END Google+ -->

<?php }else if ($_SERVER['REQUEST_URI']=='/'){  ?>
<meta name="og:url" content="http://gloobers.com" />
<meta name="og:title" content='Gloobers' />
<meta name="og:description" content='Be friendly - Travel for free. Travel for free thanks to your helpful recommendations. Drop us your email and be the first to know when we launch. Stay tuned on.' />

<meta property="og:image" content="http://gloobers.com/sites/all/themes/gloobers_new/images/2meta.png" />

<!-- Twitter Tags -->
<meta name="twitter:site" content="http://gloobers.com">
<meta name="twitter:title" content="Gloobers">
<meta name="twitter:description" content="Be friendly - Travel for free. Travel for free thanks to your helpful recommendations. Drop us your email and be the first to know when we launch. Stay tuned on.">
<meta name="twitter:creator" content="@Gloobers">
<!-- Twitter Summary card images must be at least 120x120px -->
<meta name="twitter:image" content="http://gloobers.com/sites/all/themes/gloobers_new/images/2meta.png" /> 
<!-- END TWITTER -->

<!--Google + -->
<meta itemprop="name" content="Gloobers" />
<meta itemprop="description" content="Be friendly - Travel for free. Travel for free thanks to your helpful recommendations. Drop us your email and be the first to know when we launch. Stay tuned on." />
<meta itemprop="image" content="http://gloobers.com/sites/all/themes/gloobers_new/images/2meta.png" /> 

<!-- END Google+ -->

<?php }else{  ?>
<meta name="og:url" content="http://gloobers.com<?php echo $_SERVER['REQUEST_URI']; ?>" />
<meta name="og:title" content='Help me plan my trip... And get rewarded' />
<meta name="og:description" content='Be friendly - Travel for free. Travel for free thanks to your helpful recommendations. Drop us your email and be the first to know when we launch. Stay tuned on.' />
<meta property="og:image" content="http://gloobers.com/sites/all/themes/gloobers_new/images/1meta.png" />

<!-- Twitter Tags -->
<meta name="twitter:site" content="http://gloobers.com<?php echo $_SERVER['REQUEST_URI']; ?>">
<meta name="twitter:title" content="Help me plan my trip... And get rewarded">
<meta name="twitter:description" content="Be friendly - Travel for free. Travel for free thanks to your helpful recommendations. Drop us your email and be the first to know when we launch. Stay tuned on.">
<meta name="twitter:creator" content="@Gloobers">
<!-- Twitter Summary card images must be at least 120x120px -->
<meta name="twitter:image" content="http://gloobers.com/sites/all/themes/gloobers_new/images/1meta.png" /> 
<!-- END TWITTER -->

<!--Google + -->
<meta itemprop="name" content="Help me plan my trip... And get rewarded" />
<meta itemprop="description" content="Be friendly - Travel for free. Travel for free thanks to your helpful recommendations. Drop us your email and be the first to know when we launch. Stay tuned on." />
<meta itemprop="image" content="http://gloobers.com/sites/all/themes/gloobers_new/images/1meta.png" /> 

<!-- END Google+ -->
 
<?php } ?>
<!--Title Here-->

<?php if(strpos($_SERVER['REQUEST_URI'],'/booking/summary') !== false || strpos($_SERVER['REQUEST_URI'],'/product/add/payment') !== false){ 

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

}
?>



</head>

<body <?php print $attributes; ?>>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=1628223834126415";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php print $page_top; ?>
 <?php print $page; ?>
 <?php print $page_bottom; ?>
  <?php 
  //echo $current_path;exit;
  //echo $_SERVER['REQUEST_URI'];exit;
  if($footer)
  {
	  if (($current_path != "login") && ($current_path != "register") && ($current_path != "user/confirm") && ($current_path != "user/step0") && ($current_path != "user/step1") && ($current_path != "user/step2") && ($current_path != "user/step3") && ($current_path != "user/step4") && (strpos($_SERVER['REQUEST_URI'],'search-destination') === true)) {
		//echo render($footer);
	  }
  } ?>
  <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      
    <div class="modal-content loginpop">
        
      <div class="modal-header">
          <button class="close" aria-label="Close" style="position:relative;top:-9px;" data-dismiss="modal" type="button">
            <span aria-hidden="true">×</span>
            </button>
        <div class="btnfb"> 
		<a href="<?php echo $link['href'].'?'.$query ; ?>"><i class="fa fa-facebook"></i>Sign in with Facebook</a> </div>
		<h4 class="modal-title" id="exampleModalLabel">Log in with your email</h4>
      </div>
	 <?php echo drupal_render($user_login_form);	  ?>	  
    </div>
      <div class="modal-footer">
	  <p>Don't have an account? <a href="<?php echo url('register');?>">Sign up</a></p>
	  </div>     	
   </div>
  </div>
<div class="modal fade" id="signup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content loginpop">
      <div class="modal-header">
           <button class="close" aria-label="Close" style="position:relative;top:-9px;" data-dismiss="modal" type="button">
            <span aria-hidden="true">×</span>
            </button>
        <div class="btnfb"><a href="<?php echo $link['href'].'?'.$query ; ?>">
		
		<i class="fa fa-facebook"></i>Sign in with Facebook</a> </div>
       
        <h4 class="modal-title" id="exampleModalLabel">New message</h4>
      </div>
	  <div id="divErr" style="color:red;"></div>
      <div class="modal-body">
	  <div class="alert-message alert" style="display:none;"></div>
       <?php echo drupal_render($register_form);?>		
      </div>
      <div class="modal-footer">        
        <p>Already have an account? <a href="<?php echo url('login');?>">Log In</a></p>
      </div>
    </div>
  </div>
</div>
<?php if(($path != 'user/step5')){ ?>
<script>
var jq = jQuery.noConflict();
jq(document).ready(function(){
	jq("#user-register-form").validate({
		 rules: {

        "field_first_name[und][0][value]": {
            required :true,
        },
        "field_last_name[und][0][value]": {
          required :true,
        },
        "terms" :{
          required : true,
        }, 

        "mail": {
            required: true,
			  email: true
        },
        "pass[pass1]": {           
             required: true,
        },
		"pass[pass2]":{
			 required: true,
			 equalTo : "#edit-pass-pass1"
		}
    },
	});	
});
</script>
<?php } ?>
<div id="load-screen" style="display:none;"></div>
<script type="text/javascript">
jQuery(document).on('mouseenter','#drop4',function (){
	console.log('unread_counter front');

		jQuery.ajax({
            url: $baseUrl + '/ajax/unread_counter',
            type: 'post',
            async:true,            
            beforeSend: function () {
               
            },
            success: function (data) {
                          
              jQuery('.notification_block').html('');        
              jQuery(".nav-dropdown-heading").text('Notifications');


            }
        });
});

jQuery(document).ready(function(){
    //1 minute interval for notification
   setInterval(function() { 
        getNotifications();
    },60000);
  
});

getNotifications =  function(){  
console.log("front"); 
var uid="<?php echo $user->uid; ?>";
if(uid>0) {
  console.log(uid); 

    jq.ajax({
        url: $baseUrl + '/advice/notification/',
        type: 'post',        
        data: {notification:1},
        async:true,
        beforeSend: function () {
           
        },
        success: function (data) {
            // var res = jQuery.parseJSON(data);
            // var notificationCount = (res.count>0)? res.count : '';
            // jQuery('#_my_notifications_badge').html(notificationCount);
            var res = jQuery.parseJSON(data);
            var notificationCount = (res.count>0)? res.count : '';
            var html = '<span class="count" id="_my_notifications_badge">'+notificationCount+'</span>';
            if(res.count>0)
            {
            jQuery('.notification_block').html(html);
            //jQuery('.notification_block').text(notificationCount);
            jQuery(".nav-dropdown-heading").text('Notifications('+notificationCount+')');
            } else {
            	jQuery('.notification_block').html('');
            }

            jQuery('#_my_notifications_badge2').text(notificationCount);
            jQuery('#noti_ajax_data').html(res.html);
        }
    });
 }
}

</script>
</body>
</html>