<?php
global $base_path, $user, $base_url;
$data = getUserDetails($user->uid);

$countriesVisited=countryVisited($user->uid);
$reviewCount=getUserReviewsCount($userId);
$hometown = get_user_passeport_hometown();
$userDetails = user_load($user->uid);

if(!empty($guidedata)){
  if(!empty($guidedata['0']['listings'])){
    $listing = explode( ',',$guidedata['0']['listings']);
  }
}

drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/stylesheet/for-head-foot.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/landing_page.css','file');
//drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/landing_custom.css','file');

drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/style_cropper.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/owl.carousel.css','file');
drupal_add_js(drupal_get_path('theme', $GLOBALS['theme']) . '/js/autocomplete.js', array('scope' => 'footer'));

?>
<div class="travel_profile">
<section class="topbar">
  <div class="dr-wrapper">
    <div class="links">
      <ul>
        <li><a href="<?php echo $base_url;?>">Home</a><span>-</span><a href="<?php echo $base_url; ?>/advice/travel_guide">Travel Guide</a><span>-</span><?php echo  strtoupper($guidedata['0']['title']); ?></li>
      </ul>
    </div>
  </div>
</section>
<section class="col-lg-12 user-sec nopadding">
  <div class="dr-wrapper">
    <div class="user-banner">
     <?php 
         if(!empty($guidedata)){
          $file = file_load($guidedata['0']['fid']);
            $imgurl = $file->uri; 
              $style = "guide_image_large";
            if(!empty($imgurl)){  
              echo '<img alt=" " src="'.image_style_url($style, $imgurl).'" title="" /></a>';
              }
              
        }else{
        ?> 

        <img src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/images/user-profile.jpg" alt=" ">
       <?php } ?>
      <div class="user-name">
          <?php
          if ($userDetails->picture != "") {
                                    $file = file_load($userDetails->picture->fid);
                                    //echo $file->uri;exit;
                                    $imgpath = $file->uri;
                                    //$style = "reservation_popup_listing_img";
                                    $style ="homepage_header";
                                    print '<img src="' . image_style_url($style, $imgpath) . '">';     
          }else{?>
          <img src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/images/no-profile-male-img.jpg" alt=" ">
        <?php } ?>
        <p><Span><?php echo $userDetails->field_first_name['und'][0]['value']; ?> 
          </Span><br>
          <?php if(!empty($hometown)){echo $hometown; } ?></p>
          <h4><?php echo $guidedata['0']['title']; ?></h4>
          	<h5>Recommended For</h5>
            	<h6><?php echo triptype($guidedata['0']['recommended_for']); ?></h6>
      </div>
    </div>
    
    <div class="description_block">
    <h2>Description</h2>
    <p><?php echo $guidedata['0']['description']; ?></p>

<!-- <p>Aliquam nonumes recusabo has in, modo patrioque ne per. At quod aeque iudico mei, putent prompta cu pri. Eu eos veniam nusquam moderatius. Ad nonumy tractatos cotidieque sed. Ut vis voluptua dignissim voluptatum, iudico tacimates intellegam te sit.</p> 
 -->    </div> <!-- End Description_block -->
    
    <div class="bg-back2">
    <div class="dr-wrapper">
      <div class="col-lg-12 travpass">
        <h2>Recommended For</h2>
        <div id="owl-demo" class="owl-carousel owl-theme">
        <?php foreach ($passionlist as  $passion) { 
            $file   = file_load($passion['fid']);
            $imgpath = $file->uri;
            $style = 'passion_image';
            $file_thumb   = file_load($passion['fid_thumb']);
            $imgpath_thumb = $file_thumb->uri;
        ?> 
          <div class="col-xs-12 col-sm-12 col-md-12 icontext item">
            <div class="recommend_thumb"><img src="<?php print file_create_url($imgpath_thumb); ?>" alt="" title="" /></div>
            <p><?php echo $passion['passion']; ?></p>
          </div> <!-- End Item -->
        <?php  } ?>
        </div> <!-- End owl-carousel -->
      </div>
    </div>
  </div> 
    <div class="description_block">
      <h2>About <?php  echo $userDetails->field_first_name['und'][0]['value'];  ?></h2>
      <div class="user-image"><?php
          if ($userDetails->picture != "") {
                                    $file = file_load($userDetails->picture->fid);
                                    //echo $file->uri;exit;
                                    $imgpath = $file->uri;
                                    //$style = "reservation_popup_listing_img";
                                    $style ="homepage_header";
                                    print '<img src="' . image_style_url($style, $imgpath) . '">';     
          }else{?>
          <img src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/images/no-profile-male-img.jpg" alt=" ">
        <?php } ?>
      
      		<div class="clearfix"></div>
      	<a href="<?php echo $base_url; ?>/profile/<?php echo $guidedata['0']['owner']; ?>">View full profile</a>
      </div> <!-- End User Image -->
      
       <p><?php echo $data['about_yourself']; ?></p>

<!-- <p>Aliquam nonumes recusabo has in, modo patrioque ne per. At quod aeque iudico mei, putent prompta cu pri. Eu eos veniam nusquam moderatius. Ad nonumy tractatos cotidieque sed. Ut vis voluptua dignissim voluptatum, iudico tacimates intellegam te sit.</p> 
 -->      
    </div>
  </div>
  
  <div class="dr-wrapper">
    <div class="mapinfo">
      <div class="col-lg-12">
        <div class="col-xs-12 col-sm-4 col-md-4 mapblock">
          <p>Hometown <br>
            <span class="hometext"><?php echo $hometown; ?></span></p>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 mapblock">
          <p>Countries visited <br>
            <span class="numtext"><?php echo  sizeof($countriesVisited); ?></span></p>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 mapblock">
          <p>Reviews <br>
            <span class="numtext"><?php echo $reviewCount; ?></span></p>
        </div>
      </div>
    </div>
  </div>
  <div class="bg-back2 recommendation_block">
    <div class="dr-wrapper">
      <div class="col-lg-12 nopadding">
        <div class="list-stuf">
          <h2>Recommendations</h2>
          
          <div class="col-md-12 col-sm-12 col-xs-12">
				<div class="tab-pane">
					<ul class="nav nav-tabs">
						<li><a data-toggle="tab" href="#hotels">Hotels</a></li>
						<li><a data-toggle="tab" href="#rentals">Vacation Rentals</a></li>
						<li><a data-toggle="tab" href="#restaurants">Restaurants</a></li>
						<li class="active"><a data-toggle="tab" href="#experience">Experiences</a></li>
					</ul>
				</div> <!-- End Tab-Pane -->
			</div>
          
          <div class="col-md-6 tagline">

         <?php
          if ($userDetails->picture != "") {
                                    $file = file_load($userDetails->picture->fid);
                                    //echo $file->uri;exit;
                                    $imgpath = $file->uri;
                                    //$style = "reservation_popup_listing_img";
                                    $style ="homepage_header";
                                    print '<img src="' . image_style_url($style, $imgpath) . '">';     
          }else{?>
          <img src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/images/no-profile-male-img.jpg" alt=" ">
        <?php } ?>
            <p>reviewed this listing</p>
          </div>
          
          <div class="tab-content">
          <div class="tab-pane fade in active" id="experience">
             <?php
                if(!empty($listing)){
                  foreach ($listing as $value) {

                      $photos = getPhotosData($value);
                      $OverviewData = getOverviewData($value);
                      $locationDetail = getListingData($value);


              ?>

          <div class="col-xs-12 col-sm-6 col-md-4 sectionlist">
            <div class="blocklist"> 
              <?php  if (count($photos) > 0) { 

               $photo = unserialize($photos[0]["value1"]);
                                                    $file = file_load($photo["fid"]);
                                                    $imgpath = $file->uri;
                                                    $style = 'experience_topranked_large';
                 echo '<img src="'.image_style_url($style, $imgpath).'" alt="place" onError="imgError(this)" class= "img-height"/>';
                                                                                                      
                                                //}
                                            } else {
                                                     
                                                    echo '<img src="'.base_path() .drupal_get_path("theme", "gloobers").'"/images/img/place1.png" alt="place" class="img-height" />';
                                                     
                                                }                                    

              ?>              
              <div class="listpro">
                <?php 
                  $profile_pic_id =  $OverviewData['uid'];
                  $listing_owner = user_load($profile_pic_id);

                  if ($listing_owner->picture != "") {
                                            $file = file_load( $listing_owner->picture->fid);
                                            //echo $file->uri;exit;
                                            $imgpath = $file->uri;
                                            //$style = "reservation_popup_listing_img";
                                            $style ="homepage_header";
                                            print '<img src="' . image_style_url($style, $imgpath) . '">';     
                  }else{?>
                  <img  src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/images/no-profile-male-img.jpg" alt=" ">
                <?php } ?>
                        
                

            
                </div>
            </div>
            <div class="listname">
              <h3><?php echo $OverviewData['title']; ?></h3>
              <p><?php echo $locationDetail['city'] .' '.$locationDetail['state'];  ?></p>
            </div>
            
            <div class="recommend_detail">
            	<p><i class="fa fa-chevron-right"></i><i class="fa fa-chevron-right"></i>  Amazing place , fantastic host. Area full of little restaurant, and only 2 blocks away from the conference center <i class="fa fa-chevron-left"></i><i class="fa fa-chevron-left"></i> </p>
                 <div class="user-image"> <img src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/images/no-profile-male-img.jpg" class="img-circle size-img" alt=" ">  <span>Matt</span></div>
            </div>

          </div>
          <?php } }?>
         
        
          </div> <!-- End #experience -->
          </div> <!-- End Tab-Content -->
        </div>
      </div>
    </div>
  </div>
  <div class="dr-wrapper">
    <div class="col-lg-12 nopadding">
      <div class="guide-travel">
        <h2><?php  echo $userDetails->field_first_name['und'][0]['value']; ?> Other Travel guides</h2>
        <?php  foreach ($otherguide as $value) { ?>
        <div class="col-xs-12 col-sm-6 col-md-6 travelblock"> 
           <?php $file = file_load($value['fid']);
                                        $imgurl = $file->uri; 
                                        $style = "guide_image";

                                    if(!empty($imgurl)){  
                                        echo '<img alt=" " src="'.image_style_url($style, $imgurl).'"></a>';
                                        }else{

                                         echo '
                                            <img src="'.$base_url . '/' . drupal_get_path('theme', 'gloobers_new'). '/images/default_travel_guide_img.jpg">
                                        ';

                                    }
            ?>                          

          <div class="listdetail">
            <div class="click"><a class="listicon" href="#"><span></span><span></span><span></span></a></div>
            <div class="listview" style="display:none;">
              <ul>
                <li><a href="#"><i class="fa fa-link"></i>Recommend to a friend</a></li>
                <li><a href="#"><i class="fa fa-heart"></i>Add to wishlist</a></li>
                <li><a href="#"><i class="fa fa-plus"></i>Add to guide</a></li>
                <li><a href="#"><i class="fa fa-eye"></i>View details</a></li>
                <li><a href="#"><i class="fa fa-flag-o"></i>Report this listing</a></li>
                <li><a href="#"><i class="fa fa-arrows-h"></i>Embed on my website</a></li>
              </ul>
            </div>
          </div>
          <div class="guidesec">
            <h3><?php echo $value['title'] ?></h3>
            <p class="text"><?php echo $value['subtitle']; ?></p>
            <div class="topspace">
              <p>Recommended for<br>
                <span><?php echo triptype($value['recommended_for']); ?></span></p>
            </div>
          </div>
        </div>
         <?php  } ?>        
      </div>
    </div>
    
    
  </div>
</section>

<div class="modal fade" id="recommend" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="padding-right:0px !important;">
  <div class="modal-dialog recommend">
    <div class="recommend2">
      <div class="modal-content loginpop">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="exampleModalLabel">New message</h4>
          <p>You Are About To Recommend This Listing To A friend. You Will Be Notified As Soon As Your Friend Follows Your
            Recommendation And Rewarded After He Reviewed His Trip.</p>
        </div>
        <div class="modal-body">
          <div class="tabbable">
            <ul class="nav nav-tabs">
              <li><a href="#tab1" data-toggle="tab">Share A Link</a></li>
              <li class="active"><a href="#tab2" data-toggle="tab">Add To</a></li>
              <li><a href="#tab3" data-toggle="tab">Embed</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab1">
                <form>
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">A Travel Guide</label>
                    <input type="text" class="form-control" id="recipient-name">
                  </div>
                  <div class="form-group">
                    <label for="message-text" class="control-label">Add Your Comment</label>
                    <textarea class="form-control" id="message-text">Why do you recommend this listing?</textarea>
                  </div>
                </form>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-default btncncl" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary btnsend">Send</button>
                </div>
              </div>
              <div class="tab-pane active" id="tab2">
                <form>
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">A Travel Guide</label>
                    <input type="text" class="form-control" id="recipient-name">
                  </div>
                </form>
              </div>
              <div class="tab-pane active" id="tab3">
                <form>
                  <div class="form-group">
                    <label for="message-text" class="control-label">Add Your Comment</label>
                    <textarea class="form-control" id="message-text">Why do you recommend this listing?</textarea>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/js/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']);  ?>/js/html5shiv.js" type="text/javascript"></script> 
<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']);  ?>/js/jquery.meanmenu.js" type="text/javascript"></script> 
<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/js/owl.carousel.js"></script>

<script type="text/javascript">
jQuery(document).ready(function() {
  var owl = jQuery("#owl-demo");
  owl.owlCarousel({
      items : 4, //10 items above 1000px browser width
      itemsDesktop : [1000,3], //5 items between 1000px and 901px
      itemsDesktopSmall : [900,2], // betweem 900px and 601px
      itemsTablet: [600,1], //2 items between 600 and 0
      itemsMobile : false // itemsMobile disabled - inherit from itemsTablet option
  });
 
  // Custom Navigation Events
  jQuery(".next").click(function(){
    owl.trigger('owl.next');
  });
  jQuery(".prev").click(function(){
    owl.trigger('owl.prev');
  });
 
  jQuery('nav').meanmenu();

/************** for filter toggle **************/		

jQuery(".filterbutton").click(function(){
jQuery(".formsec").slideToggle("slow");
});	


/************** for filter toggle **************/		

jQuery(".clickarrow").click(function(){
jQuery(".checksec").slideToggle("slow");
});	


/************** for options toggle **************/

jQuery(".listicon").click(function(event){
 event.preventDefault();
 jQuery(this).parent().parent().find(".listview").slideToggle("slow");
 
});


jQuery('#recommend').on('show.bs.modal', function (event) {
  var button = jQuery(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  var modal = jQuery(this)
  modal.find('.modal-title').text('Recommend << Big Five Safari >> To A Friend' + recipient)
  //modal.find('.modal-body input').val(recipient)
})

});
</script>