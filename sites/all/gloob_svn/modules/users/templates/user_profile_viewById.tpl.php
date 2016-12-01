<?php
$passionData="";
if($userDetails['first_name'])
{
$name=$userDetails['first_name']." ".$userDetails['last_name'];
}
else
{
$name=$userDetails['name'];
}

$userim=user_load($userDetails['uid']); 

$passion=array();
if(count($userPassions)>0)
{
foreach($userPassions as $passions)
{
array_push($passion,$passions['passion']);
}
$passionData=implode(" , ",$passion);
}


?>
<div class="dm-dashboard-wrapper mytrips">
<div class="col-md-7">
          <div class="row">
            <div class="col-md-10">
              <div class="panel profile-panel">
                <div class="panel-heading">
                  <div class="panel-title"> <i class="fa fa-user"></i> User Profile</div>
                  
                  
                </div>
                <div class="panel-body">
                  <div class="row">
                    <div id="profile-avatar" class="col-xs-3"> 
					<?php 
						if($userim->picture){
							$file = file_load($userim->picture->fid);
							$imgpath = $file->uri;
							
								?>
						<img src="<?php print image_style_url("thumbnail", $imgpath); ?>">
				<?php 
					}
					else{
				?>
			<img src="<?php echo $base_url."/".drupal_get_path('theme','gloobers2').'/images/no-profile-male-img.jpg'; ?>" width="100">
			<?php 
				}
			?> 
					<!--<img width="150" height="112" alt="avatar" class="img-responsive" src="img/avatars/login.png">-->
					</div>
                    <div class="col-xs-7">
                      <div class="profile-data"> <span class="profile-name"> <b class="text-primary"><?php echo ucwords($name);?></b></span> <span class="profile-email"><?php echo $userDetails['mail'];?></span>
                        <ul class="profile-info list-unstyled">
                          <li><i class="fa fa-phone"></i> <?php echo ($userDetails['phone'])?$userDetails['phone']:'';?></li>
                          <li><i class="fa fa-globe"></i> <?php echo ($userDetails['address'])?$userDetails['address'].",":'';echo ($userDetails['state'])?$userDetails['state'].",":'';echo ($userDetails['country'])?$userDetails['country'].",":'';?></li>
                        </ul>
                      </div>
                    </div>
					<div class="user-passions col-xs-9">
					<h4>Passions</h4>
					<p><?php echo $passionData;?></p>
					</div>
                  </div>
                  <div class="clearfix"></div>
                </div>
                <div class="panel-footer">
                  <div class="row">
                    
                  
                   
                  </div>
                </div>
              </div>
            </div>
			<!--my past trips-->
			<div class="col-xs-10">
			<?php
			if(count($pastTrips)>0)
			{
			print '<h3>Past Trips</h3>';
			$trips=array_slice($pastTrips,0,4);
			foreach($trips as $trip)
			{
			$photos = getPhotosData($trip["lid"]);
			print '<div class="col-md-12">';
		     print '<div class="listing-left-sec col-xs-3">';
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
		$listReviews=getListingReviews($trip['id'],arg(2));
			?>
			<div class="col-md-9">
			<ul class="profile-info list-unstyled">
			              <li><a href="<?php echo url('experience/view/'.$trip['lid']);?>"><b><?php echo $trip['title'];?></b></a></li>
                          <li> <?php echo substr($trip['short_description'],0,100)."....";?></li>
                          <li><?php echo ($trip['city'])?$trip['city'].",":'';echo ($trip['state'])?$trip['state'].",":'';echo ($trip['country'])?$trip['country']:'';?></li>
                        <?php
                        if($listReviews)
                        {						
						?>
						<li><i class="fa fa-quote-left"></i> <?php echo ucwords($listReviews[0]['comments']);?> <i class="fa fa-quote-right"></i></li>
						<?php 
                        }
                        ?>     						
						</ul>
			</div>
		</div>	
			<?php
			}
			}
			?>
			</div>
          </div>
		 
        </div>
		
		 <div class="col-md-5 listing-trips">
		 <div class="panel">
           <div class="panel-heading">
		     <div class="panel-title"><h4>My Listings</h4> </div>
			</div> 
			  <div class="panel-body">
			  <?php 
			  if(count($listings)>0)
			  {
			  foreach($listings as $listing)
			  {
			  print '<div class="list-data">';
			  print '<div class="listing-left-sec col-xs-4">';
			  $photos = getPhotosData($listing["eid"]);
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
			print '<div class="margin-top">';
			print '<a href="'.url('experience/view/'.$listing["eid"]).'" class="btn btn-primary ladda-button btn-gradient btn-sm">Book Now</a>';
		    print '</div>';
		print '</div>';
			  ?>
			    <!---------------------------------------------->
				<div class="col-md-7">
			<ul class="profile-info list-unstyled">
			              <li><a href="<?php echo url('experience/view/'.$listing["eid"]);?>" ><b><?php echo $listing['title'];?></b></a></li>
                          <li> <?php echo substr($listing['short_description'],0,100)."....";?></li>
                          <li><?php echo ($listing['city'])?$listing['city'].",":'';echo ($listing['state'])?$listing['state'].",":'';echo ($listing['country'])?$listing['country']:'';?></li>
                           						
						</ul>
			   </div>	
			</div>	
				
			 <?php 
              }
			 } 
			  else
			  {
			  print '<div>No Listing Added Yet</div>';
			  }
              ?>
               		  
				
			  </div> 
			</div>
		</div>	
	</div>
           
		
	