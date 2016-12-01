var jq=jQuery.noConflict();
/* jq(document).ready(function(){

}); */
function select_cancellation(val){

jQuery('#new_cancellation_select').val(val);
jQuery('#new_cancellation_select_final').val(val);
var Cancel_policy_typ=jQuery.trim(val);
var res = Cancel_policy_typ.replace(" ", "-"); 
jQuery(".resp-tabs-container").find('.can_policy').hide();     
jQuery(".resp-tabs-container").find('#'+res).show();

if(val=='Custom'){
	jQuery('.custom-policy').show();
}else{
	jQuery('.custom-policy').hide();
}	var new1=jQuery('#new_cancellation_select').val();	var new2=jQuery('#new_cancellation_select_final').val();	if(new1==new2){		jQuery('.selecttag').css({		   'background':'rgb(41, 144, 216)',		   'color' : '#fff',		   });		   jQuery('.selecttag').html('Selected');	}else{		jQuery('.selecttag').css({			   'background':'linear-gradient(to bottom, #f2cb00 0%, #ffae00 100%) repeat scroll 0 0 rgba(0, 0, 0, 0)',			   'color' : '#000',			   });		jQuery('.selecttag').html('Select');	}
}
function set_cancellation(){

var cancellation_type=jQuery('#new_cancellation_select').val();
jQuery('#new_cancellation_select_final').val(cancellation_type);
	if(cancellation_type=='Custom'){
		jQuery('.custom-policy').show();
	}else{
		jQuery('.custom-policy').hide();
	}		/* var new1=jQuery('#new_cancellation_select').val();	var new2=jQuery('#new_cancellation_select_final').val();	if(new1==new2){ */		jQuery('.selecttag').css({		   'background':'rgb(41, 144, 216)',		   'color' : '#fff',		   });		   jQuery('.selecttag').html('Selected');	/* }else{		jQuery('.selecttag').html('Select');	} */}