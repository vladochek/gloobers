<!-- sidebar menu -->
<?php global $base_url; ?>
<link rel="stylesheet" href="<?php echo $base_url.'/'.drupal_get_path('theme',$GLOBALS['theme']) ?>/css/landing_page.css">
<link rel="stylesheet" href="<?php echo $base_url.'/'.drupal_get_path('theme',$GLOBALS['theme']) ?>/css/landing_custom.css">
<link rel="stylesheet" href="<?php echo $base_url.'/'.drupal_get_path('theme',$GLOBALS['theme']) ?>/stylesheet/for-head-foot.css">

 <section class="account_setting">
 	<div class="sidebar_menu"> 
	 <ul>
		<li><a href="<?php echo $base_url.'/user/payout_preference'?>" class="active_sidebar">Payout preferences </a></li>
		<li><a href="<?php echo $base_url.'/user/transaction_history' ?>">Transactions history </a></li>
		<li><a href="<?php echo $base_url.'/user/account_settings' ?>">Account settings  </a></li>
	 </ul>
 </div>
<div class="account_setting_page">
 	<div class="container-fluid">
	 	<h2 class="pagehead">Payout preferences </h2>
	 	<?php  print($payout_preference); ?>
		<!-- <form>
			<div class="row">
				<fieldset class="col-lg-4">
		 			<h2>Paypal</h2>
		 			<label>Email </label>
		 			<input name="Enter your first name here" type="text" value="" placeholder="Enter your first name here">
		 		</fieldset>
		 		<p class="col-lg-12">We are working on other ways to pay you. Thanks for your patience</p>
		 	</div>
			<div class="row">
			  	<fieldset class="col-lg-4 pull-right">
					<a href="" class="button pull-left"> SAVE </a>
				</fieldset>
			</div>
		</form> -->
		
 	</div>
</div>
</section>
 <!--Account Setting page-->