<?php global $base_url; ?>
<link rel="stylesheet" href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/css/styles_menu_backend.css" />
<?php
drupal_add_js(drupal_get_path('theme', $GLOBALS['theme']) . '/js/script_menu_backend.js', array('scope' => 'footer'));

?>
<section class="dash-sec">
  <div class="dr-wrapper">
    <div class="col-lg-12">
      <div class="dashlinks">
	  <div id="cssmenu">
			
        <ul id="cd-primary-nav" class="cd-primary-nav is-fixed">
           <li><a href="<?php echo $base_url; ?>/dashboard">Dashboard</a></li>
          <!--  <li><a href="#">Messages</a></li>-->
          <li><a href="<?php echo $base_url; ?>/manage/listing">Listing</a></li>
          <li><a href="<?php echo $base_url; ?>/bookings">Reservations</a></li>
          <li><a href="#">Recommendation</a></li>
          <li><a href="<?php echo $base_url; ?>/mytrips">Trips</a></li>
          <li><a href="#">Profile</a></li>
			<!--  <li><a href="#">Accounts</a></li>-->
        </ul>
	
		</div>
      </div>
    </div>
  </div>
</section>
<section class="bg-back">
  <div class="dr-wrapper">
    <div class="col-lg-12 nopadding notifysec">
      <h2>Notifications</h2>
      <div class="botsec">
        <div class="col-md-1"><img alt=" " src="images/clientpic.JPG"></div>
        <div class="col-md-11">
          <!-- <p>Your facebook friend john accepted your initation To Join Gloobers.</p> -->
        <center><p><a href="<?php echo $base_url.'/advice/notification'; ?>"><?php echo $latest_notification; ?></a></p></center>
        </div>
      </div>
    </div>
    <div class="travel-stuf">
      <h3>Traveller activity</h3>
      <div class="col-lg-12 activebar">
        <div class="col-xs-12 col-sm-4 col-md-4">
          <p>Upcoming trips</p>
          <h2><?php  echo $upcoming_trips; ?></h2>
          <!-- <p><span><a href="#">View my upcoming trips</a></span></p> -->
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4">
          <p>Reviews</p>
          <h2><?php if(!empty($reviewCount)){ echo $reviewCount; } else { echo "0";} ?></h2>
          <!-- <p><span><a href="#">View my reviews</a></span></p> -->
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4">
          <p>Credits To Use</p>
          <h2><?php if(!empty($credit_data[0]->credits)){ 
                  echo $credit_data[0]->credits; 
                }
                else{
                  echo "0";
                }

                  ?>
          </h2>
          <p><span>( $ <?php if(!empty($total_credit)){ echo $total_credit; }else{ echo "0";}  ?> )</span></p>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="dr-wrapper">
  <div class="travel-stuf">
    <h3>Advisor activity</h3>
    <div class="col-lg-12 activebar">
      <div class="col-xs-12 col-sm-4 col-md-4">
        <p>Followed recommendations</p>
        <h2>87</h2>
       <!--  <p><span><a href="#">View all my followed recommendations</a></span></p> -->
      </div>
      <div class="col-xs-12 col-sm-4 col-md-4">
        <p>Travel guide</p>
        <h2><?php echo $totaltravelguide; ?></h2>
        <p><span><a href="#">View all my guides</a></span></p>
      </div>
      <div class="col-xs-12 col-sm-4 col-md-4">
        <p>Advisor rank</p>
        <div class="col-lg-12 starrating"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div>
      </div>
    </div>
    <div class="col-lg-12 activebar">
      <div class="col-xs-12 col-sm-4 col-md-4">
        <p>Response rate</p>
        <h2>87%</h2>
      </div>
      <div class="col-xs-12 col-sm-4 col-md-4">
        <p>Credits earned</p>
        <h2><?php if(!empty($credit_data[0]->credits_earned)) { echo $credit_data[0]->credits_earned; } else{ echo "0" ;}  ?></h2>
      </div>
      <div class="col-xs-12 col-sm-4 col-md-4">
        <p>Advisor rank</p>
        <h2>Free</h2>
       <!--  <p><span><a href="#">Go premium</a></span></p> -->
      </div>
    </div>
  </div>
</div>
<section class="bg-back">
  <div class="dr-wrapper">
    <div class="travel-stuf">
      <h3>Professional activity</h3>
      <div class="col-lg-12 activebar">
        <div class="col-xs-12 col-sm-4 col-md-4">
          <p>Ranking</p>
          <h2>87</h2>
          <p><span><a href="#">Boost your listing</a></span></p>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4">
          <p>Monthly Views</p>
          <h2>8</h2>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4">
          <p>Monthly Booking</p>
          <h2>2</h2>
        </div>
      </div>
      <div class="col-lg-12 activebar">
        <div class="col-xs-12 col-sm-4 col-md-4">
          <p>Recommended</p>
          <h2><?php 
                  if(!empty($recommended)){
                    echo $recommended;
                  } else{
                  echo "0";
                  } ?>
          </h2>
          <p><span><a href="#">View who recommended your listing</a></span></p>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4">
          <p>Income this month</p>
          <h2>$3234</h2>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4">
          <p>Upcoming Reservations</p>
          <h2>7</h2>
          <p><span><a href="#">View all upcoming reservations</a></span></p>
        </div>
      </div>
    </div>
  </div>
</section>

