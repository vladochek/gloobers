<?php 

global $base_url;

$id = arg(2);



$finder= user_load($id);

$finder_location = getUserDetails($id); 

// echo "<pre>";print_r($finder_location); exit;

drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/stylesheet/for-head-foot.css','file');



?>



<link href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/stylesheet/bootstrap.min.css" rel="stylesheet" type="text/css" />

<link href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/fonts/stylesheet.css" rel="stylesheet" type="text/css" />

<link href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/stylesheet/style.css" rel="stylesheet" type="text/css" />

<link href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/stylesheet/font-awesome.css" rel="stylesheet" type="text/css" />



<section class="content-section">

<div class="container-fluid">

<div class="row">

<div class="col-md-12 pageimage">

<div class="col-md-11 col-md-offset-1 col-sm-12">

	<div class="userprofilereq">

		<!--<img src="images/advisor_pic.jpg" alt="" title="" /> -->

		 <?php 

                                if ($finder->picture != "") {

                                    $file = file_load($finder->picture->fid);

                                    //echo $file->uri;exit;

                                    $imgpath = $file->uri;

                                    $style = "advisor_profile_pic";

                                   print '<img class="img-circle" src="' . image_style_url($style, $imgpath) . '" alt="display pic">';

                                  //  print '<img src="' . $file->uri . '" class="img-circle size-img" alt="img">';

                                }else{ 

                                    print '<img src="' . base_path() . drupal_get_path('theme', $GLOBALS['theme']) . '/images/no-profile-male-img.jpg" class="img-circle" alt="display pic" />';

                                } ?>



	</div><!-- End UserProfileReq --> 

</div><!-- End Col -->

<div class="col-md-4 col-sm-4 col-xs-12"><h2><?php echo $finder->field_first_name['und'][0]['value'];   ?></h2><h4>

	<?php echo $finder_location['city'] ." ".$finder_location['state'];  ?>

</h4></div> <!-- End Col -->

<div class="col-md-4 col-sm-4 col-xs-12"><h2><a href="<?php echo $base_url; ?>/profile/<?php echo $id; ?>">View Profile</a></h2></div> <!-- End Col -->

<div class="col-md-4 col-sm-4 col-xs-12"><h2>Open</h2>

<!-- <h4>3 days ago</h4> -->

</div> <!-- End Col -->

<div class="mask"></div> <!-- End Mask -->

</div> <!-- End PageImage -->

</div> <!-- End Row -->

</div> <!-- End Container-Fluid -->

</section> <!-- End Content-Section -->



<section class="requestdetail">

<div class="container">

<h2>Request's details</h2>



<div class="col-md-12 detailrow">

<div class="col-md-4 col-sm-4 col-xs-12"> <h3>Recommendation needed</h3> <h4><?php echo $_GET['looking_for']; ?></h4> </div> <!-- End Col -->

<div class="col-md-4 col-sm-4 col-xs-12 seperator"> <h3>Destination</h3> <h4><?php echo $_GET['dest']; ?></h4> </div> <!-- End Col -->

<div class="col-md-4 col-sm-4 col-xs-12">

<div class="col-md-6 col-sm-6 col-xs-12"><h3>Arrival</h3> <h4><?php echo $_GET['start_date']; ?></h4> </div> <!-- End Col -->

<div class="col-md-6 col-sm-6 col-xs-12"><h3>Departure</h3> <h4><?php echo $_GET['end_date']; ?></h4> </div> <!-- End Col -->

</div> <!-- End ArriveDeaprtDate -->

</div> <!-- End Deatil Row -->



<div class="col-md-12 detailrow">

<div class="col-md-4 col-sm-4 col-xs-12"> <h3>Type of trip </h3> <h4><?php echo triptype($_GET['triptype']);?></h4> </div> <!-- End Col -->

<div class="col-md-4 col-sm-4 col-xs-12 seperator"> <h3>Travellers</h3> <h4><?php echo $_GET['traveler']; ?></h4> </div> <!-- End Col -->

<div class="col-md-4 col-sm-4 col-xs-12"> <h3>Budget</h3> <h4>$<?php echo $_GET['overall_budget'];?></h4> </div> <!-- End Col -->

</div> <!-- End Deatil Row -->



<!-- <div class="col-md-12 detailrow">

<h3>Message</h3> 

<p>Hi, we are coming with our family for five days and we would like to find some activities that would fit all the family. Our Children are 9 and 6 and we love outdoor experiences.</p>

</div> <!-- End Deatil Row -->



<div class="col-md-12 detailrow"> 

<?php

// destination=India&triptype=2&traveler=3&start_date=11/04/2015&end_date=11/27/2015&overall_budget=1000&looking_for=experience

 $url = "dest=".$_GET['dest']."&triptype=".$_GET['triptype']."&traveler=".$_GET['start_date']."&start_date=".$_GET['start_date']."&end_date=".$_GET['end_date']."&overall_budget=".$_GET['overall_budget']."&looking_for=".$_GET['looking_for'];

 



?>

 <a class="button btn" href="<?php echo $base_url; ?>/advisor_listing_results?<?php echo $url;  ?>" >Search</a>

	<!-- <input type="submit" name="search" value="Search" />  -->

</div> <!-- End Col -->

</div> <!-- End Container -->

</section> <!-- End RequestDetail -->











