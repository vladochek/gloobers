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
$base_price_array=array();
if(module_exists('advisor')){ 
    $trevelGuideList=getListTrevelGuide();
}
if(arg(1)){
 $lat_long = timezone_convert_helper_getLatiLongByAddress( arg(1));
}
?>
<div class="innersearch">
<div class="tabs_ul">
<div class="sidebar">
<div class="col-md-2 col-sm-4 col-xs-12">
                    <div class="exptype">
                        <h2>Experience type </h2>
                        <select name="number" id="select_experience_type" class="abcclass">
                            <?php
                            foreach($experienceType as $key => $value){
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
                            <input type="text" autocomple="false"  readonly="readonly"  data-date-format="YYYY/MM/DD" id="datetimepicker2">
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
                            <i class="gl-ico gl-ico-star gold"></i> <i class="gl-ico gl-ico-star gold"></i> <i class="gl-ico gl-ico-star gold"></i> <i class="gl-ico gl-ico-star"></i> <i class="gl-ico gl-ico-star"></i>
                        </div>
</div>
<div class="col-md-2 col-sm-4 col-xs-12">
                        <div class="spcloffer">
                            <h2>Special offers</h2>
                            <p>Select offers</p>
                            <div class="clickarrow"><a href="#" class="fa fa-chevron-down"></a></div>
                            <div class="checksec">
                                <form name="offerFrm" id="offerFrm">
                                    <div class="col"> <span>
                                            <input name="offer[]" class="offers-listing" value="24 Hour Offer" id="sm" type="checkbox"/>
                                        </span>
                                        <label>24 hours offer</label>
                                    </div>
                                    <div class="col"> <span>
                                            <input name="offer[]" class="offers-listing" value="Early Birds"  type="checkbox">
                                        </span>
                                        <label>Early birds offer</label>
                                    </div>
                                    <div class="col"> <span>
                                            <input name="offer[]" class="offers-listing" value="Last Minute" type="checkbox">
                                        </span>
                                        <label>Last minute offer</label>
                                    </div>
                                </form>
                            </div>
                        </div>
</div>
<div class="col-md-2 col-sm-4 col-xs-12">
                        <div class="pricerange"> <h2>Price range</h2> <div id="slider-range"></div> </div>
</div>
                        </div>
</div> <!-- End Tab_UL -->
</div>
</div> <!-- End InnerSearch -->
<section class="map-search">
        <div class="col-xs-12 col-sm-12 col-md-12 nopadding"> <div class="maparea"> <div id="map_canvas" class="mapping"> </div>  </div>  </div>
        <div class="container">
                <div class="col-lg-12 listsection">
                    <?php
                    $listingResultJson = $listingResult;                    
                    if (!empty($listingResult)) {
                        foreach ($listingResult as $key => $listing) {
                            $photos = getPhotosData($listing["eid"]);
                            $basePrice = getBasePrice($listing["eid"]);
                            $offers = getOffersAndDiscountsData($listing["eid"]);
                            /*
                              echo "<pre>";
                              print_r($offers);
                              continue; */
                            $offerStack = array();
                            if (!empty($offers)) {
                                $listingResultJson[$key]['base_price'] = $basePrice["base_price"];
                                //check for all conditions 24h , last min, Early bird

                                /* echo "<pre>";
                                  print_r($offers);
                                  die; */
                                $offerStack = checkOfferApply($offers, $listing);
                                $offerUriParam = (isset($offerStack['offer_type'])) ? '?offer=' . base64_encode($offerStack['offer_type']) : '';
                            }
                            ?>

                            <div  class="col-xs-12 col-sm-4 col-md-4 listing listing_container_head" style="display:none;">
                                <div class="block"> 
                                    <div class="flexslider">
                                        <ul class="slides">
                                            <?php
                                            if (count($photos) > 0) {
                                                foreach ($photos as $imgKey => $photo) {
                                                    $photo = unserialize($photo["value1"]);
                                                    $file = file_load($photo["fid"]);
                                                    $imgpath = $file->uri;
                                                    $style = 'listing_slider';

                                                    //set image into json array for map element
                                                    if ($imgKey == 0) {
                                                        $listingResultJson[$key]['photo'] = image_style_url($style, $imgpath);
                                                    }
                                                    $noImage = base_path() . drupal_get_path('theme', 'gloobers') . '/images/img/place1.png';
                                                    ?>
                                                    <li>
                                                        <a href="<?php print $base_url; ?>/experience/<?php echo $listing["eid"] . $offerUriParam; ?>" >
                                                            <img src="<?php print image_style_url($style, $imgpath); ?>" alt="place" onError="imgError(this)" />
                                                        </a>
                                                    </li>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <li>
                                                    <a href="<?php print $base_url; ?>/experience/<?php echo $listing["eid"] . $offerUriParam; ?>" >
                                                        <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/img/place1.png" alt="place" />
                                                    </a>
                                                </li>                           
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                    </div> <!-- flex ends -->
<div class="listdetail">
<div class="click"><a href="#" class="listicon"><span></span><span></span><span></span></a></div>
<div class="listview">
<ul>
<?php
$status = getWishlistStatus($listing["eid"]);
$styleWishList = (isset($status["in_wishlist"]) && $status["in_wishlist"] == 1) ? 'style="border:1px solid #fff;color:#fff"' : 'style="border:1px solid #FFF;color:#FFF"';
$styleWishListFlag = (isset($status["in_wishlist"]) && $status["in_wishlist"] == 1) ? '1' : '0';
if (!$user->uid) {
?>
<li><a href="#" data-toggle="modal" data-target="#login" data-whatever=""><i <?php echo $styleWishList; ?> class="fa fa-heart"></i>Add to wishlist</a></li>
<?php } else { ?>
<li><a href="#" class="add_to_wishlist" data-attr="<?php echo $styleWishListFlag . ',' . $listing["eid"]; ?>"><i <?php echo $styleWishList; ?> class="fa fa-heart"></i>Add to wishlist</a></li>
<?php } ?>
<li><a href="<?php print $base_url; ?>/experience/<?php echo $listing["eid"]; ?>" target="_blank"><i class="fa fa-eye"></i>View details</a></li>
<li><a href="javascript:void(0)" onclick="addlisting('<?php echo $listing["eid"]; ?>')"><i class="fa fa-plus"></i>Recommend listing </a></li>
</ul>
</div>
</div>
                                    <div class="tagsec">
                                        <?php
                                        echo (isset($offerStack['html'])) ? $offerStack['html'] : '';
                                        ?>
                                        <div class="price">
                                            <p>$<?php echo $listing["min_price"]; ?></p>
                                        </div>
                                    </div>
                                    <?php
                                    //check for reviews
                                    $reviews = getListingReviews($listing["eid"]);
                                    if (!empty($reviews)) {
                                        ?>
                                        <div class="review">
                                            <p><span><?php echo count($reviews); ?></span><br>
                                                <?php echo (count($reviews) > 1) ? 'reviews' : 'review'; ?></p>
                                            <div class="botarrow"><img src="<?php echo $base_url . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/images/arrow-cmnt.png" alt=" "></div>
                                        </div>
                                    <?php } ?>
                                    <div class="clientpic">
                                        <?php
                                        $userDetails = user_load($listing["uid"]);
                                        if ($userDetails->picture != "") {
                                            $file = file_load($userDetails->picture->fid);
                                            $imgpath = $file->uri;
                                            ?>
                                            <a href="<?php  echo $base_url.'/profile/'.$userDetails->uid; ?>" target="_blank" >
                                            <img src="<?php print file_create_url($imgpath); ?>" alt="display pic" />
                                            <!--<img alt=" " src="<?php //print $imgpath; ?>" alt="display pic">-->
                                            </a>
                                            <?php
                                        } else {
                                            ?>
                                            <a href="<?php  echo $base_url.'/profile/'.$userDetails->uid; ?>" target="_blank" >
                                            <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/no-profile-male-img.jpg" alt="display pic" />
                                            </a>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="headingsec">
                                    <h2><a href="<?php print $base_url; ?>/experience/<?php echo $listing["eid"]; ?>"><?php echo ucwords($listing["title"]); ?></a></h2>
                                    <p><span><?php echo (strlen($listing["city"]) > 12) ? substr($listing["city"], 0, 12) . '..' : $listing["city"]; ?>, <?php echo $listing["state"]; ?></span> - <span><?php echo $listing["experience_type"]; ?></span></p>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                         echo "<div class='norecode'>
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
                    $listingCount = ($listingResultCount / 8);
                    $listingCount = ceil($listingCount);
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
                                $urlName = $base_url . '/search-destination/' . arg(1) . '?page=' . ($page - 1);
                                echo '<li><a href="' . $urlName . '"><i class="glyphicon glyphicon-chevron-left"></i></a></li>';
                            }

                            for ($i = 1; $i <= $listingCount; $i++) {
                                $currentClass = ($page == $i) ? 'current' : '';
                                $urlName = $base_url . '/search-destination/' . arg(1) . '?page=' . $i;
                                if ($i <= 3) {
                                    echo '<li><a href="' . $urlName . '" class="' . $currentClass . '">' . $i . '</a></li>';
                                }
                            }
                            if ($listingCount > 4) {
                                $urlName = $base_url . '/search-destination/' . arg(1) . '?page=' . ($page + 1);
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
<div id="modalAddToGide" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="add_to_guide_form">  
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Select Travel Guide</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <select id="_guideName" name="guideName" class="selectbox">
                                <option value =""> Select travel guide </option>                          
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

<script type="text/javascript">
jQuery(document).ready(function () {
        preLoading('show', 'load-screen');
        
/*SelectBox*/
jQuery("select").selectbox(); 
jQuery(document).click(function(e){
    if (!jQuery(e.target).is('.sbHolder, .sbHolder *')) {
        jQuery("select").selectbox('close'); 
    } 
}); //End

jQuery(".filtersearch").click(function(){
        jQuery('.sidebar').slideToggle();
        jQuery(".filtersearch span i").toggleClass("filter-icon-active");
    });

//Listing()
jQuery(".listicon").click(function(event){
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
            min: <?php echo ($listing["min_price"]) ? $listing["min_price"] : 0; ?>,
            max: <?php echo ($listing["max_price"]) ?$listing["max_price"] : 100; ?>,
            values: [0, 500]
        }).on('slideStop', function (event) {
            var cObj = {
                min: event.value[0],
                max: event.value[1],
                expType: jQuery('#select_experience_type').val(),
                when: jQuery('#datetimepicker2').val(),
                person: jQuery('#select_persons').val(),
                place: '<?php echo arg(1) ?>',
                action: 'search'
            };
            setFilter(cObj);
        });

        //Datepicker filter event bind
        jQuery('#datetimepicker2').datetimepicker({
            pickTime: false
        }).on('dp.change', function (e) {
            var cObj = {
                min: <?php echo ($listing["min_price"]) ? $listing["min_price"] : 0; ?>,
                max: <?php echo ($listing["max_price"]) ?$listing["max_price"] : 100; ?>,
                expType: jQuery('#select_experience_type').val(),
                person: jQuery('#select_persons').val(),
                when: (e.delegateTarget.value),
                place: '<?php echo arg(1) ?>',
                action: 'search'
            }
            setFilter(cObj);
        });
        //alert("1");
        if (jQuery('.listsection .listing_container_head').length > 0) {
            initialize();
        } else {
           // timezone_convert_helper_getLatiLongByAddress(<?php echo arg(1); ?>)
            initialize_blank('<?php echo arg(1); ?>');
        }
        
        jQuery('.paging-sec').css('display','block');
    });

    //Listing category filter event bind
    jQuery(document).on('change', '#select_experience_type', function () {
        var cObj = {
            min: <?php echo ($listing["min_price"]) ? $listing["min_price"] : 0; ?>,
            max: <?php echo ($listing["max_price"]) ?$listing["max_price"] : 100; ?>,
            expType: this.value,
            when: jQuery('#datetimepicker2').val(),
            person: jQuery('#select_persons').val(),
            place: '<?php echo arg(1) ?>',
            action: 'search'
        }
        setFilter(cObj);
    });




    //Select person quantity filter event bind
    jQuery(document).on('change', '#select_persons', function () {
        var cObj = {
             min: <?php echo ($listing["min_price"]) ? $listing["min_price"] : 0; ?>,
            max: <?php echo ($listing["max_price"]) ?$listing["max_price"] : 100; ?>,
            expType: jQuery('#select_experience_type').val(),
            when: jQuery('#datetimepicker2').val(),
            person: this.value,
            place: '<?php echo arg(1) ?>',
            action: 'search'
        }
        setFilter(cObj);
    });

    //Ajax request based on filtes paramters
    var setFilter = function (obj) {

        var data = {'min': obj.min, 'max': obj.max, 'action': obj.action, type: 'my_listing', 'page': '<?php echo $_GET['page']; ?>'};
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

            },
        });

    };

    function imgError(el) {
        var noImage = $baseUrl + '/' + $globalThemeUrl + '/images/img/place1.png';
        jQuery(el).attr('src', noImage);
    }
</script>

<script>
    addToWishList();
    jQuery('.offers-listing').on('click', function () {

        var cObj = {
             min: <?php echo ($listing["min_price"]) ? $listing["min_price"] : 0; ?>,
            max: <?php echo ($listing["max_price"]) ?$listing["max_price"] : 100; ?>,
            expType: jQuery('#select_experience_type').val(),
            when: jQuery('#datetimepicker2').val(),
            person: jQuery('#select_persons').val(),
            place: '<?php echo arg(1) ?>',
            offers: jQuery('#offerFrm').serialize(),
            action: 'search'
        }
        setFilter(cObj);
    });

    function initialize_blank(arg) {
        var geocoder = new google.maps.Geocoder();
        var lat= <?php echo $lat_long['lati'];  ?>;
        var longt= <?php echo $lat_long['long'];  ?>;
        geocoder.geocode({'address': arg}, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                //longt = (results[0].geometry.location.D);
                //lat = (results[0].geometry.location.k);

                var centerlatlng = new google.maps.LatLng(lat, longt);
                var myOptions = {
					minZoom: 2,
					maxZoom: 13,
                    center: centerlatlng,
                    disableDefaultUI: true,
                    mapTypeId: 'roadmap'
                };
                var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

            }
        });
    }

    function initialize(arg) {
        
        var map;
        var bounds = new google.maps.LatLngBounds();
        var mapOptions = {
            mapTypeId: 'roadmap',
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
        // alert(value.eid);
        //alert(key);
        //alert(value.base_price);
        //marker value
            var lat = parseFloat(value.latitude);
            var longt = parseFloat(value.longitude);
             var Base_price = parseFloat(value.min_price);
            markerValue[key] = [value.city + ',' + value.country, lat, longt],
                    //Marker content
                    markerContent[key] = ['<div class="info_content"><a href="' + $baseUrl + '/experience/' + value.eid + '">' +
                        '<p><img onError="imgError(this)" src="' + value.photo + '"  height="176"><div class="price" style="background: none repeat scroll 0 0 #000;bottom: 60px;color: #fff;float: left;opacity: 0.65;padding: 6px;position: absolute;text-align: center;width: 90px;" ><h4>$' + Base_price + '</h4></div></p>' +
                        '<h4>' + value.title + '- ' + value.experience_type + '</h4></a>' +
                        '<small>' + value.city + ',' + value.country + '</small>' + '</div>'];
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
            else if (value == 'Hotels') {
                window.location.href = '<?= $base_url; ?>/search-hotel/' + keyword;
            }
            else if (value == 'Gloobers') {
                window.location.href = '<?= $base_url; ?>/Gloobers/' + keyword;
            }
            else{
                  preLoading('hide', 'load-screen');
            }
        });

    });
function search_destination(){

        var home_autocomplete = new google.maps.places.Autocomplete(
                /** @type {HTMLInputElement} */
                        (document.getElementById('advice_destination')),
                        {types: ['geocode']});
        google.maps.event.addListener(home_autocomplete, 'place_changed', function () {
        });
    }
function addlisting(eid){
   // alert(eid);
    var myurl=window.location.href;
    var pathname = window.location.pathname.split("/");
    var uid = pathname[pathname.length-2];
    var rid = pathname[pathname.length-1];
    jq.ajax({
                url: $baseUrl + '/advice/ajax/adviceListToUser',
                type: 'post',
                data: {'user_id':uid,'listing_id':eid,'request_id':rid},
                beforeSend: function () {
                    preLoading('show', 'load-screen');
                },
                success: function (data) {
                   var res = jQuery.parseJSON(data);
                   preLoading('hide', 'load-screen');
                    if (res.status == 'success') {
                            jQuery.notify(res.message, {globalPosition: 'top center', className: 'success'});
                    }else{
                            jQuery.notify(res.message, {globalPosition: 'top center', className: 'error'});
                    }
                }
            });

}
</script>