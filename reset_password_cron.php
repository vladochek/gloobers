<?php
/**
 * @file
 * Handles incoming requests to fire off regularly-scheduled tasks (cron jobs).
 */

/**
 * Root directory of Drupal installation.
 */
define('DRUPAL_ROOT', getcwd());

include_once DRUPAL_ROOT . '/includes/bootstrap.inc';
// Load Drupal
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
global $user, $base_url;
$fh  = fopen('funky.txt','a');
$servername = 'localhost';
$username = 'gloobers_rudy';
$password = 'JJp~L_c$d5T=';
$dbname = 'gloobers_staging22';
// Create connection
	$conn = new mysqli($servername, $username, $password,$dbname);

	if($conn->connect_error) {
		 die("Connection failed: " . $conn->connect_error);
		 $ConMag= "Errorr Con Fail";
	}else{
		$ConMag='Connection working';
	}
	$sql = "Select * from gbl_reset_password_link";
	//fwrite($fh,$sql);exit;
	$result=$conn->query($sql);
	if($result->num_rows > 0){
		 while($row = $result->fetch_assoc()){
			$currentTime=date('y-m-d H:i:s');
			$ts1 = strtotime($currentTime);
			$ts2 = strtotime($row['created']);
			$diff = abs($ts1 - $ts2) / 3600;
			if($diff>24){
				$sqlDel = "delete from gbl_reset_password_link where rpid=".$row['rpid'];
				$resultDel=$conn->query($sqlDel);
			}
		}
	}
	
	
	//Expire traveler location request after 24 hours.
	$sql_req = "Select * from gbl_advisor_request";
	$result_req=$conn->query($sql_req);
	$currentTime=date('y-m-d H:i:s');
	$Current = strtotime($currentTime);
	if($result_req->num_rows > 0){
		 while($row = $result_req->fetch_assoc()){
			$requestId=$row['rid'];
			$request_time=$row['created'];
			$sql_relist = "Select * from gbl_advise_listing where request_id=".$requestId;
			$result_relist=$conn->query($sql_relist);
			if($result_relist->num_rows == 0){
				/*
				get diffrent times between two dates.
				$Diffrence_time = abs($Current - $request_time);
				$years = floor($diff / (365*60*60*24));
				$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
				$days = floor(($diff - ($years * 365*60*60*24) - ($months*30*60*60*24))/ (60*60*24)); */
				
				$Diffrence_time = abs($Current - $request_time)/3600;
				if($Diffrence_time>24){
					$sqlDel_r = "delete from gbl_advisor_request where rid=".$requestId;
					$resultDel_r=$conn->query($sqlDel_r);
				
					$sqlDel_Lr = "delete from gbl_advice_location_request where rid=".$requestId;
					$resultDel_Lr=$conn->query($sqlDel_Lr);
				}		
			}
		}
	}
	
	
	if (!isset($_GET['cron_key']) || variable_get('cron_key', 'drupal') != $_GET['cron_key']) {
	  watchdog('cron', 'Cron could not run because an invalid key was used.', array(), WATCHDOG_NOTICE);
	  drupal_access_denied();
	}
	elseif (variable_get('maintenance_mode', 0)) {
	  watchdog('cron', 'Cron could not run because the site is in maintenance mode.', array(), WATCHDOG_NOTICE);
	  drupal_access_denied();
	}
	else {
	  drupal_cron_run();
	}
