<?php 
global $base_url,$user; 
$par = arg(0); 
$destination = arg(1);
$filter_active="";
if(((isset($_GET['with_mutual_interests'])) || (isset($_GET['have_been_there'])) || (isset($_GET['locals'])) || (isset($_GET['professionals']))))
  {
   $filter_active = 1;
  }
$passionlist=getPassionList();
//echo "<pre>";Print_r($passionlist);exit;
?>
<link href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/stylesheet/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/fonts/stylesheet.css" rel="stylesheet" type="text/css" />
<link href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/stylesheet/style.css" rel="stylesheet" type="text/css" />
<link href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/stylesheet/font-awesome.css" rel="stylesheet" type="text/css" />
<div id="innerwraper" class="advisorpage">
<div class="innerpage">
<section class="content-section">
<div class="container-fluid">
<div class="row">
<div class="innersearch">
<div class="col-md-8 col-sm-6 col-xs-12 dessearch">
<input type="search" name="destination" value="<?php if(isset($destination) and $destination!='') {echo $destination;} ?>" class="desinput" onclick="search_destination();" id="advice_destination" onblur="if (this.placeholder == ''){this.placeholder = 'Enter a destination'; }" onfocus="if(this.placeholder == 'Enter a destination'){this.placeholder = '';}" placeholder="Enter a destination" />
<input type="submit" name="nogloob" value="Submit" class="searchinput" onclick="clickablesearch();" />
</div> <!-- End DesSearch -->
<form method="get" id="search_result_gloobers" action="">

<div class="col-md-2 col-sm-3 col-xs-12 advisorsearch">
<select class ="advisorinput"  id="dest_gloobers_type" onChange="ChangetypeofAdvisor(this);">
    <option value = "">-- Select-- </option>
    <option value="Gloobers" <?php if(isset($par) == 'Gloobers'){ echo "selected" ;} ?>>Other gloobers</option>
     <!-- <option value="Advisors" <?php //if(isset($_GET['advisors']) == 'Advisors'){ echo "selected" ;} ?>>Advisors</option> -->
    <option value="Expereince">Experience</option>
  
</select> 
</div> <!-- End AdvisorSearch -->
<div class="col-md-2 col-sm-3 col-xs-12 filtersearch">
<span> Filters <i class="filter-icon"></i></span>
</div> <!-- End AdvisorSearch -->

<div class="tab-pane tabs_ul" style="display:<?= $filter_active == 1 ? 'block' : 'none';  ?>">
<div class="container">
<ul class="check-tabs">

<!-- <li class="col-md-2 col-sm-6 col-xs-12"><input type="checkbox" name="facebook" class="checkbox" /><span>Facebook friends</span></li>
 -->
<li class="col-md-3 col-sm-6 col-xs-12"><input type="checkbox" <?php if(isset($_GET['with_mutual_interests'])){ echo 'checked'; } ?>  name="with_mutual_interests" class="checkbox" /><span>With mutual interests</span></li>
<li class="col-md-2 col-sm-6 col-xs-12"><input type="checkbox" <?php if(isset($_GET['have_been_there'])){ echo 'checked'; } ?> name="have_been_there" class="checkbox" /><span>Verified trips</span></li>
<li class="col-md-2 col-sm-6 col-xs-12"><input type="checkbox" <?php if(isset($_GET['locals'])) {echo 'checked'; } ?> name="locals" class="checkbox" /><span>Locals</span></li>
<li class="col-md-2 col-sm-6 col-xs-12"><input type="checkbox" <?php if(isset($_GET['professionals'])) {echo 'checked'; } ?> name="professionals" class="checkbox" /><span>Professionals</span></li>
</ul>

<div class="col-md-12 col-sm-12 col-xs-12 passionblock">
<div class="container">
<div class="col-md-12 col-sm-4 col-xs-12 passionpanel">
<?php
if($_GET['passions']){
$selectedPassions=explode(',',$_GET['passions']);
}else{
$selectedPassions=array();
}
foreach($passionlist as $passions){ 
if(in_array($passions['pid'],$selectedPassions)){
	$checked='checked';
}else{
	$checked='';
}
?>
<div class="col-md-3 col-sm-4 col-xs-12 passioncol">
<div class="inputthumb"><input type="checkbox" name="passions<?php echo ucfirst($passions['pid']); ?>" id="<?php echo ucfirst($passions['pid']); ?>" class="css-checkbox passion_checks" value="<?php echo ucfirst($passions['pid']); ?>" <?php echo $checked; ?>/>
<label for="<?php echo ucfirst($passions['pid']); ?>" class="css-label"><?php echo ucfirst($passions['passion']); ?></label></div>
</div> <!-- PassionCol -->
<?php } ?>
</div> <!-- End PassionPanel -->
</div> <!-- End Container -->
</div> <!-- End PassionBlock -->

</div>
</div> <!-- End Tab-Pane -->
</form>
</div> <!-- End InnerSearch -->


<div class="result_search_block">
<div class="container">
<div class="taglinerow">
<div class="col-md-12 col-sm-12 col-xs-12">
<h2>Find a trustful advisor</h2>
<p class="subtagline">Plan your trip with people you trust</p>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 reqbtnblock">
<!-- <input type="submit" name="createreccommend" value="Create a recommendation request" />
 -->
<div class="col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
 <a class="button" href = "<?php  echo $base_url; ?>/search-listing/advisors/<?php echo $destination; ?>">Create a recommendation request</a>
 </div>
 </div> <!-- End Col -->

</div> <!-- End TaglineRow -->
<div class="mask"></div>
</div> <!-- End Container -->
</div> <!-- End Result_Search_Block-->
</div> <!-- End Row -->
</div> <!-- End Container-Fluid -->
</section> <!-- End Content-Section -->

<section class="advisor_listing_tab">
<div class="container">
	<div class="tab-content">
		<div class="tab-pane fade in active" id="facebookfriend">
        <?php 
		$loogedUserId=$user->uid;
		if($result){  ?>
			<?php foreach ($result as  $value) { 
			
			if($loogedUserId !=$value['uid']){
			 $advisor_detail = getUserDetails($value['uid']); 
			 $advisor_data = user_load($value['uid']);
			 $cover_pic = getcoverpic($value['uid']);
             $location = passeport_location($value['uid']);


             //REFACTORED DB STRUCTURE!
			 $getStarRating=getAdvisorStarRating($value['uid']);
				if(!empty($getStarRating)){
					$totalReviews=sizeof($getStarRating);
					$totalRating=array_sum($getStarRating);
					$averageRating=($totalRating/$totalReviews);
					$avgRank=round($averageRating);
				}else{
					$avgRank=0;
				}
				switch($avgRank){
					case '1':
					$AvgStars='<i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star emptystar"></i><i class="glyphicon glyphicon-star emptystar"></i><i class="glyphicon glyphicon-star emptystar"></i><i class="glyphicon glyphicon-star emptystar"></i>';
					break;
					case '2':
					$AvgStars='<i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star emptystar"></i><i class="glyphicon glyphicon-star emptystar"></i><i class="glyphicon glyphicon-star emptystar"></i>';
					break;
					case '3':
					$AvgStars='<i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star emptystar"></i><i class="glyphicon glyphicon-star emptystar"></i>';
					break;
					case '4':
					$AvgStars='<i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star emptystar"></i>';
					break;
					case '5':
					$AvgStars='<i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i>';
					break;
					default:
					$AvgStars='<i class="glyphicon glyphicon-star emptystar"></i><i class="glyphicon glyphicon-star emptystar"></i><i class="glyphicon glyphicon-star emptystar"></i><i class="glyphicon glyphicon-star emptystar"></i><i class="glyphicon glyphicon-star emptystar"></i>';
					break;
				}
			 ?>

			<div class="col-md-6 col-sm-6 col-xs-12 advisorcol">
				<div class="advisorlist">
					<!-- <a href="#"> -->
                    <?php if(!empty($cover_pic)){ 
                        $style = "advisor_cover_pic";  
                        print '<img class="" src="' . image_style_url($style, $cover_pic) . '" alt="">';
                
        
                  } else{?>
						<img src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/images/advisor_cover.jpg" alt="" title="" />
                    <?php } ?>
                    <!-- </a> -->
					<div class="advisordetail">
						<div class="advisorimg">
							<!-- <a href="#"> -->
                            <?php 
                                if ($advisor_data->picture != "") {
                                    $file = file_load($advisor_data->picture->fid);
                                    //echo $file->uri;exit;
                                    $imgpath = $file->uri;
                                    $style = "advisor_profile_pic";
                                   print '<img class="img-circle" src="' . image_style_url($style, $imgpath) . '" alt="display pic">';
                                  //  print '<img src="' . $file->uri . '" class="img-circle size-img" alt="img">';
                                }else{ 
                                    print '<img src="' . base_path() . drupal_get_path('theme', $GLOBALS['theme']) . '/images/no-profile-male-img.jpg" class="img-circle" alt="display pic" />';
                                } ?>
                                <!-- </a> -->
						</div> <!-- End AdvisorImg -->
						<div class="advisorname">
							<h4><a href="<?php echo $base_url.'/profile/'.$value['uid']; ?>"><?php echo trim($advisor_data->field_first_name['und'][0]['value'],"%20"); ?> </a></h4>
								<h5><?php echo $location; ?></h5>
								<?php echo '<span class="reviewstar">'.$AvgStars.'</span>'; ?>					
								</div> <!-- End AdvisorName -->
						  <a href="<?php echo $base_url; ?>/profile/<?php  echo $value['uid']; ?>/<?php echo $destination; ?>" class="actionbtn btnselect">View Profile</a> 
						</div> <!-- End AdvisorDetail -->
					<div class="mask"></div>
				</div> <!-- End AdvisorList -->
			</div> <!-- End AdvisorColumn -->
			<?php  }else{
          if((sizeof($result)==1)){
                print '<div class="listing-info"><div class="no-listing"> <h2>Please Modify Your Search</h2>
                              <h3>No Result Found !!! </h3></div></div>';
          } 

        }
        } ?>
		</div> <!-- End FacebookID -->
		<?php
    print'<div class="col-md-12 text-center"><div class="pagination pagination-lg">';
    echo $pagination;
    print '</div></div>';
    }
    else { print '<div class="listing-info"><div class="no-listing"> <h2>Please Modify Your Search</h2>
                            <h3>No Result Found !!! </h3></div></div>'; 
    } ?>    

	</div> <!-- End tab-Content -->
</div> <!-- End Container -->
</section>

</div> <!-- End InnerPage -->
</div>


<!--<script src="<?php //print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/js/jQuery.min.js" type="text/javascript" language="javascript"></script> -->
<!--<script src="<?php  //print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/js/easingv1.3.js" type="text/javascript" language="javascript"></script> -->

<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/js/jqueryui.js" type="text/javascript" language="javascript"></script>

<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/js/bootstrap-datetimepicker.js" type="text/javascript" language="javascript"></script>

<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/js/jquery.nicescroll.min.js" type="text/javascript" language="javascript"></script>
<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/js/jquery.selectbox-0.2.js" type="text/javascript" language="javascript"></script>

<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/js/advisor.js" type="text/javascript" language="javascript"></script>
<?php if($_GET['with_mutual_interests']){ ?>
<script type="text/javascript">
jQuery('.passionblock').show();
</script>

<?php } ?>
<script type="text/javascript">
function search_destination(){
     	var home_autocomplete = new google.maps.places.Autocomplete(
                /** @type {HTMLInputElement} */
                        (document.getElementById('advice_destination')),
                        {types: ['geocode']});
        google.maps.event.addListener(home_autocomplete, 'place_changed', function () {
        });
}
jQuery(document).ready(function(){

/*Html Scroll*/
	jQuery("html").niceScroll();
	/*SelectBox*/
	//jQuery("select").selectbox(); 
		jQuery(document).click(function(e){
			if (!jQuery(e.target).is('.sbHolder, .sbHolder *')) {
            	jQuery("select").selectbox('close'); 
        	} 
		}); //End
	jQuery(".filtersearch").click(function(){
       jQuery('.tabs_ul').slideToggle();
	   jQuery('.filter-icon').toggleClass("filter-icon-active");
	   if(jQuery("input[name='with_mutual_interests']").is(":checked")){
			jQuery('.passionblock').stop();
			jQuery('.passionblock').toggle(2000);
		}
		else {
			jQuery('.passionblock').slideUp(8000);
		}
	});
}); //End Document.Ready()
	
	jQuery("input[name='with_mutual_interests']").click(function(){
		jQuery('.passionblock').toggle(5000);
	});


</script>
<script type="text/javascript">  
       jQuery(function(){
         jQuery('.checkbox').on('change',function(){
            preLoading('show', 'load-screen');
            jQuery('#search_result_gloobers').submit();
            });
        });
</script>
<script type="text/javascript">
//on change of gloobers search box
    jQuery(document).on('change','#advice_destination',function(){

      var search = (jQuery('#advice_destination').val()).trim();

     if(search.length<=0){
            return false;
        }
        
        setTimeout(function(){

         var href = $baseUrl+'/Gloobers/'+search;
         window.location.href = href;
             // jQuery('#search_result').submit();
        });
    
    });
    function ChangetypeofAdvisor(ad){
            var change = ad.value;
            if(change == 'Expereince'){
                var destination = jQuery('#advice_destination').val();
                var href = $baseUrl+'/search-destination/'+destination;
                window.location.href = href;
            }else if(change =='Advisors'){
                var destination = jQuery('#advice_destination').val();
                var href = $baseUrl+'/search-listing/advisors/'+destination;
                window.location.href = href;
            }else{
                return false;
            }
    }
	function clickablesearch(){
		var destination=jQuery('#advice_destination').val();
		if(destination==''){
			alert('please select destination.');
			return false;
		}
		var filtersearch=jQuery('#dest_gloobers_type').val();
		if (filtersearch == 'Advisors') {
			window.location.href = '<?= $base_url; ?>/search-listing/advisors/' + destination;
        }else if (filtersearch == 'Expereince') {
			window.location.href = '<?= $base_url; ?>/search-destination/' + destination;
        }else if (filtersearch == 'Gloobers') {
			window.location.href = '<?= $base_url; ?>/Gloobers/' + destination;
       }else{
         preLoading('hide', 'load-screen');
       }
    }
	
	
	jQuery(document).on('click','.passion_checks',function(){
		var mypassionsSelected= [];
		jQuery('.passion_checks').each(function( index,value){
			if (jQuery(this).prop('checked')==true){ 
				mypassionsSelected.push(jQuery(this).val());
			}
		});
		if(mypassionsSelected.length>0){
			var passions='&passions='+mypassionsSelected;
		}else{
			var passions='';
		}
		var url      = window.location.href;     // Returns full URL
		var alteredURL = removeParam("passions", url);
		var redirectedUrl=alteredURL+passions;
		window.location.href=redirectedUrl;
	});
    jQuery("select").selectbox();
	function removeParam(key, sourceURL) {
		var rtn = sourceURL.split("?")[0],
			param,
			params_arr = [],
			queryString = (sourceURL.indexOf("?") !== -1) ? sourceURL.split("?")[1] : "";
		if (queryString !== "") {
			params_arr = queryString.split("&");
			for (var i = params_arr.length - 1; i >= 0; i -= 1) {
				param = params_arr[i].split("=")[0];
				if (param === key) {
					params_arr.splice(i, 1);
				}
			}
			rtn = rtn + "?" + params_arr.join("&");
		}
		return rtn;
	}	
</script>