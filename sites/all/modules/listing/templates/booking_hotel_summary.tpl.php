<?php

global $base_url;

drupal_add_css(drupal_get_path('theme', 'gloobers_new') . '/css/gloobers.css', 'file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') . '/stylesheet/for-head-foot.css', 'file');


$forms = drupal_get_form('hotel_booking_summary_form');


if ($rulesDetail['security_options'] == 'amount_in_$') {
    $currencY_dollar = '$';
} else {
    $currencY_dollar = '';
    $currencY_percentage = '%';
}


$style = 'summary_img_style';
$Currency = '$';
//echo "<pre>";Print_r($_SESSION['order']['disscountOfferApply']);exit;
?>
<script type="text/javascript">
    jQuery.noConflict();
    jQuery(document).ready(function () {
//jQuery(".creditmessage").fadeOut(7000);
        jQuery('#hotel_booking_summary_form').validate({
            rules: {
                cardholdername: {
                    required: true,
                },
                securitycode: {
                    required: true,
                    number: true
                },
                creditcardno: {
                    required: true,
                    number: true
                },
                companyname: {
                    required: true,
                },
                street: {
                    required: true,
                },
                city: {
                    required: true,
                },
                zip: {
                    required: true, number: true
                },
                state: {
                    required: true,
                },
                number: {
                    required: true,
                    number: true
                }
            }
        });
        var imagePath = "<?php print image_style_url($style, $_SESSION['order']['imagepath']); ?>";
        jQuery(".reserv-detail").css("background", 'url(' + imagePath + ')0 0 no-repeat');

    });
</script>


<div class="dr-wrapper">

    <section class="summary-sec">

        <h1>Hotel Reservation Details</h1>
        <?php //if(isset($_SESSION['payment_message'])){ echo '<h1 class="payment_message">'.$_SESSION['payment_message'].'</h1>';}   ?>
        <div class="col-lg-12 reserv-detail nopadding">

            <div class="col-xs-12 col-sm-12 col-md-12 nopadding rightcolsec">
                <?php
                $counter = 0;
                $total_price = 0;
                
                foreach ($cart_values as $key => $values) {
                    $hotel_id = $values["hotel_id"];
                    $total_price = $total_price + $values["price"];
                    $hotel_data = getHotelDetailById($hotel_id);
                    $room_detail = getRoomDetailByRoomId($values["room_id"]);
                    $room_image = json_decode($room_detail[0]["room_images"]);
                    if ($counter == 0) {
                        ?>
                        <div class="col-lg-12 rdetail">
                            <h2 class="text-center"><?= $hotel_data[0]['hotel_name']; ?></h2>
                            <p class="text-center"><?php echo $hotel_data[0]['hotel_city'] . ', ' . $hotel_data[0]['hotel_country']; ?></p>
                        </div>
                    <?php } ?>
                    <div class="col-lg-12 rdetail bgcolor">
                        <div class="col-xs-7 col-sm-7 col-md-7 nopadding">
                        <h2>Room : <strong><?= $room_detail[0]["room_name"] ?></strong></h2>
                        <div class="selectedroomimg">
                        <img src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', 'hotel_theme'); ?>/rooms_img/main/<?= $room_image[0];?>" alt="<?= $room_detail[0]["room_name"] ?>" title="" width="555px" height="316px" />
                        </div> <!-- End SelectedRoom -->
                        
                        </div>
                        <div class="col-xs-5 col-sm-5 col-md-5 rightborder roomdetailchk">
                            <h2>Details:- </h2>
                            <ul>
                            <li><span>Price($) :</span> <b><?= number_format($values["price"], 2); ?></b></li>
							<li><span>Check In Date :</span> <b><?= $values["check_in"]; ?></b></li>
							<li><span>Check Out Date :</span> <b> <?= $values["check_out"]; ?></b></li>
							<li><span>No. of rooms :</span> <b> <?= $values["no_of_room"]; ?></b></li>
							<li><span>Seasonnal Pricing ? :</span> <b><?= isset($values["seasonal_offer"]) && $values["seasonal_offer"] == 1 ? 'Yes' : 'No'; ?></b></li>
							<li><span>24 Hour Offer Applied ? :</span> <b> <?= isset($values["24_hour_offer"]) && $values["24_hour_offer"] == 1 ? 'Yes' : 'No'; ?></b><br/>
							<li><span>Last Minute Offer Applied ? :</span> <b> <?= isset($values["last_min_offer"]) && $values["last_min_offer"] == 1 ? 'Yes' : 'No'; ?></b></li>
							<li><span>Early Bird Offer Applied ? :</span>  <b><?= isset($values["early_bird_offer"]) && $values["early_bird_offer"] == 1 ? 'Yes' : 'No'; ?></b></li>
                            </ul>
                        </div>
                        <div> </div>
                    </div>
                    <?php
                    $counter++;
                }
                ?>
                <div class="col-lg-12 rdetail ttlblock">
                     <h2><span>Total</span> <strong><?= "$ " . number_format($total_price, 2); ?></strong></h2>
                </div>


            </div>

        </div> 
        <?php
        $creditsPerDollar = 1;
        $MaxUsedCredits = ($paybleprice) * (1 / $creditsPerDollar);
        if ($totalCredits < $MaxUsedCredits) {
            $MaxUsedCredits = $totalCredits;
        }
        if ($MaxUsedCredits <= 200) {
            $valueGap = 10;
        } else if ($MaxUsedCredits <= 500) {
            $valueGap = 50;
        } else if ($MaxUsedCredits > 500) {
            $valueGap = 100;
        }
        ?>
        <div class="btnpanel">
            <?php if ($MaxUsedCredits > 0) { ?>
                <a class="btnsend modified_send"  data-toggle="modal" data-target="#recommend">USE MY CREDITS</a>
            <?php } else { ?>
                <a class="btnsend" href="javascript:void(0)">NO CREDITS</a>
            <?php } ?>
            <a class="btncncl modified_cancel" href="javascript:void(0);" onclick="history.go(-1);">MODIFY RESERVATION</a>

        </div>
        <form id="<?php echo $forms['#form_id']; ?>"  accept-charset="UTF-8" method="<?php echo $forms['#method']; ?>" action="<?php echo $forms['#action']; ?>">

            <div class="col-lg-12 nopadding">
                <div class="paymntsec">
                    <h2>Payment</h2>
                    <p>Even If  You Can Pay The Entire Reservation Amount With Your Credits, We Will Need To Verify You Credit Card For The 
                        Deposit Amount.</p>
                    <div class="col-lg-12 formbar">

                        <?php echo drupal_render($forms['booking_summary']['paymenttype']); ?>
                        <div class="col-md-6">
                            <label>&nbsp;</label>
                            <img src="<?php echo $base_url . '/' . drupal_get_path('theme', 'gloobers_new'); ?>/images/cards.png" alt="" title="" /></div>
                    </div>
                    <div class="col-lg-12 formbar">
                        <?php echo drupal_render($forms['booking_summary']['creditdata']); ?>
                        <?php echo drupal_render($forms['booking_summary']['creditcardno']); ?>
                    </div>

                    <div class="col-lg-12 formbar">
                        <div class="col-md-6 nopadding">
                            <div class="col-lg-12 nopadding">
                                <?php echo drupal_render($forms['booking_summary']['expirationmonth']); ?>
                                <?php echo drupal_render($forms['booking_summary']['expirationyear']); ?>
                                <?php echo drupal_render($forms['booking_summary']['securitycode']); ?>
                            </div>
                        </div>
                        <?php echo drupal_render($forms['booking_summary']['cardholdername']); ?> 

                    </div>
                </div>
            </div>
            <div class="col-lg-12 nopadding">
                <div class="billsec">
                    <h2>Billing</h2>
                    <div class="col-lg-12 formbar">
                        <?php echo drupal_render($forms['booking_summary']['companyname']); ?> 
                    </div>
                    <div class="col-lg-12 formbar">
                        <?php echo drupal_render($forms['booking_summary']['firstname']); ?> 
                        <?php echo drupal_render($forms['booking_summary']['lastname']); ?> 
                    </div>
                    <div class="col-lg-12 formbar">

                        <?php echo drupal_render($forms['booking_summary']['street']); ?> 
                        <div class="col-md-6 nopadding">
                            <div class="col-lg-12 nopadding">
                                <?php echo drupal_render($forms['booking_summary']['number']); ?> 
                                <?php echo drupal_render($forms['booking_summary']['apt']); ?> 
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 formbar">
                        <div class="col-md-6 nopadding">
                            <div class="col-lg-12 nopadding">
                                <?php echo drupal_render($forms['booking_summary']['city']); ?> 
                                <?php echo drupal_render($forms['booking_summary']['zip']); ?> 
                            </div>
                        </div>
                        <div class="col-md-6 nopadding">
                            <div class="col-lg-12 nopadding">
                                <?php echo drupal_render($forms['booking_summary']['state']); ?> 
                                <?php echo drupal_render($forms['booking_summary']['country']); ?> 
                            </div>
                        </div>
                    </div>
                </div>

                <div class="msgsec">
                    <div class="msgclient"> 
                        <?php
                        if (!empty($userDetails->picture)) {
                            $fid = $userDetails->picture->fid;
                            //echo $fid;exit;
                            $file = file_load($fid);
                            $imgpath = $file->uri;
                            $imgpath = ($imgpath) ? $imgpath : '';
                            $style = 'experience_topranked';
                            $src = image_style_url($style, $imgpath);
                        }
                        if ($imgpath != '') {
                            ?>
                            <img alt="profile pic" src="<?php echo $src; ?>">  
                        <?php } else { ?>
                            <img alt="no profile pic" src="<?php echo $base_url . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/images/no-profile-male-img.jpg">  
                        <?php } ?>
                        <h2>Leave A Message</h2>
                    </div>
                    <br class="clear"/>
                    <p>Any Other Information You Would Like To Share WIth The Owner. Special Request Or Information About Your Arrival.</p>
                    <?php echo drupal_render($forms['booking_summary']['message']); ?>
                </div>

                <?php echo drupal_render($forms['booking_summary']['submit']); ?> 
                <input type="hidden" value="<?php echo $forms['form_build_id']['#value']; ?>" name="form_build_id">
                <input type="hidden" value="<?php echo $forms['form_token']['#default_value']; ?>" name="form_token">
                <input type="hidden" value="<?php echo $forms['#form_id']; ?>" name="form_id">
                <input type="hidden" value="<?php echo $total_price; ?>" name="total_price">
            </div>








    </section>

</div></form>

<div class="modal fade" id="recommend" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="padding-right:0px !important;">
    <div class="modal-dialog creditpop">
        <div class="modal-content creditpanel">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 style="color:#000;" class="modal-title">Use My Credits</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo $base_url; ?>/booking/usecredits">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Total Available Credits:- <span class="totalcredits">N/A</span></label>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Use Your Available Credits</label>
                    </div>
                    <div class="form-group">
                        <div class="input-group spinner">
                            <input type="text" class="form-control credit_val" name="credit_used" value="<?php echo $MaxUsedCredits; ?>" readonly="readonly" >
                            <div class="input-group-btn-vertical">
                                <div class="btn btn-default"><i class="fa fa-caret-up"></i><i class="fa fa-caret-down"></i></div>

                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btnsend">Apply</button>

                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Left Credits:- <span class="leftcredits">N/A</span></label>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function checkcreditdata() {
        var totalCredit = '<?php echo $totalCredits; ?>';
        var credits = jQuery('.credit_val').val();
        var remaining = parseInt(totalCredit) - parseInt(credits);
        jQuery('.leftcredits').html(remaining);

    }
    jQuery(document).ready(function () {
        var credits = jQuery('.credit_val').val();
        jQuery.ajax({
            url: $baseUrl + '/ajax/getCredits',
            type: 'post',
            data: {credits: credits},
            dataType: "json",
            success: function (data) {
                jQuery('.totalcredits').html(data[0]);
                jQuery('.leftcredits').html(data[1]);
            }
        });
    });

    (function (jQuery) {
        var maxUsedCredits = "<?php echo $MaxUsedCredits; ?>";
        var valueGap = "<?php echo $valueGap; ?>";
        jQuery('.spinner .btn:first-of-type').on('click', function () {
            if (jQuery('.spinner input').val() < parseInt(maxUsedCredits))
            {
                jQuery('.spinner input').val(parseInt(jQuery('.spinner input').val(), 10) + parseInt(valueGap));
                checkcreditdata();
            }
        });
        jQuery('.spinner .btn:last-of-type').on('click', function () {
            if (jQuery('.spinner input').val() > parseInt(valueGap))
            {
                jQuery('.spinner input').val(parseInt(jQuery('.spinner input').val(), 10) - parseInt(valueGap));
                checkcreditdata();
            }
        });
        jQuery('.payment_message').fadeOut(10000);
    })(jQuery);

</script>