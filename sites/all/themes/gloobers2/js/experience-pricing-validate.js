jQuery.noConflict();
jQuery(document).ready(function() {

var early_bird = jQuery('input[name=early_birds_check]:checked');

if(early_bird.length>0)
{


/***************************************************************/
	var settings = jQuery("#product-pricing-form").validate().settings;
	
		// Modify validation settings
	    jQuery.extend(settings, {
	    	rules: {
					early_birds_price_value: {
					required: true, 
					digits: true,
					min:1
				},
			},
			
	    });
	jQuery("#product-pricing-form").valid();
	
/***************************************************************/


}
else
{
jQuery(".early-birds primary").hide();
}
var last_minute = jQuery('input[name=last_minutes_check]:checked');
if(last_minute.length>0)
{
jQuery(".last_minutes").show();
}
else
{
jQuery(".last_minutes").hide();
}
var hour_24_offer = jQuery('input[name=24_hour_offer_check]:checked');
if(hour_24_offer.length > 0)
{
 jQuery(".early-birds-hour-offer").show();
 jQuery(".form-item-schedule-type-24-hours").show();
 
}
else
{
 jQuery(".early-birds-hour-offer").hide();
 jQuery(".form-item-schedule-type-24-hours").hide();
}

jQuery('#early_birds_check').on('change', function() {

 if (this.checked) {

 jQuery(".primary").show();
  var $earlybirds = jQuery(".primary").find(":input");
  $earlybirds.prop("disabled",false);
  
  /*****************************************************************/
/*   var settings = jQuery("#product-pricing-form").validate().settings;

		// Modify validation settings
	    jQuery.extend(settings, {
	    	rules: {
				early_birds_price_value: {
			    required: true, 
				digits: true
			},		
			},
	    });
	jQuery("#product-pricing-form").valid(); */
	jQuery(".form-item-early-birds-price-value input").each(function () {
    jQuery(this).rules('add', {
        required: true,
		digits: true
    });
});
jQuery(".form-item-early-birds-time-value input").each(function () {
    jQuery(this).rules('add', {
        required: true,
		digits: true
    });
});
jQuery("#product-pricing-form .product_pricing_wrapper .themePrice .price_validate").each(function () {

    jQuery(this).rules('add', {
        required: true,
		digits: true,
		min:1,
		messages:{
	    min:"Please enter Price greater than 0"
	    }
    }
	);
});


  /*****************************************************************/
  

 }
 else
 {
 jQuery(".primary").hide();
  var $earlybirds = jQuery(".primary").find(":input");
  $earlybirds.prop("disabled",true);
 }
});

jQuery('#last_minutes_check').on('change', function() {
 if (this.checked) {
 jQuery(".last_minutes").show();
  var $last_minute = jQuery(".last_minutes").find(":input");
  $last_minute.prop("disabled",false);
  /**********************************************************************************************/
   /*  var settings = jQuery("#product-pricing-form").validate().settings;

		// Modify validation settings
	    jQuery.extend(settings, {
	    	rules: {
				last_minutes_price_value: {
			    required: true, 
				digits: true
			},		
			},
	    });
	jQuery("#product-pricing-form").valid(); */
	jQuery(".form-item-last-minutes-price-value input").each(function () {
    jQuery(this).rules('add', {
        required: true,
		digits: true
    });
});
jQuery(".form-item-last-minutes-time-value input").each(function () {
    jQuery(this).rules('add', {
        required: true,
		digits: true
    });
});
  /*****************************************************************/

 }
 else
 {
 jQuery(".last_minutes").hide();
  var $last_minute = jQuery(".last_minutes").find(":input");
  $last_minute.prop("disabled",true);
 }
});

jQuery('#24_hour_offer_check').on('change', function() {
 if (this.checked) {
 jQuery(".early-birds-hour-offer").show();
 jQuery(".form-item-schedule-type-24-hours").show();
  var $last_24_hour = jQuery(".early-birds-hour-offer").find(":input");
  $last_24_hour.prop("disabled",false);
  /*var $last_24_hour_schedule = jQuery(".form-item-schedule-type-24-hours").find(":input");
  $last_24_hour_schedule.prop("disabled",false);*/
  /*******distortion of design********************************************************************************/
     var settings = jQuery("#product-pricing-form").validate().settings;

		// Modify validation settings
	    jQuery.extend(settings,{
	    	rules: {
				offer_24_hour_price_value: {
			    required: true, 
				digits: true
			},	
            offer_24_hour_offer_date: {
			    required: true, 
		     },				
			},
	    });
	
  /*****************************************************************/

 }
 else
 {
 jQuery(".early-birds-hour-offer").hide();
 jQuery(".form-item-schedule-type-24-hours").hide();
  var $last_24_hour = jQuery(".early-birds-hour-offer").find(":input");
  $last_24_hour.prop("disabled",true);
 /* var $last_24_hour_schedule = jQuery(".form-item-schedule-type-24-hours").find(":input");
  $last_24_hour_schedule.prop("disabled",false);*/
 }
})


});
function validate_earlybirdtime(){

var time_type=jQuery('select[name=early_birds_time_type]').val();
var settings = jQuery("#product-pricing-form").validate().settings;
if(time_type=='day'){

	// Modify validation settings
	    jQuery.extend(settings, {
	    	rules: {
					early_birds_time_value: {
					required: true, 
					digits: true,
					min:7
				},
			},
			
	    });
}else{

	jQuery.extend(settings,{
	    	rules: {
					early_birds_time_value: {
					required: true, 
					digits: true,
					min:1
				},
			},
			
	    });
}
	jQuery("#product-pricing-form").valid();

}
function validate_lastminutetime(){
var settings = jQuery("#product-pricing-form").validate().settings;
var time_type=jQuery('select[name=last_minutes_time_type]').val();
if(time_type=='day'){
	// Modify validation settings
	    jQuery.extend(settings, {
	    	rules: {
					last_minutes_time_value: {
					required: true, 
					digits: true,
					max:6
				},
			},
			
	    });
}else{

	jQuery.extend(settings, {
	    	rules: {
					last_minutes_time_value: {
					required: true, 
					digits: true,
					max:144
				},
			},
			
	    });
}
	jQuery("#product-pricing-form").valid();

}function validate_lastminutetime(){
var settings = jQuery("#product-pricing-form").validate().settings;
var time_type=jQuery('select[name=last_minutes_time_type]').val();
if(time_type=='day'){
	// Modify validation settings
	    jQuery.extend(settings, {
	    	rules: {
					last_minutes_time_value: {
					required: true, 
					digits: true,
					max:6
				},
			},
			
	    });
}else{

	jQuery.extend(settings, {
	    	rules: {
					last_minutes_time_value: {
					required: true, 
					digits: true,
					max:144
				},
			},
			
	    });
}
	jQuery("#product-pricing-form").valid();

}
function Validate24hours_type(event){
	
	var value = jQuery("#edit-offer-24-hour-offer-date").val();
	var all_date_values=[];
	jQuery(".datepicker2").each(function(n) {
	
		all_date_values[n]=jQuery(this).val();
	});

	var hasDups = !all_date_values.every(function(v,i) {
	  return all_date_values.indexOf(v) == i;
	});
	var values_check=jQuery.inArray(value, all_date_values );
	if(values_check>=0){
		var hasDups=true;	
	} 
	/* jQuery('#product-pricing-form').submit(function(e) {
		if (hasDups) e.preventDefault();
	});  */
	

}
function hide_clone(){

jQuery('.pricediv_clone').remove();
var price_type=jQuery('#edit-product-pricing-type').val();
if(price_type=='PER_ITEM'){jQuery('.addPricing').parent().show();}
}

jQuery(document).ready(function(){
var value = jQuery(".price-option-type").val();
if(value == 'everyone'){

	jQuery('.addPricing').parent().hide();
}else{

	jQuery('.addPricing').parent().show();
}
var pricing_type =jQuery("#edit-product-pricing-type").val();

if(pricing_type=='PER_ITEM'){
jQuery('.addPricing').parent().show();
}



});


function val_price(){
var value = jQuery(".price-option-type").val();

if(value == 'everyone'){
	
	jQuery('.addPricing').parent().hide();
	jQuery('.pricediv_clone').hide();

}else if(value =='child'){

 jQuery('.clone_selectbox_price').html('<option value="adult">Adult</option>');
 jQuery('.addPricing').parent().show();

}else {
	var a = jQuery('.clone_selectbox_price').html('<option value="child">Child</option>');
	jQuery('.addPricing').parent().show();
}


}
