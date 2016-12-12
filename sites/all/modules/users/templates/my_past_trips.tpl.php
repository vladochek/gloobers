
<?php
global $base_url,$user;
drupal_add_css(drupal_get_path('theme', 'gloobers2') .'/css/colorbox.css','file');
drupal_add_js(drupal_get_path('theme', 'gloobers2') .'/js/jquery.colorbox.js',array('scope' => 'footer'));
?>

<div class="manage-listing past-trips">
<h2>My Past Trips</h2>
<?php
echo '<h4>'.$bookingsCount." Results Found</h4>";
if(count($bookings)>0)
{

foreach ($bookings as $list)
{
/* echo "<pre>";
print_r($list);
die; */
$photos = getPhotosData($list["lid"]);

print '<div class="listing-info">';
	print '<div class="listing-left-sec">';
		if(count($photos)>0){
		$photos=reset($photos);
			foreach($photos as $photo){
			
			$photo 	= unserialize($photo);
			
			$file 	= file_load($photo["fid"]);
			$imgpath = $file->uri;
			$style 	= "thumbnail";
			
			print '<img src="'.image_style_url($style,$imgpath).'" alt="listing-image">';
		   
			}
		}	
		else
		{
		
		print '<img src="'.$base_url.'/'.variable_get('file_public_path', conf_path() . '/files/pictures/no_image.png').'" alt="listing-image" width="100px" height="100px">';
		}
		print '</div>';
		print '<div class="listing-edit-info">';
			print  '<div class="listing-data">';
			print  '<h2><a href="'.url('experience/view/'.$list['lid']).'" class="">'.ucfirst($list['title']).'</a></h2>';
			print  '<span>'.substr($list['short_description'],0,100)."....".'</span>';
			print  '<span>'.$list['city'].",".$list['state'].",".$list['country'].'</span>';
			print '</div>';
		print '</div>';
			print '<div class="listing-visibility">';
         $listReviews=getListingReviews($list['id'],$user->uid);
		 
					  if(empty($listReviews))
					  {
					  ?>
					  <a class="inline btn btn-blue2 btn-gradient form-submit" href="#reviews<?php echo $list['id'];?>">Add Your Reviews</a>
					  <?php
					  }
					  else
					  {
					  ?>
					  <a class="inline" href="#reviews-view<?php echo $list['id'];?>">View Your Reviews</a>
					  <?php					  
					  }
					 ?>
					 <div style='display:none'>
					 <div class="list-reviews" id="reviews<?php echo $list['id'];?>" style='padding:10px; background:#fff;'>
					 <?php 
					 echo drupal_render($reviewForm);
					 ?>
					  <script type="text/javascript">
						var jq = jQuery.noConflict();
							jq(document).ready(function(){
							jq("#reviews<?php echo $list['id']; ?>").find(".listid").val(<?php echo $list['id']; ?>);
							});
							</script>
					 </div>
					 <div id="reviews-view<?php echo $list['id'];?>" style='padding:10px; background:#fff;'>
						 <div class="review-view">
						 <?php 
						 echo $listReviews[0]['comments'];
						 ?>
						 </div>
					 </div>
				</div> 
				<?php	
			print '</div>';
   print '</div>';	
}
echo '<div>'.$pagination.'</div>';
}
else
{
print '<div>No Trips data Found</div>';
}

?>
</div>
<script>
			var jq = jQuery.noConflict();
			jq(document).ready(function(){
			jq(".inline").colorbox({inline:true, width:"50%"});
			});
</script>