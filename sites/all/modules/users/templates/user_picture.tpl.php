<?php 
global $user,$base_url; 
//echo $base_url;exit;
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/bootstrap.min.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/landing_page.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/fonts/stylesheet.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/style_cropper.css','file');

drupal_add_js(drupal_get_path('theme', 'gloobers_new') .'/js/jquery.min.js','file');
drupal_add_js(drupal_get_path('theme', 'gloobers_new') .'/js/jquery.nicescroll.min.js','file');
drupal_add_js(drupal_get_path('theme', 'gloobers_new') .'/js/jquery.Jcrop.js','file');
drupal_add_js(drupal_get_path('theme', 'gloobers_new') .'/js/jquery.SimpleCropper.js','file');


?>

 
<section class="steps">
<div class="container">
<article>
<h1>Introduce yourself to the tribe</h1>
<p>Welcome to the tribe</p>
</article>
<div class="simple-cropper-images">
      <div class="profile_text">Add a profile picture</div>
      
      <div class="cropme"></div>
      <div class="cropme_2"><img src="ssssssssssrtuyhrtfyhrftyhfts" name="imageeee"/></div>
</div>
<div class="about_profile">
<div class="textarea"> <textarea onblur="getImgsrc();" name="Tell the tribe about yourself. " cols="" rows="" placeholder=" Tell the tribe about yourself. "></textarea></div>
<div class="row submitrow">
<div class="pull-right"><a href="#" class="latter">Do this later </a> <a href="<?php echo $base_url; ?>/user/test" class="button"> NEXT </a> </div>
</div>
</div>
</div>
</section>
 

 

    <!--Js Functions --> 
   <script type="text/javascript">
   $(document).ready(
    function() {
    $("html").niceScroll();

   
    }
    );
   function getImgsrc(){
    var img=$('.cropme').find('img').attr('src');alert(img);
    $('.cropme_2').html('<input type="hidden" name="Profile_picture" value="'+img+'">');
   }
 
   // Init Simple Cropper

      $('.cropme').simpleCropper();

    
 </script>


  
