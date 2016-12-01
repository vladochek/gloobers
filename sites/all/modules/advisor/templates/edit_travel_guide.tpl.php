<?php

global $base_url,$user;



/*echo "<pre>-=====";

print_r($locationDetails);

die;*/

if(($locationDetails[0]['traveller_uid'])==($user->uid)){



    $advisorId='?advisorId='.base64_encode($locationDetails[0]['advisor_uid']);

}else{





    $advisorId='';

}

/* Flex slider */

?>



<div class="col-lg-12 nopadding listsection">

    <?php

    $listingResultJson = json_encode($listingResult);
   
    $listingResultJson = $listingResult;

    if (!empty($listingResult)) {
        foreach ($listingResult as $key => $listing) {

            $photos = getPhotosData($listing["eid"]);

            $basePrice = getBasePrice($listing["eid"]);

            $offers = getOffersAndDiscountsData($listing["eid"]);



//              echo "<pre>";

//              print_r($offers);

//              continue; 

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



            <div  class="col-xs-12 col-sm-4 col-md-4 listing listing_container_head">

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

                                        <a href="<?php print $base_url; ?>/experience/<?php echo $listing["eid"] . $offerUriParam.$advisorId; ?>" >

                                            <img src="<?php print image_style_url($style, $imgpath); ?>" alt="place" onError="imgError(this)" />

                                        </a>

                                    </li>

                                    <?php

                                }

                            } else {

                                ?>

                                <li>

                                    <a href="<?php print $base_url; ?>/experience/<?php echo $listing["eid"] . $offerUriParam.$advisorId; ?>" >

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

        <!--                                                <li><a href="#"><i class="fa fa-link"></i>Recommend to a friend</a></li>-->

                                <?php

                                $status = getWishlistStatus($listing["eid"]);

                                $styleWishList = (isset($status["in_wishlist"]) && $status["in_wishlist"] == 1) ? 'style="border:1px solid #e14776;color:#e14776"' : 'style="border:1px solid #FFF;color:#FFF"';

                                $styleWishListFlag = (isset($status["in_wishlist"]) && $status["in_wishlist"] == 1) ? '1' : '0';

                                if (!$user->uid) {

                                    ?>

                                    <li><a href="#" data-toggle="modal" data-target="#login" data-whatever=""><i <?php echo $styleWishList; ?> class="fa fa-heart"></i>Add to wishlist</a></li>
                                    
                                <?php } else { ?>

                                    <li><a href="#" class="add_to_wishlist" data-attr="<?php echo $styleWishListFlag . ',' . $listing["eid"]; ?>"><i <?php echo $styleWishList; ?> class="fa fa-heart"></i>Add to wishlist</a></li>

                                <?php } ?>

                                <li><a href="<?php print $base_url; ?>/experience/<?php echo $listing["eid"]; ?>" target="_blank"><i class="fa fa-eye"></i>View details</a></li>

                                <li><a href="javascript:void(0)" onclick="removelisting(<?php echo $listing["eid"]; ?>);"><i class="fa fa-plus"></i>Remove listing</a></li>

                                <!--                                                <li><a href="#"><i class="fa fa-flag-o"></i>Report this listing</a></li>

                                <li><a href="#"><i class="fa fa-arrows-h"></i>Embed on my website</a></li>-->

                            </ul>

                        </div>

                    </div>

                    <div class="tagsec">

                        <?php

                        echo (isset($offerStack['html'])) ? $offerStack['html'] : '';

                        ?>

                        <div class="price">

                            <p>$<?php echo $basePrice["base_price"]; ?></p>

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

                            <img src="<?php print file_create_url($imgpath); ?>" alt="display pic" />

                            <?php

                        } else {

                            ?>

                            <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/no-profile-male-img.jpg" alt="display pic" />

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

        echo "<div class='norecode'>No Listing Found</div>";

    }



    //$listingResultJson = json_encode($listingResultJson);

    ?>

</div>
<script>
 //Remove liting for a particulor guide 

function removelisting(listing_id){
    
    
        var travel_guide_id = getParameterByName('tgid');
        
           jQuery.ajax({
                    type: 'POST',
                    url: $baseUrl + '/advice/ajax/removelistingguide',
                    data: {'travel_guide_id':travel_guide_id,'listing_id':listing_id},
                    success: function (data) {
                        var res = jQuery.parseJSON(data);
                            if (res.status == 'success') {
                                jQuery.notify(res.message, {globalPosition: 'top center', className: 'success'});
                                }else{
                                jQuery.notify(res.message, {globalPosition: 'top center', className: 'error'});
                                }
                       
                    },
            }); 
    

}
function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

</script>
