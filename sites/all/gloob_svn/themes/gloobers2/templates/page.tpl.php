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
 
 	global $user,$base_url;
	//drupal_add_js(drupal_get_path('theme', 'gloobers2') .'/js/jquery-1.11.0.min.js', 'file');
	//drupal_add_js(drupal_get_path('theme', 'gloobers2') .'/js/jquery-migrate-1.2.1.min.js', 'file');
	
	
?>
<script>
	$baseURL = "<?php echo $base_url;?>";
	$flashPath= "/<?php echo libraries_get_path('plupload').'/js/plupload.flash.swf'; ?>";
	$silverlite="/<?php echo libraries_get_path('plupload').'/js/plupload.silverlight.xap'; ?>";
	$productId="<?php echo arg(3);?>"
</script>
<!--[if lt IE 9]>
    <script src="http://www.plupload.com/js/html5shiv.js"></script>
    <![endif]-->
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>
<link href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/css/style.css' ?>" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/css/meanmenu.css' ?>" media="all" />

<link rel="stylesheet" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/css/demo.css' ?>" media="all" />
<link rel="stylesheet" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/css/responsiveslides.css' ?>" media="all" />
<link rel="stylesheet" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/css/leanModal.css' ?>" media="all" />
<link rel="stylesheet" type="text/css" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/css/colorbox.css" />

<!-- Font CSS  -->
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400,600,700" />

<!-- Core CSS  -->
<!--<link href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/css/bootstrap-combined.min-local.css" type="text/css" rel="stylesheet">-->
<link rel="stylesheet" type="text/css" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="http://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/fonts/glyphicons_pro/glyphicons.min.css" />

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
<!--<link rel="stylesheet" type="text/css" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/css/croppic.css" />-->
<link rel="stylesheet" type="text/css" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/css/plugins.css" />
<link rel="stylesheet" type="text/css" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/css/responsive.css" />
<link rel="stylesheet" type="text/css" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/css/jquery.datetimepicker.css" />
<link type="text/css" rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/themes/smoothness/jquery-ui.min.css" media="screen" />
<link type="text/css" rel="stylesheet" href="http://plupload.com/plupload/js/jquery.ui.plupload/css/jquery.ui.plupload.css" media="screen" />
<?php
//if($user->uid)
//{ 
?>
<header class="navbar navbar-fixed-top">
  <div class="pull-left"> <a class="navbar-brand" href="<?php print $front_page; ?>">
    <div class="navbar-logo"><img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" class="img-responsive" alt="logo" /></div>
    </a> </div>
  <div class="pull-right header-btns">
  <!--  <div class="messages-menu">
      <button type="button" class="btn btn-default btn-gradient btn-sm dropdown-toggle" data-toggle="dropdown"> <span class="glyphicon glyphicon-comment"></span> <b>4</b> </button>
      <ul class="dropdown-menu checkbox-persist" role="menu">
        <li class="menu-arrow">
          <div class="menu-arrow-up"></div>
        </li>
        <li class="dropdown-header">Recent Messages <span class="pull-right glyphicons glyphicons-comment"></span></li>
        <li>
          <ul class="dropdown-items">
            <li>
              <div class="item-avatar"><img src="img/avatars/header/2.jpg" class="img-responsive" alt="avatar" /></div>
              <div class="item-message"><b>Maggie</b> - <small class="text-muted">12 minutes ago</small><br />
                Great work Yesterday!</div>
            </li>
            <li>
              <div class="item-avatar"><img src="img/avatars/header/3.jpg" class="img-responsive" alt="avatar" /></div>
              <div class="item-message"><b>Robert</b> - <small class="text-muted">3 hours ago</small><br />
                Is the Titan Project still on?</div>
            </li>
            <li>
              <div class="item-avatar"><img src="img/avatars/header/1.jpg" class="img-responsive" alt="avatar" /></div>
              <div class="item-message"><b>Cynthia</b> - <small class="text-muted">14 hours ago</small><br />
                Don't forget about the staff meeting tomorrow</div>
            </li>
            <li>
              <div class="item-avatar"><img src="img/avatars/header/4.jpg" class="img-responsive" alt="avatar" /></div>
              <div class="item-message"><b>Matt</b> - <small class="text-muted">2 days ago</small><br />
                Thor Project cancelled, Sorry.</div>
            </li>
          </ul>
        </li>
        <li class="dropdown-footer"><a href="#">View All Messages <i class="fa fa-caret-right"></i> </a></li>
      </ul>
    </div>-->
<?php
	$name="";
		$userdetails = user_load($user->uid);
		
		if($userdetails->field_first_name["und"][0]["value"] != "" && isset($userdetails->field_first_name["und"][0]["value"])){
				$name=$userdetails->field_first_name["und"][0]["value"]." ".$userdetails->field_last_name["und"][0]["value"];
				}
				else{
				$name= $userdetails->name;
				}
		
	?>
	
	
	 	<?php
if($user->uid)
{ 
?> 
    <div class="btn-group user-menu"><div class="dropdown-toggle padding-none img-pro" data-toggle="dropdown"> 
	<?php 
		if($userdetails->picture){
			$file = file_load($userdetails->picture->fid);
			$imgpath = $file->uri;
			
	?>
	<img  src="<?php print file_create_url($imgpath); ?>">
		
	<?php 
		}
		else{
	?>
			<img src="<?php echo $base_url."/".drupal_get_path('theme',$GLOBALS['theme']).'/images/no-profile-male-img.jpg'; ?>">
	<?php 
		}
	
		
	?> 

	</div>

      <button type="button" class="btn btn-default btn-gradient btn-sm dropdown-toggle btn-adminuser" data-toggle="dropdown"> <span class="glyphicons glyphicons-user"></span> <b><?php echo $name; ?></b> </button>
      <ul class="dropdown-menu checkbox-persist" role="menu">
        <li class="menu-arrow">
          <div class="menu-arrow-up"></div>
        </li>
        <li class="dropdown-header">Your Account <span class="pull-right glyphicons glyphicons-user"></span></li>
        <li>
          <ul class="dropdown-items">
          <!--  <li>
              <div class="item-icon"><i class="fa fa-envelope-o"></i> </div>
              <a class="item-message" href="#">Messages</a> </li>
            <li>-->
			<!--<li>
              <div class="item-icon"><i class="fa fa-envelope-o"></i> </div>
              <a class="item-message" href="<?php echo $base_url;?>/experience">Experience Listing</a> </li>-->
			 <!-- <li>
              <div class="item-icon"><i class="fa fa-envelope-o"></i> </div>
              <a class="item-message" href="<?php echo $base_url;?>/bookings">Bookings Details</a> </li>-->
            
			<!--<li>
              <div class="item-icon"><i class="fa fa-envelope-o"></i> </div>
              <a class="item-message" href="<?php echo $base_url;?>/user/dashboard">Dashboard</a> </li>-->
			 <!-- <li>
              <div class="item-icon"><i class="fa fa-envelope-o"></i> </div>
              <a class="item-message" href="<?php echo $base_url;?>/user/edit">Edit Profile</a> </li>--->
			  <li>
              <div class="item-icon"><i class="fa fa-envelope-o"></i> </div>
              <a class="item-message" href="<?php echo $base_url;?>/transactions/history">My Wallet</a> </li>
         <!--   <li>
              <div class="item-icon"><i class="fa fa-envelope-o"></i> </div>
              <a class="item-message" href="<?php echo $base_url;?>/income/details">My Earning</a> </li>-->			  
              <!--<li>
              <div class="item-icon"><i class="fa fa-envelope-o"></i> </div>
              <a class="item-message" href="<?php echo $base_url;?>/manage/listing">My Listings</a> </li>  	-->		  
			
			<?php
			
           $roles = $userdetails->roles;
		   if(in_array('administrator',$roles))
		   {
           ?>
		   <li>
		   <div class="item-icon"><i class="fa fa-envelope-o"></i> </div>
		   <a class="item-message" target="_blank" href="<?php echo $base_url; ?>/admin/gloobers/services">Gloobers Services</span></a> </li>
		   <?php
		   } 
			?>
			<li>
              <div class="item-icon"><i class="fa fa-calendar"></i> </div>
              <a class="item-message" href="<?php echo $base_url; ?>/user/edit">My Profile</a> </li>
            <li>
              <div class="item-icon"><i class="fa fa-sign-out"></i></div> <a href="<?php echo $base_url; ?>/user/logout">Sign Out</a>
            </li>
          </ul>
        </li>
      </ul>
	
    </div>
	 <?php
}
?>	 
  </div>
  
</header>

<?php
//if($user->uid)
//{ 
?>
<div id="main"> 
  <!-- Start: Sidebar -->
  <?php
if($user->uid)
{ 
?>
  <aside id="sidebar">
     <!-- <form role="search" />
        <input type="text" class="search-bar form-control" placeholder="Search" />
        <i class="fa fa-search field-icon-right"></i>
        <button type="submit" class="btn btn-default hidden"></button>
      </form>
      <div class="sidebar-toggle"> <i class="fa fa-bars"></i> </div>-->
		<div id="sidebar-menu"  class= "sidebar-menu dashboard">
			<!--<ul class="nav sidebar-nav">
				<li> <a href="<?php echo $base_url; ?>/user/dashboard"><span class="glyphicons glyphicons-star"></span><span class="sidebar-title">Dashboard</span></a> </li>
			
			</ul>-->
			
		</div>

<div id="cropContainerModal" class="cropme"> 
	<?php 
					if($userdetails->picture){
						$file = file_load($userdetails->picture->fid);
						$imgpath = $file->uri;
					//image to set dimension of 255 * 255	
				?>
				
		        <img class='picture' src="<?php print file_create_url($imgpath); ?>">
				<?php 
					}
					else{
				?>
					<img class='picture' src="<?php echo $base_url."/".drupal_get_path('theme',$GLOBALS['theme']).'/images/no-profile-male-img.jpg'; ?>">
				<?php 
					}
				?> 
	<span class="dr-cam"></span>	
    </div>
 <div class="nameblock">
      <p>Welcome <?php echo $userdetails->field_first_name["und"][0]["value"]; ?></p>
     </div>	

    <div id="sidebar-menu">
	<?php 
		if (check_plain(menu_get_active_title()) == "Add Product"){
			$eid = arg(3);
			$page1 = arg(2);
	?>
	<ul class="nav sidebar-nav">
	<li class="dm-dash"> <a href="<?php echo $base_url; ?>/user/dashboard"><span class="glyphicons glyphicons-star"></span><span class="sidebar-title">Dashboard</span></a> </li>
   <li><span class="add-listing">Add Listing</span></li>
	
		<li> <a class="accordion-toggle collapsed" href="#description"><span class="glyphicons glyphicons-settings"></span><span class="sidebar-title">Description</span><span class="caret"></span></a>
          <ul id="description" class="nav sub-nav">
            <li><a href="<?php echo $base_url; ?>/product/add/overview<?php if($eid != "") echo "/".$eid; ?>"  <?php if($page1 == "overview") echo "style='color:#05A3D2'"; ?>><span class="glyphicons glyphicons-edit"></span> Overview</a><?php $OverviewData=getOverviewData(arg(3)); $step1 = 0; if(!empty($OverviewData)){ $step1 = 1; ?><img src="<?php echo $base_url."/".drupal_get_path('theme',$GLOBALS['theme']).'/images/yes.png'; ?>"><?php } else {?><span class="plus">+</span><?php }?></li>
            <li><a <?php if(!isset($eid)) echo "class='disable'"; ?> href="<?php echo $base_url; ?>/product/add/photos<?php if($eid != "") echo "/".$eid; ?>" <?php if($page1 == "photos") echo "style='color:#05A3D2'"; ?>  ><span class="glyphicons glyphicons-book"></span> Photos </a><?php $PhotosData=getPhotosData(arg(3)); $step2 = 0; if(!empty($PhotosData)){ $step2 = 1; ?><img src="<?php echo $base_url."/".drupal_get_path('theme',$GLOBALS['theme']).'/images/yes.png'; ?>"><?php } else {?><span class="plus">+</span><?php }?></li>
            <li><a <?php if(!isset($eid)) echo "class='disable'"; ?> href="<?php echo $base_url; ?>/product/add/amenities<?php if($eid != "") echo "/".$eid; ?>" <?php if($page1 == "amenities") echo "style='color:#05A3D2'"; ?>  ><span class="glyphicons glyphicons-edit"></span> Amenities</a><?php $amentiesdata=getAmentiesByproduct(arg(3)); $step3 = 0; if(!empty($amentiesdata)){ $step3 = 1; ?><img src="<?php echo $base_url."/".drupal_get_path('theme',$GLOBALS['theme']).'/images/yes.png'; ?>"><?php } else {?><span class="plus">+</span><?php }?></li>
            <li><a <?php if(!isset($eid)) echo "class='disable'"; ?> href="<?php echo $base_url; ?>/product/add/location<?php if($eid != "") echo "/".$eid; ?>" <?php if($page1 == "location") echo "style='color:#05A3D2'"; ?>  ><span class="glyphicons glyphicons-book"></span> Location </a><?php $locationDetail=getListingData(arg(3)); $step4 = 0; if(!empty($locationDetail['latitude'])){ $step4 = 1; ?><img src="<?php echo $base_url."/".drupal_get_path('theme',$GLOBALS['theme']).'/images/yes.png'; ?>"><?php } else {?><span class="plus">+</span><?php }?></li>
          </ul>
        </li>
        <li> <a class="accordion-toggle collapsed" href="#pricing"><span class="glyphicons glyphicons-settings"></span><span class="sidebar-title">Pricing & Availabilities</span><span class="caret"></span></a>
          <ul id="pricing" class="nav sub-nav">
            	<li><a <?php if(!isset($eid)) echo "class='disable'"; ?> href="<?php echo $base_url; ?>/product/add/pricing<?php if($eid != "") echo "/".$eid; ?>" <?php if($page1 == "pricing") echo "style='color:#05A3D2'"; ?>><span class="glyphicons glyphicons-book"></span> Pricing </a><?php $pricingData = getPricingData(arg(3)); $step6 = 0; if(!empty($pricingData)){ $step6 = 1; ?><img src="<?php echo $base_url."/".drupal_get_path('theme',$GLOBALS['theme']).'/images/yes.png'; ?>"><?php } else {?><span class="plus">+</span><?php }?></li>
		<li><a <?php if(!isset($eid)) echo "class='disable'"; ?> href="<?php echo $base_url; ?>/product/add/scheduling<?php if($eid != "") echo "/".$eid; ?>" <?php if($page1 == "scheduling") echo "style='color:#05A3D2'"; ?>><span class="glyphicons glyphicons-edit"></span> Calendar</a><?php $calendarDetail=getSchedulingData(arg(3)); $step5 = 0; if(!empty($calendarDetail)){ $step5 = 1; ?><img src="<?php echo $base_url."/".drupal_get_path('theme',$GLOBALS['theme']).'/images/yes.png'; ?>"><?php } else {?><span class="plus">+</span><?php }?></li>
            			<li><a <?php if(!isset($eid)) echo "class='disable'"; ?> href="<?php echo $base_url; ?>/product/add/extra<?php if($eid != "") echo "/".$eid; ?>" <?php if($page1 == "extra") echo "style='color:#05A3D2'"; ?> ><span class="glyphicons glyphicons-book"></span> Additional Services </a><?php $extras = getProductExtraData(arg(3)); $step7 = 0; if(!empty($extras)){ $step7 = 1; ?><img src="<?php echo $base_url."/".drupal_get_path('theme',$GLOBALS['theme']).'/images/yes.png'; ?>"><?php } else {?><span class="plus">+</span><?php }?></li>
 		  	<li><a <?php if(!isset($eid)) echo "class='disable'"; ?> href="<?php echo $base_url; ?>/product/add/rules<?php if($eid != "") echo "/".$eid; ?>" <?php if($page1 == "rules") echo "style='color:#05A3D2'"; ?> ><span class="glyphicons glyphicons-edit"></span> Rules & Policies</a><?php $rulesDetail=getRulesDetails(arg(3)); $step8 = 0; if(!empty($rulesDetail)){ $step8 = 1; ?><img src="<?php echo $base_url."/".drupal_get_path('theme',$GLOBALS['theme']).'/images/yes.png'; ?>"><?php } else {?><span class="plus">+</span><?php }?></li>    
		 </ul>
        </li>
      <li> <a class="accordion-toggle collapsed" href="#optional"><span class="glyphicons glyphicons-settings"></span><span class="sidebar-title">Optional</span><span class="caret"></span></a>
          <ul id="optional" class="nav sub-nav">
            <li><a <?php if(!isset($eid)) echo "class='disable'"; ?> href="<?php echo $base_url; ?>/product/add/subscription<?php if($eid != "") echo "/".$eid; ?>" <?php if($page1 == "subscription") echo "style='color:#05A3D2'"; ?>><span class="glyphicons glyphicons-edit"></span> Boost your Listing</a><?php $subscriptionDetail=getListingPackageById(arg(3)); $step9 = 0; if(!empty($subscriptionDetail)){ $step9 = 1; ?><img src="<?php echo $base_url."/".drupal_get_path('theme',$GLOBALS['theme']).'/images/yes.png'; ?>"><?php } else {?><span class="plus">+</span><?php }?></li>
          </ul>
        </li>
      </ul>
	<?php 
		}
		else if(check_plain(menu_get_active_title()) == "Add Vacation Rentals"){
			$eid = arg(3);
			$page1 = arg(2);
	?>
      <ul class="nav sidebar-nav">
	  <li> <a href="<?php echo $base_url; ?>/user/dashboard"><span class="glyphicons glyphicons-star"></span><span class="sidebar-title">Dashboard</span></a> </li>
        <li> <a class="accordion-toggle collapsed" href="#description"><span class="glyphicons glyphicons-settings"></span><span class="sidebar-title">Description</span><span class="caret"></span></a>
          <ul id="description" class="nav sub-nav">
            <li><a href="<?php echo $base_url; ?>/add/rentals/overview<?php if($eid != "") echo "/".$eid; ?>"  <?php if($page1 == "overview") echo "style='color:#05A3D2'"; ?>><span class="glyphicons glyphicons-edit"></span> Overview</a><?php $OverviewData=getOverviewData(arg(3)); $step1 = 0; if(!empty($OverviewData)){ $step1 = 1; ?><img src="<?php echo $base_url."/".drupal_get_path('theme',$GLOBALS['theme']).'/images/yes.png'; ?>"><?php } else {?><span class="plus">+</span><?php }?></li>
            <li><a href="<?php echo $base_url; ?>/add/rentals/details<?php if($eid != "") echo "/".$eid; ?>"  <?php if($page1 == "details") echo "style='color:#05A3D2'"; ?>><span class="glyphicons glyphicons-edit"></span> Details</a><?php $OverviewData=getOverviewData(arg(3)); $step1 = 0; if(!empty($OverviewData)){ $step1 = 1; ?><img src="<?php echo $base_url."/".drupal_get_path('theme',$GLOBALS['theme']).'/images/yes.png'; ?>"><?php } else {?><span class="plus">+</span><?php }?></li>
            <li><a <?php //if(!isset($eid)) echo "class='disable'"; ?> href="<?php echo $base_url; ?>/add/rentals/photos<?php if($eid != "") echo "/".$eid; ?>" <?php if($page1 == "photos") echo "style='color:#05A3D2'"; ?>  ><span class="glyphicons glyphicons-book"></span> Photos </a><?php $PhotosData=getPhotosData(arg(3)); $step2 = 0; if(!empty($PhotosData)){ $step2 = 1; ?><img src="<?php echo $base_url."/".drupal_get_path('theme',$GLOBALS['theme']).'/images/yes.png'; ?>"><?php } else {?><span class="plus">+</span><?php }?></li>
            <li><a <?php //if(!isset($eid)) echo "class='disable'"; ?> href="<?php echo $base_url; ?>/add/rentals/amenities<?php if($eid != "") echo "/".$eid; ?>" <?php if($page1 == "amenities") echo "style='color:#05A3D2'"; ?>  ><span class="glyphicons glyphicons-edit"></span> Amenities</a><?php $amentiesdata=getAmentiesdata(arg(3)); $step3 = 0; if(!empty($amentiesdata)){ $step3 = 1; ?><img src="<?php echo $base_url."/".drupal_get_path('theme',$GLOBALS['theme']).'/images/yes.png'; ?>"><?php } else {?><span class="plus">+</span><?php }?></li>
            <li><a <?php //if(!isset($eid)) echo "class='disable'"; ?> href="<?php echo $base_url; ?>/add/rentals/location<?php if($eid != "") echo "/".$eid; ?>" <?php if($page1 == "location") echo "style='color:#05A3D2'"; ?>  ><span class="glyphicons glyphicons-book"></span> Location </a><?php $locationDetail=getListingData(arg(3)); $step4 = 0; if(!empty($locationDetail)){ $step4 = 1; ?><img src="<?php echo $base_url."/".drupal_get_path('theme',$GLOBALS['theme']).'/images/yes.png'; ?>"><?php } else {?><span class="plus">+</span><?php }?></li>
          </ul>
        </li>
        <li> <a class="accordion-toggle collapsed" href="#pricing"><span class="glyphicons glyphicons-settings"></span><span class="sidebar-title">Pricing & Availabilities</span><span class="caret"></span></a>
          <ul id="pricing" class="nav sub-nav">
            <li><a <?php //if(!isset($eid)) echo "class='disable'"; ?> href="<?php echo $base_url; ?>/add/rentals/scheduling<?php if($eid != "") echo "/".$eid; ?>" <?php if($page1 == "scheduling") echo "style='color:#05A3D2'"; ?>><span class="glyphicons glyphicons-edit"></span> Calendar</a><?php $calendarDetail=getSchedulingData(arg(3)); $step5 = 0; if(!empty($calendarDetail)){ $step5 = 1; ?><img src="<?php echo $base_url."/".drupal_get_path('theme',$GLOBALS['theme']).'/images/yes.png'; ?>"><?php } else {?><span class="plus">+</span><?php }?></li>
            <li><a <?php //if(!isset($eid)) echo "class='disable'"; ?> href="<?php echo $base_url; ?>/add/rentals/pricing<?php if($eid != "") echo "/".$eid; ?>" <?php if($page1 == "pricing") echo "style='color:#05A3D2'"; ?>><span class="glyphicons glyphicons-book"></span> Pricing </a><?php $pricingData = getPricingData(arg(3)); $step6 = 0; if(!empty($pricingData)){ $step6 = 1; ?><img src="<?php echo $base_url."/".drupal_get_path('theme',$GLOBALS['theme']).'/images/yes.png'; ?>"><?php } else {?><span class="plus">+</span><?php }?></li>
			<li><a <?php// if(!isset($eid)) echo "class='disable'"; ?> href="<?php echo $base_url; ?>/add/rentals/extra<?php if($eid != "") echo "/".$eid; ?>" <?php if($page1 == "extra") echo "style='color:#05A3D2'"; ?> ><span class="glyphicons glyphicons-book"></span> Additional Services </a><?php $extras = getProductExtraData(arg(3)); $step7 = 0; if(!empty($extras)){ $step7 = 1; ?><img src="<?php echo $base_url."/".drupal_get_path('theme',$GLOBALS['theme']).'/images/yes.png'; ?>"><?php } else {?><span class="plus">+</span><?php }?></li>
 		  	<li><a <?php //if(!isset($eid)) echo "class='disable'"; ?> href="<?php echo $base_url; ?>/add/rentals/rules<?php if($eid != "") echo "/".$eid; ?>" <?php if($page1 == "rules") echo "style='color:#05A3D2'"; ?> ><span class="glyphicons glyphicons-edit"></span> Rules & Policies</a><?php $rulesDetail=getRulesDetails(arg(3)); $step8 = 0; if(!empty($rulesDetail)){ $step8 = 1; ?><img src="<?php echo $base_url."/".drupal_get_path('theme',$GLOBALS['theme']).'/images/yes.png'; ?>"><?php } else {?><span class="plus">+</span><?php }?></li>       
		 </ul>
        </li>
        <li> <a class="accordion-toggle collapsed" href="#optional"><span class="glyphicons glyphicons-settings"></span><span class="sidebar-title">Optional</span><span class="caret"></span></a>
          <ul id="optional" class="nav sub-nav">
            <li><a <?php //if(!isset($eid)) echo "class='disable'"; ?> href="<?php echo $base_url; ?>/add/rentals/subscription<?php if($eid != "") echo "/".$eid; ?>" <?php if($page1 == "subscription") echo "style='color:#05A3D2'"; ?>><span class="glyphicons glyphicons-edit"></span> Boost your Listing</a><?php $subscriptionDetail=getListingPackageById(arg(3)); $step9 = 0; if(!empty($subscriptionDetail)){ $step9 = 1; ?><img src="<?php echo $base_url."/".drupal_get_path('theme',$GLOBALS['theme']).'/images/yes.png'; ?>"><?php } else {?><span class="plus">+</span><?php }?></li>
          </ul>
        </li>
      </ul>	
	<?php
		}
		else if(check_plain(menu_get_active_title()) == "Add Restaurant"){
			$eid = arg(3);
			$page1 = arg(2);
	?>
      <ul class="nav sidebar-nav">
        <li> <a class="accordion-toggle collapsed" href="#description"><span class="glyphicons glyphicons-settings"></span><span class="sidebar-title">Description</span><span class="caret"></span></a>
          <ul id="description" class="nav sub-nav">
            <li><a href="<?php echo $base_url; ?>/add/restaurant/overview<?php if($eid != "") echo "/".$eid; ?>"  <?php if($page1 == "overview") echo "style='color:#05A3D2'"; ?>><span class="glyphicons glyphicons-edit"></span> Overview</a><?php $OverviewData=getOverviewData(arg(3)); $step1 = 0; if(!empty($OverviewData)){ $step1 = 1; ?><img src="<?php echo $base_url."/".drupal_get_path('theme',$GLOBALS['theme']).'/images/yes.png'; ?>"><?php } else {?><span class="plus">+</span><?php }?></li>
            <li><a <?php //if(!isset($eid)) echo "class='disable'"; ?> href="<?php echo $base_url; ?>/add/restaurant/photos<?php if($eid != "") echo "/".$eid; ?>" <?php if($page1 == "photos") echo "style='color:#05A3D2'"; ?>  ><span class="glyphicons glyphicons-book"></span> Photos </a><?php $PhotosData=getPhotosData(arg(3)); $step2 = 0; if(!empty($PhotosData)){ $step2 = 1; ?><img src="<?php echo $base_url."/".drupal_get_path('theme',$GLOBALS['theme']).'/images/yes.png'; ?>"><?php } else {?><span class="plus">+</span><?php }?></li> 
            <li><a <?php //if(!isset($eid)) echo "class='disable'"; ?> href="<?php echo $base_url; ?>/add/restaurant/amenities<?php if($eid != "") echo "/".$eid; ?>" <?php if($page1 == "amenities") echo "style='color:#05A3D2'"; ?>  ><span class="glyphicons glyphicons-edit"></span> Services</a><?php $amentiesdata=getAmentiesdata(arg(3)); $step3 = 0; if(!empty($amentiesdata)){ $step3 = 1; ?><img src="<?php echo $base_url."/".drupal_get_path('theme',$GLOBALS['theme']).'/images/yes.png'; ?>"><?php } else {?><span class="plus">+</span><?php }?></li>
            <li><a <?php //if(!isset($eid)) echo "class='disable'"; ?> href="<?php echo $base_url; ?>/add/restaurant/location<?php if($eid != "") echo "/".$eid; ?>" <?php if($page1 == "location") echo "style='color:#05A3D2'"; ?>  ><span class="glyphicons glyphicons-book"></span> Location </a><?php $locationDetail=getListingData(arg(3)); $step4 = 0; if(!empty($locationDetail)){ $step4 = 1; ?><img src="<?php echo $base_url."/".drupal_get_path('theme',$GLOBALS['theme']).'/images/yes.png'; ?>"><?php } else {?><span class="plus">+</span><?php }?></li>
          </ul>
        </li>
        <li> <a class="accordion-toggle collapsed" href="#pricing"><span class="glyphicons glyphicons-settings"></span><span class="sidebar-title">Pricing & Availabilities</span><span class="caret"></span></a>
          <ul id="pricing" class="nav sub-nav">
            <li><a <?php //if(!isset($eid)) echo "class='disable'"; ?> href="<?php echo $base_url; ?>/add/restaurant/scheduling<?php if($eid != "") echo "/".$eid; ?>" <?php if($page1 == "scheduling") echo "style='color:#05A3D2'"; ?>><span class="glyphicons glyphicons-edit"></span> Calendar</a><?php $calendarDetail=getSchedulingData(arg(3)); $step5 = 0; if(!empty($calendarDetail)){ $step5 = 1; ?><img src="<?php echo $base_url."/".drupal_get_path('theme',$GLOBALS['theme']).'/images/yes.png'; ?>"><?php } else {?><span class="plus">+</span><?php }?></li>
            <li><a <?php //if(!isset($eid)) echo "class='disable'"; ?> href="<?php echo $base_url; ?>/add/restaurant/pricing<?php if($eid != "") echo "/".$eid; ?>" <?php if($page1 == "pricing") echo "style='color:#05A3D2'"; ?>><span class="glyphicons glyphicons-book"></span> Pricing </a><?php $pricingData = getPricingData(arg(3)); $step6 = 0; if(!empty($pricingData)){ $step6 = 1; ?><img src="<?php echo $base_url."/".drupal_get_path('theme',$GLOBALS['theme']).'/images/yes.png'; ?>"><?php } else {?><span class="plus">+</span><?php }?></li>
			<li><a <?php// if(!isset($eid)) echo "class='disable'"; ?> href="<?php echo $base_url; ?>/add/restaurant/extra<?php if($eid != "") echo "/".$eid; ?>" <?php if($page1 == "extra") echo "style='color:#05A3D2'"; ?> ><span class="glyphicons glyphicons-book"></span> Additional Services </a><?php $extras = getProductExtraData(arg(3)); $step7 = 0; if(!empty($extras)){ $step7 = 1; ?><img src="<?php echo $base_url."/".drupal_get_path('theme',$GLOBALS['theme']).'/images/yes.png'; ?>"><?php } else {?><span class="plus">+</span><?php }?></li>
 		  	<li><a <?php //if(!isset($eid)) echo "class='disable'"; ?> href="<?php echo $base_url; ?>/add/restaurant/rules<?php if($eid != "") echo "/".$eid; ?>" <?php if($page1 == "rules") echo "style='color:#05A3D2'"; ?> ><span class="glyphicons glyphicons-edit"></span> Rules & Policies</a><?php $rulesDetail=getRulesDetails(arg(3)); $step8 = 0; if(!empty($rulesDetail)){ $step8 = 1; ?><img src="<?php echo $base_url."/".drupal_get_path('theme',$GLOBALS['theme']).'/images/yes.png'; ?>"><?php } else {?><span class="plus">+</span><?php }?></li>       
		 </ul>
        </li>
        <li> <a class="accordion-toggle collapsed" href="#optional"><span class="glyphicons glyphicons-settings"></span><span class="sidebar-title">Optional</span><span class="caret"></span></a>
          <ul id="optional" class="nav sub-nav">
            <li><a <?php //if(!isset($eid)) echo "class='disable'"; ?> href="<?php echo $base_url; ?>/add/restaurant/subscription<?php if($eid != "") echo "/".$eid; ?>" <?php if($page1 == "subscription") echo "style='color:#05A3D2'"; ?>><span class="glyphicons glyphicons-edit"></span> Boost your Listing</a><?php $subscriptionDetail=getProductSubscriptionData(arg(3)); $step9 = 0; if(!empty($subscriptionDetail)){ $step9 = 1; ?><img src="<?php echo $base_url."/".drupal_get_path('theme',$GLOBALS['theme']).'/images/yes.png'; ?>"><?php } else {?><span class="plus">+</span><?php }?></li></li>
          </ul>
        </li>
      </ul>	
	<?php
		}
		else{
	?>  
      <ul class="nav sidebar-nav">
        <li> <a href="<?php echo $base_url; ?>/user/dashboard"><span class="glyphicons glyphicons-star"></span><span class="sidebar-title">Dashboard</span></a> </li>
        <!--<li> <a class="accordion-toggle collapsed" href="#resources"><span class="glyphicons glyphicons-settings"></span><span class="sidebar-title">Inventory</span><span class="caret"></span></a>
          <ul id="resources" class="nav sub-nav">
          <!--  <li><a href="<?php echo $base_url; ?>/product/add/overview"><span class="glyphicons glyphicons-edit"></span> Add Listing</a></li>-->
            <!--<li><a href="#"><span class="glyphicons glyphicons-book"></span> Catalogs </a></li>-->
          <!--</ul>
        </li>-->
        <!--<li> <a href="#"><span class="glyphicons glyphicons-book_open"></span><span class="sidebar-title">Inbox</span></a> </li>-->
        <li> <a href="<?php echo url('manage/listing');?>"><span class="glyphicons glyphicons-star"></span><span class="sidebar-title">My Listings</span></a> </li>
		 <li> <a href="<?php echo url('bookings');?>"><span class="glyphicons glyphicons-globe"></span><span class="sidebar-title">My Reservations</span></a> </li>
		   <li> <a href="<?php echo url('mytrips');?>"><span class="glyphicons glyphicons-globe"></span><span class="sidebar-title">My Trips</span></a> </li>
        <li> <a href="<?php echo $base_url; ?>/user/edit"><span class="glyphicons glyphicons-star"></span><span class="sidebar-title">My Profile</span></a> </li>
         
       
		<!--<li> <a href="#"><span class="glyphicons glyphicons-star"></span><span class="sidebar-title">Account</span></a> </li>-->
      </ul>
	<?php 
		}
	?> 
	  
    </div>
  </aside>
 <?php
}
?> 
  <!-- End: Sidebar --> 
  <!-- Start: Content -->
  <section id="content">
   <!-- <div id="topbar">
      <ol class="breadcrumb">
        <li><a href="dashboard.html"><i class="fa fa-home"></i></a></li>
        <li><a href="index.html">Home</a></li>
        <li class="active">Blank Page</li>
      </ol>
	<?php 
		if (check_plain(menu_get_active_title()) == "Add Product"){
	?>
	  	  <div class="remaining-steps"><p>Complete <span><?php echo (9-($step1+$step2+$step3+$step4+$step5+$step6+$step7+$step8+$step9)) ?> steps</span> to list your experience.</p></div>
    <?php 
		}
	?>
	</div>-->
	<?php
	if(strpos(current_path(),'product/add')>-1 && $user->uid)
	{
	?>
	<div id="topbar">
	 <div class="wizard-wrapper">
                 <ul class="wizard-steps">
                <li <?php 
					$overviewData=getOverviewData(arg(3));
					if($overviewData)
					{
					print 'class="passed"';
					}
					if(arg(2)=="overview"){ print 'class="active"';}   ?>>
					    <a href="<?php  echo $base_url; ?>/product/add/overview<?php if($eid != "") echo "/".$eid; ?>">
                      <div class="wizard-icon overview-wizard"><i class="fa fa-pencil"></i> </div>
                      <span <?php  if(arg(2)=="overview"){print 'style="color:#0094d2;"';}?>> Overview </span> </a></li>
					  
                 <li
					<?php 
					//$photoData=getPhotosData(arg(3));
					if($PhotosData)
					{
					print 'class="passed"';
					}
					if(arg(2)=="photos"){ print 'class="active"';}
                    ?>>
					   <a <?php if(!isset($eid)) echo "class='disable'"; ?>
					  href="<?php echo $base_url; ?>/product/add/photos<?php if($eid != "") echo "/".$eid; ?>">
                      <div class="wizard-icon photos-wizard"><i class="fa fa-file-image-o"></i> </div>
                      <span  <?php if(arg(2)=="photos"){print 'style="color:#0094d2;"';} ?> >Photos</span></a></li>
					  
                    <li
					<?php 
					//$amenitiesData=getAmentiesByproduct(arg(3));
					if($amentiesdata)
					{
					print 'class="passed"';
					}
					if(arg(2)=="amenities"){ print 'class="active"';}
                    ?>>
					<a <?php if(!isset($eid) || empty($PhotosData)) echo "class='disable'"; ?> 
					  href="<?php echo $base_url; ?>/product/add/amenities<?php if($eid != "") echo "/".$eid; ?>">
                      <div class="wizard-icon amenities-wizard"><i class="fa fa-bus"></i> </div>
                      <span <?php if(arg(2)=="amenities"){print 'style="color:#0094d2;"';} ?> >Amenities</span>
					  </a></li>
					  
					 
					  <li
					 <?php 
					$listingData=getListingData(arg(3));
					if(($listingData['latitude']!="") && ($listingData['longitude']!=""))
					{
					print 'class="passed"';
					}
					if(arg(2)=="location"){ print 'class="active"';}
                    ?>>
					<a <?php if(!isset($eid) || empty($amentiesdata)) echo "class='disable'"; ?> 
					  href="<?php echo $base_url; ?>/product/add/location<?php if($eid != "") echo "/".$eid; ?>">
                      <div class="wizard-icon location-wizard"><i class="fa fa-map-marker"></i> </div>
                      <span <?php if(arg(2)=="location"){print 'style="color:#0094d2;"';} ?>>Location</span>
					  </a></li>
					<li
					<?php 
					//$pricingData = getPricingData(arg(3));
					if($pricingData)
					{
					print 'class="passed"';
					}
					if(arg(2)=="pricing"){ print 'class="active"';}
                    ?>>
					 <a <?php if(!isset($eid)|| ($listingData['latitude']=="")) echo "class='disable'"; ?> 
					   href="<?php echo $base_url; ?>/product/add/pricing<?php if($eid != "") echo "/".$eid; ?>" >
                       <div class="wizard-icon pricing-wizard"><i class="fa fa-usd"></i> </div>
                       <span  <?php if(arg(2)=="pricing"){print 'style="color:#0094d2;"';} ?>>Pricing</span>
					</a>  </li> 
	  
					  <li
					<?php 
					//$calendarDetail=getSchedulingData(arg(3));
					if($calendarDetail)
					{
					print 'class="passed"';
					}
					if(arg(2)=="scheduling"){ print 'class="active"';}
                    ?>>
					<a <?php if(!isset($eid) || empty($pricingData)) echo "class='disable'"; ?> 
					   href="<?php echo $base_url; ?>/product/add/scheduling<?php if($eid != "") echo "/".$eid; ?>">
                       <div class="wizard-icon overview-scheduling"><i class="fa fa-calendar"></i> </div>
                       <span <?php if(arg(2)=="scheduling"){print 'style="color:#0094d2;"';} ?>>Calendar</span>
					 </a> </li>
					  

					  <li
					  <?php
					  //$extras = getProductExtraData(arg(3));
					   if($extras)
					   {  print 'class="passed"';  }
					  if(arg(2)=="extra"){ print 'class="active"';}
                     ?>>
					 <a <?php  if(!isset($eid) || empty($calendarDetail)) echo "class='disable'"; ?> 
						href="<?php echo $base_url; ?>/product/add/extra<?php if($eid != "") echo "/".$eid; ?>" >
                        <div class="wizard-icon extra-wizard"><i class="fa fa-plus-square-o"></i> </div>
                        <span <?php if(arg(2)=="extra"){print 'style="color:#0094d2;"';} ?>>Additional Services</span></a>
					  </li>
					  
					 <li
					  <?php
					  //$rulesDetail=getRulesDetails(arg(3));
					   if($rulesDetail)
					   {  print 'class="passed"';  }
					  if(arg(2)=="rules"){ print 'class="active"';}
                    ?>>
					 <a <?php if(!isset($eid) || empty($extras)) echo "class='disable'"; ?> 
						href="<?php echo $base_url; ?>/product/add/rules<?php if($eid != "") echo "/".$eid; ?>">
                        <div class="wizard-icon rules-wizard"><i class="fa fa-lock"></i> </div>
                        <span <?php if(arg(2)=="rules"){print 'style="color:#0094d2;"';} ?>>Rules and Policies</span>
					 </a> </li>
					<li
					  <?php
					  $packageData = getListingPackageById(arg(3)); 
					   if(!empty($packageData))
					   {  print 'class="passed"';  }
					   if(arg(2)=="subscription" || arg(2)=="payment"){ print 'class="active"';}
					  ?>>
					  <a <?php if(!isset($eid) || empty($rulesDetail)) echo "class='disable'"; ?> 
						href="<?php echo $base_url; ?>/product/add/subscription<?php if($eid != "") echo "/".$eid; ?>" >
                        <div class="wizard-icon boost-wizard"><i class="fa fa-paypal"></i> </div>
                        <span <?php if(arg(2)=="subscription" || arg(2)=="payment"){print 'style="color:#0094d2;"';}?>>Boost Your Listing</span>
					  </a></li>
                  </ul>
                </div>
           </div>
		 <?php
         }
			else if(strpos(current_path(),'add/restaurant')>-1)
			{
         ?>
	<div id="topbar">
	 <div class="wizard-wrapper">
                  <ul class="wizard-steps">
                    <li <?php 
					$overviewData=getOverviewData(arg(3));
					if($overviewData)
					{
					print 'class="passed"';
					}
					if(arg(2)=="overview"){ print 'class="active"';}
                    ?>>
                      <div class="wizard-icon overview-wizard"><i class="fa fa-pencil"></i> </div>
                      <a <?php  if(arg(2)=="overview"){print 'style="color:#0094d2;"';}?> href="<?php  echo $base_url; ?>/add/restaurant/overview<?php if($eid != "") echo "/".$eid; ?>" >Overview</a></li>
                    <li
					<?php 
					//$photoData=getPhotosData(arg(3));
					if($PhotosData)
					{
					print 'class="passed"';
					}
					if(arg(2)=="photos"){ print 'class="active"';}
                    ?>>
                      <div class="wizard-icon photos-wizard"><i class="fa fa-file-image-o"></i> </div>
                      <a  <?php if(arg(2)=="photos"){print 'style="color:#0094d2;"';} if(!isset($eid)) echo "class='disable'"; ?>
					  href="<?php echo $base_url; ?>/add/restaurant/photos<?php if($eid != "") echo "/".$eid; ?>" >Photos</a></li>
                    <li
					<?php 
					//$amenitiesData=getAmentiesByproduct(arg(3));
					if($amentiesdata)
					{
					//print 'class="passed"';
					}
					if(arg(2)=="amenities"){ print 'class="active"';}
                    ?>>
                      <div class="wizard-icon amenities-wizard"><i class="fa fa-bus"></i> </div>
                      <a <?php if(arg(2)=="amenities"){print 'style="color:#0094d2;"';} if(!isset($eid)) echo "class='disable'"; ?> 
					  href="<?php echo $base_url; ?>/add/restaurant/amenities<?php if($eid != "") echo "/".$eid; ?>" >Services</a>
					  </li>
					 <li
					 <?php 
					$listingData=getListingData(arg(3));
					if(($listingData['latitude']!="") && ($listingData['longitude']!=""))
					{
					print 'class="passed"';
					}
					if(arg(2)=="location"){ print 'class="active"';}
                    ?>>
                      <div class="wizard-icon location-wizard"><i class="fa fa-map-marker"></i> </div>
                      <a <?php if(arg(2)=="location"){print 'style="color:#0094d2;"';}
					  if(!isset($eid)) echo "class='disable'"; ?> 
					  href="<?php echo $base_url; ?>/add/restaurant/location<?php if($eid != "") echo "/".$eid; ?>">Location</a>
					  </li>
					  <li
					<?php 
					//$calendarDetail=getSchedulingData(arg(3));
					if($calendarDetail)
					{
					print 'class="passed"';
					}
					if(arg(2)=="scheduling"){ print 'class="active"';}
                    ?>>
                       <div class="wizard-icon overview-scheduling"><i class="fa fa-calendar"></i> </div>
                       <a <?php if(arg(2)=="scheduling"){print 'style="color:#0094d2;"';}
					   if(!isset($eid)) echo "class='disable'"; ?> 
					   href="<?php echo $base_url; ?>/add/restaurant/scheduling<?php if($eid != "") echo "/".$eid; ?>">Calendar</a>
					  </li>
					  <li
					<?php 
					//$pricingData = getPricingData(arg(3));
					if($pricingData)
					{
					print 'class="passed"';
					}
					if(arg(2)=="pricing"){ print 'class="active"';}
                    ?>>
                       <div class="wizard-icon pricing-wizard"><i class="fa fa-usd"></i> </div>
                       <a  <?php if(arg(2)=="pricing"){print 'style="color:#0094d2;"';}
					   if(!isset($eid)) echo "class='disable'"; ?> 
					   href="<?php echo $base_url; ?>/add/restaurant/pricing<?php if($eid != "") echo "/".$eid; ?>" >Pricing</a>
					  </li> 
					  <li
					  <?php
					  //$extras = getProductExtraData(arg(3));
					   if($extras)
					   {  print 'class="passed"';  }
					  if(arg(2)=="extra"){ print 'class="active"';}
                     ?>>
                        <div class="wizard-icon extra-wizard"><i class="fa fa-plus-square-o"></i> </div>
                        <a <?php if(arg(2)=="extra"){print 'style="color:#0094d2;"';}
						if(!isset($eid)) echo "class='disable'"; ?> 
						href="<?php echo $base_url; ?>/add/restaurant/extra<?php if($eid != "") echo "/".$eid; ?>" >Additional Services</a>
					  </li>
					  <li
					  <?php
					  //$rulesDetail=getRulesDetails(arg(3));
					   if($rulesDetail)
					   {  print 'class="passed"';  }
					  if(arg(2)=="rules"){ print 'class="active"';}
                    ?>>
                        <div class="wizard-icon rules-wizard"><i class="fa fa-lock"></i> </div>
                        <a <?php if(arg(2)=="rules"){print 'style="color:#0094d2;"';}
						if(!isset($eid)) echo "class='disable'"; ?> 
						href="<?php echo $base_url; ?>/add/restaurant/rules<?php if($eid != "") echo "/".$eid; ?>">Rules and Policies</a>
					  </li>
					  <li
					  <?php
					  //class="passed"
					   if(arg(2)=="subscription"){ print 'class="active"';}
					  ?>>
                        <div class="wizard-icon boost-wizard"><i class="fa fa-paypal"></i> </div>
                        <a <?php if(arg(2)=="subscription"){print 'style="color:#0094d2;"';}
						if(!isset($eid)) echo "class='disable'"; ?> 
						href="<?php echo $base_url; ?>/add/restaurant/subscription<?php if($eid != "") echo "/".$eid; ?>">Boost Your Listing</a>
					  </li>
                  </ul>
                </div>
           </div>	
	<?php 
		}
			else if(strpos(current_path(),'add/rentals')>-1)
			{		
	?>	
	<div id="topbar">
	 <div class="wizard-wrapper">
                  <ul class="wizard-steps">
                    <li <?php 
					$overviewData=getOverviewData(arg(3));
					if($overviewData)
					{
					print 'class="passed"';
					}
					if(arg(2)=="overview" || arg(2)=="details"){ print 'class="active"';}
                    ?>>
                      <div class="wizard-icon overview-wizard"><i class="fa fa-pencil"></i> </div>
                      <a <?php  if(arg(2)=="overview" || arg(2)=="details"){print 'style="color:#0094d2;"';}?> href="<?php  echo $base_url; ?>/add/rentals/overview<?php if($eid != "") echo "/".$eid; ?>" >Overview & Details</a></li>
                    <li
					<?php 
					//$photoData=getPhotosData(arg(3));
					if($PhotosData)
					{
					print 'class="passed"';
					}
					if(arg(2)=="photos"){ print 'class="active"';}
                    ?>>
                      <div class="wizard-icon photos-wizard"><i class="fa fa-file-image-o"></i> </div>
                      <a  <?php if(arg(2)=="photos"){print 'style="color:#0094d2;"';} if(!isset($eid)) echo "class='disable'"; ?>
					  href="<?php echo $base_url; ?>/add/rentals/photos<?php if($eid != "") echo "/".$eid; ?>" >Photos</a></li>
                    <li
					<?php 
					//$amenitiesData=getAmentiesByproduct(arg(3));
					if($amentiesdata)
					{
					//print 'class="passed"';
					}
					if(arg(2)=="amenities"){ print 'class="active"';}
                    ?>>
                      <div class="wizard-icon amenities-wizard"><i class="fa fa-bus"></i> </div>
                      <a <?php if(arg(2)=="amenities"){print 'style="color:#0094d2;"';} if(!isset($eid)) echo "class='disable'"; ?> 
					  href="<?php echo $base_url; ?>/add/rentals/amenities<?php if($eid != "") echo "/".$eid; ?>" >Services</a>
					  </li>
					 <li
					 <?php 
					$listingData=getListingData(arg(3));
					if(($listingData['latitude']!="") && ($listingData['longitude']!=""))
					{
					print 'class="passed"';
					}
					if(arg(2)=="location"){ print 'class="active"';}
                    ?>>
                      <div class="wizard-icon location-wizard"><i class="fa fa-map-marker"></i> </div>
                      <a <?php if(arg(2)=="location"){print 'style="color:#0094d2;"';}
					  if(!isset($eid)) echo "class='disable'"; ?> 
					  href="<?php echo $base_url; ?>/add/rentals/location<?php if($eid != "") echo "/".$eid; ?>">Location</a>
					  </li>
					  <li
					<?php 
					//$calendarDetail=getSchedulingData(arg(3));
					if($calendarDetail)
					{
					print 'class="passed"';
					}
					if(arg(2)=="scheduling"){ print 'class="active"';}
                    ?>>
                       <div class="wizard-icon overview-scheduling"><i class="fa fa-calendar"></i> </div>
                       <a <?php if(arg(2)=="scheduling"){print 'style="color:#0094d2;"';}
						if(!isset($eid)) echo "class='disable'"; ?> 
					   href="<?php echo $base_url; ?>/add/rentals/scheduling<?php if($eid != "") echo "/".$eid; ?>">Calendar</a>
					  </li>
					  <li
					<?php 
					//$pricingData = getPricingData(arg(3));
					if($pricingData)
					{
					print 'class="passed"';
					}
					if(arg(2)=="pricing"){ print 'class="active"';}
                    ?>>
                       <div class="wizard-icon pricing-wizard"><i class="fa fa-usd"></i> </div>
                       <a  <?php if(arg(2)=="pricing"){print 'style="color:#0094d2;"';}
					   if(!isset($eid)) echo "class='disable'"; ?> 
					   href="<?php echo $base_url; ?>/add/rentals/pricing<?php if($eid != "") echo "/".$eid; ?>" >Pricing</a>
					  </li> 
					  <li
					  <?php
					  //$extras = getProductExtraData(arg(3));
					   if($extras)
					   {  print 'class="passed"';  }
					  if(arg(2)=="extra"){ print 'class="active"';}
                     ?>>
                        <div class="wizard-icon extra-wizard"><i class="fa fa-plus-square-o"></i> </div>
                        <a <?php if(arg(2)=="extra"){print 'style="color:#0094d2;"';}
						if(!isset($eid)) echo "class='disable'"; ?> 
						href="<?php echo $base_url; ?>/add/rentals/extra<?php if($eid != "") echo "/".$eid; ?>" >Additional Services</a>
					  </li>
					  <li
					  <?php
					  //$rulesDetail=getRulesDetails(arg(3));
					   if($rulesDetail)
					   {  print 'class="passed"';  }
					  if(arg(2)=="rules"){ print 'class="active"';}
                    ?>>
                        <div class="wizard-icon rules-wizard"><i class="fa fa-lock"></i> </div>
                        <a <?php if(arg(2)=="rules"){print 'style="color:#0094d2;"';}
						if(!isset($eid)) echo "class='disable'"; ?> 
						href="<?php echo $base_url; ?>/add/rentals/rules<?php if($eid != "") echo "/".$eid; ?>">Rules and Policies</a>
					  </li>
					  <li
					  <?php
					  //class="passed"
					   if(arg(2)=="subscription"){ print 'class="active"';}
					  ?>>
                        <div class="wizard-icon boost-wizard"><i class="fa fa-paypal"></i> </div>
                        <a <?php if(arg(2)=="subscription"){print 'style="color:#0094d2;"';}
							if(!isset($eid)) echo "class='disable'"; ?> 
						href="<?php echo $base_url; ?>/add/rentals/subscription<?php if($eid != "") echo "/".$eid; ?>">Boost Your Listing</a>
					  </li>
                  </ul>
                </div>
           </div>	
	<?php 
		}
	?> 
	<!------------------------->
	  <?php if ($messages): ?>
		<div id="messages"><div class="section clearfix">
		  <?php print $messages; ?>
		</div></div> <!-- /.section, /#messages -->
	  <?php endif; ?>	
    <div class="container">
			<?php print render($page['content']); ?>
	</div>
  </section>
  <!-- End: Content --> 
</div>
<?php 
//}
//else
//{
//drupal_goto('login');
//}
?>
<!-- End: Main --> 


<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script> 

<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/js/jquery.meanmenu.js' ?>"></script>
<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/js/jquery.leanModal.min.js' ?>"></script>
<!--<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/js/jquery.ui.plupload.js' ?>"></script>-->
<!--<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/js/jquery.datetimepicker.js' ?>"></script>-->
<!-- Theme Javascript --> 
<script type="text/javascript" src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/js/uniform.min.js' ?>"></script> 
<script type="text/javascript" src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/js/main.js' ?>"></script>
<script type="text/javascript" src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/js/custom.js' ?>"></script> 
<script type="text/javascript" src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/js/vendor/plugins/daterange/moment.min.js' ?>"></script> 
<script type="text/javascript" src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/js/vendor/plugins/daterange/daterangepicker.js' ?>"></script> 
<script type="text/javascript" src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/js/vendor/plugins/timepicker/bootstrap-timepicker.min.js' ?>"></script> 
<script type="text/javascript" src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/js/vendor/plugins/datepicker/bootstrap-datepicker.js' ?>"></script> 

<script type="text/javascript" src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/js/jquery.colorbox.js' ?>"></script> 
<!--<script type="text/javascript" src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/js/croppic.min.js' ?>"></script> -->
<script type="text/javascript" src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/js/jquery.Jcrop.js' ?>"></script> 
<script type="text/javascript" src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/js/jquery.SimpleCropper.js' ?>"></script> 
<!--<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/js/bootstrap.min.js" type="text/javascript"></script>-->
<!--<script src="//cdn.jsdelivr.net/fullcalendar/1.5.4/fullcalendar.js" type="text/javascript"></script>-->
<?php
//drupal_add_js(drupal_get_path('theme', 'gloobers2') .'/js/bootstrap.min.js',array('scope' => 'footer'));
 ?>

<script type="text/javascript">
 jQuery(document).ready(function() {
 	 jQuery('.cropme').simpleCropper();
	// Init Theme Core 	  
	Core.init();
	/* 	jQuery('.datepicker').datepicker(); */
	jQuery('.datetimepicker').datepicker();
	jQuery('.timepicker').timepicker();
	var nowTemp = new Date();
	var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

	jQuery('.datepicker').datepicker({
	     format: 'yyyy-mm-dd',
		onRender: function(date) {
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
	});	
</script>
<?php 
	global $base_url;
	$library_path = _plupload_library_path(); 
?>
 

<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/js/responsiveslides.min.js' ?>"></script>
  <script>
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
		
    });
	
			/* var croppicHeaderOptions = {
				uploadUrl:'<?php echo $base_url; ?>/user/profile/upload',
				cropData:{
					"dummyData":1,
					"dummyData2":"asdas"
				},
				cropUrl:'<?php echo $base_url; ?>/user/profile/crop',
				customUploadButtonId:'cropContainerHeaderButton',
				modal:false,
				loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
				onBeforeImgUpload: function(){ console.log('onBeforeImgUpload') },
				onAfterImgUpload: function(){ console.log('onAfterImgUpload') },
				onImgDrag: function(){ console.log('onImgDrag') },
				onImgZoom: function(){ console.log('onImgZoom') },
				onBeforeImgCrop: function(){ console.log('onBeforeImgCrop') },
				onAfterImgCrop:function(){ console.log('onAfterImgCrop') }
		}	
		var croppic = new Croppic('croppic', croppicHeaderOptions);
		
		
		var croppicContainerModalOptions = {
				uploadUrl:'<?php echo $base_url; ?>/user/profile/upload',
				cropUrl:'<?php echo $base_url; ?>/user/profile/crop',
				modal:true,
				imgEyecandyOpacity:0.4,
				loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> '
		}
		var cropContainerModal = new Croppic('cropContainerModal', croppicContainerModalOptions);
		
		
		var croppicContaineroutputOptions = {
				uploadUrl:'<?php echo $base_url; ?>/user/profile/upload',
				cropUrl:'<?php echo $base_url; ?>/user/profile/crop', 
				outputUrlId:'cropOutput',
				modal:false,
				loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> '
		}
		var cropContaineroutput = new Croppic('cropContaineroutput', croppicContaineroutputOptions);
		
		var croppicContainerEyecandyOptions = {
				uploadUrl:'<?php echo $base_url; ?>/user/profile/upload',
				cropUrl:'<?php echo $base_url; ?>/user/profile/crop',
				imgEyecandy:false,
				loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> '
		}
		var cropContainerEyecandy = new Croppic('cropContainerEyecandy', croppicContainerEyecandyOptions); */
  </script>
  <script type="text/javascript">
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
  
});
</script>
