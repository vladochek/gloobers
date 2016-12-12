<?php
global $base_url;
$recommendUser = json_decode($recommendUsers ,TRUE); 

//echo "<pre>";print_r($recommendUser);die;
drupal_add_css(
    $base_url . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/css/stylemenu.css', array(
    'group' => CSS_THEME,
    'type' => 'external',
    'media' => 'all',
    'preprocess' => FALSE,
    'every_page' => FALSE,
    'weight' => '9999',
        )
);
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/landing_page.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/stylesheet/for-head-foot.css','file');
//drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/landing_custom.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/gloobers.css','file');

?>

<?php 


if(isset($_SESSION['notify'])) { 
    $notifyHtml.= '<section class="requestrecive">';
    $notifyHtml.='<div class="alert alert-'.$_SESSION['notify']['status'].'">'.$_SESSION['notify']['message'].'</div>' ;
    $notifyHtml.='</section>';
    echo $notifyHtml;
    unset($_SESSION['notify']);
} ?>


<section class="requestrecive">
    <div class="dr-wrapper">
        <div class="recived">
            <h1>What is it ?</h1>
            <p><< Travel guides >> are a compilation of your best recommendations for a specific
            destination. You can make it public to all Gloobers,or private only to specific people.</p>
        </div>
    </div>
    <form class="treval_guide travel_guide_select">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="selectbox">
                    <select name="travelguide" class="select_box" onchange="selectravelguide(this.value);">
                        <option value="all">Display all travel guides</option>
                        <option value="public">Display Public travel guides</option>
                        <option value="private">Display Private travel guides</option>
                    </select>
                </div>
            </div>
</form>
</section>


<!--DOM Structure for Travel Guide-->
<?php //echo $tGuideListDOM; ?>
<!--End of DOM-->
<section class="col-lg-12 user-sec nopadding requestrecive">
    <div class="dr-wrapper">
        <div class="col-lg-12 nopadding">
             <div class="guide-travel">

             </div>

         </div>
    </div>
</section>            


<!--Add required JS files -->
<?php

//Add required js 
$file = $base_url . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/js/advisor.js';
drupal_add_js($file, array(
    'type' => 'external',
    'scope' => 'footer',
    'group' => JS_THEME,
    'every_page' => FALSE,
    'weight' => -1,
));

$timepickerjs = $base_url . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/js/bootstrap-datetimepicker.js';
drupal_add_js($timepickerjs, array(
    'type' => 'external',
    'scope' => 'footer',
    'group' => JS_THEME,
    'every_page' => FALSE,
    'weight' => -1,
));

$styleMenu = $base_url . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/js/stylemenu.js';
drupal_add_js($styleMenu, array(
    'type' => 'external',
    'scope' => 'footer',
    'group' => JS_THEME,
    'every_page' => FALSE,
    'weight' => -1,
));
drupal_add_js(drupal_get_path('theme', $GLOBALS['theme']) .'/js/jquery.selectbox-0.2.js','file');

?>
<script type="text/javascript">
    
  jQuery(document).ready(function() {

    jQuery("html").niceScroll();
    jQuery("select").selectbox();
      
      });

  
  
 </script>


 <script>

 function selectravelguide(value){
    jQuery.ajax({
                type: 'POST',
                url: $baseUrl + '/advisor/ajax/travelguides',
                beforeSend: function () {
                    preLoading('show', 'load-screen');
                    },
                data: {'val':value},
                success: function (data) {
                     jQuery(".guide-travel").html(data);
                    // var res = jQuery.parseJSON(data);
                     preLoading('hide', 'load-screen');
                    // if (res.status == 'success') {
                    //         jQuery.notify(res.message, {globalPosition: 'top center', className: 'success'});
                    //     }else{
                    //         jQuery.notify(res.message, {globalPosition: 'top center', className: 'error'});
                    //     }
                },
                
            }); 

 }
 </script>
 <script type="text/javascript">

jQuery(window).load(function() {
var value_select_option=jQuery(".travel_guide_option").val();
      selectravelguide(value_select_option);
  });
 </script>