<?php
global $user,$base_url;
drupal_add_css(drupal_get_path('theme', 'gloobers_new') . '/stylesheet/style.css', 'file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') . '/stylesheet/for-head-foot.css', 'file');
$userId=$user->uid;
if($booking_details['ruid']){
$userId=$booking_details['ruid'];	
}
$traveller=user_load($userId);
if($traveller->picture != ""){
		$traveller_DpID=$traveller->picture->fid;
		$traveller_file = file_load($traveller_DpID);
		$traveller_file_imgpath = $traveller_file->uri;
		$traveller_style = "new-reservation";
		$traveller_DpImage_path=image_style_url($traveller_style,$traveller_file_imgpath);
		$traveller_DpImage='<img class="img-circle size-img" src="'.image_style_url($traveller_style, $traveller_file_imgpath).'" style="border-radius:100%;width:100px;height:100px;border:none">';
}else{
		$traveller_DpImage_path=base_path().drupal_get_path('theme', $GLOBALS['theme']) . '/images/no-profile-male-img.jpg';
		$traveller_DpImage='<img src="' . base_path().drupal_get_path('theme', $GLOBALS['theme']). '/images/no-profile-male-img.jpg" class="img-circle size-img"  style="border-radius:100%;width:100px;;height:100px;border:none"/>';
}
$categoryIds=array();
foreach($PassionCategoryList as $PassionCategory){
$categoryIds[$PassionCategory['passion_category']]=$PassionCategory['pcid'];
}
//Listing Photo Data
if(!empty($listingData['main_img_fid'])){
	$metalisitngFid=$ListingData['main_img_fid'];
}else{
	$photo = getPhotosData($ListingData["eid"]);
	$photo = unserialize($photo[0]["value1"]);
	$metalisitngFid=$photo["fid"];
}
	$file = file_load($metalisitngFid);
	$style = "new-reservation";
	$Img_uri = $file->uri;
	if(file_exists($Img_uri)){
		$listingImgPath=image_style_url($style, $Img_uri);
		$Img_Name = $file->filename;
	}else{
		$listingImgPath=image_style_url($style, $Img_uri);
		$Img_Name = 'banner-listing_img.jpg';
	}

?>
<div class="reviewpageblock" style="background-image:url('<?php echo $listingImgPath; ?>');">
<div class="container">
<div class="reviewtitelrow">
<div class="col-md-12 col-sm-12 col-xs-12">
<h2><?php echo $ListingData['title']; ?></h2>
<h5><?php echo $ListingData['city'].',&nbsp;'.$ListingData['country']; ?></h5>
</div>
</div> <!-- End ReviewTitleRow -->
<div class="mask"></div>
</div> <!-- End Container -->
</div> <!-- End ReviewPageBlock -->
</div> <!-- End Row -->
</div> <!-- End Container-Fluid -->
</section> <!-- End Content-Section -->
<form name="review" id="reviewform" type="post">
<section class="reviewpagesection">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="col-md-6 col-sm-6 col-xs-12 revblocks">
<div class="col-md-12 col-sm-12 col-xs-12"><h3>Professionalism</h3></div>
<div class="col-md-12 col-sm-12 col-xs-12">
<span class="reviewstar" id="professional">
<i class="glyphicon glyphicon-star emptystar" id="professional_1"></i> 
<i class="glyphicon glyphicon-star emptystar" id="professional_2"></i> 
<i class="glyphicon glyphicon-star emptystar" id="professional_3"></i> 
<i class="glyphicon glyphicon-star emptystar" id="professional_4"></i> 
<i class="glyphicon glyphicon-star emptystar" id="professional_5"></i> 
</span> <!-- End ReviewStar -->
</div> 
</div> <!-- End RevBlocks --> 

<div class="col-md-6 col-sm-6 col-xs-12 revblocks">
<div class="col-md-12 col-sm-12 col-xs-12"><h3>Money for value</h3></div>
<div class="col-md-12 col-sm-12 col-xs-12">
<span class="reviewstar" id="money">
<i class="glyphicon glyphicon-star emptystar" id="money_1"></i> 
<i class="glyphicon glyphicon-star emptystar" id="money_2"></i> 
<i class="glyphicon glyphicon-star emptystar" id="money_3"></i> 
<i class="glyphicon glyphicon-star emptystar" id="money_4"></i> 
<i class="glyphicon glyphicon-star emptystar" id="money_5"></i> 
</span> <!-- End ReviewStar -->
</div> 
</div> <!-- End RevBlocks --> 

<div class="col-md-6 col-sm-6 col-xs-12 revblocks">
<div class="col-md-12 col-sm-12 col-xs-12"><h3>Communication</h3></div>
<div class="col-md-12 col-sm-12 col-xs-12">
<span class="reviewstar" id="communication">
<i class="glyphicon glyphicon-star emptystar" id="communication_1"></i> 
<i class="glyphicon glyphicon-star emptystar" id="communication_2"></i> 
<i class="glyphicon glyphicon-star emptystar" id="communication_3"></i> 
<i class="glyphicon glyphicon-star emptystar" id="communication_4"></i> 
<i class="glyphicon glyphicon-star emptystar" id="communication_5"></i> 
</span> <!-- End ReviewStar -->
</div> 
</div> <!-- End RevBlocks --> 

<div class="col-md-6 col-sm-6 col-xs-12 revblocks">
<div class="col-md-12 col-sm-12 col-xs-12"><h3>Safety</h3></div>
<div class="col-md-12 col-sm-12 col-xs-12">
<span class="reviewstar" id="safety">
<i class="glyphicon glyphicon-star emptystar" id="safety_1"></i> 
<i class="glyphicon glyphicon-star emptystar" id="safety_2"></i> 
<i class="glyphicon glyphicon-star emptystar" id="safety_3"></i> 
<i class="glyphicon glyphicon-star emptystar" id="safety_4"></i> 
<i class="glyphicon glyphicon-star emptystar" id="safety_5"></i> 
</span> <!-- End ReviewStar -->
</div> 
</div> <!-- End RevBlocks --> 
</div> 
</div> <!-- End Row -->
</div> <!-- End Container -->
</section> <!-- End Review-Page-Section -->

<section class="textboxsection">
<div class="container">
<div class="row">
<div class="blockheading"><h2>Write a review</h2></div>
<div class="col-md-8 col-md-offset-2">
<textarea name="writereveiw" id="writereveiw" cols="15" rows="10" placeholder="How was it ?"></textarea>
</div>
</div> <!-- End Row -->
</div> <!-- End Container -->
</section> <!-- End TextBoxSection-->
<?php if($booking_details['advisor_id']){ ?>
<section class="userratingsection">
<div class="container">
<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12">
<img src="<?php echo $traveller_DpImage_path; ?>" alt="" title="" class="reviewerpic" />
<h3>Rate this recommendation</h3>
<span class="reviewstar" id="recommendation">
<i class="glyphicon glyphicon-star emptystar" id="recommendation_1"></i> 
<i class="glyphicon glyphicon-star emptystar" id="recommendation_2"></i> 
<i class="glyphicon glyphicon-star emptystar" id="recommendation_3"></i> 
<i class="glyphicon glyphicon-star emptystar" id="recommendation_4"></i> 
<i class="glyphicon glyphicon-star emptystar" id="recommendation_5"></i> 
</span> <!-- End ReviewStar -->
</div>
</div> <!-- End Row -->
</div> <!-- End Container -->
</section> <!-- End UserRatingSection-->
<?php } ?>
<?php if($booking_details['ruid']){ ?>
<section class="userratingsection">
<div class="container">
<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12">
<img src="<?php echo $traveller_DpImage_path; ?>" alt="" title="" class="reviewerpic" />
<h3>Rate this recommendation</h3>
<span class="reviewstar" id="recommendation">
<i class="glyphicon glyphicon-star emptystar" id="recommendation_1"></i> 
<i class="glyphicon glyphicon-star emptystar" id="recommendation_2"></i> 
<i class="glyphicon glyphicon-star emptystar" id="recommendation_3"></i> 
<i class="glyphicon glyphicon-star emptystar" id="recommendation_4"></i> 
<i class="glyphicon glyphicon-star emptystar" id="recommendation_5"></i> 
</span> <!-- End ReviewStar -->
</div>
</div> <!-- End Row -->
</div> <!-- End Container -->
</section> <!-- End UserRatingSection-->
<?php } ?>
<section class="listingpassionsection">
<div class="container">
<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12">
<h3>Who would you recommend this activity for ?</h3>
<div class="reviewpassionblock">
<?php
$availCat=array();
foreach($PassionList as $Passion){
	$availCat[]=$Passion['passion_category'];
	/* if(!in_array($Passion['passion_category'],$categoryIds)){
		$Key = array_search($Passion['passion_category'], $categoryIds);
		unset($Key);
	} */
}
$availCat=array_unique($availCat);
$Passion_categories = array_intersect($categoryIds, $availCat);
$startPoint=min($Passion_categories);
$endPoint=max($Passion_categories);
$K=1;
for($c=$startPoint;$c<=$endPoint;$c++){
	$CategoryName = array_search($c, $Passion_categories);
	
	if(in_array($c,$Passion_categories)){
		echo '<div class="col-md-3 col-sm-4 col-xs-12"><h4>'.$CategoryName.'</h4><ul>';
		foreach($PassionList as $Passion){ 
			if($Passion['passion_category']==$c){ ?>
				<li>
					<input type="checkbox" name="passions[]" class="css-checkbox" id="<?php echo $Passion['pid']; ?>" value="<?php echo $Passion['passion'].'_'.$Passion['passion_category']; ?>"/>
					<label for="<?php echo $Passion['pid']; ?>" class="css-label">
					<?php echo $Passion['passion'];?>
					</label>
				</li>
		<?php
			}		
		}	
		echo "</ul></div>";
	}
	
	if($K%4==0){
		echo "<div class='clearfix'></div>";
	}
	$K++;
}
?>
</div>
<input type="submit" name="confirm" value="Confirm" class="reviewsubmitbtn" />
</div>
</div> <!-- End Row -->
</div> <!-- End Container -->
</section> <!-- End UserRatingSection-->
<input type='hidden' name='professional' id="professional_value" />
<input type='hidden' name='money'  id="money_value"/>
<input type='hidden' name='communication' id="communication_value" />
<input type='hidden' name='safety' id="safety_value"/>
<input type="hidden" name="recommendation" id="recommendation_value" />
</form>
<script type="text/javascript">
jQuery('.reviewstar').bind('click', function(event){
	var selectedStarId=event.target.id;
	var SelectedStar=selectedStarId.split('_');
	jQuery('#'+SelectedStar[0]).find('.glyphicon').removeClass('emptystar');
	switch(SelectedStar[1]){
		case '1':
		jQuery('#'+SelectedStar[0]).find('#'+SelectedStar[0]+'_2').addClass('emptystar');
		jQuery('#'+SelectedStar[0]).find('#'+SelectedStar[0]+'_3').addClass('emptystar');
		jQuery('#'+SelectedStar[0]).find('#'+SelectedStar[0]+'_4').addClass('emptystar');
		jQuery('#'+SelectedStar[0]).find('#'+SelectedStar[0]+'_5').addClass('emptystar');
		var allInputs = jQuery('input[name="' + SelectedStar[0] + '"]');
		allInputs.val(SelectedStar[1]);
		break;
		case '2':
		jQuery('#'+SelectedStar[0]).find('#'+SelectedStar[0]+'_3').addClass('emptystar');
		jQuery('#'+SelectedStar[0]).find('#'+SelectedStar[0]+'_4').addClass('emptystar');
		jQuery('#'+SelectedStar[0]).find('#'+SelectedStar[0]+'_5').addClass('emptystar');
		var allInputs = jQuery('input[name="' + SelectedStar[0] + '"]');
		allInputs.val(SelectedStar[1]);
		break;
		case '3':
		jQuery('#'+SelectedStar[0]).find('#'+SelectedStar[0]+'_4').addClass('emptystar');
		jQuery('#'+SelectedStar[0]).find('#'+SelectedStar[0]+'_5').addClass('emptystar');
		var allInputs = jQuery('input[name="' + SelectedStar[0] + '"]');
		allInputs.val(SelectedStar[1]);
		break;
		case '4':
		jQuery('#'+SelectedStar[0]).find('#'+SelectedStar[0]+'_5').addClass('emptystar');
		var allInputs = jQuery('input[name="' + SelectedStar[0] + '"]');
		allInputs.val(SelectedStar[1]);
		break;
		case '5':
		var allInputs = jQuery('input[name="' + SelectedStar[0] + '"]');
		allInputs.val(SelectedStar[1]);
		break;
	}	
});

jQuery("#reviewform").on("submit", function(event){
  event.preventDefault();
  var professional_value=jQuery('#professional_value').val();
  if(professional_value==''){
	alert('Please select professional rating.');
	return false;
  }
   var money_value=jQuery('#money_value').val();
  if(money_value==''){
	alert('Please select money value rating.');
	return false;
  }
  var communication_value=jQuery('#communication_value').val();
  if(communication_value==''){
	alert('Please select communication value rating.');
	return false;
  }
   var safety_value=jQuery('#safety_value').val();
  if(safety_value==''){
	alert('Please select safety value rating.');
	return false;
  }

  var writereveiw=jQuery('#writereveiw').val();
  if(writereveiw==''){
    alert('Please add review.');
	return false;
   }
	var SerializeData=jQuery(this).serialize().trim();
  var bookingId='<?php echo arg(1); ?>';
  jQuery.ajax({
         url: $baseUrl + '/ajax/addReview',
         type: 'post',
         data: {'SerializeData':SerializeData,'bookingId':bookingId},
         beforeSend: function(){
              preLoading('show', 'load-screen');
         },
         success: function(data){
         	var baseurl="<?php echo $base_url;?>";				
			if(data=='1'){
				alert("Cheer up, your review has been successfully submitted.");							
				window.location.href = baseurl;
			}else if(data=='3'){
				alert("Cheer up, your review has been successfully submitted.");
				window.location.href = baseurl;
			}else{
				alert("Sorry, Review cannot be update.");
			}
		 },
		 complete: function () {
             preLoading('hide', 'load-screen');
		 }
   });  
});
</script>