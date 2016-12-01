<?php  

global $base_url,$user;

drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/customcss.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/fonts/stylesheet.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/font-awesome.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/landing_page.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/stylesheet/for-head-foot.css','file');
$total_credit = total_credit_for_advisor();
$credit_earned = credit_earned($user->uid);

?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
<section class="whatssection">
    <div class="dr-wrapper">
        <div class="whatsblock">
            <h1>What is it ?</h1>
            <p>"Validated recommendations" are the recommendations your friends followed.</p>
        </div>
    </div>
</section>
</div> <!-- End Col -->

<section class="ratingsection">
<div class="col-xs-12 col-sm-12 col-md-8 col-md-4">
<h3 class="text-uppercase">Followed Recommendation</h3>
<h2><?php if(!empty($no_of_followed)){echo $no_of_followed;}else{echo '0';}?></h2>
</div> <!-- End Col -->

<div class="col-xs-12 col-sm-12 col-md-8 col-md-4">
<h3 class="text-uppercase">Credits Earned</h3>
<h2><?php if(!empty($credit_earned)){echo $credit_earned;}else{echo '0';}?></h2>
</div> <!-- End Col -->

<div class="col-xs-12 col-sm-12 col-md-8 col-md-4">
<h3 class="text-uppercase">Advisor Rate</h3>
<h2><i class="glyphicon glyphicon-star"></i> <i class="glyphicon glyphicon-star"></i> <i class="glyphicon glyphicon-star"></i> <i class="glyphicon glyphicon-star"></i> <i class="glyphicon glyphicon-star emptystar"></i></h2>
<h5>(2 recommendation)</h5>
</div> <!-- End Col -->

<form class="recommendation_select recommendation_select-wrap">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="selectbox">
                    <select name="recommendation" class="select_box" id="validate_recommend">
                        <option <?=isset($_GET['recommendation']) && $_GET['recommendation']=='all'?'selected':''?> value="all">Display all recommendations</option>
                        <option <?=isset($_GET['recommendation']) && $_GET['recommendation']=='pending'?'selected':''?> value="pending" <?php echo $selected; ?> > Display pending recommendations only</option>
                        <option <?=isset($_GET['recommendation']) && $_GET['recommendation']=='reviewed'?'selected':''?> value="reviewed" <?php echo $selected; ?> >Display reviewed recommendations only</option>
                    </select>
                </div>
            </div>
</form>
</section>
<div class="clearfix"></div>

<section class="reviewsection">
  <?php
  // echo $today = date("Y-m-d");
  //echo "<pre>";print_r($all_recommendation);exit; 
  foreach ($all_recommendation as $value) { 
  $photos = getPhotosData($value['listing_id']);
  $pic_data = user_load($value['recommend_for_uid']);
  $traveller_name = $pic_data->field_first_name['und'][0]['value'];
 
  $OverviewData = getOverviewData($value['listing_id']);
  $locationDetail = getListingData($value['listing_id']);

  ?>

  <div class="col-xs-12 col-sm-4 col-md-4">
    <div class="reviewbox">
      <div class="reviewblock">
      <?php if(!empty($photos[0]['value1'])){ 
        $photo = unserialize($photos[0]["value1"]);
         $file = file_load($photo["fid"]);
         $imgpath = $file->uri;
         $style = 'experience_topranked_large';
         echo '<img src="'.image_style_url($style, $imgpath).'" alt="place" onError="imgError(this)" class= "img-height"/>';
        }else {?>
        <img src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/images/img1.jpg" alt="" title="" />
        <?php } ?>
        <div class="reviewinfo">
          <div class="user_pic">
          <?php 
              $file = file_load($pic_data->picture->fid);
              $imgurl = $file->uri; 
              $style = "homepage_header";
              if(!empty($imgurl)){  
                                        echo '<img alt=" " src="'.image_style_url($style, $imgurl).'"></a>';
                                        }else{ ?>
            <img src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/images/no-profile-male-img.jpg" alt="" title="" />
          <?php  } ?>
          </div>
          <p>
             <?php if(isset($_GET['recommendation']) && $_GET['recommendation']=='pending' ){?>
            <strong>Pending</strong>
            <?php  } ?>
             <?php  if(isset($_GET['recommendation']) && $_GET['recommendation']=='reviewed'){?>
            <strong>Reviewed</strong>
            <?php } ?>
            <?php if(!empty($value['advisor_credits_assigned'])){echo $value['advisor_credits_assigned'];}else { echo '0';} ?> 	
            <?php      
            $today = date("Y-m-d");
            if(strtotime($today) >= strtotime($value['arrive_at_date'])){
              echo "Credits earned";
            }else{
              echo "credits to earn";
            }


            ?>

          </p>
          <h4 class="text-uppercase"><?php echo $OverviewData['title']; ?></h4>
          <h5><?php echo $locationDetail['city'].' '.",".' '.$locationDetail['state']; ?></h5>
        </div> <!-- End ReviewInfo -->
      </div> <!-- End ReviewBlock -->
      <div class="revpara">
      
      <p>This listing has been booked but the service has not been operated yet. Yours credits will be credited as soon as <?php   echo ucwords($traveller_name);?>  will  be back from trip.</p>
      
      </div> <!-- End RevPara -->
    </div> <!-- End ReviewBox -->
  </div> <!-- End Col -->
<?php  } ?>

</section>
<?php if($num_of_results>6){?>
<div class="morebtn"><a href ="javascript:void(0)" onclick="validate_recommendation_data();">Load More</a></div>
<?php }?>
<input type= "hidden" id ="total_records" name="total_records" value="<?php echo $num_of_results;?>">
<input type= "hidden" id ="record_limit" name="record_limit" value="6">

<input type= "hidden" id ="page_no" name="page_no" value="1">
 <!--Js Files --> 
 <script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/js/jquery.selectbox-0.2.js"></script>
<!--Js Functions --> 
  <script type="text/javascript">
 	
		jQuery(document).ready(function() {
		jQuery("html").niceScroll();
		});

		jQuery(document).ready(function() {
			jQuery(".nav-dropdown-content").niceScroll();
			jQuery(".select_box").selectbox();
			jQuery(document).click(function(e){
				if (!jQuery(e.target).is('.sbHolder, .sbHolder *')) {
					jQuery("select").selectbox('close'); 
				} 
			}); //End
		});
		
	
//});	
 </script>
<script>
  jQuery('#validate_recommend').change(function(){
      jQuery(this).closest('form').trigger('submit');
    });

function validate_recommendation_data(){
  var total_records = jQuery("#total_records").val();
  var record_limit = jQuery("#record_limit ").val();
  var page_no = jQuery("#page_no").val();
  var url = window.location.href;
  var search_filter = getUrlParameter('recommendation');
  var showing_record = record_limit*(parseInt(page_no)+1);
  if(!search_filter){search_filter='';}               
  
  
  jQuery.ajax({
                type: 'POST',
                url: $baseUrl + '/advice/ajax/validate_recommendation',
                data: {'total_records':total_records,'record_limit':record_limit,'page_no':page_no,'search_filter':search_filter},
                    beforeSend: function () {
                    preLoading('show', 'load-screen');
                    },
                    success: function (data) {
                      preLoading('hide', 'load-screen');
                      jQuery(".reviewsection").append(data);
                      var page = parseInt(page_no)+1;
                      jQuery("#page_no").val(page);
                      
                      
                        if(total_records<=showing_record){

                          jQuery(".morebtn").css("display","none");
                        }else{
                          jQuery(".morebtn").css("display","block");
                        }
                      
                    },
                });  



}
var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

</script>