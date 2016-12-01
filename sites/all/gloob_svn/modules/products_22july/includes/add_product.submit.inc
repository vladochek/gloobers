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
function product_add_form_submit($form, &$form_state) {

/*  	echo "<pre>";
	print_r($form_state); die;  */
  
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
    
}

function product_add_complete() {
    
  return 'Product has beed added';  
    
}
