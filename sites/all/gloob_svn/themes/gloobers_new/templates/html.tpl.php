<!DOCTYPE html>
<html>
<?php
 global $base_url,$base_path,$user; 
 $current_path = current_path(); 
  if(!$user->uid)
 {	 
 $user_login_form = drupal_get_form('user_login_block');
 $register_form =drupal_get_form('user_register_form');
 } 
  $link = fboauth_action_link_properties('connect');
	$string = "";
	foreach($link['query'] as $key=>$value){
	$string .=$key."=".$value;
	$string .="&";
	}
	$n = strlen($string);
	$query = substr($string,0,($n-1)); 
		
?>
<head>
<?php print $head; ?>
  <title><?php print $head_title; ?></title>
  <?php print $styles; ?>
  <?php print $scripts; ?>
  <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>
  
  <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700|Lato:300,400,700' rel='stylesheet' type='text/css'>
<script>
	$baseURL = "<?php echo $base_url;?>";
</script>
  </head>

<body <?php print $attributes; ?>>
<?php print $page_top; ?>
 <?php print $page; ?>
 <?php print $page_bottom; ?>
  <?php if($footer){echo render($footer);} ?>
  <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content loginpop">
      <div class="modal-header">
        <div class="btnfb"> 
		<a href="<?php echo $link['href'].'?'.$query ; ?>"><i class="fa fa-facebook"></i>Sign in with Facebook</a> </div>
       
        <h4 class="modal-title" id="exampleModalLabel">Log in with your email</h4>
      </div>
	 
      <div class="modal-body">
	  <div class="alert-message alert" style="display:none;"></div>
	  <?php echo drupal_render($user_login_form);	  ?>	  
    </div>
      <div class="modal-footer">
	  <p>Don't have an account? <a href="<?php echo url('user/register');?>">Sign up</a></p>
	  </div>     	
   </div>
  </div>
</div>
<!------------------------------------------------------->
<div class="modal fade" id="signup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content loginpop">
      <div class="modal-header">
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
</body>
</html>