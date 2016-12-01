<!-- sidebar menu -->
<?php global $user,$base_url;?>
<link rel="stylesheet" href="<?php echo $base_url.'/'.drupal_get_path('theme',$GLOBALS['theme']) ?>/fonts/stylesheet.css">
<link rel="stylesheet" href="<?php echo $base_url.'/'.drupal_get_path('theme',$GLOBALS['theme']) ?>/css/landing_page.css">
<link rel="stylesheet" href="<?php echo $base_url.'/'.drupal_get_path('theme',$GLOBALS['theme']) ?>/css/landing_custom.css">
<link rel="stylesheet" href="<?php echo $base_url.'/'.drupal_get_path('theme',$GLOBALS['theme']) ?>/stylesheet/for-head-foot.css">

<link rel="stylesheet" href="<?php echo $base_url.'/'.drupal_get_path('theme',$GLOBALS['theme']) ?>/css/font-awesome.css">

  <section class="account_setting">

 <div class="sidebar_menu">
 
	 <ul>

		<li><a href="<?php echo $base_url.'/user/payout_preference' ?>">Payout preferences </a></li>

		<li><a href="<?php echo $base_url.'/user/transaction_history' ?>">Transactions history </a></li>

		<li><a href="<?php echo $base_url.'/user/account_settings' ?>" class="active_sidebar">Account settings  </a></li>

	 </ul>

 </div>

 <div class="account_setting_page">

 <div class="container-fluid">

 <h2 class="pagehead">Account settings</h2>

<?php Print drupal_render($account_settings_form); ?>

 </div>

 </div>

 </section>

 <!--Account Setting page-->
<!--Js Files --> 
    <script type="text/javascript" src="<?php echo $base_url.'/'.drupal_get_path('theme',$GLOBALS['theme']) ?>/js/jquery.selectbox-0.2.js"></script>
   <script src="<?php echo $base_url.'/'.drupal_get_path('theme',$GLOBALS['theme']) ?>/js/jquery.nicescroll.min.js"></script>
	<script type="text/javascript" src="<?php echo $base_url.'/'.drupal_get_path('theme',$GLOBALS['theme']) ?>/js/jquery.Jcrop.js"></script>
	<script type="text/javascript" src="<?php echo $base_url.'/'.drupal_get_path('theme',$GLOBALS['theme']) ?>/js/jquery.SimpleCropper.js"></script>
<!--Js Functions --> 

<script type="text/javascript">
jQuery(document).ready(function() {
jQuery("html").niceScroll();
/*SelectBox*/
jQuery("select").selectbox();
jQuery(document).click(function (e) {
if (!jQuery(e.target).is('.sbHolder, .sbHolder *')) {
jQuery("select").selectbox('close');
}
}); //End
});

jQuery(document).ready(function() {
jQuery(".nav-dropdown-content").niceScroll();
jQuery(".select_box").selectbox();
});
// Menu Script
jQuery(document).ready(function(){
jQuery('.showhide').click(function(e){
e.preventDefault();
jQuery('.nav_main_menu').find('ul').toggleClass('dropdwonmenu_remove dropdwonmenu');
});

jQuery('.togelsubmenu').click(function(e){
e.preventDefault();
jQuery('.nav_main_menu').find('ul li ul').toggleClass('dropdwonmenu_remove1 dropdwonmenu1');
});
});	
</script>