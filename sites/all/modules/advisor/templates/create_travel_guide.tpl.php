<?php

global $base_url;
//print_r($data);//die;
$recommendUser = json_decode($recommendUsers ,TRUE); 
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

drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/landing_page.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/landing_custom.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/gloobers.css','file');

drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/stylesheet/for-head-foot.css','file');




?>


<!--TREVELLER GUIDE FORM-->
<section class="requestrecive">
    <div class="dr-wrapper">
        <div class="recived">
             
            <h1 id="headingGuideHelp"> <?=isset($data)&&!empty($data)?'Update':'Create';?> Travel Guide</h1>
            <form id="trevelGuideForm" class="treval_guide" method="post" action="<?php echo $base_url.'/advice/save_trevel_guide'; ?>" enctype="multipart/form-data">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding_left">
                    <input type="text" name="title" value="<?=isset($data)&&!empty($data)?$data[0]["title"]:'Enter Your Title';?>" onfocus="if (this.value == 'Enter Your Title')
                                this.value = '';" onblur="if (this.value == '')
                                this.value = 'Enter Your Title';" required="" id="_guideTitle">
                </div>
                
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding_left">
                    <div class="">
                        <select name="is_public" class="selectbox" id="_guideIsPublic">
                            <option value="yes" <?=isset($data)&&$data[0]["is_public"]=='yes'?'selected':'';?>>Public travel guides</option>
                            <option value="no" <?=isset($data)&&$data[0]["is_public"]=='no'?'selected':'';?>>Private travel guides</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_left">
                    <textarea name="description" cols="" rows="" placeholder="Description" id="_guideDescription"><?=isset($data)&&!empty($data)?$data[0]["description"]:'';?></textarea>
                </div>
                
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding_left">
                    <label>Upload Cover Image</label>
                    <input class="cover-image-trevel-guide" type="file" name="guide_image">
                </div>
                
                <!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding_left">
                    <label>Select Recommended Users</label>
                    <select name="recommendedUsers" class="selectbox" id="_guideRecommendation">
                        <?php 
                               // foreach($recommendUser as $users): 

                                ?>

                        <option value="<?php //echo ($users['uid']); ?>"><?php //echo $users['first_name'].' '.$users['last_name'].' ('.$users['mail'].')'; ?></option>
                        <?php //endforeach; ?>
                    </select>
                </div> -->
                
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_left">
                    <input type="hidden" name="tgid" value="0" id="_guideID">
                    <?php if(isset($data)&&!empty($data)){ ?>
                    <input type="hidden" name="update_tgid" value="<?php echo $data[0]['tgid']; ?>">
                    <?php } ?>
                    <input id="_button_submit" type="submit" value="<?=isset($data)&&!empty($data)?'Update':'Create';?> Guide" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</section>
<div class ="edit_travelguide">
<!--LISTINGS INSIDE TRAVEL GUIDE-->
    <?php
    if(($locationDetails[0]['traveller_uid']) == ($user->uid)){ ?>

     <section class="col-lg-12 user-sec map-search">
            <div class="dr-wrapper sidebar">
                <?php echo $listingHTML; ?>
            </div>
        </section>

   <?php }else{
    ?>
    <section class="col-lg-12 user-sec map-search">
        <div class="dr-wrapper sidebar">
            <?php echo $listingHTML; ?>
        </div>
    </section>
    <?php } ?>
</div>    
<!--END OF LISTING GUIDE-->
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
$flexSlider = $base_url . '/' . drupal_get_path('theme', 'gloobers') . '/js/jquery.flexslider.js';
drupal_add_js($flexSlider, array(
    'type' => 'external',
    'scope' => 'footer',
    'group' => JS_THEME,
    'every_page' => FALSE,
    'weight' => -1,
));

?>