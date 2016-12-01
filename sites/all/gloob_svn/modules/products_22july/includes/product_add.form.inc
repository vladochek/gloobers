<?php

/**
 * @file
 * Handles the form elements of the customer survey form
 * All hooks are in the .module file.
 */

/**
 * Master form which calls an individual form for each step.
 * 
 * @see customer_survey_form_validate().
 * @see customer_survey_form_submit().
 * 
 * @param type $form
 * @param string $form_state
 * @return type 
 */
function product_add_form($form, &$form_state) {

menu_rebuild();
     
  if (!isset($form_state['stage'])) $form_state['stage'] = 'product_service';
 
/*   $form = array();
  $form = products_get_header($form, $form_state); */

  switch ($form_state['stage']) {
    
    case 'product_service':
      return product_service_form($form, $form_state);
     break;  
 
    case 'product_details': 
      return product_details_form($form, $form_state);  
     break;
 
    case 'product_extra': 
      return product_extra_form($form, $form_state);  
     break;

    case 'product_scheduling':
      return product_scheduling_form($form, $form_state);
     break;  
 
    case 'product_booking_info': 
      return product_booking_info_form($form, $form_state);  
     break;
 
    case 'product_catalogs': 
      return product_catalogs_form($form, $form_state);  
     break;
	 
    case 'product_location': 
      return product_location_form($form, $form_state);  
     break;
 
    case 'product_messages': 
      return product_messages_form($form, $form_state);  
     break;
 
    default:
      return product_choose_service_form($form, $form_state);
     break; 
  }
  
  return $form;
    
}


/**
 * Form for the rate_the_room step.
 * 
 * @see customer_survey_form().
 *  
 * @param type $form
 * @param type $form_state
 * @return type 
 */
function product_service_form($form, &$form_state) {
    
  $values = isset($form_state['multistep_values']['product_service']) ? $form_state['multistep_values']['product_service'] : array();

  $form['product_service']['service_id'] = array(
    '#type' => 'radios',
    '#options' => array(1 => 'Hotels', 2 => 'Vacation Rentals', 3 => 'Restaurants and Activities', 4 => 'Gloobers'),
    '#default_value' => isset($values['service_id']) ? $values['service_id'] : NULL,
	'#required' => TRUE
  );
  
  $form['next'] = array(
    '#type' => 'submit',
    '#value' => t('Next')
  );
    
  return $form;
}


/**
 * Form for the rate_the_service step.
 * 
 * @see customer_survey_form().
 *  
 * @param type $form
 * @param type $form_state
 * @return type 
 */
function product_details_form($form, &$form_state) {
    
  $values = isset($form_state['multistep_values']['product_details']) ? $form_state['multistep_values']['product_details'] : array();

  $form['product_details']['product_name'] = array(
    '#type' => 'textfield',
    '#title' => t('Product name'),
    '#default_value' => isset($values['product_name']) ? $values['product_name'] : NULL,
	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
	'#required' => TRUE
  );
  $form['#attributes'] = array('enctype' => 'multipart/form-data');
  $form['product_details']['unique_code'] = array(
    '#type' => 'textfield',
    '#title' => t('Unique code'),
    '#default_value' => isset($values['unique_code']) ? $values['unique_code'] : NULL,
	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
	'#description' => t('optional')
  );
  
  $form['product_details']['product_pricing_type'] = array(
    '#type' => 'select',
    '#prefix' => '<div class="product_pricing">',
    '#title' => t('Product pricing'),
    '#default_value' => isset($values['product_pricing_type']) ? $values['product_pricing_type'] : NULL,
	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
	'#options' => array('PER_PERSON'=>'By Person','PER_ITEM'=>'By Item','FIXED'=>'Fixed','PER_DAY' => 'By Day','PER_HOUR'=>'By Hour','PER_MINUTE'=>'By Minute')
  );
  
  $form['product_details']['product_pricing_key'] = array(
    '#type' => 'select',
    '#default_value' => isset($values['product_pricing_key']) ? $values['product_pricing_key'] : NULL,
	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
	'#options' => array('everyone'=>'Everyone','adult'=>'Adult','child'=>'Child')
  );
  
  $form['product_details']['product_item_label'] = array(
    '#type' => 'textfield',
    '#default_value' => isset($values['product_item_label']) ? $values['product_item_label'] : NULL,
	'#attributes' => array('placeholder'=>'Label','class' => array('form-control')),
  );
 
  $form['product_details']['product_pricing_min'] = array(
    '#type' => 'textfield',
    '#default_value' => isset($values['product_pricing_min']) ? $values['product_pricing_min'] : NULL,
	'#attributes' => array('placeholder'=>'min','class' => array('form-control')),
  );
  
  $form['product_details']['product_pricing_max'] = array(
    '#type' => 'textfield',
    '#default_value' => isset($values['product_pricing_max']) ? $values['product_pricing_max'] : NULL,
	'#attributes' => array('placeholder'=>'max','class' => array('form-control')),
  );
  
  $form['product_details']['product_pricing_value'] = array(
    '#type' => 'textfield',
    '#default_value' => isset($values['product_pricing_value']) ? $values['product_pricing_value'] : NULL,
	'#attributes' => array('placeholder'=>'Price','class' => array('form-control')),
	'#suffix' => '</div>'
  );

  $form['product_details']['product_pricing_day_type'] = array(
    '#type' => 'select',
    '#default_value' => isset($values['product_pricing_day_type']) ? $values['product_pricing_day_type'] : NULL,
	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
	'#options' => array('EACH'=>'Per day','TOTAL'=>'Total')
  );
  
  $form['product_details']['product_pricing_hour_type'] = array(
    '#type' => 'select',
    '#default_value' => isset($values['product_pricing_hour_type']) ? $values['product_pricing_hour_type'] : NULL,
	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
	'#options' => array('EACH'=>'Per hour','TOTAL'=>'Total')
  );
  
  $form['product_details']['product_pricing_minute_type'] = array(
    '#type' => 'select',
    '#default_value' => isset($values['product_pricing_minute_type']) ? $values['product_pricing_minute_type'] : NULL,
	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
	'#options' => array('EACH'=>'Per minute','TOTAL'=>'Total')
  );
  
  
  $form['product_details']['advertised_price'] = array(
    '#type' => 'textfield',
    '#title' => t('Advertised price'),
	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
    '#default_value' => isset($values['advertised_price']) ? $values['advertised_price'] : NULL,
  );
  
  $form['product_details']['quantity_min'] = array(
    '#type' => 'textfield',
	'#prefix' => '<div class="quantity">',
    '#title' => t('Quantity'),
	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
    '#default_value' => isset($values['quantity_min']) ? $values['quantity_min'] : NULL,
  );
  
  $form['product_details']['quantity_max'] = array(
    '#type' => 'textfield',
	'#suffix' => '</div>',
    '#default_value' => isset($values['quantity_max']) ? $values['quantity_max'] : NULL,
	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
  );
  
  $form['product_details']['quantity_label_singular'] = array(
    '#type' => 'textfield',
	'#prefix' => '<div class="quantity-label">',
    '#title' => t('Quantity label'),
	'#attributes' => array('placeholder'=>'Participant'),
    '#default_value' => isset($values['quantity_label_singular']) ? $values['quantity_label_singular'] : NULL,
	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
  );
  
  $form['product_details']['quantity_label_plural'] = array(
    '#type' => 'textfield',
	'#suffix' => '</div>',
	'#attributes' => array('placeholder'=>'Participants'),
    '#default_value' => isset($values['quantity_label_plural']) ? $values['quantity_label_plural'] : NULL,
	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
  );
  
  $form['product_details']['brief_description'] = array(
    '#type' => 'textarea',
    '#title' => t('Brief description'),
    '#default_value' => isset($values['brief_description']) ? $values['brief_description'] : NULL,
	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
	'#required' => TRUE
  );
 
  $form['product_details']['long_description'] = array(
    '#type' => 'textarea',
    '#title' => t('Long description'),
    '#default_value' => isset($values['long_description']) ? $values['long_description'] : NULL,
	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
	'#required' => TRUE
  );
  
	$form['picture_upload'] = array(
	  '#type' => 'plupload',
	  '#title' => t('Upload files'),
	  '#description' => t('This multi-upload widget uses Plupload library.'),
	  //'#autoupload'=>TRUE,
	  //'#autosubmit'=>TRUE,
	  '#upload_validators' => array(
		'file_validate_extensions' => array('jpg jpeg gif png txt doc xls pdf ppt pps odt ods odp'),
		//'my_custom_file_validator' => array('some validation criteria'),
	  ),
	  '#plupload_settings' => array(
		'runtimes' => 'html5',
		'chunk_size' => '1mb',
	  ),
	);

  $form['product_details']['purchased_as_gift'] = array(
    '#type' => 'checkbox',
	'#prefix' => '<div class="gift-card">',
    '#title' => t('Can be purchased as a gift'),

    '#default_value' => isset($values['purchased_as_gift']) ? $values['purchased_as_gift'] : NULL,
	
  );
  
  $form['product_details']['gift_card_expires'] = array(
    '#type' => 'textfield',
    '#title' => t('expires'),
	'#suffix' => '</div>',
	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
    '#description' => t('days after purchase '),
    '#default_value' => isset($values['gift_card_expires']) ? $values['gift_card_expires'] : NULL,
  );
  
  $form['product_details']['private_tour_chapter'] = array(
    '#type' => 'checkbox',
    '#title' => t('Private tour / Charter'),

    '#default_value' => isset($values['private_tour_chapter']) ? $values['private_tour_chapter'] : NULL,
  );
  
  $form['product_details']['special_deposit_rules'] = array(
    '#type' => 'checkbox',
    '#title' => t('Requires special deposit rules'),
	'#prefix' => '<div class="special-deposit-rules">',

    '#default_value' => isset($values['special_deposit_rules']) ? $values['special_deposit_rules'] : NULL,
  );

  $form['product_details']['special_deposit_rules_type'] = array(
    '#type' => 'select',
    '#options' => array('FULL' => "Full amount", 'DEPOSIT_PERCENT' => 'Deposit (% of order total amount)','DEPOSIT_FIXED' => "Deposit (Fixed amount per person/quantity)", 'DEPOSIT_FIXED_PER_ORDER' => 'Deposit (Fixed amount per order)', 'NONE' => 'No charge'),
    '#default_value' => isset($values['special_deposit_rules_type']) ? $values['special_deposit_rules_type'] : NULL,
	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
  );

  $form['product_details']['special_deposit_rules_value_perc'] = array(
    '#type' => 'textfield',
    '#title' => t('Deposit'),
	'#suffix' => '</div>',
    '#description' => t('%'),
    '#default_value' => isset($values['special_deposit_rules_value_perc']) ? $values['special_deposit_rules_value_perc'] : NULL,
	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
  );
  
  $form['product_details']['special_deposit_rules_value_dollor'] = array(
    '#type' => 'textfield',
    '#title' => t('Deposit amount'),
	'#suffix' => '</div>',
    '#description' => t('$'),
    '#default_value' => isset($values['special_deposit_rules_value_dollor']) ? $values['special_deposit_rules_value_dollor'] : NULL,
	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
  );
  
  $form['back'] = array(
    '#type' => 'submit',
    '#value' => t('Back')
  );
  
  $form['next'] = array(
    '#type' => 'submit',
    '#value' => t('Next')
  );
    
  return $form;
}

function product_extra_form($form, &$form_state){
  $values = isset($form_state['multistep_values']['product_extra']) ? $form_state['multistep_values']['product_extra'] : array();

  $form['product_extra']['extra_value'] = array(
    '#type' => 'radios',
/* 	'#attributes' => array(
		'class' => array('radio'),
	), */
    '#options' => array('no-extra' => "No extras this product doesn't have additional extras ", 'has-extra' => 'This product has the following extras... '),
    '#default_value' => isset($values['extra_value']) ? $values['extra_value'] : NULL,
	'#required' => TRUE
  );
  
  $form['product_extra']['new_extra'] = array(
	'#prefix' => '<div class="product-extra" style="display:none;">',
    '#type' => 'textfield',
	'#attributes' => array(
		'class' => array('form-control'),
	),
    '#title' => t('New extra'),
    '#default_value' => isset($values['new_extra']) ? $values['new_extra'] : NULL,
  );
  
  $form['product_extra']['extra_price_value'] = array(
    '#type' => 'textfield',
    '#prefix' => '<div class="product_extra_price">',
	'#attributes' => array(
		'class' => array('form-control'),
	),
    '#title' => t('Price'),
    '#default_value' => isset($values['extra_price_value']) ? $values['extra_price_value'] : NULL,
  );
  
  $form['product_extra']['extra_price_key'] = array(
    '#type' => 'select',
	'#attributes' => array(
		'class' => array('form-control'),
	),
    '#default_value' => isset($values['extra_price_key']) ? $values['extra_price_key'] : NULL,
	'#options' => array('customer-choice'=>'Customer Choice','per-order'=>'Per Order','per-quantity'=>'Per Quantity'),
	'#suffix' => '</div>'
  );
 
  $form['product_extra']['product_extra_description'] = array(
    '#type' => 'textarea',
	'#attributes' => array(
		'class' => array('form-control'),
	),
    '#title' => t('Description'),
    '#default_value' => isset($values['product_extra_description']) ? $values['product_extra_description'] : NULL,
  ); 
  
	$form['product_extra']['file'] = array(
	'file_managed_container' => array(
		//'#prefix' => "<div class='coloum'>",
		'#suffix' => '</div>',
		'file_managed_element' => array(
			'#type' => 'managed_file',
			'#title' => t('Select image'),
			'#description' => t('Allowed extensions: gif,png,jpg,jpeg,doc,txt,zip,docx'),
			'#default_value' => (isset($foo->picture->fid) ? $foo->picture->fid : ''),
			'#upload_location' => 'public://product/extra',
			'#upload_validators' => array(
			'file_validate_extensions' => array('gif png jpg jpeg doc docx txt zip'),
			// Pass the maximum file size in bytes
			// 'file_validate_size' => array(MAX_FILE_SIZE*1024*1024),
			),
		),
	),
	);
  $form['back'] = array(
    '#type' => 'submit',
    '#value' => t('Back')
  );
  
  $form['next'] = array(
    '#type' => 'submit',
    '#value' => t('Next')
  );
    
  return $form;
}

function product_scheduling_form($form, &$form_state){
  $values = isset($form_state['multistep_values']['product_scheduling']) ? $form_state['multistep_values']['product_scheduling'] : array();
  
  $form['product_scheduling']['dates_available'] = array(
    '#type' => 'select',
    '#title' => t('Dates available'),
	'#attributes' => array(
		'class' => array('form-control'),
	),
    '#default_value' => isset($values['dates_available']) ? $values['dates_available'] : NULL,
	'#options' => array('INVENTORY'=>'Fixed dates & times','DATE_ENQUIRY'=>'Any date - Accept enquiries for any date','NO_DATE'=>'Date not required for booking'),
	'#required' => TRUE
  );
  
  $form['product_scheduling']['availability_type'] = array(
    '#type' => 'select',
	'#prefix' => '<div class="product-availability">',
	'#attributes' => array(
		'class' => array('form-control'),
	),
    '#title' => t('Availability'),
    '#default_value' => isset($values['availability_type']) ? $values['availability_type'] : NULL,
	'#options' => array('FREE_SALE'=>'Unlimited - Free sale','SESSION_SEATS'=>'Limited - Fixed limit per session','RESOURCES'=>'Limited - By resources'),
  );
  
  $form['product_scheduling']['availability_value'] = array(
    '#type' => 'textfield',
	'#attributes' => array(
		'class' => array('form-control'),
	),
    '#title' => 'Limit',
    '#suffix' => '</div>',
    '#default_value' => isset($values['availability_value']) ? $values['availability_value'] : NULL,
  );
  
  $form['product_scheduling']['time_available_type'] = array(
    '#type' => 'select',
	'#attributes' => array(
		'class' => array('form-control'),
	),
	'#prefix' => '<div class="time-available" style="display:none;">',
    '#title' => t('Times available'),
    '#default_value' => isset($values['time_available_type']) ? $values['time_available_type'] : NULL,
	'#options' => array('FIXED'=>'Fixed times','TIME_ENQUIRY'=>'Any time - Allow customer to choose a time','NO_TIME'=>'Time not required for booking'),
  );
  
  $form['product_scheduling']['time_available_value'] = array(
    '#type' => 'textfield',
	'#attributes' => array(
		'class' => array('form-control'),
	),
    '#title' => 'Available time',
    '#suffix' => '</div>',
    '#default_value' => isset($values['time_available_value']) ? $values['time_available_value'] : NULL,
  );
  
  $form['product_scheduling']['manage_resources'] = array(
	'#prefix' => '<a class="manage-resources" href="#" style="color:#018fe2;display:none;">Manage Resources',
	'#suffix' => '</a>',
  );
  
  $form['product_scheduling']['confirm_booking_type'] = array(
    '#type' => 'select',
	'#attributes' => array(
		'class' => array('form-control'),
	),
	'#prefix' => '<div class="product-confirm-booking">',
    '#title' => t(' Confirm bookings'),
    '#default_value' => isset($values['confirm_booking_type']) ? $values['confirm_booking_type'] : NULL,
	'#options' => array('AUTOCONFIRM'=>'Automatically','MANUAL'=>'Manually','MANUAL_THEN_AUTO'=>'Start manual then automatic','AUTO_THEN_MANUAL'=>'Start automatic then manual'),
  );
  
  $form['product_scheduling']['confirm_booking_value'] = array(
    '#type' => 'textfield',
    '#title' => 'after',
	'#attributes' => array(
		'class' => array('form-control'),
	),
    '#description' => 'Participants',
    '#suffix' => '</div>',
    '#default_value' => isset($values['confirm_booking_value']) ? $values['confirm_booking_value'] : NULL,
  );
  
  $form['product_scheduling']['duration_value'] = array(
    '#type' => 'textfield',
	'#attributes' => array(
		'class' => array('form-control'),
	),
	'#prefix' => '<div class="product-estimate-duration">',
    '#title' => 'Estimated duration',
    '#default_value' => isset($values['duration_value']) ? $values['duration_value'] : NULL,
  );
  
  $form['product_scheduling']['duration_type'] = array(
    '#type' => 'select',
	'#attributes' => array(
		'class' => array('form-control'),
	),
    '#default_value' => isset($values['duration_type']) ? $values['duration_type'] : NULL,
	'#suffix' => '</div>',
	'#options' => array('MINUTES'=>'Minutes','HOURS'=>'Hours','DAYS'=>'Days'),
  );
  
  $form['product_scheduling']['product_color'] = array(
    '#type' => 'textfield',
    '#title' => 'Product Color',
    '#required' => TRUE,
	'#attributes' => array(
		'class' => array('form-control','colorpicker'),
	),
    '#default_value' => isset($values['product_color']) ? $values['product_color'] : NULL,
  );
  
  $form['back'] = array(
    '#type' => 'submit',
    '#value' => t('Back')
  );
  
  $form['next'] = array(
    '#type' => 'submit',
    '#value' => t('Next')
  );
    
  return $form;
}

function product_booking_info_form($form, &$form_state){
  $form['back'] = array(
    '#type' => 'submit',
    '#value' => t('Back')
  );
  
  $form['next'] = array(
    '#type' => 'submit',
    '#value' => t('Next')
  );
    
  return $form;
}

function product_catalogs_form($form, &$form_state){
  $values = isset($form_state['multistep_values']['product_catalogs']) ? $form_state['multistep_values']['product_catalogs'] : array();
  
  $form['product_catalogs']['onilne_bookings'] = array(
    '#prefix' => '<div class="onilne-bookings"><h3>Online bookings</h3>',

  );
  
  $form['product_catalogs']['onilne_bookings_tours'] = array(
    '#type' => 'checkbox',
    '#title' => t('TOURS'),
	'#suffix' => '</div>',
  );
  
  $form['product_catalogs']['partners'] = array(
    '#prefix' => '<div class="partners"><h3>Partners</h3>',

  );
  
  $form['product_catalogs']['my_partners'] = array(
    '#type' => 'checkbox',
    '#title' => t('My partners'),
	'#suffix' => '</div>',
	'#prefix' => '<div class="my-partners">',
  );
  
  $form['product_catalogs']['my_partners_commission'] = array(
    '#type' => 'textfield',
    '#title' => t('COMMISSION'),
	'#attributes' => array(
		'class' => array('form-control'),
	),
	'#default_value' => isset($values['my_partners_commission']) ? $values['my_partners_commission'] : NULL,
	'#suffix' => '</div>',
  );
  
  
  $form['product_catalogs']['gloobers_community'] = array(
    '#prefix' => '<div class="gloobers-community"><h3>Gloobers Community</h3>',

  );
  
  $form['product_catalogs']['distribute'] = array(
    '#type' => 'checkbox',
    '#title' => t('Distribute'),
	'#suffix' => '</div>',
	'#prefix' => '<div class="distribute">',
  );
  
  $form['product_catalogs']['distribute_commission'] = array(
    '#type' => 'textfield',
    '#title' => t('COMMISSION'),
	'#attributes' => array(
		'class' => array('form-control'),
	),
	'#default_value' => isset($values['distribute_commission']) ? $values['distribute_commission'] : NULL,
	'#suffix' => '</div>',
  );
  
  $form['back'] = array(
    '#type' => 'submit',
    '#value' => t('Back')
  );
  
  $form['next'] = array(
    '#type' => 'submit',
    '#value' => t('Next')
  );
    
  return $form;
}

function product_location_form($form, &$form_state){
	$values = isset($form_state['multistep_values']['product_location']) ? $form_state['multistep_values']['product_location'] : array();
	
	$form['product_location']['address'] = array(
		'#type' => 'textfield',
		'#title' => t('Search address'),
	'#attributes' => array(
		'class' => array('form-control'),
	),
		'#default_value' => isset($values['address']) ? $values['address'] : NULL,
	);	

	$form['product_location']['find'] = array(
		'#prefix' => '<a href="javascript:void(0)" style="color:#018fe2" class="find-address">Find',
		'#suffix' => '</a>',
	);

	$form['product_location']['map'] = array(
		'#prefix' => '<div id="mapCanvas"> 
					<div id="infoPanel">
						<div id="markerStatus"></div>
						<div id="info"></div>
					<div id="address"></div>',
		'#suffix' => '</div></div>',
	);	
	

	$form['product_location']['show_map'] = array(
		'#type' => 'checkbox',
		'#title' => t('Show map in confirmation emails'),
	);
  
	$form['back'] = array(
		'#type' => 'submit',
		'#value' => t('Back')
	);
  
	$form['next'] = array(
		'#type' => 'submit',
		'#value' => t('Next')
	);
    
	return $form;
}

?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script>

	var jq=jQuery.noConflict();
	jq(document).ready(function(){
	
	<?php 
		global $base_url;
		$library_path = _plupload_library_path();
	?>
	/*var geocoder = new google.maps.Geocoder();
	var address = "new york";

	geocoder.geocode( { 'address': address}, function(results, status) {

	  if (status == google.maps.GeocoderStatus.OK) {
		var latitude = results[0].geometry.location.lat();
		var longitude = results[0].geometry.location.lng();
		alert(latitude);
	  } 
	}); */

	jq(".find-address").click(function(){
		initialize();
	});

	var geocoder = new google.maps.Geocoder();

	function geocodePosition(pos) {
	  geocoder.geocode({
		latLng: pos
	  }, function(responses) {
		if (responses && responses.length > 0) {
		  updateMarkerAddress(responses[0].formatted_address);
		} else {
		  updateMarkerAddress('Cannot determine address at this location.');
		}
	  });
	}

	function updateMarkerStatus(str) {
	  jq("#markerStatus").html(str);
	}

	function updateMarkerPosition(latLng) {
	geocoder.geocode({ 'latLng': new google.maps.LatLng(latLng.lat(),latLng.lng()) }, function(results, status){
		jq("#edit-address").val(results[0].formatted_address);
	});
		jq("#info").html([
			latLng.lat(),
			latLng.lng()
		].join(', '));
	}

	function updateMarkerAddress(str) {
	  jq("#address").html(str);
	}

	function initialize() {
		var address = jq("#edit-address").val();
		geocoder.geocode( { 'address': address}, function(results, status) {

		if (status == google.maps.GeocoderStatus.OK) {
			var latitude = results[0].geometry.location.lat();
			var longitude = results[0].geometry.location.lng();
		} 

		var latLng = new google.maps.LatLng(latitude, longitude);
		var map = new google.maps.Map(document.getElementById('mapCanvas'), {
			zoom: 8,
			center: latLng,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		});
		var marker = new google.maps.Marker({
			position: latLng,
			title: 'Point A',
			map: map,
			draggable: true
		});
	 
	  // Update current position info.
	  updateMarkerPosition(latLng);
	  geocodePosition(latLng);
	 
	  // Add dragging event listeners.
	  google.maps.event.addListener(marker, 'dragstart', function() {
		updateMarkerAddress('Dragging...');
	  });
	 
	  google.maps.event.addListener(marker, 'drag', function() {
		updateMarkerStatus('Dragging...');
		updateMarkerPosition(marker.getPosition());
	  });
	 
	  google.maps.event.addListener(marker, 'dragend', function() {
		updateMarkerStatus('Drag ended');
		geocodePosition(marker.getPosition());
	  });
	  
	  });
	}

	// Onload handler to fire off the app.
	google.maps.event.addDomListener(window, 'load', initialize);

	   if(jq("#edit-product-pricing-type").val() == "PER_PERSON"){
			jq(".form-item-product-item-label").hide();
			jq(".form-item-product-pricing-min").hide();
			jq(".form-item-product-pricing-max").hide();
			jq(".form-item-product-pricing-day-type").hide();
			jq(".form-item-product-pricing-minute-type").hide();
			jq(".form-item-product-pricing-hour-type").hide();
			jq(".form-item-product-pricing-key").show();
			jq(".form-item-product-pricing-value").show();
	   }
	   else if(jq("#edit-product-pricing-type").val() == "PER_ITEM"){
			jq(".form-item-product-item-label").show();
			jq(".form-item-product-pricing-min").hide();
			jq(".form-item-product-pricing-max").hide();
			jq(".form-item-product-pricing-day-type").hide();
			jq(".form-item-product-pricing-minute-type").hide();
			jq(".form-item-product-pricing-hour-type").hide();
			jq(".form-item-product-pricing-key").hide();
			jq(".form-item-product-pricing-value").show();
	   }
	   else if(jq("#edit-product-pricing-type").val() == "FIXED"){
			jq(".form-item-product-item-label").hide();
			jq(".form-item-product-pricing-min").hide();
			jq(".form-item-product-pricing-max").hide();
			jq(".form-item-product-pricing-day-type").hide();
			jq(".form-item-product-pricing-minute-type").hide();
			jq(".form-item-product-pricing-hour-type").hide();
			jq(".form-item-product-pricing-key").hide();
			jq(".form-item-product-pricing-value").show();
	   }
	   else if(jq("#edit-product-pricing-type").val() == "PER_DAY"){
			jq(".form-item-product-item-label").hide();
			jq(".form-item-product-pricing-min").show();
			jq(".form-item-product-pricing-max").show();
			jq(".form-item-product-pricing-day-type").show();
			jq(".form-item-product-pricing-minute-type").hide();
			jq(".form-item-product-pricing-hour-type").hide();
			jq(".form-item-product-pricing-key").hide();
			jq(".form-item-product-pricing-value").show();
	   }
	   else if(jq("#edit-product-pricing-type").val() == "PER_HOUR"){
			jq(".form-item-product-item-label").hide();
			jq(".form-item-product-pricing-min").show();
			jq(".form-item-product-pricing-max").show();
			jq(".form-item-product-pricing-day-type").hide();
			jq(".form-item-product-pricing-minute-type").hide();
			jq(".form-item-product-pricing-hour-type").show();
			jq(".form-item-product-pricing-key").hide();
			jq(".form-item-product-pricing-value").show();
	   }
	   else if(jq("#edit-product-pricing-type").val() == "PER_MINUTE"){
			jq(".form-item-product-item-label").hide();
			jq(".form-item-product-pricing-min").show();
			jq(".form-item-product-pricing-max").show();
			jq(".form-item-product-pricing-day-type").hide();
			jq(".form-item-product-pricing-minute-type").show();
			jq(".form-item-product-pricing-hour-type").hide();
			jq(".form-item-product-pricing-key").hide();
			jq(".form-item-product-pricing-value").show();
	   }

		jq("#edit-product-pricing-type").change(function(){
		   if(jq("#edit-product-pricing-type").val() == "PER_PERSON"){
				jq(".form-item-product-item-label").hide();
				jq(".form-item-product-pricing-min").hide();
				jq(".form-item-product-pricing-max").hide();
				jq(".form-item-product-pricing-day-type").hide();
				jq(".form-item-product-pricing-minute-type").hide();
				jq(".form-item-product-pricing-hour-type").hide();
				jq(".form-item-product-pricing-key").show();
				jq(".form-item-product-pricing-value").show();
		   }
		   else if(jq("#edit-product-pricing-type").val() == "PER_ITEM"){
				jq(".form-item-product-item-label").show();
				jq(".form-item-product-pricing-min").hide();
				jq(".form-item-product-pricing-max").hide();
				jq(".form-item-product-pricing-day-type").hide();
				jq(".form-item-product-pricing-minute-type").hide();
				jq(".form-item-product-pricing-hour-type").hide();
				jq(".form-item-product-pricing-key").hide();
				jq(".form-item-product-pricing-value").show();
		   }
		   else if(jq("#edit-product-pricing-type").val() == "FIXED"){
				jq(".form-item-product-item-label").hide();
				jq(".form-item-product-pricing-min").hide();
				jq(".form-item-product-pricing-max").hide();
				jq(".form-item-product-pricing-day-type").hide();
				jq(".form-item-product-pricing-minute-type").hide();
				jq(".form-item-product-pricing-hour-type").hide();
				jq(".form-item-product-pricing-key").hide();
				jq(".form-item-product-pricing-value").show();
		   }
		   else if(jq("#edit-product-pricing-type").val() == "PER_DAY"){
				jq(".form-item-product-item-label").hide();
				jq(".form-item-product-pricing-min").show();
				jq(".form-item-product-pricing-max").show();
				jq(".form-item-product-pricing-day-type").show();
				jq(".form-item-product-pricing-minute-type").hide();
				jq(".form-item-product-pricing-hour-type").hide();
				jq(".form-item-product-pricing-key").hide();
				jq(".form-item-product-pricing-value").show();
		   }
		   else if(jq("#edit-product-pricing-type").val() == "PER_HOUR"){
				jq(".form-item-product-item-label").hide();
				jq(".form-item-product-pricing-min").show();
				jq(".form-item-product-pricing-max").show();
				jq(".form-item-product-pricing-day-type").hide();
				jq(".form-item-product-pricing-minute-type").hide();
				jq(".form-item-product-pricing-hour-type").show();
				jq(".form-item-product-pricing-key").hide();
				jq(".form-item-product-pricing-value").show();
		   }
		   else if(jq("#edit-product-pricing-type").val() == "PER_MINUTE"){
				jq(".form-item-product-item-label").hide();
				jq(".form-item-product-pricing-min").show();
				jq(".form-item-product-pricing-max").show();
				jq(".form-item-product-pricing-day-type").hide();
				jq(".form-item-product-pricing-minute-type").show();
				jq(".form-item-product-pricing-hour-type").hide();
				jq(".form-item-product-pricing-key").hide();
				jq(".form-item-product-pricing-value").show();
		   }		
		})	
		
		if (jq("#edit-purchased-as-gift").is(":checked")) {
		   jq(".form-item-gift-card-expires").show();
		}
			
		jq("#edit-purchased-as-gift").click(function(){
			if (jq("#edit-purchased-as-gift").is(":checked")) {
			   jq(".form-item-gift-card-expires").show();
			}
			else{
				jq(".form-item-gift-card-expires").hide();
			}
		});
		
		if (jq("#edit-special-deposit-rules").is(":checked")) {
		   jq(".form-item-special-deposit-rules-type").show();
		   if(jq("#edit-special-deposit-rules-type").val() == "DEPOSIT_PERCENT"){
				jq(".form-item-special-deposit-rules-value-perc").show();
				jq(".form-item-special-deposit-rules-value-dollor").hide();
		   }
		   else if((jq("#edit-special-deposit-rules-type").val() == "DEPOSIT_FIXED") ||  (jq("#edit-special-deposit-rules-type").val() == "DEPOSIT_FIXED_PER_ORDER")){
				jq(".form-item-special-deposit-rules-value-dollor").show();
				jq(".form-item-special-deposit-rules-value-perc").hide();
		   }
		   else if((jq("#edit-special-deposit-rules-type").val() == "FULL") ||  (jq("#edit-special-deposit-rules-type").val() == "NONE")){
				jq(".form-item-special-deposit-rules-value-dollor").hide();
				jq(".form-item-special-deposit-rules-value-perc").hide();
		   }
		}
			
		jq("#edit-special-deposit-rules").click(function(){
			if (jq("#edit-special-deposit-rules").is(":checked")) {
				   jq(".form-item-special-deposit-rules-type").show();
				   if(jq("#edit-special-deposit-rules-type").val() == "DEPOSIT_PERCENT"){
						jq(".form-item-special-deposit-rules-value-perc").show();
						jq(".form-item-special-deposit-rules-value-dollor").hide();
				   }
				   else if((jq("#edit-special-deposit-rules-type").val() == "DEPOSIT_FIXED") ||  (jq("#edit-special-deposit-rules-type").val() == "DEPOSIT_FIXED_PER_ORDER")){
						jq(".form-item-special-deposit-rules-value-dollor").show();
						jq(".form-item-special-deposit-rules-value-perc").hide();
				   }
				   else if((jq("#edit-special-deposit-rules-type").val() == "FULL") ||  (jq("#edit-special-deposit-rules-type").val() == "NONE")){
						jq(".form-item-special-deposit-rules-value-dollor").hide();
						jq(".form-item-special-deposit-rules-value-perc").hide();
				   }
			}
			else{
				jq(".form-item-special-deposit-rules-type").hide();
				jq(".form-item-special-deposit-rules-value-dollor").hide();
				jq(".form-item-special-deposit-rules-value-perc").hide();
			}
		});

		jq("#edit-special-deposit-rules-type").change(function(){
			   if(jq(this).val() == "DEPOSIT_PERCENT"){
					jq(".form-item-special-deposit-rules-value-perc").show();
					jq(".form-item-special-deposit-rules-value-dollor").hide();
			   }
			   else if((jq(this).val() == "DEPOSIT_FIXED") ||  (jq(this).val() == "DEPOSIT_FIXED_PER_ORDER")){
					jq(".form-item-special-deposit-rules-value-dollor").show();
					jq(".form-item-special-deposit-rules-value-perc").hide();
			   }
			   else if((jq(this).val() == "FULL") ||  (jq(this).val() == "NONE")){
					jq(".form-item-special-deposit-rules-value-dollor").hide();
					jq(".form-item-special-deposit-rules-value-perc").hide();
			   }			
		})	

		if (jq("#edit-extra-value-has-extra").is(":checked")) {
		   jq(".product-extra").show();
		}
		
		jq("#edit-extra-value input").click(function(){
			var button = jq(this).val();
			if(button == "has-extra"){
				jq(".product-extra").show();
			}
			else{
				jq(".product-extra").hide();
			}
		});
		if (jq("#edit-dates-available").val() == "NO_DATE") {
						jq(".product-availability").hide();
						jq(".time-available").hide();
		}	
		else if (jq("#edit-dates-available").val() == "INVENTORY") {
						jq(".product-availability").show();
						jq(".time-available").hide();
		}	
		else if (jq("#edit-dates-available").val() == "DATE_ENQUIRY") {
						jq(".time-available").show();
						jq(".product-availability").hide();
		}		
		jq("#edit-dates-available").change(function(){
			var type = jq(this).val();
			switch(type){
				case 'NO_DATE':
						jq(".product-availability").hide();
						jq(".time-available").hide();
						break;
				case 'INVENTORY':
						jq(".product-availability").show();
						jq(".time-available").hide();
						if (jq("#edit-availability-type").val() == "SESSION_SEATS") {
						   jq(".form-item-availability-value").show();
						   jq(".manage-resources").hide();
						}
						else if(jq("#edit-availability-type").val() == "RESOURCES"){
						   jq(".form-item-availability-value").hide();
						   jq(".manage-resources").show();							
						}
						else if(jq("#edit-availability-type").val() == "FREE_SALE"){
						   jq(".form-item-availability-value").hide();
						   jq(".manage-resources").hide();							
						}
						break;
				case 'DATE_ENQUIRY':
						jq(".time-available").show();
						jq(".product-availability").hide();
						jq(".manage-resources").hide();
						break;
				default:
						jq(".product-availability").show();
						break;
			}
		});
		if (jq("#edit-availability-type").val() == "SESSION_SEATS") {
		   jq(".form-item-availability-value").show();
		}	
		else{
			jq(".form-item-availability-value").hide();
		}
		jq("#edit-availability-type").change(function(){
			var type = jq(this).val();
			switch(type){
				case 'FREE_SALE':
						jq(".form-item-availability-value").hide();
						jq(".manage-resources").hide();
						break;
				case 'SESSION_SEATS':
						jq(".form-item-availability-value").show();
						jq(".manage-resources").hide();
						break;
				case 'RESOURCES':
						jq(".form-item-availability-value").hide();
						jq(".manage-resources").show();
						break;
				default:
						jq(".product-availability").show();
						break;
			}
		});
		if ((jq("#edit-confirm-booking-type").val() == "AUTOCONFIRM") || (jq("#edit-confirm-booking-type").val() == "MANUAL")) {
		   jq(".form-item-confirm-booking-value").hide();
		}	
		else{
			jq(".form-item-confirm-booking-value").show();
		}		
		jq("#edit-confirm-booking-type").change(function(){
			var type = jq(this).val();
			switch(type){
				case 'AUTOCONFIRM':
						jq(".form-item-confirm-booking-value").hide();
						break;
				case 'MANUAL':
						jq(".form-item-confirm-booking-value").hide();
						break;
				case 'MANUAL_THEN_AUTO':
						jq(".form-item-confirm-booking-value").show();
						break;
				case 'AUTO_THEN_MANUAL':
						jq(".form-item-confirm-booking-value").show();
						break;
				default:
						jq(".form-item-confirm-booking-value").hide();
						break;
			}
		});
		if (jq("edit-time-available-type").val() == "FIXED") {
		   jq(".form-item-time-available-value").show();
		}	
		else{
			jq(".form-item-time-available-value").hide();
		}			
		jq("#edit-time-available-type").change(function(){
			var type = jq(this).val();
			switch(type){
				case 'FIXED':
						jq(".form-item-time-available-value").show();
						break;
				case 'TIME_ENQUIRY':
						jq(".form-item-time-available-value").hide();
						break;
				case 'NO_TIME':
						jq(".form-item-time-available-value").hide();
						break;
				default:
						jq(".form-item-time-available-value").show();
						break;
			}
		});
 	$(".form-type-plupload").plupload({
        // General settings
        runtimes : 'html5,flash,silverlight,html4',
        url : "<?php echo $base_url; ?>/product/add/images",
 
        // Maximum file size
        max_file_size : '2mb',
 
        chunk_size: '1mb',
 
        // Resize images on clientside if we can
        resize : {
            width : 200, 
            height : 200, 
            quality : 90,
            crop: true // crop to exact dimensions
        },
 
        // Specify what files to browse for
        filters : [
            {title : "Image files", extensions : "jpg,gif,png"},
            {title : "Zip files", extensions : "zip,avi"}
        ],
 
        // Rename files by clicking on their titles
        rename: true,
         
        // Sort files
        sortable: true,
 
        // Enable ability to drag'n'drop files onto the widget (currently only HTML5 supports that)
        dragdrop: true,
 
        // Views to activate
        views: {
            list: true,
            thumbs: true, // Show thumbs
            active: 'thumbs'
        },
 
        // Flash settings
        flash_swf_url : "<?php echo libraries_get_path('plupload').'/js/plupload.flash.swf'; ?>",
     
        // Silverlight settings
        silverlight_xap_url : "<?php echo libraries_get_path('plupload').'/js/plupload.silverlight.xap'; ?>"
    }); 
	
	});
</script>

<style>
	.onilne-bookings h3,.partners h3,.gloobers-community h3{
		color:#000;
		text-align:left;
	}
	#mapCanvas {
		width: 500px;
		height: 400px;
	}
	#infoPanel {
		float: left;
		margin-left: 10px;
	}
	#infoPanel div {
		margin-bottom: 5px;
	}
	.form-item-gift-card-expires{
		display:none;
	}
	.form-item-special-deposit-rules-type, .form-item-special-deposit-rules-value-perc, .form-item-special-deposit-rules-value-dollor{
		display:none;
	}
</style>
