<?php
//drupal_add_css(drupal_get_path('theme', 'gloobers') .'/css/jquery.fs.stepper.css','file'); 
drupal_add_css(drupal_get_path('theme', 'gloobers') .'/css/responsiveslides.css','file'); 
drupal_add_css(drupal_get_path('theme', 'gloobers') .'/css/demo.css','file'); 
drupal_add_css(drupal_get_path('theme', 'gloobers') .'/css/datepicker.css','file'); 
drupal_add_css(drupal_get_path('theme', 'gloobers') .'/css/jquery.datetimepicker.css','file'); 
drupal_add_css(drupal_get_path('theme', 'gloobers') .'/css/bootstrap.min.css','file'); 
drupal_add_css(drupal_get_path('theme', 'gloobers') .'/css/bootstrap-slider.css','file'); 
drupal_add_css(drupal_get_path('theme', 'gloobers') .'/css/range-slider.css','file'); 
drupal_add_css(drupal_get_path('theme', 'gloobers') .'/css/jquery.selectBoxIt.css','file'); 
drupal_add_css(drupal_get_path('theme', 'gloobers') .'/css/flexslider.css','file'); 
//drupal_add_css(drupal_get_path('theme', 'gloobers') .'/css/experience-listing.css','file'); 
drupal_add_css(drupal_get_path('theme', 'gloobers') .'/css/jRating.jquery.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers') .'/css/colorbox.css','file');  


drupal_add_js(drupal_get_path('theme', 'gloobers') .'/js/jquery.bpopup.min.js',array('scope' => 'footer')); 
drupal_add_js(drupal_get_path('theme', 'gloobers') .'/js/jquery.flexslider.js',array('scope' => 'footer')); 
drupal_add_js(drupal_get_path('theme', 'gloobers') .'/js/jquery.slimmenu.js',array('scope' => 'footer')); 
drupal_add_js(drupal_get_path('theme', 'gloobers') .'/js/jquery.selectBoxIt.min.js',array('scope' => 'footer')); 
drupal_add_js(drupal_get_path('theme', 'gloobers') .'/js/bootstrap-slider.js',array('scope' => 'footer')); 
drupal_add_js(drupal_get_path('theme', 'gloobers') .'/js/jRating.jquery.js',array('scope' => 'footer'));
drupal_add_js(drupal_get_path('theme', 'gloobers') .'/js/jquery.colorbox.js',array('scope' => 'footer'));
drupal_add_js('jQuery(document).ready(function () { jQuery(".oneall_social_login iframe").hide(); jQuery(".oneall_social_login iframe").css("heigh","59px !important"); });',
	array('type' => 'inline', 'scope' => 'footer', 'weight' => 5)
);
global $base_url;
?>
 
        <!-- ======================  slider ========================= -->
        
        	<div class="dr-full-banner">
            		<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/banner.png" alt="bungee jump" />
                    
                    <h1><?php echo isset($_GET['search']['type'])?substr($_GET['search']['type'],0,(strlen($_GET['search']['type'])-2)):''; ?> </h1>
                 
            </div><!-- banner -->
            
            
  <!-- ======================  title tab ========================= -->  
  
  	<div class="dr-title-tab">
    	<div class="dr-full-width-wrapper">
        	 <div class="dr-block-row">
             	<div class="dr-block-col border-r catagory-block">
                	<h5>Category</h5>
                	<select class="select" id="edit-product-type">
						<option value="">Select experience type</option>
						<option value="all">All</option>
						<?php
						$types = array();
						if(isset($_GET['search']['type']) && $_GET['search']['type'] != ''){
							$searchType = substr($_GET['search']['type'],0,-2);
							$types = explode(', ',$searchType);
						}
						$experienceType=getExperienceType();		
						foreach($experienceType as $key=>$value){
							$sel = '';
							if(count($types) == 1){
								if(in_array($value,$types)){
									$sel = 'selected';
								}
							}
							else if(arg(1) == $value){
								$sel = 'selected';
							}
						?>
                            <option value="<?php echo $key; ?>" <?php echo $sel; ?>><?php echo $value; ?></option>
						<?php 
						}
						?>
   					</select>
                    <div class="edit-product-category">       
                    <!--  <select class="select" id="edit-product-category">

						</select>-->
					</div>
                </div><!-- col ends -->
                
                	<div class="dr-block-col border-r rating-block">
                    
                		<h5>Ratings</h5>
                        <div class="rating-star">
                        	<!--<div class="search-basic" data-average="0" data-id="1"></div>-->
                        	<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/rating-star.png" alt="five star" />
                        </div>
                	</div><!-- col2 ends -->
                
                	<div class="dr-block-col border-r price">
                		<h5>price</h5>
							<p>
								<input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
							</p>

							<div id="slider-range"></div>
               		</div><!-- col3 ends -->       	  
             
        	</div><!-- dr block row ends -->
        </div><!-- wrapper ends -->    
    </div><!-- ttile ends -->        
            
         <div class="dr-full-width-wrapper">
         	<div class="dr-result-container">
            	<div class="dr-tab-header">
					<div class="rsult-des">
				<?php 
					if(isset($_GET['search']['place'])){
				?>
                    	<h2><?php echo (isset($_GET['search']['place']) && $_GET['search']['place'] != '')?$_GET['search']['place'].",":''; ?><span><?php echo ($_GET['search']['type'] != '')?' '.substr($_GET['search']['type'],0,(strlen($_GET['search']['type'])-2)):''; ?></span></h2>
                    		<div class="total-result">
                            	<p>(<?php echo $listingCount; ?> Results)</p>
                            </div>
                <?php 
					}
				?>
                    </div><!-- description -->
                		<div class="right-tab">
                        	<ul>
                            	<li class="active"><a class="gallery" href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/gallery-ico.png" alt="gallery view" /></a></li>
                                <li><a class="map" href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/location-ico.png" alt="gallery view" /></a></li>
                                <li><a class="list" href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/menu-ico.png" alt="gallery view" /></a></li>
                            </ul>
                        </div><!-- right tab ends -->                
                </div><!-- tab header ends --> 
                
         <!-- ======================================================= Map Article ================================================ -->
         
         <div class="tab-content-wrap">
         	<div class="result-row">
            <?php 
				$i = 1;
				if(count($listings)>0){
					foreach($listings as $listing){
						$photos = getPhotosData($listing["eid"]);
						$basePrice = getBasePrice($listing["eid"]);
						$offers = getOffersAndDiscountsData($listing["eid"]);
			?>	
                <div class="result-block loadData" id="myData_<?php echo $i; ?>">
					
                	<div class="slider-block">
						<div class="loading"></div>
                    	<div class="flexslider">
                        <ul class="slides">
							<?php 
								if(count($photos)>0){
									foreach($photos as $photo){
									$photo 	= unserialize($photo["value1"]);
									$file 	= file_load($photo["fid"]);
									$imgpath = $file->uri;
									$style = 'listing_slider';

							?>
									<li><a href="<?php echo $base_url; ?>/experience/view/<?php echo $listing["eid"]; ?>" >
										<img src="<?php print image_style_url($style,$imgpath); ?>" alt="place" />
									</a></li>
							<?php 
									}
								}
								else{
							?>
									<li><a href="<?php echo $base_url; ?>/experience/view/<?php echo $listing["eid"]; ?>" >
										<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/img/place1.png" alt="place" />
									</a></li>							
							<?php 
								}
							?>
                        </ul>
                    </div> <!-- flex ends -->
                   <?php 
						global $user;
						if(!$user->uid){
							$dest = drupal_get_destination();
							$_SESSION['destination']  = $dest["destination"];

				   ?>
						<a class="inlinepop" href="#login-popup"><div class="dr-heart">  </div></a><!-- heart ico -->
				   <?php 
						}
						else{
							$status = getWishlistStatus($listing["eid"]);
				   ?>
						<div class="dr-heart dr-heart-live" <?php if(isset($status["in_wishlist"]) && $status["in_wishlist"] == 1) {?> style='background:url("<?php echo  $base_url.'/'.drupal_get_path('theme', 'gloobers'); ?>/images/heart-ico-red.png")'; <?php }?>> <input type="hidden" value="<?php echo isset($status["in_wishlist"])?$status["in_wishlist"]:0; ?>" id="status_<?php echo $listing["eid"]; ?>" class="status"> <input type="hidden" value="<?php echo $listing["eid"]; ?>" id="listingId_<?php echo $listing["eid"]; ?>" class="listingID"> </div>
				   <?php 
						}

						if(!empty($offers)){
							foreach($offers as $offer){
								if($offer['offer_type'] == '24 Hour Offer'){
									$dates = unserialize($offer['date']);
									if($dates["offer_24_hour_offer_date"] == date('Y-m-d')){
				   ?>						
				<div class="dr-timing">
						<i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/alarm-ico.png" alt="time" /></i>
						<p>24h</p>
					 </div><!-- heart ico -->
					 <?php 
						}
						foreach($dates["24_hour_offer_date_extra"] as $key=>$value){
							if($value == date('Y-m-d')){
					?>
				<div class="dr-timing">
						<i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/alarm-ico.png" alt="time" /></i>
						<p>24h</p>
					 </div><!-- heart ico -->
					 <?php 
							}
						}
					}
					else{
					?>
				<div class="dr-timing-birds">
							<p><span>EARLY</span></p>
							<p><small>BIRDS</small></p>
							<i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/bird-cal-ico.png" alt="time" /></i>
						 </div><!-- early birds -->
				 <?php 
						}
							}
						}
			?>
                    <div class="dr-pricing">
                    	<div class="price-range">
                            <p><small>From</small></p>
                            <p><?php echo $listing["min_price"]; ?> $</p>
                        </div><!-- price range -->
                    </div><!-- heart ico -->
                    
                    
                    
                    </div><!-- slide ends -->
   
                          <div class="commenter">
                            <div class="cmntr-profile">
							<?php 
								$userDetails = user_load($listing["uid"]);
								if($userDetails->picture != ""){
									$file 	= file_load($userDetails->picture->fid);
									$imgpath = $file->uri;
									$style="user_small";
							?>
								<img src="<?php print image_style_url($style,$imgpath); ?>" alt="display pic" />
							<?php 
								}
								else{
							?>
								<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/no-profile-male-img.jpg" alt="display pic" width="70px" />
							<?php 
								}
							?>
                            </div><!-- cmnter pro -->         
                         </div><!-- cmmntr ends -->
	<!------------------------------------------------------------------------------------------------------------>		
             <a href="<?php echo $base_url; ?>/experience/view/<?php echo $listing["eid"]; ?>" >
				<div class="outer-experience"> 
					<div class="place-rating">
						<?php 
						if($listing["average_ratings"] != "")
						{
						?>
							<div class="basic" data-average="<?php echo $listing["average_ratings"]; ?>" data-id="1"></div>
						<?php 
						}
						else{
						?>
							<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="rate" />
							<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="rate" />
							<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="rate" />
							<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="rate" />
							<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star-ico.png" alt="rate" />						
						<?php 
						}
						?>
					</div><!-- ratin ends -->
					
					<h4><?php echo ucwords($listing["title"]); ?></h4>
					<p><?php echo $listing["city"]; ?>, <?php echo $listing["state"]; ?></p>
					<p><a href="<?php echo $base_url; ?>/experience/<?php echo $listing["experience_type"]; ?>"><span><?php echo $listing["experience_type"]; ?></span></a></p> 
							
				</div>
		   	</a>						
           <!--------------------------------------------------------------------------------------------------------------------------->                   
                                        <div class="share-outer-vj">
                                        	<div id="share-<?php echo $i;?>" class="share share-result">
                                            	<i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/plane-ico-b.png" alt="share" /></i>
                                                <p>Share with your friends</p>
                                                <small><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/move-right.png" alt="share" /></small>
                                            </div><!-- result share --> 
                                               
                                            <div id="quick-share" class="quick-share">
                                                	<ul>
                                                    	<li><p>Add to MY</p><div class="circle">+</div></li>
                                                        <li><p><span>Embed</span></p><input type="text" placeholder="<iframe width="560" heigh..." /></li>
                                                        <li class="social">
                                                        	<div class="soical fb"><a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/fb-ico-w.png" alt="ico" /></a></div>
                                                            <div class="soical twt"><a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/twt-ico-w.png" alt="ico" /></a></div>
                                                            <div class="soical ggl"><a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/ggl-ico-w.png" alt="ico" /></a></div>
                                                            <div class="soical plus"><a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/plus-ico-w.png" alt="ico" /></a></div>
                                                         </li>
                                                    </ul>
                                                </div><!-- quick ends -->
                    					</div> <!-- toggle wrap -->
                                        
                </div><!-- block ends -->   
						
            <?php
					$i++;
					}
				}
				else{
			?> 
					<span class="no-result">No listing found </span>
			<?php 
				}
			?>  
            </div><!-- row ends --> 
			<div class="tableRow">
				<div class="secondColumn" id="loaderImg" style="display:none;"></div>
			</div>       
            <!-- <div class="more-results">
                        	<a href="#" class="load-more">Load more</a>
              </div><!-- more results -->
         </div><!-- tab contanet wrapper -->  
            </div><!-- result cotainer ends --> 

					<div style='display:none;'>
						<div id='login-pop'>
							<div class="login-wrapper">
								<div class="panel-heading">
									<div class="panel-title"> <i class="fa fa-lock"></i> Login </div>
									<span class="panel-title-sm">Not <b>Cynthia Blue?</b></span> 
								</div>
								<div class="panel-body">
									<div class="login-avatar"> <img width="150" height="112" alt="avatar" src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/login.png"> </div>
									<!--<div class="login_socialmedia"> 
										<a href="#"> <img alt="facebook" src="http://dev.gloobers.com/sites/all/themes/gloobers/images/facebook.png"></a> 
										<a href="#"> <img alt="google" src="http://dev.gloobers.com/sites/all/themes/gloobers/images/google.png"></a>  
										<a href="#"> <img alt="twitter" src="http://dev.gloobers.com/sites/all/themes/gloobers/images/twitter.png"></a>
										<a href="#"> <img alt="linkedin" src="http://dev.gloobers.com/sites/all/themes/gloobers/images/linkedin.png"></a>
									</div> -->
									<?php 
									$user_login_form = drupal_get_form('user_login_block');
									echo drupal_render($user_login_form);
									?>
								</div>
							</div>
						</div>
					</div>
					
         </div><!-- wrapper -->   
 
 <!-- ====================== popup ============================ -->
 
 <!-- Button that triggers the popup -->
            <div class="more-social-options">
              <div class="social-content">
                 <span class="button b-close"><span>X</span></span>
                 <ul>
                 	<li><a href="#"><i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/msg-ico.png" alt="message" /></i><span>Email</span></a></li>
                    <li class="active"><a href="#"><i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/social-ico.png" alt="message" /></i><span>Share</span></a></li>
                    <li><a href="#"><i><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/plus-social.png" alt="message" /></i><span>Add To</span></a></li>
                 </ul>
                	 
                     <div class="social-share">
                     	<p>Share with social network</p>
                     		
                            <ul class="soical-networks">
                            	<li class="scl1"><a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/fb-ico-w.png" alt="icon" /></a></li>
                                <li class="scl2"><a class="" href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/twt-ico-w.png" alt="icon" /></a></li>
                                <li class="scl3"><a class="" href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/ggl-ico-w.png" alt="icon" /></a></li>
                                <li class="scl4"><a class="" href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/s-p4.png" alt="icon" /></a></li>
                                <li class="scl5"><a class="" href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/s-p5.png" alt="icon" /></a></li>
                                <li class="scl6"><a class="" href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/s-p6.png" alt="icon" /></a></li>
                                <li class="scl7"><a class="" href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/s-p7.png" alt="icon" /></a></li>
                                <li class="scl8"><a class="" href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/s-p8.png" alt="icon" /></a></li>
                                <li class="scl9"><a class="" href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/s-p9.png" alt="icon" /></a></li>
                                <li class="scl10"><a class="" href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/s-p10.png" alt="icon" /></a></li>
                            </ul><!-- networks -->
                     
                     <p>Share a link</p>
                     <div class="share-input">
                     	<input type="text" placeholder="http://gloobers.com/adrenaline-extreme/base-jumping-by" />
                        <button>copy</button>
                     </div>
                     
                     <p>Embed on a website</p>
                         <div class="share-input textarea">
                            <textarea placeholder=" Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor."></textarea>
                            <button>copy</button>
                         </div>
                     
                     </div><!-- sociual share -->
                
            	</div><!-- social conent close -->
            </div>
			
   <script type="text/javascript" charset="utf-8">
			jQuery(window).load(function() {
			jQuery("#edit-name").attr('placeholder','Enter Your Username');
			jQuery("#edit-pass").attr('placeholder','Enter Your Password');
			jQuery('.flexslider').flexslider({slideshow: false});
			
            jQuery(document).on('click','.plus',function(e) {

                // Prevents the default action to be triggered. 
                e.preventDefault();

                // Triggering bPopup when click event is fired
                jQuery('.more-social-options').bPopup({
				 
				zIndex: 101,
				modalClose: false,
				speed: 650,
				transition: 'slideIn',
				transitionClose: 'slideBack',
				modalColor: '#000',
					 
				
			});

            });
				});
				
/* 	jQuery( ".share" ).live('click',function() {

		jQuery(this).parent().find(".quick-share").toggle( "slow");
		
	});	 */
       
				
	</script>
	
  <script> 

   jQuery(document).ready(function() {  
	   jQuery(".select").selectBoxIt({
	   showFirstOption: false,
	  
	  });	
	jQuery(".basic").jRating({
		bigStarsPath: "<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/icons/stars.png",
		isDisabled : true,
		length : 5,
		type : 'small'
	});
	
	jQuery('.search-basic').jRating({
		canRateAgain : true,
		showRateInfo:false,
		decimalLength:1,
		nbRates : 10000,
		phpPath : "<?php print $GLOBALS['base_url'].'/listing/review/data'; ?>",
		bigStarsPath : "<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/images/icons/star-ico-gray.png",
		onClick:function(element,rate) {
			//$(".result-row").append("<span class='loading'><img src='<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/loading_1.gif'/></span>");
		},		
		onSuccess : function(elem,rate){
			jQuery.ajax({
				type: 'POST',
				async:false,
				url : "<?php echo $base_url; ?>/experience",
				data : {'rate':rate,'action':'filter'},
						success: function(data){
							data = jq.parseJSON(data);
							if(data.count == 0){
								jq(".result-row").html("<span class='no-result'>No results found</span>");
							}
							else{
								jq(".result-row").html(data.string);
							}
							var bannerText = '';
							if(jq("#edit-product-type").find("option:selected").val() != ''){
								bannerText = jq("#edit-product-type").find("option:selected").text();
								jq("#edit-product-typeSelectBoxIt").addClass("dr-active");
							}
							jq(".dr-full-banner").find("h1").text(bannerText);
							jq(".rsult-des").find("h2").remove();
							jq(".rsult-des").find("div").remove();
							jq(".rsult-des").append("<h2><span>"+bannerText+"</span></h2><div class='total-result'><p>("+data.count+" Results)</p></div>");
						},
				error: function(data){
				console.log('55');
					alert("ajax error occured�1"+data);
				}
			})
	
		},
		onError : function(){
			alert('Error : please retry');
		}
	});
	<?php 
		$minPrice = getMinimumListingPrice();
		$maxPrice = getMaximumListingPrice();
	?>
	jQuery( "#slider-range" ).slider({
		range: true,
		min: <?php echo $listing["min_price"]; ?>,
		max: <?php echo $listing["max_price"]; ?>,
		values: [ <?php echo $listing["min_price"]; ?>, <?php echo $listing["max_price"]; ?> ],
		slide: function( event, ui ) {
			jQuery( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
		},
		change: function( event, ui ) {
		var typeId = jq('#edit-product-type').val();
		if(typeId == null){
			typeId = '';
		}
		var catID = jq('#edit-product-category').val();
		if(catID == null){
			catID = '';
		}
		var dataString = new Array();
		
	<?php 
		if(isset($_GET["search"])){
	?>
			var place = '<?php echo $_GET["search"]["place"]; ?>'
			var etype = '<?php echo $_GET["search"]["type"]; ?>'
			var when = '<?php echo $_GET["search"]["when"]; ?>'
			var person = '<?php echo $_GET["search"]["person"]; ?>'
			
			if(typeId.length != 0 && catID.length != 0){
			
				if(typeId == 'all'){
					dataString = {'place':place,'when':when,'person':person,'catID':catID,'min':ui.values[ 0 ],'max':ui.values[ 1 ],'action':'search'};
				}
				else{
					dataString = {'place':place,'when':when,'person':person,'catID':catID,'typeId':typeId,'min':ui.values[ 0 ],'max':ui.values[ 1 ],'action':'search'};
				}
			}
			else if(typeId.length != 0 && catID.length == 0){

				if(typeId == 'all'){
					dataString = {'place':place,'when':when,'person':person,'min':ui.values[ 0 ],'max':ui.values[ 1 ],'action':'search'};
				}
				else{
					dataString = {'place':place,'when':when,'person':person,'typeId':typeId,'min':ui.values[ 0 ],'max':ui.values[ 1 ],'action':'search'};
				}			
			}
			else if(typeId.length == 0 && catID.length != 0){
				dataString = {'place':place,'when':when,'person':person,'catID':catID,'min':ui.values[ 0 ],'max':ui.values[ 1 ],'action':'search'};
			}
			else{
				dataString = {'place':place,'when':when,'person':person,'min':ui.values[ 0 ],'max':ui.values[ 1 ],'action':'search'};
			}
	<?php 
		}
		else{
	?>
			if(typeId.length != 0 && catID.length != 0){
				if(typeId == 'all'){
					dataString = {'catID':catID,'min':ui.values[ 0 ],'max':ui.values[ 1 ],'action':'filter'};
				}
				else{
					dataString = {'catID':catID,'typeId':typeId,'min':ui.values[ 0 ],'max':ui.values[ 1 ],'action':'filter'};
				}
			}
			else if(typeId.length != 0 && catID.length == 0){
				if(typeId == 'all'){
					dataString = {'min':ui.values[ 0 ],'max':ui.values[ 1 ],'action':'filter'};
				}
				else{
					dataString = {'typeId':typeId,'min':ui.values[ 0 ],'max':ui.values[ 1 ],'action':'filter'};
				}
			}
			else if(typeId.length == 0 && catID.length != 0){
				dataString = {'catID':catID,'min':ui.values[ 0 ],'max':ui.values[ 1 ],'action':'filter'};
			}
			else{
				dataString = {'min':ui.values[ 0 ],'max':ui.values[ 1 ],'action':'filter'};
			}
	<?php 
		}
	?>
					jQuery.ajax({
						type: 'POST',
						async:false,
						url : "<?php echo $base_url; ?>/experience",
						data : dataString,
						beforeSend: function(){
							jQuery(".result-row").append("<span class='loading'><img src='<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/loading_1.gif'/></span>");
						},
  						success: function(data){
							data = jq.parseJSON(data);
							if(data.count == 0){
								jq(".result-row").html("<span class='no-result'>No results found</span>");
							}
							else{
								jq(".result-row").html(data.string);
							}
							var bannerText = '';
							if(jq("#edit-product-type").find("option:selected").val() != ''){
								bannerText = jq("#edit-product-type").find("option:selected").text();
							}
							jq(".dr-full-banner").find("h1").text(bannerText);
							jq(".rsult-des").find("h2").remove();
							jq(".rsult-des").find("div").remove();
							jq(".rsult-des").append("<h2><span>"+bannerText+"</span></h2><div class='total-result'><p>("+data.count+" Results)</p></div>");
						},
						error: function(data){
						console.log('44');
							alert("ajax error occured�2"+data);
						}
					})
		}
	});
	jQuery( "#amount" ).val( "$" + jQuery( "#slider-range" ).slider( "values", 0 ) +
		" - $" + jQuery( "#slider-range" ).slider( "values", 1 ) );
	
	var jq = jQuery;
	jq('#edit-product-type').on('change', function() {
	var dataString = new Array();

	var min = 	jQuery( "#slider-range" ).slider( "values", 0 );
	var max = 	jQuery( "#slider-range" ).slider( "values", 1 );
	
	jq.ajax({
				type: "GET",
				url: "<?php echo $base_url; ?>/product/ajax/getExperienceCategory",
				//dataType: "json",
				data: "typeId=" + encodeURI(this.value) +"&action=filter",
				success: function(msg){
					jq('.edit-product-category').html("");
					
					jq('.edit-product-category').html(msg);
					
				}
	});
	<?php 
		if(isset($_GET["search"])){
	?>
			var place = '<?php echo $_GET["search"]["place"]; ?>'
			var etype = '<?php echo $_GET["search"]["type"]; ?>'
			var when = '<?php echo $_GET["search"]["when"]; ?>'
			var person = '<?php echo $_GET["search"]["person"]; ?>'
			if(this.value == 'all'){
				dataString = {'place':place,'when':when,'person':person,'min':min,'max':max,'action':'search'};
			}
			else{
				dataString = {'place':place,'when':when,'person':person,'typeId':this.value,'min':min,'max':max,'action':'search'};
			}
	<?php 
		}
		else{
	?>
			if(this.value == 'all'){
				dataString = {'min':min,'max':max,'action':'filter'};
			}
			else{
				dataString = {'typeId':this.value,'min':min,'max':max,'action':'filter'};
			}
	<?php 
		}
	?>	
	jq.ajax({
		type: 'POST',
		async:false,
		beforeSend: function(){
			jQuery(".result-row").append("<span class='loading'><img src='<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/loading_1.gif'/></span>");
		},
		url : "<?php echo $base_url; ?>/experience",
		data : dataString,
		success: function(data){
			data = jq.parseJSON(data);
			if(data.count == 0){
				jq(".result-row").html("<span class='no-result'>No results found</span>");
			}
			else{
				jq(".result-row").html(data.string);
			}
			var bannerText = jq("#edit-product-type").find("option:selected").text();
			if(bannerText != 'All'){
				jq(".dr-full-banner").find("h1").text(bannerText);
			}
			jq(".rsult-des").find("h2").remove();
			jq(".rsult-des").find("div").remove();
			jq(".rsult-des").append("<h2><span>"+bannerText+"</span></h2><div class='total-result'><p>("+data.count+" Results)</p></div>");
			if(bannerText != 'All'){
				jq("#home-exp-type").val(bannerText+',');
			}
			else{
				jq("#home-exp-type").val('');
			}		
		},
		error: function(data){
		console.log('33');
			alert("ajax error occured�3"+data);
		}
	})
					
	});
	
	jq(document).on('change','#edit-product-category', function() {
	if(jq('#edit-product-type').val()!="")
	{
	jq("#edit-product-typeSelectBoxIt").addClass("dr-active");
	}
		var typeId = jq('#edit-product-type').val();
		var min = 	jQuery( "#slider-range" ).slider( "values", 0 );
		var max = 	jQuery( "#slider-range" ).slider( "values", 1 );
		<?php 
			if(isset($_GET["search"])){
		?>
				var place = '<?php echo $_GET["search"]["place"]; ?>'
				var etype = '<?php echo $_GET["search"]["type"]; ?>'
				var when = '<?php echo $_GET["search"]["when"]; ?>'
				var person = '<?php echo $_GET["search"]["person"]; ?>'
				if(typeId == 'all'){
					dataString = {'place':place,'when':when,'person':person,'catID':this.value,'min':min,'max':max,'action':'search'};
				}
				else{
					dataString = {'place':place,'when':when,'person':person,'catID':this.value,'typeId':typeId,'min':min,'max':max,'action':'search'};
				}
		<?php 
			}
			else{
		?>
				dataString = {'catID':this.value,'typeId':typeId,'min':min,'max':max,'action':'filter'};
		<?php 
			}
		?>		
		jq.ajax({
			type: 'POST',
			async:false,
			url : "<?php echo $base_url; ?>/experience",
			beforeSend: function(){
				jQuery(".result-row").append("<span class='loading'><img src='<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/loading_1.gif'/></span>");
			},
			data : dataString,
			success: function(data){
				data = jq.parseJSON(data);
				if(data.count == 0){
					jq(".result-row").html("<span class='no-result'>No results found</span>");
				}
				else{
					jq(".result-row").html(data.string);
				}
				var bannerText = jq("#edit-product-type").find("option:selected").text();
				jq(".dr-full-banner").find("h1").text(bannerText);
				jq(".rsult-des").find("h2").remove();
				jq(".rsult-des").find("div").remove();
				jq(".rsult-des").append("<h2><span>"+bannerText+"</span></h2><div class='total-result'><p>("+data.count+" Results)</p></div>");
			},
			error: function(data){
			console.log('11');
				console.log("ajax error occured�4"+data);
			}
		})
					
	});


  });	

jQuery(document).ready(function(){

jQuery(window).on('scroll', function(){
	scrollMore();
});

function scrollMore(){
	//console.log("Scrol To=="+$(window).scrollTop()+" document height=="+$(document).height()+" window height=="+$(window).height());
	if(jQuery(window).scrollTop() == (jQuery(document).height() - jQuery(window).height())){
	
		var offset = jQuery('[id^="myData_"]').length; // here we find out total records on page.

		jQuery(window).unbind("scroll");
		jQuery("#loaderImg").html('<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/gloober-preeloader-f1.gif" />');
		jQuery("#loaderImg").show();
		loadMoreData(offset);
		
	}
}

function loadMoreData(offset){
	var typeId = jq('#edit-product-type').val();
	if(typeId == null){
		typeId = '';
	}
	var catID = jq('#edit-product-category').val();
	if(catID == null){
		catID = '';
	}
	var min = 	jQuery( "#slider-range" ).slider( "values", 0 );
	var max = 	jQuery( "#slider-range" ).slider( "values", 1 );
	var dataString = new Array();
	
	<?php 
		if(isset($_GET["search"])){
	?>
			var place = '<?php echo $_GET["search"]["place"]; ?>'
			var etype = '<?php echo $_GET["search"]["type"]; ?>'
			var when  = '<?php echo $_GET["search"]["when"]; ?>'
			var person = '<?php echo $_GET["search"]["person"]; ?>'
			if(typeId.length != 0 && catID.length != 0){
				if(typeId == 'all'){
					dataString = {'place':place,'when':when,'person':person,'catID':catID,'min':min,'max':max,'action':'search','offset':offset};
				}
				else{
					dataString = {'place':place,'when':when,'person':person,'catID':catID,'typeId':typeId,'min':min,'max':max,'action':'search','offset':offset};
				}
			}
			else if(typeId.length != 0 && catID.length == 0){
			
				if(typeId == 'all'){
					dataString = {'place':place,'when':when,'person':person,'min':min,'max':max,'action':'search','offset':offset};
				}
				else{
					dataString = {'place':place,'when':when,'person':person,'typeId':typeId,'min':min,'max':max,'action':'search','offset':offset};
				}
			}
			else if(typeId.length == 0 && catID.length != 0){
				dataString = {'place':place,'type':etype,'when':when,'person':person,'catID':catID,'min':min,'max':max,'action':'search','offset':offset};
			}
			else{
				dataString = {'place':place,'type':etype,'when':when,'person':person,'min':min,'max':max,'action':'search','offset':offset};
			}
	<?php 
		}
		else{
	?>
			if(typeId.length != 0 && catID.length != 0){
			
				if(typeId == 'all'){
					dataString = {'catID':catID,'min':min,'max':max,'action':'filter','offset':offset};
				}
				else{
					dataString = {'catID':catID,'typeId':typeId,'min':min,'max':max,'action':'filter','offset':offset};
				}
			}
			else if(typeId.length != 0 && catID.length == 0){
				if(typeId == 'all'){
					dataString = {'min':min,'max':max,'action':'filter','offset':offset};
				}
				else{
					dataString = {'typeId':typeId,'min':min,'max':max,'action':'filter','offset':offset};
				}
			}
			else if(typeId.length == 0 && catID.length != 0){
				dataString = {'catID':catID,'min':min,'max':max,'action':'filter','offset':offset};
			}
			else{
				dataString = {'min':min,'max':max,'action':'filter','offset':offset};
			}
	<?php 
		}
	?>
	jQuery.ajax({
		type: 'POST',
		async:false,
		url : "<?php echo $base_url; ?>/experience",
		data : dataString,
		success: function(data){
			jQuery("#loaderImg").empty();
			if(data.length > 0){
				jQuery("#loaderImg").hide();
			}
			else{
				jQuery("#loaderImg").html("<span>No more results..</span>");
			}
			//$(".loadData :last").after(data);
			jQuery(".result-row").append(data);
		},
		error: function(data){
		console.log('22');
			alert("ajax error occured�5"+data);
		}
	}).done(function(){
		jQuery(window).on("scroll",function(){
		scrollMore();	
	});
	});
}


});

jQuery(document).ready(function($){
  jQuery(".inlinepop").colorbox({inline:true, width:"40%", href:"#login-pop"});
});
	var jq = jQuery;
	jq(document).on('click','.dr-heart-live', function() {
		var status = jq(this).find('.status').val();
		var listingId = jq(this).find('.listingID').val();
		jq.ajax({
			type: 'POST',
			async:false,
			url : "<?php echo $base_url; ?>/add/wishlist",
			data : {'status':status,'listingId':listingId,},
			success: function(data){
				data = data.split('-');
				if(data[0] == 0){
					jq("#listingId_"+data[1]).parent().css('background','url("<?php echo  $base_url."/".drupal_get_path('theme', 'gloobers'); ?>/images/heart-ico.png") no-repeat scroll center center rgba(0, 0, 0, 0)');
					jq("#status_"+data[1]).val(data);
				}
				else{
					jq("#listingId_"+data[1]).parent().css('background','url("<?php echo  $base_url."/".drupal_get_path('theme', 'gloobers'); ?>/images/heart-ico-red.png") no-repeat scroll center center rgba(0, 0, 0, 0)');
					jq("#status_"+data[1]).val(data);
				}
			},
			error: function(data){
				alert("ajax error occured�6"+data);
			}
		})
					
	});
	jQuery( "#search-out" ).click(function() {
		jQuery( "#short-search" ).toggle( "slow", function() {
	 
		});
	});
	
	function preloader(){
		jQuery(".loading").hide();
		jQuery(".flexslider").show();
	}
	window.onload = preloader;
   </script>
   
 