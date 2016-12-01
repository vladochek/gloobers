<?php
global $base_url, $base_path, $user;
$userDetails = user_load($user->uid);
$notifiationStore = (json_decode($notifiationBadge));
$notifications = getNotifications();
//echo "<pre>";print_r($footer_first);exit;
$count_notification = count($notifications);

?>
<link href="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/stylesheet/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!--Fonts Css Here-->
<link rel="stylesheet" href="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/fonts/stylesheet.css">
<link rel="stylesheet" href="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/stylesheet/style.css">
<!--Fonts Css Here-->
<link rel="stylesheet" href="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/stylesheet/font-awesome.css">
<link rel="stylesheet" href="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/stylesheet/pop_up.css">
<script type="text/jscript">
    var $baseUrl ="<?php echo $base_url; ?>";
</script>
<?php
$status = getUserDetails($user->uid);
$query2=db_select('fboauth_users','fb');
        $query2->fields('fb',array('uid','fbid'));
        $query2->condition('uid',$user->uid);
        $result=$query2->execute();
        $facebook_login=$result->fetchAssoc();
        $facebook_user_name = getUserDetails($facebook_login['uid']);
		
		$facebook_user_name=explode(' ',$facebook_user_name['name']);
		//echo "<pre>";Print_r($facebook_user_name);exit;
		$facebook_user_name_first=$facebook_user_name[0];
		$facebook_user_name_last=$facebook_user_name[1];
		//echo $facebook_user_name_first;exit;
if(empty($facebook_login)){
    if(($status['confirm_status'] == 'no') && ($path != 'user/confirm')){
        drupal_goto('user/confirm');
    } 
}else{
//echo "<pre>";Print_r($facebook_login);exit;
	$queryfb_exists = db_select("users",'fu')->fields('fu',array('fbstatus'))->condition('uid',$facebook_login['uid']);
	$resultfb_exist = $queryfb_exists->execute();
	$resultfb_exists_count = $resultfb_exist->fetchAssoc();
	if($resultfb_exists_count['fbstatus']==''){
		$updateFb = db_update("users")->fields(array('fbstatus'=>1))->condition('uid',$facebook_login['uid']);
		$updateFbStatus = $updateFb->execute();
		$facebook_loginId=$facebook_login['uid'];
		$updateFirstLatnameFb=updatefirstLastnameFb($facebook_user_name_first,$facebook_user_name_last,$facebook_loginId);
		
		drupal_goto('user/step2');
	}else{
		$facebook_loginId=$facebook_login['uid'];
		$updateFirstLatnameFb=updatefirstLastnameFb($facebook_user_name_first,$facebook_user_name_last,$facebook_loginId);
	}
}
if (!$user->uid) {
    $user_login_form = drupal_get_form('user_login_block');
    $attribute = array('class' => 'test');
    $arr = array_merge($user_login_form['#submit'], $attribute);
    $register_form = drupal_get_form('user_register_form');
}
define('BASE_CURRENCY_NAME', '$');
$link = fboauth_action_link_properties('connect');
$string = "";
foreach ($link['query'] as $key => $value) {
    $string .=$key . "=" . $value;
    $string .="&";
}
$n = strlen($string);
$query = substr($string, 0, ($n - 1));

?> 
<div id="wraper" class="container-fluid">
    <div class="row">
        <div class="indexhome">
            <div class="main_head">
<?php if (!$user->uid) { ?>
                    <div class="loginheader">
                        <div class="col-md-9 col-sm-6 col-xs-12">
                            <div class="logo"><a href="<?php echo $base_url; ?>"><img src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/images/logo.png" alt="" title="" /></a>	</div> <!-- End Logo -->
                        </div> <!-- End Col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <nav role="navigation">
                                <div class="navbar-header">
                                    <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div> <!-- End Navbar-Header -->

                                <div id="navbarCollapse" class="collapse navbar-collapse login_bar">
                                    <ul class="nav navbar-nav">
                                        <li><a class="initialism basic_open">Log in</a></li>
                                        <li><a class="initialism slide_open">Sign up</a></li>
                                    </ul>
                                </div> <!-- End Login_bar -->

                            </nav>
                        </div> <!-- End Col -->
                    </div> <!-- End LoginHeader -->
<?php } else { ?>
                    <header>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-2 col-sm-2 col-xs-12"><a href="<?php echo $base_url; ?>" title="Home" rel="home" class="logo" id="logo"><img src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/images/logo.png" alt="Home"></a></div>

                                <div class="col-md-10 col-sm-10">
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
                                                        <i class="icoicon"><img src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/images/icon_bell.png" alt="Notification" title="" /></i>
                                                        <div class="notification_block">
                                                          <?php if (!empty($count_notification)){ ?>
                                                            <span class="count" id="_my_notifications_badge">
                                                              <?php  echo $count_notification; ?>
                                                           </span>
                                                          <?php } 
                                                          ?>
                                                          </div>
                                                    </a>
                                                    <ul aria-labelledby="drop4" class="dropdown-menu">
                                                        <div class="nav-dropdown-heading">Notifications  
                                                              <span class="count" id="_my_notifications_badge2">
                                                              <?php if (!empty($count_notification)){ 
                                                                                                    echo "(".$count_notification.")";
                                                                                                      } 
                                                                  ?>
                                                               </span>
                                                        </div>
                                                        <div class="nav-dropdown-content">
                                                            <ul id="noti_ajax_data">   
                                                            <?php if (!empty($notifications)) {
																	foreach ($notifications as $value) { ?>
																		 <li class="unread">
                                                                          <?php if($value['post_type']=='recommend listing') { ?>
                                                                            <a href="<?php echo $base_url.'/'.$value['noti_url']; ?>">
                                                                          <?php } else if($value['post_type']=='declined request') { ?>    
                                                                          <a href="<?php echo $base_url.'/'.$value['noti_url']; ?>">
                                                                          <?php } else { ?>
                                                                          <a href="<?php  echo $base_url.'/advice/request/'.base64_encode('gloobe__'.$value['sender_id']).'/'.base64_encode($value['recipient_id'])?>"> 

                                                                          <?php  } ?> 		
                                                                                <?php
                                                                                $notificationDetail = user_load($value['sender_id']);
                                                                                // echo "<pre>";
            // print_r($notificationDetail);
            // die;    
            if ($notificationDetail->picture != "") {
                $file = file_load($notificationDetail->picture->fid);
                //echo $file->uri;exit;
                $imgpath = $file->uri;
                $style = "homepage_header";
                //print '<img src="' . base_path() . drupal_get_path('theme', $GLOBALS['theme']) . '/images/no-profile-male-img.jpg" class="absolute-left-content img-circle size-img" alt="display pic" />';
                //print '<img src="' . $file->uri . '" alt="" class="absolute-left-content img-circle size-img">';
                print '<img class="absolute-left-content img-circle size-img" src="' . image_style_url($style, $imgpath) . '" alt="display pic">';
            } else {

                print '<img src="' . base_path() . drupal_get_path('theme', $GLOBALS['theme']) . '/images/no-profile-male-img.jpg" class="absolute-left-content img-circle size-img" alt="display pic" />';
            }
            ?>

                                                                                <strong><?php //print $notificationDetail->name; 
                                                                    print $notificationDetail->field_first_name['und'][0]['value'];
            ?></strong>  <?php echo $value['noti_msg']; ?>
                                                                                <?php $notify_time = $value['notification_time']; ?>

                                                                                <span class="small-caps"><?php echo humanTiming($notify_time) . ' ago'; ?></span>



                                                                            </a></li>



        <?php }
    } else { ?>

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
                                                            if (strlen($userDetails->field_first_name['und'][0]['value']) > 10) {
                                                                $dots = '..';
                                                            } else {
                                                                $dots = '';
                                                            }
                                                            $name = substr($userDetails->field_first_name['und'][0]['value'], 0, 10) . $dots;
                                                            echo (trim($name, "%20"))?(trim($name, "%20")):$facebook_user_name_first;
    ?>  </div>
                                                            <?php
                                                            if ($userDetails->picture != "") {
                                                                $file = file_load($userDetails->picture->fid);
                                                                //echo $file->uri;exit;
                                                                $imgpath = $file->uri;
                                                                $style = "homepage_header";
                                                                print '<img class="img-circle size-img" src="' . image_style_url($style, $imgpath) . '">';
                                                                //  print '<img src="' . $file->uri . '" class="img-circle size-img" alt="img">';
                                                            } else {
                                                                print '<img src="' . base_path() . drupal_get_path('theme', $GLOBALS['theme']) . '/images/no-profile-male-img.jpg" class="img-circle size-img" />';
                                                            }
                                                            ?>
                                                        <span class="caret"></span>
                                                    </a>
                                                    <ul aria-labelledby="drop3" class="dropdown-menu">
                                                        <li><a tabindex="0" role="button" href="<?php echo $base_url; ?>/dashboard"><i class="fa fa-tachometer"></i>Dashboard</a></li>
                                                        <li><a tabindex="0" role="button" href="<?php echo $base_url; ?>/manage/listing"><i class="fa fa-list-alt"></i>Listing</a></li>
                                                        <li><a tabindex="0" role="button" href="<?php echo $base_url; ?>/mytrips"><i class="fa fa-plane"></i>Trips</a></li>
                                                        <li>
														<!--<a tabindex="0" role="button" href="<?php echo $base_url; ?>/bookings"><i class="fa fa-calendar"></i>Reservations</a>-->
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

<?php } ?>
                <div class="webtitle">
                    <div class="col-md-12 col-sm-12 col-xs-12 titlecol">
                        <h1>Welcome to Gloobers</h1>
                        <h3>Be Friendly. Travel for free</h3>
                    </div> <!-- End TitleCol -->
                </div> <!-- End Webtitle -->

<?php $searchForm = drupal_get_form('search_listings_form');
echo drupal_render($searchForm); ?>
                <span class="scroll_down"><a href="javascript:void(0);"><i class="fa fa-chevron-down"></i></a></span>
                <div class="mask"></div>
            </div> <!-- End Main_Head -->
            <section id="howzcarousel" class="howitblock carousel slide">
                <a name="howitworks"></a>
                <div class="col-md-12 col-sm-12 col-xs-12 howitcol">
                    <div class="blockheading"><h2>How it works ?</h2></div>
                    <div class="carousel-inner">
                <?php print render($page['how_it_works']); ?>
                        <a class="left carousel-control" href="javascript:void(0);" data-slide="prev" onclick="jQuery('#howzcarousel').carousel('prev')"></a>
                        <a class="right carousel-control" href="javascript:void(0);" data-slide="next" onclick="jQuery('#howzcarousel').carousel('next')"></a>
                    </div> <!-- End HowItCol -->
            </section> <!-- End Howitworks -->
            <section id="popular_destination" class="destinationblock">
                <div class="col-md-12 col-sm-12 col-xs-12 destinationcol">
                    <div class="blockheading"><h2>Popular destinations</h2></div>
                    <div class="container">
                        <?php print render($page['popular_destination']); ?>
                    </div> <!-- End Container -->
                </div> <!-- End DestinationCol -->
            </section> <!-- End DestinationBlock -->
<?php print render($page['passionate']); ?>
<?php if ($page['footer']) {
    print render($page['footer']);
} ?>   

        </div> <!-- End IndexHome -->
    </div> <!-- End Row -->
</div> <!-- End Wrapper -->
<!-- Login and Sign Up Popup   -->


<?php if (!$user->uid) { ?>
    <div id="slide" class="well">
        <div class="login_box">
            <h3>New on Gloobers ?</h3>
            <p>Join the tribe now </p>
            <div class="facebook"><a href="<?php echo $link['href'] . '?' . $query; ?>">
                    <img src="<?php echo $base_url . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/images/fb_signup.png'; ?>" alt="image"></a></div>
            <p>or sign in with your email </p>
            <div id="divErrReg"></div>

            <div class="alert-message alert" id="new_signup" style="display:none;"></div>
            <div id="load-Register" class="load-screen_details_loginSignup"></div>  
    <?php echo drupal_render($register_form); ?>

            <a class="slide_close">X</a>
        </div>
    </div>
    <div  id="basic" class="well">
        <div class="login_box">
            <h3>Back on Gloobers?</h3>
            <p>Log into your account</p>
            <div class="facebook"><a href="<?php echo $link['href'] . '?' . $query; ?>"><img src="<?php echo $base_url . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/images/fb.png'; ?>" alt="image"></a></div>
            <p>Or log in with your Email</p>
            <div id="divErr"></div>
            <div class="alert-message alert" style="display:none;"></div>
            <div id="load-Login" class="load-screen_details_loginSignup"></div>  
    <?php echo drupal_render($user_login_form); ?>
            <a class="basic_close">X</a>
        </div>

    </div>
<?php } ?>


<!-- <script src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/jss/jQuery.min.js" type="text/javascript" language="javascript"></script> -->
<script src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/jss/easingv1.3.js" type="text/javascript" language="javascript"></script>
<script src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/jss/jqueryui.js" type="text/javascript" language="javascript"></script>
<!-- <script src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/jss/bootstrap.min.js" type="text/javascript" language="javascript"></script> -->
<script src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/jss/jquery.nicescroll.min.js" type="text/javascript" language="javascript"></script>
<script src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/jss/jquery.selectbox-0.2.js" type="text/javascript" language="javascript"></script>
<script src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/js/jquery.popupoverlay.js" type="text/javascript" language="javascript"></script>

<script type="text/javascript">
                            jQuery('#slide').popup({
                                focusdelay: 400,
                                outline: true,
                                vertical: 'top'
                            });

                            jQuery('#basic').popup();

                            function hometowngeocode() {
                                var home_autocomplete = new google.maps.places.Autocomplete(
                                        /** @type {HTMLInputElement} */
                                                (document.getElementById('edit-keys--2')),
                                                {types: ['geocode']});
                                google.maps.event.addListener(home_autocomplete, 'place_changed', function () {
                                });
                            }
                            jQuery(document).ready(function () {
                                jQuery("#search_listings_submit").click(function () {
                                    var tripdestination = jQuery(".searchinput").val();
                                    var triptype = jQuery(".select_box").val();
                                   if (tripdestination == "") {
                                        jQuery(".searchinput").css({'border-color': '#ff0000'});
                                        return false;
                                    }
                                    else{
                                        jQuery(".searchinput").css({'border-color': '#555'});
									}
									var myselectedoption=jQuery('#custom_jquery_select').find('.sbSelector')[0].innerHTML;
                                    if (myselectedoption == "Select Type") {
									
									 //alert(myselectedoption);return false;
                                        jQuery(".sbHolder").css({'border-color': '#ff0000'});
                                        return false;
                                    }
                                    else{
                                        jQuery(".sbHolder").css({'border-color': '#555'});
									}

                                });


                                jQuery("html").niceScroll();

                                /*SelectBox*/
                                jQuery("select").selectbox();
                                jQuery(document).click(function (e) {
                                    if (!jQuery(e.target).is('.sbHolder, .sbHolder *')) {
                                        jQuery("select").selectbox('close');
                                    }
                                }); //End


                                jQuery(".scroll_down").click(function () {
                                    jQuery('html, body').animate({
                                        scrollTop: jQuery(".howitblock").offset().top
                                    }, 1000);
                                });
                            });
                            jQuery(window).scroll(function () {
                                dHeight = jQuery(".scroll_down").offset().top + jQuery(".main_head").height();
                                wHeight = jQuery(window).scrollTop() + jQuery(window).height();
                                if (dHeight < wHeight) {
                                    jQuery('.loginheader').addClass('barfixed');
                                }
                                else {
                                    jQuery('.loginheader').removeClass('barfixed');
                                }
                            }); // End Sticky()

                            jQuery(function () {
                                jQuery('.morearrow').click(function () {
                                    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                                        var target = jQuery(this.hash);
                                        target = target.length ? target : jQuery('[name=' + this.hash.slice(1) + ']');
                                        if (target.length) {
                                            jQuery('html,body').animate({
                                                scrollTop: target.offset().top
                                            }, 1000);
                                            return false;
                                        }
                                    }
                                });
                            });

</script>
<script type="text/jscript">
    jQuery(".checkbox_cus").click(function(){
    jQuery(this).toggleClass('checked');
    jQuery('.form-checkbox').toggleClass('checked');
    });
</script>