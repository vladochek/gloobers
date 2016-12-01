<?php
/**
 * @file 
 * Handles the form submission of the customer survey form
 */


/**
 * Handles what to do with the submitted form depending on what stage has been
 * completed.
 * 
 * @see customer_survey_form()
 * @see customer_survey_form_validate()
 * 
 * @param type $form
 * @param type $form_state 
 */
/* function product_add_form_submit($form, &$form_state) {
  
  switch ($form_state['stage']) {
    

    default:
      $form_state['multistep_values'][$form_state['stage']] = $form_state['values'];
      $form_state['new_stage'] = product_add_move_to_next_stage($form, $form_state);
     break;
 
  } 

  if (isset($form_state['complete'])) drupal_goto('complete-page');   
  
  if ($form_state['triggering_element']['#value'] == 'Back') {
    $form_state['new_stage'] = product_add_move_to_previous_stage($form, $form_state);
  } 
  
  if (isset($form_state['multistep_values']['form_build_id'])) {
    $form_state['values']['form_build_id'] = $form_state['multistep_values']['form_build_id'];
  }
  $form_state['multistep_values']['form_build_id'] = $form_state['values']['form_build_id'];
  $form_state['stage'] = $form_state['new_stage'];
  
  $form_state['rebuild'] = TRUE;
    
	drupal_goto('product/add/page/'.$form_state['stage']);
} */
/* 
function product_add_complete() {
    
  return 'Product has beed added';  
    
} */
function product_details_form_validate($form, &$form_state) {

$eid = arg(3);
$values = getOverviewData($eid);
if(!isset($eid) || empty($values) || (isset($eid) && trim($form_state['values']['product_name']) != $values['title'] ))
{

$title=trim($form_state['values']['product_name']);
/* $query=db_select('gbl_experience_list','gel')
       ->fields('gel',array('title'))
       ->condition('title',$title,'like'); 
	  
$result=$query->execute();

$data=$result->fetchAssoc(); */
/* if($data['title'])
{
form_set_error('edit-product-name',t('Experience Title Should be unique'));
return false;
}  */
}  
return true; 	   

}
function product_rules_form_validate($form, &$form_state) {
//$eid = arg(3);
$title=trim($form_state['values']['product_name']);

/* if($title)
{
form_set_error('edit-product-name',t('Experience Title Should be unique'));
return false;
}  */
return true; 	   

}
function product_details_form_submit($form, &$form_state)
{
global $user;
/*  
echo "<pre>";
print_r($form_state["values"]);
die; */
if($form_state["values"]["eid"]){

		$query=db_update('gbl_experience_list')
      ->fields(array('experience_type'=>$form_state['values']['product_type'],
	  'title'=>$form_state['values']['product_name'],
	  'brief_description'=>$form_state['values']['long_description'],'modified'=>time()
	    ))->condition('eid',$form_state["values"]["eid"]);	
     $result=$query->execute();	 

	 if($result)
	 {	
		 $_SESSION['product_id']=$form_state["values"]["eid"];		 
		 drupal_set_message(t('Activity overview updated'));
		 drupal_goto('product/add/photos/'.urlencode($form_state["values"]["eid"]));
	 }
}
else{
$query=db_insert('gbl_experience_list')
      ->fields(array('experience_type'=>$form_state['values']['product_type'],
	  'title'=>$form_state['values']['product_name'],'brief_description'=>$form_state['values']['long_description'],'created'=>time(),'list_type'=>'experience','uid'=>$user->uid
	    ));
 
     $result=$query->execute();	
	 if($result)
	 {	
		 $_SESSION['product_id']=$result;		 
		 drupal_set_message(t('Activity overview saved'));
		 drupal_goto('product/add/photos/'.urlencode($result));
	 }
}

}
/* Photos Validation atleast one photo */
function product_photos_form_validate($form, &$form_state){
	$query=db_select('gbl_listing_meta','l')
		   ->fields('l')
		   ->condition('listing_id',arg(3))->condition('key1','photo_data'); 
	$result=$query->execute();
	$data=$result->fetchAll(PDO::FETCH_ASSOC);
	$counter=sizeof($data);
	if(($counter==0) || ($counter<0) || empty($data) || !isset($data)){
		form_set_error('photos','Please upload atleast one photo.');
	}
}
/* End */
function product_photos_form_submit($form, &$form_state){
	global $user;
	$photoData = array();
	
	if(isset($_SESSION["imagesData2"]) && !empty($_SESSION["imagesData2"])){
		$filepath = 'public://products';
		foreach($_SESSION["imagesData2"] as $key=>$value){
			
			$file = file_load($_SERVER["DOCUMENT_ROOT"]."/gloobers/sites/default/files/products/".$value["files"]);
			$file->uid = $user->uid;
			$file->filename = $value["files"];
			$file->uri = $filepath."/".$value["files"];
			$file->status = FILE_STATUS_PERMANENT;
			$result = file_save($file);
			
			$fileId = $result->fid;
			$photoData["text"] = $value["data"]["customValue"];
			$photoData["fid"] = $fileId;			
		    $query=db_insert('gbl_listing_meta')
			  ->fields(array('listing_id'=>arg(3),
							'key1'=>"photo_data",
							'value1'=>serialize($photoData)
				));	 
			$result=$query->execute();		
			
		}
		unset($_SESSION["imagesData2"]);
		drupal_set_message("Photos uploaded successfully.");
		drupal_goto("product/add/extra/".arg(3));
	}
		drupal_set_message("Photos uploaded successfully.");
		drupal_goto("product/add/location/".arg(3));
}

function product_extra_form_submit($form, &$form_state){
	$extraData = array();
	/*echo "<pre>";
	print_r($form_state);exit;*/

	$title=$form_state["input"]["extra_service"];
	$price=$form_state["input"]["extra_price_value"];
	$price_type=$form_state["input"]["extra_price_type"];
	$price_key=$form_state["input"]["extra_price_key"];
	
	//echo sizeof($title);exit;     
	
	if($form_state["values"]["metaID"]){

		$extraData["title"] = $title[0];
		$extraData["description"] = '';			
		$extraData["price"] = $price[0];
		$extraData["price-type"] = $price_type[0];
		$extraData["price-key"] = $price_key[0];

		$query=db_update('gbl_listing_meta')
		  ->fields(array('listing_id'=>arg(3),
						'key1'=>"product_extra",
						'value1'=>serialize($extraData)
			))
			->condition('meta_id',$form_state["values"]["metaID"]);	 
		$result=$query->execute();	
		if($result){
			drupal_set_message("Optional service updated successfully.");
			drupal_goto("product/add/extra/".arg(3));		
		}
	}
	else{
		//echo sizeof($title);exit;
		for($r=0;$r<sizeof($title);$r++){
			if($title[$r]!='' && $price[$r]!=''){
				$extraData["title"] = $title[$r];
				$extraData["description"] = '';
				//$extraData["description"] = $form_state["input"]["product_extra_description"];
				$extraData["price"] = $price[$r];
				$extraData["price-type"] = $price_type[$r];
				$extraData["price-key"] = $price_key[$r];			

				$query=db_insert('gbl_listing_meta')
				->fields(array('listing_id'=>arg(3),
				'key1'=>"product_extra",
				'value1'=>serialize($extraData)
				));			
				
				$result=$query->execute();	
			}	
		}		
			
		if($result){
			drupal_set_message("Optional service added successfully.");
			drupal_goto("product/add/rules/".arg(3));		
		}	
	}
	drupal_goto("product/add/rules/".arg(3));		
}

/* function product_pricing_form_validate($form, &$form_state) {


if(!empty($form_state['input']['quantity_min']))
 {
 if($form_state['input']['quantity_min']>$form_state['input']['quantity_max'])
 {
 drupal_set_message('MAX value should be greater than MIN value','error');
 return false;
 }
 }


	$early_birds_time_value = $form_state["values"]["early_birds_time_value"];
	if (strlen(trim($early_birds_time_value)) > 0){
		if (!is_numeric($early_birds_time_value)) {
		  form_set_error("early_birds_time_value", t('Days or months must be Numeric'));
		}
	}
	$last_minutes_time_value = $form_state["values"]["last_minutes_time_value"];
	if (strlen(trim($last_minutes_time_value)) > 0){
		if (!is_numeric($last_minutes_time_value)) {
		  form_set_error("last_minutes_time_value", t('Days or months must be Numeric'));
		}
	}

	$hour_offer_price_value = $form_state["values"]["24_hour_offer_price_value"];
	if (strlen(trim($hour_offer_price_value)) > 0){
		if (!is_numeric($hour_offer_price_value)) {
		  form_set_error("24_hour_offer_price_value", t('Price field must be Numeric'));
		}
	}
	$early_birds_price_value = $form_state["values"]["early_birds_price_value"];
	if (strlen(trim($early_birds_price_value)) > 0){
		if (!is_numeric($early_birds_price_value)) {
		  form_set_error("early_birds_price_value", t('Price field must be Numeric'));
		}
	}	

	$last_minutes_price_value = $form_state["values"]["last_minutes_price_value"];
	if (strlen(trim($last_minutes_price_value)) > 0){
		if (!is_numeric($last_minutes_price_value)) {
		  form_set_error("last_minutes_price_value", t('Price field must be Numeric'));
		}
	}

	$product_pricing_value = $form_state["values"]["product_pricing_value"];
	if (strlen(trim($product_pricing_value)) > 0){
		if (!is_numeric($product_pricing_value)) {
		  form_set_error("product_pricing_value", t('Price field must be Numeric'));
		}
	}		
}
 */
function product_pricing_form_validate($form, &$form_state){
	
	//echo "<pre>";print_r($form_state);die;
	$early_birds_time_value = $form_state["values"]["early_birds_time_value"];
	$early_birds_time_type = $form_state["values"]["early_birds_time_type"];
	$early_birds_price_value = $form_state["values"]["early_birds_price_value"];
	$early_birds_check= $form_state["values"]["early_birds_check"];
	
	//echo "<pre>";Print_r($form_state["values"]['quantity_min']);exit;
	$Qty_min=$form_state["values"]['quantity_min'];
	$Qty_max=$form_state["values"]['quantity_max'];
		if($Qty_min){
			if (!is_numeric($Qty_min)) {
			  form_set_error("Qty_min", t('Quantity min field must be Numeric'));
			}
	   } 
	   if($Qty_max){
			if (!is_numeric($Qty_max)) {
			  form_set_error("Qty_max", t('Quantity max field must be Numeric'));
			}
	   }
	 /*   if (!is_numeric($early_birds_price_value)) {
			  form_set_error("Early birds price value", t('Early birds price value field must be Numeric'));
	   } */
	   
	  
	if(trim($early_birds_time_type)=='day'){
		if(!empty($early_birds_time_value)){
			if (trim($early_birds_time_value) < 7 ) {
				
				  form_set_error("early_birds_time_value", t('You need to select minimum 7 Days for early bird offer'));
			}
		}
	}
	if (strlen(trim($early_birds_time_value)) > 0){
		if (!is_numeric($early_birds_time_value)) {
		  form_set_error("early_birds_time_value", t('Days or months must be Numeric'));
		}
	}
	$last_minutes_time_value = $form_state["values"]["last_minutes_time_value"];
	$last_minutes_time_type = $form_state["values"]["last_minutes_time_type"];
	$last_minutes_price_value = $form_state["values"]["last_minutes_price_value"];
	
	//echo $last_minutes_time_type;exit;
	if(trim($last_minutes_time_type)=='day'){
		if (trim($last_minutes_time_value) > 7){
	
			form_set_error("last_minutes_time_value", t('You can select maximum 6 Days for last minute offer'));
		}
	}
	if(trim($last_minutes_time_type)=='hour'){
		if (trim($last_minutes_time_value) > 145){
			form_set_error("last_minutes_time_value", t('You can select maximum 144 Hours for last minute offer'));
		}
	}
	if(strlen(trim($last_minutes_price_value)) > 0){
		if(!is_numeric($last_minutes_price_value)){
			form_set_error("Last minutes price value", t('Last minute price value must be numeric.'));
		}
	}
	if (strlen(trim($last_minutes_time_value)) > 0){
		if (!is_numeric($last_minutes_time_value)) {
		  form_set_error("last_minutes_time_value", t('Days or months must be Numeric'));
		}
	}
	$offer_24_hour_offer_date = $form_state["values"]["offer_24_hour_offer_date"];
	$offer_24_hour_offer_date_extra = $form_state["values"]["24_hour_offer_date_extra"];
	$offer_24_hour_price_value = $form_state["values"]["offer_24_hour_price_value"];
	
	$early_birds_price_value = $form_state["values"]["early_birds_price_value"];
	if (strlen(trim($early_birds_price_value)) > 0){
		if (!is_numeric($early_birds_price_value)) {
		  form_set_error("early_birds_price_value", t('Price field must be Numeric'));
		}
	}
	if($offer_24_hour_price_value){
		if(!is_numeric($offer_24_hour_price_value)){
			
				form_set_error("Offer 24 hour price value", t('Offer 24 hour price value field must be Numeric'));
		}	
	}
	$last_minutes_price_value = $form_state["values"]["last_minutes_price_value"];
	if (strlen(trim($last_minutes_price_value)) > 0){
		if (!is_numeric($last_minutes_price_value)) {
		  form_set_error("last_minutes_price_value", t('Price field must be Numeric'));
		}
	}

	$product_pricing_value = $form_state["values"]["product_pricing_value"];
	if (strlen(trim($product_pricing_value)) > 0){
		if (!is_numeric($product_pricing_value)) {
		  form_set_error("product_pricing_value", t('Price field must be Numeric'));
		}
	}		
}

function product_subscription_form_submit($form, &$form_state){

	if($form_state["values"]["metaID"]){
		$query=db_update('gbl_listing_meta')
		  ->fields(array('listing_id'=>arg(3),
						'key1'=>"product_subscription_data",
						'value1'=>$form_state["values"]["subscription_value"]
			))
		->condition('meta_id',$form_state["values"]["metaID"]);	 
		$result=$query->execute();	
		
		if($result){
			drupal_set_message("Product subscription data updated successfully.");
			drupal_goto("product/add/subscription/".arg(3));		
		}
	}
	else{	
		$query=db_insert('gbl_listing_meta')
		  ->fields(array('listing_id'=>arg(3),
						'key1'=>"product_subscription_data",
						'value1'=>$form_state["values"]["subscription_value"]
			));	 
		$result=$query->execute();	
		
		if($result){
			drupal_set_message("Product subscription data saved successfully.");
			drupal_goto("product/add/subscription/".arg(3));		
		}
	}
}


function product_rules_form_submit($form, &$form_state){
/*  echo "<pre>";
print_r($form_state['values']);
die;  */
$rulesData = array();
$rulesData["experience_rules"] = serialize(array_filter($form_state["input"]["experience_rules"]));
$rulesData["other_information"] = trim($form_state["values"]["other_information"]);
/* $rulesData["expected_arrival_time"] = trim($form_state["values"]["expected_arrival_time"]);
$rulesData["expected_dept_time"] = trim($form_state["values"]["expected_dept_time"]); */
$rulesData["security_deposit"] = trim($form_state["values"]["security_deposit"]);
$rulesData["security_options"] = trim($form_state["values"]["security_options"]);
$rulesData["cancellation_policies_type"] = trim($form_state["values"]["cancellation_policies_type"]);
if($rulesData["cancellation_policies_type"]=='Custom'){
$rulesData["amount_week"] = trim($form_state["values"]["amount_week"]);
$rulesData["amount_week_rental"] = trim($form_state["values"]["amount_week_rental"]);
$rulesData["amount_week_select"] = trim($form_state["values"]["amount_week_select"]);
$rulesData["amount_day"] = trim($form_state["values"]["amount_day"]);
$rulesData["amount_day_rental"] = trim($form_state["values"]["amount_day_rental"]);
$rulesData["amount_day_select"] = trim($form_state["values"]["amount_day_select"]);
}
//echo "<pre>";Print_r($rulesData);exit;
$rulesData["agreement"] = trim($form_state["values"]["agreement"]);

/* 
	$rulesData = array();
	$rulesData["experience_rules"] = $form_state["values"]["experience_rules"];
	$rulesData["experience_manual"] = $form_state["values"]["experience_manual"];
	$rulesData["entire_prior_day"] = $form_state["values"]["cancellation_policy_entire_prior_day"];
	$rulesData["entire_prior_amount"] = $form_state["values"]["cancellation_policy_entire_prior_amount"];
	$rulesData["cancellation_policies_type"] = $form_state["values"]["cancellation_policies_type"];
	$rulesData["policy_pending_day"] = $form_state["values"]["cancellation_policy_pending_day"];
	$rulesData["policy_pending_amount_after_arrival"] = $form_state["values"]["cancellation_policy_pending_amount_after_arrival"];*/
	
	if($form_state["values"]["metaID"]){
		$query=db_update('gbl_listing_meta')
		  ->fields(array('listing_id'=>arg(3),
						'key1'=>"product_cancellation_data",
						'value1'=>serialize($rulesData)
			))
		->condition('meta_id',$form_state["values"]["metaID"]);	 
		$result=$query->execute();	
		
		//if($result){
			drupal_set_message("Product cancellation rules updated successfully.");
			drupal_goto("product/add/subscription/".arg(3));		
		//}
	}
	else{	
		$query=db_insert('gbl_listing_meta')
		  ->fields(array('listing_id'=>arg(3),
						'key1'=>"product_cancellation_data",
						'value1'=>serialize($rulesData)
			));	 
		$result=$query->execute();	
		
		//if($result){
			drupal_set_message("Product cancellation rules data saved successfully.");
			drupal_goto("product/add/subscription/".arg(3));		
		//}
	}

	
}
/********************************************************************************************************/
/* function product_scheduling_form_validate($form,&$form_state)
{
$productId=arg(3);
if(!isset($productId))
{
drupal_set_message('No product Found','error');
drupal_goto('product/add/overview');
}
else
{

if($form_state["input"]["dates_available"] == "INVENTORY"){
$fromdate= strtotime($form_state["input"]["fixed_time_from"]);
$enddate = strtotime($form_state["input"]["fixed_time_to"]);
if($fromdate>$enddate)
{
drupal_set_message('From date should be smaller than to date','error');
return false;
}
if(isset($form_state["input"]["session_start_from_date"]))
{
if(empty($form_state["input"]["session_start_to_date"]))
{
drupal_set_message('Session end date is required','error');
return false;
}
else if(strtotime($form_state["input"]["session_start_from_date"])>strtotime($form_state["input"]["session_start_to_date"]))
{
drupal_set_message(' Session From-date should be smaller than to-date','error');
return false;
}
}


}
return true;
}
}
 */
function product_scheduling_form_validate($form,&$form_state){
/*   echo"<pre>";
print_r($form_state['input']);
die;  */ 
	
	if(isset($form_state["input"]["Product"]["duration"]) && $form_state["input"]["Product"]["duration"] == ""){
		form_set_error('Product[duration]', t('Estimated duration cannot be blank.'));
	}

	
/* 	if($form_state["input"]["Product"]["duration"] == "FIXED"){ */
 	if($form_state["input"]["Product"]["bookingMode"] == "INVENTORY"){ 
	
		if(isset($form_state["input"]["Session"]["endDate"]) && $form_state["input"]["Session"]["endDate"] == ""){
			form_set_error('Session[endDate]', t('End date cannot be blank.'));
		}	
		if($form_state["input"]["Session"]["startDate"] != "" && $form_state["input"]["Session"]["endDate"] != ""){
			if(strtotime($form_state["input"]["Session"]["startDate"])>strtotime($form_state["input"]["Session"]["endDate"])){
				form_set_error('Session[endDate]', t('End date cannot be less than start date.'));
			}
		}
		/************************Compare Start date and until date for per day offer************************************************************/
           if($form_state["input"]["Session"]["repeatPeriod"] !="DoNOt"){
			   if(($form_state["input"]["Session"]["startDate"] != "") && ($form_state["input"]["Session"]["endRepeatDate"]!=""))
			   {
			  
			   if(strtotime($form_state["input"]["Session"]["startDate"])>=strtotime($form_state["input"]["Session"]["endRepeatDate"])){
			  
					form_set_error('Session[endRepeatDate]', t('Until date should be greater than or equal to start date.'));
				}
			   }
			}
		   /*****************************************************************************************/
       		
	//}
	/****************************************************************/
	/* if($form_state["input"]["Product"]["bookingMode"]=='INVENTORY')
	{ */
		if($form_state["input"]["Session"]["startDate"]=="")
		{
		form_set_error('Session[startDate]', t('Start Date is Required'));
		}
		/* if(isset($form_state["input"]["Session"]["endDate"]))
		{
		if($form_state["input"]["Session"]["endDate"]=="")
		{
		form_set_error('Session[endDate]', t('End Date is Required'));
		}
		} */
		
		if($form_state["input"]["Session"]["repeatPeriod"] !="DoNOt")
		{
			if($form_state["input"]["Session"]["endRepeatDate"]=="")
			{
			form_set_error('Session[endRepeatDate]', t('Until Date is Required'));	
			}		
		}
	/*************************Check Scheduling date*************************************************************/
	$scheduledata=getScheduleSessionData(arg(3));
	if($scheduledata)
	{
	foreach($scheduledata as $data)
	{
	$startdate = strtotime($data['startDate']);
    $enddate = strtotime($data['endDate']);
	$untildate = strtotime($data['endRepeatDate']);
	if(isset($form_state["input"]["Session"]["endDate"]))
	{
	
		if($data['endRepeatDate']!="")
		{
			
			if($untildate>$enddate)
			{
			$datetoCompare=$untildate;
			}
			else
			{
			$datetoCompare=$enddate;
			}
		}
		else
		{
		$datetoCompare=$enddate;
		}
	}
    else if(isset($form_state["input"]["Session"]["endRepeatDate"]))
	{
	
	$datetoCompare=$untildate;
    }
	
	/********************Compare date in between*********************************************/
	$session_startdate=strtotime($form_state["input"]["Session"]["startDate"]);
	
		if(($session_startdate>=$startdate) && ($session_startdate<=$datetoCompare))
		{
		
		form_set_error('Session[startDate]', t('Session with these dates are already exist.Kindly add different Session dates'));	
		}
		
	}
	}
}
}

function location_direction_form_submit($form,&$form_state)
{
$productId=arg(3);
if(!isset($productId))
{
drupal_set_message('No product Found','error');
drupal_goto('product/add/overview');
}
else
{
$query=db_update('gbl_experience_list')
        ->fields(array('direction'=>trim($form_state['values']['Itinerary'])			
			))
         ->condition('eid',$productId,'=')
         ->execute();
	drupal_set_message(t('Product Itinerary data saved successfully.'));	 
}

drupal_goto("product/add/Calendernew/".arg(3));

}
/* Product Amenities Form Submit */
function product_amenities_form_submit($form,&$form_state)
{

	$amenitiesData=array();
	$amenitiesData['whats_included']=$form_state['input']['whats_included'];
	$amenitiesData['safety_precautions']=trim(check_plain($form_state['input']['safety_precautions']));
	if($form_state["values"]["input"] == "Edit")
	{
		$query=db_update('gbl_listing_meta')
				  ->fields(array('value1'=>serialize($amenitiesData))) 
				  ->condition('listing_id',arg(3),'=')		 
				  ->condition('key1','amenities','=')		 
				  ->execute();
		drupal_set_message(t('Amenities data updated successfully.'));			  
	}else{	
		$query=db_insert('gbl_listing_meta')
						  ->fields(array('listing_id'=>arg(3),'key1'=>'amenities','value1'=>serialize($amenitiesData)))
						  ->execute();
				drupal_set_message(t('Amenities data saved successfully.'));	
	}
	drupal_goto("product/add/location/".arg(3));
}

function package_payment_form_submit($form, &$form_state){

	global $user;
	
	$paymentType = urlencode('Sale');				// 'Authorization' or 'Sale'
	$firstName = urlencode($form_state['values']['first_name']);
	$lastName = urlencode($form_state['values']['last_name']);
	$creditCardType = urlencode($form_state['values']['credit_card_type']);
	$creditCardNumber = urlencode($form_state['values']['credit_card_no']);
	$expDateMonth = $form_state['values']['credit_expiration_month'];
	/* $booking_creditcard_country = $form_state['values']['booking-country']; */

	$padDateMonth = urlencode(str_pad($expDateMonth, 2, '0', STR_PAD_LEFT));
	 
	$expDateYear = urlencode($form_state['values']['credit_expiration_year']);
	$cvv2Number = urlencode($form_state['values']['credit_varification_no']);
	$address1 = urlencode($form_state['values']['address']);

	$city = urlencode($form_state['values']['city']);
	$state = urlencode($form_state['values']['state']);
	$zip = urlencode($form_state['values']['zipcode']);
	$country = urlencode($form_state['values']['country']);				// US or other valid country code
	//$amount = urlencode($form_state['values']['amount']);
	$amount = urlencode($_SESSION['price']);
	$currencyID = urlencode('USD');							// or other currency ('GBP', 'EUR', 'JPY', 'CAD', 'AUD')

    $IPADDRESS = urlencode($_SERVER['REMOTE_ADDR']);
    $DESC = urlencode('Booking payment.');
	$nvpStr =	"&PAYMENTACTION=$paymentType&IPADDRESS=$IPADDRESS&AMT=$amount&CREDITCARDTYPE=$creditCardType&ACCT=$creditCardNumber".
				"&EXPDATE=$padDateMonth$expDateYear&CVV2=$cvv2Number&FIRSTNAME=$firstName&LASTNAME=$lastName".
				"&STREET=$address1&CITY=$city&STATE=$state&ZIP=$zip&COUNTRYCODE=$country&CURRENCYCODE=$currencyID";
	 //echo $nvpStr;exit;
	 /* $nvpStr = "&PAYMENTACTION=$paymentType&IPADDRESS=$IPADDRESS&AMT=$paybleAmount&CREDITCARDTYPE=$creditCardType&ACCT=$creditCardNumber" .
            "&EXPDATE=$padDateMonth$expDateYear&CVV2=$cvv2Number&FIRSTNAME=$firstName&LASTNAME=$lastName" .
            "&STREET=$streetcc&CITY=$city&STATE=$state&ZIP=$zip&COUNTRYCODE=$country&CURRENCYCODE=$currencyID";
   */  //$httpParsedResponseAr = PPHttpPost('DoDirectPayment', $nvpStr);
	$httpParsedResponseAr = PPHttpPostPay('DoDirectPayment', $nvpStr);
	//echo "<pre>";Print_r($httpParsedResponseAr);exit;
	if($httpParsedResponseAr['ACK']=='Success' || $httpParsedResponseAr['ACK']=='SUCCESSWITHWARNING'){
/* 		echo '<pre>';
		print_r($httpParsedResponseAr['TRANSACTIONID']); die; */
		$query = db_update('gbl_experience_list')
				->fields(array('package_id'=>$_SESSION["packageID"]))
				->condition('eid',arg(3))
				->execute();
		
		$query = db_insert('gbl_packages_transactions')
				->fields(array('listing_id'=>arg(3),
					'package_id'=>$_SESSION["packageID"],
					'transaction_id'=>$httpParsedResponseAr['TRANSACTIONID'],
					'price'=>$_SESSION["price"],
					'user_id'=>$user->uid,
					'ACK'=>$httpParsedResponseAr['ACK'],
					'created'=>time()
				))	
				->execute();
		drupal_goto("product/add/success/".arg(3));
	}
	else if($httpParsedResponseAr['ACK']=='Failure')
	{
		$errorMessage=urldecode($httpParsedResponseAr['L_LONGMESSAGE0']);
		drupal_set_message($errorMessage,'error');
	}
}

function package_payment_form_validate($form, &$form_state){
	
	$postal_code = $form_state['values']['zipcode'];
		
    if(empty($form_state['values']['country'])){
    	form_set_error('Message_err', t('Please select country.'));
        return;
    }
    if (!is_numeric($postal_code)) {
        form_set_error('Message_err', t('Zipcode must be numeric.'));
        return;
    }
	/* $phoneno = $form_state['values']['phone_number'];

  	$phonenumber_length = strlen($form_state['values']['phone_number']);
  	if($phonenumber_length > 16){
  		form_set_error('phone', t('Phone number digits must be less than 16'));
  	}
  	$formats = array('###-###-####', '####-###-###',
                 '(###) ###-###', '####-####-####',
                 '##-###-####-####', '####-####', '###-###-###',
                 '#####-###-###', '##########','#########' , '###########');

	$number = $phoneno;

	if(!validate_telephone_number($number, $formats))
		{
		 form_set_error('phone number',t('Please enter valid phone number'));
	}*/

}

function PPHttpPostPay($methodName_, $nvpStr_) {
    $environment = 'sandbox';
    $credentials = getPaypalCredentails();
    if ($credentials['api_pass'] != "") {
        // Set up your API credentials, PayPal end point, and API version.
        /* 	$API_UserName = urlencode('amar-facilitator_api1.deftsoft.com'); // set your spi username
          $API_Password = urlencode('BL4Y6KT88QKFWWM3'); // set your spi password
          $API_Signature = urlencode('AFcWxV21C7fd0v3bYYYRCpSSRl31A3PORePesfy8F2bEvk6o38EgjSje'); // set your spi Signature */
        $key = pack('H*', "bcb04b7e103a0cd8b54763051cefRuDy55abe029fdebae251d417e2ffb2a00a3");

        $ciphertext_dec = base64_decode($credentials['api_pass']);
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $iv_dec = substr($ciphertext_dec, 0, $iv_size);
        $ciphertext_dec = substr($ciphertext_dec, $iv_size);
        $pass = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $ciphertext_dec, MCRYPT_MODE_CBC, $iv_dec);
    }
    /*     * ******************************************************* */

    // Set up your API credentials, PayPal end point, and API version.
    //echo "<pre>";Print_R($credentials);exit;
    $API_UserName = urlencode($credentials['api_name']); // set your spi username
    $API_Password = urlencode($pass); // set your spi password
    //echo $API_Password = urlencode($credentials['api_pass']);	
    $API_Signature = urlencode($credentials['api_key']); // set your spi Signature

    $API_Endpoint = "https://api-3t.paypal.com/nvp";
    if ("sandbox" === $environment || "beta-sandbox" === $environment) {
        $API_Endpoint = "https://api-3t.$environment.paypal.com/nvp";
    }
    $version = urlencode('51.0');

    // Set the curl parameters.
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $API_Endpoint);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);

    // Turn off the server and peer verification (TrustManager Concept).
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);

    // Set the API operation, version, and API signature in the request.
    $nvpreq = "METHOD=$methodName_&VERSION=$version&PWD=$API_Password&USER=$API_UserName&SIGNATURE=$API_Signature$nvpStr_";

    // Set the request as a POST FIELD for curl.
    curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);

    // Get response from the server.
    $httpResponse = curl_exec($ch);

    if (!$httpResponse) {
        exit("$methodName_ failed: " . curl_error($ch) . '(' . curl_errno($ch) . ')');
    }

    // Extract the response details.
    $httpResponseAr = explode("&", $httpResponse);

    $httpParsedResponseAr = array();
    foreach ($httpResponseAr as $i => $value) {
        $tmpAr = explode("=", $value);
        if (sizeof($tmpAr) > 1) {
            $httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
        }
    }

    if ((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr)) {
        exit("Invalid HTTP Response for POST request($nvpreq) to $API_Endpoint.");
    }

    return $httpParsedResponseAr;
}
/* New Calender Form Submit */

function product_calendar_form_submit($form,&$form_state)
{

	//$schedulingData=getSchedulingSessionData(arg(3));

	//$session_getListExtraPrices= getListExtraPrice(arg(3));
	
	$schedulingData=getSchedulingSessionData_new(arg(3));
	$session_getListExtraPrices= getListExtraPrice(arg(3));		

	if(count($schedulingData)>1){

		$query_s = db_delete("gbl_scheduling_sessions")
					->condition('listing_id',arg(3));
		$query_s->execute();
		/*$query_d = db_delete("gbl_scheduling_sessions_edited")
					->condition('listing_id',arg(3));
		$query_d->execute();*/	
	}

	if(count($session_getListExtraPrices)>1) {	
			$query_p = db_delete("gbl_special_price")
							->condition('listing_id',arg(3));
			$query_p->execute();
	}

	if($form_state["input"]['Product_bookingMode']){	
	$subsciptionId=$form_state["input"]["Product"]["subscriptionID"];
	($subsciptionId)?$subsciptionId:'';
	
	//if(!empty($popupvalues)){
		/* Insert Data in gbl_scheduling */
			if($form_state["input"]["Product"]["subscriptionID"] != "")
			{
				$query=db_update('gbl_scheduling')
				->fields(array(
							'bookingMode'=>$form_state["input"]['Product_bookingMode'],
							//'confirmMode'=>$form_state["input"]["Product_confirmMode"],
							'listing_id'=>arg(3),
							'modified'=> time()
					))
					->condition('id',$form_state["input"]["Product"]["subscriptionID"],'=');	 
					$result=$query->execute();
					
			}else{
				$query=db_insert('gbl_scheduling')
				->fields(array('bookingMode'=>$form_state["input"]['Product_bookingMode'],
							//'confirmMode'=>$form_state["input"]["Product_confirmMode"],
							'listing_id'=>arg(3),
							'created'=> time()
				));	 
				$resultSubscriptionID=$query->execute();	
			}
		//echo $resultSubscriptionID;exit;

		//echo "<pre>";print_r($form_state);exit;
		if($form_state["input"]['Product_bookingMode'] == "INVENTORY" || $form_state["input"]['Product_bookingMode'] == "NO_DATE"){
			
			
			$session_time= $form_state['input']['session_starttime'];
			$Session_repeatonWeeks= $form_state['input']['Session_repeatonWeek'];
			$Session_adult= $form_state['input']['amount_perAdult'];
			$Session_child= $form_state['input']['amount_perChild'];
			$Session_item= $form_state['input']['amount_perItem'];

			$new_session_array=array();
								
			foreach($session_time as $key=>$session_starttime){
				$new_session_array[$key]['Time']=date("H:i", strtotime($session_time[$key]));
				$new_session_array[$key]['Price']['amount_perAdult']=$Session_adult[$key];
				$new_session_array[$key]['Price']['amount_perChild']=$Session_child[$key];
				$new_session_array[$key]['Price']['amount_perItem']=$Session_item[$key];
				$new_session_array[$key]['weekdays']=$Session_repeatonWeeks[$key];
			
		    }
			
			$repeatEvery = $new_session_array;
			//echo "<pre>";print_r($repeatEvery);exit;
			/*opening days session hour*/
			$reapeatDaysTime = array();	
			$reapeatDaysTime = call_user_func_array("array_merge", $Session_repeatonWeeks);
			$reapeatDaysTime = array_unique($reapeatDaysTime);	
			//echo "<pre>";
			//print_r($reapeatDaysTime);exit;			
			
			$endTime = null;	
			$startTime=array();
			
			foreach($new_session_array as $key => $time_val){     

				foreach($time_val['weekdays'] as $key => $weekdays){  

					$startTime[$weekdays]['Time'][] =  date("g:i A",strtotime($time_val['Time']));  
					$startTime[$weekdays][date("g:i A",strtotime($time_val['Time']))]['amount_perAdult']=$time_val['Price']['amount_perAdult'];
					$startTime[$weekdays][date("g:i A",strtotime($time_val['Time']))]['amount_perChild']=$time_val['Price']['amount_perChild'];
					$startTime[$weekdays][date("g:i A",strtotime($time_val['Time']))]['amount_perItem']=$time_val['Price']['amount_perItem'];
				      
				}

			}	

			//echo "<pre>";print_R($startTime);exit;

			/*end opening days session hour*/

			if($form_state["input"]['Product_bookingMode'] == "NO_DATE"){
				if(isset($form_state["input"]["Product"]["subscriptionID"])){
					$query = db_delete('gbl_scheduling_sessions')
							->condition('scheduleID',$form_state["input"]["Product"]["subscriptionID"])
							->execute();
					/*delete session also from edit session table*/
							db_delete('gbl_scheduling_sessions_edited')
							->condition('listing_id',arg(3))
							->execute();
							
				}
				//$popupvalues["Session_repeatPeriod"]=null;
			}

			//17april2016 /*delete previous session session table*/

			if($form_state["input"]['Product_bookingMode'] == "INVENTORY"){
				if(isset($form_state["input"]["Product"]["subscriptionID"])){
							db_delete('gbl_scheduling_sessions')
							->condition('scheduleID',$form_state["input"]["Product"]["subscriptionID"])
							->condition('startDate',null)
							->execute();
				}				
			}

			//end 17april2016


			/*Session dates*/

			$session_repeat_date=array();
			if($form_state["input"]['session_startdate']){
				foreach($form_state["input"]['session_startdate'] as $key=>$session_startdate){
					
					if($form_state["input"]['session_startdate'][$key]){
						$session_repeat_date[$key]["from"] = $form_state["input"]['session_startdate'][$key];
						$session_repeat_date[$key]["to"] = $form_state["input"]['Session_UntilRepeatDate'][$key];	
					}				
				}	
			}				
			/*end Session dates*/

			$schedulingData=getSchedulingSessionData(arg(3));

			if($schedulingData){							

				$query=db_update('gbl_scheduling_sessions')
							   ->fields(array('listing_id'=>arg(3),
						'durationType'=>isset($form_state["input"]["Product"]["durationType"])?$form_state["input"]["Product"]["durationType"]:null,
						'minDuration'=>($form_state["input"]["Product"]["durationType"] == "Any")?$form_state["input"]["Product"]["minDuration"]:null,
						'maxDuration'=>($form_state["input"]["Product"]["durationType"] == "Any")?$form_state["input"]["Product"]["maxDuration"]:null,
						'allowSpanning'=>isset($form_state["input"]["Product"]["allowSpanning"])?$form_state["input"]["Product"]["allowSpanning"]:0,
						'DurationOption'=>($form_state["input"]["Product"]["durationType"] == "LIST")?serialize($form_state["input"]["DurationOption"]):null,					
						'startDate'=>serialize($session_repeat_date),
						'startTime'=>serialize($startTime),
						'endTime'=>null,
						'repeatPeriodBy'=>null,//$form_state["input"]["Session_repeatPeriod"][0],
						'repeatEvery'=>serialize($repeatEvery),
						'endRepeatDate'=>null,
						'reapeatDaysTime'=>serialize($reapeatDaysTime),
						'avalability_min'=>$form_state["input"]["Product_inventoryModemin"],
						'avalability_max'=>$form_state["input"]["Product_inventoryModemax"],
						'scheduleID'=> $form_state["input"]["Product"]["subscriptionID"]?$form_state["input"]["Product"]["subscriptionID"]:$resultSubscriptionID,
						'is_all_day'=> isset($form_state["input"]["all_day_session"])?1:0,
						'privacy' => $form_state["input"]["Product_privacy"]
						))->condition('listing_id',arg(3),'=')->execute();
				

			} else {				
			
			/* Insert Data in gbl_sceduling_sessions */
			$query=db_insert('gbl_scheduling_sessions')
			->fields(array('listing_id'=>arg(3),
						'durationType'=>isset($form_state["input"]["Product"]["durationType"])?$form_state["input"]["Product"]["durationType"]:null,
						'minDuration'=>($form_state["input"]["Product"]["durationType"] == "Any")?$form_state["input"]["Product"]["minDuration"]:null,
						'maxDuration'=>($form_state["input"]["Product"]["durationType"] == "Any")?$form_state["input"]["Product"]["maxDuration"]:null,
						'allowSpanning'=>isset($form_state["input"]["Product"]["allowSpanning"])?$form_state["input"]["Product"]["allowSpanning"]:0,
						'DurationOption'=>($form_state["input"]["Product"]["durationType"] == "LIST")?serialize($form_state["input"]["DurationOption"]):null,					
						'startDate'=>serialize($session_repeat_date),
						'startTime'=>serialize($startTime),
						'endTime'=>null,
						'repeatPeriodBy'=>null,//$form_state["input"]["Session_repeatPeriod"][0],
						'repeatEvery'=>serialize($repeatEvery),
						'endRepeatDate'=>null,
						'reapeatDaysTime'=>serialize($reapeatDaysTime),
						'avalability_min'=>$form_state["input"]["Product_inventoryModemin"],
						'avalability_max'=>$form_state["input"]["Product_inventoryModemax"],
						'scheduleID'=> $form_state["input"]["Product"]["subscriptionID"]?$form_state["input"]["Product"]["subscriptionID"]:$resultSubscriptionID,
						'is_all_day'=> isset($form_state["input"]["all_day_session"])?1:0,
						'privacy' => $form_state["input"]["Product_privacy"]
				));
					
				$result_session_id=$query->execute();

				$query_d = db_delete("gbl_scheduling_sessions_edited")
					->condition('listing_id',arg(3));
				$query_d->execute();

			}

			unset($_SESSION['user_booking_details']);
						
			/* New Pricing Concept */
			if(!empty($form_state["input"]['product_pricing_PER_PERSON_TYPE']) || !empty($form_state["input"]['product_pricing_PER_ITEM_TYPE'])){
			
				$price_data_array=array();
				$k=0;
				if($form_state['input']['product_pricing_type']=='PER_ITEM'){
			
					$product_pricing_array='product_pricing_PER_ITEM_TYPE';
					$product_price_type='PER_ITEM';
				
				}else{
				
					$product_pricing_array='product_pricing_PER_PERSON_TYPE';
					$product_price_type='PER_PERSON';
				
				}
				$minPriceBase=array();
				$maxPriceBase=array();
			
				foreach($form_state["input"][$product_pricing_array] as $pricing){
					
						if($product_price_type=='PER_PERSON'){
							$qtyMin=$form_state["input"]['product_person_min'];
							$qtyMax=$form_state["input"]['product_person_max'];
							$price_option_type=$pricing[0];
							$price=$pricing[1];
						}else{
							$qtyMin=$form_state["input"]['product_item_min'];
							$qtyMax=$form_state["input"]['product_item_max'];
							$adults_per_item_MIN=$form_state["input"]['produt_item_per_adult_min'];
							$adults_per_item_MAX=$form_state["input"]['produt_item_per_adult_max'];
							$child_per_item_MIN=$form_state["input"]['produt_item_per_child_min'];
							$child_per_item_MAX=$form_state["input"]['produt_item_per_child_max'];
							$price_item_name=$pricing[0];
							$price=$pricing[1];
						}
						$minPriceBase[]=$price;
						$maxPriceBase[]=$price;
						$Pricing_insert_array=array('listing_id'=>arg(3),
							'price_type'=>$product_price_type,
							'price_option_type'=>($price_option_type != "")?$price_option_type:null,
							'label'=>($price_item_name !="")?$price_item_name:null,
							'price'=>$price,
							'quantity_required'=>($qtyMin)?1:0,
							'quantity_min'=>($qtyMin != "")?$qtyMin:null,
							'quantity_max'=>($qtyMax != "")?$qtyMax:null,
							'adults_per_item_min'=>($adults_per_item_MIN != "")?$adults_per_item_MIN:null,
							'adults_per_item_max'=>($adults_per_item_MAX != "")?$adults_per_item_MAX:null,
							'child_per_item_min'=>($child_per_item_MIN != "")?$child_per_item_MIN:null,
							'child_per_item_max'=>($child_per_item_MAX != "")?$child_per_item_MAX:null
							);
						$price_data_array[$k]=$Pricing_insert_array;
						$price_data_array[$k]['price_type']=$product_price_type;
				$k++;
				}
				 if(sizeof($form_state["input"][$product_pricing_array])>1){
				 /* Min and Max Prices */
					 $minPriceBase= min($minPriceBase);
					 $maxPriceBase= max($maxPriceBase);
				 }else{
					$minPriceBase= $form_state["input"][$product_pricing_array][0][1];
					$maxPriceBase=$form_state["input"][$product_pricing_array][0][1];
				 }
				//echo $minPriceBase.'<br/>'.$maxPriceBase.'<br/>';
				$selectPrice=db_select('gbl_pricing','p')->fields('p',array('max_price','min_price'))->condition('listing_id',arg(3));
					$result_selectPrice=$selectPrice->execute();
					$result_selectPrice=$result_selectPrice->fetchAll(PDO::FETCH_ASSOC);
					if(!empty($result_selectPrice)){
						$min_price=$result_selectPrice[0]['min_price'];
						$max_price=$result_selectPrice[0]['max_price'];
						if($min_price>=$minPriceBase)
						{	
							$FinalMinPrice=$minPriceBase;
						}else{
							$FinalMinPrice=$min_price;
						}
						if($max_price>=$maxPriceBase)
						{
							$FinalMaxPrice=$max_price;
						}else{
							$FinalMaxPrice=$maxPriceBase;
						}
						//echo $FinalMinPrice.'<br/>'.$FinalMaxPrice;exit;
						$query_price=db_update('gbl_pricing')->fields(array('min_price'=>$FinalMinPrice,
																			'max_price'=>$FinalMaxPrice)
																	)->condition('listing_id',arg(3));
						$result_price=$query_price->execute();
						
					}else{
						$query_price=db_insert('gbl_pricing')->fields(array('min_price'=>$minPriceBase,
																			'max_price'=>$maxPriceBase,
																			'listing_id'=>arg(3))
																		);
						$result_price=$query_price->execute();
					}
					//echo $result_session_id;exit;

					if($result_session_id){
					
					 $query_up=db_update('gbl_scheduling_sessions')
									->fields(array('pricingData'=>serialize($price_data_array)))
									->condition('id',$result_session_id);	 						
					  $result_up=$query_up->execute();
						
					} else {

						$query_up=db_update('gbl_scheduling_sessions')
									->fields(array('pricingData'=>serialize($price_data_array)))
									->condition('listing_id',arg(3));	
									 						
					    $result_up=$query_up->execute();					
						
					}
					  
			
			}
			/* End New Pricing Concept */
		}else{
			if(isset($form_state["input"]["Session"]["scheduleID"])){
				$query = db_delete('gbl_scheduling_sessions')
						->condition('scheduleID',$form_state["input"]["Session"]["scheduleID"])
						->execute();
			}
		}

		$eid=arg(3);
		$offer_24_hour_price=$offer_24_hour_date=array();
		$currency_type=$form_state['values']['currency_type'];
		
		/* New Seasonal Price */
		$listId=arg(3);
		//updated 2/22/2016
		$seasonalPrice=getListExtraPrice(arg(3));
		//$seasonalPrice=getsessionspecialPrice($result_session_id);
		//if($form_state["input"]['fromdate']){

			$session_seasonal_pricing=array();	

			if($seasonalPrice){					

				foreach($form_state["input"]['fromdate'] as $key=>$fromdate){
					
					if($form_state["input"]['fromdate'][$key]){
						$session_seasonal_pricing[$key]["from"] = $form_state["input"]['fromdate'][$key];
						$session_seasonal_pricing[$key]["todate"] = $form_state["input"]['todate'][$key];
						$session_seasonal_pricing[$key]["rate_per_adult"] = $form_state["input"]['rate_per_adult'][$key];
						$session_seasonal_pricing[$key]["rate_per_child"] = $form_state["input"]['rate_per_child'][$key];
						$session_seasonal_pricing[$key]["rate_per_item"] = $form_state["input"]['rate_per_item'][$key];
					}
				
				}

				//echo "<pre>";print_r($session_seasonal_pricing);exit;

				$query=db_update('gbl_special_price')
							   ->fields(array('listing_id'=>arg(3),
							  	'session_ID'=>$result_session_id,
								'from_to_date'=>serialize($session_seasonal_pricing),
								'from_date'=>null,
								'to_date'=>null,
								'rate_per_item'=>null,
								'rate_per_adult'=>null,
								'rate_per_child'=>null,
								'rate_for_everyone'=>null,
								'created'=>strtotime(date('Y-m-d')),
								'rate_label'=>null,
								))->condition('listing_id',arg(3),'=')->execute();
			
			}else {				
				
				foreach($form_state["input"]['fromdate'] as $key=>$fromdate){
					
					if($form_state["input"]['fromdate'][$key]){
						$session_seasonal_pricing[$key]["from"] = $form_state["input"]['fromdate'][$key];
						$session_seasonal_pricing[$key]["todate"] = $form_state["input"]['todate'][$key];
						$session_seasonal_pricing[$key]["rate_per_adult"] = $form_state["input"]['rate_per_adult'][$key];
						$session_seasonal_pricing[$key]["rate_per_child"] = $form_state["input"]['rate_per_child'][$key];
						$session_seasonal_pricing[$key]["rate_per_item"] = $form_state["input"]['rate_per_item'][$key];
					}
				
				}
							
				if($session_seasonal_pricing){

					$query=db_insert('gbl_special_price')
						  ->fields(array('listing_id'=>arg(3),
						  	'session_ID'=>$result_session_id,
							'from_to_date'=>serialize($session_seasonal_pricing),
							'from_date'=>null,
							'to_date'=>null,
							'rate_per_item'=>null,
							'rate_per_adult'=>null,
							'rate_per_child'=>null,
							'rate_for_everyone'=>null,
							'created'=>strtotime(date('Y-m-d')),
							'rate_label'=>null,
							));	 
								 
					$result=$query->execute();
					
				}
				
			}
		//}
		
		/* End New Seasonal Price */
		
		//$minPriceBase=array();
		if(!empty($form_state["input"]['product_pricing_PER_ITEM_TYPE'][0][0])){
		
			$product_pricing_array='product_pricing_PER_ITEM_TYPE';
			$product_price_type='PER_ITEM';
		
		}else{
		
			$product_pricing_array='product_pricing_PER_PERSON_TYPE';
			$product_price_type='PER_PERSON';
		}
		
		}
		/* foreach($form_state["input"]['PriceOption'][$product_pricing_PER_PERSON_TYPE] as $pricingBase){
			$minPriceBase[]=$pricingBase[1];
		}
		$minPriceBase= min($minPriceBase); */
		/* Offers And Disscounts */
		$eid=arg(3);
		$earlyBirdData=getDiscountInfo($eid,'Early Birds');	
		$LastMinuteData=getDiscountInfo($eid,'Last Minute');
		$offer_24_Data=getDiscountInfo($eid,'24 Hour Offer');
		
		if($form_state['input']['early_birds_check'])
		{
			if(!empty($earlyBirdData))
			{  
				$query=db_update('gbl_offers_and_discount')
				   ->fields(array('time_key'=>$form_state['input']['early_birds_time_type'],'time_value'=>$form_state['input']['early_birds_time_value'],'amount'=>$form_state['input']['early_birds_price_value'],'discount_by'=>$form_state['input']['early_birds_price_type'],'modified'=>time()))
				   ->condition('id',$earlyBirdData['id'],'=')
				   ->execute();	
			}else{
				
				$query=db_insert('gbl_offers_and_discount')
					   ->fields(array('listing_id'=>arg(3),'offer_type'=>'Early Birds','time_key'=>$form_state['input']['early_birds_time_type'],'time_value'=>$form_state['input']['early_birds_time_value'],'amount'=>$form_state['input']['early_birds_price_value'],'discount_by'=>$form_state['input']['early_birds_price_type'],'added'=>time()))
					   ->execute();
			}
		}
		/* if early bird uncheck delete it */
		else{
			if(!empty($earlyBirdData))
			{
				$query=db_delete('gbl_offers_and_discount')->condition('id',$earlyBirdData['id'],'=')->execute();
			}
		}
		
		if($form_state['input']['last_minutes_check'])
		{
			if(!empty($LastMinuteData))
			{
			   $query=db_update('gbl_offers_and_discount')
					   ->fields(array('time_key'=>$form_state['input']['last_minutes_time_type'],'time_value'=>$form_state['input']['last_minutes_time_value'],'amount'=>$form_state['input']['last_minutes_price_value'],'discount_by'=>$form_state['input']['last_minutes_price_type'],'modified'=>time()))
					   ->condition('id',$LastMinuteData['id'],'=')
					   ->execute();
			
			}
			else{
			
				$query=db_insert('gbl_offers_and_discount')
					   ->fields(array('listing_id'=>arg(3),'offer_type'=>'Last Minute','time_key'=>$form_state['input']['last_minutes_time_type'],'time_value'=>$form_state['input']['last_minutes_time_value'],'amount'=>$form_state['input']['last_minutes_price_value'],'discount_by'=>$form_state['input']['last_minutes_price_type'],'added'=>time()))
					   ->execute();
			}
		}
		/* if Last minute uncheck delete it */
		else{
			if(!empty($LastMinuteData))
			{
				$query=db_delete('gbl_offers_and_discount')->condition('id',$LastMinuteData['id'],'=')->execute();
			}
		}
		
		if($form_state['input']['24_hour_offer_check'])
		{
		
		$offer_24_hour_price['offer_24_hour_offer_Data_pricetype']=$form_state['input']['offer_24_hour_offer_Data_pricetype'];
		$offer_24_hour_price['offer_24_hour_offer_Data_price']=$form_state['input']['offer_24_hour_offer_Data_price'];
		$offer_24_hour_date['offer_24_hour_offer_Data_date']=$form_state['input']['offer_24_hour_offer_Data_date'];
		
			if(!empty($offer_24_Data))
			{
				$query=db_update('gbl_offers_and_discount')
				   ->fields(array('date'=>serialize($offer_24_hour_date['offer_24_hour_offer_Data_date']),'amount'=>serialize($offer_24_hour_price['offer_24_hour_offer_Data_price']),'discount_by'=>serialize($offer_24_hour_price['offer_24_hour_offer_Data_pricetype']),'modified'=>time()))
				   ->condition('id',$offer_24_Data['id'],'=')
				   ->execute();
			}
			else
			{
		
			$query=db_insert('gbl_offers_and_discount')
				   ->fields(array('listing_id'=>arg(3),'offer_type'=>'24 Hour Offer','date'=>serialize($offer_24_hour_date['offer_24_hour_offer_Data_date']),'amount'=>serialize($offer_24_hour_price['offer_24_hour_offer_Data_price']),'discount_by'=>serialize($offer_24_hour_price['offer_24_hour_offer_Data_pricetype']),'added'=>time()))
				   ->execute();
			}
		}
		else{
			if(!empty($offer_24_Data))
			{
				$query=db_delete('gbl_offers_and_discount')->condition('id',$offer_24_Data['id'],'=')->execute();
			}
		}
		/* End Offers and Disscounts */
			/* Update after completing 5 steps */
		$query=db_update('gbl_experience_list')
			  ->fields(array('list_status'=>1,'base_price'=>$minPriceBase))
			  ->condition('eid',arg(3),'=')
			  ->execute();

		drupal_set_message(t('Rates and availability data saved successfully'));	  

		if(arg(3)=='192'){
		 drupal_goto('product/add/Calendernew/'.arg(3));	
		}	else {
		 drupal_goto('product/session/edit/'.arg(3));	
		}	  
	   //drupal_goto('product/session/edit/'.arg(3));
	/* }else{
		echo "POpup Values missing";exit;
	} */
}

function product_calendar_form_validate($form, &$form_state){
	
	if($form_state["input"]['Product_bookingMode']){	
	
	/* Session Popup Validation */		
		if($form_state['input']['Product_bookingMode']=='INVENTORY'){
			
			if(!$form_state["input"]['session_startdate']){
				form_set_error('session_startdate',t('Please select session Start dates.'));
					return false;
			}
		}

		if(!$form_state["input"]['session_starttime']){
			form_set_error('session_starttime',t('Please select session time.'));
				return false;
		}

		if(!$form_state["input"]['Session_repeatonWeek']){
			form_set_error('Session_repeatonWeek',t('Please select atleast one weekday.'));
				return false;
		}	
	
	}
	/* OFFERS AND PRICING VALIDATIONS */
	if($form_state["input"]["24_hour_offer_check"]){
		$dateValues=$form_state["input"]["offer_24_hour_offer_Data_date"];
		if(empty($dateValues)){
			form_set_error('offer_24_hour_offer_Data_date',t('Please add date for 24 hour offer.'));
			return false;
		}else{
			if(count(array_unique($dateValues))<count($dateValues)){
				form_set_error('offer_24_hour_offer_Data_date',t('Please add date for 24 hour offer.'));
				return false;
			}
		}
		if(empty($form_state["input"]["offer_24_hour_offer_Data_price"])){
			form_set_error('offer_24_hour_offer_Data_price',t('Please add price for 24 hour offer.'));
			return false;
		}else{ 
			foreach($form_state["input"]["offer_24_hour_offer_Data_price"] as $price24hOUR)
			if(!is_numeric($price24hOUR)){
				form_set_error('offer_24_hour_offer_Data_price',t('Price value of 24 hour offer must be numeric.'));
				return false;
			}
		}
		
		//echo "<pre>";print_r($form_state["input"]);exit;
		if(empty($form_state["input"]["offer_24_hour_offer_Data_pricetype"])){
			form_set_error('24_hour_offer_error',t('Please select price type for 24 hour offer.'));
			return false;
		}
		$P=0;
		foreach($form_state["input"]["offer_24_hour_offer_Data_pricetype"] as $priceType){
			if($priceType=='%'){
				if($form_state["input"]["offer_24_hour_offer_Data_price"][$P] > 100){
					form_set_error('24_hour_offer_error',t('Please select price discount less than 100 when amount discounted by is % for 24 hour offer.'));
					return false;
				}
			}
		$P++;
		}
	}
	
	if($form_state["input"]["last_minutes_check"]){
	
		$last_minutes_time_value=$form_state["input"]["last_minutes_time_value"];
		$last_minutes_time_type=$form_state["input"]["last_minutes_time_type"];
		$last_minutes_price_value=$form_state["input"]["last_minutes_price_value"];
		$last_minutes_price_type=$form_state["input"]["last_minutes_price_type"];
		if(empty($last_minutes_time_value)){
			form_set_error('last_minutes_time_value',t('Please select time for last minute offer.'));
			return false;
		}else if(!is_numeric($last_minutes_time_value)){
			  form_set_error("last_minutes_time_value", t('Last minute time must be Numeric.'));
			  return false;
		}
		if($last_minutes_time_value){
			if(trim($last_minutes_time_type)=='day'){
					if (trim($last_minutes_time_value) > 7){
						form_set_error("last_minutes_time_value", t('You can select maximum 6 Days for last minute offer'));
						return false;
					}
			}else if(trim($last_minutes_time_type)=='hour'){
				if (trim($last_minutes_time_value) > 145){
					form_set_error("last_minutes_time_value", t('You can select maximum 144 Hours for last minute offer'));
					return false;
				}
			}
		}
		if(empty($last_minutes_time_type)){
			form_set_error('last_minutes_time_type',t('Please select time type for last minute offer.'));
			return false;
		}
		if(empty($last_minutes_price_value)){
			form_set_error('last_minute_offer_error',t('Please select price for last minute offer.'));
			return false;
		}else if(!is_numeric($last_minutes_price_value)){
			  form_set_error("last_minutes_price_value", t('Last minute price must be Numeric.'));
		}
		if(empty($last_minutes_price_type)){
			form_set_error('last_minute_offer_error',t('Please select price type for last minute offer.'));
			return false;
		}

		if($last_minutes_price_type=='%'){
			if($last_minutes_price_value > 100){
				form_set_error('last_minute_offer_error',t('Please select price discount less than 100 when amount discounted by is % for last minute offer.'));
				return false;
			}
		}
	}
	
	if($form_state["input"]["early_birds_check"]){
	
		$early_birds_time_type=$form_state["input"]["early_birds_time_type"];
		$early_birds_time_value=$form_state["input"]["early_birds_time_value"];
		$early_birds_price_value=$form_state["input"]["early_birds_price_value"];
		$early_birds_price_type=$form_state["input"]["early_birds_price_type"];
		if(empty($early_birds_time_value)){
			form_set_error('early_birds_time_value',t('Please select time for early bird offer.'));
			return false;
		}else if(!is_numeric($early_birds_time_value)){
			  form_set_error("early_birds_time_value", t('Early bird time must be Numeric.'));
		}
		if(empty($early_birds_time_type)){
			form_set_error('early_birds_time_type',t('Please select time type for early bird offer.'));
			return false;
		}
		if(empty($early_birds_price_value)){
			form_set_error('early_birds_price_value',t('Please select price for early bird offer.'));
			return false;
		}else if(!is_numeric($early_birds_price_value)){
			  form_set_error("early_birds_price_value", t('early bird price must be Numeric.'));
		}
		if(empty($early_birds_price_type)){
			form_set_error('early_birds_price_type',t('Please select price type for early bird offer.'));
			return false;
		}
		
		if(trim($early_birds_time_type)=='day'){
			if(!empty($early_birds_time_value)){
				if (trim($early_birds_time_value) < 7 ) {
					form_set_error("early_birds_time_value", t('You need to select minimum 7 Days for early bird offer'));
				}
			}
		}
		
		if($early_birds_price_type=='%'){
			if($early_birds_price_value > 100){
				form_set_error('early_birds_price_error',t('Please select price discount less than 100 when amount discounted by is % for early bird offer.'));
				return false;
			}
		}
	}
}