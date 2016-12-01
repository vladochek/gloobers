<?php

/**
 * @file 
 * Handles the form submission of the customer survey form
 */
/* * ***********************  THIS PORTION CONTAINS ALL VALIDATE FUNCTIONS OF HOTEL RELATED FORM********************* */
function hotel_details_form_validate($form, &$form_state) {
    
}

function hotel_optional_service_form_validate($form, &$form_state) {
    
}

function hotel_room_form_validate($form, &$form_state) {
    
}

function hotel_rules_policies_form_validate($form, &$form_state) {
    
}

/* * ***********************  THIS PORTION CONTAINS ALL VALIDATE FUNCTIONS OF HOTEL RELATED FORM********************* */

/* * ******************************************CONTAIN ALL FORM SUBMIT CODE************************************ */

/**
 * 
 * Submit Hotel add form 
 * Entery in gbl_hotels table
 */
function hotel_details_form_submit($form, &$form_state) {
    global $user;
    $hotel_array = array();
    $hotel_amenities_array = (array_filter($form_state['values']['hotel_amenities']));
    foreach ($hotel_amenities_array as $key => $value) {
        array_push($hotel_array, $value);
    }
    $hotel_amenities = json_encode($hotel_array);
    $data_array = array(
        'hotel_name' => trim($form_state['values']['hotel_title']),
        'hotel_type' => $form_state['values']['hotel_type'],
        'hotel_rating' => $form_state['values']['hotel_rating'],
        'hotel_description' => trim($form_state['values']['hotel_description']),
        'hotel_amenities' => $hotel_amenities,
        'user_id' => $user->uid,
        'created' => getCurrentDateTime(),
    );
    /**
     * update hotel info CASE
     */
    if (isset($form_state['values']['hotel_id']) && !empty($form_state['values']['hotel_id'])) {
        $hotel_id = $form_state['values']['hotel_id'];
        $query = db_update('gbl_hotels')
                ->fields($data_array)
                ->condition("hotel_id", $hotel_id);
        $result = $query->execute();

        if ($result) {
            $_SESSION['hotel_id'] = $result;
            drupal_set_message(t('Hotel overview Updated successfully'));
            drupal_goto('hotel/add/overview/' . $hotel_id);
        }
    } else {
        /**
         * Add Hotel Info CASE
         */
        $query = db_insert('gbl_hotels')
                ->fields($data_array);
        $result = $query->execute();

        if ($result) {
            $_SESSION['hotel_id'] = $result;
            drupal_set_message(t('Hotel overview saved successfully'));
            drupal_goto('hotel/add/overview/' . $result);
        }
    }
}

/**
 * 
 * Submit Hotel add form 
 * Entery in gbl_hotel_optional_services table
 */
function hotel_optional_service_form_submit($form, &$form_state) {
    global $user;
    $array_service_name = array();
    $array_service_price = array();
    $array_service_currency = array();
    $array_service_customer_choice = array();
    $array_service_description = array();
    if (isset($form_state['input']['service_name_extra']) && !empty($form_state['input']['service_name_extra'])) {
        $array_service_name = $form_state['input']['service_name_extra'];
        $array_service_price = $form_state['input']['service_price_extra'];
        $array_service_currency = $form_state['input']['service_currency_extra'];
        $array_service_customer_choice = $form_state['input']['service_customer_choice_extra'];
        $array_service_description = $form_state['input']['service_description_extra'];
    }
    array_unshift($array_service_name, $form_state['values']['service_name']);
    array_unshift($array_service_price, $form_state['values']['service_price']);
    array_unshift($array_service_currency, $form_state['values']['service_currency']);
    array_unshift($array_service_customer_choice, $form_state['values']['service_customer_choice']);
    array_unshift($array_service_description, $form_state['values']['service_description']);
    $hotel_id = arg(3);

    /**
     * query insert data into service table
     * 
     */
    foreach ($array_service_name as $key => $val) {
        $data_array = array(
            'hotel_id' => $hotel_id,
            'service_name' => $val,
            'service_price' => $array_service_price[$key],
            'service_currency' => $array_service_currency[$key],
            'service_customer_choice' => $array_service_customer_choice[$key],
            'service_description' => $array_service_description[$key],
            'created' => getCurrentDateTime(),
        );
        $query = db_insert('gbl_hotel_optional_services')
                ->fields($data_array);
        $result = $query->execute();
    }

    drupal_set_message(t('Hotel overview saved successfully'));
    drupal_goto('hotel/add/optional_services/' . $hotel_id);
}

/**
 * query delete previous records
 * 
 */
$query = db_delete('gbl_hotel_optional_services')
        ->condition("hotel_id", $hotel_id);
$result = $query->execute();

/* * *
 * Submit Create Room form
 * Entry in gbl_hotel_rooms
 */

function hotel_room_form_submit($form, &$form_state) {
    global $user;
    $hotel_id = arg(3);
    
    /**
     * delete room details
     */
    $query = db_delete('gbl_hotel_rooms')
            ->condition("hotel_id", $hotel_id);
    $result = $query->execute();

    foreach ($form_state['input']['room_quantity'] as $key => $val) {
        /**
         * json encode for room amenities
         */
        $room_amenities1 = array();
        if (isset($form_state['input']['room_amenities']) && !empty($form_state['input']['room_amenities'])) {
            foreach ($form_state['input']['room_amenities'][$key] as $keys1 => $val1) {

                $room_amenities1[] = $val1;
            }
        }
        $room_amenities = json_encode($room_amenities1);
        /**
         * json encode for safety amenities
         */
        $room_safety_amenities1 = array();
        if (isset($form_state['input']['safety_amenities']) && !empty($form_state['input']['room_amenities'])) {
            foreach ($form_state['input']['safety_amenities'][$key] as $keys2 => $val2) {

                $room_safety_amenities1[] = $val2;
            }
        }
        $room_safety_amenities = json_encode($room_safety_amenities1);

        $data_array = array(
            'hotel_id' => $hotel_id,
            'room_name' => $form_state['input']['room_name'][$key],
            'room_quantity' => $val,
            'room_real_beds' => $form_state['input']['real_beds'][$key],
            'room_real_bed_type' => $form_state['input']['real_bed_type'][$key],
            'room_real_bed_bath' => $form_state['input']['room_bath'][$key],
            'room_additional_bed' => $form_state['input']['additional_beds'][$key],
            'room_additional_bed_type' => $form_state['input']['bed_type'][$key],
            'room_size' => $form_state['input']['room_size'][$key],
            'room_size_unit' => $form_state['input']['size_units'][$key],
            'room_max_occupancy' => $form_state['input']['max_occupancy'][$key],
            'room_max_adults' => $form_state['input']['max_adults'][$key],
            'room_max_children' => $form_state['input']['max_children'][$key],
            'room_max_babies' => $form_state['input']['max_babies'][$key],
            'room_amenities' => $room_amenities,
            'room_safety_amenities' => $room_safety_amenities,
            'created' => getCurrentDateTime(),
        );


        $query = db_insert('gbl_hotel_rooms')
                ->fields($data_array);
        $result = $query->execute();
    }
    drupal_set_message(t('Room detail saved successfully'));
    drupal_goto('hotel/add/rooms/' . $hotel_id);
}

/**
 * For Submit rules and Policy form
 * table gbl_hotel_rules_policies
 */
function hotel_rules_policies_form_submit($form, &$form_state) {
    global $user;
    $hotel_id = arg(3);
    $requirements = '';
    foreach ($_POST["requirements"] as $key => $val) {
        $requirements .= $val . ',';
    }
    $requirements = rtrim($requirements, ',');
    $data_array = array(
        "hotel_id" => $hotel_id,
        "requirements" => $requirements,
        "other_info" => $_POST["other_info"],
        "secuirty_deposit" => $_POST["secuirty_amount"],
        "secuirty_deposit_currency" => $_POST["secuirty_currency"],
        "cancellation_policy" => $_POST["cancel_policy"],
        "early_cancellation_more_price" => $_POST["early_cancel_amount"],
        "early_cancellation_more_time" => $_POST["early_cancel_time"],
        "early_traveler_reimbrused_price" => $_POST["early_travel_amount"],
        "early_traveler_reimbrused_in" => $_POST["early_travel_amounttype"],
        "late_cancellation_more_price" => $_POST["late_cancel_amount"],
        "late_cancellation_more_time" => $_POST["late_cancel_time"],
        "late_traveler_reimbrused_price" => $_POST["late_travel_amount"],
        "late_traveler_reimbrused_in" => $_POST["late_travel_amounttype"],
        "travller_not_show_price" => $_POST["noshow_travel_amount"],
        "travller_not_show_in" => $_POST["noshow_travel_time"],
        "after_start_reservation_amount" => $_POST["noshow_reservation_amount"],
        "after_start_reservation_in" => $_POST["noshow_reservation_amounttype"],
        "created" => getCurrentDateTime(),
    );
    if (isset($_POST["is_edit"])) {
        $query = db_update('gbl_hotel_rules_policies')
                ->fields($data_array)
                ->condition("hotel_id", $hotel_id);
        $result = $query->execute();
    } else {
        $query = db_insert('gbl_hotel_rules_policies')
                ->fields($data_array);
        $result = $query->execute();
    }

    drupal_set_message(t('Rules and policies detail saved successfully'));
    drupal_goto('hotel/add/rules_policies/' . $hotel_id);
}

/**
 * function for submit pricing form  
 */
function hotel_pricing_form_submit($form, &$form_state) {
    global $user;
    $hotel_id = arg(3);
    /**
     * add room rates 
     * tbl gbl_hotel_rooms
     */
    foreach ($_POST["room_night_rate"] as $key => $val) {
        $data_array = array(
            "room_night_rate" => $val,
            "room_weekend_rate " => $_POST["room_weekend_rate"][$key],
            "room_weekly" => $_POST["room_weekly_rate"][$key],
            "room_weekend_days" => $_POST["room_weekend_days"][$key],
            "room_default_board" => $_POST["room_weekend_rate"][$key],
            "modified" => getCurrentDateTime(),
        );
        $room_id = $_POST["room_rate_ids"][$key];
        $query = db_update('gbl_hotel_rooms')
                ->fields($data_array)
                ->condition("room_id", $room_id);
        $result = $query->execute();
    }
    /**
     * add board info
     * gbl_hotel_boardtype
     */
    $query = db_delete('gbl_hotel_boardtype')
            ->condition("hotel_id", $hotel_id);
    $result = $query->execute();
    foreach ($_POST["board_type"] as $key => $val) {
        $data_array = array(
            "hotel_id" => $hotel_id,
            "board_type" => $val,
            "rent_adjust_type" => $_POST["rent_adjust_type"][$key],
            "board_amount" => $_POST["rent_adjust_price"][$key],
            "board_duration" => $_POST["rent_adjust_duration"][$key],
            "created" => getCurrentDateTime(),
        );

        $query = db_insert('gbl_hotel_boardtype')
                ->fields($data_array);
        $result = $query->execute();
    }
    /**
     * seasonal price
     * gbl_hotel_seasonnal_price
     */
    $query = db_delete('gbl_hotel_seasonnal_price')
            ->condition("hotel_id", $hotel_id);
    $query->execute();
    foreach ($_POST["seasonal_name"] as $key => $val) {
        foreach ($_POST["room_ids_array"] as $key1 => $val1) {
            $data_array = array(
                "hotel_id" => $hotel_id,
                "room_id" => $val1,
                "period_name" => $val,
                "start_date" => $_POST["seasonal_date"][$key],
                "end_date" => $_POST["seasonal_till_date"][$key],
                "min_stay" => $_POST["seasonal_minstay"][$key],
                "nightly_rate" => $_POST["nightly_rate"][$key1],
                "weekend_rate" => $_POST["weekendrate"][$key1],
                "weekly_rate" => $_POST["weeklyrate"][$key1],
                "created" => getCurrentDateTime(),
            );
            $query = db_insert('gbl_hotel_seasonnal_price')
                    ->fields($data_array);
            $result = $query->execute();
        }
    }
    /**
     * add discount and offers 
     * gbl_hotels
     */
    /**
     * 24 hour offer
     */
    $offer_24_data_array = array();
    if (isset($_POST["24_hour_offer"]) && $_POST["24_hour_offer"] == 'on') {
        foreach ($_POST["offer_24_date"] as $key => $val) {
            $data_array = array(
                "offer_24_hour" => $val,
                "offer_24_amount" => $_POST["offer_24_amount"][$key],
                "offer_24_currency" => $_POST["offer_24_currency"][$key],
            );
            $offer_24_data_array[] = $data_array;
        }
    }
    /**
     * last minute offer
     */
    $offer_lastmin_data_array = array();
    if (isset($_POST["last_min_offer"]) && $_POST["last_min_offer"] == 'on') {
        foreach ($_POST["lastmin_time_value"] as $key => $val) {
            $data_array = array(
                "lastmin_time_value" => $val,
                "lastmin_time_type" => $_POST["lastmin_time_type"][$key],
                "lastmin_amount" => $_POST["lastmin_amount"][$key],
                "lastmin_currency" => $_POST["lastmin_currency"][$key],
            );
            $offer_lastmin_data_array[] = $data_array;
        }
    }
    /**
     * early bird offer
     */
    $offer_earlybird_data_array = array();
    if (isset($_POST["early_bird_offer"]) && $_POST["early_bird_offer"] == 'on') {
        foreach ($_POST["earlybird_time_val"] as $key => $val) {
            $data_array = array(
                "earlybird_time_val" => $val,
                "earlybird_time_type" => $_POST["earlybird_time_type"][$key],
                "earlybird_amount" => $_POST["earlybird_amount"][$key],
                "earlybird_currency" => $_POST["earlybird_currency"][$key],
            );
            $offer_earlybird_data_array[] = $data_array;
        }
    }
    /**
     * entry in hotel table
     */
    $data_array = array(
        "twentyfour_hour_offer" => json_encode($offer_24_data_array),
        "lastminute_offer" => json_encode($offer_lastmin_data_array),
        "earlybird_offer" => json_encode($offer_earlybird_data_array),
        "currency" => $_POST["currency"],
        "modified" => getCurrentDateTime(),
    );
    $query = db_update('gbl_hotels')
            ->fields($data_array)
            ->condition("hotel_id", $hotel_id);
    $result = $query->execute();
    drupal_set_message(t('Price detail saved successfully'));
    drupal_goto('hotel/add/pricing/' . $hotel_id);
}

/*     * ******************************************CONTAIN ALL FORM SUBMIT CODE************************************ */    