<style>
  #content:after {background-color: #e8e8e8;}
</style>  
<?php
global $base_url;


?>
<div class="container-profile">
      <div id="part2" class="left">
        <div id="top-part2">
          <ul>
            <li class="titre">Notifications</li>
            <li><span><em>Please leave a review for Martine Chenet</em></span><a href="#"><img src="<?php echo $base_url."/".drupal_get_path('theme',$GLOBALS['theme']).'/images/profile/supp.png'; ?>"></a></li>
            <li><span>Please confirm your email address by clicking on the link we just emailed you. If you cannot find the email, you can <em>request a new confirmation email</em> or <em>change your email address.</em> </span><a href="#"><img src="<?php echo $base_url."/".drupal_get_path('theme',$GLOBALS['theme']).'/images/profile/supp.png'; ?>"></a></li>
            <li><span><em>Please leave a review for Martine Chenet </em></span><a href="#"><img src="<?php echo $base_url."/".drupal_get_path('theme',$GLOBALS['theme']).'/images/profile/supp.png'; ?>"></a></li>
          </ul>
        </div>
        <div id="middle-part2">
          <ul>
            <li class="titre"> <?php print t('Messages');?> ( <?php print ($messageCount)?$messageCount:0 ." ".t('new');?>) </li>
           <?php  if($messages)
		   {
		   $i=1;
		   foreach($messages as $message)
		   {
		   if($i>10)
		   {
		   continue;
		   }
		   $senderDetail=user_load($message['author']);
		   	if($senderDetail->picture){
			$file = file_load($userdetails->picture->fid);
			$imgpath = $file->uri;
			}
		   ?>
			<li class="mailnonlu">
              <div class="imga left"> <a href="#">
			  <?php 
			  if($imgpath)
			  {
			  ?>
			  <img src="<?php print image_style_url("thumbnail", $imgpath); ?>">
			  <?php
			  }
			  else
			  {
			  ?>
			<!-- <img class="imgavatar" src="<?php echo $base_url."/".drupal_get_path('theme',$GLOBALS['theme']).'/images/profile/1.png'; ?>">-->
			 <img class="imgavatar" src="<?php echo $base_url."/".drupal_get_path('theme','gloobers2').'/images/no-profile-male-img.jpg'; ?>">
		
			  <?php
			  }
			  ?>
			  </a> </div>
              <div class="nom left"> <span><?php print $senderDetail->name;?> </span><?php echo privatemsg_format_date($message['timestamp']);?></div>
              <div class="txt left"> <a href="<?php echo url('messages/view/'.$message['thread_id'])?>"><?php print substr ($message['subject'],0,150);?></a><?php print ($message['body'])?substr($message['body'],0,150)."  ....":"";?></div>
              
              <div class="btn1 right vert"><a href="<?php echo url('messages/view/'.$message['thread_id'])?>">View</a></div>
            </li>
			<?php
			$i++;
			}
			}
			else
			{
			?>
			<li>
			No message found
			</li>
			<?php
			}
			?>
          <?php 
		  if(count($messages)>1)
		  {
		  ?>
           <li class="r"> <a href="<?php echo url('messages');?>">All messages &gt;&gt;</a> </li>
		   <?php
		   }
		   ?>
          </ul>
        </div>
        <div id="bottom-part2"> <span>Invite your friends, earn €73 travel credit!</span> <a href="#">Invite now</a> </div>
      </div>
      <div class="left" id="part1">
        <div id="middle-part1">
          <ul>
            <li><a class="titre" href="#">Verifications</a><a class="edit" href="#">Add more</a></li>
            <li id="i3">Email Address<span>Verified</span></li>
            <li id="i4">Phone Number<span> <img src="<?php echo $base_url."/".drupal_get_path('theme',$GLOBALS['theme']).'/images/profile/tel.png'; ?>"> 54 Verified</span></li>
            <li id="i5">Facebook <span>157 Friends</span></li>
            <li id="i6">Google <span>Validated</span></li>
            <li id="i7">Twitter <span>Validated</span></li>
            <li id="i8">Positively Reviewed <span>16 Reviews</span></li>
          </ul>
        </div>
        <div id="bottom-part1">
          <ul>
            <li><a class="titre" href="#">Statistics</a><a class="edit" href="#">See more</a></li>
            <li id="i10">Number of Views<span>7</span></li>
            <li id="i11">Number of Reservations<span>284</span></li>
            <li id="i12">Number of Shared<span>13</span></li>
            <li id="i13">Number of Friends<span>876</span></li>
            <li id="i14">Number of Wishlist<span>32</span></li>
            <li id="i15">Money Earned<span id="money">3500€</span></li>
          </ul>
        </div>
      </div>
    </div>