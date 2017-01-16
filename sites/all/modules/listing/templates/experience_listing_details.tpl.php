<script type="text/javascript"
        src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/js/clipboard/jquery.zclip.js"></script>
<script src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/js/jquery.classyloader.min.js"
        type="text/javascript"></script>
<?php
global $user, $base_url, $user_booking_details;

$user_booking_details = $_SESSION['user_booking_details'];
//unset($_SESSION['user_booking_details']);
$user_list_id = arg(1);
if ($user_booking_details) {
    if ($_SESSION['user_booking_details']['eid'] != $user_list_id) {
        unset($_SESSION['user_booking_details']);
    }
}
//echo "<pre>";print_r($user_booking_details);exit;

$getMaxMinBasePrice = getMaxMinbasePrice();
$userDetails = user_load($OverviewData['uid']);
$experienceType = getExperienceListingTypeById($OverviewData['experience_type']);
/* Added Css Files */
drupal_add_css(drupal_get_path('theme', $GLOBALS['theme']) . '/stylesheet/style.css', 'file');
drupal_add_css(drupal_get_path('theme', $GLOBALS['theme']) . '/css/slider.css', 'file');
drupal_add_css(drupal_get_path('theme', $GLOBALS['theme']) . '/css/bootstrap-datetimepicker.min.css', 'file');
drupal_add_css(drupal_get_path('theme', $GLOBALS['theme']) . '/css/jquery.timepicker.css', 'file');
drupal_add_css(drupal_get_path('theme', $GLOBALS['theme']) . '/css/fullcalendar.css', 'file');
drupal_add_css(drupal_get_path('theme', $GLOBALS['theme']) . '/stylesheet/for-head-foot.css', 'file');
/* Added Js Files */
drupal_add_js(drupal_get_path('theme', $GLOBALS['theme']) . '/js/moment.js', array('scope' => 'footer'));
drupal_add_js(drupal_get_path('theme', $GLOBALS['theme']) . '/js/jquery.selectbox-0.2.js', array('scope' => 'footer'));
drupal_add_js(drupal_get_path('theme', $GLOBALS['theme']) . '/js/bootstrap-datetimepicker.js', array('scope' => 'footer'));
drupal_add_js(drupal_get_path('theme', $GLOBALS['theme']) . '/js/circle-progress.js', array('scope' => 'footer'));
drupal_add_js(drupal_get_path('theme', $GLOBALS['theme']) . '/js/jquery.timepicker.js', array('scope' => 'footer'));
drupal_add_js(drupal_get_path('theme', $GLOBALS['theme']) . '/js/fullcalendar.min.js', array('scope' => 'footer'));
drupal_add_js(drupal_get_path('theme', $GLOBALS['theme']) . '/js/experience.js', array('scope' => 'footer'));
$reviewHtml = '';
$averageRating = 0;
$professionalismRate = 0;
$communicationRate = 0;
$moneyRate = 0;
$safetyRate = 0;
if (module_exists('advisor')) {
    $trevelGuideList = getListTrevelGuide();
}
$categories_counting = array();


if (!empty($reviews)) {
    $reviewHtml .= '<div class="dr-review">
				<div class="container"> 
				<div class="row">
				<div class="col-sm-12">  <h3>reviews <span>(' . sizeof($reviews) . ' reviews) </span></h3></div>';

    $rc = 1;
    foreach ($reviews as $reviewDetails) {
        $averageRating = $averageRating + $reviewDetails['average'];
        $professionalismRate = $professionalismRate + $reviewDetails['professional'];
        $communicationRate = $communicationRate + $reviewDetails['communication'];
        $moneyRate = $moneyRate + $reviewDetails['money'];
        $safetyRate = $safetyRate + $reviewDetails['safety'];
        $recommendation = $recommendation + $reviewDetails['recommendation'];
        $imgpath = image_style_url($style, $reviewDetails['uri']);
        $noImage = "this.src='" . $base_url . '/' . drupal_get_path('theme', 'gloobers') . "/images/no-profile-male-img.jpg" . "'";

        $traveller = user_load($reviewDetails['uid']);
        if ($traveller->picture != "") {
            $traveller_DpID = $traveller->picture->fid;
            $traveller_file = file_load($traveller_DpID);
            $traveller_file_imgpath = $traveller_file->uri;
            $traveller_style = "new-reservation";
            $imgpath = image_style_url($traveller_style, $traveller_file_imgpath);
        }

        $addclass = '';
        $add_newclass = '';
        if ($rc > 2) {
            $addclass = "hide_reviewdiv";
            $add_newclass = "show_reviewdiv";
        }

        $reviewHtml .= '<div class="iner-review ' . $add_newclass . ' ' . $addclass . '">
				<div class="col-sm-2 col-xs-12 left-img-sec"> <img src="' . $imgpath . '" alt=" " onError="this.onerror=null;' . $noImage . '" /> 
				<span>' . ucfirst(trim($traveller->field_first_name[und][0][value], "%20") . ' ' . $traveller->field_last_name[und][0][value]) . '</span>
				</div>

				<div class="col-sm-10 col-xs-12 right-text-sec">
				<p class="desp_short"> ' . stripslashes(substr($reviewDetails['comments'], 0, 490)) . '
				<span class="desp_long" style="display:none"> ' . stripslashes(substr($reviewDetails['comments'], 490, strlen($reviewDetails['comments']))) . '</span></p>';
        if (strlen($reviewDetails['comments']) > 490) {
            $reviewHtml .= '<a href="javascript:void(0);" class="review_desp" id="review_desp_' . $rc . '"> Read More </a>';
        }

        $reviewHtml .= '<span>' . date("d F Y", strtotime($reviewDetails['created'])) . '</span>
				</div></div>';
//        var_dump($reviewDetails);die;
        $passionCats = unserialize($reviewDetails['passion_categories']);

        foreach ($passionCats as $passionCat) {
            $categories_counting[] = $passionCat;
        }
        $rc++;
    }

    $categoriesCount = array_count_values($categories_counting);

    $reviewHtml .= '<div class="col-sm-12 read-more">
				<a href="javascript:void(0);" id="review_read_more"> Read More </a>
				</div>     

				</div>

				</div>       
				</div>';
}


if (sizeof($categoriesCount) > 5) {
    rsort($categoriesCount);
    $categoriesCount = array_slice($categoriesCount, 0, 5);
}
$FBphoto = unserialize($photos[0]['value1']);
$FBfile = file_load($FBphoto["fid"]);
$FBstyle = 'sharing_listing_image';
$FBimgpath = $FBfile->uri;

if (file_exists($FBimgpath)) {
    $imgpath = $FBimgpath;
    $Img_Name = $FBfile->filename; ?>
    <img class="image_print" style="display:none" src="<?php print image_style_url($FBstyle, $imgpath); ?>" alt=""
         title=""/>
<?php } else {
    $imgpath = $Img_uri;
    $Img_Name = 'banner-listing_img.jpg';
}

$FBsrc = image_style_url($FBstyle, $FBimgpath);
$Listing_recommend_link = $base_url . '/experience/' . arg(1) . '?ruid=' . base64_encode($user->uid) . '&FBsrc=' . $FBsrc . '&base_url=' . $base_url;
$twitter_recommend_link = $base_url . '/sites/all/themes/gloobers_new/twitterOauthwithImagePost/callback.php?msg=' . $base_url . '/experience/' . arg(1) . '?ruid=' . base64_encode($user->uid) . '&media=' . $FBsrc . '&redirect=1';

$availableDate = getAvailbaleDatesForCal($scheduleSessionData);
$finalDates = $availableDate;
//echo "<pre>";print_r($finalDates);exit;
?>
<script type="text/javascript">
    jQuery(window).load(function () {
        jQuery("#load-screen").hide();

    });
    function search_destination() {
        var home_autocomplete = new google.maps.places.Autocomplete(
            /** @type {HTMLInputElement} */
            (document.getElementById('experience_loction')),
            {types: ['geocode']});
        google.maps.event.addListener(home_autocomplete, 'place_changed', function () {
        });
    }
    jQuery(document).on('ready', function () {
        /*SelectBox*/
        jQuery("select").selectbox();
        jQuery(document).click(function (e) {
            if (!jQuery(e.target).is('.sbHolder, .sbHolder *')) {
                jQuery("select").selectbox('close');
            }
        }); //End

//BookNow Popup
        jQuery(".booknowbtn").click(function () {
            if (jQuery('.totalamount').find('h4')[0].innerHTML == '$0') {
                alert('Price cannot be zero.');
            } else if (jQuery('#time-select').val() == '') {
                alert('Please select session time.');
            } else {

                var listID = '<?php echo arg(1);?>';
                var selectedDate = jQuery('#avail-dates').val();
                var availiblitymaxval = atob(jQuery('#availiblitymax').val());
                var availiblityminval = atob(jQuery('#availiblitymin').val());
                var per_it_type = atob(jQuery('#per_it_type').val());
                var totalselected = 0;

                if (per_it_type == 'PER_PERSON') {

                    if (jQuery("#person_qty_1").parent().find('a.sbSelector').text() != 'Select' && jQuery("#person_qty_1").parent().find('a.sbSelector').text() != '') {

                        totalselected += parseInt(jQuery("#person_qty_1").parent().find('a.sbSelector').text());
                    }
                    console.log('adult:' + totalselected);
                    if (jQuery("#person_qty_2").parent().find('a.sbSelector').text() != 'Select' && jQuery("#person_qty_2").parent().find('a.sbSelector').text() != '') {
                        totalselected += parseInt(jQuery("#person_qty_2").parent().find('a.sbSelector').text());
                    }
                    console.log('total:' + totalselected);

                } else {

                    console.log(jQuery(".item_selectbox").val());
                    totalselected = jQuery(".item_selectbox").val();

                    /*total_adult = 0;total_child = 0;
                     jQuery('.exp_trave_blk').find('select.person_qty_adult').each(function(){
                     console.log('adult:'+jQuery(this).parent().find('a.sbSelector').text());
                     total_adult += parseInt(jQuery(this).parent().find('a.sbSelector').text());
                     });

                     jQuery('.exp_trave_blk').find('select.person_qty_child').each(function(){
                     console.log('child:'+jQuery(this).parent().find('a.sbSelector').text());
                     total_child += parseInt(jQuery(this).parent().find('a.sbSelector').text());
                     });
                     totalselected =total_adult+total_child;*/

                }

                if (totalselected == 0) {
                    alert('Please select adult/child quantity');
                    return false;
                }

                if (totalselected < availiblityminval) {
                    alert('Please select minimum ' + availiblityminval + ' adult/child quantity');
                    return false;
                }
                var session_time = jQuery('#time-select').val();
                jQuery("#load-screen").css('display', 'block');
                jQuery.ajax({
                    url: $baseUrl + '/ajax/CheckAvailSeatsForSession',
                    type: 'post',
                    data: {
                        'date': selectedDate,
                        'lid': listID,
                        'availiblitymax': availiblitymaxval,
                        'availiblitymin': availiblityminval,
                        'total': totalselected,
                        'session_time': session_time
                    },
                    success: function (data) {

                        var data = jQuery.parseJSON(data);
                        if (data.msg) {
                            alert(data.msg);
                        } else {
                            jQuery(".popuplightbox").show();
                            jQuery(".bookinglightbox").fadeIn();
                        }

                        jQuery("#load-screen").css('display', 'none');
                    },
                    error: function () {
                        alert('request failed please try again');
                        jQuery("#load-screen").css('display', 'none');
                    }
                });


            }
        });

        //Recommend Popup
        jQuery(".recommendbutton").on("click", function () {
            jQuery(".popuplightbox").show();
            jQuery(".recommendlightbox").fadeIn();
            jQuery("#copy-dynamic1").trigger("click");

        });

        jQuery("#copy-dynamic1").on("click", function () {
            console.log("click");

            jQuery('#copy-dynamic1').zclip(
                {
                    path: "<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/js/clipboard/ZeroClipboardnew.swf",
                    copy: function () {
                        return jQuery('#dynamic1').val();
                    },
                    afterCopy: function () {
                        console.log("success");
                        jQuery('#dynamic1').css('background-color', '#006699');
                        jQuery('#dynamic1').css('color', '#ffffff');
                    }
                });

            jQuery("#copy-dynamic1").next().remove();

        });


        // Hide Lightbox
        jQuery(".cancelbtn").click(function () {
            jQuery(".popuplightbox").hide();
            jQuery(".bookinglightbox").fadeOut();
            jQuery(".popuplightbox").hide();
            jQuery(".recommendlightbox").fadeOut();
        });

        jQuery(document).click(function (e) {
            if (!jQuery(e.target).is('.recommendlightbox *, .bookinglightbox *, .bookingdetail *')) {
                jQuery(".popuplightbox").hide();
                jQuery(".recommendlightbox").fadeOut();
                jQuery(".bookinglightbox").fadeOut();
            }
        }); //End

        jQuery('#viewdetails').show();
        jQuery('#viewdetailsFull').hide();
        jQuery('.lessdesc').hide();
        jQuery('.moredesc').show();

    }); //End Ready()
    jQuery(document).on('click', '.moredesc', function () {
        jQuery('#viewdetails').hide();
        jQuery('#viewdetailsFull').show();
        jQuery('.lessdesc').show();
        jQuery('.moredesc').hide();
    });
    jQuery(document).on('click', '.lessdesc', function () {
        jQuery('#viewdetails').show();
        jQuery('#viewdetailsFull').hide();
        jQuery('.moredesc').show();
        jQuery('.lessdesc').hide();
    });
    function getdefaultCounter(val) {

        var MyupdateDefault = jQuery('#' + val.id).attr('attr-value');
        //Default One Quantity Assign when user Click on Checkbox of optional Services
        var id = (jQuery("input[name='" + MyupdateDefault + "']").attr('attr-value'));
        var Qty = (jQuery("input[name='" + MyupdateDefault + "']").attr('data-value'));
        if (jQuery('#' + val.id).is(':checked') == true) {
            var status = 1;
        } else {
            var status = 0;
        }
        var obj = {
            status: status,
            id: id,
            qty: Qty
        }
        optionalServices(obj);
    }
    function getCounter(val) {
        fieldName = jQuery(val).attr('data-field');
        type = jQuery(val).attr('data-type');
        var input = jQuery("input[name='" + fieldName + "']");
        var isCheckedElementId = input.attr('attr-value');
        var isCheckedElement = '#service-' + isCheckedElementId;
        if (jQuery(isCheckedElement).prop('checked') == true) {
            var currentVal = parseInt(input.val());
            if (!isNaN(currentVal)) {
                if (type == 'minus') {
                    if (currentVal > input.attr('min')) {
                        input.val(currentVal - 1).change();
                        jQuery("input[name='" + fieldName + "']").attr('data-value', (currentVal - 1));

                    }
                    if (parseInt(input.val()) == input.attr('min')) {
                        jQuery(val.id).attr('disabled', true);
                    }

                } else if (type == 'plus') {
                    if (currentVal < input.attr('max')) {
                        input.val(currentVal + 1).change();
                        jQuery("input[name='" + fieldName + "']").attr('data-value', (currentVal + 1))
                    }
                    if (parseInt(input.val()) == input.attr('max')) {
                        jQuery(val.id).attr('disabled', true);
                    }
                }
                var id = (jQuery("input[name='" + fieldName + "']").attr('attr-value'));
                var Qty = (jQuery("input[name='" + fieldName + "']").attr('data-value'));
                var obj = {
                    status: 1,
                    id: id,
                    qty: Qty
                }
                optionalServices(obj);
            } else {
                input.val(0);
            }
        } else {
            alert("Please check checkbox of optional service first.");
        }
    }
    jQuery(function () {
        //alert('dfgdfg');
        //var $ = jQuery;
        var availableDates = new Array();
        availableDates = <?php echo json_encode($finalDates);?>;
        console.log(availableDates);
        var user_booking_details =<?php echo json_encode($user_booking_details); ?>;

        //alert(jQuery.type(availableDates.length));
        var dateTodayavail = new Date();
        var curr_date_avail = dateTodayavail.getDate();
        var curr_month_avail = dateTodayavail.getMonth() + 1;
        var curr_year_avail = dateTodayavail.getFullYear();
        var monthdate_avail = curr_year_avail + '-' + curr_month_avail + '-' + curr_date_avail;
        jQuery('#load-screen_details').hide();
        if (availableDates.length == 0) {
            var mindates = monthdate_avail;
            jQuery('#avail-dates').val('No dates available');
            jQuery('#avail-dates').datetimepicker({
                pickTime: false,
                minDate: mindates,
                daysOfWeekDisabled: [0, 1, 2, 3, 4, 5, 6]
            });
        } else if (availableDates['NO_DATE'] == 'NO_DATE') {

            var mindates = getFormattedDate(availableDates['dates'][0]);//monthdate_avail;
            //alert(mindates);
            var disable_days = [];
            jQuery.each(availableDates['disable_days'], function (index, value) {
                disable_days.push(parseInt(value));
            });

            jQuery('#avail-dates').val(mindates);

            if (user_booking_details) {
                jQuery('#avail-dates').val(getFormattedDate(user_booking_details['dateNew']));
                console.log('user_booking_details_Date' + getFormattedDate(user_booking_details['dateNew']));
            }

            jQuery('#avail-dates').datetimepicker({
                pickTime: false,
                minDate: mindates,
                daysOfWeekDisabled: disable_days
            });

            console.log('NO_DATE');

        } else {

            var mindates = getFormattedDate(availableDates['dates'][0]);

            jQuery('#avail-dates').val(mindates);

            if (user_booking_details) {
                jQuery('#avail-dates').val(getFormattedDate(user_booking_details['dateNew']));
                console.log('user_booking_details_Date' + getFormattedDate(user_booking_details['dateNew']));
            }

            jQuery('#avail-dates').datetimepicker({
                pickTime: false,
                minDate: mindates,
                enabledDates: availableDates['dates']
            });


        }
        jQuery('#treveller_by_day_hour_minute').datetimepicker({
            pickTime: false,
            minDate: '2015-04-20',
            defaultDate: '2015-04-20'
        });


        jQuery('#date_downarrow').on('click', function () {

            jQuery('#avail-dates').trigger('click');

        });

    });
</script>
<?php
$search_dest_bar = ucfirst($OverviewData['city']) . ', ' . ucfirst($OverviewData['country']);
?>
<section class="content-section hotelpagedetail">
    <div id="load-screen"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="innersearch">
                <div class="col-md-10 col-sm-9 col-xs-12 dessearch">
                    <input type="search" name="search_desti" id="experience_loction"
                           value="<?php print $search_dest_bar; ?>" class="desinput" onKeyup="search_destination();"
                           onblur="if (this.placeholder == ''){this.placeholder = 'Enter a destination'; }"
                           onfocus="if(this.placeholder == 'Enter a destination'){this.placeholder = '';}"
                           placeholder="Enter a destination"/>
                    <input type="submit" name="submit" value="Submit" class="searchinput" onclick="clickablesearch();"/>
                </div> <!-- End DesSearch -->

                <div class="col-md-2 col-sm-3 col-xs-12 travelsearch">
                    <select class="experienceinput" id="experience_list_filter">

                        <option value="Expereince" selected="selected">Experience</option>
                        <option value="Gloobers">Other gloobers</option>
                    </select>
                </div> <!-- End AdvisorSearch -->

            </div> <!-- End InnerSearch -->
        </div> <!-- End Row -->

        <div class="row">
            <div class="hotelslide">
                <div role="tabpanel">
                    <ul role="tablist" class="nav nav-tabs hotelpagetab" id="myTab">
                        <li class="active"><a aria-expanded="true" aria-controls="photos" data-toggle="tab" role="tab"
                                              id="photos-tab" href="#photos">Photos</a></li>
                        <!-- <li><a aria-controls="Calendar" data-toggle="tab" id="Calendar-tab" role="tab" href="#Calendar" aria-expanded="false">Calendar</a></li> -->
                        <li><a aria-controls="Map" data-toggle="tab" id="Map-tab" role="tab" href="#Map"
                               aria-expanded="false">Map</a></li>
                    </ul>
                </div> <!-- End Tabs -->

                <div class="tab-content" id="myTabContent">
                    <div aria-labelledby="photos-tab" id="photos" class="tab-pane fade active in" role="tabpanel">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="hotelslider" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner" role="listbox">
                                        <?php

                                        if (!empty($pOverviewhotos)) {
                                            $countA = 1;
                                            foreach ($photos as $photo) {
                                                $photo = unserialize($photo["value1"]);
                                                $file = file_load($photo["fid"]);
                                                $imgpath = $file->uri;
                                                $style = 'experience_slider_new_design';
                                                $style_thumb = 'experience_slider_thumb';
                                                //print image_style_url($style, $imgpath);exit;
                                                if ($countA == 1) {
                                                    $activeClass = 'active';
                                                } else {
                                                    $activeClass = '';
                                                }
                                                ?>
                                                <div class="item <?php echo $activeClass; ?>">
                                                    <img onerror="this.onerror=null;this.src='<?php echo $base_url . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/images/default_exp_banner.jpg'; ?>'"
                                                         src="<?php print image_style_url($style, $imgpath); ?>" alt=""
                                                         title=""/>
                                                </div>
                                                <?php
                                                $countA++;
                                            }
                                        } else { ?>
                                            <div class="item active"><img
                                                        src="<?php echo $base_url . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/images/cover_pic.jpg'; ?>"/>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div> <!-- End Carousel Inner -->
                                    <?php if ((sizeof($photos) > 1) || !empty($photos)) { ?>
                                        <a class="left carousel-control white_left_arrow" href="#hotelslider"
                                           data-slide="prev" onclick="jQuery('#hotelslider').carousel('prev')"></a>
                                        <a class="right carousel-control white_right_arrow" href="#hotelslider"
                                           data-slide="next" onclick="jQuery('#hotelslider').carousel('next')"></a>
                                    <?php } ?>
                                </div> <!-- End Carousel Slide -->
                            </div> <!-- End Carousel Column -->

                            <div class="tabblockname">
                                <div class="container">
                                    <h2><?php print t(ucfirst($OverviewData['title'])) . ' '; ?></h2><h4>
                                        <?php
                                        $listing_addr = '';
                                        if ($OverviewData['city']) {
                                            $listing_addr .= ucfirst($OverviewData['city']) . ', ';
                                        }
                                        if ($OverviewData['state']) {
                                            $listing_addr .= ucfirst($OverviewData['state']) . ', ';
                                        }
                                        if ($OverviewData['country']) {
                                            $listing_addr .= ucfirst($OverviewData['country']);
                                        }
                                        print $listing_addr; ?>
                                    </h4>
                                    <!-- <span class="nature"><?php echo $experienceType['experience_type']; ?></span> -->
                                </div>
                            </div> <!-- End TabBlockName -->
                        </div> <!-- End Carousel Row -->
                    </div> <!-- End Photo TabPane -->

                    <div aria-labelledby="Map-tab" id="Map" class="tab-pane fade" role="tabpanel">
                        <div class="mappanel" id="map-canvas">
                            <div class="mapframe"> Loading Map view please wait....</div>
                        </div>
                    </div> <!-- End Map TabPane -->

                    <div aria-labelledby="Calendar-tab" id="Calendar" class="tab-pane fade" role="tabpanel">
                        <div class="calenpanel">
                            <div id="calendar_full">Loading calendar please wait....</div>
                        </div>
                        <div id="loading_full_calview" class="load-screen_details" style="display:none;"></div>
                    </div> <!-- End Calendar TabPane -->

                </div> <!-- End Tab-Content -->
            </div> <!-- End HotelSlide -->

            <div class="hotelfilter">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2 col-sm-4 col-xs-6 bookingdetail checkindate">
                            <p>Check In</p>
                            <input type="text" id="avail-dates" autocomple="false" data-date-format="YYYY/MM/DD"
                                   name="date" placeholder="Select Date" readonly="readonly" value=""/>
                            <input type="hidden" id="availiblitymax"/>
                            <input type="hidden" id="availiblitymin"/>
                            <input type="hidden" id="per_it_type"/>
                            <input type="hidden" id="new_price_status"/>
                            <i class="dropdownarrow" id="date_downarrow"></i>

                        </div> <!-- End CheckinDate data-date-format="YYYY/MM/DD"-->

                        <div class="col-md-2 col-sm-4 col-xs-6 bookingdetail travelsec">
                            <p>Session</p>
                            <input type="text" placeholder="HH::MM" id="time-select" value="" readonly="readonly"/>
                            <i class="dropdownarrow timedownarrow"></i>

                            <ul class="time_down_list" style="display:none;">

                            </ul>


                        </div> <!-- End SessionTime -->

                        <div class="col-md-2 col-sm-4 col-xs-12 bookingdetail travelers">
                            <p>Travelers</p>
                            <div class="travelers-exp">
                                <span id="traveler" class="traveler">Choose travelers</span>
                                <div class="exp_trave_blk" id="travel_sec2">

                                </div> <!-- End Exp_Trave_Block -->
                            </div> <!-- End Travelers-Exp -->
                            <i class="dropdownarrow" role="dropdown-menu"></i>
                        </div> <!-- End Travelers -->
                        <script type="type/javascript">
	jQuery(document).ready(function(){
		jQuery("#traveler").click(function(){
			jQuery(".exp_trave_blk").show();
		});
	});


                        </script>
                        <div class="col-md-2 col-sm-4 col-xs-12 bookingdetail recommendbutton">
                            <p>
                                <i><img src="<?php echo $base_url . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/images/recommend_icon.png"
                                        alt="" title=""/></i></p>
                            <a href="javascript:void(0);">Recommend</a>
                        </div> <!-- End RecommendButton -->
                        <div class="col-md-2 col-sm-4 col-xs-12 bookingdetail totalamount">
                            <p>Total</p>
                            <h4>$0</h4>
                            <h5>Take $<label id="Available_gloobies_information"></label> off using your gloobies</h4>
                        </div> <!-- End TotalAmount -->
                        <div class="col-md-2 col-sm-4 col-xs-12 bookingdetail booknowbtn">
                            <p><i class="fa fa-briefcase"></i></p>
                            <a href="javascript:void(0);">Book Now</a>
                        </div> <!-- End TotalAmount -->
                    </div> <!-- End Row -->
                </div> <!-- End Container -->
            </div> <!-- End HotelFilter -->

            <div class="wrapsection">
                <div class="container">
                    <div class="col-md-12">
                        <div class="hoteloverview">
                            <div class="blockheading"><h2>Overview</h2></div> <!-- End BlockHeading -->

                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <h3>Category</h3>
                                <h4 class="colorblue"><?php echo $experienceType['experience_type']; ?></h4>
                            </div>

                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <!-- <h3>Duration</h3>
<h4 id="time_duration"> -->

                                <?php //echo!empty($calendarDetail['duration']) ? $calendarDetail['duration'] . ' ' : 'No duration '; ?><?php //print t(!empty($calendarDetail['durationUnit']) ? $calendarDetail['durationUnit'] : ''); ?>

                                <!-- </h4> -->
                            </div>

                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <h3>Reviews</h3>
                                <span class="hotelstar"><a class="reviewsCountAnchr">(<?php echo sizeof($reviews); ?>
                                        reviews)</a></span>
                            </div> <!-- End Col -->
                        </div> <!-- End HotelOverview -->
                    </div> <!-- End Col -->
                    <div class="col-md-12 col-sm-12 col-xs-12 canvascircle">
                        <div class="circles">
                            <?php //rsort($categoriesCount);


                            foreach ($reviewRatings as $key => $rating){
                            ?>
                            <div class="canvas-outr">
                                <canvas class="loader_common" id="<?= "loader_".$key ?>"></canvas>
                                <p style="display:none"><?= $rating['percentage'] ?></p>
                                <p>
                                    <?= $rating['passion_category'] ?>
                                </p>
                            </div>
                            <?php
                            } ?>
                        </div>
                    </div>
                </div> <!-- End Container -->

                <div class="container">
                    <div class="hoteldestext hideContent" id="description_read_more">
                        <div class="blockheading"><h2>Description</h2></div> <!-- End BlockHeading -->
                        <?php
                        $descriptionCount = strlen($OverviewData['brief_description']);

                        ?>

                        <div id="viewdetails" class="col-md-12 moredetail">
                            <div class="col-md-12 col-sm-12 col-xs-12 paratext">
                                <p><?php print nl2br(substr($OverviewData['brief_description'], 0, 260)).'...'; ?></p>
                            </div>
                        </div>
                        <div id="viewdetailsFull" class="col-md-12 moredetail" style="display:none;">
                            <div class="col-md-12 col-sm-12 col-xs-12 paratext">
                                <p><?php print nl2br($OverviewData['brief_description']); ?></p>
                            </div>
                        </div>
                        <div class="text-center">
                            <button data-toggle="collapse" class="morebtn moredesc">Read More</button>
                            <button data-toggle="collapse" class="morebtn lessdesc">Read Less</button>
                        </div>
                        <?php
                        //}
                        ?>
                    </div> <!-- End HotelDesText -->
                </div> <!-- End Container -->

                <?php
                //echo "<pre>";Print_r($finalDates);exit;
                if (!empty($finalDates)){
                if ($extras){ ?>
                <div class="optionalblock">
                    <div class="container">
                        <div class="blockheading"><h2>Optional services</h2></div> <!-- End BlockHeading -->
                        <?php
                        $quantkey = 1;
                        foreach ($extras as $key => $value){
                        $extras = unserialize($value["value1"]);
                        if ($extras['price-type']=='%'){
                        $percnt = '%';
                        $dolr = '';
                        }else{
                        $percnt = '';
                        $dolr = '$';
                        }
                        if ($extras['price-key']=='per-order'){
                        $orderType = 'Order';
                        }else{
                        $orderType = 'Quantity';
                        }
                        ?>
                        <div class="col-md-12">
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <input id="service-<?php echo $value["meta_id"]; ?>" class="css-checkbox"
                                       type="checkbox" onclick="getdefaultCounter(this);"
                                       attr-value="optional-select-<?php echo $value["meta_id"]; ?>"/>
                                <label for="service-<?php echo $value["meta_id"] ?>"
                                       class="css-label"><?php echo $extras["title"]; ?> (<?php echo $dolr.$extras["price"].$percnt.'/'.$orderType; ?>
                                    )</label>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <div class="input-group">
			  <span class="input-group-btn">
				  <button type="button" class="btn btn-default btn-number" id="minus-<?php echo $quantkey; ?>"
                          onclick="getCounter(this);" disabled="disabled" data-type="minus"
                          data-field="optional-select-<?php echo $value["meta_id"]; ?>">
					  <span class="glyphicon glyphicon-minus"></span>
				  </button>
			  </span>
                                    <input type="text" name="optional-select-<?php echo $value["meta_id"]; ?>" readonly
                                           attr-value="<?php echo $value["meta_id"]; ?>"
                                           id="<?php echo 'opqty_'.$quantkey; ?>"
                                           class="form-control input-number optional-services-dropbox" value="1" min="1"
                                           max="10" data-value="1"/>
                                    <span class="input-group-btn">
				  <button type="button" class="btn btn-default btn-number" id="plus-<?php echo $quantkey; ?>"
                          data-type="plus" onclick="getCounter(this);"
                          data-field="optional-select-<?php echo $value["meta_id"]; ?>">
					  <span class="glyphicon glyphicon-plus"></span>
				  </button>
			  </span>
                                </div>
                            </div>
                        </div> <!-- End Col -->
                        <?php $quantkey++;
                        } ?>

                    </div> <!-- End Container -->
                </div> <!-- End OptionalBlock -->
                <?php }
                } ?>

                <div class="container">
                    <div class="aboutuserblock">
                        <div class="blockheading"><h2>About</h2></div> <!-- End BlockHeading -->
                        <div class="col-md-2 col-sm-2 col-xs-12 userimg">
                            <?php

                            if ($userDetails->picture != "") {
                            $file = file_load($userDetails->picture->fid);
                            $imgpath = $file->uri;
                            $style = "experience_topranked";
                            print '<img src="' . image_style_url($style, $imgpath). '" alt="display pic" title="" />';
                            } else {
                            print '<img src="' . base_path() . drupal_get_path('theme', $GLOBALS['theme']) . '/images/no-profile-male-img.jpg" alt="display pic" title=""  />';
                            }
                            ?>
                            <p><?php echo trim($userDetails->field_first_name['und'][0]['value'], "%20"); ?></p><a
                                    href="<?php echo $base_url.'/profile/'.$userDetails->uid; ?>">View full profile</a>
                        </div>
                        <div class="col-md-10 paratext">
                            <p class="read-more-head"><?php print($userDetails->field_about_yourself) ? nl2br($userDetails->field_about_yourself['und'][0]['value']) : t('No more information for owner.'); ?></p>
                        </div> <!-- End paraText -->
                    </div> <!-- End HotelDesText -->
                </div> <!-- End Container -->

                <div class="cancellationsection">
                    <div class="container">
                        <div class="blockheading"><h2>Cancellation policies</h2></div> <!-- End BlockHeading -->
                        <div class="col-md-12 paratext">

                            <?php
                            //echo $rulesDetail['cancellation_policies_type'];exit;
                            if (!empty($rulesDetail['cancellation_policies_type'])){
                            switch ($rulesDetail['cancellation_policies_type']){
                            case "Relaxed":
                            print '<div class="read-more-head"><p>' . t('Guests will receive a full refund if they cancel at least two weeks before the start of their reservation.') . '</p></div>';
                            $first_days = 14;
                            $first_refundAmountPercent = "100%";
                            break;
                            case "Flexible":
                            print '<div class="read-more-head"><p>' . t('Guests will receive their full refundable deposit :') . '</p><p>' . t('A 50% refund of their paid rental costs if they cancel at least four weeks before the start of their reservation. OR') . '</p><p>' . t('A 25% refund of their paid rental costs if they cancel up to two weeks before the start of their reservation.') . '</p></div>';
                            $first_days = 28;
                            $first_refundAmountPercent = "50%";
                            $second_days = 14;
                            $second_refundAmountPercent = "25%";
                            break;
                            case "Moderate":
                            print '<div class="read-more-head"><p>' . t('Guests will receive their full refundable deposit.</p><p> A 50% refund of their paid rental costs, if they cancel at least four weeks before the start of their reservation.') . '</p></div>';
                            $first_days = 28;
                            $first_refundAmountPercent = "50%";
                            break;
                            case "Strict":
                            print '<div class="read-more-head"><p>' . t('Guests will receive their full refundable deposit :') . '</p><p>' . t('A 50% refund of their paid rental costs if they cancel at least eight weeks before the start of their reservation OR') . '</p><p>' . t('A 25% refund of their paid rental costs if they cancel up to four weeks before the start of their reservation.') . '</p></div>';
                            $first_days = 56;
                            $first_refundAmountPercent = "50%";
                            $second_days = 28;
                            $second_refundAmountPercent = "25%";
                            break;
                            case "Super-Strict":
                            print '<div class="read-more-head"><p>' . t('If the guest cancels, any money they have paid cannot be refunded.') . '</p></div>';
                            $first_days = 0;
                            $first_refundAmountPercent = "0%";
                            break;
                            case "Custom":
                            print '<div class="read-more-head"><p>' . t('Guests will receive their full refundable deposit:') . '</p><p>' . t($rulesDetail['amount_week'] . '% refund of their paid rental costs if they cancel at least ' . $rulesDetail['amount_week_rental'] . " " . $rulesDetail['amount_week_select'] . ' prior to reservation. OR') . '</p><p>' . t($rulesDetail['amount_day'] . '% refund of their paid rental costs if they cancel at least ' . $rulesDetail['amount_day_rental'] . " " . $rulesDetail['amount_day_select'] . '  prior to reservation') . '</p></div>';
                            if ($rulesDetail['amount_week_select'] == 'weeks'){
                            $rulesDetail['amount_week_rental'] = ($rulesDetail['amount_week_rental'] * 7);
                            } else {
                            $rulesDetail['amount_week_rental'] = ($rulesDetail['amount_week_rental'] * 30);
                            }
                            $first_days = $rulesDetail['amount_week_rental'];
                            $first_refundAmountPercent = $rulesDetail['amount_week'] . '%';
                            $second_days = $rulesDetail['amount_day_rental'];
                            $second_refundAmountPercent = $rulesDetail['amount_day'] . '%';
                            break;
                            default:
                            print '<div class="read-more-head"><p>' . t('No Cancellation policy.') . '</p></div>';
                            }
                            } else {
                            print '<div class="read-more-head"><p>' . t('No Cancellation policy.') . '</p></div>';
                            }
                            ?>
                        </div> <!-- End  ParaText -->
                        <div class="col-md-12 cancellation_detail_marker">
                            <?php
                            if (!empty($rulesDetail['cancellation_policies_type'])){
                            ?>
                            <div id="canceldetails" class="collapse">
                                <div class="progress">
                                    <div class="value"><i class="fa fa-map-marker"></i> 100%</div>
                                    <div class="progress-bar progress-bar-success" role="progressbar"></div>
                                    <div class="status-bar"><p>Booking Date</p></div>
                                </div> <!-- End Progress -->
                                <?php if (isset($first_days)) { ?>
                                <div class="progress">
                                    <div class="value"><i
                                                class="fa fa-map-marker"></i> <?php echo $first_refundAmountPercent; ?>
                                    </div>
                                    <div class="progress-bar progress-bar-warning" role="progressbar"></div>
                                    <div class="status-bar"><p><?php echo $first_days; ?> Days to Service</p></div>
                                </div> <!-- End Progress -->
                                <?php } if (isset($second_days)) { ?>
                                <div class="progress">
                                    <div class="value"><i
                                                class="fa fa-map-marker"></i> <?php echo $second_refundAmountPercent; ?>
                                    </div>
                                    <div class="progress-bar progress-bar-danger" role="progressbar"></div>
                                    <div class="status-bar"><p><?php echo $second_days; ?> Days to Service</p></div>
                                </div> <!-- End Progress -->
                                <?php } ?>
                                <div class="progress lastbar">
                                    <div class="value"><i class="fa fa-map-marker"></i></div>
                                    <div class="progress-bar"></div>
                                    <div class="status-bar"><p>Service Date</p></div>
                                </div> <!-- End Progress -->
                            </div> <!-- End canceldetails -->
                            <?php } ?>
                        </div> <!-- End CancellationDeatilMarker -->

                        <div class="col-md-12 morecancelblock">
                            <div class="text-center">
                                <button data-toggle="collapse" data-target="#canceldetails" class="morebtn moreme">Read
                                    More
                                </button>
                                <button data-toggle="collapse" data-target="#canceldetails" class="morebtn lessme">Read
                                    Less
                                </button>
                            </div>
                        </div> <!-- End MoreCancelBlock -->
                    </div> <!-- End Container -->
                </div>
                <?php if (!empty($reviews)){ ?>
                <div class="ratingsection">
                    <div class="container">
                        <div class="blockheading"><h2>Rating</h2></div> <!-- End BlockHeading -->
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="col-md-6"><p>Professionalism</p></div>
                            <div class="col-md-6">
			<span class="hotelstar">
			<?php

            $starValue = ceil($professionalismRate / sizeof($reviews));
            echo handleRating($starValue);
            ?>
			</span>
                            </div>
                        </div> <!-- End Column -->
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="col-md-6"><p>Money for value</p></div>
                            <div class="col-md-6">
			<span class="hotelstar">
				<?php
                $starValue = ceil($moneyRate / sizeof($reviews));
                echo handleRating($starValue);
                ?>
			</span>
                            </div>
                        </div> <!-- End Column -->
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="col-md-6"><p>Communication</p></div>
                            <div class="col-md-6">
			<span class="hotelstar">
			<?php
            $starValue = ceil($communicationRate / sizeof($reviews));
            echo handleRating($starValue);
            ?>
			</span>
                            </div>
                        </div> <!-- End Column -->
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="col-md-6"><p>Safety</p></div>
                            <div class="col-md-6">
			<span class="hotelstar">
			<?php
            $starValue = ceil($safetyRate / sizeof($reviews));
            echo handleRating($starValue);
            ?>
			</span>
                            </div>
                        </div> <!-- End Column -->
                    </div> <!-- End Container -->
                </div> <!-- End RatingSection -->
                <?php } ?>

<?php
                if (!empty($reviews)){

                echo $reviewHtml;

                }
                ?>


            </div> <!-- End Container -->
        </div> <!-- End ReviewSection -->
    </div> <!-- End WrapSection -->

    </div> <!-- End Row -->
    </div> <!-- End Container-Fluid -->
</section> <!-- End Content-Section -->

<div class="modal fade" id="recommend" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true" style="padding-right:0px !important;">
    <div class="modal-dialog recommend">
        <div class="recommend2">
            <div class="modal-content loginpop">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            &times;</span>
                    </button>
                    <h4 id="exampleModalLabel"><?php echo ucfirst($OverviewData['title']); ?></h4>
                    <p>You Are About To Recommend This Listing To A friend. You Will Be Notified As Soon As Your Friend
                        Follows Your
                        Recommendation And Rewarded After He Reviewed His Trip.</p>
                </div>
                <div class="modal-body">
                    <div class="tabbable">
                        <ul class="nav nav-tabs">
                            <li><a href="#tab1" data-toggle="tab">Share A Link</a></li>
                            <li class="active"><a href="#tab2" data-toggle="tab">Add To</a></li>
                            <li><a href="#tab3" data-toggle="tab">Embed</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane" id="tab1">
                                <?php $gmail_link = explode('&', $Listing_recommend_link); ?>
                                <form>
                                    <div class="form-group">
                                        <label for="recipient-name" class="control-label">Listing Link To Share</label>
                                        <input type="text" class="form-control" readonly
                                               value="<?php echo $Listing_recommend_link; ?>" id="recipient-name">
                                        <div class="social_tabs_popup_link">
                                            <a target='_blank' class="fa fa-twitter" target="_blank"
                                               href="https://twitter.com/home?status=<?php echo $Listing_recommend_link; ?>"></a>
                                            <a target='_blank' class="fa fa-envelope-o"
                                               href="mailto:?subject=You%20received%20a%20new%20recommendation%20from%20Gloobers&body=Hi,%0D%0A%0D%0AYou%20just%20received%20a%20new%20recommendation!%0D%0A%0D%0AClick%20on%20the%20following%20link%20or%20sign%20up%20on%20http://gloobers.com%20to%20view%20this%20recommendation.%0D%0A%0D%0A<?php echo $gmail_link[0]; ?>%0D%0A%0D%0ACheers,%0D%0A%0D%0AThe%20Gloobers%20team"></a>
                                            <a target='_blank' class="fa fa-google-plus"
                                               href="https://plus.google.com/share?url=<?php echo $Listing_recommend_link; ?>"></a>
                                            <a target='_blank' class="fa fa-facebook"
                                               href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $Listing_recommend_link; ?>"></a>

                                        </div>
                                    </div>
                                    <div class="modal-footer">

                                        <!-- <button type="submit" class="btn btn-primary btnsend" onclick="generateListingLink();">Generate Link</button>
									-->
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane active" id="tab2">

                                <form>
                                    <div class="form-group">
                                        <label for="recipient-name" class="control-label">A Travel Guide</label>
                                        <select id="_guideName" name="guideName" class="selectbox">
                                            <option value="0">Select Travel Guide</option>
                                            <?php foreach ($trevelGuideList as $guideList) { ?>
                                            <option value="<?php echo $guideList['tgid'] ?>"><?php echo $guideList['title']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <!--<input type="text" class="form-control" id="recipient-name">-->
                                    </div>
                                    <p>Note: Selected perticular listing will be added in your travel guide from here.
                                    </p>
                                </form>
                                <div class="guide_msg"></div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-default btncncl" data-dismiss="modal">Cancel
                                    </button>
                                    <button type="submit" class="btn btn-primary btnsend"
                                            onclick="addListingToTravelguide();">Add
                                    </button>
                                </div>

                            </div>
                            <div class="tab-pane" id="tab3">
                                <form>
                                    <div class="form-group">
                                        <label for="message-text" class="control-label">Copy Listing's Embed
                                            Code</label>
                                        <textarea readonly class="form-control" id="message-text"><a
                                                    class="embedly-card" href="<?php echo $Listing_recommend_link; ?>">Gloobers</a>
<script async src="<?php $base_url.'/'.drupal_get_path('theme', $GLOBALS['theme']); ?>/js/platform.js"
        charset="UTF-8"></script></textarea>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <style>
        #fullCalenderModal .modal-footer {
            border-top: 1px solid #f1f1f1;
            clear: both;
            margin-top: 70px;
            text-align: right;
        }

        #fullCalenderModal select {
            padding: 8px;
        }

        .fc-time-grid-event.fc-v-event.fc-event.fc-start.fc-end {
            cursor: pointer;
        }

        .fc-time {
            display: none;
        }
    </style>
    <div class="modal fade" id="fullCalenderModal11" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content loginpop">
                <div class="modal-header">
                    <button class="close" aria-label="Close" style="position:relative;top:-9px;" data-dismiss="modal"
                            type="button">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h3 id="information_block">Loading Please wait....</h3>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="rowbook">
                            <div id="travel_sec_cal" class="datesec"></div>
                            <div id="travel_sec2_cal" class="travelsec"></div>


                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="text-align: right;">
                    <p style="float: right;">
                        <button href="#" class="btn btn-success" id="updateFullCalenderEventSession">Done</button>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div id="person_qty_ext"></div>
<input type="hidden" value="" name="qty_Max" id="qty_Max"/>
<input type="hidden" value="" name="qty_Min" id="qty_Min"/>
<?php
$totalCredits = get_total_credits();
if (isset($totalCredits)){
$credit_per_Dollar = variable_get('credit_value');
$availble_gloobies = ($totalCredits/$credit_per_Dollar);
//$availble_gloobies=intval($availble_gloobies);
$availble_gloobies = number_format(floor($availble_gloobies*100)/100, 2, '.', '');
}else{
$availble_gloobies = 0;
}
?>

<div class="popuplightbox"></div>
<div class="recommendlightbox">
    <div class="popuppanelblock"><span class="recomendation_close_btn cancelbtn">X</span>
        <div class="popuppanelblock_inner">
            <h1>Recommend this listing</h1>
            <div class="paratext">
                <p>You are about to recommend this listing to a friend. You will be notified as soon as your friend
                    follows your recommendation and rewarded after he will execute his trip.</p>
            </div> <!-- End ParaText -->

            <div class="recommendlinkblock">
                <div class="col-md-12">
                    <div class="row">
                        <h3>Share this recommendation link</h3>
                        <fieldset>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <div class="clipboard">
                                    <input name="input" id="dynamic1" readonly="" type="text"
                                           value="<?php echo $Listing_recommend_link; ?>">
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <a class="actionbtn btn" data-clipboard-action="copy" data-clipboard-target="#dynamic1"
                                   id="copy-dynamic1" href="javascript:void(0);">Copy</a>
                                <!--<a class="actionbtn"  id="copy-dynamic" href="javascript:void(0);">Copy</a>-->
                            </div>
                        </fieldset>
                    </div> <!-- End Row -->
                </div> <!-- End Col -->
            </div> <!-- End recommendlinkblock -->
            <div class="recommendlinkblock">
                <div class="social_tabs_popup_link">
                    <a target='_blank' class="fa fa-twitter" target="_blank"
                       href="<?php echo $twitter_recommend_link; ?>"></a>
                    <!--a target='_blank' class="fa fa-twitter" target="_blank" href="http://gloobers.com/sites/all/themes/gloobers_new/twitterOauthwithImagePost/callback.php?msg=I+am+checking+image&media=http://gloobers.com/sites/default/files/slide1.jpg&redirect=1"></a-->
                    <a target='_blank' class="fa fa-envelope-o" href="mailto:?subject=You%20received%20a%20new%20recommendation%20from%20Gloobers&body=
		Hi,%0D%0A%0D%0AYou%20just%20received%20a%20new%20recommendation!%0D%0A%0D%0AClick%20on%20the%20following%20link%20or%20sign%20up%20on%20http://gloobers.com%20to%20view%20this%20recommendation.%0D%0A%0D%0A<?php echo $gmail_link[0]; ?>%0D%0A%0D%0ACheers,%0D%0A%0D%0AThe%20Gloobers%20team"></a>
                    <a target='_blank' class="fa fa-google-plus"
                       href="https://plus.google.com/share?url=<?php echo $Listing_recommend_link; ?>"></a>
                    <a target='_blank' class="fa fa-facebook"
                       href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $Listing_recommend_link; ?>"></a>
                </div>
            </div>
            <div class="recommendlinkblock">
                <div class="col-md-12">
                    <div class="row">
                        <h3>Embed this recommendation</h3>
                        <p>Embed this recommendation onto your website or blog, get rewarded for every booking you
                            generate.</p>
                        <textarea readonly="" class="form-control" id="message-text">
<div id="glooberUp" class='10030208_67677' style="float:left;text-align:center;width:100%">
<div style="background:#efefef;padding:10px;max-width:600px;display:inline-block">
<a href="<?php echo $Listing_recommend_link; ?>"><img src="<?php echo $FBsrc; ?>"
                                                      style="width:100%;border:0;outline:0;margin-bottom:10px" alt=""
                                                      title="">
</a><p style="color:#414141;font-size:20px;font-family:arial;font-weight:bold;margin:0px">Gloobers.com - <?php print t(ucfirst($OverviewData['title'])) . ' '.t(ucfirst($OverviewData['city'])) . ', '. t(ucfirst($OverviewData['country'])); ?></p>
<p style="color:#414141;font-size:16px;font-family:arial;">Be friendly - Travel for free. Travel for free thanks to your helpful recommendations. Drop us your email and be the first to know when we launch. Stay tuned on. </p>
</div></div>
</textarea>
                    </div> <!-- End Row -->
                </div> <!-- End Col -->
            </div> <!-- End recommendlinkblock -->

            <div class="payableBtns recommendBtns">
                <div class="col-md-9 col-md-offset-3 no_padding">
                    <input type="submit" name="confirm" value="Ok" class="totalpayee cancelbtn"/>
                    <span class="cancelbtn">Cancel</span>
                </div> <!-- End Col -->
            </div> <!-- End PayableBtns --></div>
    </div> <!-- End PopupPanelBlock -->
</div> <!-- End RecommendLightBox -->

<div class="bookinglightbox">
    <div class="popuppanelblock">
        <h1>Book this listing</h1>
        <div class="paratext">
            <p>You are about to book this listing. You can use your gloobies to get an exclusive discount. Choose the
                amount of gloobies you want to use and confirm your reservation. Your credit card details may be needed
                for deposit purposes.
        </div> <!-- End ParaText -->

        <div class="amountpayableblock">
            <div class="col-md-12">
                <div class="row">
                    <div class="amountfields">
                        <div class="col-md-6 col-sm-6 col-xs-6"><label>Total</label></div>
                        <div class="col-md-6 col-sm-6 col-xs-6" id="Total_Amt"><h4>$0</h4></div>
                    </div> <!-- End AmountFields -->
                    <div class="amountfields">
                        <?php $service_tax = variable_get('service_tax'); ?>
                        <div class="col-md-6 col-sm-6 col-xs-6"><label>Gloobers service
                                fees(<?php echo $service_tax.'%'; ?>)</label></div>
                        <div class="col-md-6 col-sm-6 col-xs-6" id="service_fees"><h4></h4></div>
                    </div> <!-- End AmountFields -->

                    <div class="amountfields">
                        <div class="col-md-6 col-sm-6 col-xs-6"><label>Available gloobies(<?php echo $totalCredits; ?>
                                )</label></div>
                        <div class="col-md-6 col-sm-6 col-xs-6"><h4 class="colorblue">
                                $<?php echo $availble_gloobies; ?></h4></div>
                    </div> <!-- End AmountFields -->
                    <?php ?>
                    <div class="amountfields">
                        <div class="col-md-6 col-sm-6 col-xs-6"><label>Pay in gloobies</label></div>
                        <div class="col-md-6 col-sm-6 col-xs-6 no_padding">
                            <input type="text" name="payin" class="payableamount" id="minMax" value=""
                                   onkeyup="this.value = minmax(this.value, 0,'<?php echo $availble_gloobies; ?>')"/>
                        </div>
                    </div> <!-- End AmountFields -->
                </div> <!-- End Row -->
            </div> <!-- End Col -->
        </div> <!-- End AmountPayableBlock -->

        <div class="amountcreditblock">
            <div class="amountfields">
                <div class="col-md-6 col-sm-6 col-xs-6"><label>Amount due in credit card</label></div>
                <div class="col-md-6 col-sm-6 col-xs-6" id="Pending_credits_amt"><h4>
                        <strong><?php echo '$'.$availble_gloobies; ?></strong></h4></div>
            </div> <!-- End AmountFields -->
        </div> <!-- End AmountCreaditBlock -->

        <div class="payableBtns">
            <div class="col-md-9 col-md-offset-3">
                <input type="submit" name="confirm" onclick="return confirmCredits();" value="Confirm"
                       class="totalpayee"/>
                <span class="cancelbtn">Cancel</span>
            </div> <!-- End Col -->
        </div> <!-- End PayableBtns -->
    </div> <!-- EndBookingPanelBlock -->
</div> <!-- End BookingLightBox -->
<script type="text/javascript">
    function getBookingQuantity() {
        var countTotal = 0;
        <?php if(isset($_SESSION['order']['item_type'])){ ?>

        jQuery('select[class^="Per_item_qty"]').each(function () {
            countTotal = parseInt(jQuery(this).val()) + parseInt(countTotal);
        });
        <?php }else{ ?>

        jQuery('select[class^="Per_person_qty"]').each(function () {
            countTotal = parseInt(jQuery(this).val()) + parseInt(countTotal);
        });
        <?php } ?>
        var qty_Max = jQuery('#qty_Max').val();
        var qty_Min = jQuery('#qty_Min').val();
        var selected_booking_date = jQuery('#avail-dates').val();
        var selected_booking_time = jQuery('#time-select').val();
        var listing_id =<?php echo arg(1); ?>;
        jQuery.ajax({
            url: $baseUrl + '/experience/ajax/checkAvailableseats',
            type: 'post',
            async: false,
            data: {
                selected_booking_time: selected_booking_time,
                selected_booking_date: selected_booking_date,
                listing_id: listing_id
            },
            success: function (data) {
                //alert(data);
                console.log(data);
                console.log(qty_Max);
                console.log(qty_Max);
                if ((parseInt(data) > parseInt(qty_Max)) || (parseInt(data) > parseInt(qty_Min))) {
                    window.location.href = $baseUrl + '/booking/summary';
                } else {
                    alert('Please select number of travellers between ' + qty_Min + ' to ' + qty_Max + ' range.');

                }
            }
        });
    }

    jQuery(".travelers").click(function () {
        if (jQuery('#time-select').val() == '') {
            alert('Please select time.');
            return false;
        } else {
            var timepickerVal = jQuery('#time-select').val();
        }
    })
    function getPricing_newData(timechange) {

        time_changes_var = 'No';
        if (timechange == 'timechange') {
            time_changes_var = 'yes';
        }
        console.log('timechange' + time_changes_var);
        /* New Get Dynamic Pricing ON each New Time and Date Select 29Sep2015 */
        var selected_booking_date = jQuery('#avail-dates').val();
        if (selected_booking_date == 'No dates available') {
            return false;
        }

        if (jQuery('.totalamount').find('h4')[0].innerHTML != '$0') {
            jQuery('.totalamount').find('h4').html('$0');
            jQuery('.css-checkbox').attr('checked', false);
        }
        if (jQuery('#time-select').val() == '') {
            // your code here.
            jQuery('#load-screen').hide();
            return false;
        } else {
            var timepickerVal = jQuery('#time-select').val();
        }
        var selected_booking_time = jQuery('#time-select').val();

        jQuery('#load-screen').show();

        var user_booking_details =<?php echo json_encode($user_booking_details); ?>;

        var listing_id =<?php echo arg(1); ?>;
        jQuery.ajax({
            url: $baseUrl + '/experience/ajax/getNewPricingData',
            type: 'post',
            async: false,
            data: {
                selected_booking_time: timepickerVal,
                selected_booking_date: selected_booking_date,
                listing_id: listing_id,
                time_changes: time_changes_var
            },

            success: function (data) {
                jQuery('.exp_trave_blk').show();
                var data = jQuery.parseJSON(data);
                var status = data.status;
                var mydata = data.data;
                var priceDetail = data.pricingDetail;

                var check_booking_dtls = data.user_booking_details;
                if (check_booking_dtls == null) {
                    console.log("session destroyed");
                    user_booking_details = '';
                }

                jQuery('#travel_sec2').html('');
                jQuery('#new_price_status').val('new');

                var c = 1;
                var sizeOfPrice = mydata.length;

                jQuery.each(mydata, function (index, value) {
                    var priceType = value.price_type;
                    if (priceType == 'PER_PERSON') { //Per person
                        var trevellerType = value.price_option_type;
                        var quantity_min = value.quantity_min;
                        var quantity_max = value.quantity_max;
                        jQuery('#qty_Max').val(quantity_max);
                        jQuery('#qty_Min').val(quantity_min);

                        if (status == 'sessional') {

                            if (trevellerType == 'Adult') {
                                value.price = priceDetail.rate_per_adult;
                            } else {
                                value.price = priceDetail.rate_per_child;
                            }
                        }

                        if (trevellerType == 'Adult') {
                            cq = 1;
                        } else {
                            cq = 2;
                        }

                        var quantkey = c;
                        var opt = '<option value="0">Select</option>';
                        for (j = parseInt(quantity_min); j <= parseInt(quantity_max); j++) {
                            opt += '<option value=' + j + '>' + j + '</option>'
                        }
                        jQuery('#travel_sec2').append("<div class='form-group col-md-6 col-sm-6 col-xs-6'><input id='person_type_box_" + cq + "' type='hidden' value='" + trevellerType + "' name='personType'><input id='person_box_" + cq + "' type='hidden' value='" + value.price + "' name='personType'><label class='saparate_persontype'>" + trevellerType + "</label><span class='saparate_persontype'><select id='person_qty_" + cq + "' class='Per_person_qty select_box person_qty_" + cq + "' onchange='get_travellers_new(\"PER_PERSON\"," + value.price + "," + cq + ");' name='input_travelers'>" + opt + "</select></span></div>");
                        var opt = '';
                        c++;
                        jQuery("#per_it_type").val(btoa("PER_PERSON"));

                        /*If booking session has value */
                        if (user_booking_details) {
                            if (user_booking_details['person_type']) {
                                if (trevellerType == 'Adult' && user_booking_details['person_type']['Adult']) {
                                    var session_values = user_booking_details['person_type']['Adult']['qty'];
                                } else if (trevellerType == 'Child' && user_booking_details['person_type']['Child']) {
                                    var session_values = user_booking_details['person_type']['Child']['qty'];
                                }

                                jQuery('#person_qty_' + cq).val(session_values);
                                jQuery('#person_qty_' + cq).selectbox('detach').selectbox('attach');
                            }


                            var mainSubtotal = user_booking_details['Mainsubtotal'];
                            jQuery('.totalamount').find('h4').html('$' + mainSubtotal);
                            jQuery('#Total_Amt').find('h4').html('$' + mainSubtotal);
                            var service_tax = '<?php echo variable_get('service_tax'); ?>';
                            var payamount_tax_price = ((mainSubtotal * service_tax) / 100);
                            var TaxablePrice = (parseFloat(payamount_tax_price) + parseFloat(mainSubtotal));
                            payamount_tax_price = payamount_tax_price.toFixed(2);
                            jQuery('#service_fees').find('h4').html('$' + payamount_tax_price);
                            TaxablePrice = TaxablePrice.toFixed(2);
                            jQuery('#Pending_credits_amt').find('h4').html('<strong>$' + TaxablePrice + '</strong>');

                        }

                    } else {
                        var trevellerType = value.label;
                        var price = value.price;

                        var quantity_min = parseInt(value.quantity_min);
                        var quantity_max = parseInt(value.quantity_max);
                        jQuery('#qty_Max').val(quantity_max);
                        jQuery('#qty_Min').val(quantity_min);

                        if (status == 'sessional') {

                            price = priceDetail.rate_per_item;
                        }

                        //22/3/2016
                        var quantity_adults_per_item_max = parseInt(value.adults_per_item_max);
                        var quantity_child_per_item_max = parseInt(value.child_per_item_max);
                        var availiblitymax_val = atob(jQuery('#availiblitymax').val());
                        var availiblitymin_val = atob(jQuery('#availiblitymin').val());

                        //end 22/3/2016

                        var childMax = parseInt(value.child_per_item_max);
                        if (value.child_per_item_min == null) {
                            childMin = 0;
                        } else {
                            childMin = parseInt(value.child_per_item_min);
                        }
                        var adultMin = parseInt(value.adults_per_item_min);
                        if (value.child_per_item_min == null) {
                            adultMin = 0;
                        } else {
                            adultMin = parseInt(value.child_per_item_min);
                        }
                        var adultMax = parseInt(value.adults_per_item_max) * availiblitymax_val;
                        var quantkey = c;

                        var opt = '<option value="0">Select</option>';
                        var apt = '<option value="0">Select</option>';
                        var cpt = '<option value="0">Select</option>';

                        for (j = availiblitymin_val; j <= availiblitymax_val; j++) {
                            opt += '<option value=' + j + '>' + j + '</option>'
                        }
                        for (cd = childMin; cd <= childMax; cd++) {
                            cpt += '<option value=' + cd + '>' + cd + '</option>'
                        }
                        for (ad = adultMin; ad <= adultMax; ad++) {
                            apt += '<option value=' + ad + '>' + ad + '</option>'
                        }

                        var costantZ = 20;
                        var variableZ = sizeOfPrice;
                        if (c > 1) {
                            var temp = (c - 1);
                        } else {
                            var temp = 0;
                        }
                        var FinalZParent = ((parseInt(variableZ) + costantZ) - parseInt(temp));
                        var FinalZ = (FinalZParent - 1);
                        var varibleClass = 'wrapitem' + c;
                        var varibleClassP = 'wrapitemP' + c;


                        jQuery('#travel_sec2').append("<div class='form-group col-md-6 col-sm-6 col-xs-6 " + varibleClass + "'><label class='saparate_persontype'>Adults</label><span class='saparate_persontype'><select class='Per_item_qty select_box person_qty_adult' id='person_qty_adult_" + c + "' onchange='get_travellers_new(\"PER_ITEM\"," + price + "," + c + "," + quantity_adults_per_item_max + "," + quantity_child_per_item_max + "," + childMin + ");' name='adult_allowed'>" + apt + "</select></span></div><div class='form-group col-md-6 col-sm-6 col-xs-6 " + varibleClass + "'><label class='saparate_persontype'>Child</label><span class='saparate_persontype'><select class='Per_item_qty select_box person_qty_child' id='person_qty_child_" + c + "' onchange='get_travellers_new(\"PER_ITEM\"," + price + "," + c + "," + quantity_adults_per_item_max + "," + quantity_child_per_item_max + ");' name='child_allowed'>" + cpt + "</select></span></div><div class='form-group col-md-12 col-sm-12 col-xs-12 " + varibleClassP + "'><input id='person_type_box_" + c + "' type='hidden' value='" + trevellerType + "' name='personType'><input id='person_box_" + c + "' type='hidden' value='" + price + "' name='personType'><label class='saparate_persontype'>" + trevellerType + "</label><span class='saparate_persontype'><select id='person_qty_" + c + "' onchange='get_travellers_new1(\"PER_ITEM\"," + price + "," + c + "," + quantity_adults_per_item_max + "," + quantity_child_per_item_max + "," + adultMin + "," + childMin + ");' name='input_travelers' class='select_box item_selectbox'>" + opt + "</select></span></div>");


                        jQuery('.' + varibleClassP).css('z-index', FinalZParent);
                        jQuery('.' + varibleClass).css('z-index', FinalZ);
                        c++;

                        jQuery("#per_it_type").val(btoa("PER_ITEM"));

                        /*If booking session has value */
                        if (user_booking_details) {

                            jQuery.each(user_booking_details['item_type'], function (index, value) {
                                console.log('user_booking_details' + value.price);
                                jQuery('#person_qty_adult_1').val(value.person_qty_adult);
                                jQuery('#person_qty_adult_1').selectbox('detach').selectbox('attach');

                                jQuery('#person_qty_child_1').val(value.person_qty_child);
                                jQuery('#person_qty_child_1').selectbox('detach').selectbox('attach');

                                jQuery('#person_qty_1').val(value.qty);
                                jQuery('#person_qty_1').selectbox('detach').selectbox('attach');
                            });

                            var mainSubtotal = user_booking_details['Mainsubtotal'];
                            jQuery('.totalamount').find('h4').html('$' + mainSubtotal);
                            jQuery('#Total_Amt').find('h4').html('$' + mainSubtotal);
                            var service_tax = '<?php echo variable_get('service_tax'); ?>';
                            var payamount_tax_price = ((mainSubtotal * service_tax) / 100);
                            var TaxablePrice = (parseFloat(payamount_tax_price) + parseFloat(mainSubtotal));
                            payamount_tax_price = payamount_tax_price.toFixed(2);
                            jQuery('#service_fees').find('h4').html('$' + payamount_tax_price);
                            TaxablePrice = TaxablePrice.toFixed(2);
                            jQuery('#Pending_credits_amt').find('h4').html('<strong>$' + TaxablePrice + '</strong>');

                        }
                    }
                    sizeOfPrice--;
                });

                jQuery('#load-screen').hide();
            },
            complete: function () {
                jQuery("select").selectbox({
                    onOpen: function (inst) {
                        jQuery(this).parents('.form-group').addClass('travel_sec2');
                    },
                    onClose: function (inst) {
                        jQuery(this).parents('.form-group').removeClass('travel_sec2');
                    },
                });
                //jQuery('.item_selectbox').selectbox('disable');
            },
            error: function () {
                alert('request failed please try again');
                jQuery("#load-screen").css('display', 'none');
            }

        });
        /* END New Get Dynamic Pricing ON each New Time and Date Select */
    }
    function get_travellers_new(priceType, price, quantkey, adult_max, child_max, childMin) {
        jQuery('#load-screen').show();

        console.log(jQuery('#new_price_status').val());
        var status_new = jQuery('#new_price_status').val();
        if (jQuery('#new_price_status').val() == 'new') {
            jQuery('#new_price_status').val('old');
        }

        if (adult_max) {
            adult_max_val = adult_max;
        } else {
            adult_max_val = 0;
        }
        if (child_max) {
            child_max_val = child_max;

        } else {
            child_max_val = 0;
        }
        var actual_price = price;

        var optionSelected = jQuery('#person_qty_' + quantkey).val();
        var optionSelected_modify = jQuery('#person_qty_' + quantkey).next('div').children('.sbSelector').html();
        var price = price;
        var calculatedPrice = parseInt(price * optionSelected_modify);
        var personType = jQuery('#person_type_box_' + quantkey).val();
        var person_qty_child = '';
        var person_qty_adult = '';

        if (priceType == "PER_PERSON") {
            person_qty_adult = jQuery('.exp_trave_blk').find('select.person_qty_1').parent().find('a.sbSelector').text();
            person_qty_child = jQuery('.exp_trave_blk').find('select.person_qty_2').parent().find('a.sbSelector').text();
        } else {

            person_qty_adult = jQuery('.exp_trave_blk').find('select.person_qty_adult').parent().find('a.sbSelector').text();
            person_qty_child = jQuery('.exp_trave_blk').find('select.person_qty_child').parent().find('a.sbSelector').text();

            /*jQuery('.exp_trave_blk').find('select.person_qty_adult').each(function(){
             person_qty_adult = parseInt(jQuery(this).parent().find('a.sbSelector').text());
             });

             jQuery('.exp_trave_blk').find('select.person_qty_child').each(function(){
             person_qty_child = parseInt(jQuery(this).parent().find('a.sbSelector').text());
             });	*/
            if (childMin >= 0) {
                person_qty_child = childMin;
            }

        }
        console.log('childMin ' + childMin);

        if (jQuery.trim(person_qty_adult) == "Select") {

            person_qty_adult = 0;

            if (priceType == "PER_ITEM") {
                person_qty_child = 0;
                alert('Please select atleast one Adult.');
                jQuery('.person_qty_2').val('');
                jQuery('.person_qty_2').selectbox('detach').selectbox('attach');
                status_new = 'new';
                childMin = 0;
            }

            //jQuery('#load-screen').hide();
            //return false;

            /*person_qty_adult=0;
             jQuery('#load-screen').hide();
             return false;*/

        }
        if (jQuery.trim(person_qty_child) == "Select") {

            person_qty_child = 0;

        }


        var availiblitymaxval = atob(jQuery('#availiblitymax').val());
        var occupancymax = jQuery('#qty_Max').val();

        if (childMin >= 0) {
            var cpt = '';
            var child_limit = parseInt(child_max) * parseInt(person_qty_adult);
            var child_max_limit = parseInt(availiblitymaxval) * parseInt(child_max);
            console.log(child_max_limit);
            if (child_limit >= child_max_limit) {
                child_limit = child_max_limit;
            }

            if (person_qty_adult > availiblitymaxval) {
                child_limit = parseInt(availiblitymaxval) * parseInt(occupancymax) - parseInt(person_qty_adult);
            }

            for (cd = childMin; cd <= child_limit; cd++) {
                cpt += '<option value=' + cd + '>' + cd + '</option>'
            }
            jQuery('.exp_trave_blk').find('select.person_qty_child').html(cpt);
            jQuery('.person_qty_child').selectbox('detach');
            jQuery(".person_qty_child").selectbox({
                onOpen: function (inst) {
                    jQuery(this).parents('.form-group').addClass('travel_sec2');
                },
                onClose: function (inst) {
                    jQuery(this).parents('.form-group').removeClass('travel_sec2');
                },
            });

        }


        jQuery.ajax({
            url: $baseUrl + '/ajax/SavePriceSessionCart',
            type: 'post',
            async: false,
            data: {
                quantity: optionSelected_modify,
                persontype: personType,
                priceType: priceType,
                calculatedPrice: calculatedPrice,
                person_qty_adult: person_qty_adult,
                person_qty_child: person_qty_child,
                status: 1,
                adult_max: adult_max_val,
                child_max: child_max_val,
                price: actual_price,
                occupancy_max: occupancymax,
                status_new_val: status_new
            },
            success: function (data) {
                var data = jQuery.parseJSON(data);
                var mainSubtotal = data.Mainsubtotal;
                jQuery('.totalamount').find('h4').html('$' + mainSubtotal);
                jQuery('#Total_Amt').find('h4').html('$' + mainSubtotal);
                var service_tax = '<?php echo variable_get('service_tax'); ?>';
                var payamount_tax_price = ((mainSubtotal * service_tax) / 100);
                var TaxablePrice = (parseFloat(payamount_tax_price) + parseFloat(mainSubtotal));
                payamount_tax_price = payamount_tax_price.toFixed(2);
                jQuery('#service_fees').find('h4').html('$' + payamount_tax_price);
                TaxablePrice = TaxablePrice.toFixed(2);
                jQuery('#Pending_credits_amt').find('h4').html('<strong>$' + TaxablePrice + '</strong>');

                if (priceType == "PER_ITEM") {

                    jQuery.each(data.item_type, function (index, value) {
                        console.log(person_qty_child);

                        if (person_qty_adult <= availiblitymaxval) {
                            item_qty_max = person_qty_adult;
                        } else {
                            item_qty_max = availiblitymaxval;
                        }

                        var opt = '';
                        for (j = value.qty; j <= item_qty_max; j++) {
                            opt += '<option value=' + j + '>' + j + '</option>'
                        }

                        jQuery('.exp_trave_blk').find('select.item_selectbox').html(opt);

                        jQuery('.item_selectbox').val(value.qty);
                        jQuery('.item_selectbox').selectbox('detach');

                        jQuery(".item_selectbox").selectbox({
                            onOpen: function (inst) {
                                jQuery(this).parents('.form-group').addClass('travel_sec2');
                            },
                            onClose: function (inst) {
                                jQuery(this).parents('.form-group').removeClass('travel_sec2');
                            },
                        });

                    });
                }


                jQuery('#load-screen').hide();
            },

            error: function () {
                alert('request failed please try again');
                jQuery("#load-screen").css('display', 'none');
            }
        });
    }

    /// 29 march 2016
    function get_travellers_new1(priceType, price, quantkey, adult_max, child_max, adultMin, childMin) {
        jQuery('#load-screen').show();

        var actual_price = price;

        var optionSelected = jQuery('#person_qty_' + quantkey).val();
        var optionSelected_modify = jQuery('#person_qty_' + quantkey).next('div').children('.sbSelector').html();
        var price = price;
        var calculatedPrice = parseInt(price * optionSelected_modify);
        var personType = jQuery('#person_type_box_' + quantkey).val();
        var person_qty_child = '';
        var person_qty_adult = '';

        if (priceType == "PER_PERSON") {
            person_qty_adult = jQuery('.exp_trave_blk').find('select.person_qty_1').parent().find('a.sbSelector').text();
            person_qty_child = jQuery('.exp_trave_blk').find('select.person_qty_2').parent().find('a.sbSelector').text();
        } else {

            person_qty_adult = jQuery('.exp_trave_blk').find('select.person_qty_adult').parent().find('a.sbSelector').text();
            person_qty_child = jQuery('.exp_trave_blk').find('select.person_qty_child').parent().find('a.sbSelector').text();

            /*jQuery('.exp_trave_blk').find('select.person_qty_adult').each(function(){
             person_qty_adult = parseInt(jQuery(this).parent().find('a.sbSelector').text());
             });

             jQuery('.exp_trave_blk').find('select.person_qty_child').each(function(){
             person_qty_child = parseInt(jQuery(this).parent().find('a.sbSelector').text());
             });	*/

        }

        if (jQuery.trim(person_qty_adult) == "Select") {

            person_qty_adult = 0;
            jQuery('#load-screen').hide();
            return false;

        }
        if (jQuery.trim(person_qty_child) == "Select") {

            person_qty_child = 0;

        }


        console.log("ad:" + person_qty_adult);
        console.log("cd:" + person_qty_child);

        var item_box_case = "item_box_case";


        jQuery.ajax({
            url: $baseUrl + '/ajax/SavePriceSessionCart',
            type: 'post',
            async: false,
            data: {
                quantity: optionSelected_modify,
                persontype: personType,
                priceType: priceType,
                calculatedPrice: calculatedPrice,
                person_qty_adult: person_qty_adult,
                person_qty_child: person_qty_child,
                status: 1,
                price: actual_price,
                item_boxcase: item_box_case
            },
            success: function (data) {
                var data = jQuery.parseJSON(data);
                var mainSubtotal = data.Mainsubtotal;
                jQuery('.totalamount').find('h4').html('$' + mainSubtotal);
                jQuery('#Total_Amt').find('h4').html('$' + mainSubtotal);
                var service_tax = '<?php echo variable_get('service_tax'); ?>';
                var payamount_tax_price = ((mainSubtotal * service_tax) / 100);
                var TaxablePrice = (parseFloat(payamount_tax_price) + parseFloat(mainSubtotal));
                payamount_tax_price = payamount_tax_price.toFixed(2);
                jQuery('#service_fees').find('h4').html('$' + payamount_tax_price);
                TaxablePrice = TaxablePrice.toFixed(2);
                jQuery('#Pending_credits_amt').find('h4').html('<strong>$' + TaxablePrice + '</strong>');

                if (priceType == "PER_ITEM") {

                    jQuery.each(data.item_type, function (index, value) {
                        jQuery('.item_selectbox').val(value.qty);
                        //jQuery('.item_selectbox').selectbox('detach').selectbox('attach').selectbox('disable');
                        jQuery('.item_selectbox').selectbox('detach').selectbox('attach');
                        jQuery('.item_selectbox').parents('.form-group').removeClass('travel_sec2');
                    });


                    /*	if(adultMin){
                     var apt='';
                     var adult_limit=parseInt(optionSelected_modify)*parseInt(adult_max);
                     jQuery('.person_qty_adult').val(adult_limit);
                     jQuery('.person_qty_adult').selectbox('detach');
                     jQuery(".person_qty_adult").selectbox({
                     onOpen: function (inst) {
                     jQuery(this).parents('.form-group').addClass('travel_sec2');
                     },
                     onClose: function (inst) {
                     jQuery(this).parents('.form-group').removeClass('travel_sec2');
                     },
                     });

                     }


                     if(childMin>=0){
                     var cpt='';
                     var availiblitymaxval=atob(jQuery('#availiblitymax').val());
                     var child_max_limit=parseInt(availiblitymaxval)*parseInt(child_max);
                     console.log(child_max_limit);

                     for(cd=childMin;cd<=child_max_limit;cd++){
                     cpt +='<option value='+cd+'>'+cd+'</option>'
                     }
                     jQuery('.exp_trave_blk').find('select.person_qty_child').html(cpt);
                     jQuery('.person_qty_child').selectbox('detach');

                     var child_limit=parseInt(optionSelected_modify)*parseInt(child_max);
                     console.log(child_limit);
                     jQuery('.person_qty_child').val(child_limit);
                     //jQuery('.person_qty_child').selectbox('detach').selectbox('attach');

                     jQuery('.person_qty_child').selectbox('detach');
                     jQuery(".person_qty_child").selectbox({
                     onOpen: function (inst) {
                     jQuery(this).parents('.form-group').addClass('travel_sec2');
                     },
                     onClose: function (inst) {
                     jQuery(this).parents('.form-group').removeClass('travel_sec2');
                     },
                     });

                     }*/

                }


                jQuery('#load-screen').hide();
            },
            error: function () {
                alert('request failed please try again');
                jQuery("#load-screen").css('display', 'none');
            }
        });
    }
    /// 29 march 2016
    function updateCart(value) {

        //value = jQuery.parseJSON(value);
        var type = (value.priceType);
        var sessKey = (value.sessKey);
        var quantKey = (value.quantkey);
        console.log(quantKey)
        //alert(quantKey);
        var sessKeyWithEl = '';
        try {
            sessKeyWithEl = sessKey.trim().replace(/["~!@#$%^&*\(\)_+=`{}\[\]\|\\:;'<>,.\/?"\- \t\r\n]+/g, '_');
        } catch (err) {
            sessKeyWithEl = sessKey;
        }
        //alert(value.block_name);
        if (value.block_name == 'tblBlockServices') {
            var block = (value.block_name) + '_' + sessKey;
        } else {
            var block = (value.block_name) + '_' + quantKey;
        }
        jQuery.ajax({
            url: $baseUrl + '/experience/ajax/updateCart',
            type: 'post',
            data: {type: type, value: quantKey, sessKey: sessKey},
            beforeSend: function () {
                preLoading('show', 'load-screen_details');
            },
            success: function (data) {
                jQuery('.' + block).remove();
                calculateGrandTotal();
            },
            complete: function () {
                preLoading('hide', 'load-screen_details');
            }
        });
    }

    var circle, map, cityCircle;
    function initializeMap() {
        var centerLatlng = new google.maps.LatLng(<?php echo $OverviewData['latitude'] . "," . $OverviewData['longitude']; ?>);

        map = new google.maps.Map(document.getElementById('map-canvas'), {
            'zoom': 15,
            'center': centerLatlng,
            'mapTypeId': google.maps.MapTypeId.ROADMAP,
            disableDefaultUI: true
        });
        map.setOptions({
            draggable: false,
            scrollwheel: false,
            click: false,
            dblclick: false,
            panControl: false,
            disableDoubleClickZoom: true
        });
        var populationOptions = {
            strokeColor: '#FF0000',
            strokeOpacity: 0.1,
            strokeWeight: 1,
            fillColor: '#FF0000',
            fillOpacity: 0.2,
            map: map,
            //center: citymap[city].center,
            center: centerLatlng,
            radius: 500
        };
        cityCircle = new google.maps.Circle(populationOptions);
        google.maps.event.addListenerOnce(map, 'idle', function () {
            google.maps.event.trigger(map, 'resize');
            map.setCenter(centerLatlng);
        });
    }
    function calculateGrandTotal() {
        var grandTotal = 0;
        jQuery('.grand_total_price').each(function () {
            grandTotal += parseFloat(jQuery(this).attr('for'));
        });
        if (grandTotal > 0) {
            html = '<div class="col">\n\<label>Deposit</label>\n\<label class="small">$' + jQuery('#security_deposit_hidden').val() + '</label>\n\</div>\n\<div class="col">\n\<label><span>Gross Total</span></label>\n\<label class="small"><span>$' + grandTotal + '</span></label>\n\</div>';
            jQuery('#orderGrandTotalDetails').html(html);
            jQuery('.from_order_submit_btn').fadeIn();
            jQuery('.optionalsec').fadeIn();
        } else {
            jQuery('#orderGrandTotalDetails').html('');
            jQuery('.from_order_submit_btn').css('display', 'none');
        }
    }
    function calculateOfferTotal() {
        var grandTotal = 0;
        jQuery('.grand_total_price').each(function () {
            grandTotal += parseFloat(jQuery(this).attr('for'));
        });
        if (grandTotal > 0) {
            html = '<div class="col">\n\<label>Deposit</label>\n\<label class="small">$' + jQuery('#security_deposit_hidden').val() + '</label>\n\</div>\n\<div class="col">\n\<label><span>Gross Total</span></label>\n\<label class="small"><span>$' + grandTotal + '</span></label>\n\</div>';
            jQuery('#orderGrandTotalDetails').html(html);
            jQuery('.from_order_submit_btn').fadeIn();
            jQuery('.optionalsec').fadeIn();
        } else {
            jQuery('#orderGrandTotalDetails').html('');
            jQuery('.from_order_submit_btn').css('display', 'none');
        }

        jQuery.ajax({
            url: $baseUrl + '/experience/ajax/updateOfferPrice',
            type: 'post',
            async: false,
            data: {grandTotal: grandTotal},
            beforeSend: function () {
                preLoading('show', 'load-screen_details');
            },
            success: function (data) {
                var data = jQuery.parseJSON(data);
                if (data.disscountedAmount != null) {
                    if (data.disscountBy == '$') {
                        var datediss = data.disscountBy;
                    } else {
                        var datediss = data.disscountBy + ' ($' + data.disscountedAmount + ')';
                    }
                    jQuery('#offers_apply').html('<div class="col offerDiv"><label>' + data.offerType + ' Discount</label><label class="small">' + data.amount + '' + datediss + '</label></div>');
                }
            },
            complete: function () {
                preLoading('hide', 'load-screen_details');
            }
        });
    }

    function returndate(d) {
        var curr_date = d.getDate();
        var curr_month = d.getMonth() + 1;
        var curr_year = d.getFullYear();
        var month_date = curr_year + '-' + curr_month + '-' + curr_date;
        return month_date;
    }


    jQuery("#avail-dates").on("dp.change", function (e) {
        jQuery('#load-screen').show();
        if (jQuery('.totalamount').find('h4')[0].innerHTML != '$0') {
            jQuery('.totalamount').find('h4').html('$0');
            jQuery('.css-checkbox').attr('checked', false);
        }
        var date = (e.delegateTarget.value);
        if (date != "") {

            var d = new Date(date);
            var monthdate = returndate(d);

            jQuery.ajax({

                url: $baseUrl + "/session/timings",

                type: "POST",

                data: {'cdate': monthdate, 'listing_id':<?php echo arg(1); ?>, 'date_changes': 'yes'},

                success: function (data) {
                    /* Dyannamic Times Get And disable Times */

                    jQuery('.offerDiv').remove();

                    var newData = data.split('~');

                    var TimeRange = jQuery.parseJSON(newData[0]);

                    var availiblitycheck = jQuery.parseJSON(newData[1]);

                    jQuery("#availiblitymax").val(btoa(availiblitycheck.avalabilitymax));

                    jQuery("#availiblitymin").val(btoa(availiblitycheck.avalabilitymin));

                    jQuery('#time-select').val('');

                    jQuery('#travel_sec2').html('');//to reset Travelers

                    jQuery('#travel_sec2').css('display', 'none');//to reset Travelers

                    //jQuery('#time_duration').text(TimeRange.duration);

                    jQuery('#time-select').attr('placeholder', 'HH::MM');

                    if (jQuery.isEmptyObject(TimeRange.timevalarray) == true) {

                        console.log("another session expired");
                        //alert('Session expired for date '+monthdate);

                        jQuery('#time-select').attr('placeholder', 'No session');

                        jQuery('#time-select').val('');
                        jQuery('.time_down_list').html('');

                    } else {

                        var myarray = '';

                        jQuery.each(TimeRange.timevalarray, function (index, value) {

                            myarray += '<li class="time_down_listitem">' + value + '</li>';

                        });

                        console.log(myarray);

                        jQuery('.time_down_list').html(myarray);

                        jQuery('.time_down_listitem').on('click', function () {
                            //console.log(jQuery(this).val());
                            jQuery('#time-select').val(jQuery(this).html());
                            jQuery('.time_down_list').hide();
                            getPricing_newData('timechange');
                        });


                    }


                    jQuery('#load-screen').hide();

                },

                error: function (jqxhr, textStatus, errorThrown) {

                    console.log(errorThrown);

                    jQuery('#load-screen').hide();

                }


            });
        }
    });

    /*Review scroll to button*/
    jQuery('.reviewsCountAnchr').on('click', function () {
        jQuery('html, body').animate({
            scrollTop: jQuery(".dr-review").offset().top
        }, 1000);

    });

    /*============Additional Services Block============*/

    jQuery('.optional-select-items').on('change', function () {
        if (this.value == 1) {
            jQuery(this).closest('.colbar').find('select').attr('disabled', false);
            var obj = {
                status: 1,
                id: jQuery(this).attr('attr-value'), qty: 1
            }
        } else {
            jQuery(this).closest('.colbar').find('select').attr('disabled', true);
            jQuery(this).closest('.colbar').find('select').prop('selectedIndex', 0);
            var obj = {
                status: 0,
                id: jQuery(this).attr('attr-value'),
                qty: 1
            }
        }
        optionalServices(obj);
    });

    function optionalServices(obj) {
        jQuery('#load-screen').show();
        jQuery.ajax({
            url: $baseUrl + '/experience/ajax/getOrder',
            type: 'post',
            data: {listId: '<?php echo arg(1); ?>', id: obj.id, status: obj.status, qty: obj.qty, 'isAjax': 2},
            beforeSend: function () {
                preLoading('show', 'load-screen_details');
            },
            success: function (data) {
                var data = jQuery.parseJSON(data);
                var mainSubtotal = data.Mainsubtotal;
                jQuery('.totalamount').find('h4').html('$' + mainSubtotal);
                jQuery('#Total_Amt').find('h4').html('$' + mainSubtotal);
                var service_tax = '<?php echo variable_get('service_tax'); ?>';
                var payamount_tax_price = ((mainSubtotal * service_tax) / 100);
                var TaxablePrice = (parseFloat(payamount_tax_price) + parseFloat(mainSubtotal));
                payamount_tax_price = payamount_tax_price.toFixed(2);
                jQuery('#service_fees').find('h4').html('$' + payamount_tax_price);
                TaxablePrice = TaxablePrice.toFixed(2);
                jQuery('#Pending_credits_amt').find('h4').html('<strong>$' + TaxablePrice + '</strong>');
                jQuery('#load-screen').hide();
            },
            complete: function () {
                jQuery('#load-screen').hide();
            }
        });
    }

    /*======End of Optional services Block=============*/
    jQuery(window).load(function () {
        calculateGrandTotal();
        jQuery('#edit-keys').val('<?php print t(ucfirst($OverviewData['country'])); ?>');
    });

    jQuery(document).on('ready', function () {
        if (jQuery('#person_type_box_1').length) {
            if (jQuery('#person_type_box_1').val() == 'child') {
                var option = '<option value="0">Select</option>';
                option += jQuery('#person_qty_1').html();
                jQuery('#person_qty_1').html(option);
                var newHtml = jQuery('#person_qty_1').html();
            }
        }
        if (jQuery('#person_type_box_2').length) {
            if (jQuery('#person_type_box_2').val() == 'child') {
                var option = '<option value="0">Select</option>';
                option += jQuery('#person_qty_2').html();
                jQuery('#person_qty_2').html(option);
                var newHtml = jQuery('#person_qty_2').html();
            }
        }
        jQuery('#Calendar-tab').on('click', function () {

            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 1; //January is 0!
            var yyyy = today.getFullYear();

            if (dd < 10) {
                dd = '0' + dd
            }
            if (mm < 10) {
                mm = '0' + mm
            }
            today = yyyy + '/' + mm + '/' + dd;

            if (!jQuery(this).hasClass('calender-opened')) {

                setTimeout(function () {
                    jQuery('#calendar_full').html('');
                    jQuery('#calendar_full').fullCalendar({
                        header: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'month,agendaWeek,agendaDay'
                        },
                        //defaultDate: '2015-03-26',
                        editable: false,
                        eventLimit: true, // allow "more" link when too many events]
                        defaultDate: today,
                        events: {
                            url: $baseUrl + '/experience/getcalender?listingId=<?php echo arg(1); ?>',
                            error: function () {
                                console.log('json format not well formated comming to error section');
                            }
                        },
                        loading: function (bool) {
                            if (bool) {
                                preLoading('show', 'loading_full_calview');
                            } else {
                                preLoading('hide', 'loading_full_calview');
                            }
                        },
                        eventClick: function (calEvent, jsEvent, view) {

                            var string = (calEvent.start._i);
                            var timeSplit = string.split('T');
                            var objDate = new Date(timeSplit[0]),
                                locale = "en-us";
                            var weekday = objDate.toLocaleString(locale, {weekday: "long"});
                            var month = objDate.toLocaleString(locale, {month: "long"});
                            var daynumber = (objDate.getDate() < 10) ? '0' + objDate.getDate() : objDate.getDate();
                            var year = objDate.getFullYear();
                            var title = (calEvent.title).toLowerCase();
                            title = title.replace(/\s+/, "");
                            jQuery('#information_block').html(year + '- ' + weekday + ', ' + month + ' ' + daynumber + ' [' + calEvent.title + ']');
                            //jQuery('#fullCalenderModal').modal();

                            //Set Date and Time to calculation section
                            jQuery('#avail-dates').data('DateTimePicker').setDate(timeSplit[0]);
                            jQuery('#time-select').val(title);
                            jQuery('#avail-dates').trigger('dp.change');

                        },
                        viewDisplay: function (view) {
                            //========= Hide Next/ Prev Buttons based on date range
                            console.log("full calender event");
                            console.log(view.end);

                        }

                    });
                    jQuery(".fc-right").css('display', 'none');
                }, 2000);
                jQuery(this).addClass('calender-opened');
            }
        });

        jQuery('a[href="#Map"]').on('shown.bs.tab', function () {
            if (!jQuery(this).hasClass('map-open')) {
                setTimeout(function () {
                    initializeMap();
                    jQuery('#map-canvas').css('line-height', 'normal');
                }, 2000);
                jQuery(this).addClass('map-open');
            }
        });
        var availdatess = jQuery('#avail-dates').val();

        var user_booking_details =<?php echo json_encode($user_booking_details); ?>;

        if (availdatess != "No dates available") {

            jQuery.ajax({

                url: $baseUrl + "/session/timings",

                type: "POST",

                data: {'cdate': availdatess, 'listing_id':<?php echo arg(1); ?>},

                success: function (data) {

                    /* Dyannamic Times Get And disable Times */

                    jQuery('.offerDiv').remove();

                    var newData = data.split('~');

                    var TimeRange = jQuery.parseJSON(newData[0]);

                    var availiblitycheck = jQuery.parseJSON(newData[1]);

                    jQuery("#availiblitymax").val(btoa(availiblitycheck.avalabilitymax));

                    jQuery("#availiblitymin").val(btoa(availiblitycheck.avalabilitymin));

                    jQuery('#travel_sec2').html('');//to reset Travelers

                    jQuery('#travel_sec2').css('display', 'none');//to reset Travelers

                    //jQuery('#time_duration').text(TimeRange.duration);

                    jQuery('#time-select').attr('placeholder', 'HH::MM');

                    if (jQuery.isEmptyObject(TimeRange.timevalarray) == true) {
                        console.log("session expired");
                        //alert('Session expired for date '+availdatess);

                        jQuery('#time-select').attr('placeholder', 'No session');

                        jQuery('#time-select').val('');
                        jQuery('.time_down_list').html('');
                        jQuery('#load-screen').hide();

                    } else {


                        var myarray = '';

                        jQuery.each(TimeRange.timevalarray, function (index, value) {

                            myarray += '<li class="time_down_listitem">' + value + '</li>';

                        });

                        jQuery('.time_down_list').html(myarray);

                        if (user_booking_details) {
                            jQuery('#time-select').val(user_booking_details['timeNew']);
                            console.log('$user_booking_time ' + user_booking_details['timeNew']);
                            getPricing_newData();
                        }

                        jQuery('.time_down_listitem').on('click', function () {
                            jQuery('#time-select').val(jQuery(this).html());
                            jQuery('.time_down_list').hide();
                            getPricing_newData('timechange');
                        });

                        jQuery('#load-screen').hide();
                    }

                    //jQuery('#load-screen').hide();

                },

                error: function (jqxhr, textStatus, errorThrown) {

                    console.log(errorThrown);
                    jQuery('#load-screen').hide();

                }
            });

        } else {
            //alert('No dates available for this listing.');
        }
    });
    function updateFullCalenderEventSession(type, quantKey) {

        var travellers = jQuery('#person_type_box_full_cal_' + quantKey).val();
        var qty = jQuery('#person_qty_full_cal_' + quantKey).val();
        /* alert(travellers);
         alert(qty); */
        //set into traveller and qty
        jQuery('#person_type_box_' + quantKey).val(travellers);
        jQuery('#person_qty_' + quantKey).val(qty);
        //Trigger event for treveller
        jQuery("#person_type_box_" + quantKey).trigger("change");
        jQuery("#person_type_box_" + quantKey).trigger("blur");
        //getTravelers(type,quantKey);
        //jQuery('#fullCalenderModal').modal('hide');
    }


    function tConvert(time) {
        // Check correct time format and split into components
        time = time.toString().match(/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];

        if (time.length > 1) { // If time format correct
            time = time.slice(1);  // Remove full string match value
            time[5] = +time[0] < 12 ? 'AM' : 'PM'; // Set AM/PM
            time[0] = +time[0] % 12 || 12; // Adjust hours
        }
        return time.join(''); // return adjusted time or original string
    }

    function getUpdatedQuantity(travellertype, totalqty, minquantity, quantKey) {

        var personPriceSize = '<?php echo sizeof($pricingData); ?>';
        var quantityMin = '<?php echo $pricingData[0]['quantity_min']; ?>';
        var qtyselected = jQuery("#person_qty_" + quantKey).val();
        jQuery("#person_qty_ext").append(quantKey + '|');
        var quantUsedSelcted = jQuery("#person_qty_ext").html();
        var newval = new Array();
        newval = quantUsedSelcted.split('|');
        newval = newval.filter(Boolean);
        newvalUnique = jQuery.unique(newval);
        var uniquevals = [];
        jQuery.each(newval, function (i, el) {
            if (jQuery.inArray(el, uniquevals) === -1) uniquevals.push(el);
        });

        var sum = 0;
        var selectedIndexed = new Array()
        jQuery.each(uniquevals, function (index, value) {
            var valqty = jQuery("#person_qty_" + value).val();
            sum += parseInt(valqty);
            selectedIndexed.push(index);
        });
        var lastElementSelected = selectedIndexed[selectedIndexed.length - 1];
        for (i = 1; i <= personPriceSize; i++) {
            var n = i.toString();
            var getvalarr = jQuery.inArray(n, newval);
            var remainingqty = parseInt(totalqty) - parseInt(sum);
            if (getvalarr < 0) {
                var optionField = '<option value="0" >Select</option>';
                for (option = 1; option <= remainingqty; option++) {
                    var data = '<option value="' + option + '">' + option + '</option>';
                    optionField += data;
                }

                jQuery("#person_qty_" + i).html(optionField);
            } else {
                var selectedVal = jQuery("#person_qty_" + i).val();
                if (sum > totalqty) {
                    alert('You cannot select more then ' + totalqty);
                    remQty = parseInt(sum) - parseInt(totalqty);
                    if (i == lastElementSelected) {
                        selectedVal = parseInt(selectedVal) - parseInt(remQty);
                    }
                    return false;
                }
                if (sum < minquantity) {
                    alert('You have to select atleast ' + minquantity);
                    lessremQty = parseInt(totalqty) - parseInt(sum);
                    remQty = parseInt(sum) - parseInt(totalqty);
                    if (i == lastElementSelected) {
                        selectedVal = parseInt(selectedVal) - parseInt(remQty);
                    }

                }
                var remQty = parseInt(sum) - parseInt(totalqty);
                var countStart = (parseInt(totalqty) - parseInt(remQty));
                var optionField = '<option value="0" >Select</option>';
                var Idqty = "#person_qty_" + i;
                for (option = 1; option <= totalqty; option++) {
                    if (option == selectedVal) {
                        var selected = 'selected';
                    } else {
                        var selected = '';
                    }
                    var data = '<option value="' + option + '" ' + selected + '>' + option + '</option>';
                    optionField += data;
                }
                jQuery("#person_qty_" + i).html(optionField);
            }
        }
        getTravelers(travellertype, quantKey);
        jQuery('#person_qty_ext').hide();
    }
    function getUpdatedQuantityfullcalendar(travellertype, totalqty, minquantity, quantKey) {

        var personPriceSize = '<?php echo sizeof($pricingData); ?>';
        var quantityMin = '<?php echo $pricingData[0]['quantity_min']; ?>';
        var qtyselected = jQuery("#person_qty_full_cal_" + quantKey).val();
        jQuery("#person_qty_ext").append(quantKey + '|');
        var quantUsedSelcted = jQuery("#person_qty_ext").html();
        var newval = new Array();
        newval = quantUsedSelcted.split('|');
        newval = newval.filter(Boolean);
        newvalUnique = jQuery.unique(newval);
        var uniquevals = [];
        jQuery.each(newval, function (i, el) {
            if (jQuery.inArray(el, uniquevals) === -1) uniquevals.push(el);
        });
        var sum = 0;
        jQuery.each(uniquevals, function (index, value) {
            var valqty = jQuery("#person_qty_full_cal_" + value).val();
            sum += parseInt(valqty);
        });
        for (i = 1; i <= personPriceSize; i++) {
            var n = i.toString();
            var getvalarr = jQuery.inArray(n, newval);
            var remainingqty = parseInt(totalqty) - parseInt(sum);
            if (getvalarr < 0) {
                var optionField = '<option value="0">Select</option>';
                for (option = 1; option <= remainingqty; option++) {
                    var data = '<option value="' + option + '">' + option + '</option>';
                    optionField += data;
                }
                jQuery("#person_qty_full_cal_" + i).html(optionField);
            } else {
                var selectedVal = jQuery("#person_qty_full_cal_" + i).val();
                if (sum > totalqty) {
                    alert('You cannot select more then ' + totalqty);
                    remQty = parseInt(sum) - parseInt(totalqty);
                    if (i == 1) {
                        selectedVal = parseInt(selectedVal) - parseInt(remQty);
                    }
                }
                var optionField = '';
                var Idqty = "#person_qty_full_cal_" + i;
                for (option = 1; option <= totalqty; option++) {
                    if (option == selectedVal) {
                        var selected = 'selected';
                    } else {
                        var selected = '';
                    }
                    var data = '<option value="' + option + '" ' + selected + '>' + option + '</option>';
                    optionField += data;
                }
                jQuery("#person_qty_full_cal_" + i).html(optionField);
            }
        }
        updateFullCalenderEventSession(travellertype, quantKey);
        jQuery('#person_qty_ext').hide();
    }
    function addListingToTravelguide() {
        var guideId = jQuery('#_guideName').val();
        var pathname = window.location.pathname.split('/');
        var listing_id = pathname[pathname.length - 1];

        jQuery.ajax({
            url: $baseUrl + '/advice/addlisttoGuide',
            type: 'post',
            data: {'guideId': guideId, 'listing_id': listing_id},
            beforeSend: function () {
                preLoading('show', 'load-screen_details_popup');
            },
            success: function (data) {

                if (data == 'Notadded') {
                    jQuery('.guide_msg').html('<span style="color:red;">This listing already added in this guide.</span>');
                } else {
                    jQuery('.guide_msg').html('<span style="color:green;">Listing successfully added in this guide.</span>');
                }
            },
            complete: function () {
                preLoading('hide', 'load-screen_details_popup');
            }
        });
    }
    function generateListingLink() {
        var userId = '<?php echo $user->uid; ?>';
        jQuery.ajax({
            url: $baseUrl + '/addlistingLink',
            type: 'post',
            data: {'userId': userId},
            beforeSend: function () {
                preLoading('show', 'load-screen_details_popup');
            },
            success: function (data) {

                alert(data);
            },
            complete: function () {
                preLoading('hide', 'load-screen_details_popup');
            }
        });
    }
    function minmax(value, min, max) {
        var available_gloobies =<?php echo $availble_gloobies; ?>;
        var totalAmt = jQuery('#Total_Amt').find('h4')[0].innerHTML;
        var totalAmtS = totalAmt.split('$');
        if (parseInt(totalAmtS[1]) <= parseInt(available_gloobies)) {
            max = (totalAmtS[1] - 5);
        } else {
            max = available_gloobies;
        }
        var service_tax = '<?php echo variable_get('service_tax'); ?>';
        var payamount_tax_price = ((parseFloat(totalAmtS[1]) * parseFloat(service_tax)) / 100);
        payamount_tax_price = payamount_tax_price.toFixed(2);
        jQuery('#service_fees').find('h4').html('$' + payamount_tax_price);
        if (parseInt(value) < min || isNaN(value)) {
            return 0;
        } else if (parseInt(value) > max) {
            var Pending_credits_amt = (available_gloobies - max);
            var Pending_credits_amt_due = (totalAmtS[1] - max);
            var TaxablePrice = (parseFloat(payamount_tax_price) + parseFloat(Pending_credits_amt_due));
            TaxablePrice = TaxablePrice.toFixed(2);
            jQuery('#Pending_credits_amt').find('h4').html(TaxablePrice);
            jQuery('#minMax').val(max);
            return max;
        } else {
            var Pending_credits_amt = (available_gloobies - value);
            var Pending_credits_amt_due = (totalAmtS[1] - value);
            var TaxablePrice = (parseFloat(payamount_tax_price) + parseFloat(Pending_credits_amt_due));
            TaxablePrice = TaxablePrice.toFixed(2);
            jQuery('#Pending_credits_amt').find('h4').html('$' + TaxablePrice);
            jQuery('#minMax').val(value);
            return value;
        }
    }
    function confirmCredits() {
        var available_gloobies =<?php echo $availble_gloobies; ?>;
        var used_gloobies = jQuery('#minMax').val();
        var Pending_credits_amt = jQuery('#Pending_credits_amt').find('h4')[0].innerHTML;
        Pending_credits_amt = Pending_credits_amt.split('$');
        Pending_credits_amt = Pending_credits_amt[1];
        jQuery.ajax({
            url: $baseUrl + '/experience/ajax/creditsCalculations',
            type: 'post',
            data: {
                Pending_credits_amt: Pending_credits_amt,
                available_gloobies: available_gloobies,
                used_gloobies: used_gloobies
            },
            success: function (data) {
                window.location.href = $baseUrl + '/booking/summary';
            }

        });
    }
    function clickablesearch() {

        var destination = jQuery('#experience_loction').val();
        if (destination == '') {
            alert('please select destination.');
            return false;
        }
        var filtersearch = jQuery('#experience_list_filter').val();
        if (filtersearch == 'Advisors') {
            window.location.href = '<?php echo $base_url; ?>/search-listing/advisors/' + destination;
        } else if (filtersearch == 'Expereince') {
            window.location.href = '<?php echo $base_url; ?>/search-destination/' + destination;
        } else if (filtersearch == 'Gloobers') {
            window.location.href = '<?php echo $base_url; ?>/Gloobers/' + destination;
        } else {
            preLoading('hide', 'load-screen');
        }
    }
</script>
<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme', $GLOBALS['theme']); ?>/js/clipboard.min.js"
        type="text/javascript"></script>
<script>
    var clipboard = new Clipboard('.btn');

    clipboard.on('success', function (e) {
        console.log(e);
    });

    clipboard.on('error', function (e) {
        console.log(e);
    });
</script>

<script>

    jQuery("#Available_gloobies_information").text(<?php echo $availble_gloobies; ?>);

    jQuery(document).ready(function () {

        jQuery("#review_read_more").click(function () {

            var read_txt = jQuery.trim(jQuery("#review_read_more").text());
            console.log(read_txt);

            if (read_txt == 'Read More') {
                jQuery(".show_reviewdiv").css("display", "block");
                jQuery("#review_read_more").text("Read Less");
            } else {
                jQuery(".show_reviewdiv").css("display", "none");
                jQuery("#review_read_more").text("Read More");
            }


        })

    })


</script>


<script>
    jQuery(document).ready(function () {

        jQuery('.loader_common').each(function () {
            id = jQuery(this).attr('id').trim();
            //alert(id);
            jQuery('#' + id).ClassyLoader({
                percentage: jQuery('#' + id).next().text(),
                speed: 20,
                fontSize: '20px',
                fontColor: '#26B9F0',
                diameter: 45,
                lineColor: '#26B9F0',
                remainingLineColor: 'rgba(200,200,200,0.4)',
                lineWidth: 4
            });
        });

        jQuery(".review_desp").on('click', function () {
            var id = jQuery(this).attr('id');
            var text = jQuery('#' + id).html();
            if (jQuery.trim(text) == "Read More") {
                jQuery('#' + id).parent().find(".desp_long").css("display", "inline");
                //jQuery('#'+id).parent().find(".desp_short").css("display","none");
                jQuery('#' + id).html("Read Less");
            } else {
                //jQuery('#'+id).parent().find(".desp_short").css("display","block");
                //jQuery('#'+id).parent().find(".desp_long").css("display","none");
                jQuery('#' + id).parent().find(".desp_long").css("display", "none");
                jQuery('#' + id).html("Read More");
            }

        });

        jQuery('.timedownarrow').on('click', function () {
            jQuery(".time_down_list").toggle();

        });

        /*jQuery(document).mouseup(function (e)
         {
         var container = jQuery("#avail-dates");

         if (!container.is(e.target) // if the target of the click isn't the container...
         && container.has(e.target).length === 0) // ... nor a descendant of the container
         {
         console.log('blur');
         jQuery("#avail-dates").datetimepicker().blur();

         }
         });*/


    });

    function getFormattedDate(date) {
        var mindates = new Date(date);
        var dd = mindates.getDate();
        var mm = mindates.getMonth() + 1; //January is 0!
        var yyyy = mindates.getFullYear();

        if (dd < 10) {
            dd = '0' + dd
        }
        if (mm < 10) {
            mm = '0' + mm
        }
        mindates = yyyy + '/' + mm + '/' + dd;
        return mindates;
    }

</script>
     