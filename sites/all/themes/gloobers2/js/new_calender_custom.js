

jQuery(document).ready(function(){

		/* New calender Cloning JQuery */

			/* 24 Hour Offer Cloning */
				var addperiodEXP=jQuery('.24_hour_offer_show')
				var i=50;
				var nowTemp = new Date();
				var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
				jQuery('body').on('click','#addPeriodEXP_New', function(e){
					
					e.preventDefault();
					if(e.handled !==true)
					{	
						e.handled=true;
						jQuery('.add_offers_btn').before('<div class="hour_offer_show_main"><div class="24_hours_discounted_clone"><div class="col-md-12 col-sm-12 col-xs-12 padding_left padding_right"><div class="col-md-6 col-sm-12 col-xs-12 padding_left"><span class="labeltext text-left">If booking is made on</span></div><div class="early-birds-hour-offer col-md-6 col-sm-12 col-xs-12 form-group padding_right"><div id="datetimepicker5" class="input-group date"><i class="bookig_date_icon"><span class="icon-calendar"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></span></i><input type="text" maxlength="128" size="60" value="" readonly="true" name="offer_24_hour_offer_Data_date[]" id="edit-24-hour-offer-date'+i+'" class="offer_24_hour_offer_Data_date form-text valid" placeholder="Date"></div></div></div><div class="col-md-12 col-sm-12 col-xs-12 padding_left padding_right"><div class="col-md-6 col-sm-6 col-xs-12 padding_left"><span class="labeltext font12 text-left">apply discount of</span></div><div class="col-md-3 col-sm-12 col-xs-12 paddig_right_five"><input type="text" maxlength="128" size="60" value="" name="offer_24_hour_offer_Data_price[]" id="edit-24-hour-offer-price-value'+i+'" class="offer_24_hour_offer_Data_price form-text valid" placeholder="Amount" /></div><div class="col-md-3 col-sm-12 col-xs-12 padding_right padding_left"><select name="offer_24_hour_offer_Data_pricetype[]" id="edit-24-hour-offer-price-type" class="form-select select_box"><option selected="selected" value="%">in %</option><option  value="$">in $</option></select></div></div><a  href="#" class="delete remPeriodEXP_New">Remove</a></div></div>');
						/* jQuery('.offer_24_hour_offer_Data_date').datepicker({format: 'yyyy-mm-dd', onRender: function(date) {
							return date.valueOf() < now.valueOf() ? 'disabled' : '';
						}
						
					}); */
					var Hours24DateClone = jQuery('.offer_24_hour_offer_Data_date').datepicker({
						format:'yyyy-mm-dd',
						beforeShowDay: function (date) {
							return date.valueOf() >= now.valueOf();
						},
						startDate:now,
						autoclose: true

					});
					jQuery("select").selectbox();
						i++;
					}
					//jQuery(this).parent('div').remove();
					return false;
				});
				
				jQuery(document).on('click','.remPeriodEXP_New', function(){
				
					jQuery(this).closest('.hour_offer_show_main').remove();
					return false;
				}); 
		
			/* END 24 Hour Offer Cloning */
			
			/* Pricing Type New Cloning */
				var addPricingNew = jq('.product_pricing');
				delete i;  
				//pricetype_options_PER_PERSON
				j = 50;
				jQuery(document).on('click', '.addPricing',function(e){
					
					i = j;
					
					e.preventDefault();
					if(e.handled !==true)
					{
						var price_type = jQuery("#edit-product-pricing-type").val();
						var count = jQuery('.pricediv_clone').size();
					  
						if(price_type == "PER_PERSON"){

							if(count < 1){

								var valuePerperson = jQuery(".price-option-type").val();
								if(valuePerperson=='adult'){
										var options='<option value="child">Per child</option>';
										jQuery('.pricetype_options_'+price_type).append('<div class="pricediv_clone row"><div class="col-md-8 col-sm-12 col-xs-12"><div class="col-md-5 col-sm-5 col-xs-12 padding_right" style="display: block;" id="product_pricing_extra'+i+'"><div class="person_type per_adult_child add_child_icon"><select name="product_pricing_PER_PERSON_TYPE['+i+'][]" id="edit-priceoption-0-priceoptiontype" class="form-select price-option-type clone_selectbox_price select_box product_adult_child">'+options+'</select><i><img src="http://staging.gloobers.net/sites/all/themes/gloobers2/images/child.svg" alt=""/></i></div></div><div class="col-md-5 col-sm-5 col-xs-12 form-type-textfield form-item-PriceOption-0-price"><div class="input-group"><div class="input-group-addon">$</div><input type="text" maxlength="128" size="60" value="" name="product_pricing_PER_PERSON_TYPE['+i+'][]" id="edit-priceoption-0-price" class="amount_perperson themePrice form-text" placeholder="Amount"></div></div><div class="col-md-2 col-sm-2 col-xs-12 padding_left"><div class="experience_delete"><a href="javascript:void(0)" class="removePricing_clone delete">Remove</a></div></div></div></div></div>');
										jQuery('.addPricing').parent().hide();
										jQuery("select").selectbox();
										jQuery(".amount_perChild_div").show();
									}else if(valuePerperson=='child'){
									
										var options='<option value="adult">Per adult</option>';
										jQuery('.pricetype_options_'+price_type).append('<div class="pricediv_clone row"><div class="col-md-8 col-sm-12 col-xs-12"><div class="col-md-5 col-sm-5 col-xs-12 padding_right" style="display: block;" id="product_pricing_extra'+i+'"><div class="person_type per_adult_child add_adult_icon"><select name="product_pricing_PER_PERSON_TYPE['+i+'][]" id="edit-priceoption-0-priceoptiontype" class="form-select price-option-type clone_selectbox_price select_box product_adult_child">'+options+'</select><i><img src="http://staging.gloobers.net/sites/all/themes/gloobers2/images/adult.svg" alt=""/></i></div></div><div class="col-md-5 col-sm-5 col-xs-12 form-type-textfield form-item-PriceOption-0-price"><div class="input-group"><div class="input-group-addon">$</div><input type="text" maxlength="128" size="60" value="" name="product_pricing_PER_PERSON_TYPE['+i+'][]" id="edit-priceoption-0-price" class="amount_perperson themePrice form-text" placeholder="Amount"></div></div><div class="col-md-2 col-sm-2 col-xs-12"><div class="experience_delete"><a href="javascript:void(0)" class="removePricing_clone delete">Remove</a></div></div></div></div></div>');
										jQuery('.addPricing').parent().hide();
										jQuery("select").selectbox();
										jQuery(".amount_perAdult_div").show();									
										
									}
							}
					}else if(price_type == "PER_ITEM"){
						jQuery(".additem_more" ).remove();
						jQuery('.pricetype_options_'+price_type).append('<div class="pricediv_clone row"><div class="col-md-12 col-sm-12 col-xs-12"><div class="col-md-5 col-sm-6 col-xs-12 padding_right" style="display:block"><input type="text" maxlength="128" size="60" value="" name="product_pricing_PER_ITEM_TYPE['+i+'][]" id="edit-priceoption-1-label" class="item_name form-text price-label" placeholder="Item name"></div><div class=" col-md-5 col-sm-6 col-xs-12 padding_right"><input type="text" maxlength="128" size="60" value="" name="product_pricing_PER_ITEM_TYPE['+i+'][]" id="edit-priceoption-1-price" class="amount_peritem themePrice form-text" placeholder="Price"></div><div class="col-md-2 col-sm-2 col-xs-12"><a href="javascript:void(0)" class="removePricing_clone delete">Remove</a></div><div><a class="addPricing addanother additem_more" href="#">Add more</a></div></div></div>');

					}
						j++;
					}
					return false;
				});

		
				jQuery(document).on('click','.removePricing_clone', function(){
					
					jQuery(this).parent().parent().parent().parent('.pricediv_clone').remove();
					var price_type=jQuery('#edit-product-pricing-type').val();
					if(price_type=='PER_ITEM'){				
					
						if(jQuery('.pricediv_clone').size()==0){						   						
							jQuery('.item_add').append('<a class="addPricing addanother addAnother additem_more" href="#">Add more</a>');		
							
						}else{	
							jQuery(".addPricing" ).parent().hide();
							jQuery('.pricediv_clone').last().append('<div><a class="addPricing addanother" href="#">Add more</a></div>');
						}

					}else{
						
						if(jQuery('.product_adult_child').val()=='adult'){					
							jQuery(".amount_perAdult_div").show();	
							jQuery(".amount_perChild_div").hide();		

						} else {	
							jQuery(".amount_perAdult_div").hide();	
							jQuery(".amount_perChild_div").show();		
						}									
						jQuery('.addPricing').parent().show();
					}
					
				});
			/* END Pricing New Cloning */
			
			jQuery('#edit-product-pricing-type').change(function(e){
			
				var price_type=jQuery(this).val();
				var value = jQuery(".price-option-type").val();
				if((value=='everyone') && (jQuery('.pricediv_clone').size()==0)){jQuery('.addPricing').parent().hide();}else{jQuery('.addPricing').parent().show();}
				
			});
		
		/* End New calender cloning jQuery */

});

function val_price_person(){

	var value = jQuery(".price-option-type").val();
	
	if(value == 'everyone'){
		jQuery('.addPricing').parent().hide();
		jQuery('.pricediv_clone').hide();

	}else if(value =='child'){

		 jQuery('.clone_selectbox_price').html('<option value="adult">Adult</option>');
		 jQuery('.addPricing').parent().show();

	}else{
		var a = jQuery('.clone_selectbox_price').html('<option value="child">Child</option>');
		jQuery('.addPricing').parent().show();
	}
}
function get_date_html(val){
	var date=val.value;
	if(date=="INVENTORY"){		
		jQuery('.availability_main').show();	
		jQuery('.add_date_period').show();			    
	}else{
		jQuery('.availability_main').hide();
		jQuery('.add_date_period').hide();	
	}
	jQuery('.repeat-session-HTML').hide();
	jQuery('#edit-session-startdate_new').val('');
	jQuery('#edit-session-enddate_new').val('');	
}
jQuery(document).ready(function(){
	jQuery('.offer_icon_left').on('click',function(){
	jQuery(this).closest('.padding_left').siblings().find('.css-checkbox').click();
	if(jQuery(this).closest('.padding_left').siblings().find('.css-checkbox').prop("checked") == true){
	jQuery(this).addClass('active');	
	}
	else if(jQuery(this).closest('.padding_left').siblings().find('.css-checkbox').prop("checked") == false){
		jQuery(this).removeClass('active');	
	}
	});
	
});
 
 var id=50;
 jQuery('.add_date_period').on('click',function(){
  jQuery(this).before('<div class="availability_main"><div id="datetimepicker1_'+id+'" class="col-md-4 col-sm-6 col-xs-12 datetimepicker_from date_from"><div class="select_date_from"><i class=""><span class="icon-calendar"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></span></i><h4>From</h4><h3 id="select_from_date_'+id+'">Select date</h3><input type="text" placeholder="" name="session_startdate[]" data-val="'+id+'" id="edit-session-startdate_new_'+id+'" class="datepicker required add_datepicker session_startdt" autocomplete="off" readonly="true"></div></div><div class="col-md-4 col-sm-6 col-xs-12 untill_cls_div"><div class="select_date_from"><i class=""><span class="icon-calendar"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></span></i><h4>To</h4><h3 id="select_to_date_'+id+'">Select date</h3><input type="text" placeholder="Date" class="datepicker add_datepicker" data-val="'+id+'" id="edit-session-enddate_new_'+id+'" name="Session_UntilRepeatDate[]" autocomplete="off" readonly="true" ></div></div><div class="col-md-2 col-sm-12 col-xs-12 datetimepicker_from add_period remove_period"><a href="javascript:void(0);">Remove a period</a></div></div>');  

  var nowTemp = new Date();
  var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
	

	var checkin = jQuery('#edit-session-startdate_new_'+id).datepicker({
        format:'yyyy-mm-dd',
		beforeShowDay: function (date) {
			return date.valueOf() >= now.valueOf();
		},
		autoclose: true
		
	}).on('changeDate', function (ev){
		if(ev.date){
			//if (ev.date.valueOf() > checkout.datepicker("getDate").valueOf() || !checkout.datepicker("getDate").valueOf()) {

				var newDate = new Date(ev.date);
				newDate.setDate(newDate.getDate());
				checkout.datepicker("update", newDate);

			//}
			idd=jQuery(this).attr('data-val');
			jQuery('#edit-session-enddate_new_'+idd).focus();		
			jQuery('#edit-session-enddate_new_'+idd).closest('.select_date_from').addClass('active');
			jQuery('#select_from_date_'+idd).html(jQuery('#edit-session-startdate_new_'+idd).val());
			jQuery('#select_to_date_'+idd).html(jQuery('#edit-session-enddate_new_'+idd).val());
		}


	});
	
	var checkout = jQuery('#edit-session-enddate_new_'+id).datepicker({
			format:'yyyy-mm-dd',
			beforeShowDay: function (date){
			if (!checkin.datepicker("getDate").valueOf()) {
				return date.valueOf() >= new Date().valueOf();
			} else {
				return date.valueOf() > checkin.datepicker("getDate").valueOf();
			}
		},
		autoclose: true

	}).on('changeDate', function (ev) {
		if(ev.date){
			id_end=jQuery(this).attr('data-val');		
			jQuery('#select_to_date_'+id_end).html(jQuery('#edit-session-enddate_new_'+id_end).val());
		}
	});


	jQuery('#edit-session-startdate_new_'+id).on('click',function(){
	 	id_start=jQuery(this).attr('data-val');	
	 	jQuery('#edit-session-startdate_new_'+id_start).closest('.select_date_from').addClass('active');

	});
	jQuery('#edit-session-enddate_new_'+id).on('click',function(){
		id_end=jQuery(this).attr('data-val');	
		jQuery('#edit-session-enddate_new_'+id_end).closest('.select_date_from').addClass('active');

	});
	

	id++; 
	
  });
 
var p=50
  jQuery('.per_person_period').on('click',function(){

	var person_type=jQuery('#edit-product-pricing-type').val();
	var style_p="";var style_i="";
	if(jQuery.trim(person_type)=='PER_PERSON'){	

	style_p="style=display:block";
	style_i="style=display:none";
	} else {
	style_p="style=display:none";
	style_i="style=display:block";
	}


	if(jQuery('.product_adult_child').length==2){
	style_a="style=display:block";
	style_c="style=display:block";

	} else{

	if(jQuery('.product_adult_child').val()=='adult'){	

		style_a="style=display:block";
		style_c="style=display:none";
		
	} else {
		style_a="style=display:none";
		style_c="style=display:block";
	}

	}

	jQuery(this).before('<div class="seasonnal_pricing remove_this_seasonal" ><div class="col-md-4 col-sm-6 col-xs-12"><div class="select_date_from"><i class=""><span class="icon-calendar"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></span></i><h4>From</h4><h3 id="season_from_date_'+p+'">Select date</h3><input type="text" placeholder="date" name="fromdate[]" data-val="'+p+'" id="session_from_'+p+'" class="datepicker session_from_dtpicker" autocomplete="off" readonly="true"></div></div><div class="col-md-4 col-sm-6 col-xs-12 "><div class="select_date_from"><i class=""><span class="icon-calendar"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></span></i><h4>To</h4><h3 id="season_to_date_'+p+'">Select date</h3><input type="text" placeholder="date" name="todate[]" data-val="'+p+'" id="session_to_'+p+'" class="datepicker" autocomplete="off" readonly="true"></div></div><div class="col-xs-12 col-sm-12 col-md-8"><div class="row"><div class="col-md-6 col-sm-6 col-xs-12 "><div class="seasonnal_pricing_amount pricetype_options_PER_PERSON_1" '+style_p+'><div class="amount_perAdult_div" '+style_a+'><div class="input-group"><div class="input-group-addon">$</div><input type="text" placeholder="Amount per adult" id="rate_per_adult" class="rate_per_adult" name="rate_per_adult[]" ></div></div></div></div><div class="col-md-6 col-sm-6 col-xs-12 "><div class="seasonnal_pricing_amount pricetype_options_PER_PERSON_1" '+style_p+'><div class="amount_perChild_div" '+style_c+'><div class="input-group"><div class="input-group-addon">$</div><input type="text" placeholder="Amount per child" id="rate_per_child" class="rate_per_child" name="rate_per_child[]"></div></div></div></div></div></div><div class="seasonnal_pricing_amount col-md-8 col-sm-12 col-xs-12 sessional_price_per_item padding_left" '+style_i+'><div class="col-md-6 col-sm-12 col-xs-12"><div class="input-group"><div class="input-group-addon">$</div><input type="text" placeholder="Amount per item" id="rate_per_item" class="rate_per_item" name="rate_per_item[]" ></div></div></div><div class="col-md-2 col-sm-12 col-xs-12 add_period remove_person_period"><a href="javascript:void(0);">Remove a period</a></div></div>');


  var nowTemp = new Date();
  var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);	

	var checkin = jQuery('#session_from_'+p).datepicker({
        format:'yyyy-mm-dd',
		beforeShowDay: function (date) {
			return date.valueOf() >= now.valueOf();
		},
		autoclose: true
		
	}).on('changeDate', function (ev){
		if(ev.date){	
			//if (ev.date.valueOf() > checkout.datepicker("getDate").valueOf() || !checkout.datepicker("getDate").valueOf()) {

				var newDate = new Date(ev.date);
				newDate.setDate(newDate.getDate());
				checkout.datepicker("update", newDate);

			//}
			idd=jQuery(this).attr('data-val');
			jQuery('#session_to_'+idd).focus();		
			jQuery('#session_to_'+idd).closest('.select_date_from').addClass('active');
			jQuery('#season_from_date_'+idd).html(jQuery('#session_from_'+idd).val());
			jQuery('#season_to_date_'+idd).html(jQuery('#session_to_'+idd).val());
		}

	});
	
	var checkout = jQuery('#session_to_'+p).datepicker({
			format:'yyyy-mm-dd',
			beforeShowDay: function (date){
			if (!checkin.datepicker("getDate").valueOf()) {
				return date.valueOf() >= new Date().valueOf();
			} else {
				return date.valueOf() > checkin.datepicker("getDate").valueOf();
			}
		},
		autoclose: true

	}).on('changeDate', function (ev) {
		if(ev.date){	
		 	id_end=jQuery(this).attr('data-val');		
		 	jQuery('#season_to_date_'+id_end).html(jQuery('#session_to_'+id_end).val());
		}
	});


	jQuery('#session_from_'+p).on('click',function(){
	 	id_start=jQuery(this).attr('data-val');	
	 	jQuery('#session_from_'+id_start).closest('.select_date_from').addClass('active');

	});
	jQuery('#session_to_'+p).on('click',function(){
		id_end=jQuery(this).attr('data-val');	
		jQuery('#session_to_'+id_end).closest('.select_date_from').addClass('active');

	});

	p++;
  });
 
 var s=50;
 jQuery('.add_session_link').on('click',function(){ 

var select_session='';

select_session='<ul class="sessions_tabs_menu sessions_tabs_menu_'+s+'" data-id="'+s+'"><li class="weekday_menu"><a href="#session_tab1"><i class=""><span class="icon-calendar"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></span></i><h4>M</h4></a><input type="checkbox" value="Monday" class="css-checkbox" name="Session_repeatonWeek['+s+'][0]"></li><li class="weekday_menu"><a href="#session_tab2"><i class=""><span class="icon-calendar"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></span></i><h4>T</h4></a><input type="checkbox" value="Tuesday" class="css-checkbox" name="Session_repeatonWeek['+s+'][1]"></li><li class="weekday_menu"><a href="#session_tab3"><i class=""><span class="icon-calendar"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></span></i><h4>W</h4></a><input type="checkbox" value="Wednesday" class="css-checkbox" name="Session_repeatonWeek['+s+'][2]"></li><li class="weekday_menu"><a href="#session_tab4"><i class=""><span class="icon-calendar"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></span></i><h4>T</h4></a><input type="checkbox" value="Thursday" class="css-checkbox" name="Session_repeatonWeek['+s+'][3]"></li><li class="weekday_menu"><a href="#session_tab5"><i class=""><span class="icon-calendar"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></span></i><h4>F</h4></a><input type="checkbox" value="Friday" class="css-checkbox" name="Session_repeatonWeek['+s+'][4]"></li><li class="weekday_menu"><a href="#session_tab6"><i class=""><span class="icon-calendar"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></span></i><h4>S</h4></a><input type="checkbox" value="Saturday" class="css-checkbox" name="Session_repeatonWeek['+s+'][5]"></li><li class="weekday_menu"><a href="#session_tab7"><i class=""><span class="icon-calendar"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></span></i><h4>S</h4></a><input type="checkbox" value="Sunday" class="css-checkbox" name="Session_repeatonWeek['+s+'][6]"></li></ul>';

var person_type	=jQuery('#edit-product-pricing-type').val();
var style_p="";var style_i="";
if(jQuery.trim(person_type)=='PER_PERSON'){
	
 style_p="style=display:block";
 style_i="style=display:none";
} else {
 style_p="style=display:none";
 style_i="style=display:block";
}

if(jQuery('.product_adult_child').length==2){
	style_a="style=display:block";
	style_c="style=display:block";
 
} else{

	if(jQuery('.product_adult_child').val()=='adult'){	

		style_a="style=display:block";
		style_c="style=display:none";
		
	} else {
		style_a="style=display:none";
		style_c="style=display:block";
	}
	
}
var session_count=jQuery('.session_timepicker').length+1;
jQuery(this).closest('.add_del_btn').before('<div id="session_tab1" class="sessions_tab_content"><div class="rate_type"><h3>Session '+session_count+'<span class="form-required"> *</span></h3></div><div class="session_content_inner"><div class="offer_icon_left"><i class=""><svg xml:space="preserve" enable-background="new 0 0 59.604 59.595" viewBox="0 0 59.604 59.595" height="55px" width="100px" y="0px" x="0px" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg" id="Layer_1" version="1.1"><path d="M29.823,0.547c-16.154,0-29.25,13.096-29.25,29.25	s13.096,29.25,29.25,29.25s29.25-13.096,29.25-29.25S45.977,0.547,29.823,0.547z M29.823,50.547c-11.46,0-20.75-9.29-20.75-20.75 s9.29-20.75,20.75-20.75s20.75,9.29,20.75,20.75S41.283,50.547,29.823,50.547z" class="stroke_color" stroke-width="2" stroke-linecap="round" stroke="#515151" fill="#ECECEC"/><polygon points="26.698,13.047 33.073,13.047 33.073,28.34 42.573,37.172 37.948,42.172 26.573,31.422 " class="stroke_color" stroke-width="2" stroke-linecap="round" stroke="#515151" fill="#ECECEC"/></svg></i><input type="text" data-val="'+s+'" class="timepicker session_timepicker" id="edit-session_starttime_'+s+'" name="session_starttime['+s+']" placeholder="Time" readonly="true" /><h5>Start time</h5><h6 id="session_startTime_'+s+'">Select time</h6></div><div class="hour_session_content_right">'+select_session+'<div class="row pricetype_options_PER_PERSON_1" '+style_p+'><div class="col-md-6 col-sm-6 col-xs-12 amount_perAdult_div" '+style_a+'><div class="rate_type"><h3>Price per adult</h3><div class="input-group"><div class="input-group-addon">$</div><input type="text" placeholder="Amount" name="amount_perAdult['+s+']"></div></div></div><div class="col-md-6 col-sm-6 col-xs-12 amount_perChild_div" '+style_c+'><div class="rate_type"><h3>Price per children</h3><div class="input-group"><div class="input-group-addon">$</div><input type="text" placeholder="Amount" name="amount_perChild['+s+']"></div></div></div></div><div class="row pricetype_options_PER_ITEM_1" '+style_i+'><div class="col-md-6 col-sm-6 col-xs-12"><div class="rate_type"><h3>Item Amount</h3><div class="input-group"><div class="input-group-addon">$</div><input type="text" placeholder="Amount" name="amount_perItem['+s+']"></div></div></div></div></div></div><div class="add_del_btn"><a class="del_session remove_session_link" >Delete session</a></div>');

jQuery("select").selectbox();

 s++;

 });
 
 function validate_earlybirdtime(){

}
 