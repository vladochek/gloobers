<?php

global $base_url;


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








<section class="col-lg-12 user-sec nopadding banner">
  <div class="dr-wrapper">
   <div class="user-banner">
   <?php  
     $cover_pic = getcoverpic($user->uid);
     if(!empty($cover_pic)){
        $style = "cover_pic_banner";  
        print '<img class="" src="' . image_style_url($style, $cover_pic) . '" alt="">';
                
     }else{
    ?>
    <img src="<?php echo $base_url . '/' . drupal_get_path('theme', $GLOBALS['theme']) ?>/images/user/user-profile.jpg" alt=" ">
    <?php } ?>         

             <?php 
                                if ($userDetails->picture != "") {
                                    $file = file_load($userDetails->picture->fid);
                                    //echo $file->uri;exit;
                                    $imgpath = $file->uri;
                                    $style = "experience_topranked";
                                   print '<div class="user-name"><img class="img-circle size-img" style="width:150px; height:150px; border-radius:80px;" src="' . image_style_url($style, $imgpath) . '" alt="display pic">';
                                  
                                } else {
                                    print '<div class="user-name"><img style="width:150px; height:150px; border-radius:80px;" src="' . base_path() . drupal_get_path('theme', $GLOBALS['theme']) . '/images/no-profile-male-img.jpg" class="img-circle size-img" alt="display pic" />';
                                }
                                ?>

            <!-- <div class="user-name"><img src="<?php //print image_style_url('experience_topranked', $banner_path); ?>" alt=" " onerror="<?php echo $noProfilePic; ?>">
             -->    

                <p><Span><?php echo $userDetails->field_first_name['und'][0]['value'];  ?></Span></p>
            </div>
        </div>
    
  </div>
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

                                    <td><?php echo date("M d", strtotime($request['from_date'])) . '-' . date("M d", strtotime($request['to_date'])) . ' ' . date("Y", strtotime($request['to_date'])); ?></td>

                                   <!-- <td>Adults :<?php //echo $travellers['adult']; ?><br> Childs:<?php //echo $travellers['child']; ?> </td> -->
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
                  
                  <a href="<?php echo $base_url; ?>/advice/recommend/<?php echo base64_encode($request['advisor_uid']); ?>/<?php echo base64_encode($request['traveller_uid']); ?>/<?php echo base64_encode($request['rid']);?>" class="viewbtn">View Recommendation</a>

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
    print '<div class="listing-info"><div class="no-listing"><h4>No Result found</h4></div></div>';
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