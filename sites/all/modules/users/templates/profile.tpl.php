<?php 
	global $user;
	$userr=$user;
	if(strpos($_SERVER['REQUEST_URI'],'/user') !== false){
	if(is_numeric(arg(1))){
		$uid = arg(1);
		$userr=user_load($uid);
	 }	
	}

	$output = drupal_get_form('user_profile_form', $userr);
	echo drupal_render($output);

?>