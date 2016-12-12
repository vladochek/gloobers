<?php
drupal_add_css(drupal_get_path('theme', 'gloobers') .'/css/fullcalendar.css','file');
drupal_add_js(drupal_get_path('theme', 'gloobers') .'/js/moment.min.js',array('scope' => 'footer'));
drupal_add_js(drupal_get_path('theme', 'gloobers') .'/js/fullcalendar.min.js',array('scope' => 'footer'));
drupal_add_css(drupal_get_path('theme', 'gloobers') .'/css/experience-listing.css','file'); 
/*  echo "<pre>";
print_r($scheduleSessionData); die;  */
$events = array();
foreach($scheduleSessionData as $data){
	if($data["repeatPeriodBy"] == 'DoNOt'){
		$events['title'] = 'Book Now';
		$events['start'] = $data["startDate"];
		$events['end'] = $data["endDate"];
	}
	else{
		$events['title'] = 'Book Now';
		$events['start'] = $data["startDate"];
		$events['end'] = $data["endRepeatDate"];		
	}
}

?>
<style>

	body {
		margin: 40px 10px;
		padding: 0;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		font-size: 14px;
	}

	#calendar {
		float: left;
		margin: 75px auto 0 100px;
		max-width: 1024px;
	}
	

</style>
<div id="calendar"></div>

<script>
	var jq = jQuery.noConflict();
	jq(document).ready(function() {

		jq('#calendar').fullCalendar({
			theme: true,
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			defaultDate: '2014-09-12',
			editable: false,
			eventLimit: false, // allow "more" link when too many events
			events: [<?php echo json_encode($events); ?>]
		});
		
	});

</script>