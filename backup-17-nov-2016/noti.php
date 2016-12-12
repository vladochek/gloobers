<?php 
    header('Content-Type: text/event-stream');
	header('Cache-Control: no-cache');
	
	//define('DRUPAL_ROOT', $_SERVER['DOCUMENT_ROOT']."");
	chdir($_SERVER['DOCUMENT_ROOT']."/gloob");
	define('DRUPAL_ROOT', getcwd());
    //Load Drupal
	
     require_once './includes/bootstrap.inc';	
	//require_once $_SERVER['DOCUMENT_ROOT'].'./includes/bootstrap.inc';
	
	drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
	
	$userId = 0;
	global $base_url,$user;
	
	/***************************************************************/
	if(isset($_GET['uid'])){
		$userId = $_GET['uid'];
	}
	/* if(isset($_POST["action"]) && $_POST["action"] == "make_read_all"){
		$num_updated = db_update('lew_idea_notifications')
		  ->fields(array(
			'read_status' => 1
		  ))
		  ->condition('notification_to',$_POST["uid"])
		  ->condition('read_status',0)
		  ->execute();	
	}
	elseif(isset($_POST["action"]) && $_POST["action"] == "make_read"){
		$num_updated = db_update('lew_idea_notifications')
		  ->fields(array(
			'read_status' => 1
		  ))
		  ->condition('id',$_POST["notId"])
		  ->execute();		
	} */
	/***************************************************************/
	/*********** get notifications count *******************/

	$query=db_select('gbl_notifications','gn');
	$query->fields('gn')
			->condition('recipient_id',isset($_POST["uid"])?$_POST["uid"]:$userId)
			->condition('read_status',0);			 
	$result = $query->execute();
	$count = $result->rowCount();
	/********************************************************/
	$query=db_select('gbl_notifications','gn');
	$query->fields('gn')
			->condition('recipient_id',isset($_POST["uid"])?$_POST["uid"]:$userId)
			->orderBy('nid','DESC')
			->range(0,4);
	$result = $query->execute();
	$string = "";
	$href="";
	//$string .='<li><span>Notifications('.$count.')</span><label class="mark_as_read make_read_all">Mark as read</label></li>';
	while($record = $result->fetchAssoc()) {
	
		if($record["read_status"] == 0){
			$class="unread";
			}
		else{
			$class="read";
		}
	$userInfo=user_load($record['sender_id']);
	$url ="#";
	
		 if(!empty($userInfo->picture)){		
		 $file = file_load($userInfo->picture->fid);
		 $imgpath = $file->uri;
		 $style="homepage_header";
		 $imgurl=image_style_url($style,$imgpath);
		 $string .= '<li class='.$class.'><img src="'.$imgurl.'" alt=" " /><a class="make_read" href="'.$url.'">'.$record["noti_msg"].'<input type="hidden" value="'.$record["nid"].'"></a></li>';
		 } 
		 else{				
			$src = $base_url.drupal_get_path('theme', 'gloobers')."/images/no-profile-male-img.jpg";
		  $string .= '<li class='.$class.'><img src="'.$src.'" alt=" " /><a class="make_read" href="'.$url.'">'.$record["noti_msg"].'<input type="hidden" value="'.$record["nid"].'"></a></li>';
		}
      $href="#";	
	}
		$string .= '<li><a href="'.$href.'" class="see_all">See All</a></li>';
	/********************************************************/
	$query=db_select('gbl_notifications','uc');
	$query->fields('uc')
			->orderBy('nid','DESC')
			 ->range(0,1);
	$result = $query->execute();
	$data=$result->fetchAssoc();
	
	if(time() < ($data['notification_time']+30)){
		echo "data: ".$string."~".$count."\n\n";	
		
	}
	 if(isset($_POST["action"]) && $_POST["action"] == "make_read_all"){

		echo $string."~".$count;
	} 
	flush();
?> 
	
	