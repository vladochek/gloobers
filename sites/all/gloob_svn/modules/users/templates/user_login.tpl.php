

<?php
 $link = fboauth_action_link_properties('connect');
	$string = "";
	foreach($link['query'] as $key=>$value){
	$string .=$key."=".$value;
	$string .="&";
	}
	$n = strlen($string);
	$query = substr($string,0,($n-1));
    $form = drupal_get_form('user_login_block');
//Print_r($form );exit;
	?>
<div class="bgback3">
  <div class="bgdark">
    <div class="loginsec">
      <div class="col-lg-12">
        <div class="loginstuf">
          <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
            <div class="rowlogin">
              <h2>Log in</h2>
            </div>
            <div class="rowlogin">
              <div class="btnfb"> <a href="<?php echo $link['href'].'?'.$query ; ?>">
			  <i class="fa fa-facebook"></i>Sign in with Facebook</a> </div>
            </div>
            <div class="rowlogin">
              <h3><?php print t('Log in with your email');?></h3>
            </div>
			<?php
			print '<div class="rowlogin">';
            print drupal_render($form);
			print '</div>';
			print '<div class="rowlogin1">';
			print '<p><a href="'.url('user/password').'">Forgot password?</a></p>';
            print '</div>';
			print '<div class="rowlogin">';
			print '<p>Not a member yet? <a href="'.url('user/register').'"> Sign up</a></p>';
			print '</div>';
		
			/* print '<div class="rowlogin">';
               print drupal_render($form['name']);
			print '</div>';
			print '<div class="rowlogin">';
               print drupal_render($form['pass']);
			print '</div>';   
            print drupal_render($form['form_build_id']);
            print drupal_render($form['form_id']);
			print '<div class="rowlogin">';
			print '<p><a href="'.url('user/password').'">Forgot password?</a></p>';
            print drupal_render($form['actions']);
            print '</div>';  	 */		
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
<script type="text/javascript">
	jQuery.noConflict();
	
	jQuery("#user-login-form" ).validate({
		rules: {
			 name: {
				required: true,
				email: true
			 }
			
		}
	});
	

</script>