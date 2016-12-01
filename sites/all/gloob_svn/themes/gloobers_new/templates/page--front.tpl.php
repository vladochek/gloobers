<?php
global $user,$base_url;
$userDetails=user_load($user->uid);
drupal_add_js(drupal_get_path('theme',$GLOBALS['theme']) .'/js/autocomplete.js',array('scope' => 'footer')); 

?>
<!---------------------------Page header -------------------------------------------------------> 
  
  <header class="">
  <div class="">
    <div class="logo">	
	<?php 	
	if ($logo): ?>
          <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
        <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
      </a>
     <?php endif; ?>
	<!--<a href="index.html"><img src="images/logo.png" alt="Gloobers" title="Gloobers"></a>-->
	</div>
    <p class="finder"><a href="#">Gloobers Finder</a></p>
	<?php
     if($user->uid)
     {		 
	?>
	<div class="admin-sec">
      <div class="arrow"><img src="<?php  echo   $base_url.'/'.drupal_get_path('theme',$GLOBALS['theme']);?>/images/arrow.png" alt=" "></div>
		  <div class="admin-pic"> 
		  <?php
		  if($userDetails->picture != ""){
										$file 	= file_load($userDetails->picture->fid);
										$imgpath = $file->uri;
										$style="homepage_header";
		 print  '<img src="'.image_style_url($style,$imgpath).'" alt="display pic">';
		  }
		  else
		  {
			print '<img src="'.base_path() . drupal_get_path('theme',$GLOBALS['theme']).'/images/no-profile-male-img.jpg" alt="display pic" />';
		  }		  
		  ?>
		  </div>	
      </div>
	<?php 
	 }
	 ?>
    <nav>
      <ul>
		<li class="finder-link"><a href="#">Gloobers Finder</a></li>
      	<?php 
		if(!$user->uid)
        {			
		?>
       <!-- <li><a href="<?php echo url('login');?>">Log in</a></li>
        <li><a href="<?php echo url('user/register');?>">Sign up</a></li>-->
	    <li><a data-whatever="" data-target="#login" data-toggle="modal" href="#">Log in</a></li>
        <li><a data-whatever="" data-target="#signup" data-toggle="modal" href="#">Sign up</a></li>
		<li><a href="#">List your deal</a></li>
		<?php 
		}
		else
        {			
		?>
		<li><a href="#">Notifications</a></li>
        <li><a href="#">Messages</a></li>
		<li><a href="#"><?php echo $userDetails->name;?></a></li>
        <?php 
        }
        ?> 
      </ul>
    </nav>
  </div>
</header>
<!--------------------------------------------------------------------------------------->
<?php

print render($page['banner']); 
 /* if ($messages): 
 ?>
		<div id="messages"><div class="section clearfix">
		  <?php print $messages; ?>
		</div></div> <!-- /.section, /#messages -->
	  <?php endif;  */
if($page['how_it_works'])
{	
 print render($page['how_it_works']);
}
if($page['popular_destination'])
{
  print render($page['popular_destination']);  
}
if($page['passionate'])
{
  print render($page['passionate']);  
}

if($page['join_tribe'])
{
  print render($page['join_tribe']);  
}
if($page['recommend_professional'])
{
  print render($page['recommend_professional']);  
}

?>