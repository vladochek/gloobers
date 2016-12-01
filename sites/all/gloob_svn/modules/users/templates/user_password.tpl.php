<div class="login-wrapper">
	<div class="panel-heading">
		<div class="panel-title"> <i class="fa fa-lock"></i> Forgot Password </div>
	</div>
	<div class="panel-body">
		<?php 
			module_load_include('inc', 'user', 'user.pages');
			$form =  drupal_get_form('user_pass');
			print drupal_render($form);
		?>
	</div>
</div>
<script>
	jQuery(document).ready(function () {
	jQuery("#edit-name").attr('placeholder','Enter Your Username');
	jQuery("#edit-pass").attr('placeholder','Enter Your Password');
	});
</script>