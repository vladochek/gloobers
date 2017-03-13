<script type="text/javascript"
        src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/js/clipboard/jquery.zclip.js"></script>
<?php
global $base_url;
header('Content-type: text/html; charset=utf-8');
drupal_add_js(drupal_get_path('theme', $GLOBALS['theme']) . '/js/bootstrap-datetimepicker.js', array('scope' => 'footer'));
drupal_add_js(drupal_get_path('theme', $GLOBALS['theme']) . '/js/result.js', array('scope' => 'footer'));
drupal_add_css(drupal_get_path('theme', 'gloobers_new') . '/css/gloobers.css', 'file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') . '/stylesheet/for-head-foot.css', 'file');
/* Flex slider */
drupal_add_css(drupal_get_path('theme', 'gloobers') . '/css/flexslider.css', 'file');
drupal_add_js(drupal_get_path('theme', 'gloobers') . '/js/jquery.flexslider.js', array('scope' => 'footer'));
/* Range Slider */
drupal_add_css(drupal_get_path('theme', 'gloobers_new') . '/css/bootstrap-slider.css', 'file');
drupal_add_js(drupal_get_path('theme', 'gloobers') . '/js/bootstrap-slider.js', array('scope' => 'footer'));
drupal_add_js(drupal_get_path('theme', 'gloobers') . '/js/jquery.searchabledropdown-1.0.8.min.js', array('scope' => 'footer'));
drupal_add_js(drupal_get_path('theme', 'gloobers_new') . '/js/jquery.selectbox-0.2.js', array('scope' => 'footer'));
$minMaxPrice = getMaxMinbasePrice();
$base_price_array = array();
if (module_exists('advisor')) {
    $trevelGuideList = getListTrevelGuide();
}
if ($keys) {
    $lat_long = timezone_convert_helper_getLatiLongByAddress($keys);
}
?>


<div class="innersearch">
    <div class="col-md-8 col-sm-6 col-xs-12 dessearch">
        <input type="search" name="search_desti" id="search_keyword" value="<?php echo $keys; ?>" class="desinput"
               onKeyup="search_destination();"
               onblur="if (this.placeholder == ''){this.placeholder = 'Enter a destination'; }"
               onfocus="if(this.placeholder == 'Enter a destination'){this.placeholder = '';}" autocomplete="off"
               type="text" placeholder="Enter a destination"/>
        <input type="submit" name="submit" value="Submit" class="searchinput" onclick="clickablesearch();"/>
    </div> <!-- End DesSearch -->
    <div class="col-md-2 col-sm-3 col-xs-12 travelsearch">
        <select class="experienceinput" id="experience_list_filter">
            <option value="Expereince" selected="selected">Experience</option>
            <option value="Gloobers">Other gloobers</option>
        </select>
    </div> <!-- End AdvisorSearch -->
    <div class="col-md-2 col-sm-3 col-xs-12 filtersearch filterbutton">
        <span> Filters <i class="filter-icon"></i></span>
    </div> <!-- End AdvisorSearch -->
    <div class="tabs_ul">
        <div class="sidebar">
            <div class="col-md-2 col-sm-4 col-xs-12">
                <div class="exptype">
                    <h2>Experience type </h2>
                    <select name="number" id="select_experience_type" class="abcclass">
                        <?php
                        foreach ($experienceType as $key => $value) {
                            print '<option value="' . $key . '">' . $value . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-12">
                <div class="datetype">
                    <h2>Date</h2>
                    <div class="inputctrl">
                        <input type="text" autocomple="false" readonly="readonly" id="datetimepicker2">
                        <i class="fa fa-calendar-o calicon"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-12">
                <div class="traveltype">
                    <h2>Travelers</h2>
                    <select name="number" id="select_persons" class="exp-height">
                        <?php
                        for ($i = 1; $i <= 16; $i++) {
                            if ($i == 16) {
                                print '<option value="' . $i . '">16+ </option>';
                            } else {
                                print '<option value="' . $i . '">' . $i . '</option>';
                            }
                        }
                        ?>

                    </select>
                </div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-12">
                <div class="ranktype">
                    <h2>Ranking</h2>
                    <i class="gl-ico gl-ico-star" id="rank_1"></i>
                    <i class="gl-ico gl-ico-star" id="rank_2"></i>
                    <i class="gl-ico gl-ico-star" id="rank_3"></i>
                    <i class="gl-ico gl-ico-star" id="rank_4"></i>
                    <i class="gl-ico gl-ico-star" id="rank_5"></i>
                </div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-12">
                <div class="spcloffer">
                    <h2>Special offers</h2>
                    <p>Select offers</p>
                    <div class="clickarrow"><a href="javascript:void(0);" class="fa fa-chevron-down"></a></div>
                    <div class="checksec">
                        <form name="offerFrm" id="offerFrm">
                            <div class="col"> <span>
                                            <input name="offer[]" class="offers-listing" value="24 Hour Offer" id="sm"
                                                   type="checkbox"/>
                                        </span>
                                <label>24 hours offer</label>
                            </div>
                            <div class="col"> <span>
                                            <input name="offer[]" class="offers-listing" value="Early Birds"
                                                   type="checkbox">
                                        </span>
                                <label>Early birds offer</label>
                            </div>
                            <div class="col"> <span>
                                            <input name="offer[]" class="offers-listing" value="Last Minute"
                                                   type="checkbox">
                                        </span>
                                <label>Last minute offer</label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-12">
                <div class="pricerange"><h2>Price range</h2>
                    <div id="slider-range"></div>
                </div>
            </div>
        </div>
    </div> <!-- End Tab_UL -->
</div>
</div> <!-- End InnerSearch -->
<section class="map-search">
    <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
        <div class="maparea">
            <div id="map_canvas" class="mapping"></div>
        </div>
    </div>
    <div class="container">
        <div class="col-lg-12 listsection">
            <?php
            $listingResultJson = $listingResult;

            //echo "<pre>";print_r($listingResult);exit;
            if (!empty($listingResult)) {
                foreach ($listingResult as $key => $listing) {

                    $listing_min_price[] = $listing["min_price"];
                    $listing_max_price[] = $listing["max_price"];

                    $photos = isset($listing["eid"]) ? getPhotosData($listing["eid"]) : $listing["photos"];
//var_dump($listingResult[1]);die;
                    //  $basePrice = getBasePrice($listing["eid"]);
                    $offers = getOffersAndDiscountsData($listing["eid"]);
                    /*
                      echo "<pre>";
                      print_r($offers);
                      continue; */
                    $offerStack = array();
                    if (!empty($offers)) {
                        //   $listingResultJson[$key]['base_price'] = $basePrice["base_price"];
                        //check for all conditions 24h , last min, Early bird

                        /* echo "<pre>";
                          print_r($offers);
                          die; */
                        $offerStack = checkOfferApply($offers, $listing);
                        $offerUriParam = (isset($offerStack['offer_type'])) ? '?offer=' . base64_encode($offerStack['offer_type']) : '';
                    }
                    ?>

                    <div class="col-xs-12 col-sm-4 col-md-4 listing listing_container_head" style="display:none;">
                        <div class="block">
                            <div class="flexslider">
                                <ul class="slides">
                                    <?php
                                    if (count($photos) > 0) {
                                        foreach ($photos as $imgKey => $photo) {
                                            if (isset($listing["eid"])) {
                                                $photo = unserialize($photo["value1"]);
                                                $file = file_load($photo["fid"]);
                                                $imgpath = $file->uri;
                                                $style = 'listing_slider';

                                                //set image into json array for map element
                                                if ($imgKey == 0) {
                                                    $listingResultJson[$key]['photo'] = image_style_url($style, $imgpath);
                                                }
                                                $noImage = base_path() . drupal_get_path('theme', 'gloobers') . '/images/cover_small_pic.jpg';
                                                $link = $base_url . '/experience/' . $listing["eid"] . $offerUriParam;
                                                $path = image_style_url($style, $imgpath);
                                            } else {
                                                $link = '#';
                                                $path = $photo;
                                            }
                                            ?>
                                            <li>
                                                <a href="<?= $link ?>">
                                                    <img src="<?= $path ?>" alt="place" onError="imgError(this)"/>
                                                </a>
                                            </li>
                                            <?php
                                        }

                                        if (isset($listing["eid"])) {
                                            $FBphoto = unserialize($photos[0]['value1']);
                                            $FBfile = file_load($FBphoto["fid"]);
                                            $FBimgpath = $FBfile->uri;

                                            $FBstyle = 'listing_slider';

                                            if (!file_exists($FBimgpath)) {
                                                $FBstyle = 'sharing_listing_image';
                                                $FBimgpath = 'banner-listing_img.jpg';
                                            }

                                            $FBsrc = image_style_url($FBstyle, $FBimgpath);

                                            $Listing_recommend_link = $base_url . '/experience/' . $listing["eid"] . '?ruid=' . base64_encode($user->uid) . '&FBsrc=' . $FBsrc . '&base_url=' . $base_url;

                                            $twitter_recommend_link = $base_url . '/sites/all/themes/gloobers_new/twitterOauthwithImagePost/callback.php?msg=' . $base_url . '/experience/' . $keys . '?ruid=' . base64_encode($user->uid) . '&media=' . $FBsrc . '&redirect=1';

                                            echo '<label id="twitter_recommend_link_' . $listing["eid"] . '" style="display:none">' . $twitter_recommend_link . '</label>';

                                            echo '<label id="Listing_recommend_link_' . $listing["eid"] . '" style="display:none">' . $Listing_recommend_link . '</label>';
                                            echo '<label id="Listing_recommend_link_title_' . $listing["eid"] . '" style="display:none">' . $listing["title"] . '</label>';
                                            echo '<label id="Listing_recommend_link_city_' . $listing["eid"] . '" style="display:none">' . $listing["city"] . '</label>';
                                            echo '<label id="Listing_recommend_link_country_' . $listing["eid"] . '" style="display:none">' . $listing["country"] . '</label>';
                                            echo '<label id="Listing_recommend_link_fbsrc_' . $listing["eid"] . '" style="display:none">' . $FBsrc . '</label>';
                                        }
                                    } else {
                                        $link = isset($listing["eid"]) ? $base_url . '/experience/' . $listing["eid"] . $offerUriParam : '#';
                                        ?>
                                        <li>
                                            <a href="<?= $link ?>">
                                                <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers_new'); ?>/images/cover_small_pic.jpg"
                                                     alt="place"/>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div> <!-- flex ends -->
                            <div class="listdetail">
                                <div class="click"><a href="#" class="listicon"><span></span><span></span><span></span></a>
                                </div>
                                <div class="listview">
                                    <ul>
                                        <?php
                                        if (isset($listing["eid"])) {
                                            ?>
                                            <li>
                                                <a href="<?php print $base_url; ?>/experience/<?php echo $listing["eid"]; ?>"
                                                   target="_blank">
                                                    <i class="fa fa-eye"></i>
                                                    View details
                                                </a>
                                            </li>
                                            <li>
                                                <div class="recommendbutton">
                                                    <a href="javascript:void(0);"
                                                       onclick="recommendfn(<?php echo $listing["eid"]; ?>)">
                                                        <i class="fa fa-plus"></i>
                                                        Recommend to friend
                                                    </a>
                                                </div> <!-- End RecommendButton -->
                                            </li>
                                            <?php
                                        } ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="tagsec">
                                <?php
                                echo (isset($offerStack['html'])) ? $offerStack['html'] : '';
                                ?>
                                <!--div class="price">
                                            <p>$<?php //echo $listing["min_price"]; ?></p>
                                        </div-->
                            </div>
                            <?php
                            //check for reviews
                            $reviews = getListingReviews($listing["eid"]);
                            if (!empty($reviews)) {
                                ?>
                                <div class="review">
                                    <p><span><?php echo count($reviews); ?></span><br>
                                        <?php echo (count($reviews) > 1) ? 'reviews' : 'review'; ?></p>
                                    <div class="botarrow"><img
                                                src="<?php echo $base_url . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/images/arrow-cmnt.png"
                                                alt=" "></div>
                                </div>
                            <?php } ?>
                            <div class="clientpic">
                                <?php

                                if (isset($listing["uid"]) && $userDetails = user_load($listing["uid"])) {
                                    $userUrl = $base_url . '/profile/' . $userDetails->uid;
                                    $target = '_blank';
                                    $listingUrl = $base_url . '/experience/' . $listing["eid"];
                                    if ($userDetails->picture != "") {
                                        $file = file_load($userDetails->picture->fid);
                                        $imgpath = file_create_url($file->uri);
                                    } else {
                                        $imgpath = base_path() . drupal_get_path('theme', 'gloobers') . '/images/no-profile-male-img.jpg';
                                    }
                                } else {
                                    $listingUrl = $userUrl = '#';
                                    $imgpath = base_path() . drupal_get_path('theme', 'gloobers') . '/images/no-profile-male-img.jpg';
                                    $target = '_self';
                                }
                                ?>
                                <a href="<?= $userUrl ?>"
                                   target="<?= $target ?>">
                                    <img src="<?= $imgpath ?>"
                                         alt="display pic"/>
                                </a>
                            </div>
                        </div>
                        <div class="headingsec">
                            <h2><a href="<?= $listingUrl ?>"><?php echo ucwords($listing["title"]); ?></a></h2>
                            <p>
                                <span><?php echo (strlen($listing["city"]) > 12) ? substr($listing["city"], 0, 12) . '..' : $listing["city"]; ?>
                                    , <?php echo $listing["state"]; ?></span> -
                                <span><?php echo $listing["experience_type"]; ?></span></p>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<div class='norecode'>
                            <h2>Please Modify Your Search</h2>
                            <h3>No Listing Found !!! </h3> 
                            </div>";
                echo '<script> jQuery(".maparea").css("display","none")</script>';

            }

            $listingResultJson = json_encode($listingResultJson);
            //echo "<pre>";Print_r($listingResult);exit;
            //$listingResultJson = json_encode($listingResult);
            ?>

        </div>

        <?php
        if ($listingResultCount > count($listingResult)) {
            $listingCount = ceil($listingResultCount / 8);
            $page = ($_GET['page']) ? $_GET['page'] : 1;
            $pageStartFrom = ($page > 1) ? (($page - 1) * 8) + 1 : 1;
            $pageStartEnd = ($page > 1) ? (($page - 1) * 8) + count($listingResult) : ($page * count($listingResult));
            ?>
            <div class="paging-sec" style="display: none;">
                <div class="results_count">
                    <p>
                        <?php echo $pageStartFrom . '&ndash;' . $pageStartEnd . ' of ' . ($listingResultCount) . ' Records'; ?>
                    </p>
                </div>
                <ul>
                    <?php
                    if ($page > 1) {
                        $urlName = $base_url . '/search-destination/' . $keys . '?page=' . ($page - 1);
                        echo '<li><a href="' . $urlName . '"><i class="glyphicon glyphicon-chevron-left"></i></a></li>';
                    }

                    for ($i = 1; $i <= $listingCount; $i++) {
                        $currentClass = ($page == $i) ? 'current' : '';
                        $urlName = $base_url . '/search-destination/' . $keys . '?page=' . $i;
                        if ($i <= 3) {
                            echo '<li><a href="' . $urlName . '" class="' . $currentClass . '">' . $i . '</a></li>';
                        }
                    }
                    if ($listingCount > 4) {
                        $urlName = $base_url . '/search-destination/' . $keys . '?page=' . ($page + 1);
                        echo '<li><a href="' . $urlName . '"><i class="glyphicon glyphicon-chevron-right"></i></a></li>';
                    }
                    ?>
                </ul>
            </div>
        <?php } ?>
    </div>
    </div>
    </div>
</section>

<!--MODAL FOR ADD LISTING FOR TREVEL GUIDE-->
<div id="modalAddToGide" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">Add to guide
        <div class="modal-conteView detailsnt">
            <form id="add_to_guide_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Select Travel Guide</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <select id="_guideName" name="guideName" class="selectbox">
                            <option value=""> Select travel guide</option>
                            <?php foreach ($trevelGuideList as $guideList) { ?>
                                <option value="<?php echo $guideList['tgid'] ?>"><?php echo $guideList['title']; ?></option>
                            <?php } ?>
                        </select>
                        <input type="hidden" name="_listingGuideId" id="_listingGuideId">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Add to Guide" data-loading-text="Working...">
                </div>
            </form>
        </div>
    </div>
</div>
<!--END OF MODAL-->

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
                                    <input name="input" id="dynamic1" readonly="" type="text" value="">
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
                    <a target='_blank' id="twitter_id" class="fa fa-twitter" target="_blank" href=""></a>
                    <a target='_blank' id="gmail_id" class="fa fa-envelope-o" href=""></a>
                    <a target='_blank' id="gooleplus_id" class="fa fa-google-plus" href=""></a>
                    <a target='_blank' id="fb_id" class="fa fa-facebook" href=""></a>
                </div>
            </div>
            <div class="recommendlinkblock">
                <div class="col-md-12">
                    <div class="row">
                        <h3>Embed this recommendation</h3>
                        <p>Embed this recommendation onto your website or blog, get rewarded for every booking you
                            generate.</p>
                        <textarea readonly="" class="form-control" id="message-text">

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


<?php //echo $listing["min_price"];exit;?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        preLoading('show', 'load-screen');
        /*SelectBox*/
        jQuery("select").selectbox();
        jQuery(document).click(function (e) {
            if (!jQuery(e.target).is('.sbHolder, .sbHolder *')) {
                jQuery("select").selectbox('close');
            }
        }); //End

        jQuery(".filtersearch").click(function () {
            jQuery('.sidebar').slideToggle();
            jQuery(".filtersearch span i").toggleClass("filter-icon-active");
        });

//Listing()
        jQuery(".listicon").click(function (event) {
            event.preventDefault();
            jQuery(this).next(".listview").slideToggle(400);
        }); // End


    }); //End Ready()

    jQuery(window).load(function () {

        /*Flex slider call on window load*/
        jQuery('.flexslider').flexslider({slideshow: false});

        /*Call function for loading hide will hide loader and show listing div area*/
        preLoading('hide', 'load-screen');

        /*Call range Slider for price field*/
        $slider = jQuery("#slider-range").slider({
            range: true,
            min: <?php echo (min($listing_min_price)) ? min($listing_min_price) : 0; ?>,
            max: <?php echo (max($listing_max_price)) ? max($listing_max_price) : 0; ?>,
            values: [0, 500],
            value: <?php echo (min($listing_min_price)) ? (min($listing_min_price)) : 0; ?>
        }).on('slideStop', function (event) {
            var cObj = {
                min: event.value[0],
                max: event.value[1],
                expType: jQuery('#select_experience_type').val(),
                when: jQuery('#datetimepicker2').val(),
                person: jQuery('#select_persons').val(),
                place: '<?php echo $keys ?>',
                action: 'search'
            };
            setFilter(cObj);
        });
        var dateTodayavail = new Date();
        var curr_date_avail = dateTodayavail.getDate();
        var curr_month_avail = dateTodayavail.getMonth() + 1;
        var curr_year_avail = dateTodayavail.getFullYear();
        var monthdate_avail = curr_year_avail + '-' + curr_month_avail + '-' + curr_date_avail;
        //alert(monthdate_avail);
        //Datepicker filter event bind
        jQuery('#datetimepicker2').datetimepicker({
            /*pickTime: false,
             minDate:monthdate_avail,
             startDate:monthdate_avail*/

            pickTime: false,
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            },
            minDate: moment()

        }).on('dp.change', function (e) {
            var cObj = {
                min: <?php echo (min($listing_min_price)) ? min($listing_min_price) : 0; ?>,
                max: <?php echo (max($listing_max_price)) ? max($listing_max_price) : 0; ?>,
                expType: jQuery('#select_experience_type').val(),
                person: jQuery('#select_persons').val(),
                when: (e.delegateTarget.value),
                place: '<?php echo $keys ?>',
                action: 'search'
            }
            setFilter(cObj);
            jQuery('#datetimepicker2').blur();
        });
        //alert("1");
        if (jQuery('.listsection .listing_container_head').length > 0) {
            initialize();
        } else {
            // timezone_convert_helper_getLatiLongByAddress(<?php echo $keys; ?>)
            initialize_blank('<?php echo $keys; ?>');
        }

        jQuery('.paging-sec').css('display', 'block');
    });

    //Listing category filter event bind
    jQuery(document).on('change', '#select_experience_type', function () {
        var cObj = {
            min: <?php echo (min($listing_min_price)) ? min($listing_min_price) : 0; ?>,
            max: <?php echo (max($listing_max_price)) ? max($listing_max_price) : 0; ?>,
            expType: this.value,
            when: jQuery('#datetimepicker2').val(),
            person: jQuery('#select_persons').val(),
            place: '<?php echo $keys ?>',
            action: 'search'
        }
        setFilter(cObj);
    });

    //Ranking Change Filter
    jQuery('.ranktype').bind('click', function (event) {
        var selectedStarId = event.target.id;
        var SelectedStar = selectedStarId.split('_');
        if (SelectedStar[1] == 1 && jQuery('.ranktype').find('#' + selectedStarId).hasClass('gold') && jQuery('.ranktype').find('.fa-star.gold').length == 1) {
            odd_case = 'yes';
        } else {
            odd_case = 'no';
        }
        console.log(odd_case);
        jQuery('.ranktype').find('.fa-star').removeClass('gold');
        switch (SelectedStar[1]) {
            case '1':
                if (odd_case == 'yes') {
                    jQuery('#' + selectedStarId).removeClass('gold');
                    SelectedStar[1] = 0;
                    console.log(SelectedStar[1]);

                } else {
                    jQuery('#' + selectedStarId).addClass('gold');
                }
                break;
            case '2':
                jQuery('#rank_1').addClass('gold');
                jQuery('#' + selectedStarId).addClass('gold');
                break;
            case '3':
                jQuery('#rank_1').addClass('gold');
                jQuery('#rank_2').addClass('gold');
                jQuery('#' + selectedStarId).addClass('gold');
                break;
            case '4':
                jQuery('#rank_1').addClass('gold');
                jQuery('#rank_2').addClass('gold');
                jQuery('#rank_3').addClass('gold');
                jQuery('#' + selectedStarId).addClass('gold');
                break;
            case '5':
                jQuery('#rank_1').addClass('gold');
                jQuery('#rank_2').addClass('gold');
                jQuery('#rank_3').addClass('gold');
                jQuery('#rank_4').addClass('gold');
                jQuery('#' + selectedStarId).addClass('gold');
                break;
        }
        var cObj = {
            min: <?php echo (min($listing_min_price)) ? min($listing_min_price) : 0; ?>,
            max: <?php echo (max($listing_max_price)) ? max($listing_max_price) : 0; ?>,
            expType: this.value,
            when: jQuery('#datetimepicker2').val(),
            person: jQuery('#select_persons').val(),
            place: '<?php echo $keys ?>',
            selectedStar: SelectedStar[1],
            action: 'search'
        }

        setFilter(cObj);
    });
    //Select person quantity filter event bind
    jQuery(document).on('change', '#select_persons', function () {
        var cObj = {
            min: <?php echo (min($listing_min_price)) ? min($listing_min_price) : 0; ?>,
            max: <?php echo (max($listing_max_price)) ? max($listing_max_price) : 0; ?>,
            expType: jQuery('#select_experience_type').val(),
            when: jQuery('#datetimepicker2').val(),
            person: this.value,
            place: '<?php echo $keys ?>',
            action: 'search'
        }
        setFilter(cObj);
    });

    //Ajax request based on filtes paramters
    var setFilter = function (obj) {
        if (obj.selectedStar) {
            var selectedstar = obj.selectedStar;
        } else {
            var selectedstar = '';
        }
        var data = {
            'min': obj.min,
            'max': obj.max,
            'action': obj.action,
            type: 'my_listing',
            'page': '<?php echo $_GET['page']; ?>',
            selectedstar: selectedstar
        };
        if (obj.expType && (obj.expType).length > 0) {
            data.typeId = obj.expType;
        }
        if (obj.when && (obj.when).length > 0) {
            data.when = obj.when;
        }
        if (obj.person && (obj.person).length > 0) {
            data.person = obj.person;
        }
        if (obj.place && (obj.place).length > 0) {
            data.place = obj.place;
        }

        if (obj.offers && (obj.offers).length > 0) {
            data.offers = obj.offers;
        }

        jQuery('.listsection').html('');
        jq.ajax({
            type: 'POST',
            //async:false,
            url: "<?php echo $base_url; ?>/experience",
            beforeSend: function () {
                preLoading('show', 'load-screen');
            },
            data: data,
            success: function (data) {

                data = jq.parseJSON(data);
                jQuery('.listsection').html(data.string);
                if (data.mapString == 'null') {
                    jQuery('.listsection').html("<div class='norecode'>No Listing Found</div>");
                    initialize_blank(obj.place);
                } else {
                    initialize(data.mapString);
                }

                if (data.count < 8) {
                    jQuery('.paging-sec').css('display', 'none');
                } else {
                    jQuery('.paging-sec').css('display', 'block');
                }

                preLoading('hide', 'load-screen');
                jQuery('#datetimepicker2').blur();

            },
        });

    };

    function imgError(el) {
        var noImage = $baseUrl + '/' + $globalThemeUrl + '/images/img/place1.png';
        jQuery(el).attr('src', noImage);
    }

    addToWishList();
    jQuery('.offers-listing').on('click', function () {

        var cObj = {
            min: <?php echo (min($listing_min_price)) ? min($listing_min_price) : 0; ?>,
            max: <?php echo (max($listing_max_price)) ? max($listing_max_price) : 0; ?>,
            expType: jQuery('#select_experience_type').val(),
            when: jQuery('#datetimepicker2').val(),
            person: jQuery('#select_persons').val(),
            place: '<?php echo $keys ?>',
            offers: jQuery('#offerFrm').serialize(),
            action: 'search'
        }
        setFilter(cObj);
    });

    function initialize_blank(arg) {
        var geocoder = new google.maps.Geocoder();
        var lat = <?php echo $lat_long['lati'];  ?>;
        var longt = <?php echo $lat_long['long'];  ?>;
        geocoder.geocode({'address': arg}, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                var centerlatlng = new google.maps.LatLng(lat, longt);
                var myOptions = {
                    minZoom: 2,
                    maxZoom: 15,
                    zoom: 4,
                    center: centerlatlng,
                    disableDefaultUI: true,
                    mapTypeId: 'roadmap'
                };
                var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

            }
        });
    }

    function initialize(arg) {

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

        var map;
        var bounds = new google.maps.LatLngBounds();
        var mapOptions = {
            mapTypeId: 'roadmap',
            minZoom: 3,
            maxZoom: maxZoomvar,
            scrollwheel: false,
            navigationControl: false,
            mapTypeControl: false,
            scaleControl: false
        };
        // Display a map on the page
        map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
        map.setTilt(45);

        var listingResults = (arg) ? arg : '<?php echo $listingResultJson; ?>';

        var listingResultsObj = jQuery.parseJSON(listingResults);

        var markerValue = [];
        var markerContent = [];
        jQuery.each(listingResultsObj, function (key, value) {
            var lat = parseFloat(value.latitude);
            var longt = parseFloat(value.longitude);
            var Base_price = parseFloat(value.min_price);
            markerValue[key] = [value.city + ',' + value.country, lat, longt],
                //Marker content
                markerContent[key] = ['<div class="info_content"><a href="' + $baseUrl + '/experience/' + value.eid + '">' +
                '<p><img onError="imgError(this)" src="' + value.photo + '"  height="176"><div class="price" style="background: none repeat scroll 0 0 #000;bottom: 60px;color: #fff;float: left;opacity: 0.65;padding: 6px;position: absolute;text-align: center;width: 90px;" ><h4>$' + Base_price + '</h4></div></p>' +
                '<h4>' + value.title + '- ' + value.experience_type + '</h4></a>' +
                '<small>' + value.city + ', ' + value.state + ', ' + value.country + '</small>' + '</div>'];
        });

        // Multiple Markers
        var markers = markerValue;

        // Info Window Content
        var infoWindowContent = markerContent;

        // Display multiple markers on a map
        var infoWindow = new google.maps.InfoWindow(), marker, i;

        // Loop through our array of markers & place each one on the map  
        for (i = 0; i < markers.length; i++) {
            var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
            bounds.extend(position);
            marker = new google.maps.Marker({
                position: position,
                map: map,
                title: markers[i][0]
            });

            // Allow each marker to have an info window    
            google.maps.event.addListener(marker, 'click', (function (marker, i) {
                return function () {
                    infoWindow.setContent(infoWindowContent[i][0]);
                    infoWindow.open(map, marker);
                }
            })(marker, i));

            // Automatically center the map fitting all markers on the screen
            map.fitBounds(bounds);
            map.setCenter(bounds.getCenter());
        }

        // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
        var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function (event) {
            this.setOptions({maxZoom: 13});
            google.maps.event.removeListener(boundsListener);
        });


    }

    function addToWishList() {
        jQuery('.add_to_wishlist').click(function () {
            var listId = jQuery(this).attr('data-attr');
            listId = listId.split(',');
            var dom = jQuery(this);

            jq.ajax({
                type: 'POST',
                //async:false,
                url: "<?php echo $base_url; ?>/add/wishlist",
                data: {listingId: listId[1], status: listId[0]},
                success: function (data) {
                    jQuery(dom).attr('data-attr', data.replace('-', ','));
                    var res = data.split('-');
                    if (res[0] == 1) {
                        jQuery(dom).find('i').css({'color': '#E14776', 'border': '1px solid #E14776'});
                    } else {
                        jQuery(dom).find('i').css({'color': '#FFF', 'border': '1px solid #FFF'});
                    }
                },
                error: function (data) {
                    alert("ajax error occured?8" + data);
                }
            });
        });
    }
    /*========ADD TO GUIDE===============*/
    jQuery(document).ready(function () {
        jQuery('#add_to_guide_form').submit(function () {
            jq.ajax({
                url: $baseUrl + '/advice/ajax/addToGuide',
                type: 'post',
                data: jQuery('#add_to_guide_form').serialize(),
                beforeSend: function () {
                    preLoading('show', 'load-screen');
                },
                success: function (data) {
                    var res = jQuery.parseJSON(data);
                    preLoading('hide', 'load-screen');
                    jQuery.notify(res.message, {globalPosition: 'top center', className: res.status});
                    jQuery('#modalAddToGide').modal('hide');
                }
            });
            return false;
        })
    });
    addToGuide = function (eid) {
        jQuery('#_listingGuideId').val(eid);
        jQuery('#modalAddToGide').modal();
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
        jQuery("body").on("change", "#experience_list_filter", function () {

            var me = jQuery(this);
            var value = me.val();
            var keyword = jQuery("#search_keyword").val();
            preLoading('show', 'load-screen');
            if (value == 'Advisors') {

                window.location.href = '<?= $base_url; ?>/search-listing/advisors/' + keyword;
            }
            else if (value == 'Expereince') {
                window.location.href = '<?= $base_url; ?>/search-destination/' + keyword;
            }
            else if (value == 'Gloobers') {
                window.location.href = '<?= $base_url; ?>/Gloobers/' + keyword;
            }
            else {
                preLoading('hide', 'load-screen');
            }
        });

    });
    function search_destination() {

        var home_autocomplete = new google.maps.places.Autocomplete(
            /** @type {HTMLInputElement} */
            (document.getElementById('search_keyword')),
            {types: ['geocode']});
        google.maps.event.addListener(home_autocomplete, 'place_changed', function () {
        });
    }
    function clickablesearch() {
        var destination = jQuery.trim(jQuery('#search_keyword').val().replace('#', ''));
        if (destination == '') {
            alert('please select destination.');
            return false;
        }
        var filtersearch = jQuery('#experience_list_filter').val();
        if (filtersearch == 'Advisors') {
            window.location.href = '<?= $base_url; ?>/search-listing/advisors/' + destination;
        } else if (filtersearch == 'Expereince') {
            window.location.href = '<?= $base_url; ?>/search-destination/' + destination;
        } else if (filtersearch == 'Gloobers') {
            window.location.href = '<?= $base_url; ?>/Gloobers/' + destination;
        } else {
            preLoading('hide', 'load-screen');
        }
    }
</script>
<script>
    function recommendfn(lid) {

        var linkid = jQuery("#Listing_recommend_link_" + lid).text();
        var twitter_recommend_link = jQuery("#twitter_recommend_link_" + lid).text();
        var link_gmail = linkid.split("&");
        var linkimg = jQuery("#Listing_recommend_link_fbsrc_" + lid).text();

        jQuery(".popuplightbox").show();

        jQuery("#dynamic1").val(jQuery("#Listing_recommend_link_" + lid).text());
        jQuery("#twitter_id").attr("href", twitter_recommend_link);
        jQuery("#gmail_id").attr("href", "mailto:?subject=You%20received%20a%20new%20recommendation%20from%20Gloobers&body= Hi,%0D%0A%0D%0AYou%20just%20received%20a%20new%20recommendation!%0D%0A%0D%0AClick%20on%20the%20following%20link%20or%20sign%20up%20on%20http://gloobers.com%20to%20view%20this%20recommendation.%0D%0A%0D%0A" + link_gmail[0] + "%0D%0A%0D%0ACheers,%0D%0A%0D%0AThe%20Gloobers%20team");

        jQuery("#gooleplus_id").attr("href", "https://plus.google.com/share?url=" + linkid);
        jQuery("#fb_id").attr("href", "https://www.facebook.com/sharer/sharer.php?u=" + linkid);


        var msg_box_data = '<div id="glooberUp" class="10030208_67677" style="float:left;text-align:center;width:100%"><div style="background:#efefef;padding:10px;max-width:600px;display:inline-block"><a href="' + linkid + '"><img src="' + linkimg + '" style="width:100%;border:0;outline:0;margin-bottom:10px" alt="" title=""></a><p style="color:#414141;font-size:20px;font-family:arial;font-weight:bold;margin:0px">Gloobers.com - ' + jQuery("#Listing_recommend_link_city_" + lid).text() + ' ' + jQuery("#Listing_recommend_link_city_" + lid).text() + ',' + jQuery("#Listing_recommend_link_country_" + lid).text() + '</p><p style="color:#414141;font-size:16px;font-family:arial;">Be friendly - Travel for free. Travel for free thanks to your helpful recommendations. Drop us your email and be the first to know when we launch. Stay tuned on. </p></div></div>';

        jQuery("#message-text").html(msg_box_data);

        jQuery(".recommendlightbox").fadeIn();

        jQuery('#copy-dynamic1').zclip(
            {
                path: "<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/js/clipboard/ZeroClipboardnew.swf",
                copy: function () {
                    return jQuery('#dynamic1').val();
                },
                afterCopy: function () {
                    jQuery('#dynamic1').css('background-color', '#006699');
                    jQuery('#dynamic1').css('color', '#ffffff');
                    console.log("success");
                }
            });


    }

    // Hide Lightbox
    jQuery(".cancelbtn").click(function () {
        jQuery(".popuplightbox").hide();
        jQuery(".bookinglightbox").fadeOut();
        jQuery(".popuplightbox").hide();
        jQuery(".recommendlightbox").fadeOut();
    });


    jQuery(document).mouseup(function (e) {
        var container = jQuery(".spcloffer");
        console.log(e);

        if (!container.is(e.target) // if the target of the click isn't the container...
            && container.has(e.target).length === 0) // ... nor a descendant of the container
        {
            var count = 0;
            jQuery("#offerFrm").find(".offers-listing").each(function () {
                if (jQuery(this).prop("checked") == true) {
                    count = 1;
                }
            })

            if (count == 0) {
                jQuery(".checksec").slideUp("slow");
            }

        }

        var container1 = jQuery(".recommendlightbox");
        if (!container1.is(e.target) // if the target of the click isn't the container...
            && container1.has(e.target).length === 0) // ... nor a descendant of the container
        {
            jQuery(".recommendlightbox").hide(1000);
            jQuery(".popuplightbox").hide();

        }
    });


</script>
