var jq=jQuery.noConflict();
jq(document).ready(function(){
	   jq(".form-item-product-pricing-max-participants").hide();
	   jq(".form-item-product-pricing-person-type").hide();
	   if(jq("#edit-product-pricing-type").val() == "PER_PERSON"){
			jq(".form-item-product-item-label").hide();
			jq(".form-item-product-pricing-min").hide();
			jq(".form-item-product-pricing-max").hide();
			jq(".form-item-product-pricing-day-type").hide();
			jq(".form-item-product-pricing-minute-type").hide();
			jq(".form-item-product-pricing-hour-type").hide();
			jq(".form-item-product-pricing-key").show();
			jq(".form-item-product-pricing-value").show();
			jq(".form-item-product-pricing-person-type").hide();
			jq(".form-item-product-pricing-max-participants").hide();	
	   }
	   if(jq("#edit-product-pricing-type").val() == "PER_ITEM"){
			jq(".form-item-product-item-label").show();
			jq(".form-item-product-pricing-min").hide();
			jq(".form-item-product-pricing-max").hide();
			jq(".form-item-product-pricing-day-type").hide();
			jq(".form-item-product-pricing-minute-type").hide();
			jq(".form-item-product-pricing-hour-type").hide();
			jq(".form-item-product-pricing-key").hide();
			jq(".form-item-product-pricing-value").show();
			jq(".form-item-product-pricing-person-type").hide();
			jq(".form-item-product-pricing-max-participants").hide();	
	   }
	   if(jq("#edit-product-pricing-type").val() == "FIXED"){
			jq(".form-item-product-item-label").hide();
			jq(".form-item-product-pricing-min").hide();
			jq(".form-item-product-pricing-max").hide();
			jq(".form-item-product-pricing-day-type").hide();
			jq(".form-item-product-pricing-minute-type").hide();
			jq(".form-item-product-pricing-hour-type").hide();
			jq(".form-item-product-pricing-key").hide();
			jq(".form-item-product-pricing-value").show();
			jq(".form-item-product-pricing-person-type").hide();
			jq(".form-item-product-pricing-max-participants").hide();	
	   }
	   if(jq("#edit-product-pricing-type").val() == "PER_DAY"){
			jq(".form-item-product-item-label").hide();
			jq(".form-item-product-pricing-min").show();
			jq(".form-item-product-pricing-max").show();
			jq(".form-item-product-pricing-day-type").show();
			jq(".form-item-product-pricing-minute-type").hide();
			jq(".form-item-product-pricing-hour-type").hide();
			jq(".form-item-product-pricing-key").hide();
			jq(".form-item-product-pricing-value").show();
			jq(".form-item-product-pricing-person-type").hide();
			jq(".form-item-product-pricing-max-participants").hide();	
	   }
	   if(jq("#edit-product-pricing-type").val() == "PER_HOUR"){
			jq(".form-item-product-item-label").hide();
			jq(".form-item-product-pricing-min").show();
			jq(".form-item-product-pricing-max").show();
			jq(".form-item-product-pricing-day-type").hide();
			jq(".form-item-product-pricing-minute-type").hide();
			jq(".form-item-product-pricing-hour-type").show();
			jq(".form-item-product-pricing-key").hide();
			jq(".form-item-product-pricing-value").show();
			jq(".form-item-product-pricing-person-type").hide();
			jq(".form-item-product-pricing-max-participants").hide();	
	   }
	  if(jq("#edit-product-pricing-type").val() == "PER_MINUTE"){
			jq(".form-item-product-item-label").hide();
			jq(".form-item-product-pricing-min").show();
			jq(".form-item-product-pricing-max").show();
			jq(".form-item-product-pricing-day-type").hide();
			jq(".form-item-product-pricing-minute-type").show();
			jq(".form-item-product-pricing-hour-type").hide();
			jq(".form-item-product-pricing-key").hide();
			jq(".form-item-product-pricing-value").show();
			jq(".form-item-product-pricing-person-type").hide();
			jq(".form-item-product-pricing-max-participants").hide();	
	   }
	   if(jq("#edit-product-pricing-key").val() == "family-of-three" || jq("#edit-product-pricing-key").val() == "family-of-four" || jq("#edit-product-pricing-key").val() == "family-of-five"){
				jq(".form-item-product-pricing-person-type").show();
				jq(".form-item-product-pricing-max-participants").hide();
	   }
	   if(jq("#edit-product-pricing-key").val() == "group"){
				jq(".form-item-product-pricing-person-type").show();
				jq(".form-item-product-pricing-max-participants").show();
	   }	   
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
	   
	   jq("#product-rules-form .relaxed").hide();
	   jq("#product-rules-form .flexible").hide();
	   jq("#product-rules-form .moderate").hide();
	   jq("#product-rules-form .strict").hide();
	   jq("#product-rules-form .super_strict").hide();
	   jq("#product-rules-form .cancelation-policy-entire-stay").hide();
	   jq("#product-rules-form .cancelation-policy-pending-stay").hide();
	   
	   if(jq("#edit-cancellation-policies-type").val() == "Relaxed"){
			jq("#product-rules-form .relaxed").show();

	   }
	   else if(jq("#edit-cancellation-policies-type").val() == "Flexible"){
			jq("#product-rules-form .flexible").show();
	   }
	   else if(jq("#edit-cancellation-policies-type").val() == "Moderate"){
			jq("#product-rules-form .moderate").show();
	   }
	   else if(jq("#edit-cancellation-policies-type").val() == "Strict"){
			jq("#product-rules-form .strict").show();
	   }
	   else if(jq("#edit-cancellation-policies-type").val() == "Super-Strict"){
			jq("#product-rules-form .super_strict").show();
	   }
	   else if(jq("#edit-cancellation-policies-type").val() == "Custom"){
		   jq("#product-rules-form .cancelation-policy-entire-stay").show();
		   jq("#product-rules-form .cancelation-policy-pending-stay").show();
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
				jq("#product-rules-form .relaxed").show();
				jq("#product-rules-form .flexible").hide();
				jq("#product-rules-form .moderate").hide();
				jq("#product-rules-form .strict").hide();
				jq("#product-rules-form .super_strict").hide();
				jq("#product-rules-form .cancelation-policy-entire-stay").hide();
				jq("#product-rules-form .cancelation-policy-pending-stay").hide();
		   }
		   else if(jq(this).val() == "Flexible"){
				jq("#product-rules-form .relaxed").hide();
				jq("#product-rules-form .flexible").show();
				jq("#product-rules-form .moderate").hide();
				jq("#product-rules-form .strict").hide();
				jq("#product-rules-form .super_strict").hide();
				jq("#product-rules-form .cancelation-policy-entire-stay").hide();
				jq("#product-rules-form .cancelation-policy-pending-stay").hide();
		   }
		   else if(jq(this).val() == "Moderate"){
				jq("#product-rules-form .relaxed").hide();
				jq("#product-rules-form .flexible").hide();
				jq("#product-rules-form .moderate").show();
				jq("#product-rules-form .strict").hide();
				jq("#product-rules-form .super_strict").hide();
				jq("#product-rules-form .cancelation-policy-entire-stay").hide();
				jq("#product-rules-form .cancelation-policy-pending-stay").hide();
		   }
		   else if(jq(this).val() == "Strict"){
				jq("#product-rules-form .relaxed").hide();
				jq("#product-rules-form .flexible").hide();
				jq("#product-rules-form .moderate").hide();
				jq("#product-rules-form .strict").show();
				jq("#product-rules-form .super_strict").hide();
				jq("#product-rules-form .cancelation-policy-entire-stay").hide();
				jq("#product-rules-form .cancelation-policy-pending-stay").hide();
		   }
		   else if(jq(this).val() == "Super-Strict"){
				jq("#product-rules-form .relaxed").hide();
				jq("#product-rules-form .flexible").hide();
				jq("#product-rules-form .moderate").hide();
				jq("#product-rules-form .strict").hide();
				jq("#product-rules-form .super_strict").show();
				jq("#product-rules-form .cancelation-policy-entire-stay").hide();
				jq("#product-rules-form .cancelation-policy-pending-stay").hide();
		   }
		   else if(jq(this).val() == "Custom"){
				jq("#product-rules-form .relaxed").hide();
				jq("#product-rules-form .flexible").hide();
				jq("#product-rules-form .moderate").hide();
				jq("#product-rules-form .strict").hide();
				jq("#product-rules-form .super_strict").hide();
				jq("#product-rules-form .cancelation-policy-entire-stay").show();
				jq("#product-rules-form .cancelation-policy-pending-stay").show();
		   }
	   });
	   
	   
	   jq("#edit-product-pricing-key").change(function(){
			if(jq(this).val() == "family-of-three" || jq(this).val() == "family-of-four" || jq(this).val() == "family-of-five"){
				jq(".form-item-product-pricing-person-type").show();
				jq(".form-item-product-pricing-max-participants").hide();
			}
			else if(jq(this).val() == "group"){
				jq(".form-item-product-pricing-person-type").show();
				jq(".form-item-product-pricing-max-participants").show();
			}
			else{
				jq(".form-item-product-pricing-person-type").hide();
				jq(".form-item-product-pricing-max-participants").hide();				
			}
	   });

		jq("#edit-product-pricing-type").change(function(){
		   if(jq("#edit-product-pricing-type").val() == "PER_PERSON"){
				jq(".form-item-product-item-label").hide();
				jq(".form-item-product-pricing-min").hide();
				jq(".form-item-product-pricing-max").hide();
				jq(".form-item-product-pricing-day-type").hide();
				jq(".form-item-product-pricing-minute-type").hide();
				jq(".form-item-product-pricing-hour-type").hide();
				jq(".form-item-product-pricing-key").show();
				jq(".form-item-product-pricing-value").show();
				if(jq("#edit-product-pricing-key").val() == "group"){
					jq(".form-item-product-pricing-person-type").show();
					jq(".form-item-product-pricing-max-participants").show();					
				}
			   if(jq("#edit-product-pricing-key").val() == "family-of-three" || jq("#edit-product-pricing-key").val() == "family-of-four" || jq("#edit-product-pricing-key").val() == "family-of-five"){
						jq(".form-item-product-pricing-person-type").show();
						jq(".form-item-product-pricing-max-participants").hide();
			   }
		   }
		   else if(jq("#edit-product-pricing-type").val() == "PER_ITEM"){
				jq(".form-item-product-item-label").show();
				jq(".form-item-product-pricing-min").hide();
				jq(".form-item-product-pricing-max").hide();
				jq(".form-item-product-pricing-day-type").hide();
				jq(".form-item-product-pricing-minute-type").hide();
				jq(".form-item-product-pricing-hour-type").hide();
				jq(".form-item-product-pricing-key").hide();
				jq(".form-item-product-pricing-value").show();
				jq(".form-item-product-pricing-person-type").hide();
				jq(".form-item-product-pricing-max-participants").hide();	
		   }
		   else if(jq("#edit-product-pricing-type").val() == "FIXED"){
				jq(".form-item-product-item-label").hide();
				jq(".form-item-product-pricing-min").hide();
				jq(".form-item-product-pricing-max").hide();
				jq(".form-item-product-pricing-day-type").hide();
				jq(".form-item-product-pricing-minute-type").hide();
				jq(".form-item-product-pricing-hour-type").hide();
				jq(".form-item-product-pricing-key").hide();
				jq(".form-item-product-pricing-value").show();
				jq(".form-item-product-pricing-person-type").hide();
				jq(".form-item-product-pricing-max-participants").hide();	
		   }
		   else if(jq("#edit-product-pricing-type").val() == "PER_DAY"){
				jq(".form-item-product-item-label").hide();
				jq(".form-item-product-pricing-min").show();
				jq(".form-item-product-pricing-max").show();
				jq(".form-item-product-pricing-day-type").show();
				jq(".form-item-product-pricing-minute-type").hide();
				jq(".form-item-product-pricing-hour-type").hide();
				jq(".form-item-product-pricing-key").hide();
				jq(".form-item-product-pricing-value").show();
				jq(".form-item-product-pricing-person-type").hide();
				jq(".form-item-product-pricing-max-participants").hide();	
		   }
		   else if(jq("#edit-product-pricing-type").val() == "PER_HOUR"){
				jq(".form-item-product-item-label").hide();
				jq(".form-item-product-pricing-min").show();
				jq(".form-item-product-pricing-max").show();
				jq(".form-item-product-pricing-day-type").hide();
				jq(".form-item-product-pricing-minute-type").hide();
				jq(".form-item-product-pricing-hour-type").show();
				jq(".form-item-product-pricing-key").hide();
				jq(".form-item-product-pricing-value").show();
				jq(".form-item-product-pricing-person-type").hide();
				jq(".form-item-product-pricing-max-participants").hide();	
		   }
		   else if(jq("#edit-product-pricing-type").val() == "PER_MINUTE"){
				jq(".form-item-product-item-label").hide();
				jq(".form-item-product-pricing-min").show();
				jq(".form-item-product-pricing-max").show();
				jq(".form-item-product-pricing-day-type").hide();
				jq(".form-item-product-pricing-minute-type").show();
				jq(".form-item-product-pricing-hour-type").hide();
				jq(".form-item-product-pricing-key").hide();
				jq(".form-item-product-pricing-value").show();
				jq(".form-item-product-pricing-person-type").hide();
				jq(".form-item-product-pricing-max-participants").hide();	
		   }		
		})	
		
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
		jq(".form-item-fixed-time-from").hide();
		jq(".form-item-fixed-time-to").hide();
		if (jq("#edit-dates-available").val() == "NO_DATE") {
						jq(".form-item-fixed-date").hide();
						jq(".form-item-fixed-time-from").hide();
						jq(".form-item-time-available-type").hide();
						jq(".form-item-fixed-time-to").hide();
						jq(".time-available").hide();
		}	
		else if (jq("#edit-dates-available").val() == "INVENTORY") {
						jq(".form-item-fixed-date").show();
						jq(".form-item-fixed-time-from").show();
						jq(".form-item-fixed-time-to").show();
						jq(".form-item-time-available-type").hide();
						jq(".time-available").hide();
		}	
		else if (jq("#edit-dates-available").val() == "DATE_ENQUIRY") {
						jq(".time-available").show();
						jq(".form-item-time-available-value").show();
						jq(".form-item-fixed-date").hide();
						jq(".form-item-fixed-time-from").hide();
						jq(".form-item-time-available-type").show();
						jq(".form-item-fixed-time-to").hide();
		}		
		jq("#edit-dates-available").change(function(){
			var type = jq(this).val();
			switch(type){
				case 'NO_DATE':
						jq(".form-item-fixed-date").hide();
						jq(".form-item-fixed-time-from").hide();
						jq(".form-item-time-available-type").hide();
						jq(".form-item-fixed-time-to").hide();
						jq(".time-available").hide();
						break;
				case 'INVENTORY':
						jq(".form-item-fixed-date").show();
						jq(".form-item-fixed-time-from").show();
						jq(".form-item-fixed-time-to").show();
						jq(".form-item-time-available-type").hide();
						jq(".time-available").hide();
						if (jq("#edit-availability-type").val() == "SESSION_SEATS") {
						   jq(".form-item-availability-value").show();
						   jq(".manage-resources").hide();
						}
						else if(jq("#edit-availability-type").val() == "RESOURCES"){
						   jq(".form-item-availability-value").hide();
						   jq(".manage-resources").show();							
						}
						else if(jq("#edit-availability-type").val() == "FREE_SALE"){
						   jq(".form-item-availability-value").hide();
						   jq(".manage-resources").hide();							
						}
						break;
				case 'DATE_ENQUIRY':
						jq(".time-available").show();
						jq(".form-item-time-available-value").show();
						jq(".form-item-fixed-date").hide();
						jq(".form-item-fixed-time-from").hide();
						jq(".form-item-time-available-type").show();
						jq(".form-item-fixed-time-to").hide();
						break;
				default:
						jq(".product-availability").show();
						break;
			}
		});
		if (jq("#edit-availability-type").val() == "SESSION_SEATS") {
		   jq(".form-item-availability-value").show();
		}	
		else{
			jq(".form-item-availability-value").hide();
		}
		jq("#edit-availability-type").change(function(){
			var type = jq(this).val();
			switch(type){
				case 'FREE_SALE':
						jq(".form-item-availability-value").hide();
						jq(".manage-resources").hide();
						break;
				case 'SESSION_SEATS':
						jq(".form-item-availability-value").show();
						jq(".manage-resources").hide();
						break;
				case 'RESOURCES':
						jq(".form-item-availability-value").hide();
						jq(".manage-resources").show();
						break;
				default:
						jq(".product-availability").show();
						break;
			}
		});
		if ((jq("#edit-confirm-booking-type").val() == "AUTOCONFIRM") || (jq("#edit-confirm-booking-type").val() == "MANUAL")) {
		   jq(".form-item-confirm-booking-value").hide();
		}	
		else{
			jq(".form-item-confirm-booking-value").show();
		}		
		jq("#edit-confirm-booking-type").change(function(){
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

		if (jq("#edit-time-available-type").val() == "FIXED") {
			jq(".form-item-time-available-value").show();
			jq("#addTime").show();
		}	
		else if (jq("#edit-time-available-type").val() == "TIME_ENQUIRY") {
			jq(".form-item-time-available-value").hide();
			jq("#addTime").hide();
		}	
		else if (jq("#edit-time-available-type").val() == "NO_TIME") {
			jq(".form-item-time-available-value").hide();
			jq("#addTime").hide();
		}			
		jq("#edit-time-available-type").change(function(){
			var type = jq(this).val();
			switch(type){
				case 'FIXED':
						jq(".form-item-time-available-value").show();
						jq("#addTime").show();
						
						break;
				case 'TIME_ENQUIRY':
						jq(".form-item-time-available-value").hide();
						jq("#addTime").hide();
						break;
				case 'NO_TIME':
						jq(".form-item-time-available-value").hide();
						jq("#addTime").hide();
						break;
				default:
						jq(".form-item-time-available-value").show();
						break;
			}
		});

		if (jq("#edit-repeat-session").val() == "DoNOt") {
			jq(".form-item-repeat-session-every-minutes").hide();
			jq(".form-item-repeat-session-every-hours").hide();
			jq(".form-item-repeat-session-every-days").hide();
			jq(".form-item-repeat-session-weekly-on").hide();
			jq(".form-item-repeat-session-until").hide();
			jq(".form-item-session-repeats-from").hide();
			jq(".form-item-session-repeats-to").hide();
			jq("#addSession").hide();
		}	
		else if (jq("#edit-repeat-session").val() == "Minute") {
			jq(".form-item-repeat-session-every-minutes").show();
			jq(".form-item-repeat-session-every-hours").hide();
			jq(".form-item-repeat-session-every-days").hide();
			jq(".form-item-repeat-session-weekly-on").show();
			jq(".form-item-repeat-session-until").show();
			jq(".form-item-session-repeats-from").show();
			jq(".form-item-session-repeats-to").show();
			jq("#addSession").show();
		}	
		else if (jq("#edit-repeat-session").val() == "Hourly") {
			jq(".form-item-repeat-session-every-minutes").hide();
			jq(".form-item-repeat-session-every-hours").show();
			jq(".form-item-repeat-session-every-days").hide();
			jq(".form-item-repeat-session-weekly-on").show();
			jq(".form-item-repeat-session-until").show();
			jq(".form-item-session-repeats-from").show();
			jq(".form-item-session-repeats-to").show();
			jq("#addSession").show();
		}		
		else if (jq("#edit-repeat-session").val() == "Daily") {
			jq(".form-item-repeat-session-every-minutes").hide();
			jq(".form-item-repeat-session-every-hours").hide();
			jq(".form-item-repeat-session-every-days").show();
			jq(".form-item-repeat-session-weekly-on").show();
			jq(".form-item-repeat-session-until").show();
			jq(".form-item-session-repeats-from").show();
			jq(".form-item-session-repeats-to").show();
			jq("#addSession").hide();
		}	
		else if (jq("#edit-repeat-session").val() == "Weekly") {
			jq(".form-item-repeat-session-weekly-on").hide();
			jq(".form-item-repeat-session-every-minutes").hide();
			jq(".form-item-repeat-session-every-hours").hide();
			jq(".form-item-repeat-session-every-days").hide();
			jq(".form-item-repeat-session-weekly-on").show();
			jq(".form-item-repeat-session-until").hide();
			jq(".form-item-session-repeats-from").hide();
			jq(".form-item-session-repeats-to").hide();
			jq("#addSession").hide();
		}
		jq("#edit-repeat-session").change(function(){
			var type = jq(this).val();
			switch(type){
				case 'DoNOt':
						jq(".form-item-repeat-session-every-minutes").hide();
						jq(".form-item-repeat-session-every-hours").hide();
						jq(".form-item-repeat-session-every-days").hide();
						jq(".form-item-repeat-session-weekly-on").hide();
						jq(".form-item-repeat-session-until").hide();
						jq(".form-item-session-repeats-from").hide();
						jq(".form-item-session-repeats-to").hide();
						jq("#addSession").hide();
						jq("#removeSession").hide();
						
						break;
				case 'Minute':
						jq(".form-item-repeat-session-every-minutes").show();
						jq(".form-item-repeat-session-every-hours").hide();
						jq(".form-item-repeat-session-every-days").hide();
						jq(".form-item-repeat-session-weekly-on").show();
						jq(".form-item-repeat-session-until").show();
						jq(".form-item-session-repeats-from").show();
						jq(".form-item-session-repeats-to").show();
						jq("#addSession").show();
						jq("#removeSession").show();
						break;
				case 'Hourly':
						jq(".form-item-repeat-session-every-minutes").hide();
						jq(".form-item-repeat-session-every-hours").show();
						jq(".form-item-repeat-session-every-days").hide();
						jq(".form-item-repeat-session-weekly-on").show();
						jq(".form-item-repeat-session-until").show();
						jq(".form-item-session-repeats-from").show();
						jq(".form-item-session-repeats-to").show();
						jq("#addSession").show();
						jq("#removeSession").show();
						break;
				case 'Daily':
						jq(".form-item-repeat-session-every-minutes").hide();
						jq(".form-item-repeat-session-every-hours").hide();
						jq(".form-item-repeat-session-every-days").show();
						jq(".form-item-repeat-session-weekly-on").hide();
						jq(".form-item-repeat-session-until").show();
						jq(".form-item-session-repeats-from").hide();
						jq(".form-item-session-repeats-to").hide();
						jq("#addSession").hide();
						jq("#removeSession").hide();
						break;
				case 'Weekly':
						jq(".repeat_session1").hide(); 
						jq(".form-item-repeat-session-every-minutes").hide();
						jq(".form-item-repeat-session-every-hours").hide();
						jq(".form-item-repeat-session-every-days").hide();
						jq(".form-item-repeat-session-weekly-on").show();
						jq(".form-item-repeat-session-until").hide();
						jq(".form-item-session-repeats-from").hide();
						jq(".form-item-session-repeats-to").hide();
						jq("#addSession").hide();
						jq("#removeSession").hide();
						break;
				default:
						jq(".form-item-time-available-value").show();
						break;
			}
		});
		
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
		var addDiv = jq('#season_rate');
		var i = 1;

		jq('#addRate').on('click', function(e) {
			e.preventDefault();
			if(e.handled !==true)
			{
				jq('input[name="openning_hours_dates"] , .form-item-high-season-rate-dates input').daterangepicker();
				e.handled=true;
				jq('<div id="season_rate" class="quantity"><div class="form-item form-type-textfield form-item-season-rate-label"><label for="edit-season-rate-label">Rate Label </label><input type="text" maxlength="128" size="60" value="" name="season_rate_label_extra[' + i +']" id="edit-season-rate-label' + i +'" class="form-control form-text" placeholder="Rate Label"></div><div class="form-item form-type-textfield form-item-season-rate-amount"><label for="edit-season-rate-amount">Rate Price </label><input type="text" maxlength="128" size="60" value="" name="season_rate_amount_extra[' + i +']" id="edit-season-rate-amount' + i +'" class="form-control form-text" placeholder="Rate Price"></div><div class="form-item form-type-textfield form-item-high-season-rate-dates"><label for="edit-high-season-rate-dates">From - To </label><input id="edit-high-season-rate-dates' + i +'" class="form-control form-text" type="text" maxlength="128" size="60" value="" name="high_season_rate_dates_extra[' + i +']" placeholder="From - To"></div><a class="btn btn-dark btn-gradient form-submit" href="#" id="remRate">Remove Rate</a> </div>').appendTo(addDiv);
				i++;
			}
			return false;
		});

		jq('#remRate').live('click', function() {
			jq(this).parent('#season_rate').remove();

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

		var addSession = jq('#repeat_session');
		var i = 1;

		jq('#addSession').on('click', function(e) {
			e.preventDefault();
			if(e.handled !==true)
			{
				e.handled=true;
					jq('<div id="repeat_session[' + i +']" class="repeat_session1"><div class="form-item form-type-select form-item-repeat-session-weekly-on" style="display: block;"><label for="edit-repeat-session-weekly-on">On </label><select name="repeat_session_weekly_on_extra[' + i +']" id="edit-repeat-session-weekly-on[' + i +']" class="form-control form-select"><option value="Monday">Monday</option><option value="Tuesday">Tuesday</option><option value="Wednesday">Wednesday</option><option value="Thursday">Thursday</option><option value="Friday">Friday</option><option value="Saturday">Saturday</option><option value="Sunday">Sunday</option></select></div><div class="form-item form-type-textfield form-item-session-repeats-from" style="display: block;"><label for="edit-session-repeats-from">From </label><input type="text" maxlength="128" size="60" value="" name="session_repeats_from_extra[' + i +']" id="edit-session-repeats-from[' + i +']" class="form-control timepicker form-text" placeholder="From"></div><div class="form-item form-type-textfield form-item-session-repeats-to" style="display: block;"><label for="edit-session-repeats-to">To </label><input type="text" maxlength="128" size="60" value="" name="session_repeats_to_extra[' + i +']" id="edit-session-repeats-to[' + i +']" class="form-control timepicker form-text" placeholder="To"></div><a class="btn btn-dark btn-gradient form-submit" href="#" id="removeSession">Remove</a> </div>').appendTo(addSession);
				i++;
			}
			return false;
		});

		jq('#removeSession').live('click', function() {
			jq(this).parent('.repeat_session1').remove();

			return false;
		});		

		var addSession = jq('#time-available');
		var i = 1;

		jq('#addTime').on('click', function(e) {
			e.preventDefault();
			if(e.handled !==true)
			{
				e.handled=true;
					jq('<div id="time-available[' + i +']" class="time-available"><div class="form-item form-type-textfield form-item-time-available-value"><label for="edit-time-available-value">Available time </label><input type="text" maxlength="128" size="60" value="" name="time_available_value[' + i +']" id="edit-time-available-value[' + i +']" class="form-control timePicker form-text"></div><a class="btn btn-dark btn-gradient form-submit" href="#" id="removeTime">Remove</a> </div>').appendTo(addSession);
				i++;
			}
			return false;
		});

		jq('#removeTime').live('click', function() {
			jq(this).parent('.time-available').remove();

			return false;
		});	
		/*****************************************************************************************/
		 
		 /*********************************Add more Experinece Requirements*******************************************/
		 var i = 500;
        var addExp=jq('#experience-require')
		jq('#addIncExp').on('click', function(e) {
			e.preventDefault();
			if(e.handled !==true)
			{
			
				var index = jq("input[name*='experience_rules']").size();
				if(index)
				{
					index++;
				}
				else
				{
					index = 0;
				}
				e.handled=true;
				jq('<div id="experience-require'+i+'" class="experience-require"><div class="form-item form-type-textfield form-item-experience-rules"><input type="text" maxlength="140" size="60" value="" name="experience_rules['+index+']" id="edit-experience-rules'+i+'" class="form-control form-text experience-rules" placeholder="Experience Requirements"></div><div class="add-experience"><a id="remIncExp" href="#" class="btn btn-dark btn-gradient form-submit add-extra-submit">Remove</a></div></div>').appendTo(addExp);
			
				i++;
			}
			return false;
		});

		jq('#remIncExp').live('click', function() {
			jq(this).parent().parent('.experience-require').remove();

			return false;
		});
       /*************************************************************************************/
	});