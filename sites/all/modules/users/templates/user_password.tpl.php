<?php 
global $user,$base_url; 
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/bootstrap.min.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/landing_page.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/fonts/stylesheet.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/landing_custom.css','file');
drupal_add_js(drupal_get_path('theme', 'gloobers_new') .'/js/jquery.min.js','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/stylesheet/for-head-foot.css','file');
?>
 
<section class="steps">
<div class="container">
	<article>
		<h1><?php echo ($user_pass_form)? 'Change your Password' : 'Reset password link is expired'; ?></h1>
		<!-- <p>Reset your Password</p> -->
	</article>

<div class="row">
	<div class="search_place">

		<div class="row">
			<?php 
			//module_load_include('inc', 'user', 'user.pages');
			//$form =  drupal_get_form('user_pass_form');
			print drupal_render($user_pass_form);
			?>
 		</div>  
	</div>
</div>
</div>
</section>
<script>
	jQuery(document).ready(function () {
	jQuery("#edit-name").attr('placeholder','Enter Your Username or Email');
	jQuery("#edit-pass").attr('placeholder','Enter Your Password');
	});
</script>