<!-- Updated 12-02-2016 time -->
<div style="display: none;" id="load-screen"></div>
<!--End Updated 12-02-2016 -->
<?php
/**
 * @file
 * Bartik's theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template normally located in the
 * modules/system directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 * - $hide_site_name: TRUE if the site name has been toggled off on the theme
 *   settings page. If hidden, the "element-invisible" class is added to make
 *   the site name visually hidden, but still accessible.
 * - $hide_site_slogan: TRUE if the site slogan has been toggled off on the
 *   theme settings page. If hidden, the "element-invisible" class is added to
 *   make the site slogan visually hidden, but still accessible.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['header']: Items for the header region.
 * - $page['featured']: Items for the featured region.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['triptych_first']: Items for the first triptych.
 * - $page['triptych_middle']: Items for the middle triptych.
 * - $page['triptych_last']: Items for the last triptych.
 * - $page['footer_firstcolumn']: Items for the first footer column.
 * - $page['footer_secondcolumn']: Items for the second footer column.
 * - $page['footer_thirdcolumn']: Items for the third footer column.
 * - $page['footer_fourthcolumn']: Items for the fourth footer column.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 * @see bartik_process_page()
 * @see html.tpl.php
 */

global $user, $base_url;

//22april2016//
$timezone=date_default_timezone_get();
date_default_timezone_set($timezone);
//22april2016//

//22april2016//
$timezonefile=fopen("timezone.text",a);
fwrite($timezonefile,$user->uid.'='.$timezone.PHP_EOL);
fclose($timezonefile);
//end 22april2016//


if (in_array('administrator', $user->roles)) {
    
}
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
$userDetails = user_load($user->uid);
$listingId = arg(3);
$OverviewData = getOverviewData($listingId);
$PhotosData = getPhotosData($listingId);
//echo "<pre>";Print_r($PhotosData);exit;
$amentiesdata = getAmentiesByproduct($listingId);
$pricingData = getPricingData($listingId);
$locationDetail = getListingData($listingId);

$extras = getExtraDetailsNew($listingId);
$rulesDetail = getRulesDetails($listingId);
$ruLeData=unserialize($rulesDetail['value1']);
if(isset($ruLeData['cancellation_policies_type'])){
$Cancel_type=$ruLeData['cancellation_policies_type'];
}else{
$Cancel_type='Relaxed';
}
$calendarDetail = getSchedulingData($listingId);
$current_path = current_path();
$notifications = getNotifications();
$messagelist = getMessageList();
$senderDetail = user_load($messagelist['author']);
$messagecount = getNewMessageListCount();
$notifiationStore = (json_decode($notifiationBadge));
$count_notification = $notifiationStore->count;
define('BASE_CURRENCY_NAME', '$');
$front_end_theme_with_new_header = 'gloobers_new';
$notifiationBadge = unread_notification(1);
$notifiationStore = (json_decode($notifiationBadge));
$front_end_theme_common_path = 'gloobers_new';
//$count_notification = $notifiationStore->count;
$count_notification = getNotificationsCount();

?>
 <script type="text/javascript">
  $baseURL = "<?php echo $base_url; ?>";
  $productId = "<?php echo arg(3); ?>";
</script>
<?php if (strpos($_SERVER['REQUEST_URI'], '/product/add/photos') !== false) { ?> 
<script type="text/javascript">
    $baseURL = "<?php echo $base_url; ?>";
    //$flashPath= $baseURL+"/<?php echo libraries_get_path('plupload') . '/js/plupload.flash.swf'; ?>";
    $flashPath = $baseURL + "/<?php echo libraries_get_path('plupload') . '/js/Moxie.swf'; ?>";
    $silverlite = "/<?php echo libraries_get_path('plupload') . '/js/plupload.silverlight.xap'; ?>";
    $productId = "<?php echo arg(3); ?>";
	plupload.addFileFilter('max_file_size', function(maxSize, file, cb) {
	    var undef;
		var fileSize = bytesToSize(file.size);
		var sizeBreak=maxSize.split(' ');
		if(sizeBreak[1]=='mb'){
			var max_size_allowed=(sizeBreak[0]*1000000);
		}
		if(file.size > max_size_allowed){
			this.trigger('Error', {
			  code : plupload.FILE_SIZE_ERROR,
			  message : plupload.translate('File format is not valid.'),
              //message : plupload.translate('File size error.'),
			  file : file
			});
			cb(false);
		}else{
			cb(true);
		}
	});
	
	function bytesToSize(bytes) {
	   var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
	   if (bytes == 0) return '0 Byte';
	   var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
	   return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
	};
	
</script>
<style>
    .calinfo > p {
        display: none;
    }
</style>
<?php }?>
<?php if (strpos($_SERVER['REQUEST_URI'], '/product/add/location') !== false) { ?> 
<!--script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&language=en"></script-->
<script src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyA9ZXW_xxCYbGV5hAN13jO2yquESD3MY10 &libraries=places&language=en"></script>
<?php }?>
<link href="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/css/style.css' ?>" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/css/meanmenu.css' ?>" media="all" />
<link rel="stylesheet" href="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/css/demo.css' ?>" media="all" />
<link rel="stylesheet" href="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/css/responsiveslides.css' ?>" media="all" />
<link rel="stylesheet" href="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/css/leanModal.css' ?>" media="all" />
<link rel="stylesheet" type="text/css" href="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/css/colorbox.css" />
<!----NEW FONT ADDED -->

<!-- Core CSS  -->
<link rel="stylesheet" type="text/css" href="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $front_end_theme_with_new_header); ?>/css/bootstrap.min.css" />
<!--<link rel="stylesheet" type="text/css" href="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $front_end_theme_with_new_header); ?>/css/landing_custom.css" />
<link rel="stylesheet" type="text/css" href="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $front_end_theme_with_new_header); ?>/css/landing_page.css" />-->

<link rel="stylesheet" type="text/css" href="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $front_end_theme_with_new_header); ?>/fonts/stylesheet.css" />
<link rel="stylesheet" type="text/css" href="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $front_end_theme_with_new_header); ?>/css/font-awesome.css" />
<?php//if(strpos($_SERVER['REQUEST_URI'],'/user/account_settings') !== false){  ?>
<!--<link rel="stylesheet" type="text/css" href="<?php //print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$front_end_theme_with_new_header); ?>/stylesheet/style.css" />-->
<?php //} ?>
<!-- Plugin CSS -->
<link rel="stylesheet" type="text/css" href="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/js/vendor/plugins/chosen/chosen.min.css" />
<link rel="stylesheet" type="text/css" href="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/js/vendor/plugins/timepicker/bootstrap-timepicker.min.css" />
<link rel="stylesheet" type="text/css" href="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/js/vendor/plugins/datepicker/datepicker.css" />
<link rel="stylesheet" type="text/css" href="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/js/vendor/plugins/daterange/daterangepicker.css" />
<link rel="stylesheet" type="text/css" href="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/js/vendor/plugins/tags/tagmanager.css" />

<!-- Theme CSS -->
<link rel="stylesheet" type="text/css" href="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/css/theme.css" />
<link rel="stylesheet" type="text/css" href="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/css/pages.css" />


<link rel="stylesheet" type="text/css" href="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/css/jquery.Jcrop.css" />
<link rel="stylesheet" type="text/css" href="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/css/plugins.css" />
<link rel="stylesheet" type="text/css" href="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/css/responsive.css" />
<link rel="stylesheet" type="text/css" href="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/css/jquery.datetimepicker.css" />
<link type="text/css" rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/themes/smoothness/jquery-ui.min.css" media="screen" />
<link type="text/css" rel="stylesheet" href="http://plupload.com/plupload/js/jquery.ui.plupload/css/jquery.ui.plupload.css" media="screen" />

<?php
drupal_add_css(drupal_get_path('theme', $GLOBALS['theme']) . '/css/stylemenu.css');
drupal_add_js(drupal_get_path('theme', $GLOBALS['theme']) . '/js/stylemenu_main.js', array('scope' => 'footer'));
if (strpos($_SERVER['REQUEST_URI'], '/product/add/location') !== false) {
drupal_add_js(drupal_get_path('theme', $GLOBALS['theme']) . '/js/autocomplete.js', array('scope' => 'footer'));
}
?>
<!--New HTML CALENDER IMPLEMENTATION CSS-->

<link href="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/css/inner_page.css" rel="stylesheet" type="text/css">


<link rel="stylesheet" href="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/css/landing_page.css">
<link rel="stylesheet" href="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/css/simple-sidebar.css">
<link rel="stylesheet" href="<?php print $GLOBALS['base_url'] . '/sites/all/themes/gloobers_new/stylesheet/for-head-foot.css' ?>">
<!--END New HTML CALENDER IMPLEMENTATION CSS-->

<div id="page-wrapper">
    <div id="page">
        <header>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2 col-sm-2 col-xs-12"><a href="<?php echo $base_url; ?>" title="Home" rel="home" class="logo" id="logo"><img src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/images/sitelogo.png" alt="Home"></a></div>
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
                                            <?php
                                            if (!empty($count_notification)) {
                                                echo "<span class='count'>";
                                                echo $count_notification;
                                                echo "</span>";
                                            }
                                            ?>
                                            </div>
                                            
                                        </a>
                                        <ul aria-labelledby="drop4" class="dropdown-menu">
                                            <div class="nav-dropdown-heading">Notifications <?php
                                                if (!empty($count_notification)) {
                                                    echo "(";
                                                    echo $count_notification;
                                                    echo ")";
                                                } 
                                                ?>
                                                </div>
                                            <div class="nav-dropdown-content">
                                                <ul id="noti_ajax_data">   
                                                <?php if (!empty($notifications)) {
                                                    foreach ($notifications as $value) {
                                                        ?>
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
                                                            } else {
                                                                print '<img src="' . base_path() . drupal_get_path('theme', $GLOBALS['theme']) . '/images/no-profile-male-img.jpg" class="absolute-left-content img-circle size-img" alt="display pic" />';
                                                            }
                                                            ?>
                                                                    <strong><?php print $notificationDetail->field_first_name['und'][0]['value'].'  '; ?></strong>
                                                                    <?php echo $value['noti_msg']; ?>
                                                                    <?php $notify_time = $value['notification_time']; ?>
                                                                    <span class="small-caps"><?php echo humanTiming($notify_time) . ' ago'; ?></span>
                                                                </a>
                                                            </li>
                                                                <?php
                                                                }
                                                            } else {
                                                                ?>
                                                        <li> -- No  Notification -- </li> 
                                                    <?php } ?>       
                                            </div>
											 <?php if (!empty($notifications)) { ?>
                                            <li><a href="<?php echo $base_url; ?>/advice/notification" class="notifications_btn">See all notifications</a></li>
											<?php } ?>
                                        </ul>
                                    </li>
                                    <li class="dropdown" id="fat-menu">
                                        <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#" id="drop3">
                                            <div class="user_name"><?php
											
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
                                            <li><a tabindex="0" role="button" href="<?php echo $base_url; ?>/manage/listing"><i class="fa fa-list-alt"></i>Listing</a></li>
                                            <li><a tabindex="0" role="button" href="<?php echo $base_url; ?>/mytrips"><i class="fa fa-plane"></i>Trips</a></li>
                                            <li>
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
    </div>
</div>
<?php if ($user->uid) {    ?>
    <!-----New Menu Implemented According to hotel design-->
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
                            ?>" href="<?php echo $base_url; ?>/manage/listing"> Listings  </a>
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
                               ?>" href="<?php echo $base_url; ?>/mytrips"> 
							   Trips
						</a>
                    </li>
                    <li><a href="javascript:void(0)"> Recommendation <div class="togelsubmenu pull-right"><i class="fa fa-bars"></i></div> </a>

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
                    <!--<li><a class="<?php
                            if (strpos($_SERVER['REQUEST_URI'], '/bookings') !== false) {
                                echo $class_select_menu = 'select_menus';
                            } else {
                                echo $class_select_menu = '';
                            }
                            ?>" href="<?php echo $base_url; ?>/bookings"> Reservations  </a>
                    </li>-->
                        
                       
                        

                    </ul>
                </div> 

            </div>
        </div>
    </div>

    <?php
} $eid = arg(3);
?>
<!-- End: Main --> 
<?php $cls = '';?>
<!-- End: Main --> 
<?php if(($current_path != 'manage/listing') && (!strpos($_SERVER['REQUEST_URI'], 'bookings'))) { ?>
<section class="account_section experience_section">
  <?php if($current_path != 'mytrips'){ $tripWrapper="wrapper";  }else{ $tripWrapper="tripwrapper"; } ?>
    <?php if($current_path != 'mytrips'){echo ' <div class="activity_title"><h3>Create an activity</h3></div>';}?>   
     <div id="<?php echo $tripWrapper; ?>">
		<?php if($current_path != 'mytrips'){ ?>
        <div id="sidebar-wrapper">
            <!-- <div class="toggle_heading-div"><p class="toggle_heading">Create an experience</p></div> -->
<ul class="sidebar-nav">
                <li>
                    <a  <?php
                        if (strpos($_SERVER['REQUEST_URI'], '/product/add/overview') !== false) {
                           $cls = "active_sidebar ";
                        }else{
							$cls = "";
						}
						if($OverviewData){
							$vis="visited_sidebar";
                            if ($eid != ""){ $eids="/" . $eid;}
                            $hrefExists=$base_url.'/product/add/overview'.$eids;
						}else{
							$vis="";
                            $hrefExists='javascript:void(0);';
						}

                  ?> class="<?php echo $cls.$vis; ?>"  href="<?php echo $hrefExists ; ?>">Overview</a>
                </li>

                <li>
                    <a <?php
                        if (strpos($_SERVER['REQUEST_URI'], '/product/add/photos') !== false) {
                           $cls = "active_sidebar ";
                        }else{
							$cls = "";
						}
						if(!empty($PhotosData)){
							$vis="visited_sidebar";
                            if ($eid != ""){ $eids="/" . $eid;}
                            $hrefExists=$base_url.'/product/add/photos'. $eids;
						}else{
							$vis="";
                            $hrefExists='javascript:void(0);';
						}
                        ?> class="<?php echo $cls.$vis; ?>"  href="<?php echo $hrefExists; ?>">Photos</a>
                </li>
               <!--  <li>
                    <a <?php
                        if (strpos($_SERVER['REQUEST_URI'], '/product/add/amenities') !== false) {
                           $cls = "active_sidebar ";
                        }else{
							$cls = "";
						}
						if(isset($amentiesdata) && !empty($amentiesdata)){
							$vis="visited_sidebar";
						}else{
							$vis="";
						}
						if(isset($PhotosData) && !empty($PhotosData)){
							if ($eid != ""){ $eids="/" . $eid;}
							$hrefExists=$base_url.'/product/add/amenities'. $eids;
			
						}else{
							$hrefExists='javascript:void(0);';
						}
						
                  ?> class="<?php echo $cls.$vis; ?>" href="<?php echo $hrefExists; ?>">Amenties</a>
                </li> -->
                <li>
                    <a <?php
                        if (strpos($_SERVER['REQUEST_URI'], '/product/add/location') !== false) {
                           $cls = "active_sidebar ";
                        }else{
							$cls = "";
						}
						if(!empty($locationDetail['address1']) || !empty($locationDetail['state']) || !empty($locationDetail['country'])){
							$vis="visited_sidebar";
                            if ($eid != ""){ $eids="/" . $eid;}
                            $hrefExists=$base_url.'/product/add/location'. $eids;

						}else{
							$vis="";
                            $hrefExists='javascript:void(0);';
						}
						
                  ?> class="<?php echo $cls.$vis; ?>" href="<?php echo $hrefExists; ?>">Location</a>
                </li>
                <li>
                    <a <?php
                        if (strpos($_SERVER['REQUEST_URI'], '/product/add/Calendernew') !== false) {
                           $cls = "active_sidebar ";
                        }else{
							$cls = "";
						}
						if((isset($pricingData) && !empty($pricingData)) && (!empty($calendarDetail)&& isset($calendarDetail))){
							$vis="visited_sidebar";
                            if ($eid != ""){ $eids="/" . $eid;}
                            $hrefExists=$base_url.'/product/add/Calendernew'. $eids;
						}else{
							$vis="";
                            $hrefExists='javascript:void(0);';
						}
						
                  ?> class="<?php echo $cls.$vis; ?>" href="<?php echo $hrefExists; ?>">Rates and availabilities </a>
                </li>
                <li>
                    <a <?php
                        if (strpos($_SERVER['REQUEST_URI'], '/product/session/edit') !== false) {
                           $cls = "active_sidebar ";
                        }else{
                            $cls = "";
                        }
                        if((isset($pricingData) && !empty($pricingData)) && (!empty($calendarDetail)&& isset($calendarDetail))){
                            $vis="visited_sidebar";
                             if ($eid != ""){ $eids="/" . $eid;}
                            $hrefExists=$base_url.'/product/session/edit'. $eids;
                        }else{
                            $vis="";
                             $hrefExists='javascript:void(0);';
                        }
                       
                  ?> class="<?php echo $cls.$vis; ?>" href="<?php echo $hrefExists; ?>">Calendar </a>
                </li>
                <li>
                    <a <?php
                        if (strpos($_SERVER['REQUEST_URI'], '/product/add/extra') !== false) {
                           $cls = "active_sidebar ";
                        }else{
							$cls = "";
						}
						if(isset($extras) && !empty($extras)){
							$vis="visited_sidebar";
                            if ($eid != ""){ $eids="/" . $eid;}
                            $hrefExists=$base_url.'/product/add/extra'. $eids;
						}else{
							$vis="";
                            $hrefExists='javascript:void(0);';
						}
						
                  ?> class="<?php echo $cls.$vis; ?>" href="<?php echo $hrefExists; ?>">Optional services</a>
                </li>
                <li>
                    <a <?php
                        if (strpos($_SERVER['REQUEST_URI'], '/product/add/rules') !== false){
                           $cls = "active_sidebar ";
                        }else{
							$cls = "";
						}
						if(isset($rulesDetail) && !empty($rulesDetail)){
							$vis="visited_sidebar";
                            if ($eid != ""){ $eids="/" . $eid;}
                            $hrefExists=$base_url.'/product/add/rules'. $eids;
						}else{
							$vis="";
                             $hrefExists='javascript:void(0);';
						}
						
                  ?> class="<?php echo $cls.$vis; ?>" href="<?php echo $hrefExists; ?>">Rules and policies</a>
                </li>
                <li>
                    <a <?php
                        if ((strpos($_SERVER['REQUEST_URI'], '/product/add/subscription') !== false) || (strpos($_SERVER['REQUEST_URI'], 'product/add/payment') !== false))  {
                           $cls = "active_sidebar ";
                        }else{
							$cls = "";
						}
						if(isset($success) || (strpos($_SERVER['REQUEST_URI'], 'product/add/payment') !== false) || (strpos($_SERVER['REQUEST_URI'], 'product/add/success') !== false) || ($OverviewData['package_id'] != null)){
							$vis="visited_sidebar";
                            if ($eid != ""){ $eids="/" . $eid;}
                            $hrefExists=$base_url.'/product/add/subscription'. $eids;
						}else{
							$vis="";
                            $hrefExists='javascript:void(0);';
						}
						
                  ?> class="<?php echo $cls.$vis; ?>" href="<?php echo $hrefExists; ?>">Ranking plan</a>
                </li>
			</ul>
            </div> <?php } ?>
        <?php
        $DivSize = 'product/add/subscription';
        switch ($DivSize) {
            case (strpos($_SERVER['REQUEST_URI'], 'product/add/subscription') !== false):
                $var_bootstrap = '12';
                break;
			case (strpos($_SERVER['REQUEST_URI'], 'product/session/edit') !== false):
                $var_bootstrap = '12';
                break;
            case (strpos($_SERVER['REQUEST_URI'], 'product/add/location') !== false):
                $var_bootstrap = '12';
                break;
            case (strpos($_SERVER['REQUEST_URI'], 'product/add/rules') !== false):
                $var_bootstrap = '9';
                break;
			case (strpos($_SERVER['REQUEST_URI'], 'product/extra/edit') !== false):
                $var_bootstrap = '9';
                break;
			case (strpos($_SERVER['REQUEST_URI'], 'product/add/amenities') !== false):
                $var_bootstrap = '12';
                break;
            case (strpos($_SERVER['REQUEST_URI'], 'product/add/photos') !== false):
                $var_bootstrap = '9';
                break;
            case (strpos($_SERVER['REQUEST_URI'], 'product/add/extra') !== false):
                $var_bootstrap = '9';
                break;
            case (strpos($_SERVER['REQUEST_URI'], 'product/add/Calendernew') !== false || strpos($_SERVER['REQUEST_URI'], 'product/session/edit') !== false):
                $var_bootstrap = '9';
                break;
            case (strpos($_SERVER['REQUEST_URI'], 'product/add/overview') !== false):
                $var_bootstrap = '9';
                break;
            case (strpos($_SERVER['REQUEST_URI'], 'manage/listing') !== false):
                $var_bootstrap = '12';
                break;
            case (strpos($_SERVER['REQUEST_URI'], '/bookings') !== false):
                $var_bootstrap = '12';
                break;
            case (strpos($_SERVER['REQUEST_URI'], '/user/edit') !== false):
                $var_bootstrap = '12';
                break;

            case (strpos($_SERVER['REQUEST_URI'], '/mytrips') !== false):
                $var_bootstrap = '12';
                break;
            case (strpos($_SERVER['REQUEST_URI'], '/dashboard') !== false):
                $var_bootstrap = '0';
                break;
            case (strpos($_SERVER['REQUEST_URI'], '/product/add/payment') !== false):
                $var_bootstrap = '9';
                break;
            case (strpos($_SERVER['REQUEST_URI'], '/product/add/success') !== false):
                $var_bootstrap = '12';
                break;
            case (strpos($_SERVER['REQUEST_URI'], '/profile/view') !== false):
                $var_bootstrap = '12';
                break; 


            default:
                $var_bootstrap = '6';
        }

        if (strpos($_SERVER['REQUEST_URI'], 'dashboard') !== false) {
            $classRowCol = '';
        } else {
            $classRowCol = "col-xs-12 col-sm-" . $var_bootstrap . " col-md-" . $var_bootstrap . "";
        }
        ?>
        <div id="page-content-wrapper">
            <div class="container-fluid">
			<?php if($current_path!='mytrips'){ ?>
                <div class="row">  <a id="menu-toggle" class="sidebar_btn" href="#menu-toggle">Toggle Menu</a></div> <?php } ?>
                <div class="row pos_relative">
                    <div class="<?php echo $classRowCol; ?>">
                        <div class="inner_setting_page">
<?php if ($messages): ?>
                                <div id="messages"><div class="section clearfix">
    <?php print $messages; ?>
                                    </div></div> <!-- /.section, /#messages -->
<?php endif; ?>
<?php print render($page['content']); ?>
                        </div>
                    </div> <!-- End Col -->	
                </div>
            </div>
        </div>
    </div>
</section>
<?php }else{ ?>
<section class="account_section experience_section responsive_tab">
<?php if($current_path != 'mytrips'){ $tripWrapper="wrapper";  }else{ $tripWrapper="tripwrapper"; } ?>
     <div id="<?php echo $tripWrapper; ?>">
	<?php if($current_path != 'mytrips'){ ?>
<div id="sidebar-wrapper">
<!-- <div class="toggle_heading-div"><p class="toggle_heading">Listings</p></div> -->
<ul class="sidebar-nav">
<li><a <?php
          if (strpos($_SERVER['REQUEST_URI'], '/manage/listing') !== false) {
           $cls = "active_sidebar";
          }else{
			$cls = "";
		  }
		  
          ?> class="<?php echo $cls; ?>" class="<?php if($current_path == 'manage/listing'){ echo "active_sidebar";} ?>" href="<?php echo $base_url; ?>/manage/listing">My listings</a></li>
<li><a <?php
          if (strpos($_SERVER['REQUEST_URI'], '/bookings?booking_status=upcoming_reservation') !== false) {
           $cls = "active_sidebar";
          }else{
			$cls = "";
		  }
		  ?> class="<?php echo $cls; ?>" href="<?php echo $base_url; ?>/bookings?booking_status=upcoming_reservation">Upcoming reservations</a></li>
<li><a <?php
          if (strpos($_SERVER['REQUEST_URI'], '/bookings?booking_status=past_reservation') !== false || strpos($_SERVER['REQUEST_URI'], '/bookings?search_filter') !== false) {
           $cls = "active_sidebar";
          }else{
			$cls = "";
		  }
		  ?> class="<?php echo $cls; ?>" href="<?php echo $base_url; ?>/bookings?booking_status=past_reservation">Reservation history</a></li>
</ul>
</div>
<?php } ?>
                <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="<?php echo $classRowCol; ?>">
                        <div class="inner_setting_page">
<?php if ($messages): ?>
                                <div id="messages"><div class="section clearfix">
    <?php print $messages; ?>
                                    </div></div> <!-- /.section, /#messages -->
<?php endif; ?>
<?php print render($page['content']); ?>
                        </div>
                    </div> <!-- End Col --> 
                </div>
            </div>
        </div>
        </div>
        </section>



<?php } ?> 

<?php
//echo '<p style="color:red;">'.strpos($_SERVER['REQUEST_URI'],'product/add/photos').'</p>';exit;
print render($page['footer']);
?>
<!-- End: Main --> 
<?php if (strpos($_SERVER['REQUEST_URI'], '/product/add/subscription') !== false) { ?>
<script src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/js/jquery-1.12.3.min.js' ?>"></script>
<script src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/js/ion.rangeSlider.js' ?>"></script>
<?php } else { ?>
   <script src="//code.jquery.com/jquery-1.11.0.min.js"></script> 
<?php }?>


<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script> 

<?php if ((strpos($_SERVER['REQUEST_URI'], 'product/add/photos')) == false) { ?>
    <script type="text/javascript" src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $front_end_theme_with_new_header) . '/js/bootstrap.min.js' ?> "></script>
<?php } ?>

<script type="text/javascript" src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/js/easyResponsiveTabs.js' ?> "></script>

<!-- <script src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/js/jquery.meanmenu.js' ?>"></script> -->
<script src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/js/jquery.leanModal.min.js' ?>"></script>

<script type="text/javascript" src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/js/uniform.min.js' ?>"></script> 
<script type="text/javascript" src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/js/main.js' ?>"></script>
<script type="text/javascript" src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/js/custom.js' ?>"></script> 
<script type="text/javascript" src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/js/vendor/plugins/daterange/moment.min.js' ?>"></script> 
<script type="text/javascript" src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/js/vendor/plugins/daterange/daterangepicker.js' ?>"></script>
<script type="text/javascript" src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/js/vendor/plugins/timepicker/bootstrap-timepicker.min.js' ?>"></script> 
<script type="text/javascript" src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/js/vendor/plugins/datepicker/bootstrap-datepicker.js' ?>"></script> 

<script type="text/javascript" src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/js/jquery.colorbox.js' ?>"></script> 
<script type="text/javascript" src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/js/jquery.Jcrop.js' ?>"></script> 
<script type="text/javascript" src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/js/jquery.SimpleCropper.js' ?>"></script> 
<script src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/js/jquery.selectbox-0.2.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function () {
		<?php if(!strpos($_SERVER['REQUEST_URI'], 'product/add/location')){ ?>
			jQuery("select").selectbox();
		<?php } ?>
        jQuery('.cropme').simpleCropper();
        // Init Theme Core 	  
        Core.init();
        //jQuery('.datepicker').datepicker();
        jQuery('.datetimepicker').datepicker();
        //jQuery('.timepicker').timepicker();
        var nowTemp = new Date();
        var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

        jQuery('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            onRender: function (date) {
                return date.valueOf() < now.valueOf() ? 'disabled' : '';
            }
        });

        jQuery('.datepicker').keyup(function () {
            jQuery(this).val('');
        });
        jQuery('.datetimepicker').keyup(function () {
            jQuery(this).val('');
        });
        jQuery('.daterangepicker2').keyup(function () {
            jQuery(this).val('');
        });

        jQuery('input[name="openning_hours_dates"] , .form-item-high-season-rate-dates input , .daterangepicker2').daterangepicker({minDate: moment().subtract('days', 1)});
        /* jQuery('.timepicker').timepicker(); */

        /*  NEW JS ACC TO THEME */
        jQuery('.showhide').click(function (e) {
            e.preventDefault();
            jQuery('.nav_main_menu').find('ul').toggleClass('dropdwonmenu_remove dropdwonmenu');
        });

        jQuery('.togelsubmenu').click(function (e) {
            e.preventDefault();
            jQuery('.nav_main_menu').find('ul li ul').toggleClass('dropdwonmenu_remove1 dropdwonmenu1');
        });

        jQuery(".sidebar_icone").click(function () {
            jQuery(".inner_setting_page .container-fluid").addClass("container");
        });

        jQuery(".sidebar_icone").click(function () {
            jQuery(".sidebar_menu").toggleClass("close_sidebar");
        });

        jQuery("#menu-toggle").click(function (e) {
            e.preventDefault();
			if(jQuery("#wrapper").hasClass('toggled')){
			  jQuery("#wrapper").removeClass('toggled');
			}
			else
			{
			  jQuery("#wrapper").addClass('toggled');
			}
            //jQuery("#wrapper").toggleClass("toggled");
        });
		

        /* END */
    });
	jQuery(window).load(function(){
		function side_bar_resize(){
	    var window_width = jQuery(window).width();
		if(window_width <= 1024)
			{
				jQuery("#wrapper").addClass("toggled");
				
			}
			else
			{
				jQuery("#wrapper").removeClass("toggled");
				
			}
		}		
		
		side_bar_resize();  
   });
</script>

<?php
global $base_url;
$library_path = _plupload_library_path();

?>

<script src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/js/responsiveslides.min.js' ?>"></script>
<script src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $front_end_theme_with_new_header); ?>/js/jquery.nicescroll.min.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function () {
    
	jQuery('ul.nav li.dropdown').hover(function(){
		jQuery(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
		jQuery(this).addClass('open');
	}, function() {
		jQuery(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
		jQuery(this).removeClass('open');
	});
	});
    
    jQuery(document).ready(function () {      
       

		var Cancel_policy_typ='<?php echo $Cancel_type; ?>';
		jQuery('#new_cancellation_select').val(Cancel_policy_typ);
            
            if(Cancel_policy_typ=='' || Cancel_policy_typ==0){
                Cancel_policy_typ='Relaxed'
            }     
            console.log(Cancel_policy_typ);         
            var Cancel_policy_typ=jQuery.trim(Cancel_policy_typ);
            var res = Cancel_policy_typ.replace(" ", "-");   
            jQuery(".resp-tabs-container").find('#'+res).show();         
		
	
		// Slideshow 2
        jQuery("#slider2").responsiveSlides({
            auto: false,
            pager: true,
            speed: 300,
            width: 100,
        });

        // Calling Login Form
        jQuery("#login_form").click(function () {
            jQuery(".social_login").hide();
            jQuery(".user_login").show();
            return false;
        });

        // Calling Register Form
        jQuery("#register_form").click(function () {
            jQuery(".social_login").hide();
            jQuery(".user_register").show();
            jQuery(".header_title").text('Register');
            return false;
        });

        // Going back to Social Forms
        jQuery(".back_btn").click(function () {
            jQuery(".user_login").hide();
            jQuery(".user_register").hide();
            jQuery(".social_login").show();
            jQuery(".header_title").text('Login');
            return false;
        });

        jQuery("#user-profile-form").find("input[type=text]").addClass("form-control");
        jQuery("#user-profile-form").find("select").addClass("form-control");
        jQuery("#user-profile-form").find("input[type=password]").addClass("form-control");
        jQuery("#user-profile-form").find("input[type=submit]").addClass("btn btn-dark btn-gradient");

        jQuery(".btn-adminuser").click(function () {
            jQuery(".user-menu .dropdown-menu").slideToggle();

        });

        jQuery('html').on('click', 'a.disable', function (event) {
            event.preventDefault();
        });
        if (jQuery('#24_hour_offer_check').prop('checked') == true) {
            jQuery('.24_hour_offer_show').show();
        } else {
            jQuery('.24_hour_offer_show').hide();
        }
    });
    jQuery(document).ready(function () {

        Core.init();

        // Populates theme styles for Tabs - Trash function 
        var tabOptions = [];
        var tabToggle = jQuery(".toggle-tab-style .tab-style-option");
        var tabCount = jQuery(tabToggle).length;

        jQuery(tabToggle).each(function (index, element) {
            var optionVal = $(element).attr('opt');

            // gather options and push to array
            tabOptions.push(optionVal);

            // on last loop filter for uniques
            if (index == tabCount - 1) {
                jQuery.unique(tabOptions);
            }
        });

        // Changes theme style on Tabs - Trash function 
        jQuery(tabToggle).click(function () {
            var tabStyle = $(this).attr('opt');
            var Options = tabOptions.join(" ");

            // GARBAGE JS - left tab navigation has styles widget outside of its menu.
            // Requires slightly different class detection
            if (jQuery(this).parent().hasClass('tab-style-left')) {
                jQuery(this).parents("div.tab-block").children("ul").removeClass(Options).addClass(tabStyle);
            }
            else {
                // Assign option to parent of clicked tab widget. Remove all other options
                jQuery(this).parents("ul").removeClass(Options).addClass(tabStyle);
            }
            // remove active class from options and add
            // the class to the newly clicked option
            jQuery(this).siblings().removeClass("active");
            jQuery(this).addClass("active");

        });

        //jQuery("#helpBar").stick_in_parent();
    });
    
    function hide_perminute(val) {

        var typeTime = jQuery(val).val();
        if (typeTime != 'Minute') {
            jQuery('.repeat_everyminute_condition').hide();

        } else {
            jQuery('.repeat_everyminute_condition').show();

        }
    }
   

    jQuery(window).scroll(function () {
		var document_height = jQuery(document).height();
		var footer_height = jQuery('.region-footer footer').height();
		var window_height = jQuery(window).height();
		var container_height1 = footer_height + window_height;
		var container_height2 = document_height - container_height1;

		
        var scroll = jQuery(window).scrollTop();
        //>=, not <=
        if (scroll >= 250) {
            //clearHeader, not clearheader - caps H
<?php if ((strpos($_SERVER['REQUEST_URI'], 'product/add/amenities') !== false) || (strpos($_SERVER['REQUEST_URI'], 'product/add/location') !== false)) { ?>

                //jQuery("#helpBar").addClass("");

<?php } else { ?>
                jQuery("#helpBar").addClass("darkHeader");
				jQuery('#helpBar').css('top',scroll-200);
				if(scroll >= container_height2){
				jQuery('#helpBar').css('top',container_height2-100);
				}
<?php } ?>

	

        }

        else if (scroll <= 250) {
            //clearHeader, not clearheader - caps H
            jQuery("#helpBar").removeClass("darkHeader");
			jQuery('#helpBar').css('top','0');
        }
    });
	
	


    function readnotifications(recipient_id) {
        jQuery.ajax({
            url: '<?php echo $base_url; ?>/advice/readnotifications',
            type: 'post',
            data: {'recipientid': recipient_id, 'isAjax': 1},
            success: function (result) {
                //alert(result);

                window.location.href = '<?php echo $base_url; ?>/advice/notification';
            }

        });

    }
</script>

<script type="text/jscript">

    $baseUrl="<?php echo $base_url; ?>";
    jQuery(document).on('keypress','.my-custom-search',function(event){

    if ( event.which == 13 ) {
    var search = (jQuery('#edit-keys').val()).trim();
    if(search.length<=0){
    return false;
    }
    setTimeout(function(){
    var href = $baseUrl+'/search-destination/'+search;
    window.location.href = href;
    });
    }
    });


    jQuery(document).on('click','.my-custom-search',function(){
    var search = (jQuery('#edit-keys').val()).trim();
    if(search.length<=0){
    return false;
    }
    setTimeout(function(){
    var href = $baseUrl+'/search-destination/'+search;
    window.location.href = href;
    });
    });
    
</script>
<?php 
/* These Scripts will load only when The new pricing and calendar section page will be opened */
if(strpos($_SERVER['REQUEST_URI'],'product/add/Calendernew') !== false || strpos($_SERVER['REQUEST_URI'],'product/session/edit') !== false){ ?>

	<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/js/new_calender_custom.js"></script>

	<link rel="stylesheet" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme','gloobers_new'); ?>/css/fullcalendar.css" />

	<script type="text/javascript" src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme','gloobers_new'); ?>/js/fullcalendar.min.js"></script>
	<script type="text/javascript">
			var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 1; //January is 0!
            var yyyy = today.getFullYear();
			
            if (dd < 10) {
                dd = '0' + dd
            }
            if (mm < 10) {
                mm = '0' + mm
            }
            today = yyyy + '/' + mm + '/' + dd;
		/* Full Calendar */	
		jQuery('#calendar').fullCalendar({
				header: {
					left: 'prev,next',
					center: 'title',
					right: ''
				},
				defaultDate: today,
				editable: true,
				eventLimit: true,
		}); /* End Full Calendar */
				
		
		/* Calendar Popup Show/Hide */
	jQuery(document).ready(function() {

		jQuery( document ).on( 'click', 'input', function() {
		jQuery(this).removeClass('error');
		})
		
		var count24Hourclone=jQuery('.24_hours_discounted_clone').size();
		jQuery('.fc-event-container').click(function(){
			jQuery('.eventpopup_lightbox').fadeIn(500);
			jQuery(this).fadeIn(500);
		});
	
		jQuery('.closepopup').click(function(){
			jQuery('.eventpopup_lightbox').fadeOut(800);
		}); 
		/* End Calendar Popup Show/Hide */	

        jQuery('body').on('focus',".session_timepicker", function(){
            
            jQuery(this).timepicker().on('changeTime.timepicker', function(e){  
                    ss=jQuery(this).attr('data-val');
                    pre_selected_time=jQuery('#session_startTime_'+ss).html();

                    selected_time=jQuery(this).val();
                    console.log('pre_selected_time='+pre_selected_time);
                   
                    count_div=jQuery('.sessions_tabs_menu').length;
                    session_exists='time';
                    weekarray= [];
                    jQuery('.sessions_tabs_menu_'+ss).find('li').each(function(){
                            if(jQuery(this).hasClass('day_active')){    
                                weekarray.push(jQuery(this).find('.css-checkbox').val()); 
                            } 
                        })
                    console.log(weekarray); 
                    console.log('weekarray'+weekarray.length);    
                    if(count_div>1 && weekarray.length>0){                

                    jQuery('.session_timepicker').each(function(){

                        each_id=jQuery(this).attr('data-val');

                        if(ss!=each_id){

                        jQuery(this).closest('.offer_icon_left').next('.hour_session_content_right').find('.sessions_tabs_menu li').each(function(){
                                           
                            checkday='';each_selected_time='';         
                                      
                                if(jQuery(this).hasClass('day_active')){

                                    each_selected_time=jQuery('#session_startTime_'+each_id).text(); 
                                    checkday=jQuery(this).find('.css-checkbox').val();                    
                                    //convert both time into timestamp
                                    var stt = new Date("November 13, 2013 " + selected_time);
                                    stt = stt.getTime();
                                    var endt = new Date("November 13, 2013 " + each_selected_time);
                                    endt = endt.getTime();
                                    console.log('each_selected_time='+each_selected_time);
                                    console.log('stt='+stt);
                                    console.log('endt='+endt);
                                    if(stt==endt){
                                        console.log(jQuery.inArray(checkday, weekarray));
                                         if(jQuery.inArray(checkday, weekarray)>=0) {
                                            session_exists='yes';                                                                   
                                         } 
                                     }                             
                                }                  
                            })
                       }         
                    })
                  }

                  if(session_exists=='yes'){
                        alert('Session time '+selected_time+' already selected for same weekday');
                        jQuery('#edit-session_starttime_'+ss).val(pre_selected_time);  
                    } else if(session_exists=='time') {                               
                        console.log("here");
                        jQuery('#session_startTime_'+ss).html(jQuery(this).val());
                        jQuery('#edit-session_starttime_'+ss).val(jQuery(this).val());            
                        jQuery(this).closest('.offer_icon_left').addClass('active');                
                    }
            });

        });

		
		/* End Click on calendar Date opens Popup */
			
	
	
	/* Price Section Show/Hide */	
	jQuery('#edit-product-pricing-type').change(function()
	{	         		
		
		var Price_type_byId=jQuery('#edit-product-pricing-type').val();
		if(Price_type_byId=='PER_PERSON'){
		
			var person_type=jQuery('#edit-product-pricing-type').next().find('.sbSelector').html();			
			jQuery('.sessional_price_per_person-everyone').hide();
			jQuery('.pricetype_options_PER_ITEM').hide();
            jQuery('.pricetype_options_PER_ITEM_1').hide();
			jQuery('.pricetype_options_PER_ITEM_qty').hide();
			jQuery('.pricetype_options_PER_PERSON').show();
            jQuery('.pricetype_options_PER_PERSON_1').show();
			jQuery('.pricetype_options_PER_PERSON_qty').show();			
			jQuery('.sessional_price_per_item').hide();
			jQuery('#edit-product-pricing-type-sessional').val('Per Person');

            /*Hide show adult/child*/          
           
                if(jQuery('.product_adult_child').length==2){
                jQuery('.amount_perAdult_div').show();
                jQuery('.amount_perChild_div').show();
				jQuery('.add-experience').hide();

                } else{
                if(jQuery('.product_adult_child').val()=='adult'){  

                jQuery('.amount_perAdult_div').show();
                jQuery('.amount_perChild_div').hide();

                } else {
                jQuery('.amount_perAdult_div').hide();
                jQuery('.amount_perChild_div').show();
                }

                }                
                jQuery('.person_Item_availability').html('Min/Max person per session<span class="form-required"> *</span>');
			
		}else{
            jQuery("#addmore_item").hide();			
			jQuery('.pricetype_options_PER_ITEM').show();
            jQuery('.pricetype_options_PER_ITEM_1').show();
			jQuery('.pricetype_options_PER_ITEM_qty').show();
			jQuery('.pricetype_options_PER_PERSON').hide();
            jQuery('.pricetype_options_PER_PERSON_1').hide();
			jQuery('.pricetype_options_PER_PERSON_qty').hide();			
			jQuery('.sessional_price_per_person-everyone').hide();
			jQuery('.sessional_price_per_item').show();
			jQuery('#edit-product-pricing-type-sessional').val('Per Item');
			jQuery('.item_add').show();   
            jQuery('.person_Item_availability').html('Min/Max item per session<span class="form-required"> *</span>');            
		}
	});
	
		if(jQuery('#edit-product-person-type').val()=='adult'){
		jQuery('#edit-product-person-type').parent().removeClass('per_adult_child');
		jQuery('#edit-product-person-type').parent().addClass('per_adult');
		} else {
		jQuery('#edit-product-person-type').parent().removeClass('per_adult');
		jQuery('#edit-product-person-type').parent().addClass('per_adult_child');		
		}
		
	jQuery('#edit-product-person-type').change(function(){	      
		
		if(jQuery(this).val()=='adult'){
		jQuery(this).parent().removeClass('per_adult_child');
		jQuery(this).parent().addClass('per_adult');
        jQuery(".amount_perAdult_div").show();
        jQuery(".amount_perChild_div").hide();  
		} else {
		jQuery(this).parent().removeClass('per_adult');
		jQuery(this).parent().addClass('per_adult_child');	
        jQuery(".amount_perAdult_div").hide();
        jQuery(".amount_perChild_div").show();	
		}
        // Updated 11-02-2016 
        jQuery('.pricediv_clone').remove();
        if(jQuery('.additem_more').size()>1) {
        jQuery('.additem_more').eq(1).remove();           
        }
        //End Updated 11-02-2016 
		if(jQuery(this).attr('value')=='everyone'){
			jQuery('.sessional_price_per_person-everyone').show();				
			jQuery('#addmore_person').hide();
		}else{
			jQuery('.sessional_price_per_person-everyone').hide();			
			jQuery('#addmore_person').show();			
		}
	});

     jQuery('.eventpopup_panel').find('.rate_sec_inner').find('fieldset').find('.pricetype_options_PER_ITEM').find('div:first').find('.rate_type').find('input').blur(function(){
       var Item_name=jQuery('.eventpopup_panel').find('.rate_sec_inner').find('fieldset').find('.pricetype_options_PER_ITEM').find('div:first').find('.rate_type').find('input').val();
       if(Item_name==''){
           Item_name='item';
       }
       jQuery('#Item_booking').html('Min/Max '+Item_name+' per booking<span class="form-required"> *</span>');    
       jQuery('#Item_adult').html('Min/Max adults per '+Item_name+'<span class="form-required"> *</span>');    
       jQuery('#Item_child').html('Min/Max children per '+Item_name+'<span class="form-required"> *</span>');  
       jQuery('.person_Item_availability').html('Min/Max '+Item_name+' per session<span class="form-required"> *</span>'); 
       

   });
   
	/* End Price Section Show/Hide */	

	/* Offers and Disscounts Checkboxes Check Show/Hide */
	jQuery("#last_minutes_check").click(function(){
		if(jQuery('#last_minutes_check').prop('checked')==false){
			jQuery('.last_minute_checked_show').hide();
		}else{
			jQuery('.last_minute_checked_show').show();
		}
	});
	jQuery("#early_birds_check").click(function(){
		if(jQuery('#early_birds_check').prop('checked')==false){
			jQuery('.early_bird_discount_show').hide();
		}else{
			jQuery('.early_bird_discount_show').show();
		}
	});
	jQuery("#24_hour_offer_check").click(function(){
		if(jQuery('#24_hour_offer_check').prop('checked')==false){
			jQuery('.24_hour_offer_show').hide();
		}else{
			jQuery('.24_hour_offer_show').show();
		}
	});
	/* End Offers and Disscounts Checkboxes Check Show/Hide */

    function scroll_to_id(element_id){
        
        jQuery('html, body').animate({
        scrollTop: jQuery("#"+element_id).offset().top
        }, 2000);

    }

	/* Session Popup Validations And serialization of all values */
	var mySessionForm="";
	jQuery('.submit_btn_session').click(function()
	{
	   
		
		/* Create Session Popup Custom Form Validations */
		var Err = 0;var message_str='';

        var maxAvail=jQuery('#max_avail').val();
        var minAvail=jQuery('#min_avail').val();
        var products_person_max=jQuery('#products_person_max').val();
        var product_person_min=jQuery('#product_person_min').val();  
        
        var product_item_max=jQuery('#product_item_max').val();
        var product_item_min=jQuery('#product_item_min').val();       

		
        /*17may2016*/
        if(maxAvail== ''){      
            jQuery('#max_avail').addClass('error');
            Err++;

        }else if((jQuery.isNumeric(maxAvail))==false){          
            jQuery('#max_avail').addClass('error');
            Err++;

        }else{          
            jQuery('#max_avail').removeClass('error');
            
        }
        
        if(minAvail==''){
            jQuery("#min_avail").addClass("error");
            Err++;
        }else if((jQuery.isNumeric(minAvail))==false){
            jQuery("#min_avail").addClass("error");
            Err++;
        }else{
            jQuery("#min_avail").removeClass("error");
        }

        if((maxAvail!= '') && (minAvail!='')){
            if(jQuery.isNumeric(minAvail)!=false && jQuery.isNumeric(maxAvail)!=false){

                if(parseInt(maxAvail) < parseInt(minAvail)){               
                   
                    jQuery("#max_avail").addClass("error");
                    jQuery("#min_avail").addClass("error");
                    jQuery("#max_avail + label").remove();
                    jQuery("#max_avail").after('<label class="error">Availability max value should be greater than availability min value</label>');
                    Err++;
                }else{
              
                    jQuery("#min_avail").removeClass("error");
                    jQuery("#max_avail").removeClass("error");
                    jQuery("#max_avail + label").remove();
                }
                
            }
            
        }


        /*end 17may2016*/
         console.log("Err11="+Err);
		var Price_type=jQuery('#edit-product-pricing-type').val();
		if(jQuery.trim(Price_type)=='PER_PERSON'){
          console.log('here');
			jQuery('input[class^="amount_perperson"]').each(function(){
				if(jQuery(this).val()==''){
					jQuery(this).addClass("error");
					Err++;
				} else if((Math.floor(jQuery(this).val()) != jQuery(this).val()) || (!jQuery.isNumeric(jQuery(this).val())) || (jQuery(this).val().indexOf('-')>=0) || (jQuery(this).val().indexOf('+')>=0)){       
					jQuery(this).addClass("error");
					Err++;
				}else{
					jQuery(this).removeClass("error");
				}
				
			});

             console.log("Err_person="+Err);

            /* 17may2016*/

                if(products_person_max=='') {            
                    jQuery("#products_person_max").addClass("error");             
                    Err++;          
                }else if((jQuery.isNumeric(products_person_max))==false){          
                    jQuery('#products_person_max').addClass('error');
                    Err++;
                }else{
                    jQuery("#products_person_max").removeClass("error");
                }

                if(product_person_min=='') {     
                    jQuery("#product_person_min").addClass("error");
                    Err++;          
                }else if((jQuery.isNumeric(product_person_min))==false){          
                    jQuery('#product_person_min').addClass('error');
                    Err++;
                }else{           
                    jQuery("#product_person_min").removeClass("error");                
                }

                if((products_person_max!= '') && (product_person_min!='')){

                     if(jQuery.isNumeric(products_person_max)!=false && jQuery.isNumeric(product_person_min)!=false){

                        if(parseInt(products_person_max) < parseInt(product_person_min)){    
                                                            
                            jQuery("#products_person_max").addClass("error");
                            jQuery("#product_person_min").addClass("error");
                            jQuery("#products_person_max + label").remove();
                            jQuery("#products_person_max").after('<label class="error">Occupancy max value should be greater than Occupancy min value</label>');
                            Err++;
                        }else{           
                            jQuery("#product_person_min").removeClass("error");
                            jQuery("#products_person_max").removeClass("error");
                            jQuery("#products_person_max + label").remove();
                        }
                  }
                }

                console.log("Err1="+Err);
                
                if(Err>0){

                    if(message_str==''){
                       message_str="message_str"; 
                       scroll_to_id("Rate_type"); 
                    }
                        
                  }  
                  
              /*session date validation*/     
            if(jQuery('#booking_type_date').val()=='INVENTORY'){
                var max = "";
                var min = "";
                var startDate=jQuery('#edit-session-startdate_new_0').val();    
                var untilDate=jQuery('#edit-session-enddate_new_0').val();         

                if(startDate ==''){
                    //alert("Please select start date");
                    jQuery("#edit-session-startdate_new_0").addClass("error");
                    Err++;
                }else{            
                    jQuery("#edit-session-startdate_new_0").removeClass("error");
                }
                if(untilDate ==''){
                    //alert("Please select untill date");
                    jQuery("#edit-session-enddate_new_0").addClass("error");
                    Err++;
                }else{
                    jQuery("#edit-session-enddate_new_0").removeClass("error");
                }

                     if(Err>0){ 
                            if(message_str==''){                   
                                scroll_to_id("Availability_settings");
                                message_str="message_str";
                             } 
                        }           
                
                }  

                /*Opening days and session hour price validation*/ 
                var Opening_days='';
                var arlene1 = [];
                jQuery('.hour_session_content_right').find('.pricetype_options_PER_PERSON_1').find('.amount_perAdult_div').find('input').each(function(){
                    if(jQuery(this).val()!=''){
                        if( (parseInt(jQuery(this).val())<=0) || (Math.floor(jQuery(this).val()) != jQuery(this).val()) || (!jQuery.isNumeric(jQuery(this).val())) || (jQuery(this).val().indexOf('-')>=0) || (jQuery(this).val().indexOf('+')>=0)){
                            jQuery(this).addClass("error");
                            Err++;
                            Opening_days = jQuery(this).closest('.hour_session_content_right').prev('.offer_icon_left').find('input').attr('id');
                             arlene1.push(Opening_days);
                        }else{
                            jQuery(this).removeClass("error");
                        }                        
                    }  else {
                        jQuery(this).removeClass("error");
                    }
                    
                    var child_val =jQuery(this).closest('.amount_perAdult_div').next().find('input').val(); 
                     if(child_val!=''){
                        if( (parseInt(child_val)<=0) || (Math.floor(child_val) != child_val) || (!jQuery.isNumeric(child_val)) || (child_val.indexOf('-')>=0) || (child_val.indexOf('+')>=0)){
                            jQuery(this).closest('.amount_perAdult_div').next().find('input').addClass("error");
                            Err++;
                            Opening_days = jQuery(this).closest('.hour_session_content_right').prev('.offer_icon_left').find('input').attr('id');
                             arlene1.push(Opening_days);
                        }else{
                            jQuery(this).closest('.amount_perAdult_div').next().find('input').removeClass("error");
                        }                        
                    }  else {
                        jQuery(this).closest('.amount_perAdult_div').next().find('input').removeClass("error");
                    }                   

                });               

                console.log("Opening_days_price "+Err);
                    if(Err>0){

                        if(message_str==''){                           
                           scroll_to_id(arlene1[0]); 
                           message_str="message_str"; 
                        }
                        
                  }            


		}else {           

			var product_item_min=jQuery('#product_item_min').val();
			var product_item_max=jQuery('#product_item_max').val();
			var product_item_per_adult_min=jQuery('#product_item_per_adult_min').val();
			var product_item_per_adult_max=jQuery('#product_item_per_adult_max').val();
			var product_item_per_child_min=jQuery('#product_item_per_child_min').val();
			var product_item_per_child_max=jQuery('#product_item_per_child_max').val();

			jQuery('input[class^="amount_peritem"]').each(function(){
				if(jQuery(this).val()==''){
				
					jQuery(this).addClass("error");
					Err++;
				}else if((Math.floor(jQuery(this).val()) != jQuery(this).val()) || (!jQuery.isNumeric(jQuery(this).val())) || (jQuery(this).val().indexOf('-')>=0) || (jQuery(this).val().indexOf('+')>=0)){
				
					jQuery(this).addClass("error");
					Err++;
				}else{
					jQuery(this).removeClass("error");
				}
			});

            
			jQuery('input[class^="item_name"]').each(function(){
				if(jQuery(this).val()==''){
				
					jQuery(this).addClass("error");
					Err++;
				}else{
					jQuery(this).removeClass("error");
				}
			});
			

			if(product_item_min==''){			
				jQuery('#product_item_min').addClass('error');
				Err++;
			}else{
				jQuery("#product_item_min").removeClass("error");
			} 
			if(product_item_max==""){
		
				jQuery("#product_item_max").addClass("error");
				Err++;
			}else{
				jQuery("#product_item_max").removeClass("error");
			} 

            if(product_item_min!='' && product_item_max!=''){  
            
                if(parseInt(product_item_max)<parseInt(product_item_min)){
                  
                    jQuery("#product_item_max").addClass("error");
                    jQuery("#product_item_min").addClass("error");
                    jQuery("#product_item_max + label").remove();
                    jQuery("#product_item_max").after('<label class="error">Occupancy max value should be greater than Occupancy min value</label>');
                    Err++;
                }else{
                    jQuery("#product_item_max").removeClass("error");
                    jQuery("#product_item_min").removeClass("error");
                    jQuery("#product_item_max + label").remove();
                }     
            }

			

			if(product_item_per_adult_min==""){
			
				jQuery('#product_item_per_adult_min').addClass("error");
				Err++;
			}else{
				jQuery('#product_item_per_adult_min').removeClass("error");
			}

			if(product_item_per_adult_max==""){
			
				jQuery('#product_item_per_adult_max').addClass("error");
				Err++;
			}else{
				jQuery('#product_item_per_adult_max').removeClass("error");
			}
            
            if(product_item_per_adult_max!='' && product_item_per_adult_min!=''){ 
             
    			if(parseInt(product_item_per_adult_max) < parseInt(product_item_per_adult_min)){
    				jQuery('#product_item_per_adult_min').addClass("error");
    				jQuery('#product_item_per_adult_max').addClass("error");
                    jQuery("#product_item_per_adult_max + label").remove();
                    jQuery("#product_item_per_adult_max").after('<label class="error">Adult max value should be greater than Adult min value</label>');
    				
    				Err++;
    			}else{
    				jQuery('#product_item_per_adult_min').removeClass("error");
    				jQuery('#product_item_per_adult_max').removeClass("error");
                    jQuery("#product_item_per_adult_max + label").remove();
    			}
            }

			if(product_item_per_child_min==''){
			
				jQuery('#product_item_per_child_min').addClass("error");
				Err++;
			}else{
				jQuery('#product_item_per_child_min').removeClass("error");
			}
			if(product_item_per_child_max==''){

				jQuery('#product_item_per_child_max').addClass("error");
				Err++;
			}else{
				jQuery('#product_item_per_child_max').removeClass("error");
			}

            if(product_item_per_child_min!='' && product_item_per_child_max!=''){ 

    			if(parseInt(product_item_per_child_min)>parseInt(product_item_per_child_max)){
    			
    				jQuery('#product_item_per_child_min').addClass("error");
    				jQuery('#product_item_per_child_max').addClass("error");
                    jQuery("#product_item_per_child_max + label").remove();
                    jQuery("#product_item_per_child_max").after('<label class="error">Child max value should be greater than Child min value</label>');
    				Err++;
    			}else{
    				jQuery('#product_item_per_child_min').removeClass("error");
    				jQuery('#product_item_per_child_max').removeClass("error");
                    jQuery("#product_item_per_child_max + label").remove();
    			}
            }

            //updated 5april2016
           if(parseInt(product_item_per_adult_max)>parseInt(product_item_max)){

                if(product_item_per_adult_max!=='' || product_item_max!=''){
                  
                    jQuery('#product_item_per_adult_max').addClass("error");
                    jQuery("#product_item_per_adult_max + label").remove();
                    jQuery("#product_item_per_adult_max").after('<label class="error">"The max occupancy per item is '+product_item_max+' maximum adult can be '+product_item_max+'</label>');

                     Err++;
                } else {
                     jQuery('#product_item_per_adult_max').removeClass("error");
                     jQuery("#product_item_per_adult_max + label").remove();

                }
         }


            var child_max=parseInt(product_item_max)-1;
            
            if(child_max>=0){

                if((product_item_per_child_min!='' && product_item_per_child_max!='') && (parseInt(product_item_per_child_min)<=parseInt(product_item_per_child_max))){ 

                    //if(parseInt(product_item_per_child_min)<=parseInt(product_item_per_child_max)){

                        if(parseInt(product_item_per_child_max)>child_max){
                           
                            jQuery('#product_item_per_child_max').addClass("error");
                            jQuery("#product_item_per_child_max + label").remove();
                            jQuery("#product_item_per_child_max").after('<label class="error">The max occupancy per item is '+product_item_max+' maximum child can be '+child_max+'</label>');

                            Err++;
                        } else {
                            jQuery('#product_item_per_child_max').removeClass("error");
                            jQuery("#product_item_per_child_max + label").remove();

                        }
                   // }
                    
                } 
            } 
            
            if(product_item_per_child_max!='' && product_item_per_adult_max!=''){

                     var total_occupancy=parseInt(product_item_per_adult_max)+parseInt(product_item_per_child_max);
                     console.log(parseInt(product_item_max));
                     console.log(parseInt(total_occupancy));

                     if(parseInt(product_item_max)<parseInt(total_occupancy)){

                        jQuery('#product_item_per_adult_max').addClass("error");
                        jQuery("#product_item_per_adult_max + label").remove();
                        jQuery("#product_item_per_adult_max").after('<label class="error">Max(Adult+Child) should be less than or equal to maximum occupancy</label>');

                        jQuery('#product_item_per_child_max').addClass("error");

                         Err++;
                         
                     } else {

                         jQuery('#product_item_per_adult_max').removeClass("error");   
                         jQuery('#product_item_per_child_max').removeClass("error");
                         jQuery("#product_item_per_adult_max + label").remove();                         

                     }                                

            }  

            if(product_item_per_child_min!='' && product_item_per_adult_min!=''){

                     var min_occupancy=parseInt(product_item_per_adult_min)+parseInt(product_item_per_child_min);
                     console.log('product_item_min'+parseInt(product_item_min));
                     console.log('min_occupancy'+parseInt(min_occupancy));

                     if(parseInt(min_occupancy)<parseInt(product_item_min)){

                        jQuery('#product_item_per_adult_min').addClass("error");
                        jQuery("#product_item_per_adult_min + label").remove();
                        jQuery("#product_item_per_adult_min").after('<label class="error">Min(Adult+Child) should be greated than or equal to minimum occupancy</label>');

                        jQuery('#product_item_per_child_min').addClass("error");

                         Err++;
                         
                     } else {

                         jQuery('#product_item_per_adult_min').removeClass("error");   
                         jQuery('#product_item_per_child_min').removeClass("error");
                         jQuery("#product_item_per_adult_min + label").remove();                         

                     }                                

            }              
                    
            
             if(Err>0){

                    if(message_str==''){
                       message_str="message_str"; 
                       scroll_to_id("Rate_type"); 
                    }
                        
                  }  
                  
              /*session date validation*/     
            if(jQuery('#booking_type_date').val()=='INVENTORY'){
                var max = "";
                var min = "";
                var startDate=jQuery('#edit-session-startdate_new_0').val();    
                var untilDate=jQuery('#edit-session-enddate_new_0').val();         

                if(startDate ==''){
                    //alert("Please select start date");
                    jQuery("#edit-session-startdate_new_0").addClass("error");
                    Err++;
                }else{            
                    jQuery("#edit-session-startdate_new_0").removeClass("error");
                }
                if(untilDate ==''){
                    //alert("Please select untill date");
                    jQuery("#edit-session-enddate_new_0").addClass("error");
                    Err++;
                }else{
                    jQuery("#edit-session-enddate_new_0").removeClass("error");
                }

                     if(Err>0){ 
                            if(message_str==''){                   
                                scroll_to_id("Availability_settings");
                                message_str="message_str";
                             } 
                        }           
                
                } 
                
                /*Opening days and session hour price validation*/ 
                var Opening_days='';
                var arlene1 = [];
                jQuery('.hour_session_content_right').find('.pricetype_options_PER_ITEM_1').find('.input-group').find('input').each(function(){
                    if(jQuery(this).val()!=''){

                        if( (parseInt(jQuery(this).val())<=0) ||(Math.floor(jQuery(this).val()) != jQuery(this).val()) || (!jQuery.isNumeric(jQuery(this).val())) || (jQuery(this).val().indexOf('-')>=0) || (jQuery(this).val().indexOf('+')>=0)){
                            jQuery(this).addClass("error");
                            Err++;
                            Opening_days = jQuery(this).closest('.hour_session_content_right').prev('.offer_icon_left').find('input').attr('id');
                            arlene1.push(Opening_days);
                        }else{
                            jQuery(this).removeClass("error");
                        }
                        
                    }else {
                            jQuery(this).removeClass("error");
                    }   
                    

                });


                console.log("Opening_days_price "+Err);
                    if(Err>0){

                        if(message_str==''){                           
                           scroll_to_id(arlene1[0]); 
                           message_str="message_str"; 
                        }
                        
                     }               


		}

        //check opening days selected 
                var arlene1 = [];
                jQuery('.sessions_tabs_menu').each(function(){
                  days_opning=0;  
                  Opening_days='sessions_tabs_menu_'+jQuery(this).closest('.sessions_tabs_menu').attr('data-id');

                  jQuery(this).find('li').each(function(){

                        if(jQuery(this).find(".css-checkbox").prop( "checked")==true){                     
                            days_opning=1;                     
                            return false; 
                        }

                   });                  
                 
                 if(days_opning==0){
                  jQuery('.'+Opening_days).addClass('opening_error');
                  arlene1.push(Opening_days);
                   Err++;  
                  } else {
                  jQuery('.'+Opening_days).removeClass('opening_error');
                  }

                });
                console.log('arlene1'+arlene1);

                if(Err>0){

                    if(message_str==''){                           
                        jQuery('html, body').animate({
                        scrollTop: jQuery("."+arlene1[0]).offset().top - 200
                        }, 2000);
                       message_str="message_str"; 
                    }
                    
                 }

        //check timepicker has value
                    var arlene1 = [];                   

                    jQuery('.session_timepicker').each(function(index,value){ 

                    tt=jQuery(this).attr('data-val');
                        if(jQuery('#session_startTime_'+tt).html()=='Select time'){

                             jQuery(this).closest('.offer_icon_left').addClass("error");                             
                             session_timepicker = 'session_startTime_'+tt;
                             arlene1.push(session_timepicker);
                             Err++;  
                        }
                              

                    });
                    
                    if(Err>0){
                            if(message_str==''){   
								jQuery('html, body').animate({
								scrollTop: jQuery("#"+arlene1[0]).offset().top - 200
								}, 2000);
                               message_str="message_str";
                            }
                    } 

                /*seasonal price validation*/
                if(jQuery.trim(Price_type)=='PER_PERSON') {

                style_a=''; style_c='';
                    if(jQuery('.product_adult_child').length==2){
                         style_a="exists";
                         style_c="exists";

                        } else{

                        if(jQuery('.product_adult_child').val()=='adult'){  

                            style_a="exists";
                            style_c="";

                        } else {
                            style_a="";
                            style_c="exists";
                        }

                    }
                   var arlene1 = [];
                   jQuery('.session_from_dtpicker').each(function(){ 

                    var p=jQuery(this).attr('data-val');

                    if(jQuery('#session_from_'+p).val()){
                  

                    var rate_adult=jQuery(this).closest('.seasonnal_pricing').children(':nth-child(3)').find('.amount_perAdult_div input').val();
                    var rate_child=jQuery(this).closest('.seasonnal_pricing').children(':nth-child(3)').find('.amount_perChild_div input').val();
                       if(style_a=="exists"){ 
                         if( (rate_adult=='') || (parseInt(rate_adult)<=0) || (Math.floor(rate_adult) != rate_adult) || (!jQuery.isNumeric(rate_adult)) || (rate_adult.indexOf('-')>=0) || (rate_adult.indexOf('+')>=0)){                
                            jQuery(this).closest('.seasonnal_pricing').children(':nth-child(3)').find('.amount_perAdult_div input').addClass('error');
                            Err++;
                            Seasonal_days = 'session_from_'+p;
                            arlene1.push(Seasonal_days);

                        }else {
                            jQuery(this).closest('.seasonnal_pricing').children(':nth-child(3)').find('.amount_perAdult_div input').removeClass('error');
                        }
                      }
                      if(style_c=="exists"){  
                        if( (rate_child=='') || (parseInt(rate_child)<=0)|| (Math.floor(rate_child) != rate_child) || (!jQuery.isNumeric(rate_child)) || (rate_child.indexOf('-')>=0) || (rate_child.indexOf('+')>=0)){ 
                            jQuery(this).closest('.seasonnal_pricing').children(':nth-child(3)').find('.amount_perChild_div input').addClass('error');
                            Err++;
                            Seasonal_days = 'session_from_'+p;
                            arlene1.push(Seasonal_days);
                        }else {
                            jQuery(this).closest('.seasonnal_pricing').children(':nth-child(3)').find('.amount_perChild_div input').removeClass('error');
                        } 
                      }

                    }
                        

                    });
                    console.log('arlene1 '+arlene1);

                    if(Err>0){

                            if(message_str==''){                        
                               scroll_to_id(arlene1[0]); 
                               message_str="message_str";
                            }
                                
                     } 

                }
                else {
                    
               var arlene1 = [];
               jQuery('.session_from_dtpicker').each(function(){ 
                var p=jQuery(this).attr('data-val');

                if(jQuery('#session_from_'+p).val()){       
                              
                     var rate_item=jQuery(this).closest('.select_date_from').closest('.remove_this_seasonal').find('.sessional_price_per_item').find('.rate_per_item').val();

                     if( (rate_item=='') || (parseInt(rate_item)<=0) || (Math.floor(rate_item) != rate_item) || (!jQuery.isNumeric(rate_item)) || (rate_item.indexOf('-')>=0) || (rate_item.indexOf('+')>=0)){
                    
                            jQuery(this).closest('.select_date_from').closest('.remove_this_seasonal').find('.sessional_price_per_item').find('.rate_per_item').addClass("error");
                            Err++;
                            Seasonal_days = 'session_from_'+p;
                            arlene1.push(Seasonal_days);
                    }  else {
                        jQuery(this).closest('.select_date_from').closest('.remove_this_seasonal').find('.sessional_price_per_item').find('.rate_per_item').removeClass('error');
                    }      
                                
                  }            
                    

                });

                if(Err>0){

                        if(message_str==''){                        
                           scroll_to_id(arlene1[0]); 
                           message_str="message_str";
                        }
                            
                 } 
                             
              }
		
		if(Err>0){
			return false;
		}else{
          console.log("sucess");
		    /* Create session popup form Serialize */
				mySessionForm =jQuery('#create_session_id').serialize();
				jQuery('#session_data_value').val(mySessionForm);
			/* End Create session popup form Serialize */
			jQuery('.eventpopup_lightbox').fadeOut(800); 

            jQuery('.repeat_session_Hourly_HTML').find('.hours_row').each(function(){

            if(jQuery(this).find('.frominput')){
            jQuery(this).find('.frominput').val(jQuery('#edit-session_starttime').val());
            jQuery(this).find('.frominput').prop('disabled', true);            
            }

            if(jQuery(this).find('.toinput')){
            jQuery(this).find('.toinput').val(jQuery('#edit-session_endtime').val());
            jQuery(this).find('.toinput').prop('disabled', true);
            }

            });
          

			return true;
		}
		/* End Create Session Popup Custom Form Validations */
	});
	/* End Session Popup Validations And serialization of all values */
	if(mySessionForm){
	console.log(mySessionForm);
	}
}); /* End Document dot Ready Function */


function calendar_form_validate(){

		var Err=0;
		
		var arlene1 = [];
		if(jQuery('#24_hour_offer_check').prop('checked')==true){
			
			jQuery('input[class^="offer_24_hour_offer_Data_date"]').each(function(){
				var current_val=jQuery(this).val();
				if(jQuery(this).val()==''){
					jQuery(this).addClass("error");
                    arlene1.push(jQuery(this).attr('id'));
					Err++;
				}else{
					jQuery(this).removeClass("error");
				}
			});
			jQuery('input[class^="offer_24_hour_offer_Data_price"]').each(function(){
				if( (jQuery(this).val()=='') || (Math.floor(jQuery(this).val()) != jQuery(this).val()) || (!jQuery.isNumeric(jQuery(this).val())) || (jQuery(this).val().indexOf('-')>=0) || (jQuery(this).val().indexOf('+')>=0) ){
					jQuery(this).addClass("error");
                    arlene1.push(jQuery(this).attr('id'));
					Err++;
				
				}else{
					jQuery(this).removeClass("error");
				}
			});
            console.log('error_reach '+Err);
            var inputs = jQuery('input[class^="offer_24_hour_offer_Data_date"]');
            inputs.filter(function(i,el){
                return inputs.not(this).filter(function() {
                    console.log('this.value '+this.value);
                    console.log('el.value '+el.value);
                    if(this.value==''){
                        jQuery(this).addClass("error");
                        jQuery(this).next().remove();
                        arlene1.push(jQuery(this).attr('id'));
                    }else if(this.value === el.value){
                        Err++;
                        jQuery(this).addClass("error");
                        jQuery(this).next().remove();
                        jQuery(this).after('<label class="error">Date can not be same</label>');
                        arlene1.push(jQuery(this).attr('id'));
                        return this.value === el.value;
                    }else{
                        jQuery(this).removeClass('error');
                        jQuery(this).next().remove();
                    }
                    return this.value === el.value;
                }).length !== 0;
                
            }).addClass('error');
            console.log('error_reach1 '+Err);
             if(Err>0){
                  
                    jQuery('html, body').animate({
                    scrollTop: jQuery("#"+arlene1[0]).offset().top - 200
                    }, 2000); 
                    //return false;
              } 
			
			console.log('In 24 hour validate condition');		
		}
		if(jQuery('#last_minutes_check').prop('checked')==true){
			console.log('In last_minutes_check');		
			var timeval=jQuery('#edit-last-minutes-time-value').val();
			var timetype=jQuery('#edit-last-minutes-time-type').val();
			if(timeval == ''){
		        jQuery('#edit-last-minutes-time-value').addClass('error');
				Err++;
			}else{
				jQuery('#edit-last-minutes-time-value').removeClass('error');
			}
			if(timeval != ''){			
				if(timetype=='hour'){
					timeval=parseInt(timeval);
					if(timeval> 144){
						jQuery('#edit-last-minutes-time-value').addClass('error');
						jQuery('#edit-last-minutes-time-value').parent().find('span').remove();
						jQuery('#edit-last-minutes-time-value').parent().append('<span style="color:red;">Time cannot be more then 6 Days (144 Hours).</span>');
						Err++;
					}else if( (jQuery('#edit-last-minutes-time-value').val().indexOf('-')>=0) || (jQuery('#edit-last-minutes-time-value').val().indexOf('+')>=0) ){
                        jQuery('#edit-last-minutes-time-value').addClass('error');
                        jQuery('#edit-last-minutes-time-value').parent().find('span').remove();
                        Err++;
                    }else{
						jQuery('#edit-last-minutes-time-value').removeClass('error');
						jQuery('#edit-last-minutes-time-value').parent().find('span').remove();
					}
				}else{
					timeval=parseInt(timeval);
					if(timeval>6){
						jQuery('#edit-last-minutes-time-value').addClass('error');
						jQuery('#edit-last-minutes-time-value').parent().find('span').remove();
						jQuery('#edit-last-minutes-time-value').parent().append('<span style="color:red;">Time cannot be more then 6 Days (144 Hours).</span>');
						Err++;
					}else if( (jQuery('#edit-last-minutes-time-value').val().indexOf('-')>=0) || (jQuery('#edit-last-minutes-time-value').val().indexOf('+')>=0) ){
                        jQuery('#edit-last-minutes-time-value').addClass('error');
                        jQuery('#edit-last-minutes-time-value').parent().find('span').remove();
                        Err++;
                    }else{
						jQuery('#edit-last-minutes-time-value').removeClass('error');
						jQuery('#edit-last-minutes-time-value').parent().find('span').remove();
					}
				}
			}
			var price=jQuery('#edit-last-minutes-price-value').val();
            if( (parseInt(price)<=0) ||(Math.floor(price) != price) || (!jQuery.isNumeric(price)) || (price.indexOf('-')>=0) || (price.indexOf('+')>=0)){
                jQuery('#edit-last-minutes-price-value').addClass("error");
                
                 Err++;
            }else {
             jQuery('#edit-last-minutes-price-value').removeClass("error");
            }
		}
		
		if(jQuery('#early_birds_check').prop('checked')==true){
			console.log('In early_birds_check');	
			var timevalearly=jQuery('#edit-early-birds-time-value').val();
			var timetypeearly=jQuery('#edit-early-birds-time-type').val();
			if(timevalearly == ''){
				jQuery('#edit-early-birds-time-value').addClass('error');
                jQuery('html, body').animate({
                scrollTop: jQuery("#Special_offers").offset().top
                }, 2000); 
				Err++;
			}else{
				jQuery('#edit-early-birds-time-value').removeClass('error');
                jQuery('#edit-early-birds-time-value').parent().find('span').remove();
				
			}
			if(timevalearly != ''){	
				console.log(timetypeearly);			
				if(timetypeearly=='day'){
					timevalearly=parseInt(timevalearly);	
					if(timevalearly < 7){
						jQuery('#edit-early-birds-time-value').addClass('error');
						jQuery('#edit-early-birds-time-value').parent().find('span').remove();
						jQuery('#edit-early-birds-time-value').parent().append('<span style="color:red;">Time will be greater then 7 Days in early birds offer.</span>');
                        jQuery('html, body').animate({
                        scrollTop: jQuery("#Special_offers").offset().top
                        }, 2000); 
						Err++;
					} else if( (jQuery('#edit-early-birds-time-value').val().indexOf('-')>=0) || (jQuery('#edit-early-birds-time-value').val().indexOf('+')>=0) ){
                        jQuery('#edit-early-birds-time-value').addClass('error');
                        jQuery('#edit-early-birds-time-value').parent().find('span').remove();
                        jQuery('html, body').animate({
                        scrollTop: jQuery("#Special_offers").offset().top
                        }, 2000); 
                        Err++;
                    }else{
						jQuery('#edit-early-birds-time-value').removeClass('error');
						jQuery('#edit-early-birds-time-value').parent().find('span').remove();
					}
				}
			}
			var price=jQuery('#edit-early-birds-price-value').val();
			if( (parseInt(price)<=0) ||(Math.floor(price) != price) || (!jQuery.isNumeric(price)) || (price.indexOf('-')>=0) || (price.indexOf('+')>=0)){
					jQuery('#edit-early-birds-price-value').addClass("error");
                    jQuery('html, body').animate({
                    scrollTop: jQuery("#Special_offers").offset().top
                    }, 2000); 
					Err++;
			}else {
                jQuery('#edit-early-birds-price-value').removeClass("error");
            }
		}
		if(Err>0){
			return false;
		}else{
			return true;
		}
		
	}
function validate_lastminutetime(){
return true;
var settings = jQuery("#product-calendar-form").validate().settings;
var time_type=jQuery('select[name=last_minutes_time_type]').val();
if(time_type=='day'){
	// Modify validation settings
	    jQuery.extend(settings, {
	    	rules: {
					last_minutes_time_value: {
					required: true, 
					digits: true,
					max:6
				},
			},
			
	    });
}else{

	jQuery.extend(settings, {
	    	rules: {
					last_minutes_time_value: {
					required: true, 
					digits: true,
					max:144
				},
			},
			
	    });
}
	jQuery("#product-calendar-form").valid();

}

/* Updated 17-02-2016 */
//view session data script starts here//
jQuery(document).ready(function() {   
    jQuery(".session_view_link").click(function(){
        
        var lis_sis = jQuery(this).attr('ses-data').split('/');        

        if (lis_sis != "")
            {           
             jQuery("#load-screen").css('display','block');

                jQuery.ajax({
                    url: $baseUrl + "/product/geteachsessiondata",
                    type: "POST",
                    data: {'listing_id':lis_sis[0], 'ses_id' : lis_sis[1]},
                    success: function (res)
                    {   
                                               
                    var priceArray = jQuery.parseJSON(res);  
                    var data =""; var person_p_i="" ;var price_p_i="";                        

                    var Start_Time = priceArray.startTime;
                    var Start_Time =Start_Time.split(':');
                    var Start_Time = hours_am_pm(Start_Time[0]+Start_Time[1]);

                    var End_Time = priceArray.endTime;
                    var End_Time =End_Time.split(':');
                    var End_Time = hours_am_pm(End_Time[0]+End_Time[1]);
                    var session_date='';
                    if(priceArray.startDate==null || priceArray.endRepeatDate==null){
                        session_date="No date required";
                    }else {
                       session_date=priceArray.startDate+'/'+priceArray.endRepeatDate;
                    }
                    

                    var i =1;    
                     jQuery.each(priceArray.pricingData,function(index,value){                           

                     if(value.price_type=="PER_PERSON") {  
                         person_p_i +=  value.price_option_type.charAt(0).toUpperCase()+value.price_option_type.substr(1)+'</br>';

                      } else {
                        person_p_i +=  value.label+'</br>';   
                      }                                          
                      price_p_i += value.price+'</br>';
                      
                    i++;});                    

                   data += "<thead>"+"<tr>"+"<th>Start date/End date</th>"+"<th>Start time</th>"+"<th>End time</th>";
                   data += " <th>Person type/Item name</th>"+"<th>Price($)</th>"+"</tr>"+"</thead>"; 

                    if(priceArray['pricingData'][0]['price_type']=="PER_ITEM") {
                         priceArray['pricingData'][0]['price_type'] = "PER ITEM";    
                         
                    } else {
                        priceArray['pricingData'][0]['price_type'] = "PER PERSON";    
                    }  
                   
                    data += "<tr>"+"<td>"+session_date+"</td>"+"<td>"+Start_Time+"</td>"+"<td>"+End_Time+"</td>";    

                    data += "</td>"+"<td>"+person_p_i+"</td>"+"<td>"+price_p_i+"</td>"+"</tr>";       

                    jQuery(".edit_date_heading").html("view Session data");
                    jQuery(".session_pricing_data").html(data);
                    jQuery('.individual_session_popup').fadeIn(500);
                    jQuery("#load-screen").css('display','none');

                    }
                });
            }  
    });

//End session data script here//
/* Updated 17-02-2016 ,Updated 18-02-2016, Updated 19-02-2016 */
//view session edited date script starts here//
  jQuery(".session_editdats_link").click(function(){
        
        var lis_sis = jQuery(this).attr('ses-data').split('/');        

        if (lis_sis != "")
            {           
             jQuery("#load-screen").css('display','block');

                jQuery.ajax({
                    url: $baseUrl + "/product/getediteddates",
                    type: "POST",
                    data: {'listing_id':lis_sis[0], 'ses_id' : lis_sis[1]},
                    success: function (res)
                    { 

                     if(res == 'null') {
                        alert("No Edited date found in this session");
                        jQuery("#load-screen").css('display','none');
                        return false;
                      }                                                
                    var priceArray = jQuery.parseJSON(res);  
                    var editdate_data =""; 

                    editdate_data += "<thead>"+"<tr>"+"<th>Edited date</th>"+"<th>Start time</th>"+"<th>End time</th>"+" <th>Price type</th>"+" <th>Person type/Item name</th>"+"<th>Price($)</th>"+"</tr>"+"</thead>";
                    jQuery.each(priceArray,function(index,value) {

                    var pricetype_p_i ="";var person_p_i = ""; var price_p_i = "";
                       
                    var Start_Time = value.start_time;
                    var Start_Time =Start_Time.split(':');
                    var Start_Time = hours_am_pm(Start_Time[0]+Start_Time[1]);
                   
                    var End_Time = value.end_time;
                    var End_Time =End_Time.split(':');
                    var End_Time = hours_am_pm(End_Time[0]+End_Time[1]);

                    editdate_data += "<tr>"+"<td>"+value.edited_date+"</td>"+"<td>"+Start_Time+"</td>"+"<td>"+End_Time+"</td>";                   
                    var i=1;
                    jQuery.each(value.pricingData,function(index,value){                     
                      if(value.price_type=="PER_PERSON") {  
                       person_p_i +=  value.price_option_type.charAt(0).toUpperCase()+value.price_option_type.substr(1)+'</br>';
                       pricetype_p_i =  "PER PERSON"; 
                      } else {                      
                       person_p_i +=  value.label+'</br>';
                        pricetype_p_i =  "PER ITEM";  
                      } 
                                         
                      price_p_i += value.price+'</br>';

                    });                                  


                    editdate_data += "<td>"+pricetype_p_i+"</td>"+"<td>"+person_p_i+"</td>"+"<td>"+price_p_i+"</td>"+"</tr>";  

                    });   
                                     
                    jQuery(".edit_date_heading").html("View Edited Dates");               
                    jQuery(".session_pricing_data").html(editdate_data);
                    jQuery('.individual_session_popup').fadeIn(500);
                    jQuery("#load-screen").css('display','none');

                    }
                });
            }  
    });

//end session edited date script here//
//end Updated 18-02-2016 ,end Updated 19-02-2016
jQuery('.closepopup').click(function(){
    jQuery('.individual_session_popup').fadeOut(800);
});

});

/* End Updated 17-02-2016 */

</script>
<?php } 
/* End scripts of New pricing and calendar section */
?>
<script type="text/javascript">
jQuery(document).on('mouseenter','#drop4',function (){

console.log('unread_counter backend');
		jQuery.ajax({
            url: $baseUrl + '/ajax/unread_counter',
            type: 'post',    
            async:true,         
            beforeSend: function () {
               // preLoading('show', 'load-screen_details');
            },
              success: function (data) {
               //jQuery('#load-screen').hide();               
                /*if(data){
                var html = '<span class="count">'+data+'</span>';

                jQuery(".nav-dropdown-heading").text('Notifications('+data+')');
                jQuery('.notification_block').html(html);

                }else{
                jQuery('.notification_block').html('');        
                jQuery(".nav-dropdown-heading").text('Notifications');      
                }*/

                jQuery('.notification_block').html('');        
                jQuery(".nav-dropdown-heading").text('Notifications');    
            }
        });
});


jQuery(document).ready(function(){
    //1 minute interval for notification


    setInterval(function() { 
        getNotifications();
    },60000);
    
   
});

getNotifications =  function(){  
console.log("backend");  
    jq.ajax({
        url: $baseUrl + '/advice/notification/',
        type: 'post',       
        data: {notification:1},
        async:true, 
        beforeSend: function () {
           
        },
        success: function (data) {
            // var res = jQuery.parseJSON(data);
            // var notificationCount = (res.count>0)? res.count : '';
            // jQuery('#_my_notifications_badge').html(notificationCount);
            var res = jQuery.parseJSON(data);
            var notificationCount = (res.count>0)? res.count : '';
            var html = '<span class="count" id="_my_notifications_badge">'+notificationCount+'</span>';
            if(res.count>0)
            {
            jQuery('.notification_block').html(html);
            //jQuery('.notification_block').text(notificationCount);
            jQuery(".nav-dropdown-heading").text('Notifications('+notificationCount+')');
            } else {
                  jQuery('.notification_block').html('');

            }

            jQuery('#_my_notifications_badge2').text(notificationCount);
            jQuery('#noti_ajax_data').html(res.html);
        }
    });
}


</script>

<!-- Updated 12-02-2016 -->

<?php //Session Edit Code
if(strpos($_SERVER['REQUEST_URI'],'product/session/edit') !== false){	

$time_range=array();
$listId=arg(3);

$scheduleSessionData = getScheduleSessionData($listId);
$availableDate = getAvailbaleDatesForCal($scheduleSessionData);
$finalDates=$availableDate;

$time_ranges='';
if($scheduleSessionData){    
$time_ranges=unserialize($scheduleSessionData[0]['startTime']);   
}

if($time_ranges){

    foreach ($time_ranges as $key => $time_range) {
        
        $new_time_range=''; $main_time_range='';
        foreach ($time_range['Time'] as $time_rang) {
                    $new_time_range[]=strtotime($time_rang);
                }         
       sort($new_time_range);

      
       foreach ($new_time_range as $new_time_rang) {
                    $main_time_range[]=date("g:i A",$new_time_rang); 
        }

        $time_ranges[$key]['Time'] =$main_time_range;
    }
}
$time_range=$time_ranges;

?>

	<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/js/new_calender_custom.js"></script>

	<link rel="stylesheet" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme','gloobers_new'); ?>/css/fullcalendar.css" />

	<script type="text/javascript" src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme','gloobers_new'); ?>/js/fullcalendar.min.js"></script>
	<script type="text/javascript">
			var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 1; //January is 0!
            var yyyy = today.getFullYear();
			
            if (dd < 10) {
                dd = '0' + dd
            }
            if (mm < 10) {
                mm = '0' + mm
            }
            today = yyyy + '/' + mm + '/' + dd;
		/* Full Calendar */	
		var availableDates = new Array();
        availableDates = <?php echo  json_encode($finalDates['dates']);?>;
        all_array = <?php echo  json_encode($finalDates);?>;
        //alert(all_array['NO_DATE']);
        if(all_array['NO_DATE']=='NO_DATE'){
           availableDates=''; 
        }

		jsonObj = [];
		jQuery.each(availableDates, function( index, value ){
			item = {}
			item ["title"] = value;
			item ["start"] = value;
			jsonObj.push(item);
		});
		console.log(jsonObj);
		jQuery('#calendar_new').fullCalendar({
				header: {
					left: 'prev,next',
					center: 'title',
					right: ''
				},
				defaultDate: availableDates[0],
				editable: true,
				eventLimit: true,
				//events: jsonObj
				
		}); /* End Full Calendar */
		jQuery(document).ready(function(){

          function get_calendar_dates(){

            var time_range_data = new Array();
            time_range_data = <?php echo  json_encode($time_range);?>;
            availableDates_new = <?php echo  json_encode($finalDates);?>;
            
            jQuery('.fc-day-number').each(function(){

                var dateEach=jQuery(this).attr('data-date');

                week_day=new Date(dateEach).getDay();

                var weekdays = new Array();
                weekdays[0] = "Sunday";
                weekdays[1] = "Monday";
                weekdays[2] = "Tuesday";
                weekdays[3] = "Wednesday";
                weekdays[4] = "Thursday";
                weekdays[5] = "Friday";
                weekdays[6] = "Saturday";
                //alert(availableDates);
                
                var in_array_exists=jQuery.inArray(dateEach,availableDates);
               
                if(availableDates==''){
                   
                    var inputDate = new Date(dateEach);
                    var dd = inputDate.getDate();
                    var mm = inputDate.getMonth() + 1; //January is 0!
                    var yyyy = inputDate.getFullYear();

                    if (dd < 10) {
                    dd = '0' + dd
                    }
                    if (mm < 10) {
                    mm = '0' + mm
                    }
                    inputDate = yyyy + '-' + mm + '-' + dd;                    
                   
                    if(inputDate>=availableDates_new['dates'][0] && (jQuery.inArray(new Date(inputDate).getDay(),availableDates_new['enable_days'])!== -1)){  

                     var edited_date=jQuery(this).html();
                                            
                     var str=strnew=left_time_count=add_time_row='';
                                            
                        jQuery.each(time_range_data,function(index,day){                                                                                                       

                         if(weekdays[week_day]==index){  

                            y=day.Time;
                                 
                            if(new Date(dateEach) <= new Date()){ 

                                    jQuery.each(y,function(time_index,time_val){ 

                                    var dt = new Date(); var cr_time = dt.getTime();
                                    var t = new Date((dt.getMonth() + 1) + "/" + dt.getDate() + "/" + dt.getFullYear() + " " + time_val);
                                    time = t.getTime(); 
                                                                          
                                    if (time<cr_time) { 

                                        y = jQuery.grep(y, function(tt) {
                                        return tt != time_val;
                                        });
                                    } 
                                    
                                   }); 
                                  
                               } 


                              if(y.length>0) {  
                                var i=1;   
                                jQuery.each(y,function(index2,value){  
                                 
                                    if(i<=2){
                                        str +='<span class="get_time_click">'+value+'</span>';
                                    } else {                                                            
                                        strnew +='<span class="get_time_click">'+value+'</span>';
                                        left_time_count=y.length-2;
                                        
                                        add_time_row='<a class="click_for_time">+'+left_time_count+' more</a>';                        

                                    }  
                                 i++;}); 
                               } else{
                                   add_time_row='<a href="javascript:void(0)" class="no_session">No session</a>';             
                                }                                      
                                                         
                         }                           

                     });

                        var add_newrow='<div class="add_time_row" style="display:none"><div class="close_add_time_row">x</div><div class="add_strnew">'+strnew+'</div></div>';     
                        
                        jQuery(this).html(edited_date+str+add_time_row+add_newrow);
                        
                    }  else {
                        
                        jQuery(this).addClass('disable_date');
                    } 
                    

                } else {
                    
                    if(parseInt(in_array_exists)>=0){   
                            
                        var edited_date=jQuery(this).html();  
                        var str=strnew=left_time_count=add_time_row='';

                        jQuery.each(time_range_data,function(index,day){ 

                         day.Time.sort();                                                                                   

                         if(weekdays[week_day]==index){  

                            y=day.Time;
                                 
                            if(new Date(dateEach) <= new Date()){ 

                                    jQuery.each(y,function(time_index,time_val){ 

                                    var dt = new Date(); var cr_time = dt.getTime();
                                    var t = new Date((dt.getMonth() + 1) + "/" + dt.getDate() + "/" + dt.getFullYear() + " " + time_val);
                                    time = t.getTime(); 
                                                                          
                                    if (time<cr_time) { 

                                        y = jQuery.grep(y, function(tt) {
                                        return tt != time_val;
                                        });
                                    } 
                                    
                                   }); 
                                  
                               } 

                              if(y.length>0) {    
                               
                                var i=1;    
                                jQuery.each(y,function(index2,value){  
                                 
                                    if(i<=2){
                                        str +='<span class="get_time_click">'+value+'</span>';
                                    } else {                                                            
                                        strnew +='<span class="get_time_click">'+value+'</span>';
                                        left_time_count=y.length-2;
                                        
                                        add_time_row='<a class="click_for_time">+'+left_time_count+' more</a>';                        

                                    }  
                                 i++;}); 

                                 } else{
                                   add_time_row='<a href="javascript:void(0)" class="no_session">No session</a>';             
                                }                       
                         }                           

                     });

                        var add_newrow='<div class="add_time_row" style="display:none"><div class="close_add_time_row">x</div><div class="add_strnew">'+strnew+'</div></div>';     
                        
                        jQuery(this).html(edited_date+str+add_time_row+add_newrow);
                    }  else {
                        
                        jQuery(this).addClass('disable_date');
                    } 
                }
                               

            });

            jQuery('.click_for_time').on('click',function(){
            jQuery('.add_time_row').hide();       
            jQuery(this).closest('.fc-day-number').find('.add_time_row').show();

            }); 

            jQuery('.close_add_time_row').on('click',function(){
            jQuery(this).closest('.add_time_row').hide();

            }); 
              

          }

       /*call session date get function*/   

        get_calendar_dates();			
		
		jQuery('.fc-prev-button').hide();
		jQuery(document).on('click','.fc-next-button', function(){
		
			var today = new Date(availableDates[0]);
            var dd = today.getDate();
            var mm = today.getMonth(); 
			var YY = today.getFullYear(); 
			
			var selectDate=new Date('1 '+jQuery('.fc-center').find('h2').html());
			var selectDateM = selectDate.getMonth(); 
			var selectDateY = selectDate.getFullYear(); 
			jQuery('.fc-prev-button').show();
			if(parseInt(selectDateY)>parseInt(YY)){
				//Show Prev Button
			
			}
			if(parseInt(selectDateY)==parseInt(YY)){
				//Show Prev Button
			}
			get_calendar_dates();
		});
	
		jQuery(document).on('click','.fc-prev-button', function(){
		
			var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth(); 
			var YY = today.getFullYear(); 
			
			var selectDate=new Date('1 '+jQuery('.fc-center').find('h2').html());
			var selectDateM = selectDate.getMonth(); 
			var selectDateY = selectDate.getFullYear(); 
			
			if(parseInt(selectDateY)>parseInt(YY)){
                jQuery('.fc-prev-button').show();                
            } else {
                jQuery('.fc-prev-button').hide();
            }
            
            if(parseInt(selectDateY)==parseInt(YY)){
                if(parseInt(selectDateM)>parseInt(mm)){
                    jQuery('.fc-prev-button').show();
                      
                }else{                    
                    jQuery('.fc-prev-button').hide();
                        
                }
            }
			get_calendar_dates();			
		});

        jQuery(document).on('click','.get_time_click', function() { 
         //jQuery(document).on('click','.fc-day, .fc-day-number', function() { 

            jQuery("#load-screen").css('display','block');
            var timestamp=jQuery(this).closest('.fc-day-number').attr('data-date'); 
            var edited_time=jQuery(this).html();

             jQuery( "[name='adult_price']" ).val('');
             jQuery( "[name='child_price']" ).val('');
             jQuery( "[name='item_price']" ).val('');

                  
            if (timestamp != "")
            {   
          
                jQuery.ajax({
                    url: $baseUrl + '/experience/ajax/getNewPricingData',
                    type: "POST",                   
                    data: {selected_booking_time:edited_time,selected_booking_date:timestamp,listing_id:<?php echo arg(3); ?>},

                    success: function (result)
                    {   
                    
                    var data = jQuery.parseJSON(result);
                    var status=data.status;
                    var mydata=data.data;  
                    var priceDetail=data.pricingDetail;  
                    var priceType='';
                     console.log(data);    
                    jQuery.each(mydata, function( index, value ) {
                      priceType=value.price_type;
                     if(priceType == 'PER_PERSON'){ //Per person   
                        
                            var trevellerType=value.price_option_type;

                            if(trevellerType=='Adult'){
                                jQuery( "[name='adult_price']" ).val(value.price);
                            }else {
                                jQuery( "[name='child_price']" ).val(value.price);
                            }
                            console.log(jQuery( "[name='child_price']" ).val());

                           //if seasonal price added//
                            if(status=='sessional'){

                                if(trevellerType=='Adult'){
                                   
                                    jQuery( "[name='adult_price']" ).val(priceDetail.rate_per_adult);
                                }else {
                                    
                                    jQuery( "[name='child_price']" ).val(priceDetail.rate_per_child);
                                }
                             }

                            jQuery('.person_type_input').show();                               
                            jQuery('.item_type_input').remove();

                        }  else {

                            jQuery( "[name='item_price']" ).val(value.price);                          

                            if(status=='sessional'){
                                jQuery( "[name='item_price']" ).val(priceDetail.rate_per_item);                                 
                            }
                            
                            jQuery('.person_type_input').remove();
                            jQuery('.item_type_input').show();
                        }                 

                    });

                       if(priceType == 'PER_PERSON'){

                            if(jQuery( "[name='adult_price']" ).val()==''){

                                jQuery( "[name='adult_price']" ).closest('.person_type_input').remove();
                            }

                            if(jQuery( "[name='child_price']" ).val()==''){

                                 jQuery( "[name='child_price']" ).closest('.person_type_input').remove();
                            }
                        }

                        if(data.status_checked=='True'){
                            jQuery( "[name='price_checkbox']").attr('checked',true);
                        }else{
                            jQuery( "[name='price_checkbox']").attr('checked',false);
                        }

                        jQuery('#edited_date_session').val(timestamp);  
                        jQuery('#edited_time_session').val(edited_time);
                        
                        jQuery('.eventpopup_lightbox_new').fadeIn(500);
                        jQuery(this).fadeIn(500);            

                        jQuery("#load-screen").css('display','none');  
                        
                    },

                    error: function(){
                    alert('request failed please try again');
                    jQuery("#load-screen").css('display','none');  
                    }
                });
            }            

        });

    }); 
        
	/* Calendar Popup Show/Hide */
	jQuery(document).ready(function(){
		jQuery('.eventpopup_lightbox_new').hide();
		jQuery('.fc-event-container').click(function(){
			jQuery('.eventpopup_lightbox_new').fadeIn(500);
			jQuery(this).fadeIn(500);
		});
		jQuery('.closepopup').click(function(){
			jQuery('.eventpopup_lightbox_new').fadeOut(800);
		});
	});
</script>
   
    <script type="text/javascript">       
    jQuery(document).ready(function() {    
        
        var count24Hourclone=0;
        jQuery('.fc-event-container').click(function(){
            jQuery('.eventpopup_lightbox_new').fadeIn(500);
            jQuery(this).fadeIn(500);
        });
    
        jQuery('.closepopup').click(function(){
            jQuery('.eventpopup_lightbox_new').fadeOut(800);
        }); 
        /* End Calendar Popup Show/Hide */     
   
    /* Session Popup Validations And serialization of all values */
    var mySessionForm="";
    jQuery('.submit_btn_session_edit').click(function()
    {     
        
        /* Create Session Popup Custom Form Validations */
         var Err = 0;      

         var adult_price= jQuery( "[name='adult_price']" ).val();
         var child_price= jQuery( "[name='child_price']" ).val();
         var item_price=  jQuery( "[name='item_price']" ).val();

        if(jQuery( "[name='adult_price']" ).length>0){

             if(adult_price==''){
                 
                jQuery( "[name='adult_price']" ).addClass('error'); 
                jQuery( "[name='adult_price']" ).parent().parent().find('label').remove();
                jQuery( "[name='adult_price']" ).parent().after('<label class="error">Please enter price value</label>');  
                Err++;

              }else if((Math.floor(adult_price) != adult_price) || (!jQuery.isNumeric(adult_price)) || (adult_price.indexOf('-')>=0) || (adult_price.indexOf('+')>=0)){      

                jQuery( "[name='adult_price']" ).addClass('error'); 
                jQuery( "[name='adult_price']" ).parent().parent().find('label').remove();     
                jQuery( "[name='adult_price']" ).parent().after('<label class="error">Please enter valid amount</label>');    
                 Err++;

             } else {
                 jQuery( "[name='adult_price']" ).parent().parent().find('label').remove();        
                 jQuery( "[name='adult_price']" ).removeClass('error');

             }
         }
        
            if(jQuery( "[name='child_price']" ).length>0){

                if(child_price==''){
                     
                     jQuery( "[name='child_price']" ).addClass('error');    
                     jQuery( "[name='child_price']" ).parent().parent().find('label').remove();                
                     jQuery( "[name='child_price']" ).parent().after('<label class="error">Please enter price value</label>');    
                    Err++;

                  }else if((Math.floor(child_price) != child_price) || (!jQuery.isNumeric(child_price)) || (child_price.indexOf('-')>=0) || (child_price.indexOf('+')>=0)){ 

                    jQuery( "[name='child_price']" ).addClass('error');  
                    jQuery( "[name='child_price']" ).parent().parent().find('label').remove();             
                    jQuery( "[name='child_price']" ).parent().after('<label class="error">Please enter valid amount</label>');    
                     Err++;

                 } else {
                     jQuery( "[name='child_price']" ).parent().parent().find('label').remove();     
                     jQuery( "[name='child_price']" ).removeClass('error');

                 }
           }
         
         if(jQuery( "[name='item_price']" ).length>0){

              if(item_price==''){            
                jQuery( "[name='item_price']" ).addClass('error');  
                jQuery( "[name='item_price']" ).parent().parent().find('label').remove();                 
                jQuery( "[name='item_price']" ).parent().after('<label class="error">Please enter price value</label>');    
                Err++;

              }else if((Math.floor(item_price) != item_price) || (!jQuery.isNumeric(item_price)) || (item_price.indexOf('-')>=0) || (item_price.indexOf('+')>=0)){ 

               jQuery( "[name='item_price']" ).addClass('error');  
               jQuery( "[name='item_price']" ).parent().parent().find('label').remove();               
               jQuery( "[name='item_price']" ).parent().after('<label class="error">Please enter valid amount</label>');    
               Err++;

             } else {
                 jQuery( "[name='item_price']" ).parent().parent().find('label').remove();    
                 jQuery( "[name='item_price']" ).removeClass('error');

             }
         }
         
       
        if(Err>0){
            return false;
        }else{
            /* End Create session popup form Serialize */
            EditSessionForm =jQuery('#edit_session_id').serialize();
            jQuery('#edit_session_data_value').val(EditSessionForm);
            /* End Create session popup form Serialize */
            jQuery('.eventpopup_lightbox_new').fadeOut(800);
            return true;
        }
        /* End Create Session Popup Custom Form Validations */
    });
    /* End Session Popup Validations And serialization of all values */
    if(mySessionForm){
    console.log(mySessionForm);
    }
   
}); /* End Document dot Ready Function */

</script>


<?php } 
/* End scripts of New pricing and calendar section */
?>
 <!--End Updated 12-02-2016 -->

<script>
function hours_am_pm(time) {
            var hours = time[0] + time[1];
            var min = time[2] + time[3];
            if (hours < 12) {
                return hours + ':' + min + ' AM';
            } else if(hours==12){
                return hours + ':' + min + ' PM';
            } else {
                hours=hours - 12;
                hours=(hours.length < 10) ? '0'+hours:hours;
                return hours+ ':' + min + ' PM';
            }
        }
</script>

 <script>
 jQuery(document).ready(function(){
 setTimeout(function(){ jQuery('#messages').fadeOut('slow'); }, 3000);
 })

 </script>