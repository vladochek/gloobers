<?php
menu_rebuild();
 global $base_path,$user,$base_url;
 drupal_add_js(drupal_get_path('theme',$GLOBALS['theme']).'/js/autocomplete.js',array('scope' => 'footer'));
 $userDetails=user_load($user->uid);
 $current_path=current_path();
 
 define('BASE_CURRENCY_NAME', '$');

 ?>

<div id="page-wrapper">
  <div id="page">
  <!---------------------------Page header -------------------------------------------------------> 
  <?php
 if(($current_path == "login") || ($current_path == "user/register"))
  { 
 ?>
<header class="headlogo">
	<div class="logo">
		
		<?php if ($logo): ?>
			  <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
				<img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
			  </a>
		 <?php endif; ?>
	</div>
</header>
<?php 
}
else 
{
?>

  <header class="inner-header">
  <div class="">
    <div class="logo">
	
	<?php if ($logo): ?>
          <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
        <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>"/>
      </a>
     <?php endif; ?>
	</div>
	<!----------->
	<div class="search">
            <input id="edit-keys" type="text" value="<?php echo arg(1); ?>" onfocus="if(this.value  == 'Enter Destination, deal title or name of a friend') { this.value = ''; } " onblur="if(this.value == '') { this.value = 'Enter Destination, deal title or name of a friend'; } ">
    </div>
	<!-------------------->
    <p class="finder"><a href="#">Gloobers Finder</a></p>
	<?php
    if($user->uid)
    {		
	?>
	<div class="admin-sec">
      <div class="arrow"><img src="<?php echo $base_url.'/'.drupal_get_path('theme',$GLOBALS['theme']);?>/images/arrow.png" alt="arrow"></div>
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
        <li><a href="<?php echo url('login');?>">Log in</a></li>
        <li><a href="<?php echo url('user/register');?>">Sign up</a></li>
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
<?php 
}
?>
<!--------------------------------------------------------------------------------------->
   <!-- <div id="header">
      <div class="section clearfix">
        <?php if ($logo): ?>
          <?php print render($page['logo']) ?>
        <?php endif; ?>

        <?php if ($site_name || $site_slogan): ?>
          <div id="name-and-slogan">
            <?php if ($site_name): ?>
              <?php print render($page['site_name']); ?>
            <?php endif; ?>

            <?php if ($site_slogan): ?>
              <div id="site-slogan"><?php print $site_slogan; ?></div>
            <?php endif; ?>
          </div>
        <?php endif; ?>

        <?php print render($page['header']); ?>
      </div>
    </div>-->


    <!--<?php if ($main_menu || $secondary_menu): ?>
      <div id="navigation">
        <div class="section">
          <?php print render($page['main_menu']); ?>
          <?php print render($page['secondary_menu']); ?>
        </div>
      </div>
    <?php endif; ?>

    <?php if ($breadcrumb): ?>
      <div id="breadcrumb">
        <?php print $breadcrumb; ?>
      </div>
    <?php endif; ?>-->

    

    <div id="main-wrapper">
      <div id="main" class="clearfix">
   
		

        <div id="content" class="column">
          <div class="section">
          
            <a id="main-content"></a>

            <?php print render($title_prefix); ?>
            <?php if ($title): ?>
              <h1 class="title" id="page-title"><?php print $title; ?></h1>
            <?php endif; ?>
            <?php print render($title_suffix); ?>

            <?php if ($tabs): ?>
              <div class="tabs">
                <?php print render($tabs); ?>
              </div>
            <?php endif; ?>

            <?php /* print render($page['help']); */ ?>
              
            <?php if ($action_links): ?>
              <ul class="action-links">
                <?php print render($action_links); ?>
              </ul>
            <?php endif; ?>
			<?php print $messages; ?>
             <div class="">  
             <?php print render($page['content']); ?>
			 </div>
            <?php print $feed_icons; ?>
          </div>
        </div>

       
      </div>
    </div>
<!---------------------------------------------------------------------------------------------->
  
  </div>
</div>
