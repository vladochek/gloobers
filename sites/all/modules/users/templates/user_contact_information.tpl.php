<?php 
global $user,$base_url; 
// drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/bootstrap.min.css','file');
// drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/landing_page.css','file');
// drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/fonts/stylesheet.css','file');
// drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/landing_custom.css','file');

/* drupal_add_js(drupal_get_path('theme', 'gloobers_new') .'/js/jquery.min.js','file');
drupal_add_js(drupal_get_path('theme', 'gloobers_new') .'/js/jquery.nicescroll.min.js','file');
drupal_add_js(drupal_get_path('theme', 'gloobers_new') .'/js/jquery.selectbox-0.2.js','file'); */
drupal_add_js(drupal_get_path('theme', 'gloobers_new') .'/js/jquery.zclip.js',array('scope'=>'footer'));

?>
<style>
#dynamic {
    font-size: 15px;
    height: 28px;
    width: 357px;
}
</style>
<section class="steps">
<div class="container">
<article>
<h1>Save your Mobile Number</h1>
</article>

<div class="about_profile">
<?php  //print $contact_information;?>
</div>
</div>
<input type="text" id="dynamic" value="PHPGang demo is available!!" />
<a href="#copy" id="copy-dynamic">Copy Now</a>
</section>
<script type ="text/javascript">
jQuery(document).ready(function() {
jQuery("#user-contact-information-form").validate({
   rules: {
      phone :"required",
       keys: {
          required: true,

         }
     },
});
});

    jQuery(document).ready(function(){
       jQuery("a#copy-dynamic").zclip({
       path:"http://davidwalsh.name/demo/ZeroClipboard.swf",
       allowScriptAccess: 'always',
   	   forceHandCursor: true,
           copy:function(){return jQuery("input#dynamic").val();}
        });
    });
</script>
</script>
    <!--Js Functions --> 
  <script type="text/javascript">
    
 /*  $(document).ready(function() {

     $("html").niceScroll();
      
      }
    );
     $(function () {
      $(".select_box").selectbox();
    }); */
  
  // When the browser is ready...
 </script>
