var jq=jQuery.noConflict();
	 jQuery(document).ready(function(){
	 jQuery(document).not('input[type="submit"]').on('focus','.product-form-wrapper .Calenderform form select,input,textarea',function(){
		jQuery(".help_right div").hide();
		 /******************************************************/		
		 jQuery(".help_right ."+jQuery(this).parent().parent().parent().attr('class')+"-help").fadeIn();
		 jQuery(".help_right ."+jQuery(this).parent().parent().attr('class')+"-help").fadeIn();		
		 jQuery(".help_right ."+jQuery(this).parent().attr('class')+"-help").fadeIn();
		 /*********************************************************/
		jQuery(".help_right .'"+jQuery(this).attr('name')+"'-help").fadeIn();
alert(jQuery(this).attr('id'));
		jQuery(".help_right ."+jQuery(this).attr('id')+"-help").fadeIn();
 });
/**********************************************************/
	jQuery('#edit-cancellation-policies-type').focus(function(){
	jQuery(".help_right div").hide();
	jQuery(".help_right .policies-"+jQuery(this).val()+"-help").fadeIn(); 
	});
  jQuery("#edit-cancellation-policies-type").on('change',function(){
  jQuery(".help_right div").hide();
  jQuery(".help_right .policies-"+jQuery(this).val()+"-help").fadeIn();
  });  
  jQuery("#edit-product-inventorymode").on('change',function(){       
  jQuery(".help_right div").hide();  
  jQuery(".help_right .form-item-Product-bookingMode-help").fadeIn();  });  
  });	