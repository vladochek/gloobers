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
	 drupal_add_js(drupal_get_path('theme', 'gloobers') .'/js/jquery-1.11.0.min.js', 'file');	
	 drupal_add_js(drupal_get_path('theme', 'gloobers') .'/js/home.js',array('scope' => 'footer'));
     $notiCount=getNotificationsCount();
     $notifications=getNotifications(4);	 
	 
?>
<script>
	$baseURL = "<?php echo $base_url;?>";
</script>	

<link href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/css/style.css' ?>" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/css/meanmenu.css' ?>" media="all" />
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" />
<link rel="stylesheet" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/css/sldie-paralex-demo.css' ?>" media="all" />
<link rel="stylesheet" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/css/responsiveslides.css' ?>" media="all" />
<link rel="stylesheet" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/css/leanModal.css' ?>" media="all" />
<link rel="stylesheet" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/css/jquery-ui.css' ?>" media="all" />
<link rel="stylesheet" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/css/experience.css' ?>" media="all" />
<link rel="stylesheet" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/css/flexslider.css' ?>" media="all" />
<link rel="stylesheet" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/css/easy-responsive-tabs.css' ?>" media="all" />
<link rel="stylesheet" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/css/gloobers.css' ?>" media="all" />
<link rel="stylesheet" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/css/responsive-styles.css' ?>" media="all" />
<link rel="stylesheet" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/css/colorbox.css' ?>" media="all" />
<?php
//drupal_add_css(drupal_get_path('theme', 'gloobers') .'/css/responsive-styles.css','file');  
?>
<!--<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>-->



<!--<link type="text/css" rel="stylesheet" href="http://plupload.com/plupload/js/jquery.ui.plupload/css/jquery.ui.plupload.css" media="screen" />-->
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>
<?php
	if(drupal_is_front_page() ){
	/* drupal_session_start();
	_drupal_session_write('advisor_search',''); */

?>
		<div class="dt-main-header no-bg" >
        	<a class="dr-logo" href="<?php echo $base_url; ?>">
            	<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/logo-main.png" alt="Gloober logo" />
            </a>                
                
   <!-- ===================== 7 oct ========================= -->             
            		 
     <div class="dr-right-login user-in">
				
	<!--======================================================-->
	<?php 
	
	if($user->uid)
	{

?>	
	   
		   <div class="advice-form">
			  <a class="" href="<?php echo url('gloobers/finder')?>">Gloobers Finder</a> 				 
		  </div> 
	  
<?php  
}
?>	  
       <!--======================================================-->   
                    <?php 
						
						if(!$user->uid){
				   ?>               	
                    <div class="profile-menu nav-space">
                		<a href="<?php echo $base_url;?>/user/register">Sign Up</a>
						<a href="<?php echo $base_url;?>/login"> Log in </a>  
                     </div>
                    	 
					<?php 
						}
						else{
					?>
				<span class="noti-icon"><strong id="noti-count"><?php if($notiCount > 0) { echo $notiCount; } ?></strong></span>
				<ul class="dropdown-menu dropdown-inverse" style="display:none;">
				<li><span><?php print t('Notifications');?>(<?php echo $notiCount; ?>)</span><label class="mark_as_read make_read_all"><?php print t('Mark as read');?></label></li>
				<?php 
				//print_r( $notifications );
				//die;
				/*foreach($notifications as $notification)
				{
				$url="#";
				if($notification["read_status"] == 0){
					$class="unread";
				}
				else{
					$class="read";
				}
				$userInfo=user_load($notification['sender_id']);
				if(!empty($userInfo->picture)){
					$file = file_load($userInfo->picture->fid);
					$imgpath = $file->uri;
					$style="homepage_header";
		?>	
					<li class="<?php echo $class; ?>"><img src="<?php print image_style_url($style,$imgpath); ?>" alt=" " /><a class="make_read" href="<?php echo $url; ?>"><?php echo $notification["noti_msg"]; ?><input type="hidden" value="<?php echo $notification['nid']; ?>"></a></li>
		<?php 
				}
				else{
		?>
					<li class="<?php echo $class; ?>"><img src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme','gloobers').'/images/no-profile-male-img.jpg' ?>" alt="no-profile-image" /><a class="make_read" href="<?php echo $url; ?>"><?php echo $notification["notification_message"]; ?><input type="hidden" value="<?php echo $notification['nid']; ?>"></a></li>
		<?php	
				}
				?>
				<?php

				}*/
				?>
				<li><a href="<?php print url('notifications'); ?>" class="see_all"><?php print t('See All');?></a></li>
				</ul>
					<div class="profile-menu">
                	<a id="user-manual" class="user-profile" href="#"><span>
					<?php 
								$userDetails = user_load($user->uid);
								if($userDetails->picture != ""){
									$file 	= file_load($userDetails->picture->fid);
									$imgpath = $file->uri;
									$style="homepage_header";
							?>
							<img src="<?php print image_style_url($style,$imgpath); ?>" alt="display pic">
							
							<?php 
								}
								else{
							?>
								<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/no-profile-male-img.jpg" alt="display pic" />
					<?php 
							}
					?>
					</span>
					<small>	
					<?php 
							if(isset($userDetails->field_first_name["und"][0]["value"]) && $userDetails->field_first_name["und"][0]["value"] != ""){
								echo ucwords($userDetails->field_first_name["und"][0]["value"])." ".ucwords($userDetails->field_last_name["und"][0]["value"]);
							}
							else{
								echo ucwords($userDetails->name);
							}
						?>
					</small></a>
                    	
                        <div class="user-manual">
                        	<div class="top-arrow"><i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/top-arrow.png" alt="icon" /></i></div>
                            	<ul>
                                	<li><a class="setting" href="<?php echo $base_url; ?>/user/dashboard"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/setting-ico.png" alt="setting" />Dashboard</a></li>
                                    <!--<li><a class="my-wish" href="<?php echo $base_url; ?>/wishlist"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico-w.png" alt="setting" />My Wish Lists</a></li>-->
                                    <li><a class="my-list" href="<?php echo $base_url; ?>/manage/listing"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/list-ico-b.png" alt="setting" />My Listings</a></li>
                                 <!--   <li><a class="my-trips" href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/small-loc.png" alt="setting" />My Trips</a></li>-->
                                    <!--<li><a class="my-advice" href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/plane-ico-b.png" alt="setting" />My Advice</a></li>
                                    <li><a class="my-guide" href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/map-ico.png" alt="setting" />My Travel Guides</a></li>-->
                                    <li><a class="my-profile" href="<?php echo $base_url;?>/user/edit"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/profile-ico.png" alt="setting" /> Edit Profile</a></li>
                                    <li><a class="my-account" href="<?php echo $base_url;?>/user/profile"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/account-ico.png" alt="setting" /> Account</a></li>
                                    <li><a class="log-me-out" href="<?php echo $base_url; ?>/user/logout"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/lock-ico.png" alt="setting" />Log out</a></li>
                               </ul>
                        </div> <!-- user manual ends -->
                        
                     </div><!-- profil menu ends -->
                     <span class="head-border"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/border.png" alt="border" /></span>
                    <a href="#"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/mail-icon.png" alt="message" /> </a> 
					
					
                    <span class="head-border"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/border.png" alt="border" /></span>                    
					<?php }?>

                    
                    <a class="list-btn btn-bg" href="<?php echo $base_url; ?>/product/add/overview">list your deals</a>
                    
                </div><!-- right-login ends -->
           
            
		</div><!-- header close -->
        	<div class="dr-share-world">
            		<h1>Share Your World</h1>
                    
                    <div class="dr-search-pannel">
                    	<div id="horizontalTab">
                            <ul class="resp-tabs-list">
                                <li class="orange"><div class="tab-ico"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/bed-ico.png" alt="icon" width="35px" height="43px" /></div><p>Hotels</p></li>
                                <li class="blue"><div class="tab-ico"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/home-ico.png" alt="icon" width="35px" height="43px" /></div><p>Vacation Rentals</p></li>
                                <li class="red"><div class="tab-ico"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/knif-ico.png" alt="icon" width="35px" height="43px" /></div><p>Restaurants</p></li>
                                <li class="green"><div class="tab-ico"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/exp-loc-ico.png" alt="icon" width="35px" height="43px" /></div><p><span>Experiences</span>Hiking, Sky Diving, Motocross,...</p></li>
                            </ul>
                            <div class="resp-tabs-container">
                                <div class="tab1-content">                                
                                   
                                   <div id="short-search" class="search-page">
                                         <!-- ================ search content ============== -->
                                                        <div class="block-content">
                                                            <input id="destination1" class="loc" type="text" placeholder="Paris, New York, London..." />
                                                            <input class="exp" type="text" placeholder="Hiking, Sky Diving..." />
                                                            <input class="cal" type="text" id="datepicker" placeholder="When?">
                                                            <input class="prtcpnt" type="text" placeholder="Participants">
                                                            <input class="btn-bg" type="button" value="Search" />
                                                        
                                                        </div><!-- col content -->
                                       </div><!-- search ends -->
                
                                </div>
                                
                                <div class="tab2-content">
                                    
                                    <div id="short-search" class="search-page">
                                         <!-- ================ search content ============== -->
                                                        <div class="block-content">
                                                            <input id="destination2" class="loc" type="text" placeholder="Paris, New York, London..." />
                                                            <input class="exp" type="text" placeholder="Hiking, Sky Diving..." />
                                                            <input class="cal" type="text" id="datepicker" placeholder="When?">
                                                            <input class="prtcpnt" type="text" placeholder="Participants">
                                                            <input class="btn-bg" type="button" value="Search" />
                                                        
                                                        </div><!-- col content -->
                                       </div><!-- search ends -->
                                    
                                </div>
                                
                                <div class="tab3-content">
                                    
                                    <div id="short-search" class="search-page">
                                         <!-- ================ search content ============== -->
                                                        <div class="block-content">
                                                            <input id="destination3" class="loc" type="text" placeholder="Paris, New York, London..." />
                                                            <input class="exp" type="text" placeholder="Hiking, Sky Diving..." />
                                                            <input class="cal" type="text" id="datepicker" placeholder="When?">
                                                            <input class="prtcpnt" type="text" placeholder="Participants">
                                                            <input class="btn-bg" type="button" value="Search" />
                                                        
                                                        </div><!-- col content -->
                                       </div><!-- search ends -->
                                       
                                </div>


                                <div class="tab4-content">
                                     
                                    <div id="short-search" class="search-page">
                                         <!-- ================ search content ============== -->
                                                        <div class="block-content">
															<form name="exp-search-form" id="exp-search-form" action="<?php echo $base_url; ?>/experience" method="GET">
																<input id="home-destination4" name="search[place]" class="loc destination" type="text" placeholder="Paris, New York, London... " value="" />
																<input class="exp exp-type" id="home-exp-type" name="search[type]" type="text" placeholder="Hiking, Sky Diving..." />
																<input class="cal datepicker" type="text" name="search[when]" id="home-exp-datepicker" placeholder="When?">
																<input class="prtcpnt" id="exp-prtcpnt" type="text" name="search[person]" placeholder="Participants" min="1">
																<input class="btn-bg" type="button" value="Search" onclick="validateSearch()" />
															</form>
                                                        </div><!-- col content -->
                                       </div><!-- search ends -->
                                 </div>
                            </div> <!-- container close -->
                        </div><!--vertical Tabs-->
         </div> <!-- tabs close -->
                 
                 <div class="slide-down-btn"><a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/slide-down.png" alt="slide down" /></a></div>
            </div><!-- banner -->
            
            
  <!-- ======================  video section tab ========================= -->  
  
  	<div class="video-section">
	<?php 
		$videoUrl =  variable_get('video_url');
	?> 	
        <div class="video-frame">
        	<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/video-thumb.jpg" alt="video" />
        </div><!-- frame here -->
        
            <div class="video-caption">
                <p>How it works ?</p>
                <a class="homepagevideo" href="<?php echo $videoUrl; ?>"><span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/play-ico.png" alt="play" /></span></a>
            </div><!-- video caption ends -->
        
    </div><!-- video section ends -->
  
  
  
  <!--  ====================== video ends ====================== -->        
     <!-- ======================================================= discover Article ================================================ -->         
         
         	<div class="dr-result-container">
        
         <div class="tab-content-wrap discover-article-page">
         	<div class="result-row">
              <div class="result-block discover-col">
                	<div class="discover-article">
                    	<p>Discover</p>
                        <h5>Create yourself lifelong memories with the world's greatest tourism services.</h5>
                    </div>                   
                </div><!-- block ends -->
                <?php 
				$i=1;
					$listings = getMostlyViewedListings();
					foreach($listings as $listing){
						$photos = getPhotosData($listing["eid"]);
						$basePrice = getBasePrice($listing["eid"]);
				?>
						<div class="result-block loadData" id="myData_<?php echo $i; ?>">
							<div class="slider-block">
							<div class="loading"></div>
								<div class="flexslider">
								<ul class="slides">
									<?php 
										if(count($photos)>0){
											foreach($photos as $photo){
											$photo 	= unserialize($photo["value1"]);
											$file 	= file_load($photo["fid"]);
											$imgpath = $file->uri;
											$style = 'listing_slider';

									?>
											<li><a onClick="updateViewsCount(<?php echo $listing["eid"]; ?>)" href="javascript:void(0)" >
												<img src="<?php print image_style_url($style,$imgpath); ?>" alt="place" />
											</a></li>
									<?php 
											}
										}
										else{
									?>
											<li><a onClick="updateViewsCount(<?php echo $listing["eid"]; ?>)" href="javascript:void(0)" >
												<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/img/place1.png" alt="place" />
											</a></li>							
									<?php 
										}
									?>
								</ul>
							</div> <!-- flex ends -->
						   <?php 
								
								if(!$user->uid){
									$dest = drupal_get_destination();
									$_SESSION['destination']  = $dest["destination"];

						   ?>
								<a class="inlinepop" href="#login-popup"><div class="dr-heart">  </div></a><!-- heart ico -->
						   <?php 
								}
								else{
									$status = getWishlistStatus($listing["eid"]);
						   ?>
								<div class="dr-heart dr-heart-live" <?php if(isset($status["in_wishlist"]) && $status["in_wishlist"] == 1) {?> style='background:url("<?php echo  $base_url.'/'.drupal_get_path('theme', 'gloobers'); ?>/images/heart-ico-red.png")'; <?php }?>> <input type="hidden" value="<?php echo isset($status["in_wishlist"])?$status["in_wishlist"]:0; ?>" id="status_<?php echo $listing["eid"]; ?>" class="status"> <input type="hidden" value="<?php echo $listing["eid"]; ?>" id="listingId_<?php echo $listing["eid"]; ?>" class="listingID"> </div>
						   <?php 
								}
						   ?>
							<div class="dr-timing">
								<i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/alarm-ico.png" alt="time" width="23px" height="24px" /></i>
								<p>24h</p>
							 </div><!-- heart ico -->
							<div class="dr-pricing">
								<div class="price-range">
									<p><small>From</small></p>
									<p><?php echo $basePrice["price"]; ?> $</p>
								</div><!-- price range -->
							</div><!-- heart ico -->
							
							</div><!-- slide ends -->
				  <!------------------------------------------------------------------------------------------------------------------>
							  
								  <div class="commenter">
									<div class="cmntr-profile">
									<?php 
										$userDetails = user_load($listing["uid"]);
										if($userDetails->picture != ""){
											$file 	= file_load($userDetails->picture->fid);
											$imgpath = $file->uri;
									?>
										<img src="<?php print file_create_url($imgpath); ?>" alt="display pic" />
									<?php 
										}
										else{
									?>
										<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/no-profile-male-img.jpg" alt="display pic" width="60px" height="60px" />
									<?php 
										}
									?>
									</div><!-- cmnter pro -->         
								 </div><!-- cmmntr ends -->
			<!------------------------------------------------------------------------------------------------------------>		
					 <a onClick="updateViewsCount(<?php echo $listing["eid"]; ?>)" href="javascript:void(0)" >
						<div class="outer-experience"> 
							<div class="place-rating">
								<?php 
								if($listing["average_ratings"] != "")
								{
								?>
									<div class="basic" data-average="<?php echo $listing["average_ratings"]; ?>" data-id="1"></div>
								<?php 
								}
								else{
								?>
									<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="rate" width="20px" height="20px" />
									<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="rate" width="20px" height="20px" />
									<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="rate" width="20px" height="20px" />
									<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="rate" width="20px" height="20px" />
									<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="rate" width="20px" height="20px" />						
								<?php 
								}
								?>
							</div><!-- ratin ends -->							
							<h4><?php echo ucwords($listing["title"]); ?></h4>
							<p><?php echo $listing["city"]; ?>, <?php echo $listing["state"]; ?></p>
							<p><span><?php echo $listing["experience_type"]; ?></span></p> 
									
						</div>
					</a>						
				   <!--------------------------------------------------------------------------------------------------------------------------->                   
												<div class="share-outer-vj">
													<div id="share" class="share share-result">
														<i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/plane-ico-b.png" alt="share" /></i>
														<p>Share with your friends</p>
														<small><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/move-right.png" alt="share" /></small>
													</div><!-- result share --> 
													   
													<div id="quick-share" class="quick-share">
															<ul>
																<li><p>Add to MY</p><div class="circle">+</div></li>
																<li><p><span>Embed</span></p><input type="text" placeholder="<iframe width="560" heigh..." /></li>
																<li class="social">
																	<div class="soical fb"><a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/fb-ico-w.png" alt="ico" height="30px" width="14px" /></a></div>
																	<div class="soical twt"><a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/twt-ico-w.png" alt="ico" height="27px" width="29px" /></a></div>
																	<div class="soical ggl"><a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/ggl-ico-w.png" alt="ico" height="30px" width="30px" /></a></div>
																	<div class="soical plus"><a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/plus-ico-w.png" alt="ico" height="29px" width="28px" /></a></div>
																 </li>
															</ul>
														</div><!-- quick ends -->
												</div> <!-- toggle wrap -->
												
						</div><!-- block ends -->   
                <?php 
				$i++;
					}
				?>
                              
            	</div><!-- row ends --> 
         	 </div><!-- tab contanet wrapper -->  
            </div><!-- result cotainer ends -->         
            
 
 <!-- ====================== popup ============================ -->
 
 <!-- Button that triggers the popup -->
            <div class="more-social-options">
              <div class="social-content">
                 <span class="button b-close"><span>X</span></span>
                 <ul>
                 	<li><a href="#"><i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/msg-ico.png" alt="message" /></i><span>Email</span></a></li>
                    <li class="active"><a href="#"><i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/social-ico.png" alt="message" /></i><span>Share</span></a></li>
                    <li><a href="#"><i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/plus-social.png" alt="message" /></i><span>Add To</span></a></li>
                 </ul>
                	 
                     <div class="social-share">
                     	<p>Share with social network</p>
                     		
                            <ul class="soical-networks">
                            	<li class="scl1"><a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/fb-ico-w.png" alt="icon" /></a></li>
                                <li class="scl2"><a class="" href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/twt-ico-w.png" alt="icon" /></a></li>
                                <li class="scl3"><a class="" href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/ggl-ico-w.png" alt="icon" /></a></li>
                                <li class="scl4"><a class="" href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/s-p4.png" alt="icon" /></a></li>
                                <li class="scl5"><a class="" href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/s-p5.png" alt="icon" /></a></li>
                                <li class="scl6"><a class="" href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/s-p6.png" alt="icon" /></a></li>
                                <li class="scl7"><a class="" href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/s-p7.png" alt="icon" /></a></li>
                                <li class="scl8"><a class="" href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/s-p8.png" alt="icon" /></a></li>
                                <li class="scl9"><a class="" href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/s-p9.png" alt="icon" /></a></li>
                                <li class="scl10"><a class="" href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/s-p10.png" alt="icon" /></a></li>
                            </ul><!-- networks -->
                     
                     <p>Share a link</p>
                     <div class="share-input">
                     	<input type="text" placeholder="http://gloobers.com/adrenaline-extreme/base-jumping-by" />
                        <button>copy</button>
                     </div>
                     
                     <p>Embed on a website</p>
                         <div class="share-input textarea">
                            <textarea placeholder=" Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor."></textarea>
                            <button>copy</button>
                         </div>
                     
                     </div><!-- sociual share -->
                
            	</div><!-- social conent close -->
            </div>
               
 <!-- =========================== pop up =========================== -->   
 <!-- ============================================= page 4 ============================================= -->
      <div class="advice-section">
            <div class="dr-full-width-wrapper">
            	<div class="section-text">
                	<p>ADVISE</p>
                    <h5>Recommand . Earn . Save . Smile </h5>
                    <h5>Help your friends out, share your best recommendations and save on your next trips</h5>
                    <a href="#">&gt; See the different advisors subscriptions</a>             
            	</div><!-- text ends -->
                	<div class="plane-way">
                    	<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/plane-way.png" alt="that way" width="" height="" />
                    </div><!-- planeway ends -->             
            </div><!-- wrapper --> 
      </div><!-- advice section ends -->
      
  <!-- ============================================= page 5 ============================================= -->
        <div class="post-section">           
 			<div class="dr-full-width-wrapper">
            
            
                 
				 <div id="banner-slide">

        <!-- start Basic Jquery Slider -->
       <ul class="rslides2" id="slider5">
      <li>
      	<div class="slide-content">
        	 <div class="profile-section">
             	<div class="pro-dp">
                	<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/img1.png" alt="dp" />
                </div><!-- pr dp ends -->
                <div class="dp-cation">
                	<h2>Ylann</h2>
                    <h2><span>Paris, France</span></h2>
                </div><!-- dp caption ends -->
                
                                <p>"As a student in medicine and Gloobers host,
                I love helping travelers experiencing Paris the way 
                they'd like it. Their satisfaction is my greatest success. 
                Using Gloobers allows me to create myself another
                income from my helpful advices."</p>

					<p><span>Member since May 2013</span></p>
             </div><!-- pro section ends -->
             		<div class="image-content">
                	<a href="#">
                    	<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/img-collage.png" alt="collage album" />
                    </a>                
                </div><!-- image ends -->
        </div><!-- contnet ends -->
      </li> <!-- slide content over -->
      
      <li>
      	<div class="slide-content">
        	 <div class="profile-section">
             	<div class="pro-dp">
                	<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/dp.png" alt="dp" />
                </div><!-- pr dp ends -->
                <div class="dp-cation">
                	<h2>Ylann</h2>
                    <h2><span>Paris, France</span></h2>
                </div><!-- dp caption ends -->
                
                                <p>"As a student in medicine and Gloobers host,
                I love helping travellers experiencing Paris the way 
                they'd like it. Their satisfaction is my greatest success. 
                Using Gloobers allows me to create myself another
                income from my helpful advices."</p>

					<p><span>Member since May 2013</span></p>
             </div><!-- pro section ends -->
             		<div class="image-content">
                	<a href="#">
                    	<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/img-collage.png" alt="collage album" />
                    </a>                
                </div><!-- image ends -->
        </div><!-- contnet ends -->
      </li> <!-- slide content over -->
      
      <li>
      	<div class="slide-content">
        	 <div class="profile-section">
             	<div class="pro-dp">
                	<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/img1.png" alt="dp" />
                </div><!-- pr dp ends -->
                <div class="dp-cation">
                	<h2>Ylann</h2>
                    <h2><span>Paris, France</span></h2>
                </div><!-- dp caption ends -->
                
                                <p>"As a student in medicine and Gloobers host,
                I love helping travelers experiencing Paris the way 
                they'd like it. Their satisfaction is my greatest success. 
                Using Gloobers allows me to create myself another
                income from my helpful advices."</p>

					<p><span>Member since May 2013</span></p>
             </div><!-- pro section ends -->
             		<div class="image-content">
                	<a href="#">
                    	<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/img-collage.png" alt="collage album" />
                    </a>                
                </div><!-- image ends -->
        </div><!-- contnet ends -->
      </li> <!-- slide content over -->
      
      <li>
      	<div class="slide-content">
        	 <div class="profile-section">
             	<div class="pro-dp">
                	<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/dp2.png" alt="dp" />
                </div><!-- pr dp ends -->
                <div class="dp-cation">
                	<h2>Ylann</h2>
                    <h2><span>Paris, France</span></h2>
                </div><!-- dp caption ends -->
                
                                <p>"As a student in medicine and Gloobers host,
                I love helping travelers experiencing Paris the way 
                they'd like it. Their satisfaction is my greatest success. 
                Using Gloobers allows me to create myself another
                income from my helpful advices."</p>

					<p><span>Member since May 2013</span></p>
             </div><!-- pro section ends -->
             		<div class="image-content">
                	<a href="#">
                    	<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/img-collage.png" alt="collage album" />
                    </a>                
                </div><!-- image ends -->
        </div><!-- contnet ends -->
      </li> <!-- slide content over -->
       
    </ul>
        <!-- end Basic jQuery Slider -->

      </div>
      <!-- End outer wrapper -->
				 
				 
				 
			</div>
                
                
 			</div><!-- wrapper ends -->
 		</div><!-- selection carousal close -->	

<?php 
	}
	else{
		$class = '';
		if((strpos('/experience/', $_SERVER['REQUEST_URI']) !== false) || (arg(0) == 'experience' && arg(1) == 'view') || isset($_GET["search"])){
			$class = 'custom-header';
		}
?>

		<div class="dt-main-header <?php echo $class; ?>">
        	<a class="dr-logo" href="<?php echo $base_url; ?>">
            	<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/logo-main.png" alt="Gloober logo" />
            </a>
             
        <!---------------------------------------------------------------------------------------------------->
            <span class="head-border"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/border.png" alt="border" /></span>
            <!--<button id="search-out"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/lense.png" alt="search" /></button>
            <p class="search-megni-text">Search</p>     --> 
		 <div id="short-search" class="search-page">
                		<small><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/top-arrow.png" alt="arrow" /></small>
                	<div class="search-block">
                    	<div class="search-block-col">
                        	<a href="#">
                            	<i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/bed1-ico.png" alt="bed" /></i>
                                Hotels
                        	</a><!-- col ands -->
                        </div><!-- col ends -->
                        
                        <div class="search-block-col">
                        	<a href="#">
                            	<i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/home1-ico.png" alt="bed" /></i>
                                Vacation Rentals
                        	</a><!-- col ands -->
                        </div><!-- col ends -->
                        
                        <div class="search-block-col">
                        	<a href="#">
                            	<i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/knif1-ico.png" alt="bed" /></i>
                                Restaurants
                        	</a><!-- col ands -->
                        </div><!-- col ends -->
                        
                        <div class="search-block-col active last-col">
                        	<a href="#">
                            	<i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/mask-ico.png" alt="bed" /></i>
                                Experiences
                        	</a><!-- col ands -->
                        </div><!-- col ends -->
                     
                    </div><!-- search block -->
                    
                    <!-- ================ search content ============== -->
                            	<div class="block-content">
									<form name="exp-search-form" id="exp-search-form" action="<?php echo $base_url; ?>/experience" method="GET">
										<input value="<?php echo isset($_GET['search']['place'])?$_GET['search']['place']:'' ?>" id="home-destination4" name="search[place]" class="loc destination" type="text" placeholder="Paris, New York, Londre..." />
										<input value="<?php echo isset($_GET['search']['type'])?$_GET['search']['type']:'' ?>" class="exp exp-type" id="home-exp-type" name="search[type]" type="text" placeholder="Hiking, Sky Dinving..." />
										<input value="<?php echo isset($_GET['search']['when'])?$_GET['search']['when']:'' ?>" class="cal datepicker" type="text" name="search[when]" id="home-exp-datepicker" placeholder="When?">
										<input value="<?php echo isset($_GET['search']['person'])?$_GET['search']['person']:'' ?>" class="prtcpnt" id="exp-prtcpnt" type="text" name="search[person]" placeholder="Participants" min="1">
										<input class="btn-bg" type="button" value="Search" onclick="validateSearch()" />
									</form>                              
                                </div><!-- col content -->
                    
                                    
                </div><!-- search ends -->  		            	 
                 
                
   <!-- ===================== 7 oct ========================= -->             
            		 
                <div class="dr-right-login user-in">
				
			<!--	<div class="advice-wrapper">
	   <div class="advice-form">
	      <span class="advice-label">Get An Advise</span> 
	     <div class="advice-form-head">
	   <?php 
	   echo drupal_render($adviceForm);
	   ?>
	   </div> 
	  </div> 
	  </div>-->
                    <?php 
						global $user;
						if(!$user->uid){
				   ?>               	
                    <div class="profile-menu nav-space">
                		<a href="<?php echo $base_url;?>/user/register">Sign Up</a>
						<a href="<?php echo $base_url;?>/login"> Log in </a>  
                     </div>
                    	 
					<?php 
						}
						else{
					?>
					<div class="profile-menu">
                	<a id="user-manual" class="user-profile" href="#"><span>
					<?php 
								$userDetails = user_load($user->uid);
								if($userDetails->picture != ""){
									$file 	= file_load($userDetails->picture->fid);
									$imgpath = $file->uri;
									$style="homepage_header";
							?>
								<img src="<?php print image_style_url($style, $imgpath); ?>" alt="display pic" />
							
							<?php 
								}
								else{
							?>
								<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/no-profile-male-img.jpg" alt="display pic" />
					<?php 
							}
					?>
					</span>
					<small>	
					<?php 
							if(isset($userDetails->field_first_name["und"][0]["value"]) && $userDetails->field_first_name["und"][0]["value"] != ""){
								echo ucwords($userDetails->field_first_name["und"][0]["value"])." ".ucwords($userDetails->field_last_name["und"][0]["value"]);
							}
							else{
								echo ucwords($userDetails->name);
							}
						?>
					</small></a>
                    	
                        <div class="user-manual">
                        	<div class="top-arrow"><i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/top-arrow.png" alt="icon" /></i></div>
                            	<ul>
                                	<li><a class="setting" href="<?php echo $base_url; ?>/user/dashboard"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/setting-ico.png" alt="setting" />Dashboard</a></li>
                                    <li><a class="my-wish" href="<?php echo $base_url; ?>/wishlist"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico-w.png" alt="setting" />My Wish Lists</a></li>
                                    <li><a class="my-list" href="<?php echo $base_url; ?>/listing"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/list-ico-b.png" alt="setting" />My Listings</a></li>
                                   <!-- <li><a class="my-trips" href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/small-loc.png" alt="setting" />My Trips</a></li>-->
                                    <!--<li><a class="my-advice" href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/plane-ico-b.png" alt="setting" />My Advice</a></li>
                                    <li><a class="my-guide" href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/map-ico.png" alt="setting" />My Travel Guides</a></li>-->
                                    <li><a class="my-profile" href="<?php echo $base_url;?>/user/edit"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/profile-ico.png" alt="setting" /> Edit Profile</a></li>
                                    <li><a class="my-account" href="<?php echo $base_url;?>/user/profile"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/account-ico.png" alt="setting" /> Account</a></li>
                                    <li><a class="log-me-out" href="<?php echo $base_url; ?>/user/logout"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/lock-ico.png" alt="setting" />Log out</a></li>
                               </ul>
                        </div> <!-- user manual ends -->
                        
                     </div><!-- profil menu ends -->
                     <span class="head-border"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/border.png" alt="border" /></span>
                    <a href="#"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/mail-icon.png" alt="message" /> </a> 
					
					
                    <span class="head-border"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/border.png" alt="border" /></span>                    
					<?php }?>

                    
                    <a class="list-btn btn-bg" href="#">list your deals</a>
                    
                </div><!-- right-login ends -->
           
            
		</div><!-- header close -->
<?php 
}
?>
<?php 
	if(drupal_is_front_page()) 
	{ 
?>	
<?php 
	}
	else{
?>
  <div id="main-wrapper" class="clearfix">
	<div id="main" class="clearfix">

    <?php if ($breadcrumb): ?>
      <div id="breadcrumb"><?php print $breadcrumb; ?></div>
    <?php endif; ?>


    <div id="content" class="column"><div class="section">
	  <?php if ($messages): ?>
		<div id="messages"><div class="section clearfix">
		  <?php print $messages; ?>
		</div></div> <!-- /.section, /#messages -->
	  <?php endif; ?>
      <a id="main-content"></a>
      <?php print render($title_prefix); ?>
      <?php if ($title): ?>
        <h1 class="title" id="page-title">
          <?php print $title; ?>
        </h1>
      <?php endif; ?>
      
      <?php print render($page['content']); ?>

    </div></div>


  </div></div>
<?php 
	}
?>
    <div class="dr-footer">
      <div class="topbar"></div>
      <div class="dr-wrapper">
		<?php print render($page['footer']); ?>
      </div>
    </div>

</div>

<?php
	if(!$user->uid){
 ?>
<!-- loagin and register modal box -->
	<div id="modal" class="popupContainer" style="display:none;">
		<header class="popupHeader">
			<span class="header_title">Login</span>
			<span class="modal_close"><i class="fa fa-times"></i></span>
		</header>
		
		<section class="popupBody">
			<!-- Social Login -->
			<div class="social_login">
				<div class="">
					<a href="#" class="social_box fb">
						<span class="icon"><i class="fa fa-facebook"></i></span>
						<span class="icon_title">Connect with Facebook</span>
						
					</a>

					<a href="#" class="social_box google">
						<span class="icon"><i class="fa fa-google-plus"></i></span>
						<span class="icon_title">Connect with Google</span>
					</a>
				</div>

				<div class="centeredText">
					<span>Or use your Email address</span>
				</div>

				<div class="action_btns">
					<div class="one_half"><a href="#" id="login_form" class="btn">Login</a></div>
					<div class="one_half last"><a href="#" id="register_form" class="btn">Sign up</a></div>
				</div>
			</div>

			<!-- Username & Password Login form -->
			<div class="user_login">
				<?php 
/* 					$form = drupal_get_form('user_login');
					print drupal_render($form); */
				?>
				<div class="one_half"><a href="#" class="btn back_btn"><i class="fa fa-angle-double-left"></i> Back</a></div>

				<a href="#" class="forgot_password">Forgot password?</a>
			</div>

			<!-- Register Form -->
			<div class="user_register">
				<?php 
					$form = drupal_get_form('user_register_form');
					print drupal_render($form);
				?>
				<div class="one_half"><a href="#" class="btn back_btn"><i class="fa fa-angle-double-left"></i> Back</a></div>
			</div>
		</section>
	</div>
<?php 
	}
	$types = getExperienceListingType();
?>
<script>
var $availableTags = ["<?php echo implode('","',$types); ?>"];
</script>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script> 
<!--<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>-->

<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/js/jquery.meanmenu.js' ?>"></script>
<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/js/jquery.leanModal.min.js' ?>"></script>
<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/js/responsiveslides.min.js' ?>"></script>
<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/js/jquery.sumoselect.min.js' ?>"></script>
<!--<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/js/custom.js' ?>"></script>-->
<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/js/jquery.slimmenu.js' ?>"></script>
<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/js/jquery.selectBoxIt.min.js' ?>"></script>
<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/js/jquery.flexslider.js' ?>"></script>
<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/js/jquery.bpopup.min.js' ?>"></script>
<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/js/easyResponsiveTabs.js' ?>"></script>
<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/js/paralex-slide-responsive.js' ?>"></script>
<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/js/autocomplete.js' ?>"></script>
<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/js/html5lightbox.js' ?>"></script>
<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/js/jquery.colorbox.js' ?>"></script>
<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/js/jquery.lazyloader.js' ?>"></script>
<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']).'/js/placeholders.min.js' ?>"></script>

<script>
	var jq=jQuery.noConflict();
	jq(document).ready(function(){
	jq('#edit-list-type').on('change', function() {
    jq.ajax({
				type: "GET",
				url: "<?php echo $base_url; ?>/product/ajax/getExperienceCategory",
				//dataType: "json",
				data: "typeId=" + encodeURI(this.value),
				success: function(msg){
					//eval(msg);
					jq('#edit-list-category').html("");
					
					if(msg !=0)
					{
				    
					//jq('#edit-product-category').append(msg);
					jq.each(msg,function(index,val){
					jq('#edit-list-category').append("<option value='"+index+"'>"+val+"</option>");
					});
					}
					else
					{
					
					//jq('#edit-product-category').html("");
					jq('#edit-list-category').append('<option value="0">No Category Found</option>');
					}
					
				}
			});

      });
	  
	  /* jQuery('.advice-label').toggle(function(){
		jQuery('.advice-form-head').slideDown();
	  },function(){
		jQuery('.advice-form-head').slideUp();
		jQuery('#getadvice-form').find("input[type=text], textarea").val('');
	  }); */
});
</script>
<script>
if(typeof(EventSource) !== "undefined") {
 var source = new EventSource("<?php print $GLOBALS['base_url'].'/noti.php?uid='.$user->uid;?>");
	source.onmessage = function(event) {
	var note = event.data;
	note = note.split("~");
	var message = note[0];
	var count = note[1];
	if(count != 0){
		$("#noti-count").show();
		document.getElementById("noti-count").innerHTML = count;
		}
		$(".dropdown-menu").html(message);
	//append to html
	}; 
	
}
jQuery(function() {
	jQuery(".make_read").click(function(){	
			var notId = $(this).children().val();
				jQuery.ajax({
				type: "POST",
				url: "<?php print $GLOBALS['base_url'].'/noti.php';?>",
				data: { action: "make_read", notId: notId }
				})
				.done(function( data ) {
					var note = data;
					note = note.split("~");
					var message = note[0];
					var count = note[1];
					document.getElementById("noti-count").innerHTML = count;
					jQuery(".dropdown-menu").html(message);
					jQuery("#noti-count").text('');
					
				});
			}); 
	/*********************************************************************/
	jQuery(".make_read_all").click(function(){	
			jQuery.ajax({
			type: "POST",
			url: "<?php print $GLOBALS['base_url'].'/noti.php';?>",
			data: { action: "make_read_all", uid: "<?php echo $user->uid; ?>" }
			})
			.done(function( data ) {
				var note = data;
				note = note.split("~");
				var message = note[0];
				var count = note[1];
				document.getElementById("noti-count").innerHTML = count;
				jQuery(".dropdown-inverse").html(message);
				jQuery("#noti-count").hide();
				});
		});
/****************************************************************************/	
	 });
</script>