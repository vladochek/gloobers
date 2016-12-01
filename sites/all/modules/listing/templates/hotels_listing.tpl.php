<?php
ob_start();
GLOBAL $user,$base_url;
if (!$user->uid) {
    drupal_goto('login');
}
drupal_add_css(drupal_get_path('theme', 'gloobers_new') . '/stylesheet/for-head-foot.css', 'file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') . '/css/landing_page.css', 'file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') . '/css/landing_custom.css', 'file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') . '/stylesheet/bootstrap.min.css', 'file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') . '/stylesheet/bootstrap-datetimepicker.min.css', 'file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') . '/fonts/stylesheet.css', 'file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') . '/stylesheet/style.css', 'file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') . '/stylesheet/font-awesome.css', 'file');
$hotel_id = arg(1);
if (!isset($hotel_id) || empty($hotel_id)) {
    drupal_goto();
}
if (isset($_SESSION)) {
    unset($_SESSION["hotel_room_cart"]);
}
/**
 * get hotel details and room details and rules and policies
 * 
 */
$hotel_data_result = gethotel_detail($hotel_id);
$hotel_room_data = getRoomDetailByHotelId($hotel_id);
$hotel_rules_result = getRulesPoliciesofHotel($hotel_id);
$hotel_data = $hotel_data_result[0];
$hotel_rules_data = $hotel_rules_result[0];
/**
 * get hotel and room data by checkin checkout date and hotel id
 */
$check_in_get = isset($_GET["checkin_date"]) ? $_GET["checkin_date"] : date("Y-m-d");
$check_out_get = isset($_GET["checkout_date"]) ? $_GET["checkout_date"] : date("Y-m-d", strtotime($check_in_get . '+1 day'));
$traveler_get = isset($_GET["travelers"]) ? $_GET["travelers"] : 1;
$checkin_date = $check_in_get;
$checkout_date = $check_out_get;
$no_of_travellere = $traveler_get;
$query = "select * from gbl_hotel_rooms  where hotel_id=$hotel_id";
$query = db_query($query);
$room_data = $query->fetchAll(PDO::FETCH_ASSOC);
$room_data_array = array();
/**
 * get available rooms
 */
foreach ($room_data as $keys => $values) {
    $query = "select *,sum(no_of_rooms)as total_room_booked from gbl_room_booking_details  where  hotel_id=" . $hotel_id . " and  room_id =" . $values["room_id"];
    $query.=" and  start_date <='$checkin_date' and end_date > '$checkin_date'";
    $query = db_query($query);
    $booking_data = $query->fetchAll(PDO::FETCH_ASSOC);
    $avail_room = 0;
    if ($values["room_quantity"] > $booking_data[0]["total_room_booked"]) {
        $avail_room = $values["room_quantity"] - $booking_data[0]["total_room_booked"];
    }

    $room_data[$keys]["avail_room"] = $avail_room;
}
$hotel_room_data = $room_data;
?>


<div id="innerwraper" class="hotelpage">
    <div class="innerpage">
        <section class="content-section hotelpagedetail">
            <div class="container-fluid">
                <div class="row">
                    <div class="hotelslide">
                        <div role="tabpanel">
                            <ul role="tablist" class="nav nav-tabs hotelpagetab">
                                <li class="active">
                                    <a aria-expanded="true" aria-controls="photos" data-toggle="tab" role="tab" id="photos-tab" href="#photos">Photos</a>
                                </li>
                                <li>
                                    <a aria-expanded="false" aria-controls="Map" data-toggle="tab" role="tab" id="Map-tab" href="#map">Map</a>
                                </li>
                            </ul>
                        </div> <!-- End Tabs -->

                        <div class="tab-content">
                            <div aria-labelledby="photos-tab" id="photos" class="tab-pane fade active in" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="hotelslider" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner" role="listbox">
                                                <?php
                                                if (isset($hotel_data["hotel_images"])) {
                                                    foreach (json_decode($hotel_data["hotel_images"]) as $key => $val) {
                                                        ?>
                                                        <div class="item <?= $key == 0 ? 'active' : '' ?>"><img src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', "hotel_theme"); ?>/hotel_img/main/<?= $val; ?>" alt="" title="" /></div>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <div class="item"><img src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', "hotel_theme"); ?>/hotel_img/hotel_slide.jpg" alt="" title="" /></div>
                                                <?php } ?>
                                            </div> <!-- End Carousel Inner -->
                                            <a class="left carousel-control" href="#hotelslider" data-slide="prev" onclick="jQuery('#hotelslider').carousel('prev')"></a>
                                            <a class="right carousel-control" href="#hotelslider" data-slide="next" onclick="jQuery('#hotelslider').carousel('next')"></a>
                                        </div> <!-- End Carousel Slide -->
                                    </div> <!-- End Carousel Column -->
                                </div> <!-- End Carousel Row -->
                            </div> <!-- End Photo TabPane -->

                            <div aria-labelledby="map-tab" id="map" class="tab-pane fade" role="tabpanel">
                                <div class="mapframe">
                                    <iframe src="https://maps.google.com/maps?q=<?= (float) $hotel_data["hotel_latitude"]; ?>,<?= (float) $hotel_data["hotel_longitude"]; ?>'&hl=es;z=4&amp;output=embed" height="427" frameborder="0" style="border:0"></iframe>
                                </div> <!-- End MapFrame -->
                            </div> <!-- End Map TabPane-->    
                        </div> <!-- End Tab-Content -->
                    </div> <!-- End HotelSlide -->

                    <div class="hotelfilter">
                        <div class="container">
                            <div class="col-md-5 hotelname">
                                <h3><?= $hotel_data["hotel_name"] ?></h3>
                                <p><?= isset($hotel_data['hotel_city']) ? $hotel_data['hotel_city'] : ''; ?>,
                                    <?= isset($hotel_data['hotel_state']) ? $hotel_data['hotel_state'] : ''; ?>,
                                    <?= isset($hotel_data['hotel_country']) ? $hotel_data['hotel_country'] : ''; ?>
                                    <span class="hotelstar">
                                        <?php
                                        $empty_star = 5 - $hotel_data["hotel_rating"];
                                        for ($i = $hotel_data["hotel_rating"]; $i > 0; $i--) {
                                            ?>

                                            <i class="glyphicon glyphicon-star"></i> 
                                            <?php
                                        }
                                        for ($i = $empty_star; $i > 0; $i--) {
                                            ?>

                                            <i class="glyphicon glyphicon-star emptystar"></i> 
                                            <?php
                                        }
                                        ?>
                                    </span>
                                </p>
                            </div> <!-- End Name -->
                            <form action="" method="get">
                                <div class="col-md-2 col-sm-6 col-xs-6 bookingdetail checkindate">
                                    <p>Check In</p>
                                    <input type="text" id="checkin_date" value="<?= $check_in_get; ?>" data-date-format="YYYY/MM/DD" name="checkin_date" placeholder="checkin_date" readonly="readonly" />
                                    <i class="dropdownarrow"></i>
                                </div> <!-- End CheckinDate -->

                                <div class="col-md-2 col-sm-6 col-xs-6 bookingdetail checkoutdate">
                                    <p>Check Out</p>
                                    <input type="text" id="checkout_date" value="<?= $check_out_get; ?>" data-date-format="YYYY/MM/DD" name="checkout_date" placeholder="checkout_date" readonly="readonly" />
                                    <i class="dropdownarrow"></i>
                                </div> <!-- End CheckoutDate -->

                                <div class="col-md-1 col-sm-12 col-xs-12 bookingdetail travelers">
                                    <p>Travelers</p>
                                    <select name="travelers">
                                        <option value="1" <?= $traveler_get == 1 ? 'selected' : ''; ?>>1</option>
                                        <option value="2" <?= $traveler_get == 2 ? 'selected' : ''; ?>>2</option>
                                        <option value="3" <?= $traveler_get == 3 ? 'selected' : ''; ?>>3</option>
                                        <option value="4" <?= $traveler_get == 4 ? 'selected' : ''; ?>>4</option>
                                        <option value="5" <?= $traveler_get == 5 ? 'selected' : ''; ?>>5</option>
                                        <option value="6" <?= $traveler_get == 6 ? 'selected' : ''; ?>>6</option>
                                        <option value="7" <?= $traveler_get == 7 ? 'selected' : ''; ?>>7</option>
                                        <option value="8" <?= $traveler_get == 8 ? 'selected' : ''; ?>>8</option>
                                        <option value="9" <?= $traveler_get == 9 ? 'selected' : ''; ?>>9</option>
                                    </select>
                                    <i class="dropdownarrow"></i>
                                </div> <!-- End Travelers -->

                                <div class="col-md-1 col-sm-6 col-xs-6 bookingdetail ">
                                    <input type="submit" class="srch-icon" value="" id="search_btn"/>
                                </div> <!-- End TotalAmount -->
                            </form>
                            <div class="col-md-1 col-sm-6 col-xs-6 bookingdetail totalamount">
                                <p>Total ($)</p>
                                <h4 id="total_booked_price">0.00</h4>
                            </div> <!-- End TotalAmount -->
                        </div> <!-- End Container -->
                    </div> <!-- End HotelFilter -->


                    <div class="wrapsection">
                        <div class="bookingblock">
                            <a href="<?= $base_url; ?>/booking/hotel/summary" class="main_booknow_btn" style="display:none;">Book now</a>
                            <a href="javascript:void(0);">Recommended</a>
                        </div> <!-- End BookingBlock -->


                        <div class="container">
                            <div class="col-md-12">
                                <div class="hoteloverview">
                                    <div class="blockheading"><h2>Overview</h2></div> <!-- End BlockHeading -->

                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <h3>Category</h3>
                                        <h4 class="colorblue"><?= $hotel_data["hotel_type"]; ?></h4>
                                    </div> <!-- End Col -->

                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <h3>Min Stay</h3>
                                        <h4>3 nights</h4>
                                    </div> <!-- End Col -->

                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <h3>Reviews</h3>
                                        <span class="hotelstar">
                                            <i class="glyphicon glyphicon-star"></i> 
                                            <i class="glyphicon glyphicon-star"></i> 
                                            <i class="glyphicon glyphicon-star"></i> 
                                            <i class="glyphicon glyphicon-star"></i> 
                                            <i class="glyphicon glyphicon-star emptystar"></i> 
                                        </span>
                                    </div> <!-- End Col -->
                                </div> <!-- End HotelOverview -->
                            </div> <!-- End Col -->

                            <div class="col-md-12 col-sm-12 col-xs-12 canvascircle">
                                <div class="circles">
                                    <div class="first circle"><canvas></canvas><strong>98%</strong><p>Foodies</p></div>
                                    <div class="second circle"><canvas></canvas><strong>73%</strong><p>Budget Travelers</p></div>
                                    <div class="third circle"><canvas></canvas><strong>73%</strong> <p>Trendsters</p></div>
                                    <div class="forth circle"><canvas></canvas><strong>67%</strong><p>Students</p></div>
                                </div> <!-- End Circles -->
                            </div> <!-- End CanvasCircle -->
                        </div> <!-- End Container -->

                        <div class="container">
                            <div class="hoteldestext">
                                <div class="blockheading"> <h2>Description</h2> </div> <!-- End BlockHeading -->
                                <div class="col-md-12 paratext">
                                    <p><?= $hotel_data["hotel_description"] ?></p>
                                </div> <!-- End paraText -->

                                <div class="text-center">
                                    <button data-toggle="collapse" data-target="#viewdetails" class="morebtn moreme">Read More</button>
                                    <!--<button data-toggle="collapse" data-target="#viewdetails" class="morebtn lessme">Read Less</button>-->
                                </div>

                                <div id="viewdetails" class="collapse moredetail">
                                    <div class="blockheading"><h2>Hotel's Amenities</h2></div> <!-- End Block Heading -->
                                    <ul>
                                        <?php
                                        if (isset($hotel_data["hotel_amenities"])) {
                                            foreach (json_decode($hotel_data["hotel_amenities"]) as $key => $val) {
                                                $data = getHotelAmenitiesById($val);
                                                ?>
                                                <li class="col-md-4 col-sm-6 col-xs-12"><?= $data["hotel_amenties_name"] ?></li>
                                                <?php
                                            }
                                        }
                                        ?>

                                    </ul>
                                </div> <!-- End ViewDetails -->
                            </div> <!-- End HotelDesText -->
                        </div> <!-- End Container -->

                        <?php
                        if (!empty($hotel_room_data)) {
                            foreach ($hotel_room_data as $key1 => $val1) {
                                ?>
                                <div class="roomdeatilsection">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <div id="hotelroomslider_<?= $key1 ?>" class="carousel slide" data-ride="carousel">
                                                    <div class="carousel-inner">
                                                        <?php
                                                        if (isset($val1["room_images"])) {
                                                            foreach (json_decode($val1["room_images"]) as $key => $val) {
                                                                ?>
                                                                <div class="item <?= $key == 0 ? 'active' : ''; ?>"><img src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', "hotel_theme"); ?>/rooms_img/main/<?= $val; ?>" alt="" title="" /></div>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <div class="item"><img src="images/advisor_slide.jpg" alt="" title="" /></div>
                                                        <?php } ?>
                                                    </div> <!-- End Carousel Inner -->
                                                    <a class="left carousel-control" href="#hotelroomslider_<?= $key1; ?>" data-slide="prev" onclick="jQuery('#hotelroomslider_<?= $key1; ?>').carousel('prev')"></a>
                                                    <a class="right carousel-control" href="#hotelroomslider_<?= $key1; ?>" data-slide="next" onclick="jQuery('#hotelroomslider_<?= $key1; ?>').carousel('next')"></a>
                                                </div> <!-- End Carousel Slide -->
                                            </div> <!-- End Carousel Column -->

                                            <div class="col-md-6 col-sm-12 col-xs-12 roomdetailblock">
                                                <div class="col-md-12"><div class="blockheading"><h2><?= $val1["room_name"]; ?></h2></div> </div> <!-- End col -->
                                                <fieldset>
                                                    <div class="col-md-4 col-sm-4 col-xs-12"><h4>Bed type</h4><p><?= $val1['room_additional_bed_type']; ?></p></div> <!-- End Col -->
                                                    <div class="col-md-4 col-sm-4 col-xs-12"><h4>Max pers.</h4><p><?= $val1['room_max_occupancy']; ?> Adults</p></div> <!-- End Col -->
                                                    <div class="col-md-4 col-sm-4 col-xs-12"><h4>Board</h4><p><select name="board" class="board_type"><option value="1">1</option><option value="2">2</option></select></p></div> <!-- End Col -->
                                                </fieldset>
                                                <fieldset>
                                                    <div class="col-md-3 col-sm-3 col-xs-12"><h4>No. Rooms</h4><p><select name="numrooms"  class="select_room">
                                                                <option value=" ">Select Rooms</option>
                                                                <?php
                                                                $avail_room = $val1["avail_room"];
                                                                for ($k = 1; $k <= $avail_room; $k++) {
                                                                    ?> 
                                                                    <option value="<?= $k ?>"><?= $k ?></option>
                                                                <?php } ?>                                                               
                                                            </select></p></div> <!-- End Col -->
                                                    <div class="col-md-4 col-sm-4 col-xs-12"><h4>Price per night</h4><p><strong>$<?= $val1["room_night_rate"]; ?></strong></p></div> <!-- End Col -->
                                                    <div class="col-md-5 col-sm-5 col-xs-12"><a href="javascript:void(0);" data-val="<?= $val1["room_id"] ?>" class="book_now_room actionbtn">Add</a></div> <!-- End Col -->
                                                </fieldset>
                                            </div> <!-- End RoomDetailBllock -->

                                            <div class="col-md-12 roomamenties">
                                                <div class="text-center">
                                                    <button data-toggle="collapse" data-target="#roomdetails_<?= $key1; ?>" class="morebtn moreme">Read More</button>
                                                    <button data-toggle="collapse" data-target="#roomdetails_<?= $key1; ?>" class="morebtn lessme">Read Less</button>
                                                </div>

                                                <div id="roomdetails_<?= $key1; ?>" class="collapse moredetail">
                                                    <div class="blockheading"><h2>Room's amenities</h2></div> <!-- End Block Heading -->
                                                    <ul>
                                                        <?php
                                                        $data_amen = json_decode($val1["room_amenities"]);
                                                        if (isset($data_amen) && !empty($data_amen)) {
                                                            foreach (json_decode($val1["room_amenities"]) as $key2 => $val2) {
                                                                $data = getHotelRoomAmenitiesDetailsById($val2);
                                                                ?>
                                                                <li class="col-md-4 col-sm-6 col-xs-12"><?= $data["hotel_amenties_name"]; ?></li>
                                                                <?php
                                                            }
                                                        } else {
                                                            echo "No Data Found!!!";
                                                        }
                                                        ?>
                                                    </ul>
                                                </div> <!-- End ViewDetails -->
                                            </div> <!-- End RoomAmenties-->
                                        </div> <!-- End Row -->
                                    </div> <!-- End Container-->
                                </div> <!-- End RoomDetailSection -->


                                <?php
                            }
                        }
                        ?>

                        <div class="cancellationsection">
                            <div class="container">
                                <div class="blockheading"><h2>Cancellation policies</h2></div> <!-- End BlockHeading -->
                                <div class="col-md-12 paratext">
                                    <h3><?= $hotel_rules_data["cancellation_policy"]; ?></h3>
                                    <ul>
                                        <li>$<?= $hotel_rules_data["early_cancellation_more_price"] ?> Is cancellation is made more than <?= $hotel_room_data["early_cancellation_more_time"] ?></li>
                                        <li>$<?= $hotel_rules_data["early_traveler_reimbrused_price"] ?> Travelers will be reimbursed of  <?= $hotel_room_data["early_traveler_reimbrused_in"] ?></li>
                                        <li>$<?= $hotel_rules_data["late_cancellation_more_price"] ?> Is cancellation is made more than  <?= $hotel_room_data["late_cancellation_more_time"] ?></li>
                                        <li>$<?= $hotel_rules_data["late_traveler_reimbrused_price"] ?> Travelers will be reimbursed of  <?= $hotel_room_data["late_traveler_reimbrused_in"] ?></li>
                                        <li>$<?= $hotel_rules_data["travller_not_show_price"] ?> Is traveler doesn't show <?= $hotel_room_data["travller_not_show_in"] ?></li>
                                        <li>$<?= $hotel_rules_data["after_start_reservation_amount"] ?>  after the start of the reservation  <?= $hotel_room_data["after_start_reservation_in"] ?></li>

                                    </ul>
                                </div> <!-- End  ParaText -->

                                <div class="col-md-12 cancellation_detail_marker">
                                    <div class="text-center">
                                        <button data-toggle="collapse" data-target="#canceldetails" class="morebtn moreme">Read More</button>
                                        <button data-toggle="collapse" data-target="#canceldetails" class="morebtn lessme">Read Less</button>
                                    </div>

                                    <div id="canceldetails" class="collapse">
                                        <div class="progress">
                                            <div class="value"><i class="fa fa-map-marker"></i> 100%</div>
                                            <div class="progress-bar progress-bar-success" role="progressbar"></div>
                                            <div class="status-bar"><p>Booking Date</p></div>
                                        </div> <!-- End Progress -->

                                        <div class="progress">
                                            <div class="value"><i class="fa fa-map-marker"></i> 50%</div>
                                            <div class="progress-bar progress-bar-warning" role="progressbar"></div>
                                            <div class="status-bar"><p>15 Days to Service</p></div>
                                        </div> <!-- End Progress -->

                                        <div class="progress">
                                            <div class="value"><i class="fa fa-map-marker"></i> 0%</div>
                                            <div class="progress-bar progress-bar-danger" role="progressbar"></div>
                                            <div class="status-bar"><p>7 Days to Service</p></div>
                                        </div> <!-- End Progress -->

                                        <div class="progress lastbar">
                                            <div class="value"><i class="fa fa-map-marker"></i></div>
                                            <div class="progress-bar"></div>
                                            <div class="status-bar"><p>Service Date</p></div>
                                        </div> <!-- End Progress -->
                                    </div> <!-- End canceldetails -->
                                </div> <!-- End CancellationDeatilMarker -->
                            </div> <!-- End Container -->
                        </div> <!-- End CancellationSection -->

                        <div class="ratingsection">
                            <div class="container">
                                <div class="blockheading"><h2>Rating</h2></div> <!-- End BlockHeading -->
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="col-md-6"><p>Overall experience</p></div>
                                    <div class="col-md-6">
                                        <span class="hotelstar">
                                            <i class="glyphicon glyphicon-star"></i> 
                                            <i class="glyphicon glyphicon-star"></i> 
                                            <i class="glyphicon glyphicon-star"></i> 
                                            <i class="glyphicon glyphicon-star"></i> 
                                            <i class="glyphicon glyphicon-star emptystar"></i> 
                                        </span>
                                    </div>
                                </div> <!-- End Column -->

                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="col-md-6"><p>Communication</p></div>
                                    <div class="col-md-6">
                                        <span class="hotelstar">
                                            <i class="glyphicon glyphicon-star"></i> 
                                            <i class="glyphicon glyphicon-star"></i> 
                                            <i class="glyphicon glyphicon-star"></i> 
                                            <i class="glyphicon glyphicon-star"></i> 
                                            <i class="glyphicon glyphicon-star emptystar"></i> 
                                        </span>
                                    </div>
                                </div> <!-- End Column -->

                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="col-md-6"><p>Professionalism</p></div>
                                    <div class="col-md-6">
                                        <span class="hotelstar">
                                            <i class="glyphicon glyphicon-star"></i> 
                                            <i class="glyphicon glyphicon-star"></i> 
                                            <i class="glyphicon glyphicon-star"></i> 
                                            <i class="glyphicon glyphicon-star"></i> 
                                            <i class="glyphicon glyphicon-star emptystar"></i> 
                                        </span>
                                    </div>
                                </div> <!-- End Column -->

                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="col-md-6"><p>Safety</p></div>
                                    <div class="col-md-6">
                                        <span class="hotelstar">
                                            <i class="glyphicon glyphicon-star"></i> 
                                            <i class="glyphicon glyphicon-star"></i> 
                                            <i class="glyphicon glyphicon-star"></i> 
                                            <i class="glyphicon glyphicon-star"></i> 
                                            <i class="glyphicon glyphicon-star emptystar"></i> 
                                        </span>
                                    </div>
                                </div> <!-- End Column -->
                            </div> <!-- End Container -->
                        </div> <!-- End RatingSection -->


                        <div class="reviewsection">
                            <div class="container">
                                <div class="blockheading"><h2>Reviews  <span>(6 reviews)</span></h2></div> <!-- End BlockHeading -->

                                <div class="col-md-12 reviewblock">
                                    <div class="col-md-2 col-sm-2 col-xs-12 reviewuserimg"><img src="<?= $base_url.'/'.drupal_get_path('theme', 'gloobers_new')?>/images/amadou.jpg" alt="" title="" /><p>Amadou</p></div> <!-- End Review UserImg -->
                                    <div class="col-md-10 col-sm-10 col-sm-12 userreview">
                                        <p>What a amazing experiences. Everything was perfect. Sam is a great tour guide, the car are perfect, the trip is just a must do for anyone looking for andrenalyne and wildlife experience. </p>
                                        <p><span>october 2015</span></p>
                                    </div> <!-- End UserReview -->
                                </div> <!-- End ReviewBlock -->

                                <div class="col-md-12 reviewblock">
                                    <div class="col-md-2 col-sm-2 col-xs-12 reviewuserimg"><img src="<?= $base_url.'/'.drupal_get_path('theme', 'gloobers_new')?>/images/amadou.jpg" alt="" title="" /><p>Amadou</p></div> <!-- End Review UserImg -->
                                    <div class="col-md-10 col-sm-10 col-sm-12 userreview">
                                        <p>What a amazing experiences. Everything was perfect. Sam is a great tour guide, the car are perfect, the trip is just a must do for anyone looking for andrenalyne and wildlife experience. </p>
                                        <p><span>october 2015</span></p>
                                    </div> <!-- End UserReview -->
                                </div> <!-- End ReviewBlock -->

                                <div class="col-md-12 reviewblock">
                                    <div class="col-md-2 col-sm-2 col-xs-12 reviewuserimg"><img src="<?= $base_url.'/'.drupal_get_path('theme', 'gloobers_new')?>/images/amadou.jpg" alt="" title="" /><p>Amadou</p></div> <!-- End Review UserImg -->
                                    <div class="col-md-10 col-sm-10 col-sm-12 userreview">
                                        <p>What a amazing experiences. Everything was perfect. Sam is a great tour guide, the car are perfect, the trip is just a must do for anyone looking for andrenalyne and wildlife experience. </p>
                                        <p><span>october 2015</span></p>
                                    </div> <!-- End UserReview -->
                                </div> <!-- End ReviewBlock -->



                                <div class="col-md-12 morereviewsblock">
                                    <div class="text-center">
                                        <button data-toggle="collapse" data-target="#morereviews" class="morebtn moreme">Read More</button>
                                        <button data-toggle="collapse" data-target="#morereviews" class="morebtn lessme">Read Less</button>
                                    </div>

                                    <div id="morereviews" class="collapse">
                                        <div class="col-md-12 reviewblock">
                                            <div class="col-md-2 col-sm-2 col-xs-12 reviewuserimg"><img src="<?= $base_url.'/'.drupal_get_path('theme', 'gloobers_new')?>/images/amadou.jpg" alt="" title="" /><p>Amadou</p></div> <!-- End Review UserImg -->
                                            <div class="col-md-10 col-sm-10 col-sm-12 userreview">
                                                <p>What a amazing experiences. Everything was perfect. Sam is a great tour guide, the car are perfect, the trip is just a must do for anyone looking for andrenalyne and wildlife experience. </p>
                                                <p><span>october 2015</span></p>
                                            </div> <!-- End UserReview -->
                                        </div> <!-- End ReviewBlock -->

                                        <div class="col-md-12 reviewblock">
                                            <div class="col-md-2 col-sm-2 col-xs-12 reviewuserimg"><img src="<?= $base_url.'/'.drupal_get_path('theme', 'gloobers_new')?>/images/amadou.jpg" alt="" title="" /><p>Amadou</p></div> <!-- End Review UserImg -->
                                            <div class="col-md-10 col-sm-10 col-sm-12 userreview">
                                                <p>What a amazing experiences. Everything was perfect. Sam is a great tour guide, the car are perfect, the trip is just a must do for anyone looking for andrenalyne and wildlife experience. </p>
                                                <p><span>october 2015</span></p>
                                            </div> <!-- End UserReview -->
                                        </div> <!-- End ReviewBlock -->

                                        <div class="col-md-12 reviewblock">
                                            <div class="col-md-2 col-sm-2 col-xs-12 reviewuserimg"><img src="<?= $base_url.'/'.drupal_get_path('theme', 'gloobers_new')?>/images/amadou.jpg" alt="" title="" /><p>Amadou</p></div> <!-- End Review UserImg -->
                                            <div class="col-md-10 col-sm-10 col-sm-12 userreview">
                                                <p>What a amazing experiences. Everything was perfect. Sam is a great tour guide, the car are perfect, the trip is just a must do for anyone looking for andrenalyne and wildlife experience. </p>
                                                <p><span>october 2015</span></p>
                                            </div> <!-- End UserReview -->
                                        </div> <!-- End ReviewBlock -->
                                    </div> <!-- End MoreReviews -->
                                </div> <!-- End MoreReviewsBlock -->

                            </div> <!-- End Container -->
                        </div> <!-- End ReviewSection -->
                    </div> <!-- End WrapSection -->

                </div> <!-- End Row -->
            </div> <!-- End Container-Fluid -->
        </section> <!-- End Content-Section -->



            <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
        <script src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/js/jQuery.min.js" type="text/javascript" language="javascript"></script>
        <script src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/js/easingv1.3.js" type="text/javascript" language="javascript"></script>
        <script src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/js/jqueryui.js" type="text/javascript" language="javascript"></script>
        <script src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/js/bootstrap.min.js" type="text/javascript" language="javascript"></script>
        <script src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/js/moment.js" type="text/javascript" language="javascript"></script>
        <script src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/js/bootstrap-datetimepicker.js" type="text/javascript" language="javascript"></script>
        <script src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/js/circle-progress.js" type="text/javascript" language="javascript"></script>
        <script src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/js/jquery.nicescroll.min.js" type="text/javascript" language="javascript"></script>
        <script src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/js/jquery.selectbox-0.2.js" type="text/javascript" language="javascript"></script>
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
                                                    jQuery(".filtersearch").click(function () {
                                                        jQuery('.tabs_ul').slideToggle();
                                                        jQuery(".filtersearch span i").toggleClass("filter-icon-active");
                                                    });
                                                }); //End Document.Ready()

        </script>
        <script type ="text/javascript">
            var dateToday = new Date();
            jQuery(function () {
                jQuery('#checkin_date').datetimepicker({
                    pickTime: false,
                    minDate: dateToday,
                    //            defaultDate: dateToday,
                });
                dateToday.setDate(dateToday.getDate() + 1);
                jQuery('#checkout_date').datetimepicker({
                    pickTime: false,
                    //            defaultDate: dateToday,
                });
            }); //End


            jQuery("#checkin_date").on("dp.change", function (e) {
                jQuery('#checkout_date').data("DateTimePicker").setMinDate(e.date);
            });
            jQuery("#checkout_date").on("dp.change", function (e) {
                jQuery('#checkin_date').data("DateTimePicker").setMaxDate(e.date);
            });


            // Canvas()
            jQuery('.first.circle').circleProgress({
                value: 0.98,
                //animation: false,
                fill: {color: '#00aeef'}
            });
            jQuery('.second.circle').circleProgress({
                startAngle: -Math.PI / 4 * 3,
                value: 0.73,
                fill: {color: '#00aeef'}
            });

            jQuery('.third.circle').circleProgress({
                startAngle: -Math.PI / 4 * 3,
                value: 0.73,
                fill: {color: '#00aeef'}
            });

            jQuery('.forth.circle').circleProgress({
                startAngle: -Math.PI / 4 * 3,
                value: 0.67,
                fill: {color: '#00aeef'}
            });

            jQuery(document).ready(function () {
                jQuery('.moreme').click(function () {
                    var text = jQuery(this).text();
                    if (text == "Read Less") {
                        var now_text = "Read More";
                    } else {
                        var now_text = "Read Less";
                    }
                    jQuery(this).text(now_text);
                    jQuery(this).parent().next().toggle();
                });

                jQuery('.lessme').click(function () {
                    jQuery(this).text("Read More");
                    jQuery(this).parent().next().toggle();
                });

            });
        </script> 
        <script>
            jQuery(document).ready(function () {
                /**
                 * Add room to cart
                 */
                var hotel_id = '<?= arg(1); ?>';
                jQuery('body').on("click", ".book_now_room", function () {
                    var me = jQuery(this);
                    var room_id = me.attr("data-val");
                    var index = jQuery(".book_now_room").index(me);
                    var no_of_room = jQuery(".select_room").eq(index).val();
                    var board_type = jQuery(".board_type").eq(index).val();
                    if (no_of_room == ' ') {
                        alert("Please select Room");//addClass("error");
                        return false;
                    }
                    var check_in = '<?= $check_in_get ?>';
                    var check_out = '<?= $check_out_get ?>';
                    var dataString = "room_id=" + room_id + "&no_of_room=" + no_of_room + "&check_in=" + check_in + "&check_out=" + check_out + '&hotel_id=' + hotel_id + '&board_type=' + board_type;
                    jQuery.ajax({
                        data: dataString,
                        type: "post",
                        url: '<?= $base_url; ?>/hotel/ajax/getRoomPriceOfSelectedDates',
                        beforeSend: function (xhr) {
                            preLoading('show', 'load-screen');
                        },
                        success: function (response) {
                            preLoading('hide', 'load-screen');
                            var data = response.split("|");
                            if (data[0] == 'success') {
                                var value = parseFloat(data[1]);
                                if (value > 0) {
                                    jQuery(".main_booknow_btn").css("display", "block");
                                } else {
                                    jQuery(".main_booknow_btn").css("display", "none");
                                }
                                var result = value.toFixed(2);
                                jQuery("#total_booked_price").text(result);
                                if (no_of_room > 0) {
                                    me.css("background", "#1581c3");
                                    me.text("Added");
                                } else {
                                    me.css("background", "rgb(244,160,26)");
                                    me.text("Add");

                                }
                                window.scrollTo(0, 0).dealy(2000);
                            }

                        }
                    });
                });

            });
        </script>
