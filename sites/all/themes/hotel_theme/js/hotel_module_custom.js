jQuery.noConflict();
count = 0;
jQuery(document).ready(function () {
    /**
     * to remove additional tags
     */
//jQuery("#fileInput").remove();
//jQuery("#ascrail2000-hr").closest("#fileInput").remove();



    /**
     * for count character in hotel overview
     */
    characterCount('edit-hotel-title', 35);
    characterCount('edit-hotel-description', 2000);
    characterCount('hotel-location-description', 2000);
    /**
     * For hotel add validations
     */
    jQuery("#hotel-details-form").validate({
        rules: {
            hotel_type: "required",
            hotel_rating: "required",
            hotel_title: "required",
            hotel_description: {
                required: true,
                minlength: 2,
                maxlength: 2000

            }
        },
        messages: {
            hotel_type: "Please select hotel type",
            hotel_rating: "Please select hotel rating",
            hotel_title: "Please enter hotel title",
            hotel_description: {
                required: "Please enter description",
                minlength: "Hotel description must be of 2 to 2000 characters",
                maxlength: "Hotel description must be of 2 to 2000 characters"

            }
        }

    });
    /**
     * For Optional services add validations
     */
    jQuery("body").on("click", "#service_add_btn", function () {

        jQuery("#hotel-optional-service-form").validate({
            rules: {
                service_name: {
                    required: true
                },
                service_price: {
                    required: true,
                    number: true
                },
                service_currency: {
                    required: true
                },
                service_customer_choice: {
                    required: true
                },
                service_description: {
                    required: true,
                    minlength: 2,
                    maxlength: 500

                },
                "service_name_extra[]": {
                    required: true
                },
                "service_price_extra[]": {
                    required: true,
                    number: true
                },
                "service_currency_extra[]": {
                    required: true
                },
                "service_customer_choice_extra[]": {
                    required: true
                },
                "service_description_extra[]": {
                    required: true,
                    minlength: 2,
                    maxlength: 2000

                }
            },
            messages: {
                service_name: {
                    required: "Please enter service name"
                },
                service_price: {
                    required: "Please enter service price",
                    number: "Please enter vaild price"
                },
                service_currency: {
                    required: "Please select currency"
                },
                service_customer_choice: {
                    required: "Please select customer choice"
                },
                service_description: {
                    required: "Please enter description",
                    minlength: "Service description must be of 2 to 2000 characters",
                    maxlength: "Service description must be of 2 to 2000 characters"

                },
                "service_name_extra[]": {
                    required: "Please enter service name"
                },
                "service_price_extra[]": {
                    required: "Please enter service price",
                    number: "Please enter vaild price"
                },
                "service_currency_extra[]": {
                    required: "Please select currency"
                },
                "service_customer_choice_extra[]": {
                    required: "Please select customer choice"
                },
                "service_description_extra[]": {
                    required: "Please enter description",
                    minlength: "Service description must be of 2 to 500 characters",
                    maxlength: "Service description must be of 2 to 500 characters"

                }
            },
        });
    });
    /**
     *For Room Create Validation
     */
    jQuery("body").on("click", ".hotel_room_create", function () {

        jQuery("#hotel-room-form").validate({
            ignore: "",
            rules: {
                "room_name[]": {
                    required: true
                },
                "room_quantity[]": {
                    required: true,
                    number: true
                },
                "real_beds[]": {
                    required: true
                },
                "real_bed_type[]": {
                    required: true
                },
                "room_bath[]": {
                    required: true
                },
                "additional_beds[]": {
                    required: true
                },
                "bed_type[]": {
                    required: true
                },
                "room_size[]": {
                    required: true,
                    number: true
                },
                "size_units[]": {
                    required: true
                },
                "max_occupancy[]": {
                    required: true
                },
                "max_adults[]": {
                    required: true
                },
                "max_children[]": {
                    required: true
                },
                "max_babies[]": {
                    required: true
                }
            },
            messages: {
                "room_name[]": {
                    required: "Please enter room name"
                },
                "room_quantity[]": {
                    required: "Please enter room quantity",
                    number: "Please enter vaild quantity"
                },
                "real_beds[]": {
                    required: "Please select no of beds"
                },
                "real_bed_type[]": {
                    required: "Please select real bed type"
                },
                "room_bath[]": {
                    required: "Please select no of bath"
                },
                "additional_beds[]": {
                    required: "Please select additional beds"
                },
                "bed_type[]": {
                    required: "Please select additional bed type"
                },
                "room_size[]": {
                    required: "Please enter room size",
                    number: "Please enter room size in numeric"
                },
                "size_units[]": {
                    required: "Please select room size unit"
                },
                "max_occupancy[]": {
                    required: "Please select maximum occupancy"
                },
                "max_adults[]": {
                    required: "Please select maximum no. of adults allowed in room"
                },
                "max_children[]": {
                    required: "Please select maximum no. of children allowed in room"
                },
                "max_babies[]": {
                    required: "Please select maximum no. of babies allowed in room"
                }
            }, submitHandler: function (form) {
                var exist = 0;
                jQuery(".room_name_array").each(function () {
                    var me = jQuery(this);
                    var counter = 0;
                    var value = me.val();
                    jQuery(".room_name_array").each(function () {
                        var my = jQuery(this);
                        if (jQuery.trim(value) === jQuery.trim(my.val())) {
                            counter++;
                        }
                        if (counter > 1) {
                            my.addClass("error");
                            my.focus();
                            my.parent().after("<span class='error_focus'>Room name must be  unique</span>");
                            return false;
                        }
                    });
                    if (counter > 1) {
                        exist = 1;
                        return false;
                    }

                    counter = 0;
                });
                if (exist == 1) {
                    return false;
                } else {
                    form.submit();
                }
            }
        });
    });
    /**
     * for repeat rules and policies
     */
    jQuery("body").on("click", ".addanotherrequirement", function () {
        var me = jQuery(this);
        var HTML = '<div class="requirement_more"> <div class="col-md-8 col-lg-8 col-sm-8 col-xs-12 padding_left">';
        HTML += '<input name="requirements[]" id="requirements_' + jQuery.now() + '" class="focus_help_menu" placeholder="Requirement name" type="text" />';
        HTML += '</div><div class="col-md-4 col-lg-4 col-sm-4 col-xs-12 paddng_right" ><a href="javascript:void(0);" class="removeRequirement">Remove </a></div></div>';
        jQuery(".requirement_more:last").after(HTML);
    });
    /**
     * remove extra requirements
     * 
     */
    jQuery("body").on("click", ".removeRequirement", function () {
        var me = jQuery(this);
        me.parent().parent().remove();
    });
    /**
     *For Rules and Policy  Form  Validation
     */
    jQuery('body').on('click', '#hotel_rules_policies_btn', function () {
        jQuery("#hotel-rules-policies-form").validate({
            rules: {
                "requirements[]": {
                    required: true
                },
                other_info: {
                    required: true
                },
                secuirty_amount: {
                    required: true,
                    number: true
                },
                secuirty_currency: {
                    required: true
                },
                cancel_policy: {
                    required: true
                },
                early_cancel_amount: {
                    required: true
                },
                early_cancel_time: {
                    required: true
                },
                early_travel_amount: {
                    required: true
                },
                early_travel_amounttype: {
                    required: true
                },
                late_cancel_time: {
                    required: true
                },
                late_travel_amount: {
                    required: true
                },
                late_travel_amounttype: {
                    required: true
                },
                noshow_travel_amount: {
                    required: true
                },
                noshow_travel_time: {
                    required: true
                },
                noshow_reservation_amount: {
                    required: true
                },
                noshow_reservation_amounttype: {
                    required: true
                },
            },
        });
    });
    /***********************************Start pricing form Validation***********************/
    /**
     * form validation for pricing form 
     */
    jQuery("body").on("click", "#hotel_pricing_btn", function () {
        jQuery("#hotel-pricing-form").validate({
            rules: {
                currency: {
                    required: true
                },
                "room_night_rate[]": {
                    required: true,
                    number: true
                },
                "room_weekend_rate[]": {
                    required: true,
                    number: true
                },
                "room_weekly_rate[]": {
                    required: true,
                    number: true
                },
                "room_weekend_days[]": {
                    required: true
                },
                "room_default_board[]": {
                    required: true
                },
                "board_type[]": {
                    required: true
                },
                "rent_adjust_type[]": {
                    required: true
                },
                "rent_adjust_price[]": {
                    required: true,
                    number: true
                },
                "rent_adjust_duration[]": {
                    required: true
                },
                "seasonal_name[]": {
                    required: true
                },
                "seasonal_date[]": {
                    required: true
                },
                "seasonal_till_date[]": {
                    required: true
                },
                "seasonal_minstay[]": {
                    required: true
                },
                "nightly_rate[]": {
                    required: true,
                    number: true
                },
                "weekendrate[]": {
                    required: true,
                    number: true
                },
                "weeklyrate[]": {
                    required: true,
                    number: true
                },
                "offer_24_date[]": {
                    required: true
                },
                "offer_24_amount[]": {
                    required: true,
                    number: true
                },
                "offer_24_currency[]": {
                    required: true
                },
                "lastmin_time_value[]": {
                    required: true
                },
                "lastmin_time_type[]": {
                    required: true
                },
                "lastmin_amount[]": {
                    required: true
                },
                "lastmin_currency[]": {
                    required: true
                },
                "earlybird_time_val[]": {
                    required: true
                },
                "earlybird_time_type[]": {
                    required: true
                },
                "earlybird_amount[]": {
                    required: true
                },
                "earlybird_currency[]": {
                    required: true
                },
            },
            messages: {
            },
        });
    });
    /***********************************end of pricing form***********************/


    /**
     * add attribute in hotel & room photo form
     */

    jQuery("#hotel-photos-form").attr("enctype", "multipart/form-data");
    /***
     * 
     * for upload images
     */
    jQuery("body").on("click", "#photo_add_btn", function (e) {
        var ai = 1;
        if (jQuery(".room_pic_class").length > 0) {
            jQuery(".room_pic_class").each(function () {
                var $fileUpload = jQuery(this);
                var room_id = jQuery(this).attr("data-val");
                var help_id = jQuery(this).attr("data-data");
                remove_room = '';
                if (jQuery("input[name=jfiler-items-exclude-room_pics_" + room_id + "-" + help_id + "]").length > 0) {
                    remove_room = jQuery("input[name=jfiler-items-exclude-room_pics_" + room_id + "-" + help_id + "]").val();
                }
                if (parseInt($fileUpload.get(0).files.length) > 10) {
                    alert("You can only upload a maximum of 10 files for each room");
                    ai++;
                    if (ai != 1) {
                        return false;
                    }
                }
                var files = $fileUpload.get(0).files;
                for (i = 0; i < files.length; i++)
                {
                    if (parseInt(files[i].size) > 4000000)
                    {
                        var l = 1;
                        if ((remove_room == '') || (remove_room != '' && remove_room.indexOf(files[i].name) < 0)) {
                            alert("Please remove " + files[i].name + "  file From room " + help_id + ".its greater than 4mb");
                            l++;
                            ai++;
                        }
                        if (l != 1) {
                            return false;
                        }
                        if (ai != 1) {
                            return false;
                        }
                    }
                }
            });
        }

        if (ai != 1) {
            return false;
        }
        var $fileUpload = jQuery(".hotel_pics");
        if (parseInt($fileUpload.get(0).files.length) > 10) {
            alert("You can only upload a maximum of 10 files for hotel");
            return false;
        }
        var remove_hotel_img = '';
        if (jQuery("input[name=jfiler-items-exclude-hotel_pics-0]").length > 0) {
            remove_hotel_img = jQuery("input[name=jfiler-items-exclude-hotel_pics-0]").val();
        }
        var ai = 1;
        var files = $fileUpload.get(0).files;
        for (i = 0; i < files.length; i++)
        {
            if (parseInt(files[i].size) > 4000000)
            {
                var l = 1;
                if ((remove_hotel_img == '') || (remove_hotel_img != '' && remove_hotel_img.indexOf(files[i].name) < 0)) {
                    alert("Please remove " + files[i].name + "  file From hotel photos .its greater than 4mb");
                    l++;
                    ai++;
                }
                if (l != 1) {
                    return false;
                }
                if (ai != 1) {
                    return false;
                }
            }
        }
        if (ai != 1) {
            return false;
        }
        e.preventDefault();
        var me = jQuery(this);
        var data = new FormData();
        var hotel_pic = new Array();
        jQuery.each(jQuery('.hotel_pics')[0].files, function (i, file) {
            data.append("hotel_pic[]", file);
        });
        data.append('hotel_id', jQuery("#hotel_id_pic").val());
        data.append('room_ids', jQuery("#room_ids").val());
        data.append('hotel_edit_imgs', jQuery("#edit_hotel_img").val());
        var ids_data = jQuery("#room_ids").val();
        var id_array = ids_data.split(',');
        jQuery.each(id_array, function (k, val) {
            if (jQuery(".room_class_" + val).length > 0) {
                data.append('edit_room_img_' + val, jQuery("#edit_room_img_" + val).val());
                jQuery.each(jQuery(".room_class_" + val)[0].files, function (i, file) {
                    data.append('roompic_' + val + '[]', file);
                });
            }
        });
        var dataString = data;
        jQuery.ajax({
            url: $baseURL + '/hotel/ajax/hotelPics',
            data: dataString,
            type: "post",
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function (xhr) {
                preLoading('show', 'load-screen');
            },
            success: function (data) {
                preLoading('hide', 'load-screen');
                if (data == 'success') {
                    window.location.href = $baseURL + "/hotel/add/photos/" + jQuery("#hotel_id_pic").val();
                }

            }
        });
    });
    /**
     * FOR REPEAT OPTIONAL SERVICES FORM
     */
    var i = 1;
    jQuery("body").on("click", ".add_optional_services", function () {

        var me = jQuery(this);
        var HTML = '<div class="repeat_field"><fieldset><div class="col-lg-12 col-sm-12 col-xs-12 "><label>Service name</label>';
        HTML += '<div class="form-item form-type-textfield form-item-service-name-">';
        HTML += '<input type="text" class="focus_help_menu" data-val="optional_service_name" maxlength="128" size="60"  name="service_name_extra[' + i + ']" id="service_name_extra' + i + '" placeholder="Enter Your Title Here" class=" form-text required">';
        HTML += '</div></div></fieldset><fieldset><div class="col-lg-3 col-sm-12 col-xs-12 "><div class="home_town"><h3>Price</h3><div class="form-item form-type-textfield form-item-service-price-">';
        HTML += '<input type="text" class="focus_help_menu" dat-val="optional_service_price" maxlength="128" size="60"  name="service_price_extra[' + i + ']" id="service_price_extra' + i + '" placeholder="Amount" class=" form-text required">';
        HTML += '</div></div></div><div class="col-lg-4 col-sm-12 col-xs-12 "><div class="home_town"><h3>&nbsp;</h3><div class="form-item form-type-select form-item-service-currency-">';
        HTML += '<select class="select_box select_box_jq" name="service_currency_extra[' + i + ']" id="service_currency_extra' + i + '" class=" form-select required"><option selected="selected" >- Select -</option><option>1</option>';
        HTML += '<option>2</option><option>3</option><option>4</option><option>5</option></select>';
        HTML += '</div></div></div><div class="col-lg-5 col-sm-12 col-xs-12 "><div class="home_town"><h3>&nbsp;</h3><div class="form-item form-type-select form-item-service-customer-choice-">';
        HTML += '<select class="select_box select_box_jq" name="service_customer_choice_extra[' + i + ']" id="service_customer_choice_extra' + i + '" class=" form-select required"><option selected="selected" >- Select -</option><option>1</option>';
        HTML += '<option>2</option><option>3</option><option>4</option><option>5</option></select>';
        HTML += '</div></div></div></fieldset><fieldset><div class="col-lg-12 col-sm-12 col-xs-12"><label>Description</label><div class="form-item form-type-textarea form-item-service-description-">';
        HTML += '<div class="form-textarea-wrapper resizable textarea-processed resizable-textarea"><textarea rows="5" class="focus_help_menu" data-val="optional_service_description" cols="60" name="service_description_extra[' + i + ']" id="service_description_extra' + i + '" placeholder="Describe your service here." class=" form-textarea required"></textarea>';
        HTML += '<div class="grippie"></div></div></div></div></fieldset>';
        HTML += '<fieldset><div class="row"><div class="col-lg-12 col-sm-12 col-xs-12"><a class="add_service remove_optional_services" href="javascript:void(0);">Remove Services</a></div></div></fieldset></div>';
        i++;
        jQuery(".repeat_field:last").after(HTML);
    });
    /**'data-val'=>'optional_service_description'
     * remove optional services
     */
    jQuery("body").on("click", ".remove_optional_services", function () {
        var me = jQuery(this);
        me.parent().parent().parent().parent().remove();
    });
    /**
     * 
     * For Make duplicate rooms
     */
    jQuery("body").on("click", ".duplicate_room_form", function () {
        preLoading('show', 'load-screen');
        var me = jQuery(this);
        var HTML = '<div class="form_repeat_div">';
        HTML += me.parent().parent().parent().parent().parent().html();
        if (me.hasClass('iamfirst')) {
            HTML += '<div class="col-xs-12 col-sm-12 col-md-12"> <h4><a href="javascript:void(0);" class="remove_rooms" >Remove room</h4> </div></div>';
        }
        preLoading('hide', 'load-screen');
        jQuery(".form_repeat_div:last").after(HTML);
        jQuery(".form_repeat_div:last").find("input[type='text']").each(function () {
            var me = jQuery(this);
            var id = me.attr("id");
            me.attr("id", id + '_' + jQuery.now());
        });
        jQuery(".form_repeat_div:last").find("select").each(function () {
            var me = jQuery(this);
            var id = me.attr("id");
            me.attr("id", id + '_' + jQuery.now());
        });
        jQuery(".form_repeat_div:last").find("input[type='checkbox']").each(function () {
            var me = jQuery(this);
            var id = me.attr("id");
            if (me.hasClass("safe_amen")) {
                me.attr("name", "safety_amenities[" + count + "][]");
            }
            if (me.hasClass("room_amen"))
            {
                me.attr("name", "room_amenities[" + count + "][]");
            }
            var timestamp = jQuery.now();
            me.next('label').attr("for", id + '_' + timestamp);

            //alert(me.closest("label").attr("for"));//.attr("for", id + '_' + timestamp);
            me.attr("id", id + '_' + timestamp);
        });
        count++;
        if (me.hasClass('iamfirst')) {

            jQuery("body .first_duplicate_content:last").html('<a class="red delete_room"   href="javascript:void(0);">Delete this rooms</a>');
        }
    });
    /**
     * select help option tags
     */

    jQuery('body').on("click", ".focus_help_menu", function () {
        var my = jQuery(this);
        var class_helper = my.attr("data-val");
        jQuery('.help_class').hide();
        jQuery('div .' + class_helper + '_help').show();

    });
    jQuery(window).scroll(function () {
        var scroll = jQuery(window).scrollTop();
        //>=, not <=
        if (scroll >= 250) {
            jQuery(".help_block").addClass("darkHeader");
        }
        else {
            jQuery(".help_block").removeClass("darkHeader");
        }
    });
    /**
     * 
     * add more requirements
     * In Rules and policies
     */
    jQuery('body').on("click", ".addanother_requirement", function () {
        var me = jQuery(this);
        var HTML = '<input type="text" id="requirement_' + jQuery.now() + '" name="requirement_name[]" placeholder="Requirement Name" class="focus_help_menu form-text required" data-val="requirement_name"/>';
        HTML += '</div><div class="col-md-4 col-lg-4 col-sm-4 col-xs-12 paddng_right" >';
        HTML += '<a href="javascript:void(0);" class="remove_requirement">Remove </a></div></div></div>';
    });
    /**
     * 
     *remove requirements
     *In Rules and Policies
     */
    jQuery('body').on("click", ".remove_requirement", function () {
        var me = jQuery(this);
    });
    /**
     * 
     *Remove Hotel Images
     */
    jQuery("body").on("click", ".remove_hotel_img", function () {
        var me = jQuery(this);
        var value_img = me.attr("data-val");
        var remain_img = jQuery("#edit_hotel_img").val();
        remain_img = remain_img.replace(value_img, '');
        remain_img = remain_img.replace(/^,|,$/g, '');
        jQuery("#edit_hotel_img").val(remain_img);
        me.parent().parent().remove();
    });
    /**
     * 
     *Remove Room Images
     */
    jQuery("body").on("click", ".remove_room_img", function () {
        var me = jQuery(this);
        var value_img = me.attr("data-val");
        var room_id = me.attr("data-data");
        var remain_img = jQuery("#edit_room_img_" + room_id).val();
        remain_img = remain_img.replace(value_img, '');
        remain_img = remain_img.replace(/^,|,$/g, '');
        jQuery("#edit_room_img_" + room_id).val(remain_img);
        me.parent().parent().remove();
    });
    /***
     * 
     * Add more board
     */
    var board = 1;
    jQuery("body").on("click", ".addanother_board", function () {
        var HTML1 = '<div class="board_class"><div class="row">';
        HTML1 += '<div class="col-lg-4 col-sm-12 col-xs-12"><div class="home_town"><h3>Board types </h3>';
        HTML1 += '<select name="board_type[]" id="board_type' + board + '" class="select_box"><option value="1">1</option>';
        HTML1 += '<option value="2">2</option></select></div></div><div class="col-lg-8 col-sm-12 col-xs-12"><h3>Rent Adjustment </h3>';
        HTML1 += '<div class="col-lg-3 col-sm-12 col-xs-12"><div class="home_town"><select name="rent_adjust_type[]" id="rent_adjust_type' + board + '" class="select_box" >';
        HTML1 += '<option value="1">1</option><option value="2">2</option></select></div></div>';
        HTML1 += '<div class="col-lg-3 col-sm-12 col-xs-12"><div class="home_town"><input name="rent_adjust_price[]" class="focus_help_menu" data-val="rent_adjust_price" id="rent_adjust_price' + board + '" type="text" placeholder="Amount  ">';
        HTML1 += '</div></div><div class="col-lg-6 col-sm-12 col-xs-12"><div class="home_town"><select name="rent_adjust_duration[]" id="rent_adjust_duration' + board + '" class="select_box" >';
        HTML1 += '<option value="1">1</option><option value="2">2</option></select>';
        HTML1 += '</div></div></div></div><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_left"><a href="javascript:void(0);" class="remove_board">Remove</a>';
        HTML1 += '</div>';
        if (jQuery(".board_class").length > 0) {
            jQuery(".board_class:last").after(HTML1);
        } else {
            me.parent().prev().append(HTML1);
        }
        jQuery(".select_box").selectbox();
        board++;
    });
    /**
     * 
     *remove board 
     */
    jQuery("body").on("click", ".remove_board", function () {
        var me = jQuery(this);
        me.parent().parent().remove();
    });
    /**
     * 
     * add more seasonal price
     */
    var z = 1;
    jQuery("body").on("click", ".add_anothers_seasonal", function () {
        var me = jQuery(this);
        preLoading('show', 'load-screen');
        var HTML = '<div class="seasonal_div_repeat"> <div class="col-md-12 padding_left"> <div class="col-md-4 col-sm-6 col-xs-12 padding_left">';
        HTML += '<div class="col-md-12 col-sm-12 col-xs-12"><h3>Period name </h3> <div class="home_town"> <input name="seasonal_name[]" class="focus_help_menu" data-val="seasonal_name" id="seasonal_name' + z + '" type="text" placeholder=" Period name ">';
        HTML += '</div></div><div class="col-lg-12 col-sm-12 col-xs-12"> <div class="home_town"> <p class="para_peroid">Date</p><div class="col-lg-6 col-sm-6 col-xs-6 padding_left">';
        HTML += '<input name="seasonal_date[]" class="focus_help_menu seasonal_end_date" data-val="seasonal_date" id="seasonal_date' + z + '" type="text" placeholder=" from"></div><div class="col-lg-6 col-sm-6 col-xs-6 paddng_right"><input name="seasonal_till_date[]" class="focus_help_menu seasonal_start_date" data-val="seasonal_till_date" id="seasonal_till_date' + z + '" type="text" placeholder=" to">';
        HTML += '</div></div></div><div class="col-lg-12 col-sm-12 col-xs-12"> <div class="home_town"> <p class="para_peroid">Min stay </p><select id="seasonal_minstay' + z + '" name="seasonal_minstay[]" class="select_box" tabindex="2">';
        HTML += '<option>1</option><option>2</option></select> </div></div></div><div class="col-md-8 col-sm-6 col-xs-12 padding_left paddng_right">';
        HTML += '<div class="col-md-12 col-sm-12 col-xs-12 col_right_wrap"> <div class="col-md-3 col-sm-12 col-xs-12"> <div class="home_town"><h3>Rooms</h3></div></div><div class="col-md-3 col-sm-12 col-xs-12">';
        HTML += '<div class="home_town"><h3>Nightly rate </h3></div></div><div class="col-md-3 col-sm-12 col-xs-12"> <div class="home_town"><h3>Week end rate </h3></div></div><div class="col-md-3 col-sm-12 col-xs-12">';
        HTML += '<div class="home_town"><h3>Weekly rate</h3></div></div></div>';
        var dataString = 'hotel_id=' + hotel_id;
        jQuery.ajax({
            data: dataString,
            url: $baseUrl + '/hotel/ajax/editroom',
            type: "post",
            async: false,
            beforeSend: function (xhr) {
                preLoading('show', 'load-screen');
            },
            success: function (response) {

                var data = jQuery.parseJSON(response);
                jQuery(data.data).each(function (key, val) {
                    HTML += ' <div class="col-md-12 col-sm-12 col-xs-12 col_room_wrap"> <div class="col-md-3 col-sm-12 col-xs-12 padding_left padding_right">';
                    HTML += ' <div class="home_town"> <p class="parah">' + val.room_name + '</p><p class="parap">No board rate </p></div></div><div class="col-md-3 col-sm-12 col-xs-12"> <div class="home_town"><input name="nightly_rate[]" class="focus_help_menu" data-val="nightly_rate" id="nightly_rate' + z + '" type="text" placeholder="Amount">';
                    HTML += '</div></div><div class="col-md-3 col-sm-12 col-xs-12"> <div class="home_town"><input name="weekendrate[]" class="focus_help_menu" data-val="weekendrate" id="weekendrate' + z + '" type="text" placeholder="Amount"></div></div><div class="col-md-3 col-sm-12 col-xs-12"> <div class="home_town">';
                    HTML += '<input name="weeklyrate[]" class="focus_help_menu" data-val="weeklyrate" id="weeklyrate' + z + '" type="text" placeholder="Amount"><input type="hidden" name="room_ids_array[]" value="' + val.room_id + '"/></div></div></div>';
                });
            }
        });
        HTML += '</div><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_left paddng_right" align="left">';
        HTML += '<a href="javascript:void(0);" class="remove_seasonal delete pull-right">remove</a></div></div></div></div></div>';
        preLoading('hide', 'load-screen');
        if (jQuery(".seasonal_div_repeat").length > 0) {
            jQuery(".seasonal_div_repeat:last").after(HTML);
        } else {
            me.parent().prev().append(HTML);
        }
        jQuery(".select_box").selectbox();
        z++;
    });
    /**
     * 
     *remove seasonal price
     */
    jQuery("body").on("click", ".remove_seasonal", function () {
        var me = jQuery(this);
        me.parent().parent().parent().remove();
    });
    /**
     * 
     * add more discount offers
     * 24 hour offer
     */
    var i_1 = 1;
    jQuery("body").on("click", ".add_more_24_offer", function () {
        var me = jQuery(this);
        var HTML3 = '<div class="repeat_24_offer"><div class="looping"><div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 padding_left">';
        HTML3 += ' <p class="offer_P">If booking is made on </p><div class="form-group"> <div id="datetimepicker5" class="input-group date">';
        HTML3 += ' <input name="offer_24_date[]"  disabled="disabled" id="offer_24_date_' + i_1 + '" class="focus_help_menu seasonal_end_date" data-val="offer_24_date" type="text" placeholder="Date"> </div></div></div><div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 padding_left">';
        HTML3 += ' <p class="offer_P">Apply discount of </p><input name="offer_24_amount[]"  disabled="disabled" id="offer_24_amount' + i_1 + '" class="focus_help_menu" data-val="offer_24_amount"  type="text" placeholder="$ Amount "> </div>';
        HTML3 += '<div class="col-lg-3 col-sm-12 col-xs-12 padding_left" > <div class="home_town"> <p>&nbsp;</p>';
        HTML3 += '<select name="offer_24_currency[]"  disabled="disabled" id="offer_24_currency' + i_1 + '" class="select_box" tabindex="2"> <option> Amount in $ </option>';
        HTML3 += ' <option>1</option><option> 2</option> </select> </div></div><div class="col-lg-2 col-sm-12 col-xs-12 padding_left paddng_right">';
        HTML3 += ' <div class="home_town"> <p>&nbsp;</p><h5 class="para_total_amount">On total amount </h5> </div>';
        HTML3 += '</div><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_left" align="right"> <a href="javascript:void(0);" class="remove_24_offer delete">Delete</a>';
        HTML3 += ' </div></div></div>';
        i_1++;
        var result = jQuery(".repeat_24_offer").length;
        if (result > 0) {
            jQuery(".repeat_24_offer:last").after(HTML3);
        } else {
            jQuery("#container_24").html(HTML3);
        }
        jQuery(".select_box").selectbox();
    })
    /**
     * 
     * remove discount offers
     * 24 hour offer
     */
    jQuery("body").on("click", ".remove_24_offer", function () {
        var me = jQuery(this);
        me.parent().parent().remove();
    });
    /**
     * 
     * add more discount offers
     * last minute  offer
     */
    var lm = 1;
    jQuery("body").on("click", ".add_more_lastminute_offer", function () {
        var me = jQuery(this);
        var HTML3 = '<div class="repeat_lastminute_offer"><div class="looping"><div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 padding_left"> <p class="offer_P">If booking is made less than </p><div class="col-lg-6 col-sm-12 col-xs-12 padding_left" >';
        HTML3 += '<div class="home_town"> <select name="lastmin_time_value[]"  disabled="disabled" id="lastmin_time_value' + lm + '" data-val="lastmin_time_value"  class="focus_help_menu select_box" tabindex="2"> <option > 1</option> <option > 1</option> <option > 2</option> </select> </div></div>';
        HTML3 += '<div class="col-lg-6 col-sm-12 col-xs-12 padding_left paddng_right" > <div class="home_town"> <select  disabled="disabled" id="lastmin_time_type' + lm + '" data-val="lastmin_time_type" name="lastmin_time_type[]" class="focus_help_menu select_box" tabindex="2"> <option > Days</option>';
        HTML3 += '<option>1</option> <option > 2</option> </select> </div></div><p class="offer_P">prior to reservation date </p></div><div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 padding_left">';
        HTML3 += '<p class="offer_P">Apply discount of </p><input name="lastmin_amount[]"  disabled="disabled" id="lastmin_amount' + lm + '" class="focus_help_menu" data-val="lastmin_amount" type="text" placeholder="$ Amount "> </div><div class="col-lg-3 col-sm-12 col-xs-12 padding_left" > <div class="home_town"> <p>&nbsp;</p>';
        HTML3 += '<select name="lastmin_currency[]"  disabled="disabled" id="lastmin_currency' + lm + '" class="select_box" tabindex="2"> <option > Amount in $ </option> <option > 1</option> <option > 2</option> </select> </div></div>';
        HTML3 += '<div class="col-lg-2 col-sm-12 col-xs-12 padding_left paddng_right"> <div class="home_town"> <p>&nbsp;</p><h5 class="para_total_amount">On total amount </h5> </div></div>';
        HTML3 += '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_left " align="right"> <a href="javascript:void(0);" class="remove_lastminute_offer delete">Delete</a></div></div></div>';
        var result = jQuery(".repeat_lastminute_offer").length;
        lm++;
        if (result > 0) {
            jQuery(".repeat_lastminute_offer:last").after(HTML3);
        } else {
            jQuery("#container_lastmin").html(HTML3);
        }
        jQuery(".select_box").selectbox();
    })
    /**
     * 
     * remove discount offers
     * last minute  offer
     */
    jQuery("body").on("click", ".remove_lastminute_offer", function () {
        var me = jQuery(this);
        me.parent().parent().remove();
    });
    /**
     * 
     * add more discount offers
     * early bird  offer
     */
    var lk = 1;
    jQuery("body").on("click", ".add_more_earlybird_offer", function () {
        var me = jQuery(this);
        var HTML3 = '<div class="repeat_earlybird_offer"><div class="looping"> <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 padding_left">';
        HTML3 += ' <p class="offer_P">If booking is made more than </p><div class="col-lg-6 col-sm-12 col-xs-12 padding_left" > <div class="home_town"> <select name="earlybird_time_val[]"  disabled="disabled" id="earlybird_time_val' + lk + '" class="select_box" tabindex="2"> <option > 1</option>';
        HTML3 += ' <option > 1</option> <option > 2</option> </select> </div></div><div class="col-lg-6 col-sm-12 col-xs-12 padding_left paddng_right" > <div class="home_town"> <select  disabled="disabled" name="earlybird_time_type[]" id="earlybird_time_type' + lk + '" class="select_box" tabindex="2">';
        HTML3 += ' <option > Days</option> <option > 1</option> <option > 2</option> </select> </div></div><p class="offer_P">prior to reservation date </p></div><div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 padding_left">';
        HTML3 += ' <p class="offer_P">Apply discount of </p><input name="earlybird_amount[]"  id="earlybird_amount' + lk + '" data-val="earlybird_amount" class="focus_help_menu"  disabled="disabled" type="text" placeholder="$ Amount "> </div><div class="col-lg-3 col-sm-12 col-xs-12 padding_left" > <div class="home_town"> <p>&nbsp;</p><select name="earlybird_currency[]" id="earlybird_currency' + lk + '" class="select_box" tabindex="2">';
        HTML3 += ' <option > Amount in $ </option> <option > 1</option> <option > 2</option> </select> </div></div><div class="col-lg-2 col-sm-12 col-xs-12 padding_left paddng_right"> <div class="home_town">';
        HTML3 += ' <p>&nbsp;</p><h5 class="para_total_amount">On total amount </h5>';
        HTML3 += ' </div></div><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_left" align="right"> <a href="javascript:void(0);" class="remove_earlybird_offer delete">Delete</a> </div></div>';
        lk++;
        var result = jQuery(".repeat_earlybird_offer").length;
        if (result > 0) {
            jQuery(".repeat_earlybird_offer:last").after(HTML3);
        } else {
            jQuery("#container_early").html(HTML3);
        }
        jQuery(".select_box").selectbox();
    })
    /**
     * 
     * remove discount offers
     * last minute  offer
     */
    jQuery("body").on("click", ".remove_earlybird_offer", function () {
        var me = jQuery(this);
        me.parent().parent().remove();
    });
    /***
     * 
     Show address popup
     */
    jQuery("body").on("click", ".show_location_popup", function () {
        jQuery(".locationpopup").css("display", "block");
    });
    /**
     * validate from location itenrary
     */
    jQuery("body").on("click", "#hotel_location_btn2", function () {
        jQuery("#location-form").validate({
            rules: {
                hotel_instruction: {
                    required: true
                }
            },
            messages: {
            },
            submitHandler: function () {
                var dataString = jQuery("#location-form").serialize();
                jQuery.ajax({
                    data: dataString,
                    url: $baseUrl + '/hotel/ajax/add_location1',
                    type: "post",
                    beforeSend: function (xhr) {
                        preLoading('show', 'load-screen');
                    },
                    success: function (data) {
                        preLoading('hide', 'load-screen');
                        //    location.reload();
                    }
                });
            }
        });
    });


    /**
     * validate location add form
     */
    jQuery("body").on("click", "#hotel_location_btn", function () {
        jQuery("#hotel_location_form").validate({
            rules: {
                addressline1: {
                    required: true
                },
//                addressline2: {
//                    required: true
//                },
                city: {
                    required: true
                },
                state: {
                    required: true
                },
                zipcode: {
                    required: true
                },
                country_popup: {
                    required: true

                }
            },
            messages: {
            },
            submitHandler: function () {
                var dataString = jQuery("#hotel_location_form").serialize();
                jQuery.ajax({
                    data: dataString,
                    url: $baseUrl + '/hotel/ajax/add_location',
                    type: "post",
                    beforeSend: function (xhr) {
                        preLoading('show', 'load-screen');
                    },
                    success: function (data) {
                        preLoading('hide', 'load-screen');
                        location.reload();
                    }
                });
            }
        });
    });
    /**
     * 
     *hide location popup
     */
    jQuery("body").on("click", ".hide_popup", function () {
        jQuery(".locationpopup").hide();
    });
    /**
     * 
     *arrow pic on off
     */
    jQuery("body").on("click", '.heading_class', function () {
        var me = jQuery(this);
        var extra = me.attr("data-val");
        var index = me.index();
        if (jQuery(".custom_arrow_" + extra).hasClass("arrow_pic_off")) {
            jQuery(".custom_arrow_" + extra).addClass("arrow_pic_on");
            jQuery(".custom_arrow_" + extra).removeClass("arrow_pic_off");
        } else {
            jQuery(".custom_arrow_" + extra).removeClass("arrow_pic_on");
            jQuery(".custom_arrow_" + extra).addClass("arrow_pic_off");
        }
    });

    /***
     * enabele disable validation on offers
     */
    jQuery("body").on("change", "input[name = '24_hour_offer']", function () {
        var me = jQuery(this);
        if (me.is(':checked')) {
            jQuery(".repeat_24_offer").each(function () {
                var my = jQuery(this);
                my.find('input:text').prop('disabled', false);
                my.find('select').prop('disabled', false);
            });
        } else {
            jQuery(".repeat_24_offer").each(function () {
                var my = jQuery(this);
                my.find('input:text').removeClass("error");
                my.find('select').removeClass("error");
                my.find('select').find("label").remove();
                my.find('input:text').prop('disabled', true);
                my.find('select').prop('disabled', true);

            });
        }

    });

    jQuery("body").on("change", "input[name = 'last_min_offer']", function () {
        var me = jQuery(this);
        if (me.is(':checked')) {
            jQuery(".repeat_lastminute_offer").each(function () {
                var my = jQuery(this);
                my.find('input:text').prop('disabled', false);
                my.find('select').prop('disabled', false);
            });
        } else {
            jQuery(".repeat_lastminute_offer").each(function () {
                var my = jQuery(this);
                my.find('input:text').removeClass("error");
                my.find('select').removeClass("error");
                my.find('input:text').prop('disabled', true);
                my.find('select').prop('disabled', true);

            });
        }

    });
    jQuery("body").on("change", "input[name = 'early_bird_offer']", function () {
        var me = jQuery(this);
        if (me.is(':checked')) {
            jQuery(".repeat_earlybird_offer").each(function () {
                var my = jQuery(this);
                my.find('input:text').prop('disabled', false);
                my.find('select').prop('disabled', false);
            });
        } else {
            jQuery(".repeat_earlybird_offer").each(function () {
                var my = jQuery(this);
                my.find('input:text').removeClass("error");
                my.find('select').removeClass("error");
                my.find('input:text').prop('disabled', true);
                my.find('select').prop('disabled', true);

            });
        }

    });

});
/**
 * 
 Show hide room listing detail
 */
jQuery("body").on("click", '.room_div_toggle', function () {
    var me = jQuery(this);
    var data = me.attr("data-val");

//    jQuery(".room_create_form_hide").each(function () {
//        jQuery(this).hide();
//    });
    jQuery("." + data).toggle();
    if (me.find(".arrow_img").hasClass("arrow_pic_on")) {
        me.find(".arrow_img").removeClass("arrow_pic_on");
        me.find(".arrow_img").addClass("arrow_pic_off");
    } else {
        me.find(".arrow_img").removeClass("arrow_pic_off");
        me.find(".arrow_img").addClass("arrow_pic_on");
    }
});
/**  * FOR  CREATE ROOM FORM
 */
function getTemplate(i) {
    var extra = "";
    if (i == 1) {
        extra = "iamfirst";
    }
    var HTML = GenreateTemplate(extra);
    if (i == 1) {

        HTML += '</div><div class="col-xs-12 col-sm-12 col-md-12"> <h4><a href="javascript:void(0);" class="add_more_rooms" >Add a room</a></h4></div>';
    } else {
        HTML += '<div class="col-xs-12 col-sm-12 col-md-12"> <h4><a href="javascript:void(0);" class="remove_rooms" >Remove room</h4> </div></div>';
    }
    return HTML;
}
/**
 *ROOM CREATE TEMPLATE 
 *
 */
function GenreateTemplate(extra) {

    var HTML = '<div class="form_repeat_div"><div class="grey_form_div"> <div class="select_room"> <div class="row"> <div class="col-lg-12 col-sm-12 col-xs-12">';
    HTML += '<div class="arrow_pic"><div class="arrow_img arrow_pic_off"></div></div><p class="room_heading"> <a class="heading-of-room room_menu" href="javascript:void(0);">Room Name</a>';
    HTML += '</p></div><div class="col-lg-4 col-sm-12 col-xs-12"><a class="blue" href="javascript:void(0);">Rename this room</a></div><div class="col-lg-4 col-sm-12 col-xs-12">';
    HTML += '<a class="blue duplicate_room_form"  href="javascript:void(0);">Duplicate this room</a></div><div class="col-lg-4 col-sm-12 col-xs-12">';
    if (extra != 'iamfirst') {
        HTML += '<a class="red delete_room" href="javascript:void(0);">Delete this room</a>';
    }
    HTML += '</div></div></div>';
    HTML += '<fieldset><div class="col-lg-4 col-sm-12 col-xs-12"> <div class="home_town"> <h3>Room Name</h3> <input class="focus_help_menu room_name_array" data-val="room_name" name="room_name[]" id="room_name_' + jQuery.now() + '" required="required" type="text"  placeholder="Room name"></div></div></fieldset>';
    HTML += '<fieldset> <div class="col-lg-4 col-sm-12 col-xs-12"> <div class="home_town"> <h3>Room quantity</h3> <input class="focus_help_menu" data-val="room_quantity" name="room_quantity[]" id="room_quantity_' + jQuery.now() + '" required="required" type="text" placeholder="No. of rooms">';
    HTML += '</div></div></fieldset> <fieldset> <div class="col-lg-4 col-sm-12 col-xs-12"> <div class="home_town"> <h3>Real Beds </h3> <select name="real_beds[]" id="real_beds_' + jQuery.now() + '" required="required" class="select_box" tabindex="2">';
    HTML += '<option value="1">1</option> <option value="2"> 2</option> </select> </div></div><div class="col-lg-5 col-sm-12 col-xs-12 "> <div class="home_town">';
    HTML += '<h3>Beds type </h3> <select name="real_bed_type[]" required="required" id="real_bed_type_' + jQuery.now() + '" class="select_box" tabindex="2"> <option >Select a type of bed</option> <option value="1">1</option> <option value="2"> 2</option> </select>';
    HTML += '</div></div><div class="col-lg-3 col-sm-12 col-xs-12"> <div class="home_town"> <h3>Bath</h3> <select required="required" id="room_bath_' + jQuery.now() + '" name="room_bath[]" class="select_box" tabindex="2"> <option >1</option> <option value="1">1</option>';
    HTML += '<option value="2"> 2</option> </select> </div></div></fieldset> <fieldset> <div class="col-lg-4 col-sm-12 col-xs-12"> <div class="home_town"> <h3>Additional beds </h3> <select name="additional_beds[]" required="required" id="additional_beds_' + jQuery.now() + '" class="select_box" tabindex="2">';
    HTML += '<option >0</option> <option value="1">1</option> <option value="2"> 2</option> </select> </div></div><div class="col-lg-5 col-sm-12 col-xs-12 "> <div class="home_town"> <h3>Beds type </h3> <select name="bed_type[]" required="required" id="bed_type_' + jQuery.now() + '" class="select_box" tabindex="2">';
    HTML += '<option >Select a type of bed</option> <option value="1">1</option> <option value="2"> 2</option> </select> </div></div></fieldset> <fieldset> <div class="col-lg-4 col-sm-12 col-xs-12"> <div class="home_town"> <h3>Size </h3> <input class="focus_help_menu" data-val="room_size" name="room_size[]" required="required" id="room_size_' + jQuery.now() + '" type="text" placeholder=" ">';
    HTML += '</div></div><div class="col-lg-5 col-sm-12 col-xs-12"> <div class="home_town"> <h3>Unit</h3> <select name="size_units[]" required="required" id="size_units_' + jQuery.now() + '" class="select_box" tabindex="2"> <option > Square/meter</option> <option value="1">1</option> <option value="2"> 2</option> </select> </div></div></fieldset> <fieldset> <div class="col-lg-3 col-sm-12 col-xs-12 ">';
    HTML += '<div class="home_town"> <h3>Max Occupancy </h3> <select name="max_occupancy[]" class="select_box" tabindex="2"> <option value="1">1 </option> <option value="1">1</option> <option value="2"> 2</option> </select> </div></div><div class="col-lg-3 col-sm-12 col-xs-12"> <div class="home_town"> <h3>Max Adults</h3> <select required="required" id="max_adults_' + jQuery.now() + '"  name="max_adults[]" class="select_box" tabindex="2">';
    HTML += '<option value="1">1</option> <option value="2">2</option> <option value="3"> 3</option> </select> </div></div><div class="col-lg-3 col-sm-12 col-xs-12"> <div class="home_town"> <h3>Max children </h3> <select name="max_children[]" required="required" id="max_children_' + jQuery.now() + '" class="select_box" tabindex="2"> <option value="0">no children</option> <option value="1">1</option> <option value="2"> 2</option> </select>';
    HTML += '</div></div><div class="col-lg-3 col-sm-12 col-xs-12"> <div class="home_town"> <h3>Max babies</h3> <select name="max_babies[]" required="required" id="max_babies_' + jQuery.now() + '" class="select_box" tabindex="2"> <option value="0"> no babies</option> <option value="1">1</option> <option value="2"> 2</option> </select> </div></div></fieldset> <div class="row"> <div class="col-lg-12"> <h6>Room amenities </h6> </div></div>';
    HTML += '<div class="row"> <div class="col-lg-12">';
    jQuery.ajax({
        url: $baseURL + '/hotel/ajax/getAmenities',
        type: 'post',
        data: 'data=data',
        async: false,
        success: function (result) {
            var data = jQuery.parseJSON(result);
            HTML += '<div class="hotel_amenities">';
            var j = jQuery.now();
            jQuery.each(data.room_amenities, function (i, item) {

                HTML += '<div class="form-type-checkbox"><input type="checkbox" name="room_amenities[' + count + '][]" id="room_amenities_' + j + '" class="room_amen css-checkbox" value="' + i + '" /><label for="room_amenities_' + j + '" class="css-label radGroup1">' + item + '</label></div>';
                j++;
            });
            HTML += ' </div>';
            HTML += '<div class="row"> <div class="col-lg-12"> <h6>Safety amenities </h6> </div></div><div class="row"> <div class="col-lg-12">';
            var t = jQuery.now();
            jQuery.each(data.safety_amenities, function (i, item) {

                HTML += '<div class="safety_amenities"> <input type="checkbox" name="safety_amenities[' + count + '][]" id="safety_amenities_' + t + '" class="safe_amen css-checkbox" value="' + i + '"/><label for="safety_amenities_' + t + '" class="css-label radGroup1">' + item + '</label> </div>';
                t++;
            });
        }
    });
    HTML += '</div></div></div></div></div>';
    count++;
    return HTML;
}
/***
 * Template for room edit case
 */
function editCaseRoomCreateHtml(data, x) {

    var extra = '';
    if (x == 0) {
        extra = "iamfirst";
    }
    var room_safety_var1 = data.room_safety_amenities.replace(/\[/g, '');
    var room_safety_var2 = room_safety_var1.replace(/\]/g, '');
    var room_safety_var = room_safety_var2.replace(/\"/g, '');
    var room_amenities_var1 = data.room_amenities.replace(/\[/g, '');
    var room_amenities_var2 = room_amenities_var1.replace(/\]/g, '');
    var room_amenities_var = room_amenities_var2.replace(/\"/g, '');
    var room_safety = room_safety_var.split(',');
    var room_amenities = room_amenities_var.split(',');
    var room_real_beds_array = new Array(1, 2);
    var real_bed_type_array = new Array(1, 2);
    var room_bath_array = new Array(1, 2);
    var additional_beds_array = new Array(1, 2);
    var bed_type_array = new Array(1, 2);
    var size_units_array = new Array(1, 2);
    var max_occupancy_array = new Array(1, 2);
    var max_adults_array = new Array(1, 2);
    var max_children_array = new Array();
    max_children_array[0] = 'no children';
    max_children_array[1] = '1';
    max_children_array[2] = '2';
    var max_babies_array = new Array();
    max_babies_array[0] = 'no babies';
    max_babies_array[1] = '1';
    max_babies_array[2] = '1';
    var HTML = '<div class="form_repeat_div"><div class="grey_form_div"> <div class="select_room"> <div class="row"> <div class="col-lg-12 col-sm-12 col-xs-12">';
    HTML += '<div class="arrow_pic"><a href="javascript:void(0);" data-val="class_' + count + '" class="room_div_toggle"><div class="arrow_img arrow_pic_off"></div></a></div><p class="room_heading"> <a class="heading-of-room"  class="room_div_toggle" href="javascript:void(0);">' + data.room_name + '</a>';
    HTML += '</p></div><div class="col-lg-4 col-sm-12 col-xs-12"><a class="blue room_div_toggle" data-val="class_' + count + '" href="javascript:void(0);">Rename this room</a></div><div class="col-lg-4 col-sm-12 col-xs-12">';
    HTML += '<a class="blue duplicate_room_form  ' + extra + '"  href="javascript:void(0);">Duplicate this room</a></div>';
    if (extra != 'iamfirst') {
        HTML += '<div class="col-lg-4 col-sm-12 col-xs-12"><a class="red delete_room" href="javascript:void(0);">Delete this room</a>';
    } else {
        HTML += '<div class="col-lg-4 col-sm-12 col-xs-12  first_duplicate_content">';
    }
    HTML += '</div></div></div>';
    HTML += '<div class="room_create_form_hide class_' + count + '" style="display:none;"><fieldset> <div class="col-lg-4 col-sm-12 col-xs-12"> <div class="home_town"> <h3>Room Name</h3> <input class="focus_help_menu room_name_array" data-val="room_name" name="room_name[]" id="room_name_' + jQuery.now() + '" required="required" type="text" value="' + data.room_name + '" placeholder="Room name"></div></div></fieldset>';
    HTML += '<fieldset> <div class="col-lg-4 col-sm-12 col-xs-12"> <div class="home_town"> <h3>Room quantity</h3> <input name="room_quantity[]" id="room_quantity_' + jQuery.now() + '" required="required" class="focus_help_menu" data-val="room_quantity" type="text" value="' + data.room_quantity + '" placeholder="No. of rooms">';
    HTML += '</div></div></fieldset> <fieldset> <div class="col-lg-4 col-sm-12 col-xs-12"> <div class="home_town"> <h3>Real Beds </h3> <select name="real_beds[]" id="real_beds_' + jQuery.now() + '" required="required" class="select_box" tabindex="2">';
    jQuery.each(room_real_beds_array, function (index, value) {
        var select = '';
        if (data.room_real_beds == value) {
            select = ' selected';
        }

        HTML += '<option value="' + value + '" ' + select + '>' + value + '</option>';
    });
    HTML += ' </select> </div></div><div class="col-lg-5 col-sm-12 col-xs-12 "> <div class="home_town">';
    HTML += '<h3>Beds type </h3> <select name="real_bed_type[]" required="required" id="real_bed_type_' + jQuery.now() + '" class="select_box" tabindex="2"> <option >Select a type of bed</option>';
    jQuery.each(real_bed_type_array, function (index, value) {
        var select = '';
        if (data.room_real_bed_type == value) {
            select = ' selected';
        }

        HTML += '<option value="' + value + '" ' + select + '>' + value + '</option>';
    });
    HTML += '</select></div></div><div class="col-lg-3 col-sm-12 col-xs-12"> <div class="home_town"> <h3>Bath</h3> <select required="required" id="room_bath_' + jQuery.now() + '" name="room_bath[]" class="select_box" tabindex="2">';
    jQuery.each(room_bath_array, function (index, value) {
        var select = '';
        if (data.room_real_bed_bath == value) {
            select = ' selected';
        }

        HTML += '<option value="' + value + '" ' + select + '>' + value + '</option>';
    });
    HTML += '</select> </div></div></fieldset> <fieldset> <div class="col-lg-4 col-sm-12 col-xs-12"> <div class="home_town"> <h3>Additional beds </h3> <select name="additional_beds[]" required="required" id="additional_beds_' + jQuery.now() + '" class="select_box" tabindex="2">';
    jQuery.each(additional_beds_array, function (index, value) {
        var select = '';
        if (data.room_additional_bed == value) {
            select = ' selected';
        }

        HTML += '<option value="' + value + '" ' + select + '>' + value + '</option>';
    });
    HTML += '</select> </div></div><div class="col-lg-5 col-sm-12 col-xs-12 "> <div class="home_town"> <h3>Beds type </h3> <select name="bed_type[]" required="required" id="bed_type_' + jQuery.now() + '" class="select_box" tabindex="2">';
    jQuery.each(bed_type_array, function (index, value) {
        var select = '';
        if (data.room_additional_bed_type == value) {
            select = ' selected';
        }
        HTML += '<option value="' + value + '" ' + select + '>' + value + '</option>';
    });
    HTML += '</select> </div></div></fieldset> <fieldset> <div class="col-lg-4 col-sm-12 col-xs-12"> <div class="home_town"> <h3>Size </h3> <input class="focus_help_menu" data-val="room_size" name="room_size[]" value="' + data.room_size + '" required="required" id="room_size_' + jQuery.now() + '" type="text" placeholder=" ">';
    HTML += '</div></div><div class="col-lg-5 col-sm-12 col-xs-12"> <div class="home_town"> <h3>Unit</h3> <select name="size_units[]" required="required" id="size_units_' + jQuery.now() + '" class="select_box" tabindex="2">';
    jQuery.each(size_units_array, function (index, value) {
        var select = '';
        if (data.room_size_unit == value) {
            select = ' selected';
        }
        HTML += '<option value="' + value + '" ' + select + '>' + value + '</option>';
    });
    HTML += '</select> </div></div></fieldset> <fieldset> <div class="col-lg-3 col-sm-12 col-xs-12 ">';
    HTML += '<div class="home_town"> <h3>Max Occupancy </h3> <select name="max_occupancy[]" class="select_box" tabindex="2"> ';
    jQuery.each(max_occupancy_array, function (index, value) {
        var select = '';
        if (data.room_max_occupancy == value) {
            select = ' selected';
        }
        HTML += '<option value="' + value + '" ' + select + '>' + value + '</option>';
    });
    HTML += '</select> </div></div><div class="col-lg-3 col-sm-12 col-xs-12"> <div class="home_town"> <h3>Max Adults</h3> <select required="required" id="max_adults_' + jQuery.now() + '"  name="max_adults[]" class="select_box" tabindex="2">';
    jQuery.each(max_adults_array, function (index, value) {
        var select = '';
        if (data.room_max_adults == value) {
            select = ' selected';
        }
        HTML += '<option value="' + value + '" ' + select + '>' + value + '</option>';
    });
    HTML += '</select> </div></div><div class="col-lg-3 col-sm-12 col-xs-12"> <div class="home_town"> <h3>Max children </h3> <select name="max_children[]" required="required" id="max_children_' + jQuery.now() + '" class="select_box" tabindex="2">';
    jQuery.each(max_children_array, function (index, value) {
        var select = '';
        if (data.room_max_children == value) {
            select = ' selected';
        }
        HTML += '<option value="' + value + '" ' + select + '>' + value + '</option>';
    });
    HTML += '</select></div></div><div class="col-lg-3 col-sm-12 col-xs-12"> <div class="home_town"> <h3>Max babies</h3> <select name="max_babies[]"  required="required" id="max_babies_' + jQuery.now() + '" class="select_box" tabindex="2">';
    jQuery.each(max_babies_array, function (index, value) {
        var select = '';
        if (data.room_max_babies == value) {
            select = ' selected';
        }
        HTML += '<option value="' + value + '" ' + select + '>' + value + '</option>';
    });
    HTML += '</select> </div></div></fieldset> <div class="row"> <div class="col-lg-12"> <h6>Room amenities </h6> </div></div>';
    HTML += '<div class="row"> <div class="col-lg-12">';
    jQuery.ajax({
        url: $baseURL + '/hotel/ajax/getAmenities',
        type: 'post',
        data: 'data=data',
        async: false,
        success: function (result) {
            var data = jQuery.parseJSON(result);

            HTML += '<div class="hotel_amenities">';
            var j = jQuery.now();
            jQuery.each(data.room_amenities, function (i, item) {
                var is_checked = '';
                var check = i;
                if (jQuery.inArray(check, room_amenities) >= 0) {
                    is_checked = 'checked="checked"';
                }
                HTML += '<div class="form-type-checkbox"><input ' + is_checked + ' type="checkbox" name="room_amenities[' + count + '][]" id="room_amenities_' + j + '" class="room_amen css-checkbox" value="' + i + '" /><label for="room_amenities_' + j + '" class="css-label radGroup1" >' + item + '</label></div>';
                j++;
            });
            HTML += ' </div>';
            HTML += '<div class="row"> <div class="col-lg-12"> <h6>Safety amenities </h6> </div></div><div class="row"> <div class="col-lg-12">';
            var t = jQuery.now();
            jQuery.each(data.safety_amenities, function (i, item) {
                var is_checked = '';
                if (jQuery.inArray(i, room_safety) >= 0) {
                    is_checked = 'checked="checked"';
                }
                HTML += '<div class="safety_amenities"> <input type="checkbox"  ' + is_checked + ' name="safety_amenities[' + count + '][]" id="safety_amenities_' + t + '" class="safe_amen css-checkbox" value="' + i + '"/><label for="safety_amenities_' + t + '" class="css-label radGroup1">' + item + '</label> </div>';
                t++;
            });
        }
    });
    HTML += '</div></div></div></div></div></div>';
    count++;
    return HTML;
}




/**
 * remove repeated rooms
 */
jQuery('body').on("click", ".add_more_rooms", function () {
    preLoading('show', 'load-screen');
    var HTML = getTemplate(2);
    jQuery(".form_repeat_div:last").after(HTML);
    preLoading('hide', 'load-screen');
    jQuery('.select_box').selectbox();
});
/**
 * remove repeated rooms
 */
jQuery('body').on("click", ".remove_rooms ,.delete_room", function () {
    preLoading('show', 'load-screen');
    var me = jQuery(this);
    me.closest(".form_repeat_div").remove();
    preLoading('hide', 'load-screen');
});
/**
 * 
 *function to count no of 
 */
function characterCount(elementId, maxchar, maxCharsWarning)
{

    jQuery('#' + elementId).jqEasyCounter({
        'maxChars': maxchar,
        'maxCharsWarning': maxCharsWarning,
        'msgFontSize': '12px',
        'msgFontColor': '#000',
        'msgFontFamily': 'Verdana',
        'msgTextAlign': 'right',
        'msgWarningColor': '#F00',
        'msgAppendMethod': 'insertAfter'});
}
/**
 * 
 * for loader
 */
var preLoading = function (type, el) {
    switch (type) {
        case 'show':
            //jQuery('#load-screen,#load-screen_details').fadeIn();
            jQuery('#' + el).fadeIn();
            break;
        case 'hide':
            //jQuery('#load-screen,#load-screen_details').fadeOut();
            jQuery('#' + el).fadeOut();
            jQuery('.listing_container_head').fadeIn();
            break;
        default:
            break;
    }
}
function initialize_trip() {
    var home_autocomplete = new google.maps.places.Autocomplete(
            /** @type {HTMLInputElement} */
                    (document.getElementById('edit-address1')),
                    {types: []});
    google.maps.event.addListener(home_autocomplete, 'place_changed', function () {



        // Get the place details from the autocomplete object.
        var autocomplete = home_autocomplete;
        var place = autocomplete.getPlace();
        //alert(place.toSource());

        adresses = place.address_components;
        //alert(place.name);

        var long_addr = '';
        if (place.name)

        {

            long_addr = place.name;
            document.getElementById('edit-address1').value = long_addr;
        }

        for (var i = 0; i < place.address_components.length; i++)
        {
            var addr = place.address_components[i];
            if (addr.types[0] == "route")
            {
                if (place.name != addr.long_name)
                {
                    long_addr = long_addr + ', ' + addr.long_name;
                    document.getElementById('edit-address1').value = long_addr;
                }
            }
            else if (addr.types[0] == "sublocality_level_1")
            {
                if (place.name != addr.long_name)
                {
                    long_addr = long_addr + ', ' + addr.long_name;
                    document.getElementById('edit-address1').value = long_addr;
                }
            }
            else if (addr.types[0] == "sublocality_level_2")
            {
                if (place.name != addr.long_name)
                {
                    document.getElementById('edit-address2').value = addr.long_name;
                }
            }
            else if (addr.types[0] == "locality")
            {
                document.getElementById('edit-city').value = addr.long_name;
            }
            else if (addr.types[0] == "administrative_area_level_1")
            {
                document.getElementById('edit-state').value = addr.long_name;
            }
            else if (addr.types[0] == "postal_code")
            {
                document.getElementById('edit-zipcode').value = addr.long_name;
            }
            else if (addr.types[0] == "country")

            {
                document.getElementById('edit-country').value = addr.long_name;
                var refer_no = jQuery("#edit-country").attr("sb");
                HTML = '<li><a href="#' + addr.long_name + '" rel="' + addr.long_name + '" class="">' + addr.long_name + '</a></li>';
                jQuery("#sbSelector_" + refer_no).text(addr.long_name);

            }
        }
    });
}

 