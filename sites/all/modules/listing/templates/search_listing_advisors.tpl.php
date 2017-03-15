<?php global $base_url; ?>
<link href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/stylesheet/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/fonts/stylesheet.css" rel="stylesheet" type="text/css" />
<link href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/stylesheet/style.css" rel="stylesheet" type="text/css" />
<link href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/stylesheet/for-head-foot.css" rel="stylesheet" type="text/css" />
<link href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/stylesheet/font-awesome.css" rel="stylesheet" type="text/css" />

<section class="content-section">
<div class="container-fluid">
<div class="row">

<?php $searchForm=drupal_get_form('search_listings_advisors_form'); echo drupal_render($searchForm);  ?>

</div> <!-- End Row -->
</div> <!-- End Container -->
</section> <!-- End Content-Section -->
<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/js/jQuery.min.js" type="text/javascript" language="javascript"></script> 

<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/js/easingv1.3.js" type="text/javascript" language="javascript"></script>
<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/js/jqueryui.js" type="text/javascript" language="javascript"></script>
<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/js/bootstrap-datetimepicker.js" type="text/javascript" language="javascript"></script>
<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/js/jquery.nicescroll.min.js" type="text/javascript" language="javascript"></script>
<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/js/jquery.selectbox-0.2.js" type="text/javascript" language="javascript"></script>

<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery("#search-listings-advisors-form").click(function(){
		//var traveler=jQuery("#edit-traveler").val();
		//var triptype=jQuery("#edit-triptype").val();
		var destisearch=jQuery("#edit-destination-search").val();
		var budget=jQuery("#edit-overall-budget").val();
		if(destisearch==""){jQuery("#edit-destination-search").css({'border-color':'#ff0000'}); return false; }
		else { jQuery(".form-text").css({'border-color':'#555'}); }
		var triptype=jQuery('#select_custom_triptype').find('.sbSelector')[0].innerHTML;
		var traveler=jQuery('#select_custom_traveler').find('.sbSelector')[0].innerHTML;
		if(traveler=='Select Travelers') { jQuery(".sbHolder").css({'border-color':'#ff0000'}); return false; }
		else { jQuery(".sbHolder").css({'border-color':'#555'}); }
		if(triptype=='Type of trip') { jQuery(".sbHolder").css({'border-color':'#ff0000'}); return false; }
		else { jQuery(".sbHolder").css({'border-color':'#555'}); }
		if(budget==""){jQuery("#edit-overall-budget").css({'border-color':'#ff0000'}); return false; }
		else { jQuery(".form-text").css({'border-color':'#555'}); }
	});
	  jQuery("#edit-overall-budget").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        //jQuery("#ermsg").html("Please enter numeric value").show();
               return false;
    }
    else{
    	jQuery("#ermsg").html("").fadeOut();
    }
   });
	
/*Html Scroll*/
jQuery("html").niceScroll();
/*SelectBox*/
jQuery("select").selectbox(); 
	jQuery(document).click(function(e){
		if (!jQuery(e.target).is('.sbHolder, .sbHolder *')) {
			jQuery("select").selectbox('close'); 
		} 
	}); //End
	
}); //End Document.Ready()

</script>
<script type ="text/javascript">
function search_destination(){
     	var home_autocomplete = new google.maps.places.Autocomplete(
                /** @type {HTMLInputElement} */
                        (document.getElementById('advice_destination')),
                        {types: ['geocode']});
        google.maps.event.addListener(home_autocomplete, 'place_changed', function () {
        });
    }
var dateToday = new Date();
	 jQuery(function () {
	 	jQuery('#start_date').datetimepicker({
					pickTime: false,
					minDate: dateToday,
					defaultDate: dateToday,    
				});
				dateToday.setDate(dateToday.getDate() + 1);
				 jQuery('#end_date').datetimepicker({
					pickTime: false,
					minDate: dateToday,
					defaultDate: dateToday,    
				});
    });
</script>