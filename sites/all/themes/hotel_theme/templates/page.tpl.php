<?php
global $user, $base_url;

if (in_array('administrator', $user->roles)) {
    
}
$status = getUserDetails($user->uid);
if (($status['confirm_status'] == 'no') && ($path != 'user/confirm')) {
    drupal_goto('user/confirm');
}
$userDetails = user_load($user->uid);
$hotel_id = arg(3);
$current_path = current_path();
$notifications = getNotifications();
$messagelist = getMessageList();
$senderDetail = user_load($messagelist['author']);
$messagecount = getNewMessageListCount();
$notifiationStore = (json_decode($notifiationBadge));
$count_notification = $notifiationStore->count;
define('BASE_CURRENCY_NAME', '$');
$front_end_theme_with_new_header = 'gloobers_new';
$notifiationBadge = unread_notification(1);
//echo $notifiationBadge;die;
$notifiationStore = (json_decode($notifiationBadge));
$front_end_theme_common_path = 'gloobers_new';
$count_notification = $notifiationStore->count;
?>
<script type="text/javascript">
    $baseURL = "<?php echo $base_url; ?>";
    //$flashPath= $baseURL+"/<?php echo libraries_get_path('plupload') . '/js/plupload.flash.swf'; ?>";
    $flashPath = $baseURL + "/<?php echo libraries_get_path('plupload') . '/js/Moxie.swf'; ?>";
    $silverlite = "/<?php echo libraries_get_path('plupload') . '/js/plupload.silverlight.xap'; ?>";
    $HotelId = "<?php echo arg(3); ?>";</script>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>
<script type="text/javascript" src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/js/autocomplete.js' ?>"></script> 

<link href="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/css/bootstrap.min.css' ?>" rel="stylesheet" type="text/css" />
<!--<link href="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/css/extralayers.css' ?>" rel="stylesheet" type="text/css" />-->
<link href="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/css/hotel-page_stylesheet.css' ?>" rel="stylesheet" type="text/css" />
<link href="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/css/landing_page.css' ?>" rel="stylesheet" type="text/css" />
<!--<link href="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/css/style_cropper.css' ?>" rel="stylesheet" type="text/css" />-->
<link href="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/css/simple-sidebar.css' ?>" rel="stylesheet" type="text/css" />
<link href="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/fonts/stylesheet.css' ?>" rel="stylesheet" type="text/css" />
<link href="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/css/font-awesome.css' ?>" rel="stylesheet" type="text/css" />
<link href="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/css/hotel_custom.css' ?>" rel="stylesheet" type="text/css" />
<link href="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/css/jquery.filer.css' ?>" rel="stylesheet" type="text/css" />
<link href="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/css/jquery.filer-dragdropbox-theme.css' ?>" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700,700italic,400italic,300italic' rel='stylesheet' type='text/css'>

<link href='http://fonts.googleapis.com/css?family=Khula:400,800,700,600,300' rel='stylesheet' type='text/css'>

<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400,600,700" />
<link rel="stylesheet" type="text/css" href="http://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" />
<link type="text/css" rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/themes/smoothness/jquery-ui.min.css" media="screen" />
<link type="text/css" rel="stylesheet" href="http://plupload.com/plupload/js/jquery.ui.plupload/css/jquery.ui.plupload.css" media="screen" />
<?php drupal_add_css(drupal_get_path('theme', 'gloobers_new') . '/stylesheet/for-head-foot.css', 'file'); ?>
<div id="page-wrapper">
    <div id="page">
        <header>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2 col-sm-2 col-xs-12"><a href="<?php echo $base_url; ?>" title="Home" rel="home" class="logo" id="logo"><img src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', 'gloobers2'); ?>/images/logo.png" alt="Home"></a></div>
                    <div class="col-md-10 col-sm-10">
                        <nav class="navbar navbar-default navbar-static" id="navbar-example">
                            <div class="navbar-header">
                                <button data-target=".bs-example-js-navbar-collapse" data-toggle="collapse" type="button" class="navbar-toggle collapsed">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="2&quot;icon-bar&quot;"></span>
                                </button>
                            </div>
                            <div class="navbar-collapse bs-example-js-navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
                                <ul class="nav navbar-nav navbar-right">
                                    <li class="dropdown">
                                        <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#" id="drop4">
                                            <span class="icotext">Notifications</span>
                                            <i class="icoicon"><img src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', 'gloobers2'); ?>/images/icon_bell.png" alt="Notification" title="" /></i>
                                            <span class="count">
                                                <?php
                                                if (!empty($count_notification)) {
                                                    echo $count_notification;
                                                } else {
                                                    echo "0";
                                                }
                                                ?>
                                            </span>
                                        </a>
                                        <ul aria-labelledby="drop4" class="dropdown-menu">
                                            <div class="nav-dropdown-heading">Notifications( <?php
                                                if (!empty($count_notification)) {
                                                    echo $count_notification;
                                                } else {
                                                    echo "0";
                                                }
                                                ?>
                                                )</div>
                                            <div class="nav-dropdown-content">
                                                <ul>   
                                                    <?php
                                                    if (!empty($notifications)) {
                                                        foreach ($notifications as $value) {
                                                            ?>
                                                            <li class="unread">
                                                                <a href="<?php echo $base_url . '/advice/request/' . base64_encode('gloobe__' . $value['sender_id']) ?>">
                                                                    <?php
                                                                    $notificationDetail = user_load($value['sender_id']);
                                                                    if ($notificationDetail->picture != "") {
                                                                        $file = file_load($notificationDetail->picture->fid);
                                                                        $imgpath = $file->uri;

                                                                        $style = "homepage_header";
                                                                        print '<img class="absolute-left-content img-circle size-img" src="' . image_style_url($style, $imgpath) . '" alt="display pic">';
                                                                    } else {
                                                                        print '<img src="' . base_path() . drupal_get_path('theme', 'hotel_theme') . '/images/no-profile-male-img.jpg" class="absolute-left-content img-circle size-img" alt="display pic" />';
                                                                    }
                                                                    ?>
                                                                    <strong><?php print $notificationDetail->field_first_name['und'][0]['value']; ?></strong>
                                                                    <?php echo $value['noti_msg']; ?>
        <?php $notify_time = $value['notification_time']; ?>
                                                                    <span class="small-caps"><?php echo humanTiming($notify_time) . ' ago'; ?></span>
                                                                </a>
                                                            </li>
                                                            <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <li> -- No  Notification -- </li> 
<?php } ?>       
                                            </div>
                                            <li><a href="<?php echo $base_url; ?>/advice/notification" class="notifications_btn">See all notifications</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown" id="fat-menu">
                                        <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#" id="drop3">
                                            <div class="user_name"><?php
                                                if (strlen($userDetails->field_first_name['und'][0]['value']) > 10) {
                                                    $dots = '..';
                                                } else {
                                                    $dots = '';
                                                }
                                                $name = substr($userDetails->field_first_name['und'][0]['value'], 0, 10) . $dots;
                                                echo trim($name, "%20");
                                                ?>  </div>
                                            <?php
                                            if ($userDetails->picture != "") {
                                                $file = file_load($userDetails->picture->fid);
                                                $imgpath = $file->uri;
                                                $style = "homepage_header";
                                                print '<img class="img-circle size-img" src="' . image_style_url($style, $imgpath) . '">';
                                            } else {
                                                print '<img src="' . base_path() . drupal_get_path('theme', $GLOBALS['theme']) . '/images/no-profile-male-img.jpg" class="img-circle size-img" />';
                                            }
                                            ?>
                                            <span class="caret"></span>
                                        </a>
                                        <ul aria-labelledby="drop3" class="dropdown-menu">
                                            <li><a tabindex="0" role="button" href="<?php echo $base_url; ?>/user/account_settings"><i class="fa fa-user"></i>Account</a></li>
                                            <li><a tabindex="0" role="button" href="<?php echo $base_url; ?>/dashboard"><i class="fa fa-tachometer"></i>Dashboard</a></li>
                                            <li><a tabindex="0" role="button" href="<?php echo $base_url; ?>/manage/listing"><i class="fa fa-list-alt"></i>Manage Listing</a></li>
                                            <li><a tabindex="0" role="button" href="<?php echo $base_url; ?>/hotel/add/manage"><i class="fa fa-list-alt"></i>Manage Hotels</a></li>
                                            <li><a tabindex="0" role="button" href="<?php echo $base_url; ?>/bookings"><i class="fa fa-calendar"></i>Reservations</a></li>
                                            <li><a tabindex="0" role="button" href="<?php echo $base_url; ?>/mytrips"><i class="fa fa-plane"></i>Trips</a></li>
                                            <li class="divider"></li>
                                            <li><a tabindex="0" role="button" href="<?php echo $base_url; ?>/user_profile"><i class="fa fa-user"></i>Profile</a></li>
                                            <li><a tabindex="0" role="button" href="<?php echo $base_url; ?>/user/logout"><i class="fa fa-sign-out"></i>Logout</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div> <!-- nav-collapse -->
                        </nav>
                    </div>
                </div>
            </div> <!-- End Container-Fluid -->
        </header>
    </div>
</div>
<?php // }   ?>


<?php if ($user->uid) { ?>
    <div class="main_menu">
        <div class="container-fluid padding_left paddng_right">
            <div class="col-lg-12 no_paddng">
                <div class="nav_main_menu">
                    <a class="showhide pull-right">MENU <i class="fa fa-bars"></i></a>
                    <ul class="dropdwonmenu_remove">
                        <li><a href="<?= $base_url . '/hotel/add/manage/'; ?>"> Dashboard </a></li>
                        <!--                        <li><a href="#"> Messages </a></li>
                                                <li><a href="#"> Listings  </a></li>
                                                <li><a href="#"> Reservations  </a></li>
                                                <li><a href="#"> Trips</a></li>
                                                <li><a href="#"> Recommendations   </a></li>-->
                        <li><a href="<?php echo $base_url; ?>/user_profile">  Profile  </a></li>
                    </ul>
                </div> 

            </div>
        </div>



        <section class="experiences" style="display: none;">

        </section>
        <?php
    }
    ?>
    <!-- End: Main --> 

    <!-- End: Main --> 

    <section class="account_section"> 

        <div id="wrapper">

            <!-- Sidebar -->
<?php if (arg(1) != listing) { ?>
                <div id="sidebar-wrapper">
                    <div class="toggle_heading-div"><P class="toggle_heading">Create a Hotel</P></div>
                    <?php
                    /**
                     * create link for redirect
                     */
                    $argu = arg(3);
                    if (isset($argu)) {
                        $link_argu = $argu;
                        $check_room_exists = getRoomDetailByHotelId($argu);
                    } else {
                        $link_argu = '';
                    }
                    ?>
                    <ul class="sidebar-nav">
                        <li>
                            <?php if (!isset($argu)) { ?>
                                <a href="javascript:void(0);">Overview</a>
                            <?php } else { ?>
                                <a href="<?= $base_url ?>/hotel/add/overview/<?= $link_argu ?>">Overview</a>
    <?php } ?>
                        </li>
                        <li  >
                            <?php if (!isset($argu)) { ?>
                                <a  <?php if (!isset($argu)) { ?>style="cursor: not-allowed;"<?php } ?> href="javascript:void(0);">Rooms</a>
                            <?php } else { ?>
                                <a href="<?= $base_url ?>/hotel/add/rooms/<?= $link_argu ?>">Rooms</a>
    <?php } ?>
                        </li>
                        <li>
                            <?php if (!isset($argu)) { ?>
                                <a  <?php if (!isset($argu)) { ?>style="cursor: not-allowed;"<?php } ?> href="javascript:void(0);">Photos</a>
                            <?php } else { ?>
                                <a  href="<?= $base_url ?>/hotel/add/photos/<?= $link_argu ?>">Photos</a>
    <?php } ?>
                        </li>
                        <li>
                            <?php if (!isset($argu)) { ?>
                                <a  <?php if (!isset($argu)) { ?>style="cursor: not-allowed;"<?php } ?> href="javascript:void(0);">Location</a> 
                            <?php } else { ?>
                                <a   href="<?= $base_url ?>/hotel/add/location/<?= $link_argu ?>">Location</a>
    <?php } ?>
                        </li>
                        <li>
                            <?php if (!isset($argu)) { ?>
                                <a  <?php if (!isset($argu)) { ?>style="cursor: not-allowed;"<?php } ?> href="javascript:void(0);">Pricing</a> 
                            <?php } else if (isset($argu) && count($check_room_exists) == 0) { ?>
                                <a  <?php if (isset($argu) && count($check_room_exists) == 0) { ?>style="cursor: not-allowed;"<?php } ?> href="javascript:void(0);">Pricing</a> 
                            <?php } else {
                                ?>
                                <a   href="<?= $base_url ?>/hotel/add/pricing/<?= $link_argu ?>">Pricing</a>
    <?php } ?>
                        </li>
                        <li>
                            <?php if (!isset($argu)) { ?>
                                <a  <?php if (!isset($argu)) { ?>style="cursor: not-allowed;"<?php } ?> href="javascript:void(0);">Calendar</a> 
                            <?php } else { ?>
                                <a  href="<?= $base_url ?>/hotel/add/calendar/<?= $link_argu ?>">Calendar</a>
    <?php } ?>
                        </li>
                        <li>
                            <?php if (!isset($argu)) { ?>
                                <a  <?php if (!isset($argu)) { ?>style="cursor: not-allowed;"<?php } ?> href="javascript:void(0);">Optionnal Services</a> 
                            <?php } else { ?>
                                <a  href="<?= $base_url ?>/hotel/add/optional_services/<?= $link_argu ?>">Optional Services</a>
    <?php } ?>
                        </li>

                        <li >
                            <?php if (!isset($argu)) { ?> 
                                <a  <?php if (!isset($argu)) { ?>style="cursor: not-allowed;"<?php } ?> href="javascript:void(0);">Rules & Policies</a> 
                            <?php } else { ?>
                                <a <?php if (!isset($argu)) { ?>style="cursor: not-allowed;"<?php } ?> href="<?= $base_url ?>/hotel/add/rules_policies/<?= $link_argu ?>">Rule & Policies</a>
    <?php } ?>
                        </li>
                        <!--  <li>
                             <a href="#">Ranking</a>
                         </li> -->

                    </ul>
                </div>
<?php } ?>
            <!-- container----> 
            <div id="page-content-wrapper">
                <div class="container-fluid">

                    <div class="row">  <a href="#menu-toggle" class="sidebar_btn" id="menu-toggle">Toggle Menu</a></div>

                    <div class="row">
                        <div class="account_setting_page">
                            <!---------------------------CREATE HOTEL---------------------------->



                            <div class="col-xs-12 col-sm-12 col-md-9">
                                <div id="load-screen" class="load-screen_details" ></div>
<?php if (arg(2) == 'overview') { ?>
                                    <h1>Overview</h1>
                                    <h2>Introduce your hotel </h2>  
<?php } elseif (arg(2) == 'optional_services') { ?>
                                    <h1>Optional Services</h1>
                                    <h2 class="top_text">Your Service can make the difference</h2> 
<?php } elseif (arg(2) == 'rooms') { ?>
                                    <h1>Rooms</h1>
                                    <h2 class="head">Create your rooms</h2>
<?php } elseif (arg(2) == 'rules_policies') { ?>
                                    <h1>Rules & Policies </h1>
                                    <h2 class="head">Set the rules </h2>
<?php } elseif (arg(2) == 'photos') { ?>
                                    <h1>Photos </h1>
                                    <h2 class="heading_photo">One photo equals a thousand words</br> Show everyone how unique your hotel is </h2>
<?php } elseif (arg(2) == 'location') { ?>
                                    <h1>Location </h1>
                                    <h2 class="heading_photo">Your exact adress is kept private. It will only be shared to confirmed traveler. </h2>
<?php } elseif (arg(2) == 'pricing') { ?>
                                    <h1>Set up your prices </h1>
                                    <h2 class="head">Set up your prices </h2>
<?php } else if (arg(2) == 'calendar') { ?>
                                    <h1>Calendar </h1>
                                    <h2 class="head">Manage your Calendar  </h2>
                                    <?php print render($page['ical']); ?>

                                <?php } ?>
<?php print render($page['content']); ?>

                            </div>





                            <!---------------------------CREATE HOTEL---------------------------->                      
<?php if (arg(1) != listing) { ?>
                                <div class="col-xs-12 col-sm-12 col-md-3">
                                    <!--<h4>Preview the listing</h4>--> 
                                    <div class="help_block help_hotel_block">
                                        <div class="heading_help">Help</div>
                                        <?php
                                        if (arg(2) == 'overview') {
                                            ?>
                                            <div class="hotel_title_help help_class" style="display:none;">
                                                <p><b><?php print t('Hotel Title'); ?></b></p>
                                                <p><?php print t('Hotel title is Required'); ?></p>
                                                <p><?php print t('Maximum 35 characters are allowed'); ?></p>
                                            </div>
                                            <div class="hotel_description_help help_class" style="display:none;">
                                                <p><b><?php print t('Hotel Description'); ?></b></p>
                                                <p><?php print t('Hotel description required'); ?></p>
                                                <p><?php print t('Maximum 2000 characters are allowed'); ?></p>
                                            </div>

    <?php } else if (arg(2) == 'optional_services') { ?>
                                            <div class="optional_service_price_help help_class" style="display:none;">
                                                <p><b><?php print t('Optional Service Price'); ?></b></p>
                                                <p><?php print t('Service Price is Required'); ?></p>
                                                <p><?php print t('Service Price Must be numeric'); ?></p>
                                            </div>
                                            <div class="optional_service_description_help help_class" style="display:none;">
                                                <p><b><?php print t('Opitonal Service Description'); ?></b></p>
                                                <p><?php print t('Service description required'); ?></p>
                                                <p><?php print t('Maximum 2000 characters are allowed'); ?></p>
                                            </div>
                                            <div class="optional_service_name_help help_class" style="display:none;">
                                                <p><?php print t('Opitonal Service Name'); ?></p>
                                                <p><?php print t('Service Name required'); ?></p>
                                            </div>

    <?php } else if (arg(2) == 'rooms') { ?> 
                                            <div class="room_name_help help_class" style="display:none;">
                                                <p><b><?php print t('Name of Room'); ?></b></p>
                                                <p><?php print t('Room Name is Required'); ?></p>
                                                <p><?php print t('Room Names must be unique in a Hotel'); ?></p>
                                            </div>
                                            <div class="room_quantity_help help_class" style="display:none;">
                                                <p><b><?php print t('Room Quantity'); ?></b></p>
                                                <p><?php print t('Room Quantity required'); ?></p>
                                                <p><?php print t('Room Quantity must be numeric'); ?></p>
                                            </div>
                                            <div class="room_size_help help_class" style="display:none;">
                                                <p><?php print t('Room Size'); ?></p>
                                                <p><?php print t('Room Size required'); ?></p>
                                                <p><?php print t('Room Size must be numeric'); ?></p>
                                            </div>
    <?php } elseif (arg(2) == 'rules_policies') { ?>
                                            <div class="requirement_help help_class" style="display:none;">
                                                <p><b><?php print t('Requirements'); ?></b></p>
                                                <p><?php print t('Requirement are  Required'); ?></p>
                                            </div>
                                            <div class="other_info_help help_class" style="display:none;">
                                                <p><b><?php print t('Other Information'); ?></b></p>
                                                <p><?php print t('other information is Required'); ?></p>
                                            </div>
                                            <div class="secuirty_amount_help help_class" style="display:none;">
                                                <p><b><?php print t('Secuirty Deposit'); ?></b></p>
                                                <p><?php print t('Secuirty Deposit is required'); ?></p>
                                                <p><?php print t('Secuirty Deposit  must be numeric'); ?></p>
                                            </div>
                                            <div class="early_cancel_amount_help help_class" style="display:none;">
                                                <p><b><?php print t('Early Cancellation Amount'); ?></b></p>
                                                <p><?php print t('Early cancellation amount is Required'); ?></p>
                                                <p><?php print t('Early cancellation amount must be numeric'); ?></p>
                                            </div>
                                            <div class="early_travel_amount_help help_class" style="display:none;">
                                                <p><b><?php print t('Early Cancellation Reimbursed  Amount'); ?></b></p>
                                                <p><?php print t('Early Cancellation Reimbursed  Amount is Required'); ?></p>
                                                <p><?php print t('Early Cancellation Reimbursed  Amount must be numeric'); ?></p>
                                            </div>
                                            <div class="late_cancel_amount_help help_class" style="display:none;">
                                                <p><b><?php print t('Late Cancellation Amount'); ?></b></p>
                                                <p><?php print t('Late cancellation amount is Required'); ?></p>
                                                <p><?php print t('Late cancellation amount must be numeric'); ?></p>
                                            </div>
                                            <div class="late_travel_amount_help help_class" style="display:none;">
                                                <p><b><?php print t('Late Cancellation Reimbursed  Amount'); ?></b></p>
                                                <p><?php print t('Late Cancellation Reimbursed  Amount is Required'); ?></p>
                                                <p><?php print t('Late Cancellation Reimbursed  Amount must be numeric'); ?></p>
                                            </div>
                                            <div class="noshow_travel_amount_help help_class" style="display:none;">
                                                <p><b><?php print t('No Show Policy Amount'); ?></b></p>
                                                <p><?php print t('No Show Policy Amount is Required'); ?></p>
                                                <p><?php print t('No Show Policy Amount must be numeric'); ?></p>
                                            </div>
                                            <div class="noshow_reservationamount_help help_class" style="display:none;">
                                                <p><b><?php print t('After Reservation No Show Policy Amount'); ?></b></p>
                                                <p><?php print t('Amount is Required'); ?></p>
                                                <p><?php print t('Amount must be numeric'); ?></p>
                                            </div>
    <?php } else if (arg(2) == 'photos') { ?> 
                                            <div class="help_class" >
                                                <p><b><?php print t('Hotel/ Room Photos'); ?></b></p>
                                                <p><?php print t('Upload Photos of Hotel and Rooms'); ?></p>
                                                <p><?php print t('Maximum 10 photo for each allowed'); ?></p>
                                                <p><?php print t('Ideal size of hotel photo is 1366*428px'); ?></p>
                                                <p><?php print t('Ideal size of room photo is 555*316px'); ?></p>
                                                <p><?php print t('Photo must be less than 4 mb'); ?></p>
                                            </div>
    <?php } else if (arg(2) == 'pricing') { ?>
                                            <div class="room_night_rate_help help_class" style="display:none;">
                                                <p><b><?php print t('Room Rates : Night Rate'); ?></b></p>
                                                <p><?php print t('Amount is Required'); ?></p>
                                                <p><?php print t('Amount must be numeric'); ?></p>
                                            </div>
                                            <div class="room_weekend_rate_help help_class" style="display:none;">
                                                <p><b><?php print t('Room Rates : Weekend Rate'); ?></b></p>
                                                <p><?php print t('Amount is Required'); ?></p>
                                                <p><?php print t('Amount must be numeric'); ?></p>
                                            </div>
                                            <div class="room_weekly_rate_help help_class" style="display:none;">
                                                <p><b><?php print t('Room Rates : Weekly Rate'); ?></b></p>
                                                <p><?php print t('Amount is Required'); ?></p>
                                                <p><?php print t('Amount must be numeric'); ?></p>
                                            </div>
                                            <div class="rent_adjust_price_help help_class" style="display:none;">
                                                <p><b><?php print t('Board Rates'); ?></b></p>
                                                <p><?php print t('Amount is Required'); ?></p>
                                                <p><?php print t('Amount must be numeric'); ?></p>
                                            </div>

                                            <div class="seasonal_name_help help_class" style="display:none;">
                                                <p><b><?php print t('Seasonal Pricing : Period name'); ?></b></p>
                                                <p><?php print t('Period Name is Required'); ?></p>
                                            </div>
                                            <div class="seasonal_date_help help_class" style="display:none;">
                                                <p><b><?php print t('Seasonal Pricing : Start Date'); ?></b></p>
                                                <p><?php print t('Date is Required'); ?></p>
                                            </div>
                                            <div class="seasonal_till_date_help help_class" style="display:none;">
                                                <p><b><?php print t('Seasonal Pricing : End Date'); ?></b></p>
                                                <p><?php print t('Date is Required'); ?></p>
                                            </div>
                                            <div class="nightly_rate_help help_class" style="display:none;">
                                                <p><b><?php print t('Seasonal Pricing : Nightly Rate'); ?></b></p>
                                                <p><?php print t('Amount is Required'); ?></p>
                                                <p><?php print t('Amount must be numeric'); ?></p>
                                            </div>
                                            <div class="weekendrate_help help_class" style="display:none;">
                                                <p><b><?php print t('Seasonal Pricing : Weekend Rate'); ?></b></p>
                                                <p><?php print t('Amount is Required'); ?></p>
                                                <p><?php print t('Amount must be numeric'); ?></p>
                                            </div>
                                            <div class="weeklyrate_help help_class" style="display:none;">
                                                <p><b><?php print t('Seasonal Pricing : Weekly Rate'); ?></b></p>
                                                <p><?php print t('Amount is Required'); ?></p>
                                                <p><?php print t('Amount must be numeric'); ?></p>
                                            </div>
                                            <div class="offer_24_date_help help_class" style="display:none;">
                                                <p><b><?php print t('Offers & Discounts : Date'); ?></b></p>
                                                <p><?php print t('Date is Required'); ?></p>
                                            </div>
                                            <div class="offer_24_amount_help help_class" style="display:none;">
                                                <p><b><?php print t('24 Hours Offer : Amount'); ?></b></p>
                                                <p><?php print t('Amount is Required'); ?></p>
                                                <p><?php print t('Amount must be numeric'); ?></p>
                                            </div>
                                            <div class="lastmin_amount_help help_class" style="display:none;">
                                                <p><b><?php print t('Last Minute Offer: Amount'); ?></b></p>
                                                <p><?php print t('Amount is Required'); ?></p>
                                                <p><?php print t('Amount must be numeric'); ?></p>
                                            </div>
                                            <div class="earlybird_amount_help help_class" style="display:none;">
                                                <p><b><?php print t('Early Bird Offer: Amount'); ?></b></p>
                                                <p><?php print t('Amount is Required'); ?></p>
                                                <p><?php print t('Amount must be numeric'); ?></p>
                                            </div>
    <?php } else if (arg(2) == 'location') { ?>
                                            <div class="description_location" >
                                                <p><b><?php print t('Location: Itinerary'); ?></b></p>
                                                <p><?php print t('Itinerary is Required'); ?></p>
                                            </div>

    <?php } ?>

                                    </div>        
                                </div><?php } ?>





                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>               


<?php // print render($page['content']);          ?>


<?php print render($page['footer']); ?>
    <!-- End: Main --> 
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/js/hotel_module_validate.js' ?>"></script> 
    <script src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', 'gloobers2') . '/js/location-custom.js'; ?>"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $front_end_theme_with_new_header) . '/js/jquery.selectbox-0.2.js' ?> "></script>
    <script type="text/javascript" src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $front_end_theme_with_new_header) . '/js/bootstrap.min.js' ?> "></script>
    <script src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $front_end_theme_with_new_header); ?>/js/jquery.nicescroll.min.js"></script>


    <script type="text/javascript" src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', 'gloobers_new') . '/js/home.js' ?>"></script> 
    <script type="text/javascript" src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', 'gloobers2') . '/js/jquery.sticky.js' ?>"></script> 
    <script type="text/javascript" src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', 'gloobers2') . '/js/help-text.js' ?>"></script> 
    <script type="text/javascript" src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/js/jquery.filer.min.js' ?>"></script> 
    <script type="text/javascript" src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/js/jquery.Jcrop.js' ?>"></script> 
    <script type="text/javascript" src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/js/jquery.SimpleCropper.js' ?>"></script> 

    <script type="text/javascript" src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/js/hotel_module_custom.js' ?>"></script> 
    <script type="text/javascript" src="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/js/custom.js' ?>"></script> 

    <script type="text/javascript">

    jQuery(document).ready(function () {
        jQuery("html").niceScroll();
        //                                                         

    });
// Init Simple Cropper
    jQuery('.cropme').simpleCropper();
    jQuery(document).ready(function () {
        jQuery(".nav-dropdown-content").niceScroll();
        jQuery(".select_box").selectbox();
    });
// Menu Script
    jQuery(document).ready(function () {


        jQuery('.showhide').click(function (e) {
            e.preventDefault();
            jQuery('.nav_main_menu').find('ul').toggleClass('dropdwonmenu_remove dropdwonmenu');
        });
        jQuery('.togelsubmenu').click(function (e) {
            e.preventDefault();
            jQuery('.nav_main_menu').find('ul li ul').toggleClass('dropdwonmenu_remove1 dropdwonmenu1');
        });
    });
    jQuery(document).ready(function () {

        jQuery(".sidebar_icone").click(function () {
            jQuery(".account_setting_page .container-fluid").addClass("container");
        });
        jQuery(".sidebar_icone").click(function () {
            jQuery(".sidebar_menu").toggleClass("close_sidebar");
        });
    });</script>
    <script>
        jQuery("#menu-toggle").click(function (e) {
            e.preventDefault();
            jQuery("#wrapper").toggleClass("toggled");
        });</script>    

    <script type="text/javascript">

        jQuery(document).ready(function () {
            jQuery('.cropme').simpleCropper();
            // Init Theme Core    
            Core.init();
            /*  jQuery('.datepicker').datepicker(); */
            jQuery('.datetimepicker').datepicker();
            //jQuery('.timepicker').timepicker();
            var nowTemp = new Date();
            var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
            jQuery('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                onRender: function (date) {
                    return date.valueOf() < now.valueOf() ? 'disabled' : '';
                }
            });
            jQuery('.datepicker').keyup(function () {
                jQuery(this).val('');
            });
            jQuery('.datetimepicker').keyup(function () {
                jQuery(this).val('');
            });
            jQuery('.daterangepicker2').keyup(function () {
                jQuery(this).val('');
            });
            jQuery('input[name="openning_hours_dates"] , .form-item-high-season-rate-dates input , .daterangepicker2').daterangepicker({minDate: moment().subtract('days', 1)});
            /* jQuery('.timepicker').timepicker(); */
        });</script>
    <?php
    global $base_url;
    $library_path = _plupload_library_path();
//echo $library_path;exit;
    ?>


    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery("#helpBar").niceScroll();
        });
        /* jQuery(".admin-sec").click(function(){
         jQuery(".nadminmenu").slideToggle("slow");
         });     */
        jQuery(document).ready(function () {
            //jQuery("#modal_trigger").leanModal({top : 200, overlay : 0.6, closeButton: ".modal_close" });
            // You can also use "$(window).load(function() {"


            // Slideshow 2
            jQuery("#slider2").responsiveSlides({
                auto: false,
                pager: true,
                speed: 300,
                width: 100,
            });
            // Calling Login Form
            jQuery("#login_form").click(function () {
                jQuery(".social_login").hide();
                jQuery(".user_login").show();
                return false;
            });
            // Calling Register Form
            jQuery("#register_form").click(function () {
                jQuery(".social_login").hide();
                jQuery(".user_register").show();
                jQuery(".header_title").text('Register');
                return false;
            });
            // Going back to Social Forms
            jQuery(".back_btn").click(function () {
                jQuery(".user_login").hide();
                jQuery(".user_register").hide();
                jQuery(".social_login").show();
                jQuery(".header_title").text('Login');
                return false;
            });
            jQuery("#user-profile-form").find("input[type=text]").addClass("form-control");
            jQuery("#user-profile-form").find("select").addClass("form-control");
            jQuery("#user-profile-form").find("input[type=password]").addClass("form-control");
            jQuery("#user-profile-form").find("input[type=submit]").addClass("btn btn-dark btn-gradient");
            jQuery(".btn-adminuser").click(function () {
                jQuery(".user-menu .dropdown-menu").slideToggle();
            });
            jQuery('html').on('click', 'a.disable', function (event) {
                event.preventDefault();
            });
        });
        jQuery(document).ready(function () {


            Core.init();
            // Populates theme styles for Tabs - Trash function 
            var tabOptions = [];
            var tabToggle = jQuery(".toggle-tab-style .tab-style-option");
            var tabCount = jQuery(tabToggle).length;
            jQuery(tabToggle).each(function (index, element) {
                var optionVal = $(element).attr('opt');
                // gather options and push to array
                tabOptions.push(optionVal);
                // on last loop filter for uniques
                if (index == tabCount - 1) {
                    jQuery.unique(tabOptions);
                }
            });
            // Changes theme style on Tabs - Trash function 
            jQuery(tabToggle).click(function () {
                var tabStyle = $(this).attr('opt');
                var Options = tabOptions.join(" ");
                // GARBAGE JS - left tab navigation has styles widget outside of its menu.
                // Requires slightly different class detection
                if (jQuery(this).parent().hasClass('tab-style-left')) {
                    jQuery(this).parents("div.tab-block").children("ul").removeClass(Options).addClass(tabStyle);
                }
                else {
                    // Assign option to parent of clicked tab widget. Remove all other options
                    jQuery(this).parents("ul").removeClass(Options).addClass(tabStyle);
                }
                // remove active class from options and add
                // the class to the newly clicked option
                jQuery(this).siblings().removeClass("active");
                jQuery(this).addClass("active");
            });
            //jQuery("#helpBar").stick_in_parent();
        });
        jQuery(document).ready(function () {
            jQuery('header nav').meanmenu();
            jQuery(".nav-dropdown-content").niceScroll();
        });
        function hide_perminute(val) {

            var typeTime = jQuery(val).val();
            if (typeTime != 'Minute') {
                jQuery('.repeat_everyminute_condition').hide();
            } else {
                jQuery('.repeat_everyminute_condition').show();
            }
        }

        jQuery(document).ready(function () {
            jQuery('header nav').meanmenu();
        });
        function readnotifications(recipient_id) {
            jQuery.ajax({
                url: '<?php echo $base_url; ?>/advice/readnotifications',
                type: 'post',
                data: {'recipientid': recipient_id, 'isAjax': 1},
                success: function (result) {
                    //alert(result);

                    window.location.href = '<?php echo $base_url; ?>/advice/notification';
                }

            });
        }
    </script>
    <script type="text/jscript">
        $baseUrl = "<?php echo $base_url; ?>";

        jQuery(document).on('keypress','.my-custom-search',function(event){

        if ( event.which == 13 ) {
        var search = (jQuery('#edit-keys').val()).trim();
        if(search.length<=0){
        return false;
        }
        setTimeout(function(){
        var href = $baseUrl+'/search-destination/'+search;
        window.location.href = href;
        });
        }

        });
        jQuery(document).on('click','.my-custom-search',function(){
        var search = (jQuery('#edit-keys').val()).trim();
        // alert(search);
        if(search.length<=0){
        return false;
        }

        setTimeout(function(){
        var href = $baseUrl+'/search-destination/'+search;
        window.location.href = href;
        });

        });
    </script>
<?php if (arg(2) == 'rooms') { ?>
        <script type="text/javascript">
            var hotel_id = '<?= arg(3); ?>';
            var dataString = 'hotel_id=' + hotel_id;
            jQuery.ajax({
                data: dataString,
                url: '<?php echo $base_url; ?>/hotel/ajax/editroom',
                type: "post",
                beforeSend: function (xhr) {
                    preLoading('show', 'load-screen');
                },
                async: false,
                success: function (data) {
                    if (data == 'no_record') {
                        var HTML = getTemplate(1);
                        preLoading('hide', 'load-screen');
                        jQuery(".room_repeat_div").html(HTML);
                    }
                    else {
                        var result = jQuery.parseJSON(data);
                        var m = result.data.length;
                        var k = 1;
                        jQuery.each(result.data, function (i, item) {

                            var HTML = editCaseRoomCreateHtml(item, i);
                            var divHTML = jQuery(".room_repeat_div").html();
                            if (k == 1) {
                            }
                            else if (m == k) {
                                HTML += '<div class="col-xs-12 col-sm-12 col-md-12"> <h4><a href="javascript:void(0);" class="remove_rooms" >Remove room</h4> </div></div></div>';

                            } else {
                                HTML += '<div class="col-xs-12 col-sm-12 col-md-12"> <h4><a href="javascript:void(0);" class="remove_rooms" >Remove room</h4> </div></div>';
                            }
                            k++;
                            preLoading('hide', 'load-screen');
                            jQuery(".room_repeat_div").html(divHTML + HTML);
                        });
                        var repeat_now_html = jQuery(".room_repeat_div").html();
                        repeat_now_html += '<div class="col-xs-12 col-sm-12 col-md-12"> <h4><a href="javascript:void(0);" class="add_more_rooms" >Add a room</a></h4></div>';
                        jQuery(".room_repeat_div").html(repeat_now_html);
                    }
                }

            });


        </script>

        <?php
    } else if (arg(2) == 'rules_policies') {

        $hotel_id = arg(3);
        $rule_data = getRulesPoliciesofHotel($hotel_id);
        if (count($rule_data) > 0) {
            $requirement = explode(",", $rule_data[0]["requirements"]);
            $l = 1;
            foreach ($requirement as $key => $value) {
                ?>

                <script type="text/javascript">
                    var HTML = '<div class="requirement_more"> <div class="col-md-8 col-lg-8 col-sm-8 col-xs-12 padding_left">';
                    HTML += '<input name="requirements[]" class="focus_help_menu" data-val="requirement" value="<?= $value; ?>" id="requirements_' + jQuery.now() + '" placeholder="Requirement name" type="text" /></div>';
                    if (<?= $l ?> != 1) {
                        HTML += '<div class="col-md-4 col-lg-4 col-sm-4 col-xs-12 paddng_right" ><a href="javascript:void(0);" class="removeRequirement">Remove </a></div>';
                    }
                    HTML += '</div>';
                    jQuery(".requirement_more:last").after(HTML);
                </script>
                <?php
                $l++;
            }
        } else {
            ?>
            <script type="text/javascript">
                var HTML = '<div class="col-md-8 col-lg-8 col-sm-8 col-xs-12 padding_left"><input type="text" data-val="requirement" placeholder="Requirement name" class="focus_help_menu" id="requirements" name="requirements[]"></div>';

                jQuery(".first_requirement").html(HTML);

            </script>

            <?php
        }
    } else if (arg(2) == 'photos') {
        ?>
        <script type="text/javascript">

            var hotel_id = '<?= arg(3); ?>';
            var dataString = 'hotel_id=' + hotel_id;
            /**
             * For recent hotel images
             */
            jQuery.ajax({
                data: dataString,
                url: '<?php echo $base_url; ?>/hotel/ajax/hotel_recent_pic',
                type: "post",
                beforeSend: function (xhr) {
                    preLoading('show', 'load-screen');
                },
                async: false,
                success: function (response) {
                    var data = jQuery.parseJSON(response);
                    var HTML = '<h3>Recent Hotel Images</h3><ul class="recent_ul_img">';
                    var data_array = new Array();
                    jQuery(data).each(function (key, value) {
                        data_array.push(value);
                        HTML += '<li><div class="image_block_box"><div class="image_container"><div class="thumb_img">';
                        HTML += '<img src="<?php echo $base_url; ?>/sites/all/themes/hotel_theme/hotel_img/listing_page/' + value + '" class="thumb_img-image" alt="' + value + '" title="' + value + '" /></div>';
                        HTML += '<div class="image_title">' + value + '</div><div class="trash_btn remove_hotel_img" data-val="' + value + '" ><i class="fa fa-trash-o"></i>';
                        HTML += '<label>Delete</label></div></div></div></li>';
                    });
                    HTML += '</ul><input type="hidden" name="hotel_edit_imgs" id="edit_hotel_img" value="' + data_array + '"/>';
                    jQuery(".hotel_recent_pics").html(HTML);
                }
            });

            /**
             * Recent room images
             * */
            /**
             * For recent hotel images
             */
            jQuery.ajax({
                data: dataString,
                url: '<?php echo $base_url; ?>/hotel/ajax/room_recent_pic',
                type: "post",
                beforeSend: function (xhr) {
                    preLoading('show', 'load-screen');
                },
                async: false,
                success: function (response) {
                    var data = jQuery.parseJSON(response);

                    jQuery(data).each(function (key, val) {
                        var data_array = new Array();
                        var HTML = '<h3>Recent Room Images</h3><ul class="recent_ul_img">';
                        var room_images = jQuery.parseJSON(val.room_images);
                        jQuery(room_images).each(function (key, value) {
                            data_array.push(value);
                            HTML += '<li><div class="image_block_box"><div class="image_container"><div class="thumb_img">';
                            HTML += '<img src="<?php echo $base_url; ?>/sites/all/themes/hotel_theme/rooms_img/listing_page/' + value + '" class="thumb_img-image" alt="' + value + '" title="' + value + '" /></div>';
                            HTML += '<div class="image_title">' + value + '</div><div class="trash_btn remove_room_img" data-val="' + value + '" data-data="' + val.room_id + '" ><i class="fa fa-trash-o"></i>';
                            HTML += '<label>Delete</label></div></div></div></li>';
                        });
                        HTML += '</ul><input type="hidden" name="room_edit_imgs_' + val.room_id + '" id="edit_room_img_' + val.room_id + '" value="' + data_array + '"/>';
                        jQuery(".room_recent_pics_" + val.room_id).html(HTML);
                    });
                }
            });












        </script>
<?php } else if (arg(2) == 'pricing') { ?>
        <script type = "text/javascript" >
            var HTML = '';
            /***
             * For room listing fields
             */
            var hotel_id = '<?= arg(3); ?>';
            var dataString = 'hotel_id=' + hotel_id;
            jQuery.ajax({
                data: dataString,
                url: '<?php echo $base_url; ?>/hotel/ajax/room_recent_pic',
                type: "post",
                async: false,
                beforeSend: function (xhr) {
                    preLoading('show', 'load-screen');
                },
                success: function (response) {
                    if (typeof response != 'undefined') {
                        var data = jQuery.parseJSON(response);
                        jQuery(data).each(function (key, val) {
                            HTML += '<div class="room_class"><fieldset><div class="bs-example"><div class="panel-group" id="accordion"><div class="panel panel-default"><div class="panel-heading">';
                            HTML += '<h4 class="panel-title heading_class" data-val="' + key + '"><a data-toggle="collapse" data-parent="#accordion" href="#collapseOne_' + key + '"><div class="arrow_pic custom_arrow_' + key + ' arrow_pic_off"></div>';
                            HTML += '<div class="heading-of-room" href="#">' + val.room_name + '</div></p></a></h4></div><div id="collapseOne_' + key + '" class="panel-collapse collapse">';
                            HTML += '<div class="panel-body"><div class="col-lg-12"><div class="col-lg-4 col-sm-4 col-xs-12"><div class="home_town"><h3>Nightly rate</h3>';
                            HTML += '<input  name="room_night_rate[]" value="' + ((val.room_night_rate != null) ? val.room_night_rate : ' ') + '" id="room_night_rate' + key + '" class="focus_help_menu" data-val="room_night_rate" type="text" placeholder=" Amount"></div></div><div class="col-lg-4 col-sm-4 col-xs-12"> ';
                            HTML += '<div class="home_town"><h3>Week end rate </h3><input name="room_weekend_rate[]" value="' + ((val.room_weekend_rate != null) ? val.room_weekend_rate : ' ') + '" id="room_weekend_rate' + key + '" class="focus_help_menu" data-val="room_weekend_rate" type="text" placeholder=" Amount ">';
                            HTML += '</div></div><div class="col-lg-4 col-sm-4 col-xs-12"><div class="home_town"><h3> Weekly rate </h3>';
                            HTML += '<input name="room_weekly_rate[]"  value="' + ((val.room_weekly != null) ? val.room_weekly : ' ') + '" id="room_weekly_rate' + key + '" class="focus_help_menu" data-val="room_weekly_rate" type="text" placeholder=" Amount "></div></div></div><div class="col-lg-12">';
                            HTML += '<div class="col-lg-6 col-sm-6 col-xs-12"><div class="home_town"><h3>Week end days </h3><select name="room_weekend_days[]" id="room_weekend_days' + key + '" class="select_box">';

                            HTML += '<option value="Friday"';
                            if (val.room_weekend_days != '' && val.room_weekend_days == 'Friday') {
                                HTML += 'selected';
                            }
                            HTML += '>Friday</option><option value="Saturday"';
                            if (val.room_weekend_days != '' && val.room_weekend_days == 'Saturday') {
                                HTML += 'selected';
                            }
                            HTML += '>Saturday</option><option value="Sunday"';
                            if (val.room_weekend_days != '' && val.room_weekend_days == 'Sunday') {
                                HTML += 'selected';
                            }
                            HTML += '>Sunday</option></select></div></div>';
                            HTML += '<div class="col-lg-6 col-sm-6 col-xs-12"><div class="home_town"><h3>Default board</h3><select name="room_default_board[]" id="room_default_board' + key + '" class="select_box">';
                            HTML += '<option selected="selected" disabled="disabled">Select board type</option><option value="1"';
                            HTML += ((val.room_weekend_days != '' && val.room_default_board == 1) ? 'selected="selected"' : '') + '>1</option><option  value="2"';
                            HTML += ((val.room_weekend_days != '' && val.room_default_board == 2) ? 'selected="selected"' : '') + '>2</option></select><input type="hidden" name="room_rate_ids[]" value="' + val.room_id + '" /></div></div>';
                            HTML += '</div></div></div></div>';
                        });
                    }
                    jQuery(".pricing_form_field").html(HTML);
                }
            });
            /***
             * For board type
             */

            var HTML1 = '<fieldset><div class="row"><div class="col-lg-12"><h6>Boards </h6></div></div>';
            var dataString = 'hotel_id=' + hotel_id;
            jQuery.ajax({
                data: dataString,
                url: '<?php echo $base_url; ?>/hotel/ajax/hotel_board_type',
                type: "post",
                async: false,
                beforeSend: function (xhr) {
                    preLoading('show', 'load-screen');
                },
                success: function (response) {

                    var data = jQuery.parseJSON(response);
                    if (data != '') {

                        var count = 1;
                        jQuery(data).each(function (key, val) {
                            HTML1 += '<div class="row board_class"><div class="col-lg-4 col-sm-12 col-xs-12"><div class="home_town"><h3>Board types </h3>';
                            HTML1 += '<select name="board_type[]" id="board_type' + key + '" class="select_box" ><option value="1" ' + ((val.board_type != '' && val.board_type == 1) ? 'selected="selected"' : '') + '>1</option>';
                            HTML1 += '<option value="2" ' + ((val.board_type != '' && val.board_type == 2) ? 'selected="selected"' : '') + '>2</option></select></div></div><div class="col-lg-8 col-sm-12 col-xs-12"><h3>Rent Adjustment </h3>';
                            HTML1 += '<div class="col-lg-3 col-sm-12 col-xs-12"><div class="home_town"><select name="rent_adjust_type[]" id="rent_adjust_type' + key + '" class="select_box">';
                            HTML1 += '<option value="1" ' + ((val.rent_adjust_type != '' && val.rent_adjust_type == 1) ? 'selected="selected"' : '') + '>1</option><option value="2" ' + ((val.rent_adjust_type != '' && val.rent_adjust_type == 2) ? 'selected="selected"' : '') + '>2</option></select></div></div>';
                            HTML1 += '<div class="col-lg-3 col-sm-12 col-xs-12"><div class="home_town"><input name="rent_adjust_price[]" value="' + val.board_amount + '" class="focus_help_menu" data-val="rent_adjust_price" id="rent_adjust_price' + key + '" type="text" placeholder="Amount  ">';
                            HTML1 += '</div></div><div class="col-lg-6 col-sm-12 col-xs-12"><div class="home_town"><select name="rent_adjust_duration[]" id="rent_adjust_duration' + key + '" class="select_box">';
                            HTML1 += '<option value="1" ' + ((val.board_duration != '' && val.board_duration == 1) ? 'selected="selected"' : '') + '>1</option><option value="2" ' + ((val.board_duration != '' && val.board_duration == 1) ? 'selected="selected"' : '') + '>2</option></select>';
                            HTML1 += '</div></div></div>';
                            if (count != 1) {
                                HTML1 += '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_left"><a href="javascript:void(0);" class="remove_board">Remove</a></div>';
                            }
                            HTML1 += '</div></div>';
                            count++;
                        });
                        HTML1 += '<div class = "col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_left" ><a href = "javascript:void(0);" class = "addanother_board addanother"> Add another </a></div>';
                    } else {
                        HTML1 += '<div class="row board_class"><div class="col-lg-4 col-sm-12 col-xs-12"><div class="home_town"><h3>Board types </h3>';
                        HTML1 += '<select name="board_type[]" id="board_type0" class="select_box" ><option value="1">1</option>';
                        HTML1 += '<option value="2">2</option></select></div></div><div class="col-lg-8 col-sm-12 col-xs-12"><h3>Rent Adjustment </h3>';
                        HTML1 += '<div class="col-lg-3 col-sm-12 col-xs-12"><div class="home_town"><select name="rent_adjust_type[]" id="rent_adjust_type0" class="select_box">';
                        HTML1 += '<option value="1">1</option><option value="2">2</option></select></div></div>';
                        HTML1 += '<div class="col-lg-3 col-sm-12 col-xs-12"><div class="home_town"><input name="rent_adjust_price[]" class="focus_help_menu" data-val="rent_adjust_price" id="rent_adjust_price0" type="text" placeholder="Amount  ">';
                        HTML1 += '</div></div><div class="col-lg-6 col-sm-12 col-xs-12"><div class="home_town"><select name="rent_adjust_duration[]" id="rent_adjust_duration0" class="select_box">';
                        HTML1 += '<option value="1">1</option><option value="2">2</option></select>';
                        HTML1 += '</div></div></div></div><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_left"><a href="javascript:void(0);" class="addanother_board addanother">Add another</a></div></div>';

                    }

                }
            });

            HTML1 += '</fieldset>';
            var div_html = jQuery(".pricing_form_field").html();
            jQuery(".pricing_form_field").html(div_html + HTML1);
            /**
             * For seasonal Price
             */
            var HTML2 = '<div class="outer_box"> <div class="row"> <h6>Seasonnal pricing </h6>';
            var dataString = 'hotel_id=' + hotel_id;
            jQuery.ajax({
                data: dataString,
                url: '<?php echo $base_url; ?>/hotel/ajax/hotel_seasonnalprice',
                type: "post",
                async: false,
                beforeSend: function (xhr) {
                    preLoading('show', 'load-screen');
                },
                success: function (response) {

                    var data = jQuery.parseJSON(response);
                    if (data.length != 0) {

                        var j = 0;
                        var length = data.length;
                        jQuery(data.data).each(function (key, val) {
                            if (j % length == 0) {
                                HTML2 += '<div class="seasonal_div_repeat"><div class="col-md-12 padding_left"> <div class="col-md-4 col-sm-6 col-xs-12 padding_left">';
                                HTML2 += '<div class="col-md-12 col-sm-12 col-xs-12"><h3>Period name </h3> <div class="home_town"> <input name="seasonal_name[]" value="' + val.period_name + '" class="focus_help_menu" data-val="seasonal_name" id="seasonal_name' + j + '" type="text" placeholder=" Period name ">';
                                HTML2 += '</div></div><div class="col-lg-12 col-sm-12 col-xs-12"> <div class="home_town"> <p class="para_peroid">Date</p><div class="col-lg-6 col-sm-6 col-xs-6 padding_left">';
                                HTML2 += '<input name="seasonal_date[]"  value="' + val.start_date + '" class="focus_help_menu seasonaldate seasonal_start_date" data-val="seasonal_date"  id="seasonal_date' + j + '" type="text" placeholder=" from"></div><div class="col-lg-6 col-sm-6 col-xs-6 paddng_right"><input name="seasonal_till_date[]"  value="' + val.end_date + '"  class="focus_help_menu seasonal_end_date" data-val="seasonal_till_date"  id="seasonal_till_date' + j + '" type="text" placeholder=" to">';
                                HTML2 += '</div></div></div><div class="col-lg-12 col-sm-12 col-xs-12"> <div class="home_town"> <p class="para_peroid">Min stay </p><select id="seasonal_minstay' + j + '" name="seasonal_minstay[]" class="select_box">';
                                HTML2 += ' <option value="1" ' + ((val.min_stay != '' && val.min_stay == 1) ? 'selected="selected"' : '') + '>1</option><option value="2" ' + ((val.min_stay != '' && val.min_stay == 2) ? 'selected="selected"' : '') + '>2</option></select></div></div></div><div class="col-md-8 col-sm-6 col-xs-12 padding_left paddng_right">';
                                HTML2 += ' <div class="col-md-12 col-sm-12 col-xs-12 col_right_wrap"> <div class="col-md-3 col-sm-12 col-xs-12"> <div class="home_town"><h3>Rooms</h3></div></div><div class="col-md-3 col-sm-12 col-xs-12">';
                                HTML2 += '<div class="home_town"><h3>Nightly rate </h3></div></div><div class="col-md-3 col-sm-12 col-xs-12"> <div class="home_town"><h3>Week end rate </h3></div></div><div class="col-md-3 col-sm-12 col-xs-12">';
                                HTML2 += ' <div class="home_town"><h3>Weekly rate</h3></div></div></div>';
                            }
                            j++;
                            HTML2 += ' <div class="col-md-12 col-sm-12 col-xs-12 col_room_wrap"> <div class="col-md-3 col-sm-12 col-xs-12 padding_left padding_right">';
                            HTML2 += ' <div class="home_town"> <p class="parah">' + val.room_name + '</p><p class="parap">No board rate </p></div></div><div class="col-md-3 col-sm-12 col-xs-12"> <div class="home_town"><input name="nightly_rate[]" value="' + val.nightly_rate + '" class="focus_help_menu" data-val="nightly_rate" id="nightly_rate" type="text" placeholder="Amount">';
                            HTML2 += '</div></div><div class="col-md-3 col-sm-12 col-xs-12"> <div class="home_town"><input name="weekendrate[]" value="' + val.weekend_rate + '" class="focus_help_menu" data-val="weekendrate"  id="weekendrate' + j + '" type="text" placeholder="Amount"></div></div><div class="col-md-3 col-sm-12 col-xs-12"> <div class="home_town">';
                            HTML2 += '<input name="weeklyrate[]" value="' + val.weekly_rate + '" id="weeklyrate' + j + '" class="focus_help_menu" data-val="weeklyrate" type="text" placeholder="Amount"><input type="hidden" name="room_ids_array[]" value="' + val.room_id + '"/></div></div></div>  ';
                            if (j % length == 0) {
                                HTML2 += '</div>';
                                if (j != 1) {
                                    HTML2 += '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_left paddng_right" align="left">';
                                    HTML2 += '<a href="javascript:void(0);" class="remove_seasonal delete pull-right">remove</a></div></div></div>';
                                }
                            }

                        });
                        HTML2 += ' </div><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_left paddng_right" align="left">';
                        HTML2 += ' <a href="javascript:void(0);" class="add_anothers_seasonal addanother">Add another</a></div></div>';

                    } else {

                        HTML2 += '<div class="seasonal_div_repeat"><div class="col-md-12 padding_left"> <div class="col-md-4 col-sm-6 col-xs-12 padding_left">';
                        HTML2 += '<div class="col-md-12 col-sm-12 col-xs-12"><h3>Period name </h3> <div class="home_town"> <input name="seasonal_name[]" class="focus_help_menu" data-val="seasonal_name" id="seasonal_name" type="text" placeholder=" Period name ">';
                        HTML2 += '</div></div><div class="col-lg-12 col-sm-12 col-xs-12"> <div class="home_town"> <p class="para_peroid">Date</p><div class="col-lg-6 col-sm-6 col-xs-6 padding_left">';
                        HTML2 += '<input name="seasonal_date[]" class="focus_help_menu start_seasonal_date seasonal_start_date" data-val="seasonal_date"  id="seasonal_date" type="text" placeholder=" from"></div><div class="col-lg-6 col-sm-6 col-xs-6 paddng_right"><input name="seasonal_till_date[]" class="focus_help_menu seasonal_end_date" data-val="seasonal_till_date"  id="seasonal_till_date" type="text" placeholder=" to">';
                        HTML2 += '</div></div></div><div class="col-lg-12 col-sm-12 col-xs-12"> <div class="home_town"> <p class="para_peroid">Min stay </p><select id="seasonal_minstay" name="seasonal_minstay[]" class="select_box">';
                        HTML2 += ' <option value="1">1</option><option value="2">2</option></select></div></div></div><div class="col-md-8 col-sm-6 col-xs-12 padding_left paddng_right">';
                        HTML2 += ' <div class="col-md-12 col-sm-12 col-xs-12 col_right_wrap"> <div class="col-md-3 col-sm-12 col-xs-12"> <div class="home_town"><h3>Rooms</h3></div></div><div class="col-md-3 col-sm-12 col-xs-12">';
                        HTML2 += '<div class="home_town"><h3>Nightly rate </h3></div></div><div class="col-md-3 col-sm-12 col-xs-12"> <div class="home_town"><h3>Week end rate </h3></div></div><div class="col-md-3 col-sm-12 col-xs-12">';
                        HTML2 += ' <div class="home_town"><h3>Weekly rate</h3></div></div></div>';


                        var dataString = 'hotel_id=' + hotel_id;
                        jQuery.ajax({
                            data: dataString,
                            url: $baseUrl + '/hotel/ajax/editroom',
                            type: "post",
                            async: false,
                            beforeSend: function (xhr) {
                                preLoading('show', 'load-screen');
                            },
                            success: function (response) {
                                preLoading('hide', 'load-screen');
                                var data = jQuery.parseJSON(response);
                                jQuery(data.data).each(function (key, val) {
                                    HTML2 += ' <div class="col-md-12 col-sm-12 col-xs-12 col_room_wrap"> <div class="col-md-3 col-sm-12 col-xs-12 padding_left padding_right">';
                                    HTML2 += ' <div class="home_town"> <p class="parah">' + val.room_name + '</p><p class="parap">No board rate </p></div></div><div class="col-md-3 col-sm-12 col-xs-12"> <div class="home_town"><input name="nightly_rate[]" class="focus_help_menu" data-val="nightly_rate" id="nightly_rate" type="text" placeholder="Amount">';
                                    HTML2 += '</div></div><div class="col-md-3 col-sm-12 col-xs-12"> <div class="home_town"><input name="weekendrate[]" class="focus_help_menu" data-val="weekendrate"  id="weekendrate" type="text" placeholder="Amount"></div></div><div class="col-md-3 col-sm-12 col-xs-12"> <div class="home_town">';
                                    HTML2 += '<input name="weeklyrate[]" id="weeklyrate" class="focus_help_menu" data-val="weeklyrate" type="text" placeholder="Amount"><input type="hidden" name="room_ids_array[]" value="' + val.room_id + '"/></div></div></div>';
                                });
                            }
                        });
                        HTML2 += ' </div></div></div></div><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_left paddng_right" align="left">';
                        HTML2 += ' <a href="javascript:void(0);" class="add_anothers_seasonal addanother">Add another</a></div></div>';

                    }
                }});


            var div_html = jQuery(".pricing_form_field").html();
            jQuery(".pricing_form_field").html(div_html + HTML2);
            //jQuery(".seasonaldate").datepicker();
            /**
             * Offers and discount
             */
            var hotel_id = '<?= arg(3); ?>';
            var hotel_data = new Array();
            var dataString = 'hotel_id=' + hotel_id;
            jQuery.ajax({
                data: dataString,
                url: '<?php echo $base_url; ?>/hotel/ajax/hotel_detail',
                type: "post",
                async: false,
                beforeSend: function (xhr) {
                    preLoading('show', 'load-screen');
                },
                success: function (response) {
                    var data = jQuery.parseJSON(response);
                    hotel_data["twenty_four"] = data.twenty_four;
                    hotel_data["lastmin"] = data.lastmin;
                    hotel_data["earlybird_offer"] = data.earlybird_offer;

                }});

            var HTML3 = '<div class="outer_box"><h6>Offers & Discounts </h6><fieldset><div class="col-lg-1 col-md-12 col-sm-12 col-xs-12 colLefttoffer">';
            HTML3 += '<img src="<?php echo $base_url; ?>/sites/all/themes/hotel_theme/img/offer-icon.png" width="40" height="98" alt="image"></div><div class="col-lg-11 col-md-11 col-sm-11 col-xs-11 padding_left colRightoffer">';
            HTML3 += '<div class="row"> <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <div class="hotel_amenities">';
            HTML3 += '<input type="checkbox" name="24_hour_offer" id="checkbox1" class="css-checkbox" />';
            HTML3 += '<label for="checkbox1" class="css-label radGroup1">24 hours offer</label></div>';
            HTML3 += '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> <a href="javascript:void(0);" class="add_more_24_offer addanother">Add another</a>';
            HTML3 += ' </div></div></div><div id="container_24">';

            HTML3 += '<div class="repeat_24_offer">';
            if (hotel_data["twenty_four"] == null) {

                HTML3 += '<div class="looping"><div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 padding_left">';
                HTML3 += ' <p class="offer_P">If booking is made on </p><div class="form-group"> <div id="datetimepicker5" class="input-group date">';
                HTML3 += ' <input name="offer_24_date[]" disabled="disabled" id="offer_24_date_0" class="focus_help_menu seasonal_start_date" data-val="offer_24_date" type="text" placeholder="Date"> </div></div></div><div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 padding_left">';
                HTML3 += ' <p class="offer_P">Apply discount of </p><input name="offer_24_amount[]" disabled="disabled" id="offer_24_amount0" class="focus_help_menu" data-val="offer_24_amount"  type="text" placeholder="$ Amount "> </div>';
                HTML3 += '<div class="col-lg-3 col-sm-12 col-xs-12 padding_left" > <div class="home_town"> <p>&nbsp;</p>';
                HTML3 += '<select name="offer_24_currency[]"  id="offer_24_currency0" disabled="disabled" class="select_box" tabindex="2"> <option> Amount in $ </option>';
                HTML3 += ' <option value="1">1</option><option value="1">2</option> </select> </div></div><div class="col-lg-2 col-sm-12 col-xs-12 padding_left paddng_right">';
                HTML3 += ' <div class="home_town"> <p>&nbsp;</p><h5 class="para_total_amount">On total amount </h5> </div>';
                HTML3 += '</div><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_left" align="right"> <a href="javascript:void(0);" class="remove_24_offer delete">Delete</a>';
                HTML3 += ' </div></div> ';

            } else {

                var data = jQuery.parseJSON(hotel_data["twenty_four"]);
                jQuery(data).each(function (key, value) {
                    HTML3 += '<div class="looping"><div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 padding_left">';
                    HTML3 += '<p class="offer_P">If booking is made on </p><div class="form-group"> <div id="datetimepicker5" class="input-group date">';
                    HTML3 += '<input name="offer_24_date[]" value="' + value.offer_24_hour + '" id="offer_24_date_' + key + '" class="focus_help_menu seasonal_start_date" data-val="offer_24_date" type="text" placeholder="Date"> </div></div></div><div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 padding_left">';
                    HTML3 += ' <p class="offer_P">Apply discount of </p><input name="offer_24_amount[]" value="' + value.offer_24_amount + '" id="offer_24_amount' + key + '" class="focus_help_menu" data-val="offer_24_amount"  type="text" placeholder="$ Amount "> </div>';
                    HTML3 += '<div class="col-lg-3 col-sm-12 col-xs-12 padding_left" > <div class="home_town"> <p>&nbsp;</p>';
                    HTML3 += '<select name="offer_24_currency[]"  id="offer_24_currency' + key + '" class="select_box" tabindex="2"> <option> Amount in $ </option>';
                    HTML3 += ' <option value="1" ' + ((value.offer_24_currency != '' && value.offer_24_currency == 1) ? 'selected="selected"' : '') + '>1</option><option value="2" ' + ((value.offer_24_currency != '' && value.offer_24_currency == 2) ? 'selected="selected"' : '') + '> 2</option> </select> </div></div><div class="col-lg-2 col-sm-12 col-xs-12 padding_left paddng_right">';
                    HTML3 += ' <div class="home_town"> <p>&nbsp;</p><h5 class="para_total_amount">On total amount </h5> </div>';
                    HTML3 += '</div><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_left" align="right"> <a href="javascript:void(0);" class="remove_24_offer delete">Delete</a>';
                    HTML3 += ' </div></div>';
                });
            }

            HTML3 += '</div></div></div></fieldset> <fieldset> <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12 colLeftoffer">';
            HTML3 += '<img src="<?php echo $base_url; ?>/sites/all/themes/hotel_theme/img/offer-icon-2.png" width="40" height="98" alt="image"> </div><div class="col-lg-11 col-md-11 col-sm-12 col-xs-12 padding_left colRightoffer">';
            HTML3 += ' <div class="row"> <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <div class="hotel_amenities"> <input type="checkbox" name="last_min_offer" id="lastminute" class="css-checkbox" />';
            HTML3 += '<label for="lastminute" class="css-label radGroup1">Last minute Offer </label></div><div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> <a href="javascript:void(0);" class="add_more_lastminute_offer addanother">Add another</a> </div></div></div><div id="container_lastmin"><div class="repeat_lastminute_offer">';
            if (hotel_data["lastmin"] == null) {
                HTML3 += '<div class="looping"><div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 padding_left"> <p class="offer_P">If booking is made less than </p><div class="col-lg-6 col-sm-12 col-xs-12 padding_left" >';
                HTML3 += '<div class="home_town"> <select name="lastmin_time_value[]" disabled="disabled" id="lastmin_time_value_0" data-val="lastmin_time_value"  class="focus_help_menu select_box" > <option value="1"> 1</option> <option value="2"> 2</option> <option value="3" >3</option></select> </div></div>';
                HTML3 += '<div class="col-lg-6 col-sm-12 col-xs-12 padding_left paddng_right" > <div class="home_town"> <select disabled="disabled" id="lastmin_time_type_0" data-val="lastmin_time_type" name="lastmin_time_type[]" class="focus_help_menu select_box" > <option selected="selected" disabled="disabled" > Days</option>';
                HTML3 += '<option value="1">1</option> <option value="2" > 2</option><option value="3" > 3</option> </select> </div></div><p class="offer_P">prior to reservation date </p></div><div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 padding_left">';
                HTML3 += '<p class="offer_P">Apply discount of </p><input name="lastmin_amount[]" disabled="disabled" id="lastmin_amount_0" class="focus_help_menu" data-val="lastmin_amount" type="text" placeholder="$ Amount "> </div><div class="col-lg-3 col-sm-12 col-xs-12 padding_left" > <div class="home_town"> <p>&nbsp;</p>';
                HTML3 += '<select name="lastmin_currency[]" disabled="disabled" id="lastmin_currency_0" class="select_box" tabindex="2"> <option > Amount in $ </option> <option > 1</option> <option > 2</option> </select> </div></div>';
                HTML3 += '<div class="col-lg-2 col-sm-12 col-xs-12 padding_left paddng_right"> <div class="home_town"> <p>&nbsp;</p><h5 class="para_total_amount">On total amount </h5> </div></div>';
                HTML3 += '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_left " align="right"> <a href="javascript:void(0);" class="remove_lastminute_offer delete">Delete</a></div></div> ';
            } else {
                var data = jQuery.parseJSON(hotel_data["lastmin"]);
                jQuery(data).each(function (key, value) {
                    HTML3 += '<div class="looping"><div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 padding_left"> <p class="offer_P">If booking is made less than </p><div class="col-lg-6 col-sm-12 col-xs-12 padding_left" >';
                    HTML3 += '<div class="home_town"> <select name="lastmin_time_value[]"  id="lastmin_time_value_' + key + '" data-val="lastmin_time_value"  class="focus_help_menu select_box" ><option value="1" ' + ((value.lastmin_time_value != '' && value.lastmin_time_value == 1) ? 'selected="selected"' : '') + ' >1</option> <option value="2" ' + ((value.lastmin_time_value != '' && value.lastmin_time_value == 2) ? 'selected="selected"' : '') + '>2</option><option value="3" ' + ((value.lastmin_time_value != '' && value.lastmin_time_value == 3) ? 'selected="selected"' : '') + '>3</option> </select> </div></div>';
                    HTML3 += '<div class="col-lg-6 col-sm-12 col-xs-12 padding_left paddng_right" > <div class="home_town"> <select id="lastmin_time_type_' + key + '" data-val="lastmin_time_type" name="lastmin_time_type[]" class="focus_help_menu select_box" tabindex="2"> <option > Days</option>';
                    HTML3 += '<option value="1" ' + ((value.lastmin_time_type != '' && value.lastmin_time_type == 1) ? 'selected="selected"' : '') + '>1</option> <option value="2" ' + ((value.lastmin_time_type != '' && value.lastmin_time_type == 2) ? 'selected="selected"' : '') + ' > 2</option> </select> </div></div><p class="offer_P">prior to reservation date </p></div><div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 padding_left">';
                    HTML3 += '<p class="offer_P">Apply discount of </p><input name="lastmin_amount[]" id="lastmin_amount_' + key + '" value="' + value.lastmin_amount + '" class="focus_help_menu" data-val="lastmin_amount" type="text" placeholder="$ Amount "> </div><div class="col-lg-3 col-sm-12 col-xs-12 padding_left" > <div class="home_town"> <p>&nbsp;</p>';
                    HTML3 += '<select name="lastmin_currency[]" id="lastmin_currency_' + key + '" class="select_box" tabindex="2"> <option > Amount in $ </option> <option value="1" ' + ((value.lastmin_currency != '' && value.lastmin_currency == 1) ? 'selected="selected"' : '') + ' > 1</option> <option value="2" ' + ((value.lastmin_currency != '' && value.lastmin_currency == 2) ? 'selected="selected"' : '') + '> 2</option> </select> </div></div>';
                    HTML3 += '<div class="col-lg-2 col-sm-12 col-xs-12 padding_left paddng_right"> <div class="home_town"> <p>&nbsp;</p><h5 class="para_total_amount">On total amount </h5> </div></div>';
                    HTML3 += '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_left " align="right"> <a href="javascript:void(0);" class="remove_lastminute_offer delete">Delete</a></div></div>';
                });
            }
            HTML3 += '</div></div></div></fieldset> <fieldset>';
            HTML3 += ' <div class="col-lg-1 col-md-12 col-sm-12 col-xs-12 colLeftoffer"> <img src="<?php echo $base_url; ?>/sites/all/themes/hotel_theme/img/offer-icon-3.png" width="40" height="98" alt="image"> </div>';
            HTML3 += '<div class="col-lg-11 col-md-11 col-sm-11 col-xs-11 padding_left colRightoffer"> <div class="row"> <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
            HTML3 += ' <div class="hotel_amenities"> <input type="checkbox" name="early_bird_offer" id="early_bird_check" class="css-checkbox" /><label for="early_bird_check" class="css-label radGroup1">Early Birds Offer </label>';
            HTML3 += '</div><div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> <a href="javascript:void(0);" class="add_more_earlybird_offer addanother">Add another</a> </div></div></div><div id="container_early">';


            HTML3 += '<div class="repeat_earlybird_offer">';
            if (hotel_data["earlybird_offer"] == null) {
                HTML3 += '<div class="looping"> <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 padding_left">';
                HTML3 += ' <p class="offer_P">If booking is made more than </p><div class="col-lg-6 col-sm-12 col-xs-12 padding_left" > <div class="home_town"> <select name="earlybird_time_val[]" disabled="disabled" id="earlybird_time_val_0" class="select_box"><option value="1"> 1</option>';
                HTML3 += ' <option value="2" >2</option> <option value="3">3</option> </select> </div></div><div class="col-lg-6 col-sm-12 col-xs-12 padding_left paddng_right" > <div class="home_town"> <select name="earlybird_time_type[]" disabled="disabled" id="earlybird_time_type_0" class="select_box" tabindex="2">';
                HTML3 += ' <option selected="selected" disabled="disabled" > Days</option> <option value="1" > 1</option> <option value="2"> 2</option><option value="3">3</option> </select> </div></div><p class="offer_P">prior to reservation date </p></div><div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 padding_left">';
                HTML3 += ' <p class="offer_P">Apply discount of </p><input name="earlybird_amount[]" disabled="disabled"  id="earlybird_amount_0" data-val="earlybird_amount" class="focus_help_menu" type="text" placeholder="$ Amount "> </div><div class="col-lg-3 col-sm-12 col-xs-12 padding_left" > <div class="home_town"> <p>&nbsp;</p><select name="earlybird_currency[]" id="earlybird_currency_0" class="select_box" >';
                HTML3 += ' <option > Amount in $ </option> <option value="1" > 1</option> <option value="2" > 2</option> <option value="3"> 3</option></select> </div></div><div class="col-lg-2 col-sm-12 col-xs-12 padding_left paddng_right"> <div class="home_town">';
                HTML3 += ' <p>&nbsp;</p><h5 class="para_total_amount">On total amount </h5>';
                HTML3 += ' </div></div><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_left" align="right"> <a href="javascript:void(0);" class="remove_earlybird_offer delete">Delete</a> </div>';
            } else {
                var data = jQuery.parseJSON(hotel_data["earlybird_offer"]);
                jQuery(data).each(function (key, value) {
                    HTML3 += '<div class="looping"> <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 padding_left">';
                    HTML3 += ' <p class="offer_P">If booking is made more than </p><div class="col-lg-6 col-sm-12 col-xs-12 padding_left" > <div class="home_town"> <select name="earlybird_time_val[]" id="earlybird_time_val_' + key + '" class="select_box"> <option value="1" ' + ((value.earlybird_time_val != '' && value.earlybird_time_val == 1) ? 'selected="selected"' : '') + ' > 1</option>';
                    HTML3 += ' <option value="2"  ' + ((value.earlybird_time_val != '' && value.earlybird_time_val == 2) ? 'selected="selected"' : '') + '>2</option> <option value="3"  ' + ((value.earlybird_time_val != '' && value.earlybird_time_val == 3) ? 'selected="selected"' : '') + ' > 2</option> </select> </div></div><div class="col-lg-6 col-sm-12 col-xs-12 padding_left paddng_right" > <div class="home_town"> <select name="earlybird_time_type[]" id="earlybird_time_type_' + key + '" class="select_box">';
                    HTML3 += ' <option selected="selected" disabled="disabled"> Days</option> <option value="1" ' + ((value.earlybird_time_type != '' && value.earlybird_time_type == 1) ? 'selected="selected"' : '') + '  > 1</option><option value="2" ' + ((value.earlybird_time_type != '' && value.earlybird_time_type == 2) ? 'selected="selected"' : '') + '> 2</option> </select> </div></div><p class="offer_P">prior to reservation date </p></div><div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 padding_left">';
                    HTML3 += ' <p class="offer_P">Apply discount of </p><input name="earlybird_amount[]" value="' + value.earlybird_amount + '"  id="earlybird_amount_' + key + '" data-val="earlybird_amount" class="focus_help_menu" type="text" placeholder="$ Amount "> </div><div class="col-lg-3 col-sm-12 col-xs-12 padding_left" > <div class="home_town"> <p>&nbsp;</p><select name="earlybird_currency[]" id="earlybird_currency_' + key + '" class="select_box" tabindex="2">';
                    HTML3 += ' <option value="1" ' + ((value.earlybird_currency != '' && value.earlybird_currency == 1) ? 'selected="selected"' : '') + '> Amount in $ </option> <option value="2" ' + ((value.earlybird_currency != '' && value.earlybird_currency == 2) ? 'selected="selected"' : '') + '> 2</option> <option value="3" ' + ((value.earlybird_currency != '' && value.earlybird_currency == 3) ? 'selected="selected"' : '') + ' > 3</option> </select> </div></div><div class="col-lg-2 col-sm-12 col-xs-12 padding_left paddng_right"> <div class="home_town">';
                    HTML3 += ' <p>&nbsp;</p><h5 class="para_total_amount">On total amount </h5>';
                    HTML3 += ' </div></div><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_left" align="right"> <a href="javascript:void(0);" class="remove_earlybird_offer delete">Delete</a> </div></div>';
                });
            }
            HTML3 += '</div></div></fieldset> </div>';
            var div_html = jQuery(".pricing_form_field").html();
            jQuery(".pricing_form_field").html(div_html + HTML3);

        </script>
    <?php } elseif (arg(2) == 'location') {
        ?>
        <div class="locationpopup" style="display:none;">
            <form action="javascript:void(0);" id="hotel_location_form" name="hotel_location_form" method="POST">
                <div class="locationblock">
                    <div class="closebtn hide_popup"><i class="fa fa-remove"></i></div>
                    <div class="col-md-12 col-sm-12 col-xs-12">	<h3>Enter Address</h3>	</div> <!-- End Col -->

                    <div class="col-md-12 col-sm-12 col-xs-12 addressblock">
                        <label>Address Line 1  <span class="mandatory">*</span></label>
                        <input type="text" id="edit-address1" onfocus="initialize_trip();" name="addressline1" placeholder="ex. Rua Bossoroca, 1" />
                    </div> <!-- End Col -->

                    <div class="col-md-12 col-sm-12 col-xs-12 addressblock">
                        <label>Address Line 2</label>
                        <input type="text" id="edit-address2" name="addressline2" placeholder="ex. apt 50" />
                    </div> <!-- End Col -->

                    <div class="col-md-12 col-sm-12 col-xs-12 addressblock">
                        <label>City <span class="mandatory">*</span></label>
                        <input type="text" id="edit-city" name="city" placeholder="ex. Rua Bossoroca, 1" />
                    </div> <!-- End Col -->

                    <div class="col-md-12 col-sm-12 col-xs-12 addressblock">
                        <label>State / Province / Region  <span class="mandatory">*</span></label>
                        <input type="text" id="edit-state" name="state" placeholder="ex. Rua Bossoroca, 1" />
                    </div> <!-- End Col -->

                    <div class="col-md-12 col-sm-12 col-xs-12 addressblock">
                        <label>Zip / Postal Code</label>
                        <input type="text" id="edit-zipcode" name="zipcode" placeholder="ex. 437719" />
                        <input type="hidden" id="edit-zipcode" name="hotel_id" value="<?= arg(3); ?>" />
                    </div> <!-- End Col -->

                    <div class="col-md-12 col-sm-12 col-xs-12 addressblock">
                        <label>Country <span class="mandatory">*</span></label>
                        <select name="country_popup" class="select_box" id="edit-country" >
                            <option value="" selected="selected" disabled="disabled">Select Country</option>
                            <option  value="Afghanistan">Afghanistan</option><option  value="Albania">Albania</option><option  value="Algeria">Algeria</option><option  value="American Samoa">American Samoa</option><option  value="Andorra">Andorra</option><option  value="Angola">Angola</option><option  value="Anguilla">Anguilla</option><option  value="Antarctica">Antarctica</option><option  value="Antigua and Barbuda">Antigua and Barbuda</option><option  value="Argentina">Argentina</option><option  value="Armenia">Armenia</option><option  value="Aruba">Aruba</option><option  value="Australia">Australia</option><option  value="Austria">Austria</option><option  value="Azerbaijan">Azerbaijan</option><option  value="Bahamas">Bahamas</option><option  value="Bahrain">Bahrain</option><option  value="Bangladesh">Bangladesh</option><option  value="Barbados">Barbados</option><option  value="Belarus">Belarus</option><option  value="Belgium">Belgium</option><option  value="Belize">Belize</option><option  value="Benin">Benin</option><option  value="Bermuda">Bermuda</option><option  value="Bhutan">Bhutan</option><option  value="Bolivia, Plurinational State of">Bolivia, Plurinational State of</option><option  value="Bonaire, Sint Eustatius and Saba">Bonaire, Sint Eustatius and Saba</option><option  value="Bosnia and Herzegovina">Bosnia and Herzegovina</option><option  value="Botswana">Botswana</option><option  value="Bouvet Island">Bouvet Island</option><option  value="Brazil">Brazil</option><option  value="British Indian Ocean Territory">British Indian Ocean Territory</option><option  value="Brunei Darussalam">Brunei Darussalam</option><option  value="Bulgaria">Bulgaria</option><option  value="Burkina Faso">Burkina Faso</option><option  value="Burundi">Burundi</option><option  value="Cambodia">Cambodia</option><option  value="Cameroon">Cameroon</option><option  value="Canada">Canada</option><option  value="Cape Verde">Cape Verde</option><option  value="Cayman Islands">Cayman Islands</option><option  value="Central African Republic">Central African Republic</option><option  value="Chad">Chad</option><option  value="Chile">Chile</option><option  value="China">China</option><option  value="Christmas Island">Christmas Island</option><option  value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option><option  value="Colombia">Colombia</option><option  value="Comoros">Comoros</option><option  value="Congo">Congo</option><option value="Congo, the Democratic Republic of the">Congo, the Democratic Republic of the</option><option value="Cook Islands">Cook Islands</option><option value="Costa Rica">Costa Rica</option><option value="Croatia">Croatia</option><option value="Cuba">Cuba</option><option value="CuraÃƒÂ§ao">CuraÃƒÂ§ao</option><option value="Cyprus">Cyprus</option><option value="Czech Republic">Czech Republic</option><option value="CÃƒÂ´te d'Ivoire">CÃƒÂ´te d'Ivoire</option><option value="Denmark">Denmark</option><option value="Djibouti">Djibouti</option><option value="Dominica">Dominica</option><option value="Dominican Republic">Dominican Republic</option><option value="Ecuador">Ecuador</option><option value="Egypt">Egypt</option><option value="El Salvador">El Salvador</option><option value="Equatorial Guinea">Equatorial Guinea</option><option value="Eritrea">Eritrea</option><option value="Estonia">Estonia</option><option value="Ethiopia">Ethiopia</option><option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option><option value="Faroe Islands">Faroe Islands</option><option value="Fiji">Fiji</option><option value="Finland">Finland</option><option value="France">France</option><option value="French Guiana">French Guiana</option><option value="French Polynesia">French Polynesia</option><option value="French Southern Territories">French Southern Territories</option><option value="Gabon">Gabon</option><option value="Gambia">Gambia</option><option value="Georgia">Georgia</option><option value="Germany">Germany</option><option value="Ghana">Ghana</option><option value="Gibraltar">Gibraltar</option><option value="Greece">Greece</option><option value="Greenland">Greenland</option><option value="Grenada">Grenada</option><option value="Guadeloupe">Guadeloupe</option><option value="Guam">Guam</option><option value="Guatemala">Guatemala</option><option value="Guernsey">Guernsey</option><option value="Guinea">Guinea</option><option value="Guinea-Bissau">Guinea-Bissau</option><option value="Guyana">Guyana</option><option value="Haiti">Haiti</option><option value="Heard Island and McDonald Mcdonald Islands">Heard Island and McDonald Mcdonald Islands</option><option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option><option value="Honduras">Honduras</option><option value="Hong Kong">Hong Kong</option><option value="Hungary">Hungary</option><option value="Iceland">Iceland</option><option value="India">India</option><option value="Indonesia">Indonesia</option><option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option><option value="Iraq">Iraq</option><option value="Ireland">Ireland</option><option value="Isle of Man">Isle of Man</option><option value="Israel">Israel</option><option value="Italy">Italy</option><option value="Jamaica">Jamaica</option><option value="Japan">Japan</option><option value="Jersey">Jersey</option><option value="Jordan">Jordan</option><option value="Kazakhstan">Kazakhstan</option><option value="Kenya">Kenya</option><option value="Kiribati">Kiribati</option><option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option><option value="Korea, Republic of">Korea, Republic of</option><option value="Kuwait">Kuwait</option><option value="Kyrgyzstan">Kyrgyzstan</option><option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option><option value="Latvia">Latvia</option><option value="Lebanon">Lebanon</option><option value="Lesotho">Lesotho</option><option value="Liberia">Liberia</option><option value="Libya">Libya</option><option value="Liechtenstein">Liechtenstein</option><option value="Lithuania">Lithuania</option><option value="Luxembourg">Luxembourg</option><option value="Macao">Macao</option><option value="Macedonia, the Former Yugoslav Republic of">Macedonia, the Former Yugoslav Republic of</option><option value="Madagascar">Madagascar</option><option value="Malawi">Malawi</option><option value="Malaysia">Malaysia</option><option value="Maldives">Maldives</option><option value="Mali">Mali</option><option value="Malta">Malta</option><option value="Marshall Islands">Marshall Islands</option><option value="Martinique">Martinique</option><option value="Mauritania">Mauritania</option><option value="Mauritius">Mauritius</option><option value="Mayotte">Mayotte</option><option value="Mexico">Mexico</option><option value="Micronesia, Federated States of">Micronesia, Federated States of</option><option value="Moldova, Republic of">Moldova, Republic of</option><option value="Monaco">Monaco</option><option value="Mongolia">Mongolia</option><option value="Montenegro">Montenegro</option><option value="Montserrat">Montserrat</option><option value="Morocco">Morocco</option><option value="Mozambique">Mozambique</option><option value="Myanmar">Myanmar</option><option value="Namibia">Namibia</option><option value="Nauru">Nauru</option><option value="Nepal">Nepal</option><option value="Netherlands">Netherlands</option><option value="New Caledonia">New Caledonia</option><option value="New Zealand">New Zealand</option><option value="Nicaragua">Nicaragua</option><option value="Niger">Niger</option><option value="Nigeria">Nigeria</option><option value="Niue">Niue</option><option value="Norfolk Island">Norfolk Island</option><option value="Northern Mariana Islands">Northern Mariana Islands</option><option value="Norway">Norway</option><option value="Oman">Oman</option><option value="Pakistan">Pakistan</option><option value="Palau">Palau</option><option value="Palestine, State of">Palestine, State of</option><option value="Panama">Panama</option><option value="Papua New Guinea">Papua New Guinea</option><option value="Paraguay">Paraguay</option><option value="Peru">Peru</option><option value="Philippines">Philippines</option><option value="Pitcairn">Pitcairn</option><option value="Poland">Poland</option><option value="Portugal">Portugal</option><option value="Puerto Rico">Puerto Rico</option><option value="Qatar">Qatar</option><option value="Romania">Romania</option><option value="Russian Federation">Russian Federation</option><option value="Rwanda">Rwanda</option><option value="RÃƒÂ&copy;union">RÃƒÂ&copy;union</option><option value="Saint BarthÃƒÂ&copy;lemy">Saint BarthÃƒÂ&copy;lemy</option><option value="Saint Helena, Ascension and Tristan da Cunha">Saint Helena, Ascension and Tristan da Cunha</option><option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option><option value="Saint Lucia">Saint Lucia</option><option value="Saint Martin (French part)">Saint Martin (French part)</option><option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option><option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option><option value="Samoa">Samoa</option><option value="San Marino">San Marino</option><option value="Sao Tome and Principe">Sao Tome and Principe</option><option value="Saudi Arabia">Saudi Arabia</option><option value="Senegal">Senegal</option><option value="Serbia">Serbia</option><option value="Seychelles">Seychelles</option><option value="Sierra Leone">Sierra Leone</option><option value="Singapore">Singapore</option><option value="Sint Maarten (Dutch part)">Sint Maarten (Dutch part)</option><option value="Slovakia">Slovakia</option><option value="Slovenia">Slovenia</option><option value="Solomon Islands">Solomon Islands</option><option value="Somalia">Somalia</option><option value="South Africa">South Africa</option><option value="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option><option value="South Sudan">South Sudan</option><option value="Spain">Spain</option><option value="Sri Lanka">Sri Lanka</option><option value="Sudan">Sudan</option><option value="Suriname">Suriname</option><option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option><option value="Swaziland">Swaziland</option><option value="Sweden">Sweden</option><option value="Switzerland">Switzerland</option><option value="Syrian Arab Republic">Syrian Arab Republic</option><option value="Taiwan, Province of China">Taiwan, Province of China</option><option value="Tajikistan">Tajikistan</option><option value="Tanzania, United Republic of">Tanzania, United Republic of</option><option value="Thailand">Thailand</option><option value="Timor-Leste">Timor-Leste</option><option value="Togo">Togo</option><option value="Tokelau">Tokelau</option><option value="Tonga">Tonga</option><option value="Trinidad and Tobago">Trinidad and Tobago</option><option value="Tunisia">Tunisia</option><option value="Turkey">Turkey</option><option value="Turkmenistan">Turkmenistan</option><option value="Turks and Caicos Islands">Turks and Caicos Islands</option><option value="Tuvalu">Tuvalu</option><option value="Uganda">Uganda</option><option value="Ukraine">Ukraine</option><option value="United Arab Emirates">United Arab Emirates</option><option value="United Kingdom">United Kingdom</option><option value="United States">United States</option><option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option><option value="Uruguay">Uruguay</option><option value="Uzbekistan">Uzbekistan</option><option value="Vanuatu">Vanuatu</option><option value="Venezuela, Bolivarian Republic of">Venezuela, Bolivarian Republic of</option><option value="Viet Nam">Viet Nam</option><option value="Virgin Islands, British">Virgin Islands, British</option><option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option><option value="Wallis and Futuna">Wallis and Futuna</option><option value="Western Sahara">Western Sahara</option><option value="Yemen">Yemen</option><option value="Zambia">Zambia</option><option value="Zimbabwe">Zimbabwe</option><option value="Ã…land Islands">Ã…land Islands</option>
                        </select>
                    </div> <!-- End Col -->

                    <div class="col-md-12 col-sm-12 col-xs-12 addressblock text-center"><input type="submit" name="saveaddress" value="Save" id="hotel_location_btn" class="button" /></div> <!-- End Col -->

                </div> <!-- End Locationblock -->
            </form>
        </div>
        <?php
        $data = gethotel_detail(arg(3));
        $latitude = number_format($data[0]["hotel_latitude"], 5);
        $longitude = number_format($data[0]["hotel_longitude"], 5);
        ?>
        <script>
            function initMap() {
                var lati = parseFloat('<?= $latitude ?>');
                var logi = parseFloat('<?= $longitude ?>');
                var myLatLng = {lat: lati, lng: logi};
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 6,
                    center: myLatLng
                });
                var marker = new google.maps.Marker({
                    position: myLatLng,
                    map: map,
                });
            }
            google.maps.event.addDomListener(window, 'load', initMap);
        </script>
        <?php
    }
    ?>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    <script>
   //			var datepicker = jQuery.fn.datepicker.noConflict();
   //			jQuery.fn.bootstrapDP = datepicker;   
   //			jQuery('.seasonaldate').datepicker({
   //			    format: 'mm/dd/yyyy',
   //			    startDate: '-3d'
   //			})
               /**
                * jQuery add calender to seasonal pricing 
                */

               /**
                * jQuery add calender to seasonal pricing 
                */
               jQuery("body").on("focus", ".seasonal_end_date,.seasonal_start_date", function () {
                   var me = jQuery(this);
                   jQuery(this).datepicker();
               });

    </script>