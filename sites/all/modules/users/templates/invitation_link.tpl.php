

<?php 
global $user,$base_url; 
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/landing_page.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/stylesheet/for-head-foot.css','file');

$recommendation_link=generate_link();
$recommendation_link=urldecode($recommendation_link);
?>

<!--Steps HTML  Here--> 
<section class="steps modified_steps">
<div class="container">
<article>
<h1>Earn your first Gloobies  </h1>
<p>Invite your friends to enter the tribe, and get rewarded every single time they travel, recommend or get a reservation from another tribe member.</p>
</article>

<div class="about_profile">
<div class="row">
<div class="spep5">
<div class="step_link">
<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12"><p>Share your invitation link </p></div>
<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12"> 
	<input name="input" id="dynamic" readonly type="text" value="<?php echo $recommendation_link; ?>">
</div>
<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"><a class="button pull-left" id="copy-dynamic" href="javascript:void(0);" > Copy </a></div>
<div class="col-md-9 socil_icon">
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $recommendation_link;?>"><i class="fa fa-facebook"></i>
<p>Share on Facebook </p> </a> </div>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"><a class="" target="_blank" href="https://plus.google.com/share?url=<?php echo $recommendation_link;?>">
<i class="fa fa-google-plus"></i>
<p>Share on Google+ </p> </a> </div>

<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"> <a target="_blank" href="https://twitter.com/home?status=<?php echo $recommendation_link; ?>">
			<i class="fa fa-twitter"></i>
<p>Share on Twitter </p> </a></div>
</div>
</div>
</div>
</div>
<div class="row submitrow">
<div class="pull-right"><a href="<?php echo $base_url; ?>" class="button pull-right"> Go to homepage </a> </div>
</div>
</div>
</div>
</section>
