<?php
global $base_url; 
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/gloobers.css','file');
drupal_add_css(drupal_get_path('theme', $GLOBALS['theme']) .'/css/landing_page.css','file');
drupal_add_css(drupal_get_path('theme', $GLOBALS['theme']) .'/stylesheet/for-head-foot.css','file');
?>
<section class="list-sec">
  <div class="dr-wrapper">
    <div class="col-lg-12">
      <h1>Coming Soon</h1>
    </div>
  </div>
</section>
<div class="dr-wrapper">
  <div class="col-lg-12 errorsec">
    <div class="errorstuf">
      <div class="titleline">
        <p><span>!</span>This page is coming soon!</p>
      </div>
      <div class="btnback"><a href="<?php echo $base_url;?>">Back to Home Page</a></div>
    </div>
  </div>
</div>