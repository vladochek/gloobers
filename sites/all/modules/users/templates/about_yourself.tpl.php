<?php 
global $user,$base_url; 

drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/landing_page.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/stylesheet/for-head-foot.css','file');

// drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/landing_custom.css','file');
// drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/fonts/stylesheet.css','file');
 
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/style_cropper.css','file');
drupal_add_js(drupal_get_path('theme', 'gloobers_new') .'/js/jquery.min.js','file');
//drupal_add_js(drupal_get_path('theme', 'gloobers_new') .'/js/jquery.nicescroll.min.js','file');
drupal_add_js(drupal_get_path('theme', 'gloobers_new') .'/js/jquery.Jcrop.js','file');
drupal_add_js(drupal_get_path('theme', 'gloobers_new') .'/js/jquery.SimpleCropper.js','file');


?>
<section class="steps modified_steps">
<div class="container">
<article>
<h1>Introduce yourself to the tribe</h1>
<p>Welcome to the tribe</p>
</article>
<?php  Print($About_yourself);?>
</div>
</section>
<script type ="text/javascript">
jQuery(document).ready(function() {
jQuery("#about-yourself-form").validate({
   rules: {
      about_yourself :"required",
       keys: {
          required: true,

         }
     },
});
});
</script>

<!--Js Functions --> 
<script type="text/javascript">
  /*  $(document).ready(function(){
    $("html").niceScroll();
	}); */
   function getImgsrc(){
		var img=$('.cropme').find('img').attr('src');
		$('.cropme_2').html('<input type="hidden" name="Profile_picture" value="'+img+'">');
   }
 
   // Init Simple Cropper

      $('.cropme').simpleCropper();

    
 </script>