jQuery.noConflict();
jQuery(document).ready(function() {

	jQuery("#product-details-form").validate({
		rules: {
		    product_type :"required",
			product_name: "required",			
			short_description: {
				required: true,
				minlength: 2,
				maxlength :500
			},
            expect:{
				//required: true,
				minlength: 100,
				maxlength :2000
			},			
		},
		messages: {
		    product_type :"Experience Type is required",
			product_name: "Experience Title is required",
			short_description: {
				required: "Highlights is required",
				minlength: "Highlights must consist of at least 2 characters",
				maxlength :"Maximum 500 characters are allowed"
			},
			expect: {
				minlength: "Long description must consist of at least 100 characters",
				maxlength :"Maximum 2000 characters are allowed"
			},
			
		}
	});
	jQuery("#product-rules-form").validate({
		rules: {
		   	security_deposit: {
				digits: true
			},	
			amount_week: {
				digits: true
			},
			amount_week_rental: {
				digits: true
			},	
			amount_day: {
				digits: true
			},	
			amount_day_rental: {
				digits: true
			},		
		},
		messages: {
		   	security_deposit: {
				digits: "security deposit should be numeric",				
			},
			amount_week: {
				digits: "This should be numeric",				
			},
			
		}
	});
	jQuery("#product-scheduling-form").validate({
		rules: {
		    dates_available :"required",
			duration_value: {
				digits: true
			},		
		},
		messages: {
		    dates_available :"Date Available is required",
			duration_value: {
				digits: "Duration should be numeric",
				
			},
			
		}
	});
	jQuery("#product-pricing-form").validate({
		rules: {
		//    season_rate_amount :"required",
		//   high_season_rate_dates :"required",			
		//   product_pricing_value :"required",
//new added	
          early_birds_time_value:"required",	   
          last_minutes_time_value:"required",	 
//		  
			product_pricing_min: {
				digits: true
			},	
            product_pricing_max: {
				digits: true
			},	
			quantity_min: {
				digits: true
			},
			quantity_max: {
				digits: true
			},
			product_pricing_value: {
				digits: true
			},
			early_birds_time_value: {
				digits: true
			},
			last_minutes_time_value: {
				digits: true
			},			
		},
		messages: {
		    season_rate_amount :"Price is required",
		  //  product_pricing_value :"Price is required",
			product_pricing_min: {
				digits: "Minimum Price should be numeric",				
			},
			product_pricing_max: {
				digits: "Maximum Price should be numeric",				
			},
			quantity_min: {
				digits: "Minimum quantity should be numeric",				
			},
			quantity_max: {
				digits: "Maximum quantity should be numeric",				
			},
			product_pricing_value: {
				digits: "Price should be numeric",				
			},
			early_birds_time_value: {
				digits: "Days or month should be numeric",				
			},
			last_minutes_time_value: {
				digits: "Days or month should be numeric",				
			},
			
		}
	});
	 jQuery("#product-extra-form").validate({
		rules: {
		    extra_service :"required",
			extra_price_value: {
				digits: true,
				required: true,
				min:1
			},		
		},
		messages: {
		    extra_service :"Extra Service Title is required",
			extra_price_value: {
				digits: "Price should be numeric",
				required:"Price is required",
				min:"Price Should be greater than 0"
			},
			
		}
	}); 
	jQuery('#edit-dates-available').on('change', function() {
      if(this.value=='INVENTORY')
	 {
	 
	 /*************************************************************************************/
	 var settings = jQuery("#product-scheduling-form").validate().settings;

		// Modify validation settings
	    jQuery.extend(settings, {
	    	rules: {
				fixed_time_from: {
			    required: true, 				
			},	
           fixed_time_to: {
			    required: true, 				
			},					
			},
	    });
	jQuery("#product-scheduling-form").valid();
	 /*************************************Product Pricing Form************************************************/
	
	 }
	
});
var position =(window.location.pathname).indexOf("product/add/pricing");
if(position > -1)
{
	var settings = jQuery("#product-pricing-form").validate().settings;

		// Modify validation settings
	    jQuery.extend(settings, {
	    	rules: {
				offer_24_hour_price_value: {
			    required: true, 
				digits: true
			},	
			quantity_min:{
			required: true, 
			digits: true,
			min:1
			},
			quantity_max:{
			required: true, 
			digits: true,
			min:1
			},
			
            offer_24_hour_offer_date: {
			    required: true, 
		     },				
			},
	    });
	jQuery("#product-pricing-form").valid(); 
}	
	/******************************************************************/
	jQuery(".offer-datepicker div input").each(function () {
    jQuery(this).rules('add', {
        required: true
    });
});
jQuery(".offer-price div input").each(function () {
    jQuery(this).rules('add', {
        required: true,
		digits: true,
		min: 0
    });
});

/********************************************************************************/
 jQuery(".form-item-24-hour-offer-price-value-extra input").each(function () {
    jQuery(this).rules('add', {
        required: true,
		digits: true,
		min: 0
    });
});
 jQuery(".form-item-24-hour-offer-date-extra input").each(function () {
    jQuery(this).rules('add', {
        required: true,
		digits: true
    });
});
/***************/
jQuery('#addPeriodEXP,#remPeriodEXP-extra').on('click', function(e) {
    jQuery(".offer-datepicker div input").each(function () {
    jQuery(this).rules('add', {
        required: true
    });
});
jQuery(".offer-price div input").each(function () {
    jQuery(this).rules('add', {
        required: true,
		digits: true,
		min: 0
    });
});
});
/*******************/
 jQuery(".form-item-offer-24-hour-price-value-extra-0 input").each(function () {
    jQuery(this).rules('add', {
        required: true,
		digits: true,
		min: 0
    });
});
/**************************Product Pricing*************29-SEPT***********************************/
 jQuery("#product-pricing-form .product_pricing_wrapper .price-label").each(function () {
    jQuery(this).rules('add', {
        required: true		
    });
});
 jQuery("#product-pricing-form .product_pricing_wrapper .price-min").each(function () {
    jQuery(this).rules('add', {
        required: true,
        digits: true,
		min: 0
		
    });
});
jQuery("#product-pricing-form .product_pricing_wrapper .price-max").each(function () {
    jQuery(this).rules('add', {
        required: true,
        digits: true,
        min: 0		
    });
});
jQuery("#product-pricing-form .product_pricing_wrapper .themePrice").each(function () {
    jQuery(this).rules('add', {
        required: true,
		number: true,
		min:1
    });
});
/************/
	jQuery('.addPricing,.removePricing').on('click', function(e) {
		jQuery("#product-pricing-form .product_pricing_wrapper .price-max").each(function () {
		jQuery(this).rules('add', {
			required: true,
			digits: true,
            min: 1			
		});
	});
	jQuery("#product-pricing-form .product_pricing_wrapper .price-min").each(function () {
		jQuery(this).rules('add', {
			required: true,
			digits: true,
			min: 1,
			
			
		});
	});
	jQuery("#product-pricing-form .product_pricing_wrapper .price-label").each(function () {
		jQuery(this).rules('add', {
			required: true		
		});
	});
	jQuery("#product-pricing-form .product_pricing_wrapper .themePrice").each(function () {
    jQuery(this).rules('add', {
        required: true,
		number: true,
		min:1
    });
});
	});
/***************************************************************************************************/
jQuery("#product-pricing-form").validate();
	//seosonal_extra_price_validate();
/* if(jQuery("#product-pricing-form #seosonal-pricing").is(":checked"))
		{
	//	jQuery("#product-pricing-form").validate();
	//		seosonal_extra_price_validate();
        } */
/* jQuery('#addRate,#remRate').on('click', function(e) {
//jQuery("#product-pricing-form").validate();
	//seosonal_extra_price_validate();
}); */		

jQuery.validator.addMethod("minprice", function(value, element) {
 return this.optional(element) || (parseInt(value)>0);
}, "Please enter the Price greater than zero");

/* function seosonal_extra_price_validate()
{

jQuery("#product-pricing-form .product_season_rate .rate-label").each(function () {

		    jQuery(this).rules('add', {
			required: true,			
			   });
              });
			  
			jQuery("#product-pricing-form .product_season_rate .rate-price").each(function () {
		    jQuery(this).rules('add', {
			required: true,
			digits: true,
			min: 1,
			messages:{
			min:"Price should be greater than 0"
			}
			   });
              });
			jQuery("#product-pricing-form .product_season_rate .rate-from").each(function () {
		    jQuery(this).rules('add', {
			required: true
			   });
              });
} */
/************************************************************************************/
if(jQuery(".form-item-Product-bookingMode .form-select").val()=="INVENTORY")
{
jQuery.validator.addMethod("greaterThanDate", 
function(value, element, params) {
    if (!/Invalid|NaN/.test(new Date(value))) {
        return new Date(value) >= new Date(jQuery(params).val());
    }
    return isNaN(value) && isNaN(jQuery(params).val()) 
        || (Number(value) > Number(jQuery(params).val())); 
},'End date must be greater than or equal to start date.');
jQuery.validator.addMethod("lessThanDate", 
function(value, element, params) {
    if (!/Invalid|NaN/.test(new Date(value))) {
        return new Date(value) <= new Date(jQuery(params).val());
    }
    return isNaN(value) && isNaN(jQuery(params).val()) 
        || (Number(value) < Number(jQuery(params).val())); 
},'End date must be less than or equal to start date.');

 var startDate=jQuery("#edit-session-startdate").val();
var endDate=jQuery("#edit-session-enddate").val(); 
//if(startDate !="")
//{
jQuery("#product-scheduling-form .session-from .form-item-Session-startDate input").each(function () {
		jQuery(this).rules('add', {
		date: true,
		required:true
		});
	});
//}	
	/* jQuery("#product-scheduling-form .session-from .form-item-Session-endDate input").each(function () {
		jQuery(this).rules('add', {
		date: true
		});
	}); */

/***************************************************************************************/
if(endDate !="")
{
jQuery("#product-scheduling-form .session-from .form-item-Session-endDate input").each(function () {
		jQuery(this).rules('add', {
		date: true,
		//required:true,
		greaterThanDate:'#edit-session-startdate'
		});
	});
}	
if(endDate !="" &&  startDate !=""){
	jQuery("#product-scheduling-form .form-item-Session-endRepeatDate input").each(function () {
		jQuery(this).rules('add', {
		date: true,
		required:true,
		greaterThanDate:'#edit-session-startdate',
		lessThanDate:'#edit-session-enddate',
		
		  messages: {
		  greaterThanDate:"Until date should be greater than or equal to start date",
		  lessThanDate:"Until date should be less than or equal to end date",
		  }
		});
	});
}	
if(startDate !=""){
	jQuery("#product-scheduling-form .form-item-Session-endRepeatDate input").each(function () {
		jQuery(this).rules('add', {
		date: true,
		required:true,
		greaterThanDate:'#edit-session-startdate',
		//lessThanDate:'#edit-session-enddate',
		
		  messages: {
		  greaterThanDate:"Until date should be greater than or equal to start date",
		 // lessThanDate:"Until date should be less than or equal to end date",
		  }
		});
	});
}	
/************************************************************************************************/
}
jQuery("#product-scheduling-form .form-item-Product-defaultQuantity input").each(function () {
	jQuery(this).rules('add', {
	required:true,
	digits:true,
	min:1
	});
});
/*************************Product Amenities validate********************************************/
/*****************************************************************/
jQuery("#product-amenities-form").validate();
jQuery(".amenities-included .form-text").each(function () {
	jQuery(this).rules('add', {
        required: true
    });
});
jQuery(".amenities-excluded .form-text").each(function () {
	jQuery(this).rules('add', {
        required: true
    });
});
jQuery(".amenities-extra-included .form-text").each(function () {
	jQuery(this).rules('add', {
        required: true
    });
	
});
jQuery('#addExc,#remIncExtra,#remExc').on('click', function(e) {
/***********************************************************/
jQuery(".amenities-extra-included .form-text").each(function () {
	jQuery(this).rules('add', {
        required: true
    });
	
});
jQuery(".amenities-excluded .form-text").each(function () {
	jQuery(this).rules('add', {
        required: true
    });
});
/***************************************************************/

});
/*******************************************************************************************/		
});