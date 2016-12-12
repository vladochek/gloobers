<?php
global $base_url,$user;
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/landing_page.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/gloobers.css','file');

drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/landing_custom.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/stylesheet/for-head-foot.css','file');

drupal_add_css(
        $base_url . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/css/stylemenu.css', array(
    'group' => CSS_THEME,
    'type' => 'external',
    'media' => 'all',
    'preprocess' => FALSE,
    'every_page' => FALSE,
    'weight' => '9999',
        )
);
?>
<style>
    .notificationContainerItems label {
        display: block;
        /*padding: 0 10px;*/
    }
    .notificationContainerItems td {
        vertical-align: middle!important;
    }
    .notificationContainerItems .profile-icon-notification{
        width: 80px;
        height: 80px;
        border-radius: 100px;
    }
    .notificationContainerItems .label-notification {
        color: #8f8f8f;
        margin-top: 30px;
    }
    .notificationContainerItems{
        background: #fff;
    }
    .notificationContainerItems .req_massage{
        width: 500px;
        top: -10px;
        position: relative;
    }
</style>


<?php 
if(empty($notificationList)){ 
    //echo "<pre>";print_r($notificationList);exit;
?>
<!--<section class="myrequest notificationContainerItems">
                <div class="dr-wrapper">
                    <div class="">
                        <div class="table-responsive no_Notification">
                           
                           <h2></h2>    
                        </div>
                    </div>
                </div>
</section>-->
<div class="dr-wrapper">
  <div class="col-lg-12 no_Notification">
    <div class="errorstuf"> 
      <div class="titleline">
        <p><span>!</span><?php echo t('Sorry! You have no Notification.'); ?></p>
      </div>
      <div class="btnback"><a href="<?php echo $base_url;?>"><?php echo t('Back to Home Page'); ?></a></div>
    </div>
  </div>
</div>
<?php
}else{//echo "<pre>";Print_r($notificationList);exit;
foreach ($notificationList as $key => $notification) { ?>
            <section class="myrequest notificationContainerItems">
                <div class="dr-wrapper">
                    <div class="">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td colspan="2"><h2 class="label-notification"><?php echo ucwords($key); ?><h2></td>
										<?php if($key !='messages' && $key !='recommend listing'){ ?>
                                         <td><a class="btn btn-default actionbtn" href="<?php echo $base_url.'/'.$notification[0]['noti_url']; ?>">View All</td> 
										 <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    foreach ($notification as $notificationResult) { 
                                        $file = file_load($notificationResult['picture']);
                                        $imgpath = $file->uri;
                                        $src = file_create_url($imgpath);
                                        $noPic = $base_url . '/' . drupal_get_path('theme', 'gloobers') . "/images/no-profile-male-img.jpg";
                                        $src = ($src) ? $src : $noPic;
                                        
                                        switch ($notificationResult['post_type']){
                                            case 'requests received':
                                                $url = $base_url.'/advice/request/'.base64_encode('gloobe__'.$notificationResult['sender_id']);
                                                break;
                                            case 'my request':
                                                 $url = $base_url.'/advice/request/'.base64_encode('gloobe__'.$notificationResult['sender_id']);
                                                break;
											case 'declined request':
                                                 $url = $base_url.'/advice/request/'.base64_encode('gloobe__'.$notificationResult['sender_id']);
                                                break;
											 case 'recommend listing':
                                                 $url = $base_url.'/'.$notificationResult['noti_url'];
                                                break;
                                            case 'messages':
										
										
                                                $url = $base_url.'/advice/messages';
                                                break;
                                        }
                                    ?> 
                                        <tr>
                                            <td style="text-align: center;">
                                                <img alt="image" onerror="this.onerror=null;this.src='<?php echo $noPic; ?>'" src="<?php echo $src; ?>" class="profile-icon-notification">
                                                <label><?php 
                                                   $name=user_load($notificationResult['uid']);
                                                echo $name->field_first_name['und'][0]['value'];
                                               ?>


                                                </label>
                                            </td>
                                            <td>
                                                <div class="req_massage">
                                                    <p><?php echo stripslashes($notificationResult['noti_msg']); ?></p>
													<p><?php    
                                                    $get =  date('Y-m-d H:i:s',$notificationResult['notification_time']);
                                                    $get_date = strtotime($get)+86400;
                                                    $get_date = date('Y-m-d H:i:s',$get_date);
                                                    $current_date=date('Y-m-d H:i:s');
                                                     ?> </p>
                                                    <?php echo $get;  ?>

                                                </div>
                                            </td>
                                            <td>

                                            <?php
                                                if($key!='messages' && $key!='declined request'){
                                                if($key=='requests received'){                                                    
                                                    if(strtotime($get_date)<=strtotime($current_date)) { ?>
                                                    <a class="btn btn-success actionbtn" >Expired 
                                                    <?php   } else { ?>
                                                    <a class="btn btn-success actionbtn" href="<?php echo $url; ?>">View Details
                                                    <?php  }
                                                } else { ?>
                                                <a class="btn btn-success actionbtn" href="<?php echo $url; ?>">View Details
                                                <?php  }} ?>										

                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
            <?php
        }
		}
        ?>


        <!--Add required JS files -->
        <?php
//Add required js 
        $file = $base_url . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/js/advisor.js';
        drupal_add_js($file, array(
            'type' => 'external',
            'scope' => 'footer',
            'group' => JS_THEME,
            'every_page' => FALSE,
            'weight' => -1,
        ));

        $timepickerjs = $base_url . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/js/bootstrap-datetimepicker.js';
        drupal_add_js($timepickerjs, array(
            'type' => 'external',
            'scope' => 'footer',
            'group' => JS_THEME,
            'every_page' => FALSE,
            'weight' => -1,
        ));

        $styleMenu = $base_url . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/js/stylemenu_main.js';
        drupal_add_js($styleMenu, array(
            'type' => 'external',
            'scope' => 'footer',
            'group' => JS_THEME,
            'every_page' => FALSE,
            'weight' => -1,
        ));
        ?>