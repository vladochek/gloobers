<?php

function hotel_add_form_1() {
    global $user;
    $page = arg(2);
    if (($user->uid) == 0) {
        drupal_goto('login');

        exit();
    }
    $hotelForm = array();
    $page = arg(2);
    $hotelForm = array();
    switch ($page) {
        case "overview":
            $overViewListing = 1;
            $hotelForm = drupal_get_form('hotel_details_form');
            break;
        case "rooms":
            $overViewListing = 1;
            $hotelForm = drupal_get_form('hotel_room_form');
            break;
        case "optional_services":
            $overViewListing = 1;
            $hotelForm = drupal_get_form('hotel_optional_service_form');
            break;
        case "rules_policies":
            $overViewListing = 1;
            $hotelForm = drupal_get_form('hotel_rules_policies_form');
            break;
        case "photos":
            $overViewListing = 1;
            $hotelForm = drupal_get_form('hotel_photos_form');
            break;
        case "pricing":
            $overViewListing = 1;
            $hotelForm = drupal_get_form('hotel_pricing_form');
            break;
        case "location":
            $overViewListing = 1;
            $hotelForm = drupal_get_form('location_form');

            break;
        case "calendar":
            $overViewListing = 1;
            $hotelForm = drupal_get_form('calender_from');
            break;
        case "manage":
            $overViewListing = 1;
            $hotelForm = drupal_get_form('manage_form');
            break;
        default:
            $hotelForm = drupal_get_form('hotel_details_form');
            break;
    }
    $_SESSION['hotel_id'] = arg(3);
    return theme('add_hotel', array('payment' => $payment, 'packages' => $packages, 'success' => $success, 'scheduleSessionData' => $scheduleSessionData, 'directionform' => $directionform, 'hotelForm' => $hotelForm, 'photos' => $photos, 'extras' => $extras, 'extrasListing' => $extrasListing, 'hotelDetail' => $hotelDetail, 'addressform' => $addressform, 'addressListing' => $addressListing, 'photosListing' => $photosListing, 'subscriptionListing' => $subscriptionListing, 'overViewListing' => $overViewListing, 'amenitiesList' => $amenitiesList, 'pricingList' => $pricingList, 'schedulingList' => $schedulingList, 'rulesList' => $rulesList, 'calendar' => $calendar));
}

/* * ********Add form for hotel****** */

function hotel_details_form($form, &$form_state) {
    global $user;

    $hotel_id = arg(3);
    if (isset($hotel_id) && !empty($hotel_id)) {
        $hotel_data = getHotelDetailById($hotel_id);
    }
    $hotel_type = array("1" => "1", "2" => "2", "3" => "3", "4" => "4", "5" => "5");
    $form['#attributes']['class'][] = 'Calenderform';
    $form['hotel_details']['hotel_type'] = array(
        '#type' => 'select',
        '#prefix' => '<fieldset><div class="col-lg-6 col-sm-12 col-xs-12 padding_left"><div class="home_town"><h3>Hotel Type </h3>',
        "#options" => $hotel_type,
        '#default_value' => isset($hotel_data) && count($hotel_data) > 0 ? $hotel_data[0]['hotel_type'] : '',
        '#attributes' => array(
            'class' => array('select_box'),
        ),
        '#suffix' => '</div></div>',
        '#required' => TRUE
    );
    $hotel_rating = array("1" => "*", "2" => "**", "3" => "***", "4" => "****", "5" => "*****");
    $form['hotel_details']['hotel_rating'] = array(
        '#type' => 'select',
        '#prefix' => '<div class="col-lg-6 col-sm-12 col-xs-12 padding_left"><div class="home_town"> <h3>Stars </h3>',
        "#options" => $hotel_rating,
        '#default_value' => isset($hotel_data) && count($hotel_data) > 0 ? $hotel_data[0]['hotel_rating'] : '',
        '#attributes' => array(
            'class' => array('select_box'),
        ),
        '#suffix' => '</div></div></fieldset>',
        '#required' => TRUE
    );
    $form['hotel_details']['hotel_title'] = array(
        '#type' => 'textfield',
        '#default_value' => isset($hotel_data) && count($hotel_data) > 0 ? $hotel_data[0]['hotel_name'] : '',
        '#attributes' => array(
            'class' => array('focus_help_menu'), 'data-val' => 'hotel_title', 'placeholder' => 'Write hotel title here',
        ),
        '#prefix' => '<fieldset><label>Hotel Title </label><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_left">',
        '#suffix' => ' </div></fieldset>',
        '#maxlength' => 35,
        '#required' => TRUE
            //<p class="text-right">12 / 35 characters </p>
    );
    $form['hotel_details']['hotel_description'] = array(
        '#type' => 'textarea',
        '#attributes' => array(
            'class' => array('focus_help_menu'), 'data-val' => 'hotel_description', 'placeholder' => 'Introduce Hotel to your travelers....',
        ),
        '#default_value' => isset($hotel_data) && count($hotel_data) > 0 ? $hotel_data[0]['hotel_description'] : '',
        '#prefix' => '<fieldset><label>Describe your hotel</label><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_left">',
        '#suffix' => '</div></fieldset><div class=" col-lg-12 col-md-12 col-sm-12"><h1>Hotel Amenities </h1><h2>What does your Hotel propose?</h2>  ',
        '#required' => TRUE
    );
    $amenities_list = getHotelAmenities();
    $checkbox_array = array(isset($hotel_data) && count($hotel_data) > 0 ? json_decode($hotel_data[0]['hotel_amenities']) : '');

    $form['hotel_details']['hotel_amenities'] = array(
        '#type' => 'checkboxes',
        '#options' => $amenities_list,
        '#attributes' => array(
            'class' => array('css-checkbox'),
        ),
        '#prefix' => '<div class="hotel_amenities">',
        '#suffix' => '</div>',
        '#default_value' => $checkbox_array[0],
    );
    if (isset($hotel_data) && count($hotel_data) > 0) {
        $form['hotel_details']['hotel_id'] = array(
            '#type' => 'hidden',
            '#value' => $hotel_data[0]['hotel_id'],
        );
    }
    $form['hotel_details']['save'] = array(
        '#type' => 'submit',
        '#value' => t('Save'),
        '#attributes' => array('class' => array('')),
        '#prefix' => '</div><fieldset>',
        '#suffix' => '</fieldset>',
    );
    return $form;
}

/* * *
 * FORM FOR ADD HOTEL ROOMS
 */

function hotel_room_form($form, &$form_state) {
    global $user;
    $hotel_id = arg(3);
    $form['#attributes']['class'][] = 'Calenderform';
    $form['#attributes']['novalidate'] = '1';

    $form['hotel_rooms']['save'] = array(
        '#type' => 'submit',
        '#value' => t('Save'),
        '#attributes' => array('class' => array('class' => 'hotel_room_create')),
        '#prefix' => '<div class="room_repeat_div"></div><div class="row"><div class="col-xs-12 col-sm-12 col-md-12" align="center"><fieldset>',
        '#suffix' => '</fieldset></div></div>',
    );
    return $form;
}

/**
 * FORM FOR OPTIONAL SERVICES
 */
function hotel_optional_service_form($form, &$form_state) {
    global $user;

    $hotel_id = arg(3);
    $previous_service_list = getOptionalServicesByHotelId($hotel_id);
    if (isset($hotel_id) && !empty($hotel_id)) {
        $hotel_data = getHotelDetailById($hotel_id);
    }
    $hotel_type = array("1" => "1", "2" => "2", "3" => "3", "4" => "4", "5" => "5");
    $form['#attributes']['class'][] = 'Calenderform';
    $form['hotel_optional_service']['service_name'] = array(
        '#type' => 'textfield',
        '#id' => "service_name_" . time(),
        '#prefix' => '<div class="repeat_field"><fieldset><div class="col-lg-12 col-sm-12 col-xs-12 "><label>Service name</label>',
        //'#default_value' => isset($hotel_data) && count($hotel_data) > 0 ? $hotel_data[0]['hotel_type'] : '',
        '#attributes' => array(
            'class' => array('focus_help_menu'), 'data-val' => 'optional_service_name', 'placeholder' => 'Enter Your Title Here',
        ),
        '#suffix' => '</div></fieldset>',
        '#required' => TRUE
    );
    $form['hotel_optional_service']['service_price'] = array(
        '#type' => 'textfield',
        '#id' => "service_price_" . time(),
        '#prefix' => '<fieldset><div class="col-lg-3 col-sm-12 col-xs-12 "><div class="home_town"><h3>Price</h3>',
        //'#default_value' => isset($hotel_data) && count($hotel_data) > 0 ? $hotel_data[0]['hotel_type'] : '',
        '#attributes' => array(
            'class' => array('focus_help_menu'), 'data-val' => 'optional_service_price', 'placeholder' => 'Amount',
        ),
        '#suffix' => '</div></div>',
        '#required' => TRUE
    );
    $service_currency = array("1" => "1", "2" => "2", "3" => "3", "4" => "4", "5" => "5");
    $form['hotel_optional_service']['service_currency'] = array(
        '#type' => 'select',
        '#id' => "service_currency_" . time(),
        '#prefix' => '<div class="col-lg-4 col-sm-12 col-xs-12 "><div class="home_town"><h3>&nbsp;</h3>',
        "#options" => $service_currency,
        //'#default_value' => isset($hotel_data) && count($hotel_data) > 0 ? $hotel_data[0]['hotel_type'] : '',
        '#attributes' => array(
            'class' => array('select_box'),
        ),
        '#suffix' => '</div></div>',
        '#required' => TRUE
    );
    $service_customer_choice = array("1" => "1", "2" => "2", "3" => "3", "4" => "4", "5" => "5");
    $form['hotel_optional_service']['service_customer_choice'] = array(
        '#type' => 'select',
        '#id' => "service_customer_choice_" . time(),
        '#prefix' => '<div class="col-lg-5 col-sm-12 col-xs-12 "><div class="home_town"><h3>&nbsp;</h3>',
        "#options" => $service_customer_choice,
        //'#default_value' => isset($hotel_data) && count($hotel_data) > 0 ? $hotel_data[0]['hotel_type'] : '',
        '#attributes' => array(
            'class' => array('select_box'),
        ),
        '#suffix' => '</div></div></fieldset>',
        '#required' => TRUE
    );
    $form['hotel_optional_service']['service_description'] = array(
        '#type' => 'textarea',
        '#id' => "service_description_" . time(),
        '#attributes' => array(
            'class' => array('focus_help_menu'), 'data-val' => 'optional_service_description', 'placeholder' => 'Describe your service here.',
        ),
        //'#default_value' => isset($hotel_data) && count($hotel_data) > 0 ? $hotel_data[0]['hotel_description'] : '',
        '#prefix' => '<fieldset><div class="col-lg-12 col-sm-12 col-xs-12"><label>Description</label>',
        '#suffix' => '</div></fieldset></div>',
        '#required' => TRUE
    );
    $form['hotel_optional_service']['service_add_more'] = array(
        '#prefix' => '<fieldset><div class="row"><div class="col-lg-12 col-sm-12 col-xs-12"><a href="javascript:void(0);" class="add_service add_optional_services">Add another Extra Services</a>',
        '#suffix' => '</div></div></fieldset>'
    );
    $list_body_prefix = '<fieldset><div class="col-lg-12 col-sm-12 col-xs-12"><div class="help-block boader_class"><div class="table_heading_help">My optional Services</div>';
    $list_body_prefix .='<table class="table2"><thead><tr><th>Title</th><th>Price</th><th>Action</th></tr></thead><tbody>';
    $data_table = '';
    if (isset($previous_service_list) && !empty($previous_service_list)) {
        foreach ($previous_service_list as $key => $val) {
            $data_table.='<tr><td>' . $val['service_name'] . '</td><td>' . $val['service_price'] . '</td><td><a href="javascript:void(0);" class="delete delete_optional_service" data-val="' . $val["hotel_service_id"] . '">Delete</a></td></tr>';
        }
    } else {
        $data_table .='<tr><td colspan="4">No Service Added Yet !!!</td></tr>';
    }
    $list_body_suffix = '</tbody></table></div></div></fieldset>';
    $form['hotel_optional_service']['service_added_list'] = array(
        '#prefix' => $list_body_prefix . $data_table,
        '#suffix' => $list_body_suffix
    );
    $form['hotel_optional_service']['save'] = array(
        '#type' => 'submit',
        '#id' => 'service_add_btn',
        '#value' => t('Save'),
        '#attributes' => array('class' => array('')),
        '#prefix' => '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12" align="center"><fieldset>',
        '#suffix' => '</div></div>',
    );

    return $form;
}

/**
 * FORM FOR Hotel Rules and Policies
 */
function hotel_rules_policies_form($form, &$form_state) {
    global $user;

    $hotel_id = arg(3);
    $rule_data = getRulesPoliciesofHotel($hotel_id);

    $secuirty_currency = array("1" => "1", "2" => "2", "3" => "3", "4" => "4", "5" => "5");
    $cancel_policy = array("1" => "1", "2" => "2", "3" => "3", "4" => "4", "5" => "5");

    $form['#attributes']['class'][] = 'Calenderform'; //requirement_name
    $form['hotel_rules_policies']['addmore'] = array(
        '#prefix' => '<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12"><div class="boaders_ruleregulation2"><label>Requirements</label><div class="requirement_more"><div class="row first_requirement">',
        '#suffix' => '</div></div><div class="col-md-4 col-lg-4 col-sm-4 col-xs-12 paddng_right" ><a href="javascript:void(0);" class="addanotherrequirement">Add another requirement </a></div></div></div></div>',
    );
    $form['hotel_rules_policies']['other_info'] = array(
        '#type' => 'textarea',
        '#id' => "other_info_" . time(),
        '#prefix' => '<fieldset class="boaders_ruleregulation2 "><div class="row"><div class="col-md-12 col-lg-12 col-sm-12 col-xs-12"><label>Other information</label>',
        '#default_value' => isset($rule_data) && !empty($rule_data) ? $rule_data[0]["other_info"] : "",
        '#attributes' => array(
            'class' => array('focus_help_menu'), 'data-val' => 'other_info', 'placeholder' => 'Any information you want your travelers to know before they book, that hasn\'t been handled prior...  Security Deposit ',
        ),
        '#suffix' => '</div></div></fieldset>',
        '#required' => TRUE
    );
    $form['hotel_rules_policies']['secuirty_amount'] = array(
        '#type' => 'textfield',
        '#id' => "secuirty_amount_" . time(),
        '#prefix' => '<fieldset><div class="row"><div class="col-lg-5 col-md-5 col-sm-5 col-xs-12"><label>Security Deposit </label>',
        '#default_value' => isset($rule_data) && !empty($rule_data) ? $rule_data[0]["secuirty_deposit"] : "",
        '#attributes' => array(
            'class' => array('focus_help_menu'), 'data-val' => 'secuirty_amount', 'placeholder' => 'Amount',
        ),
        '#suffix' => '</div><div class="col-lg-4 col-sm-12 col-xs-12"><label>&nbsp;</label>',
        '#required' => TRUE
    );
    $form['hotel_rules_policies']['secuirty_currency'] = array(
        '#type' => 'select',
        '#id' => "secuirty_currency" . time(),
        '#prefix' => '',
        '#default_value' => isset($rule_data) && !empty($rule_data) ? $rule_data[0]["secuirty_deposit_currency"] : "",
        '#attributes' => array(
            'class' => array('focus_help_menu', 'select_box'), 'data-val' => 'secuirty_currency',
        ),
        "#options" => $secuirty_currency,
        '#suffix' => '</div></div></fieldset>',
        '#required' => TRUE
    );
    $form['hotel_rules_policies']['cancel_policy'] = array(
        '#type' => 'select',
        '#id' => "cancel_policy_" . time(),
        '#prefix' => ' <fieldset><div class="row"><div class="col-lg-12 col-sm-12 col-xs-12"><div class="home_town"><h3>Cancellation Policy </h3>',
        '#default_value' => isset($rule_data) && !empty($rule_data) ? $rule_data[0]["cancellation_policy"] : "",
        '#attributes' => array(
            'class' => array('focus_help_menu', 'select_box'), 'data-val' => 'secuirty_amount', 'placeholder' => 'Amount',
        ),
        "#options" => $cancel_policy,
        '#suffix' => '</div></div></div></fieldset>',
        '#required' => TRUE
    );
    $form['hotel_rules_policies']['early_cancel_amount'] = array(
        '#type' => 'textfield',
        '#id' => "early_cancel_amount_" . time(),
        '#prefix' => ' <fieldset><div class="row"><h4 class="heading">Early cancellation </h4><div class="col-lg-12 col-sm-12 col-xs-12 padding_left padding_right"><div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 paddng_right"><label class="subheading">Is cancellation is made more than </label></div><div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 paddng_right ">',
        '#default_value' => isset($rule_data) && !empty($rule_data) ? $rule_data[0]["early_cancellation_more_price"] : "",
        '#attributes' => array(
            'class' => array('focus_help_menu'), 'data-val' => 'early_cancel_amount', 'placeholder' => 'Amount',
        ),
        '#suffix' => '</div><div class="col-lg-4 col-sm-4 col-xs-12 paddng_right"><div class="home_town">',
        '#required' => TRUE
    );
    $early_cancel_time = array("1" => "1", "2" => "2", "3" => "3", "4" => "4", "5" => "5");
    $form['hotel_rules_policies']['early_cancel_time'] = array(
        '#type' => 'select',
        '#id' => "early_cancel_time_" . time(),
        '#prefix' => '',
        '#default_value' => isset($rule_data) && !empty($rule_data) ? $rule_data[0]["early_cancellation_more_time"] : "",
        '#attributes' => array(
            'class' => array('focus_help_menu', 'select_box'), 'data-val' => 'early_cancel_time',
        ),
        "#options" => $early_cancel_time,
        '#suffix' => '</div></div></div>',
        '#required' => TRUE
    );
    $form['hotel_rules_policies']['early_travel_amount'] = array(
        '#type' => 'textfield',
        '#id' => "early_travel_amount_" . time(),
        '#prefix' => '<div class="col-lg-12 col-sm-12 col-xs-12 padding_left padding_right"><div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 paddng_right"><label class="subheading">travelers will be reimbursed of </label></div><div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 paddng_right">',
        '#default_value' => isset($rule_data) && !empty($rule_data) ? $rule_data[0]["early_traveler_reimbrused_price"] : "",
        '#attributes' => array(
            'class' => array('focus_help_menu'), 'data-val' => 'early_travel_amount', 'placeholder' => 'Amount',
        ),
        '#suffix' => '</div>',
        '#required' => TRUE
    );
    $early_travel_amounttype = array("1" => "1", "2" => "2", "3" => "3", "4" => "4", "5" => "5");
    $form['hotel_rules_policies']['early_travel_amounttype'] = array(
        '#type' => 'select',
        '#id' => "early_travel_amounttype_" . time(),
        '#prefix' => '<div class="col-lg-4 col-sm-4 col-xs-12 paddng_right"><div class="home_town">',
        '#default_value' => isset($rule_data) && !empty($rule_data) ? $rule_data[0]["early_traveler_reimbrused_in"] : "",
        '#attributes' => array(
            'class' => array('focus_help_menu', 'select_box'), 'data-val' => 'early_travel_amounttype',
        ),
        "#options" => $early_travel_amounttype,
        '#suffix' => '</div></div></div> </div></fieldset>',
        '#required' => TRUE
    );
    $form['hotel_rules_policies']['late_cancel_amount'] = array(
        '#type' => 'textfield',
        '#id' => "late_cancel_amount_" . time(),
        '#prefix' => '<fieldset><div class="row"><h4 class="heading">Late cancellation </h4><div class="col-lg-12 col-sm-12 col-xs-12 padding_left padding_right"><div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 paddng_right"><label class="subheading">Is cancellation is made more than </label></div><div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 paddng_right">',
        '#default_value' => isset($rule_data) && !empty($rule_data) ? $rule_data[0]["late_cancellation_more_price"] : "",
        '#attributes' => array(
            'class' => array('focus_help_menu'), 'data-val' => 'late_cancel_amount', 'placeholder' => 'Amount',
        ),
        '#suffix' => '</div><div class="col-lg-4 col-sm-4 col-xs-12 paddng_right"><div class="home_town">',
        '#required' => TRUE
    );

    $late_cancel_time = array("1" => "1", "2" => "2", "3" => "3", "4" => "4", "5" => "5");
    $form['hotel_rules_policies']['late_cancel_time'] = array(
        '#type' => 'select',
        '#id' => "late_cancel_time_" . time(),
        '#prefix' => '',
        '#default_value' => isset($rule_data) && !empty($rule_data) ? $rule_data[0]["late_cancellation_more_time"] : "",
        '#attributes' => array(
            'class' => array('focus_help_menu', 'select_box'), 'data-val' => 'late_cancel_time',
        ),
        "#options" => $late_cancel_time,
        '#suffix' => '</div></div></div>',
        '#required' => TRUE
    );
    $form['hotel_rules_policies']['late_travel_amount'] = array(
        '#type' => 'textfield',
        '#id' => "late_travel_amount_" . time(),
        '#prefix' => '<div class="col-lg-12 col-sm-12 col-xs-12 padding_left padding_right"><div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 paddng_right"><label class="subheading">travelers will be reimbursed of </label></div><div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 paddng_right">',
        '#default_value' => isset($rule_data) && !empty($rule_data) ? $rule_data[0]["late_traveler_reimbrused_price"] : "",
        '#attributes' => array(
            'class' => array('focus_help_menu'), 'data-val' => 'late_travel_amount', 'placeholder' => 'Amount',
        ),
        '#suffix' => '</div><div class="col-lg-4 col-sm-4 col-xs-12 paddng_right"><div class="home_town">',
        '#required' => TRUE
    );

    $late_travel_amounttype = array("1" => "1", "2" => "2", "3" => "3", "4" => "4", "5" => "5");
    $form['hotel_rules_policies']['late_travel_amounttype'] = array(
        '#type' => 'select',
        '#id' => "late_travel_amounttype_" . time(),
        '#prefix' => '',
        '#default_value' => isset($rule_data) && !empty($rule_data) ? $rule_data[0]["late_traveler_reimbrused_in"] : "",
        '#attributes' => array(
            'class' => array('focus_help_menu', 'select_box'), 'data-val' => 'late_travel_amounttype',
        ),
        "#options" => $late_travel_amounttype,
        '#suffix' => '</div></div></div></div></fieldset>',
        '#required' => TRUE
    );

    $form['hotel_rules_policies']['noshow_travel_amount'] = array(
        '#type' => 'textfield',
        '#id' => "noshow_travel_amount_" . time(),
        '#prefix' => '<fieldset><div class="row"><h4 class="heading"> No show policy </h4><div class="col-lg-12 col-sm-12 col-xs-12 padding_left padding_right"><div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 paddng_right"><label class="subheading">Is traveler doesn&#39;t show</label></div><div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 paddng_right">',
        '#default_value' => isset($rule_data) && !empty($rule_data) ? $rule_data[0]["travller_not_show_price"] : "",
        '#attributes' => array(
            'class' => array('focus_help_menu'), 'data-val' => 'noshow_travel_amount', 'placeholder' => 'Amount',
        ),
        '#suffix' => '</div><div class="col-lg-4 col-sm-4 col-xs-12 paddng_right"><div class="home_town">',
        '#required' => TRUE
    );

    $noshow_travel_time = array("1" => "1", "2" => "2", "3" => "3", "4" => "4", "5" => "5");
    $form['hotel_rules_policies']['noshow_travel_time'] = array(
        '#type' => 'select',
        '#id' => "noshow_travel_time_" . time(),
        '#prefix' => '',
        '#default_value' => isset($rule_data) && !empty($rule_data) ? $rule_data[0]["travller_not_show_in"] : "",
        '#attributes' => array(
            'class' => array('focus_help_menu', 'select_box'), 'data-val' => 'noshow_travel_time',
        ),
        "#options" => $noshow_travel_time,
        '#suffix' => '</div></div></div>',
        '#required' => TRUE
    );
    $form['hotel_rules_policies']['noshow_reservation_amount'] = array(
        '#type' => 'textfield',
        '#id' => "noshow_reservation_amount_" . time(),
        '#prefix' => '<div class="col-lg-12 col-sm-12 col-xs-12 padding_left padding_right"><div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 paddng_right"><label class="subheading"> after the start of the reservation </label></div><div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 paddng_right">',
        '#default_value' => isset($rule_data) && !empty($rule_data) ? $rule_data[0]["after_start_reservation_amount"] : "",
        '#attributes' => array(
            'class' => array('focus_help_menu'), 'data-val' => 'noshow_reservationamount', 'placeholder' => 'Amount',
        ),
        '#suffix' => '</div><div class="col-lg-4 col-sm-4 col-xs-12 paddng_right"><div class="home_town">',
        '#required' => TRUE
    );

    $noshow_reservation_time = array("1" => "1", "2" => "2", "3" => "3", "4" => "4", "5" => "5");
    $form['hotel_rules_policies']['noshow_reservation_amounttype'] = array(
        '#type' => 'select',
        '#id' => "noshow_reservation_time_" . time(),
        '#prefix' => '',
        '#default_value' => isset($rule_data) && !empty($rule_data) ? $rule_data[0]["after_start_reservation_in"] : "",
        '#attributes' => array(
            'class' => array('focus_help_menu', 'select_box'), 'data-val' => 'noshow_reservationtime',
        ),
        "#options" => $noshow_travel_time,
        '#suffix' => ' </div></div></div></div></fieldset>',
        '#required' => TRUE
    );
    if (isset($rule_data) && !empty($rule_data)) {
        $form['hotel_rules_policies']['is_edit'] = array(
            '#type' => 'hidden',
            '#value' => "editMode",
        );
    }
    $form['hotel_rules_policies']['save'] = array(
        '#type' => 'submit',
        '#id' => 'hotel_rules_policies_btn',
        '#value' => t('Save'),
        '#attributes' => array('class' => array('')),
        '#prefix' => '<fieldset>',
        '#suffix' => '</fieldset>',
    );

    return $form;
}

/**
 * FORM FOR ADD HOTEL AND ROOMS IMAGES
 */
function hotel_photos_form() {
    $hotel_id = arg(3);
    $room_tabs = '';
    $room_html = '';
    $room_ids = '';
    $prefix_html = '<div class="col-md-12"><div class="row"><form class="Calenderform" name="photo_form" id="photo_form" enctype="multipart/form-data"><ul class="nav nav-tabs2">';
    $prefix_html .='<li class="active"><a data-toggle="tab" href="#home" class="pic_tabs" data-val="">Hotel</a></li>';
    $room_data = getRoomDetailByHotelId($hotel_id);
    $m = 1;
    foreach ($room_data as $key => $value) {
        $room_ids.=$value["room_id"] . ',';
        $room_tabs .='<li><a data-toggle="tab" href="#room_' . $value["room_id"] . '">' . $value["room_name"] . '</a></li>';
        $room_html .='<div id="room_' . $value["room_id"] . '" class="tab-pane fade in "> <div class="uploader"><input type="file" data-val="' . $value["room_id"] . '" data-data="' . $m . '" multiple name="room_pics_' . $value["room_id"] . '[]" class="room_pic_class uploader_field room_class_' . $value["room_id"] . '" id="input_' . $value["room_id"] . '"> </div><div class="room_recent_pics_' . $value["room_id"] . '"></div></div>';
        $m++;
    }
    $prefix_html.=$room_tabs . '</ul>';
    $prefix_html .='<div class="nav-tabs_inner_div"><div class="tab-content"><div id="home" class="tab-pane fade in active"> <div class="uploader"> <input type="file" multiple name="hotel_pics[]" class="hotel_pics uploader_field hotel_pics" id="input2"> </div><div class="hotel_recent_pics">';

    $prefix_html .='</div></div>';
    $prefix_html.=$room_html;
    $prefix_html.='</div></div><div class="clearfix"></div><fieldset> ';
    $form['hotel_photos']['save'] = array(
        '#type' => 'submit',
        '#id' => 'photo_add_btn',
        '#value' => t('Save'),
        '#attributes' => array('class' => array('saveBtn_hotel_photos')),
        '#prefix' => $prefix_html,
        '#suffix' => '<input type="hidden"  id="room_ids" name="room_ids" value="' . rtrim($room_ids, ',') . '"/> <input type="hidden" data-val="' . $hotel_id . '" id="hotel_id_pic" value="' . $hotel_id . '" name="hotel_id"/><input type="hidden" id="room_id_pic" value="" name="room_id"/></fieldset> </form></div></div>',
    );
    return $form;
}

/* * *
 * Hotel Pricing  form 
 */

function hotel_pricing_form() {
    global $user;

    $hotel_id = arg(3);
    $hotel_data = getHotelDetailById($hotel_id);
    $currency = array("1" => "1", "2" => "2", "3" => "3", "4" => "4", "5" => "5");
    $form['#attributes']['class'][] = 'Calenderform';
    $form['hotel_pricing']['currency'] = array(
        '#type' => 'select',
        '#prefix' => '<fieldset><div class="col-lg-3 col-sm-12 col-xs-12 padding_left"><div class="home_town"><h3>Currency </h3> ',
        '#default_value' => isset($hotel_data) && !empty($hotel_data) ? $hotel_data[0]["currency"] : "",
        '#attributes' => array(
            'class' => array('focus_help_menu', 'select_box'), 'data-val' => 'currency',
        ),
        "#options" => $currency,
        '#suffix' => '</select></div></div></fieldset><div class="pricing_form_field"></div>',
        '#required' => TRUE
    );
    $form['hotel_pricing']['save'] = array(
        '#type' => 'submit',
        '#id' => 'hotel_pricing_btn',
        '#value' => t('Save'),
        '#attributes' => array('class' => array('button_create-room-page')),
        '#prefix' => '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12" align="center"><fieldset>',
        '#suffix' => '</fieldset></div></div>',
    );
    return $form;
}

/**
 * form for location of hotel
 */
function location_form($form, &$form_state) {
    global $user;
    $hotel_id = arg(3);
    $form['#attributes']['class'][] = 'Calenderform';
    $hotel_data = getHotelDetailById($hotel_id);
    $prefix = '<fieldset>';



    if (!empty($hotel_data[0]["hotel_longitude"]) && !empty($hotel_data[0]["hotel_address"])) {
        $prefix.='<div class="map" id="map" style="height:300px; width:100%"></div>';
        $prefix.='<div class="location_add"><address><p>' . $hotel_data[0]["hotel_address"] . '</p><p>' . $hotel_data[0]["hotel_address1"] . ' ' . $hotel_data[0]["hotel_city"] . '</p><p>' . $hotel_data[0]["hotel_state"] . ' ' . $hotel_data[0]["hotel_zipcode"] . '</p><p>' . $hotel_data[0]["hotel_country"] . '</p>';
        $prefix.='<p align="center"> <a class="mail show_location_popup" href="javascript:void(0);">Edit address </a></p></address></div>';
    } else {
        $prefix.='<div class="map"><iframe width="100%" id="map" height="300" frameborder="0" style="border:0" src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d55373193.96960599!2d79.985516139203!3d32.104080806377034!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1434543140626"></iframe></div>';
        $prefix.='<div class="location_add"><address>';
        $prefix.='<p align="center"> <a class="mail show_location_popup" href="javascript:void(0);" >Add address</a></p></address></div>';
    }
    $prefix.='</fieldset><fieldset><label>Itinerary  </label><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_left paddng_right">';
    $prefix.='<input type="hidden" name="hotel_id" value ="' . $hotel_id . '"/> <textarea id="hotel-location-description"  data-val="location_description" name="hotel_instruction" cols="" rows="" placeholder="Give itinerary instructions to travelers, bus lines, closest train station, anything that could help them get to you. ">' . $hotel_data[0]["hotel_instruction"] . '</textarea>';
    $prefix.='</div></fieldset><div class="clearfix"></div>';
    $form['hotel_location_form']['save'] = array(
        '#type' => 'submit',
        '#id' => 'hotel_location_btn2',
        '#value' => t('Save'),
        '#maxlength' => 2000,
        '#attributes' => array('class' => array('button_create-room-page')),
        '#prefix' => $prefix,
        '#suffix' => '',
    );
    return $form;
}

/**
 * function for calendar view
 */
function calender_from($form, &$form_state) {
    global $user;
    $hotel_id = arg(3);
    $form['#attributes']['class'][] = 'Calenderform';
    return $form;
}

/**
 * function for calendar view
 */
function manage_form($form, &$form_state) {
    global $user, $base_url;
    //$hotel_id = arg(3);
    $user_id = $user->uid;
    $hotel_list = getHotelListByUser($user_id);
    $prefix = '<p><h2>My Hotel List</h2></p>';
    foreach ($hotel_list as $key => $val) {
        $image_name = json_decode($val["hotel_images"]);
        $prefix.='<div class="col-md-6 col-sm-6 col-sm-12"><div class="new_listing"><img src="' . $base_url . '/' . drupal_get_path('theme', 'hotel_theme') . '/hotel_img/listing_page/' . $image_name[0] . '"/>';
        $prefix.='<div class="listinfo"><h2><a href="' . $base_url . '/hotel/add/overview/' . $val["hotel_id"] . '">' . $val["hotel_name"] . '</a></h2><p>'.$val["hotel_city"].', '.$val["hotel_state"].'</p><div class="editfield"><a href="' . $base_url . '/hotel/add/overview/' . $val["hotel_id"] . '">Edit Hotel</a> <a href="' . $base_url . '/hotel/add/overview/' . $val["hotel_id"] . '">Calendar</a></div></div></div></div>';
    }
    $prefix.='<div class="clearfix"></div><h2><a href="' . $base_url . '/hotel/add/overview/">Create Hotel</a></h2>';
    $form['#attributes']['class'][] = 'Calenderform';
    $form['hotel_list_form'][] = array(
        '#prefix' => $prefix,
        '#suffix' => '',
    );
    return $form;
}
