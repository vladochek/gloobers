<?php
menu_rebuild();

global $base_path, $user, $base_url;

$path = current_path();



$status = getUserDetails($user->uid);

$query=db_select('fboauth_users','fb');

		$query->fields('fb',array('uid','fbid'));

		$query->condition('uid',$user->uid);

		$result=$query->execute();

		$facebook_login=$result->fetchAssoc();

    $facebook_user_name = getUserDetails($facebook_login['uid']);

	$facebook_user_name=explode(' ',$facebook_user_name['name']);

	$facebook_user_name_first=$facebook_user_name[0];

 if(empty($facebook_login)){

	if(($status['confirm_status'] == 'no') && ($path != 'user/confirm')){

		drupal_goto('user/confirm');

	} 

}
if(($path != 'user/step5')){

drupal_add_js(drupal_get_path('theme', $GLOBALS['theme']) . '/js/autocomplete.js', array('scope' => 'footer'));

drupal_add_js(drupal_get_path('theme', $GLOBALS['theme']) . '/js/notify.js', array('scope' => 'footer'));

}

if((strpos($_SERVER['REQUEST_URI'],'/finder') !== false) || (strpos($_SERVER['REQUEST_URI'],'/profile/') !== false)  || (strpos($_SERVER['REQUEST_URI'],'/advice/request/') !== false)  || (strpos($_SERVER['REQUEST_URI'],'/advisor_listing_results') !== false)  ||($path == 'user_profile') || ($path == 'advice/request') || (strpos($_SERVER['REQUEST_URI'],'/add-listing') !== false) || (strpos($_SERVER['REQUEST_URI'],'/add_listing_to_guide/') !== false) || (strpos($_SERVER['REQUEST_URI'],'/search-destination/') !== false)){ 

drupal_add_js(drupal_get_path('theme', $GLOBALS['theme']) . '/js/notify-bootstrap.js', array('scope' => 'footer'));

}

$userDetails = user_load($user->uid);

$current_path = current_path();

$step=substr(arg(1),4);

define('BASE_CURRENCY_NAME', '$');

//$notifiationBadge = unread_notification(1);

$notifications = getNotifications();

$messagelist=getMessageList();

$senderDetail=user_load($messagelist['author']);

$messagecount = getNewMessageListCount();

//$notifiationStore = (json_decode($notifiationBadge));
//12april2016
$count_notification = getNotificationsCount();

?>

<link rel="stylesheet" type="text/css" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/fonts/stylesheet.css" />

<link rel="stylesheet" type="text/css" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/css/font-awesome.css" />



<script type="text/Javascript">

$baseUrl="<?php echo $base_url; ?>";

$globalThemeUrl = '<?php echo drupal_get_path('theme', $GLOBALS['theme']); ?>';

<?php if(($path != 'user/step5')){ ?>

jQuery.noConflict();	

jQuery(document).ready(function(){

	jQuery('#search-listings-form').validate({

			rules: {

				 keys: {

					required: true,



				 }

			}

	});

});

<?php } ?>

 </script>

<script type="text/jscript">

var $baseUrl ="<?php  echo $base_url; ?>";

</script>



<?php

 if( ($current_path == "terms-and-conditions") || ($current_path == 'privacy-policy') || ($current_path == "faqs")){ 

		drupal_add_css(drupal_get_path('theme', $GLOBALS['theme']) .'/css/landing_page.css','file');

		drupal_add_css(drupal_get_path('theme', $GLOBALS['theme']) .'/css/landing_custom.css','file');

		drupal_add_css(drupal_get_path('theme', $GLOBALS['theme']) .'/stylesheet/for-head-foot.css','file');

	 }



?>



<div id="page-wrapper">

    <div id="page">

        <!-- Page header -->

      <?php

    if(!$user->uid){



      //if(($current_path == "user/password") || (strpos($_SERVER['REQUEST_URI'],'/search-destination/') !== false) || ($current_path == "terms-and-conditions") || ($current_path == 'privacy-policy') || ($current_path == "faqs")){ ?>

        <header>

          <div class="container-fluid">

            <div class="row">

              <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6"><a href="<?php echo $base_url; ?>" class="logo"><img src="<?php echo $base_url.'/'.drupal_get_path('theme',$GLOBALS['theme']).'/images/sitelogo.png';?>" alt="image"></a></div>

              <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 pull-right">
			   <div class="sarch_page_nav">
			    <ul>
				 <li><a href="<?php echo $base_url.'/login'; ?>" >Log in</a></li>
				 <li><a href="<?php echo $base_url.'/register'; ?>" >Sign up</a></li>
				</ul>
			   </div>
			  </div>

            </div>

          </div>

        </header>

      

     <?php //}



    } 

		if($user->uid){

        if (($current_path == "login") || ($current_path == "register")) {

		

            ?>

            <header class="headlogo">

                <div class="logo">



                    <?php if ($logo): ?>

                        <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">

                            <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />

                        </a>

                    <?php endif; ?>

                </div>

            </header>

            <?php

        }else if(($current_path == "user/confirm") || ($current_path == "user/step2") || ($current_path == "user/step3")|| ($current_path == "user/step4")|| ($current_path == "user/step5")){

			



		?>

				<header>

					<div class="container-fluid">

						<div class="row">

							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6"><a href="<?php  echo $base_url; ?>" class="logo"><img src="<?php echo $base_url.'/'.drupal_get_path('theme',$GLOBALS['theme']).'/images/sitelogo.png';?>" alt="image"></a></div>

							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 pull-right"><!-- <p>Step <?php //if($current_path == "user/confirm"){ echo "1";}else{ echo $step; }?> on 5</p> --> 
              <?php if($current_path == "user/confirm"){ ?>

                <div class="sarch_page_nav">
                <ul>

                <li><a href="<?php echo  $base_url; ?>/user/logout">logout</a></li>
                </ul>
                </div>

                <?php }     ?>

             </div>

						</div>

					</div>

				</header>

		

		

		<?php }else{  ?>



<header>

          <div class="container-fluid">

          <div class="row">

          <div class="col-md-2 col-sm-2 col-xs-12"><a href="<?php echo $base_url; ?>" title="Home" rel="home" class="logo" id="logo"><img src="<?php print $GLOBALS['base_url'].'/'.drupal_get_path('theme',$GLOBALS['theme']);?>/images/sitelogo.png" alt="Home"></a></div>

          <div class="col-md-10 col-sm-10 col-xs-12">

          <nav class="navbar navbar-default navbar-static" id="navbar-example">

          <div class="navbar-header">

          <button data-target=".bs-example-js-navbar-collapse" data-toggle="collapse" type="button" class="navbar-toggle collapsed">

          <span class="sr-only">Toggle navigation</span>

          <span class="icon-bar"></span>

          <span class="icon-bar"></span>

          <span class="2&quot;icon-bar&quot;"></span>

          </button>

          </div>

          <div class="navbar-collapse bs-example-js-navbar-collapse collapse" aria-expanded="false" style="height: 1px;">

          <ul class="nav navbar-nav navbar-right">

          <li class="dropdown">

          <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#" id="drop4">

          <span class="icotext">Notifications</span>

          <i class="icoicon"><img src="<?php print $GLOBALS['base_url'].'/'.drupal_get_path('theme',$GLOBALS['theme']);?>/images/icon_bell.png" alt="Notification" title="" /></i>

          
           <div class="notification_block">
          <?php if (!empty($count_notification)){ ?>

            <span class="count" id="_my_notifications_badge2">

              <?php  echo $count_notification; ?>

           </span>

          <?php } 

          ?>
          </div>

          

          </a>

          <ul aria-labelledby="drop4" class="dropdown-menu">

          <div class="nav-dropdown-heading">Notifications<?php //if (!empty($count_notification)){ 

                                                                            echo "(".$count_notification.")";

                                                                        //} 

                                                                      ?>

                                                            </div>

          <div class="nav-dropdown-content">

            <ul id="noti_ajax_data">   

              <?php  if (!empty($notifications)){

                foreach ($notifications as  $value) {  ?>

              <li class="unread">

                <?php if($value['post_type']=='recommend listing') { ?>

                <a href="<?php echo $base_url.'/'.$value['noti_url']; ?>">

                <?php } else if($value['post_type']=='declined request') { ?>    

                <a href="<?php echo $base_url.'/'.$value['noti_url']; ?>">

                <?php } else if($value['post_type']=='requests received') { ?>  
                                                                       
                <a href="<?php  echo $base_url.'/'.$value['noti_url'].'/'.base64_encode('gloobe__'.$value['sender_id']).'/'.base64_encode($value['recipient_id'])?>"> 
                <?php }else { ?>

                <a href="<?php echo $base_url.'/advice/notification'; ?>">

                <?php  } ?> 

                <?php 

                  $notificationDetail = user_load($value['sender_id']);

                  if ($notificationDetail->picture != "") {

                  $file = file_load($notificationDetail->picture->fid);

                  $imgpath = $file->uri;

                  $style = "homepage_header";

                  print '<img class="absolute-left-content img-circle size-img" src="' . image_style_url($style, $imgpath) . '" alt="display pic">';

                  }else{

                  print '<img src="' . base_path() . drupal_get_path('theme', $GLOBALS['theme']) . '/images/no-profile-male-img.jpg" class="absolute-left-content img-circle size-img" alt="display pic" />';

                  } 

              ?>

            <strong><?php print $notificationDetail->field_first_name['und'][0]['value'].'  ';?></strong>

            <?php echo $value['noti_msg']; ?>

            <?php  $notify_time = $value['notification_time']; ?>

            <span class="small-caps"><?php echo humanTiming($notify_time).' ago';  ?></span>

            </a>

            </li>

          <?php }

          } 

          else

            { ?>

        <li> -- No  Notification -- </li> 

        <?php } ?>       

      </div>
 <?php  if (!empty($notifications)){ ?>
      <li><a href="<?php echo $base_url; ?>/advice/notification" class="notifications_btn">See all notifications</a></li>
<?php } ?>
    </ul>

</li>

<li class="dropdown" id="fat-menu">

<a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#" id="drop3">

<div class="user_name">

<?php 

if(strlen($userDetails->field_first_name['und'][0]['value']) > 10){

$dots = '..';

}

else{

$dots = '';

}

$name = substr($userDetails->field_first_name['und'][0]['value'],0,10).$dots;  

echo (trim($name, "%20"))?(trim($name, "%20")):$facebook_user_name_first;

?>  

</div>

<?php 

if ($userDetails->picture != "") {

$file = file_load($userDetails->picture->fid);

$imgpath = $file->uri;

$style = "homepage_header";

print '<img class="img-circle size-img" src="' . image_style_url($style, $imgpath) . '">';

} else {

print '<img src="' . base_path() . drupal_get_path('theme', $GLOBALS['theme']) . '/images/no-profile-male-img.jpg" class="img-circle size-img" />';

}

?>

<span class="caret"></span>

</a>

 <ul aria-labelledby="drop3" class="dropdown-menu">

                                            <li><a tabindex="0" role="button" href="<?php echo $base_url; ?>/dashboard"><i class="fa fa-tachometer"></i>Dashboard</a></li>

                                            <li><a tabindex="0" role="button" href="<?php echo $base_url; ?>/manage/listing"><i class="fa fa-list-alt"></i>Listings</a></li>

                                            <li><a tabindex="0" role="button" href="<?php echo $base_url; ?>/mytrips"><i class="fa fa-plane"></i>Trips</a></li>

                                            <li>
											<!--<a tabindex="0" role="button" href="<?php //echo $base_url; ?>/advice/request"><i class="fa fa-calendar"></i>Recommendations</a>-->
											<a tabindex="0" role="button" href="<?php echo $base_url; ?>/advice/my_request"><i class="fa fa-calendar"></i>Recommendation
											</a>
											</li>

                                            <li><a tabindex="0" role="button" href="<?php echo $base_url; ?>/user_profile"><i class="fa fa-user"></i>Profile</a></li>

                                            <li><a tabindex="0" role="button" href="<?php echo $base_url; ?>/user/account_settings"><i class="fa fa-user"></i>Account</a></li>

                                            <li class="divider"></li>

                                            <li><a tabindex="0" role="button" href="<?php echo $base_url; ?>/user/logout"><i class="fa fa-sign-out"></i>Logout</a></li>

                                        </ul>

</li>

</ul>

</div> <!-- nav-collapse -->

</nav>

</div>

</div>

</div> <!-- End Container-Fluid -->

</header>

             

 <?php if(($path == 'user_profile') ||($path == 'advice/my_request') || (strpos($_SERVER['REQUEST_URI'],'/advice/request/') !== false) ||($path == 'dashboard') ||($path == 'advice/validate_recommendation') || ($path == 'advice/request') ||($path == 'advice/create_travel_guide') ||($path == 'advice/travel_guide') ||($path == 'create_guide') ||($path == 'advice/my_request') ||($path == 'user/account_settings') || ($path == 'user/payout_preference') || ($path == 'user/transaction_history') || ($path == 'transactions/history') ){ 

?>

<div class="main_menu">

        <div class="container-fluid padding_left paddng_right">

            <div class="col-lg-12 no_paddng">

                <div class="nav_main_menu">

                    <a class="showhide pull-right">MENU <i class="fa fa-bars"></i></a>

                    <ul class="dropdwonmenu_remove"> 

                    <li><a class="<?php

                            if (strpos($_SERVER['REQUEST_URI'], '/dashboard') !== false) {

                                echo $class_select_menu = 'select_menus';

                            } else {

                                echo $class_select_menu = '';

                            }

                            ?>" href="<?php echo $base_url; ?>/dashboard"> Dashboard </a>

                    </li>

                    <li><a class="<?php

                        if ((strpos($_SERVER['REQUEST_URI'], '/product/add/overview') !== false) || (strpos($_SERVER['REQUEST_URI'], '/manage/listing') !== false)) {

                            echo $class_select_menu = 'select_menus';

                        } else {

                            echo $class_select_menu = '';

                        }

                            ?>" href="<?php echo $base_url; ?>/manage/listing"> Listings  <div class="togelsubmenu pull-right"><i class="fa fa-bars"></i></div> </a>

                           <!--  <ul class="dropdwonmenu_remove1">

                                <li><a href="<?php //echo $base_url; ?>/product/add/overview"> Create Listing </a></li>

                                <li><a href="<?php //echo $base_url; ?>/manage/listing"> Manage Listing</a></li>

                            </ul> -->

                    </li>

                    <li><a class="<?php

                               if (strpos($_SERVER['REQUEST_URI'], '/mytrips') !== false) {

                                   echo $class_select_menu = 'select_menus';

                               } else {

                                   echo $class_select_menu = '';

                               }

                               ?>" href="<?php echo $base_url; ?>/mytrips"> Trips</a>

                    </li>

                    <li><a href="<?php echo $base_url; ?>/advice/request"> Recommendation <div class="togelsubmenu pull-right"><i class="fa fa-bars"></i></div> </a>



                            <ul class="dropdwonmenu_remove1">

                                <li><a href="<?php echo $base_url; ?>/advice/my_request"> My Request </a></li>

                                <li><a href="<?php echo $base_url; ?>/advice/request"> Request Received </a></li>

                                <!--li><a href="<?php //echo $base_url; ?>/advice/create-travel-guide"> Create Travel Guide </a></li>
                                <li><a href="<?php //echo $base_url; ?>/advice/travel_guide"> View Travel Guide </a></li-->

                            </ul>

                    </li>

                    <li><a class="<?php

                           if (strpos($_SERVER['REQUEST_URI'], '/user_profile') !== false) {

                               echo $class_select_menu = 'select_menus';

                           } else {

                               echo $class_select_menu = '';

                           }

                           ?>" href="<?php echo $base_url; ?>/user_profile">  Profile  </a>

                    </li>

                    <li><a class="<?php

                        if (strpos($_SERVER['REQUEST_URI'], '/user/account_settings') !== false) {

                            echo $class_select_menu = 'select_menus';

                        } else {

                        echo $class_select_menu = '';

                        }

                        ?>" href="<?php echo $base_url; ?>/user/account_settings"> Account  </a>

                    </li>

                    

                    </ul>

                </div> 



            </div>

        </div>

    </div>



 

<?php } ?>

<?php  } 		

	  }

	//}

?>

        <!------------------------------------------------------------------------------------------------>

        <!-- <div id="header">

           <div class="section clearfix">

        <?php if ($logo): ?>

            <?php print render($page['logo']) ?>

        <?php endif; ?>

     

        <?php if ($site_name || $site_slogan): ?>

                     <div id="name-and-slogan">

            <?php if ($site_name): ?>

                <?php print render($page['site_name']); ?>

            <?php endif; ?>

                                         

            <?php if ($site_slogan): ?>

                                    <div id="site-slogan"><?php print $site_slogan; ?></div>

            <?php endif; ?>

                                                   </div>

        <?php endif; ?>

     

        <?php //print render($page['header']); ?>

           </div>

         </div>-->





        <!--<?php if ($main_menu || $secondary_menu): ?>

                                              <div id="navigation">

                                                <div class="section">

            <?php print render($page['main_menu']); ?>

            <?php print render($page['secondary_menu']); ?>

                                                </div>

                                              </div>

        <?php endif; ?>

    

        <?php if ($breadcrumb): ?>

                                              <div id="breadcrumb">

            <?php print $breadcrumb; ?>

                                              </div>

        <?php endif; ?>-->







        <div id="main-wrapper">

            <div id="main" class="clearfix">

				<div id="content" class="column">

                    <div class="section">



                        <a id="main-content"></a>



                        <?php print render($title_prefix); ?>

                        <?php if ($title): ?>

                            <h1 class="title" id="page-title"><?php print $title; ?></h1>

                        <?php endif; ?>

                        <?php print render($title_suffix); ?>



                        <?php if ($tabs): ?>

                            <div class="tabs">

                                <?php print render($tabs); ?>

                            </div>

                        <?php endif; ?>



                        <?php /* print render($page['help']); */ ?>



                        <?php if ($action_links): ?>

                            <ul class="action-links">

                                <?php print render($action_links); ?>

                            </ul>

                        <?php endif; ?>

                        <?php //print $messages; ?>

						

                        <div class="">  

							<?php if ($messages): ?>

							<div id="messages"><div class="section clearfix">

							  <?php print $messages; ?>

							</div></div> <!-- /.section, /#messages -->

						   <?php endif; ?>

                            <?php print render($page['content']); ?>

                        </div>

                        <?php print $feed_icons; ?>

                    </div>

                </div>

				</div>

        </div>

        <?php 

       // if(strpos($_SERVER['REQUEST_URI'],'/Gloobers/') !== false){

       //  print render($page['footer']);

       // }





		if(($path == 'user_profile')  || (strpos($_SERVER['REQUEST_URI'],'/Gloobers/') !== false)  || ($path == 'dashboard') ||($path == 'advice/create-travel-guide') || ($path == 'user/transaction_history') || ($path == 'user/account_settings') || ($path == 'user/payout_preference') || ($path == 'advice/notification')||($path == 'advice/travel_guide')||($path == 'hotel_booking/success') || ($path == 'advice/request') ||($path == 'advice/my_request' ) ||($path == 'advice/create_travel_guide') ||($path == 'privacy-policy') || ($path == 'terms-and-conditions')|| ($path == 'user/account_settings') || (strpos($_SERVER['REQUEST_URI'],'/travel_guide/profile/') !== false) || (strpos($_SERVER['REQUEST_URI'],'/search-listing/advisors/') !== false)  || (strpos($_SERVER['REQUEST_URI'],'experience') !== false) || (strpos($_SERVER['REQUEST_URI'],'advice/validate_recommendation') !== false) ||($path == 'finder') ||($path == 'faqs') || (strpos($_SERVER['REQUEST_URI'],'search-hotel/India'))||(strpos($_SERVER['REQUEST_URI'],'booking/hotel/summary'))||(strpos($_SERVER['REQUEST_URI'],'Hotels/'))||(strpos($_SERVER['REQUEST_URI'],'search-hotel'))||(strpos($_SERVER['REQUEST_URI'],'hotel_booking')) || (strpos($_SERVER['REQUEST_URI'],'/profile/') !== false) || (strpos($_SERVER['REQUEST_URI'],'/user/password') !== false)){

			if($page['footer']){

				print render($page['footer']);

			}

		}

          //if(($path !='user/confirm') && ($path !='user/step0') && ($path !='login') && ($path !='register') && ($path !='user/step1') && ($path !='user/step2') && ($path !='user/step3') && ($path !='user/step4') && (strpos($_SERVER['REQUEST_URI'],'search-destination') === true)){	   

           // if($page['footer'])

             // {

             // print render($page['footer']);

             // }

          //} 

        ?>

        <!---------------------------------------------------------------------------------------------->



    </div>

</div>



<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/js/jquery.nicescroll.min.js"></script>

   

  <script type="text/javascript">

   

	jQuery(document).ready(function () {

		jQuery("html").niceScroll();

	});

	

	function readnotifications(recipient_id){

            jQuery.ajax({

        

             url:'<?php echo $base_url; ?>/advice/readnotifications',

             type:'post',

             data:{'recipientid':recipient_id ,'isAjax':1},

             success: function(result){

                window.location.href='<?php echo $base_url;?>/advice/notification';

             }



         });

   }

</script><script type="text/jscript">

jQuery(".checkbox_cus").click(function(){

    jQuery(this).toggleClass('checked');

	jQuery('.form-checkbox').toggleClass('checked');



});

</script>

<?php 



if(($path != 'user_profile') && ($path != 'user/step3')){



 ?>

<script type="text/jscript">

  //on change of gloobers search box

    jQuery(document).on('keypress','#_trip_loction',function(event){



        if ( event.which == 13 ) {

            var search = (jQuery('#_trip_loction').val()).trim();

            if(search.length<=0){

                return false;

            }

            setTimeout(function(){

                var href = $baseUrl+'/search-destination/'+search;

                window.location.href = href;

            });

        }

        

    });

    

  //on change of gloobers search box

    jQuery(document).on('click','.my-custom-search',function(){

      var search = (jQuery('#_trip_loction').val()).trim();

      //alert(search);

     if(search.length<=0){

            return false;

        }

        

        setTimeout(function(){

            var href = $baseUrl+'/search-destination/'+search;

            window.location.href = href;

        });

    

    });
	
	jQuery(document).keydown(function(e) {
		console.log(e.keyCode);
    
    if (e.keyCode == 27) {
       jQuery( ".cancelbtn" ).trigger( "click" );
    }
});

</script>

<?php  }?>