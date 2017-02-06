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

$servername = 'localhost';
$username = 'drupaluser';
$password = 'password';
$dbname = 'gloobers';
//Synchronize activity types with APITUDE
SyncAPI::synchronizeActivityTypes();
SyncAPI::synchronizeHotelTypes();
SyncAPI::synchronizeHotelFacilities();
SyncAPI::synchronizeHotelFacilityGroups();
SyncAPI::synchronizeHotelAccomodations();
SyncAPI::synchronizeHotelCategories();
SyncAPI::synchronizeHotelRoomTypes();
// Create connection
	$conn = new mysqli($servername, $username, $password,$dbname);
	if($conn->connect_error) {
		 die("Connection failed: " . $conn->connect_error);
		 $ConMag= "Errorr Con Fail";
	}else{
		$ConMag='Connection working';
	}	
	$Msg='My Cron is running';
	//(CURDATE() + INTERVAL 1 DAY) 
	$sql = "Select * from gbl_booking where arrive_at_date = CURDATE() and  booking_status='booked'";
	$result=$conn->query($sql);

	if($result->num_rows > 0){
		 while($row = $result->fetch_assoc()){
			
			$Traveller=user_load($row["uid"]);
			if(!empty($Traveller ->field_first_name['und'][0]['value'])){

				$Traveller_name =  $Traveller->field_first_name['und'][0]['value'];
			}else{
				$Traveller_name =  $Traveller->name;
			}
			$listingData=getOverviewData($row["lid"]);
			if(!empty($listingData['main_img_fid'])){
				$metalisitngFid=$listingData['main_img_fid'];
			}else{
				$photo = getPhotosData($row["lid"]);
				$photo = unserialize($photo[0]["value1"]);
				$metalisitngFid=$photo["fid"];
			}
			 $file = file_load($metalisitngFid);
			 //$style = "new-reservation";
			 $style="experience_slider_new_design";
			 $Img_uri = $file->uri;
			 if(file_exists($Img_uri)){
				$imgpath=image_style_url($style, $Img_uri);
				$Img_Name = $file->filename;
			}else{
				$imgpath=image_style_url($style, $Img_uri);
				$Img_Name = 'banner-listing_img.jpg';
			}	
			// Traveler image
			$Traveller_DpID=$Traveller->picture->fid;
			if($Traveller->picture != ""){
				$Traveller_file = file_load($Traveller_DpID);
				$Traveller_file_imgpath = $Traveller_file->uri;
				$Traveller_style = "new-reservation";
				$Traveller_DpImage_path=image_style_url($Traveller_style, $Traveller_file_imgpath);
				$Traveller_DpImage= '<img class="img-circle size-img" src="'.image_style_url($Traveller_style, $Traveller_file_imgpath). '" style="border-radius:100%;width:70px;height:70px">';
			}else{
				$Traveller_DpImage_path=base_path().drupal_get_path('theme', $GLOBALS['theme']). '/images/no-profile-male-img.jpg';
				$Traveller_DpImage=  '<img src="' . base_path().drupal_get_path('theme', $GLOBALS['theme']) . '/images/no-profile-male-img.jpg" class="img-circle size-img"  style="border-radius:100%;width:70px;height:70px"/>';
			}
			// end traveler image			
			if($row["advisor_id"] !=0){
				
				$Check_Credits = "Select * from gbl_credit_user where uid =".$row["advisor_id"];
				$Check_Credits_result=$conn->query($Check_Credits);
				$Credits_row = $Check_Credits_result->fetch_assoc();
				$booking_credits=$row['advisor_credits_assigned'];
				if($Check_Credits_result->num_rows > 0){
					
					$credits=($Credits_row['credits'] + $booking_credits);
					$credits_assign=($Credits_row['credits_assigned']-$booking_credits);
					$credits_earned=($Credits_row['credits_earned'] + $booking_credits);
					$Update_Credits = "update gbl_credit_user set credits='".$credits."',credits_assigned='".$credits_assign."',credits_earned='".$credits_earned."' where uid =".$row["advisor_id"];
					$Update_Credits_result=$conn->query($Update_Credits);
				}else{
					
					$credits=($Credits_row['credits'] + $booking_credits);
					$credits_assign=$booking_credits;
					$credits_earned=($Credits_row['credits_earned'] + $booking_credits);
					$insert_Credits = "INSERT INTO gbl_credit_user (uid,credits,credits_assigned,credits_earned) VALUES ('".$row["advisor_id"]."','".$credits."','".$credits_assign."','".$credits_earned."')";
					$insert_Credits_result=$conn->query($insert_Credits);
				}
				// Implement Confirm Booking To Advised by user.
				$adviceByUser=user_load($row["advisor_id"]);
				if(!empty($adviceByUser ->field_first_name['und'][0]['value'])){
					$adviceByUser_name =  $adviceByUser->field_first_name['und'][0]['value'];
				}else{
					$adviceByUser_name =  $adviceByUser->name;
				}
				$key ='confirm_recommendation';
				//$title = 'Hello '.$adviceByUser_name.',<br/>';
				$module = 'user';
				$to_email = $adviceByUser->mail;
				$subject = 'Recommendation confirmed';
				
				// 22/3/2016

				$body='<table align="center" width="650" border="0" cellspacing="0" cellpadding="0" style="Margin-left: auto;Margin-right: auto; border:5px solid #efefef; padding:10px">
				<tr>
				<td><center> <img src="http://gloobers.com/sites/all/themes/gloobers2/images/logo.png" alt="logo"> </center> </td>
				</tr>
				<tr>
				<td height="20"> </td>
				</tr>

				<tr>
				<td>


				<table align="center" width="400" border="0" cellspacing="0" cellpadding="0" style="Margin-left: auto;Margin-right: auto;">

				<tr>
				<td background="'.$imgpath.'"  bgcolor="#fff" width="434" height="294" valign="top" style="background-image:url('.$imgpath.') / cover; >
				<!--[if gte mso 9]>
				<v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="width:434px;height:294px;">
				<v:fill type="tile" src="'.$imgpath.'" color="#fff" />
				<v:textbox inset="0,0,0,0">
				<![endif]-->
				<div>

				<table width="400" border="0" cellspacing="0" cellpadding="0">

				<tr>
				<td height="20"></td>
				</tr>


				<tr>
				<td align="center"> <center> <img src="'.$Traveller_DpImage_path.'" width="150" height="150" alt="image" style="border-radius:50%;"/> </center> </td>
				</tr>
				<tr>
				<td height="20"></td>
				</tr>
				<tr align="center">
				<td style="font-size:24px; color:#fff; font-weight:bold; text-shadow:0px 3px 3px #000;"><center>'.$listingData['title'].'</center></td>
				</tr>

				<tr>
				<td style="color:#fff; font-weight:bold; text-shadow:0px 3px 3px #000;" align="center"><center>'.$listingData['state'].', '.$listingData['country'].'</center></td>
				</tr>
				</table>

				</div>
				<!--[if gte mso 9]>
				</v:textbox>
				</v:rect>
				<![endif]-->
				</td>
				</tr>

				</table>



				</td>
				</tr>



				<tr>
				<td height="20"> </td>
				</tr>
				<tr>
				<td ><center> <a href="'.$base_url.'/dashboard" style="color:#209cbe; font-weight:normal; text-decoration:none;font-size:15px;"> View in my dashboard</a> </center> </td>
				</tr>
				<tr>
				<td height="40"> </td>
				</tr>

				<tr>
				<td style="font-size:22px; color:#000; font-weight:normal; text-decoration:none;"><center> Confirmed recommendation ! </center> </td>
				</tr>
				<tr>
				<td height="20"> </td>
				</tr>


				<tr>
				<td style="font-size:14px; color:#000; font-weight:normal;"> Good news '.$adviceByUser_name.', </td>
				</tr>
				<tr>
				<td height="20"> </td>
				</tr>

				<tr>
				<td style="color:#000; font-weight:normal; line-height:22px;"> Your friend '.$Traveller_name.' executed his reservation '.$listingData['title'].'. Your account has been credited of '.$booking_credits.' gloobies that you can now use to book any listing within 2 years.  </td>
				</tr>
				<tr>
				<td height="20"> </td>
				</tr>
				<tr>
				<td style="color:#000; font-weight:normal; line-height:22px;"> You can see '.$Traveller_name.' review on this recommendation <a href="'.$base_url.'/addreview/'.$row["id"].'" style="color:#209cbe; font-weight:normal; text-decoration:none;"> here </a></td>
				</tr>
				</td>
				</tr>

				<tr>
				<td><p style="text-align:left; color: #000000;">Cheers,</p></td>
				</tr>

				<tr>
				<td><p style="text-align:left; color: #000000;">The Gloobers team</p></td>
				</tr>

				<tr>
				<td>
				<p style="text-align:left">
				<img src="http://gloobers.com/sites/all/themes/gloobers_new/images/signature.png" alt="Gloobers::Be friendly. Travel for free" title="Gloobers::Be friendly. Travel for free" />
				</p>
				</td>
				</tr>

				</td>
				</tr>

				</table>
				</table>';

				//end 22/3/2016

				sendNotificationEmail($module, $key, $to_email, $subject, $title, $body);
			}
			
			if(($row["ruid"]) && ($row["ruid"] != $row["uid"])){	
				
				$Check_Credits = "Select * from gbl_credit_user where uid =".$row["ruid"];
				$Check_Credits_result=$conn->query($Check_Credits);
				$Credits_row = $Check_Credits_result->fetch_assoc();
				$recommend_booking_credits=$row['ruid_credits_assign'];
				if($Check_Credits_result->num_rows > 0){
					$credits=($Credits_row['credits'] + $recommend_booking_credits);
					$credits_assign=($Credits_row['credits_assigned']-$recommend_booking_credits);
					$credits_earned=($Credits_row['credits_earned'] + $recommend_booking_credits);
					$recommend_Update_Credits = "update gbl_credit_user set credits='".$credits."',credits_assigned='".$credits_assign."',credits_earned='".$credits_earned."' where uid =".$row["ruid"];
					$recommend_Update_Credits_result=$conn->query($recommend_Update_Credits);
				}else{
					
					$credits=($Credits_row['credits'] + $recommend_booking_credits);
					$credits_assign=$recommend_booking_credits;
					$credits_earned=($Credits_row['credits_earned'] + $recommend_booking_credits);
					$recommend_insert_Credits = "INSERT INTO gbl_credit_user (uid,credits,credits_assigned,credits_earned) VALUES ('".$row["ruid"]."','".$credits."','".$credits_assign."','".$credits_earned."')";
					$recommend_insert_Credits_result=$conn->query($recommend_insert_Credits);
				}
				
				// Implement Confirm Booking To recommend by user.
			
				$receomendByUser=user_load($row["ruid"]);
				
				if(!empty($receomendByUser ->field_first_name['und'][0]['value'])){

					$receomendByUser_name =  $receomendByUser->field_first_name['und'][0]['value'].' '.$receomendByUser->field_last_name['und'][0]['value'];
				}else{
					$receomendByUser_name =  $receomendByUser->name;
				}
				$key ='confirm_recommendation';
				//$title = 'Hello '.$receomendByUser_name.',<br/>';
				$module = 'user';
				$to_email = $receomendByUser->mail;
				$subject = 'Recommendation confirmed';
	
				//22/3/2016

				$body='<table align="center" width="650" border="0" cellspacing="0" cellpadding="0" style="Margin-left: auto;Margin-right: auto; border:5px solid #efefef; padding:10px">
				<tr>
				<td><center> <img src="http://gloobers.com/sites/all/themes/gloobers2/images/logo.png" alt="logo"> </center> </td>
				</tr>
				<tr>
				<td height="20"> </td>
				</tr>

				<tr>
				<td>


				<table align="center" width="400" border="0" cellspacing="0" cellpadding="0" style="Margin-left: auto;Margin-right: auto;">

				<tr>
				<td background="'.$imgpath.'"  bgcolor="#fff" width="434" height="294" valign="top" style="background-image:url('.$imgpath.') / cover; >
				<!--[if gte mso 9]>
				<v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="width:434px;height:294px;">
				<v:fill type="tile" src='.$imgpath.'" color="#fff" />
				<v:textbox inset="0,0,0,0">
				<![endif]-->
				<div>

				<table width="400" border="0" cellspacing="0" cellpadding="0">

				<tr>
				<td height="20"></td>
				</tr>


				<tr>
				<td align="center"> <center> <img src="'.$Traveller_DpImage_path.'" width="150" height="150" alt="image" style="border-radius:50%;"/> </center> </td>
				</tr>
				<tr>
				<td height="20"></td>
				</tr>
				<tr align="center">
				<td style="font-size:24px; color:#fff; font-weight:bold; text-shadow:0px 3px 3px #000;"><center>'.$listingData['title'].'</center></td>
				</tr>

				<tr>
				<td style="color:#fff; font-weight:bold; text-shadow:0px 3px 3px #000;" align="center"><center>'.$listingData['state'].', '.$listingData['country'].'</center></td>
				</tr>
				</table>

				</div>
				<!--[if gte mso 9]>
				</v:textbox>
				</v:rect>
				<![endif]-->
				</td>
				</tr>

				</table>



				</td>
				</tr>



				<tr>
				<td height="20"> </td>
				</tr>
				<tr>
				<td ><center> <a href="'.$base_url.'/dashboard" style="color:#209cbe; font-weight:normal; text-decoration:none;font-size:15px;"> View in my dashboard</a> </center> </td>
				</tr>
				<tr>
				<td height="40"> </td>
				</tr>

				<tr>
				<td style="font-size:22px; color:#000; font-weight:normal; text-decoration:none;"><center> Confirmed recommendation ! </center> </td>
				</tr>
				<tr>
				<td height="20"> </td>
				</tr>


				<tr>
				<td style="font-size:14px; color:#000; font-weight:normal;"> Good news '.$receomendByUser_name.', </td>
				</tr>
				<tr>
				<td height="20"> </td>
				</tr>

				<tr>
				<td style="color:#000; font-weight:normal; line-height:22px;"> Your friend '.$Traveller_name.' executed his reservation '.$listingData['title'].'. Your account has been credited of '.$recommend_booking_credits.' gloobies that you can now use to book any listing within 2 years.  </td>
				</tr>
				<tr>
				<td height="20"> </td>
				</tr>
				<tr>
				<td style="color:#000; font-weight:normal; line-height:22px;"> You can see '.$Traveller_name.' review on this recommendation <a href="'.$base_url.'/addreview/'.$row["id"].'" style="color:#209cbe; font-weight:normal; text-decoration:none;"> here </a></td>
				</tr>
					 </td>
				</tr>

				<tr>
				<td><p style="text-align:left; color: #000000;">Cheers,</p></td>
				</tr>

				<tr>
				<td><p style="text-align:left; color: #000000;">The Gloobers team</p></td>
				</tr>

				<tr>
				<td>
				<p style="text-align:left">
				<img src="http://gloobers.com/sites/all/themes/gloobers_new/images/signature.png" alt="Gloobers::Be friendly. Travel for free" title="Gloobers::Be friendly. Travel for free" />
				</p>
				</td>
				</tr>

				</td>
				</tr>

				</table>
				</table>';
				//end 22/3/2016

				sendNotificationEmail($module, $key, $to_email, $subject, $title, $body);
			}
		}
	}
	
	
	//$ArriveAtTime=date("H:i", strtotime($booking_details['arrive_at_time']));
	//Upcoming Reminder Emails From Cron job.
	$Upcoming = "Select * from gbl_booking where arrive_at_date = (CURDATE()+INTERVAL 1 DAY) and  booking_status='booked' ";
	
	$result=$conn->query($Upcoming);
	$resultUpcoming=$conn->query($Upcoming);
	if($resultUpcoming->num_rows > 0){
		 while($row = $resultUpcoming->fetch_assoc()){
			
			$Traveller=user_load($row["uid"]);
			if(!empty($Traveller->field_first_name['und'][0]['value'])){

				$Traveller_name =  ucfirst($Traveller->field_first_name['und'][0]['value']).' '.ucfirst($Traveller->field_last_name['und'][0]['value']);
			}else{
				$Traveller_name =  ucfirst($Traveller->name);
			}
			$listingData=getOverviewData($row["lid"]);
			$Provider=user_load($listingData['uid']);
			if(!empty($Provider ->field_first_name['und'][0]['value'])){

				$Provider_name =  ucfirst($Provider->field_first_name['und'][0]['value']).' '.ucfirst($Provider->field_last_name['und'][0]['value']);
			}else{
				$Provider_name =  ucfirst($Provider->name);
			}
			$quantity_details=unserialize($row['quantity_details']);
			// Traveller data in string format
			$qtyC=1;
			$strQty='';
			foreach($quantity_details as $key=>$val){
				if(sizeof($quantity_details)==$qtyC){$Comma='';}else{$Comma=', ';}
				$strQty .= $val['qty'].' '.$key.$Comma;
				$qtyC++;
			}
			//End
			if(!empty($listingData['main_img_fid'])){
				$metalisitngFid=$listingData['main_img_fid'];
			}else{
				$photo = getPhotosData($row["lid"]);
				$photo = unserialize($photo[0]["value1"]);
				$metalisitngFid=$photo["fid"];
			}
			 $file = file_load($metalisitngFid);
			 $style = "new-reservation";
			 $Img_uri = $file->uri;
			 if (file_exists($Img_uri)){
				$imgpath=image_style_url($style, $Img_uri);
				$Img_Name = $file->filename;
			}else{
				$imgpath=image_style_url($style, $Img_uri);
				$Img_Name = 'banner-listing_img.jpg';
			}	
			// Traveler image
			$Traveller_DpID=$Traveller->picture->fid;
			if($Traveller->picture != ""){
				$Traveller_file = file_load($Traveller_DpID);
				$Traveller_file_imgpath = $Traveller_file->uri;
				$Traveller_style = "new-reservation";
				$Traveller_DpImage_path=image_style_url($Traveller_style, $Traveller_file_imgpath);
				$Traveller_DpImage= '<img class="img-circle size-img" src="'.image_style_url($Traveller_style, $Traveller_file_imgpath). '" style="border-radius:100%;width:70px;height:70px">';
			}else{
				$Traveller_DpImage_path=base_path().drupal_get_path('theme', $GLOBALS['theme']). '/images/no-profile-male-img.jpg';
				$Traveller_DpImage=  '<img src="' . base_path().drupal_get_path('theme', $GLOBALS['theme']) . '/images/no-profile-male-img.jpg" class="img-circle size-img"  style="border-radius:100%;width:70px;height:70px"/>';
			}
			// end traveler image
			
			
			// Provider image
			$Provider_DpID=$Provider->picture->fid;
			if($Provider->picture != ""){
				$Provider_file = file_load($Provider_DpID);
				$Provider_file_imgpath = $Provider_file->uri;
				$Provider_style = "new-reservation";
				$Provider_DpImage_path=image_style_url($Provider_style, $Provider_file_imgpath);
				$Provider_DpImage= '<img class="img-circle size-img" src="'.image_style_url($Provider_style, $Provider_file_imgpath). '" style="border-radius:100%;width:70px;height:70px">';
			}else{
				$Provider_DpImage_path=base_path().drupal_get_path('theme', $GLOBALS['theme']). '/images/no-profile-male-img.jpg';
				$Provider_DpImage=  '<img src="' . base_path().drupal_get_path('theme', $GLOBALS['theme']) . '/images/no-profile-male-img.jpg" class="img-circle size-img"  style="border-radius:100%;width:70px;height:70px"/>';
			}

			$query=db_select('gbl_user_passeport','gup');
			$query->fields('gup',array('location'));
			$query->condition('uid',$listingData['uid']);
			$query->condition('description','I live there');
			$result1=$query->execute();
			$Provider_location=$result1->fetchField();


			// end Provider image
			
			
			$ArriveAtDate = date("d/m/Y", strtotime($row['arrive_at_date']));
			$Arrive_After_One_day = date('d/m/Y', strtotime($row['arrive_at_date'] . ' +1 day'));
			//Upcoming Trips of user --->Email To Traveler
				$key ='upcoming_trip';
				$title = '';
				$module = 'user';
				$to_email = $Traveller->mail;
				//$to_email = 'testing.testing139@gmail.com';
				$subject = 'Your Upcoming Trip';
				
				
			$body='<table width="650" border="0" bordercolor="efefef" cellspacing="0" cellpadding="0" align="center" style=" border-collapse: collapse;table-layout: fixed;Margin-left: auto;Margin-right: auto;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;">

			<tr>
			<td>


			<table style="font-family: arial,sans-serif; font-size:14px;color:#000;line-height:24px;text-align:center;margin:auto;letter-spacing:0px;padding:1%;background:#fff;box-sizing:border-box;border-collapse:separate;max-width:650px;border:5px solid #efefef">
			<tr>
			<td align="center" valign="top"><img src="http://gloobers.com/sites/all/themes/gloobers2/images/logo.png" alt="Gloobers::Be friendly. Travel for free" title="Gloobers::Be friendly. Travel for free" width="300" /> </td>
			</tr>

			<tr>
			<td>
			<table width="378" align="center" cellspacing="0" cellpadding="0">

			<tr>
			<td background="'.$imgpath.'" bgcolor="#000000" align="center" style="padding:0px 0; background-position: center center;
			background-repeat: no-repeat; height: 179px;">
				<h3 style="color:#fff;font-weight:bold;text-shadow:3px 1px 2px #333;font-size:20px;margin:20px 0 0"> <center style="color:#fff;">'.$listingData['title'].' </center></h3>
				<p style="color:#fff;font-weight:400;text-shadow:1px 1px 1px #333;margin:0px 0 10px"> <center style="color:#fff;">'.$listingData['state'].', '.$listingData['country'].'</center></p>
			</td>			

			</table>
			</td>
			</tr>

			<tr>
			<td><a href="'.$base_url.'/mytrips" style="color:#139ABC;text-decoration:none;margin:10px 0 0;display:block" target="_blank"><center>View reservation details</center></a></td>
			</tr>

			<tr>
			<td><h3 style="font-size:18px;font-weight:600;margin:5px 0"><center style="font-size:18px; color:#000;">You have an upcoming trip !</center></h3></td>
			</tr>

			<tr>
			<td>
			<p style="text-align:left; color:#000;">Hi '.$Traveller_name.',<br />
			Just a little reminder that you have an upcoming trip at: '.$listingData['title'].' on '.$ArriveAtDate.'. This reservation is confirmed and paid.
			</p>

			<p style="text-align:left; color:#000;">You can view this reservation'."'s".' details in your <a href="'.$base_url.'/mytrips" style="color:#139ABC;text-decoration:none;" target="_blank">trips</a></p>

			<p style="text-align:left; color:#000;">  We encourage you to stay in touch with '.$Provider_name.' via email or phone and let him know about your arrival plans.  </p>
			</td>
			</tr><tr>
			<td><p style="text-align:left; color:#000;">Cheers,</p></td>
			</tr>

			<tr>
			<td><p style="text-align:left; color:#000;">The Gloobers team</p></td>
			</tr>

			<tr>
			<td>
			<p style="text-align:left">
			<img src="http://gloobers.com/sites/all/themes/gloobers_new/images/signature.png" alt="Gloobers::Be friendly. Travel for free" title="Gloobers::Be friendly. Travel for free" />
			</p>
			</td>
			</tr>
			</td>
			</tr>
			</table>
			</table>';					

			sendNotificationEmail($module, $key, $to_email, $subject, $title, $body);
			
			//Upcoming Reservarions of provider --->Email To Listing Owner
			//85% goes to listing owner//
			$amount_to_owner=round(($row['grand_total']*85)/100, 2);

			$key ='upcoming_reservation';
			$title = '';
			$module = 'user';
			$to_email = $Provider->mail;
			$subject = 'Your Upcoming Reservation';
			$body='<table width="650" border="0" bordercolor="efefef" cellspacing="0" cellpadding="0" align="center" style=" border-collapse: collapse;table-layout: fixed;Margin-left: auto;Margin-right: auto;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;">

			<tr>
			<td>


			<table style="font-family: arial,sans-serif; font-size:14px;color:#000;line-height:24px;text-align:center;margin:auto;letter-spacing:0px;padding:1%;background:#fff;box-sizing:border-box;border-collapse:separate;max-width:650px;border:5px solid #efefef">
			<tr>
			<td align="center" valign="top"><img src="http://gloobers.com/sites/all/themes/gloobers2/images/logo.png" alt="Gloobers::Be friendly. Travel for free" title="Gloobers::Be friendly. Travel for free" width="300" /> </td>
			</tr>

			<tr>
			<td>
			<table style="width:100%;box-sizing:border-box;border-collapse:collapse">

			<tr>
			<td bgcolor="#000000" background="'.$imgpath.'" style="width:40%;vertical-align:middle;padding:0;border:1px solid #aaa;">
			<h3 style="color:#fff;font-weight:400;text-shadow:3px 1px 2px #333;font-size:18px;margin:0"><center>'.$listingData['title'].'</center></h3>
			<p style="color:#fff;font-weight:400; text-align:center; font-size:13px; font-family:arial,sans-serif; text-shadow:1px 1px 1px #333;margin:0px 0 10px">'.$listingData['country'].'</p>
			</td>

			<td width="20%" align="center" valign="middle" style="padding:5px; border:1px solid #aaa; color:#000;">
			<img width="63" height="62" src="'.$Traveller_DpImage_path.'" alt="" title="" style="border-radius:50%;width:63px;height:62px;" />

			<p style="color:#000; text-align:center; font-family:arial,sans-serif; font-size:13px;"><strong>'.ucfirst($Traveller->field_first_name['und'][0]['value']).' '.ucfirst($Traveller->field_last_name['und'][0]['value']).'</strong><br />
			'.$Provider_location.'<br />
			<a href="mailto:'.($Traveller->mail).'" style="color:#139ABC; font-size:13px; text-decoration:none; font-family:arial,sans-serif;" target="_blank">'.($Traveller->mail).'</a></p>

			</td>

			<td style="width:20%;padding:5px;border:1px solid #aaa; color:#000;">
			<center><p style="color:#000;"><strong>Arrives on</strong><br />
			'.$ArriveAtDate.'<br />
			'.date("H:i", strtotime($row['arrive_at_time'])).'</p></center>
			</td>

			<td style="width:20%;padding:5px;border:1px solid #aaa;text-align:center; color:#000;">
			<p style="color:#000;"><strong>Travelers</strong><br />
			'.$strQty.'</p>
			</td>
			</tr>

			<tr>  
			<td colspan="2" style="padding:0">&nbsp;</td>
			<td style="border:1px solid #aaa;border-right:0;text-align:center;background:#ccc;padding:0; color:#000;">
			<p style="margin:5px 0; color:#000;">Net Amount</p>
			</td>
			<td style="border:1px solid #aaa;border-left:0;;background:#ccc;padding:0; color:#000;">
			<p style="font-size:16px;margin:5px 0; color:#000;"><strong>$'.$row['grand_total'].'</strong></p>
			</td>
			</tr>

			</table>
			</td>
			</tr>

			<tr>
			<td><a href="'.$base_url.'/bookings?booking_status=upcoming_reservation" style="color:#139ABC;text-decoration:none;margin:10px 0 0;display:block" target="_blank"><center>View reservation details</center></a></td>
			</tr>

			<tr>
			<td><h3 style="font-size:18px;font-weight:600;margin:5px 0"><center style="font-size:18px; color:#000;">You have an upcoming reservation !</center></h3></td>
			</tr>

			<tr>
			<td>
			<p style="text-align:left; color:#000;">Hi '.$Provider_name.',<br />
			Just a little reminder that you have an upcoming reservation for your listing '.$listingData['title'].'. This reservation is confirmed and paid, the net amount of : $'.$amount_to_owner.' will be issued to your account on '.$Arrive_After_One_day.'
			</p>

			<p style="text-align:left; color:#000;">You can view this reservation'."'s".' details in your <a href="'.$base_url.'/bookings?booking_status=upcoming_reservation" style="color:#139ABC;text-decoration:none;" target="_blank">upcoming reservations</a></p>

			<p style="text-align:left; color:#000;">  We encourage you to stay in touch with '.($Traveller_name).' via email or phone.  </p>
			</td>
			</tr><tr>
			<td><p style="text-align:left; color:#000;">Cheers,</p></td>
			</tr>

			<tr>
			<td><p style="text-align:left; color:#000;">The Gloobers team</p></td>
			</tr>

			<tr>
			<td>
			<p style="text-align:left">
			<img src="http://gloobers.com/sites/all/themes/gloobers_new/images/signature.png" alt="Gloobers::Be friendly. Travel for free" title="Gloobers::Be friendly. Travel for free" />
			</p>
			</td>
			</tr>
			</td>
			</tr>
			</table>
			</table>';

			  sendNotificationEmail($module, $key, $to_email, $subject, $title, $body);
			}
    }
	
	//add Review on Over trips
	$OverTrips = "Select * from gbl_booking where arrive_at_date = (CURDATE()-INTERVAL 1 DAY) and  booking_status='booked'";
	$result_OverTrips=$conn->query($OverTrips);
	if($result_OverTrips->num_rows > 0){
		while($row = $result_OverTrips->fetch_assoc()){	
		
			$Traveler=user_load($row['uid']);
			$listing_id=$row['lid'];
			$listingData=getOverviewData($listing_id);
			//Listing Photo Data
			if(!empty($listingData['main_img_fid'])){
				$metalisitngFid=$listingData['main_img_fid'];
			}else{
				$photo = getPhotosData($row["lid"]);
				$photo = unserialize($photo[0]["value1"]);
				$metalisitngFid=$photo["fid"];
			}
			$file = file_load($metalisitngFid);
			$style = "new-reservation";
			$Img_uri = $file->uri;
			if(file_exists($Img_uri)){
				$listingImgPath=image_style_url($style, $Img_uri);
				$Img_Name = $file->filename;
			}else{
				$listingImgPath=image_style_url($style, $Img_uri);
				$Img_Name = 'banner-listing_img.jpg';
			}	
			
			//End
			$Provider=user_load($listingData['uid']);
			
			if(!empty($Traveler->field_first_name['und'][0]['value'])){
				$Traveler_name =  $Traveler->field_first_name['und'][0]['value'];
			}else{
				$Traveler_name =  $Traveler->name;
			}
			if(!empty($Provider->field_first_name['und'][0]['value'])){
				$Provider_name =  $Provider->field_first_name['und'][0]['value'];
			}else{
				$Provider_name =  $Provider->name;
			}
			$key ='review_email';
			$title = '';
			$module = 'user';
			$to_email = $Traveler->mail;
			//$to_email = 'testing.testing139@gmail.com';
			$subject = 'Add Listing Review';


			$body='<table width="650" border="0" bordercolor="efefef" cellspacing="0" cellpadding="0" align="center" style=" border-collapse: collapse;table-layout: fixed;Margin-left: auto;Margin-right: auto;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;">

			<tr>
			<td>


			<table style="font-family: arial,sans-serif; font-size:14px;color:#000;line-height:24px;text-align:center;margin:auto;letter-spacing:0px;padding:1%;background:#fff;box-sizing:border-box;border-collapse:separate;max-width:650px;border:5px solid #efefef">
			<tr>
			<td align="center" valign="top"><img src="http://gloobers.com/sites/all/themes/gloobers2/images/logo.png" alt="Gloobers::Be friendly. Travel for free" title="Gloobers::Be friendly. Travel for free" width="300" /> </td>
			</tr>

			<tr>
			<td>
			<table width="378" align="center">

			<tr>
			<td style="font-family:arial,sans-serif; font-size:14px; color:#000; background-image:url('.$listingImgPath.'); background-repeat:no-repeat; background-color:#000; background-position:center;  padding:0px 0; text-align:center; height:179px;">

				<h3 style="color:#fff;font-weight:bold;font-family:arial,sans-serif; text-shadow:1px 1px 10px #000;font-size:20px;margin:20px auto 0;text-align:center;max-width:380px;">'.$listingData['title'].'</h3><p style="color:#fff;font-weight:400;text-shadow:1px 1px 1px #333;font-size:13px;margin:13px 0 10px;text-align:center"><strong>'.$listingData['state'].',&nbsp;'.$listingData['country'].'</strong></p>  

			</td>			
			</tr>			

			</table>
			</td>
			</tr>

			<tr>
			<td><a href="'.$base_url.'/addreview/'.$row['id'].'" style="color:#139ABC;text-decoration:none;margin:10px 0 0;display:block" target="_blank"><center>Leave a review</center></a></td>
			</tr>

			<tr>
			<td><h3 style="font-size:18px;font-weight:600;margin:5px 0"><center style="font-size:18px; color:#000;">How was it ?</center></h3></td>
			</tr>

			<tr>
			<td>
			<p style="text-align:left; color:#000;">Hi '.ucfirst($Traveler_name).',<br />
			We hope you enjoyed your time in '.$listingData['country'].'.</p>

			<p style="text-align:left; color:#000;">How was it? Leave a review to '.$listingData['title'].'. So that other tribe members can make their opinion on it.</p>

			<p style="text-align:left; color:#000;"><a href="'.$base_url.'/addreview/'.$row['id'].'" style="color:#139ABC;text-decoration:none;" target="_blank">  Click here to leave a review </a> </p>
			</td>
			</tr><tr>
			<td><p style="text-align:left; color:#000;">Cheers,</p></td>
			</tr>

			<tr>
			<td><p style="text-align:left; color:#000;">The Gloobers team</p></td>
			</tr>

			<tr>
			<td>
			<p style="text-align:left">
			<img src="http://gloobers.com/sites/all/themes/gloobers_new/images/signature.png" alt="Gloobers::Be friendly. Travel for free" title="Gloobers::Be friendly. Travel for free" />
			</p>
			</td>
			</tr>
			</td>
			</tr>
			</table>
			</table>';
			
			sendNotificationEmail($module, $key, $to_email, $subject, $title, $body);
		}
	}

if(!isset($_GET['cron_key']) || variable_get('cron_key', 'drupal') != $_GET['cron_key']){
  watchdog('cron', 'Cron could not run because an invalid key was used.', array(), WATCHDOG_NOTICE);
  drupal_access_denied();
}elseif(variable_get('maintenance_mode', 0)){
  watchdog('cron', 'Cron could not run because the site is in maintenance mode.', array(), WATCHDOG_NOTICE);
  drupal_access_denied();
}else{
  drupal_cron_run();
}