<?php 
	global $user;
	module_load_include('pages.inc', 'user', 'user');	
	$output = drupal_get_form('user_profile_form', $user);
	//echo "<pre>";Print_r($output);exit;
	echo drupal_render($output);
?>