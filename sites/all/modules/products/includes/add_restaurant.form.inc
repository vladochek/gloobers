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
function add_restaurant_form(){
	menu_rebuild();
	$photos = array();
	$page = arg(2);
	$extrasListing = $addressListing = $photosListing = $subscriptionListing = 0;
	switch($page){
		case "overview":
			$productForm = drupal_get_form('restaurant_details_form');
		break;
		case "photos":
			$photosListing = 1;
			$_SESSION['product_id'] = arg(3);
			drupal_add_js(drupal_get_path('theme', 'gloobers2') .'/js/jquery.alerts.js', 'file');
			drupal_add_css(drupal_get_path('theme', 'gloobers2') .'/css/jquery.alerts.css', 'file');
			drupal_add_js(drupal_get_path('theme', 'gloobers2') .'/js/jquery.ui.plupload.js',array('scope' => 'footer'));
			drupal_add_js(drupal_get_path('theme', 'gloobers2') .'/js/custom-pluplaod.js',array('scope' => 'footer'));
			$photos = getPhotosData(arg(3));
			$productForm = drupal_get_form('restaurant_photos_form');
		break;
		case "amenities":
			$productForm = drupal_get_form('restaurant_amenities_form');
		break;
		case "location":
			$addressListing = 1;
			$addressform=drupal_get_form('restaurant_location_info_form');	
			$productId=(Integer)arg(3);			
			if (is_int ($productId) )
			{
				$productDetail=getListingData($productId);	
			}
		break;
		case "extra":
			$extrasListing = 1;
			$extras = getProductExtraData(arg(3));
			$productForm = drupal_get_form('restaurant_extra_form');
		break;
		case "pricing":
			drupal_add_js(drupal_get_path('theme', 'gloobers2') .'/js/vendor/plugins/datepicker/bootstrap-datepicker.js', 'file');
			$productForm = drupal_get_form('restaurant_pricing_form');
		break;
		case "subscription":
			$subscriptionListing = 1;
			$productForm = drupal_get_form('restaurant_subscription_form');
		break;
		case "rules":
			$productForm = drupal_get_form('restaurant_rules_form');
		break;
		case "scheduling":
			$productForm = drupal_get_form('restaurant_scheduling_form');
		break;
		
		default:
			$productForm = drupal_get_form('restaurant_details_form');
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

/**********changes on 25-july************/
function restaurant_details_form($form, &$form_state) {
    

$eid = arg(3);
$values = getOverviewData($eid);

  $form['restaurant_details'] = array(
    '#prefix' => '<div><h2>Overview</h2>',
    '#suffix' => '</div>',
  );
  
 $form['restaurant_details']['restauranthtml1'] = array(
 '#type' => 'markup',
 '#markup' => '<h3>'.t('About your Restaurant').'</h3>',
); 

$restaurantType=getRestaurantType();
array_unshift($restaurantType,t('--Select Restaurant Type--'));

  $form['restaurant_details']['restaurant_type'] = array(
    '#type' => 'select',
    '#title' => t('Restaurant Type'),
    '#default_value' => isset($values['restaurant_type']) ? $values['restaurant_type'] : 0,
	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
	'#options'=>$restaurantType,
	'#required' => TRUE
  );
$cuisineType=getCuisineType();

  $form['restaurant_details']['cuisine_type'] = array(
    '#type' => 'checkboxes',
    '#title' => t('Cuisine Type'),
    '#default_value' => isset($values['cuisine_type']) ? $values['cuisine_type'] : 0,
	'#options'=>$cuisineType,
	'#required' => TRUE
  );
 
    $form['restaurant_details']['cuisine_specification'] = array(
    '#type' => 'select',
    '#title' => t('Cuisine Specification'),
    '#default_value' => isset($values['cuisine_specification']) ? $values['cuisine_specification'] : 0,
	'#options'=>array(''=>'--Select--','Halal'=>'Halal','Kosher'=>'Kosher','Vegan'=>'Vegan friendly','Vegetarian'=>'Vegetarian friendly'),
/* 	'#required' => TRUE, */
	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
  );
  
 $form['restaurant_details']['restauranthtml2'] = array(
 '#type' => 'markup',
 '#markup' => '<h3>'.t('Your Restaurant').'</h3>',
); 

  $form['restaurant_details']['restaurant_name'] = array(
    '#type' => 'textfield',
    '#title' => t('Restaurant name'),
    '#default_value' => isset($values['restaurant_name']) ? $values['restaurant_name'] : '',
	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
	'#required' => TRUE
  );
  
  $form['restaurant_details']['short_description'] = array(
    '#type' => 'textarea',
    '#title' => t('Short description'),
    '#default_value' => isset($values['short_description']) ? $values['short_description'] : '',
	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
	'#required' => TRUE
  );
  
  $form['restaurant_details']['long_description'] = array(
    '#type' => 'textarea',
    '#title' => t('Long description'),
    '#default_value' => isset($values['long_description']) ? $values['long_description'] : '',
	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
	/* '#required' => TRUE */
  );
 
  $form['restaurant_details']['languages_spoken'] = array(
    '#type' => 'checkboxes',
    '#title' => t('Languages spoken'),
    '#default_value' => isset($values['languages_spoken']) ? $values['languages_spoken'] : '',
	/* '#required' => TRUE */
	'#options' => getLanguagesList()
  );
  
  $form['page'] = array(
    '#type' => 'hidden',
    '#default_value' => 'restaurant_photos'
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
function product_details_form_submit($form, &$form_state)
{
/*  
echo "<pre>";
print_r($form_state["values"]);
die; */
if($form_state["values"]["eid"]){
/*  $query=db_update('gbl_experience_list')
      ->fields(array('experience_type'=>$form_state['values']['product_type'],'experience_category'=>$form_state['values']['product_category'],
	  'title'=>$form_state['values']['product_name'],'short_description'=>$form_state['values']['short_description'],
	  'brief_description'=>$form_state['values']['long_description'],'traveller_access'=>$form_state['values']['traveller_access'],
	  'communication_with_traveller'=>$form_state['values']['communication'],'around_places'=>$form_state['values']['whats_around'],
	  'transportation'=>$form_state['values']['transportation'],'modified'=>time()
	    ))->condition('eid',$form_state["values"]["eid"]);	 */
		$query=db_update('gbl_experience_list')
      ->fields(array('experience_type'=>$form_state['values']['product_type'],'experience_category'=>$form_state['values']['product_category'],
	  'title'=>$form_state['values']['product_name'],'short_description'=>$form_state['values']['short_description'],
	  'expect'=>$form_state['values']['expect'],'itinerary'=>$form_state['values']['itinerary'],
	  'communication_with_traveller'=>$form_state['values']['communication'],'modified'=>time()
	    ))->condition('eid',$form_state["values"]["eid"]);	
     $result=$query->execute();	 

	 if($result)
	 {	
		 $_SESSION['product_id']=$form_state["values"]["eid"];		 
		 drupal_set_message(t('Product Overview data updated successfully'));
		 drupal_goto('product/add/photos/'.urlencode($form_state["values"]["eid"]));
	 }
}
else{
$query=db_insert('gbl_experience_list')
      ->fields(array('experience_type'=>$form_state['values']['product_type'],'experience_category'=>$form_state['values']['product_category'],
	  'title'=>$form_state['values']['product_name'],'short_description'=>$form_state['values']['short_description'],
	  'expect'=>$form_state['values']['expect'],'itinerary'=>$form_state['values']['itinerary'],
	  'communication_with_traveller'=>$form_state['values']['communication'],'created'=>time()
	    ));
 /* $query=db_insert('gbl_experience_list')
      ->fields(array('experience_type'=>$form_state['values']['product_type'],'experience_category'=>$form_state['values']['product_category'],
	  'title'=>$form_state['values']['product_name'],'short_description'=>$form_state['values']['short_description'],
	  'brief_description'=>$form_state['values']['long_description'],'traveller_access'=>$form_state['values']['traveller_access'],
	  'communication_with_traveller'=>$form_state['values']['communication'],'around_places'=>$form_state['values']['whats_around'],
	  'transportation'=>$form_state['values']['transportation'],'created'=>time()
	    ));	  */
     $result=$query->execute();	

	 if($result)
	 {	
		 $_SESSION['product_id']=$result;		 
		 drupal_set_message(t('Product Overview data saved successfully'));
		 drupal_goto('product/add/photos/'.urlencode($result));
	 }
}

}
function product_photos_form($form, &$form_state){

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

function restaurant_amenities_form($form, &$form_state){
	$amenitiesdatas=getAmentiesByproduct(arg(3));
	$amenitiesId=array();
	  foreach($amenitiesdatas as $amenitiesdata)
	  {
	  $amenitiesId[]=$amenitiesdata['value1'];
	  }
	  $form['product_amenities'] = array(
		'#prefix' => '<div><h2>Amenities</h2>',
		'#suffix' => '</div>',
	  );
	$commonAmenties=getAmentiesdata('Restaurant');
	$paymentMethods=getAmentiesdata('Payment methods');
	$creditCards=getAmentiesdata('Credit Card');
	   if(count($commonAmenties>0))
	  {
	   $form['basic'] = array(
		'#prefix'=> '<div class="amenities-common"><ul>'   
	  );
	  foreach($commonAmenties as $amenties)
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
  
		if($amenties['amenties_name'] == "Payment methods"){
			if(count($paymentMethods>0))
			{
			   $form['basic']['HTML'] = array(
				'#prefix'=> '<div class="amenities-payment-methods"><ul>'   
			  );
				foreach($paymentMethods as $amenties)
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
							if($amenties['amenties_name'] == "Credit card"){
								if(count($creditCards>0))
								{
								   $form['basic']['HTML-CREDIT'] = array(
									'#prefix'=> '<div class="amenities-credit-cards"><ul>'   
								  );
									foreach($creditCards as $creditCard)
									{
									  
									  $idlower=trim(strtolower($creditCard['amenties_name']));
									  $id=str_replace(" ","-",$idlower);  
										  if($creditCard['description'] != ""){
												$form['basic'][$id] = array(
												'#prefix' => '<li><label for="'.$id.'">',
												'#suffix' => '</li></label>',
												'#type'=>'checkbox',
												'#title'=>$creditCard['amenties_name']."  <strong id='hint' rel='".$creditCard['description']."'>?</strong>",
												'#value'=>(in_array($creditCard['aid'],$amenitiesId))?1:0,
												// '#value' =>$creditCard['aid'],		
												'#name' => $creditCard['aid'],
												'#attributes' => array('class' => array('icon-question')), 
												
												);
										  }
										  else{
												$form['basic'][$id] = array(
												'#prefix' => '<li><label for="'.$id.'">',
												'#suffix' => '</li></label>',
												'#type'=>'checkbox',
												'#title'=>$creditCard['amenties_name'],
												'#value'=>(in_array($creditCard['aid'],$amenitiesId))?1:0,
												// '#value' =>$creditCard['aid'],		
												'#name' => $creditCard['aid'],
												'#attributes' => array('class' => array('icon-question')), 
												
												);							
										  }
									}
								  $form['basic']['HTML-CLOSE-CREDIT']=array(
									'#suffix'=> '</ul></div>',
								  );
								}
							}
							else{
										$form['basic'][$id."_label"] = array(
										'#type' => 'textfield',
			/* 							'#title' => t('Restaurant name'), */
										'#default_value' => isset($values[$id."_label"]) ? $values[$id."_label"] : '',
										  '#attributes' => array('placeholder'=>'Add label',
											'class' => array('form-control'),
										  ),
										'#required' => TRUE
										);							
							}
							
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
							if($amenties['amenties_name'] == "Credit card"){
								if(count($creditCards>0))
								{
								   $form['basic']['HTML-CREDIT'] = array(
									'#prefix'=> '<div class="amenities-credit-cards"><ul>'   
								  );
									foreach($creditCards as $creditCard)
									{
									  
									  $idlower=trim(strtolower($creditCard['amenties_name']));
									  $id=str_replace(" ","-",$idlower);  
										  if($creditCard['description'] != ""){
												$form['basic'][$id] = array(
												'#prefix' => '<li><label for="'.$id.'">',
												'#suffix' => '</li></label>',
												'#type'=>'checkbox',
												'#title'=>$creditCard['amenties_name']."  <strong id='hint' rel='".$creditCard['description']."'>?</strong>",
												'#value'=>(in_array($creditCard['aid'],$amenitiesId))?1:0,
												// '#value' =>$creditCard['aid'],		
												'#name' => $creditCard['aid'],
												'#attributes' => array('class' => array('icon-question')), 
												
												);
										  }
										  else{
												$form['basic'][$id] = array(
												'#prefix' => '<li><label for="'.$id.'">',
												'#suffix' => '</li></label>',
												'#type'=>'checkbox',
												'#title'=>$creditCard['amenties_name'],
												'#value'=>(in_array($creditCard['aid'],$amenitiesId))?1:0,
												// '#value' =>$creditCard['aid'],		
												'#name' => $creditCard['aid'],
												'#attributes' => array('class' => array('icon-question')), 
												
												);							
										  }
									}
								  $form['basic']['HTML-CLOSE-CREDIT']=array(
									'#suffix'=> '</ul></div>',
								  );
								}						
						  }
						  else{
										$form['basic'][$id."_label"] = array(
										'#type' => 'textfield',
			/* 							'#title' => t('Restaurant name'), */
										'#default_value' => isset($values[$id."_label"]) ? $values[$id."_label"] : '',
										  '#attributes' => array('placeholder'=>'Add label',
											'class' => array('form-control'),
										  ),
										'#required' => TRUE
										);						  
						  }
						}
					}
				  $form['basic']['HTML-CLOSE']=array(
					'#suffix'=> '</ul></div>',
				  );
			}
		}
	  }
	  $form['basic-close']=array(
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

function product_amenities_form_submit($form, &$form_state)
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
function product_location_info_form($form,&$form_state)
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
function product_extra_form($form, &$form_state){
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
	'#suffix' => '</div>'
  );
  
/*   $form['product_extra']['extra_price_key'] = array(
    '#type' => 'select',
	'#attributes' => array(
		'class' => array('form-control'),
	),
    '#default_value' => isset($extraDetails['price-key']) ? $extraDetails['price-key'] : NULL,
	'#options' => array('per-day'=>'Per Day','per-stay'=>'Per Stay','per-item'=>'Per Item','per-hour'=>'Per Hour'),
	'#suffix' => '</div>'
  ); */
  
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

function restaurant_pricing_form($form, &$form_state){
	$eid = arg(3);
	$pricingData = getPricingData($eid);
  
	$values = unserialize($pricingData["value1"]);
  
	$form['restaurant_pricing'] = array(
	'#prefix' => '<div><h2>Pricing</h2>',
	'#suffix' => '</div>',
	);

	$form['restaurant_pricing']['coupon_name'] = array(
		'#type' => 'textfield',
		'#title' => t("Enter Coupon's name"),
		'#default_value' => isset($values['coupon_name']) ? $values['coupon_name'] :  '',
		'#attributes' => array(
		'class' => array('form-control'),
		),
	);  
/* 	$form['restaurant_pricing']['add_new_schedule'] = array(
		'#prefix' => '<div><a class="btn btn-dark btn-gradient form-submit" href="#" id="addCat">Add category</a>',
		'#suffix' => '</div></div>',
	); */

/* 	$form['restaurant_pricing']['ruleshtml'] = array(
		'#type' => 'markup',
		'#markup' => '<h3>'.t('Discounts').'</h3>',
	); */

	$form['restaurant_pricing']['coupon_price'] = array(
		'#type' => 'textfield',
		'#title' => t("Price"),
		'#prefix' => '<div class="coupon-price-wrapper">',
		'#description' => t("enter a number please"),
		'#default_value' => isset($values['coupon_price']) ? $values['coupon_price'] :  '',
		'#attributes' => array(
		'class' => array('form-control'),
		),
	); 
	
	$form['restaurant_pricing']['coupon_price_form'] = array(
		'#type' => 'select',
		'#attributes' => array(
			'class' => array('form-control'),
		),
		'#suffix' => '</div>',
		'#default_value' => isset($values['coupon_price_form']) ? $values['coupon_price_form'] : NULL,
		'#options' => array('in-%'=>'in % on total amount','in-$'=>'in % on total amount'),
	);
 
/*   $form['restaurant_pricing']['discount_description'] = array(
	'#type' => 'textarea',
	'#attributes' => array(
		'class' => array('form-control'),
	),
	'#title' => t('Description'),
	'#default_value' => isset($extraDetails['discount_description']) ? $extraDetails['discount_description'] : NULL,
  ); 
 
  $form['restaurant_pricing']['discount_restrictions'] = array(
	'#type' => 'textarea',
	'#attributes' => array(
		'class' => array('form-control'),
	),
	'#title' => t('Restrictions'),
	'#default_value' => isset($extraDetails['discount_restrictions']) ? $extraDetails['discount_restrictions'] : NULL,
  );  */ 

  $form['restaurant_pricing']['validity_on'] = array(
    '#type' => 'radios',
    '#title' => t('Restrictions'),
	'#prefix' => '<div class="validity-wrapper">',
    '#default_value' => isset($values['validity_on']) ? $values['validity_on'] : 0,
	'#options'=>array('Breakfast'=>'Breakfast','Lunch'=>'Lunch','Dinner'=>'Dinner'),
  );
	$form['restaurant_pricing']['rep-sessions-html'] = array(
		'#type' => 'markup',
		'#prefix' => '<div class="rep-sessions-wrapper">',
	);
	$weekdays = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
	foreach($weekdays as $key=>$value){
		$form['restaurant_pricing']['validity_day_['.$value.']'] = array(
		'#type' => 'checkbox',
		'#prefix' => '<div class="rep-sessions">',
		'#title' => t($value),
		'#default_value' => isset($values['validity_day_'.$value]) ? $values['validity_day_'.$value] : NULL,

		);
	  
		$form['restaurant_pricing']['validity_from_['.$value.']'] = array(
		'#type' => 'textfield',
		'#title' => t('From'),
		'#default_value' => isset($values['validity_to_'.$value]) ? $values['validity_to_'.$value] : NULL,
		  '#attributes' => array('placeholder'=>'From',
			'class' => array('form-control','timepicker'),
		  ),
		);
	  
		$form['restaurant_pricing']['validity_to_['.$value.']'] = array(
		'#type' => 'textfield',
		'#title' => t('To'),
		'#suffix' => '</div>',
		'#default_value' => isset($values['validity_to_'.$value]) ? $values['validity_to_'.$value] : NULL,
		  '#attributes' => array('placeholder'=>'To',
			'class' => array('form-control','timepicker'),
		  ),
		);
	} 
	$form['restaurant_pricing']['rep-sessions-html-close'] = array(
		'#type' => 'markup',
		'#suffix' => '</div></div>',
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
	

	$form['save'] = array(
	'#type' => 'submit',
	'#attributes' => array('class'=>array('btn btn-dark btn-gradient')),
	'#value' => t('Save')
	);
    
	return $form;
}

function product_rules_form($form, &$form_state){
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
	$form['product_rules']['experience_rules'] = array(
		'#type' => 'textarea',
		'#title' => t('Experience Rules'),
		'#default_value' => isset($values['experience_rules']) ? $values['experience_rules'] :  '',
		'#attributes' => array(
		'class' => array('form-control'),
		),
	);
  $form['product_rules']['experience_manual'] = array(
    '#type' => 'textarea',
    '#title' => t('Experience Manual'),
	'#default_value' => isset($values['experience_manual']) ? $values['experience_manual'] : '',
 	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
  );


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
  
  
$form['product_rules']['cancellation_policy_entire'] = array(  
	'#prefix' => '<div class="cancelation-policy-entire-stay">',	
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
     '#markup' => '<h4>'.t('(in %) refunded on the pending stay duration').'</h4>',
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

function product_booking_info_form($form, &$form_state){
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

function product_location_form($form, &$form_state){
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

function product_subscription_form($form, &$form_state){

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

function restaurant_scheduling_form($form, &$form_state){
  $values = isset($form_state['multistep_values']['rentals_scheduling']) ? $form_state['multistep_values']['rentals_scheduling'] : array();
 
  $form['restaurant_scheduling'] = array(
    '#prefix' => '<div><h2>Scheduling</h2>',
    '#suffix' => '</div>',
  );
 
	$form['restaurant_scheduling']['price-settings'] = array(
		'#type' => 'markup',
		'#markup' => '<h3>'.t('Availability').'</h3>',
/* 		'#prefix' => '<div class="quantity" id="session">', */
	);
	
  $form['restaurant_scheduling']['restaurant_dates_available'] = array(
    '#type' => 'select',
    '#title' => t('Dates available'),
	'#attributes' => array(
		'class' => array('form-control'),
	),
    '#default_value' => isset($values['restaurant_dates_available']) ? $values['restaurant_dates_available'] : NULL,
	'#options' => array('YEARLY'=>'All year Long','SEASON'=>'Seasonly'),
	'#required' => TRUE
  );
  $form['restaurant_scheduling']['openning-days-hours'] = array(
		'#type' => 'markup',
		'#markup' => '<h3>'.t('Openning Days & Hours').'</h3>',
		'#prefix' => '<div class="quantity rentals-scheduling-yearly">',
);
	$weekdays = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
	foreach($weekdays as $key=>$value){
		$form['restaurant_scheduling']['restaurant_day_['.$value.']'] = array(
		'#type' => 'checkbox',
		'#prefix' => '<div class="rep-sessions">',
		'#title' => t($value),
		'#default_value' => isset($extraDetails['restaurant_day_'.$value]) ? $extraDetails['restaurant_day_'.$value] : NULL,

		);
	  
		$form['restaurant_scheduling']['restaurant_time_from_['.$value.']'] = array(
		'#type' => 'textfield',
		'#title' => t('From'),
		'#default_value' => isset($values['restaurant_time_from_'.$value]) ? $values['restaurant_time_from_'.$value] : NULL,
		  '#attributes' => array('placeholder'=>'From',
			'class' => array('form-control','timepicker'),
		  ),
		);
	  
		$form['restaurant_scheduling']['restaurant_time_to_['.$value.']'] = array(
		'#type' => 'textfield',
		'#title' => t('To'),
		'#suffix' => '</div>',
		'#default_value' => isset($values['restaurant_time_to_'.$value]) ? $values['restaurant_time_to_'.$value] : NULL,
		  '#attributes' => array('placeholder'=>'To',
			'class' => array('form-control','timepicker'),
		  ),
		);
	}
  $form['restaurant_scheduling']['openning-days-hours-end'] = array(
		'#type' => 'markup',
		'#suffix' => '</div>',
);   
  $form['restaurant_scheduling']['openning-dates'] = array(
		'#type' => 'markup',
		'#markup' => '<h3>'.t('Openning Dates').'</h3>',
		'#prefix' => '<div class="quantity rentals-scheduling">',
);  

  $form['restaurant_scheduling']['restaurant_date_from'] = array(
    '#type' => 'textfield',
 	'#title' => t('From'),
	'#prefix' => '<div id="rentals-scheduling" class="rentals-scheduling">',
    '#default_value' => isset($values['rentals_date_from']) ? $values['rentals_date_from'] : NULL,
	  '#attributes' => array('placeholder'=>'From',
		'class' => array('form-control','datepicker'),
	  ),
  );
  
  $form['restaurant_scheduling']['restaurant_date_to'] = array(
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
 
	$form['restaurant_scheduling']['add_new_schedule'] = array(
		'#prefix' => '<div><a class="btn btn-dark btn-gradient form-submit" href="#" id="addDate">Add another</a>',
		'#suffix' => '</div></div></div>',
	);
	
  $form['restaurant_scheduling']['openning-hours'] = array(
		'#type' => 'markup',
		'#markup' => '<h3>'.t('Openning Hours').'</h3>',
		'#prefix' => '<div class="quantity rentals-scheduling">',
	);
  $form['restaurant_scheduling']['openning_hours_type'] = array(
    '#type' => 'select',
	'#attributes' => array(
		'class' => array('form-control'),
	),
    '#default_value' => isset($extraDetails['price-key']) ? $extraDetails['price-key'] : NULL,
	'#options' => array('every-day'=>'Every day','specific-days'=>'Specific days','specific-dates'=>'Specific dates'),
  );
  $form['restaurant_scheduling']['openning_hours_dates'] = array(
    '#type' => 'textfield',
/* 	'#prefix' => '<div class="quantity">',
    '#title' => t('From'), */
	  '#attributes' => array('placeholder'=>'10/25/2013 - 10/25/2013',
		'class' => array('form-control'),
	  ),
    '#default_value' => isset($values['openning_hours_dates']) ? $values['openning_hours_dates'] : NULL,
  );
  $form['restaurant_scheduling']['openning_hours_days'] = array(
    '#type' => 'select',
	'#attributes' => array(
		'class' => array('form-control'),
	),
    '#default_value' => isset($extraDetails['openning_hours_days']) ? $extraDetails['openning_hours_days'] : NULL,
	'#options' => array('Monday'=>'Monday','Tuesday'=>'Tuesday','Wednesday'=>'Wednesday','Thursday'=>'Thursday','Friday'=>'Friday','Saturday'=>'Saturday','Sunday'=>'Sunday'),
	'#suffix' => '</div>'
  );	

  
  $form['page'] = array(
	'#type' => 'hidden',
	'#default_value' => 'product_pricing'
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

function restaurant_extra_form($form, &$form_state){
	$metaID = arg(4);
	$extraDetails1 = getExtraDetails($metaID);
	$extraDetails = unserialize($extraDetails1["value1"]);
	
/* 	echo "<pre>";
	print_r($extraDetails); die; */
	
  $form['restaurant_extra']['new_extra'] = array(
	'#prefix' => '<div class="product-extra">',
    '#type' => 'textfield',
    '#required' => TRUE,
	'#attributes' => array(
		'class' => array('form-control'),
	),
    '#title' => t('New extra'),
    '#default_value' => isset($extraDetails['title']) ? $extraDetails['title'] : NULL,
  );
  
  $form['restaurant_extra']['extra_price_value'] = array(
    '#type' => 'textfield',
    '#prefix' => '<div class="product_extra_price">',
	'#attributes' => array(
		'class' => array('form-control','themePrice'),
	),
    '#title' => t('Price'),
	'#required' => TRUE,
    '#default_value' => isset($extraDetails['price']) ? $extraDetails['price'] : NULL,
  );
  
  $form['restaurant_extra']['extra_price_type'] = array(
    '#type' => 'select',
	'#attributes' => array(
		'class' => array('form-control'),
	),
    '#default_value' => isset($extraDetails['price-type']) ? $extraDetails['price-type'] : NULL,
	'#options' => array('%'=>'Amount in %','$'=>'Amount in $'),
  );
  
  
  $form['restaurant_extra']['extra_price_key'] = array(
    '#type' => 'select',
	'#attributes' => array(
		'class' => array('form-control'),
	),
    '#default_value' => isset($values['extra_price_key']) ? $values['extra_price_key'] : NULL,
	'#options' => array('customer-choice'=>'Customer Choice','per-order'=>'Per Order','per-quantity'=>'Per Quantity'),
	'#suffix' => '</div>'
  );
 
  $form['restaurant_extra']['product_extra_description'] = array(
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

function restaurant_rules_form($form, &$form_state){
	$metaID = arg(3);
	$rules = getRulesDetails($metaID);
	$values = unserialize($rules["value1"]);

	$form['restaurant_rules'] = array(
		'#prefix' => '<div><h2>Rules & Policies</h2>',
		'#suffix' => '</div>',
	);

	$form['restaurant_rules']['ruleshtml'] = array(
		'#type' => 'markup',
		'#markup' => '<h3>'.t('Rules').'</h3>',
	);
	$form['restaurant_rules']['restaurant_policies'] = array(
		'#type' => 'textarea',
		'#title' => t('Restaurant Policies'),
		'#default_value' => isset($values['house_rules']) ? $values['house_rules'] :  '',
		'#attributes' => array(
		'class' => array('form-control'),
		),
	);
 /* $form['restaurant_rules']['restaurant_manual'] = array(
    '#type' => 'textarea',
    '#title' => t('Restaurant Manual'),
	'#default_value' => isset($values['house_manual']) ? $values['house_manual'] : '',
 	  '#attributes' => array(
		'class' => array('form-control'),
	  ),
  );*/



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

function restaurant_photos_form($form, &$form_state){

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


?>