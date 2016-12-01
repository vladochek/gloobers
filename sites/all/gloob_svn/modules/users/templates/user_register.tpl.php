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
	//echo "<pre>";Print_r($form);exit;
	// print drupal_render($form);
	?>
<div class="bgback3">
  <div class="bgdark">
    <div class="loginsec">
      <div class="col-lg-12">
        <div class="loginstuf">
          <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
            <div class="rowlogin">
             <h2>Sign up</h2>
            </div>
            <div class="rowlogin">
              <div class="btnfb"> <a href="<?php echo $link['href'].'?'.$query ; ?>">
			  <i class="fa fa-facebook"></i>Sign in with Facebook</a> </div>
            </div>
            <div class="rowlogin">
              <h3><?php print t('Sign up with your email');?></h3>
            </div>
			<?php
			print '<div class="rowlogin">';
               print drupal_render($form);
			print '</div>';
			print '<div class="rowlogin1">';
			print '<p>Already member? <a href="'.url('login').'">Login</a></p>';
            print '</div>';
			/* print '<div class="rowlogin">';
               print drupal_render($form['pass1']);
			print '</div>';  
			print '<div class="rowlogin">';
               print drupal_render($form['pass2']);
			print '</div>';			
            print drupal_render($form['form_build_id']);
            print drupal_render($form['form_id']);
			print '<div class="rowlogin">';
		
            print drupal_render($form['actions']);
            print '</div>';   */			
			?>
            <!--<div class="rowlogin">
              <label>Email</label>
              <input type="text" value="Enter your email" onfocus="if(this.value  == 'Enter your email') { this.value = ''; } " onblur="if(this.value == '') { this.value = 'Enter your email'; } ">
            </div>
            <div class="rowlogin">
              <label>Password</label>
              <input type="text" value="Enter your password" onfocus="if(this.value  == 'Enter your password') { this.value = ''; } " onblur="if(this.value == '') { this.value = 'Enter your password'; } ">
            </div>
            <div class="rowlogin">
              <p><a href="#">Forgot password?</a></p>
              <input name="" type="submit" value="log in">
            </div>-->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
	jQuery(document).ready(function () {
	jQuery("#edit-name").attr('placeholder','Enter Your Username');
	jQuery("#edit-mail").attr('placeholder','Enter Your Email');
	jQuery("#edit-pass-pass1").attr('placeholder','Password');
	jQuery("#edit-pass-pass2").attr('placeholder','Repeat Password');
	jQuery("#edit-field-first-name-und-0-value").attr('placeholder','First Name');
	jQuery("#edit-field-last-name-und-0-value").attr('placeholder','Last Name');
	});
</script>


<script type="text/javascript">
	jQuery.noConflict();
	
		/* jQuery( "#user-register-form--2" ).validate({
		rules: {
			  mail: {
					required: true,
					email: true
				 },
			"pass[pass1]": "required",
			"pass[pass2]": {
			equalTo: "#pass[pass1]"
			}
		
		}
	}); */
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