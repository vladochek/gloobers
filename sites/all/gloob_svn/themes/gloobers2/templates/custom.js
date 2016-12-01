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
		if (jq("#edit-dates-available").val() == "NO_DATE") {
						jq(".product-availability").hide();
						jq(".time-available").hide();
		}	
		else if (jq("#edit-dates-available").val() == "INVENTORY") {
						jq(".product-availability").show();
						jq(".time-available").hide();
		}	
		else if (jq("#edit-dates-available").val() == "DATE_ENQUIRY") {
						jq(".time-available").show();
						jq(".product-availability").hide();
		}		
		jq("#edit-dates-available").change(function(){
			var type = jq(this).val();
			switch(type){
				case 'NO_DATE':
						jq(".product-availability").hide();
						jq(".time-available").hide();
						break;
				case 'INVENTORY':
						jq(".product-availability").show();
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
						jq(".product-availability").hide();
						jq(".manage-resources").hide();
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
		if (jq("edit-time-available-type").val() == "FIXED") {
		   jq(".form-item-time-available-value").show();
		}	
		else{
			jq(".form-item-time-available-value").hide();
		}			
		jq("#edit-time-available-type").change(function(){
			var type = jq(this).val();
			switch(type){
				case 'FIXED':
						jq(".form-item-time-available-value").show();
						break;
				case 'TIME_ENQUIRY':
						jq(".form-item-time-available-value").hide();
						break;
				case 'NO_TIME':
						jq(".form-item-time-available-value").hide();
						break;
				default:
						jq(".form-item-time-available-value").show();
						break;
			}
		});
	});