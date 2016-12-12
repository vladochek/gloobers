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
		$productId=(Integer)arg(3);			
		if (is_int ($productId))
		{
		 ///update 3/18/2016

			$productDetail=getListingData($productId);				

			//if($productDetail['address1']=="" && $productDetail['state']=="" && $productDetail['country']=="") {
			  if($productDetail['state']=="" && $productDetail['country']=="") {

				$getuserpassport=getpassport();

				if($getuserpassport['location']) {
					
					$getuserpassportt=str_replace(' ', '+', $getuserpassport['location']);
					$geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.trim($getuserpassportt).'&sensor=false');
				
					$output = json_decode($geocode);
					//echo "<pre>";print_r($output);exit;	
					
					if($output) {
						foreach ($output->results[0]->address_components as $addressC) {
							if ($addressC->types[0] == "locality" || $addressC->types[0] == "premise" || $addressC->types[1] == "locality") {
							$citynew = $addressC->long_name;						
							}else if($addressC->types[0] == "locality"){
							$city = $addressC->long_name;
							} else if($addressC->types[0] == "administrative_area_level_1"){
							$state = $addressC->long_name;	
							}else if ($addressC->types[0] == "country") {
							$country = $addressC->long_name;						
							}else if ($addressC->types[0] == "postal_code") {	
							$zipcode =$addressC->long_name;						
							}
						}		

						if(!isset($city)){
							$city = $citynew;
						}				

                        if(isset($output->results[0]->geometry->location->lat)) {
                        	$latitude=$output->results[0]->geometry->location->lat;
                        }
						if(isset($output->results[0]->geometry->location->lng)) {
							$longitude=$output->results[0]->geometry->location->lng;
						}	

						/*if($output->results[0]->formatted_address){
							$set_adrs=explode(',',$output->results[0]->formatted_address);		
							$address1=$set_adrs[0];
						} else {
							$set_adrs=explode(',',$getuserpassport['location']);		
							$address1=$set_adrs[0];

						}*/

						$address1='';
						
						
                     /*   echo $getuserpassport['location'].'<br>';
						echo $city.'<br>' ;
						echo $state.'<br>' ;
						echo $country.'<br>' ;
						echo $zipcode.'<br>' ;						
						exit;*/

					$result = db_update('gbl_experience_list')->fields(array('address1'=>$address1,'latitude'=>$latitude,'longitude'=>$longitude,'city'=>$city,'state'=>$state,'zipcode'=>$zipcode,'country'=>$country)) ->condition('uid',$user->uid)->condition('eid',$productId)->execute();

					//$result = db_update('gbl_experience_list')->fields(array('address1'=>'','latitude'=>'','longitude'=>'','city'=>'','state'=>'','zipcode'=>'','country'=>'')) ->condition('uid',$user->uid)->condition('eid',$productId)->execute();

					}

				}					

			}				

		   ///	end update 3/18/2016	

		   $productDetail=getListingData($productId);		

		}

		$addressform=drupal_get_form('product_location_info_form');
		$directionform=drupal_get_form('location_direction_form');	
	    drupal_add_js(drupal_get_path('theme', 'gloobers2') .'/js/location-custom.js',array('scope' => 'footer'));	


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

	return theme('add_product', array(
	    'payment'=>$payment,'packages'=>$packages,'success'=>$success,'scheduleSessionData'=>$scheduleSessionData,
        'directionform'=>$directionform,'productForm' => $productForm,'photos'=>$photos,'extras'=>$extras,
        'extrasListing'=>$extrasListing,'productDetail'=>$productDetail,'addressform'=>$addressform,
        'addressListing'=>$addressListing,'photosListing'=>$photosListing,'subscriptionListing'=>$subscriptionListing,
        'overViewListing'=>$overViewListing,'amenitiesList'=>$amenitiesList,'Calendernew'=>$Calendernew,
        'pricingList'=>$pricingList,'schedulingList'=>$schedulingList,'rulesList'=>$rulesList,'calendar'=>$calendar
    ));
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
/*	$form['html']=array('#prefix'=>'<div class="col-md-12 col-sm-12 col-xs-12"><h2 class="pagehead">Location</h2>
						<p class="subtitle">Manage Location</p></div>');*/

    $form['transport']['Itinerary'] = array(
	'#type' => 'textarea',
    '#prefix' => '<h1>Itinerary</h1><div class="safty_left">',
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
			//drupal_set_message('No Listing data yet Created','error');
			drupal_goto('product/add/overview');
		}
		else if($user->uid!=$values['uid']){
			drupal_set_message('You have not access to view Listing data','error');
			drupal_goto('product/add/overview');
		}
	}
	$form['html']=array('#prefix'=>'<div class="col-md-12 col-sm-12 col-xs-12"><h2 class="pagehead">Overview</h2>
						<p class="subtitle"></p></div>');

	$form['#attributes']['class'][] = 'Calenderform';
 	$form['product_details'] = array(
    	'#prefix' => '<div class="col-xs-12 col-sm-22 col-md-12 save_btn_fix">',
    );


	$experienceType=getExperienceType();
//	$experienceCategory=getExperienceCategory();
  	$form['product_details']['product_type'] = array(
    	'#type' => 'select',
    	'#prefix' => '<fieldset class="overview_fields"><label>Type<span class="form-required"> *</span></label><div class="custom_full">',
    	'#default_value' => isset($values['experience_type']) ? $values['experience_type'] : '',
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
			'placeholder'=>'Activity title'
		),
		'#title' => t('Title'),
		
	    '#prefix'=>'<fieldset class="overview_fields"><div class="custom_full">',
	    '#suffix'=>'</div></fieldset>',
	    '#maxlength' =>35,
	    '#required' => TRUE
  	);

  
 	$form['product_details']['long_description'] = array(
    	'#type' => 'textarea',
    	'#title' => t('Description'),
    	'#default_value' => isset($values['brief_description']) ? trim($values['brief_description']) : '',
	  	'#attributes' => array(
			'class' => array(''),'onKeyPress'=>"return(this.value.length<5000);",
			'placeholder'=>'What makes your activity unique? What will the travelers experience?'
	  	),
	  	'#prefix'=>'<fieldset class="marg_bottom_80">',
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
	    '#value' => t('Next'),
		'#attributes' => array('class'=>array('add_over_exp')),
		'#prefix'=>'<fieldset class="full_width_fix"><div class="col-xs-12 col-sm-9 col-md-9">',
		'#suffix'=>'</div></fieldset></div></div></div></div></div></div>'
	);
  
	return $form;
}

function product_photos_form($form, &$form_state){
		
	global $user;  
    $listing_id = arg(3);
	if($listing_id!=""){
		$values = getOverviewData($listing_id);
		if(empty($values)){
  			//drupal_set_message('No Listing data yet Created','error');
			drupal_goto('product/add/overview');
		}
		else if($user->uid!=$values['uid']){
			drupal_set_message('You have not access to view Listing data','error');
			drupal_goto('product/add/overview');
		}
	}
	$form['html']=array('#prefix'=>'');
	
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
		'#prefix'=>'<fieldset class="marg_bottom_80"></fieldset><fieldset class="full_width_fix"><div class="col-xs-12 col-sm-9 col-md-9">',
		'#suffix'=>'</div></fieldset>',
		'#attributes' => array('class'=>array('')),
		'#value' => t('Next')
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
			//drupal_set_message('No Listing data yet Created','error');
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
		//drupal_set_message('No Listing data Found','error');
		drupal_goto('product/add/overview');
		}
		else if($user->uid!=$values['uid']){

		drupal_set_message('You have not access to view Listing data','error');
		drupal_goto('product/add/overview');
		}
	}
	/**************************************************************************************/
	
	if($values['country']){
		$countryList[$values['country']]=$values['country'];
	}	
	    
	$form=array();
		// $form['html']=array('#prefix'=>'<div class="col-md-12 col-sm-12 col-xs-12"><h2 class="pagehead">Location</h2>
		// 				</div>');
	//$form['product_address'] = array(
   // '#prefix' => '<div><h2>'.t('Enter Address').'</h2>',
  //  '#suffix' => '</div>',
 // );	
  $form['address1'] = array(
	'#prefix' => '<div class="outer_location_inner"><div class="row"><div class="col-xs-12 col-md-12 map_fields_style custom_six">',
	'#type' => 'textfield',
	'#attributes' => array(
		'class' => array('form-control'),'placeholder' => t('Enter the activity address here')
	),
    '#title' => t('Address'),
	'#required' => TRUE,
	'#default_value' => ($values['address1'])?$values['address1'] :"",
	'#suffix' => '</div></div>',
  );
 // $form['address2'] = array(

 //	'#prefix' => '<div class="row"><div class="col-xs-12 col-md-12 map_fields_style">',
  //   '#type' => 'textfield',
 //	'#attributes' => array(
 //		'class' => array('form-control'),'placeholder' => t('"ex. apt 50')	),
  //   '#title' => t('Address Line 2'), 
  //   '#default_value' => ($values['address2'])?$values['address2'] :"",	
 //	'#suffix' => '</div></div>',
  // );
  $form['city'] = array(
	'#prefix' => '<div class="row"><div class="col-xs-12 col-md-7 map_fields_style custom_sevan">',
    '#type' => 'textfield',
	'#attributes' => array(
	'class' => array('form-control'),'placeholder' => t('Enter city')
	),
	//'#attributes' =>array('placeholder' => t(''))
    '#title' => t('City'),
    '#required' => TRUE ,
    '#default_value' => ($values['city'])?$values['city'] :"",		
	'#suffix' => '</div>',
  );
  
    $form['zipcode'] = array(
	'#prefix' => '<div class="col-xs-12 col-md-5 map_fields_style custom_five">',
	'#type' => 'textfield',
	'#attributes' => array(
		'class' => array('form-control'),'placeholder' => t('Zip code')
	),	
    '#title' => t('ZIP'), 
    '#required' => TRUE , 
    '#maxlength' =>10,
	'#default_value' => ($values['zipcode'])?$values['zipcode'] :"",	
    '#suffix' => '</div></div>',
  );
  
 $form['state'] = array(
	 '#prefix' => '<div class="row"><div class="col-xs-12 col-md-5 map_fields_style custom_five">',
	'#type' => 'textfield',
	'#attributes' => array(	'class' => array('form-control'),'placeholder' => t('Enter state')),
    '#title' => t('State'),
    //'#required' => TRUE ,
     '#default_value' => ($values['state'])?$values['state'] :"",	
	 '#suffix' => '</div>',
  );

    $form['country'] = array(
	'#prefix' => '<div class="col-xs-12 col-md-7 map_fields_style custom_sevan">',
    '#type' => 'select',
	'#attributes' => array(
		'class' => array('form-control'),		
	),	
    '#title' => t('Country'),   
    '#required' => TRUE	,
	'#options'=>$countryList,
	'#default_value' => ($values['country'])?$values['country'] :"",
	'#suffix' => '</div></div></div>',
  );
  
   $form['Itinerary'] = array(
	'#prefix' => '<div class="itinerary_row row"><div class="col-xs-12 col-md-12 map_fields_style">',
	'#type' => 'textarea',
	'#attributes' => array(
		'class' => array('form-control'),'placeholder' => t('How can travelers get to you walking, by car or public transportation?')
	),
    '#title' => t('Itinerary'),
	//'#required' => TRUE,
	'#default_value' => ($values['direction'])?$values['direction'] :"",
	'#suffix' => '</div></div>',
  );   
	 
  $form['next'] = array(
	'#prefix' => '<fieldset class="marg_bottom_80"></fieldset><fieldset class="full_width_fix">',
    '#type' => 'button',
	'#attributes' => array('class'=>array('btn btn-dark btn-gradient')),
    '#value' => t('Next'),
	'#suffix' => '</fieldset>'
  );
  
  return $form;
	}

function product_extra_form($form, &$form_state){


	global $user,$base_url;  
    $productId = arg(3);
	$extrasListing = 1;
	$extras = getProductExtraData(arg(3));
	/*echo "<pre>";
	print_r($extras);exit;*/
	
	if($productId!="")
	{
		$values = getOverviewData($productId);
		if(empty($values))
		{
		//drupal_set_message(t('No Listing data found'),'error');
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

  $form['html']=array('#prefix'=>'<div class="row"><div class="col-md-12 col-sm-12 col-xs-12"><h2 class="pagehead">Optional services</h2></div></div>');
  $form['product_extra']['extra_service[]'] = array(
	'#prefix' => '<fieldset><div class="row"><div class="pos_rel"><div class="col-xs-10 col-md-10"><div class="col-xs-12 col-sm-12 col-md-6 padding-left-none">',
    '#type' => 'textfield',
	'#suffix'=>'</div>',
    //'#required' => TRUE,
	'#attributes' => array(
		'class' => array(''),
		'placeholder'=>'Enter title here',
	),
    '#title' => t('Service title'),
    '#default_value' => isset($extraDetails['title']) ? $extraDetails['title'] : NULL,
  );
  
  $form['product_extra']['extra_price_value[]'] = array(
    '#type' => 'textfield',
    '#prefix' => '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 padding_left"> <label>Rate</label><div class="rate_input_field">',
	'#attributes' => array(		
		'placeholder'=>'Amount',
	),
	//'#required' => TRUE,
    '#default_value' => isset($extraDetails['price']) ? $extraDetails['price'] : NULL,
	'#suffix'=>'</div>'
  );
  
  $form['product_extra']['extra_price_type[]'] = array(
    '#type' => 'select',
	'#prefix'=>'<div class="rate_icon_right">',
	'#suffix'=>'</div></div>',
	'#attributes' => array(
		'class' => array(''),
	),
    '#default_value' => isset($extraDetails['price-type']) ? $extraDetails['price-type'] : NULL,
	'#options' => array('$'=>'$','%'=>'%'),
  );
  $form['product_extra']['extra_price_key[]'] = array(
    '#type' => 'select',
	'#prefix'=>'<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 padding_left padding_right"><label>Choice</label>',
	'#attributes' => array(
		'class' => array(''),

	),
    '#default_value' => isset($values['extra_price_key']) ? $values['extra_price_key'] : NULL,
	'#options' => array('per-quantity'=>'Per quantity','per-order'=>'Per order'),
	'#suffix' => '</div></div>'
  );
 
 /* $form['product_extra']['product_extra_description'] = array(
    '#type' => 'textarea',
	'#prefix'=>'<fieldset>',
	'#suffix' => '</fieldset>',
	'#attributes' => array(
		'class' => array(''),
	),
    '#title' => t('Description'),
    '#default_value' => isset($extraDetails['description']) ? $extraDetails['description'] : NULL,
  ); */

 if(empty($metaID)){
   $form['product_extra']['product_extra_description'] = array(    
	'#prefix'=>'<div class="add_services">',
	'#suffix' => '<a class="add_more_optional">Add More</a></div></div></div></fieldset>',	   
  ); 
}else {
 $form['product_extra']['product_extra_description'] = array(    
	'#prefix'=>'<div class="add_services">',
	'#suffix' => '</div></div></div></fieldset>',	   
  ); 
}

  /*$form['next_step']=array(
	 '#prefix'=>'<fieldset class="boaders"><a href="'.url("product/add/rules/".arg(3)).'" class="add_service">Next</a></fieldset>',
   ); 
  */
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
	$form['already_added'] = array( '#prefix' => '<div class="optional_table"><fieldset><div class="help-block boader_class">
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
	$form['already_added_end'] = array( '#prefix' => '</tbody></table></div></fieldset></div>');
	}
   
 
    
    $form['next'] = array(
    '#type' => 'submit',
	'#attributes' => array('class'=>array('btn btn-dark btn-gradient exp_add_extra')),
    '#value' => t('Next'),
	'#prefix'=>'<fieldset class="marg_bottom_80"></fieldset><fieldset class="boaders full_width_fix"><div class="col-xs-12 col-sm-9 col-md-9">',
	 '#suffix'=>'</div></fieldset></div></div></div></div></div>'
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
		//drupal_set_message(t('No Listing data found'),'error');
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
	'#prefix' => '<fieldset><div class="24_hours_disscount_extra 24_hours_discounted_clone"><div class="early-birds-hour-offer col-lg-3 col-md-3 col-sm-6 col-xs-12 padding_left"><p class="pre_small_text">apply discount of </p>',
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
		//drupal_set_message(t('No Listing data found'),'error');
		drupal_goto('product/add/overview');
		}
		else if($user->uid!=$OverviewData['uid']){

		drupal_set_message(t('You have not access to view Listing data'),'error');
		drupal_goto('product/add/overview');
		}
	}
	$form['html']=array('#prefix'=>'<div class="col-md-12 col-sm-12 col-xs-12"><h2 class="pagehead">Rules and Policies</h2>
						</div>');
	
	/*if($exprienceReq)
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
			 '#attributes' => array('placeholder'=>'Add requirement here',
			'class' => array('experience-rules'),
		  ),
		  '#maxlength' =>140,
		);
		$form['product_rules']['add_experience['.$key.']'] = array(
		'#prefix' => '<div class="experience_delete"><a class="delete add-experience" href="#" id="remIncExp">Delete</a></div>',
		'#suffix' => '</div></fieldset>',
	);
	  }
	 }
	}*/
	
	/*$form['product_rules']['other_information'] = array(
		'#type' => 'textarea',
		'#prefix' =>'<fieldset>',
		'#suffix'=>'</fieldset>',
		'#title' => t("Other Information"),
		'#default_value' => isset($values['other_information']) ? $values['other_information'] : '',
		  '#attributes' => array(
			'class' => array(''),
		  ),
	);*/


$form['#attributes']['class'][] = 'Calenderform';
		$form['product_rules'] = array(
		'#prefix' => '<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 padding_left"><fieldset><label>'.t("Security Deposit").'</label>',
		
	);
 

$form['product_rules']['security_deposit'] = array(
		'#type' => 'textfield',		
		'#prefix'=>'<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_left padding-right"><div class="rate_input_field">',
		'#default_value' => isset($values['security_deposit']) ? $values['security_deposit'] :  '',
		'#attributes' => array(
		'class' => array(''),'placeholder'=>t('Amount')
		),
		'#suffix'=>'</div>',
	);
	$form['product_rules']['security_options'] = array(
	'#type' => 'select',
	'#prefix'=>'<div class="rate_icon_right">',
	'#default_value' => isset($values['security_options']) ? $values['security_options'] : '',
	  '#attributes' => array(
	'class' => array(''),
	),
	'#options'=>array('amount_in_$'=>'$','booking_%'=>'%'),
	'#suffix'=>'</div></div></fieldset></div>'
	);	

$form['product_rules']['Test'] = array(
	'#type' => 'select',
	'#prefix'=>'<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 padding_left"><fieldset>',
	'#default_value' => isset($values['cancellation_policies_type']) ? $values['cancellation_policies_type'] : '',
	  '#attributes' => array(
	'class' => array(''),
	'onchange'=>"select_cancellation(this.value);",
	),
	'#options'=>array('Relaxed'=>'Cancellation policy: Relaxed','Flexible'=>'Cancellation policy: Flexible','Moderate'=>'Cancellation policy: Moderate','Strict'=>'Cancellation policy: Strict','Super-Strict'=>'Cancellation policy: Super Strict','Custom'=>'Cancellation policy: Custom'),
	'#suffix'=>' <div class="resp-tabs-container hor_1">
                <div style="display:none" id="Relaxed" class="can_policy">				 
                   <p> <strong>Guests will receive a full refund if they cancel at least two weeks before the start of their reservation.</strong> </p>
                    <br>                    
                </div>
                <div style="display:none" id="Flexible" class="can_policy">               
                 <p> <strong>Guests will receive their full refundable deposit:</strong><br/>

						A 50% refund of their paid rental costs if they cancel at least four weeks before the start of their reservation; OR<br/>
						A 25% refund of their paid rental costs if they cancel up to two weeks before the start of their reservation.

					 </p>      
				</div>
                <div style="display:none" id="Moderate" class="can_policy">               
                   <p> <strong>Guests will receive their full refundable deposit:-</strong><br/>
						A 50% refund of their paid rental costs, if they cancel at least four weeks before the start of their reservation.
					 </p>
                    <br>                    
                </div>
                <div style="display:none" id="Strict" class="can_policy">               
                  <p> <strong>Guests will receive their full refundable deposit:</strong><br/>

					A 50% refund of their paid rental costs if they cancel at least eight weeks before the start of their reservation; OR<br/>
					A 25% refund of their paid rental costs if they cancel up to four weeks before the start of their reservation.
					<br>
				  </p>
                    <br>                    
                </div>                
                <div style="display:none" id="Super-Strict" class="can_policy">                
                <p> <strong>If the guest cancels, any money they have paid cannot be refunded.</strong></p> </div>                
                <div style="display:none" id="Custom" class="can_policy">
                <div ></select>
				</span>
				</div>
                 <p><strong>This is custom settings for Cancellation Policy.User can cut any % of price in any time of period.</strong></p>
                </div>
            </div>
	</fieldset></div>'
	);	


$form['product_rules']['cancellation_policies_type_valid'] = array(

	'#type' => 'hidden',
	'#default_value' => (trim($values['cancellation_policies_type'])) ? $values['cancellation_policies_type'] : 'Relaxed',
	'#attributes' => array(
		'id' => array('new_cancellation_select'),
	  ),
);
$form['product_rules']['cancellation_policies_type'] = array(

	'#type' => 'hidden',
	'#default_value' => (trim($values['cancellation_policies_type'])) ? $values['cancellation_policies_type'] : 'Relaxed',
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
			'class' => array(''),'placeholder'=>'Amount','onkeyup'=>'this.value = minmaxCancel(this.value, 0,100)'
		  ),
		'#default_value' => isset($values['amount_week']) ? $values['amount_week'] : '',
		 '#title' => t('A'),
	);	
$form['product_rules']['amount_week_rental']=array(
    '#type' => 'textfield',
 	  '#attributes' => array(
		'class' => array(''),
		'placeholder'=>'No of weeks/months'
	  ),
	'#default_value' => isset($values['amount_week_rental']) ? $values['amount_week_rental'] : '',
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
		'class' => array(''),'placeholder'=>'Amount','onkeyup'=>'this.value = minmaxCancel(this.value, 0,100)'
	  ),
	 
	'#default_value' => isset($values['amount_day']) ? $values['amount_day'] : '',
 	 '#title' => t('B'),
);	
$form['product_rules']['amount_day_rental']=array(
    '#type' => 'textfield',
 	  '#attributes' => array(
		'class' => array(''),
		'placeholder'=>'No of days'
	  ),
	
	'#default_value' => isset($values['amount_day_rental']) ? $values['amount_day_rental'] : '',
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


	if($exprienceReq && count($exprienceReq)>1)
	{	
	$exprience_Req=$exprienceReq[0];		
	unset($exprienceReq[0]);
	$undata=($exprienceReq);

	 $new_exp_data='';
	 $exp_data='';
	 $exp_data1=''; 
	 $countexp_req = count($undata);
	 $k=1;
	 foreach ($undata as $key=>$value)
	 {
		if($k==$countexp_req){
		$exp_data1 ='<div id="experience-require" class="experience-require"><input type="text" maxlength="140" size="60" value="'.$value.'" name="experience_rules[]" id="edit-experience-rules" class="" placeholder="Add requirement here">
		<div class="experience_delete"><a id="remIncExp" href="javascript:void(0)" class="delete">Delete</a></div>
		<div class="add-experience "><a class="addanother" href="#"  id="addIncExp">Add more</a></div></div>';
		$new_exp_data=$exp_data.$exp_data1;
		}

		$exp_data .='<div id="experience-require" class="experience-require"><input type="text" maxlength="140" size="60" value="'.$value.'" name="experience_rules[]" id="edit-experience-rules" class="" placeholder="Add requirement here">
		<div class="experience_delete"><a id="remIncExp" href="javascript:void(0)" class="delete">Delete</a></div><div class="add-experience "></div></div>';	

		$k++;
	  }

	  //echo $new_exp_data;exit;
	  
	  $form['product_rules']['experience_rules[]'] = array(
		'#type' => 'textfield',
		'#prefix' => '<fieldset><label class="text-left">'.t('Requirements').'</label><div class="experience-require left_fld" id="experience-require">',
		'#default_value' => isset($exprience_Req) ? trim($exprience_Req) : '',
		  '#attributes' => array('placeholder'=>'Add requirement here',
			'class' => array('experience-rules'),
		  ),
		  '#maxlength' =>140,

		  '#suffix' => $new_exp_data.'</div></fieldset>',
		);	
	
	} else {
		
		$form['product_rules']['experience_rules[]'] = array(
		'#type' => 'textfield',
		'#prefix' => '<fieldset ><label class="text-left">'.t('Requirements').'</label><div class="experience-require left_fld" id="experience-require">',
		'#default_value' => isset($exprienceReq[0]) ? trim($exprienceReq[0]) : '',
		  '#attributes' => array('placeholder'=>'Add requirement here',
			'class' => array('experience-rules'),
		  ),
		  '#maxlength' =>140,
		);

		$form['product_rules']['add_experience'] = array(
		'#prefix' => '<div class="add-experience "><a class="addanother" href="#"  id="addIncExp">Add more</a>',
		'#suffix' => '</div></div></fieldset>',
		);
		
	}




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
		'#attributes' => array('class'=>array('exp_rule_save')),
		'#prefix'=>'<fieldset class="marg_bottom_80"></fieldset><fieldset class="boaders full_width_fix"><div class="col-xs-12 col-sm-9 col-md-9">',
		'#suffix'=>'</div></fieldset></div></div></div></div></div>',
		'#value' => t('Next')
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
			//drupal_set_message(t('No Listing data found'),'error');
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
		//drupal_set_message(t('No Listing data yet Created'),'error');
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
	
	//update listing visibility to user.
	db_update('gbl_experience_list')
	->fields(array('visibility_status'=>1))
	->condition('eid',arg(3))->execute();	

	$query=db_select('gbl_users_meta','u');
	$query->fields('u',array('mobile','country_code','city','state','country'));
	$query->condition('uid',$user->uid);
	$result=$query->execute();
	$mob_info=$result->fetchAll(PDO::FETCH_ASSOC);
	//echo "<pre>";print_r($mob_info);exit;

	$query=db_select('gbl_user_passeport','gup');
	$query->fields('gup',array('location'));
	$query->condition('uid',$user->uid);
	$query->condition('description','I live there');
	$result1=$query->execute();
   	$location=$result1->fetchField();   	

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
	'#default_value'=>$location,
	"#attributes" => array("class" =>array('loc input-col'),'placeholder'=>'Address'),
	'#prefix'=>'<div class="col-xs-12 col-sm-6 col-md-6">',
	'#suffix'=>'</div>',
	);

	$form['city'] = array(
	'#type' => 'textfield',
	'#title' => 'City/Town/Suburb',
	'#size' => '30',
	'#default_value'=>($mob_info[0]['city'])?$mob_info[0]['city']:'',
	'#required'=>true,
	"#attributes" => array("class" =>array('loc input-col'),'placeholder'=>'City/Town/Suburb'),
	'#prefix'=>'<div class="col-xs-12 col-sm-6 col-md-6">',
	'#suffix'=>'</div>',
	);

	$form['state'] = array(
	'#type' => 'textfield',
	'#title' => 'State',
	'#size' => '30',
	//'#required'=>true,
	'#default_value'=>($mob_info[0]['state'])?$mob_info[0]['state']:'',
	'#prefix'=>'<div class="col-xs-12 col-sm-6 col-md-6">',
	'#suffix'=>'</div>',
	"#attributes" => array("class" =>array('loc input-col'),'placeholder'=>'State'),
	);
    $form['country'] = array(
	'#type' => 'select',
	'#options' => $countries,
	'#default_value'=>($mob_info[0]['country'])?$mob_info[0]['country']:'',
	'#prefix'=>'<div class="col-xs-12 col-sm-6 col-md-6"><label>'.t('Country').' <span class="form-required" title="This field is required.">*</span></label>',
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
	'#title' => 'Phone Number',
	'#size' => '20',
	'#required'=>true,
	'#default_value'=>($mob_info[0]['mobile'])?$mob_info[0]['mobile']:'',
	'#maxlength'=>15,
	"#attributes" => array("class" =>array('loc input-col'),'placeholder'=>'Phone Number'),
	'#prefix'=>'<div class="col-xs-12 col-sm-6 col-md-6">',
	'#suffix' => '</div>'
	);  
	$form['markup-payment-details'] = array(
	'#type' => 'markup',
	'#markup' => '</div><div class="card-no address-area left-col-payment payment_sec"><h1 class="gray-bg">Payment</h1>',
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
	'#options' => array('Visa'=>'Visa','MasterCard'=>'MasterCard','Amex'=>'Amex','Discover'=>'Discover'),
	 "#attributes" => array("class" =>array('pay-select')), 
	 '#prefix'=>'<div class="credit-card-details"><div class="col-xs-12 col-sm-6 col-md-6"><label>'.t('Credit Card Type').'</label>',
	'#suffix'=>'</div>',
	);	
	
	$form['credit_card_no'] = array(
	'#type' => 'textfield',
	'#title' => 'Credit Card No',
	'#size' => '30',
	'#prefix'=>'<div class="col-xs-12 col-sm-6 col-md-6">',
	'#suffix'=>'</div>',
	"#attributes" => array("class" =>array('card-no input-col'),'placeholder'=>'Credit Card No.','autocomplete' => 'off','maxlength'=>16),
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
	"#attributes" => array("class" =>array('loc input-col'),'placeholder'=>'Card Verification No'),
	);	
	
	$form['terms_checkbox'] = array(
    '#type' => 'checkboxes',
	'#prefix' => '<fieldset><div class="col-xs-12 col-sm-12 col-md-12"><div class="terms-check">',
     '#options' => array('terms'=>'I hereby agree on <a href="/terms-and-conditions" target="_blank">'.t('Gloobers Terms & Conditions.').'</a>'),
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
	'#value' => t('Pay Now'),
	'#size' => '30',
	"#attributes" => array("class" =>array('btn', 'btn-dark', 'btn-gradient', 'form-submit', 'package-validate')),
	'#prefix'=>'<fieldset class="marg_bottom_80"></fieldset><fieldset class="full_width_fix"><div class="row-form col-xs-12 col-sm-9 col-md-9"><div class="terms-check">',
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

//update listing visibility to user.
db_update('gbl_experience_list')
->fields(array('visibility_status'=>1))
->condition('eid',arg(3))->execute();	

/*if($result)
{*/
drupal_set_message('Your Listing has been subscribed for Economy Class Successfully');
drupal_goto('product/add/success/'.$listId);
/*}*/	   
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
		//drupal_set_message(t('No Listing data yet Created'),'error');
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
	
		'#prefix'=>'<div class="col-xs-12 col-sm-12 col-md-12 padding-left-none padding-right-none">
				  <h2 class="pagehead">Rates and availabilities </h2>				 
				  </div>',
    
	);


	 /*rate and availability form*/ 

	/* echo "<pre>";
	 print_r(unserialize($sessionData['pricingData']));exit;*/

	$session_getListExtraPrices= getListExtraPrice($eid);	 

	$session_pricing=""; $session_start_times=""; $session_start_dates="";

	$price_type="";
	$session_pricing_adult=""; $session_pricing_child="";	 
	$avalability_min=""; $avalability_max=""; $quantity_min=""; $quantity_max="";

	$adults_per_item_min =""; $adults_per_item_max =""; $child_per_item_min =""; $child_per_item_max ="";

	$session_privacy_public=""; $session_privacy_private="";

	$bookingMode=""; $bookingMode_NO_DATE="";
	$confirmMode_AUTOCONFIRM=""; $confirmMode_MANUAL="";

	$availability_dates=''; $seasonal_data=''; $session_time_data=''; $session_reapeatDaysTimes='';

	$selected_person='selected';
	$selected_item='';
	$person_div="style=display:block";
	$item_div="style=display:none";
	$addmore_link_display="style=display:block";
	$child_hide_div="style=display:none";
	$adult_hide_div="style=display:block";

	$child_add_person_div='';

	$selected_person_a=''; $selected_person_c=''; $session_item_price=''; $session_item_name='';

	$display_dates="style=display:block";
	 


$child_add_person_div='	<div class="row">
				<div class="col-md-8 col-sm-12 col-xs-12 marg_top10">
				<div class="col-md-5 col-sm-5 col-xs-12 padding_right">
				<div class="rate_type">

				<div class="person_type per_adult">
				<select name="product_pricing_PER_PERSON_TYPE[0][]" id="edit-product-person-type" class="select_box price-option-type product_adult_child" onchange="val_price_person();">
				<option value="adult" '.$selected_person_a.'>Per adult</option>
				<option value="child" '.$selected_person_c.'>Per child</option>
				</select>
				<i class="side_icon child_icon"><img alt="" src="http://staging.gloobers.net/sites/all/themes/gloobers2/images/child.svg"></i> <i class="side_icon adult_icon"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
				viewBox="0 0 137.8 219.8" style="enable-background:new 0 0 137.8 219.8;" xml:space="preserve">
				<g id="XMLID_4_">
				<circle id="XMLID_15_" class="st0" cx="70.3" cy="34.3" r="18.1"/>
				<path id="XMLID_6_" class="st0" d="M123.2,80.7L95.8,53.4c-0.8-0.8-1.9-1.1-3-1l0,0H70.3H46.2l0,0c-1.1,0-2.2,0.2-3.1,1L15.8,80.7
				c-0.7,0.7-1,1.6-1,2.5c0,0.9,0.3,1.8,1,2.5l27.4,27.4c0.8,0.8,2,1.1,3.1,0.9v0.4h-3v28h3v52.2c0,5.5,4.4,9.9,9.9,9.9h0
				c5.5,0,9.9-4.4,9.9-9.9v-52.2h7.7v52.2c0,5.5,4.4,9.9,9.9,9.9h0c5.5,0,9.9-4.4,9.9-9.9v-52.2h2.2v-28h-3v-0.3
				c1.1,0.2,2.2-0.1,3-0.9l27.4-27.4c0.7-0.7,1-1.6,1-2.5C124.2,82.4,123.9,81.4,123.2,80.7z M41.3,83.3l5-5v9.9L41.3,83.3z
				M92.8,88.2v-9.9l4.9,4.9L92.8,88.2z"/>
				</g>
				</svg></i>
				<div style="display:none"><img src="http://staging.gloobers.net/sites/all/themes/gloobers2/images/child.svg" alt=""/>
				<img src="http://staging.gloobers.net/sites/all/themes/gloobers2/images/adult.svg" alt=""/>
				</div>
				</div>
				</div>
				</div> <!-- End input_group -->

				<div class="col-md-5 col-sm-5 col-xs-12">
				<div class="rate_type">
				
				<div class="input-group">
				<div class="input-group-addon">$</div>
				<input type="text" name="product_pricing_PER_PERSON_TYPE[0][]" class="amount_perperson" placeholder="Amount"  />
				</div>
				</div>
				</div>			<!-- End input_group -->
				<div class="col-md-2 col-sm-2 col-xs-12">
				<div class="add-experience"><a href="#" id="addmore_person" class="addmore addPricing addanother"> Add another</a></div></div>

				</div>
				</div>';

	/*If listing exists*/			
				
	if($schedulingData){		

	    if($schedulingData['bookingMode']=='INVENTORY'){

	    $bookingMode_INVENTORY="selected";
	    $bookingMode_NO_DATE='';
	    $display_dates="style=display:block";
	    } else {
	    	
	    $bookingMode_INVENTORY="";
	    $bookingMode_NO_DATE="selected";
	    $display_dates="style=display:none";
	    } 

	    if($schedulingData['confirmMode']=='AUTOCONFIRM'){
	    $confirmMode_AUTOCONFIRM="selected";
	    $confirmMode_MANUAL='';
	   
	    } else {	    	
	    $confirmMode_AUTOCONFIRM="";
	    $confirmMode_MANUAL="selected";
	    } 
	}					

	/*If listing session exists*/
	 if($sessionData){

	 	$session_pricing=unserialize($sessionData['pricingData']);
	 	$session_start_times=unserialize($sessionData['repeatEvery']);
	 	$session_start_dates=unserialize($sessionData['startDate']);
	 	$session_reapeatDaysTimes=unserialize($sessionData['reapeatDaysTime']);
	 	$session_getListExtraPrices=unserialize($session_getListExtraPrices[0]['from_to_date']);
	 	//echo "<pre>"; print_r($session_pricing);exit;
	 	$price_type=$session_pricing[0]['price_type'];

	 	if($price_type=='PER_PERSON'){	 		 		
	 		
	 		$selected_person='selected';
	 		$selected_item='';
	 		$person_div="style=display:block";
	 		$item_div="style=display:none";
	 		$addmore_link_display="style=display:block";
	 		
	 		if(count($session_pricing)>1){
	 			$addmore_link_display="style=display:none";
	 		}	
	 		 	
				if($session_pricing[0]['price_option_type']=='adult')	{
					$session_pricing_data=$session_pricing[1]['price'];
					$selected_person_a='selected';
					$selected_person_c='';
					$child_hide_div="style=display:none";
		 			$adult_hide_div="style=display:block";
					if(count($session_pricing)>1){
						$child_hide_div="style=display:block";
		 				$adult_hide_div="style=display:block";
						$add_adult_child_div='<div class="pricediv_clone row" ><div class="col-md-8 col-sm-12 col-xs-12">
					<div class="col-md-5 col-sm-5 col-xs-12 padding_right" style="display: block;" id="product_pricing_extra">
					<div class="person_type per_adult_child add_child_icon">
					<select name="product_pricing_PER_PERSON_TYPE[1][]" id="edit-priceoption-0-priceoptiontype" class="form-select price-option-type clone_selectbox_price select_box product_adult_child"><option value="child">Per child</option></select>
					<i><img src="http://staging.gloobers.net/sites/all/themes/gloobers2/images/child.svg" alt=""/></i>
					</div></div>
					<div class="col-md-5 col-sm-5 col-xs-12 form-type-textfield form-item-PriceOption-0-price">
					<div class="input-group">
					<div class="input-group-addon">$</div>
					<input type="text" maxlength="128" size="60" name="product_pricing_PER_PERSON_TYPE[1][]" id="edit-priceoption-0-price" class="amount_perperson themePrice form-text" placeholder="Amount" value="'.$session_pricing_data.'">
					</div>
					</div>
					<div class="col-md-2 col-sm-2 col-xs-12 padding_left"><div class="experience_delete"><a href="javascript:void(0)" class="removePricing_clone delete">Remove</a>
					</div></div></div></div>';						
					}
				} else {	
					$selected_person_a='';
					$selected_person_c='selected';
		 			$session_pricing_data=$session_pricing[1]['price'];		 			
		 			$child_hide_div="style=display:block";
		 			$adult_hide_div="style=display:none";
		 			if(count($session_pricing)>1){
		 				$child_hide_div="style=display:block";
		 				$adult_hide_div="style=display:block";
		 				$add_adult_child_div='<div class="pricediv_clone row"><div class="col-md-8 col-sm-12 col-xs-12"><div class="col-md-5 col-sm-5 col-xs-12 padding_right" style="display: block;" id="product_pricing_extra"><div class="person_type per_adult_child add_adult_icon"><select name="product_pricing_PER_PERSON_TYPE[1][]" id="edit-priceoption-0-priceoptiontype" class="form-select price-option-type clone_selectbox_price select_box product_adult_child"><option value="adult">Per adult</option></select><i><img src="http://staging.gloobers.net/sites/all/themes/gloobers2/images/adult.svg" alt=""/></i></div></div><div class="col-md-5 col-sm-5 col-xs-12 form-type-textfield form-item-PriceOption-0-price"><div class="input-group"><div class="input-group-addon">$</div><input type="text" maxlength="128" size="60" name="product_pricing_PER_PERSON_TYPE[1][]" id="edit-priceoption-0-price" class="amount_perperson themePrice form-text" placeholder="Amount" value="'.$session_pricing_data.'"></div></div><div class="col-md-2 col-sm-2 col-xs-12"><div class="experience_delete"><a href="javascript:void(0)" class="removePricing_clone delete">Remove</a></div></div></div></div>';
		 				
					}
		 		}

					$child_add_person_div='	<div class="row">
					<div class="col-md-8 col-sm-12 col-xs-12 marg_top10">
					<div class="col-md-5 col-sm-5 col-xs-12 padding_right">
					<div class="rate_type">
					
					<div class="person_type per_adult">
					<select name="product_pricing_PER_PERSON_TYPE[0][]" id="edit-product-person-type" class="select_box price-option-type product_adult_child" onchange="val_price_person();">
					<option value="adult" '.$selected_person_a.'>Per adult</option>
					<option value="child" '.$selected_person_c.'>Per child</option>
					</select>
					<i class="side_icon child_icon"><img alt="" src="http://staging.gloobers.net/sites/all/themes/gloobers2/images/child.svg"></i> <i class="side_icon adult_icon"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
					viewBox="0 0 137.8 219.8" style="enable-background:new 0 0 137.8 219.8;" xml:space="preserve">
					<g id="XMLID_4_">
					<circle id="XMLID_15_" class="st0" cx="70.3" cy="34.3" r="18.1"/>
					<path id="XMLID_6_" class="st0" d="M123.2,80.7L95.8,53.4c-0.8-0.8-1.9-1.1-3-1l0,0H70.3H46.2l0,0c-1.1,0-2.2,0.2-3.1,1L15.8,80.7
					c-0.7,0.7-1,1.6-1,2.5c0,0.9,0.3,1.8,1,2.5l27.4,27.4c0.8,0.8,2,1.1,3.1,0.9v0.4h-3v28h3v52.2c0,5.5,4.4,9.9,9.9,9.9h0
					c5.5,0,9.9-4.4,9.9-9.9v-52.2h7.7v52.2c0,5.5,4.4,9.9,9.9,9.9h0c5.5,0,9.9-4.4,9.9-9.9v-52.2h2.2v-28h-3v-0.3
					c1.1,0.2,2.2-0.1,3-0.9l27.4-27.4c0.7-0.7,1-1.6,1-2.5C124.2,82.4,123.9,81.4,123.2,80.7z M41.3,83.3l5-5v9.9L41.3,83.3z
					M92.8,88.2v-9.9l4.9,4.9L92.8,88.2z"/>
					</g>
					</svg></i>
					<div style="display:none"><img src="http://staging.gloobers.net/sites/all/themes/gloobers2/images/child.svg" alt=""/>
					<img src="http://staging.gloobers.net/sites/all/themes/gloobers2/images/adult.svg" alt=""/>
					</div>
					</div>
					</div>
					</div> <!-- End input_group -->

					<div class="col-md-5 col-sm-5 col-xs-12">
					<div class="rate_type">
					
					<div class="input-group">
					<div class="input-group-addon">$</div>
					<input type="text" name="product_pricing_PER_PERSON_TYPE[0][]" class="amount_perperson" placeholder="Amount" value="'.$session_pricing[0]['price'].'" />
					</div>
					</div>
					</div>			<!-- End input_group -->
					<div class="col-md-2 col-sm-2 col-xs-12">
					<div class="add-experience" '.$addmore_link_display.'><a href="#" id="addmore_person" class="addmore addPricing addanother"> Add another</a></div></div>

					</div>
					</div>'.$add_adult_child_div;	 
	 		
	 		
	 			 		
	 	} else {
	 		$selected_person='';
	 		$selected_item='selected';
	 		$person_div="style=display:none";
	 		$item_div="style=display:block";

	 		$child_hide_div="style=display:none";
			$adult_hide_div="style=display:none";

	 		$session_item_price=$session_pricing[0]['price'];
	 		$session_item_name=$session_pricing[0]['label'];	 		

	 		$adults_per_item_min =$session_pricing[0]['adults_per_item_min'];
	 		$adults_per_item_max =$session_pricing[0]['adults_per_item_max'];
			$child_per_item_min =$session_pricing[0]['child_per_item_min'];
			$child_per_item_max =$session_pricing[0]['child_per_item_max'];

	 	}

	 	$quantity_min=$session_pricing[0]['quantity_min'];
		$quantity_max=$session_pricing[0]['quantity_max'];

	 	$avalability_min=$sessionData['avalability_min'];
	 	$avalability_max=$sessionData['avalability_max'];

	  	if($sessionData['privacy']=='PUBLIC'){
	    $session_privacy_public="selected";
	    $session_privacy_private='';
	    	   
	    } else {
	    	
	    $session_privacy_public="";
	    $session_privacy_private="selected";
	    } 	

	    	
	    if($schedulingData['bookingMode']=='INVENTORY'){

	    foreach ($session_start_dates as $key => $session_start_date) {
	    	$remove_date_period='';
	    	if($key>=1){
	    		$remove_date_period='<div class="col-md-2 col-sm-12 col-xs-12 datetimepicker_from add_period remove_period"><a href="javascript:void(0);">Remove a period</a></div>';
	    	} 

		$availability_dates .='<div class="availability_main">
		<div class="col-md-4 col-sm-6 col-xs-12 datetimepicker_from session_startdate_new" id="datetimepicker1">
		<div class="select_date_from active">
		<i class=""><span class="icon-calendar">
		<span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></span>
		</i>
		<h4>From<span class="form-required"> *</span></h4>
		<h3 id="select_from_date_'.$key.'">'.$session_start_date['from'].'</h3>

		<input type="text" class="datepicker required session_startdt" id="edit-session-startdate_new_'.$key.'" data-val="'.$key.'" name="session_startdate[]" placeholder="" value="'.$session_start_date['from'].'" autocomplete="off" readonly="true" />
		</div> <!-- End Input_group -->
		</div>
		<div class="col-md-4 col-sm-6 col-xs-12 untill_cls_div">
		<div class="select_date_from active">
		<i class=""><span class="icon-calendar">
		<span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></span>
		</i>
		<h4>To<span class="form-required"> *</span></h4>
		<h3 id="select_to_date_'.$key.'">'.$session_start_date['to'].'</h3>
		<input type="text" name="Session_UntilRepeatDate[]" id="edit-session-enddate_new_'.$key.'" data-val="'.$key.'" class="datepicker" placeholder="Date" value="'.$session_start_date['to'].'" autocomplete="off" readonly="true"/>
		</div> <!-- End Input_group -->
		</div> <!-- End Input_group -->
		'.$remove_date_period.'
		</div>';
	    	
	    }
	}

	   // echo "<pre>"; print_r($session_start_times);exit;
	    $key=1;
	   foreach ($session_start_times as $keyy => $session_start_time) {

	   	$remove_session_period='';
	   	if($key>1){
	   		$remove_session_period='<div class="add_del_btn"><a class="del_session remove_session_link">Delete session</a></div>';
	   	}	   	     	

	   	$session_start_time['Time']=date("g:i A", strtotime($session_start_time['Time']));      
	   	//$key=$key+1;
	    $session_time_data .='<div id="session_tab1" class="sessions_tab_content">
		<div class="rate_type">
			<h3 >Session '.$key.'<span class="form-required"> *</span></h3>
		</div>
		 <div class="session_content_inner">
		 <div class="offer_icon_left active">
			 <i class="">
			 <svg xml:space="preserve" enable-background="new 0 0 59.604 59.595" viewBox="0 0 59.604 59.595" height="55px" width="100px" y="0px" x="0px" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg" id="Layer_1" version="1.1">
	<path d="M29.823,0.547c-16.154,0-29.25,13.096-29.25,29.25
	s13.096,29.25,29.25,29.25s29.25-13.096,29.25-29.25S45.977,0.547,29.823,0.547z M29.823,50.547c-11.46,0-20.75-9.29-20.75-20.75
	s9.29-20.75,20.75-20.75s20.75,9.29,20.75,20.75S41.283,50.547,29.823,50.547z" class="stroke_color" stroke-width="2" stroke-linecap="round" stroke="#515151" fill="#ECECEC"/>
	<polygon points="26.698,13.047 33.073,13.047 33.073,28.34 42.573,37.172 
	37.948,42.172 26.573,31.422 " class="stroke_color" stroke-width="2" stroke-linecap="round" stroke="#515151" fill="#ECECEC"/>
	</svg>
			 </i>
			 <input type="text" class="timepicker session_timepicker" data-val="'.$key.'" id="edit-session_starttime_'.$key.'" name="session_starttime['.$key.']" placeholder="Time" readonly="true" value="'.$session_start_time['Time'].'"/>
			 <h5>Start time</h5>
			 <h6 id="session_startTime_'.$key.'">'.$session_start_time['Time'].'</h6>
			 </div>
			 <div class="hour_session_content_right">

			<ul class="sessions_tabs_menu sessions_tabs_menu_'.$key.'" data-id="'.$key.'">
			<li ';
			if (in_array("Monday", $session_start_time['weekdays']) ){ $session_time_data .= ' class="day_active weekday_menu "'; } else {$session_time_data .= ' class= weekday_menu';}
			$session_time_data .=' >
			<a href="#session_tab1">
			<i class=""><span class="icon-calendar">
			<span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></span>
			</i><h4>M</h4>
			</a>
			<input type="checkbox" name="Session_repeatonWeek['.$key.'][0]" class="css-checkbox" value="Monday" ';
			if (in_array("Monday", $session_start_time['weekdays']) ){ $session_time_data .= ' checked=checked '; }
			$session_time_data .=' ></li>
			<li ';
			if (in_array("Tuesday", $session_start_time['weekdays']) ){ $session_time_data .= ' class="day_active weekday_menu"'; } else {$session_time_data .= ' class= weekday_menu';}
			$session_time_data .=' >
			<a href="#session_tab2"><i class=""><span class="icon-calendar">
			<span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></span>
			</i><h4>T</h4>
			</a>
			<input type="checkbox" name="Session_repeatonWeek['.$key.'][1]" class="css-checkbox" value="Tuesday" ';
			if (in_array("Tuesday", $session_start_time['weekdays']) ){ $session_time_data .= ' checked=checked '; }
			$session_time_data .=' ></li>
			<li ';
			if (in_array("Wednesday", $session_start_time['weekdays']) ){ $session_time_data .= ' class="day_active weekday_menu"'; } else {$session_time_data .= ' class= weekday_menu';}
			$session_time_data .=' >
			<a href="#session_tab3"><i class=""><span class="icon-calendar">
			<span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></span>
			</i><h4>W</h4></a>
			<input type="checkbox" name="Session_repeatonWeek['.$key.'][2]" class="css-checkbox" value="Wednesday" ';
			if (in_array("Wednesday", $session_start_time['weekdays']) ){ $session_time_data .= ' checked=checked '; }
			$session_time_data .=' ></li>
			<li ';
			if (in_array("Thursday", $session_start_time['weekdays']) ){ $session_time_data .= ' class="day_active weekday_menu"'; } else {$session_time_data .= ' class= weekday_menu';}
			$session_time_data .=' >
			<a href="#session_tab4"><i class=""><span class="icon-calendar">
			<span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></span>
			</i><h4>T</h4></a>
			<input type="checkbox" name="Session_repeatonWeek['.$key.'][3]" class="css-checkbox" value="Thursday" ';
			if (in_array("Thursday", $session_start_time['weekdays']) ){ $session_time_data .= ' checked=checked '; }
			$session_time_data .=' ></li>
			<li ';
			if (in_array("Friday", $session_start_time['weekdays']) ){ $session_time_data .= ' class="day_active weekday_menu"'; } else {$session_time_data .= ' class= weekday_menu';}
			$session_time_data .=' >
			<a href="#session_tab5"><i class=""><span class="icon-calendar">
			<span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></span>
			</i><h4>F</h4></a>
			<input type="checkbox" name="Session_repeatonWeek['.$key.'][4]" class="css-checkbox" value="Friday" ';
			if (in_array("Friday", $session_start_time['weekdays']) ){ $session_time_data .= ' checked=checked '; }
			$session_time_data .=' ></li>
			<li ';
			if (in_array("Saturday", $session_start_time['weekdays']) ){ $session_time_data .= ' class="day_active weekday_menu"'; } else {$session_time_data .= ' class= weekday_menu';}
			$session_time_data .='>
			<a href="#session_tab6"><i class=""><span class="icon-calendar">
			<span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></span>
			</i><h4>S</h4></a>
			<input type="checkbox" name="Session_repeatonWeek['.$key.'][5]" class="css-checkbox" value="Saturday" ';
			if (in_array("Saturday", $session_start_time['weekdays']) ){ $session_time_data .= ' checked=checked '; }
			$session_time_data .=' ></li>
			<li ';
			if (in_array("Sunday", $session_start_time['weekdays']) ){ $session_time_data .= ' class="day_active weekday_menu"'; } else {$session_time_data .= ' class= weekday_menu';}
			$session_time_data .='>
			<a href="#session_tab7"><i class=""><span class="icon-calendar">
			<span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></span>
			</i><h4>S</h4></a>
			<input type="checkbox" name="Session_repeatonWeek['.$key.'][6]" class="css-checkbox" value="Sunday" ';
			if (in_array("Sunday", $session_start_time['weekdays']) ){ $session_time_data .= ' checked=checked '; }
			$session_time_data .=' ></li>
			</ul>
			  
			   <!--per person-->
			   <div class="row pricetype_options_PER_PERSON_1" '.$person_div.'>
				<div class="col-md-6 col-sm-6 col-xs-12 amount_perAdult_div" '.$adult_hide_div.'>
					<div class="rate_type">
					<h3>Price per adult</h3>
						<div class="input-group">
						<div class="input-group-addon">$</div>
						<input type="text" placeholder="Amount" name="amount_perAdult['.$key.']" value="'.$session_start_time['Price']['amount_perAdult'].'">
						</div>
					</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12 amount_perChild_div" '.$child_hide_div.' >
					<div class="rate_type">
					<h3>Price per children</h3>
						<div class="input-group">
						<div class="input-group-addon">$</div>
						<input type="text" placeholder="Amount" name="amount_perChild['.$key.']" value="'.$session_start_time['Price']['amount_perChild'].'">
						</div>
					</div>
				</div>
			   </div><!--end-->
			   <!--per item-->
			    <div class="row pricetype_options_PER_ITEM_1" '.$item_div.'>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="rate_type">
					<h3>Item Amount</h3>
						<div class="input-group">
						<div class="input-group-addon">$</div>
						<input type="text" placeholder="Amount" name="amount_perItem['.$key.']" value="'.$session_start_time['Price']['amount_perItem'].'">
						</div>
					</div>
				</div>				
			   </div><!--end-->
			 </div>
		</div>
		'.$remove_session_period.'		
	</div>';

$key++;}
	
	foreach ($session_getListExtraPrices as $key => $session_getListExtraPrice) {
		//echo "<pre>";
		//print_r($session_getListExtraPrice);exit;		

		$seasonal_data .='<!-- For Per person -->
	<div class="seasonnal_pricing remove_this_seasonal" >
	  <div class="col-md-4 col-sm-6 col-xs-12">
	 <div class="select_date_from active">
	 <i class=""><span class="icon-calendar">
		<span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></span>
	 </i>
	 <h4>From</h4>
	<h3 id="season_from_date_'.$key.'">'.$session_getListExtraPrice['from'].'</h3>
	<input type="text" placeholder="date" name="fromdate[]" id="session_from_'.$key.'" data-val="'.$key.'" class="datepicker session_from_dtpicker" value="'.$session_getListExtraPrice['from'].'" autocomplete="off" readonly="true">
	</div> <!-- End Input_group -->
	</div>
	<div class="col-md-4 col-sm-6 col-xs-12 ">
	 <div class="select_date_from active">
	 <i class=""><span class="icon-calendar">
		<span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></span>
	 </i>
	 <h4>To</h4>
	<h3 id="season_to_date_'.$key.'">'.$session_getListExtraPrice['todate'].'</h3>
	<input type="text" placeholder="date" name="todate[]" id="session_to_'.$key.'" data-val="'.$key.'" class="datepicker" value="'.$session_getListExtraPrice['todate'].'" autocomplete="off" readonly="true">
	</div> <!-- End Input_group -->	
	</div> <!-- End Input_group -->
	<div class="col-xs-12 col-sm-12 col-md-8">
		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="seasonnal_pricing_amount pricetype_options_PER_PERSON_1" '.$person_div.'>
					<div class="amount_perAdult_div" '.$adult_hide_div.'>
						<div class="input-group">
							<div class="input-group-addon">$</div>		
							<input type="text" placeholder="Amount per adult" id="rate_per_adult" class="rate_per_adult" name="rate_per_adult[]" value="'.$session_getListExtraPrice['rate_per_adult'].'" >
						 </div>
					</div> 
			   </div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
			  <div class="seasonnal_pricing_amount pricetype_options_PER_PERSON_1" '.$person_div.'>
				<div class="amount_perChild_div" '.$child_hide_div.'>
					<div class="input-group">
						<div class="input-group-addon">$</div>	
						<input type="text" placeholder="Amount per child" id="rate_per_child" class="rate_per_child" name="rate_per_child[]" value="'.$session_getListExtraPrice['rate_per_child'].'" >
						</div>
					</div>
				</div>
			 </div> 
		</div>
	</div>
	<div class="seasonnal_pricing_amount col-md-8 col-sm-12 col-xs-12 sessional_price_per_item padding_left" '.$item_div.'>
	 <div class="col-md-6 col-sm-12 col-xs-12">
	  <div class="input-group">
		<div class="input-group-addon">$</div>	
		<input type="text" placeholder="Amount per item" id="rate_per_item" class="rate_per_item" name="rate_per_item[]" value="'.$session_getListExtraPrice['rate_per_item'].'" >
	 </div>
	 </div> 
	</div>
	<div class="col-md-2 col-sm-12 col-xs-12 add_period remove_person_period"><a href="javascript:void(0);">Remove a period</a></div>
	</div>
	<!-- End Per person -->';
	}
	    
} 


if($seasonal_data==''){

	$seasonal_data='<!-- For Per person -->
<div class="seasonnal_pricing remove_this_seasonal" >
  <div class="col-md-4 col-sm-6 col-xs-12">
 <div class="select_date_from">
 <i class=""><span class="icon-calendar">
	<span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></span>
 </i>
 <h4>From</h4>
<h3 id="season_from_date_0">Select date</h3>
<input type="text" placeholder="date" name="fromdate[]" id="session_from_0" data-val="0" class="datepicker session_from_dtpicker" autocomplete="off" readonly="true">
</div> <!-- End Input_group -->
</div>
<div class="col-md-4 col-sm-6 col-xs-12 ">
 <div class="select_date_from">
 <i class=""><span class="icon-calendar">
	<span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></span>
 </i>
 <h4>To</h4>
<h3 id="season_to_date_0">Select date</h3>
<input type="text" placeholder="date" name="todate[]" id="session_to_0" data-val="0" class="datepicker" autocomplete="off" readonly="true">
</div> <!-- End Input_group -->
</div> <!-- End Input_group -->
<div class="col-xs-12 col-sm-12  col-md-8">
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12">
 <div class="seasonnal_pricing_amount pricetype_options_PER_PERSON_1" '.$person_div.'>
		<div class="amount_perAdult_div" '.$adult_hide_div.'>
		<div class="input-group">
			<div class="input-group-addon">$</div>		
			<input type="text" placeholder="Amount per adult" id="rate_per_adult" class="rate_per_adult"  name="rate_per_adult[]" >
		 </div>
		</div> 
 </div>
 </div>
 <div class="col-md-6 col-sm-6 col-xs-12">
 <div class="seasonnal_pricing_amount pricetype_options_PER_PERSON_1" '.$person_div.'>
	<div class="amount_perChild_div" '.$child_hide_div.'>
	<div class="input-group">
		<div class="input-group-addon">$</div>	
		<input type="text" placeholder="Amount per child" id="rate_per_child" class="rate_per_child" name="rate_per_child[]" >
	</div>
 	</div>
</div>	
 </div>
 </div>
</div>

<div class="seasonnal_pricing_amount col-md-8 col-sm-12 col-xs-12 sessional_price_per_item padding_left" '.$item_div.'>
 <div class="col-md-6 col-sm-12 col-xs-12">
  <div class="input-group">
	<div class="input-group-addon">$</div>	
	<input type="text" placeholder="Amount per item" id="rate_per_item" class="rate_per_item" name="rate_per_item[]" >
 </div>
 </div> 
</div>
<div class="col-md-2 col-sm-12 col-xs-12 add_period remove_person_period"><a href="javascript:void(0);">Remove a period</a></div>
</div>
<!-- End Per person -->';

}


if($session_time_data==''){

	$session_time_data='<div id="session_tab1" class="sessions_tab_content" data-id="1">
		<div class="rate_type">
			<h3 >Session 1<span class="form-required"> *</span></h3>
		</div>
		 <div class="session_content_inner">
		 <div class="offer_icon_left">
			 <i class="">
			 <svg xml:space="preserve" enable-background="new 0 0 59.604 59.595" viewBox="0 0 59.604 59.595" height="55px" width="100px" y="0px" x="0px" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg" id="Layer_1" version="1.1">
	<path d="M29.823,0.547c-16.154,0-29.25,13.096-29.25,29.25
	s13.096,29.25,29.25,29.25s29.25-13.096,29.25-29.25S45.977,0.547,29.823,0.547z M29.823,50.547c-11.46,0-20.75-9.29-20.75-20.75
	s9.29-20.75,20.75-20.75s20.75,9.29,20.75,20.75S41.283,50.547,29.823,50.547z" class="stroke_color" stroke-width="2" stroke-linecap="round" stroke="#515151" fill="#ECECEC"/>
	<polygon points="26.698,13.047 33.073,13.047 33.073,28.34 42.573,37.172 
	37.948,42.172 26.573,31.422 " class="stroke_color" stroke-width="2" stroke-linecap="round" stroke="#515151" fill="#ECECEC"/>
	</svg>
			 </i>
			 <input type="text" class="timepicker session_timepicker" id="edit-session_starttime_0"  data-val="0" name="session_starttime[0]" placeholder="Time" readonly="true" />
			 <h5>Start time</h5>
			 <h6 id="session_startTime_0">Select time</h6>
			 </div>
			 <div class="hour_session_content_right">
			<ul class="sessions_tabs_menu sessions_tabs_menu_0" data-id="0">
			<li class="weekday_menu">
			<a href="#session_tab1">
			<i class=""><span class="icon-calendar">
			<span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></span>
			</i><h4>M</h4>
			</a>
			<input type="checkbox" value="Monday" class="css-checkbox" name="Session_repeatonWeek[0][0]"></li>
			<li class="weekday_menu">
			<a href="#session_tab2"><i class=""><span class="icon-calendar">
			<span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></span>
			</i><h4>T</h4>
			</a>
			<input type="checkbox" value="Tuesday" class="css-checkbox" name="Session_repeatonWeek[0][1]"></li>
			<li class="weekday_menu">
			<a href="#session_tab3"><i class=""><span class="icon-calendar">
			<span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></span>
			</i><h4>W</h4></a>
			<input type="checkbox" value="Wednesday" class="css-checkbox" name="Session_repeatonWeek[0][2]"></li>
			<li class="weekday_menu">
			<a href="#session_tab4"><i class=""><span class="icon-calendar">
			<span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></span>
			</i><h4>T</h4></a>
			<input type="checkbox" value="Thursday" class="css-checkbox" name="Session_repeatonWeek[0][3]"></li>
			<li class="weekday_menu">
			<a href="#session_tab5"><i class=""><span class="icon-calendar">
			<span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></span>
			</i><h4>F</h4></a>
			<input type="checkbox" value="Friday" class="css-checkbox" name="Session_repeatonWeek[0][4]"></li>
			<li class="weekday_menu">
			<a href="#session_tab6"><i class=""><span class="icon-calendar">
			<span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></span>
			</i><h4>S</h4></a>
			<input type="checkbox" value="Saturday" class="css-checkbox" name="Session_repeatonWeek[0][5]"></li>
			<li class="weekday_menu">
			<a href="#session_tab7"><i class=""><span class="icon-calendar">
			<span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></span>
			</i><h4>S</h4></a>
			<input type="checkbox" value="Sunday" class="css-checkbox" name="Session_repeatonWeek[0][6]"></li>
			</ul>			   
			   <!--per person-->
			   <div class="row pricetype_options_PER_PERSON_1">
				<div class="col-md-6 col-sm-6 col-xs-12 amount_perAdult_div" '.$adult_hide_div.'>
					<div class="rate_type">
					<h3>Price per adult</h3>
						<div class="input-group">
						<div class="input-group-addon">$</div>
						<input type="text" placeholder="Amount" name="amount_perAdult[]">
						</div>
					</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12 amount_perChild_div" '.$child_hide_div.'>
					<div class="rate_type">
					<h3>Price per children</h3>
						<div class="input-group">
						<div class="input-group-addon">$</div>
						<input type="text" placeholder="Amount" name="amount_perChild[]">
						</div>
					</div>
				</div>
			   </div><!--end-->
			   <!--per item-->
			    <div class="row pricetype_options_PER_ITEM_1" '.$item_div.'>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="rate_type">
					<h3>Item Amount</h3>
						<div class="input-group">
						<div class="input-group-addon">$</div>
						<input type="text" placeholder="Amount" name="amount_perItem[]">
						</div>
					</div>
				</div>				
			   </div><!--end-->
			 </div>
		</div>		
	</div>';
}


if($availability_dates==''){

	$availability_dates='<div class="availability_main" '.$display_dates.'>
	<div class="col-md-4 col-sm-6 col-xs-12 datetimepicker_from session_startdate_new" id="datetimepicker1">
	<div class="select_date_from">
	<i class=""><span class="icon-calendar">
	<span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></span>
	</i>
	<h4>From<span class="form-required"> *</span></h4>
	<h3 id="select_from_date_0">Select date</h3>

	<input type="text" class="datepicker required session_startdt" id="edit-session-startdate_new_0" data-val="0" name="session_startdate[]" placeholder="" autocomplete="off" readonly="true"/>
	</div> <!-- End Input_group -->
	</div>
	<div class="col-md-4 col-sm-6 col-xs-12 untill_cls_div">
	<div class="select_date_from">
	<i class=""><span class="icon-calendar">
	<span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></span>
	</i>
	<h4>To<span class="form-required"> *</span></h4>
	<h3 id="select_to_date_0">Select date</h3>
	<input type="text" name="Session_UntilRepeatDate[]" id="edit-session-enddate_new_0" data-val="0" class="datepicker" placeholder="Date" autocomplete="off" readonly="true"/>
	</div> <!-- End Input_group -->
	</div> <!-- End Input_group -->
	</div>';
}



  $rate_data ='<div class="rate_availability">
<div class="col-md-12 col-sm-12 col-xs-12 padding-left-none padding-right-none">
<div class="eventpopup_panel">
<div class="rate_sec_inner">
<fieldset class="col_wrap border_btm">
	
		<div class="col-md-8  col-sm-12 col-xs-12">
		<div class="rate_type selected_blue">
		 <h2 id="Rate_type">Rate type<span class="form-required"> *</span></h2>
		 <select name="product_pricing_type" id="edit-product-pricing-type" class="select_box" >
				<option value="PER_PERSON" '.$selected_person.'> Per person</option>
				<option value="PER_ITEM" '.$selected_item.'> Per item</option>
		</select>
		</div>
		</div> <!-- End input_group onchange="hide_clone();"-->
		<!-- Per person Pricing -->
		<div class="product_pricing pricetype_options_PER_PERSON" '.$person_div.'>		   
			
		'.$child_add_person_div.'		
		
		</div>

		<!-- Per item Pricing -->
		<div class="product_pricing pricetype_options_PER_ITEM col-md-8  col-sm-12 col-xs-12 marg_top10" '.$item_div.'>
			<div class="col-md-6 col-sm-6 col-xs-12 padding-left-none">
			<div class="rate_type">
			
			<input type="text" name="product_pricing_PER_ITEM_TYPE[0][]" class="item_name" placeholder="Item name" value="'.$session_item_name.'" />
			</div></div> <!-- End input_group -->

			<div class="col-md-6 col-sm-6 col-xs-12 padding-right-none">
			<div class="rate_type">
			
			<div class="input-group">
			<div class="input-group-addon">$</div>
			 <input type="text" name="product_pricing_PER_ITEM_TYPE[0][]" placeholder="Amount" class="amount_peritem" value="'.$session_item_price.'" />
			</div>
			</div>
			</div> <!-- End input_group -->
			<!-- Updated 11-02-2016  -->
			<!-- <div class="col-md-2 col-sm-2 col-xs-12 col_wrap item_add"> <a href="#" id="addmore_item" class="addmore addPricing additem_more"> Add another</a></div>-->
		   <!-- End Updated 11-02-2016  -->
		</div>
</fieldset>
<div class="col_wrap border_btm">
<fieldset class="col_wrap">	
		<div class="col-md-12  col-sm-12 col-xs-12">
		<div class="rate_type">
		 <h2>Session settings</h2>
		 <div class="row">
		   <!--div class="col-md-5  col-sm-6 col-xs-12">
		     <div><h3>Confirm bookings </h3></div>
		 <select name="Product_confirmMode" id="edit-product-confirmmode" class="select_box form-select" >
				<option value="AUTOCONFIRM" '.$confirmMode_AUTOCONFIRM.'>Automatically</option>
				<option value="MANUAL" '.$confirmMode_MANUAL.'>Manually</option>
		</select>
		   </div-->
		   <div class="col-md-7 col-sm-6 col-xs-12">
		     <div><h3>Session privacy </h3></div>
			 <select name="Product_privacy" id="edit-product-privacy" class="select_box form-select" >
				<option value="PUBLIC" '.$session_privacy_public.'>Public: Allow bookings until a session is full</option>
				<option value="PRIVATE" '.$session_privacy_private.'>Private: Allow only one booking per session</option>
			</select>
		   </div>
		 </div>
		</div>
		</div> <!-- End input_group onchange="hide_clone();"-->		
</fieldset>
<div class="col-md-4 col-sm-6 col-xs-12">
<fieldset class="col_wrap pricetype_options_PER_PERSON_qty" '.$person_div.'>
 
  <div class="rate_type">
   <h3>Min/Max person per booking<span class="form-required"> *</span></h3>

  <div class="occupancy_item">
	<input type="text" name="product_person_min" placeholder="Min" id="product_person_min" value="'.$quantity_min.'" />
  </div>
  <div class="occupancy_item">
	<input type="text" name="product_person_max" placeholder="Max" id="products_person_max" value="'.$quantity_max.'" />
  </div><!-- End Input_group -->
</div>
<!-- End Input_group -->
</fieldset>
</div>
<fieldset class="col_wrap pricetype_options_PER_ITEM_qty" '.$item_div.'>
<div class="col-md-4 col-sm-6 col-xs-12">
<div class="rate_type">
 <h3 id="Item_booking">Min/Max '. (($session_item_name == "") ? "item" : $session_item_name) .' per booking<span class="form-required"> *</span></h3>
 <div class="occupancy_item">
  <input type="text" id="product_item_min" name="product_item_min" placeholder="Min" value="'.$quantity_min.'"/> 
 </div>
 <!-- End Input_group -->
  <div class="occupancy_item">
   <input type="text" id="product_item_max" name="product_item_max" placeholder="Max" value="'.$quantity_max.'"/>
  </div>
 <!-- End Input_group -->
 </div>
</div> <!-- End Col -->

<div class="col-md-4 col-sm-6 col-xs-12">
<div class="rate_type">
 <h3 id="Item_adult">Min/Max adults per '. (($session_item_name == "") ? "item" : $session_item_name) .'<span class="form-required"> *</span></h3>
 <div class="occupancy_item">
  <input type="text" name="produt_item_per_adult_min" id="product_item_per_adult_min" placeholder="Min" value="'.$adults_per_item_min.'" />
 </div>
 <!-- End Input_group -->
  <div class="occupancy_item">
   <input type="text" name="produt_item_per_adult_max" id="product_item_per_adult_max" placeholder="Max" value="'.$adults_per_item_max.'" />
  </div>
 <!-- End Input_group -->
 </div>
</div> <!-- End Col -->

<div class="col-md-4 col-sm-6 col-xs-12">
<div class="rate_type">
 <h3 id="Item_child">Min/Max children per '. (($session_item_name == "") ? "item" : $session_item_name) .'<span class="form-required"> *</span></h3>
 <div class="occupancy_item">
  <input type="text" name="produt_item_per_child_min" placeholder="Min" id="product_item_per_child_min" value="'.$child_per_item_min.'" />
 </div>
 <!-- End Input_group -->
  <div class="occupancy_item">
   <input type="text" name="produt_item_per_child_max" placeholder="Max" id="product_item_per_child_max" value="'.$child_per_item_max.'" />
  </div>
 <!-- End Input_group -->
 </div>
</div> <!-- End Col -->
</fieldset>
<div class="col-md-4 col-sm-6 col-xs-12">
<fieldset class="col_wrap">
	<div class="rate_type">
	  <h3 class="person_Item_availability" '.$person_div.'>Min/Max person per session<span class="form-required"> *</span></h3>
	  <h3 class="person_Item_availability" '.$item_div.'>Min/Max '. (($session_item_name == "") ? "item" : $session_item_name) .' per session<span class="form-required"> *</span></h3>		  
	
		<div class="occupancy_item">
		 <input type="text" id="min_avail" name="Product_inventoryModemin" placeholder="Min" value="'.$avalability_min.'" />
		</div>
		<div class="occupancy_item">
		 <input type="text" id="max_avail" name="Product_inventoryModemax" placeholder="Max" value="'.$avalability_max.'" />
	</div>
	 <!-- End Input_group -->
	</div>
	<!-- End Col -->
</fieldset>
</div>
</div>
<div class="col_wrap border_btm">
 <fieldset class="col_wrap">
<div class="col-md-8 col-sm-12 col-xs-12"><div class="rate_type"><h2 id="Availability_settings">Availability settings</h2></div></div>
<div class="col-md-8 col-sm-12 col-xs-12">
	<select  class="select_box" id="booking_type_date" name="Product_bookingMode" onchange="get_date_html(this);">
		<option value="INVENTORY" '.$bookingMode_INVENTORY.'> This activity is available on specific periods</option>
		<option value="NO_DATE" '.$bookingMode_NO_DATE.'> This activity is available all year long</option>
	</select>
</div> <!-- End Col -->
<!-- End Centerbox -->
</fieldset>


<div class="date_required_data">
<fieldset class="col_wrap session-from-to">
'. $availability_dates.'
<div class="col-md-2 col-sm-12 col-xs-12 datetimepicker_from add_period add_date_period" '.$display_dates.'><a href="javascript:void(0);">Add a period</a></div>
</fieldset>
<div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 openning_days_main">
<div class="rate_type">
<h2 id="Opening_days">Opening days and sessions hours</h2>
</div>
<div class="sessions_hours_content">
<div id="tabs-container">

<div class="sessions_tab_content_main">	
'.$session_time_data.'	
<div class="add_del_btn">
<a class="add_session_link" href="javascript:void(0);">Add session</a>	
</div>
</div>
</div>
</div>
</div>

</div>

</div>
<div class="col_wrap border_btm">
    <div class="col-md-12 col-sm-12 col-xs-12 pricecalendar_form">

	<!--?php echo $checkBoxSession; ?-->

	<!-- <label class="css-label radGroup1 text-left" for="sesonal_price_checked_id">Seasonnal pricing</label> -->
	 <div class="rate_type"><h2 class="text-left" id="Seasonnal_pricing">Seasonal pricing</h2></div>

	</div>
	
<fieldset class="col_wrap sesonal_price_div_show">
'.$seasonal_data.'
<div class="col-md-2 col-sm-12 col-xs-12 add_period per_person_period"><a href="javascript:void(0);">Add a period</a></div>
</fieldset>	
</div>

</div>
</div> <!-- End EventPopUp_Panel -->
</div> <!-- End Col -->
</div> <!-- End EventPopUp_Lightbox -->

<!--Updated 17-02-2016 , Updated 19-02-2016-->

<div class="individual_session_popup"><!-- starts individual_session_popup -->
<div class="col-md-12 col-sm-12 col-xs-12">
<div class="eventpopup_panel">
<div class="closepopup"><i class="fa fa-remove"></i></div>
<div class="date_required_data">

<fieldset>
         <div class="col-xs-12 col-sm-9 col-md-9">   
		 <div class="help-block boader_class">
            <div class="heading_help edit_date_heading"></div>
            
            <table class="table2">
			<!-- <thead>
			  <tr>
				<th>Starts on</th>				
				<th colspan="2">Actions</th>
			  </tr>
			</thead> -->
	<tbody class="session_pricing_data">	

	</tbody>
  </table>
</div>
</div>
</fieldset>

</div>

</div> <!-- End EventPopUp_Panel -->
</div> <!-- End Col -->
</div> <!-- End individual_session_popup -->';


$form['product_scheduling']['rate_availability_HTML']=array(
	'#prefix'=>"$rate_data",
	
	);


/*end of rate and availability form*/

	  
	$form['product_scheduling']['Product[subscriptionID]'] = array(
    '#type' => 'hidden',
	'#default_value' => isset($schedulingData['id']) ? $schedulingData['id'] : NULL,
	);


	$form['product_pricing']['offers_and_discounts_24hour']=array(
		'#prefix'=>'<div class="col_wrap border_btm"><fieldset>
				<div class="col-md-12 col-sm-12 col-xs-12"><div class="rate_type"><h2 id="Special_offers">Special offers </h2></div></div></fieldset>'
		
		);


/* Early birds Html*/

  
   if($earlyBirdData)
  { 

		 $form['product_pricing']['offers_and_discounts_earlybirds'] = array(
		'#prefix' => '<div class="col-md-12 col-sm-12 col-xs-12 pos_static"><fieldset>
					<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 padding_left">
			 <div class="offer_icon_left active">
			 <h5 id="24_hour_offer">Early birds</h5>
			 <i class="icon-rates">
					<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
					viewBox="0 0 64 61.5" style="enable-background:new 0 0 64 61.5;" xml:space="preserve">
					<style type="text/css">
					.st0{fill:none;stroke:#444443;stroke-width:1.45;stroke-miterlimit:10;}
					</style>
					<g id="XMLID_2_">
					<path id="XMLID_7_" class="st0" d="M50.4,19.1c0,0-6.6-7.1-9.1-1c-1,3.5-2.4,7.3-2.4,7.3s-4.9,6.1-8.4,0c-0.1-2,2.1-9.3-6.1-10.6
					c-3.4-0.1-15.7-0.5-18.7-2.4c-0.8,1.5,1.6,5,3.3,5.6c0,0.9-0.8,4,3.1,4.8c0.9,0.8,0.3,3.9,4.8,4.6c0.1,0.8-0.4,3.3,7,3.4
					c1.3,0.3,7.9,0.2,4.6,5C26,39.8,24,45.8,11.2,48.1c0.5,0.9,0.5,4,4.2,4c0.2,0.3-0.9,2.5,5,2c0.5,0.7,3.1,1.7,5.3,0
					c0,0,0.2-10.8,5.4-10.7c2.4,0,8.4-0.4,8.4-0.4s10.5-0.8,7.8-15.3C46.9,26.4,45.5,20.4,50.4,19.1z"/>
					<ellipse id="XMLID_6_" class="st0" cx="47.7" cy="18.7" rx="1.6" ry="1.5"/>
					<path id="XMLID_5_" class="st0" d="M54.3,18.7C51,15.8,43.1,7.6,38.9,17c-0.8,1.9-1.9,6.2-1.9,6.2l-0.6,1.6c0,0-1.7,2.3-2.8,0
					c-0.3-0.7,0-6.5,0-6.5s-0.2-5.4-8.1-6.3c-1.3-0.3-15,0.7-22-2.8c0,0-4.6,5,1.4,9.4c0.4,0.9-0.7,5.5,5.5,6.4c0,0.6-1.1,4.5,3.4,4.5
					c0,0,0.2,5.1,8.4,3.5c1.4-0.3,8.1-0.8,0.3,7.3c-1.2,1-4.6,3.8-11.3,4.4c-3.4,0.3-8.1,3.2-1.7,6.1c0,0-1.2,4.5,4.2,4
					c0.3,0.2-1.6,3.2,5,2c0.3,0.5-0.1,3,5.3,1.8c0.6,0.5,2.8,1.6,3.9-1c0.3-1.7,1-11.2,4.7-11.5c3.8-0.3,15.5,0.8,17.8-10
					c0,0,0.9-5.3-0.3-8.7c0,0-1.2-4.9,0.6-5.9C52.8,21.1,57.9,21.8,54.3,18.7z"/>
					<path id="XMLID_4_" class="st0" d="M58,3.7c0,0,5.5-4.6,4.3,1.2c-0.4,2.1-6.9,9.7-7.9,13.8c-2.1-1.9-5.8-4.6-5.8-4.6l-2.7-1.5
					c0,0,1.4-4.8,6.9-6.7C54.4,5.3,55.5,5.2,58,3.7z"/>
					<path id="XMLID_3_" class="st0" d="M48.7,13.6c0,0,0.5-3.9,7.6-5.4c-0.2,0.7-1.4,4.6-4.6,7.9L48.7,13.6z"/>
					</g>
					</svg>
			 </i>
			 </div>
		</div>', 
		);

	  $form['product_pricing']['early_birds'] = array(
		'#prefix' => '<div class="col-lg-5 col-md-6 col-sm-12 col-xs-12">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="pricing_cal">
						<input type="checkbox" name="early_birds_check" class="css-checkbox" id= "early_birds_check" value="early-bird" checked="checked" />
								<label for="early_birds_check" class="css-label radGroup1">Early birds offer</label>
           			 	</div>
					</div>',

	  );
	 
 }
  else
  { 

	 $form['product_pricing']['offers_and_discounts_earlybirds'] = array(
	'#prefix' => '<div class="col-md-12 col-sm-12 col-xs-12 pos_static"><fieldset>
					<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 padding_left">
		 <div class="offer_icon_left">
		 <h5 id="24_hour_offer">Early birds</h5>
		 <i class="icon-rates">
			<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			viewBox="0 0 64 61.5" style="enable-background:new 0 0 64 61.5;" xml:space="preserve">
			<style type="text/css">
			.st0{fill:none;stroke:#444443;stroke-width:1.45;stroke-miterlimit:10;}
			</style>
			<g id="XMLID_2_">
			<path id="XMLID_7_" class="st0" d="M50.4,19.1c0,0-6.6-7.1-9.1-1c-1,3.5-2.4,7.3-2.4,7.3s-4.9,6.1-8.4,0c-0.1-2,2.1-9.3-6.1-10.6
			c-3.4-0.1-15.7-0.5-18.7-2.4c-0.8,1.5,1.6,5,3.3,5.6c0,0.9-0.8,4,3.1,4.8c0.9,0.8,0.3,3.9,4.8,4.6c0.1,0.8-0.4,3.3,7,3.4
			c1.3,0.3,7.9,0.2,4.6,5C26,39.8,24,45.8,11.2,48.1c0.5,0.9,0.5,4,4.2,4c0.2,0.3-0.9,2.5,5,2c0.5,0.7,3.1,1.7,5.3,0
			c0,0,0.2-10.8,5.4-10.7c2.4,0,8.4-0.4,8.4-0.4s10.5-0.8,7.8-15.3C46.9,26.4,45.5,20.4,50.4,19.1z"/>
			<ellipse id="XMLID_6_" class="st0" cx="47.7" cy="18.7" rx="1.6" ry="1.5"/>
			<path id="XMLID_5_" class="st0" d="M54.3,18.7C51,15.8,43.1,7.6,38.9,17c-0.8,1.9-1.9,6.2-1.9,6.2l-0.6,1.6c0,0-1.7,2.3-2.8,0
			c-0.3-0.7,0-6.5,0-6.5s-0.2-5.4-8.1-6.3c-1.3-0.3-15,0.7-22-2.8c0,0-4.6,5,1.4,9.4c0.4,0.9-0.7,5.5,5.5,6.4c0,0.6-1.1,4.5,3.4,4.5
			c0,0,0.2,5.1,8.4,3.5c1.4-0.3,8.1-0.8,0.3,7.3c-1.2,1-4.6,3.8-11.3,4.4c-3.4,0.3-8.1,3.2-1.7,6.1c0,0-1.2,4.5,4.2,4
			c0.3,0.2-1.6,3.2,5,2c0.3,0.5-0.1,3,5.3,1.8c0.6,0.5,2.8,1.6,3.9-1c0.3-1.7,1-11.2,4.7-11.5c3.8-0.3,15.5,0.8,17.8-10
			c0,0,0.9-5.3-0.3-8.7c0,0-1.2-4.9,0.6-5.9C52.8,21.1,57.9,21.8,54.3,18.7z"/>
			<path id="XMLID_4_" class="st0" d="M58,3.7c0,0,5.5-4.6,4.3,1.2c-0.4,2.1-6.9,9.7-7.9,13.8c-2.1-1.9-5.8-4.6-5.8-4.6l-2.7-1.5
			c0,0,1.4-4.8,6.9-6.7C54.4,5.3,55.5,5.2,58,3.7z"/>
			<path id="XMLID_3_" class="st0" d="M48.7,13.6c0,0,0.5-3.9,7.6-5.4c-0.2,0.7-1.4,4.6-4.6,7.9L48.7,13.6z"/>
			</g>
			</svg>
		 </i>
		 </div>
	</div>', 
	);
	 $form['product_pricing']['early_birds'] = array(
		'#prefix' => '<div class="col-lg-5 col-md-6 col-sm-12 col-xs-12">
					<div class="col-md-12 col-sm-12 col-xs-12">
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
		'#prefix' => '<div class="early_bird_discount_show"><div class="col-md-12 col-sm-12 col-xs-12 padding_left padding_right">
						<div class="row"><div class="col-md-12 col-sm-12 col-xs-12">
						<div class="col-md-12 col-sm-12 col-xs-12 padding_left padding_right"><span class="labeltext">If booking is made more than</span> </div><div class="col-md-12 col-sm-12 col-xs-12 padding_left padding_right"><div class="col-md-4 col-sm-6 col-xs-12 form-group padding_left early-birds primary '.$class.'"">',
		'#attributes' => array('placeholder'=>'',
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
	'#prefix'=>'<div class="col-md-8 col-sm-6 col-xs-12 form-group padding_left padding_right">',
	'#suffix'=>'</div></div><div class="col-md-12 col-sm-12 col-xs-12 padding_left padding_right"><span class="labeltext">prior to arrival, apply discount of</span></div></div></div></div>',
    '#default_value' => isset($earlyBirdData['time_key']) ? $earlyBirdData['time_key'] : NULL,
	'#options' => array('day'=>'days','week'=>'weeks','month'=>'months'),
  );
  

  $form['product_pricing']['early_birds_price_value'] = array(
    '#type' => 'textfield',
	'#prefix'=>'<div class="col-md-12 col-sm-12 col-xs-12 padding_left padding_right"><div class="row"><div class="col-md-12 col-sm-12 col-xs-12"><div class="col-md-6 col-sm-6 col-xs-12 padding_left">',
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
		'#prefix'=>'<div class="col-md-6 col-sm-6 col-xs-12 padding_right">',
		'#suffix'=>'</div></div></div></div></div></fieldset>',
		'#default_value' => isset($earlyBirdData['discount_by']) ? $earlyBirdData['discount_by'] : NULL,
		'#options' => array('%'=>'in %','$'=>'in $'),
		
	  );
	
	/* 24 hours Disscount Html */		
	
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
			 '#prefix'=>'<fieldset>
		             <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 padding_left">
					 <div class="offer_icon_left active">
					 <h5>24 hour offer</h5>
					 <i class=""><span class="icon-calendar">
                <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span>
                </span></i>
					 </div>
					</div>
					<div class="col-lg-5 col-md-6 col-sm-12 col-xs-12">
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
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
			 '#prefix'=>'<fieldset>
		             <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 padding_left">
					 <div class="offer_icon_left">
					 <h5>24 hour offer</h5>
					 <i class=""><span class="icon-calendar">
                <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span>
                </span></i>
					 </div>
					</div>
					<div class="col-lg-5 col-md-6 col-sm-12 col-xs-12" id="24_hours_offer_master">
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
		'#prefix' => '<div class="24_hour_offer_show hour_offer_show_main"><div class="col-md-12 col-sm-12 col-xs-12 padding_left padding_right">
							<div class="col-md-6 col-sm-12 col-xs-12 padding_left"><span class="labeltext text-left">If booking is made on</span> </div>
								<div class="col-md-6 col-sm-12 col-xs-12 form-group padding_right">
                                	<div id="datetimepicker5" class="input-group date">',
		  /* '#attributes' => array('placeholder'=>'Date',
			'class' => array('datepicker'),
			'onblur'=>'Validate24hours_type();' onblur="Validate24hours_type();" 
		  ) ,*/
		  '#suffix'=>'<input type="text" placeholder="Date" id="offer_24_hour_offer_Data_date" readonly="true" class="offer_24_hour_offer_Data_date datepicker" name="offer_24_hour_offer_Data_date[]" value="'.$dates[0].'" ><i class="bookig_date_icon"><span class="icon-calendar">
                <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span>
                </span></i></div></div></div>',
		  //'#default_value' => isset($dateData['offer_24_hour_offer_date']) ? $dateData['offer_24_hour_offer_date'] : NULL,
		);
	  $form['product_pricing']['24_hour_offer']['offer_24_hour_price_value'] = array(
		//'#type' => 'textfield',
		'#attributes' => array('placeholder'=>'Price'),
		'#prefix'=>'<div class="col-md-12 col-sm-12 col-xs-12 padding_left padding_right"><div class="col-md-6 col-sm-12 col-xs-12 padding_left"><span class="labeltext font12 text-left">apply discount of</span></div><div class="col-md-3 col-sm-6 col-xs-12 paddig_right_five">',
		'#suffix'=>'<input type="text"  id="offer_24_hour_offer_Data_price" class="offer_24_hour_offer_Data_price" name="offer_24_hour_offer_Data_price[]" value="'.$amount[0].'" placeholder="Amount"></div>',
		//'#default_value' => isset($priceData['offer_24_hour_price_value']) ? $priceData['offer_24_hour_price_value'] : NULL,
	  );
  if($disscountBy[0]=='$'){
	$selother1='selected';
	$sel1='';
  }else{	
	$sel1='selected';
	$selother1='';
  }
   $form['product_pricing']['24_hour_offer']['24_hour_offer_price_type'] = array(
    //'#type' => 'select',
	'#prefix'=>'<div class="col-md-3 col-sm-6 col-xs-12 padding_left padding_right" >',
	'#suffix'=>'<select name="offer_24_hour_offer_Data_pricetype[]" class="select_box day_disscount"><option value="%" '.$sel1.'>in %</option><option value="$" '.$selother1.'>in $</option></select></div></div>',	
	
	); 

	if(sizeof($my24array)>0){
		$varAddStart='';
	}else{
		$varAddStart='<div class="add_offers_btn"><a  href="#" class="Add_anothers add_anothers" id="addPeriodEXP_New">Add date</a></div>';
	}
	
	$cont=1;
	
	foreach($my24array as $key=>$vals){
	if(sizeof($my24array)==$cont){
	$varSuf='<div class="add_offers_btn"><a  href="#" class="Add_anothers add_anothers" id="addPeriodEXP_New">Add date</a></div>';
	}else{$varSuf='';}
	if($vals['discountby']=='$'){$sel='';$selother='selected';}else{$sel='selected';$selother='';}
	//'.$cont.'
		$form['product_pricing']['24_hour_offer']['add_new_date"'.$cont.'"'] = array(
			'#prefix'	=> '<div class="hour_offer_show_main"><div class="24_hours_discounted_clone"><div class="col-md-12 col-sm-12 col-xs-12 padding_left padding_right"><div class="col-md-6 col-sm-12 col-xs-12 padding_left"><span class="labeltext text-left">If booking is made on</span></div><div class="early-birds-hour-offer col-md-6 col-sm-12 col-xs-12 form-group padding_right"><div id="datetimepicker5" class="input-group date"><i class="bookig_date_icon"><span class="icon-calendar"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></span></i><input type="text" maxlength="128" size="60" value="'.$vals['dates'].'" readonly="true" name="offer_24_hour_offer_Data_date[]" id="edit-24-hour-offer-date'.$cont.'" class="offer_24_hour_offer_Data_date form-text valid" placeholder="Date"></div></div></div><div class="col-md-12 col-sm-12 col-xs-12 padding_left padding_right"><div class="col-md-6 col-sm-6 col-xs-12 padding_left"><span class="labeltext font12 text-left">apply discount of</span></div><div class="col-md-3 col-sm-12 col-xs-12 paddig_right_five"><input type="text" maxlength="128" size="60" value="'.$vals['amount'].'" name="offer_24_hour_offer_Data_price[]" id="edit-24-hour-offer-price-value'.$cont.'" class="offer_24_hour_offer_Data_price form-text valid" placeholder="Amount" /></div><div class="col-md-3 col-sm-12 col-xs-12 padding_right padding_left"><select class="form-select select_box" id="edit-24-hour-offer-price-type" name="offer_24_hour_offer_Data_pricetype[]" style="display: none;">
							<option value="%"  '.$sel.'> in %</option>
							<option value="$" '.$selother.'>in $</option>
							</select></div></div><a  href="#" class="delete remPeriodEXP_New">Remove</a></div></div>'.$varSuf,
			
		); 
		$cont++;
	}
	$form['product_pricing']['24_hour_offer']['add_new_date'] = array(
		'#prefix' => ''.$varAddStart.'</div>  
				</div></fieldset>',
		
	); 
	
	

	/* Last minute Html */	

	if(!empty($LastMinuteData)){

		$form['product_pricing']['offers_and_discounts_lastminute'] = array('#prefix' => '<fieldset>
		<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 padding_left">
			 <div class="offer_icon_left active">
			 <h5>Last minute</h5>
			 <i class="">
			 <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
		width="100px" height="55px" viewBox="0 0 59.604 59.595" enable-background="new 0 0 59.604 59.595" xml:space="preserve">
		<path fill="#ECECEC" stroke="#515151" stroke-linecap="round" stroke-width="2" class="stroke_color"  d="M29.823,0.547c-16.154,0-29.25,13.096-29.25,29.25
		s13.096,29.25,29.25,29.25s29.25-13.096,29.25-29.25S45.977,0.547,29.823,0.547z M29.823,50.547c-11.46,0-20.75-9.29-20.75-20.75
		s9.29-20.75,20.75-20.75s20.75,9.29,20.75,20.75S41.283,50.547,29.823,50.547z"/>
		<polygon fill="#ECECEC" stroke="#515151" stroke-linecap="round" stroke-width="2" class="stroke_color" points="26.698,13.047 33.073,13.047 33.073,28.34 42.573,37.172 
		37.948,42.172 26.573,31.422 "/>
		</svg>
			 </i>
			 </div>
		</div>
		<div class="col-lg-5 col-md-6 col-sm-12 col-xs-12">'
		);
		//echo "<pre>";Print_r($LastMinuteData);exit;

	  $form['product_pricing']['last_minutes'] = array(
		'#prefix' => '<div class="col-md-12 col-sm-12 col-xs-12 padding_left padding_right">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="pricing_cal">
							<input type="checkbox" name="last_minutes_check" class="css-checkbox" id="last_minutes_check" value="last-minute" checked>',
		'#suffix' => '<label for="last_minutes_check" class="css-label radGroup1">Last minute offer</label></div></div></div></div>',
	  ); 
  }else{

		$form['product_pricing']['offers_and_discounts_lastminute'] = array('#prefix' => '<fieldset>
			<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 padding_left">
				 <div class="offer_icon_left">
				 <h5>Last minute</h5>
				 <i class="">
				 <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
		width="100px" height="55px" viewBox="0 0 59.604 59.595" enable-background="new 0 0 59.604 59.595" xml:space="preserve">
		<path fill="#ECECEC" stroke="#515151" stroke-linecap="round" stroke-width="2" class="stroke_color"  d="M29.823,0.547c-16.154,0-29.25,13.096-29.25,29.25
		s13.096,29.25,29.25,29.25s29.25-13.096,29.25-29.25S45.977,0.547,29.823,0.547z M29.823,50.547c-11.46,0-20.75-9.29-20.75-20.75
		s9.29-20.75,20.75-20.75s20.75,9.29,20.75,20.75S41.283,50.547,29.823,50.547z"/>
		<polygon fill="#ECECEC" stroke="#515151" stroke-linecap="round" stroke-width="2" class="stroke_color" points="26.698,13.047 33.073,13.047 33.073,28.34 42.573,37.172 
		37.948,42.172 26.573,31.422 "/>
		</svg>
				 </i>
				 </div>
		    </div>
			<div class="col-lg-5 col-md-6 col-sm-12 col-xs-12">'
			);
		//echo "<pre>";Print_r($LastMinuteData);exit;

	  $form['product_pricing']['last_minutes'] = array(
		'#prefix' => '<div class="col-md-12 col-sm-12 col-xs-12 padding_left padding_right">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="pricing_cal">
							<input type="checkbox" name="last_minutes_check"  class="css-checkbox" id="last_minutes_check" value="last-minute">',
		'#suffix' => '<label for="last_minutes_check" class="css-label radGroup1">Last minute offer</label></div></div>',
	  ); 
  }
		
  
	$form['product_pricing']['last_minutes_time_value'] = array(
		'#type' => 'textfield',
		'#prefix' => '<div class="last_minute_checked_show"><div class="col-md-12 col-sm-12 col-xs-12"><div class="col-md-12 col-sm-12 col-xs-12 padding_left padding_right"><span class="labeltext">If booking is made less than</span></div><div class="col-md-12 col-sm-12 col-xs-12 padding_left padding_right"><div class="col-md-5 col-sm-6 col-xs-12 form-group padding_left">',
		  
		  '#attributes' => array('placeholder'=>'',
			'class' => array(''),
			'onblur'=>'validate_lastminutetime();'
		  ),
		  '#suffix'=>'</div>',
		'#default_value' => isset($LastMinuteData['time_value']) ? $LastMinuteData['time_value'] : NULL,
	  );
	 
	  $form['product_pricing']['last_minutes_time_type'] = array(
		'#type' => 'select',
		'#prefix'=>'<div class="col-md-7 col-sm-6 col-xs-12 form-group padding_right">',
		'#attributes' => array(
			'class' => array('select_box'),
			//'onchange'=>'validate_lastminutetime();'
		),
		'#default_value' => isset($LastMinuteData['time_key']) ? $LastMinuteData['time_key'] : NULL,
		'#options' => array('day'=>'days','hour'=>'hours'),
		'#suffix'=>'</div></div></div>',
	    );

	  $form['product_pricing']['last_minutes_price_value'] = array(
		'#type' => 'textfield',
		'#attributes' => array('placeholder'=>'Amount',
			'class' => array('themePrice'),
		), 
	   '#prefix'=>'<div class="col-md-12 col-sm-12 col-xs-12 padding_left padding_right"><div class="col-md-12 col-sm-12 col-xs-12"><span class="labeltext">prior to arrival, apply discount of</span></div></div><div class="col-md-12 col-sm-12 col-xs-12"><div class="col-md-7 col-sm-6 col-xs-12 padding_left">',
		'#suffix'=>'</div>',
		'#default_value' => isset($LastMinuteData['amount']) ? $LastMinuteData['amount'] : NULL,
	  );
	  
	 
   $form['product_pricing']['last_minutes_price_type'] = array(
		'#type' => 'select',
		'#prefix'=>'<div class="col-md-5 col-sm-6 col-xs-12 padding_right">',
		'#attributes' => array(
			'class' => array('select_box'),
		),
		'#default_value' => isset($LastMinuteData['discount_by']) ? $LastMinuteData['discount_by'] : NULL,
	'#options' => array('%'=>'in %','$'=>'in $'),
	'#suffix' => '</div></div></div></div></div></div></fieldset>',
   );   
   
 
	  $form['product_pricing']['Submit'] = array(
		'#type' => 'submit',
		'#prefix'=>'<fieldset class="marg_bottom_40"></fieldset><fieldset class="full_width_fix"><div class="col-xs-12 col-sm-12 col-md-12">',
		'#attributes' => array(
			'class' => array('submit_btn_session'),
			'value' =>'Save',
		),
		'#suffix'=>'</div></fieldset>',
	  );

	   $form['product_pricing']['End_HTML'] = array(
			'#prefix'=>'</div></div></div></div></div>',
		);
    
	return $form;

}
