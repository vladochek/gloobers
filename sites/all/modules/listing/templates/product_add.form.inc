<?php
/*Experience listing backend form for multiple steps
* @Product listing Experience Backend Forms
*/
function product_add_form_1(){
	global $user;
	if(!$user->uid){
		$dest = drupal_get_destination();
		$_SESSION['destination']  = $dest["destination"];
		drupal_goto('login', $dest);
	}
	$productForm=$addressform=$productDetail=$extras=$photos =$packages= $directionform=$scheduleSessionData=array();
	$page = arg(2);
	$payment=$success=$calendar=$extrasListing = $addressListing = $photosListing = $subscriptionListing=$overViewListing =$amenitiesList= $pricingList=$rulesList=$schedulingList=0;
	switch($page){
		case "overview":
		$overViewListing=1;
		$productForm = drupal_get_form('product_details_form');
		break;
		case "photos":
			$photosListing = 1;
			$_SESSION['product_id'] = arg(3);
			drupal_add_js(drupal_get_path('theme', 'gloobers2') .'/js/jquery.alerts.js', 'file');
			
			drupal_add_css(drupal_get_path('theme', 'gloobers2') .'/css/jquery.alerts.css', 'file');
			drupal_add_js(drupal_get_path('theme', 'gloobers2') .'/js/jquery.ui.plupload.js',array('scope' => 'footer'));
			drupal_add_js(drupal_get_path('theme', 'gloobers2') .'/js/custom-pluplaod.js',array('scope' => 'footer'));
			$photos = getPhotosData(arg(3));
			$productForm = drupal_get_form('product_photos_form');
		break;
		case "amenities":
			$amenitiesList=1;
			
			$productForm = drupal_get_form('product_amenities_form');
		break;
		case "location":
		$addressListing = 1;
		$addressform=drupal_get_form('product_location_info_form');
		$directionform=drupal_get_form('location_direction_form');	
	    drupal_add_js(drupal_get_path('theme', 'gloobers2') .'/js/location-custom.js',array('scope' => 'footer'));				
		$productId=(Integer)arg(3);			
		if (is_int ($productId))
		{
			$productDetail=getListingData($productId);	
		}
		break;
		 case "extra":
			$extrasListing = 1;
			
			$extras = getProductExtraData(arg(3));
			$productForm = drupal_get_form('product_extra_form');
		break;		
		case "subscription":
			$subscriptionListing = 1;
			
			$packages = getListingPackages();
			$productForm = drupal_get_form('product_subscription_form');
		break;
		
		case "rules":
		$rulesList=1;		
		drupal_add_js(drupal_get_path('theme', 'gloobers2') .'/js/rules_custom.js', 'file');
		$productForm = drupal_get_form('product_rules_form');
		break;
		
		case "calendar":
			$calendar = 1;
		break;
		case "success":		
			$success=1;
		break;
		case "payment":
			$payment=1;
			if(arg(4)=="3")
			{
			setFreeSubscription(arg(3));
			}
			else {
			$productForm = drupal_get_form('package_payment_form');
			}
		break;
		case "Calendernew":
			$Calendernew=1;
			drupal_add_js(drupal_get_path('theme', 'gloobers2') .'/js/vendor/plugins/datepicker/bootstrap-datepicker.js', 'file');

			$scheduleSessionData = getScheduleSessionData(arg(3));
			$productForm = drupal_get_form('product_calendar_form');
		break;
		default:
			$productForm = drupal_get_form('product_details_form');
		break; 
	}
	$_SESSION['product_id'] = arg(3);

	return theme('add_product', array('payment'=>$payment,'packages'=>$packages,'success'=>$success,'scheduleSessionData'=>$scheduleSessionData,'directionform'=>$directionform,'productForm' => $productForm,'photos'=>$photos,'extras'=>$extras,'extrasListing'=>$extrasListing,'productDetail'=>$productDetail,'addressform'=>$addressform,'addressListing'=>$addressListing,'photosListing'=>$photosListing,'subscriptionListing'=>$subscriptionListing,'overViewListing'=>$overViewListing,'amenitiesList'=>$amenitiesList,'Calendernew'=>$Calendernew,'pricingList'=>$pricingList,'schedulingList'=>$schedulingList,'rulesList'=>$rulesList,'calendar'=>$calendar));
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
 
 

/**
 * Form for the entering location address for experience listing form.
 * 
 * @see.
 *  
 * @param type $form
 * @param type $form_state
 * @return type 
 */
function location_direction_form($form,&$form_state){
$form=array();
$productId=(Integer)arg(3);
$productDetail=getListingData($productId);
	$form['html']=array('#prefix'=>'<div class="col-md-12 col-sm-12 col-xs-12"><h2>Location</h2>
						<p class="subtitle">Manage Location</p></div>');

    $form['transport']['Itinerary'] = array(
	'#type' => 'textarea',
    '#prefix' => '<h1>Itinerary</h1><div class="col-xs-12 col-sm-9 col-md-9 safty_left">',
	'#default_value' => isset($productDetail['direction']) ? $productDetail['direction'] : NULL,
    ); 
	
    $form['save'] = array(
    '#type' => 'submit',
	'#attributes' => array('class'=>array('btn btn-dark btn-gradient')),
    '#value' => t('Save'),
	'#prefix' => '<div class="bs_save_btn">',
	'#suffix' => '</div></div>',
	);
	/* $form['help_lines'] = array('#prefix'=>'<div class="col-xs-12 col-sm-3 col-md-3"><div class="help_block"><div class="heading_help" style="display: block;">Address</div><p>Your exact address is kept private. It will only be shared to confirmed travellers.</p>
			</div></div>'
	);
	 */
	
	
return $form;  
}


/**
 * Form for the Experience listing overview form.
 * 
 * 
 *  
 * @param type $form
 * @param type $form_state
 * @return type 
 */
 /*

/**********changes on 25-july*****Product overview form*******/
function product_details_form($form, &$form_state) {
	global $user;  
	$eid = arg(3);
	$values = getOverviewData($eid);
	if(isset($eid) && $eid!=""){
		if(empty($values)){
			drupal_set_message('No Listing data yet Created','error');
			drupal_goto('product/add/overview');
		}
		else if($user->uid!=$values['uid']){
			drupal_set_message('You have not access to view Listing data','error');
			drupal_goto('product/add/overview');
		}
	}
	$form['html']=array('#prefix'=>'<div class="col-md-12 col-sm-12 col-xs-12"><h2 class="pagehead">Overview</h2>
						<p class="subtitle">Introduce your experience</p></div>');

	$form['#attributes']['class'][] = 'Calenderform';
 	$form['product_details'] = array(
    	'#prefix' => '<div class="col-xs-12 col-sm-22 col-md-12">',
    ); 

	$experienceType=getExperienceType();
	$experienceCategory=getExperienceCategory();
  	$form['product_details']['product_type'] = array(
    	'#type' => 'select',
    	'#prefix' => '<fieldset><label>Experience Type </label><div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 padding_left">',
    	'#default_value' => isset($values['experience_type']) ? $values['experience_type'] : 0,
	  	'#attributes' => array(
			'class' => array(''),
	  	),
	  	'#suffix'=>'</div></fieldset>',
		'#options'=>$experienceType,
		'#required' => TRUE
  	);

 	$form['product_details']['product_name'] = array(
        '#type' => 'textfield',
        '#default_value' => isset($values['title']) ? $values['title'] : '',
	    '#attributes' => array(
			'class' => array(''),
		),
		'#title' => t('Experience Title.'),
		
	    '#prefix'=>'<fieldset><div class="col-lg-12 col-md-12 col-sm-22 col-xs-12 padding_left">',
	    '#suffix'=>'</div></fieldset>',
	    '#maxlength' =>35,
	    '#required' => TRUE
  	);

  
 	$form['product_details']['long_description'] = array(
    	'#type' => 'textarea',
    	'#title' => t('Describe your experience.'),
    	'#default_value' => isset($values['brief_description']) ? trim($values['brief_description']) : '',
	  	'#attributes' => array(
			'class' => array(''),'onKeyPress'=>"return(this.value.length<5000);"
	  	),
	  	'#prefix'=>'<fieldset>',
	 	'#suffix'=>'</fieldset>',
		'#required' => TRUE
  	);

  	$form['page'] = array(
    	'#type' => 'hidden',
    	'#default_value' => 'product_amenities'
  	);
  
  	$form['eid'] = array(
    	'#type' => 'hidden',
    	'#default_value' => isset($values['eid']) ? $values['eid'] : 0,
  	);
  
   	$form['save']=array(
		'#type' => 'submit',
	    '#value' => t('Save'),
		'#attributes' => array('class'=>array('')),
		'#prefix'=>'<fieldset>',
		'#suffix'=>'</fieldset></div></div></div></div></div></div>'
	);
  
	return $form;
}

function product_photos_form($form, &$form_state){
		
	global $user;  
    $listing_id = arg(3);
	if($listing_id!=""){
		$values = getOverviewData($listing_id);
		if(empty($values)){
  			drupal_set_message('No Listing data yet Created','error');
			drupal_goto('product/add/overview');
		}
		else if($user->uid!=$values['uid']){
			drupal_set_message('You have not access to view Listing data','error');
			drupal_goto('product/add/overview');
		}
	}
	$form['html']=array('#prefix'=>'<div class="col-md-12 col-sm-12 col-xs-12"><h2 class="pagehead">Photos</h2>
						<p class="subtitle">Manage Photos</p></div>');
	
	$form['#attributes']['class'][] = 'Calenderform';
	
  	$form['picture_upload'] = array(
	  	'#type' => 'plupload',
	  	'#title' => t('Upload files'),
	  	'#upload_validators' => array(
			'file_validate_extensions' => array('jpg jpeg gif png txt doc xls pdf ppt pps odt ods odp'),
	  	),
	  	'#plupload_settings' => array(
			'runtimes' => 'html5',
			'chunk_size' => '1mb',
	  	),
	);
	
	$form['listing_id']=array(
		'#type'=>'hidden',
		'#default_value'=>$listing_id,	
		'#attributes' => array('class'=>array('listing_id')),		
	);
 //,'onclick'=>'check_photo_validate();'
    $form['save']=array(
        '#type' => 'submit',
		'#prefix'=>'<fieldset>',
		'#suffix'=>'</fieldset>',
		'#attributes' => array('class'=>array('')),
		'#value' => t('Save')
    );
	$form['End_html']=array(
        '#type' => 'markup',
		'#suffix'=>'</div></div></div></div></div>',
	);
	return $form;
}
/* function product_photos_form_submit($form, &$form_state){
	echo "sdfsdf";exit;
} */

/* Product Amenities Form */
function product_amenities_form($form, &$form_state){
	global $user;  
    $listing_id = arg(3);
	if($listing_id!=""){
		$values = getOverviewData($listing_id);
		if(empty($values)){
			drupal_set_message('No Listing data yet Created','error');
			drupal_goto('product/add/overview');
		}
		else if($user->uid!=$values['uid']){
			drupal_set_message('You have not access to view Listing data','error');
			drupal_goto('product/add/overview');
		}
	}

	$amenitiesdatas=getAmentiesByproduct(arg(3));
	$amenities_array=unserialize($amenitiesdatas['value1']);

	$form['html']=array('#prefix'=>'<div class="col-md-12 col-sm-12 col-xs-12"><h2 class="pagehead">Amenities</h2>
						<p class="subtitle">Manage Amenities</p></div>');
	$form['product_amenities'] = array();
	
	$form['product_amenities']['whats_included[]'] = array(
		'#type' => 'textfield',
		'#prefix' => '<div class="bs_right_one"><h1>What\'s included ?</h1><div class="bs_event_form-one" id="amenities-included">',
		'#default_value' => isset($amenities_array['whats_included'][0]) ?$amenities_array['whats_included'][0] : '',
		  '#attributes' => array('placeholder'=>'Add label',
			'class' => array('amenities-included','required'),
		  ),
	);
	$form['product_amenities']['add_whats_included'] = array(
		'#prefix' => '<p><a href="#" class="" id="addInc">Add more</a></p>',
	);
	if(sizeof($amenities_array['whats_included'])>1){
		foreach($amenities_array['whats_included'] as $key=>$value){
			if($key>0){
				$form['product_amenities']['whats_included['.$key.']'] = array(
					'#type' => 'textfield',
					'#prefix' => '<div class="bs_event_form-one amenities-included" id="amenities-included'.$key.'">',
					'#default_value' => isset($value) ?$value : '',
					'#attributes' => array('placeholder'=>'Add label',
						'class' => array('required'),
					),
					  '#maxlength' =>35,
				);
				
				$form['product_amenities']['remove_whats_included['.$key.']'] = array(
				'#prefix' => '<a id="remInc" class="delete_clone" href="#">'.t('Delete').'</a></div>',
				);
			}
		}
	}
	$form['product_amenities']['end_included'] = array(
		'#prefix' => '</div></div>',
	);

	$form['product_amenities']['safety_precautions'] = array(
		'#type' => 'textarea',
		'#prefix' => '<div class="bs_event_safty"><h1>Safety</h1><div class="col-xs-12 col-sm-9 col-md-9 safty_left">',
		'#default_value' =>isset($amenities_array['safety_precautions']) ?$amenities_array['safety_precautions'] : '',
		'#attributes' => array('placeholder'=>'Add label',
								'class' => array(''),
							),
	);
	if($amenities_array)
	{
		$form['input'] = array(
		'#type' => 'hidden',
		'#value' => 'Edit'
		);
  
	 $form['save'] = array(
		'#type' => 'submit',
		'#attributes' => array('class'=>array('')),
		'#value' => t('Save'),
		'#prefix'=>'<div class="bs_save_btn">',
		'#suffix'=>'</div>'
		);
	}else{
	 $form['save'] = array(
		'#type' => 'submit',
		'#attributes' => array('class'=>array('')),
		'#value' => t('Save'),
		'#prefix'=>'<div class="bs_save_btn">',
		'#suffix'=>'</div>'
		);
	}
	return $form;
}

/* End Product Amenities Form */

function product_location_info_form($form,&$form_state)
{
	
	$countryList=getCountryList();
	$productId=(Integer)arg(3);
	/**************************************************************************************/
	global $user;  
    $productId = arg(3);
	
	if($productId!="")
	{
	$values = getOverviewData($productId);
		if(empty($values))
		{
		drupal_set_message('No Listing data Found','error');
		drupal_goto('product/add/overview');
		}
		else if($user->uid!=$values['uid']){

		drupal_set_message('You have not access to view Listing data','error');
		drupal_goto('product/add/overview');
		}
	}
	/**************************************************************************************/
	
    
	$form=array();
		// $form['html']=array('#prefix'=>'<div class="col-md-12 col-sm-12 col-xs-12"><h2 class="pagehead">Location</h2>
		// 				<p class="subtitle">Manage Location</p></div>');
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
	'#default_value' => ($values['address1'])?$values['address1'] :"",
  );
  $form['address2'] = array(

    '#type' => 'textfield',
	'#attributes' => array(
		'class' => array('form-control'),'placeholder' => t('"ex. apt 50')	),
    '#title' => t('Address Line 2'), 
    '#default_value' => ($values['address2'])?$values['address2'] :"",	
  );
  $form['city'] = array(
	
    '#type' => 'textfield',
	'#attributes' => array(
		'class' => array('form-control'),
	),
	//'#attributes' =>array('placeholder' => t(''))
    '#title' => t('City'),
    '#required' => TRUE ,
    '#default_value' => ($values['city'])?$values['city'] :"",		
  );
	 $form['state'] = array(
	'#type' => 'textfield',
	'#attributes' => array(	'class' => array('form-control'),),
    '#title' => t('State / Province / Region'),
    '#required' => TRUE ,
     '#default_value' => ($values['state'])?$values['state'] :"",	
  );
  $form['zipcode'] = array(
	'#type' => 'textfield',
	'#attributes' => array(
		'class' => array('form-control'),'placeholder' => t('ex. 437719')
	),	
    '#title' => t('ZIP / Postal Code'),  
    '#maxlength' =>10,
	'#default_value' => ($values['zipcode'])?$values['zipcode'] :"",	
    
  );
    $form['country'] = array(
    '#type' => 'select',
	'#attributes' => array(
		'class' => array('form-control'),
	),	
    '#title' => t('Country'),   
    '#required' => TRUE	,
	'#options'=>$countryList,
	'#default_value' => ($values['country'])?$values['country'] :"",
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

function product_extra_form($form, &$form_state){


	global $user,$base_url;  
    $productId = arg(3);
	$extrasListing = 1;
	$extras = getProductExtraData(arg(3));
	
	if($productId!="")
	{
		$values = getOverviewData($productId);
		if(empty($values))
		{
		drupal_set_message(t('No Listing data found'),'error');
		drupal_goto('product/add/overview');
		}
		else if($user->uid!=$values['uid']){

		drupal_set_message(t('You have not access to view Listing data'),'error');
		drupal_goto('product/add/overview');
		}
	}
	$form['#attributes']['class'][] = 'Calenderform';
	$metaID = arg(4);
	$extraDetails1 = getExtraDetails($metaID);
	$extraDetails = unserialize($extraDetails1["value1"]);

  $form['html']=array('#prefix'=>'<div class="col-md-12 col-sm-12 col-xs-12"><h2 class="pagehead">Optional Services</h2>
						<p class="subtitle">Manage Optional Services</p></div>');
  $form['product_extra']['extra_service'] = array(
	'#prefix' => '<fieldset>',
    '#type' => 'textfield',
	'#suffix'=>'</fieldset>',
    '#required' => TRUE,
	'#attributes' => array(
		'class' => array(''),
	),
    '#title' => t('Optional Service'),
    '#default_value' => isset($extraDetails['title']) ? $extraDetails['title'] : NULL,
  );
  
  $form['product_extra']['extra_price_value'] = array(
    '#type' => 'textfield',
    '#prefix' => '<fieldset><label>Price</label><div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 padding_left">',
	
	'#required' => TRUE,
    '#default_value' => isset($extraDetails['price']) ? $extraDetails['price'] : NULL,
	'#suffix'=>'</div>'
  );
  
  $form['product_extra']['extra_price_type'] = array(
    '#type' => 'select',
	'#prefix'=>'<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 padding_left">',
	'#suffix'=>'</div>',
	'#attributes' => array(
		'class' => array(''),
	),
    '#default_value' => isset($extraDetails['price-type']) ? $extraDetails['price-type'] : NULL,
	'#options' => array('%'=>'Amount in %','$'=>'Amount in $'),
  );
  $form['product_extra']['extra_price_key'] = array(
    '#type' => 'select',
	'#prefix'=>'<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 padding_left padding_right">',
	'#attributes' => array(
		'class' => array(''),

	),
    '#default_value' => isset($values['extra_price_key']) ? $values['extra_price_key'] : NULL,
	'#options' => array('per-order'=>'Per Order','per-quantity'=>'Per Quantity'),
	'#suffix' => '</div></fieldset>'
  );
 
  $form['product_extra']['product_extra_description'] = array(
    '#type' => 'textarea',
	'#prefix'=>'<fieldset>',
	'#suffix' => '</fieldset>',
	'#attributes' => array(
		'class' => array(''),
	),
    '#title' => t('Description'),
    '#default_value' => isset($extraDetails['description']) ? $extraDetails['description'] : NULL,
  ); 
  $form['next_step']=array(
	 '#prefix'=>'<fieldset class="boaders"><a href="'.url("product/add/rules/".arg(3)).'" class="add_service">Next Step</a></fieldset>',
   ); 
  
   $form['metaID'] = array(
    '#type' => 'hidden',
    '#default_value' => isset($extraDetails1['meta_id']) ? $extraDetails1['meta_id'] : NULL,
  ); 

  $form['page'] = array(
    '#type' => 'hidden',
    '#default_value' => 'product_subscription'
  );
  //echo "<pre>";Print_r($extras);exit;
  if($extras){
	$form['already_added'] = array( '#prefix' => '<fieldset><div class="help-block boader_class">
										<div class="heading_help">My optional Services</div>
										<table class="table2">
											<thead>
												<tr>
												<th>Title</th>
												<th>Type</th>
												<th>Price</th>
												<th>Action</th>
												</tr>
											</thead>
										<tbody>',
						);
	
	foreach($extras as $key=>$val){
		$extra1 	= unserialize($val["value1"]);
		//echo "<pre>";Print_r($extra1);exit;
		if($extra1["price-type"] == '%'){
			$cost = $extra1["price"].'%';
		}else{
			$cost = '$'.$extra1["price"];
	    }
	
		$form['already_added_data'][$key] = array(
		
		'#prefix'=>'<tr><td>'.$extra1["title"].'<br/>'.$extra1["description"].'</td>
						  <td>'.$extra1["price-key"].'</td>
						  <td>'.$cost.'</td>
						  <td><a href="'.$base_url.'/product/extra/edit/'.$val["listing_id"].'/'.$val["meta_id"].'">Change</a> | <a href="'.$base_url.'/product/extra/delete/'.$val["listing_id"].'/'.$val["meta_id"].'">Remove</a></td>
						</tr>'
			
		);
	}
	$form['already_added_end'] = array( '#prefix' => '</tbody></table></div></fieldset>');
	}
   
 
    
    $form['next'] = array(
    '#type' => 'submit',
	'#attributes' => array('class'=>array('btn btn-dark btn-gradient')),
    '#value' => t('Add another extra service'),
	'#prefix'=>'<fieldset class="boaders">',
	 '#suffix'=>'</fieldset></div></div></div></div></div>'
   );
  return $form;
}



/* implemented new html function */
function product_pricing_form($form, &$form_state){

	global $user;  
    $eid = arg(3);

	if($eid!="")
	{
		$values = getOverviewData($eid);
		if(empty($values))
		{
		drupal_set_message(t('No Listing data found'),'error');
		drupal_goto('product/add/overview');
		}
		else if($user->uid!=$values['uid']){

		drupal_set_message(t('You have not access to view Listing data'),'error');
		drupal_goto('product/add/overview');
		}
	}
	$pricingData = getPricingData($eid);
	$earlyBirdData=getDiscountInfo($eid,'Early Birds');
	$LastMinuteData=getDiscountInfo($eid,'Last Minute');
	$offer_24_Data=getDiscountInfo($eid,'24 Hour Offer');
	$listingData = getOverviewData($eid);
	
	
	//exit;
	$seasonalPrice=getListExtraPrice(arg(3));
	$pricingData = getPricingData($eid);
 
	$form['#attributes'] = array('onsubmit' => 'return pricingValidation();',
								'class' => 'Calenderform'
							);
 	$form['product_pricing'] = array(
		'#prefix' => '<fieldset class="col-lg-12 col-md-12 col-sm-22 col-xs-12 padding_left product_pricing_wrapper"><label>'.t('Standard rate').'</label>',
	  );
	$i = 1;
	
	if(count($pricingData)> 0){

		$form['product_pricing']['product_pricing_type'] = array(
			'#type' => 'select',
			'#prefix' => '<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 padding_left"><div class="selectbox">',
			'#default_value' => isset($pricingData[0]['price_type']) ? $pricingData[0]['price_type'] : NULL,
			'#attributes' => array(
			'onchange'=>'hide_clone();'
			),
			'#suffix'=>'</div></div>',
			/* ,'PER_DAY' => 'By Day','PER_HOUR'=>'By Hour','PER_MINUTE'=>'By Minute' ,'FIXED'=>'Fixed'*/
			'#options' => array('PER_PERSON'=>'By Person','PER_ITEM'=>'By Item')
		);
		
		//echo "<pre>";Print_r($pricingData);exit;
		foreach($pricingData as $key => $values)
		{
			$class = "";
			if($i>1){
				$class2='pricediv_clone col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_left';
			}
			if($i>1){$class = "product_pricing_extra";}
			if($values["price_type"] == "PER_PERSON"){
		
			  $form['product_pricing']['PriceOption[PER_PERSON]['.$i.'][price_option_type]'] = array(
				'#type' => 'select',
				'#prefix' => '<div class="product_pricing pricetype_options_PER_PERSON '.$class.' '.$class2.'" id="product_pricing_extra_'.$i.'"><div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 padding_left"><div class="selectbox">',
				'#default_value' => isset($values['price_option_type']) ? $values['price_option_type'] : NULL,
				'#attributes' => array(
					'class' => array('price-option-type'),'onchange'=>'val_price();',
						'data-type' => 'number',
    			  ),
				'#suffix'=>'</div></div>',
				'#options' => array('everyone'=>'Everyone','adult'=>'Adult','child'=>'Child','everyone'=>'Everyone',/* 'senior'=>'Senior','teenager'=>'Teenager','student'=>'Student','family-of-three'=>'Family of 3','family-of-four'=>'Family of 4','family-of-five'=>'Family of 5', 'group'=>'Group'*/)
			  );
			// echo drupal_render( $form['product_pricing']['PriceOption[PER_PERSON]['.$i.'][price_option_type]']);exit;
			  $form['product_pricing']['PriceOption[PER_PERSON]['.$i.'][price]'] = array(
				'#type' => 'textfield',
				'#prefix'=>'<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 padding_left">',
				'#suffix'=>'</div>',
				'#default_value' => isset($values['price']) ? $values['price'] : NULL,
				'#attributes' => array('placeholder'=>'Price','class' => array('themePrice','price_validate')),
			  );
			  
			  $form['product_pricing']['PriceOption[PER_PERSON]['.$i.'][priceID]'] = array(
				'#type' => 'hidden',
				'#default_value' => isset($values['id']) ? $values['id'] : NULL,
			  );
			  
			 
			if($i == 1){

				$form['product_pricing']['add_new_PER_PERSON'] = array(
					'#prefix' => '<div><a class="addPricing addanother" href="javascript:void(0);">Add more</a>',
					'#suffix' => '</div></div>',
				);	
			}
			else{
				$form['product_pricing']['remove_PER_PERSON'.$i] = array(
					'#prefix' => '<div><a class="removePricing removePricing_clone addanother" href="javascript:void(0);">Remove</a>',
					'#suffix' => '</div></div>',
				);					
			}
			

		}else{	

			if($i == 1){
			
			  $form['product_pricing']['PriceOption[PER_PERSON]['.$i.'][price_option_type]'] = array(
				'#type' => 'select',
				'#prefix' => '<div class="product_pricing pricetype_options_PER_PERSON"><div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 padding_left"><div class="selectbox">',
				'#default_value' => isset($values['price_option_type']) ? $values['price_option_type'] : NULL,
				  '#attributes' => array(
					'class' => array('price-option-type'),'onchange'=>'val_price();'
				  ),
				 '#suffix'=>'</div></div>',
				'#options' => array('everyone'=>'Everyone','adult'=>'Adult','child'=>'Child'/* ,'everyone'=>'Everyone','senior'=>'Senior','teenager'=>'Teenager','student'=>'Student','family-of-three'=>'Family of 3','family-of-four'=>'Family of 4','family-of-five'=>'Family of 5','group'=>'Group' */)
			  );
			  $form['product_pricing']['PriceOption[PER_PERSON]['.$i.'][price]'] = array(
				'#type' => 'textfield',
				'#prefix'=>'<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 padding_left">',
				'#suffix'=>'</div>',
				'#default_value' => isset($values['price']) ? $values['price'] : NULL,
				'#attributes' => array('placeholder'=>'Price','class' => array('themePrice','price_validate')),
			  );
			   $form['product_pricing']['add_new_PER_PERSON'] = array(
					'#prefix' => '<div><a class="addPricing addanother" href="javascript:void(0);">Add more</a>',
					'#suffix' => '</div></div>',
				);	
			}
		}
		if($values["price_type"] == "PER_ITEM"){
		
			  $form['product_pricing']['PriceOption[PER_ITEM]['.$i.'][label]'] = array(
				'#type' => 'textfield',
				'#prefix' => '<div class="product_pricing pricetype_options_PER_ITEM '.$class.' '.$class2.'"><div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 padding_left">',
				'#default_value' => isset($values['label']) ? $values['label'] : NULL,
				'#attributes' => array('placeholder'=>'Label','class' => array('price-label')),
				'#suffix'=>'</div>'
			  );
			  $form['product_pricing']['PriceOption[PER_ITEM]['.$i.'][priceID]'] = array(
				'#type' => 'hidden',
				'#default_value' => isset($values['id']) ? $values['id'] : NULL,
			  );
			  $form['product_pricing']['PriceOption[PER_ITEM]['.$i.'][price]'] = array(
				'#type' => 'textfield',
				'#prefix'=>'<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 padding_left">',
				'#default_value' => isset($values['price']) ? $values['price'] : NULL,
				'#attributes' => array('placeholder'=>'Price','class' => array('themePrice','price_validate')),
				'#suffix'=>'</div>'
			  );
			if($i == 1){

				$form['product_pricing']['add_new_PER_ITEM'] = array(
					'#prefix' => '<div><a class="addPricing addanother" href="javascript:void(0);">Add more</a>',
					'#suffix' => '</div></div>',
				);	
			}
			else{
				$form['product_pricing']['remove__PER_ITEM'.$i] = array(
					'#prefix' => '<div><a class="removePricing removePricing_clone delete" href="javascript:void(0);">Remove</a>',
					'#suffix' => '</div></div>',
				);					
			}

		}else{ 
	
			if($i == 1){
			
			  $form['product_pricing']['PriceOption[PER_ITEM]['.$i.'][label]'] = array(
				'#type' => 'textfield',
				'#prefix' => '<div class="product_pricing pricetype_options_PER_ITEM" ><div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 padding_left">',
				'#default_value' => isset($values['label']) ? $values['label'] : NULL,
				'#attributes' => array('placeholder'=>'Label','class' => array('price-label')),
				'#suffix'=>'</div>'
			  );

			  $form['product_pricing']['PriceOption[PER_ITEM]['.$i.'][price]'] = array(
				'#type' => 'textfield',
				'#prefix'=>'<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 padding_left">',
				'#default_value' => isset($values['price']) ? $values['price'] : NULL,
				'#attributes' => array('placeholder'=>'Price','class' => array('themePrice','price_validate')),
				'#suffix'=>'</div>'
			  );
				$form['product_pricing']['add_new_PER_ITEM'] = array(
					'#prefix' => '<div><a class="addPricing addanother" href="javascript:void(0);">Add more</a>',
					'#suffix' => '</div></div>',
				);				  
			}		
		}
		if($values["price_type"] == "FIXED"){
			
			  $form['product_pricing']['PriceOption[FIXED]['.$i.'][priceID]'] = array(
				'#type' => 'hidden',
				'#default_value' => isset($values['id']) ? $values['id'] : NULL,
			  );
			  $form['product_pricing']['PriceOption[FIXED]['.$i.'][price]'] = array(
				'#type' => 'textfield',
				'#prefix' => '<div class="product_pricing pricetype_options_FIXED '.$class.'"><div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 padding_left">',
				'#default_value' => isset($values['price']) ? $values['price'] : NULL,
				'#suffix' => '</div></div>',
				'#attributes' => array('placeholder'=>'Price','class' => array('themePrice','price_validate')),
			  );		
		}else{
			
			if($i ==1){
		
			  $form['product_pricing']['PriceOption[FIXED]['.$i.'][price]'] = array(
				'#type' => 'textfield',
				'#prefix' => '<div class="product_pricing pricetype_options_FIXED"><div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 padding_left">',
				'#default_value' => isset($values['price']) ? $values['price'] : NULL,
				'#suffix' => '</div></div>',
				'#attributes' => array('placeholder'=>'Price','class' => array('themePrice','price_validate')),
			  );
			//  echo drupal_render($form['product_pricing']['PriceOption[FIXED]['.$i.'][price]']);exit;
			 
			}
		}
		if($values["price_type"] == "PER_DAY"){	  
		
			  $form['product_pricing']['PriceOption[PER_DAY]['.$i.'][min]'] = array(
				'#type' => 'textfield',
				'#prefix' => '<div class="product_pricing pricetype_options_PER_DAY '.$class.'"><div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 padding_left">',
				'#default_value' => isset($values['min']) ? $values['min'] : NULL,
				'#attributes' => array('placeholder'=>'min','class' => array('day-min','price-min')),
				'#suffix'=>'</div>'
			  );
			  $form['product_pricing']['PriceOption[PER_DAY]['.$i.'][priceID]'] = array(
				'#type' => 'hidden',
				'#default_value' => isset($values['id']) ? $values['id'] : NULL,
			  );			  
			  $form['product_pricing']['PriceOption[PER_DAY]['.$i.'][max]'] = array(
				'#type' => 'textfield',
				'#prefix'=>'<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 padding_left">',
				'#suffix'=>'</div>',
				'#default_value' => isset($values['max']) ? $values['max'] : NULL,
				'#attributes' => array('placeholder'=>'max','class' => array('day-max','price-max')),
			  );
			  
			  $form['product_pricing']['PriceOption[PER_DAY]['.$i.'][price]'] = array(
				'#type' => 'textfield',
				'#prefix'=>'<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 padding_left">',
				'#suffix'=>'</div>',
				'#default_value' => isset($values['price']) ? $values['price'] : NULL,
				'#attributes' => array('placeholder'=>'Price','class' => array('themePrice','price_validate')),
			  );
			  
			  $form['product_pricing']['PriceOption[PER_DAY]['.$i.'][priceGroupType]'] = array(
				'#type' => 'select',
				'#default_value' => isset($values['price_group_type']) ? $values['price_group_type'] : NULL,
				  '#attributes' => array(
					'class' => array(''),
				  ),
				'#prefix'=>'<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 padding_left"><div class="selectbox">',
				'#suffix'=>'</div></div>',
				'#options' => array('EACH'=>'Per day','TOTAL'=>'Total')
			  );
			if($i == 1){
				$form['product_pricing']['add_new_PER_DAY'] = array(
					'#prefix' => '<div><a class="addPricing addanother" href="#">Add more</a>',
					'#suffix' => '</div></div>',
				);	
			}
			else{
				$form['product_pricing']['remove_PER_PER_DAY'.$i] = array(
					'#prefix' => '<div><a class="removePricing delete" href="#">Remove</a>',
					'#suffix' => '</div></div>',
				);					
			}

		}else{
		
			if($i == 1){
				$form['product_pricing']['PriceOption[PER_DAY]['.$i.'][min]'] = array(
				'#type' => 'textfield',
				'#prefix' => '<div class="product_pricing pricetype_options_PER_DAY"><div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 padding_left">',
				'#default_value' => isset($values['min']) ? $values['min'] : NULL,
				'#attributes' => array('placeholder'=>'min','class' => array('day-min','price-min')),
				'#suffix'=>'</div>'
				);
			  
			  $form['product_pricing']['PriceOption[PER_DAY]['.$i.'][max]'] = array(
				'#type' => 'textfield',
				'#prefix'=>'<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 padding_left">',
				'#suffix'=>'</div>',
				'#default_value' => isset($values['max']) ? $values['max'] : NULL,
				'#attributes' => array('placeholder'=>'max','class' => array('day-max','price-max')),
			  );
			  
			  $form['product_pricing']['PriceOption[PER_DAY]['.$i.'][price]'] = array(
				'#type' => 'textfield',
				'#prefix'=>'<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 padding_left">',
				'#suffix'=>'</div>',
				'#default_value' => isset($values['price']) ? $values['price'] : NULL,
				'#attributes' => array('placeholder'=>'Price','class' => array('themePrice','price_validate')),
			  );
			  
			  $form['product_pricing']['PriceOption[PER_DAY]['.$i.'][priceGroupType]'] = array(
				'#type' => 'select',
				'#prefix'=>'<div class="col-lg-3 col-md-3  col-sm-6 col-xs-12 padding_left"><div class="selectbox">',
				'#suffix'=>'</div></div>',
				'#default_value' => isset($values['price_group_type']) ? $values['price_group_type'] : NULL,
				  '#attributes' => array(
					'class' => array(''),
				  ),
				'#options' => array('EACH'=>'Per day','TOTAL'=>'Total')
			  );
				$form['product_pricing']['add_new_PER_DAY'] = array(
					'#prefix' => '<div><a class="addPricing addanother" href="#">Add more</a>',
					'#suffix' => '</div></div>',
				);
		
			}
		}
		if($values["price_type"] == "PER_HOUR"){
		
			  $form['product_pricing']['PriceOption[PER_HOUR]['.$i.'][min]'] = array(
				'#type' => 'textfield',
				'#prefix' => '<div class="product_pricing pricetype_options_PER_HOUR '.$class.'"><div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 padding_left">',
				'#default_value' => isset($values['min']) ? $values['min'] : NULL,
				'#attributes' => array('placeholder'=>'min','class' => array('hour-min','price-min')),
				'#suffix'=>'</div>'
			  );
			  $form['product_pricing']['PriceOption[PER_HOUR]['.$i.'][priceID]'] = array(
				'#type' => 'hidden',
				'#default_value' => isset($values['id']) ? $values['id'] : NULL,
			  );				  
			  $form['product_pricing']['PriceOption[PER_HOUR]['.$i.'][max]'] = array(
				'#type' => 'textfield',
				'#prefix'=>'<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 padding_left">',
				'#suffix'=>'</div>',
				'#default_value' => isset($values['max']) ? $values['max'] : NULL,
				'#attributes' => array('placeholder'=>'max','class' => array('hour-max','price-max')),
			  );
			  
			  $form['product_pricing']['PriceOption[PER_HOUR]['.$i.'][price]'] = array(
				'#type' => 'textfield',
				'#prefix'=>'<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 padding_left">',
				'#suffix'=>'</div>',
				'#default_value' => isset($values['price']) ? $values['price'] : NULL,
				'#attributes' => array('placeholder'=>'Price','class' => array('themePrice','price_validate')),
			  );
			  
			  $form['product_pricing']['PriceOption[PER_HOUR]['.$i.'][priceGroupType]'] = array(
				'#type' => 'select',
				'#prefix'=>'<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 padding_left"><div class="selectbox">',
				'#suffix'=>'</div></div>',
				'#default_value' => isset($values['price_group_type']) ? $values['price_group_type'] : NULL,
				  '#attributes' => array(
					'class' => array(''),
				  ),
				'#options' => array('EACH'=>'Per hour','TOTAL'=>'Total')
			  );		
			if($i == 1){
				$form['product_pricing']['add_new_PER_HOUR'] = array(
					'#prefix' => '<div class="col-lg-1 col-md-1 col-sm-2 col-xs-12 padding_left"><a class="addPricing addanother" href="#">Add more</a>',
					'#suffix' => '</div></div>',
				);	
			}
			else{
				$form['product_pricing']['remove_PER_HOUR'.$i] = array(
					'#prefix' => '<div class="col-lg-1 col-md-1 col-sm-2 col-xs-12 padding_left"><a class="removePricing delete" href="#">Remove</a>',
					'#suffix' => '</div></div>',
				);					
			}
		}else{	
			if($i == 1){
			  $form['product_pricing']['PriceOption[PER_HOUR]['.$i.'][min]'] = array(
				'#type' => 'textfield',
				'#prefix'=>'<div class="product_pricing pricetype_options_PER_HOUR"><div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 padding_left">',
				'#suffix'=>'</div>',
				'#default_value' => isset($values['min']) ? $values['min'] : NULL,
				'#attributes' => array('placeholder'=>'min','class' => array('hour-min','price-min')),
			  );
			  
			  $form['product_pricing']['PriceOption[PER_HOUR]['.$i.'][max]'] = array(
				'#type' => 'textfield',
				'#prefix'=>'<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 padding_left">',
				'#suffix'=>'</div>',
				'#default_value' => isset($values['max']) ? $values['max'] : NULL,
				'#attributes' => array('placeholder'=>'max','class' => array('hour-max','price-max')),
			  );
			  
			  $form['product_pricing']['PriceOption[PER_HOUR]['.$i.'][price]'] = array(
				'#type' => 'textfield',
				'#prefix'=>'<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 padding_left">',
				'#suffix'=>'</div>',
				'#default_value' => isset($values['price']) ? $values['price'] : NULL,
				'#attributes' => array('placeholder'=>'Price','class' => array('themePrice','price_validate')),
			  );
			  
			  $form['product_pricing']['PriceOption[PER_HOUR]['.$i.'][priceGroupType]'] = array(
				'#type' => 'select',
				'#prefix'=>'<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 padding_left"><div class="selectbox">',
				'#suffix'=>'</div></div>',
				'#default_value' => isset($values['price_group_type']) ? $values['price_group_type'] : NULL,
				  '#attributes' => array(
					'class' => array(''),
				  ),
				'#options' => array('EACH'=>'Per hour','TOTAL'=>'Total')
			  );
				$form['product_pricing']['add_new_PER_HOUR'] = array(
					'#prefix' => '<div class="col-lg-1 col-md-1 col-sm-2 col-xs-12 padding_left"><a class="addPricing addanother" href="#">Add more</a>',
					'#suffix' => '</div></div>',
				);
			}
		}
		
		if($values["price_type"] == "PER_MINUTE"){
		
			  $form['product_pricing']['PriceOption[PER_MINUTE]['.$i.'][min]'] = array(
				'#type' => 'textfield',
				'#prefix' => '<div class="product_pricing pricetype_options_PER_MINUTE '.$class.'"><div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 padding_left">',
				'#default_value' => isset($values['min']) ? $values['min'] : NULL,
				'#attributes' => array('placeholder'=>'min','class' => array('minute-min','price-min')),
				'#suffix'=>'</div>'
			 );
			  $form['product_pricing']['PriceOption[PER_MINUTE]['.$i.'][priceID]'] = array(
				'#type' => 'hidden',
				'#default_value' => isset($values['id']) ? $values['id'] : NULL,
			  );				  
			  $form['product_pricing']['PriceOption[PER_MINUTE]['.$i.'][max]'] = array(
				'#type' => 'textfield',
				'#prefix'=>'<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 padding_left">',
				'#suffix'=>'</div>',
				'#default_value' => isset($values['max']) ? $values['max'] : NULL,
				'#attributes' => array('placeholder'=>'max','class' => array('minute-max','price-max')),
			  );
			  
			  $form['product_pricing']['PriceOption[PER_MINUTE]['.$i.'][price]'] = array(
				'#type' => 'textfield',
				'#prefix'=>'<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 padding_left">',
				'#suffix'=>'</div>',
				'#default_value' => isset($values['price']) ? $values['price'] : NULL,
				'#attributes' => array('placeholder'=>'Price','class' => array('themePrice','price_validate')),
			  );
			  
			  $form['product_pricing']['PriceOption[PER_MINUTE]['.$i.'][priceGroupType]'] = array(
				'#type' => 'select',
				'#prefix'=>'<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 padding_left"><div class="selectbox">',
				'#suffix'=>'</div></div>',
				'#default_value' => isset($values['price_group_type']) ? $values['price_group_type'] : NULL,
				  '#attributes' => array(
					'class' => array(''),
				  ),
				'#options' => array('EACH'=>'Per minute','TOTAL'=>'Total')
			  );	
			if($i == 1){
				$form['product_pricing']['add_new_PER_MINUTE'] = array(
					'#prefix' => '<div><a class="addPricing addanother" href="#">Add more</a>',
					'#suffix' => '</div></div>',
				);	
			}
			else{
				$form['product_pricing']['remove_PER_MINUTE'.$i] = array(
					'#prefix' => '<div><a class="removePricing delete" href="#">Remove</a>',
					'#suffix' => '</div></div>',
				);					
			}
		}else{ 
			if($i == 1){
			  $form['product_pricing']['PriceOption[PER_MINUTE]['.$i.'][min]'] = array(
				'#type' => 'textfield',
				'#prefix'=>'<div class="product_pricing pricetype_options_PER_MINUTE"><div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 padding_left">',
				'#suffix'=>'</div>',
				'#default_value' => isset($values['min']) ? $values['min'] : NULL,
				'#attributes' => array('placeholder'=>'min','class' => array('minute-min','price-min')),
			  );
			  
			  $form['product_pricing']['PriceOption[PER_MINUTE]['.$i.'][max]'] = array(
				'#type' => 'textfield',
				'#prefix'=>'<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 padding_left">',
				'#suffix'=>'</div>',
				'#default_value' => isset($values['max']) ? $values['max'] : NULL,
				'#attributes' => array('placeholder'=>'max','class' => array('minute-max','price-max')),
			  );
			  
			  $form['product_pricing']['PriceOption[PER_MINUTE]['.$i.'][price]'] = array(
				'#type' => 'textfield',
				'#prefix'=>'<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 padding_left">',
				'#suffix'=>'</div>',
				'#default_value' => isset($values['price']) ? $values['price'] : NULL,
				'#attributes' => array('placeholder'=>'Price','class' => array('themePrice','price_validate')),
			  );
			  
			  $form['product_pricing']['PriceOption[PER_MINUTE]['.$i.'][priceGroupType]'] = array(
				'#type' => 'select',
				'#prefix'=>'<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 padding_left"><div class="selectbox">',
				'#suffix'=>'</div></div>',
				'#default_value' => isset($values['price_group_type']) ? $values['price_group_type'] : NULL,
				  '#attributes' => array(
					'class' => array(''),
				  ),
				'#options' => array('EACH'=>'Per minute','TOTAL'=>'Total')
			  );	
			  $form['product_pricing']['add_new_PER_MINUTE'] = array(
					'#prefix' => '<div><a class="addPricing addanother" href="#">Add more</a>',
					'#suffix' => '</div></div>',
			  );	
			}
		}
		
		$i++;		
		}
	}else{
			$form['product_pricing']['product_pricing_type'] = array(
			'#type' => 'select',
			'#prefix' => '<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 padding_left"><div class="selectbox">',
			'#default_value' => isset($pricingData[0]['price_type']) ? $pricingData[0]['price_type'] : NULL,
			'#attributes' => array(
			'class' => array(''),'onchange'=>'hide_clone();'
			),
			'#suffix'=>'</div></div>',
			/* ,'PER_DAY' => 'By Day','PER_HOUR'=>'By Hour','PER_MINUTE'=>'By Minute','FIXED'=>'Fixed' */
			'#options' => array('PER_PERSON'=>'By Person','PER_ITEM'=>'By Item')
			);
		
		
				$form['product_pricing']['PriceOption[PER_PERSON][1][price_option_type]'] = array(
				'#type' => 'select',
				'#prefix' => '<div class="product_pricing pricetype_options_PER_PERSON"><div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 padding_left"><div class="selectbox">',
				'#default_value' => isset($values['price_option_type']) ? $values['price_option_type'] : NULL,
				  '#attributes' => array(
					'class' => array('price-option-type','select_box'),'onchange'=>'val_price();'
				  ),
				 '#suffix'=>'</div></div>',
				'#options' => array('everyone'=>'Everyone','adult'=>'Adult','child'=>'Child'/* ,'everyone'=>'Everyone','senior'=>'Senior','teenager'=>'Teenager','student'=>'Student','family-of-three'=>'Family of 3','family-of-four'=>'Family of 4','family-of-five'=>'Family of 5','group'=>'Group' */)
			  );
			  $form['product_pricing']['PriceOption[PER_PERSON][1][price]'] = array(
				'#type' => 'textfield',
				'#prefix'=>'<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 padding_left">',
				'#suffix'=>'</div>',
				'#default_value' => isset($values['price']) ? $values['price'] : NULL,
				'#attributes' => array('placeholder'=>'Price','class' => array('themePrice','price_validate')),
			  );
			   $form['product_pricing']['add_new_PER_PERSON'] = array(
					'#prefix' => '<div><a class="addPricing addanother" href="#">Add more</a>',
					'#suffix' => '</div></div>',
				);
		 
				$form['product_pricing']['PriceOption[PER_ITEM][1][label]'] = array(
				'#type' => 'textfield',
				'#prefix' => '<div class="product_pricing pricetype_options_PER_ITEM" ><div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 padding_left">',
				'#default_value' => isset($values['label']) ? $values['label'] : NULL,
				'#attributes' => array('placeholder'=>'Label','class' => array('price-label')),
				'#suffix'=>'</div>'
				);

				$form['product_pricing']['PriceOption[PER_ITEM][1][price]'] = array(
				'#type' => 'textfield',
				'#prefix'=>'<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 padding_left">',
				'#default_value' => isset($values['price']) ? $values['price'] : NULL,
				'#attributes' => array('placeholder'=>'Price','class' => array('themePrice','price_validate')),
				'#suffix'=>'</div>'
				);
				$form['product_pricing']['add_new_PER_ITEM'] = array(
					'#prefix' => '<div><a class="addPricing addanother" href="#">Add more</a>',
					'#suffix' => '</div></div>',
				);		
		
		   $form['product_pricing']['PriceOption[FIXED][1][price]'] = array(
				'#type' => 'textfield',
				'#prefix' => '<div class="product_pricing pricetype_options_FIXED"><div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 padding_left">',
				'#default_value' => isset($values['price']) ? $values['price'] : NULL,
				'#suffix' => '</div></div>',
				'#attributes' => array('placeholder'=>'Price','class' => array('themePrice','price_validate')),
			  );
		
		  $form['product_pricing']['PriceOption[PER_DAY][1][min]'] = array(
			'#type' => 'textfield',
			'#prefix' => '<div class="product_pricing pricetype_options_PER_DAY">',
			'#default_value' => isset($values['product_pricing_min']) ? $values['product_pricing_min'] : NULL,
			'#attributes' => array('placeholder'=>'min','class' => array('day-min','price-min')),
		  );
		  
		  $form['product_pricing']['PriceOption[PER_DAY][1][max]'] = array(
			'#type' => 'textfield',
			'#default_value' => isset($values['product_pricing_max']) ? $values['product_pricing_max'] : NULL,
			'#attributes' => array('placeholder'=>'max','class' => array('day-max','price-max')),
		  );
		  
		  $form['product_pricing']['PriceOption[PER_DAY][1][price]'] = array(
			'#type' => 'textfield',
			'#default_value' => isset($values['product_pricing_value']) ? $values['product_pricing_value'] : NULL,
			'#attributes' => array('placeholder'=>'Price','class' => array('themePrice','price_validate')),
		  );
		  
		  $form['product_pricing']['PriceOption[PER_DAY][1][priceGroupType]'] = array(
			'#type' => 'select',
			'#default_value' => isset($values['product_pricing_day_type']) ? $values['product_pricing_day_type'] : NULL,
			  '#attributes' => array(
				'class' => array('select_box'),
			  ),
			'#options' => array('EACH'=>'Per day','TOTAL'=>'Total')
		  );

			$form['product_pricing']['add_new1_PER_DAY'] = array(
				'#prefix' => '<div><a class="addanother addPricing" href="#">Add more</a>',
				'#suffix' => '</div></div>',
			);	
			
		  $form['product_pricing']['PriceOption[PER_HOUR][1][min]'] = array(
			'#type' => 'textfield',
			'#prefix' => '<div class="product_pricing pricetype_options_PER_HOUR">',
			'#default_value' => isset($values['product_pricing_min']) ? $values['product_pricing_min'] : NULL,
			'#attributes' => array('placeholder'=>'min','class' => array('hour-min','price-min')),
		  );
		  
		  $form['product_pricing']['PriceOption[PER_HOUR][1][max]'] = array(
			'#type' => 'textfield',
			'#default_value' => isset($values['product_pricing_max']) ? $values['product_pricing_max'] : NULL,
			'#attributes' => array('placeholder'=>'max','class' => array('hour-max','price-max')),
		  );
		  
		  $form['product_pricing']['PriceOption[PER_HOUR][1][price]'] = array(
			'#type' => 'textfield',
			'#default_value' => isset($values['product_pricing_value']) ? $values['product_pricing_value'] : NULL,
			'#attributes' => array('placeholder'=>'Price','class' => array('themePrice','price_validate')),
		  );
		  
		  $form['product_pricing']['PriceOption[PER_HOUR][1][priceGroupType]'] = array(
			'#type' => 'select',
			'#default_value' => isset($values['product_pricing_day_type']) ? $values['product_pricing_day_type'] : NULL,
			  '#attributes' => array(
				'class' => array('select_box'),
			  ),
			'#options' => array('EACH'=>'Per hour','TOTAL'=>'Total')
		  );

			$form['product_pricing']['add_new1_PER_HOUR'] = array(
				'#prefix' => '<div><a class="addPricing addanother" href="#">Add more</a>',
				'#suffix' => '</div></div>',
			);	
			
		  $form['product_pricing']['PriceOption[PER_MINUTE][1][min]'] = array(
			'#type' => 'textfield',
			'#prefix' => '<div class="product_pricing pricetype_options_PER_MINUTE">',
			'#default_value' => isset($values['product_pricing_min']) ? $values['product_pricing_min'] : NULL,
			'#attributes' => array('placeholder'=>'min','class' => array('minute-min','price-min')),
		  );
		  
		  $form['product_pricing']['PriceOption[PER_MINUTE][1][max]'] = array(
			'#type' => 'textfield',
			'#default_value' => isset($values['product_pricing_max']) ? $values['product_pricing_max'] : NULL,
			'#attributes' => array('placeholder'=>'max','class' => array('minute-max','price-max')),
		  );
		  
		  $form['product_pricing']['PriceOption[PER_MINUTE][1][price]'] = array(
			'#type' => 'textfield',
			'#default_value' => isset($values['product_pricing_value']) ? $values['product_pricing_value'] : NULL,
			'#attributes' => array('placeholder'=>'Price','class' => array('themePrice','price_validate')),
		  );
		  
		  $form['product_pricing']['PriceOption[PER_MINUTE][1][priceGroupType]'] = array(
			'#type' => 'select',
			'#default_value' => isset($values['product_pricing_day_type']) ? $values['product_pricing_day_type'] : NULL,
			  '#attributes' => array(
				'class' => array('select_box'),
			  ),
			'#options' => array('EACH'=>'Per minute','TOTAL'=>'Total')
		  );		  
		  
			$form['product_pricing']['add_new1_PER_MINUTE'] = array(
					'#prefix' => '<div><a class="addPricing addanother" href="#">Add more</a>',
					'#suffix' => '</div></div>',
				);	
			
	}
	$form['product_pricing']['HTML'] = array(
		'#type' => 'markup',
		'#suffix' => '</fieldset>',
		);
		
  
  $form['product_pricing']['currency_type']=array(
            '#type'=>'select',
			'#prefix' => '<fieldset><label>Currency Type </label><div class="selectbox">',
			'#options' => array('USD'=>'USD'),
			'#suffix' => '</div></fieldset>',
	);
  
 $form['product_pricing']['quantity-heading'] = array(
    '#prefix' => '<fieldset>',
   
  );
  
  $form['product_pricing']['product_pricing_quantity'] = array(
    '#type' => 'select',
	//'#title' => 'Quantity',
	'#prefix' => '<div class="quantity product_pricing_quantity"><div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding_left"><label>'.t('Quantity').'</label><div class="selectbox">',
    '#default_value' => isset($values['quantity_required']) ? $values['quantity_required'] : NULL,
	  '#attributes' => array(
		'class' => array('select_box'),
		'onchange'=>'default_quanity(this.selectedIndex);'
	  ),
	'#suffix'=>'</div></div>',
	'#options' => array('No Quantity Required','Quantity Required')
  ); 
  
  $form['product_pricing']['quantity_min'] = array(
    '#type' => 'textfield',
	'#title' => 'Min.',
	'#prefix'=>'<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 padding_left">',
	  '#attributes' => array('placeholder'=>'Min.',
		'class' => array(''),
	  ),
	  '#suffix' => '</div>',
    '#default_value' => isset($values['quantity_min']) ? $values['quantity_min'] : NULL,
  );
  
  $form['product_pricing']['quantity_max'] = array(
    '#type' => 'textfield',
    '#title' => 'Max.',
	'#prefix'=>'<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 padding_left">',
    '#default_value' => isset($values['quantity_max']) ? $values['quantity_max'] : NULL,
	  '#attributes' => array('placeholder'=>'Max.',
		'class' => array(''),
	  ),
	  	'#suffix' => '</div></div></fieldset>',
  );
  /*SeSSional Price*/
 $i=1; 
 if($seasonalPrice)
 { 
 $form['product_pricing']['product_pricing_seosanal'] = array(
    '#prefix' => '<fieldset><label><div class="checkbox"><input type="checkbox" name="seosonal-pricing" id="seosonal-pricing" checked="checked">',
   '#suffix' => '</div>'.t('Seasonal Prices').'</label></fieldset>',
  );
 foreach($seasonalPrice as $price)
 {
 $form['product_pricing']['season_rate['.$i.'][label]'] = array(
    '#type' => 'textfield',
	'#prefix' => '<fieldset class="col-lg-12 col-md-12 col-sm-22 col-xs-12 padding_left product_season_rate"><div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 padding_left product_season_rate" id="product_season_rate">',
	//'#title' => t('Rate Label').'<span class="form-required"> *<span>', 
    '#default_value' => isset($price['rate_label']) ? $price['rate_label'] : NULL,
	'#attributes' => array('placeholder'=>'Rate Label','class' => array('')),
	'#suffix'=>'</div>'
	
  );
  $form['product_pricing']['season_rate['.$i.'][price]'] = array(
    '#type' => 'textfield',
	//'#title' => t('Rate Price').'<span class="form-required"> *<span>', 
    '#default_value' => isset($price['rate_price']) ? $price['rate_price'] : NULL,
	'#attributes' => array('placeholder'=>'Rate Price','class' => array('themePrice','price_validate')),
	'#prefix'=>'<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 padding_left special-price">',
	'#suffix'=>'</div>'
  );
  $form['product_pricing']['season_rate['.$i.'][from-to]'] = array(
    '#type' => 'textfield',
    //'#title' => t('From - To').'<span class="form-required"> *<span>', 
	  '#attributes' => array('placeholder'=>'From - To',
		'class' => array('daterangepicker2'),
	  ),
    '#default_value' => isset($price['from_to_date']) ? $price['from_to_date'] : NULL,
	'#prefix'=>'<div class="col-lg-5 col-md-5 col-sm-8 col-xs-12 padding_left seosonal-date-price">',
	'#suffix'=>'</div>'
  );
		$form['product_pricing']['season_rate['.$i.'][priceID]'] = array(
		'#type' => 'hidden',
		'#default_value' => isset($price['sid']) ? $price['sid'] : NULL,
		); 
	    if($i==1)
	    {
	    $form['product_pricing']['add_new'] = array(
			'#prefix' => '<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 padding_left"><a class="addanother" href="javascript:void(0)" id="addRate">Add Rate</a>',
			'#suffix' => '</div></fieldset>',
		);
		}
		else
		{
		$form['product_pricing']['rem_new'.$i] = array(
			'#prefix' => '<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 padding_left"><a class="delete" href="javascript:void(0)" id="remRate">Remove Rate</a>',
			'#suffix' => '</div></fieldset>',
		);
		}
	$i++;
   }
   $form['product_pricing']['removed-pricing']=array(
   '#type' => 'hidden',
   '#default_value'=>'',
    '#attributes' => array('id' => 'removed-pricing'),
   
   );
   $form['product_pricing']['clone-pricing']=array(
   '#prefix'=>'<div id="product_season_rate_clone">',
   '#suffix'=>'</div>'
   );
   
  }else{
	  $form['product_pricing']['product_pricing_seosanal'] = array(
		'#prefix' => '<div><input type="checkbox" name="seosonal-pricing" id="seosonal-pricing"><h5>Seasonal Prices</h5>',
		'#suffix' => '</div>',
	  );
  $form['product_pricing']['season_rate[0][label]'] = array(
    '#type' => 'textfield',
	'#prefix' => '<fieldset class="col-lg-12 col-md-12 col-sm-22 col-xs-12 padding_left product_season_rate"><div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 padding_left product_season_rate" id="product_season_rate">',
	
	'#default_value' => isset($pricingData['season_rate_label']) ? $pricingData['season_rate_label'] : NULL,
	'#attributes' => array('placeholder'=>'Rate Label','class' => array('')),
	'#suffix'=>'</div>'
  );
   $form['product_pricing']['season_rate[0][price]'] = array(
    '#type' => 'textfield',
	'#default_value' => isset($pricingData['season_rate_amount']) ? $pricingData['season_rate_amount'] : NULL,
	'#attributes' => array('placeholder'=>'Rate Price','class' => array('themePrice','price_validate')),
	'#prefix'=>'<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 padding_left special-price">',
	'#suffix'=>'</div>'
  );
  $form['product_pricing']['season_rate[0][from-to]'] = array(
    '#type' => 'textfield',
    '#attributes' => array('placeholder'=>'From - To',
		'class' => array('daterangepicker2'),
	  ),
	'#prefix'=>'<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 padding_left special-price">',
	'#suffix'=>'</div>',
    '#default_value' => isset($pricingData['high_season_rate_dates']) ? $pricingData['high_season_rate_dates'] : NULL,
  );
  $form['product_pricing']['add_new'] = array(
		'#prefix' => '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 padding_left"><a class="addanother" href="#" id="addRate">Add Rate</a>',
		'#suffix' => '</div></fieldset>',
	);
 $form['product_pricing']['clone-pricing']=array(
   '#prefix'=>'<div id="product_season_rate_clone">',
   '#suffix'=>'</div>'
   );
  } 
  /*End SeSSional Price*/
  
  $form['product_pricing']['offers_and_discounts'] = array(
    '#prefix' => '<fieldset><label>Offers & Discounts </label>',
     '#suffix' => '<div class="col-lg-1 col-lg-1 col-md-2 col-sm-2 padding_left"><img width="40" height="98" alt="image" src="'.$GLOBALS["base_url"].'/'. drupal_get_path("theme",$GLOBALS["theme"]).'/images/offer-icon-3.png"></div>', 
  );
  
   if($earlyBirdData)
  { 

	  $form['product_pricing']['early_birds'] = array(
		'#prefix' => '<div class="col-lg-11 col-md-10 col-sm-10 col-xs-12 padding_left"><fieldset><label><div class="checkbox"><input type="checkbox" name="early_birds_check"  id= "early_birds_check" value="early-bird" checked></div>Early Birds Discounts</label>',

	  );
	 
 }
  else
  { 
	 $form['product_pricing']['early_birds'] = array(
		'#prefix' => '<div class="col-lg-11 col-md-10 col-sm-10 col-xs-12 padding_left"><fieldset><label><div class="checkbox"><input type="checkbox" name="early_birds_check"  id= "early_birds_check" value="early-bird" ></div>Early Birds Discounts</label>',

	  );
	  $class="early-birds-hide";
  } 

  $form['product_pricing']['early_birds_time_value'] = array(
		'#type' => 'textfield',	
		
		'#prefix' => '<div id="early_bird_discount"><div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 padding_left early-birds primary '.$class.'">',
		'#attributes' => array('placeholder'=>'Days or Months',
			'class' => array(''),
			'onblur'=>'validate_earlybirdtime();'
		),
		'#suffix'=>'<p>'.t('If booking is made').'</p></div>',
		'#default_value' => isset($earlyBirdData['time_value']) ? $earlyBirdData['time_value'] : NULL,
  );
 
  $form['product_pricing']['early_birds_time_type'] = array(
    '#type' => 'select',
	'#attributes' => array(
		'class' => array('select_box'),
		'onchange'=>'validate_earlybirdtime();'
	),
	'#prefix'=>'<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 padding_left"><div class="selectbox">',
	'#suffix'=>'</div><p></p><p></p></div>',
    '#default_value' => isset($earlyBirdData['time_key']) ? $earlyBirdData['time_key'] : NULL,
	'#options' => array('day'=>'Day','week'=>'Week','month'=>'Month'),
  );

  $form['product_pricing']['early_birds_price_value'] = array(
    '#type' => 'textfield',
	'#prefix'=>'<div class="col-lg-2 col-md-6 col-sm-12 col-xs-12 padding_left">',
	'#suffix'=>'<p>'.t('prior to arrival apply discount of ').'</p></div>',
	'#attributes' => array('placeholder'=>'Price',
		'class' => array('themePrice'),
	),
    
    '#default_value' => isset($earlyBirdData['amount']) ? $earlyBirdData['amount'] : NULL,
  );
  
  $form['product_pricing']['early_birds_price_type'] = array(
    '#type' => 'select',
	'#attributes' => array(
		'class' => array('select_box'),
	),
	'#prefix'=>'<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 padding_left"><div class="selectbox">',
	'#suffix'=>'</div><p>'.t('on total Amount').'</p></div></fieldset></div></fieldset>',
    '#default_value' => isset($earlyBirdData['discount_by']) ? $earlyBirdData['discount_by'] : NULL,
	'#options' => array('%'=>'Amount in %','$'=>'Amount in $'),
	
  );
  
  $form['product_pricing']['offers_and_discounts_lastminute'] = array(
    '#prefix' => '<fieldset><label>Offers & Discounts </label>',
     '#suffix' => '<div class="col-lg-1 col-lg-1 col-md-2 col-sm-2 padding_left"><img width="40" height="98" alt="image" src="'.$GLOBALS["base_url"].'/'. drupal_get_path("theme",$GLOBALS["theme"]).'/images/offer-icon-2.png"></div>', 
  );
  if(!empty($LastMinuteData)){
	  $form['product_pricing']['last_minutes'] = array(
		'#prefix' => '<div class="col-lg-11 col-md-10 col-sm-10 col-xs-12 padding_left"><fieldset><label><div class="checkbox"><input type="checkbox" name="last_minutes_check" id="last_minutes_check" value="last-minute" checked>',
		'#suffix' => '</div>Last Minute Discounts</label>',
	  ); 
  }else{
	  $form['product_pricing']['last_minutes'] = array(
		'#prefix' => '<div class="col-lg-11 col-md-10 col-sm-10 col-xs-12 padding_left"><fieldset><label><div class="checkbox"><input type="checkbox" name="last_minutes_check" id="last_minutes_check" value="last-minute">',
		'#suffix' => '</div>Last Minute Discounts</label>',
	  ); 
  }
 
	  $form['product_pricing']['last_minutes_time_value'] = array(
		'#type' => 'textfield',
		'#prefix' => '<div id="last_minutes_disscount" class="early-birds last_minutes"><div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 padding_left">',
		  
		  '#attributes' => array('placeholder'=>'Days or Hours',
			'class' => array(''),
			'onblur'=>'validate_lastminutetime();'
		  ),
		  '#suffix'=>'<p>If booking is made</p></div>',
		'#default_value' => isset($LastMinuteData['time_value']) ? $LastMinuteData['time_value'] : NULL,
	  );
	 
	  $form['product_pricing']['last_minutes_time_type'] = array(
		'#type' => 'select',
		'#prefix'=>'<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 padding_left"><div class="selectbox">',
		'#attributes' => array(
			'class' => array('select_box'),
			'onchange'=>'validate_lastminutetime();'
		),
		
		'#default_value' => isset($LastMinuteData['time_key']) ? $LastMinuteData['time_key'] : NULL,
		'#options' => array('hour'=>'hour','day'=>'day'),
		'#suffix'=>'</div><p></p><p></p></div>',
	  );

	  $form['product_pricing']['last_minutes_price_value'] = array(
		'#type' => 'textfield',
		'#attributes' => array('placeholder'=>'Price',
			'class' => array('themePrice'),
		), 
	   '#prefix'=>'<div class="col-lg-2 col-md-6 col-sm-12 col-xs-12 padding_left">',
		'#suffix'=>'<p>prior to arrival apply discount of</p></div>',
		'#default_value' => isset($LastMinuteData['amount']) ? $LastMinuteData['amount'] : NULL,
	  );
	  
	  $form['product_pricing']['last_minutes_price_type'] = array(
		'#type' => 'select',
		'#prefix'=>'<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 padding_left"><div class="selectbox">',
		'#attributes' => array(
			'class' => array('select_box'),
		),
		'#default_value' => isset($LastMinuteData['discount_by']) ? $LastMinuteData['discount_by'] : NULL,
	'#options' => array('%'=>'Amount in %','$'=>'Amount in $'),
	'#suffix' => '</div><p>'.t('on total Amount').'</p></div></div></div></fieldset>',
  );			
  
  $form['product_pricing']['offers_and_discounts_24hour'] = array(
    '#prefix' => '<fieldset><label>Offers & Discounts </label>',
     '#suffix' => '<div class="col-lg-1 col-lg-1 col-md-2 col-sm-2 padding_left"><img width="40" height="98" alt="image" src="'.$GLOBALS["base_url"].'/'. drupal_get_path("theme",$GLOBALS["theme"]).'/images/offer-icon.png"></div>', 
  );
  if(!empty($offer_24_Data))
  {
	  $form['product_pricing']['24_hour_offer'] = array(
		'#prefix' => '<div class="col-lg-11 col-md-10 col-sm-10 col-xs-12 padding_left"><fieldset><label><div class="checkbox checkbox_2"><input type="checkbox" name="24_hour_offer_check" id="24_hour_offer_check" value="24_hour_offer" checked></div>24 hour Discounts</label>',
		'#suffix' => '</div>',
	  );
  }
  else
  {
 
  $form['product_pricing']['24_hour_offer'] = array(
		'#prefix' => '<div class="col-lg-11 col-md-10 col-sm-10 col-xs-12 padding_left"><fieldset><label><div class="checkbox checkbox_2"><input type="checkbox" name="24_hour_offer_check" id="24_hour_offer_check" value=""></div>24 hour Discounts</label>',
		'#suffix' => '</div>',
	  );
  }
		$priceData=unserialize($offer_24_Data['amount']);
		$dateData=unserialize($offer_24_Data['date']);
		$form['product_pricing']['24_hour_offer']['offer_24_hour_offer_date'] = array(
		'#type' => 'textfield',
		'#prefix' => '<div id="24_hours_disscount"><div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 padding_left">',
		  '#attributes' => array('placeholder'=>'Date',
			'class' => array('datepicker'),
			'onblur'=>'Validate24hours_type();'
		  ),
		  '#suffix'=>'<p class="pre_small_text">If booking is made</p></div>',
		  '#default_value' => isset($dateData['offer_24_hour_offer_date']) ? $dateData['offer_24_hour_offer_date'] : NULL,
		);
  $form['product_pricing']['24_hour_offer']['offer_24_hour_price_value'] = array(
    '#type' => 'textfield',
	'#attributes' => array('placeholder'=>'Price'),
	'#prefix'=>'<div class="col-lg-2 col-md-6 col-sm-6 col-xs-12 padding_left">',
	'#suffix'=>'<p>apply discount of</p></div>',
	'#default_value' => isset($priceData['offer_24_hour_price_value']) ? $priceData['offer_24_hour_price_value'] : NULL,
  );
  
   $form['product_pricing']['24_hour_offer']['24_hour_offer_price_type'] = array(
    '#type' => 'select',
	'#prefix'=>'<div class="col-lg-4 col-md-6 col-sm-7 col-xs-12 padding_left"><div class="selectbox">',
	'#suffix'=>'</div><p>'.t('on total Amount').'</p></div>',
	'#attributes'=>array('class'=>'select_box'),
    '#default_value' => isset($offer_24_Data['discount_by']) ? $offer_24_Data['discount_by'] : NULL,
	'#options' => array('%'=>'Amount in %','$'=>'Amount in $'),
	
   ); 
//onclick="Validate24hours_type();"
	$form['product_pricing']['24_hour_offer']['add_new_date'] = array(
		'#prefix' => '<div class="col-lg-3 col-md-6 col-sm-5 col-xs-12 padding_left"><a  class="addanother" href="#" id="addPeriodEXP">Add Period</a>',
		'#suffix' => '</div></div></fieldset>',
	); 
	
	
if(count($dateData['24_hour_offer_date_extra'])>0)
{

foreach($dateData['24_hour_offer_date_extra'] as $key=>$value)
{

$form['product_pricing']['24_hour_offer']['offer_24_hour_date_extra['.$key.']'] = array(
    '#type' => 'textfield',
	'#prefix' => '<fieldset><div class="24_hours_disscount_extra 24_hours_discounted_clone"><div class="early-birds-hour-offer col-lg-3 col-md-3 col-sm-6 col-xs-12 padding_left"><p class="pre_small_text">Apply discount of </p>',
	  '#attributes' => array('placeholder'=>'Date',
		'class' => array('datepicker'),
	  ),
	
  '#default_value' => isset($value) ? $value : NULL,
  '#suffix'=>'</div>'
  );
 
  $form['product_pricing']['24_hour_offer']['offer_24_hour_price_value_extra['.$key.']'] = array(
    '#type' => 'textfield',
	'#attributes' => array('placeholder'=>'Price',
		'class' => array('extra-price'),
	),
	'#default_value' => isset($priceData['24_hour_offer_price_value_extra'][$key]) ? $priceData['24_hour_offer_price_value_extra'][$key] : NULL,
	'#prefix'=>'<div class="col-lg-2 col-md-6 col-sm-6 col-xs-12 padding_left"><p> </p>',
	'#suffix'=>'</div>',
 );
  
   $form['product_pricing']['24_hour_offer']['24_hour_offer_price_type_extra['.$key.']'] = array(
    '#type' => 'select',
	'#attributes' => array(
		'class' => array(''),
	),
	'#options' => array('%'=>'Amount in %'),
	'#prefix'=>'<div class="col-lg-4 col-md-6 col-sm-4 col-xs-12 padding_left"><div class="selectbox">',
	'#suffix'=>'</div><p>'.t('on total Amount').'</p></div>',
	
  ); 

    $form['product_pricing']['24_hour_offer']['rem_extra_date['.$key.']'] = array(
		'#prefix' => '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 padding_left"><p></p><a class="" href="#" id="remPeriodEXP-extra">Remove</a>',
		'#suffix' => '</div></div></fieldset>',
	);
}
}
	$form['product_pricing']['24_hour_offer']['End'] = array(
			'#prefix' => '</div>',
	); 

	$form['metaID'] = array(
		'#type' => 'hidden',
		'#default_value' => isset($pricingData["meta_id"])?$pricingData["meta_id"]:'',
	);
  
	$form['page'] = array(
		'#type' => 'hidden',
		'#default_value' => 'product_rules'
	);
	$form['save'] = array(
    '#type' => 'submit',
	'#attributes' => array('class'=>array('btn btn-dark btn-gradient')),
    '#value' => t('Save'),
	'#prefix'=>'<fieldset><div class="price-save">',
	'#suffix'=>'</div></fieldset></div></div></div></div>'
	);
   
	return $form;
}

function product_rules_form($form, &$form_state){
	$metaID = arg(3);
	$rules = getRulesDetails($metaID);
    $values = unserialize($rules["value1"]);
	$exprienceReq=unserialize($values['experience_rules']);
	global $user;  
    $eid = arg(3);
	if($eid!="")
	{
	$OverviewData = getOverviewData($eid);
	if(empty($OverviewData))
		{
		drupal_set_message(t('No Listing data found'),'error');
		drupal_goto('product/add/overview');
		}
		else if($user->uid!=$OverviewData['uid']){

		drupal_set_message(t('You have not access to view Listing data'),'error');
		drupal_goto('product/add/overview');
		}
	}
	$form['html']=array('#prefix'=>'<div class="col-md-12 col-sm-12 col-xs-12"><h2 class="pagehead">Rules & Policies</h2>
						<p class="subtitle">Manage Rules & Policies</p></div>');


	$form['#attributes']['class'][] = 'Calenderform';
		$form['product_rules'] = array(
		'#prefix' => '<fieldset><label>'.t("Requirements").'</label>',
		
	);
		$form['product_rules']['experience_rules[]'] = array(
		'#type' => 'textfield',
		'#prefix' => '<div class="experience-require left_fld" id="experience-require">',
		'#default_value' => isset($exprienceReq[0]) ? trim($exprienceReq[0]) : '',
		  '#attributes' => array('placeholder'=>'Experience Requirements',
			'class' => array('experience-rules'),
		  ),
		  '#maxlength' =>140,
		);

 	$form['product_rules']['add_experience'] = array(
		'#prefix' => '<div class="add-experience "><a class="addanother" href="#"  id="addIncExp">Add more</a>',
		'#suffix' => '</div></div></fieldset>',
	);
	if($exprienceReq)
	{
	if(count($exprienceReq>1))
	{
	unset($exprienceReq[0]);
	$undata=($exprienceReq);
	
	 foreach ($undata as $key=>$value)
	 {
	 $form['product_rules']['experience_rules['.$key.']'] = array(
			'#type' => 'textfield',
			'#prefix' => '<fieldset><div class="experience-require left_fld">',
			'#default_value' => isset($value) ?trim($value) : '',
			 '#attributes' => array('placeholder'=>'Experience Requirements',
			'class' => array('experience-rules'),
		  ),
		  '#maxlength' =>140,
		);
		$form['product_rules']['add_experience['.$key.']'] = array(
		'#prefix' => '<a class="delete add-experience" href="#" id="remIncExp">Delete</a>',
		'#suffix' => '</div></fieldset>',
	);
	  }
	 }
	}
	
	$form['product_rules']['other_information'] = array(
		'#type' => 'textarea',
		'#prefix' =>'<fieldset>',
		'#suffix'=>'</fieldset>',
		'#title' => t("Other Information"),
		'#default_value' => isset($values['other_information']) ? $values['other_information'] : '',
		  '#attributes' => array(
			'class' => array(''),
		  ),
	);
 

$form['product_rules']['security_deposit'] = array(
		'#type' => 'textfield',		
		'#prefix'=>'<fieldset class="boaders"><label>'.t('Security Deposit').'</label><div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 padding_left">',
		'#default_value' => isset($values['security_deposit']) ? $values['security_deposit'] :  '',
		'#attributes' => array(
		'class' => array(''),'placeholder'=>t('amount')
		),
		'#suffix'=>'</div><div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 padding_left">',
	);
	$form['product_rules']['security_options'] = array(
	'#type' => 'select',
	'#prefix'=>'',
	'#default_value' => isset($values['security_options']) ? $values['security_options'] : '',
	  '#attributes' => array(
	'class' => array(''),
	),
	'#options'=>array('amount_in_$'=>'in $','booking_%'=>'Booking in %'),
	'#suffix'=>'</div></fieldset>'
	);	

$form['product_rules']['Test'] = array(

'#prefix'=>'<fieldset>
			<div id="parentHorizontalTab">
            <ul class="resp-tabs-list hor_1">
                <li onclick="select_cancellation(\'Relaxed\');">Relaxed</li>
				<li onclick="select_cancellation(\'Flexible\');">Flexible</li>
                <li onclick="select_cancellation(\'Moderate\');">Moderate</li>
                <li onclick="select_cancellation(\'Strict\');">Strict</li>
                <li onclick="select_cancellation(\'Super-Strict\');">Super Strict</li>
                <li onclick="select_cancellation(\'Custom\');">Custom</li>
            </ul>
            <div class="resp-tabs-container hor_1">
                <div>
				 <div class="heading">Relaxed<a href="javascript:void(0);" class="selecttag" onclick="set_cancellation();">Select</a></div>
                   <p> <strong>Guests will receive a full refund if they cancel at least two weeks before the start of their reservation.</strong> </p>
                    <br>                    
                </div>
                <div>
                <div class="heading">Flexible<a href="javascript:void(0);" class="selecttag" onclick="set_cancellation();">Select</a></div>
                 <p> <strong>Guests will receive their full refundable deposit:</strong><br/>

						A 50% refund of their paid rental costs if they cancel at least four weeks before the start of their reservation; OR<br/>
						A 25% refund of their paid rental costs if they cancel up to two weeks before the start of their reservation.

					 </p>      
				</div>
                <div>
                <div class="heading">Moderate<a href="javascript:void(0);" class="selecttag" onclick="set_cancellation();">Select</a></div>
                   <p> <strong>Guests will receive their full refundable deposit:-</strong><br/>
						A 50% refund of their paid rental costs, if they cancel at least four weeks before the start of their reservation.
					 </p>
                    <br>                    
                </div>
                <div>
                <div class="heading">Strict<a href="javascript:void(0);" class="selecttag" onclick="set_cancellation();">Select</a></div>
                  <p> <strong>Guests will receive their full refundable deposit:</strong><br/>

					A 50% refund of their paid rental costs if they cancel at least eight weeks before the start of their reservation; OR<br/>
					A 25% refund of their paid rental costs if they cancel up to four weeks before the start of their reservation.
					<br>
				  </p>
                    <br>                    
                </div>                
                <div>
                <div class="heading">Super Strict<a href="javascript:void(0);" class="selecttag" onclick="set_cancellation();">Select</a></div>
                <p> <strong>If the guest cancels, any money they have paid cannot be refunded.</strong></p> </div>                
                <div>
                <div class="heading">Custom<a href="javascript:void(0);" class="selecttag" onclick="set_cancellation();">Select</a></select>
				</span>
				</div>
                 <p><strong>This is custom settings for Cancellation Policy.User can cut any % of price in any time of period.</strong></p>
                </div>
            </div>
        </div>
            </fieldset>',

);


$form['product_rules']['cancellation_policies_type_valid'] = array(

	'#type' => 'hidden',
	'#default_value' => isset($values['cancellation_policies_type']) ? $values['cancellation_policies_type'] : 0,
	'#attributes' => array(
		'id' => array('new_cancellation_select'),
	  ),
);
$form['product_rules']['cancellation_policies_type'] = array(

	'#type' => 'hidden',
	'#default_value' => isset($values['cancellation_policies_type']) ? $values['cancellation_policies_type'] : 0,
	'#attributes' => array(
		'id' => array('new_cancellation_select_final'),
	  ),
);


  $form['product_rules']['cancellation_policy_entire'] = array(  
	'#prefix' => '<fieldset class="custom_policy_fields"><div id="parentHorizontalTab" style="display: block; width: 100%; margin: 0px;"><div class="custom-policy">',	
  ); 
	$form['product_rules']['product_rules_custom'] = array(
		'#prefix' => '<div><h4>Guests will receive their full refundable deposit plus:</h4>',
		'#suffix' => '</div>',
	);
	$form['product_rules']['amount_week']=array(
	'#prefix' => '<div class="amount-week">',
		'#type' => 'textfield',
		  '#attributes' => array(
			'class' => array(''),'placeholder'=>'amount'
		  ),
		'#default_value' => isset($values['amount_week']) ? $values['amount_week'] : 1,
		 '#title' => t('A'),
	);	
$form['product_rules']['amount_week_rental']=array(
    '#type' => 'textfield',
 	  '#attributes' => array(
		'class' => array('')
	  ),
	'#default_value' => isset($values['amount_week_rental']) ? $values['amount_week_rental'] : 1,
 	 '#title' => t('(in %) refund of their paid rental costs if they cancel at least'),
);	
$form['product_rules']['amount_week_select']=array(
    '#type' => 'select',
 	  '#attributes' => array(
		'class' => array('')
	  ),
	/*  '#prefix'=>'<div class="selectbox">',
	'#suffix'=>'</div>', */
	'#default_value' => isset($values['amount_week_select']) ? $values['amount_week_select'] :'',
 	'#options'=>array('weeks'=>'Weeks','months'=>'Months'),
		
);	 

$form['product_rules']['amount_day']=array(
'#prefix' => '<div class="amount-day">',
    '#type' => 'textfield',
 	  '#attributes' => array(
		'class' => array(''),'placeholder'=>'amount'
	  ),
	 
	'#default_value' => isset($values['amount_day']) ? $values['amount_day'] : 1,
 	 '#title' => t('B'),
);	
$form['product_rules']['amount_day_rental']=array(
    '#type' => 'textfield',
 	  '#attributes' => array(
		'class' => array('')
	  ),
	
	'#default_value' => isset($values['amount_day_rental']) ? $values['amount_day_rental'] : 1,
 	 '#title' => t('(in %) refund of their paid rental costs if they cancel at least'),
);	
$form['product_rules']['amount_day_select']=array(
    '#type' => 'select',
 	  '#attributes' => array(
		'class' => array('')
	  ),
	'#default_value' => isset($values['amount_day_select']) ? $values['amount_day_select'] :'',
 	'#prefix'=>'',
	'#suffix'=>'</div></fieldset>',
	'#options'=>array('days'=>'Days'),
	
);
  $form['metaID'] = array(
	'#type' => 'hidden',
	'#default_value' => isset($rules["meta_id"]) ? $rules["meta_id"] : null,
  );
  
  $form['page'] = array(
	'#type' => 'hidden',
	'#default_value' => 'product_extra'
  );
  
	$form['save'] = array(
		'#type' => 'submit',
		'#attributes' => array('class'=>array('')),
		'#prefix'=>'<fieldset>',
		'#suffix'=>'</fieldset></div></div></div></div></div>',
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
   
	global $user;  
    $eid = arg(3);
	
	if($eid!="")
	{
		$values = getOverviewData($eid);
		if(empty($values))
			{
			drupal_set_message(t('No Listing data found'),'error');
			drupal_goto('product/add/overview');
			}
			else if($user->uid!=$values['uid']){

			drupal_set_message(t('You have not access to view Listing data'),'error');
			drupal_goto('product/add/overview');
			}
	}
  $values = getProductSubscriptionData($eid);
  
  
  $form['product_subscription']['subscription_text'] = array(
    '#prefix' => '<div><h2>Listing Subscription </h2>',
    '#suffix' => '</div>',
  );
 
  $form['product_subscription']['free'] = array(
    '#type' => 'radio',
	'#prefix' =>'<div class="priceblock">',
	'#title' => 'Classic - Free',
	'#suffix' => '<h2>Totally Free</h2></div>',
    '#default_value' => isset($values['free']) ? $values['free'] : NULL,
	'#required' => TRUE
  ); 
  
  $form['product_subscription']['Silver'] = array(
    '#type' => 'radio',
	'#prefix' =>'<div class="priceblock">',
	'#title' => 'Silver',
    '#suffix' => '<h2>$29/Month</h2></div>',
    '#default_value' => isset($values['Silver']) ? $values['Silver'] : NULL,
	'#required' => TRUE
  ); 
  
  $form['product_subscription']['Gold'] = array(
    '#type' => 'radio',
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
 
  
  $form['next'] = array(
    '#type' => 'submit',
	'#attributes' => array('class'=>array('btn btn-dark btn-gradient')),
    '#value' => t('Save')
  );
    
  return $form;
}


function product_scheduling_form($form, &$form_state){
 $schedulingData=getSchedulingData(arg(3));
 $sessionData=getSchedulingSessionData(arg(3));
 $pricingData = getPricingData(arg(3));
 $discountData = getDiscountData(arg(3));
 
/**************************************************************************************/
	global $user;  
    $eid = arg(3);
	$values = getOverviewData($eid);
	if(($eid))
	{
		if(empty($values))
		{
		drupal_set_message(t('No Listing data yet Created'),'error');
		drupal_goto('product/add/overview');
		}
		else if($user->uid!=$values['uid']){

		drupal_set_message(t('You have not access to view Listing data'),'error');
		drupal_goto('product/add/overview');
		}
	}
	/**************************************************************************************/

	$form['#attributes']['class'][] = 'Calenderform';
	$form['product_scheduling']['Product[bookingMode]'] = array(
    '#type' => 'select',
	'#attributes' => array(
		'class' => array(''),
	),
	'#prefix'=>'<fieldset><label>Dates Available </label><div class="col-lg-12 col-md-12 col-sm-22 col-xs-12 padding_left"><div class="selectbox">',
    '#default_value' => isset($schedulingData['bookingMode']) ? $schedulingData['bookingMode'] : NULL,
	'#options' => array('INVENTORY'=>'Fixed date & time','DATE_ENQUIRY'=>'Any date - Accept enquiries for any date','NO_DATE'=>'Date not required for booking'),
	'#suffix'=>'</div></div></fieldset>'
	);
  
   $form['product_scheduling']['Product[inventoryMode]'] = array(
    '#type' => 'select',
	'#prefix' => '<fieldset class="product-availability"><label>'.t('Availability').'</label><div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 padding_left"><div class="selectbox">',
	'#attributes' => array(
		'class' => array(''),
	),
	'#suffix'=>'</div></div>',
    '#default_value' => isset($schedulingData['inventoryMode']) ? $schedulingData['inventoryMode'] : NULL,
	'#options' => array('SESSION_SEATS'=>'Limited - Fixed limit per session','FREE_SALE'=>'Unlimited - Free sale'/* ,'RESOURCES'=>'Limited - By resources' */),
  ); 
  
   $form['product_scheduling']['Product[defaultQuantity]'] = array(
    '#type' => 'textfield',
	'#attributes' => array('placeholder'=>'Limit',
		'class' => array(''),
	),
	'#prefix'=>'<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 padding_left">',
   	'#suffix' => '</div></fieldset>',
    '#default_value' => isset($schedulingData['defaultQuantity']) ? $schedulingData['defaultQuantity'] : 10,
  );
  

  $form['product_scheduling']['Product[bookingTimeMode]'] = array(
    '#type' => 'select',
	'#attributes' => array(
		'class' => array(''),
	),
	'#prefix' => '<fieldset class="form-item-Product-bookingTimeMode"><div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding_left"><label>'.t('Times available').'</label><div class="selectbox">',
	'#suffix'=>'</div></div></fieldset>',
    '#default_value' => isset($schedulingData['bookingTimeMode']) ? $schedulingData['bookingTimeMode'] : NULL,
	'#options' => array('FIXED'=>'Fixed times','TIME_ENQUIRY'=>'Any time - Allow customer to choose a time','NO_TIME'=>'Time not required for booking'),
  );
   
  $form['product_scheduling']['Product[bookingFixedTimes][0]'] = array(
    '#type' => 'textfield',
	'#attributes' => array(
		'class' => array('timepicker'),
	),
	'#prefix' => '<fieldset id="time-available" class="time-available"><label>'.t('Available time').'<span class="form-required"> *</span></label><div  class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding_left">',
	'#default_value' => isset($schedulingData['bookingFixedTimes']) ? $schedulingData['bookingFixedTimes'] : NULL,
	'#suffix'=>'</div>'
  );

	$form['product_scheduling']['add_new1'] = array(
		'#prefix' => '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding_left"><a class="addanother" href="#" id="addTime">Add more</a>',
		'#suffix' => '</div></fieldset>',
	);
  $form['product_scheduling']['new_added_clone'] = array(
		'#prefix' => '<div id="time_available_clone">',
		'#suffix' => '</div>',
	);
  $form['product_scheduling']['Product[confirmMode]'] = array(
    '#type' => 'select',
	'#attributes' => array(
		'class' => array(''),
	),
	'#prefix' => '<fieldset class="product-confirm-booking"><label>'.t(' Confirm bookings').'</label><div class="selectbox">',
	'#suffix' => '</div></fieldset>',
    '#default_value' => isset($schedulingData['confirmMode']) ? $schedulingData['confirmMode'] : NULL,
	'#options' => array('AUTOCONFIRM'=>'Automatically','MANUAL'=>'Manually'),
  );
  
  $form['product_scheduling']['confirm_booking_value'] = array(
    '#type' => 'textfield',
    '#title' => 'after',
	'#attributes' => array(
		'class' => array(''),
	),
	'#prefix'=>'<fieldset>',
    '#description' => 'Participants',
    '#suffix' => '</fieldset>',
  );

 if($pricingData[0]["price_type"] == "PER_DAY" || $pricingData[0]["price_type"] == "PER_HOUR" || $pricingData[0]["price_type"] == "PER_MINUTE"){
	 
	  $form['product_scheduling']['Product[durationType]'] = array(
		'#type' => 'select',
		'#attributes' => array(
			'class' => array(''),
		),
		'#prefix' => '<fieldset class="duration-wrapper" ><label>'.t('Duration').'<span class="form-required"> *</span></label><div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 padding_left product-estimate-duration"><div class="selectbox">',
		'#default_value' => isset($schedulingData['durationType']) ? $schedulingData['durationType'] : NULL,
		'#options' => array('Any'=>'Any duration','LIST'=>'Choose from a list'),
		'#suffix'=>'</div></div>'
	  );
	  
	  $form['product_scheduling']['Product[minDuration]'] = array(
		'#type' => 'textfield',
		'#attributes' => array('placeholder'=>'Min',
			'class' => array(''),
		),
		'#prefix'=>'<div class="min-max-duration"><div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 padding_left min-max-duration"><label>'.t('Min').'<span class="form-required"> *</span></label>',
		'#suffix' => '</div>',
		'#description' => t('days'),
		'#default_value' => isset($schedulingData['minDuration']) ? $schedulingData['minDuration'] : NULL,
	  );
	  
	  $form['product_scheduling']['Product[maxDuration]'] = array(
		'#type' => 'textfield',
		'#attributes' => array('placeholder'=>'Max',
			'class' => array(''),
		),
		'#description' => t('days'),
		'#prefix'=>'<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 padding_left"><label>'.t('Max').'<span class="form-required"> *</span></label>',
		'#suffix' => '</div></div>',
		'#default_value' => isset($schedulingData['maxDuration']) ? $schedulingData['maxDuration'] : NULL,
	  );
	 
	  $form['product_scheduling']['DurationOption[0][durationLabel]'] = array(
		'#type' => 'textfield',
		'#attributes' => array('placeholder'=>'Label',
			'class' => array(''),
		),
		'#prefix'=>'<div id="choose-list-duration" class="choose-list-duration"><div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 padding_left">',
		'#suffix' => '</div>',
		'#default_value' => isset($schedulingData['durationLabel']) ? $schedulingData['durationLabel'] : NULL,
	  );
	  
		$form['product_scheduling']['DurationOption[0][durationValue]'] = array(
		'#type' => 'textfield',
		'#attributes' => array('placeholder'=>'Duration',
			'class' => array(''),
		),
		'#prefix'=>'<div  class="col-lg-2 col-md-2 col-sm-6 col-xs-12 padding_left">',
		'#suffix'=>'</div>',
		'#default_value' => isset($schedulingData['durationValue']) ? $schedulingData['durationValue'] : NULL,
		);
	  
		$form['product_scheduling']['add_duration'] = array(
			'#prefix' => '<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 padding_left"><a class="" href="#" id="addDuration">Add more</a>',
			'#suffix' => '</div></div>',
		);
		$form['product_scheduling']['add_duration_end'] = array(
			'#suffix' => '</fieldset>',
		);
	 
  }else{
 
	  $form['product_scheduling']['Product[duration]'] = array(
		'#type' => 'textfield',
		'#attributes' => array('placeholder'=>'Minutes or Hours',
			'class' => array(''),
		),
		'#prefix' => '<fieldset><label>'.t('Estimated duration').'<span class="form-required"> *</span></label><div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding_left product-estimate-duration">',
		
		'#default_value' => isset($schedulingData['duration']) ? $schedulingData['duration'] : NULL,
		'#suffix'=>'</div>'
	  );
	  
	  $form['product_scheduling']['Product[durationUnit]'] = array(
		'#type' => 'select',
		'#attributes' => array(
			'class' => array(''),
		),
		'#default_value' => isset($schedulingData['durationUnit']) ? $schedulingData['durationUnit'] : NULL,
		'#prefix'=>'<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding_left"><div class="selectbox">',
		'#suffix' => '</div></div></fieldset>',
		'#options' => array('MINUTES'=>'Minutes','HOURS'=>'Hours','DAYS'=>'Days'),
	  );
  }
 
  $form['product_scheduling']['Product[subscriptionID]'] = array(
    '#type' => 'hidden',
	'#default_value' => isset($schedulingData['id']) ? $schedulingData['id'] : NULL,
  );
  
	$form['product_scheduling']['Sessions-settings'] = array(
		'#prefix' => '<div class="" id="session-wrapper">',
	);
	$form['product_scheduling']['start-session-HTML-start'] = array(
		'#prefix' => '<div id="start-session-wrapper">',
	);

  $form['product_scheduling']['Session[startDate]'] = array(
    '#prefix' => '<fieldset><label>'.t('Date').'</label><div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 padding_left"><div class="form-group session-from-to"><div id="datetimepicker1" class="input-group date session-from">',
	'#type' => 'textfield',
    '#default_value' => isset($form_state["input"]["Session"]["startDate"]) ? $form_state["input"]["Session"]["startDate"]: NULL,
	  '#attributes' => array('placeholder'=>'From',
		'class' => array('datepicker'),
	  ),
		'#suffix' => '<span class="input-group-addon"><i class="fa fa-calendar-o"></i></span></div></div></div>'
  );
  if(!isset($pricingData[0]["price_type"]) || $pricingData[0]["price_type"] == "PER_PERSON" || $pricingData[0]["price_type"] == "PER_ITEM" || $pricingData[0]["price_type"] == "FIXED"){
	  $startTime=date("g:i a", strtotime($sessionData['startTime']));
	  $form['product_scheduling']['Session[startTime]'] = array(
		'#prefix' => '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 padding_left"><div class="form-group"><div class="input-group date session-from">',
		
		'#type' => 'textfield',
		  '#attributes' => array('placeholder'=>'From',
			'class' => array('timepicker'),
		  ),
			'#suffix' => '<span class="input-group-addon All_day"><i class="fa fa-clock-o"></i></span></div></div></div>'
	  ); 
		
	  $endTime=date("g:i a", strtotime($sessionData['endTime']));
	  $form['product_scheduling']['Session[endTime]'] = array(
	  	'#prefix' => '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 padding_left"><div class="form-group"><div class="input-group date session-from">',
		'#type' => 'textfield',
		  '#attributes' => array('placeholder'=>'To',
			'class' => array('timepicker'),
		  ),
			'#suffix' => '<span class="input-group-addon All_day"><i class="fa fa-clock-o"></i></span></div></div></div>'
	  ); 
	  $form['product_scheduling']['Session[endDate]'] = array(
		'#prefix' => '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 padding_left"><div class="form-group"><div  class="input-group date session-from">',
	
		'#type' => 'textfield',
		'#default_value' => isset($form_state["input"]["Session"]["endDate"]) ? $form_state["input"]["Session"]["endDate"]: NULL,
		  '#attributes' => array('placeholder'=>'To',
			'class' => array('datepicker'),'onblur'=>'setUntilDate();'
		  ),
			'#suffix' => '<span class="input-group-addon"><i class="fa fa-calendar-o"></i></span></div></div></div>'
	  );
		
	  $form['product_scheduling']['all_day_session'] = array(
		'#type' => 'checkboxes',
		'#prefix'=>'<fieldset><div>',
		'#suffix'=>'</div></fieldset>',
		'#options' => array('all-day' => "All Day"),
	  );
	}
	$form['product_scheduling']['start-session-HTML-end'] = array(
		'#type' => 'markup',
		'#suffix' => '</fieldset></div>',
	);
	
	$form['product_scheduling']['Session[repeatPeriod]'] = array(
		'#type' => 'select',
		'#prefix'=>'<fieldset class="repeat_sessions_condition"><label>Repeat sessions </label><div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding_left"><div class="selectbox">',
		'#suffix'=>'</div></div></fieldset>',
		'#attributes' => array(
		'onchange'=>'hide_perminute(this);'
		),
		'#default_value' => isset($values['repeat_session']) ? $values['repeat_session'] : NULL,
		'#options' => array('DoNOt'=>'Do not repeat','YEARLY'=>'Repeat yearly','MONTHLY'=>'Repeat monthly','Weekly'=>'Repeat Weekly','Daily'=>'Repeat Daily','Hourly'=>'Repeat Hourly'),
		//,'Minute'=>'Repeat minute by minute'
	);
  
  $minutes = array();
  for($i=5;$i<65;$i=$i+5){
	$minutes[$i] = $i;
  }

	$form['product_scheduling']['repeat-session-HTML-start1'] = array(
		'#prefix' => '<div class="repeat-session-HTML">',
	); 
	$form['product_scheduling']['Session[repeatEveryMinute]'] = array(
		'#type' => 'select',
		'#options' => $minutes,
		'#prefix' => '<fieldset class="repeat_everyminute_condition"><div class="repeat_session repeatEveryMinute"><label>Every Minute</label><div class="selectbox">',
		'#default_value' => isset($values['repeat_session_every_minutes']) ? $values['repeat_session_every_minutes'] : NULL,
		'#attributes' => array('placeholder'=>'Minutes'
							),
		'#suffix' => '</div></div></fieldset>',
	);
 
  $hours = array();
  for($i=1;$i<25;$i=$i+1){
	$hours[$i] = $i;
  }
  
  $form['product_scheduling']['Session[repeatEveryHour]'] = array(
    '#type' => 'select',
    '#options' => $hours,
 	'#prefix' => '<fieldset class="repeat_session repeatEveryHour"><label>Every Hour</label><div class="selectbox">',
    '#default_value' => isset($values['repeat_session_every_hours']) ? $values['repeat_session_every_hours'] : NULL,
	  '#attributes' => array('placeholder'=>'Hours'
	  ),
	'#suffix' => '</div></fieldset>'
  );
  
  if($pricingData[0]["price_type"] == "PER_DAY"){
			 drupal_add_js('jQuery(document).ready(function () {
					jQuery("#edit-session-repeatperiod").val("Daily").attr("selected","selected");
					jQuery(".form-item-Session-repeatPeriod").hide();
					jQuery(".repeat_sessions_condition").hide();
					jQuery(".repeat_everyminute_condition").hide();
					jQuery(".repeatEveryHour").hide();
					jQuery("#repeat-session-wrapper").hide();
					jQuery(".form-item-Product-maxDuration .description, .form-item-Product-minDuration .description").text("days");
					jQuery(".form-item-Session-repeatEveryDay").hide();
			 });',
				array('type' => 'inline', 'scope' => 'header', 'weight' => 5)
			  );
  }
  else if($pricingData[0]["price_type"] == "PER_HOUR"){
			 drupal_add_js('jQuery(document).ready(function () { 
					jQuery("#edit-session-repeatperiod").val("Hourly").attr("selected","selected");
					jQuery(".form-item-Session-repeatPeriod").hide();
					jQuery(".repeat_sessions_condition").hide();
					jQuery(".repeat_everyminute_condition").hide();
					jQuery(".repeatEveryHour").hide();
					jQuery("#repeat-session-wrapper").hide();
					jQuery(".form-item-Session-repeatEveryHour").hide();
					jQuery(".form-item-Product-maxDuration .description, .form-item-Product-minDuration .description").text("hours");
			 });',
				array('type' => 'inline', 'scope' => 'header', 'weight' => 5)
			  );	
  }
  else if($pricingData[0]["price_type"] == "PER_MINUTE"){
			 drupal_add_js('jQuery(document).ready(function () {
					jQuery("#edit-session-repeatperiod").val("Minute").attr("selected","selected");
					jQuery(".form-item-Session-repeatPeriod").hide();
					jQuery(".repeat_sessions_condition").hide();
					jQuery("#repeat-session-wrapper").hide();
					jQuery(".repeat_everyminute_condition").hide();
					jQuery(".repeatEveryHour").hide();
					jQuery(".form-item-Session-repeatEveryMinute").hide();
					jQuery(".form-item-Product-maxDuration .description, .form-item-Product-minDuration .description").text("mins");
					
			 });',
				array('type' => 'inline', 'scope' => 'header', 'weight' => 5)
			  );	
  }
 
  $days = array();
  for($i=1;$i<31;$i=$i+1){
	$days[$i] = $i;
  }
  $year = array();
  for($i=1; $i<=12; $i++){
  	$year[$i] = $i;
  }
  $form['product_scheduling']['Session[repeatEveryDay]'] = array(
    '#type' => 'select',
    '#options' => $days,
	'#prefix' => '<fieldset class="repeat_session repeatEveryDay"><label>Every Day</label><div class="selectbox">',
    '#default_value' => isset($values['repeat_session_every_days']) ? $values['repeat_session_every_days'] : NULL,
	  '#attributes' => array('placeholder'=>'Days'
	  ),
	'#suffix' => '</div></fieldset>'
  );

  $form['product_scheduling']['Session[repeatEveryWeek]'] = array(
    '#type' => 'select',
    '#options' => $days,
 	'#prefix' => '<fieldset class="repeat_session repeatEveryWeek"><label>Every Day</label><div class="selectbox">',
    '#default_value' => isset($values['repeat_session_every_days']) ? $values['repeat_session_every_days'] : NULL,
	  '#attributes' => array('placeholder'=>'Days',
		'class' => array(''),
	  ),
	'#suffix' => '</div></fieldset>'
  );

  $form['product_scheduling']['Session[repeatEveryMonth]'] = array(
    '#type' => 'select',
    '#options' => $days,
 	'#prefix' => '<fieldset class="repeat_session repeatEveryMonth"><label>Every Month</label><div class="selectbox">',
    '#default_value' => isset($values['repeat_session_every_days']) ? $values['repeat_session_every_days'] : NULL,
	  '#attributes' => array('placeholder'=>'Days',
		'class' => array(''),
	  ),
	'#suffix' => '</div></fieldset>'
  );

  $form['product_scheduling']['Session[repeatEveryYear]'] = array(
    '#type' => 'select',
    '#options' => $year,
 	'#prefix' => '<fieldset class="repeat_session repeatEveryYear"><label>Every Year</label><div class="selectbox">',
    '#default_value' => isset($values['repeat_session_every_days']) ? $values['repeat_session_every_days'] : NULL,
	  '#attributes' => array('placeholder'=>'Days',
		'class' => array(''),
	  ),
	'#suffix' => '</div></fieldset>'
  );
  
  $form['product_scheduling']['Session[endRepeatDate]'] = array(
    '#type' => 'textfield',
	'#prefix'=>'<fieldset class="form-item form-type-textfield form-item-Session-endRepeatDate"><label>'.t('Until').'<span class="form-required"> *</span></label>',
 	'#default_value' => isset($form_state["input"]["Session"]["endRepeatDate"]) ? $form_state["input"]["Session"]["endRepeatDate"]: NULL,
	  '#attributes' => array('placeholder'=>'Date',
		'class' => array('datepicker'),
	  ),
 	'#suffix' => '</fieldset>'
  );
	$form['product_scheduling']['repeat-session-HTML-end1'] = array(
		'#type' => 'markup',
		'#suffix' => '</div>',
	);
 	$form['product_scheduling']['repeat-session-HTML-start'] = array(
		'#type' => 'markup',
		'#markup' => '<h4>'.t('Openning hours').'</h4>',
		'#prefix' => '<div id="repeat-session-wrapper">',
	);

	$weekdays = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
	foreach($weekdays as $key=>$value){
		$form['product_scheduling']['Session[repeaton]['.$value.']'] = array(
		'#type' => 'checkbox',
		'#prefix' => '<div class="rep-sessions"><fieldset>',
		'#title' => t($value),
		'#default_value' => isset($extraDetails['repeat_session_on_'.$value]) ? $extraDetails['repeat_session_on_'.$value] : NULL,
		'#suffix'=>'</fieldset>'
		);
	  
		$form['product_scheduling']['Session[repeatfrom]['.$value.']'] = array(
		'#type' => 'textfield',
		'#default_value' => isset($values['session_repeats_from_'.$value]) ? $values['session_repeats_from_'.$value] : NULL,
		  '#attributes' => array('placeholder'=>'From',
			'class' => array('timepicker'),
		  ),
		  '#prefix'=>'<fieldset><div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding_left">',
		  '#suffix'=>'</div>',
		);
	  
		$form['product_scheduling']['Session[repeatto]['.$value.']'] = array(
		'#type' => 'textfield',
		 '#prefix'=>'<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding_left">',

		'#suffix' => '</div></fieldset></div>',
		'#default_value' => isset($values['session_repeats_to_'.$value]) ? $values['session_repeats_to_'.$value] : NULL,
		  '#attributes' => array('placeholder'=>'To',
			'class' => array('timepicker'),
		  ),
		);
	}

  $form['product_scheduling']['repeat-session-HTML-end'] = array(
		'#type' => 'markup',
		'#suffix' => '</div>',
	);
	
	
	if(count($discountData)>0){
		$form['product_scheduling']['discount-HTML'] = array(
			'#type' => 'markup',
			'#markup' => '<h3>Offers & Discounts</h3>',
			'#prefix' => '<fieldset><div class="schedule-discount-wrapper">'
		);
		$i =1;
		foreach($discountData as $key=>$val){

 			if($val["offer_type"] == "24 Hour Offer"){
				$newArray = unserialize($val['amount']);
				$newArray_date=unserialize($val['date']);
				$total_array=array_merge($newArray_date,$newArray);
				$m = 100;
				foreach($newArray as $key1=>$val1){
				
					$form['product_scheduling']['Session[discountAmt]['.$m.'][scheduleDiscount]'] = array(
						'#type' => 'textfield',
						
						'#prefix' => '<fieldset><label>'.t($val["offer_type"]).'</label><div class="schedule-discount-inner-wrapper"><div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding_left">',
						'#default_value' => isset($val1['price']) ? $val1['price'] : NULL,
						'#attributes' => array('placeholder'=>'Price','disabled'=>'disabled',
						'class' => array(),
						),
						'#suffix'=>'</div>'
					);						
					$form['product_scheduling']['Session[discountAmt]['.$m.'][scheduleDiscountDate]'] = array(
						'#type' => 'textfield',
						'#prefix'=>'<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding_left">',
						'#suffix' => '</div></div></fieldset>',
						'#default_value' => isset($val1['date']) ? $val1['date'] : NULL,
						'#attributes' => array('placeholder'=>'Date','disabled'=>'disabled',
						'class' => array('datepicker'),
						),
					);		
					$form['product_scheduling']['Session[discountAmt]['.$m.'][baseDiscount]'] = array(
						'#type' => 'hidden',
						'#default_value' => isset($val1['price']) ? $val1['price'] : NULL,
					);	
					$form['product_scheduling']['Session[discountAmt]['.$m.'][baseDiscountDate]'] = array(
						'#type' => 'hidden',
						'#default_value' => isset($val1['date']) ? $val1['date'] : NULL,
					);						
					$m++;
				}
			}else{
				$form['product_scheduling']['Session[discountAmt]['.$key.'][scheduleDiscount]'] = array(
					'#type' => 'textfield',
					
					'#prefix' => '<div class="schedule-discount-inner-wrapper"><fieldset><label>'.t($val["offer_type"]).'</label><div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding_left">',
					'#default_value' => isset($val['amount']) ? $val['amount'] : NULL,
					'#attributes' => array('placeholder'=>'Price','disabled'=>'disabled',
					'class' => array(''),
					
					),
					'#suffix'=>'</div>'
				);	
				$form['product_scheduling']['Session[discountAmt]['.$key.'][baseDiscount]'] = array(
					'#type' => 'hidden',
					'#default_value' => isset($val['amount']) ? $val['amount'] : NULL,
				);	
				$form['product_scheduling']['Session[discountAmt]['.$key.'][baseDiscountType]'] = array(
					'#type' => 'hidden',
					'#default_value' => isset($val['discount_by']) ? $val['discount_by'] : NULL,
				);	
				$form['product_scheduling']['Session[discountAmt]['.$key.'][scheduleDiscountType]'] = array(
					'#type' => 'select',
					'#attributes' => array(
						'class' => array(''),
					),
					'#prefix'=>'<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding_left"><div class="selectbox">',
					'#default_value' => isset($val['discount_by']) ? $val['discount_by'] : NULL,
					'#options' => array('%'=>'Amount in %','$'=>'Amount in $'),
					'#suffix' => '</div><h4>'.t('on total Amount').'</h4></div></fieldset></div>',
				);	
				
			}
		}	
		$form['product_scheduling']['another-discount'] = array(
		'#type' => 'checkbox',
		
		'#title' => t('Use another discount for this schedule'),
		'#default_value' => isset($extraDetails['repeat_session_on_'.$value]) ? $extraDetails['repeat_session_on_'.$value] : NULL,
		'#suffix'=>'</div></fieldset>'
		);
	}
$form['product_scheduling']['End-session-wrapper'] = array(
		'#type' => 'markup',
		'#suffix'=>'</div>'
		);
 
  $form['page'] = array(
	'#type' => 'hidden',
	'#default_value' => 'product_pricing'
  );

  $scheduleSessionData = getScheduleSessionData(arg(3));
  
  if($schedulingData['bookingMode'] == "INVENTORY" && !empty($scheduleSessionData)){
		
	$form['product_scheduling']['Session[scheduleID]'] = array(
		'#type' => 'hidden',
		'#default_value' => isset($schedulingData['id']) ? $schedulingData['id'] : NULL,
	);

	$form['save'] = array(
		'#type' => 'submit',
		'#attributes' => array('class'=>array('')),
		'#value' => t('Add another schedule'),
		'#prefix'=>'<fieldset>',
		'#suffix'=>'</fieldset></div></div></div></div>',
	);  
  }
  else if($schedulingData['bookingMode'] == "INVENTORY"){ 
		$form['product_scheduling']['Session[scheduleID]'] = array(
			'#type' => 'hidden',
			'#default_value' => isset($schedulingData['id']) ? $schedulingData['id'] : NULL,
		);  
		$form['save'] = array(
			'#type' => 'submit',
			'#attributes' => array('class'=>array('')),
			'#value' => t('Add another schedule'),
			'#prefix'=>'<fieldset>',
			'#suffix'=>'</fieldset></div></div></div></div>',
		); 
  }
  else{
	  $form['save'] = array(
		'#type' => 'submit',
		'#attributes' => array('class'=>array('')),
		'#value' => t('Add another schedule'),
		'#prefix'=>'<fieldset>',
		'#suffix'=>'</fieldset></div></div></div></div>',
	  ); 
  }
  
	$form['product_scheduling']['End-schedule-HTML'] = array(
	'#type' => 'markup',
	'#prefix' => '</div>'
	);
    
    
  return $form;
}



function add_calendar_events(){
	echo json_encode($_POST); die;
}

function package_payment_form($form, &$form_state){
	global $user;
	$form = array();
	$countries = getCountryListWithIsoCode();
    $traveller =user_load($user->uid);	
	$current_year=date("Y");
	$expiration_year=array();
	$form['#attributes'] = array('onsubmit' => 'return validate_booking();',
								 'class' => array('Calenderform','Calenderform_payment')
							);
	for($i=$current_year;$i<($current_year+20);$i++)
	{
	$expiration_year[$i]=$i;
	}
	$monthCount=array();
	for($i=1;$i<=12;$i++)
	{
	$monthCount[$i]=$i;
	}
	if($userDetails->field_first_name["und"][0]["value"] != ""){
	$name= ucwords($userDetails->field_first_name["und"][0]["value"]." ".$userDetails->field_last_name["und"][0]["value"]);
	}else{
	$name= ucwords($userDetails->name);
	}
	/*$form['html']=array('#prefix'=>'<div class="col-md-12 col-sm-12 col-xs-12"><h2 class="pagehead">Ranking</h2>
						</div>');*/

	$form['markup-contact-details'] = array(
	'#type' => 'markup',
	'#markup' => '<div class="card-no address-area left-col-payment"><h2 class="pagehead">Billing Address</h2>',
	);
	
	$form['first_name'] = array(
	'#type' => 'textfield',
	'#title' => 'First Name',
	'#size' => '30',
	'#required'=>true,
	"#attributes" => array("class" =>array('loc input-col half'),'placeholder'=>'First Name'),
	'#default_value'=>($traveller->field_first_name)?$traveller->field_first_name["und"][0]["value"]:$_SESSION['first_name'],
	'#prefix'=>'<div class=""><div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">',
	'#suffix'=>'</div>'
	);
	
	$form['last_name'] = array(
	'#type' => 'textfield',
	'#title' => 'Last Name',
	'#size' => '30',
	'#required'=>true,
	'#default_value'=>($traveller->field_last_name)?$traveller->field_last_name["und"][0]["value"]:$_SESSION['last_name'],
	"#attributes" => array("class" =>array('loc input-col half move-right'),'placeholder'=>'Last Name'),
	'#prefix'=>'<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">',
	'#suffix'=>'</div></div>',
	);
	
	
	$form['email'] = array(
	'#type' => 'textfield',
	'#title' => 'Email',
	'#size' => '30',
	'#required'=>true,
	"#attributes" => array("class" =>array('loc input-col'),'placeholder'=>'Email'),
	'#default_value'=>($traveller->mail)?$traveller->mail:$_SESSION['email'],
	'#prefix'=>'<div class="col-xs-12 col-sm-6 col-md-6">',
	'#suffix'=>'</div>',
	);
	$form['company'] = array(
	'#type' => 'textfield',
	'#title' => t('Company'),
	'#size' => '30',
	'#default_value'=>$_SESSION['company'],
	"#attributes" => array("class" =>array('loc input-col'),'placeholder'=>'Company'),
	'#prefix'=>'<div class="col-xs-12 col-sm-6 col-md-6">',
	'#suffix'=>'</div>',
	);
	
	$form['address'] = array(
	'#type' => 'textfield',
	'#title' => 'Address',
	'#size' => '30',
	'#default_value'=>$_SESSION['address'],
	"#attributes" => array("class" =>array('loc input-col'),'placeholder'=>'Address'),
	'#prefix'=>'<div class="col-xs-12 col-sm-6 col-md-6">',
	'#suffix'=>'</div>',
	);

	$form['city'] = array(
	'#type' => 'textfield',
	'#title' => 'City/Town/Suburb',
	'#size' => '30',
	'#default_value'=>$_SESSION['city'],
	'#required'=>true,
	"#attributes" => array("class" =>array('loc input-col'),'placeholder'=>'City/Town/Suburb'),
	'#prefix'=>'<div class="col-xs-12 col-sm-6 col-md-6">',
	'#suffix'=>'</div>',
	);

	$form['state'] = array(
	'#type' => 'textfield',
	'#title' => 'State',
	'#size' => '30',
	'#required'=>true,
	'#default_value'=>$_SESSION['state'],
	'#prefix'=>'<div class="col-xs-12 col-sm-6 col-md-6">',
	'#suffix'=>'</div>',
	"#attributes" => array("class" =>array('loc input-col'),'placeholder'=>'State'),
	);
    $form['country'] = array(
	'#type' => 'select',
	'#options' => $countries,
	'#default_value'=>$_SESSION['country'],
	'#prefix'=>'<div class="col-xs-12 col-sm-6 col-md-6"><label>'.t('Country').'</label>',
	'#required'=>true,
	'#suffix'=>'</div>',
 	"#attributes" => array("class" =>array('')),
	);	
	
	$form['zipcode'] = array(
	'#type' => 'textfield',
	'#title' => 'Postcode/ZIP',
	'#size' => '30',
	'#required'=>true,
	'#default_value'=>$_SESSION['zipcode'],
	'#prefix'=>'<div class="col-xs-12 col-sm-6 col-md-6">',
	'#maxlength'=>10,
	"#attributes" => array("class" =>array('loc input-col'),'placeholder'=>'Postcode/ZIP'),
	'#suffix' => '</div><div class="row-form">                            	
								
                            </div>'
	);
	$form['phone_number'] = array(
	'#type' => 'textfield',
	'#title' => 'Confirm Phone Number',
	'#size' => '20',
	'#required'=>true,
	'#default_value'=>$_SESSION['phone_number'],
	'#maxlength'=>15,
	"#attributes" => array("class" =>array('loc input-col'),'placeholder'=>'Phone Number'),
	'#prefix'=>'<div class="col-xs-12 col-sm-6 col-md-6">',
	'#suffix' => '</div>'
	);  
	$form['markup-payment-details'] = array(
	'#type' => 'markup',
	'#markup' => '</div><div class="card-no address-area left-col-payment"><h1 class="gray-bg">Payment</h1>',
	);
	$form['payment_type'] = array(
	'#type' => 'select',
	'#options' => array('credit-card'=>'Credit card'),
	 "#attributes" => array("class" =>array('pay-select')),
    '#prefix'=>'<div class="col-xs-12 col-sm-6 col-md-6"><label>'.t('Payment Type').'</label>',
	'#suffix'=>'</div>',	 
	);	
	$form['credit_card_type'] = array(
	'#type' => 'select',
	'#options' => array('Visa'=>'Visa','MasterCard'=>'Master Card','Amex'=>'Amex','Discover'=>'Discover'),
	 "#attributes" => array("class" =>array('pay-select')), 
	 '#prefix'=>'<div class="credit-card-details"><div class="col-xs-12 col-sm-6 col-md-6"><label>'.t('Credit Card Type').'</label>',
	'#suffix'=>'</div>',
	);	
	
	$form['credit_card_no'] = array(
	'#type' => 'textfield',
	'#title' => 'Credit Card n°',
	'#size' => '30',
	'#prefix'=>'<div class="col-xs-12 col-sm-6 col-md-6">',
	'#suffix'=>'</div>',
	"#attributes" => array("class" =>array('card-no input-col'),'placeholder'=>'Credit Card No.','autocomplete' => 'off'),
	);	

	$form['credit_expiration_month'] = array(
	'#type' => 'select',
	'#prefix' => '<div class="card-exp-month"><div class="col-xs-12 col-sm-4 col-md-4"><label>'.t('Expiration Month').'</label>',
	'#suffix'=>'</div>',
	'#options' => $monthCount,
	"#attributes" => array("class" =>array('loc','half')),
	);	
	
	
	$form['credit_expiration_year'] = array(
	'#type' => 'select',	
	'#prefix'=>'<div class="col-xs-12 col-sm-4 col-md-4"><label>'.t('Expiration year').'</label>',
	'#suffix'=>'</div>',
	'#options' =>$expiration_year,
	"#attributes" => array("class" =>array('loc','half','move-right')),
	);	
	
	
	$form['credit_varification_no'] = array(
	'#type' => 'password',
	'#title' => 'Card verification No',
	'#size' => '30',
	'#prefix'=>'<div class="col-xs-12 col-sm-4 col-md-4">',
	'#suffix'=>'</div></div>',
	"#attributes" => array("class" =>array('loc input-col'),'placeholder'=>'Card Varification No'),
	);	
	
	$form['terms_checkbox'] = array(
    '#type' => 'checkboxes',
	'#prefix' => '<fieldset><div class="col-xs-12 col-sm-12 col-md-12"><div class="terms-check">',
     '#options' => array('terms'=>'<p>'.t('I hereby agree on Gloobers Terms & Conditions.').'</p>'),
	'#suffix'=>'</div></div></fieldset>'
    );
	
	$form['amount'] = array(
	'#type' => 'hidden',
	'#default_value' => isset($_GET['total-amount'])?$_GET['total-amount']:0,
	);
	$form['booking_on'] = array(
	'#type' => 'hidden',
	'#default_value' => isset($_GET['booking-on'])?$_GET['booking-on']:'',
	);

	$form['submit'] = array(
	'#type' => 'submit',
	'#value' => t('PAY NOW'),
	'#size' => '30',
	"#attributes" => array("class" =>array('btn', 'btn-dark', 'btn-gradient', 'form-submit')),
	'#prefix'=>'<fieldset><div class="row-form"><div class="terms-check">',
	'#suffix'=>'</div></div></fieldset></div></div></div></div></div></div></div>'
	);		
	return $form;
}

function getListingPackages(){
	$packages = array();
	$query = db_select('gbl_listing_packages','p')
			->fields('p')
			->execute();
	while($data = $query->fetchAssoc()){
		$packages[] = $data;
	}
	return $packages;
}

function getPackageDetails($packageID){
	$query = db_select('gbl_listing_packages','p')
			->fields('p')
			->condition('id',$packageID)
			->execute();
	return $query->fetchAssoc();
}

function getListingPackageById($listID){
	$packages = array();
	$query = db_select('gbl_packages_transactions','t')
			->fields('t')
			->condition('listing_id',$listID)
			->execute();
	while($data = $query->fetchAssoc()){
		$packages[] = $data;
	}
	return $packages;
}
function setFreeSubscription($listId=null)
{
$listId=arg(3);
$query=db_update('gbl_experience_list')
       ->fields(array('package_id'=>3))
       ->condition('eid',$listId);
$result=$query->execute();
if($result)
{
drupal_set_message('Your Listing has been subscribed for Economy Class Successfully');
drupal_goto('product/add/success/'.$listId);
}	   
}
function product_calendar_form(){

	$eid=arg(3);
	$schedulingData=getSchedulingData($eid);
	$sessionData=getSchedulingSessionData($eid);
	$pricingData = getPricingData($eid);
	$discountData = getDiscountData($eid);
	$earlyBirdData=getDiscountInfo($eid,'Early Birds');
	$LastMinuteData=getDiscountInfo($eid,'Last Minute');
	$offer_24_Data=getDiscountInfo($eid,'24 Hour Offer');
	/* Start Function */
	global $user;  
    $eid = arg(3);
	$values = getOverviewData($eid);
	if(($eid))
	{
		if(empty($values))
		{
		drupal_set_message(t('No Listing data yet Created'),'error');
		drupal_goto('product/add/overview');
		}
		else if($user->uid!=$values['uid']){

		drupal_set_message(t('You have not access to view Listing data'),'error');
		drupal_goto('product/add/overview');
		}
	}
	$form['#attributes']['class']='pricecalendar_form';
	$form['#attributes']['onsubmit']='return calendar_form_validate();';
	$form['#attributes']['novalidate']='novalidate';
	$form['product_scheduling']['html'] = array(
	
		'#prefix'=>'<div class="col-xs-12 col-sm-12 col-md-12">
				  <h1>Pricing &amp; Calendar</h1>
				  <h2>Create your calendar </h2>  
				  </div>',
    
	);
	$form['product_scheduling']['html-calender'] = array(
	
		'#prefix'=>'<fieldset>
					<div class="col-lg-12 col-sm-12 col-xs-12 padding_left"> 
						<div class="home_town">
                        <div id="calendar"><p class="sessiontext">Click on the date to create a session </p></div>',
	    '#suffix'=>'<div class="calinfo">
								<p>Use the <span class="linkTab">Calendar sync tool</span> to <span class="linkTab">import your calendar</span> or <span class="linkTab">export your calendar</span> and sync it with other system</p>
							</div> <!-- End CalInfo -->
						</div> <!-- End Home_Town -->
					</div>  <!-- End Col -->
				</fieldset>'
    
	);
	$form['product_scheduling']['Product[confirmMode]'] = array(
	
		 '#type' => 'select',
		'#attributes' => array(
			'class' => array('select_box'),
		),
		'#prefix'=>'<fieldset>
                	<div class="col-lg-12 col-sm-12 col-xs-12 padding_left"> 
		                <div class="home_town">
			                <div class="col-lg-4 col-sm-12 col-xs-12 padding_left"><h3>Confirm Bookings </h3></div>
							<div class="col-lg-4 col-sm-12 col-xs-12 padding_left">',
	    '#suffix'=>'</div>
		                </div>
	                </div>
				</fieldset>',
		'#options' => array('AUTOCONFIRM'=>'Automatically','MANUAL'=>'Manually'),
    
	);
	 $form['product_scheduling']['Product[session_data_value]'] = array(
			'#type' => 'hidden',
			'#attributes'=>array('id'=>'session_data_value'),
		);
	$weekdays = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
	$form['product_scheduling']['repeat_session_Weekly_HTML']=array(
	'#prefix'=>'<fieldset class="repeat_session_Weekly_HTML">
                	<div class="col-lg-12 col-sm-12 col-xs-12 padding_left padding_right"> 
		                <div class="home_town">
			                <div class="col-lg-12 col-sm-12 col-xs-12 padding_left"><h3>Opening Hours </h3></div>
                            <div class="col-lg-12 col-sm-12 col-xs-12 padding_left padding_right">
                           '
	
	);
	foreach($weekdays as $key=>$value){
		
	  $form['product_scheduling']['Session[repeatonWeek]['.$value.']'] = array(
		//'#type' => 'checkbox',
		'#prefix' => '<div class="hours_row"><div class="col-md-4 col-sm-4 col-xs-4 padding_left padding_right">',
		
		//'#attributes'=>array('class'=>array('css-checkbox')),
		'#suffix'=>'<input id="'.$value.'" class="css-checkbox" type="checkbox" name="Session[repeatonWeek]['.$value.']" /> <label for="'.$value.'" class="css-label">'.$value.'</label></div>'
		);
	}
	$form['product_scheduling']['repeat_session_Weekly_HTML_END']=array(
	'#prefix'=>'</div></div></div></fieldset>'
	
	);
	$form['product_scheduling']['repeat_session_Hourly_HTML']=array(
	'#prefix'=>'<fieldset class="repeat_session_Hourly_HTML">
                	<div class="col-lg-12 col-sm-12 col-xs-12 padding_left padding_right"> 
		                <div class="home_town">
			                <div class="col-lg-12 col-sm-12 col-xs-12 padding_left"><h3>Opening Hours </h3></div>
                            <div class="col-lg-12 col-sm-12 col-xs-12 padding_left padding_right">
                            <div class="hours_row">
								<div class="col-md-4 col-sm-4 col-sm-4 col-xs-4"> </div>
                                <div class="col-md-4 col-sm-4 col-xs-4"><h3>Start</h3></div>
                                <div class="col-md-4 col-sm-4 col-xs-4"><h3>End</h3></div>
                             </div> <!-- End Hours_Row -->'
	
	);
	$day=1;
	foreach($weekdays as $key=>$value){
		
	  $form['product_scheduling']['Session[repeaton]['.$value.']'] = array(
		//'#type' => 'checkbox',
		'#prefix' => '<div class="hours_row"><div class="col-md-4 col-sm-4 col-xs-4 padding_left padding_right">',
		//'#title' => t($value),
		//'#default_value' => isset($extraDetails['repeat_session_on_'.$value]) ? $extraDetails['repeat_session_on_'.$value] : NULL,
		//'#attributes'=>array('class'=>array('css-checkbox')),
		'#suffix'=>'<input id="'.$value.'_'.$day.'" class="css-checkbox" type="checkbox" name="Session[repeaton]['.$value.']" /> <label for="'.$value.'_'.$day.'" class="css-label">'.$value.'</label></div>'
		);
	  
		$form['product_scheduling']['Session[repeatfrom]['.$value.']'] = array(
		'#type' => 'textfield',
		'#default_value' => isset($values['session_repeats_from_'.$value]) ? $values['session_repeats_from_'.$value] : NULL,
		  '#attributes' => array('placeholder'=>'From',
			'class' => array('timepicker'),
		  ),
		  '#prefix'=>'<div class="col-md-4 col-sm-4 col-xs-4">',
		  '#suffix'=>'</div>',
		);
	  
		$form['product_scheduling']['Session[repeatto]['.$value.']'] = array(
		'#type' => 'textfield',
		 '#prefix'=>'<div class="col-md-4 col-sm-4 col-xs-4">',

		'#suffix' => '</div></div>',
		'#default_value' => isset($values['session_repeats_to_'.$value]) ? $values['session_repeats_to_'.$value] : NULL,
		  '#attributes' => array('placeholder'=>'To',
			'class' => array('timepicker'),
		  ),
		);
		$day++;
	  }
		
	$form['product_scheduling']['repeat_session_HTML_END']=array(
	'#prefix'=>'</div></div></div></fieldset>'
	);
	  
	$form['product_scheduling']['Product[subscriptionID]'] = array(
    '#type' => 'hidden',
	'#default_value' => isset($schedulingData['id']) ? $schedulingData['id'] : NULL,
	);
	
	/* 24 hours Disscount Html */
		$form['product_pricing']['offers_and_discounts_24hour']=array(
		'#prefix'=>'<fieldset>
				<div class="col-md-12 col-sm-12 col-xs-12 padding_left"><h3>Offers & Discounts </h3></div>'
		
		);
	
	 $amount=unserialize($offer_24_Data['amount']);
	 $disscountBy=unserialize($offer_24_Data['discount_by']);
	 $dates=unserialize($offer_24_Data['date']);
	 
	 $my24array=array();
	 for($r=1;$r<sizeof($amount);$r++){
		$my24array[$r]['amount']=$amount[$r];
		$my24array[$r]['discountby']=$disscountBy[$r];
		$my24array[$r]['dates']=$dates[$r];
	 }
	 //echo "<pre>";Print_r($offer_24_Data);exit;
	 if($offer_24_Data)
	  {
	  //echo "11";exit;
		 $form['product_pricing']['24_hour_offer']=array(
			 '#prefix'=>'<div class="col-md-12 col-sm-12 col-xs-12 padding_left"><fieldset>
					<div class="col-md-1 col-sm-2 col-xs-12 padding_left"><img width="40" height="98" alt="image" src="'.$GLOBALS["base_url"].'/'. drupal_get_path("theme",$GLOBALS["theme"]).'/images/offer-icon.png"></div>
					<div class="col-md-11 col-sm-10 col-xs-12 padding_left">
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12 padding_left">
								<div class="pricing_cal">
									<input type="checkbox" name="24_hour_offer_check" id="24_hour_offer_check" class="css-checkbox" checked />
									<label for="24_hour_offer_check" class="css-label radGroup1">24 hours offer</label>
								</div>
							</div>'
		);
	  }
	  else
	  {
	  //echo "112";exit;
	 
	 $form['product_pricing']['24_hour_offer']=array(
			 '#prefix'=>'<div class="col-md-12 col-sm-12 col-xs-12 padding_left"><fieldset>
					<div class="col-md-1 col-sm-2 col-xs-12 padding_left"><img width="40" height="98" alt="image" src="'.$GLOBALS["base_url"].'/'. drupal_get_path("theme",$GLOBALS["theme"]).'/images/offer-icon.png"></div>
					<div class="col-md-11 col-sm-10 col-xs-12 padding_left" id="24_hours_offer_master">
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12 padding_left">
								<div class="pricing_cal">
									<input type="checkbox" name="24_hour_offer_check" id="24_hour_offer_check" class="css-checkbox" />
									<label for="24_hour_offer_check" class="css-label radGroup1">24 hours offer</label>
								</div>
							</div></div>'
							);
	  }
	  /* for($k=1;$k<sizeof(array);$k++){
	  
		$val[$k]
	  } */
		
		$form['product_pricing']['24_hour_offer']['offer_24_hour_offer_date'] = array(
		//'#type' => 'textfield',
		'#prefix' => '<div class="24_hour_offer_show"><div class="col-md-12 col-sm-12 col-xs-12 padding_left">
							<div class="col-md-4 col-sm-6 col-xs-12"><span class="labeltext">If booking is made on</span> </div>
								<div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                	<div id="datetimepicker5" class="input-group date">',
		  /* '#attributes' => array('placeholder'=>'Date',
			'class' => array('datepicker'),
			'onblur'=>'Validate24hours_type();' onblur="Validate24hours_type();" 
		  ) ,*/
		  '#suffix'=>'<input type="text" "placeholder"="Date" id="offer_24_hour_offer_Data_date"  class="offer_24_hour_offer_Data_date datepicker" name="offer_24_hour_offer_Data_date[]" value="'.$dates[0].'" ></div></div></div>',
		  //'#default_value' => isset($dateData['offer_24_hour_offer_date']) ? $dateData['offer_24_hour_offer_date'] : NULL,
		);
	  $form['product_pricing']['24_hour_offer']['offer_24_hour_price_value'] = array(
		//'#type' => 'textfield',
		'#attributes' => array('placeholder'=>'Price'),
		'#prefix'=>'<div class="col-md-2 col-sm-12 col-xs-12 padding_left padding_right"><span class="labeltext font12">Apply discount of</span></div><div class="col-md-2 col-sm-12 col-xs-12 padding_left">',
		'#suffix'=>'<input type="text" id="offer_24_hour_offer_Data_price" class="offer_24_hour_offer_Data_price" name="offer_24_hour_offer_Data_price[]" value="'.$amount[0].'"></div>',
		//'#default_value' => isset($priceData['offer_24_hour_price_value']) ? $priceData['offer_24_hour_price_value'] : NULL,
	  );
  
   $form['product_pricing']['24_hour_offer']['24_hour_offer_price_type'] = array(
    //'#type' => 'select',
	'#prefix'=>'<div class="col-md-3 col-sm-12 col-xs-12 padding_left" >',
	'#suffix'=>'<select name="offer_24_hour_offer_Data_pricetype[]" class="select_box"><option value="%">Amount in %</option><option value="$">Amount in $</option></select></div><div class="col-md-2 col-sm-12 col-xs-12 padding_left"><h5 class="para_total_amount">On total amount </h5></div>',	
	
	); 

	if(sizeof($my24array)>0){
		$varAddStart='';
	}else{
		$varAddStart='<div class="col-md-2 col-sm-12 col-xs-12 padding_left padding_right"><a  href="#" class="Add_anothers add_anothers" id="addPeriodEXP_New">Add another</a></div>';
	}
	
	$cont=1;
	
	foreach($my24array as $key=>$vals){
	if(sizeof($my24array)==$cont){
	$varSuf='<div class="col-lg-3 col-md-6 col-sm-5 col-xs-12 padding_left pull-right"><a  href="#" class="Add_anothers add_anothers" id="addPeriodEXP_New">Add another</a></div>';
	}else{$varSuf='';}
	/* if($vals['discountby']=='$'){$sel} */
	//'.$cont.'
		$form['product_pricing']['24_hour_offer']['add_new_date"'.$cont.'"'] = array(
			'#prefix' => '<div class="24_hours_discounted_clone">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_left">
							<div class="early-birds-hour-offer col-lg-3 col-md-3 col-sm-6 col-xs-12 padding_left">
							<input type="text" placeholder="Date" class="datepicker2 offer_24_hour_offer_Data_date form-text valid" id="edit-24-hour-offer-date1" name="offer_24_hour_offer_Data_date[]" value="'.$vals['dates'].'" size="60" maxlength="128">
							</div>
							<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 padding_left">
							<input type="text" placeholder="Price" class="form-text valid offer_24_hour_offer_Data_price" id="edit-24-hour-offer-price-value1" name="offer_24_hour_offer_Data_price[]" value="'.$vals['amount'].'" size="60" maxlength="128">
							</div>
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 padding_left">
							<select class="form-select select_box" id="edit-24-hour-offer-price-type" name="offer_24_hour_offer_Data_pricetype[]" style="display: none;">
							<option value="%"  selected="selected">Amount in %</option>
							<option value="$">Amount in $</option>
							</select>
							</div>
							</div><a class="delete remPeriodEXP_New" href="#">Remove</a>
							</div>',
			'#suffix'=>$varSuf
			
		); 
		$cont++;
	}
	$form['product_pricing']['24_hour_offer']['add_new_date'] = array(
		'#prefix' => ''.$varAddStart.'</div>  
				</div></div>
				</fieldset>',
		
	); 
	
	

	/* Last minute Html */
	
	$form['product_pricing']['offers_and_discounts_lastminute'] = array('#prefix' => '<fieldset>
				<div class="col-md-1 col-sm-2 col-xs-12 padding_left"><img width="40" height="98" alt="image" src="'.$GLOBALS["base_url"].'/'. drupal_get_path("theme",$GLOBALS["theme"]).'/images/offer-icon-2.png"></div>
				<div class="col-md-11 col-sm-10 col-xs-12 padding_left">'
				);
	//echo "<pre>";Print_r($LastMinuteData);exit;
	if(!empty($LastMinuteData)){
	  $form['product_pricing']['last_minutes'] = array(
		'#prefix' => '<div class="col-md-11 col-sm-10 col-xs-12 padding_left">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12 padding_left">
						<div class="pricing_cal">
							<input type="checkbox" name="last_minutes_check"  class="css-checkbox" id="last_minutes_check" value="last-minute" checked>',
		'#suffix' => '<label for="last_minutes_check" class="css-label radGroup1">Last minute offer</label></div></div>',
	  ); 
  }else{
	  $form['product_pricing']['last_minutes'] = array(
		'#prefix' => '<div class="col-md-11 col-sm-10 col-xs-12 padding_left">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12 padding_left">
						<div class="pricing_cal">
							<input type="checkbox" name="last_minutes_check"  class="css-checkbox" id="last_minutes_check" value="last-minute">',
		'#suffix' => '<label for="last_minutes_check" class="css-label radGroup1">Last minute offer</label></div></div>',
	  ); 
  }
		
  
	$form['product_pricing']['last_minutes_time_value'] = array(
		'#type' => 'textfield',
		'#prefix' => '<div class="last_minute_checked_show"><div class="col-md-12 col-sm-12 col-xs-12"><div class="col-md-4 col-sm-12 col-xs-12 padding_left padding_right"><span class="labeltext">If booking is made less than</span></div><div class="col-md-2 col-sm-12 col-xs-12 form-group padding_left">',
		  
		  '#attributes' => array('placeholder'=>'Days/Hours',
			'class' => array(''),
			'onblur'=>'validate_lastminutetime();'
		  ),
		  '#suffix'=>'</div>',
		'#default_value' => isset($LastMinuteData['time_value']) ? $LastMinuteData['time_value'] : NULL,
	  );
	 
	  $form['product_pricing']['last_minutes_time_type'] = array(
		'#type' => 'select',
		'#prefix'=>'<div class="col-md-2 col-sm-12 col-xs-12 form-group padding_left">',
		'#attributes' => array(
			'class' => array('select_box'),
			//'onchange'=>'validate_lastminutetime();'
		),
		'#default_value' => isset($LastMinuteData['time_key']) ? $LastMinuteData['time_key'] : NULL,
		'#options' => array('hour'=>'hour','day'=>'day'),
		'#suffix'=>'</div><div class="col-md-4 col-sm-12 col-xs-12 padding_left"><span class="labeltext">prior on reservation date</span></div></div>',
	    );

	  $form['product_pricing']['last_minutes_price_value'] = array(
		'#type' => 'textfield',
		'#attributes' => array('placeholder'=>'Price',
			'class' => array('themePrice'),
		), 
	   '#prefix'=>'<div class="col-md-3 col-sm-12 col-xs-12"><span class="labeltext">Apply discount of</span> </div><div class="col-md-2 col-sm-12 col-xs-12 padding_left">',
		'#suffix'=>'</div>',
		'#default_value' => isset($LastMinuteData['amount']) ? $LastMinuteData['amount'] : NULL,
	  );
	  
	 
   $form['product_pricing']['last_minutes_price_type'] = array(
		'#type' => 'select',
		'#prefix'=>'<div class="col-md-3 col-sm-12 col-xs-12 padding_left" >',
		'#attributes' => array(
			'class' => array('select_box'),
		),
		'#default_value' => isset($LastMinuteData['discount_by']) ? $LastMinuteData['discount_by'] : NULL,
	'#options' => array('%'=>'Amount in %','$'=>'Amount in $'),
	'#suffix' => '</div><div class="col-md-2 col-sm-12 col-xs-12 padding_left"><h5 class="para_total_amount">On total amount </h5></div></div></div></div></fieldset>',
   );
   
   
 /* Early birds Html*/
		 $form['product_pricing']['offers_and_discounts_earlybirds'] = array(
			'#prefix' => '<fieldset><div class="col-md-1 col-sm-2 col-xs-12 padding_left">',
			 '#suffix' => '<img width="40" height="98" alt="image" src="'.$GLOBALS["base_url"].'/'. drupal_get_path("theme",$GLOBALS["theme"]).'/images/offer-icon-3.png"></div>', 
		  );
  
   if($earlyBirdData)
  { 

	  $form['product_pricing']['early_birds'] = array(
		'#prefix' => '<div class="col-md-11 col-sm-10 col-xs-12 padding_left">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12 padding_left">
						<div class="pricing_cal">
						<input type="checkbox" name="early_birds_check" class="css-checkbox" id= "early_birds_check" value="early-bird" checked="checked" />
								<label for="early_birds_check" class="css-label radGroup1">Early birds offer</label>
           			 	</div>
					</div>',

	  );
	 
 }
  else
  { 
	 $form['product_pricing']['early_birds'] = array(
		'#prefix' => '<div class="col-md-11 col-sm-10 col-xs-12 padding_left">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12 padding_left">
						<div class="pricing_cal">
						<input type="checkbox" name="early_birds_check"  id= "early_birds_check" class="css-checkbox" value="early-bird" />
								<label for="early_birds_check" class="css-label radGroup1">Early birds offer</label>
           			 	</div>
					</div>',

	  );
	  $class="early-birds-hide";
  } 

  $form['product_pricing']['early_birds_time_value'] = array(
		'#type' => 'textfield',	
		'#prefix' => '<div class="early_bird_discount_show"><div class="col-md-12 col-sm-12 col-xs-12">
						<div class="col-md-4 col-sm-12 col-xs-12 padding_left padding_right"><span class="labeltext">If booking is made less than</span> </div>
						<div class="col-md-2 col-sm-12 col-xs-12 form-group padding_left early-birds primary '.$class.'"">',
		'#attributes' => array('placeholder'=>'Days/Months',
			'class' => array(''),
			//'onblur'=>'validate_earlybirdtime();'
		),
		'#suffix'=>'</div>',
		'#default_value' => isset($earlyBirdData['time_value']) ? $earlyBirdData['time_value'] : NULL,
  );
 
  $form['product_pricing']['early_birds_time_type'] = array(
    '#type' => 'select',
	'#attributes' => array(
		'class' => array('select_box'),
		'onchange'=>'validate_earlybirdtime();'
	),
	'#prefix'=>'<div class="col-md-2 col-sm-12 col-xs-12 form-group padding_left">',
	'#suffix'=>'</div><div class="col-md-4 col-sm-12 col-xs-12 padding_left"><span class="labeltext">prior on reservation date</span></div></div><div class="col-md-3 col-sm-12 col-xs-12"><span class="labeltext">Apply discount of</span></div>',
    '#default_value' => isset($earlyBirdData['time_key']) ? $earlyBirdData['time_key'] : NULL,
	'#options' => array('day'=>'Day','week'=>'Week','month'=>'Month'),
  );
  

  $form['product_pricing']['early_birds_price_value'] = array(
    '#type' => 'textfield',
	'#prefix'=>'<div class="col-md-2 col-sm-12 col-xs-12 padding_left">',
	'#suffix'=>'</div>',
	'#attributes' => array('placeholder'=>'Amount',
		'class' => array('themePrice'),
	), 
    
    '#default_value' => isset($earlyBirdData['amount']) ? $earlyBirdData['amount'] : NULL,
  );
  
	 
	  $form['product_pricing']['early_birds_price_type'] = array(
		'#type' => 'select',
		'#attributes' => array(
			'class' => array('select_box'),
		),
		'#prefix'=>'<div class="col-md-3 col-sm-12 col-xs-12 padding_left">',
		'#suffix'=>'</div><div class="col-md-2 col-sm-12 col-xs-12 padding_left"><h5 class="para_total_amount">On total amount </h5></div></div></div></fieldset>',
		'#default_value' => isset($earlyBirdData['discount_by']) ? $earlyBirdData['discount_by'] : NULL,
		'#options' => array('%'=>'Amount in %','$'=>'Amount in $'),
		
	  );
	  $form['product_pricing']['Submit'] = array(
		'#type' => 'submit',
		'#prefix'=>'<fieldset>',
		'#attributes' => array(
			'value' =>'Save',
		),
		'#suffix'=>'</fieldset>',
	  );

	   $form['product_pricing']['End_HTML'] = array(
			'#prefix'=>'</div></div></div></div></div>',
		);
    

	return $form;

}