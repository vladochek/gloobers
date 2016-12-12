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
	//echo "here";exit;

 	global $user,$base_url;
	
	 if(in_array('administrator',$user->roles)){
	
	 }
 

  $status = getUserDetails($user->uid);
$query=db_select('fboauth_users','fb');
    $query->fields('fb',array('uid','fbid'));
    $query->condition('uid',$user->uid);
    $result=$query->execute();
    $facebook_login=$result->fetchAssoc();
    
 if(empty($facebook_login)){
  if(($status['confirm_status'] == 'no') && ($path != 'user/confirm')){
    drupal_goto('user/confirm');
  } 
}
	$userDetails = user_load($user->uid);
	$listingId=arg(3);
	$PhotosData=getPhotosData($listingId);
	$amentiesdata=getAmentiesByproduct($listingId);
	$pricingData=getPricingData($listingId);
	$extras=getExtraDetails($listingId);
	$rulesDetail=getRulesDetails($listingId);
	$calendarDetail = getSchedulingData($listingId);
	$current_path = current_path();
	$notifications = getNotifications();
	$messagelist=getMessageList();
	$senderDetail=user_load($messagelist['author']);
	$messagecount = getNewMessageListCount();
	$notifiationStore = (json_decode($notifiationBadge));
	$count_notification =  $notifiationStore->count;
	define('BASE_CURRENCY_NAME', '$');
	$front_end_theme_with_new_header='gloobers_new';
	$notifiationBadge = unread_notification(1);
	$notifiationStore = (json_decode($notifiationBadge));
	$front_end_theme_common_path='gloobers_new';
    $count_notification =  $notifiationStore->count;
?>
<script type="text/javascript">
	$baseURL = "<?php echo $base_url;?>";
	//$flashPath= $baseURL+"/<?php echo libraries_get_path('plupload').'/js/plupload.flash.swf'; ?>";
	$flashPath= $baseURL+"/<?php echo libraries_get_path('plupload').'/js/Moxie.swf'; ?>";
	$silverlite="/<?php echo libraries_get_path('plupload').'/js/plupload.silverlight.xap'; ?>";
	$productId="<?php echo arg(3);?>";
</script>
<style>
.calinfo > p {
  display: none;
}
</style>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>

<link href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/css/style.css' ?>" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/css/meanmenu.css' ?>" media="all" />
<link rel="stylesheet" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/css/demo.css' ?>" media="all" />
<link rel="stylesheet" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/css/responsiveslides.css' ?>" media="all" />
<link rel="stylesheet" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/css/leanModal.css' ?>" media="all" />
<link rel="stylesheet" type="text/css" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/css/colorbox.css" />
<!----NEW FONT ADDED -->

<!-- Core CSS  -->
<link rel="stylesheet" type="text/css" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$front_end_theme_with_new_header); ?>/css/bootstrap.min.css" />
<!--<link rel="stylesheet" type="text/css" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$front_end_theme_with_new_header); ?>/css/landing_custom.css" />
<link rel="stylesheet" type="text/css" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$front_end_theme_with_new_header); ?>/css/landing_page.css" />-->

<link rel="stylesheet" type="text/css" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$front_end_theme_with_new_header); ?>/fonts/stylesheet.css" />
<link rel="stylesheet" type="text/css" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$front_end_theme_with_new_header); ?>/css/font-awesome.css" />
<?php 
//if(strpos($_SERVER['REQUEST_URI'],'/user/account_settings') !== false){ ?>
<!--<link rel="stylesheet" type="text/css" href="<?php //print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$front_end_theme_with_new_header); ?>/stylesheet/style.css" />-->
<?php //} ?>
<!-- Plugin CSS -->
<link rel="stylesheet" type="text/css" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/js/vendor/plugins/chosen/chosen.min.css" />
<link rel="stylesheet" type="text/css" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/js/vendor/plugins/timepicker/bootstrap-timepicker.min.css" />
<link rel="stylesheet" type="text/css" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/js/vendor/plugins/datepicker/datepicker.css" />
<link rel="stylesheet" type="text/css" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/js/vendor/plugins/daterange/daterangepicker.css" />
<link rel="stylesheet" type="text/css" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/js/vendor/plugins/tags/tagmanager.css" />

<!-- Theme CSS -->
<link rel="stylesheet" type="text/css" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/css/theme.css" />
<link rel="stylesheet" type="text/css" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/css/pages.css" />


<link rel="stylesheet" type="text/css" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/css/jquery.Jcrop.css" />
<link rel="stylesheet" type="text/css" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/css/plugins.css" />
<link rel="stylesheet" type="text/css" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/css/responsive.css" />
<link rel="stylesheet" type="text/css" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/css/jquery.datetimepicker.css" />
<link type="text/css" rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/themes/smoothness/jquery-ui.min.css" media="screen" />
<link type="text/css" rel="stylesheet" href="http://plupload.com/plupload/js/jquery.ui.plupload/css/jquery.ui.plupload.css" media="screen" />

<?php
drupal_add_css(drupal_get_path('theme', $GLOBALS['theme']) . '/css/stylemenu.css');
drupal_add_js(drupal_get_path('theme', $GLOBALS['theme']) . '/js/stylemenu_main.js', array('scope' => 'footer'));
drupal_add_js(drupal_get_path('theme', $GLOBALS['theme']) . '/js/autocomplete.js', array('scope' => 'footer'));

?>
<!--New HTML CALENDER IMPLEMENTATION CSS-->

<link href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/css/inner_page.css" rel="stylesheet" type="text/css">


<link rel="stylesheet" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/css/landing_page.css">
<link rel="stylesheet" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/css/simple-sidebar.css">
<link rel="stylesheet" href="<?php print $GLOBALS['base_url'].'/sites/all/themes/gloobers_new/stylesheet/for-head-foot.css' ?>">
<!--END New HTML CALENDER IMPLEMENTATION CSS-->

<div id="page-wrapper">
    <div id="page">
<header>
          <div class="container-fluid">
          <div class="row">
          <div class="col-md-2 col-sm-2 col-xs-12"><a href="<?php echo $base_url; ?>" title="Home" rel="home" class="logo" id="logo"><img src="<?php print $GLOBALS['base_url'].'/'.drupal_get_path('theme',$GLOBALS['theme']);?>/images/logo.png" alt="Home"></a></div>
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
          <i class="icoicon"><img src="<?php print $GLOBALS['base_url'].'/'.drupal_get_path('theme',$GLOBALS['theme']);?>/images/icon_bell.png" alt="Notification" title="" /></i>
          <?php if (!empty($count_notification)){ 
            echo " <span class='count'>";
            echo $count_notification;
            echo "</span>";
          } 
         ?>
          
          </a>
          <ul aria-labelledby="drop4" class="dropdown-menu">
          <div class="nav-dropdown-heading">Notifications <?php if (!empty($count_notification)){ 
                                                                            echo "(";
                                                                            echo $count_notification;
                                                                            echo ")";
                                                                        } 
                                                                       
                                                                        ?>
                                                            </div>
          <div class="nav-dropdown-content">
            <ul>   
              <?php  if (!empty($notifications)){
                foreach ($notifications as  $value) {  ?>
              <li class="unread">
              <a href="<?php  echo $base_url.'/advice/request/'.base64_encode('gloobe__'.$value['sender_id'])?>">
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
            <strong><?php print $notificationDetail->field_first_name['und'][0]['value'];?></strong>
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
      <li><a href="<?php echo $base_url; ?>/advice/notification" class="notifications_btn">See all notifications</a></li>
    </ul>
</li>
<li class="dropdown" id="fat-menu">
<a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#" id="drop3">
<div class="user_name"><?php 
if(strlen($userDetails->field_first_name['und'][0]['value']) > 10){
$dots = '..';
}
else{
$dots = '';
}
$name = substr($userDetails->field_first_name['und'][0]['value'],0,10).$dots;  
echo trim($name, "%20");
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
<li><a tabindex="0" role="button" href="<?php echo $base_url;?>/user/account_settings"><i class="fa fa-user"></i>Account</a></li>
<li><a tabindex="0" role="button" href="<?php echo $base_url;?>/dashboard"><i class="fa fa-tachometer"></i>Dashboard</a></li>
<li><a tabindex="0" role="button" href="<?php echo $base_url;?>/manage/listing"><i class="fa fa-list-alt"></i>Manage Listing</a></li>
<li><a tabindex="0" role="button" href="<?php echo $base_url;?>/bookings"><i class="fa fa-calendar"></i>Reservations</a></li>
<li><a tabindex="0" role="button" href="<?php echo $base_url;?>/mytrips"><i class="fa fa-plane"></i>Trips</a></li>
<li class="divider"></li>
<li><a tabindex="0" role="button" href="<?php echo $base_url;?>/user_profile"><i class="fa fa-user"></i>Profile</a></li>
<li><a tabindex="0" role="button" href="<?php echo $base_url;?>/user/logout"><i class="fa fa-sign-out"></i>Logout</a></li>
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
<?php if($user->uid){ 
?>
<!-----New Menu Implemented According to hotel design-->
<div class="main_menu">
  <div class="container-fluid padding_left paddng_right">
 <div class="col-lg-12 no_paddng">
	<div class="nav_main_menu">
  <a class="showhide pull-right">MENU <i class="fa fa-bars"></i></a>
 <ul class="dropdwonmenu_remove">
 <li><a class="<?php if(strpos($_SERVER['REQUEST_URI'],'/user/account_settings') !== false){
						echo $class_select_menu='select_menus';
						}else{
						echo $class_select_menu='';
						} ?>" href="<?php echo $base_url; ?>/user/account_settings"> Account  </a></li>
 <li><a class="<?php if(strpos($_SERVER['REQUEST_URI'],'/dashboard') !== false){
						echo $class_select_menu='select_menus';
						}else{
						echo $class_select_menu='';
						} ?>" href="<?php echo $base_url; ?>/dashboard"> Dashboard </a></li>
 <li><a class="<?php if((strpos($_SERVER['REQUEST_URI'],'/product/add/overview') !== false) || (strpos($_SERVER['REQUEST_URI'],'/manage/listing') !== false) ){
						echo $class_select_menu='select_menus';
						}else{
						echo $class_select_menu='';
						} ?>" href="javascript:void(0)"> Listings  <div class="togelsubmenu pull-right"><i class="fa fa-bars"></i></div> </a>
			<ul class="dropdwonmenu_remove1">
			  <li><a href="<?php echo $base_url;  ?>/product/add/overview"> Create Listing </a></li>
			  <li><a href="<?php echo $base_url;?>/manage/listing"> Manage Listing</a></li>
			</ul></li>
 <li><a class="<?php if(strpos($_SERVER['REQUEST_URI'],'/bookings') !== false){
						echo $class_select_menu='select_menus';
						}else{
						echo $class_select_menu='';
						} ?>" href="<?php  echo $base_url;?>/bookings"> Reservations  </a></li>
 <li><a href="javascript:void(0)"> Recommendation <div class="togelsubmenu pull-right"><i class="fa fa-bars"></i></div> </a>
         
         <ul class="dropdwonmenu_remove1">
          <li><a href="<?php echo $base_url; ?>/advice/my_request"> My Request </a></li>
          <li><a href="<?php echo $base_url; ?>/advice/request"> Request Received </a></li>
          <li><a href="<?php echo $base_url; ?>/advice/validate_recommendation"> Validate Recommendation </a></li>
           <li><a href="<?php echo $base_url; ?>/advice/create-travel-guide"> Create Travel Guide </a></li>
            <li><a href="<?php echo $base_url; ?>/advice/travel_guide"> View Travel Guide  </a></li>
            
         </ul></li>
 <li><a class="<?php if(strpos($_SERVER['REQUEST_URI'],'/mytrips') !== false){
						echo $class_select_menu='select_menus';
						}else{
						echo $class_select_menu='';
						} ?>" href="<?php echo $base_url;?>/mytrips"> Trips</a></li>
 <li><a class="<?php if(strpos($_SERVER['REQUEST_URI'],'/user_profile') !== false){
						echo $class_select_menu='select_menus';
						}else{
						echo $class_select_menu='';
						} ?>" href="<?php echo $base_url; ?>/user_profile">  Profile  </a></li>

 </ul>
 </div> 
 
  </div>
 </div>
</div>

<?php 
} $eid=arg(3);
?>
<!-- End: Main --> 
<?php $cls=''; ?>
<!-- End: Main --> 
<section class="account_section experience_section">
	<div id="wrapper">
	<div id="sidebar-wrapper">
             <div class="toggle_heading-div"><p class="toggle_heading">Create an experience</p></div>
        
            <ul class="sidebar-nav">
                <li>
					<a <?php if(strpos($_SERVER['REQUEST_URI'],'/product/add/overview') !== false){
								echo $cls='class="active_sidebar"';
							}
						?>  href="<?php  echo $base_url; ?>/product/add/overview<?php if($eid != "") echo "/".$eid; ?>">Overview</a>
                </li>
                
                <li>
                    <a <?php if(strpos($_SERVER['REQUEST_URI'],'/product/add/photos') !== false){
								echo $cls='class="active_sidebar"';
							}
						?>  href="<?php echo $base_url; ?>/product/add/photos<?php if($eid != "") echo "/".$eid; ?>">Photos</a>
                </li>
                <li>
                    <a <?php if(strpos($_SERVER['REQUEST_URI'],'/product/add/amenities') !== false){
								echo $cls='class="active_sidebar"';
							}
						?> href="<?php echo $base_url; ?>/product/add/amenities<?php if($eid != "") echo "/".$eid; ?>">Amenties</a>
                </li>
                <li>
                    <a <?php if(strpos($_SERVER['REQUEST_URI'],'/product/add/location') !== false){
								echo $cls='class="active_sidebar"';
							}
						?>  href="<?php echo $base_url; ?>/product/add/location<?php if($eid != "") echo "/".$eid; ?>">Location</a>
                </li>
                <li>
                    <a <?php if(strpos($_SERVER['REQUEST_URI'],'/product/add/Calendernew') !== false){
								echo $cls='class="active_sidebar"';
							}
						?> href="<?php echo $base_url; ?>/product/add/Calendernew<?php if($eid != "") echo "/".$eid; ?>">Pricing &amp; Calendar </a>
                </li>
                <li>
                    <a <?php if(strpos($_SERVER['REQUEST_URI'],'/product/add/extra') !== false){
								echo $cls='class="active_sidebar"';
							}
						?>  href="<?php echo $base_url; ?>/product/add/extra<?php if($eid != "") echo "/".$eid; ?>">Optional Services</a>
                </li>
                <li>
                    <a <?php if(strpos($_SERVER['REQUEST_URI'],'/product/add/rules') !== false){
								echo $cls='class="active_sidebar"';
							}
						?> href="<?php echo $base_url; ?>/product/add/rules<?php if($eid != "") echo "/".$eid; ?>">Rule &amp; Policies</a>
                </li>
                <li>
                    <a <?php if(strpos($_SERVER['REQUEST_URI'],'/product/add/subscription') !== false){
								echo $cls='class="active_sidebar"';
							}
						?>  href="<?php echo $base_url; ?>/product/add/subscription<?php if($eid != "") echo "/".$eid; ?>">Ranking</a>
                </li>
                
            </ul>
        </div>
		 <?php
			$DivSize = 'product/add/subscription/';
			switch ($DivSize) {
				case (strpos($_SERVER['REQUEST_URI'],'product/add/subscription/') !== false):
					$var_bootstrap='12';
					break;
				case (strpos($_SERVER['REQUEST_URI'],'product/add/location') !== false):
					$var_bootstrap='12';
					break;
				case (strpos($_SERVER['REQUEST_URI'],'product/add/rules') !== false):
					$var_bootstrap='9';
					break;
				case (strpos($_SERVER['REQUEST_URI'],'product/add/amenities') !== false):
					$var_bootstrap='12';
					break;
				case (strpos($_SERVER['REQUEST_URI'],'product/add/photos') !== false):
					$var_bootstrap='9';
					break;
				case (strpos($_SERVER['REQUEST_URI'],'product/add/extra') !== false):
					$var_bootstrap='9';
					break;
				case (strpos($_SERVER['REQUEST_URI'],'product/add/Calendernew') !== false):
					$var_bootstrap='9';
					break;
				case (strpos($_SERVER['REQUEST_URI'],'product/add/overview') !== false):
					$var_bootstrap='9';
					break;
				case (strpos($_SERVER['REQUEST_URI'],'manage/listing') !== false):
					$var_bootstrap='12';
					break;
				case (strpos($_SERVER['REQUEST_URI'],'/bookings') !== false):
					$var_bootstrap='12';
					break;
				case (strpos($_SERVER['REQUEST_URI'],'/user/edit') !== false):
					$var_bootstrap='12';
					break;
					
				case (strpos($_SERVER['REQUEST_URI'],'/mytrips') !== false):
					$var_bootstrap='12';
					break;
				case (strpos($_SERVER['REQUEST_URI'],'/dashboard') !== false):
					$var_bootstrap='0';
					break;
				case (strpos($_SERVER['REQUEST_URI'],'/product/add/payment') !== false):
					$var_bootstrap='9';
					break;
				case (strpos($_SERVER['REQUEST_URI'],'/product/add/success') !== false):
					$var_bootstrap='12';
					break;
					
					
				default:
					$var_bootstrap='6';
			}			

		 if(strpos($_SERVER['REQUEST_URI'],'dashboard') !== false){
			$classRowCol='';
		}else{
			$classRowCol="col-xs-12 col-sm-".$var_bootstrap." col-md-".$var_bootstrap."";
			
		}
	
	?>
		<div id="page-content-wrapper">
            <div class="container-fluid">
          <div class="row">  <a id="menu-toggle" class="sidebar_btn" href="#menu-toggle">Toggle Menu</a></div>
                <div class="row">
				<div class="<?php echo $classRowCol;?>">
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


<?php 
//echo '<p style="color:red;">'.strpos($_SERVER['REQUEST_URI'],'product/add/photos').'</p>';exit;
print render($page['footer']); 

?>
<!-- End: Main --> 
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script> 

<?php if((strpos($_SERVER['REQUEST_URI'],'product/add/photos'))== false){?>
<script type="text/javascript" src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$front_end_theme_with_new_header).'/js/bootstrap.min.js'?> "></script>
<?php } ?>

<script type="text/javascript" src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/js/easyResponsiveTabs.js'?> "></script>

<!-- <script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/js/jquery.meanmenu.js' ?>"></script> -->
<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/js/jquery.leanModal.min.js' ?>"></script>

<script type="text/javascript" src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/js/uniform.min.js' ?>"></script> 
<script type="text/javascript" src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/js/main.js' ?>"></script>
<script type="text/javascript" src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/js/custom.js' ?>"></script> 
<script type="text/javascript" src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/js/vendor/plugins/daterange/moment.min.js' ?>"></script> 
<script type="text/javascript" src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/js/vendor/plugins/daterange/daterangepicker.js' ?>"></script>
<script type="text/javascript" src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/js/vendor/plugins/timepicker/bootstrap-timepicker.min.js' ?>"></script> 
<script type="text/javascript" src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/js/vendor/plugins/datepicker/bootstrap-datepicker.js' ?>"></script> 

<script type="text/javascript" src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/js/jquery.colorbox.js' ?>"></script> 
<script type="text/javascript" src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/js/jquery.Jcrop.js' ?>"></script> 
<script type="text/javascript" src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/js/jquery.SimpleCropper.js' ?>"></script> 
<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/js/jquery.selectbox-0.2.js"></script>
<script type="text/javascript">
 jQuery(document).ready(function() {
	
	jQuery("select").selectbox();

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
		onRender: function(date){
		return date.valueOf() < now.valueOf() ? 'disabled' : '';
		}
	});
	
	jQuery('.datepicker').keyup(function() {
		jQuery(this).val('');
	});
	jQuery('.datetimepicker').keyup(function() {
		jQuery(this).val('');
	});
	jQuery('.daterangepicker2').keyup(function() {
		jQuery(this).val('');
	});
	
	jQuery('input[name="openning_hours_dates"] , .form-item-high-season-rate-dates input , .daterangepicker2').daterangepicker({minDate:moment().subtract('days',1)});
	/* jQuery('.timepicker').timepicker(); */
	
	/*  NEW JS ACC TO THEME */
		jQuery('.showhide').click(function(e){
			e.preventDefault();
			jQuery('.nav_main_menu').find('ul').toggleClass('dropdwonmenu_remove dropdwonmenu');
		});

		jQuery('.togelsubmenu').click(function(e){
		    e.preventDefault();
		    jQuery('.nav_main_menu').find('ul li ul').toggleClass('dropdwonmenu_remove1 dropdwonmenu1');
		});

	    jQuery(".sidebar_icone").click(function(){
	    jQuery(".inner_setting_page .container-fluid").addClass("container");
		});
	
		jQuery(".sidebar_icone").click(function () {
			jQuery(".sidebar_menu").toggleClass("close_sidebar");
		});

		jQuery("#menu-toggle").click(function(e) {
			e.preventDefault();
			jQuery("#wrapper").toggleClass("toggled");
		});
	
	/* END */
	});	
</script>

<?php 
	global $base_url;
	$library_path = _plupload_library_path(); 
	//echo $library_path;exit;
?>

<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/js/responsiveslides.min.js' ?>"></script>
<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$front_end_theme_with_new_header); ?>/js/jquery.nicescroll.min.js"></script>
<script type="text/javascript">
jQuery(document).ready(function() {
    jQuery("html").niceScroll();
    jQuery("#helpBar").niceScroll();
    });
  
  /* jQuery(".admin-sec").click(function(){
		jQuery(".nadminmenu").slideToggle("slow");
	});	 */
 jQuery(document).ready(function () {
	//jQuery("#modal_trigger").leanModal({top : 200, overlay : 0.6, closeButton: ".modal_close" });
    // You can also use "$(window).load(function() {"

		
      // Slideshow 2
      jQuery("#slider2").responsiveSlides({
        auto: false,
        pager: true,
        speed: 300,
        width:100,
      });

		// Calling Login Form
		jQuery("#login_form").click(function(){
			jQuery(".social_login").hide();
			jQuery(".user_login").show();
			return false;
		});

		// Calling Register Form
		jQuery("#register_form").click(function(){
			jQuery(".social_login").hide();
			jQuery(".user_register").show();
			jQuery(".header_title").text('Register');
			return false;
		});

		// Going back to Social Forms
		jQuery(".back_btn").click(function(){
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
		
		jQuery(".btn-adminuser").click(function(){
	    jQuery(".user-menu .dropdown-menu").slideToggle();
		
        }); 
		
		jQuery('html').on('click','a.disable',function(event){
			event.preventDefault();
		});
		if(jQuery('#24_hour_offer_check').prop('checked')==true){
			jQuery('.24_hour_offer_show').show();
		}else{
			jQuery('.24_hour_offer_show').hide();
		}
    });
	jQuery(document).ready(function() {

		Core.init();
  
  // Populates theme styles for Tabs - Trash function 
  var tabOptions = [];
  var tabToggle = jQuery(".toggle-tab-style .tab-style-option");
  var tabCount = jQuery(tabToggle).length;	
  
  jQuery(tabToggle).each(function (index, element){
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
jQuery(document).ready(function () {
	    //jQuery('header nav').meanmenu();
	    //jQuery(".nav-dropdown-content").niceScroll();
	});
	function hide_perminute(val){

	var typeTime=jQuery(val).val();
		if(typeTime != 'Minute'){
		jQuery('.repeat_everyminute_condition').hide();

		}else{
		jQuery('.repeat_everyminute_condition').show();

		}
	}

	jQuery(document).ready(function () {
	    //jQuery('header nav').meanmenu();
	});
	
	
	jQuery(window).scroll(function() {    
    var scroll = jQuery(window).scrollTop();

     //>=, not <=
    if (scroll >= 250) {
        //clearHeader, not clearheader - caps H
		<?php if((strpos($_SERVER['REQUEST_URI'],'product/add/amenities') !== false) || (strpos($_SERVER['REQUEST_URI'],'product/add/location') !== false)){ ?>

			jQuery("#helpBar").addClass("");

		<?php	}else{ ?>
			jQuery("#helpBar").addClass("darkHeader");
	   <?php } ?>
    }
	
	  else if (scroll <= 250) {
        //clearHeader, not clearheader - caps H
       jQuery("#helpBar").removeClass("darkHeader");
    } 
	});


        function readnotifications(recipient_id){
            jQuery.ajax({
        
             url:'<?php echo $base_url; ?>/advice/readnotifications',
             type:'post',
             data:{'recipientid':recipient_id ,'isAjax':1},
             success: function(result){
                //alert(result);

                window.location.href='<?php echo $base_url;?>/advice/notification';
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

	/* jQuery(document).on('blur','.datepicker',function(){
			jQuery('.datepicker-dropdown').toggle();
		}); */
</script>


<?php 
/* These Scripts will load only when The new pricing and calendar section page will be opened */
if(strpos($_SERVER['REQUEST_URI'],'product/add/Calendernew') !== false){ ?>

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
		/* Click on calendar Date opens Popup */
		jQuery(document).on('click','.fc-day', function(){
		
			var timestamp=jQuery(this).attr('data-date');
			var check = timestamp;
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
            today = yyyy + '-' + mm + '-' + dd;
			console.log(check);
			console.log(today);
			if(new Date(today) <= new Date(check)){
				jQuery('#information_block').html(timestamp);
				jQuery('.eventpopup_lightbox').fadeIn(500);
				jQuery(this).fadeIn(500);
			
			}else{
				alert('Old Dates not allowed');
			}
		});
		/* Calendar Popup Show/Hide */
	jQuery(document).ready(function() {
		//alert(jQuery('.24_hours_discounted_clone').size());
		var count24Hourclone=jQuery('.24_hours_discounted_clone').size();
		jQuery('.fc-event-container').click(function(){
			jQuery('.eventpopup_lightbox').fadeIn(500);
			jQuery(this).fadeIn(500);
		});
	
		jQuery('.closepopup').click(function(){
			jQuery('.eventpopup_lightbox').fadeOut(800);
		}); 
		/* End Calendar Popup Show/Hide */		
		/* End Click on calendar Date opens Popup */
		
		/* Repeat sessions */
		jQuery('#repeat_sessions').change(function(){
				var repeatBy=jQuery(this).val();
				var repeatBy=jQuery('#repeat_sessions').val();
				switch(repeatBy){
				case "Weekly":
					jQuery('.repeat_session_Weekly_HTML').show();
					jQuery('.repeat_session_Hourly_HTML').hide();
					jQuery('#YEARLY').hide();
					jQuery('#MONTHLY').hide();
					jQuery('#Weekly').show();
					jQuery('#Hourly').hide();
				break;
				case "Hourly":
					jQuery('.repeat_session_Weekly_HTML').hide();
					jQuery('.repeat_session_Hourly_HTML').show();
					jQuery('#YEARLY').hide();
					jQuery('#MONTHLY').hide();
					jQuery('#Weekly').hide();
					jQuery('#Hourly').show();
				break;
				case "MONTHLY":
					jQuery('.repeat_session_Weekly_HTML').hide();
					jQuery('.repeat_session_Hourly_HTML').hide();
					jQuery('#YEARLY').hide();
					jQuery('#MONTHLY').show();
					jQuery('#Weekly').hide();
					jQuery('#Hourly').hide();
				break;
				case "YEARLY":
					jQuery('.repeat_session_Weekly_HTML').hide();
					jQuery('.repeat_session_Hourly_HTML').hide();
					jQuery('#YEARLY').show();
					jQuery('#MONTHLY').hide();
					jQuery('#Weekly').hide();
					jQuery('#Hourly').hide();
				break;
				default:
					jQuery('.repeat_session_Weekly_HTML').hide();
					jQuery('.repeat_session_Hourly_HTML').hide();
					jQuery('#YEARLY').hide();
					jQuery('#MONTHLY').hide();
					jQuery('#Weekly').hide();
					jQuery('#Hourly').hide();
				break;
				}
		});
		/* End Repeat sessions */
		/* var selectPrice_type_val=jQuery('.sbSelector')[15].innerHTML;
		
		if(selectPrice_type_val==' Per Person'){
			jQuery('.pricetype_options_PER_PERSON_qty').show();
			jQuery('.pricetype_options_PER_ITEM_qty').hide();
			jQuery('.pricetype_options_PER_PERSON').show();
			jQuery('.pricetype_options_PER_ITEM').hide();
		}else{
			jQuery('.pricetype_options_PER_PERSON_qty').hide();
			jQuery('.pricetype_options_PER_ITEM_qty').show();
			jQuery('.pricetype_options_PER_PERSON').hide();
			jQuery('.pricetype_options_PER_ITEM').show();
		} */
		
		var Price_type=jQuery('#edit-product-pricing-type').val();
		count24Hourclone=(parseInt(count24Hourclone)+12);
		var Price_type=jQuery('.sbSelector')[count24Hourclone].innerHTML;
		//console.log(Price_type);
		if(Price_type==' Per Person'){
		console.log('here');
			var person_type=jQuery('.sbSelector')[(count24Hourclone+1)].innerHTML;
			console.log(person_type);
			switch(person_type){
					case ' Everyone':
					console.log(person_type);
						jQuery('.sessional_price_per_person').hide();
						jQuery('.sessional_price_per_person-everyone').show();
						jQuery('#addmore_person').hide();
					break;
					default:
						jQuery('.sessional_price_per_person').show();
						jQuery('.sessional_price_per_person-everyone').hide();
						jQuery('#addmore_person').show();
					break;
				}
			jQuery('.pricetype_options_PER_ITEM').hide();
			jQuery('.pricetype_options_PER_ITEM_qty').hide();
			jQuery('.pricetype_options_PER_PERSON').show();
			jQuery('.pricetype_options_PER_PERSON_qty').show();
			//jQuery('.sessional_price_per_person').show();
			jQuery('.sessional_price_per_item').hide();
			jQuery('#edit-product-pricing-type-sessional').val('Per Person');
			
		}else{console.log('there');
			jQuery('.pricetype_options_PER_ITEM').show();
			jQuery('.pricetype_options_PER_ITEM_qty').show();
			jQuery('.pricetype_options_PER_PERSON').hide();
			jQuery('.pricetype_options_PER_PERSON_qty').hide();
			jQuery('.sessional_price_per_person').hide();
			jQuery('.sessional_price_per_person-everyone').hide();
			jQuery('.sessional_price_per_item').show();
			jQuery('#edit-product-pricing-type-sessional').val('Per Item');
			jQuery('.item_add').show();
		}
		
	
		jQuery('#YEARLY').hide();
		jQuery('#MONTHLY').hide();
		jQuery('#Weekly').hide();
		jQuery('#Hourly').hide();
		jQuery('.repeat_session_Weekly_HTML').hide();
		jQuery('.repeat_session_Hourly_HTML').hide();
		
	/* 	if(repeatBy=='Weekly'){
			jQuery('.repeat_session_Weekly_HTML').show();
			jQuery('.repeat_session_Hourly_HTML').hide();
		}else if(repeatBy=='Hourly'){
			jQuery('.repeat_session_Weekly_HTML').hide();
			jQuery('.repeat_session_Hourly_HTML').show();
		}else{
			jQuery('.repeat_session_Weekly_HTML').hide();
			jQuery('.repeat_session_Hourly_HTML').hide();
		} */
	
	/* Price Section Show/Hide */	
	jQuery('#edit-product-pricing-type').change(function()
	{	
		var Price_type=jQuery('.sbSelector')[count24Hourclone].innerHTML;
		//console.log(Price_type);
		var Price_type_byId=jQuery('#edit-product-pricing-type').val();
		if(Price_type_byId=='PER_PERSON'){
		
			var person_type=jQuery('.sbSelector')[(count24Hourclone+1)].innerHTML;
			console.log(person_type);
			jQuery('.sessional_price_per_person').show();
			jQuery('.sessional_price_per_person-everyone').hide();
			jQuery('.pricetype_options_PER_ITEM').hide();
			jQuery('.pricetype_options_PER_ITEM_qty').hide();
			jQuery('.pricetype_options_PER_PERSON').show();
			jQuery('.pricetype_options_PER_PERSON_qty').show();
			//jQuery('.sessional_price_per_person').show();
			jQuery('.sessional_price_per_item').hide();
			jQuery('#edit-product-pricing-type-sessional').val('Per Person');
			
		}else{
			console.log('there');
			jQuery('.pricetype_options_PER_ITEM').show();
			jQuery('.pricetype_options_PER_ITEM_qty').show();
			jQuery('.pricetype_options_PER_PERSON').hide();
			jQuery('.pricetype_options_PER_PERSON_qty').hide();
			jQuery('.sessional_price_per_person').hide();
			jQuery('.sessional_price_per_person-everyone').hide();
			jQuery('.sessional_price_per_item').show();
			jQuery('#edit-product-pricing-type-sessional').val('Per Item');
			jQuery('.item_add').show();
		}
	});
	jQuery('#edit-product-person-type').change(function(){	
		if(jQuery(this).attr('value')=='everyone'){
			jQuery('.sessional_price_per_person-everyone').show();
			jQuery('.sessional_price_per_person').hide();	
			jQuery('#addmore_person').hide();
		}else{
			jQuery('.sessional_price_per_person-everyone').hide();
			jQuery('.sessional_price_per_person').show();
			jQuery('#addmore_person').show();			
		}
	});
	/* End Price Section Show/Hide */	

	/* Sesonal price Checkbox Show/Hide */
	jQuery("#sesonal_price_checked_id").click(function(){
		if(jQuery('#sesonal_price_checked_id').prop('checked')==false){
			jQuery('#sesonal_price_checked_id').removeAttr( "checked" );
			jQuery('.sesonal_price_div_show').hide();
		}else{
			jQuery('.sesonal_price_div_show').show();
		}
	});
	/* End Sesonal price Checkbox Show/Hide */

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

	/* Session Popup Validations And serialization of all values */
	var mySessionForm="";
	jQuery('.submit_btn_session').click(function()
	{
	   
		
		/* Create Session Popup Custom Form Validations */
		var Err = 0;
		if(jQuery('#booking_type_date').val()=='INVENTORY'){
		var max = "";
		var min = "";
		var startDate=jQuery('#edit-session-startdate_new').val();
		var startTime=jQuery('#edit-session_starttime').val();
		var endTime=jQuery('#edit-session_endtime').val();
		var untilDate=jQuery('#edit-session-enddate_new').val();
		var maxAvail=jQuery('#max_avail').val();
		var minAvail=jQuery('#min_avail').val();
		if(startDate ==''){
			jQuery("#edit-session-startdate_new").addClass("error");
			Err++;
		}else{
			jQuery("#edit-session-startdate_new").removeClass("error");
		}
		if(untilDate ==''){
			jQuery("#edit-session-enddate_new").addClass("error");
			Err++;
		}else{
			jQuery("#edit-session-enddate_new").removeClass("error");
		}
		if(startTime ==''){
			jQuery("#edit-session_starttime").addClass("error");
			Err++;
		}else{
			jQuery("#edit-session_starttime").removeClass("error");
		}
		if(endTime ==''){
			jQuery("#edit-session_endtime").addClass("error");
			Err++;
		}else{
			jQuery("#edit-session_endtime").removeClass("error");
		}
		if((startTime==endTime) || (startTime>endTime)){
			jQuery("#edit-session_starttime").addClass("error");
			jQuery("#edit-session_endtime").addClass("error");
			Err++;
		}else{
			jQuery("#edit-session_starttime").removeClass("error");
			jQuery("#edit-session_endtime").removeClass("error");
		}
		//alert(maxAvail);
		if(maxAvail== ''){
		console.log('111111111');
			jQuery('#max_avail').addClass('error');
			Err++;
		}else if((jQuery.isNumeric(maxAvail))==false){
			console.log('22222222');
			jQuery('#max_avail').addClass('error');
			Err++;
		}else{
			console.log('333333333');
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
		console.log(maxAvail);
		console.log(minAvail);
		if((maxAvail!= '') && (minAvail!='')){
			if(parseInt(maxAvail) < parseInt(minAvail)){
			console.log('PP');
				jQuery("#max_avail").addClass("error");
				jQuery("#min_avail").addClass("error");
				Err++;
			}else{
			console.log('PP111');
				jQuery("#min_avail").removeClass("error");
				jQuery("#max_avail").removeClass("error");
			}
		}
		}
		var Price_type=jQuery('.sbSelector')[count24Hourclone].innerHTML;
		if(Price_type==' Per Person'){
			jQuery('input[class^="amount_perperson"]').each(function(){
				if(jQuery(this).val()==''){
					jQuery(this).addClass("error");
					Err++;
				}else if((jQuery.isNumeric(jQuery(this).val()))==false){
					jQuery(this).addClass("error");
					Err++;
				}else{
					jQuery(this).removeClass("error");
				}
			});
		}else{
			var product_item_min=jQuery('#products_person_max').val();
			var product_item_max=jQuery('#products_person_max').val();
			var product_item_per_adult_min=jQuery('#product_item_per_adult_min').val();
			var product_item_per_adult_max=jQuery('#product_item_per_adult_max').val();
			var product_item_per_child_min=jQuery('#product_item_per_child_min').val();
			var product_item_per_child_max=jQuery('#product_item_per_child_max').val();
			jQuery('input[class^="amount_peritem"]').each(function(){
				if(jQuery(this).val()==''){
					jQuery(this).addClass("error");
					Err++;
				}else if((jQuery.isNumeric(jQuery(this).val()))==false){
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
			
			console.log(product_item_min);
			console.log(product_item_max);
			if(product_item_min==''){
			console.log(jQuery('#product_item_min').addClass('error'));
				jQuery('#product_item_min').addClass('error');
				Err++;
			}else{
				jQuery("#product_item_min").removeClass("error");
			} 
			if(product_item_max==""){
			console.log('2');
				jQuery("#products_person_max").addClass("error");
				Err++;
			}else{
				jQuery("#product_item_max").removeClass("error");
			} 
			if(product_item_max<product_item_min){
				jQuery("#product_item_max").addClass("error");
				jQuery("#product_item_min").addClass("error");
				Err++;
			}else{
				jQuery("#product_item_max").removeClass("error");
				jQuery("#product_item_min").removeClass("error");
			}
			if(product_item_per_adult_min==""){
			console.log('3');
				jQuery('#product_item_per_adult_min').addClass("error");
				Err++;
			}else{
				jQuery('#product_item_per_adult_min').removeClass("error");
			}
			if(product_item_per_adult_max==""){
			console.log('4');
				jQuery('#product_item_per_adult_min').addClass("error");
				Err++;
			}else{
				jQuery('#product_item_per_adult_min').removeClass("error");
			}
			if(product_item_per_adult_max < product_item_per_adult_min){
				jQuery('#product_item_per_adult_min').addClass("error");
				jQuery('#product_item_per_adult_min').addClass("error");
				Err++;
			}else{
				jQuery('#product_item_per_adult_min').removeClass("error");
				jQuery('#product_item_per_adult_min').removeClass("error");
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
			if(product_item_per_child_min>product_item_per_child_max){
				jQuery('#product_item_per_child_min').addClass("error");
				jQuery('#product_item_per_child_max').addClass("error");
				Err++;
			}else{
				jQuery('#product_item_per_child_min').removeClass("error");
				jQuery('#product_item_per_child_max').removeClass("error");
			}
			
		}
		
		if(jQuery('#sesonal_price_checked_id').prop('checked')==true){
			console.log('Here');
			
			var session_from=jQuery('#session_from').val();
			var session_to=jQuery('#session_to').val();
			var period_name=jQuery('#period_name').val();
			
			if(Price_type==' Per Person'){
				var person_type_Ch=jQuery('#edit-product-person-type').val();
				console.log(person_type_Ch);
				switch(person_type_Ch){
					case 'everyone':
						var rate_for_everyone=jQuery('#rate_for_everyone').val();
						if(rate_for_everyone==''){
							jQuery('#rate_for_everyone').addClass('error');
							Err++;
						}else if((jQuery.isNumeric(rate_for_everyone))==false){
							jQuery('#rate_for_everyone').addClass("error");
							Err++;
						}else{
							jQuery('#rate_for_everyone').removeClass('error');
						}
					break;
					default:
						var rate_for_adult=jQuery('#rate_per_adult').val();
						var rate_for_chid=jQuery('#rate_per_child').val();
						if(rate_for_adult==''){
							jQuery('#rate_per_adult').addClass('error');
							Err++;
						}else if((jQuery.isNumeric(rate_for_adult))==false){
							jQuery('#rate_per_adult').addClass("error");
							Err++;
						}else{
							jQuery('#rate_per_adult').removeClass('error');
						}
						if(rate_for_chid==''){
							jQuery('#rate_per_child').addClass('error');
							Err++;
						}else if((jQuery.isNumeric(rate_for_chid))==false){
							jQuery('#rate_per_child').addClass("error");
							Err++;
						}else{
							jQuery('#rate_per_child').removeClass('error');
						}
					break;
				}
			}else{
				var rate_per_item=jQuery('#rate_per_item').val();
				if(rate_per_item==''){
					jQuery('#rate_per_item').addClass('error');
					Err++;
				}else if((jQuery.isNumeric(rate_per_item))==false){
					jQuery('#rate_per_item').addClass("error");
					Err++;
				}else{
					jQuery('#rate_per_item').removeClass('error');
				}
			}
			if(period_name==''){
				jQuery('#period_name').addClass('error');
				Err++;
			}else{
				jQuery('#period_name').removeClass('error');
			}
			if(session_from==''){
				jQuery('#session_from').addClass('error');
				Err++;
			}else{
				jQuery('#session_from').removeClass('error');
			}
			if(session_to==''){
				jQuery('#session_to').addClass('error');
				Err++;
			}else{
				jQuery('#session_to').removeClass('error');
			}
		}
		
		if(Err>0){
			return false;
		}else{
		    /* Create session popup form Serialize */
				mySessionForm =jQuery('#create_session_id').serialize();
				jQuery('#session_data_value').val(mySessionForm);
			/* End Create session popup form Serialize */
			jQuery('.eventpopup_lightbox').fadeOut(800);
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
		
		
		if(jQuery('#24_hour_offer_check').prop('checked')==true){
			var inputs = jQuery('input[class^="offer_24_hour_offer_Data_date"]');
			inputs.filter(function(i,el){
				return inputs.not(this).filter(function() {
				
					if(this.value === el.value){
						Err++;
						return this.value === el.value;
					}else{
						jQuery(this).removeClass('error');
					}
					return this.value === el.value;
				}).length !== 0;
				
			}).addClass('error');
			
			
			jQuery('input[class^="offer_24_hour_offer_Data_date"]').each(function(){
				var current_val=jQuery(this).val();
				if(jQuery(this).val()==''){
					jQuery(this).addClass("error");
					Err++;
				}else{
					jQuery(this).removeClass("error");
				}
			});
			jQuery('input[class^="offer_24_hour_offer_Data_price"]').each(function(){
				if(jQuery(this).val()==''){
					jQuery(this).addClass("error");
					Err++;
				}else{
					jQuery(this).removeClass("error");
				}
			});
			
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
					}else{
						jQuery('#edit-last-minutes-time-value').removeClass('error');
						jQuery('#edit-last-minutes-time-value').parent().find('span').remove();
					}
				}
			}
			var price=jQuery('#edit-last-minutes-price-value').val();
		}
		
		if(jQuery('#early_birds_check').prop('checked')==true){
			console.log('In early_birds_check');	
			var timevalearly=jQuery('#edit-early-birds-time-value').val();
			var timetypeearly=jQuery('#edit-early-birds-time-type').val();
			if(timevalearly == ''){
				jQuery('#edit-early-birds-time-value').addClass('error');
				Err++;
			}else{
				jQuery('#edit-early-birds-time-value').removeClass('error');
				
			}
			if(timevalearly != ''){	
				console.log(timetypeearly);			
				if(timetypeearly=='day'){
					timevalearly=parseInt(timevalearly);	
					if(timevalearly < 7){
						jQuery('#edit-early-birds-time-value').addClass('error');
						jQuery('#edit-early-birds-time-value').parent().find('span').remove();
						jQuery('#edit-early-birds-time-value').parent().append('<span style="color:red;">Time will be greater then 7 Days in early birds offer.</span>');
						Err++;
					}else{
						jQuery('#edit-early-birds-time-value').removeClass('error');
						jQuery('#edit-early-birds-time-value').parent().find('span').remove();
					}
				}
			}
			var price=jQuery('#edit-early-birds-price-value').val();
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
</script>
<?php } 
/* End scripts of New pricing and calendar section */
?>