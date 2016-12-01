<?php 
	global $user;

	$output = drupal_get_form('user_profile_form', $user);
	echo drupal_render($output);

?>