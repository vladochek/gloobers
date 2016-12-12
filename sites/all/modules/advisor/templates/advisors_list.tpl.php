<?php

global $base_url;

$adviceStatus = 0;

$advisorSearch = $_SESSION['advisor_search'];

if (isset($advisorSearch['location']) && $advisorSearch['location'] != "") {

    $location = trim($advisorSearch['location']);

}





//Add inline css 
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/stylesheet/for-head-foot.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/landing_page.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/gloobers.css','file');
drupal_add_css(

        '.dropdown-menu{ left:23px; } 

        .treveller-menu-a { float:left; margin-left:10px; padding:5px; } 

        .treveller-menu-opt{ position:relative; padding:5px; } 

        .trip_date_time{ margin-left:10px;  margin-bottom:5px;} 

        .dropdown-menu{ z-index:99!important; } ',

         array(

    'group' => CSS_THEME,

    'type' => 'inline',

    'media' => 'all',

    'preprocess' => FALSE,

    'every_page' => FALSE,

    'weight' => '9999',

        )

);
$recommendation_link=generate_link();
?>



<section class="topbar">

    <div class="dr-wrapper">

        <div class="headbar headbar2 col-xs-offset-3">

            <ul>

               <li><a href="javascript:void(0)">Hotels</a></li>

                <li><a href="javascript:void(0)">Vacations rentals</a></li>

                <li><a href="javascript:void(0)">Restaurants</a></li>

                <li class="active"><a href="javascript:void(0)">Experiences</a></li>

            </ul>

        </div>

    </div>

</section>



<!-- FILTERS FOR FINDING ADVISOR -->

<div class="dr-wrapper" id="_finder_form_container">

    <div class="col-lg-12 finder-form">

        <form id="_advisor_form_el">  

            <div class="col-md-2 col-sm-6 col-xs-12 desti">

                <input id="_trip_loction" name="trip_loction" type="text" value="Destination" onfocus="if (this.value == 'Destination') {

                            this.value = '';

                        }

                       " onblur="if (this.value == '') {

                                   this.value = 'Destination';

                               }

                       ">

            </div>



            <div class="col-md-2 col-sm-6 col-xs-12 trip-filter">

                  <a class="trip_type"  href="#">                   

                <h2>TYPE OF TRIP</h2>

                <p>

                Select a type of trip<br>

                

                    <i class="fa fa-chevron-down"  href="#"></i>

              </p>

              </a>



                

                <ul id="_trip" class="dropdown-menu trip_popup" role="menu" aria-labelledby="dropdownMenu">

                    <?php foreach ($tripType as $trip): ?>

                        <li><a tabindex="-1" href="#"><input type="radio" name="trip_type" value="<?php echo $trip['trip_id']; ?>"> <?php echo '<label>'.$trip['trip_type'].'</label>'; ?></a></li>

                    <?php endforeach; ?>

                </ul>

            </div>



            <div class="col-md-2 col-sm-6 col-xs-12 trip-filter">

             <a href='#' class="date_type">   <h2>Date</h2>

                <p style="min-height: 42px;">Select date <i class="fa fa-calendar-o" id="abc" href="#"></i> </p></a>

                <ul id="_trip" class="dropdown-menu date_popup" role="menu" aria-labelledby="dropdownMenu">

                   <li><div class="trip_date_time">From : <input type="text" id="start_date" data-date-format="YYYY/MM/DD" name="start_date"/></p></div>
                   <li><div class="trip_date_time">To: <input type="text" id="end_date" data-date-format="YYYY/MM/DD" name="end_date"/></p></div>  

                </ul>

            </div>



            <div class="col-md-2 col-sm-6 col-xs-12 trip-filter">

                 <a class="travellers_type"  href="#">   

                <h2>Travellers</h2>

                <p>Add travellers<br>

                    <i class="fa fa-chevron-down" href="#"></i>

                </p>

                </a>

                <ul id="_counselors" class="dropdown-menu travellers_popup " role="menu" aria-labelledby="dropdownMenu">

                    <li>

                        <p>

                            <!-- <a tabindex="-1" href="#" class="treveller-menu-a">Trevellers </a> --> 

                            <a tabindex="-1" href="#" class="treveller-menu-a">Adults</a> 

                            <select class="treveller-menu-opt" name="travellers_adults">

                                <option value="0">Select</option>

                                <?php for ($i = 1; $i <= 10; $i++) { ?>

                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>

                                <?php } ?>

                            </select>

                           

                        </p>
 
                    </li>

                    <li>

                        <p>

                            <a tabindex="-1" href="#" class="treveller-menu-a">Childs</a> 

                            <select class="treveller-menu-opt" name="travellers_childs">

                                <option value="0">Select</option>

                                <?php for ($i = 1; $i <= 10; $i++) { ?>

                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>

                                <?php } ?>

                            </select>

                           

                        </p>

                    </li>    

                </ul>

            </div>



            <div class="col-md-2 col-sm-6 col-xs-12 trip-filter">

            <a class="counslers_type" href="#">

                <h2>Counselors</h2>

                <p>Select counselors form<br>

                    <i class="fa fa-chevron-down " href="#"></i>



                </p>

                </a>

                <ul id="_counselors" class="dropdown-menu counselors_popup" role="menu" aria-labelledby="dropdownMenu">

                    <!-- <li><a tabindex="-1" href="#"><input type="checkbox" id="1"  value="facebook_friends" class="css-checkbox" name="counselors[]"> <label class="css-label lite-green-check" for="1">Facebook Friends</label></a></li>    

              -->       <li><a tabindex="-1" href="#"><input type="checkbox" id="2"  value="with_mutual_interest" class="css-checkbox" name="counselors[]"> <label class="css-label lite-green-check" for="2">With Mutual Interest</label></a></li>    

                    <li><a tabindex="-1" href="#"><input type="checkbox" id="3"  value="have_been_there" class="css-checkbox" name="counselors[]"> <label class="css-label lite-green-check" for="3">Have been there</label></a></li>    

                    <li><a tabindex="-1" href="#"><input type="checkbox" id="4"  value="locals" class="css-checkbox" name="counselors[]"> <label class="css-label lite-green-check" for="4">Locals</label></a></li>    

                </ul>

            </div>



            <div class="col-md-2 col-sm-6 col-xs-12 search">

                <input id="_filter_search_advisor" name="" type="button" class="filterbutton" value="Search">

            </div>

        </form>

    </div>

</div>

<!-- <div class="fa fa-facebook fb-share-button" data-href="http://staging.gloobers.net/experience/56?refer=TZl4FSK3G5y69uJOMpKgNHz5VGGlne&uid=MQ==" data-layout="button"></div> -->

<section class="bgback4">

    <div class="dr-wrapper">

        <div class="find-banner">

            <h2>Select Your Counselors</h2>

            <p>Get personal recommendations from your friends or gloobers like you</p>

            <h3>Your Request's Link</h3>
			<input type="text" readonly value="<?php echo $recommendation_link;?>">
           <ul>
			<li>
			<a class="fa fa-twitter" target="_blank" href="https://twitter.com/home?status=<?php echo $recommendation_link; ?>">
			</a></li>
            <li> <a class="fa fa-envelope-o" href="mailto:?&subject=Signup link&body=Hey%20Signup%20from%20here%20on%20Gloobers%20and%20travel%20anywhere%20in%20world.<?php echo $recommendation_link; ?>"></a></li>
			
			<!--<li>
			<a href="mailto:?&body=%3Ca%20href=%22mailto%3Aemail%40gmail.com?%26subject=Signup%20link%26body=%3Ctable%3E%0A%3Ctr%3E%0A%3Ctd%3EHelo%0A%3C/td%3E%0A%3Ctd%3EHelo%0A%3C/td%3E%0A%3Ctd%3EHelo%0A%3C/td%3E%0A%3C/tr%3E%0A%0A%3C/table%3E%0A%0A%22%3ESend%20Email%3C/a%3E">Send Email</a>
			</li>--->
			<li><a class="fa fa-google-plus" target="_blank" href="https://plus.google.com/share?url=<?php echo $recommendation_link;?>"></a></li>
			<li>
			<a class="fa fa-facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $recommendation_link;?>"></a>
			<!--<div class="fb-share-button" data-href="<?php //echo $recommendation_link;?>" data-layout="button"></div></li>
-->
            </ul>

        </div>

    </div>

</section>





<div id="_advisorListingBoard" class="col-md-12">

    <div class="advisor-init-message">

        <h1>See Advisor opinion's. Why don't you search for Advisors</h1>

        <a href="javascript:void(0)" id="_search_advisor_anchor">Click here to search</a>

    </div>

</div>



<!--MODAL FOR MESSAGE AND SEND REQUEST TO SELECTED ADVISOR-->

<div id="modal_advisor_request" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <form id="advisor_request_form">  

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                    <h4 class="modal-title" id="exampleModalLabel">Advisor Request</h4>

                </div>

                <div class="modal-body">

                    <div class="form-group">

                        <label for="recipient-name" class="control-label">Recipient:</label>

                        <input type="text" class="form-control" id="recipient-name" readonly="readonly" name="recipient-name">

                    </div>

                    <div class="form-group">

                        <label for="message-text" class="control-label">Message:</label>

                        <textarea class="form-control" id="message-text" required="required" name="message"></textarea>

                        <input type="hidden" name="filter_advisor_input" id="filter_advisor_input">

                        <input type="hidden" name="advisor_uid" id="advisor_uid">

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    <input type="submit" class="btn btn-primary" value="Send message" data-loading-text="Sending...">

                </div>

            </form>

        </div>

    </div>

</div>

<!--END OF MODAL-->
<?php

//Add required js 

$file = $base_url . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/js/advisor.js';

drupal_add_js($file, array(

    'type' => 'external',

    'scope' => 'footer',

    'group' => JS_THEME,

    'every_page' => FALSE,

    'weight' => -1,

));



$timepickerjs = $base_url . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/js/bootstrap-datetimepicker.js';



drupal_add_js($timepickerjs, array(

    'type' => 'external',

    'scope' => 'footer',

    'group' => JS_THEME,

    'every_page' => FALSE,

    'weight' => -1,

));

?>

<script type ="text/javascript">

 jQuery('.trip_type').on('click', function () {

    

      jQuery('.date_popup').hide();

      jQuery('.travellers_popup').hide();

      jQuery('.counselors_popup').hide();

      jQuery('.trip_popup').show();

     

     });

     jQuery('.date_type').on('click', function () {

     

      jQuery('.trip_popup').hide();

      jQuery('.travellers_popup').hide();

      jQuery('.counselors_popup').hide();

      jQuery('.date_popup').show();

     

     });

     jQuery('.travellers_type').on('click', function () {

     

      jQuery('.date_popup').hide();

      jQuery('.trip_popup').hide();

      jQuery('.counselors_popup').hide();

       jQuery('.travellers_popup').show();

     

     });

     jQuery('.counslers_type').on('click', function () {

     

      jQuery('.date_popup').hide();

      jQuery('.travellers_popup').hide();

      jQuery('.trip_popup').hide();

      jQuery('.counselors_popup').show();

      

     });
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