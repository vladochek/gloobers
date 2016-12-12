<?php
global $base_url;
$userDetails = user_load($user->uid);

drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/gloobers.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/landing_page.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/landing_custom.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/stylesheet/for-head-foot.css','file');

 
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

drupal_add_css(
        $base_url . '/' . drupal_get_path('theme', 'gloobers') . '/css/flexslider.css', array(
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
    '.recommendations-label { color: #5f6c78;font-size: 20px;font-weight: bold;text-align: center;text-transform: uppercase;}
    .location-request-section label{display: block;}
    .map-search .sidebar {position: static;width: 100%;}
    @media only screen and (min-width:1210px){.map-search .sidebar .listsection .listing {width: 33.3333%;padding: 10px;}}
    .map-search .sidebar .listsection .listing:nth-child(2n) {margin-left: auto!important;}', array(
        'group' => CSS_THEME,
        'type' => 'inline',
        'media' => 'all',
        'preprocess' => FALSE,
        'every_page' => FALSE,
        'weight' => '9999',
    )
);

//GET USER INFORMATION AND DETAIL 
$banner_path = $userDetails->picture->uri;
$noProfilePic = $base_url . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/images/no-profile-male-img.jpg';
?>

<section class="topbar">
    <div class="dr-wrapper">
        <div class="links">
            <div class="recommendations-label">recommendations</div>
        </div>
    </div>
</section>

<section class="user-sec nopadding">
<div class="container nopadding">
<div class="col-md-12 col-sm-12 col-xs-12 nopadding">
<div class="profilepageblock">
<?php if(!empty($cover_pic)){ 
$style = "cover_pic";  print '<img class="" src="' . image_style_url($style, $cover_pic) . '" alt=""  title="" />';
}else{?>
<img src="<?php echo $base_url . '/' . drupal_get_path('theme', $GLOBALS['theme']) ?>/images/user/user-profile.jpg" alt="" title="" />
<?php  } ?>
<div class="userprodata">
<div class="userpicimg">
<?php 
if ($userDetails->picture != "") {
$file = file_load($userDetails->picture->fid);
//echo $file->uri;exit;
$imgpath = $file->uri;
$style = "experience_topranked";
print '<img class="img-circle" src="' . image_style_url($style, $imgpath) . '" alt="display pic" title="" />';
} else {
print '<img src="' . base_path() . drupal_get_path('theme', $GLOBALS['theme']) . '/images/no-profile-male-img.jpg" class="img-circle" alt="display pic" title="" />';
}
?>
</div> <!--End UserPicImg -->
<h3><?php echo $userDetails->field_first_name['und'][0]['value'];  ?></h3>
<h4> <?php if(!empty($loc)){echo $loc;} ?>  </h4>
</div> <!-- End UserProData -->
<div class="mask"></div>
</div> <!-- End ProfilePagePlock -->
</div> <!-- End Col -->
</div> <!-- End Container -->
</section> <!-- End UserSection -->
       
<section class="myrequest">
    <div class="dr-wrapper">
        <div class="myrequestlist">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Destination</th>
                            <th>TRIP</th>
                            <th>Type of Recommendation</th>
                            <th>Date</th>
                            <th>Travellers</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php

                            $advisor = user_load($traveller_recommend_data[0]['advisor_uid']);
                              //echo "<pre>";print_r($traveller_recommend_data); exit;
                             if ($advisor->picture != "") {
                                    $file = file_load($advisor->picture->fid);
                                    //echo $file->uri;exit;
                                    $imgpath = $file->uri;
                                    $style = "homepage_header";
                                   print '<img class="img-circle size-img" src="' . image_style_url($style, $imgpath) . '" alt="display pic">';
                                  //  print '<img src="' . $file->uri . '" class="img-circle size-img" alt="img">';
                                } else {
                                    print '<img src="' . base_path() . drupal_get_path('theme', $GLOBALS['theme']) . '/images/no-profile-male-img.jpg" class="img-circle size-img" alt="display pic" />';
                                }
                                
                            
                            ?>

                            
                            <label><?php echo $advisor->field_first_name['und'][0]['value']; ?></label>
                            </td>
                            <td><?php echo $traveller_recommend_data[0]['destination'];?></td>
                            <td><?php echo $traveller_recommend_data[0]['trip_type'];?></td>
                            <td><?php echo $traveller_recommend_data[0]['listing_type'];?></td>
                            <td><?php 
                                $from_date=date_create($traveller_recommend_data[0]['from_date']);
                                $to_date = date_create($traveller_recommend_data[0]['to_date']);
                                echo date_format($from_date,"M d").', '.date_format($from_date,'Y');
                            ?>       
                            </td>
                            <!-- <td><?php 
                                $traveller //= //unserialize($traveller_recommend_data[0]['travellers']);?>
                                Adults:<?php //echo $traveller['adult']; ?><br>    
                                Childs:<?php //echo $traveller['child']; ?>
                            </td> -->
                            <td> <?php echo $traveller_recommend_data[0]['travellers']; ?> </td>
                            <!-- <td> --> <!-- <div class="selectbox"><select name="OPEN" class="green"><option>OPEN</option></select></div> -->
                             <?php if ($traveller_recommend_data[0]['status'] == 1) { ?>

                                        <td class="green"><?php echo 'OPEN'; ?></td>

                                    <?php } else if ($traveller_recommend_data[0]['status'] == 0) { ?>

                                        <td class="red"><?php echo 'CLOSE'; ?></td>

                                    <?php } else { ?>

                                        <td class="red"><?php echo 'DECLINE'; ?></td>

                                    <?php } ?>
                            <!-- </td> -->
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<section class="recv_list">
    <div class="dr-wrapper">
<div class="map-search">
  <div class="col-lg-12 nopadding">
      <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
      <div class="sidebar">
        
        <div class="col-lg-12 nopadding listsection">
          <?php 
          
        foreach ($data as $key=>$value){
                            //echo "<pre>";print_r($value);exit;
                            $photos = getPhotosData($value['listing_id']);
                            $basePrice = getBasePrice($value['listing_id']);
                            $OverviewData = getOverviewData($value['listing_id']);
                            if($OverviewData){
                            $locationDetail = getListingData($value['listing_id']);
                            $offers = getOffersAndDiscountsData($value["listing_id"]);
                            $advisor_id = $value['owner_id'];
                            if(!empty($advisor_id)){
                                $advisorId='?advisorId='.base64_encode($advisor_id);
                            }else{
                                  $advisorId='';
                            }

                           /*  $offerStack = array();
                            if (!empty($offers)) {
                                $value[$key]['base_price'] = $basePrice["base_price"];

                                //check for all conditions 24h , last min, Early bird
                            
                                $offerStack = checkOfferApply($offers, $value);
                                $offerUriParam = (isset($offerStack['offer_type'])) ? '?offer=' . base64_encode($offerStack['offer_type']) : '?';
                                
                            } */

          ?>
          <div class="col-xs-12 col-sm-4 col-md-4  listing">
            <div class="block"> 
            <?php if (count($photos) > 0) {
                                        $photo = unserialize($photos[0]["value1"]);
                                                    $file = file_load($photo["fid"]);
                                                    $imgpath = $file->uri;
                                                    $style = 'experience_topranked_large';
                                                     echo '<a href="'.$base_url.'/experience/'.$value['listing_id'].$advisorId.'"><img src="'.image_style_url($style, $imgpath).'" alt="place" onError="imgError(this)" class= "img-height"/></a>';
                                                                                                      
                                                
                                            } else {
                                                     
                                                    //echo '<img src="'.$base_url."/".drupal_get_path("theme", "gloobers").'"/images/img/place1.png" alt="place" class="img-height" />';
                                                    print '<a href="'.$base_url.'/experience/'.$value['listing_id'].$advisorId.'"><img src="' . base_path() . drupal_get_path('theme', 'gloobers') . '/images/img/place1.png" class="img-height" /><a>'; 
                                                } ?>
             
              <div class="tagsec">
                
                <div class="price">
                  <p>$<?php echo $basePrice["base_price"]; ?></p>
                </div>
              </div>
              
              <div class="clientpic">
              <?php 


                 $pic_data = user_load($OverviewData['uid']);  

                 $file = file_load($pic_data->picture->fid);
                 $imgurl = $file->uri; 
                                        $style = "homepage_header";

                                        if(!empty($imgurl)){  
                                        echo '<img alt=" " src="'.image_style_url($style, $imgurl).'"></a>';
                                        }
                                        else {
                                         print '<img src="' . base_path() . drupal_get_path('theme', $GLOBALS['theme']) . '/images/no-profile-male-img.jpg" class="absolute-left-content img-circle size-img" alt="display pic" />'; 
                                        } 

              ?>
              

              </div>
            </div>
            <div class="headingsec">
              <h2><?php echo $OverviewData['title']; ?></h2>
              <p><?php echo $locationDetail['city'].' '.",".' '.$locationDetail['state']; ?></p>
            </div>
            
            <div class="comments">
                <textarea  readonly name="" cols="" rows=""><?php if(!empty($value['advice_comment'])){echo $value['advice_comment'];} ?></textarea>
            </div>
          </div>
         
          
        <?php  }} ?>  
          </div>
          </div>
        
      </div>
    </div>
  </div>
</div>
</section>
<script type="text/javascript">
   function imgError(el) {
        var noImage = $baseUrl + '/' + $globalThemeUrl + '/images/default_images/banner-listing_img.jpg';
        jQuery(el).attr('src', noImage);
    } 

</script>


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

$flexSlider = $base_url . '/' . drupal_get_path('theme', 'gloobers') . '/js/jquery.flexslider.js';
drupal_add_js($flexSlider, array(
    'type' => 'external',
    'scope' => 'footer',
    'group' => JS_THEME,
    'every_page' => FALSE,
    'weight' => -1,
));
?>