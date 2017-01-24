<?php
global $user, $base_url;
$userDetails = user_load($user->uid);
$select_language = unserialize($Main_user_data[0]['language']);
$location = array();
$desc = array();
foreach ($passeports as $key => $value) {
    if ($value['location']) {
        $location[] = $value['location'];
    }
    if ($value['description']) {
        $description[] = $value['description'];
    }

}
$aboutyourself = $userDetails->field_about_yourself['und']['0']['value'];
drupal_add_css(drupal_get_path('theme', 'gloobers_new') . '/css/style_cropper.css', 'file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') . '/css/owl.carousel.css', 'file');
drupal_add_js(drupal_get_path('theme', $GLOBALS['theme']) . '/js/autocomplete.js', array('scope' => 'footer'));
drupal_add_css(drupal_get_path('theme', $GLOBALS['theme']) . '/css/landing_page.css', 'file');
drupal_add_css(drupal_get_path('theme', $GLOBALS['theme']) . '/stylesheet/for-head-foot.css', 'file');
$query = db_select('fboauth_users', 'fb');
$query->fields('fb', array('uid', 'fbid'));
$query->condition('uid', $user->uid);
$result = $query->execute();
$facebook_login = $result->fetchAssoc();
$facebook_user_name = getUserDetails($facebook_login['uid']);
$facebook_user_name = explode(' ', $facebook_user_name['name']);
$facebook_user_name_first = $facebook_user_name[0];
?>
<div id="notifications" class="success_notification" style="display:none">
    <div class="alert alert-success">Successfully Added</div>
</div>

<section class="profile_image smokebg">
    <div class="container">
        <div class="row">
            <div class="cover_image">
                <div class="simple-cropper-images cover_img">
                    <div class="cropme" id="cp"
                         <?php if (!empty($cover_pic)){ ?>style="background-image:url('<?php $style = "cover_pic";
                         print image_style_url($style, $cover_pic); ?>')"<?php } ?>>
                        <div class="profile_text"><img
                                    src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/images/cover.png"
                                    alt="image"> <br/>Change the cover picture
                        </div>
                    </div>
                </div>

                <div class="user_info">
                    <div class="simple-cropper-images profile_pic">
                        <div class="cropme" id="dp">
                            <div class="overlaytext">
                                <div class="overprofile_text">
                                    <img src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/images/cover.png"
                                         alt="image">
                                    Change the profile picture
                                </div> <!-- End OverProfileText -->
                            </div> <!-- End Overlaytext -->
                            <?php
                            if (empty($facebook_login)) {
                                if (!empty($profile_pic)) { ?>
                                    <?php
                                    $style = "reservation_popup_listing_img";
                                    print '<img class="" src="' . image_style_url($style, $profile_pic) . '" alt="display pic">';
                                    ?>
                                    <div class="overlaytext">
                                        <div class="overprofile_text">
                                            <img src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/images/cover.png"
                                                 alt="image">
                                            Change the profile picture
                                        </div> <!-- End OverProfileText -->
                                    </div> <!-- End Overlaytext -->
                                <?php }
                            } else {

                                if ($userDetails->picture != "") {
                                    $file = file_load($userDetails->picture->fid);
                                    $profile_pic = $file->uri;
                                    ?>

                                    <?php $style = "reservation_popup_listing_img";
                                    print '<img class="" src="' . image_style_url($style, $profile_pic) . '" alt="display pic">';

                                    ?>

                                <?php }
                            } ?>

                        </div>
                    </div>
                    <h3><?php $firstName = $userDetails->field_first_name['und'][0]['value'];
                        echo (trim($firstName, "%20")) ? (trim($firstName, "%20")) : $facebook_user_name_first;
                        ?>
                    </h3>
                    <h4><?php echo $loc; ?></h4>
                </div>
                <div class="mask"></div>
            </div>

        </div>

    </div>

    </div>

</section>

<section class="about_me">
    <div class="container">
        <div class="row">
            <h3>About</h3>
            <div class="col-md-8 col-sm-8 col-xs-12">

<textarea class="about_me_info" name="about_me" cols="" rows="" onblur="update_about_info(this); "

          placeholder="Introduce yourself to the tribe, share your best travel souvenirs, the friendly local you won't forget or any other element that you want to let other travelers know about you"><?php if (!empty($Main_user_data[0]['about_yourself'])) {
        echo $Main_user_data[0]['about_yourself'];
    } ?></textarea>

            </div>

            <aside class="col-md-4 col-sm-4 col-xs-12">
                <div class="home_town">
                    <h3>Hometown </h3>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="text" autocomplete="off" value="<?php if (!empty($loc)) {
                            echo $loc;
                        } ?>" onclick="hometowngeocode();" id="home-town" onblur="add_hometown()"
                               placeholder="Enter your hometown" class="hometown" name="tags5">
                    </div>
                </div>


                <div class="home_town">
                    <h3>Occupation</h3>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <input name="Enter your occupation" id="occupation" type="text"
                               placeholder="Enter your occupation" onblur="add_occupation()"
                               value="<?php if (!empty($Main_user_data[0]['occupation'])) {
                                   echo $Main_user_data[0]['occupation'];
                               } ?>">
                        <div class="result_msg"></div>
                    </div>
                </div>


                <div class="home_town">
                    <h3>Phone Number</h3>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <input name="phonenumber" id="phone" type="text" placeholder="Enter your phone number"
                               onblur="add_phone_number()" value="<?php if (!empty($Main_user_data[0]['mobile'])) {
                            echo $Main_user_data[0]['mobile'];
                        } ?>">
                        <div class="result_msg_phn"></div>
                    </div>
                </div>

                <div class="home_town">
                    <h3>Languages </h3>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <select class="select_box" id="language" tabindex="2">
                            <?php foreach ($language as $lang) { ?>
                                <option value="<?php echo $lang['language'] ?>"> <?php echo $lang['language'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-12"><input type="submit" class="button pull-right" name="add"
                                                                    onclick="add_language();" value="Add"/></div>

                </div>

                <div id="Lang_div">
                    <?php
                    if (!empty($select_language)) {
                        foreach ($select_language as $lang) { ?>
                            <span tag="Bahasa Indonesia" class="tagmanagerTag"><?php echo $lang; ?><a
                                        href="javascript:void(0);" title="Remove" onclick="Delete_language(this)"
                                        class="tagmanagerRemoveTag">x</a></span>
                        <?php }
                    } ?>
                </div>

            </aside>
        </div>
    </div>
</section>


<section class="verifications">

    <div class="container">

        <!--col-lg-6 col-md-6 col-sm-12 col-lg-offset-3 col-md-offset-3-->

        <div class="">

            <h3>Verifications</h3>


            <?php

            if (empty($facebook_login)) {

                if ($Main_user_data[0]['confirm_status'] == 'yes') {
                    $userEmail = 'Verified';
                } else {
                    $userEmail = 'Not Verified';
                }

            } else {

                $userEmail = 'Verified';

            }

            ?>

            <!--col-lg-3 col-sm-3 col-xs-12-->
            <div class="verification_box">
                <?php if (!empty($facebook_login)) { ?>
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                        <div class="verifications_title"> Facebook</div>
                        <div class="verifications_cont"><?php echo $userEmail; ?></div>
                    </div>
                <?php } ?>

                <div class="col-lg-6 col-sm-6 col-xs-12">
                    <div class="verifications_title"> Email</div>
                    <div class="verifications_cont"><?php echo $userEmail; ?></div>
                </div>

            </div>

        </div>

    </div>

    </div>

</section>

<section class="passions">
    <div class="container">
        <h3>Passions </h3>
        <div class="row">
            <div class="grid">
                <div id="owl-demo" class="owl-carousel owl-theme">
                    <?php //echo "<pre>";print_r($passionlist);die; ?>
                    <?php foreach ($passionlist as $passion) {
                        $file = file_load($passion['fid']);
                        $imgpath = $file->uri;
                        $style = 'passion_image';
                        $file_thumb = file_load($passion['fid_thumb']);
                        $imgpath_thumb = $file_thumb->uri;
                        ?>
                        <div class="item">
                            <figure class="effect-layla"><img alt="img06"
                                                              src="<?php print image_style_url($style, $imgpath); ?>">
                                <figcaption>
                                    <?php //if($file_thumb){ ?>
                                    <!--  <div class="contblock"> <i><img alt=" " src="<?php print file_create_url($imgpath_thumb); ?>"></i>  </div> -->
                                    <?php //} ?>
                                    <h2><?php echo $passion['passion']; ?></h2>
                                </figcaption>
                            </figure>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <a href="<?php echo $base_url; ?>/user/editpassions" class="edit">Edit Passions</a>
        </div>
    </div>
</section>

<section class="passport">
    <div class="container">
        <div class="row"><h3>Passeport </h3>
            <div class="search_place"> <?php Print ($passeportListDOM) ?> </div>
        </div>
    </div>
</section>

<?php $recommendation_link = generate_link();
$recommendation_link = urldecode($recommendation_link);
?>
<div class="invitationlinkblock">
    <div class="container">
        <div class="row">
            <div class="invitationpanel">
                <div class="col-md-12 col-sm-12 col-xs-12"><h3>Invitation link </h3></div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <p>Share this link with anyone you would like to see joining the tribe. Passionate travelers,
                        devoted advisors or talented professionals. You will get rewarded on every single of their
                        trips, followed recommendations or reservations received.</p>
                </div>
                <div class="col-md-10 col-sm-10 col-xs-12"><input name="input" id="dynamic" readonly type="text"
                                                                  value="<?php echo $recommendation_link; ?>"></div>
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <a class="actionbtn pull-right btnc" data-clipboard-action="copy" data-clipboard-target="#dynamic"
                       href="javascript:void(0);">Copy</a>

                </div>

                <div class="col-md-12 col-sm-12 col-xs-12 socil_icon">

                    <!--<div class="col-md-4 col-sm-4 col-xs-12">-->
                    <!--<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=-->
                    <?php //echo $recommendation_link;?><!--">-->
                    <!--<i class="fa fa-facebook"></i><p>Share on Facebook </p> </a>-->
                    <!--</div>-->
                    <?= $fbAuthLink ?>
<?= $linkedinLink ?>
                    <?php
                    drupal_add_js(GPLUS_SYNC_MODULE_PATH.'/gplus_sync.js');
                    drupal_add_js(GPLUS_SYNC_URL_GPLUS_JS_CLIENT);
                    $client_id = variable_get('gplus_sync_client_id');
                    ?>
                    <div id="gConnect">
                        <button class="g-signin"
                                data-scope="https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email"
                                data-requestvisibleactions="http://schemas.google.com/AddActivity"
                                data-clientId="<?php print $client_id; ?>"
                                data-accesstype="offline"
                                data-callback="gplus_sync_sign_on_callback"
                                data-theme="light"
                                data-approvalprompt="force"
                                data-cookiepolicy="single_host_origin">
                        </button>
                    </div>
<!--                    <div class="col-md-4 col-sm-4 col-xs-12">-->
<!--                        <a class="" target="_blank"-->
<!--                           href="https://plus.google.com/share?url=--><?php //echo $recommendation_link; ?><!--">-->
<!--                            <i class="fa fa-google-plus"></i>-->
<!--                            <p>Share on Google+ </p></a>-->
<!--                    </div>-->

                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <a target="_blank" href="https://twitter.com/home?status=<?php echo $recommendation_link; ?>">
                            <i class="fa fa-twitter"></i>
                            <p>Share on Twitter </p></a>
                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <a target="_blank" href="https://twitter.com/home?status=<?php echo $recommendation_link; ?>">
                            <i class="fa fa-linkedin"></i>
                            <p>Share on Twitter </p></a>
                    </div>

                </div>
            </div>
        </div>
    </div> <!-- End InvitationLinkBlock -->


    <!--Js Files -->
    <script src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/js/jquery.selectbox-0.2.js"></script>
    <script src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/js/jquery.nicescroll.min.js"></script>
    <script src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/js/jquery.Jcrop.js"></script>
    <script src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/js/jquery.SimpleCropper.js"></script>
    <script src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/js/owl.carousel.js"></script>

    <div id="get_passeport"></div>
    <!--Js Functions -->
    <script type="text/javascript">
        jQuery(document).ready(function () {
            /*SelectBox*/
            jQuery("select").selectbox();
            jQuery(document).click(function (e) {
                if (!jQuery(e.target).is('.sbHolder, .sbHolder *')) {
                    jQuery("select").selectbox('close');
                }
            }); //End
            jQuery("#dp").hover(function () {
                jQuery(".overlaytext").fadeIn();
            }, function () {
                jQuery(".overlaytext").fadeOut();
            });

            var owl = jQuery("#owl-demo");
            owl.owlCarousel({
                items: 4, //10 items above 1000px browser width
                itemsDesktop: [1000, 3], //5 items between 1000px and 901px
                itemsDesktopSmall: [900, 2], // betweem 900px and 601px
                itemsTablet: [600, 1], //2 items between 600 and 0
                itemsMobile: false // itemsMobile disabled - inherit from itemsTablet option
            });


// Custom Navigation Events
            jQuery(".next").click(function () {
                owl.trigger('owl.next');
            })

            jQuery(".prev").click(function () {
                owl.trigger('owl.prev');
            })

            jQuery(".play").click(function () {
                owl.trigger('owl.play', 1000); //owl.play event accept autoPlay speed as second parameter
            })

            jQuery(".stop").click(function () {
                owl.trigger('owl.stop');
            })

        });


        jQuery(document).ready(function () {

            /*Initialize another map*/

            jQuery('#map_canvas').before('<div style="display:none;width: 100%; height: 350px;" id="map_canvas_new"></div>');
            function initialize() {
                var mapOptions = {
                    center: new google.maps.LatLng(52.5167, 13.3833),
                    zoom: 10,
                };
                var map = new google.maps.Map(document.getElementById("map_canvas_new"), mapOptions);
            }

            google.maps.event.addDomListener(window, 'load', initialize);

            /*End Initialized another map*/

            jQuery("html").niceScroll();

            var locations =<?php echo json_encode($location); ?>;

            var loc_desc_all =<?php echo json_encode($description); ?>;

            var markers = new Array();


            for (var x = 0; x < locations.length; x++) {

                switch (loc_desc_all[x]) {

                    case "I live there":

                        var pinColor = "88FF88";

                        break;

                    case "I've been living there":

                        var pinColor = "FF9933";

                        break;

                    case "I've been there in a business trip":

                        var pinColor = "0099FF";

                        break;

                    case "I've been there in a romantic trip":

                        var pinColor = "FF0000";

                        break;

                    case "I've been there with a group":

                        var pinColor = "0000CC";

                        break;

                    case "I've been there in a lone exploration":

                        var pinColor = "3366CC";

                        break;
                    case "I've been there in a family trip":

                        var pinColor = "84a366";

                        break;
                    case "I've been trip with A friend":
                        var pinColor = "ffe4c4";
                        break;


                }

                var myUrl = 'http://maps.googleapis.com/maps/api/geocode/json?address=' + locations[x] + '&sensor=false';

                jQuery.ajax({

                    url: myUrl,

                    dataType: 'json',

                    async: false,

                    success: function (data) {

                        p = data.results[0].geometry.location;

                        markers[x] = {"lat": p.lat, "lng": p.lng, "color": pinColor};


                    }

                });


            }

            var width = jQuery(window).width();
            var height = jQuery(window).height();

            if (width >= "1900") {
                var maxZoomvar = 5;

            } else if (width >= "1340") {
                var maxZoomvar = 15;

            } else {
                var maxZoomvar = 15;

            }

            if (height >= "980") {
                var maxZoomvar = 5;

            } else if (height >= "630") {
                var maxZoomvar = 15;

            } else {
                var maxZoomvar = 15;

            }
            console.log(maxZoomvar);


            if (locations.length > 0) {

                var mapOptions = {
                    minZoom: 3,
                    maxZoom: maxZoomvar,
                    center: new google.maps.LatLng(markers[0].lat, markers[0].lng),
                    mapTypeId: 'terrain'

                };


            } else {

                jQuery('#map_canvas_new').show();
                jQuery('#map_canvas').hide();
                return false;

            }


            var infoWindow = new google.maps.InfoWindow();

            var latlngbounds = new google.maps.LatLngBounds();

            var map = new google.maps.Map(jq('#map_canvas')[0], mapOptions);

            var i = 0;

            if (locations.length > 0) {

                var interval = setInterval(function () {

                    var data = markers[i];

                    /* }else{

                     markers[0] = {"lat":0,"lng":0,"color":'ffffff','description':'N/A'};

                     var data = markers[0];

                     }	 */


                    var myLatlng = new google.maps.LatLng(data.lat, data.lng);

                    icon = "http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + data.color;


                    var marker = new google.maps.Marker({

                        position: myLatlng,

                        map: map,

                        animation: google.maps.Animation.DROP,

                        icon: new google.maps.MarkerImage(icon)

                    });

                    // (function (marker, data){

                    //     google.maps.event.addListener(marker, "click", function (e) {

                    //         infoWindow.setContent(data.description);

                    //         infoWindow.open(map, marker);

                    //     });

                    // })(marker, data);

                    latlngbounds.extend(marker.position);

                    i++;

                    if (i == markers.length) {

                        clearInterval(interval);

                        var bounds = new google.maps.LatLngBounds();

                        map.setCenter(latlngbounds.getCenter());

                        map.fitBounds(latlngbounds);

                    }

                }, 80);

            }

        });


        // Init Simple Cropper
        //jQuery('#dp').simpleCropper();
        jQuery('.cropme').simpleCropper();
        jQuery(document).ready(function () {
            jQuery(".nav-dropdown-content").niceScroll();
            /*SelectBox*/
            jQuery("select").selectbox();
            jQuery(document).click(function (e) {
                if (!jQuery(e.target).is('.sbHolder, .sbHolder *')) {
                    jQuery("select").selectbox('close');
                }
            }); //End

            // Menu Script
            jQuery(function () {
                jQuery('.showhide').click(function () {
                    jQuery(".slidediv").slideToggle();
                });
                jQuery('.togelsubmenu').click(function () {
                    jQuery(".submenu").slideToggle();
                });
            });
        });

        jQuery(window).on('resize', function () {
            var width = jQuery(window).width();
            if (width < 1024) {
                jQuery('.navmenu').click(function () {
                    jQuery("#nav").slideToggle();
                });
            } else {
                jQuery(".navmenu").css("display", "none");
            }
        });

        function add_hometown() {
            var hometown = jQuery('.hometown').val();
            fullHometonwAddress['homtown'] = hometown;
            jQuery.ajax({
                url: $baseUrl + '/ajax/user/hometown',
                type: 'post',
                data: fullHometonwAddress,
                /* success: function (result) {
                 alert(result);
                 }, */
            });
        }

        function add_occupation() {
            var occupation = jQuery('#occupation').val();
            jQuery.ajax({
                url: $baseUrl + '/ajax/user/occupation',
                type: 'post',
                data: {occupation: occupation},
                success: function (result) {
                    //jQuery('.result_msg').html(result);
                },
            });
        }

        function add_phone_number() {
            var phonenumber = jQuery('#phone').val();
            jQuery.ajax({
                url: $baseUrl + '/ajax/user/add_phone_number',
                type: 'post',
                async: false,
                data: {phone: phonenumber},
                success: function (data) {
                    var res = jQuery.parseJSON(data);
                    if (res.status == 'success') {
                        jQuery('.result_msg_phn').show();
                        jQuery('.result_msg_phn').removeClass('error_msg_phn');
                        jQuery('.result_msg_phn').addClass('success_msg_phn');
                        jQuery('.result_msg_phn').html('<i class="fa fa-check"></i> ' + res.message);
                    } else {
                        jQuery('.result_msg_phn').show();
                        jQuery('.result_msg_phn').removeClass('success_msg_phn');
                        jQuery('.result_msg_phn').addClass('error_msg_phn');
                        jQuery('.result_msg_phn').html('<i class="fa fa-remove"></i> ' + res.message);
                    }
                },
            });
            jQuery('.result_msg_phn').hide(7000);
        }

        function add_language() {
            var language = jQuery('#language').val();
            jQuery.ajax({
                url: $baseUrl + '/ajax/user/language',
                type: 'post',
                data: {language: language},
                success: function (result) {
                    jQuery('#Lang_div').html(result);
                },
            });
        }

        function Delete_language(language) {
            var language = jQuery(language).parent().attr('tag');
            jQuery.ajax({
                url: $baseUrl + '/ajax/user/deletelanguage',
                type: 'post',
                data: {language: language},
                success: function (result) {
                    jQuery('#Lang_div').html(result);
                },
            });
        }
    </script>

    <script type="text/javascript">
        function insertMap() {
            get_passeport();
            var Updated_passeport = document.getElementById("get_passeport").innerHTML;
            var getContants = Updated_passeport.split('|');
            var locationsall = getContants[0];
            var locations = Array();
            var locdesc = getContants[1];
            var loc_desc_all = Array();
            locations = jQuery.parseJSON(locationsall);
            loc_desc_all = jQuery.parseJSON(locdesc);
            var markers = new Array();
            /* alert(locations);
             alert(loc_desc_all); */
            for (var x = 0; x < locations.length; x++) {
                switch (loc_desc_all[x]) {
                    case "I live there":
                        var pinColor = "88FF88";
                        break;
                    case "I've been living there":
                        var pinColor = "FF9933";
                        break;
                    case "I've been there in a business trip":
                        var pinColor = "0099FF";
                        break;
                    case "I've been there in a romantic trip":
                        var pinColor = "FF0000";
                        break;
                    case "I've been there with a group":
                        var pinColor = "0000CC";
                        break;
                    case "I've been there in a lone exploration":
                        var pinColor = "3366CC";
                        break;
                    case "I've been there in a family trip":
                        var pinColor = "84a366";
                        break;
                    case "I've been trip with A friend":
                        var pinColor = "ffe4c4";
                        break;

                }

                var myUrl = 'http://maps.googleapis.com/maps/api/geocode/json?address=' + locations[x] + '&sensor=false';
                jQuery.ajax({
                    url: myUrl,
                    dataType: 'json',
                    async: false,
                    success: function (data) {
                        p = data.results[0].geometry.location;
                        markers[x] = {"lat": p.lat, "lng": p.lng, "color": pinColor};
                    }
                });
            }

            var width = jQuery(window).width();
            var height = jQuery(window).height();

            if (width >= "1900") {
                var maxZoomvar = 5;

            } else if (width >= "1340") {
                var maxZoomvar = 15;

            } else {
                var maxZoomvar = 15;

            }

            if (height >= "980") {
                var maxZoomvar = 5;

            } else if (height >= "630") {
                var maxZoomvar = 15;

            } else {
                var maxZoomvar = 15;

            }
            console.log("maxZoomvar:" + maxZoomvar);

            //if(locations!=''){
            var mapOptions = {
                center: new google.maps.LatLng(markers[0].lat, markers[0].lng),
                minZoom: 3,
                maxZoom: maxZoomvar,
                mapTypeId: 'terrain'
            };
            /* }else{
             var myOptions = {
             zoom: 1,
             center: new google.maps.LatLng(0, 0),
             mapTypeId: 'terrain'
             };
             map = new google.maps.Map(jq('#map_canvas')[0], myOptions);
             } */
            var infoWindow = new google.maps.InfoWindow();
            var latlngbounds = new google.maps.LatLngBounds();
            var map = new google.maps.Map(jq('#map_canvas')[0], mapOptions);
            var i = 0;
            var interval = setInterval(function () {
                var data = markers[i];
                var myLatlng = new google.maps.LatLng(data.lat, data.lng);
                icon = "http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + data.color;
                var marker = new google.maps.Marker({
                    position: myLatlng,
                    map: map,
                    animation: google.maps.Animation.DROP,
                    icon: new google.maps.MarkerImage(icon)
                });
                latlngbounds.extend(marker.position);
                i++;
                if (i == markers.length) {
                    clearInterval(interval);
                    var bounds = new google.maps.LatLngBounds();
                    map.setCenter(latlngbounds.getCenter());
                    map.fitBounds(latlngbounds);
                }
            }, 80);
            jQuery('#_trip_loction1').attr('placeholder', 'Destination');
            jQuery('#_trip_loction1').attr('value', '');
        }

        function get_passeport() {
            var location = jQuery('#_trip_loction1').val();
            var description = jQuery('#loc_desc').val();
            jQuery.ajax({
                url: $baseUrl + '/ajax/user/getpasseport',
                type: 'post',
                async: false,
                success: function (result) {
                    var response = result;
                    console.log(response.length);
                    if (response.length == 5) {
                        jQuery('#get_passeport').html('');
                        jQuery('#map_canvas_new').show();
                        jQuery('#map_canvas').hide();
                    } else {
                        jQuery('#map_canvas').show();
                        jQuery('#map_canvas_new').hide();
                        jQuery('#get_passeport').html(result);
                    }

                },
            });
        }

        function add_passeport() {
            var location = jQuery('#_trip_loction1').val();
            if (location == '') {
                alert('Please select Destination.');
                jQuery('#_trip_loction').attr('placeholder', 'Destination');
                jQuery('#_trip_loction').val('');
                return false;
            }

            fullAddress['description'] = jQuery('#loc_desc').val();
            fullAddress['location'] = location;
            jQuery.ajax({
                url: $baseUrl + '/ajax/user/addpasseport',
                type: 'post',
                async: false,
                data: fullAddress,
                success: function (result) {
                    jQuery('#createElementHandlerBox').html(result);
                    jQuery('#_trip_loction1').val('');
                },
            });
            insertMap();
        }
        var fullAddress = {
            address: '',
            city: '',
            state: '',
            country: ''
        };
        function search_destination() {
            var home_autocomplete = new google.maps.places.Autocomplete(
                /** @type {HTMLInputElement} */
                (document.getElementById('_trip_loction1')),
                {types: ['geocode']});

            home_autocomplete.addListener('place_changed', function () {
                var place = home_autocomplete.getPlace();
                var arrAddress = place.address_components;
                for (var i = 0; i < arrAddress.length; i++) {
                    if (arrAddress[i].types[0] == "route") {
                        fullAddress['address'] = arrAddress[i].long_name;
                    }
                    if (arrAddress[i].types[0] == "locality") {
                        fullAddress['city'] = arrAddress[i].long_name;
                    }
                    if (arrAddress[i].types[0] == "administrative_area_level_1") {
                        fullAddress['state'] = arrAddress[i].short_name;
                    }
                    if (arrAddress[i].types[0] == "country") {
                        fullAddress['country'] = arrAddress[i].long_name;
                    }
                }

            });
        }
        function Delete_passeport(location) {
            var location2 = jQuery(location).parent().attr('tag');
            jQuery.ajax({
                url: $baseUrl + '/ajax/user/deletepasseport',
                type: 'post',
                async: false,
                data: {location: location2},
                success: function (result) {
                    jQuery('#createElementHandlerBox').html(result);
                }
            });
            Delete_map(location);
        }

        function Delete_map(location) {
            get_passeport();
            var Updated_passeport = document.getElementById("get_passeport").innerHTML
            var getContants = Updated_passeport.split('|');
            var locationsall = getContants[0];
            var locationsAll = Array();
            var locdesc = getContants[1];
            var locDesc = Array();
            locationsAll = jQuery.parseJSON(locationsall);
            locDesc = jQuery.parseJSON(locdesc);
            //var value_del_select=jQuery.inArray(location_select,locationsAll);
            //var locations_removed = locationsAll.splice(value_del_select,1);
            //var locDesc_removed = locDesc.splice(value_del_select,1);
            /* alert(locationsAll.length);
             alert(locDesc); */
            var markers = new Array();

            for (var x = 0; x < locationsAll.length; x++) {
                switch (locDesc[x]) {
                    case "I live there":
                        var pinColor = "88FF88";
                        break;
                    case "I've been living there":
                        var pinColor = "FF9933";
                        break;
                    case "I've been there in a business trip":
                        var pinColor = "0099FF";
                        break;
                    case "I've been there in a romantic trip":
                        var pinColor = "FF0000";
                        break;
                    case "I've been there with a group":
                        var pinColor = "0000CC";
                        break;
                    case "I've been there in a lone exploration":
                        var pinColor = "3366CC";
                        break;
                }

                var myUrl = 'http://maps.googleapis.com/maps/api/geocode/json?address=' + locationsAll[x] + '&sensor=false';
                jQuery.ajax({
                    url: myUrl,
                    dataType: 'json',
                    async: false,
                    success: function (data) {
                        // alert(data);
                        p = data.results[0].geometry.location;
                        markers[x] = {"lat": p.lat, "lng": p.lng, "color": pinColor};
                        //set_value(markers);
                    }
                });
            }

            if (locationsAll.length > 0) {
                var mapOptions = {
                    center: new google.maps.LatLng(markers[0].lat, markers[0].lng),
                    zoom: 1,
                    mapTypeId: 'terrain'
                };
            } else {
                var myOptions = {
                    zoom: 1,
                    center: new google.maps.LatLng(0, 0),
                    mapTypeId: 'terrain'
                };
                map = new google.maps.Map(jq('#map_canvas')[0], myOptions);
            }

            var infoWindow = new google.maps.InfoWindow();
            var latlngbounds = new google.maps.LatLngBounds();
            // var map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);
            var map = new google.maps.Map(jq('#map_canvas')[0], mapOptions);
            var i = 0;
            if (locationsAll.length > 0) {
                var interval = setInterval(function () {
                    var data = markers[i];
                    var myLatlng = new google.maps.LatLng(data.lat, data.lng);
                    icon = "http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + data.color;
                    var marker = new google.maps.Marker({
                        position: myLatlng,
                        map: map,
                        animation: google.maps.Animation.DROP,
                        icon: new google.maps.MarkerImage(icon)
                    });
                    latlngbounds.extend(marker.position);
                    i++;
                    if (i == markers.length) {
                        clearInterval(interval);
                        var bounds = new google.maps.LatLngBounds();
                        map.setCenter(latlngbounds.getCenter());
                        map.fitBounds(latlngbounds);
                    }
                }, 80);
            }
        }

        function update_about_info(val) {
            var about_me = val.value;
            var Dp = jQuery('#dp').find('img').attr('src');
            var Cp = jQuery('#cp').find('img').attr('src');
            if (!Dp) {
                var Dp = '0';
            }
            if (!Cp) {
                var Cp = '0';
            }
            if (!about_me) {
                return false;
            }
            jQuery.ajax({
                url: $baseUrl + '/ajax/user/update_basic_info',
                type: 'post',
                async: true,
                data: {about_me: about_me},

                beforeSend: function () {
                    preLoading('show', 'load-screen');

                },

                success: function (data) {
                    preLoading('hide', 'load-screen');
                    jQuery(".success_notification").html('<div class="alert alert-success">' + data + '</div>');
                    jQuery(".success_notification").fadeIn(500);

                    window.setTimeout(function () {
                        jQuery('.success_notification').fadeOut(500);
                    }, 2000);

                }

            });


        }

        function update_dp() {
            var Dp = jQuery('#dp').find('img').attr('src');
            var Cp = jQuery('#cp').find('img').attr('src');
            if (!Dp) {
                var Dp = '0';
            }
            if (!Cp) {
                var Cp = '0';
            }
            jQuery.ajax({
                url: $baseUrl + '/ajax/user/update_Dp',
                type: 'post',
                data: {profile_pic: Dp, cover_pic: Cp},
                beforSend: function () {
                    preLoading('show', 'load_screen');
                }
            });
        }
        // Menu Script
        jQuery(document).ready(function () {
            jQuery('.showhide').click(function (e) {
                e.preventDefault();
                jQuery('.nav_main_menu').find('ul').toggleClass('dropdwonmenu_remove dropdwonmenu');
            });

            jQuery('.togelsubmenu').click(function (e) {
                e.preventDefault();
                jQuery('.nav_main_menu').find('ul li ul').toggleClass('dropdwonmenu_remove1 dropdwonmenu1');
            });
        });
    </script>
    <script type="text/javascript">
        var fullHometonwAddress = {
            address: '',
            city: '',
            state: '',
            country: ''
        };
        function hometowngeocode() {
            var home_autocomplete = new google.maps.places.Autocomplete(
                /** @type {HTMLInputElement} */
                (document.getElementById('home-town')),
                {types: ['geocode']});

            home_autocomplete.addListener('place_changed', function () {
                var place = home_autocomplete.getPlace();
                var arrAddress = place.address_components;
                for (var i = 0; i < arrAddress.length; i++) {
                    if (arrAddress[i].types[0] == "route") {
                        fullHometonwAddress['address'] = arrAddress[i].long_name;
                    }
                    if (arrAddress[i].types[0] == "locality") {
                        fullHometonwAddress['city'] = arrAddress[i].long_name;
                    }
                    if (arrAddress[i].types[0] == "administrative_area_level_1") {
                        fullHometonwAddress['state'] = arrAddress[i].short_name;
                    }
                    if (arrAddress[i].types[0] == "country") {
                        fullHometonwAddress['country'] = arrAddress[i].long_name;
                    }
                }

            });
        }
    </script>

    <script src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/js/advisor.js"></script>
    <script src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/js/clipboard.min.js"
            type="text/javascript"></script>
    <script>
        var clipboard = new Clipboard('.btnc');

        clipboard.on('success', function (e) {
            console.log(e);
        });

        clipboard.on('error', function (e) {
            console.log(e);
        });
    </script>

