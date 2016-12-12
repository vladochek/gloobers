var jq=jQuery.noConflict();
jQuery(document).ready(function () {
	jQuery('.moreme').click(function(){
		jQuery(this).hide();
		jQuery(this).next().show();
	});
	
	jQuery('.lessme').click(function(){
		jQuery(this).hide();
		jQuery(this).parent().find('.moreme').show();
	});
	

jQuery('.input-number').focusin(function(){
   jQuery(this).data('oldValue', jQuery(this).val());
});
jQuery('.input-number').change(function() {
    minValue =  parseInt(jQuery(this).attr('min'));
    maxValue =  parseInt(jQuery(this).attr('max'));
    valueCurrent = parseInt(jQuery(this).val());
    name = jQuery(this).attr('name');
    if(valueCurrent >= minValue) {
        jQuery(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        jQuery(this).val(jQuery(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        jQuery(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        jQuery(this).val(jQuery(this).data('oldValue'));
    }
    
    
});
jQuery(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if (jQuery.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    }); //End
	
	
//jQuery('.read-more-head').css({'height':'54px'});
jQuery('nav').meanmenu();
//Start of Script for Sticky header
 jQuery(window).scroll(function() {
if (jq(this).scrollTop() > 1){  
jQuery('header').addClass("sticky");
}
else{
jQuery('header').removeClass("sticky");
}
});
/*  for filter toggle */	
jQuery(".filterbutton").click(function(){
jQuery(".formsec").slideToggle("slow");
});
jQuery(".clickarrow").click(function(){
jQuery(".checksec").slideToggle("slow");
});
/* for options toggle */

jQuery(".listicon").click(function(event){
 event.preventDefault();
 jQuery(this).parent().parent().find(".listview").slideToggle("slow");
 
});

var dateToday = new Date();
jQuery('#datetimepicker1').datetimepicker({
		pickTime: false,
		minDate: dateToday,
		defaultDate:dateToday,
		//format: 'dd/MM/YYYY'
		//daysOfWeekDisabled: [1,2,3,5]
         
});
//to select time
jQuery('#time-select').timepicker();



/**************************For experience detail page *********Price div*************/
width = jQuery( window ).width();
if(width>1025)
{
jQuery(window).scroll(function() {
    var scroll = jQuery(window).scrollTop();

    if (scroll >= 300 && scroll < 500) {
        jQuery(".booking-sec").addClass("darkHeader");
    }
	else if (scroll >= 500 || scroll < 300) {
		
       jQuery(".booking-sec").removeClass("darkHeader");
    }
	
});
}
/*************For circle percentage***********************************/
jQuery('.first.circle').circleProgress({
	startAngle: -Math.PI / 4 * 3,
    value: 0.98,
    //animation: false,
    fill: { color: '#00aeef' }
});
jQuery('.second.circle').circleProgress({
    startAngle: -Math.PI / 4 * 3,
    value: 0.73,
    fill: { color: '#00aeef' }
});

jQuery('.third.circle').circleProgress({
    startAngle: -Math.PI / 4 * 3,
    value: 0.73,
    fill: { color: '#00aeef' }
});

jQuery('.forth.circle').circleProgress({
    startAngle: -Math.PI / 4 * 3,
    value: 0.67,
    fill: { color: '#00aeef' }
});

});

jQuery.noConflict();
jQuery(document).ready(function(){	
jQuery('#recommend').on('show.bs.modal', function (event) {
  var button = jQuery(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  var modal = jQuery(this)
  modal.find('.modal-title').text('Recommend << Big Five Safari >> To A Friend' + recipient)
  //modal.find('.modal-body input').val(recipient)
})

/* Read more for experience detail page */	
jQuery('#readMore').click(function(){
  if(jQuery(this).hasClass('r-m-close')){
	  jQuery('.read-more-head').css({'height':'100px'});
	  jQuery(this).removeClass('r-m-close');
  }else{
	  jQuery('.read-more-head').css({'height':'auto'});
	  jQuery(this).addClass('r-m-close');
	  jQuery("#readMore").remove();
	  
  }
});	
jQuery('#readMore2').click(function(){
  if(jQuery(this).hasClass('r-m-close')){
	  jQuery('.read-more-head').css({'height':'30px'});
	  jQuery(this).removeClass('r-m-close');
  }else{
	  jQuery('.read-more-head').css({'height':'auto'});
	  jQuery(this).addClass('r-m-close');
	  jQuery("#readMore2").remove();
	  
  }
});	
jQuery('#readMore3').click(function(){
  if(jQuery(this).hasClass('r-m-close')){
	  jQuery('.read-more-head').css({'height':'30px'});
	  jQuery(this).removeClass('r-m-close');
  }else{
	  jQuery('.read-more-head').css({'height':'auto'});
	  jQuery(this).addClass('r-m-close');
	  jQuery("#readMore3").remove();
	  
  }
});	
/* End */
});	