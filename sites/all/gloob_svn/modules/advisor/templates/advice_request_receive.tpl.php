<?php 

?>
<div class="advice-request-wrapper">
<?php 
if(count($requests)>0)
{
	foreach($requests as $request)
	{
?>
<div class="advice-request">
	  <div class="request-info">
	   <p><span> Destination </span>
		 <span>  Trip </span>
	   <span> Type of Recommendation </span>
	   <span> Date </span>
	   <span> Travellers </span>
	   <span> Status </span></p>
	   
	  </div>
	   <div class="advice-request-data">
	  <span><?php echo $request['destination'];?></span>
	  <span><?php echo $request['trip_type'];?></span>
	  <span><?php echo $request['listing_type'];?></span>
	  <span><?php echo date('M d',strtotime($request['from_date']))."-".date('M jS,Y',strtotime($request['to_date']));?></span>
	  <span>5</span>
	  <span><?php if($request['status']){
		  echo "open</br>";
		  echo "until ".date('M jS',strtotime($request['to_date'])).",12:00";
		  print '<a href="" id="decline_'.$request['rid'].'" class="decline-request">Decline this request</a>';
	  }
	  else{echo "closed";}?></span>
	  <span>Message: <?php echo $request['message'];?> </span>
	  
	   </div>
  <a href=""  class="edit-listings">Edit Listings</a> 
  <a href="" class="create-listings">Create Listings</a> 
  <a href="" class="create a travel guide">Create a Travel Guide</a> 
 </div> 
  
<?php
	} 
}
else
{
?>
<div class="error-msg">No Advice Request received</div>
<?php
}
?>  
</div>