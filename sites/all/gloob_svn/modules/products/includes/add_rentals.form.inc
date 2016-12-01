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
function add_rentals_form(){
	menu_rebuild();
	$photos = array();
	$page = arg(2);
	$extrasListing = $addressListing = $photosListing = $subscriptionListing = 0;
	switch($page){
		case "overview":
			$productForm = drupal_get_form('rentals_overview_form');
		break;
		case "details":
			$productForm = drupal_get_form('rentals_details_form');
		break;
		case "photos":
			$photosListing = 1;
			$_SESSION['product_id'] = arg(3);
			drupal_add_js(drupal_get_path('theme', 'gloobers2') .'/js/jquery.alerts.js', 'file');
			drupal_add_css(drupal_get_path('theme', 'gloobers2') .'/css/jquery.alerts.css', 'file');
			$photos = getPhotosData(arg(3));
			$productForm = drupal_get_form('rentals_photos_form');
		break;
		case "amenities":
			$productForm = drupal_get_form('rentals_amenities_form');
		break;
		case "location":
			$addressListing = 1;
			$addressform=drupal_get_form('rentals_location_info_form');	
			$productId=(Integer)arg(3);			
			if (is_int ($productId) )
			{
				$productDetail=getListingData($productId);	
			}
		break;
		case "extra":
			$extrasListing = 1;
			$extras = getProductExtraData(arg(3));
			$productForm = drupal_get_form('rentals_extra_form');
		break;
		case "pricing":
			drupal_add_js(drupal_get_path('theme', 'gloobers2') .'/js/vendor/plugins/datepicker/bootstrap-datepicker.js', 'file');
			$productForm = drupal_get_form('rentals_pricing_form');
		break;
		case "subscription":
			$subscriptionListing = 1;
			$productForm = drupal_get_form('rentals_subscription_form');
		break;
		case "rules":
			$productForm = drupal_get_form('rentals_rules_form');
		break;
		case "scheduling":
			$productForm = drupal_get_form('rentals_scheduling_form');
		break;
		
		default:
			$productForm = drupal_get_form('product_details_form');
		break; 
	}
	$_SESSION['product_id'] = arg(3);
/* 	drupal_add_js(drupal_get_path('theme', 'gloobers2') .'/js/custom.js', 'file'); */
	return theme( 'add_product', array( 'productForm' => $productForm,'photos'=>$photos,'extras'=>$extras,'extrasListing'=>$extrasListing,'productDetail'=>$productDetail,'addressform'=>$addressform,'addressListing'=>$addressListing,'photosListing'=>$photosListing,'subscriptionListing'=>$subscriptionListing));
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
 
 
function product_service_type_form($form, &$form_state) {

    
  $values = isset($form_state['multistep_values']['product_service_type']) ? $form_state['multistep_values']['product_service_type'] : array();

  $form['product_service_type'] = array(
    '#prefix' => '<div><h2>Select your Listing type </h2>',
    '#suffix' => '</div>',
  );
  
  $form['product_service_type']['service_type'] = array(
    '#type' => 'radios',
    '#options' => array('HOTEL' => 'Hotels', 'VACATION-RENTALS' => 'Vacation Rentals', 'RESTAURANTS' => 'Restaurants', 'EXPERIENCE' => 'Experience'),
    '#default_value' => isset($values['service_type']) ? $values['service_type'] : NULL,
	'#required' => TRUE
  );
 
  $form['page'] = array(
    '#type' => 'hidden',
    '#default_value' => 'product_service_type'
  );
  
  $form['next'] = array(
    '#type' => 'submit',
    '#attributes' => array('class'=>array('btn btn-dark btn-gradient')),
    '#value' => t('Next')
  );
    
  return $form;
}


function product_service_form($form, &$form_state) {

    
  $values = isset($form_state['multistep_values']['product_service']) ? $form_state['multistep_values']['product_service'] : array();

  $form['product_service'] = array(
    '#prefix' => '<div><h2>Select your Listing category </h2>',
    '#suffix' => '</div>',
  );
  
  $form['product_service']['service_id'] = array(
    '#type' => 'radios',
    '#options' => array(1 => 'Activity', 2 => 'Day Tour', 3 => 'Multi Day Tour', 4 => 'Private Tour',5 => 'Rental', 6 => 'Ticket', 7 => 'Lesson', 8 => 'Charter', 9 => 'Event'),
    '#default_value' => isset($values['service_id']) ? $values['service_id'] : NULL,
	'#required' => TRUE
  );
  
  $form['page'] = array(
    '#type' => 'hidden',
    '#default_value' => 'product_service'
  );
  
  $form['next'] = array(
    '#type' => 'submit',
    '#attributes' => array('class'=>array('btn btn-dark btn-gradient')),
    '#value' => t('Next')
  );

  
  return $form;
}

function rentals_overview_form($form, &$form_state) {
    

$eid = arg(3);
$values = getOverviewData($eid);
$bedType=getRentalsBedType();
  $form['rentals_overview'] = array(
    '#prefix' => '<div><h2>Overview</h2>',
    '#suffix' => '</div>',
  );
  
 $form['rentals_overview']['rentalshtml1'] = array(
 '#type' => 'markup',
 '#markup' => '<h3>'.t('Listing Type').'</h3>',
); 

$rentalsListingType=getRentalsListingType();
array_unshift($rentalsListingType,t('--Select Listing Type--'));

  $form['rentals_overview']['listing_type'] = array(
    '#type' => 'select',
    '#title' => t('Listing Type'),
    '#default_value' => isset($values['listing_type']) ? $values['listing_type'] : 0,
	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
	'#options'=>$rentalsListingType,
	'#required' => TRUE
  );
$propertyType=getPropertyType();
array_unshift($propertyType,t('--Select Property Type--'));
  $form['rentals_overview']['property_type'] = array(
    '#type' => 'select',
    '#title' => t('Property type'),
    '#default_value' => isset($values['property_type']) ? $values['property_type'] : 0,
	'#options'=>$propertyType,
	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
	'#required' => TRUE
  );
 
 $form['rentals_overview']['restauranthtml2'] = array(
 '#type' => 'markup',
 '#markup' => '<h3>'.t('About your property').'</h3>',
); 

  $form['rentals_overview']['rentals_size_value'] = array(
    '#type' => 'textfield',
    '#title' => t('Size'),
	'#prefix' => '<div class="rentals-size">',
    '#default_value' => isset($values['rentals_size']) ? $values['rentals_size'] : '',
	  '#attributes' => array('placeholder'=>'Sq Ft/Sq Meters',
		'class' => array('form-control'),
	  ),
	'#required' => TRUE
  );
  
  $form['rentals_overview']['rentals_size_type'] = array(
    '#type' => 'select',
    '#default_value' => isset($values['rentals_size_type']) ? $values['rentals_size_type'] : '',
	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
	'#suffix' => '</div>',
	'#options' => array('sq-ft'=>'Sq Ft','sq-mt'=>'Sq Meters'),
  );
  
  $form['rentals_overview']['accomodates_person'] = array(
    '#type' => 'select',
    '#title' => t('Accomodates'),
	'#prefix' => '<div class="accomodates">',
    '#default_value' => isset($values['accomodates_person']) ? $values['accomodates_person'] : '',
	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
	'#options' => array('1'=>'1 people','2'=>'2 people','3'=>'3 people','4'=>'4 people','5'=>'5 people','6'=>'6 people','7'=>'7 people','8'=>'8 people','9'=>'9 people','10'=>'10 people','11'=>'11 people','12'=>'12 people','13'=>'13 people','14'=>'14 people','15'=>'15 people','16'=>'16 people','16+'=>'16+ people'),
  );
  
   $form['rentals_overview']['accomodates_bedroom'] = array(
    '#type' => 'select',
    '#default_value' => isset($values['accomodates_bedroom']) ? $values['accomodates_bedroom'] : '',
	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
	//'#suffix' => '</div>',
	'#options' => array('1'=>'1 Bedrooms','2'=>'2 Bedrooms','3'=>'3 Bedrooms','4'=>'4 Bedrooms','5'=>'5 Bedrooms','6'=>'6 Bedrooms','7'=>'7 Bedrooms','8+'=>'8+ Bedrooms'),
  );
  $form['rentals_overview']['accomodates_bed'] = array(
    '#type' => 'select',
	'#title' => t('Beds'),
    '#default_value' => isset($values['accomodates_bed']) ? $values['accomodates_bed'] : '',
	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
/* 	'#suffix' => '</div>', */
	'#options' => array(''=>'--Select--','1'=>'1 Bed','2'=>'2 Beds','3'=>'3 Beds','4'=>'4 Beds','5'=>'5 Beds','6'=>'6 Beds','7'=>'7 Beds','8'=>'8 Beds','9'=>'9 Beds','10'=>'10 Beds'),
  );

  $form['rentals_overview']['accomodates_bed_type'] = array(
    '#type' => 'select',
	'#title' => t('Type of Bed'),
    '#default_value' => isset($values['accomodates_bed_type']) ? $values['accomodates_bed_type'] : '',
	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
	//'#suffix' => '</div>',
	'#options' => $bedType,
  );

  $form['rentals_overview']['accomodates_bed_extra'] = array(
    '#type' => 'select',
	'#title' => t('Extra Bed'),
    '#default_value' => isset($values['accomodates_bed_extra']) ? $values['accomodates_bed_extra'] : '',
	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
	'#options' => $bedType,
  );

  $form['rentals_overview']['accomodates_bathrooms'] = array(
    '#type' => 'select',
	'#title' => t('Bathrooms'),
    '#default_value' => isset($values['accomodates_bathrooms']) ? $values['accomodates_bathrooms'] : '',
	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
	  '#suffix' => '</div>',
	'#options' => array('0'=>'0','0.5'=>'0.5','1'=>'1','1.5'=>'1.5','2'=>'2','2.5'=>'2.5','3'=>'3','3.5'=>'3.5','4'=>'4','4.5'=>'4.5','5'=>'5','5.5'=>'5.5','6'=>'6','6.5'=>'6.5','7'=>'7','7.5'=>'7.5','8'=>'8'),
  );
  
  
  $form['page'] = array(
    '#type' => 'hidden',
    '#default_value' => 'rentals_details'
  );
  
  $form['eid'] = array(
    '#type' => 'hidden',
    '#default_value' => isset($values['eid']) ? $values['eid'] : 0,
  );
  
   $form['save']=array(
               '#type' => 'submit',
			   '#value' => t('Save'),
			   '#attributes' => array('class'=>array('btn btn-dark btn-gradient')),
                  );
  
    
  return $form;
}

function rentals_details_form($form, &$form_state){

	/* $bedType=getRentalsBedType(); */
	array_unshift($bedType,t('--Select Bed Type--'));

	$form['rentals_details'] = array(
		'#prefix' => '<div><h2>Details</h2>',
		'#suffix' => '</div>',
	);

	$form['rentals_details']['rentalshtml1'] = array(
		'#type' => 'markup',
		'#markup' => '<h3>'.t('The house').'</h3>',
	);

  $form['rentals_details']['house_description'] = array(
    '#type' => 'textarea',
    '#title' => t('Describe your house'),
    '#default_value' => isset($values['house_description']) ? $values['house_description'] : '',
	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
	'#required' => TRUE
  );
  $form['rentals_details']['short_description'] = array(
    '#type' => 'textarea',
    '#title' => t('Short Description'),
   // '#default_value' => isset($values['house_description']) ? $values['house_description'] : '',
	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
	'#required' => TRUE
  );
  $form['rentals_details']['travelers_access'] = array(
    '#type' => 'textarea',
    '#title' => t('What can Travelers access'),
    '#default_value' => isset($values['travelers_access']) ? $values['travelers_access'] : '',
	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
  );
  $form['rentals_details']['travelers_communication'] = array(
    '#type' => 'textarea',
    '#title' => t('Communication with travelers'),
    '#default_value' => isset($values['travelers_communication']) ? $values['travelers_communication'] : '',
	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
  );
 $form['rentals_details']['extra-information'] = array(
    '#type' => 'textarea',
    '#title' => t('Extra Information'),
    '#default_value' => isset($values['transportation']) ? $values['transportation'] : '',
	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
  );
  $form['rentals_details']['house-manual'] = array(
    '#type' => 'textarea',
    '#title' => t('House Manual'),
	'#description'=>t('only for confirmed travelers'),
	'#required'=>TRUE,
    '#default_value' => isset($values['transportation']) ? $values['transportation'] : '',
	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
  );
  
	$form['rentals_details']['rentalshtml2'] = array(
		'#type' => 'markup',
		'#markup' => '<h3>'.t('The neighborhood').'</h3>',
	);

  $form['rentals_details']['whats_around'] = array(
    '#type' => 'textarea',
    '#title' => t("What's around"),
    '#default_value' => isset($values['whats_around']) ? $values['whats_around'] : '',
	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
  );
  $form['rentals_details']['transportation'] = array(
    '#type' => 'textarea',
    '#title' => t('Transportation'),
    '#default_value' => isset($values['transportation']) ? $values['transportation'] : '',
	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
  );
 
 
/*	$form['rentals_details']['rentalshtml3'] = array(
		'#type' => 'markup',
		'#markup' => '<h3>'.t('The Rooms').'</h3>',
	);

  $form['rentals_details']['accomodates_person'] = array(
    '#type' => 'select',
    '#title' => t('Accomodates'),
	'#prefix' => '<div class="details-accomodates">',
    '#default_value' => isset($values['accomodates_person']) ? $values['accomodates_person'] : '',
	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
	'#options' => array(''=>'--Select--','1'=>'1 people','2'=>'2 people','3'=>'3 people','4'=>'4 people','5'=>'5 people','6'=>'6 people','7'=>'7 people','8'=>'8 people','9'=>'9 people','10'=>'10 people','11'=>'11 people','12'=>'12 people','13'=>'13 people','14'=>'14 people','15'=>'15 people','16'=>'16 people','16+'=>'16+ people'),
  );
  
  $form['rentals_details']['accomodates_bedroom'] = array(
    '#type' => 'select',
	'#title' => t('Beds'),
    '#default_value' => isset($values['accomodates_bedroom']) ? $values['accomodates_bedroom'] : '',
	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
/* 	'#suffix' => '</div>', */
/*
	'#options' => array(''=>'--Select--','1'=>'1 Bed','2'=>'2 Beds','3'=>'3 Beds','4'=>'4 Beds','5'=>'5 Beds','6'=>'6 Beds','7'=>'7 Beds','8'=>'8 Beds','9'=>'9 Beds','10'=>'10 Beds'),
  );

  $form['rentals_details']['accomodates_bed_type'] = array(
    '#type' => 'select',
	'#title' => t('Type of Bed'),
    '#default_value' => isset($values['accomodates_bed_type']) ? $values['accomodates_bed_type'] : '',
	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
	'#suffix' => '</div>',
	'#options' => $bedType,
  );

  $form['rentals_details']['accomodates_bed_extra'] = array(
    '#type' => 'select',
	'#title' => t('Extra Bed'),
    '#default_value' => isset($values['accomodates_bed_extra']) ? $values['accomodates_bed_extra'] : '',
	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
	'#options' => $bedType,
  );

  $form['rentals_details']['accomodates_bathrooms'] = array(
    '#type' => 'select',
	'#title' => t('Bathrooms'),
    '#default_value' => isset($values['accomodates_bathrooms']) ? $values['accomodates_bathrooms'] : '',
	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
	'#options' => array('0'=>'0','0.5'=>'0.5','1'=>'1','1.5'=>'1.5','2'=>'2','2.5'=>'2.5','3'=>'3','3.5'=>'3.5','4'=>'4','4.5'=>'4.5','5'=>'5','5.5'=>'5.5','6'=>'6','6.5'=>'6.5','7'=>'7','7.5'=>'7.5','8'=>'8'),
  );
 */ 
  $form['page'] = array(
    '#type' => 'hidden',
    '#default_value' => 'rentals_photos'
  );
  
  $form['eid'] = array(
    '#type' => 'hidden',
    '#default_value' => isset($values['eid']) ? $values['eid'] : 0,
  );
  
   $form['save']=array(
               '#type' => 'submit',
			   '#value' => t('Save'),
			   '#attributes' => array('class'=>array('btn btn-dark btn-gradient')),
                  );
  
    
  return $form;
  
}

function rentals_photos_form($form, &$form_state){

	$values = isset($form_state['multistep_values']['product_photos']) ? $form_state['multistep_values']['product_photos'] : array();
  
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
 
    $form['save']=array(
               '#type' => 'submit',
			   '#attributes' => array('class'=>array('btn btn-dark btn-gradient')),
			   '#value' => t('Save')
    );
	
	 return $form;
}

function rentals_amenities_form($form, &$form_state){
	$amenitiesdatas=getAmentiesByproduct(arg(3));
	$amenitiesId=array();
	  foreach($amenitiesdatas as $amenitiesdata)
	  {
	  $amenitiesId[]=$amenitiesdata['value1'];
	  }
	  $form['product_amenities'] = array(
		'#prefix' => '<div><h2>Essentials</h2>',
		'#suffix' => '</div>',
	  );
	  $essentialsAmenties=getAmentiesdata('Essentials');
	   if(count($essentialsAmenties>0))
	  {
	   $form['basic'] = array(
		'#prefix'=> '<div class="amenities-common"><ul>'   
	  );
	  foreach($essentialsAmenties as $amenties)
	  {
	  
	  $idlower=trim(strtolower($amenties['amenties_name']));
	  $id=str_replace(" ","-",$idlower);  
		  if($amenties['description'] != ""){
				$form['basic'][$id] = array(
				'#prefix' => '<li><label for="'.$id.'">',
				'#suffix' => '</li></label>',
				'#type'=>'checkbox',
				'#title'=>$amenties['amenties_name']."  <strong id='hint' rel='".$amenties['description']."'>?</strong>",
				'#value'=>(in_array($amenties['aid'],$amenitiesId))?1:0,
				// '#value' =>$amenties['aid'],		
			   '#name' => $amenties['aid'],
				'#attributes' => array('class' => array('icon-question')), 
				
				);
		  }
		  else{
				$form['basic'][$id] = array(
				'#prefix' => '<li><label for="'.$id.'">',
				'#suffix' => '</li></label>',
				'#type'=>'checkbox',
				'#title'=>$amenties['amenties_name'],
				'#value'=>(in_array($amenties['aid'],$amenitiesId))?1:0,
				// '#value' =>$amenties['aid'],		
			   '#name' => $amenties['aid'],
				'#attributes' => array('class' => array('icon-question')), 
				
				);		  
		  }
	  }
	  $form['basic-close']=array(
		'#suffix'=> '</ul></div>',
	  );
	  }
	  
	  $form['product_amenities_bathrooms'] = array(
		'#prefix' => '<div><h2>Bathroom & Kitchen</h2>',
		'#suffix' => '</div>',
	  );
	  $BathroomAmenties=getAmentiesdata('Bathroom & Kitchen');
	   if(count($BathroomAmenties>0))
	  {
		$form['bathrooms'] = array(
			'#prefix'=> '<div class="amenities-common"><ul>'   
		);
		foreach($BathroomAmenties as $amenties)
		{

			$idlower=trim(strtolower($amenties['amenties_name']));
			$id=str_replace(" ","-",$idlower);  
			if($amenties['description'] != ""){
				$form['bathrooms'][$id] = array(
					'#prefix' => '<li><label for="'.$id.'">',
					'#suffix' => '</li></label>',
					'#type'=>'checkbox',
					'#title'=>$amenties['amenties_name']."  <strong id='hint' rel='".$amenties['description']."'>?</strong>",
					'#value'=>(in_array($amenties['aid'],$amenitiesId))?1:0,
					// '#value' =>$amenties['aid'],		
					'#name' => $amenties['aid'],
					'#attributes' => array('class' => array('icon-question')), 

				);
			}
			else{
				$form['bathrooms'][$id] = array(
				'#prefix' => '<li><label for="'.$id.'">',
				'#suffix' => '</li></label>',
				'#type'=>'checkbox',
				'#title'=>$amenties['amenties_name'],
				'#value'=>(in_array($amenties['aid'],$amenitiesId))?1:0,
				// '#value' =>$amenties['aid'],		
				'#name' => $amenties['aid'],
				'#attributes' => array('class' => array('icon-question')), 

				);		  
			}
		}
		$form['bathrooms-close']=array(
			'#suffix'=> '</ul></div>',
		);
	  }
	  
	  $form['product_amenities_special'] = array(
		'#prefix' => '<div><h2>Special Features</h2>',
		'#suffix' => '</div>',
	  );
	  $specialAmenties=getAmentiesdata('Special Features');
	   if(count($specialAmenties>0))
	  {
	   $form['special'] = array(
		'#prefix'=> '<div class="amenities-common"><ul>'   
	  );
	  foreach($specialAmenties as $amenties)
	  {
	  
	  $idlower=trim(strtolower($amenties['amenties_name']));
	  $id=str_replace(" ","-",$idlower);  
		  if($amenties['description'] != ""){
				$form['special'][$id] = array(
				'#prefix' => '<li><label for="'.$id.'">',
				'#suffix' => '</li></label>',
				'#type'=>'checkbox',
				'#title'=>$amenties['amenties_name']."  <strong id='hint' rel='".$amenties['description']."'>?</strong>",
				'#value'=>(in_array($amenties['aid'],$amenitiesId))?1:0,
				// '#value' =>$amenties['aid'],		
			   '#name' => $amenties['aid'],
				'#attributes' => array('class' => array('icon-question')), 
				
				);
		  }
		  else{
				$form['special'][$id] = array(
				'#prefix' => '<li><label for="'.$id.'">',
				'#suffix' => '</li></label>',
				'#type'=>'checkbox',
				'#title'=>$amenties['amenties_name'],
				'#value'=>(in_array($amenties['aid'],$amenitiesId))?1:0,
				// '#value' =>$amenties['aid'],		
			   '#name' => $amenties['aid'],
				'#attributes' => array('class' => array('icon-question')), 
				
				);		  
		  }
	  }
	  $form['special-close']=array(
		'#suffix'=> '</ul></div>',
	  );
	  }
	  
	  $form['product_amenities_electronics'] = array(
		'#prefix' => '<div><h2>Electronics</h2>',
		'#suffix' => '</div>',
	  );
	  $ElectronicsAmenties=getAmentiesdata('Electronics');
	   if(count($ElectronicsAmenties>0))
	  {
	   $form['electronics'] = array(
		'#prefix'=> '<div class="amenities-common"><ul>'   
	  );
	  foreach($ElectronicsAmenties as $amenties)
	  {
	  
	  $idlower=trim(strtolower($amenties['amenties_name']));
	  $id=str_replace(" ","-",$idlower);  
		  if($amenties['description'] != ""){
				$form['electronics'][$id] = array(
				'#prefix' => '<li><label for="'.$id.'">',
				'#suffix' => '</li></label>',
				'#type'=>'checkbox',
				'#title'=>$amenties['amenties_name']."  <strong id='hint' rel='".$amenties['description']."'>?</strong>",
				'#value'=>(in_array($amenties['aid'],$amenitiesId))?1:0,
				// '#value' =>$amenties['aid'],		
				'#name' => $amenties['aid'],
				'#attributes' => array('class' => array('icon-question')), 
				
				);
		  }
		  else{
				$form['electronics'][$id] = array(
				'#prefix' => '<li><label for="'.$id.'">',
				'#suffix' => '</li></label>',
				'#type'=>'checkbox',
				'#title'=>$amenties['amenties_name'],
				'#value'=>(in_array($amenties['aid'],$amenitiesId))?1:0,
				// '#value' =>$amenties['aid'],		
			   '#name' => $amenties['aid'],
				'#attributes' => array('class' => array('icon-question')), 
				
				);		  
		  }
	  }
	  $form['electronics-close']=array(
		'#suffix'=> '</ul></div>',
	  );
	  }
	  
	  /************************************************/
	   $form['product_amenities_safety'] = array(
		'#prefix' => '<div><h2>Safety</h2>',
		'#suffix' => '</div>',
	  );
	   $safetyAmenties=getAmentiesdata('safety');
	   if(count($safetyAmenties>0))
	  {
	  $form['basic-safety'] = array(
		'#prefix'=> '<div class="amenties-safety"><ul>',  
	  );
	  foreach($safetyAmenties as $amenties)
	  {
	  $idlower=trim(strtolower($amenties['amenties_name']));
	  $id=str_replace(" ","-",$idlower); 
		if($amenties['description'] != ""){
		   $form['basic-safety'][$id] = array(
			'#prefix' => '<li><label for="'.$id.'">',
			'#suffix' => '</li></label>',
			'#type'=>'checkbox',
			'#title'=>$amenties['amenties_name']."  <strong id='hint' rel='".$amenties['description']."'>?</strong>",
			'#value'=>(in_array($amenties['aid'],$amenitiesId))?1:0,
			'#name' =>$amenties['aid'],
			'#attributes' => array('class' => array('icon-question')),
			
			); 
		}
		else{
		   $form['basic-safety'][$id] = array(
			'#prefix' => '<li><label for="'.$id.'">',
			'#suffix' => '</li></label>',
			'#type'=>'checkbox',
			'#title'=>$amenties['amenties_name'],
			'#value'=>(in_array($amenties['aid'],$amenitiesId))?1:0,
			'#name' =>$amenties['aid'],
			'#attributes' => array('class' => array('icon-question')),
			
			); 		
		}
	  }	
		 $form['safety-close']=array(
		'#suffix'=> '</ul></div>',
	  );

		}
	if(count($amenitiesdata)>0)
	{
	 $form['save'] = array(
		'#type' => 'submit',
		'#attributes' => array('class'=>array('btn btn-dark btn-gradient')),
		'#value' => t('Update'),
		  );

	}
	else
	{
	   $form['save'] = array(
		'#type' => 'submit',
		'#attributes' => array('class'=>array('btn btn-dark btn-gradient')),
		'#value' => t('Save'),
		  );
	}

	  
	  /* $form['back'] = array(
		'#type' => 'submit',
		'#attributes' => array('class'=>array('btn btn-dark btn-gradient')),
		'#value' => t('Back')
	  );
	  
	  $form['next'] = array(
		'#type' => 'submit',
		'#attributes' => array('class'=>array('btn btn-dark btn-gradient')),
		'#value' => t('Next')
	  ); */
		
	  return $form;
}

function rentals_amenities_form_submit($form, &$form_state)
{
if($form_state["values"]["op"]=="Update")
{
$query=db_delete('gbl_listing_meta')
          ->condition('listing_id',arg(3),'=')		 
          ->condition('key1','amenities','=')		 
		  ->execute();
	foreach($_REQUEST as $key=>$value)
	{
			if (is_numeric($key))
			{
			$query=db_insert('gbl_listing_meta')
				  ->fields(array('listing_id'=>arg(3),'key1'=>'amenities','value1'=>$key))
				  ->execute();
			}
	}		  
		  
}
	else
	{
		foreach($_REQUEST as $key=>$value)
			{
				if (is_numeric($key))
				{
				$query=db_insert('gbl_listing_meta')
					  ->fields(array('listing_id'=>arg(3),'key1'=>'amenities','value1'=>$key))
					  ->execute();
				}
			}
		}

	}
/*********************************************************************************/
function rentals_location_info_form($form,&$form_state)
	{
	$countryList=getCountryList();
	$productId=(Integer)arg(3);
     if (is_int($productId))
	 {
	$productDetail=getListingData($productId);
	}
	$form=array();
	$form['product_address'] = array(
    '#prefix' => '<div><h2>'.t('Enter Address').'</h2>',
    '#suffix' => '</div>',
  );
	
  $form['address1'] = array(
	'#type' => 'textfield',
	'#attributes' => array(
		'class' => array('form-control'),'placeholder' => t('ex. Rua Bossoroca, 1')
	),
    '#title' => t('Address Line 1'),
	'#required' => TRUE,
	'#default_value' => ($productDetail['address1'])?$productDetail['address1'] :"",
  );
  $form['address2'] = array(

    '#type' => 'textfield',
	'#attributes' => array(
		'class' => array('form-control'),'placeholder' => t('"ex. apt 50')	),
    '#title' => t('Address Line 2'), 
    '#default_value' => ($productDetail['address2'])?$productDetail['address2'] :"",	
  );
  $form['city'] = array(
	
    '#type' => 'textfield',
	'#attributes' => array(
		'class' => array('form-control'),
	),
	//'#attributes' =>array('placeholder' => t(''))
    '#title' => t('City'),
    '#required' => TRUE ,
    '#default_value' => ($productDetail['city'])?$productDetail['city'] :"",		
  );
	 $form['state'] = array(
	'#type' => 'textfield',
	'#attributes' => array(	'class' => array('form-control'),),
    '#title' => t('State / Province / Region'),
    '#required' => TRUE ,
     '#default_value' => ($productDetail['state'])?$productDetail['state'] :"",	
  );
  $form['zipcode'] = array(
	'#type' => 'textfield',
	'#attributes' => array(
		'class' => array('form-control'),'placeholder' => t('ex. 437719')
	),	
    '#title' => t('ZIP / Postal Code'),  
    '#maxlength' =>10,
	'#default_value' => ($productDetail['zipcode'])?$productDetail['zipcode'] :"",	
    //'#required' => TRUE	,
	// '#element_validate' => array('element_validate_integer_positive'),
  );
    $form['country'] = array(
	//'#prefix' => '<div class="product-extra" style="display:none;">',
    '#type' => 'select',
	'#attributes' => array(
		'class' => array('form-control'),
	),	
    '#title' => t('Country'),   
    '#required' => TRUE	,
	'#options'=>$countryList,
	'#default_value' => ($productDetail['country'])?$productDetail['country'] :"",
  );
  $form['next'] = array(
    '#type' => 'submit',
	'#attributes' => array('class'=>array('btn btn-dark btn-gradient')),
    '#value' => t('Next')
	
  );
  $form['cancel'] = array(
    '#type' => 'button',
	'#attributes' => array('class'=>array('btn btn-dark btn-gradient')),
    '#value' => t('Cancel')
	
  ); 
  return $form;
	}
/*********************************************************************************/
function rentals_extra_form($form, &$form_state){
	$metaID = arg(4);
	$extraDetails1 = getExtraDetails($metaID);
	$extraDetails = unserialize($extraDetails1["value1"]);
	
/* 	echo "<pre>";
	print_r($extraDetails); die; */
	
  $form['product_extra']['new_extra'] = array(
	'#prefix' => '<div class="product-extra">',
    '#type' => 'textfield',
    '#required' => TRUE,
	'#attributes' => array(
		'class' => array('form-control'),
	),
    '#title' => t('New extra'),
    '#default_value' => isset($extraDetails['title']) ? $extraDetails['title'] : NULL,
  );
  
  $form['product_extra']['extra_price_value'] = array(
    '#type' => 'textfield',
    '#prefix' => '<div class="product_extra_price">',
	'#attributes' => array(
		'class' => array('form-control','themePrice'),
	),
    '#title' => t('Price'),
	'#required' => TRUE,
    '#default_value' => isset($extraDetails['price']) ? $extraDetails['price'] : NULL,
  );
  
  $form['product_extra']['extra_price_type'] = array(
    '#type' => 'select',
	'#attributes' => array(
		'class' => array('form-control'),
	),
    '#default_value' => isset($extraDetails['price-type']) ? $extraDetails['price-type'] : NULL,
	'#options' => array('%'=>'Amount in %','$'=>'Amount in $'),
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
    '#default_value' => isset($extraDetails['description']) ? $extraDetails['description'] : NULL,
  ); 
  
   $form['metaID'] = array(
    '#type' => 'hidden',
    '#default_value' => isset($extraDetails1['meta_id']) ? $extraDetails1['meta_id'] : NULL,
  ); 

  $form['page'] = array(
    '#type' => 'hidden',
    '#default_value' => 'product_subscription'
  );

  
  $form['next'] = array(
    '#type' => 'submit',
	'#attributes' => array('class'=>array('btn btn-dark btn-gradient')),
    '#value' => t('Save')
	
  );
    
  return $form;
}

function rentals_pricing_form($form, &$form_state){
  $eid = arg(3);
  $pricingData = getPricingData($eid);
  
  $values = unserialize($pricingData["value1"]);
  
/*   echo "<pre>";
  print_r($values); 
  die;   */

  $form['product_pricing'] = array(
    '#prefix' => '<div><h2>Pricing</h2>',
    '#suffix' => '</div>',
  );
 
 $form['product_pricing']['season_rate_label'] = array(
    '#type' => 'textfield',
	'#prefix' => '<div class="quantity product_season_rate" id="product_season_rate">',
	'#title' => t('Rate Label'), 
    '#default_value' => isset($pricingData['season_rate_label']) ? $pricingData['season_rate_label'] : NULL,
	'#attributes' => array('placeholder'=>'Rate Label','class' => array('form-control')),
  );
  
 $form['product_pricing']['season_rate_amount'] = array(
    '#type' => 'textfield',
	'#title' => t('Rate Price'), 
    '#default_value' => isset($pricingData['season_rate_amount']) ? $pricingData['season_rate_amount'] : NULL,
	'#attributes' => array('placeholder'=>'Rate Price','class' => array('form-control','themePrice')),
  );

  $form['product_pricing']['high_season_rate_dates'] = array(
    '#type' => 'textfield',
    '#title' => t('From - To'), 
	  '#attributes' => array('placeholder'=>'From - To',
		'class' => array('form-control','daterangepicker2'),
	  ),
/*  	'#suffix' => '</div>', */
    '#default_value' => isset($pricingData['high_season_rate_dates']) ? $pricingData['high_season_rate_dates'] : NULL,
  );

	$form['product_pricing']['add_new'] = array(
		'#prefix' => '<div><a class="btn btn-dark btn-gradient form-submit" href="#" id="addRate">Add Rate</a>',
		'#suffix' => '</div></div>',
	);
  if(count($values["season_rate_label_extra"])>0)
{
/*  echo "<pre>";
print_r($values["season_rate_amount_extra"]);
die; */
 foreach ($values["season_rate_label_extra"] as $key => $value)
{

 $form['product_pricing']['season_rate_label_extra'.$key] = array(
    '#type' => 'textfield',
	'#prefix' => '<div class="product_season_rate" id="product_season_rate_'.$key.'">',
	'#title' => t('Rate Label'), 
    '#default_value' => ($value)?$value:'',
	'#attributes' => array('placeholder'=>'Rate Label','class' => array('form-control'),'name'=>'season_rate_label_extra['.$key.']'),
);
$form['product_pricing']['season_rate_amount_extra'.$key] = array(
    '#type' => 'textfield',
	'#title' => t('Rate Price'), 
	'#prefix' => '<div class="form-item-season-rate-amount">',
    '#default_value' => ($values["season_rate_amount_extra"][$key])?$values["season_rate_amount_extra"][$key]:'',
	'#attributes' => array('placeholder'=>'Rate Price','class' => array('form-control','themePrice'),'name'=>'season_rate_amount_extra['.$key.']'),
	'#suffix' => '</div>'
/* 	'#description' => 'Add rate i.e High Season rate' */
  );

  $form['product_pricing']['high_season_rate_dates_extra'.$key] = array(
    '#type' => 'textfield',
 	'#prefix' => '<div class="form-item-high-season-rate-dates">',
    '#title' => t('From - To'), 
	  '#attributes' => array('placeholder'=>'From - To','class' => array('form-control','daterangepicker2'),'name'=>'high_season_rate_dates_extra['.$key.']' ),
 	'#suffix' => '</div>', 
    '#default_value' => ($values["high_season_rate_dates_extra"][$key])?$values["high_season_rate_dates_extra"][$key]:'',
  );

}
}

 $form['product_pricing']['cleaning_fees'] = array(
    '#type' => 'textfield',
	'#prefix' => '<div class="quantity cleaning_fees">',
	'#title' => t('Cleaning fees'), 
    '#default_value' => isset($pricingData['cleaning_fees']) ? $pricingData['cleaning_fees'] : NULL,
	'#attributes' => array('placeholder'=>'Price','class' => array('form-control')),
  );

 $form['product_pricing']['cleaning_fees_price_form'] = array(
    '#type' => 'select',
    '#default_value' => isset($pricingData['cleaning_fees_price_form']) ? $pricingData['cleaning_fees_price_form'] : NULL,
	'#attributes' => array('class' => array('form-control')),
	'#options' => array('$'=>'Amount in $','%'=>'Amount in %'),
  ); 
  
 $form['product_pricing']['cleaning_fees_price_type'] = array(
    '#type' => 'select',
    '#default_value' => isset($pricingData['cleaning_fees_price_type']) ? $pricingData['cleaning_fees_price_type'] : NULL,
	'#attributes' => array('class' => array('form-control')),
	'#options' => array('per-day'=>'Per day','per-stay'=>'Per stay'),
	'#suffix' => '</div>',
  ); 
 

/*   $form['product_pricing']['miscellaneous_fees_price_rule'] = array(
    '#type' => 'select',
	'#prefix' => '<div class="quantity cleaning_fees">',
	'#title' => t('Miscellaneous Fees'), 
	'#description' => t('(Gaz, water, electricity)'),
    '#default_value' => isset($pricingData['miscellaneous_fees_price_rule']) ? $pricingData['miscellaneous_fees_price_rule'] : NULL,
	'#attributes' => array('class' => array('form-control')),
	'#options' => array('Included'=>'Included','Not-included'=>'Not included'),
  );  */

  $form['product_pricing']['miscellaneous_fees_html'] = array( 
     '#markup' => '<div class="miscellaneous"><h4>'.t('Miscellaneous Fees').'</h4><span>('.t('Gaz, water, electricity').')</span></div>',
	//'#title'=> t('(in %) refunded on the entire stay'),
    /* '#suffix' => '</div>', */
  );  
  
  $form['product_pricing']['miscellaneous_fees_included'] = array(
    '#type' => 'checkbox',
	'#prefix' => '<div class="cleaning_fees cleaning_fees">',
	'#title' => t('Included'), 
    '#default_value' => isset($pricingData['miscellaneous_fees_included']) ? $pricingData['miscellaneous_fees_included'] : NULL,
  );
  
 $form['product_pricing']['miscellaneous_fees'] = array(
    '#type' => 'textfield',
	'#prefix' => '<div class="miscellaneous_fees">',
    '#default_value' => isset($pricingData['cleaning_miscellaneous_fees']) ? $pricingData['cleaning_miscellaneous_fees'] : NULL,
	'#attributes' => array('placeholder'=>'Price','class' => array('form-control')),
  );
  
 $form['product_pricing']['miscellaneous_fees_price_form'] = array(
    '#type' => 'select',
    '#default_value' => isset($pricingData['miscellaneous_fees_price_form']) ? $pricingData['miscellaneous_fees_price_form'] : NULL,
	'#attributes' => array('class' => array('form-control')),
	'#options' => array('$'=>'Amount in $','%'=>'Amount in %'),
  ); 
  
 $form['product_pricing']['miscellaneous_fees_price_type'] = array(
    '#type' => 'select',
    '#default_value' => isset($pricingData['miscellaneous_fees_price_type']) ? $pricingData['miscellaneous_fees_price_type'] : NULL,
	'#attributes' => array('class' => array('form-control')),
	'#options' => array('per-day'=>'Per day','per-stay'=>'Per stay'),
	'#suffix' => '</div></div>',
  ); 
   
/*   $form['product_pricing']['quantity-heading'] = array(
    '#prefix' => '<div><h2>Quantity</h2>',
    '#suffix' => '</div>',
  );
 
  $form['product_pricing']['product_pricing_quantity_type'] = array(
    '#type' => 'select',
	'#prefix' => '<div class="quantity product_pricing_quantity">',
    '#default_value' => isset($values['product_pricing_quantity_type']) ? $values['product_pricing_quantity_type'] : NULL,
	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
	'#options' => array('Limited'=>'Limited - Fixed Limit per person','Unlimited'=>'Unlimited Free Sale')
  );
  
  $form['product_pricing']['quantity_min'] = array(
    '#type' => 'textfield',
	'#title' => 'Min.',
	  '#attributes' => array('placeholder'=>'Min.',
		'class' => array('form-control'),
	  ),
    '#default_value' => isset($values['quantity_min']) ? $values['quantity_min'] : NULL,
  );
  
  $form['product_pricing']['quantity_max'] = array(
    '#type' => 'textfield',
    '#title' => 'Max.',
    '#default_value' => isset($values['quantity_max']) ? $values['quantity_max'] : NULL,
	  '#attributes' => array('placeholder'=>'Max.',
		'class' => array('form-control'),
	  ),
  );
  
  $form['product_pricing']['quantity_label'] = array(
    '#type' => 'textfield',
	'#title' => 'Label',
	'#suffix' => '</div>',
    '#default_value' => isset($values['quantity_label']) ? $values['quantity_label'] : NULL,
	  '#attributes' => array('placeholder'=>'Label',
		'class' => array('form-control'),
	  ),
  );
 */  

  $form['product_pricing']['offers_and_discounts'] = array(
    '#prefix' => '<div><h2>Offers a Discounts</h2>',
     '#suffix' => '</div>', 
  );
  
  $form['product_pricing']['early_birds'] = array(
    '#prefix' => '<div><h5>Early Birds</h5>',
/*     '#suffix' => '</div>', */
  );
 
  $form['product_pricing']['early_birds_time_value'] = array(
    '#type' => 'textfield',
	'#prefix' => '<div class="early-birds">',
    '#title' => t('If booking'),
	  '#attributes' => array('placeholder'=>'Days or Months',
		'class' => array('form-control'),
	  ),
    '#default_value' => isset($values['early_birds_time_value']) ? $values['early_birds_time_value'] : NULL,
  );
 
  $form['product_pricing']['early_birds_time_type'] = array(
    '#type' => 'select',
	'#attributes' => array(
		'class' => array('form-control'),
	),
    '#default_value' => isset($values['early_birds_time_type']) ? $values['early_birds_time_type'] : NULL,
	'#options' => array('day'=>'Day','month'=>'Month'),
  );

  $form['product_pricing']['early_birds_price_value'] = array(
    '#type' => 'textfield',
	'#attributes' => array('placeholder'=>'Price',
		'class' => array('form-control','themePrice'),
	),
    '#title' => t('prior to Arrival date'),
	'#required' => TRUE,
    '#default_value' => isset($values['early_birds_price_value']) ? $values['early_birds_price_value'] : NULL,
  );
  
  $form['product_pricing']['early_birds_price_type'] = array(
    '#type' => 'select',
	'#attributes' => array(
		'class' => array('form-control'),
	),
    '#default_value' => isset($values['early_birds_price_type']) ? $values['early_birds_price_type'] : NULL,
	'#options' => array('%'=>'Amount in %','$'=>'Amount in $'),
	'#suffix' => '<h4>'.t('on total Amount').'</h4>',
  );

  	$form['product_pricing']['schedule_type_early_bids'] = array(
		'#type' => 'select',
		'#title' => 'Apply to schedule',
		'#default_value' => isset($values['schedule_type_early_bids']) ? $values['schedule_type_early_bids'] : NULL,
		  '#attributes' => array(
			'class' => array('form-control'),
		  ),
		'#suffix' => '</div>',
		'#options' => array('1'=>'schedule 1','2'=>'schedule 2')
	); 
	
/*   $form['product_pricing']['early_birds']['total_amount'] = array( 
     '#markup' => '',
	//'#title'=> t('(in %) refunded on the entire stay'),
    '#suffix' => '</div>',
  ); */

  $form['product_pricing']['last_minutes'] = array(
    '#prefix' => '</div><div><h5>Last Minute</h5>',
    '#suffix' => '</div>',
  );
 
  $form['product_pricing']['last_minutes_time_value'] = array(
    '#type' => 'textfield',
	'#prefix' => '<div class="early-birds">',
    '#title' => t('If booking'),
	  '#attributes' => array('placeholder'=>'Days or Months',
		'class' => array('form-control'),
	  ),
    '#default_value' => isset($values['last_minutes_time_value']) ? $values['last_minutes_time_value'] : NULL,
  );
 
  $form['product_pricing']['last_minutes_time_type'] = array(
    '#type' => 'select',
	'#attributes' => array(
		'class' => array('form-control'),
	),
    '#default_value' => isset($values['last_minutes_time_type']) ? $values['last_minutes_time_type'] : NULL,
	'#options' => array('day'=>'Day','month'=>'Month'),
  );

  $form['product_pricing']['last_minutes_price_value'] = array(
    '#type' => 'textfield',
	'#attributes' => array('placeholder'=>'Price',
		'class' => array('form-control','themePrice'),
	), 
    '#title' => t('prior to Arrival date'),

	'#required' => TRUE,
    '#default_value' => isset($values['last_minutes_price_value']) ? $values['last_minutes_price_value'] : NULL,
  );
  
  $form['product_pricing']['last_minutes_price_type'] = array(
    '#type' => 'select',
	'#attributes' => array(
		'class' => array('form-control'),
	),
    '#default_value' => isset($values['last_minutes_price_type']) ? $values['last_minutes_price_type'] : NULL,
	'#options' => array('%'=>'Amount in %','$'=>'Amount in $'),
	'#suffix' => '<h4>'.t('on total Amount').'</h4>',
  );

/*   $form['product_pricing']['last_minutes']['total_amount'] = array( 
     '#markup' => '</div><h4>'.t('on total Amount').'</h4>',
	//'#title'=> t('(in %) refunded on the entire stay'),
    '#suffix' => '</div>',
  );   */
 
  	$form['product_pricing']['schedule_type_last_minutes'] = array(
		'#type' => 'select',
		'#title' => 'Apply to schedule',
		'#default_value' => isset($values['schedule_type_last_minutes']) ? $values['schedule_type_last_minutes'] : NULL,
		  '#attributes' => array(
			'class' => array('form-control'),
		  ),
		'#suffix' => '</div>',
		'#options' => array('1'=>'schedule 1','2'=>'schedule 2')
	); 
  
  $form['product_pricing']['24_hour_offer'] = array(
    '#prefix' => '</div><div><h5>24 Hour Offer</h5>',
    '#suffix' => '</div>',
  );
 
  $form['product_pricing']['24_hour_offer']['24_hour_offer_date'] = array(
    '#type' => 'textfield',
	'#prefix' => '<div class="early-birds-hour-offer">',
    '#title' => t('If booking made on'),
	  '#attributes' => array('placeholder'=>'Date',
		'class' => array('form-control','datepicker'),
	  ),
    '#default_value' => isset($values['24_hour_offer_date']) ? $values['24_hour_offer_date'] : NULL,
  );

  $form['product_pricing']['24_hour_offer']['24_hour_offer_price_value'] = array(
    '#type' => 'textfield',
	'#attributes' => array('placeholder'=>'Price',
		'class' => array('form-control','themePrice'),
	),
/*     '#title' => t('prior to Arrival date'), */
	'#required' => TRUE,
    '#default_value' => isset($values['24_hour_offer_price_value']) ? $values['24_hour_offer_price_value'] : NULL,
  );
  
   $form['product_pricing']['24_hour_offer']['24_hour_offer_price_type'] = array(
    '#type' => 'select',
	'#attributes' => array(
		'class' => array('form-control'),
	),
    '#default_value' => isset($extraDetails['24_hour_offer_price_type']) ? $extraDetails['24_hour_offer_price_type'] : NULL,
	'#options' => array('%'=>'Amount in %','$'=>'Amount in $'),
  ); 

  $form['product_pricing']['24_hour_offer']['total_amount'] = array( 
     '#markup' => '<h4>'.t('in % on total Amount').'</h4>',
	//'#title'=> t('(in %) refunded on the entire stay'),
    /* '#suffix' => '</div>', */
  );  
  	$form['product_pricing']['schedule_type_24_hours'] = array(
		'#type' => 'select',
		'#title' => 'Apply to schedule',
		'#default_value' => isset($values['schedule_type_24_hours']) ? $values['schedule_type_24_hours'] : NULL,
		  '#attributes' => array(
			'class' => array('form-control'),
		  ),
		'#suffix' => '</div>',
		'#options' => array('1'=>'schedule 1','2'=>'schedule 2')
	);
  $form['metaID'] = array(
	'#type' => 'hidden',
	'#default_value' => isset($pricingData["meta_id"])?$pricingData["meta_id"]:'',
	//'#default_value' => isset($pricingData['meta_id']) ? $pricingData['meta_id'] :arg(3),
  );
  
  $form['page'] = array(
	'#type' => 'hidden',
	'#default_value' => 'product_rules'
  );
	
/*   $form['back'] = array(
    '#type' => 'submit',
	'#attributes' => array('class'=>array('btn btn-dark btn-gradient')),
    '#value' => t('Back')
  ); */
  
  $form['save'] = array(
    '#type' => 'submit',
	'#attributes' => array('class'=>array('btn btn-dark btn-gradient')),
    '#value' => t('Save')
  );
    
  return $form;

}

function rentals_rules_form($form, &$form_state){
	$metaID = arg(3);
	$rules = getRulesDetails($metaID);
	$values = unserialize($rules["value1"]);

	$form['product_rules'] = array(
		'#prefix' => '<div><h2>Rules & Policies</h2>',
		'#suffix' => '</div>',
	);

	$form['product_rules']['ruleshtml'] = array(
		'#type' => 'markup',
		'#markup' => '<h3>'.t('Rules').'</h3>',
	);
	$form['product_rules']['house_rules'] = array(
		'#type' => 'textarea',
		'#title' => t('House Rules'),
		'#default_value' => isset($values['house_rules']) ? $values['house_rules'] :  '',
		'#attributes' => array(
		'class' => array('form-control'),
		),
	);
/*   $form['product_rules']['house_manual'] = array(
    '#type' => 'textarea',
    '#title' => t('House Manual'),
	'#default_value' => isset($values['house_manual']) ? $values['house_manual'] : '',
 	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
  ); */


/************************************************************************/
  $form['product_rules']['CancellationPolicies'] = array(
 '#type' => 'markup',
 '#markup' => '<h3>'.t('Cancellation Policies').'</h3>',
);

$form['product_rules']['cancellation_policies_type'] = array(
'#type' => 'select',
'#title' => t('Cancellation Policies'),
'#default_value' => isset($values['cancellation_policies_type']) ? $values['cancellation_policies_type'] : 0,
  '#attributes' => array(
	'class' => array('form-control'),
  ),
'#options'=>array('Relaxed'=>'Relaxed','Flexible'=>'Flexible','Moderate'=>'Moderate','Strict'=>'Strict','Super-Strict'=>'Super Strict','Custom'=>'Custom'),
/* '#required' => TRUE */
);
/* 
$form['product_rules']['cancellation_policies_relaxed'] = array(
	'#prefix' => "<div class='relaxed'><h2>Relaxed</h2><p>
		Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
	</p>",
	'#suffix' => '</div>',
);

$form['product_rules']['cancellation_policies_flexible'] = array(
	'#prefix' => "<div class='flexible'><h2>Flexible</h2><p>
		Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
	</p>",
	'#suffix' => '</div>',
);

$form['product_rules']['cancellation_policies_moderate'] = array(
	'#prefix' => "<div class='moderate'><h2>Moderate</h2><p>
		Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
	</p>",
	'#suffix' => '</div>',
);

$form['product_rules']['cancellation_policies_text_strict'] = array(
	'#prefix' => "<div class='strict'><h2>Strict</h2><p>
		Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
	</p>",
	'#suffix' => '</div>',
);

$form['product_rules']['cancellation_policies_super_strict'] = array(
	'#prefix' => "<div class='super_strict'><h2>Super Strict</h2><p>
		Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
	</p>",
	'#suffix' => '</div>',
);
   */
  
$form['product_rules']['cancellation_policy_entire'] = array(  
	'#prefix' => '<div class="cancelation-policy-entire-stay"><h2>Customized</h2>',	
  );
 $form['product_rules']['cancellation_policy_entire_prior_day'] = array( 
  //'#prefix' => '<div class="numbers-row">',
    '#type' => 'textfield',
 	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
	'#default_value' => isset($values['entire_prior_day']) ? $values['entire_prior_day'] : 1,
 	 '#title' => t('If travelers cancel'),
   //   '#suffix' => '</div>',	 
  ); 
   $form['product_rules']['cancellation_policy_entire_prior_amount'] = array( 
  // '#prefix' => '<div class="numbers-row">',
    '#type' => 'textfield',
 	 '#title' => t('days prior to arrival date Amount '),
 	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
	 '#default_value' => isset($values['entire_prior_amount']) ? $values['entire_prior_amount'] : 1,
   //   '#suffix' => '</div>',	 
  ); 
  $form['product_rules']['cancellation_policy_entire_amount_refund'] = array( 
     '#markup' => '<h4>'.t('(in %) refunded on the entire stay').'</h4>',
	//'#title'=> t('(in %) refunded on the entire stay'),
    '#suffix' => '</div>',
  );
  /**/
  $form['product_rules']['cancellation_policy_pending'] = array(  
	'#prefix' => '<div class="cancelation-policy-pending-stay">',	
  );
 $form['product_rules']['cancellation_policy_pending_day'] = array( 
  //'#prefix' => '<div class="numbers-row">',
    '#type' => 'textfield',
 	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
 	 '#title' => t('If travelers cancel'),
	 '#default_value' => isset($values['policy_pending_day']) ? $values['policy_pending_day'] : 1,
	//   '#suffix' => '</div>',	
  ); 
   $form['product_rules']['cancellation_policy_pending_amount_after_arrival'] = array( 
   //  '#prefix' => '<div class="numbers-row">',
    '#type' => 'textfield',
 	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
 	 '#title' => t('days after arrival date Amount '),
	 '#default_value' => isset($values['policy_pending_amount_after_arrival']) ? $values['policy_pending_amount_after_arrival'] : 1,
	//    '#suffix' => '</div>',	 
  ); 
  $form['product_rules']['cancellation_policy_pending_amount_refund'] = array( 
     '#markup' => '<h4>'.t('(in %) refunded on the pending stay').'</h4>',
	//'#title'=> t('(in %) refunded on the entire stay'),
    '#suffix' => '</div>',
  );
/************************************************************************/

  $form['metaID'] = array(
	'#type' => 'hidden',
	'#default_value' => isset($rules['meta_id']) ? $rules['meta_id'] : NULL,
  );
  
  $form['page'] = array(
	'#type' => 'hidden',
	'#default_value' => 'product_extra'
  );
  
	/*$form['back'] = array(
		'#type' => 'submit',
		'#attributes' => array('class'=>array('btn btn-dark btn-gradient')),
		'#value' => t('Back')
	);*/

	$form['save'] = array(
		'#type' => 'submit',
		'#attributes' => array('class'=>array('btn btn-dark btn-gradient')),
		'#value' => t('Save')
	);

	return $form;
	
}

function rentals_booking_info_form($form, &$form_state){
  $form['back'] = array(
    '#type' => 'submit',
	'#attributes' => array('class'=>array('btn btn-dark btn-gradient')),
    '#value' => t('Back')
  );
  
  $form['next'] = array(
    '#type' => 'submit',
	'#attributes' => array('class'=>array('btn btn-dark btn-gradient')),
    '#value' => t('Next')
  );
    
  return $form;
}

function rentals_catalogs_form($form, &$form_state){
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
	'#attributes' => array('class'=>array('btn btn-dark btn-gradient')),
    '#value' => t('Back')
  );
  
  $form['next'] = array(
    '#type' => 'submit',
	'#attributes' => array('class'=>array('btn btn-dark btn-gradient')),
    '#value' => t('Next')
  );
    
  return $form;
}

function rentals_location_form($form, &$form_state){
	$values = isset($form_state['multistep_values']['product_location']) ? $form_state['multistep_values']['product_location'] : array();

  $form['product_location'] = array(
    '#prefix' => '<div><h2>Location</h2>',
    '#suffix' => '</div>',
  );
  
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
  
	  $form['page'] = array(
		'#type' => 'hidden',
		'#default_value' => 'product_scheduling'
	  );
	$form['back'] = array(
		'#type' => 'submit',
		'#attributes' => array('class'=>array('btn btn-dark btn-gradient')),
		'#value' => t('Back')
	);
  
	$form['next'] = array(
	
		'#type' => 'submit',
		'#attributes' => array('class'=>array('btn btn-dark btn-gradient')),
		'#value' => t('Next')
	);
    
	return $form;
}

function rentals_subscription_form($form, &$form_state){

  $eid = arg(3);
  $values = getProductSubscriptionData($eid);
  
/*   echo "<pre>";
  print_r($values); die; */
  
  $form['product_subscription']['subscription_text'] = array(
    '#prefix' => '<div><h2>Listing Subscription </h2>',
    '#suffix' => '</div>',
  );

/*  $form['product_subscription']['subscription_value'] = array(
    '#type' => 'radios',
  	'#attributes' => array(
		'class' => array('radio'),
	), 
    '#options' => array('FREE' => "Classic - Free", 'SILVER' => 'Silver - <span>$29/Month</span>','GOLD' => "Gold - $59/month"),
    '#default_value' => isset($values['value1']) ? $values['value1'] : NULL,
	'#required' => TRUE
  );*/
 
  $form['product_subscription']['free'] = array(
    '#type' => 'radio',
/*  	'#attributes' => array(
		'class' => array('radio'),
	), */
	'#prefix' =>'<div class="priceblock">',
	'#title' => 'Classic - Free',
	'#suffix' => '<h2>Totally Free</h2></div>',
    '#default_value' => isset($values['free']) ? $values['free'] : NULL,
	'#required' => TRUE
  ); 
  
  $form['product_subscription']['Silver'] = array(
    '#type' => 'radio',
/*  	'#attributes' => array(
		'class' => array('radio'),
	), */
	'#prefix' =>'<div class="priceblock">',
	'#title' => 'Silver',
    '#suffix' => '<h2>$29/Month</h2></div>',
    '#default_value' => isset($values['Silver']) ? $values['Silver'] : NULL,
	'#required' => TRUE
  ); 
  
  $form['product_subscription']['Gold'] = array(
    '#type' => 'radio',
/*  	'#attributes' => array(
		'class' => array('radio'),
	), */
	'#prefix' =>'<div class="priceblock">',
	'#title' => 'Gold',
    '#suffix' => '<h2>$59/Month</h2></div>',
    '#default_value' => isset($values['Gold']) ? $values['Gold'] : NULL,
	'#required' => TRUE
  ); 
  
  
  $form['metaID'] = array(
	'#type' => 'hidden',
	'#default_value' => isset($values['meta_id']) ? $values['meta_id'] : NULL,
  );
 
/*   $form['back'] = array(
    '#type' => 'submit',
	'#attributes' => array('class'=>array('btn btn-dark btn-gradient')),
    '#value' => t('Back')
  ); */
  
  $form['next'] = array(
    '#type' => 'submit',
	'#attributes' => array('class'=>array('btn btn-dark btn-gradient')),
    '#value' => t('Save')
  );
    
  return $form;
}

function rentals_scheduling_form($form, &$form_state){
  $values = isset($form_state['multistep_values']['rentals_scheduling']) ? $form_state['multistep_values']['rentals_scheduling'] : array();
 
  $form['rentals_scheduling'] = array(
    '#prefix' => '<div><h2>Scheduling</h2>',
    '#suffix' => '</div>',
  );
 
	$form['rentals_scheduling']['price-settings'] = array(
		'#type' => 'markup',
		'#markup' => '<h3>'.t('Availability').'</h3>',
/* 		'#prefix' => '<div class="quantity" id="session">', */
	);
	
  $form['rentals_scheduling']['rentals_dates_available'] = array(
    '#type' => 'select',
    '#title' => t('Dates available'),
	'#attributes' => array(
		'class' => array('form-control'),
	),
    '#default_value' => isset($values['dates_available']) ? $values['dates_available'] : NULL,
	'#options' => array('ALWAYS'=>'Always available','MOSTLY'=>'Mostly available','OCCASIONNALY'=>'Occasionnaly available'),
	'#required' => TRUE
  );
  

  $form['product_scheduling']['rentals_date_from'] = array(
    '#type' => 'textfield',
 	'#title' => t('From'),
	'#prefix' => '<div id="rentals-scheduling" class="rentals-scheduling">',
    '#default_value' => isset($values['rentals_date_from']) ? $values['rentals_date_from'] : NULL,
	  '#attributes' => array('placeholder'=>'From',
		'class' => array('form-control','datepicker'),
	  ),
  );
  
  $form['product_scheduling']['rentals_date_to'] = array(
    '#type' => 'textfield',
 	'#title' => t('To'),
    '#default_value' => isset($values['rentals_date_to']) ? $values['rentals_date_to'] : NULL,
	  '#attributes' => array('placeholder'=>'To',
		'class' => array('form-control','datepicker'),
	  ),
  );

/*    $form['product_scheduling']['season_label'] = array(
    '#type' => 'textfield',
	'#title' => t('Label'), 
    '#default_value' => isset($values['season_label']) ? $values['season_label'] : NULL,
	'#attributes' => array('placeholder'=>'Label','class' => array('form-control')),
  ); */
 
	$form['product_scheduling']['add_new_schedule'] = array(
		'#prefix' => '<div><a class="btn btn-dark btn-gradient form-submit" href="#" id="addDate">Add another</a>',
		'#suffix' => '</div></div>',
	);
	
  $form['page'] = array(
	'#type' => 'hidden',
	'#default_value' => 'rentals_pricing'
  );

  
  $form['save'] = array(
    '#type' => 'submit',
	'#attributes' => array('class'=>array('btn btn-dark btn-gradient')),
    '#value' => t('Save')
  );
    
  return $form;
}

?>