var jq=jQuery.noConflict();
jQuery(document).ready(function () {
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
/************** for filter toggle **************/	
jQuery(".filterbutton").click(function(){
jQuery(".formsec").slideToggle("slow");
});
jQuery(".clickarrow").click(function(){
jQuery(".checksec").slideToggle("slow");
});
/************** for options toggle **************/

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
/****************************For jssor slider on experience detail page*****************************************************/    
            var options = {
                $AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                $AutoPlayInterval: 4000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
                $SlideDuration: 500,                                //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
                $DragOrientation: 3,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)
                $UISearchMode: 0,                                   //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).

                $ThumbnailNavigatorOptions: {
                    $Class: $JssorThumbnailNavigator$,              //[Required] Class to create thumbnail navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
					$Loop: 2,                                       //[Optional] Enable loop(circular) of carousel or not, 0: stop, 1: loop, 2 rewind, default value is 1
                    $SpacingX: 3,                                   //[Optional] Horizontal space between each thumbnail in pixel, default value is 0
                    $SpacingY: 3,                                   //[Optional] Vertical space between each thumbnail in pixel, default value is 0
                    $DisplayPieces: 6,                              //[Optional] Number of pieces to display, default value is 1
                    $ParkingPosition: 204,                          //[Optional] The offset position to park thumbnail,

                    $ArrowNavigatorOptions: {
                        $Class: $JssorArrowNavigator$,              //[Requried] Class to create arrow navigator instance
                        $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                        $AutoCenter: 2,                                 //[Optional] Auto center arrows in parent container, 0 No, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                        $Steps: 6                                       //[Optional] Steps to go for each navigation request, default value is 1
                    }
                }
            };

            var jssor_slider1 = new $JssorSlider$("slider1_container", options);
			//alert(jssor_slider1);exit;
            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizes
            function ScaleSlider() {
                var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
                if (parentWidth)
                    jssor_slider1.$ScaleWidth(Math.min(parentWidth,893));
                else
                    window.setTimeout(ScaleSlider, 30);
            }
            ScaleSlider();
			jQuery(window).bind("load", ScaleSlider);
            jQuery(window).bind("resize", ScaleSlider);
            jQuery(window).bind("orientationchange", ScaleSlider);
            //responsive code end
/***********************Read more for experience detail page**********************************/	
jQuery('.read-more').click(function(){
  if(jQuery(this).hasClass('r-m-close')){
	  jQuery('.read-more-head').css({'height':'30px'});
	  jQuery(this).removeClass('r-m-close');
  }else{
	  jQuery('.read-more-head').css({'height':'auto'});
	  jQuery(this).addClass('r-m-close');
  }
});	
/**************************************************************/
    });

 