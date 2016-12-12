<?php

global $base_url;

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

/**
*@deprecated Add inline css do not put the css out of file(external). 
It is already using for other section . There was need of same DOM Structure but with some little modication so here we create inline css
*/

drupal_add_css(
        '@media only screen and (min-width:1210px){.guide-travel .travelblock{width: 33.333%;}}
        .guide-travel .travelblock .guidesec a h3{font-size: 20px!important;}
        .guide-travel .travelblock .guidesec a h3{font-size: 20px!important;}
        .user-sec .guide-travel .travelblock .guidesec p.text {font-size: 14px!important;font-weight: bold;}
        .user-sec .guide-travel {padding: 0;margin-bottom: 10px;}
        .user-sec .guide-travel .travelblock .guidesec {top: 23%;}
        .user-sec .guide-travel .travelblock .guidesec .topspace {padding-top: 5%;}', array(
    'group' => CSS_THEME,
    'type' => 'inline',
    'media' => 'all',
    'preprocess' => FALSE,
    'every_page' => FALSE,
    'weight' => '9999',
        )
);
//echo "<pre>";print_r($recomendlist);exit;
?>

<section class="topbarmenu">
    <div class="dr-wrapper">
        <div class="cd-main-header">
            <ul class="cd-header-buttons">
                <li><a class="cd-nav-trigger" href="#cd-primary-nav">Menu<span></span></a></li>
            </ul> <!-- cd-header-buttons -->
        </div>
        <main class="cd-main-content">
            <!-- your content here -->
        </main>

        <div class="cd-nav">
            <ul id="cd-primary-nav" class="cd-primary-nav is-fixed">
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Messages</a></li>
                <li><a href="#">Listing</a></li>
                <li><a href="#">Reservations</a></li>
                <li class="has-children"><a href="#">Recommendation</a>
                    <ul class="cd-secondary-nav is-hidden">
                        <li class="go-back"><a href="#0">Menu</a></li>
                        <li><a href="#">My requests</a></li>
                        <li><a href="#">Requests received </a></li>
                        <li><a href="#">Validated recommendations</a></li>
                        <li><a href="#">Travel guides</a></li>
                    </ul>
                </li>
                <li><a href="#">Trips</a></li>
                <li><a href="#">Profile</a></li>
                <li><a href="#">Accounts</a></li>
            </ul> <!-- primary-nav -->
        </div>
    </div>
</section>

<section class="experiences">

</section>

<section class="requestrecive">
    <div class="dr-wrapper">
        <div class="recived">
            <h1>What is it ?</h1>
            <p><< My Request>> Are the request you received via the Advisor.  
                Book Suggested Listing and make your trip more enjoyable.</p>
        </div>
    </div>
</section>
<?php
 $listings=array();
 foreach($recomendlist as $results){
 
 
	$lists=explode(',',$results['listings']);
	$listings[]=$lists;
 
 }
 $output=array();
 foreach($listings as $listing){
	$output=array_merge($output,$listing);
 
 }
 $outputListings=array_unique($output);
 $getListingData=getOverviewData($listId=$outputListings[0]);
 echo "<pre>";Print_r($getListingData);exit;
 ?>

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
?>