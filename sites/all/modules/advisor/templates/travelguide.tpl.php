<?php  

global $base_url,$user;
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/stylesheet/for-head-foot.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/gloobers.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/landing_page.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/landing_custom.css','file');
 
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/fonts/stylesheet.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/font-awesome.css','file');
//echo "<pre>";print_r($guidedata);exit;

if(!empty($guidedata)){
  if(!empty($guidedata['0']['listings'])){
    $listing = explode( ',',$guidedata['0']['listings']);
  }
}


?>
<div class="travel_custom">
<section class="travel_info">
<div class="container">
<div class="back_btn">
  <a href="#">
    <i>
      <img src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/images/back-icon.png" alt="back" title="" />
    </i>Back
  </a>
</div>
<h2>Create a new travel guide</h2>
<div class="row">
</div>
</div>
</section>
<form id="trevelGuideForm"  method="post" action="<?php echo $base_url.'/advice/save_trevel_guide'; ?>" enctype="multipart/form-data">
<section class="profile_image">
<div class="container">
<div class="row">
	<div class="cover_image cover-outer">
		<div class="simple-cropper-images">
			<div class="cropme">
         <?php 
         if(!empty($guidedata)){
          $file = file_load($guidedata['0']['fid']);
            $imgurl = $file->uri; 
              $style = "experience_topranked_large";
            if(!empty($imgurl)){  
              echo '<img alt=" " src="'.image_style_url($style, $imgurl).'" width="1400px;" height="430px;"></a>';
              }
        }
        ?>
      </div>
		</div>
    	<div class="user_info">
			<!-- <div class="simple-cropper-images">
				<div class="cropme"></div>
              
             
      </div> -->
		</div>
	</div>
</div>
</div>
</section> 


<section class="travel_info">
	<div class="container">
	<div class="row">
    <fieldset>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<h3>Travel Guide Title </h3>
        	<?php if(!empty($guidedata['0']['title'])){echo $guidedata['0']['title']; } ?>
		</div>
        
        <div class="col-md-6 col-sm-6 col-xs-12">
			<h3>Destination </h3>
     <?php if(!empty($guidedata['0']['destination'])){echo $guidedata['0']['destination']; }  ?>
	</fieldset>
	<fieldset>
        <div class="col-md-6 col-sm-6 col-xs-12">
			<h3>Travel Guide Subtitle </h3>
     <?php if(!empty($guidedata['0']['subtitle'])){echo $guidedata['0']['subtitle']; } ?>
		</div>
        
        <div class="col-md-6 col-sm-6 col-xs-12">
			<h3>Recommended for </h3>
       <?php $type = triptype($guidedata['0']['recommended_for']); ?>
        	<?php echo $type; ?>
	</fieldset>
	
    <fieldset>
		<div class="col-md-12 col-sm-12 col-xs-12">
         <h2>Description</h2>
        	<h3>Describe your travel guide</h3>
           <?php if(!empty($guidedata['0']['description'])){echo $guidedata['0']['description'];} ?>
        </div>
	</fieldset>
	</div>
	</div>
</section>

</form>
<section class="travel_info recommendation_block">
	<div class="container">
    <h2>Recommendations</h2>
	<div class="row">
    
    <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="tab-pane">
    <ul class="nav nav-tabs">
    <li><a data-toggle="tab" href="#hotels">Hotels</a></li>
    <li><a data-toggle="tab" href="#rentals">Vacation Rentals</a></li>
    <li><a data-toggle="tab" href="#restaurants">Restaurants</a></li>
    <li class="active"><a data-toggle="tab" href="#experience">Experiences</a></li>
    </ul>
    </div> <!-- End Tab-Pane -->
    </div> <!-- End Col -->
    
    <div class="tab-content">
    	<div id="experience" class="tab-pane fade in active">
	   <?php
      if(!empty($listing)){
      foreach ($listing as $value) {

          $photos = getPhotosData($value);
          $OverviewData = getOverviewData($value);
          $locationDetail = getListingData($value);
    ?>
    <div class="col-md-4 col-sm-6 col-xs-12">
        <fieldset>
        	<div class="recommend_block">
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

			
                <div class="recommend_info">
					<h4><?php echo $OverviewData['title']; ?></h4>
                    <h5><?php echo $locationDetail['city'] .' '.$locationDetail['state'];  ?></h5>
                </div> <!-- End Recommend_Info -->
			</div> <!-- End RecomendBlock -->
            <div class="recommend_detail">
            	<p><i class="fa fa-circle"></i><?php if(!empty($OverviewData['brief_description'])){echo substr($OverviewData['brief_description'],0,80);} ?> </p>
            </div> <!-- End Recommend_Detail -->
            
		</fieldset>
        </div> 
        
      <?php } } ?>  
        
        
        </div> <!-- End #Experiences -->
        </div> <!-- End Tab-Content -->
        

        <div class="clearfix"></div>
  
	</div>
	</div>
</section>


<section class="travel_info">
	<div class="container">
    <h2>Settings</h2>
	<div class="row">
    <fieldset>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<h3>Guide's direct link </h3>
        <?php if(!empty($guidedata['0']['guide_url'])){echo $guidedata['0']['guide_url'];} ?>
		</div>
        
        <div class="col-md-6 col-sm-6 col-xs-12">
			<h3>Privacy </h3>
      <?php if(!empty($guidedata['0']['is_public'])== 'yes'){echo "Public";}else{echo "Private";} ?>
		</div>
	</fieldset>
	
    <fieldset>
		<div class="col-md-12 col-sm-12 col-xs-12">
        	<h3>Embed this guide</h3>
            <textarea name="embedcode"  cols="" rows="" class="embedarea">
             <a href="<?php if(!empty($guidedata['0']['guide_url'])){echo $guidedata['0']['guide_url'];} ?>">Embed this code</a>  
	            </textarea>
           </div>   
  </fieldset>



	</div>
	</div>
</section>
</div> <!-- End Travel_Custom -->


<!--Js Files --> 
<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/js/jquery.min.js"></script>
<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']);?>/js/jquery.selectbox-0.2.js"></script>
<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']);  ?>/js/bootstrap.min.js"></script>

<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']);  ?>/js/jquery.nicescroll.min.js"></script>


<!--Js Functions -->
<script type="text/javascript">
  jQuery(document).ready(function() {
    function listingofguide(){


    }
    jQuery("html").niceScroll();
    jQuery(".nav-dropdown-content").niceScroll();
    jQuery(".select_box").selectbox();
    // Menu Script
    jQuery('.showhide').click(function(e){
      e.preventDefault();
      jQuery('.nav_main_menu').find('ul').toggleClass('dropdwonmenu_remove dropdwonmenu');
    });

    jQuery('.togelsubmenu').click(function(e){
      e.preventDefault();
      jQuery('.nav_main_menu').find('ul li ul').toggleClass('dropdwonmenu_remove1 dropdwonmenu1');
    });
});
function imgError(el) {
        var noImage = $baseUrl + '/' + $globalThemeUrl + '/images/list8.jpg';
        jQuery(el).attr('src', noImage);
    }  
</script>
 <!--  <img src="<?php //print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/images/list8.jpg" alt="" title="" /> -->

<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/js/advisor.js"></script>
