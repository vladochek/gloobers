<?php
	global $user,$base_url;
	$userdetails = user_load($user->uid);
	$commisson=getCommisionByuserForBooking("",$user->uid);	
	if($commisson['commission']!="")
		{
		$comm=$commisson['commission'];
		}
		else if(variable_get('commission')!="")
		{
		$comm=variable_get('commission');
		}
		else
		{
		$comm="0.0";
		}
	$totalProfit=getTotalAmountEarnedByUser($user->uid);
	$profit=$totalProfit['grand_profit']-($totalProfit['refund_total']+$totalProfit['trans_fees_total']);
	$banner_path=$userdetails->picture->uri;
	($banner_path)?$banner_path:'';
	$banner_Style="user_dashboard_banner";
	$banner_profile_Style="experience_topranked";
	$countryName=getcountryname($userdetails->field_country['und'][0]['iso2']);
	//echo "<pre>";Print_r($userListing);exit;
?>
<section class="topbar">
  <div class="dr-wrapper">
    <div class="links">
      <ul>
        <li><a href="#">Home</a></li>
        <li>-</li>
        <li><a href="#">Profile</a></li>
        <li>-</li>
        <li><a href="#"><?php echo ucfirst($userdetails->name); ?></a></li>
      </ul>
    </div>
  </div>
</section>
<section class="col-lg-12 user-sec nopadding">
  <div class="dr-wrapper">
    <div class="user-banner"> 
		<img src="<?php echo  $base_url.'/sites/all/themes/gloobers_new/images/user/' ?>user-profile.jpg" alt=" ">
      <div class="user-name">
			<?php if($banner_path !=''){  ?>
						<img src="<?php print image_style_url($banner_profile_Style,$banner_path); ?>" alt=" ">
			<?php  }else{ ?>
						<img src="<?php echo $base_url.'/sites/all/themes/gloobers_new/images/no-profile-male-img.jpg'; ?>" alt="Dumy Experience image">
			<?php } ?>
		
        <p><Span><?php echo ucfirst($userdetails->name); ?></Span><br/>
          <?php echo ucfirst($userdetails->field_state['und'][0]['safe_value']); ?>,<?php echo ' '.ucfirst($countryName['name']); ?>
		</p>
      </div>
    </div>
    <div class="about-matt">
      <div class="sec-rat"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
        <p>( 724 Recommendations followed )</p>
      </div>
      <h2>About <?php echo ucfirst($userdetails->name); ?></h2>
		<p>
			<?php echo ucfirst($userdetails->field_about_yourself['und'][0]['safe_value']); ?>
		</p>
	  <div class="col-md-3 block">
        <p>Facebook <br>
          <span>Connected</span></p>
      </div>
      <div class="col-md-3 block">
        <p>Email <br>
          <span>Verified</span></p>
      </div>
      <div class="col-md-3 block">
        <p>Telephone <br>
          <span>Verified</span></p>
      </div>
      <div class="col-md-3 block">
        <p>Friends <br>
          <strong>284</strong></p>
      </div>
    </div>
  </div>
  <div class="bg-back2">
    <div class="dr-wrapper">
      <div class="col-lg-12 travpass">
        <h2>Travel passions</h2>
			<?php  foreach($userpassions as $userpassion){
						$file=file_load($userpassion['fid_thumb']);
						$imagePath=$file->uri;
						
			?>
				<div class="col-md-3 icontext">
					<img src="<?php print file_create_url($imagePath); ?>" alt=" ">
					<p><?php echo ucfirst($userpassion['passion']); ?></p>
				</div>
			<?php } ?>
      </div>
    </div>
  </div>
  <div class="dr-wrapper">
    <div class="mapinfo">
      <h2>Passeport</h2>
      <div class="col-lg-12">
        <div class="col-md-4 mapblock">
          <p>Hometown <br>
            <span><?php echo ucfirst($countryName['name']);?></span></p>
        </div>
        <div class="col-md-4 mapblock">
          <p>Countries visited <br>
            <span>284</span></p>
        </div>
        <div class="col-md-4 mapblock">
          <p>Reviews <br>
            <span>67</span></p>
        </div>
        <div class="mappart">
          <iframe width="800" height="500" frameborder="0" style="border:0" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d94214.18946019579!2d-92.3630410397186!3d42.44490055268727!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x87e551f0dd63dc31%3A0x9797f41431602601!2sLost+Island+Waterpark!5e0!3m2!1sen!2sin!4v1423825841993"></iframe>
        </div>
      </div>
    </div>
  </div>
  <div class="bg-back2">
    <div class="dr-wrapper">
      <div class="col-lg-12 nopadding">
        <div class="list-stuf">
          <h2>Listing</h2>
          <div class="col-md-6 tagline"> <img src="<?php echo $base_url.'/sites/all/themes/gloobers_new/images/user/' ?>clientpic.JPG" alt=" ">
            <p>Your friend david reviewed this listing</p>
          </div>
		  <?php foreach($userListing as $userListin){
					$photos = getPhotosData($userListin['eid']);
					$file=unserialize($photos[0]['value1']);
					$file=file_load($file['fid']);
					$Imgpath_listing=($file->uri)?$file->uri:'';					
					$style_imgPath_list='user_dashboard_listing';
					//echo "<pre>";Print_r($file);exit;

		  ?>
			  <div class="col-md-4 sectionlist about-mattonlist">
				<div class="blocklist">
					<?php if($Imgpath_listing !=''){  ?>
						<img src="<?php print image_style_url($style_imgPath_list,$Imgpath_listing); ?>" alt=" ">
					<?php  }else{ ?>
						<img src="<?php echo $base_url.'/sites/all/themes/gloobers_new/images/dumy_list_image.jpg'; ?>" alt="Dumy Experience image">
					<?php } ?>
				  <div class="listpro"> 
				  <?php if($banner_path !=''){  ?>
						<img src="<?php print image_style_url($banner_profile_Style,$banner_path); ?>" alt=" "> </div>
					<?php  }else{ ?>
						<img src="<?php echo $base_url.'/sites/all/themes/gloobers_new/images/no-profile-male-img.jpg'; ?>" alt="Dumy Experience image">
					<?php } ?>
				  
				  				</div>
				<div class="listname">
				  <h3><?php echo $userListin['title']; ?></h3>
				  <p><?php echo $userListin['address1'].', '; ?><?php echo $userListin['country']; ?> <span><?php echo $userListin['state']; ?></span> </p>
				</div>
			  </div>
		  <?php } ?>
        </div>
      </div>
    </div>
  </div>
  <div class="dr-wrapper">
    <div class="col-lg-12 nopadding">
      <div class="guide-travel">
        <h2>Travel guides</h2>
        <div class="col-md-6 travelblock"> <img src="<?php echo $base_url.'/sites/all/themes/gloobers_new/images/user/' ?>travel.jpg" alt=" ">
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
            <h3>Parifornie</h3>
            <p class="text">Where US frenchies hide in the city of light</p>
            <div class="topspace">
              <p>Recommended for<br>
                <span>Backpackers, Trensetters, Students</span></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 travelblock"> <img src="<?php echo $base_url.'/sites/all/themes/gloobers_new/images/user/' ?>travel.jpg" alt=" ">
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
            <h3>Parifornie</h3>
            <p class="text">Where US frenchies hide in the city of light</p>
            <div class="topspace">
              <p>Recommended for<br>
                <span>Backpackers, Trensetters, Students</span></p>
            </div>
          </div>
        </div>
        <div class="guidelink">
          <p><a href="#">And 7 more travel guides</a></p>
        </div>
      </div>
      <div class="list-stuf">
        <h2>Reviews <span>( 56 Reviews )</span></h2>
        <div class="col-md-4 sectionlist">
          <div class="blocklist"> <img src="<?php echo $base_url.'/sites/all/themes/gloobers_new/images/user/' ?>listing1.jpg" alt=" ">
            <div class="listpro"> <img src="<?php echo $base_url.'/sites/all/themes/gloobers_new/images/user/' ?>clientpic.JPG" alt=" "> </div>
          </div>
          <div class="listname">
            <h3>Miznon paris</h3>
            <p>Le marais, pairs <span>Streetfood</span> </p>
          </div>
        </div>
        <div class="col-md-4 sectionlist">
          <div class="blocklist"> <img src="<?php echo $base_url.'/sites/all/themes/gloobers_new/images/user/' ?>listing1.jpg" alt=" ">
            <div class="listpro"> <img src="<?php echo $base_url.'/sites/all/themes/gloobers_new/images/user/' ?>clientpic.JPG" alt=" "> </div>
          </div>
          <div class="listname">
            <h3>Miznon paris</h3>
            <p>Le marais, pairs <span>Streetfood</span> </p>
          </div>
        </div>
        <div class="col-md-4 sectionlist">
          <div class="blocklist"> <img src="<?php echo $base_url.'/sites/all/themes/gloobers_new/images/user/' ?>listing1.jpg" alt=" ">
            <div class="listpro"> <img src="<?php echo $base_url.'/sites/all/themes/gloobers_new/images/user/' ?>clientpic.JPG" alt=" "> </div>
          </div>
          <div class="listname">
            <h3>Miznon paris</h3>
            <p>Le marais, pairs <span>Streetfood</span> </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>