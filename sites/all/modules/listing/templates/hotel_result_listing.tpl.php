
<script src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/js/easingv1.3.js" type="text/javascript" language="javascript"></script>
<script src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/js/jqueryui.js" type="text/javascript" language="javascript"></script>
<script src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/js/moment.js" type="text/javascript" language="javascript"></script>
<script src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/js/bootstrap-datetimepicker.js" type="text/javascript" language="javascript"></script>
<script src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/js/jquery.selectbox-0.2.js" type="text/javascript" language="javascript"></script>
<script src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/js/jquery.nicescroll.min.js" type="text/javascript" language="javascript"></script>
<script src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/js/range-slider.js" type="text/javascript" language="javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function () {
        /*Html Scroll*/
        jQuery("html").niceScroll();
        /*SelectBox*/
        jQuery("select").selectbox();
        jQuery(document).click(function (e) {
            if (!jQuery(e.target).is('.sbHolder, .sbHolder *')) {
                jQuery("select").selectbox('close');
            }
        }); //End
        jQuery("#ex2").slider();
        jQuery('#ex2').on('slideStop', function () {
            // Set a flag to indicate slide not in progress
            slideStart = false;
            jQuery("#search_filter").submit();
            // start the timeout
            refreshId = setInterval(function () { // saving the timeout
                sTimeout();
            }, intSeconds * 3000);

        });


        // Filter Toggle()
        jQuery(".filtersearch").click(function () {
            jQuery('.tabs_ul').slideToggle();
            jQuery(".filtersearch span i").toggleClass("filter-icon-active");
        });

        //Travel-Guide Listing()
        jQuery(".listicon").click(function (event) {
            event.preventDefault();
            jQuery(this).next(".travelerlistview").slideToggle(400);
        }); // End

    }); //End Document.Ready()
</script>
<script type="text/javascript">
    var dateToday = new Date();
    jQuery(function () {
        jQuery('#checkin_date').datetimepicker({
            pickTime: false,
            minDate: dateToday,
            defaultDate: dateToday,
        });
        dateToday.setDate(dateToday.getDate() + 1);
        jQuery('#checkout_date').datetimepicker({
            pickTime: false,
            minDate: dateToday,
            defaultDate: dateToday,
        });
    });

    /**
     * filter options
     */

    jQuery(document).ready(function () {
        jQuery("body").on("change", ".filter_hotel_type,#checkin_date,#checkout_date,.filter_travelers", function () {
            jQuery("#search_filter").submit();
        });


    });
</script>
<style>
    .travel-bbl-icon2 {
        background: none repeat scroll 0 0 rgba(0, 0, 0, 0.4);
        border: 1px solid #fff;
        color: #fff;
        padding: 5px 10px;
        position: absolute;
        right: 20px;
        top: 10px;
    }
</style>

<?php
global $base_url;
$seach_destination = arg(1);

$checkin_date = $_GET["checkin_date"];
$checkout_date = $_GET["checkout_date"];
$no_of_travellere = $_GET["travelers"];
$hotel_type = 0;
$show_filter = 0;
$price_range = '';
if (isset($_GET["checkin_date"]) && !empty($_GET["checkin_date"])) {
    if (isset($_GET["hotel_type"]) && !empty($_GET["hotel_type"])) {
        $hotel_type = $_GET["hotel_type"];
    }
    if (isset($_GET["price_range"]) && !empty($_GET["price_range"])) {
        $price_range = $_GET["price_range"];
    }
    if (isset($_GET["search_desti"]) && !empty($_GET["search_desti"])) {
        $result_keyword = explode(",", $_GET["search_desti"]);
        $seach_destination = trim($result_keyword[0]);
    }
    $show_filter = 1;
    $result = CheckHotelRoomAvailable($seach_destination, $checkin_date, $checkout_date, $hotel_type, $price_range);
} else {
    $result_keyword = explode(",", $seach_destination);
    $seach_destination = trim($result_keyword[0]);
    $result = getHotelsDataByLocaiton($seach_destination);
}
if (arg(1)) {
    $lat_long = timezone_convert_helper_getLatiLongByAddress(arg(1));
}

?>
<link href="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/stylesheet/style.css" rel="stylesheet" type="text/css" />
<div id="innerwraper" class="travelpage">
    <div class="innerpage">


        <section class="content-section">
            <div class="container-fluid">
                <div class="row">
                    <form action="" id="search_filter" method="get" >
                        <div class="innersearch">
                            <div class="col-md-8 col-sm-6 col-xs-12 dessearch">
                                <input type="search" name="search_desti" id="search_keyword"  value="<?= isset($_GET["search_desti"]) && !empty($_GET["search_desti"]) ? $_GET["search_desti"] : $seach_destination; ?>" id="advice_destination" class="searchinput" onclick="search_destination();"  placeholder="Destination" />
                            </div>
                            <!-- End DesSearch -->
                            <div class="col-md-2 col-sm-3 col-xs-12 travelsearch">
                                <!--<input type="text" name="travel-guide"  class="travelinput" value="Hotel" readonly="readonly" />-->
                                <select class ="advisorinput" id="hotel_list_filter" >
                                    <option value="Advisors">Advisors</option>
                                    <option value="Hotels" selected="selected">Hotels</option>
                                    <option value="Expereince">Experience</option>
                                    <option value="Gloobers" >Gloobers</option>
                                </select> 
                            </div>

                            <!-- End AdvisorSearch -->
                            <div class="col-md-2 col-sm-3 col-xs-12 filtersearch">
                                <span> Filters <i class="filter-icon"></i></span>
                            </div>
                            <!-- End AdvisorSearch -->

                            <div class="tabs_ul" style="display: <?= isset($show_filter) && $show_filter == 1 ? 'block' : 'none'; ?>">
                                <div class="container">
                                    <div class="col-md-2">
                                        <select name="hotel_type" class="filter_hotel_type select_box">
                                            <option selected="selected" disabled="disabled">Hotel Type</option>
                                            <option value=" " <?= isset($_GET["hotel_type"]) && $_GET["hotel_type"] == ' ' ? 'selected="selected"' : ''; ?>>All</option>
                                            <option value="1"<?= isset($_GET["hotel_type"]) && $_GET["hotel_type"] == 1 ? 'selected="selected"' : ''; ?>>1</option>
                                            <option value="2" <?= isset($_GET["hotel_type"]) && $_GET["hotel_type"] == 2 ? 'selected="selected"' : ''; ?>>2</option>
                                            <option value="3" <?= isset($_GET["hotel_type"]) && $_GET["hotel_type"] == 3 ? 'selected="selected"' : ''; ?>>3</option>
                                            <option value="4" <?= isset($_GET["hotel_type"]) && $_GET["hotel_type"] == 4 ? 'selected="selected"' : ''; ?>>4</option>
                                            <option value="5" <?= isset($_GET["hotel_type"]) && $_GET["hotel_type"] == 5 ? 'selected="selected"' : ''; ?>>5</option>
                                        </select>
                                    </div> <!-- End Col -->

                                    <div class="col-md-2 dropdown menu-drp-down">
                                        <h4 class="dropdown-toggle" data-toggle="dropdown">Date<i class="sbToggle"></i></h4>
                                        <ul class="dropdown-menu" role="menu">
                                            <li class="checkindate">
                                                <h4>Check in date</h4>
                                                <input type="text" id="checkin_date" value="<?= $checkin_date; ?>" data-date-format="YYYY/MM/DD" name="checkin_date" placeholder="checkin_date" readonly="readonly" />
                                            </li>
                                            <li class="checkoutdate">
                                                <h4>Check out date</h4>
                                                <input type="text" id="checkout_date" value="<?= $checkout_date; ?>" data-date-format="YYYY/MM/DD" name="checkout_date" placeholder="checkout_date" readonly="readonly" />
                                            </li>
                                        </ul>

                                    </div> <!-- End Col -->

                                    <div class="col-md-2">
                                        <select name="travelers" class="filter_travelers select_box">
                                            <option selected="selected" disabled="disabled">Travelers</option>
                                            <option value="1" <?= isset($_GET["travelers"]) && $_GET["travelers"] == 1 ? 'selected="selected"' : ''; ?>>1</option>
                                            <option value="2" <?= isset($_GET["travelers"]) && $_GET["travelers"] == 2 ? 'selected="selected"' : ''; ?>>2</option>
                                            <option value="3" <?= isset($_GET["travelers"]) && $_GET["travelers"] == 3 ? 'selected="selected"' : ''; ?>>3</option>
                                            <option value="4" <?= isset($_GET["travelers"]) && $_GET["travelers"] == 4 ? 'selected="selected"' : ''; ?>>4</option>
                                            <option value="5" <?= isset($_GET["travelers"]) && $_GET["travelers"] == 5 ? 'selected="selected"' : ''; ?>>5</option>
                                        </select>
                                    </div> <!-- End Col -->

                                    <div class="col-md-2">
                                        <select name="" class="select_box">
                                            <option>Ranking</option>
                                        </select>
                                    </div> <!-- End Col -->

                                    <div class="col-md-2 dropdown menu-drp-down">
                                        <h4>Special</h4>
                                    </div> <!-- End Col -->

                                    <div class="col-md-2 dropdown menu-drp-down">
                                        <h4 class="dropdown-toggle" data-toggle="dropdown">Price Range<i class="sbToggle"></i></h4>
                                        <ul class="dropdown-menu">
                                            <li class="checkindate">
                                                <input id="ex2" type="text" name="price_range" class="span2" value="<?= isset($_GET["price_range"]) && !empty($_GET["price_range"]) ? $_GET["price_range"] : '20,500'; ?>" data-slider-min="10" data-slider-max="1000" data-slider-step="5" data-slider-value="[<?= isset($_GET["price_range"]) && !empty($_GET["price_range"]) ? $_GET["price_range"] : '20,500'; ?>]" />
                                                <b class="pull-left">$ 10</b> <b class="pull-right">$1000</b>
                                            </li>

                                        </ul>
                                    </div> <!-- End Col -->
                                </div> <!-- End Container -->
                            </div> <!-- End Tab_UL -->
                        </div> <!-- End InnerSearch -->
                    </form>
                </div> <!-- End Row -->
            </div> <!-- End Container-Fluid -->
        </section> <!-- End Content-Section -->

        <section class="hotels-map">

            <!--<script src="http://maps.google.com/maps/api/js?sensor=false"></script>-->
            <div id="map" style="width: 100%; height: 400px;"></div>
            <?php
            $pointer_data = array();
            if(count($result)>0){
            foreach ($result as $key => $value) {
                $extra = array();
                $extra[] = '<h4>' . $value["hotel_name"] . '<br/>' . $value["hotel_city"] . ',' . $value["hotel_state"] . '<br/>' . $value["hotel_country"] . '</h4>';
                $extra[] = $value["hotel_latitude"];
                $extra[] = $value["hotel_longitude"];

                $pointer_data[] = $extra;
            }}
            else{
                $extra = array();
                $extra[] = arg(1);
                $extra[] = $lat_long["lati"];
                $extra[] = $lat_long["long"];
                
                $pointer_data[] = $extra;
                
            }
            ?>
            <script>

                var locations = <?= json_encode($pointer_data); ?>;
                // Setup the different icons and shadows
                var iconURLPrefix = 'http://maps.google.com/mapfiles/ms/icons/';

                var icons = [
                    iconURLPrefix + 'red-dot.png',
                    iconURLPrefix + 'green-dot.png',
                    iconURLPrefix + 'blue-dot.png',
                    iconURLPrefix + 'orange-dot.png',
                    iconURLPrefix + 'purple-dot.png',
                    iconURLPrefix + 'pink-dot.png',
                    iconURLPrefix + 'yellow-dot.png'
                ]
                var iconsLength = icons.length;

                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 10,
                    center: new google.maps.LatLng(51.5073509, -0.1277583),
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    mapTypeControl: false,
                    streetViewControl: false,
                    panControl: false,
                    zoomControlOptions: {
                        position: google.maps.ControlPosition.LEFT_BOTTOM
                    }
                });

                var infowindow = new google.maps.InfoWindow({
                    maxWidth: 160
                });

                var markers = new Array();

                var iconCounter = 0;

                // Add the markers and infowindows to the map
                for (var i = 0; i < locations.length; i++) {
                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                        map: map,
                        icon: icons[iconCounter]
                    });

                    markers.push(marker);

                    google.maps.event.addListener(marker, 'click', (function (marker, i) {
                        return function () {
                            infowindow.setContent(locations[i][0]);
                            infowindow.open(map, marker);
                        }
                    })(marker, i));

                    iconCounter++;
                    // We only have a limited number of possible icon colors, so we may have to restart the counter
                    if (iconCounter >= iconsLength) {
                        iconCounter = 0;
                    }
                }

                function autoCenter() {
                    //  Create a new viewpoint bound
                    var bounds = new google.maps.LatLngBounds();
                    //  Go through each...
                    for (var i = 0; i < markers.length; i++) {
                        bounds.extend(markers[i].position);
                    }
                    //  Fit these bounds to the map
                    map.fitBounds(bounds);
                }
                autoCenter();



            </script> 
            <!--            <div class="mapframe" id="map">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d94214.18946019579!2d-92.3630410397186!3d42.44490055268727!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x87e551f0dd63dc31%3A0x9797f41431602601!2sLost+Island+Waterpark!5e0!3m2!1sen!2sin!4v1423825841993" width="100%" height="427" frameborder="0" style="border:0"></iframe>
                        </div>-->
            <!-- End MapFrame -->
        </section>
        <!-- End HotelsMap -->
        <section class="travel_listing_tab">
            <div class="container">

                <?php
                if (count($result) > 0) {
                    foreach ($result as $key => $value) {
                        $img_data = json_decode($value["hotel_images"]);
                        ?>

                        <div class="col-md-4 col-sm-4 col-xs-12 travelcol">
                            <div class="travellist">
                                <a href="<?= $base_url; ?>/Hotels/<?= $value["hotel_id"] ?>">   <img src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', 'hotel_theme'); ?>/hotel_img/listing_page/<?= $img_data[0] ?>" alt="" title="" />
                                </a>
                                <div class="travellistdetail">
                                    <div class="listicon"><i class="fa fa-align-justify"></i></div>
                                    <div class="travelerlistview">
                                        <ul>
                                            <li><a href="#"><i class="fa fa-link"></i>Recommend to a friend</a></li>
                                            <li><a href="#"><i class="fa fa-heart"></i>Add to wishlist</a></li>
                                            <li><a href="#"><i class="fa fa-plus"></i>Add to guide</a></li>
                                            <li><a href="<?= $base_url; ?>/Hotels/<?= $value["hotel_id"] ?>"><i class="fa fa-eye"></i>View details</a></li>
                                            <li><a href="#"><i class="fa fa-flag-o"></i>Report this listing</a></li>
                                            <li><a href="#"><i class="fa fa-arrows-h"></i>Embed on my website</a></li>
                                        </ul>
                                    </div>
                                    <!-- End ListView -->
                                </div>
                                <div class="travel-bbl-icon2" >
                                    <b>$ <?= $value["lowest_price"] ?></b>
                                    <small>Per Night</small>
                                </div>


                                <!-- End ListDetail -->

                                <!-- Detail -->
                                <div class="travel-bottom-detail">
                                    <div class="travel-bottom-detail-left">
                                        <h5><?= $value["hotel_name"] ?></h5>
                                        <span class="pull-left">
                                            <?= $value["hotel_city"] ?>, <?= $value["hotel_state"] ?> &nbsp;
                                        </span>
                                        <span class="pull-right">
                                            <?= $value["hotel_country"] ?>
                                        </span>
                                    </div>

                                    <div class="travel-bbl-icon">
                                        <b>7</b>
                                        <small>reviews</small>
                                    </div>
                                </div>

                            </div>
                            <!-- End TravelList -->
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <div class="col-md-12 text-center"><div class="pagination pagination-lg">
                            <h2>Please Modify Your Search</h2>
                            <h3>No Hotel Found !!! </h3>
                        </div>
                    </div>
                <?php } ?>

                <?php
                print'<div class="col-md-12 text-center"><div class="pagination pagination-lg">';
                echo $pagination;
                print '</div></div>';
                ?>
                <!-- End Text_center -->
            </div>
            <!-- End Container -->
        </section>
        <!-- End TravelListingTab -->




    </div>
    <!-- End InnerPage -->
</div>
<script src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/js/advisor.js" type="text/javascript" language="javascript"></script>
<script>
                function search_destination() {

                    var home_autocomplete = new google.maps.places.Autocomplete(
                            /** @type {HTMLInputElement} */
                                    (document.getElementById('advice_destination')),
                                    {types: ['geocode']});
                    google.maps.event.addListener(home_autocomplete, 'place_changed', function () {
                        jQuery("#search_filter").submit();
                    });
                }
</script>
<script type="text/javascript">
    jQuery(document).ready(function (e) {
        jQuery('.dropdown-menu input').click(function (e) {
            e.stopPropagation();
        });
        /**
         * filter redirection
         */
        jQuery("body").on("change", "#hotel_list_filter", function () {
            var me = jQuery(this);
            var value = me.val();
            var keyword = jQuery("#search_keyword").val();
            if (value == 'Advisors') {
                window.location.href = '<?= $base_url; ?>/search-listing/advisors/' + keyword;
            }
            else if (value == 'Expereince') {
                window.location.href = '<?= $base_url; ?>/search-destination/' + keyword;
            }
            else if (value == 'Gloobers') {
                window.location.href = '<?= $base_url; ?>/Gloobers/' + keyword;
            }
        });

    });


</script>
