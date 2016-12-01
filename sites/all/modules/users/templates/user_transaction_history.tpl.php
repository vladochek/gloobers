<?php global $base_url; ?>
<link rel="stylesheet" href="<?php echo $base_url.'/'.drupal_get_path('theme',$GLOBALS['theme']) ?>/css/landing_page.css">
<link rel="stylesheet" href="<?php echo $base_url.'/'.drupal_get_path('theme',$GLOBALS['theme']) ?>/css/landing_custom.css">
<link rel="stylesheet" href="<?php echo $base_url.'/'.drupal_get_path('theme',$GLOBALS['theme']) ?>/stylesheet/for-head-foot.css">

  <section class="account_setting">
 <div class="sidebar_menu">
	 <ul>
		<li><a href="<?php echo $base_url.'/user/payout_preference' ?>">Payout preferences </a></li>
		<li><a href="<?php echo $base_url.'/user/transaction_history' ?>" class="active_sidebar">Transactions history </a></li>
		<li><a href="<?php echo $base_url.'/user/account_settings' ?>">Account settings  </a></li>
	 </ul>
 </div>
 <div class="account_setting_page">
 <div class="container-fluid">
 <h2 class="pagehead">Transactions history </h2>

 <div class="clearfix"></div>
 <div class="table-responsive">          
  <table class="table">
    <thead>
      <tr>
        <th>Date</th>
        <th>Method</th>
        <th>Amount</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php 
	//echo "<pre>";Print_r($booking);exit;
	  foreach($booking as $books) { ?>
      <tr>
        <td><?php echo $books['payment_at']; ?></td>
        <td><strong>Paypal</strong></td>
        <td>$<?php echo $books['grand_total']; ?></td>
        <td> <span class="complete"> <?php echo $books['payment_status'];?> </span> </td>
      </tr>
      <?php  

	} ?>
    </tbody>
  </table>
  </div>
  <?php 
  
	print'<div class="col-md-12 col-sm-12 col-xs-12 text-center"><div class="pagination">';

	echo $pagination;

	print '</div></div>';
  
  
  ?>

 </div>
 </div>
 </section>