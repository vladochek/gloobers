<?php
 $link = fboauth_action_link_properties('connect');
	$string = "";
	foreach($link['query'] as $key=>$value){
	$string .=$key."=".$value;
	$string .="&";
	}
	$n = strlen($string);
	$query = substr($string,0,($n-1));
    // $form = drupal_get_form('user_login_block');
	$form = drupal_get_form('user_register_form');
	//exit;
	 $register_form = drupal_get_form('user_register_form');
	?>
	<!--Landding page Css Here-->
<link rel="stylesheet" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/stylesheet/style.css">
<link rel="stylesheet" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/stylesheet/pop_up.css">
<!--Fonts Css Here-->
<link rel="stylesheet" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/fonts/stylesheet.css">

<div class="bgback3">
  <div class="bgdark">
   <?php if ($messages): ?>
				<div id="messages"><div class="section clearfix">
				  <?php print $messages; ?>
				</div></div> <!-- /.section, /#messages -->
	<?php endif; ?>
    <div class="loginsec">
      <div class="login_box">
		 <h3><?php print t('New on Gloobers ?');?></h3>
		 <p><?php print t('Join the tribe now');?> </p>
		 <div class="facebook"><a href="<?php echo $link['href'].'?'.$query ; ?>">
		 <img src="<?php echo $GLOBALS['base_url'].'/'.drupal_get_path('theme',$GLOBALS['theme']).'/images/fb.png';?>" alt="image"></a></div>
		 <p><?php print t('or');?> </p>
			<div class="rowlogin">
              <h3><?php print t('Sign up with your email');?></h3>
            </div>
			<div id="divErrReg" style="color:red;"></div>
			<?php
				print '<div class="rowlogin">';
				print drupal_render($register_form);
				print '<div class="load-screen_details_loginSignup"></div>';
				print '</div>';
				print '<div class="rowlogin1">';
				print '<p>Already member? <a href="'.url('login').'">Login</a></p>';
				print '</div>';  
			?>
			</div>
		</div>
    </div>
  </div>

<script type="text/javascript">
	jQuery(document).ready(function () {
	jQuery("#edit-name").attr('placeholder','Enter Your Username');
	jQuery("#edit-mail").attr('placeholder','Enter Your Email');
	jQuery("#edit-field-first-name-und-0-value").attr('placeholder','First Name');
	jQuery("#edit-field-last-name-und-0-value").attr('placeholder','Last Name');	jQuery(".password-field").attr('placeholder','Password');	jQuery(".password-confirm").attr('placeholder','Repeat Password');

	jQuery("#edit-pass-pass1--3").attr('placeholder','Enter Your Password');
	jQuery("#edit-pass-pass2--3").attr('placeholder','Repeat Your Password');
	
	});
	
	jQuery.noConflict();
	jQuery( "#user-register-form--2" ).validate({
		rules: {
			 mail: {
				required: true,
				email: true
				},
			"pass[pass1]": "required",
			"pass[pass2]": {
			equalTo: "#edit-pass-pass1--2"
			}
		}
	});
	jQuery.extend(jQuery.validator.messages, {
		required: "This field is required.",
		email:"Please enter valid email address",
		equalTo:"Password and Confirm password do not match."
			
   
	});
</script>