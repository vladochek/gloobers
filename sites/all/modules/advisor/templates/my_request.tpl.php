<?php

global $base_url,$user;


$userDetails = user_load($user->uid);
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/landing_page.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/stylesheet/for-head-foot.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/gloobers.css','file');
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



/**

*@deprecated Add inline css do not put the css out of file(external). 

It is already using for other section . There was need of same DOM Structure but with some little modication so here we create inline css

*/



drupal_add_css(

        '@media only screen and (min-width:1210px){.guide-travel .travelblock{width: 33.333%;}}

        .guide-travel .travelblock .guidesec a h3{font-size: 20px!important;}

        .guide-travel .travelblock .guidesec a h3{font-size: 20px!important;}

        .user-sec .guide-travel .travelblock .guidesec p.text {font-size: 14px!important;font-weight: bold;}

        .user-sec .guide-travel {padding: 0;margin-bottom: 10px;}

        .user-sec .guide-travel .travelblock .guidesec {top: 23%;}

        .user-sec .guide-travel .travelblock .guidesec .topspace {padding-top: 5%;}', array(

    'group' => CSS_THEME,

    'type' => 'inline',

    'media' => 'all',

    'preprocess' => FALSE,

    'every_page' => FALSE,

    'weight' => '9999',

        )

);

?>
<section class="user-sec nopadding">
<div class="container nopadding">
<div class="col-md-12 col-sm-12 col-xs-12 nopadding">
<div class="profilepageblock">
<?php  
$cover_pic = getcoverpic($user->uid);
if(!empty($cover_pic)){
$style = "cover_pic_banner";  
print '<img class="" src="' . image_style_url($style, $cover_pic) . '" alt="" title="" />';

}else{
?></div>
<img src="<?php echo $base_url . '/' . drupal_get_path('theme', $GLOBALS['theme']) ?>/images/user/user-profile.jpg" alt="" title="" />
<?php } ?>
<div class="userprodata">
<div class="userpicimg">
<?php 
if ($userDetails->picture != "") {
$file = file_load($userDetails->picture->fid);
//echo $file->uri;exit;
$imgpath = $file->uri;
$style = "experience_topranked";
print '<img class="img-circle" src="' . image_style_url($style, $imgpath) . '" alt="display pic" title="" />';

} else {
print '<div class="user-name"><img src="' . base_path() . drupal_get_path('theme', $GLOBALS['theme']) . '/images/no-profile-male-img.jpg" class="img-circle" alt="display pic" title="" />';
}
?>  
</div> <!--End UserPicImg -->
 <!-- End UserProData -->
<h3><?php echo $userDetails->field_first_name['und'][0]['value'];  ?></h3></div>
<div class="mask"></div>
</div> <!-- End ProfilePagePlock -->

</div> <!-- End Col -->
</div> <!-- End Container -->
</section>

 <section class="myrequest">

            <div class="dr-wrapper">
            <h1>MY REQUEST</h1>
            </div>
 </section>           
  
<?php

if (!empty($requestList)) {
      
   //echo "<pre>";print_r($requestList);die;
    foreach ($requestList as $request) {
        
        //$travellers = unserialize($request['travellers']);
        
        $advisior_data = user_load($request['advisor_uid']);

        $file = file_load($advisior_data->picture->fid);
        
        $imgpath = $file->uri;

        $style = "homepage_header";

        $src = image_style_url($style,$imgpath);
       
        $noPic = $base_url . '/' . drupal_get_path('theme', 'gloobers') . "/images/no-profile-male-img.jpg";

        $src = ($src) ? $src : $noPic;
       
        //GET Mutual Passion

        //$mutualStore = getMutualPassion($request['advisor_uid']);

        ?>

        <section class="myrequest">

            <div class="dr-wrapper">
                
              <div class="myrequestlist">

                    <div class="table-responsive" id="element_<?php echo $request['rid']; ?>">

                        <table class="table">

                            <thead>

                                <tr>

                                    <th></th>

                                    <th>Destination</th>

                                    <th>TRIP</th>

                                    <th>Type of Recommendation</th>

                                    <th>Date</th>

                                    <th>Travelers</th>

                                    <th>Status</th>

                                </tr>

                            </thead>

                            <tbody>

                                <tr>

                                    <td>

                                        <img class="img-circle size-img" src="<?php echo $src; ?>" onerror="this.onerror=null;this.src='<?php echo $noPic; ?>'" alt="image">

                                        <label><?php $data =user_load($request['advisor_uid']); 
                                                    echo $data->field_first_name['und'][0]['value'];    
                                                ?>
                                        </label>
                                                  
                                    </td>

                                    <td><?php echo $request['destination']; ?></td>

                                    <td ><?php echo ucfirst($request['trip_type']); ?></td>

                                    <td><?php echo ucfirst($request['listing_type']); ?></td>

                                    <td><?php 
                                    if($request['from_date'] || $request['to_date']){
                                    $from_date=date_create($request['from_date']);
                                    $to_date = date_create($request['to_date']);
                                    echo date_format($from_date,"M d").', '.date_format($from_date,'Y');
                                    } else {
                                        echo "No date available";
                                    }
                                  

                                  ?></td>

                                   <!-- <td>Adults :<?php ///echo $travellers['adult']; ?><br> Childs:<?php //echo $travellers['child']; ?> </td> -->
                                   <td><?php  echo $request['travellers']; ?></td>
                                    <?php if ($request['status'] == 1) { ?>

                                        <td class="green"><?php echo 'OPEN'; ?></td>

                                    <?php } else if ($request['status'] == 0) { ?>

                                        <td class="red"><?php echo 'CLOSE'; ?></td>

                                    <?php } else { ?>

                                        <td class="red"><?php echo 'DECLINE'; ?></td>

                                    <?php } ?>



                                </tr>

                            </tbody>

                        </table>

                    </div>

                </div>
                   <?php if ($request['status'] != 2) { ?>
                  <a href="<?php echo $base_url; ?>/advice/recommend/<?php echo base64_encode($request['advisor_uid']); ?>/<?php echo base64_encode($request['traveller_uid']); ?>/<?php echo base64_encode($request['rid']);?>" class="viewbtn">View recommendation</a>
                  <?php  } ?>
            </div>

        </section>



        <!--LISTING AND TRAVEL GUIDE SECTION-->



        <?php

        //$guideList = getListTrevelGuide($request['rid']);

        ///if (!empty($guideList)) {

           // $guideListDOM = theme('travel_guide_list', array('tGuideList' => $guideList, 'editable' => 'FALSE'));

           // echo $guideListDOM;

        //}

    }

}else{
    echo "<div class='no-results'>";
    echo "<p>No results found</p>";
    echo "</div>";
}

?>





<!--MODAL FOR MESSAGE AND SEND REQUEST TO SELECTED ADVISOR-->

<div id="modal_advisor_request" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <form id="advisor_request_form">  

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                    <h4 class="modal-title" id="exampleModalLabel">Decline Request</h4>

                </div>

                <div class="modal-body">

                    <div class="form-group">

                        <label for="recipient-name" class="control-label">Recipient:</label>

                        <input type="text" class="form-control" id="recipient-name" readonly="readonly" name="recipient-name">

                    </div>

                    <div class="form-group">

                        <label for="message-text" class="control-label">Message:</label>

                        <textarea class="form-control" id="message-text" required="required" name="message"></textarea>

                        <input type="hidden" name="requestID" id="requestID">

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    <input type="submit" class="btn btn-primary" value="Send message" data-loading-text="Sending...">

                </div>

            </form>

        </div>

    </div>

</div>

<!--END OF MODAL-->





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



$styleMenu = $base_url . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/js/stylemenu.js';

drupal_add_js($styleMenu, array(

    'type' => 'external',

    'scope' => 'footer',

    'group' => JS_THEME,

    'every_page' => FALSE,

    'weight' => -1,

));

?>