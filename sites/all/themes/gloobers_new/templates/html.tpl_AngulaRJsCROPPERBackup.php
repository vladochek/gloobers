<!DOCTYPE html>
<html ng-app="myApp">
<?php
 global $base_url,$base_path,$user; 
 $current_path = current_path(); 
  if(!$user->uid)
 {	 
 $user_login_form = drupal_get_form('user_login_block');
 $attribute=array('class'=>'test');
 $arr=array_merge($user_login_form['#submit'],$attribute);
 //$user_login_form['#submit']['#attributes']=$attribute;
 //$user_login_form['actions']['submit']['#attributes'] =  array('class'=>'my_class');
 //$user_login_form['actions']['submit']=array_merge($user_login_form['actions']['submit'],$user_login_form['actions']['submit']['#attributes']);
 //echo "<pre>";Print_r($user_login_form['actions']['submit']);exit;
 //echo "<pre>";Print_r(drupal_render($user_login_form));exit;
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
  <?php print $scripts; ?>
  <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>
  <link href='http://fonts.googleapis.com/css?family=Khula:400,300,600,700,800' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700|Lato:300,400,700' rel='stylesheet' type='text/css'>
<script>
	$baseURL = "<?php echo $base_url;?>";
</script>
<script type="text/javascript" src="<?php echo drupal_get_path('theme', $GLOBALS['theme']) . '/js/angular.min.js' ?>"></script>
<script type="text/javascript" src="<?php echo drupal_get_path('theme', $GLOBALS['theme']) . '/js/image-crop.js' ?>"></script>
<link href='<?php echo drupal_get_path('theme', $GLOBALS['theme']) . '/css/image-crop-styles.css' ?>' rel='stylesheet' type='text/css'/>
 <script>
    var myApp = null;
    (function() {

      angular.module('myApp', ['ImageCropper'])
        .controller('MainController', function($scope) {
          console.log('MainController');

          $scope.imageCropResult = null;
          $scope.showImageCropper = false;

          $scope.$watch('imageCropResult', function(newVal) {
            if (newVal) {
              console.log('imageCropResult', newVal);
            }

          });

        });

    })();
  </script>
  <!-- REQUIRED 3/3 - the image crop directive -->
  <script type="text/javascript" src="<?php echo drupal_get_path('theme', $GLOBALS['theme']) . '/js/image-crop.js' ?>"></script>
 
 
</head>

<body <?php print $attributes; ?>>
<?php print $page_top; ?>
 <?php print $page; ?>
 <?php print $page_bottom; ?>
  <?php 
  
  if($footer)
  {
	  if (($current_path != "login") && ($current_path != "register")) {
	  
		echo render($footer);
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
	 
      <div class="modal-body">
	  <div class="alert-message alert" style="display:none;"></div>
	  <?php echo drupal_render($user_login_form);	  ?>	  
    </div>
      <div class="modal-footer">
	  <p>Don't have an account? <a href="<?php echo url('register');?>">Sign up</a></p>
	  </div>     	
   </div>
  </div>
</div>
<!------------------------------------------------------->
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
<script>
var jq = jQuery.noConflict();
jq(document).ready(function(){
	jq("#user-register-form").validate({
		 rules: {
        mail: {
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


<div id="load-screen" style="display:none;"></div>
</body>
</html>