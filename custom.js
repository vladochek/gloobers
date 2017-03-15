var jq=jQuery.noConflict();
jq(document).ready(function(){
	   
	   if (jq("#edit-annulation-policy").is(":checked")) {
			   jq(".form-item-annulation-policy-days").show();
			   jq(".form-item-annulation-policy-refund").show();
	   }
	   
	   if(jq("#edit-product-pricing-quantity-type").val() == "Limited"){
			jq(".form-item-quantity-min").show();
			jq(".form-item-quantity-max").show();
			jq(".form-item-quantity-label").show();

	   }
	   else if(jq("#edit-product-pricing-quantity-type").val() == "Unlimited"){
			jq(".form-item-quantity-min").hide();
			jq(".form-item-quantity-max").hide();
			jq(".form-item-quantity-label").hide();
	   }	   

		jq("#edit-product-pricing-quantity-type").change(function(){
			if(jq(this).val() == "Limited"){
				jq(".form-item-quantity-min").show();
				jq(".form-item-quantity-max").show();
				jq(".form-item-quantity-label").show();

			}
			else if(jq(this).val() == "Unlimited"){
				jq(".form-item-quantity-min").hide();
				jq(".form-item-quantity-max").hide();
				jq(".form-item-quantity-label").hide();
			}			
		});	
	   
	   jq("#rentals-rules-form .relaxed").hide();
	   jq("#rentals-rules-form .flexible").hide();
	   jq("#rentals-rules-form .moderate").hide();
	   jq("#rentals-rules-form .strict").hide();
	   jq("#rentals-rules-form .super_strict").hide();
	   jq("#rentals-rules-form .cancelation-policy-entire-stay").hide();
	   jq("#rentals-rules-form .cancelation-policy-pending-stay").hide();
	   
	   if(jq("#edit-cancellation-policies-type").val() == "Relaxed"){
			jq("#rentals-rules-form .relaxed").show();

	   }
	   else if(jq("#edit-cancellation-policies-type").val() == "Flexible"){
			jq("#rentals-rules-form .flexible").show();
	   }
	   else if(jq("#edit-cancellation-policies-type").val() == "Moderate"){
			jq("#rentals-rules-form .moderate").show();
	   }
	   else if(jq("#edit-cancellation-policies-type").val() == "Strict"){
			jq("#rentals-rules-form .strict").show();
	   }
	   else if(jq("#edit-cancellation-policies-type").val() == "Super-Strict"){
			jq("#rentals-rules-form .super_strict").show();
	   }
	   else if(jq("#edit-cancellation-policies-type").val() == "Custom"){
		   jq("#rentals-rules-form .cancelation-policy-entire-stay").show();
		   jq("#rentals-rules-form .cancelation-policy-pending-stay").show();
	   }

	   jq("#restaurant-rules-form .relaxed").hide();
	   jq("#restaurant-rules-form .flexible").hide();
	   jq("#restaurant-rules-form .moderate").hide();
	   jq("#restaurant-rules-form .strict").hide();
	   jq("#restaurant-rules-form .super_strict").hide();
	   jq("#restaurant-rules-form .cancelation-policy-entire-stay").hide();
	   jq("#restaurant-rules-form .cancelation-policy-pending-stay").hide();
	   
	   if(jq("#edit-cancellation-policies-type").val() == "Relaxed"){
			jq("#restaurant-rules-form .relaxed").show();

	   }
	   else if(jq("#edit-cancellation-policies-type").val() == "Flexible"){
			jq("#restaurant-rules-form .flexible").show();
	   }
	   else if(jq("#edit-cancellation-policies-type").val() == "Moderate"){
			jq("#restaurant-rules-form .moderate").show();
	   }
	   else if(jq("#edit-cancellation-policies-type").val() == "Strict"){
			jq("#restaurant-rules-form .strict").show();
	   }
	   else if(jq("#edit-cancellation-policies-type").val() == "Super-Strict"){
			jq("#restaurant-rules-form .super_strict").show();
	   }
	   else if(jq("#edit-cancellation-policies-type").val() == "Custom"){
		   jq("#restaurant-rules-form .cancelation-policy-entire-stay").show();
		   jq("#restaurant-rules-form .cancelation-policy-pending-stay").show();
	   }
		jq(".form-type-select form-item-openning-hours-days").hide();
	   if(jq("#edit-openning-hours-type").val() == "every-day"){
			jq(".form-item-openning-hours-days").hide();
			jq(".form-item-openning-hours-dates").hide();

	   }
	   else if(jq("#edit-openning-hours-type").val() == "specific-days"){
			jq(".form-item-openning-hours-days").show();
			jq(".form-item-openning-hours-dates").hide();
	   }
	   else if(jq("#edit-openning-hours-type").val() == "specific-dates"){
			jq(".form-item-openning-hours-days").hide();
			jq(".form-item-openning-hours-dates").show();
	   }

	   jq("#edit-openning-hours-type").change(function(){
		   if(jq(this).val() == "every-day"){
				jq(".form-item-openning-hours-days").hide();
				jq(".form-item-openning-hours-dates").hide();

		   }
		   else if(jq(this).val() == "specific-days"){
				jq(".form-item-openning-hours-days").show();
				jq(".form-item-openning-hours-dates").hide();
		   }
		   else if(jq(this).val() == "specific-dates"){
				jq(".form-item-openning-hours-days").hide();
				jq(".form-item-openning-hours-dates").show();
		   }			
	   });	   
		jq(".rentals-scheduling").hide();

		if(jq("#edit-rentals-dates-available").val() == "ALWAYS"){
			jq(".rentals-scheduling").hide();

		}
		else if(jq("#edit-rentals-dates-available").val() == "MOSTLY" || jq("#edit-rentals-dates-available").val() == "OCCASIONNALY"){
			jq(".rentals-scheduling").show();
		}
	   
	   jq("#edit-rentals-dates-available").change(function(){
		   if(jq(this).val() == "ALWAYS"){
				jq(".rentals-scheduling").hide();

		   }
		   else if(jq(this).val() == "MOSTLY" || jq(this).val() == "OCCASIONNALY"){
				jq(".rentals-scheduling").show();
		   }		
	   });	
	   

		jq(".rentals-scheduling").hide();

		if(jq("#edit-restaurant-dates-available").val() == "YEARLY"){
			jq(".rentals-scheduling").hide();

		}
		else if(jq("#edit-restaurant-dates-available").val() == "SEASON"){
			jq(".rentals-scheduling").show();
		}
	   
	   jq("#edit-restaurant-dates-available").change(function(){
		   if(jq(this).val() == "YEARLY"){
				jq(".rentals-scheduling").hide();

		   }
		   else if(jq(this).val() == "SEASON"){
				jq(".rentals-scheduling").show();
		   }		
	   });	
	   
		jq(".form-type-select form-item-openning-hours-days").hide();
	   if(jq("#edit-sessions-type").val() == "Single-time"){
			jq(".form-item-sessions-date").show();
			jq(".form-item-sessions-time").show();
			jq(".form-item-sessions-days").hide();

	   }
	   else if(jq("#edit-sessions-type").val() == "every"){
			jq(".form-item-sessions-time").show();
			jq(".form-item-sessions-days").show();
			jq(".form-item-sessions-date").hide();
	   }
/* 	   else if(jq("#edit-openning-hours-type").val() == "specific-dates"){
			jq(".form-item-openning-hours-days").hide();
	   } */
	   else if(jq("#edit-sessions-type").val() == "on-demand"){
			jq(".form-item-sessions-time").hide();
			jq(".form-item-sessions-days").hide();
			jq(".form-item-sessions-date").hide();
	   }	
	   jq("#edit-sessions-type").change(function(){
		   if(jq(this).val() == "Single-time"){
				jq(".form-item-sessions-date").show();
				jq(".form-item-sessions-time").show();
				jq(".form-item-sessions-days").hide();
				jq(".form-item-sessions-time-from").show();
				jq(".form-item-sessions-time-to").show();
		   }
		   else if(jq(this).val() == "every"){

				jq(".form-item-sessions-days").show();
				jq(".form-item-sessions-date").hide();
				jq(".form-item-sessions-time-from").show();
				jq(".form-item-sessions-time-to").show();
		   }
		   else if(jq(this).val() == "on-demand"){
				jq(".form-item-sessions-time").hide();
				jq(".form-item-sessions-days").hide();
				jq(".form-item-sessions-date").hide();
				jq(".form-item-sessions-time-from").hide();
				jq(".form-item-sessions-time-to").hide();
		   }		   
	   });	
	   
	   jq("#edit-cancellation-policies-type").change(function(){
		   if(jq(this).val() == "Relaxed"){
				jq("#rentals-rules-form .relaxed").show();
				jq("#rentals-rules-form .flexible").hide();
				jq("#rentals-rules-form .moderate").hide();
				jq("#rentals-rules-form .strict").hide();
				jq("#rentals-rules-form .super_strict").hide();
				jq("#rentals-rules-form .cancelation-policy-entire-stay").hide();
				jq("#rentals-rules-form .cancelation-policy-pending-stay").hide();
		   }
		   else if(jq(this).val() == "Flexible"){
				jq("#rentals-rules-form .relaxed").hide();
				jq("#rentals-rules-form .flexible").show();
				jq("#rentals-rules-form .moderate").hide();
				jq("#rentals-rules-form .strict").hide();
				jq("#rentals-rules-form .super_strict").hide();
				jq("#rentals-rules-form .cancelation-policy-entire-stay").hide();
				jq("#rentals-rules-form .cancelation-policy-pending-stay").hide();
		   }
		   else if(jq(this).val() == "Moderate"){
				jq("#rentals-rules-form .relaxed").hide();
				jq("#rentals-rules-form .flexible").hide();
				jq("#rentals-rules-form .moderate").show();
				jq("#rentals-rules-form .strict").hide();
				jq("#rentals-rules-form .super_strict").hide();
				jq("#rentals-rules-form .cancelation-policy-entire-stay").hide();
				jq("#rentals-rules-form .cancelation-policy-pending-stay").hide();
		   }
		   else if(jq(this).val() == "Strict"){
				jq("#rentals-rules-form .relaxed").hide();
				jq("#rentals-rules-form .flexible").hide();
				jq("#rentals-rules-form .moderate").hide();
				jq("#rentals-rules-form .strict").show();
				jq("#rentals-rules-form .super_strict").hide();
				jq("#rentals-rules-form .cancelation-policy-entire-stay").hide();
				jq("#rentals-rules-form .cancelation-policy-pending-stay").hide();
		   }
		   else if(jq(this).val() == "Super-Strict"){
				jq("#rentals-rules-form .relaxed").hide();
				jq("#rentals-rules-form .flexible").hide();
				jq("#rentals-rules-form .moderate").hide();
				jq("#rentals-rules-form .strict").hide();
				jq("#rentals-rules-form .super_strict").show();
				jq("#rentals-rules-form .cancelation-policy-entire-stay").hide();
				jq("#rentals-rules-form .cancelation-policy-pending-stay").hide();
		   }
		   else if(jq(this).val() == "Custom"){
				jq("#rentals-rules-form .relaxed").hide();
				jq("#rentals-rules-form .flexible").hide();
				jq("#rentals-rules-form .moderate").hide();
				jq("#rentals-rules-form .strict").hide();
				jq("#rentals-rules-form .super_strict").hide();
				jq("#rentals-rules-form .cancelation-policy-entire-stay").show();
				jq("#rentals-rules-form .cancelation-policy-pending-stay").show();
		   }
	   });
	   

	   jq("#edit-cancellation-policies-type").change(function(){
		   if(jq(this).val() == "Relaxed"){
				jq("#restaurant-rules-form .relaxed").show();
				jq("#restaurant-rules-form .flexible").hide();
				jq("#restaurant-rules-form .moderate").hide();
				jq("#restaurant-rules-form .strict").hide();
				jq("#restaurant-rules-form .super_strict").hide();
				jq("#restaurant-rules-form .cancelation-policy-entire-stay").hide();
				jq("#restaurant-rules-form .cancelation-policy-pending-stay").hide();
		   }
		   else if(jq(this).val() == "Flexible"){
				jq("#restaurant-rules-form .relaxed").hide();
				jq("#restaurant-rules-form .flexible").show();
				jq("#restaurant-rules-form .moderate").hide();
				jq("#restaurant-rules-form .strict").hide();
				jq("#restaurant-rules-form .super_strict").hide();
				jq("#restaurant-rules-form .cancelation-policy-entire-stay").hide();
				jq("#restaurant-rules-form .cancelation-policy-pending-stay").hide();
		   }
		   else if(jq(this).val() == "Moderate"){
				jq("#restaurant-rules-form .relaxed").hide();
				jq("#restaurant-rules-form .flexible").hide();
				jq("#restaurant-rules-form .moderate").show();
				jq("#restaurant-rules-form .strict").hide();
				jq("#restaurant-rules-form .super_strict").hide();
				jq("#restaurant-rules-form .cancelation-policy-entire-stay").hide();
				jq("#restaurant-rules-form .cancelation-policy-pending-stay").hide();
		   }
		   else if(jq(this).val() == "Strict"){
				jq("#restaurant-rules-form .relaxed").hide();
				jq("#restaurant-rules-form .flexible").hide();
				jq("#restaurant-rules-form .moderate").hide();
				jq("#restaurant-rules-form .strict").show();
				jq("#restaurant-rules-form .super_strict").hide();
				jq("#restaurant-rules-form .cancelation-policy-entire-stay").hide();
				jq("#restaurant-rules-form .cancelation-policy-pending-stay").hide();
		   }
		   else if(jq(this).val() == "Super-Strict"){
				jq("#restaurant-rules-form .relaxed").hide();
				jq("#restaurant-rules-form .flexible").hide();
				jq("#restaurant-rules-form .moderate").hide();
				jq("#restaurant-rules-form .strict").hide();
				jq("#restaurant-rules-form .super_strict").show();
				jq("#restaurant-rules-form .cancelation-policy-entire-stay").hide();
				jq("#restaurant-rules-form .cancelation-policy-pending-stay").hide();
		   }
		   else if(jq(this).val() == "Custom"){
				jq("#restaurant-rules-form .relaxed").hide();
				jq("#restaurant-rules-form .flexible").hide();
				jq("#restaurant-rules-form .moderate").hide();
				jq("#restaurant-rules-form .strict").hide();
				jq("#restaurant-rules-form .super_strict").hide();
				jq("#restaurant-rules-form .cancelation-policy-entire-stay").show();
				jq("#restaurant-rules-form .cancelation-policy-pending-stay").show();
		   }
	   });
	   
	   jq(".form-item-product-pricing-key select").change(function(){
			if(jq(this).val() == "family-of-three" || jq(this).val() == "family-of-four" || jq(this).val() == "family-of-five"){
				jq(this).parent().parent().find(".form-item-product-pricing-person-type").show();
				jq(this).parent().parent().find(".form-item-product-pricing-max-participants").hide();
			}
			else if(jq(this).val() == "group"){
				jq(this).parent().parent().find(".form-item-product-pricing-person-type").show();
				jq(this).parent().parent().find(".form-item-product-pricing-max-participants").show();
			}
			else{
				jq(this).parent().parent().find(".form-item-product-pricing-person-type").hide();
				jq(this).parent().parent().find(".form-item-product-pricing-max-participants").hide();				
			}
	   });

		if(jq(".price-option-type").val() == "group"){
			jq(this).parent().next(".product_pricing").find('.max-partners').show();
			jq(this).parent().next(".product_pricing").find('.pricing-group-type').show();
		}
		else if(jq(".price-option-type").val() == "family-of-four" || jq(".price-option-type").val() == "family-of-three" || jq(".price-option-type").val() == "family-of-five"){
			jq(this).parent().next(".product_pricing").find('.max-partners').hide();
			jq(this).parent().next(".product_pricing").find('.pricing-group-type').show();				
		}
		else{
			jq(this).parent().next(".product_pricing").find('.max-partners').hide();
			jq(this).parent().next(".product_pricing").find('.pricing-group-type').hide();				
		}	   
	   
		jq(".product_pricing_wrapper .product_pricing").hide();
		jq(".product_pricing_wrapper .pricetype_options_"+jq(".form-item-product-pricing-type select").val()).show();
			
		jq(".form-item-product-pricing-type select").change(function(){
			jq(".product_pricing_wrapper .product_pricing").hide();
			jq(".product_pricing_wrapper .pricetype_options_"+jq(this).val()).show();
			if(jq(this).val() == "PER_PERSON"){
				if(jq(".price-option-type").val() == "group"){
					jq(this).parent().next(".product_pricing").find('.max-partners').show();
					jq(this).parent().next(".product_pricing").find('.pricing-group-type').show();
				}
				else if(jq(".price-option-type").val() == "family-of-four" || jq(".price-option-type").val() == "family-of-three" || jq(".price-option-type").val() == "family-of-five"){
					jq(this).parent().next(".product_pricing").find('.max-partners').hide();
					jq(this).parent().next(".product_pricing").find('.pricing-group-type').show();				
				}
				else{
					jq(this).parent().next(".product_pricing").find('.max-partners').hide();
					jq(this).parent().next(".product_pricing").find('.pricing-group-type').hide();				
				}		
	
				jq(".pricetype_options_PER_PERSON select").change(function(){
					if(jq(this).val() == "group"){
						jq(this).parent().parent(".product_pricing").find('.max-partners').show();
						jq(this).parent().parent(".product_pricing").find('.pricing-group-type').show();
					}
					else if(jq(this).val() == "family-of-four" || jq(this).val() == "family-of-three" || jq(this).val() == "family-of-five"){
						jq(this).parent().parent(".product_pricing").find('.max-partners').hide();
						jq(this).parent().parent(".product_pricing").find('.pricing-group-type').show();				
					}
					else{
						jq(this).parent().parent(".product_pricing").find('.max-partners').hide();
						jq(this).parent().parent(".product_pricing").find('.pricing-group-type').hide();				
					}
				});	
				
			}
		})
		
		if(jq(".pricetype_options_PER_PERSON .price-option-type").val() == "group"){
			jq(".pricetype_options_PER_PERSON .price-option-type").parent().parent().find('.max-partners').show();
			jq(".pricetype_options_PER_PERSON .price-option-type").parent().parent().find('.pricing-group-type').show();
		}
		else if(jq(".pricetype_options_PER_PERSON .price-option-type").val() == "family-of-four" || jq(this).val() == "family-of-three" || jq(this).val() == "family-of-five"){
			jq(".pricetype_options_PER_PERSON .price-option-type").parent().parent().find('.max-partners').hide();
			jq(".pricetype_options_PER_PERSON .price-option-type").parent().parent().find('.pricing-group-type').show();				
		}
		else{
			jq(".pricetype_options_PER_PERSON .price-option-type").parent().parent().find('.max-partners').hide();
			jq(".pricetype_options_PER_PERSON .price-option-type").parent().parent().find('.pricing-group-type').hide();				
		}	
			
		jq(".pricetype_options_PER_PERSON .price-option-type").change(function(){
			if(jq(this).val() == "group"){
				jq(this).parent().parent().find('.max-partners').show();
				jq(this).parent().parent().find('.pricing-group-type').show();
			}
			else if(jq(this).val() == "family-of-four" || jq(this).val() == "family-of-three" || jq(this).val() == "family-of-five"){
				jq(this).parent().parent().find('.max-partners').hide();
				jq(this).parent().parent().find('.pricing-group-type').show();				
			}
			else{
				jq(this).parent().parent().find('.max-partners').hide();
				jq(this).parent().parent().find('.pricing-group-type').hide();				
			}
		});
		
		if (jq("#edit-purchased-as-gift").is(":checked")) {
		   jq(".form-item-gift-card-expires").show();
		}
			
		jq("#edit-purchased-as-gift").click(function(){
			if (jq("#edit-purchased-as-gift").is(":checked")) {
			   jq(".form-item-gift-card-expires").show();
			}
			else{
				jq(".form-item-gift-card-expires").hide();
			}
		});


		if (jq("#edit-another-pricing").is(":checked")) {
		   jq(".schedule-pricing-wrapper input[type=text]").attr("disabled",false);
		}
			
		jq("#edit-another-pricing").click(function(){
			if (jq("#edit-another-pricing").is(":checked")) {
			   jq(".schedule-pricing-wrapper input[type=text]").attr("disabled",false);
			}
			else{
				jq(".schedule-pricing-wrapper input[type=text]").attr("disabled",true);
			}
		});

		if (jq("#edit-another-discount").is(":checked")) {
		   jq(".schedule-discount-inner-wrapper input[type=text]").attr("disabled",false);
		   jq(".schedule-discount-inner-wrapper select").attr("disabled",false);
		}
		else{
		   jq(".schedule-discount-inner-wrapper input[type=text]").attr("disabled",true);
		   jq(".schedule-discount-inner-wrapper select").attr("disabled",true);			
		}
			
		jq("#edit-another-discount").click(function(){
			if (jq("#edit-another-discount").is(":checked")) {
			   jq(".schedule-discount-inner-wrapper input[type=text]").attr("disabled",false);
			   jq(".schedule-discount-inner-wrapper select").attr("disabled",false);
			}
			else{
			   jq(".schedule-discount-inner-wrapper input[type=text]").attr("disabled",true);
			   jq(".schedule-discount-inner-wrapper select").attr("disabled",true);			
			}
		});		

		if (jq("#edit-all-day-session-all-day").is(":checked")) {
		   jq(".form-item-Session-startTime").hide();
		   jq(".form-item-Session-endTime").hide();
		}
			
		jq("#edit-all-day-session-all-day").click(function(){
			if (jq(this).is(":checked")) {
			   jq(".form-item-Session-startTime").hide();
			   jq(".form-item-Session-endTime").hide();
			}
			else{
			   jq(".form-item-Session-startTime").show();
			   jq(".form-item-Session-endTime").show();
			}
		});
		
		
		if (jq("#edit-payment-methods").is(":checked")) {
			jq(".amenities-payment-methods").show();
		}
		else{
			jq(".amenities-payment-methods").hide();
		}
			
		jq("#edit-payment-methods").click(function(){

			if (jq("#edit-payment-methods").is(":checked")) {
			   jq(".amenities-payment-methods").show();
			}
			else{
				jq(".amenities-payment-methods").hide();
			}
		});

		
		if (jq("#edit-special-deposit-rules").is(":checked")) {
		   jq(".form-item-special-deposit-rules-type").show();
		   if(jq("#edit-special-deposit-rules-type").val() == "DEPOSIT_PERCENT"){
				jq(".form-item-special-deposit-rules-value-perc").show();
				jq(".form-item-special-deposit-rules-value-dollor").hide();
		   }
		   else if((jq("#edit-special-deposit-rules-type").val() == "DEPOSIT_FIXED") ||  (jq("#edit-special-deposit-rules-type").val() == "DEPOSIT_FIXED_PER_ORDER")){
				jq(".form-item-special-deposit-rules-value-dollor").show();
				jq(".form-item-special-deposit-rules-value-perc").hide();
		   }
		   else if((jq("#edit-special-deposit-rules-type").val() == "FULL") ||  (jq("#edit-special-deposit-rules-type").val() == "NONE")){
				jq(".form-item-special-deposit-rules-value-dollor").hide();
				jq(".form-item-special-deposit-rules-value-perc").hide();
		   }
		}
			
		jq("#edit-special-deposit-rules").click(function(){
			if (jq("#edit-special-deposit-rules").is(":checked")) {
				   jq(".form-item-special-deposit-rules-type").show();
				   if(jq("#edit-special-deposit-rules-type").val() == "DEPOSIT_PERCENT"){
						jq(".form-item-special-deposit-rules-value-perc").show();
						jq(".form-item-special-deposit-rules-value-dollor").hide();
				   }
				   else if((jq("#edit-special-deposit-rules-type").val() == "DEPOSIT_FIXED") ||  (jq("#edit-special-deposit-rules-type").val() == "DEPOSIT_FIXED_PER_ORDER")){
						jq(".form-item-special-deposit-rules-value-dollor").show();
						jq(".form-item-special-deposit-rules-value-perc").hide();
				   }
				   else if((jq("#edit-special-deposit-rules-type").val() == "FULL") ||  (jq("#edit-special-deposit-rules-type").val() == "NONE")){
						jq(".form-item-special-deposit-rules-value-dollor").hide();
						jq(".form-item-special-deposit-rules-value-perc").hide();
				   }
			}
			else{
				jq(".form-item-special-deposit-rules-type").hide();
				jq(".form-item-special-deposit-rules-value-dollor").hide();
				jq(".form-item-special-deposit-rules-value-perc").hide();
			}
		});

		if (jq("#edit-miscellaneous-fees-included").is(":checked")) {
			jq(".miscellaneous_fees").hide();
		}
		else{
			jq(".miscellaneous_fees").show();
		}
		
		jq("#edit-miscellaneous-fees-included").click(function(){
			if (jq(this).is(":checked")) {
				jq(".miscellaneous_fees").hide();
			}
			else{
				jq(".miscellaneous_fees").show();
			}
		});
		
		jq("#edit-annulation-policy").click(function(){
			if (jq("#edit-annulation-policy").is(":checked")) {
				   jq(".form-item-annulation-policy-days").show();
				   jq(".form-item-annulation-policy-refund").show();
			}
			else{
				   jq(".form-item-annulation-policy-days").hide();
				   jq(".form-item-annulation-policy-refund").hide();
			}
		});

		jq("#edit-special-deposit-rules-type").change(function(){
			   if(jq(this).val() == "DEPOSIT_PERCENT"){
					jq(".form-item-special-deposit-rules-value-perc").show();
					jq(".form-item-special-deposit-rules-value-dollor").hide();
			   }
			   else if((jq(this).val() == "DEPOSIT_FIXED") ||  (jq(this).val() == "DEPOSIT_FIXED_PER_ORDER")){
					jq(".form-item-special-deposit-rules-value-dollor").show();
					jq(".form-item-special-deposit-rules-value-perc").hide();
			   }
			   else if((jq(this).val() == "FULL") ||  (jq(this).val() == "NONE")){
					jq(".form-item-special-deposit-rules-value-dollor").hide();
					jq(".form-item-special-deposit-rules-value-perc").hide();
			   }			
		})	

		if (jq("#edit-extra-value-has-extra").is(":checked")) {
		   jq(".product-extra").show();
		}
		
		jq("#edit-extra-value input").click(function(){
			var button = jq(this).val();
			if(button == "has-extra"){
				jq(".product-extra").show();
			}
			else{
				jq(".product-extra").hide();
			}
		});
		jq(".form-item-fixed-date").hide();
		jq(".form-item-Product-bookingTimeMode").hide();
		jq(".form-item-time-available-value").hide();
		jq("#addTime").hide();
		jq(".form-item-fixed-time-from").hide();
		jq(".form-item-season-label").hide();
		jq(".form-item-fixed-time-to").hide();
		jq("#addSchedule").hide();
		if (jq("#edit-product-bookingmode").val() == "NO_DATE") {
						jq(".form-item-fixed-date").hide();
						jq(".form-item-fixed-time-from").hide();
						jq(".form-item-time-available-type").hide();
						jq(".form-item-fixed-time-to").hide();
						jq(".time-available").hide();
						jq("#session-wrapper").hide();
						jq(".form-item-season-label").hide();
						jq(".form-item-Product-bookingTimeMode").hide();
						/***********added on 29th sept***********************/
						jq(".form-item-Product-allowSpanning").hide();
						jq("#edit-product-durationtype").val("LIST").attr("selected","selected");
						jq("#edit-product-durationtype").attr("disabled",true);
						jq(".min-max-duration").hide();
						jq(".choose-list-duration").show();
						/**********************************/
						jq(".product-availability").hide();
						jq("#addSchedule").hide();
		}	
		else if (jq("#edit-product-bookingmode").val() == "INVENTORY") {
						jq(".form-item-fixed-date").show();
						jq(".form-item-fixed-time-from").show();
						jq(".form-item-fixed-time-to").show();
						jq(".form-item-time-available-type").hide();
						jq("#addSchedule").show();
						jq(".time-available").hide();
						jq(".form-item-Product-bookingTimeMode").hide();
						jq("#session-wrapper").show();
						jq(".form-item-season-label").show();
						/***********added on 29th sept***********************/
						jq(".form-item-Product-allowSpanning").show();
						jq("#edit-product-durationtype").val("Any").attr("selected","selected");
						jq("#edit-product-durationtype").attr("disabled",false);
						jq(".min-max-duration").show();
						jq(".choose-list-duration").hide();
						/**********************************/
						jq(".product-availability").show();
		}	
		else if (jq("#edit-product-bookingmode").val() == "DATE_ENQUIRY") {
						jq(".time-available").show();
						jq(".form-item-time-available-value").show();
						jq(".form-item-fixed-date").hide();
						jq(".form-item-Product-bookingTimeMode").show();
						jq(".form-item-fixed-time-from").hide();
						jq(".form-item-time-available-type").show();
						jq(".form-item-fixed-time-to").hide();
						jq(".product-availability").hide();
						jq("#session-wrapper").hide();
						jq(".form-item-season-label").hide();
						jq("#addSchedule").hide();
						/***********added on 29th sept***********************/
						jq(".form-item-Product-allowSpanning").hide();
						jq("#edit-product-durationtype").val("Any").attr("selected","selected");
						jq("#edit-product-durationtype").attr("disabled",false);
						jq(".min-max-duration").show();
						jq(".choose-list-duration").hide();
						/**********************************/
		}		
		jq("#edit-product-bookingmode").change(function(){
			var type = jq(this).val();
			switch(type){
				case 'NO_DATE':
						jq(".form-item-fixed-date").hide();
						jq(".form-item-fixed-time-from").hide();
						jq(".form-item-time-available-type").hide();
						jq(".form-item-Product-bookingTimeMode").hide();
						jq(".form-item-fixed-time-to").hide();
						jq(".time-available").hide();
						jq(".product-schedules-listing").hide();
						jq(".time-available #removeTime").hide();
						jq("#session-wrapper").hide();
						if(jq(".add-another-schedule").attr("class") == "btn btn-dark btn-gradient add-another-schedule form-submit"){
							jq(".add-another-schedule").val("Save");
						}
						jq(".form-item-season-label").hide();
						jq(".product-availability").hide();
						/***********added on 29th sept***********************/
						jq(".form-item-Product-allowSpanning").hide();
						jq("#edit-product-durationtype").val("LIST").attr("selected","selected");
						jq("#edit-product-durationtype").attr("disabled",true);
						jq(".min-max-duration").hide();
						jq(".choose-list-duration").show();
						/**********************************/
						break;
				case 'INVENTORY':
						jq(".form-item-fixed-date").show();
						jq(".form-item-fixed-time-from").show();
						jq(".form-item-fixed-time-to").show();
						jq(".product-schedules-listing").show();
						jq(".form-item-time-available-type").hide();
						jq(".form-item-Product-bookingTimeMode").hide();
						jq(".time-available").hide();
						if(jq(".add-another-schedule").attr("class") == "btn btn-dark btn-gradient add-another-schedule form-submit"){
							jq(".add-another-schedule").val("Add another schedule");
						}
						jq(".time-available #removeTime").hide();
						jq(".form-item-season-label").show();
						jq(".product-availability").show();
						jq("#session-wrapper").show();
						
						/***********added on 29th sept***********************/
						jq(".form-item-Product-allowSpanning").show();
						jq("#edit-product-durationtype").val("Any").attr("selected","selected");
						jq("#edit-product-durationtype").attr("disabled",false);
						jq(".min-max-duration").show();
						jq(".choose-list-duration").hide();
						/**********************************/
						
 						if (jq("#edit-product-inventorymode").val() == "SESSION_SEATS") {
						   jq(".form-item-availability-value").show();
						   jq(".manage-resources").hide();
						}
						else if(jq("#edit-product-inventorymode").val() == "RESOURCES"){
						   jq(".form-item-availability-value").hide();
						   jq(".manage-resources").show();							
						}
						else if(jq("#edit-product-inventorymode").val() == "FREE_SALE"){
						   jq(".form-item-availability-value").hide();
						   jq(".manage-resources").hide();							
						} 
						break;
				case 'DATE_ENQUIRY':
						jq(".time-available").show();
						jq(".form-item-time-available-value").show();
						jq("#addTime").show();
						jq(".form-item-fixed-date").hide();
						jq(".product-schedules-listing").hide();
						jq(".form-item-fixed-time-from").hide();
						jq(".form-item-Product-bookingTimeMode").show();
						jq(".form-item-time-available-type").show();
						jq(".form-item-fixed-time-to").hide();
						jq(".product-availability").hide();
						jq("#removeTime").show();
						if(jq(".add-another-schedule").attr("class") == "btn btn-dark btn-gradient add-another-schedule form-submit"){
							jq(".add-another-schedule").val("Save");
						}
						jq(".form-item-season-label").hide();
						jq("#session-wrapper").hide();
						/***********added on 29th sept***********************/
						jq(".form-item-Product-allowSpanning").hide();
						jq("#edit-product-durationtype").val("Any").attr("selected","selected");
						jq("#edit-product-durationtype").attr("disabled",false);
						jq(".min-max-duration").show();
						jq(".choose-list-duration").hide();
						/**********************************/
						break;
				default:
						jq(".product-availability").show();
						break;
			}
		});
 		if (jq("#edit-product-inventorymode").val() == "SESSION_SEATS") {
			jq(".form-item-Product-defaultQuantity").show();
			jq(".manage-resources").hide();
		}	
		else{
			jq(".form-item-Product-defaultQuantity").hide();
			jq(".manage-resources").hide();
		}
		jq("#edit-product-inventorymode").change(function(){
			var type = jq(this).val();
			switch(type){
				case 'FREE_SALE':
						jq(".form-item-Product-defaultQuantity").hide();
						jq(".manage-resources").hide();
						break;
				case 'SESSION_SEATS':
						jq(".form-item-Product-defaultQuantity").show();
						jq(".manage-resources").hide();
						break;
				case 'RESOURCES':
						jq(".form-item-Product-defaultQuantity").hide();
						jq(".manage-resources").show();
						break;
				default:
						jq(".product-availability").show();
						break;
			}
		});
		if ((jq("#edit-product-confirmmode").val() == "AUTOCONFIRM") || (jq("#edit-product-confirmmode").val() == "MANUAL")) {
		   jq(".form-item-confirm-booking-value").hide();
		}	
		else{
			jq(".form-item-confirm-booking-value").show();
		}		
		jq("#edit-product-confirmmode").change(function(){
			var type = jq(this).val();
			switch(type){
				case 'AUTOCONFIRM':
						jq(".form-item-confirm-booking-value").hide();
						break;
				case 'MANUAL':
						jq(".form-item-confirm-booking-value").hide();
						break;
				case 'MANUAL_THEN_AUTO':
						jq(".form-item-confirm-booking-value").show();
						break;
				case 'AUTO_THEN_MANUAL':
						jq(".form-item-confirm-booking-value").show();
						break;
				default:
						jq(".form-item-confirm-booking-value").hide();
						break;
			}
		});

		if (jq("#edit-product-bookingtimemode").val() == "FIXED") {
			if (jq("#edit-dates-available").val() == "DATE_ENQUIRY") {
				jq(".time-available").show();
				jq("#addTime").show();
			}
		}	
		else if (jq("#edit-product-bookingtimemode").val() == "TIME_ENQUIRY") {
			jq(".time-available").hide();
			jq("#addTime").hide();
		}	
		else if (jq("#edit-product-bookingtimemode").val() == "NO_TIME") {
			jq(".form-item-time-available-value").hide();
			jq("#addTime").hide();
		}			
		jq("#edit-product-bookingtimemode").change(function(){
			var type = jq(this).val();
			switch(type){
				case 'FIXED':
						jq(".time-available").show();
						jq("#addTime").show();
						
						break;
				case 'TIME_ENQUIRY':
						jq(".time-available").hide();
						jq("#addTime").hide();
						break;
				case 'NO_TIME':
						jq(".time-available").hide();
						jq("#addTime").hide();
						break;
				default:
						jq(".time-available").show();
						break;
			}
		});

		if (jq("#edit-session-repeatperiod").val() == "DoNOt") {
			jq(".form-item-Session-repeatEveryMinute").hide();
			jq(".repeatEveryDay").hide();
			jq(".repeatEveryHour").hide();
			jq(".form-item-repeat-session-weekly-on").hide();
			jq(".form-item-Session-endRepeatDate").hide();
			jq(".repeatEveryMonth").hide();
			jq(".repeatEveryYear").hide();
			jq(".repeatEveryWeek").hide();
			jq(".form-item-session-repeats-from").hide();
			jq(".form-item-session-repeats-to").hide();
			jq("#repeat-session-wrapper").hide();
/* 			jq(".form-item-repeat-session-weekly-on").hide(); */
			jq("#addSession").hide();
		}	
		else if (jq("#edit-session-repeatperiod").val() == "Minute") {
			jq(".form-item-Session-repeatEveryMinute").show();
			jq(".repeatEveryDay").hide();
			jq(".repeatEveryHour").hide();
			jq(".repeatEveryMonth").hide();
			jq(".repeatEveryYear").hide();
			jq(".repeatEveryWeek").hide();
			jq(".form-item-repeat-session-weekly-on").hide();
			jq(".form-item-Session-endRepeatDate").show();
			jq(".form-item-session-repeats-from").show();
			jq("#repeat-session-wrapper .rep-sessions .form-type-textfield").show();
			jq(".form-item-session-repeats-to").show();
			jq("#addSession").show();
			jq("#repeat-session-wrapper").show();
		}	
		else if (jq("#edit-session-repeatperiod").val() == "Hourly") {
			jq(".form-item-Session-repeatEveryMinute").hide();
			jq(".repeatEveryDay").hide();
			jq(".repeatEveryHour").show();
			jq(".repeatEveryMonth").hide();
			jq(".repeatEveryYear").hide();
			jq(".repeatEveryWeek").hide();
			jq(".form-item-repeat-session-weekly-on").hide();
			jq(".form-item-Session-endRepeatDate").show();
			jq(".form-item-session-repeats-from").show();
			jq(".form-item-session-repeats-to").show();
			jq("#repeat-session-wrapper").show();
			jq("#repeat-session-wrapper .rep-sessions .form-type-textfield").show();
			jq("#addSession").show();
		}		
		else if (jq("#edit-session-repeatperiod").val() == "Daily") {
			jq(".form-item-Session-repeatEveryMinute").hide();
			jq(".repeatEveryDay").show();
			jq(".repeatEveryHour").hide();
			jq(".repeatEveryMonth").hide();
			jq(".repeatEveryYear").hide();
			jq(".repeatEveryWeek").hide();
			jq(".form-item-repeat-session-weekly-on").hide();
			jq(".form-item-Session-endRepeatDate").show();
			jq(".form-item-session-repeats-from").show();
			jq(".form-item-session-repeats-to").show();
			jq("#repeat-session-wrapper").hide();
			jq("#addSession").hide();
		}	
		else if (jq("#edit-session-repeatperiod").val() == "Weekly") {
			jq(".form-item-repeat-session-weekly-on").hide();
			jq(".form-item-Session-repeatEveryMinute").hide();
			jq(".repeatEveryDay").hide();
			jq(".repeatEveryHour").hide();
			jq(".repeatEveryMonth").hide();
			jq(".repeatEveryWeek").show();
			jq(".repeatEveryYear").hide();
			/* jq(".form-item-repeat-session-weekly-on").show(); */
			jq(".form-item-Session-endRepeatDate").show();
			jq(".form-item-session-repeats-from").hide();
			jq(".form-item-session-repeats-to").hide();
			jq("#repeat-session-wrapper").hide();
			jq("#addSession").hide();
			jq("#repeat-session-wrapper").show();
			jq("#repeat-session-wrapper .rep-sessions .form-type-textfield").hide();
		}
		else if (jq("#edit-session-repeatperiod").val() == "MONTHLY") {
			jq(".form-item-repeat-session-weekly-on").hide();
			jq(".form-item-Session-repeatEveryMinute").hide();
			jq(".repeatEveryDay").hide();
			jq(".repeatEveryHour").hide();
			jq(".repeatEveryMonth").show();
			jq(".repeatEveryWeek").hide();
			jq(".repeatEveryYear").hide();
			/* jq(".form-item-repeat-session-weekly-on").show(); */
			jq(".form-item-Session-endRepeatDate").show();
			jq(".form-item-session-repeats-from").hide();
			jq(".form-item-session-repeats-to").hide();
			jq("#repeat-session-wrapper").hide();
			jq("#addSession").hide();
		}
		else if (jq("#edit-session-repeatperiod").val() == "YEARLY") {
			jq(".form-item-repeat-session-weekly-on").hide();
			jq(".form-item-Session-repeatEveryMinute").hide();
			jq(".repeatEveryDay").hide();
			jq(".repeatEveryHour").hide();
			jq(".repeatEveryWeek").hide();
			jq(".repeatEveryMonth").hide();
			jq(".repeatEveryYear").show();
			/* jq(".form-item-repeat-session-weekly-on").show(); */
			jq(".form-item-Session-endRepeatDate").show();
			jq(".form-item-session-repeats-from").hide();
			jq(".form-item-session-repeats-to").hide();
			jq("#repeat-session-wrapper").hide();
			jq("#addSession").hide();
		}
		jq("#edit-session-repeatperiod").change(function(){
			var type = jq(this).val();
			switch(type){
				case 'DoNOt':
						jq(".form-item-Session-repeatEveryMinute").hide();
						jq(".repeatEveryDay").hide();
						jq(".repeatEveryHour").hide();
						jq(".repeatEveryMonth").hide();
						jq(".repeatEveryYear").hide();
						jq(".repeatEveryWeek").hide();
						jq(".form-item-repeat-session-weekly-on").hide();
						jq(".form-item-Session-endRepeatDate").hide();
						jq(".form-item-session-repeats-from").hide();
						jq(".form-item-session-repeats-to").hide();
						jq("#addSession").hide();
						jq("#removeSession").hide();
						jq("#repeat-session-wrapper").hide();
						
						break;
				case 'Minute':
						jq(".form-item-Session-repeatEveryMinute").show();
						jq(".repeatEveryDay").hide();
						jq(".repeatEveryHour").hide();
						jq(".repeatEveryMonth").hide();
						jq("#repeat-session-wrapper .rep-sessions .form-type-textfield").show();
						jq(".repeatEveryYear").hide();
						jq(".repeatEveryWeek").hide();
						jq(".form-item-repeat-session-weekly-on").hide();
						jq(".form-item-Session-endRepeatDate").show();
						jq(".form-item-session-repeats-from").show();
						jq(".form-item-session-repeats-to").show();
						jq("#addSession").show();
						jq("#removeSession").show();
						jq("#repeat-session-wrapper").show();
						break;
				case 'Hourly':
						jq(".form-item-Session-repeatEveryMinute").hide();
						jq(".repeatEveryDay").hide();
						jq(".repeatEveryHour").show();
						jq(".repeatEveryMonth").hide();
						jq(".repeatEveryYear").hide();
						jq("#repeat-session-wrapper .rep-sessions .form-type-textfield").show();
						jq(".repeatEveryWeek").hide();
						jq(".form-item-repeat-session-weekly-on").hide();
						jq(".form-item-Session-endRepeatDate").show();
						jq(".form-item-session-repeats-from").show();
						jq(".form-item-session-repeats-to").show();
						jq("#addSession").show();
						jq("#removeSession").show();
						jq("#repeat-session-wrapper").show();
						break;
				case 'Daily':
						jq(".form-item-Session-repeatEveryMinute").hide();
						jq(".repeatEveryDay").show();
						jq(".repeatEveryHour").hide();
						jq(".repeatEveryMonth").hide();
						jq(".repeatEveryYear").hide();
						jq(".repeatEveryWeek").hide();
						jq(".form-item-repeat-session-weekly-on").hide();
						jq(".form-item-Session-endRepeatDate").show();
						jq(".form-item-session-repeats-from").hide();
						jq(".form-item-session-repeats-to").hide();
						jq("#addSession").hide();
						jq("#removeSession").hide();
						jq("#repeat-session-wrapper").hide();
						break;
				case 'Weekly':
						/* jq(".repeat_session1").hide();  */
						jq(".form-item-Session-repeatEveryMinute").hide();
						jq(".repeatEveryDay").hide();
						jq(".repeatEveryHour").hide();
						jq(".repeatEveryMonth").hide();
						jq(".repeatEveryYear").hide();
						/* jq(".form-item-repeat-session-weekly-on").show(); */
						jq(".form-item-Session-endRepeatDate").show();
						jq(".form-item-session-repeats-from").hide();
						jq(".form-item-session-repeats-to").hide();
						jq("#addSession").hide();
						jq("#removeSession").hide();
						jq(".repeatEveryWeek").show();
						jq("#repeat-session-wrapper").show();
						jq("#repeat-session-wrapper .rep-sessions .form-type-textfield").hide();
						break;
				case 'MONTHLY':
						/* jq(".repeat_session1").hide();  */
						jq(".form-item-Session-repeatEveryMinute").hide();
						jq(".repeatEveryDay").hide();
						jq(".repeatEveryHour").hide();
						jq(".repeatEveryMonth").show();
						jq(".repeatEveryYear").hide();
						jq(".repeatEveryWeek").hide();
						/* jq(".form-item-repeat-session-weekly-on").show(); */
						jq(".form-item-Session-endRepeatDate").show();
						jq(".form-item-session-repeats-from").hide();
						jq(".form-item-session-repeats-to").hide();
						jq("#addSession").hide();
						jq("#removeSession").hide();
						jq("#repeat-session-wrapper").hide();
						break;
				case 'YEARLY':
						/* jq(".repeat_session1").hide();  */
						jq(".form-item-Session-repeatEveryMinute").hide();
						jq(".repeatEveryDay").hide();
						jq(".repeatEveryHour").hide();
						jq(".repeatEveryMonth").hide();
						jq(".repeatEveryYear").show();
						jq(".repeatEveryWeek").hide();
						/* jq(".form-item-repeat-session-weekly-on").show(); */
						jq(".form-item-Session-endRepeatDate").show();
						jq(".form-item-session-repeats-from").hide();
						jq(".form-item-session-repeats-to").hide();
						jq("#addSession").hide();
						jq("#removeSession").hide();
						jq("#repeat-session-wrapper").hide();
						break;
				default:
						jq(".form-item-time-available-value").show();
						break;
			}
		});

		if (jq("#edit-all-day-session-all-day").is(":checked")) {
		   jq("#edit-session-start-from-date").val("");
		   jq("#edit-session-start-to-date").val("");
		}
		
		jq("#edit-session-start-from-date").focus(function(){
			jq("#edit-all-day-session-all-day").attr("checked",false);
		
		});
		jq("#edit-session-start-to-date").focus(function(){
			jq("#edit-all-day-session-all-day").attr("checked",false);
		
		});		
		
		jq("#edit-all-day-session-all-day").click(function(){
			if (jq("#edit-all-day-session-all-day").is(":checked")) {
			   jq("#edit-session-start-from-date").val("");
			   jq("#edit-session-start-to-date").val("");			
			}
		
		});



/********************************Added on 29th sept**********************************************/	
		if(jq("#edit-product-durationtype").val() == "Any"){
			jq(".min-max-duration").show();
			jq(".choose-list-duration").hide();
		}
		else{
			jq(".min-max-duration").hide();
			jq(".choose-list-duration").show();
		}
		
		jq("#edit-product-durationtype").change(function(){
			if(jq(this).val() == "Any"){
				jq(".min-max-duration").show();
				jq(".choose-list-duration").hide();
			}
			else{
				jq(".min-max-duration").hide();
				jq(".choose-list-duration").show();
			}		
		});

		var addDiv = jq('#choose-list-duration');
		var i = 50;
		
		jq('#addDuration').on('click', function(e) {
			e.preventDefault();
			if(e.handled !==true)
			{
				e.handled=true;
				jq(this).parent().parent().append('<div id="choose-list-duration' + i +'" class="choose-list-duration choose-list-duration-extra"><div class="form-item form-type-textfield form-item-DurationOption-0-durationLabel"><input type="text" maxlength="128" size="60" value="" name="DurationOption['+i+'][durationLabel]" id="edit-durationoption-0-durationlabel" class="form-control form-text" placeholder="Label"></div><div class="form-item form-type-textfield form-item-DurationOption-0-durationValue"><input type="text" maxlength="128" size="60" value="" name="DurationOption['+i+'][durationValue]" id="edit-durationoption-0-durationvalue" class="form-control form-text" placeholder="Duration"></div><a class="btn btn-dark btn-gradient form-submit" href="#" id="remDuration">Remove</a> </div>');
				i++;
			}
			
			return false;
		});

		jq('#remDuration').live('click', function() {
			jq(this).parent('.choose-list-duration').remove();

			return false;
		});	
	
/******************************************************************************/		


		var changeTooltipPosition = function(event) {
		  var tooltipX = event.pageX - 8;
		  var tooltipY = event.pageY + 8;
		  jq('div.tooltip').css({top: tooltipY, left: tooltipX});
		};
	 
		var showTooltip = function(event) {
		var title = jq(this).attr("rel");
		  jq('div.tooltip').remove();
		  jq('<div class="tooltip">'+title+'</div>')
				.appendTo('body');
		  changeTooltipPosition(event);
		};
	 
		var hideTooltip = function() {
		   jq('div.tooltip').remove();
		};
	 
		jq("strong#hint").bind({
		   mousemove : changeTooltipPosition,
		   mouseenter : showTooltip,
		   mouseleave: hideTooltip
		});
		var addDiv1 = jq('#product_season_rate');
		var j = 500;
		jq('#addRate').on('click', function(e) {
	
			e.preventDefault();
			if(e.handled !==true)
			{
				e.handled=true;
				jq('<div id="product_season_rate[' + j +']" class="product_season_rate quantity"><div class="form-item form-type-textfield form-item-season-rate-label rate-label"><label for="edit-season-rate-label">Rate Label </label><input type="text" maxlength="128" size="60" value="" name="season_rate['+j+'][label]" id="edit-season-rate-label' + j +'" class="form-control form-text" placeholder="Rate Label"></div><div class="form-item form-type-textfield form-item-season-rate-amount rate-price"><label for="edit-season-rate-amount">Rate Price </label><span class="input-group-addon"><i class="fa fa-usd"></i> </span><input type="text" maxlength="128" size="60" value="" name="season_rate['+j+'][price]" id="edit-season-rate-amount' + j +'" class="form-control form-text" placeholder="Rate Price"></div><div class="form-item form-type-textfield form-item-high-season-rate-dates"><label for="edit-high-season-rate-dates ">From - To </label><span class="input-group-addon"><i class="fa fa-calendar"></i> </span><input id="edit-high-season-rate-dates' + j +'" class="form-control form-text rate-from" type="text" maxlength="128" size="60" value="" name="season_rate['+j+'][from-to]" placeholder="From - To"></div><a class="btn btn-dark btn-gradient form-submit" href="#" id="remRate">Remove Rate</a> </div>').appendTo(addDiv1);
				jq('input[name="openning_hours_dates"] , .form-item-high-season-rate-dates input').daterangepicker();
				i++;
			}
			return false;
		});

		jq('#remRate').live('click', function() {
			var removeId=jq(this).parent().find("input[type='hidden']").val();
			if(removeId != "")
			{
				var priceId=document.getElementById("removed-pricing").value;

			if(priceId == "")
			{
				document.getElementById("removed-pricing").value=removeId;
			}
			else
			{
				document.getElementById("removed-pricing").value=removeId+','+priceId;
			}
		}
		jq(this).parent().remove();

			return false;
		});	 

		var addDiv = jq('#product-scheduling');
		var i = 50;
	
		jq('#addSchedule').on('click', function(e) {
			e.preventDefault();
			if(e.handled !==true)
			{
				jq('input[name="openning_hours_dates"] , .form-item-high-season-rate-dates input').daterangepicker();
				e.handled=true;
				jq('<div id="product-scheduling[' + i +']" class="product-scheduling"><div class="form-item form-type-textfield form-item-fixed-time-from" style="display: block;"><label for="edit-fixed-time-from">From </label><span class="input-group-addon"><i class="fa fa-calendar"></i> </span><input type="text" maxlength="128" size="60" value="" name="fixed_time_from_more[' + i +']" id="edit-fixed-time-from[' + i +']" class="form-control datetimepicker form-text" placeholder="From"></div><div class="form-item form-type-textfield form-item-fixed-time-to" style="display: block;"><label for="edit-fixed-time-to">To </label><span class="input-group-addon"><i class="fa fa-calendar"></i> </span><input type="text" maxlength="128" size="60" value="" name="fixed_time_to_more[' + i +']" id="edit-fixed-time-to[' + i +']" class="form-control datetimepicker form-text" placeholder="To"></div><div class="form-item form-type-textfield form-item-season-label" style="display: block;"><label for="edit-season-label">Label </label><input type="text" maxlength="128" size="60" value="" name="season_label_more[' + i +']" id="edit-season-label[' + i +']" class="form-control form-text" placeholder="Label"></div><a class="btn btn-dark btn-gradient form-submit" href="#" id="remSchedule">Remove schedule</a> </div>').appendTo(addDiv);
				jQuery('.datetimepicker').datepicker();
				i++;
			}
			
			return false;
		});

		jq('#remSchedule').live('click', function() {
			jq(this).parent('.product-scheduling').remove();

			return false;
		});	
		
		
/* 		var addSession = jq('#session');
		var i = 1;

		jq('#addSession').on('click', function(e) {
			e.preventDefault();
			if(e.handled !==true)
			{
				e.handled=true;
				jq('<div id="session" class="quantity"><div class="form-item form-type-select form-item-sessions-type"><select name="sessions_type" id="edit-sessions-type" class="form-control form-select"><option value="Single-time">Single time</option><option value="every">Every</option><option value="on-demand">On demand</option></select></div><div class="form-item form-type-textfield form-item-sessions-date"><input type="text" maxlength="128" size="60" value="" name="sessions_date" id="edit-sessions-date" class="form-control datepicker form-text hasDatepicker" placeholder="Date"></div><div class="form-item form-type-select form-item-sessions-days" style="display: none;"><select name="sessions_days" id="edit-sessions-days" class="form-control form-select"><option value="Monday">Monday</option><option value="Tuesday">Tuesday</option><option value="Wednesday">Wednesday</option><option value="Thursday">Thursday</option><option value="Friday">Friday</option><option value="Saturday">Saturday</option><option value="Sunday">Sunday</option></select></div><div class="form-item form-type-textfield form-item-sessions-time-from">  <label for="edit-sessions-time-from">From </label> <input type="text" maxlength="128" size="60" value="" name="sessions_time_from" id="edit-sessions-time-from" class="form-control timepicker form-text" placeholder="From"></div><div class="form-item form-type-textfield form-item-sessions-time-to">  <label for="edit-sessions-time-to">To </label> <input type="text" maxlength="128" size="60" value="" name="sessions_time_to" id="edit-sessions-time-to" class="form-control timepicker form-text" placeholder="To"></div><a class="btn btn-dark btn-gradient form-submit" href="#" id="removeSession">Remove Session</a> </div>').appendTo(addSession);
				i++;
			}
			return false;
		});

		jq('#removeSession').live('click', function() {
			jq(this).parent('#session').remove();

			return false;
		}); */

		var addSession = jq('#repeat-session');
		var i = 50;

		jq('#addSession').on('click', function(e) {
			e.preventDefault();
			if(e.handled !==true)
			{
				e.handled=true;
					jq('<div id="repeat-session[' + i +']" class="repeat-session"><div class="form-item form-type-select form-item-repeat-session-weekly-on" style="display: block;"><label for="edit-repeat-session-weekly-on">On </label><select name="repeat_session_weekly_on_extra[' + i +']" id="edit-repeat-session-weekly-on[' + i +']" class="form-control form-select"><option value="Monday">Monday</option><option value="Tuesday">Tuesday</option><option value="Wednesday">Wednesday</option><option value="Thursday">Thursday</option><option value="Friday">Friday</option><option value="Saturday">Saturday</option><option value="Sunday">Sunday</option></select></div><div class="form-item form-type-textfield form-item-session-repeats-from" style="display: block;"><label for="edit-session-repeats-from">From </label><input type="text" maxlength="128" size="60" value="" name="session_repeats_from_extra[' + i +']" id="edit-session-repeats-from[' + i +']" class="form-control timepicker form-text" placeholder="From"></div><div class="form-item form-type-textfield form-item-session-repeats-to" style="display: block;"><label for="edit-session-repeats-to">To </label><input type="text" maxlength="128" size="60" value="" name="session_repeats_to_extra[' + i +']" id="edit-session-repeats-to[' + i +']" class="form-control timepicker form-text" placeholder="To"></div><a class="btn btn-dark btn-gradient form-submit" href="#" id="removeSession">Remove</a> </div>').appendTo(addSession);
				i++;
			}
			return false;
		});

		jq('#removeSession').live('click', function() {
			jq(this).parent('.repeat-session').remove();

			return false;
		});		

		var addtTime = jq('#time-available');
		var i = 50;

		jq('#addTime').on('click', function(e) {
			e.preventDefault();
			if(e.handled !==true)
			{
				e.handled=true;
				jq('<div id="time-available[' + i +']" class="time-available"><div class="form-item form-type-textfield form-item-time-available-value"><label for="edit-time-available-value">Available time </label><span class="input-group-addon"><i class="fa fa-clock-o"></i> </span><input type="text" maxlength="128" size="60" value="" name="Product[bookingFixedTimes]['+i+']" id="edit-time-available-value' + i +'" class="form-control timepicker form-text"></div><a class="btn btn-dark btn-gradient form-submit" href="#" id="removeTime">Remove</a> </div>').appendTo(addtTime);
				jQuery('.timepicker').timepicker();
				i++;
			}
			return false;
		});

		jq('#removeTime').live('click', function() {
			jq(this).parent('.time-available').remove();

			return false;
		});	


		var addtRentals= jq('#rentals-scheduling');
		var i = 50;

		jq('#addDate').on('click', function(e) {
			e.preventDefault();
			if(e.handled !==true)
			{
				e.handled=true;
				jq('<div class="rentals-scheduling-extra"><div class="rentals-scheduling" id="rentals-scheduling[' + i +']" style="display: block;"><div class="form-item form-type-textfield form-item-rentals-date-from"><label for="edit-rentals-date-from">From </label><span class="input-group-addon"><i class="fa fa-calendar"></i> </span><input type="text" maxlength="128" size="60" value="" name="rentals_date_from[' + i +']" id="edit-rentals-date-from[' + i +']" class="form-control datepicker form-text" placeholder="From"></div><div class="form-item form-type-textfield form-item-rentals-date-to"><label for="edit-rentals-date-to">To </label><span class="input-group-addon"><i class="fa fa-calendar"></i> </span><input type="text" maxlength="128" size="60" value="" name="rentals_date_to[' + i +']" id="edit-rentals-date-to[' + i +']" class="form-control datepicker form-text" placeholder="To"></div><a class="btn btn-dark btn-gradient form-submit" href="#" id="remDate">Remove</a> </div></div>').appendTo(addtRentals);
				jQuery('.datepicker').datepicker();
				i++;
			}
			return false;
		});

		jq('#remDate').live('click', function() {
			jq(this).parent('.rentals-scheduling').remove();

			return false;
		});	

		
		var addtCategory = jq('#restaurant-category-name');
		var i = 50;

		jq('#addCat').on('click', function(e) {
			e.preventDefault();
			if(e.handled !==true)
			{
				e.handled=true;
				jq('<div class="restaurant-category-name" id="restaurant-category-name[' + i +']"><div class="form-item form-type-textfield form-item-category-name"><input type="text" maxlength="128" size="60" value="" name="category_name[' + i +']" id="edit-category-name[' + i +']" class="form-control form-text"></div><a class="btn btn-dark btn-gradient form-submit" href="#" id="remCat">Remove</a></div>').appendTo(addtCategory);
				jQuery('.datepicker').datepicker();
				i++;
			}
			return false;
		});

		jq('#remCat').live('click', function() {
			jq(this).parent('.restaurant-category-name').remove();

			return false;
		});	
		
		/****************************Added on 16th Sept******experience amenities***************************************/
		var addtInc = jq('#amenities-included');
		var i = 50;

		jq('#addInc').on('click', function(e) {
			e.preventDefault();
			if(e.handled !==true)
			{
				e.handled=true;
				jq('<div class="amenities-included" id="amenities-included' + i +'"><div class="form-item form-type-textfield form-item-whats-included"><input type="text" maxlength="35" size="60" value="" name="whats_included[' + i +']" id="edit-whats-included' + i +'" class="form-control form-text" placeholder="Add label"></div><a class="btn btn-dark btn-gradient form-submit" href="#" id="remInc">Remove</a></div>').appendTo(addtInc);
				jQuery('.datepicker').datepicker();
				i++;
			}
			return false;
		});

		jq('#remInc').live('click', function() {
			jq(this).parent('.amenities-included').remove();

			return false;
		});	
		
		var addExc = jq('#amenities-excluded');
		var i = 50;

		jq('#addExc').on('click', function(e) {
			e.preventDefault();
			if(e.handled !==true)
			{
				e.handled=true;
				jq('<div class="amenities-excluded" id="amenities-excluded' + i +'"><div class="form-item form-type-textfield form-item-whats-excluded"><input type="text" maxlength="35" size="60" value="" name="whats_excluded[' + i +']" id="edit-whats-excluded' + i +'" class="form-control form-text" placeholder="Add label"></div><a class="btn btn-dark btn-gradient form-submit" href="#" id="remExc">Remove</a></div>').appendTo(addExc);
				jQuery('.datepicker').datepicker();
				i++;
			}
			return false;
		});

		jq('#remExc').live('click', function() {
			jq(this).parent('.amenities-excluded').remove();

			return false;
		});	
		
		/*************************************************************************/
		var addtPricing = jq('.product_pricing');
		delete i;  
		j = 50;
		
		jq('.addPricing').on('click', function(e) {
			i = j;
			e.preventDefault();
			if(e.handled !==true)
			{
				var price_type = jq("#edit-product-pricing-type").val();
				if(price_type == "PER_PERSON"){
					jq('.pricetype_options_'+price_type).parent().append('<div class="product_pricing pricetype_options_PER_PERSON product_pricing_extra" style="display: block;" id="product_pricing_extra'+i+'"><div class="form-item form-type-select form-item-PriceOption-0-priceOptionType" id="yui_3_17_2_1_1411463950273_47"><select name="PriceOption[PER_PERSON]['+i+'][price_option_type]" id="edit-priceoption-0-priceoptiontype" class="form-control form-select price-option-type"><option value="everyone">Everyone</option><option value="adult">Adult</option><option value="child">Child</option><option value="senior">Senior</option><option value="teenager">Teenager</option><option value="student">Student</option><option value="family-of-three">Family of 3</option><option value="family-of-four">Family of 4</option><option value="family-of-five">Family of 5</option><option value="group">Group</option></select></div><div class="form-item form-type-textfield form-item-PriceOption-0-max max-partners"><input type="text" maxlength="128" size="60" value="" name="PriceOption[PER_PERSON]['+i+'][max]" id="edit-priceoption-0-max" class="form-control form-text price-max" placeholder="max"></div><div class="form-item form-type-textfield form-item-PriceOption-0-price"><span class="input-group-addon"><i class="fa fa-usd"></i> </span><input type="text" maxlength="128" size="60" value="" name="PriceOption[PER_PERSON]['+i+'][price]" id="edit-priceoption-0-price" class="form-control themePrice form-text" placeholder="Price"></div><div class="form-item form-type-select form-item-PriceOption-0-priceGroupType pricing-group-type"><select name="PriceOption[PER_PERSON]['+i+'][priceGroupType]" id="edit-priceoption-0-pricegrouptype" class="form-control form-select"><option value="per-person">Per person</option><option value="TOTAL">Total</option></select></div><a href="javascript:void(0)" class="btn btn-dark btn-gradient form-submit removePricing">Remove</a></div> ');
					if(jq("#edit-priceoption-per-person-1-price-option-type").val() == "group"){
						jq("#product_pricing_extra"+i+" .max-partners").show();
						jq("#product_pricing_extra"+i+" .pricing-group-type").show();	
						jq("#product_pricing_extra"+i+" .price-option-type").val("group").attr("selected","selected");
					}
					else if(jq("#edit-priceoption-per-person-1-price-option-type").val() == "family-of-five" || jq("#edit-priceoption-per-person-1-price-option-type").val() == "family-of-three" || jq("#edit-priceoption-per-person-1-price-option-type").val() == "family-of-four"){
						var selVal = jq("#edit-priceoption-per-person-1-price-option-type").val();
						jq("#product_pricing_extra"+i+" .max-partners").hide();
						jq("#product_pricing_extra"+i+" .pricing-group-type").show();
						jq("#product_pricing_extra"+i+" .price-option-type").val(selVal).attr("selected","selected");
					}
					else{
						var selVal = jq("#edit-priceoption-per-person-1-price-option-type").val();
						jq("#product_pricing_extra"+i+" .max-partners").hide();
						jq("#product_pricing_extra"+i+" .pricing-group-type").hide();	
						jq("#product_pricing_extra"+i+" .price-option-type").val(selVal).attr("selected","selected");
					}
				}
				else if(price_type == "PER_ITEM"){
					jq('.pricetype_options_'+price_type).parent().append('<div class="product_pricing pricetype_options_PER_ITEM product_pricing_extra" style="display: block;"><div class="form-item form-type-textfield form-item-PriceOption-1-label"><input type="text" maxlength="128" size="60" value="" name="PriceOption[PER_ITEM]['+i+'][label]" id="edit-priceoption-1-label" class="form-control form-text price-label" placeholder="Label"></div><div class="form-item form-type-textfield form-item-PriceOption-1-price"><span class="input-group-addon"><i class="fa fa-usd"></i> </span><input type="text" maxlength="128" size="60" value="" name="PriceOption[PER_ITEM]['+i+'][price]" id="edit-priceoption-1-price" class="form-control themePrice form-text" placeholder="Price"></div><a href="javascript:void(0)" class="btn btn-dark btn-gradient form-submit removePricing">Remove</a></div> ');
				}
				else if(price_type == "FIXED"){
					jq('.pricetype_options_'+price_type).parent().append('<div class="product_pricing pricetype_options_FIXED product_pricing_extra" style="display: block;"><div class="form-item form-type-textfield form-item-PriceOption-2-price"><span class="input-group-addon"><i class="fa fa-usd"></i> </span><input type="text" maxlength="128" size="60" value="" name="PriceOption[FIXED]['+i+'][price]" id="edit-priceoption-2-price" class="form-control themePrice form-text" placeholder="Price"></div><a href="javascript:void(0)" class="btn btn-dark btn-gradient form-submit removePricing">Remove</a></div>');
				}
				else if(price_type == "PER_DAY"){
					var nextMin = "";
					jq(this).parent().parent().parent().find('.day-max').each(function( index ) {
						nextMin = jq(this).val();
					});
					jq('.pricetype_options_'+price_type).parent().append('<div class="product_pricing pricetype_options_PER_DAY product_pricing_extra" style="display: block;"><div class="form-item form-type-textfield form-item-PriceOption-3-min"><input type="text" maxlength="128" size="60" value="'+(parseInt(nextMin)+1)+'" name="PriceOption[PER_DAY]['+i+'][min]" id="edit-priceoption-3-min" class="form-control form-text day-min price-min" placeholder="min"></div><div class="form-item form-type-textfield form-item-PriceOption-3-max"><input type="text" maxlength="128" size="60" value="" name="PriceOption[PER_DAY]['+i+'][max]" id="edit-priceoption-3-max" class="form-control form-text day-max price-max" placeholder="max"></div><div class="form-item form-type-textfield form-item-PriceOption-3-price"><span class="input-group-addon"><i class="fa fa-usd"></i> </span><input type="text" maxlength="128" size="60" value="" name="PriceOption[PER_DAY]['+i+'][price]" id="edit-priceoption-3-price" class="form-control themePrice form-text" placeholder="Price"></div><div class="form-item form-type-select form-item-PriceOption-3-priceGroupType"><select name="PriceOption[PER_DAY]['+i+'][priceGroupType]" id="edit-priceoption-3-pricegrouptype" class="form-control form-select"><option value="EACH">Per day</option><option value="TOTAL">Total</option></select></div> <a href="javascript:void(0)" class="btn btn-dark btn-gradient form-submit removePricing">Remove</a></div>');
				}
				else if(price_type == "PER_HOUR"){
					var nextMin = "";
					jq(this).parent().parent().parent().find('.hour-max').each(function( index ) {
						nextMin = jq(this).val();
					});
					jq('.pricetype_options_'+price_type).parent().append('<div class="product_pricing pricetype_options_PER_HOUR product_pricing_extra" style="display: block;"><div class="form-item form-type-textfield form-item-PriceOption-3-min"><input type="text" maxlength="128" size="60" value="'+(parseInt(nextMin)+1)+'" name="PriceOption[PER_HOUR]['+i+'][min]" id="edit-priceoption-3-min" class="form-control form-text hour-min price-min" placeholder="min"></div><div class="form-item form-type-textfield form-item-PriceOption-3-max"><input type="text" maxlength="128" size="60" value="" name="PriceOption[PER_HOUR]['+i+'][max]" id="edit-priceoption-3-max" class="form-control form-text hour-max price-max" placeholder="max"></div><div class="form-item form-type-textfield form-item-PriceOption-3-price"><span class="input-group-addon"><i class="fa fa-usd"></i> </span><input type="text" maxlength="128" size="60" value="" name="PriceOption[PER_HOUR]['+i+'][price]" id="edit-priceoption-3-price" class="form-control themePrice form-text" placeholder="Price"></div><div class="form-item form-type-select form-item-PriceOption-3-priceGroupType"><select name="PriceOption[PER_HOUR]['+i+'][priceGroupType]" id="edit-priceoption-3-pricegrouptype" class="form-control form-select"><option value="EACH">Per hour</option><option value="TOTAL">Total</option></select></div> <a href="javascript:void(0)" class="btn btn-dark btn-gradient form-submit removePricing">Remove</a></div>');
				}
				else if(price_type == "PER_MINUTE"){
					var nextMin = "";
					jq(this).parent().parent().parent().find('.minute-max').each(function( index ) {
						nextMin = jq(this).val();
					});
					jq('.pricetype_options_'+price_type).parent().append('<div class="product_pricing pricetype_options_PER_MINUTE product_pricing_extra" style="display: block;"><div class="form-item form-type-textfield form-item-PriceOption-3-min"><input type="text" maxlength="128" size="60" value="'+(parseInt(nextMin)+1)+'" name="PriceOption[PER_MINUTE]['+i+'][min]" id="edit-priceoption-3-min" class="form-control form-text minute-min price-min" placeholder="min"></div><div class="form-item form-type-textfield form-item-PriceOption-3-max"><input type="text" maxlength="128" size="60" value="" name="PriceOption[PER_MINUTE]['+i+'][max]" id="edit-priceoption-3-max" class="form-control form-text minute-max price-max" placeholder="max"></div><div class="form-item form-type-textfield form-item-PriceOption-3-price"><span class="input-group-addon"><i class="fa fa-usd"></i> </span><input type="text" maxlength="128" size="60" value="" name="PriceOption[PER_MINUTE]['+i+'][price]" id="edit-priceoption-3-price" class="form-control themePrice form-text" placeholder="Price"></div><div class="form-item form-type-select form-item-PriceOption-3-priceGroupType"><select name="PriceOption[PER_MINUTE]['+i+'][priceGroupType]" id="edit-priceoption-3-pricegrouptype" class="form-control form-select"><option value="EACH">Per minute</option><option value="TOTAL">Total</option></select></div> <a href="javascript:void(0)" class="btn btn-dark btn-gradient form-submit removePricing">Remove</a></div>');
				}

/* 				if(jq(".pricetype_options_PER_PERSON .price-option-type").val() == "group"){
					jq(".pricetype_options_PER_PERSON .price-option-type").parent().parent().find('.max-partners').show();
					jq(".pricetype_options_PER_PERSON .price-option-type").parent().parent().find('.pricing-group-type').show();
				}
				else if(jq(".pricetype_options_PER_PERSON .price-option-type").val() == "family-of-four" || jq(this).val() == "family-of-three" || jq(this).val() == "family-of-five"){
					jq(".pricetype_options_PER_PERSON .price-option-type").parent().parent().find('.max-partners').hide();
					jq(".pricetype_options_PER_PERSON .price-option-type").parent().parent().find('.pricing-group-type').show();				
				}
				else{
					jq(".pricetype_options_PER_PERSON .price-option-type").parent().parent().find('.max-partners').hide();
					jq(".pricetype_options_PER_PERSON .price-option-type").parent().parent().find('.pricing-group-type').hide();				
				}	 */
				jq(".pricetype_options_PER_PERSON .price-option-type").change(function(){
					if(jq(this).val() == "group"){
						jq(this).parent().parent().find('.max-partners').show();
						jq(this).parent().parent().find('.pricing-group-type').show();
					}
					else if(jq(this).val() == "family-of-four" || jq(this).val() == "family-of-three" || jq(this).val() == "family-of-five"){
						jq(this).parent().parent().find('.max-partners').hide();
						jq(this).parent().parent().find('.pricing-group-type').show();				
					}
					else{
						jq(this).parent().parent().find('.max-partners').hide();
						jq(this).parent().parent().find('.pricing-group-type').hide();				
					}
				});		
				j++;
			}
			return false;
		});

		jq('.removePricing').live('click', function() {
			jq(this).parent('.product_pricing').remove();
		});	
		
		
		jq(".datepicker").before('<span class="input-group-addon"><i class="fa fa-calendar"></i> </span>');
		//jq("#edit-high-season-rate-dates").before('<span class="input-group-addon"><i class="fa fa-calendar"></i> </span>');
		jq(".daterangepicker2").before('<span class="input-group-addon"><i class="fa fa-calendar"></i> </span>');
		jq(".datetimepicker").before('<span class="input-group-addon"><i class="fa fa-calendar"></i> </span>');
		jq(".timepicker").before('<span class="input-group-addon"><i class="fa fa-clock-o"></i> </span>');
		jq(".themePrice").before('<span class="input-group-addon"><i class="fa fa-usd"></i> </span>');
		
		jq("#sidebar-menu ul li ul").addClass("menu-open");
		jq("#sidebar-menu ul li ul").show();
		/*****************************24 hour offer experience listing********************************************/  
  var addperiodEXP=jq('#early-birds-hour-offer')
  var i=1;
  var nowTemp = new Date();
  var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
  jq('#addPeriodEXP').on('click', function(e) {
			e.preventDefault();
			if(e.handled !==true)
			{
				e.handled=true;
				jq('<div id="early-birds-hour-offer" class="early-birds-hour-offer add-extra-pricing"><div class="form-item form-type-textfield form-item-24-hour-offer-date-extra"><span class="input-group-addon"><i class="fa fa-calendar"></i> </span><input type="text" maxlength="128" size="60" value="" name="24_hour_offer_date_extra[]" id="edit-24-hour-offer-date'+i+'" class="form-control datepicker form-text valid" placeholder="Date"></div><div class="form-item form-type-textfield form-item-24-hour-offer-price-value-extra"><input type="text" maxlength="128" size="60" value="" name="24_hour_offer_price_value_extra[]" id="edit-24-hour-offer-price-value'+i+'" class="form-control form-text valid" placeholder="Price"></div><div class="form-item form-type-select form-item-24-hour-offer-price-type-extra"><select name="24_hour_offer_price_type" id="edit-24-hour-offer-price-type" class="form-control form-select"><option selected="selected" value="%">Amount in %</option></select></div><h4>on total Amount</h4><div><a id="remPeriodEXP" href="#" class="btn btn-dark btn-gradient form-submit">Remove</a></div></div>').appendTo(addperiodEXP);
			jq('.datepicker').datepicker({ onRender: function(date) {
    return date.valueOf() < now.valueOf() ? 'disabled' : '';
  }
  });
				i++;
			}
			return false;
		});
		jq('#remPeriodEXP').live('click', function() {
	
		jq(this).parent().parent('.early-birds-hour-offer').remove();
		

			return false;
		});
		jq('#remPeriodEXP-extra').live('click', function() {
	
		jq(this).parent().parent('.early-birds-hour-offer').remove();
		

			return false;
		});	
  
 	/*********************************************************************************/	
	   	   /************************************Product Cancellation Policy**********************************************/
	   jq("#product-rules-form .custom-policy").hide();
	   jq("#edit-cancellation-policies-type").change(function(){
	   if(jq(this).val() == "Custom"){
	            jq("#product-rules-form .custom-policy").show();   
				jq("#product-rules-form .cancelation-policy-entire-stay").show();
				jq("#product-rules-form .cancelation-policy-pending-stay").show();
		   }
		   else
		   {
		   jq("#product-rules-form .custom-policy").hide();
		   }
	   });
	   if(jq("#edit-cancellation-policies-type").val()=="Custom")
	   {
	    jq("#product-rules-form .custom-policy").show();
	   }
	  /************************************************************************************************/ 
		/********************************Products seasonal Price*****************************************************/
		//jq(".product_season_rate").hide();
		 jq(".product_season_rate").find("*").prop("disabled", true);
		jq(".product_season_rate").find("a").attr('disabled','disabled'); 
		if(jq("#seosonal-pricing").is(':checked'))
		{
		jq(".product_season_rate").show();
		jq(".product_season_rate").find("*").prop("disabled", false);
		jq(".product_season_rate").find("a").removeAttr("disabled");
		}
		else
		{
		jq(".product_season_rate").hide();
		jq(".product_season_rate").find("*").prop("disabled", true);
		jq(".product_season_rate").find("a").attr('disabled','disabled');
		}
		jq("#seosonal-pricing").click(function(){
		if(jq("#seosonal-pricing").is(':checked'))
		{
				jq(".product_season_rate").show();
		jq(".product_season_rate").find("*").prop("disabled", false);
		jq(".product_season_rate").find("a").removeAttr("disabled");
		}
		else
		{
		jq(".product_season_rate").hide();
		jq(".product_season_rate").find("*").prop("disabled", true);
		jq(".product_season_rate").find("a").attr('disabled','disabled');
		}
		});
		/***********************************hotels-pricing-form*******************************************************************/	
      jq(".form-item-early-bird-room-label").hide();     
      jq(".form-item-last-minutes-room-label").hide();     
	 jq("#edit-min-length").blur(function(){
      var lengthValue=jq(this).val();
	  jq("#edit-early-birds-min-days").val(lengthValue);
	  jq("#edit-last-minutes-min-days").val(lengthValue);
      });
      jq('#edit-room-type-early-bids').change(function(){
	  if(jq(this).val()=="specific-room")
	  {
	  jq(".form-item-early-bird-room-label").show();  
	  }
	  else
	  {
	  jq(".form-item-early-bird-room-label").hide();
	  }
	  
      });	
      jq('#edit-room-type-last-minutes').change(function(){
	  if(jq(this).val()=="specific-room")
	  {
	  jq(".form-item-last-minutes-room-label").show();  
	  }
	  else
	  {
	  jq(".form-item-last-minutes-room-label").hide();
	  }
      });
       if(jq("#edit-room-type-early-bids").val()=='specific-room')
	  {
	  jq(".form-item-early-bird-room-label").show();
	  }
	  else
	  {
	   jq(".form-item-early-bird-room-label").hide();
	  }
	  if(jq("#edit-room-type-last-minutes").val()=='specific-room')
	  {
	    jq(".form-item-last-minutes-room-label").show();  
	  } 
	  else
	  {
	   jq(".form-item-last-minutes-room-label").hide();
	  }
	  if(jq(".form-item-room-type-last-minutes select").val()=='specific-room')
	  {
	  jq(".form-item-hour-24-room-label").show();
	  }
	  else
	  {
	    jq(".form-item-hour-24-room-label").hide();
	  }
	      jq('.form-item-room-type-24-hour .form-select').live('change',function(){
		 
		  if(jq(this).val()=='specific-room')
	      {
	      jq(".form-item-hour-24-room-label").show();
	      }
		  else
		  {
		  jq(".form-item-hour-24-room-label").hide();
		  }
		  });
	});
	
	function pricingValidation(){
		var finalError = 0;
		var max = "";
		var min = "";
		if(jq("#edit-product-pricing-type").val() == "PER_DAY"){
			jq(".product_pricing_wrapper").find('.day-max').each(function( index ) {
				finalError = childPricingValidation(this,"day");
			});
		}
		else if(jq("#edit-product-pricing-type").val() == "PER_HOUR"){
			jq(".product_pricing_wrapper").find('.hour-max').each(function( index ) {
				finalError = childPricingValidation(this,"hour");
			});
		}
		else if(jq("#edit-product-pricing-type").val() == "PER_MINUTE"){
			jq(".product_pricing_wrapper").find('.minute-max').each(function( index ) {
				finalError = childPricingValidation(this,"minute");
			});
		}
/* 		alert(finalError);
		return false; */
		if(finalError>0){
			return false;
		}
		else{
			return true;
		}
	}
	
	function childPricingValidation(obj='',type=''){
		var err = 0;
		max = jq(obj).val();
		min = jq(obj).parent().parent().find('.'+type+'-min').val();
		if(parseInt(min)>parseInt(max)){
			jq(obj).css("border","solid 1px red");
			jq(obj).parent().append("<span class='pricing-error' style='color:red;'>Max value can't be less than min value</span>");
			err++;
		}
		else{
			jq(obj).css("border","1px solid #ccc");
			jq(".pricing-error").remove();
		}
		return err;
	}