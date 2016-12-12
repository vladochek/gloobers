<?php 

global $user,$base_url; 

drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/stylesheet/for-head-foot.css','file');

drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/bootstrap.min.css','file');

drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/landing_page.css','file');

drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/fonts/stylesheet.css','file');

drupal_add_js(drupal_get_path('theme', 'gloobers_new') .'/js/jquery.min.js','file');

drupal_add_js(drupal_get_path('theme', 'gloobers_new') .'/js/jquery.nicescroll.min.js','file');





?>

 

 <!--Steps HTML  Here--> 



<section class="steps modified_steps">

<div class="container">



<?php if($confirm_status != 'yes'){ ?>
<article>
<h1>Confirm Your Email</h1>
<?php  }else {  ?>
<h1>Thanks for confirmed Email</h1>

<?php 	} ?>

</article>

<p><?php echo $result; ?></p>

<?php //echo $confirm_status;exit; ?>
<?php if($confirm_status == 'yes') {

?>


<div class="pull-right"><a href="<?php echo $base_url; ?>/user/step2" class="button pull-right"> Next </a> </div>

<?php

}else{

?>

<!-- <div class="pull-right"><a href="<?php //echo $base_url; ?>/user/step1" class="latter"> Do this later. </a> </div>
 -->


<?php } ?>





</div>

</section>

 

<script type="text/javascript">

 	$(document).ready(

		function() {

			$("html").niceScroll();

		}

	);

 </script>