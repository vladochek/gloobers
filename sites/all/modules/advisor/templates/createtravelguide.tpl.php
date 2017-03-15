<?php  

global $base_url,$user;
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/fonts/stylesheet.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/font-awesome.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/gloobers.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/landing_page.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/landing_custom.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/stylesheet/for-head-foot.css','file');



//echo "<pre>";print_r($travel_guide_data);exit;
if(!empty($travel_guide_data)){
  if(!empty($travel_guide_data['0']['listings'])){
    $listing = explode( ',',$travel_guide_data['0']['listings']);
  }
}
?>

<div class="travel_custom">
<?php
if(isset($_SESSION['notify'])) { 
    $notifyHtml.= '<div class="col-md-12 col-sm-12 col-xs-12 autohidediv"><section class="requestrecive">';
    $notifyHtml.='<div class="alert alert-'.$_SESSION['notify']['status'].'"><i class="fa fa-check"></i> '.$_SESSION['notify']['message'].'</div>' ;
    $notifyHtml.='</section></div>';
    echo $notifyHtml;
    unset($_SESSION['notify']);
} 
?>
<section class="travel_info">
<div class="container">
<div class="back_btn">
  <a href="<?php echo $base_url ?>/advice/travel_guide">
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
			<div class="cropme" >
         <?php 
         if(!empty($travel_guide_data)){
          $file = file_load($travel_guide_data['0']['fid']);
            $imgurl = $file->uri; 
              $style = "experience_topranked_large";
            if(!empty($imgurl)){  
              echo '<img alt=" " src="'.image_style_url($style, $imgurl).'" width="1400px;" height="430px;"></a>';
              }
              // else{

              //  echo '
              //     <img src="'.$base_url . '/' . drupal_get_path('theme', 'gloobers'). '/images/thumb1.jpg">
              // ';

         //}
        }
        ?>
      </div>
		</div>
    	<div class="user_info">
			<div class="simple-cropper-images">
				<div class="cropme"></div>
              
              <?php if(isset($_REQUEST['tgid'])){ ?>
                <div class="filebrowse">
                <input type="button" name="guide_image" class="button text-uppercase" value="Update Picture" />
                <input type="file" name="guide_image" class="button text-uppercase" value="Update Picture" />
              </div>

               <?php  }else {?>
               <div class="filebrowse">
                <input type="button" name="guide_image" class="button text-uppercase" value="Upload Picture" />
                <input type="file" name="guide_image" class="button text-uppercase" value="Upload Picture" />
              </div>
			       
              <?php  }?>  
      </div>
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
        	<input type="text" name="title" value="<?php if(!empty($travel_guide_data['0']['title'])){echo $travel_guide_data['0']['title']; } ?>" placeholder="Enter Title" />
		</div>
        
        <div class="col-md-6 col-sm-6 col-xs-12">
			<h3>Destination </h3>
        	<input type="text" name="destination" value="<?php if(!empty($travel_guide_data['0']['destination'])){echo $travel_guide_data['0']['destination']; }  ?>"  id="destination" onclick="hometowngeocode();" placeholder="Related destination" />
		</div>
	</fieldset>
	<fieldset>
        <div class="col-md-6 col-sm-6 col-xs-12">
			<h3>Travel Guide Subtitle </h3>
        	<input type="text" name="subtitle" value="<?php if(!empty($travel_guide_data['0']['subtitle'])){echo 
            $travel_guide_data['0']['subtitle']; } ?>" placeholder="Enter Subtitle" />
		</div>
        
        <div class="col-md-6 col-sm-6 col-xs-12">

			<h3>Recommended for </h3>
        	<select name="recommendedfor" class="select_box">
          <option value="">--Select --</option>
          <?php foreach ($triptype as  $value) { 
              $selected = "";
              if($travel_guide_data['0']['recommended_for'] == $value['trip_id']){
                $selected = "selected='selected'";
              }else{
                $selected = "";
              }

            ?>
<option value="<?php echo $value['trip_id']; ?>" <?php echo $selected; ?> ><?php echo $value['trip_type'];  ?></option>
          <?php  } ?>    
        	</select>
		</div>
	</fieldset>
	
    <fieldset>
		<div class="col-md-12 col-sm-12 col-xs-12">
         <h2>Description</h2>
        	<h3>Describe your travel guide</h3>
            <textarea name="description" cols="" rows="" placeholder="What makes this guide unique?"><?php if(!empty($travel_guide_data['0']['description'])){echo $travel_guide_data['0']['description'];} ?></textarea>
        </div>
	</fieldset>
	</div>
	</div>
</section>


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
            	<p><i class="fa fa-circle"></i> <?php if(!empty($OverviewData['brief_description'])){
                echo substr($OverviewData['brief_description'],0,80);} ?></p>
            </div> <!-- End Recommend_Detail -->
            <a href="javascript:void(0);" data-list="<?php echo $value; ?>" data-travel="<?php echo base64_encode($_REQUEST["tgid"]); ?>" class="delete_link delete_listing_id">Delete this listing</a>
		</fieldset>
        </div> 
        
      <?php } }else{  ?>
          <div class="blankrow text-center">  
            <h4>No listing found</h4>
          </div>  
        <?php } ?>
        </div> <!-- End #Experiences -->
        </div> <!-- End Tab-Content -->
        

        <div class="clearfix"></div>
        <?php if(isset($_REQUEST['tgid'])){?>
        <fieldset class="text-center">  
        <a href="<?php echo $base_url;?>/add_listing_to_guide/<?php echo $travel_guide_data['0']['destination'];?>/<?php echo $_REQUEST['tgid']; ?>"> 
        <input type="button" class="button submit_add_button" value="Add a Listing" /> </a> 
        </fieldset>
        <?php  }else { ?>
        <fieldset class="text-center">  
        <a href="javascript:void(0);" title="You can not add listing until you create travel guide."> 
        <input type="button" class="button submit_add_button" value="Add a Listing" /> </a> 
        </fieldset>

        <?php } ?>
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
        	<input type="url" name="url" value="<?php if(!empty($travel_guide_data['0']['guide_url'])){echo $travel_guide_data['0']['guide_url'];} ?>" placeholder="https://gbrs/guide/4536/pairs" readonly="" />
		</div>
        
        <div class="col-md-6 col-sm-6 col-xs-12">
			<h3>Privacy </h3>
        <select name="privacy" class="select_box">
          
        <option value="public" <?php if ($travel_guide_data['0']['is_public'] == 'yes') echo 'selected'; ?> >public</option>
        <option value="private" <?php if ($travel_guide_data['0']['is_public'] == 'no') echo 'selected'; ?>  >private</option>
        	</select>
		</div>
	</fieldset>
	
    <fieldset>
		<div class="col-md-12 col-sm-12 col-xs-12">
        	<h3>Embed this guide</h3>
<textarea name="embedcode" readonly="" cols="" rows="" class="embedarea" placeholder="Embed Code..."><?php if(isset($_REQUEST['tgid'])){ ?><a href="<?php if(!empty($travel_guide_data['0']['guide_url'])){echo $travel_guide_data['0']['guide_url'];} ?>">Embed this code</a><?php  } ?></textarea>
        </div>
	</fieldset>

<fieldset class="text-center"> 

<?php if(isset($_REQUEST['tgid'])){ ?>
<div class="col-md-12 col-sm-12 col-xs-12 text-center">
  <input type ="submit" name="submit" class="button" value="Update">
   <input type="hidden" name="update_tgid" value="<?php echo $_REQUEST['tgid']; ?>">
</div>
<?php } else{?>
<div class="col-md-12 col-sm-12 col-xs-12 text-center">
  <input type ="submit" name="submit" class="button" value="Publish">
</div>

<?php }?>
  <!-- <input name="publish" type="submit" class="button submit_add_button" value="Publish">  
   -->
  </fieldset>

	</div>
	</div>
</section>
</div> <!-- End Travel_Custom -->
</form>

<!--Js Files --> 
<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/js/jquery.min.js"></script>
<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']);?>/js/jquery.selectbox-0.2.js"></script>
<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']);  ?>/js/jquery.nicescroll.min.js"></script>


<!--Js Functions -->
<script type="text/javascript">
  jQuery(document).ready(function() {

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

<script>
function hometowngeocode() {
        var home_autocomplete = new google.maps.places.Autocomplete(
                /** @type {HTMLInputElement} */
                        (document.getElementById('destination')),
                        {types: ['geocode']});
        google.maps.event.addListener(home_autocomplete, 'place_changed', function () {
        });
    }

jQuery('body').on('click','.delete_listing_id',function (){
var me = jQuery(this);
   var lid = me.attr("data-list");
   var tgid = me.attr("data-travel");
   jq.ajax({
                url: $baseUrl + '/advice/ajax/removelistingguide',
                type: 'post',
                data: {'listing_id':lid,'travel_guide_id':tgid},
                beforeSend: function () {
                    preLoading('show', 'load-screen');
                },
                success: function (data) {
                   var res = jQuery.parseJSON(data);
                    
                   preLoading('hide', 'load-screen');
                    if (res.status == 'success') {
                      
                      me.parent().parent().remove();
                      
                            jQuery.notify(res.message, {globalPosition: 'top center', className: 'success'});
                            
                        }else{
                            jQuery.notify(res.message, {globalPosition: 'top center', className: 'error'});
                        }
                }
            });
});    

</script>

<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/js/advisor.js"></script>
