<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gloobers</title>
    <script src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyA9ZXW_xxCYbGV5hAN13jO2yquESD3MY10 &libraries=places&language=en"></script>
    <script src="https://cdn.sobekrepository.org/includes/gmaps-markerwithlabel/1.9.1/gmaps-markerwithlabel-1.9.1.min.js"></script>
    <?php
    global $base_path;
    drupal_add_css('https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|PT+Sans:400,700', ['type' => 'external']);
    drupal_add_css('sites/all/themes/new_design/css/sprite.css', ['type' => 'file']);
    drupal_add_css('sites/all/themes/new_design/css/jquery.fancybox.css', ['type' => 'file']);
    drupal_add_css('sites/all/themes/new_design/css/daterangepicker.css', ['type' => 'file']);
    drupal_add_css('sites/all/themes/new_design/css/drop-theme-arrows.css', ['type' => 'file']);
    drupal_add_css('sites/all/themes/new_design/css/bootstrap.min.css', ['type' => 'file']);
    drupal_add_css('sites/all/themes/new_design/css/bootstrap-theme.min.css', ['type' => 'file']);
    drupal_add_css('sites/all/themes/new_design/css/star-rating.min.css', ['type' => 'file']);
    //    drupal_add_css('sites/all/themes/new_design/css/toggle-switch-px.css', ['type' => 'file']);
    drupal_add_css('sites/all/themes/new_design/css/all.css', ['type' => 'file']);
    $cover = isset($profileInfo['profile']['cover_img']) ? image_style_url('cover_pic', $profileInfo['profile']['cover_img']) : $GLOBALS['base_url'] . '/' . drupal_get_path('theme', 'new_design') . '/images/bg-main.jpg';
    $avatar = isset($profileInfo['profile']['profile_img']) ? image_style_url('reservation_popup_listing_img', $profileInfo['profile']['profile_img']) : $GLOBALS['base_url'] . '/' . drupal_get_path('theme', 'new_design') . '/images/photo01-big.jpg';
    ?>
</head>
<body>
<div class="wrapper">
    <header class="header">
        <div class="header-holder container-fluid">
            <a href="#" class="logo"><img
                        src="<?= $base_path . drupal_get_path('theme', 'new_design') . '/images/logo-inner.png' ?>"
                        alt="Gloobers" height="60" width="49"></a>
            <nav class="nav">
                <ul class="main-nav">
                    <li><a href="#">About <i class="gl-ico gl-ico-arrow-down"></i></a></li>
                    <li class="active"><a href="#">Professionals</a></li>
                    <li><a href="#">Log in</a></li>
                </ul>
                <a href="#" class="btn btn-default">Create an activity</a>
            </nav>
            <div class="object-type">
                <!--                <a href="#" class="open-drop" data-offset="-10px 0" data-theme="drop-theme-arrows-bounce">-->
                <!--                    Hotels <i class="gl-ico gl-ico-arrow-down"></i>-->
                <!--                </a>-->
                <!--                <div class="drop-content hide">-->
                <!--                    <div class="drop-list">-->
                <!--                        <ul>-->
                <!--                            <li><a href="#">Hotels</a></li>-->
                <!--                            <li><a href="#">Activites</a></li>-->
                <!--                            <li class="active"><a href="#">Advisors</a></li>-->
                <!--                        </ul>-->
                <!--                    </div>-->
                <!--                </div>-->
                <select class="sel" name="" id="search-items">
                    <option>Hotels</option>
                    <option>Activities</option>
                    <option>Advisors</option>
                </select>
            </div>
            <div class="search-row">
                <i class="fa fa-search" aria-hidden="true"></i>
                <input id="search-prompt" class="search-field" onclick="searchAutocompleteByItem('search-prompt')"
                       type="text" placeholder="Start searching">
            </div>
        </div>
    </header>
    <main class="main">
        <div class="visual" id="profile-tether-target">
            <div class="container">
                <div class="row">
                    <div class="col-xs-4">
                        <div class="aspect"></div>
                    </div>
                </div>
            </div>
            <div id="profile-tether-elm" class="profile-aside-area">
                <div class="container">
                    <div class="row">
                        <div class="profile-aside-wrap col-xs-4">
                            <div class="profile-aside">
                                <div class="profile-avatar">
                                    <img src="<?= $avatar ?>" alt="ava">
                                </div>
                                <h2 class="text-center"><?= $profileInfo['profile']['first_name'] ?> <?= $profileInfo['profile']['last_name'] ?></h2>
                                <strong class="sub-ttl text-center">
                                    <?php if ($profileInfo['profile']['user_city']) {
                                        ?>
                                        <?= $profileInfo['profile']['user_city'] ?>
                                    <?php } ?>

                                    <?php if ($profileInfo['profile']['user_country']) {
                                        ?>
                                        ,
                                        <?= $profileInfo['profile']['user_country'] ?>
                                    <?php } ?>
                                </strong>

                                <span class="position">
                    <?php if ($profileInfo['profile']['occupation']) {
                        ?>
                        <?= $profileInfo['profile']['occupation'] ?>
                    <?php } ?>

                                    <?php if ($profileInfo['profile']['company']) {
                                        ?>
                                        in
                                        <?= $profileInfo['profile']['company'] ?>
                                    <?php } ?>
                        </span>

                                <div class="socials-connected">
                                    <div class="cell">
                                        <?php
                                        if ($profileInfo['profile']['fbid']) {
                                            ?>
                                            <a href="#" class="btn"><i class="gl-ico gl-ico-facebook"></i> Facebook</a>
                                            <span class="connection-status">Connected</span>
                                            <?php
                                        } else {
                                            ?>
                                            <a href="#" class="btn disabled"><i class="gl-ico gl-ico-facebook"></i> Facebook</a>
                                            <span class="connection-status disabled">Not verified</span>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="cell">
                                        <?php
                                        if ($profileInfo['profile']['gplus_sync_url_profile']) {
                                            ?>
                                            <a href="#" class="btn"><i class="gl-ico gl-ico-google-plus"></i> Google+ </a>
                                            <span class="connection-status">Connected</span>
                                            <?php
                                        } else {
                                            ?>
                                            <a href="#" class="btn disabled"><i class="gl-ico gl-ico-google-plus"></i> Google+
                                            </a>
                                            <span class="connection-status disabled">Not verified</span>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="cell">
                                        <?php
                                        if ($profileInfo['profile']['twitter_uid']) {
                                            ?>
                                            <a href="#" class="btn"><i class="gl-ico gl-ico-twitter"></i> Twitter </a>
                                            <span class="connection-status">Connected</span>
                                            <?php
                                        } else {
                                            ?>
                                            <a href="#" class="btn disabled"><i class="gl-ico gl-ico-twitter"></i> Twitter </a>
                                            <span class="connection-status disabled">Not verified</span>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="booking-btns">
                                    <a href="#" class="btn btn-default fill-width"><i class="gl-ico gl-ico-logo"></i>View
                                        recommendations</a>
                                    <span class="special-info">Special conditions for service usage</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <img class="visual-img" src="<?= $cover ?>" alt="image" width="1920" height="370">
        </div>
        <div class="container">
            <div class="row">
                <div class="profile-content col-xs-8 pull-right">
                    <div class="object-desc-heading profile-desc-heading">
                        <div class="object-ttl">
                            <div class="ttl-info">
                                <div class="object-rate-info">
                                    <strong class="rating-ttl">Advisor's rating</strong>
                                    <div class="rating">
                                        <div class="stars">
                                            <?php for ($i = 0; $i < $profileInfo['profile']['overall_advisor_rating']; $i++) { ?>
                                                <span class="star"><i class="gl-ico gl-ico-star" aria-hidden="true"></i></span>
                                            <?php } ?>
                                            <?php for ($k = 0; $k < 5 - $profileInfo['profile']['overall_advisor_rating']; $k++) { ?>
                                                <span class="star empty"><i class="gl-ico gl-ico-star"
                                                                            aria-hidden="true"></i></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="recommended-for">
                            <div class="recommend-eval-wrap">
                                <div class="recommend-eval">
                                    <strong class="eval-percent"><?= $profileInfo['experience']['user_trips_count'] ?></strong>
                                    <span class="eval-name">Trips</span>
                                </div>
                                <div class="recommend-eval eval-luxury">
                                    <strong class="eval-percent"><?= $profileInfo['experience']['user_listings_count'] ?></strong>
                                    <span class="eval-name">Listings</span>
                                </div>
                                <div class="recommend-eval eval-travel">
                                    <strong class="eval-percent">2</strong>
                                    <span class="eval-name">Travel Guides</span>
                                </div>
                                <div class="recommend-eval eval-budget">
                                    <strong class="eval-percent"><?= $profileInfo['experience']['user_reviews_count'] ?></strong>
                                    <span class="eval-name">Reviews</span>
                                </div>
                            </div>
                            <i class="extra-info-line">Based on travelers experience</i>
                        </div>
                    </div>
                    <div class="profile-block">
                        <h3 class="text-center">About</h3>
                        <p><?= $profileInfo['profile']['about_yourself'] ?></p>
                       </div>
                    <div class="profile-block">
                        <h3>Passions</h3>
                        <div class="passions-list">
                            <?php
                            if (is_array($profileInfo['passions']) && count($profileInfo['passions'])) {
                                foreach ($profileInfo['passions'] as $passion) {
                                    $file = file_load($passion['fid']);
                                    $imgpath = $file->uri;
                                    ?>
                                    <div class="item">
                                        <div class="img-h">
                                            <img src="<?php print image_style_url('passion_image', $imgpath); ?>"
                                                 alt="image">
                                        </div>
                                        <span class="passion-label"><?= $passion['passion'] ?></span>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <div class="btn-row text-center">
                            <a href="" class="btn">See more</a>
                        </div>
                    </div>
                    <div class="profile-block">
                        <h3>Passport</h3>
                        <div class="passport-map">
                            <div id="map" class="map"></div>
                            <div class="mask"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="footer">
        <div class="container">
            <a href="#" class="logo"><img src="<?= $base_path . drupal_get_path('theme', 'new_design') . '/images/logo.png' ?>" alt="Gloobers" height="59" width="160"></a>
            <div class="soc-list">
                <a class="item" href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                <a class="item" href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a class="item" href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
            </div>
            <ul class="footer-nav">
                <li><a href="#">Home</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Gloobers for professionals</a></li>
            </ul>
        </div>
        <div class="footer-row container">
            <p class="copy"><strong>Gloobers Global Ltd.</strong> 2016. All rights reserved</p>
            <ul class="extra-nav">
                <li><a href="#">Help center</a></li>
                <li><a href="#">Terms and Conditions</a></li>
            </ul>
        </div>
    </footer>
</div>
<!-- start modal window recommendation -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-custom-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Recommend this activity</h4>
                <strong class="sub-ttl">And get rewarded when other travelers follow your recommendatuion</strong>
            </div>
            <div class="modal-body">
                <div class="edit-recommendation-holder">
                    <div class="column">
                        <textarea class="form-control" id="message-text">Write your recommendation here</textarea>
                    </div>
                    <div class="column">
                        <div class="tags-wrap">
                            <div class="tags-box">
                                <div class="tags-ttl-holder rating-wrap-ttl">
                                    <strong class="tags-ttl">Set a rating </strong>
                                    <input class="rating" value="3" data-step=1 data-size="lg" data-symbol="&#xe018;" data-glyphicon="false" data-rating-class="rating-gloobers" >
                                </div>
                            </div>
                            <div class="tags-box">
                                <div class="tags-ttl-holder">
                                    <strong class="tags-ttl">Recomends this activity for</strong>
                                    <i class="ttl-extra-info">Tap to select</i>
                                </div>
                                <div class="tags-list">
                                    <a href="#" class="tag btn btn-sm"><i class="gl-ico gl-ico-airplane"></i>Trip 1</a>
                                    <a href="#" class="tag btn btn-sm"><i class="gl-ico gl-ico-airplane"></i>Trip type 1</a>
                                    <a href="#" class="tag btn btn-sm"><i class="gl-ico gl-ico-airplane"></i>Trip type 1</a>
                                    <a href="#" class="tag btn btn-sm"><i class="gl-ico gl-ico-airplane"></i>Trip 1</a>
                                    <a href="#" class="tag btn btn-sm"><i class="gl-ico gl-ico-airplane"></i>Trip 1</a>
                                    <a href="#" class="tag btn btn-sm"><i class="gl-ico gl-ico-airplane"></i>Trip type 1</a>
                                    <a href="#" class="tag btn btn-sm"><i class="gl-ico gl-ico-airplane"></i>Trip type 1</a>
                                    <a href="#" class="tag btn btn-sm"><i class="gl-ico gl-ico-airplane"></i>Trip 1</a>
                                </div>
                            </div>
                            <div class="tags-box">
                                <div class="tags-ttl-holder">
                                    <strong class="tags-ttl">Travelers passionate about</strong>
                                    <i class="ttl-extra-info">Tap to select</i>
                                </div>
                                <div class="tags-list">
                                    <a href="#" class="tag btn btn-sm"><i class="gl-ico gl-ico-like"></i>Passion</a>
                                    <a href="#" class="tag btn btn-sm"><i class="gl-ico gl-ico-like"></i>bla bla bla</a>
                                    <a href="#" class="tag btn btn-sm"><i class="gl-ico gl-ico-like"></i>bla bla bla</a>
                                    <a href="#" class="tag btn btn-sm"><i class="gl-ico gl-ico-like"></i>Passion</a>
                                    <a href="#" class="tag btn btn-sm"><i class="gl-ico gl-ico-like"></i>Passion</a>
                                    <a href="#" class="tag btn btn-sm"><i class="gl-ico gl-ico-like"></i>bla bla</a>
                                    <a href="#" class="tag btn btn-sm"><i class="gl-ico gl-ico-like"></i>Passion</a>
                                    <a href="#" class="tag btn btn-sm"><i class="gl-ico gl-ico-like"></i>Passion</a>
                                    <a href="#" class="tag btn btn-sm"><i class="gl-ico gl-ico-like"></i>bla bla</a>
                                    <a href="#" class="tag btn btn-sm"><i class="gl-ico gl-ico-like"></i>Passion</a>
                                    <a href="#" class="tag btn btn-sm"><i class="gl-ico gl-ico-like"></i>Passion</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="btns-row text-right">
                    <a href="#" class="btn btn-link">Cancel</a>
                    <a href="#" class="btn btn-default">SAVE</a>
                </div>
            </div>
        </div>
    </div>
</div>






<!-- end modal window recommendation -->

<?php
drupal_add_js('https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', 'external');
drupal_add_js('https://use.fontawesome.com/36fe5b07c5.js', 'external');

drupal_add_js('sites/all/themes/new_design/js/jquery.paging.min.js', 'file');
drupal_add_js('sites/all/themes/new_design/js/custom-file-input.js', 'file');
drupal_add_js('sites/all/themes/new_design/js/moment.js', 'file');
drupal_add_js('sites/all/themes/new_design/js/daterangepicker.js', 'file');
drupal_add_js('sites/all/themes/new_design/js/bootstrap.min.js', 'file');
drupal_add_js('sites/all/themes/new_design/js/slick.min.js', 'file');
drupal_add_js('sites/all/themes/new_design/js/popover-extra-placements.min.js', 'file');
drupal_add_js('sites/all/themes/new_design/js/bootstrap-slider.min.js', 'file');

drupal_add_js('https://d3js.org/d3.v4.min.js', 'external');
drupal_add_js('https://d3js.org/d3-selection-multi.v1.min.js', 'external');
drupal_add_js('https://d3js.org/d3-ease.v1.min.js', 'external');
drupal_add_js('sites/all/themes/new_design/js/modernizr.js', 'file');
drupal_add_js('sites/all/themes/new_design/js/tether.min.js', 'file');
drupal_add_js('sites/all/themes/new_design/js/drop.min.js', 'file');
drupal_add_js('sites/all/themes/new_design/js/star-rating.min.js', 'file');
drupal_add_js('sites/all/themes/new_design/js/map.js', 'file');
drupal_add_js('sites/all/themes/new_design/js/scroll-menu.js', 'file');
drupal_add_js('sites/all/themes/new_design/js/main.js', 'file');
//drupal_add_js('sites/all/themes/new_design/js/search-advisor.js', 'file');

?>
<script>
    $(document).ready(function () {
        (function() {

            if ( $("#tether-elm").length && $("#tether-target").length ) {
                new Tether({
                    element: '#tether-elm',
                    target: '#tether-target',
                    attachment: 'bottom center',
                    targetAttachment: 'top center',
                    constraints: [{
                        to: 'window',
                        pin: ['top']
                    }]
                });
            }

            if ( $("#profile-tether-elm").length && $("#profile-tether-target").length ) {
                new Tether({
                    element: '#profile-tether-elm',
                    target: '#profile-tether-target',
                    attachment: 'top center',
                    targetAttachment: 'top center',
                    constraints: [
                        {
                            to: 'window',
                            pin: ['top']
                        }
                    ]
                });
            }

        }).call(this);
//
//        var locations = [
//            {
//                'advisor_latitude': 49.768525,
//                "advisor_longitude": -70.075736,
//                "type_of_trip": 1
//            },
//            {
//                "advisor_latitude": 50.768525,
//                "advisor_longitude": -74.075736,
//                "type_of_trip": 2
//            },
//            {
//                "advisor_latitude": 51.768525,
//                "advisor_longitude": -76.075736,
//                "type_of_trip": 3
//            }
//        ];
        var locations = <?= json_encode($profileInfo['passport']); ?>;
        console.log(locations);
        var map;

        var markers = [],
            infoWindows = [];

        map = initMap();
        initMarkers(locations, getDefaultMarker);

        function initMarkers(objects, markerTemplate) {
            var marker;
//                infowindow;
            $('body').append('<div class="calcMarkerWidthElm"></div>');
            objects.forEach(function (element) {
//                console.log(element);
//                infowindow = new google.maps.InfoWindow({
//                    content: "holding ..."
//                });
//
//                infoWindows.push(infowindow);
                marker = markerTemplate(element);
                console.log(marker);
                markers.push(marker);
            });
        }

        map.setOptions({
            draggable: false,
            zoomControl: false,
            scrollwheel: false,
            disableDoubleClickZoom: true
        });
        function getDefaultMarker(element) {

            var markerIcon = {
                url: "<?= $GLOBALS['base_url'] . '/' . drupal_get_path('theme', 'new_design') . '/images/marker.svg' ?>",
                scaledSize: new google.maps.Size(30, 40),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(15, 40)
            };

            var position = {
                lat: parseFloat(element.latitude),
                lng: parseFloat(element.longitude)
            };

            var icon,
                type = parseInt(element.passport_trip_type_id);


            /*
             **** types of trip: ****

             #1: I live there
             #2: I've been living there
             #3: I've been there in a business trip
             #4: I've been there in a romantic trip
             #5: I've been there with a group
             #6: I've been there alone
             #7: I've been there with the friend
             #8: I've been in a family trip

             */

            switch (type) {
                case 1:
                    icon = '<i class="gl-ico gl-ico-home-user"></i>';
                    break;
                case 2:
                    icon = '<i class="gl-ico gl-ico-home"></i>';
                    break;
                case 3:
                    icon = '<i class="gl-ico gl-ico-briefcase"></i>';
                    break;
                case 4:
                    icon = '<i class="gl-ico gl-ico-heart"></i>';
                    break;
                case 5:
                    icon = '<i class="gl-ico gl-ico-users-group"></i>';
                    break;
                case 6:
                    icon = '<i class="gl-ico gl-ico-school-book-bag"></i>';
                    break;
                case 7:
                    icon = '<i class="gl-ico gl-ico-users"></i>';
                    break;
                case 8:
                    icon = '<i class="gl-ico gl-ico-family"></i>';
                    break;
                default:
                    console.log("no icon for this type")
            }

            $('.calcMarkerWidthElm').find('.custom-marker-icon').remove();

            var calcWidthElm = '<div class="custom-marker-icon">' + icon + '</div>';

            var offsetAnchorX = ( $('.calcMarkerWidthElm').append(calcWidthElm).width() ) / 2;

            var marker = new MarkerWithLabel({
                map: map,
                animation: false, //google.maps.Animation.DROP,
                position: position,
                icon: markerIcon,
                labelContent: icon,
                labelAnchor: new google.maps.Point(offsetAnchorX, 34),
                labelClass: "custom-marker-icon",
                labelInBackground: true
            });

            return marker;

        };
        fitMapBounds(markers, map);


        var zoomChangeBoundsListener =
            google.maps.event.addListenerOnce(map, 'bounds_changed', function(event) {
                var currentZoom = map.getZoom();
                if (this.getZoom() && currentZoom >= 1){
                    var newZoom = currentZoom - 1;
                    this.setZoom(newZoom);
                }
            });
    })
</script>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
<!--<script src="https://use.fontawesome.com/36fe5b07c5.js"></script>-->
<!---->
<!--<script src="js/custom-file-input.js"></script>-->
<!---->
<!--<script src="js/moment.js"></script>-->
<!--<script src="js/daterangepicker.js"></script>-->
<!--<script src="js/bootstrap.min.js"></script>-->
<!--<script src="js/slick.min.js"></script>-->
<!--<script src="js/popover-extra-placements.min.js"></script>-->
<!--<script src="js/bootstrap-slider.min.js"></script>-->
<!---->
<!--<script src="https://d3js.org/d3.v4.min.js"></script>-->
<!--<script src="https://d3js.org/d3-selection-multi.v1.min.js"></script>-->
<!--<script src="https://d3js.org/d3-ease.v1.min.js"></script>-->
<!---->
<!--<script src="js/modernizr.js"></script>-->
<!---->
<!---->
<!--<script src="js/tether.min.js"></script>-->
<!--<script src="js/drop.min.js"></script>-->
<!---->
<!--<script src="js/star-rating.min.js"></script>-->
<!---->
<!--<script src="js/scroll-menu.js"></script>-->
<!---->
<!--<script src="js/main.js"></script>-->

<!--<script src="https://maps.googleapis.com/maps/api/js?callback=initMap" async defer></script>-->

</body>
</html>
