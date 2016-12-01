<?php
global $base_url; 
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/gloobers.css','file');
?>
<section class="list-sec">
  <div class="dr-wrapper">
    <div class="col-lg-12">
      <h1>Error 404</h1>
    </div>
  </div>
</section>
<div class="dr-wrapper">
  <div class="col-lg-12 errorsec">
    <div class="errorstuf"> <img src="<?php echo $base_url.'/'.drupal_get_path('theme',$GLOBALS['theme']);?>/images/404.png" alt="404 not found">
      <div class="titleline">
        <p><span>!</span>Oops! The Page you requested was not found!</p>
      </div>
      <div class="btnback"><a href="<?php echo $base_url;?>">Back to Home Page</a></div>
    </div>
  </div>
</div>