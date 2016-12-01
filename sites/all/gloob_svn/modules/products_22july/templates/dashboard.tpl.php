<?php
	global $user,$base_url;

/*  $block = module_invoke('block', 'block_view', '7'); 
 echo $block['content']; */
 
	$userdetails = user_load($user->uid);
/* 	echo "<pre>";
	print_r($userdetails); */
?>
<div class="dashboard-wrapper">
	<div class="dashboard-left">
		<ul class="dashboard-left-nav">
			<li>Profile</li>
				<ul>
					<li><a href="<?php echo $base_url; ?>/user/dashboard">Dashboard</a></li>
					<li><a href="<?php echo $base_url; ?>/user/dashboard?page=edit-profile">Edit My Information</a></li>
				</ul>
			<li>Manage Services</li>
				<ul>
					<li><a href="#">My Services</a></li>
					<li><a href="#">Add New Service</a></li>
				</ul>
			<li>Manage Bookings</li>
				<ul>
					<li><a href="#">My Bookings</a></li>
				</ul>
			<li>Password</li>
				<ul>
					<li><a href="<?php echo $base_url; ?>/user/dashboard?page=change-pass">Change Password</a></li>
				</ul>
			<li>Logout</li>
				<ul>
					<li><a href="<?php echo $base_url; ?>/user/logout">Logout</a></li>
				</ul>
		</ul>
	</div>
	<div class="dashboard-right">
	<h2>Manage Profile</h2>
	<?php 
		if(!isset($_GET["page"])){
	?>
		<div class="dashboard-profile">
			<div class="left">
				<?php 
					if($userdetails->picture){
						$file = file_load($userdetails->picture->fid);
						$imgpath = $file->uri;
						
				?>
						<img src="<?php print image_style_url("medium", $imgpath); ?>">
				<?php 
					}
					else{
				?>
						<img src="<?php echo $base_url."/".drupal_get_path('theme',$GLOBALS['theme']).'/images/no-profile-male-img.jpg'; ?>">
				<?php 
					}
				?>
			</div>
			<div class="right">
				<ul>
					<li><strong>Username</strong> <span><?php echo $userdetails->name; ?></span></li>
					<li><strong>Email</strong> <span><?php echo $userdetails->mail; ?></span></li>
					<li><strong>User Role</strong> <span><?php echo $userdetails->field_acconut_type["und"][0]["value"]; ?></span></li>
					<li><strong>Member Since</strong> <span><?php echo date("Y-m-d",$userdetails->created); ?></span></li>
				</ul>
			</div>
		</div>
	<?php 
		}
	?>
	<?php 
		if(isset($_GET["page"]) && $_GET["page"] == "change-pass"){
	?>
		<div class="change-pass">
			<?php print drupal_render($changePassForm); ?>
		</div>
	<?php 
		}
		elseif(isset($_GET["page"]) && $_GET["page"] == "edit-profile"){
	?>
		<div class="edit-profile">
			<?php //print drupal_render($editProfileForm); 
			module_load_include('pages.inc', 'user', 'user');
			$output = drupal_get_form('user_profile_form', $user);
				echo drupal_render($output);
			?>
		</div>
	<?php 
		}
	?>
	</div>
</div>
<style>
.dashboard-left {
    border-right: 2px solid #ececf6;
    float: left;
    padding: 10px 0 10px 0px;
    width: 18%;
}

.dashboard-wrapper {
    background: none repeat scroll 0 0 #fff;
    float: left;
    width: 100%;
}

.dashboard-left-nav {
    list-style: none outside none;
	padding-right: 4px;
	padding-left: 4px;
}

.dashboard-left-nav > li {
    background: none repeat scroll 0 0 #05C2EC;
    color: #fff;
    padding: 5px;
}

.dashboard-left-nav > ul {
    padding: 8px 0 8px 18px;
    padding-left: 16px;
}

.dashboard-left-nav a {
    color: inherit;
}
.dashboard-right {
    float: left;
    padding: 10px 0 0 15px;
    width: 79%;
}
.dashboard-profile .right ul{
    list-style: none outside none;
    width: 100%;
}
.dashboard-profile h2{
	border-bottom:1px solid #ececf6;
	padding-bottom:10px;
}

.dashboard-profile .left {
    float: left;
    width: 145px;
}
.dashboard-profile .right{
	float: left;
}

.dashboard-profile .left img {
    border-radius: 10px;
    box-sizing: border-box;
    height: auto;
    max-width: 87%;
    width: auto;
}
.dashboard-profile .right li {
    float: left;
    padding: 5px;
    width: 100%;
}

.dashboard-profile .right strong {
    float: left;
    font-weight: bold;
    width: 100px;
}
.calendar-wrapper {
    float: left;
    margin: 25px 0;
    width: 100%;
}
#user-profile-form--2 .form-submit{
    background: #05C2EC;
    color: #fff;
    float: left;
    font-size: 16px;
    font-weight: bold;
    height: 39px;
    line-height: 39px;
    text-align: center;
    text-decoration: none;
    text-transform: uppercase;
    width: 20%;
}
#user-profile-form .form-submit{
    background: #05C2EC;
    color: #fff;
    float: left;
    font-size: 16px;
    font-weight: bold;
    height: 39px;
    line-height: 39px;
    text-align: center;
    text-decoration: none;
    text-transform: uppercase;
    width: 20%;
}

.dashboard-profile {
    float: left;
    width: 900px;
}
</style>