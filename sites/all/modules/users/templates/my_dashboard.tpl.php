<?php global $base_url; ?>
<link rel="stylesheet" href="<?php echo $base_url.'/'.drupal_get_path('theme',$GLOBALS['theme']) ?>/css/landing_page.css">
<link rel="stylesheet" href="<?php echo $base_url.'/'.drupal_get_path('theme',$GLOBALS['theme']) ?>/css/gloobers.css">

<link rel="stylesheet" href="<?php echo $base_url.'/'.drupal_get_path('theme',$GLOBALS['theme']) ?>/css/landing_custom.css">
<link rel="stylesheet" href="<?php echo $base_url.'/'.drupal_get_path('theme',$GLOBALS['theme']) ?>/stylesheet/for-head-foot.css">

<section class="bg-back">
  <div class="container1">
    <div class="col-lg-12 nopadding notifysec">
      <h2>Notifications</h2>
      <div class="botsec">
        <!-- <div class="col-md-1"><img alt=" " src="images/clientpic.JPG"></div> -->
        <div class="col-md-12">
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
                  echo $credit_data[0]->credits.' (gloobies)'; 
                }
                else{
                  echo "0 (gloobies)";
                }
      $creditperdollar=variable_get('credit_value');
      $creditsTouse=$credit_data[0]->credits;
      $dollarsTouse=($creditsTouse/$creditperdollar);
      
             ?>
          </h2>
          <p><span>( $ <?php echo number_format(floor($dollarsTouse*100)/100,2, '.', '');  ?> )</span></p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- <div class="dr-wrapper">
  <div class="travel-stuf">
    <h3>Advisor activity</h3>
    <div class="col-lg-12 activebar">
      <div class="col-xs-12 col-sm-4 col-md-4">
        <p>Followed recommendations</p>
        <h2>N/A</h2>      
      </div>
      <div class="col-xs-12 col-sm-4 col-md-4">
        <p>Travel guide</p>
        <h2><?php echo $totaltravelguide; ?></h2>      
      </div>
     <div class="col-xs-12 col-sm-4 col-md-4">
        <p>Advisor rank</p>
        <div class="col-lg-12 starrating">N/A</div>
      </div>
    </div>
    <div class="col-lg-12 activebar">
      <div class="col-xs-12 col-sm-4 col-md-4">
        <p>Response rate</p>       
        <h2>N/A</h2>
      </div>
      <div class="col-xs-12 col-sm-4 col-md-4">
        <p>Credits earned</p>
        <h2><?php if(!empty($credit_data[0]->credits_earned)) { echo $credit_data[0]->credits_earned; } else{ echo "0" ;}  ?></h2>
      </div>     
      </div>
    </div>
  </div> -->

</div>
<section class="bg-back">
  <div class="">
    <div class="travel-stuf">
      <h3>Professional activity</h3>
      <div class="col-lg-12 activebar">
        <!-- <div class="col-xs-12 col-sm-4 col-md-4">
          <p>Ranking</p>
           <h2>N/A</h2>           
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4">
          <p>Monthly Views</p>
          <h2>N/A</h2>
        </div> -->
        <div class="col-xs-12 col-sm-4 col-md-4">
          <p>Monthly Booking</p>
          <h2><?php 
              if(!empty($monthly_booking)){
                  echo $monthly_booking;
              }
              else{
                  echo "0";
              }

          ?></h2>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4">
          <p>Recommended</p>
          <h2><?php 
                  if(!empty($recommended)){
                    echo $recommended;
                  } else{
                  echo "0";
                  } ?>
          </h2>
          </div>
        <div class="col-xs-12 col-sm-4 col-md-4">
          <p>Income this month</p>
          <h2><?php if(!empty($monthly_income)){
              echo "$".$monthly_income;
          } 
          else{
              echo "$ 0";
          }

          ?>

          </h2>
        </div>
      </div>
      <div class="col-lg-12 activebar">        
       <!--  <div class="col-xs-12 col-sm-4 col-md-4">
          <p>Upcoming Reservations</p>
          <h2>N/A</h2>          
        </div> -->
      </div>
    </div>
  </div>
</section>