<?php  global $base_url,$user; 
$par = arg(0); 
$filter_active="";
if(((isset($_GET['with_mutual_interests'])) || (isset($_GET['have_been_there'])) || (isset($_GET['locals'])) || (isset($_GET['professionals']))))
  {
   $filter_active = 1;
  };
$passionlist=getPassionList();
?>
<link href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/stylesheet/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/fonts/stylesheet.css" rel="stylesheet" type="text/css" />
<link href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/stylesheet/style.css" rel="stylesheet" type="text/css" />
<link href="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/stylesheet/font-awesome.css" rel="stylesheet" type="text/css" />
<div class="innerpage">
<section class="content-section">
<div class="container-fluid">
<div class="row">
<div class="innersearch">
<form method="get" id="search_result_advisor" action="<?php echo $base_url; ?>/advisor_listing_results">
<div class="col-md-8 col-sm-6 col-xs-12 dessearch">
<input type="search" name="dest" value="<?php if(isset($_GET['dest']) and $_GET['dest']!='') {echo $_GET['dest'];} ?>" class="desinput" onclick="search_destination();" id="advice_destination" onblur="if (this.placeholder == ''){this.placeholder = 'Enter a destination'; }" onfocus="if(this.placeholder == 'Enter a destination'){this.placeholder = '';}" placeholder="Enter a destination" />
<input type="submit" name="nothing" value="Submit" class="searchinput" onclick="clickablesearch();" />
</div> <!-- End DesSearch -->
<div class="col-md-2 col-sm-3 col-xs-12 advisorsearch">
<!-- <input type="text" name="advisors" class="advisorinput" value="Advisors" readonly="readonly" />
 -->
  <select class ="advisorinput"  onChange="ChangetypeofAdvisor(this);">
    <option value = "">-- Select-- </option>
   <!--  <option value="Advisors" <?php //if(isset($_GET['advisors']) == 'Advisors'){ echo "selected" ;} ?>>Advisors</option> -->
    <option value="Expereince">Experience</option>
     <option value="Gloobers" <?php if(isset($par) == 'Gloobers'){ echo "selected" ;} ?>>Other gloobers</option>
</select> 
 </div> <!-- End AdvisorSearch -->
<div class="col-md-2 col-sm-3 col-xs-12 filtersearch">
<span> Filters <i class="fa fa-list"></i></span>
</div> <!-- End AdvisorSearch -->

<div class="tab-pane tabs_ul" style="display:<?= $filter_active == 1 ? 'block' : 'none';  ?>">

<div class="container">
<ul class="check-tabs">

<!-- <li class="col-md-2 col-sm-6 col-xs-12"><input type="checkbox" name="facebook" class="checkbox" /><span>Facebook friends</span></li>
 --><li class="col-md-3 col-sm-6 col-xs-12"><input type="checkbox" <?php if(isset($_GET['with_mutual_interests'])){ echo 'checked'; } ?> 	name="with_mutual_interests" class="checkbox" /><span>With mutual interests</span></li>
<li class="col-md-2 col-sm-6 col-xs-12"><input type="checkbox" <?php if(isset($_GET['have_been_there'])){ echo 'checked'; } ?> name="have_been_there" class="checkbox" /><span>Verified trips</span></li>
<li class="col-md-2 col-sm-6 col-xs-12"><input type="checkbox" <?php if(isset($_GET['locals'])) {echo 'checked'; } ?> name="locals" class="checkbox" /><span>Locals</span></li>
<li class="col-md-2 col-sm-6 col-xs-12"><input type="checkbox" <?php if(isset($_GET['professionals'])) {echo 'checked'; } ?>  name="professionals" class="checkbox" /><span>Professionals</span></li>
</ul>
</div>
</div> <!-- End Tab-Pane -->
<!-- <input type ="hidden" name="destination" value= "<?php //echo $_GET['destination']; ?>"> -->
<input type ="hidden" name="advisors" value="<?php echo $_GET['advisors']; ?>">
<input type ="hidden" name="triptype" value="<?php echo $_GET['triptype']; ?>">
<input type ="hidden" name="traveler" value="<?php echo $_GET['traveler']; ?>">
<input type ="hidden" name="start_date" value="<?php echo $_GET['start_date']; ?>">
<input type ="hidden" name="end_date" value="<?php echo $_GET['end_date']; ?>">
<input type ="hidden" name="overall_budget" value="<?php echo $_GET['overall_budget']; ?>">
<input type ="hidden" name="lookingfor" value="<?php echo $_GET['lookingfor']; ?>">
</form>
</div> <!-- End InnerSearch -->
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
</form>
<div class="sharingblock">
<div class="container">
<div class="sharingrow">
<div class="col-md-10 col-sm-10 col-xs-12"><h2>Share this request</h2></div>
<fieldset>
<?php 
$destination = $_GET['dest'];
$triptype = $_GET['triptype'];
$traveler = $_GET['traveler'];
$start_date = $_GET['start_date'];
$end_date = $_GET['end_date'];
$overall_budget = $_GET['overall_budget'];
$looking_for = $_GET['lookingfor'];
$request_id = $user->uid;
$url= ($base_url."/advisor_sharing/request_id/".$request_id."?dest=".$destination."&triptype=".$triptype."&traveler=".$traveler."&start_date=".$start_date."&end_date=".$end_date."&overall_budget=".$overall_budget."&looking_for=".$looking_for);

?>
<div class="col-md-10 col-sm-10 col-xs-12">
   <div class="clipboard">
        <input name="input" id="dynamic" readonly type="text" value="<?php echo $url; ?>">
       <!--  <span>http://gloobers.com/<?php //echo $url; ?></span> -->
    </div>
</div>
<div class="col-md-2 col-sm-2 col-xs-12">
<!--<a class="actionbtn"  id="copy-dynamic" href="javascript:void(0);">Copy</a>-->
<a class="actionbtn btn" data-clipboard-action="copy" data-clipboard-target="#dynamic" id="copy-dynamic1" href="javascript:void(0);">Copy</a>
</div>
</fieldset>
<div class="col-md-10 col-sm-10 col-xs-12 social_icons">
<ul>
<li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($url); ?>"><i class="fa fa-facebook"> </i></a></li>
<li><a target="_blank" href="https://twitter.com/home?status=<?php echo urlencode($url); ?>"><i class="fa fa-twitter"> </i></a></li>
<li><a target="_blank" href="https://plus.google.com/share?url=<?php echo urlencode($url); ?>"><i class="fa fa-google-plus"> </i></a></li>
<li><a href="mailto:?&subject=&body=<?php echo urlencode($url); ?>"><i class="fa fa-envelope-o"> </i></a></li>
</ul>
</div> <!-- End Social_Icons -->
</div> <!-- End sharingrow -->
</div> <!-- End Container -->
<div class="mask"></div>
</div> <!-- End SharingBlock-->
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
			if($value['uid'] != $loogedUserId){
			 $advisor_detail = getUserDetails($value['uid']); 
			 $advisor_data = user_load($value['uid']);
			 $cover_pic = getcoverpic($value['uid']);
            $location = passeport_location($value['uid']);
             
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
							<!-- <a href="#"> -->
                            <h4><a href="<?php echo $base_url.'/profile/'.$value['uid']; ?>"><?php echo $advisor_data->field_first_name['und'][0]['value']; ?> </a></h4>
							<h5><?php echo $location; ?></h5>
                            <!-- </a> -->
                            </div> <!-- End AdvisorName -->
						<a href="javascript:void(0)" onclick="forward_request('<?php echo base64_encode($value['uid']); ?>','<?php echo $advisor_data->field_first_name['und'][0]['value']; ?>')" class="actionbtn btnselect">Send request</a> 
						</div> <!-- End AdvisorDetail -->
					<div class="mask"></div>
				</div> <!-- End AdvisorList -->
			</div> <!-- End AdvisorColumn -->
			<?php  }else{
          if((sizeof($result)==1)){
                print '<div class="listing-info"><div class="no-listing"> <h2>Please Modify Your Search</h2>
                              <h3>No Result Found !!! </h3></div></div>';
          } 

        }} ?>
		</div> <!-- End FacebookID -->
		<?php
        print'<div class="col-md-12 text-center"><div class="pagination pagination-lg">';
        echo $pagination;
        print '</div></div>';
        }
        else { print '<div class="listing-info"><div class="no-listing"><h4>No Result found</h4></div></div>'; 
        } ?>        

	</div> <!-- End tab-Content -->
</div> <!-- End Container -->
</section>

</div> <!-- End InnerPage -->


<!--MODAL FOR MESSAGE AND SEND REQUEST TO SELECTED ADVISOR-->

<div id="modal_advisor_request" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="advisor_request_form" name="advisor_request_form"   method="post">  
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Advisor Request</h4>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Recipient:</label>
                        <input type="text" class="form-control" id="recipient-name" readonly="readonly" name="recipient-name" />
                    </div>

                    <div class="form-group">
                        <label for="message-text" class="control-label">Message:</label>
                        <textarea class="form-control" id="message-text" required="required" name="message"></textarea>
                        <input type="hidden" value="<?php echo $filter_advisor_input; ?>" name="filter_advisor_input" id="filter_advisor_input" />
                        <input type="hidden" name="advisor_uid" id="advisor_uid">
                    </div>
                </div>

                <div class="modal-footer">
                   <!--  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                    <input type="submit" class="btn btn-primary" value="Send message" data-loading-text="Sending..." />
                </div>
            </form>
        </div>
    </div>
</div> <!--END OF MODAL-->


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
			jQuery('.passionblock').toggle(5000);
		}else {
		    var url      = window.location.href;     // Returns full URL
			var alteredURL = removeParam("passions", url);
			jQuery('.passionblock').slideUp(8000);
		}
	});
}); //End Document.Ready()
	jQuery("input[name='with_mutual_interests']").click(function(){
		jQuery('.passionblock').toggle(5000);
	});
	function search_destination(){
     	var home_autocomplete = new google.maps.places.Autocomplete(
                /** @type {HTMLInputElement} */
                        (document.getElementById('advice_destination')),
                        {types: ['geocode']});
        google.maps.event.addListener(home_autocomplete, 'place_changed', function () {
        });
    }
	function clickablesearch(){
		var destination=jQuery('#advice_destination').val();
		var filtersearch=jQuery('#advice_destination_type').val();
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

</script>
<script type="text/javascript">  
        jQuery(function(){
         jQuery('.checkbox').on('change',function(){
            preLoading('show', 'load-screen');
            jQuery('#search_result_advisor').submit();
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
             jQuery('#search_result_advisor').submit();
        });
    
    });
    function ChangetypeofAdvisor(ad){
            var change = ad.value;
           
            if(change == 'Expereince'){
                var destination = jQuery('#advice_destination').val();
                var href = $baseUrl+'/search-destination/'+destination;
                window.location.href = href;
            }else if(change == 'Gloobers'){
                var destination = jQuery('#advice_destination').val();
                var href = $baseUrl+'/Gloobers/'+destination;
                window.location.href = href;

            }else{
                return false;
            }
    }
	jQuery("select").selectbox();
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
		//alert(alteredURL);
		var redirectedUrl=alteredURL+passions;
		window.location.href=redirectedUrl;
	});
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
<script src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/js/clipboard.min.js" type="text/javascript"></script>
<script>
    var clipboard = new Clipboard('.btn');

    clipboard.on('success', function(e) {
        console.log(e);
    });

    clipboard.on('error', function(e) {
        console.log(e);
    });
</script>   
