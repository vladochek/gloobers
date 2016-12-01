/*
* @Help Bar For Backend
*/
var jq=jQuery.noConflict();
	jQuery(document).ready(function(){
		 jQuery(document).not('input[type="submit"]').on('focus','.product-form-wrapper .pricecalendar_form .Calenderform form select,input,textarea',function(){
			jQuery(".help_block div").hide();
			jQuery(".heading_help").show();
			jQuery(".help_right ."+jQuery(this).parent().parent().parent().attr('class')+"-help").fadeIn();
			jQuery(".help_right ."+jQuery(this).parent().parent().attr('class')+"-help").fadeIn();		
			jQuery(".help_right ."+jQuery(this).parent().attr('class')+"-help").fadeIn();
			jQuery(".help_right ."+jQuery(this).attr('id')+"-help").fadeIn();
			var str = jQuery(this).attr('name');
			if(str){
				var res = str.replace("[]", "");
				jQuery(".help_right ."+res+"-help").fadeIn();
			}			
			//jQuery(".help_right ."+jQuery(this).attr('name')+"-help").fadeIn();
		});
		jQuery('#edit-cancellation-policies-type').focus(function(){
			jQuery(".help_block div").hide();
			jQuery(".heading_help").show();
			jQuery(".help_right .policies-"+jQuery(this).val()+"-help").fadeIn(); 
		});
	  jQuery("#edit-cancellation-policies-type").on('change',function(){
		  jQuery(".help_block div").hide();
		  jQuery(".heading_help").show();
		  jQuery(".help_right .policies-"+jQuery(this).val()+"-help").fadeIn();
	  }); 
		jQuery("#edit-product-confirmmode").on('change',function(){
			jQuery(".help_block div").hide();
			jQuery(".heading_help").show();
			jQuery(".help_right ."+jQuery(this).val()+"-help").fadeIn();
		});
	  jQuery("#edit-product-bookingmode").on('change',function(){
		jQuery(".help_block div").hide();
		jQuery(".heading_help").show();
		jQuery(".help_right ."+jQuery(this).val()+"-help").fadeIn();
	  });
	  jQuery("#edit-session-repeatperiod").on('change',function(){
		jQuery(".help_block div").hide();
		jQuery(".heading_help").show();
		jQuery(".help_right ."+jQuery(this).val()+"-help").fadeIn();
	  });
	  jQuery("#edit-product-type").on('change',function(){

		jQuery(".help_block div").hide();
		jQuery(".heading_help").show();
		jQuery(".help_right .edit-product-type-help").fadeIn();
	  });
	  jQuery("#edit-product-inventorymode").on('change',function(){
		jQuery(".help_block div").hide();
		jQuery(".heading_help").show();
		jQuery(".help_right ."+jQuery(this).val()+"-help").fadeIn();
	  });
	  jQuery("#edit-product-inventorymode").on('change',function(){       
		  jQuery(".help_block div").hide();
		  jQuery(".heading_help").show();
		  jQuery(".help_right .form-item-Product-bookingMode-help").fadeIn();  
	  });	
	  jQuery("#edit-product-pricing-type").on('change',function(){
		jQuery(".help_block div").hide();
		jQuery(".heading_help").show();
		jQuery(".help_right ."+jQuery(this).val()+"-help").fadeIn();
	  });  
  });