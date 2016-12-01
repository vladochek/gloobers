var jq=jQuery.noConflict();
	 jq(document).ready(function(){
	
	 jq(document).not('input[type="submit"]').on('focus','.product-form-wrapper form select,input,textarea',function(){
     jq(".helpbox div").hide();
	 /******************************************************/
	 jq(".helpbox ."+jq(this).parent().parent().attr('class')+"-help").fadeIn();
	 jq(".helpbox ."+jq(this).parent().attr('class')+"-help").fadeIn();
	 /*********************************************************/
	jq(".helpbox ."+jq(this).attr('name')+"-help").fadeIn();
 });
/**********************************************************/
	jq('#edit-cancellation-policies-type').focus(function(){
	     jq(".helpbox div").hide();
	jq(".helpbox .policies-"+jq(this).val()+"-help").fadeIn(); 
	});
  jq("#edit-cancellation-policies-type").on('change',function(){
       jq(".helpbox div").hide();
  jq(".helpbox .policies-"+jq(this).val()+"-help").fadeIn();
  });
   
	});	