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
    .topbar {margin: 65px 0 0;}
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


<section class="col-lg-12 user-sec">
    <div class="dr-wrapper">
        <div class="user-banner"> <img src="<?php echo $base_url . '/' . drupal_get_path('theme', $GLOBALS['theme']) ?>/images/user/user-profile.jpg" alt=" ">
            <div class="user-name"><img src="<?php print image_style_url('experience_topranked', $banner_path); ?>" alt=" " onerror="<?php echo $noProfilePic; ?>">
                <p><Span><?php echo $userDetails->name; ?></Span></p>
            </div>
        </div>
    </div>
</section>


<!--LOCATION REQUEST BLOCK-->
<?php
foreach ($locationDetails as $request) {
    $file = file_load($request['picture']);
    $imgpath = $file->uri;

    $src = file_create_url($imgpath);
    $noPic = $base_url . '/' . drupal_get_path('theme', 'gloobers') . "/images/no-profile-male-img.jpg";
    $src = ($src) ? $src : $noPic;
	//echo $src;exit;
    //GET Mutual Passion
    //$mutualStore = getMutualPassion($request['uid']);
    ?>
    <section class="col-lg-12 user-sec location-request-section">
        <div class="dr-wrapper">
            <div class="myrequestlist">
                <div class="table-responsive" id="element_<?php echo $request['rid']; ?>">
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Destination</th>
                                <th>TRIP</th>
                                <th>Type of Recommendation</th>
                                <th>Date</th>
                                <th>Travelers</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="2">
                                    <img class="user-picture-advisor" src="<?php echo $src; ?>" onerror="this.onerror=null;this.src='<?php echo $noPic; ?>'" alt="image">
                                    <label><?php echo ucfirst($request['name']); ?></label>
                                </td>
                                <td><?php echo $request['destination']; ?></td>
                                <td ><?php echo ucfirst($request['trip_type']); ?></td>
                                <td><?php echo ucfirst($request['listing_type']); ?></td>
                                <td><?php echo date("M d", strtotime($request['from_date'])) . '-' . date("M d", strtotime($request['to_date'])) . ' ' . date("Y", strtotime($request['to_date'])); ?></td>
                                <td><?php 
								$traves=unserialize($request['travellers']);
								echo ($traves['adult'])?'Adult: '.$traves['adult']:'N/A';
								echo "<br/>";
								echo ($traves['child'])?'Child: '.$traves['adult']:'N/A';
								?></td>
                                <?php if ($request['status'] == 1) { ?>
                                    <td class="green"><?php echo 'OPEN'; ?></td>
                                <?php } else if ($request['status'] == 0) { ?>
                                    <td class="red"><?php echo 'CLOSE'; ?></td>
                                <?php } else { ?>
                                    <td class="red"><?php echo 'DECLINE'; ?></td>
                                <?php } ?>

                            </tr>
                            <tr>
    <!--                                    <td colspan="1"> </td>-->
                                <td colspan="4"><div class="req_massage">
                                        <h1>Message</h1>
                                        <p><?php echo $request['message']; ?></p>
                                    </div></td>
                                <td colspan="2"><div class="req_decline">Until <?php echo date("M d h:i", strtotime($request['to_date'])); ?> <br> 
                                        <?php if ($request['status'] == 1) { ?>
                                            <a href="javascript:void(0)" onclick="decline_request('<?php echo base64_encode($request['rid']); ?>', '<?php echo $request['name']; ?>')")">Decline  this request</a> </div></td>
                                <?php } ?>
                            </tr>
                            <tr class="edit_recommendation_table">
                                <td>
                                    <?php if (!empty($mutualStore)) { ?>
                                        <div class="request_social">
                                            <ul>
                                                <?php
                                                foreach ($mutualStore as $passion) {
                                                    $imageSrcPassion = 'passion_' . $passion['pid'] . '.png';
                                                    ?>
                                                    <li><a href="#"> <img title="<?php echo $passion['passion']; ?>" src="<?php echo $base_url . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/images/passion/<?php echo $imageSrcPassion; ?>"></a> </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    <?php } ?>
                                </td>
                                <td colspan="6"></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
<?php } ?>
<!--END OF LOCATION BLOCK-->

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
<!--END OF LISTING GUIDE-->


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