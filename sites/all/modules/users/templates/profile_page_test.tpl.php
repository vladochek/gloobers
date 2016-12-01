<?php 
global $user,$base_url; 
//echo $base_url;exit;
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/bootstrap.min.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/landing_page.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/style_cropper.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/fonts/stylesheet.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/font-awesome.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/landing_custom.css','file');

/* 

drupal_add_js(drupal_get_path('theme', 'gloobers_new') .'/js/jquery.min.js','file');

drupal_add_js(drupal_get_path('theme', 'gloobers_new') .'/js/jquery.Jcrop.js','file');
drupal_add_js(drupal_get_path('theme', 'gloobers_new') .'/js/jquery.SimpleCropper.js','file'); */


?>
<!--Steps HTML  Here-->
 <div class="main_menu">
 <div class="container">
<div class="nav_main_menu">
  <a href="#" class="showhide pull-right"><i class="fa fa-bars"></i></a>
 <ul class="slidediv">
 <li><a href="#"> Dashboard </a></li>
 <li><a href="#"> Messages </a></li>
 <li><a href="#"> Listings  </a></li>
 <li><a href="#"> Reservations  </a></li>
 <li><a href="#"> Trips <div class="togelsubmenu pull-right"><i class="fa fa-bars"></i></div> </a>
 
 <ul class="submenu">
  <li><a href="#"> Link 1  </a></li>
  <li><a href="#"> Link 1  </a></li>
  <li><a href="#"> Link 1  </a></li>
  <li><a href="#"> Link 1  </a></li>
  <li><a href="#"> Link 1  </a></li>
  <li><a href="#"> Link 1  </a></li>
  <li><a href="#"> Link 1  </a></li>
 </ul>
 
 </li>
 <li><a href="#"> Recommendations Profile  </a></li>
 <li><a href="#"> Account  </a></li>
 </ul>
 </div>  
 <!---
 <a href="#" class="navmenu pull-right">
 <i class="fa fa-bars"></i></a>
 
 <ul id="nav">
                <li><a href="#"> Home </a> </li>
                <li><a href="#s1">Menu 1</a>
                    <span id="s1"></span>
                    <ul class="subs">
                        <li><a href="#">Header a</a>
                            <ul>
                                <li><a href="#">Submenu x</a></li>
                                <li><a href="#">Submenu y</a></li>
                                <li><a href="#">Submenu z</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Header b</a>
                            <ul>
                                <li><a href="#">Submenu x</a></li>
                                <li><a href="#">Submenu y</a></li>
                                <li><a href="#">Submenu z</a></li>
                            </ul>
                        </li>
                        
                        <li><a href="#">Header 2</a>
                            <ul>
                                <li><a href="#">Submenu x</a></li>
                                <li><a href="#">Submenu y</a></li>
                                <li><a href="#">Submenu z</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="active"><a href="#s2">Menu 2</a>
                    <span id="s2"></span>
                    <ul class="subs">
                        <li><a href="#">Header c</a>
                            <ul>
                                <li><a href="#">Submenu x</a></li>
                                <li><a href="#">Submenu y</a></li>
                                <li><a href="#">Submenu z</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Header d</a>
                            <ul>
                                <li><a href="#">Submenu x</a></li>
                                <li><a href="#">Submenu y</a></li>
                                <li><a href="#">Submenu z</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a href="#">Menu 3</a></li>
                <li><a href="#">Menu 4</a></li>
                <li><a href="#">Menu 5</a></li>
                <li><a href="http://www.script-tutorials.com/css3-responsive-menu/">Back to Responsive menu tutorial</a></li>
            </ul>
            
            ---->
 </div>
 </div>
 
 
<section class="profile_image">
<div class="container">
<div class="row"><div class="cover_image">
<div class="simple-cropper-images">
      <div class="profile_text"><img src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/images/cover.png" alt="image"> <br/>Add a profile picture</div>
      <div class="cropme"></div>
 
 

  
    </div>
    <div class="user_info">
    <div class="simple-cropper-images">
      <div class="profile_text"><img src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/images/cover.png" alt="image"> <br/> Change profile picture</div>
      <div class="cropme"></div>
 
 

  
    </div>
    </div>
    
    </div> </div>
</div>
</section> 



<section class="about_me">

<div class="container">
<div class="row">
<h3>About me </h3>
<div class="col-lg-8 paddng_left">
<textarea name="" cols="" rows="" placeholder="Introduce yourself to the tribe, share your best travel souvenirs, the friendly local you won't forget or any other element that you want to let other travelers know about you "></textarea>
 </div>
<aside class="col-lg-4">
<div class="home_town">
<h3>Hometown </h3>
<input name="Enter your hometown " type="text" placeholder="Enter your hometown ">
</div>


<h3>Occupation </h3>
		<select class="select_box" id="Yh" tabindex="1">
			<option value=""> I've been living there</option>
            <option value=""> 1</option>
            <option value=""> 2</option>
		</select>
        
        
        
      
<h3>Languages  </h3>
<select class="select_box" id="Yh1" tabindex="2">
			<option value=""> I've been living there</option>
            <option value=""> 1</option>
            <option value=""> 2</option>
		</select>

</aside>
</div>
</div>
</section>
 
 <section class="verifications">
 <div class="container">
 <div class="col-lg-6 col-md-6 col-sm-12 col-lg-offset-3 col-md-offset-3">
 <h3>Verifications</h3>
 <div class="col-lg-3 col-sm-3 col-xs-12"> <div class="verifications_title">Facebook</div>
 <div class="verifications_cont"> Connected </div>
 </div>
 <div class="col-lg-3 col-sm-3 col-xs-12"> <div class="verifications_title"> Email</div>  <div class="verifications_cont"> Verified </div></div>
 <div class="col-lg-3 col-sm-3 col-xs-12"><div class="verifications_title"> Telephone </div> <div class="verifications_cont">Verified  </div></div>
 <div class="col-lg-3 col-sm-3 col-xs-12"> <div class="verifications_title">Friends</div> <div class="verifications_total"> 283</div> </div>
 </div>
 </div>
 </section>
 
 <section class="passport">
 <div class="container">
 <div class="row"><h3>My passport </h3>
<div class="search_place">


<form class="tagsfilter">
<div class="row">
 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 paddng_left">
 <div class="title">Destination </div>
 <input type="text" autocomplete="off" id="example5" placeholder="Enter destination here" name="tags5"></div>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"> 
<div class="title">Type of trip </div>
<select tabindex="1" class="select_box">
			<option value=""> I've been living there</option>
            <option value=""> I've been living there</option>
            <option value=""> I've been living there</option>
		</select> </div>
 <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
 <div class="title"> </div>
 <a class="button pull-right" href=""> ADD </a>
 </div>   
 </div>  
 </form>
</div>

<div class="map"> <iframe width="100%" height="300" frameborder="0" style="border:0" src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d55373193.96960599!2d79.985516139203!3d32.104080806377034!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1434543140626"></iframe></div>
 </div>
 </div>
 </section>
 
 
 <section class="steps">
<div class="container">
<article>
<h1>My invitation link   </h1>
<p>Share this link with anyone you would like to see joining the tribe. Passionate travelers, devoted advisors or talented professionals. You will get rewarded on every single of their trips, followed recommendations or reservations received. </p>
</article>

<div class="row">
<div class="spep5">
<div class="step_link share_link">
<p>Share your invitation link </p>
<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12"> <input type="text" placeholder=" www.gloobers.com/id=5784/welcome/hello/Danke  " name="input"></div>
<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"><a href="" class="button pull-left"> COPY </a></div>
<div class="col-md-9 col-sm-9 socil_icon">
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><a href="#"> <i class="fa fa-facebook"></i>
<p>Share on Facebook </p> </a> </div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> <a href="#"><i class="fa fa-twitter"></i>
<p>Share on Twitter </p> </a></div>
</div>
</div>
</div>


</div>
</div>
</section>


<footer>
<div class="container">
<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
<div class="footer_menu">
<ul>
<li><a href="">Currency </a></li>
<li><a href="">Language </a></li>
</ul>
</div>
</div>
<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
<div class="footer_menu">
<ul>
<li><a href="">Gloobers for professionals </a></li>
<li><a href="">Publish your listing </a></li>
</ul>
</div>
</div>
<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
<a href="" class="footer_logo"><img src="img/footer_logo.png" width="47" height="50" alt="image"></a>
<p>Gloobers Global Ltd. All rights reserved. 2015 </p>
</div>
<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
<div class="footer_menu">
<ul>
<li><a href="">Terms & Conditions </a></li>
<li><a href="">Help  </a></li>
<li><a href="">Sitemap   </a></li>
</ul>
</div>
</div>
<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
<div class="footer_menu">
<ul>
<li><a href="" class="text-right">Contact  </a></li>
<li><a href="" class="text-right">Facebook  </a></li>
<li><a href="" class="text-right">Twitter   </a></li>
</ul>
</div>
</div>
</div>
</footer>

 <!--Js Files --> 
   <script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/js/jquery.min.js"></script>
<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/js/jquery-migrate-1.2.1.min.js"></script>

<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/js/jquery.selectbox-0.2.js"></script>

<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/js/bootstrap.min.js"></script>

<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/js/jquery.nicescroll.min.js"></script>

<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/js/jquery.Jcrop.js"></script>

<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/js/jquery.SimpleCropper.js"></script>

    <!--Js Functions --> 
  <script type="text/javascript">
 	
		jQuery(document).ready(function() {
		jQuery("html").niceScroll();
		});



   // Init Simple Cropper
        jQuery('.cropme').simpleCropper();
		
		
		
		jQuery(document).ready(function() {
			jQuery(".nav-dropdown-content").niceScroll();
			jQuery(".select_box").selectbox();
			
			
			// Menu Script
			
			 jQuery(function() {
jQuery('.showhide').click(function() {
jQuery(".slidediv").slideToggle();
});

jQuery('.togelsubmenu').click(function() {
jQuery(".submenu").slideToggle();
});

});
});

jQuery(window).on('resize',function(){
    var width = jQuery(window).width();
    if (width < 1024){
        jQuery('.navmenu').click(function() {
            jQuery("#nav").slideToggle();
			
			});
    }else{
       jQuery(".navmenu").css("display", "none");
    }
});	
</script>
</body>
</html>