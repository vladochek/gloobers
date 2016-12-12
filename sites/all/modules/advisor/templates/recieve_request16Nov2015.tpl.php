<?php

global $base_url,$user;
//$locationDetail = getListingData(94);
//echo "<pre>";print_r($locationDetail); die;
$trevelGuideList=getListTrevelGuide();
//echo "<pre>";print_r($trevelGuideList);die;
drupal_add_css(drupal_get_path('theme', 'gloobers') . '/css/flexslider.css', 'file');
drupal_add_js(drupal_get_path('theme', 'gloobers') . '/js/jquery.flexslider.js', 'file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/landing_page.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/gloobers.css','file');

drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/stylesheet/for-head-foot.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/landing_custom.css','file');
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


<section class="experiences">



</section>



<section class="requestrecive">

    <div class="dr-wrapper">

        <div class="recived">

            <h1>What is it ?</h1>

            <p><< Request received >> Are the recommendations request you received via the Gloobers

                finder.  Create your friends tailormade trips and earn points for the helping hand.</p>

        </div>

    </div>

</section>



<?php

//echo "<pre>";Print_r($requestList);exit;
$requestlist = array_reverse($requestList);
//echo "<pre>";Print_r($requestlist);exit;

if (!empty($requestlist)) {

    foreach ($requestlist as $request) {

        
        $traveller = unserialize($request['travellers']);
        
        
        $file = file_load($request['picture']);

        $imgpath = $file->uri;

        $style = "experience_topranked";

        $src = image_style_url($style,$imgpath);
       // $edit_recommendation = edit_my_recommendation();
       

        $noPic = $base_url . '/' . drupal_get_path('theme', 'gloobers') . "/images/no-profile-male-img.jpg";

        $src = ($src) ? $src : $noPic;
        // if(!empty($src)){
        //     $img_src = $src;
        // }else{
        //     $img_src = $noPic;
        // }


        //GET Mutual Passion

        $mutualStore = getMutualPassion($request['uid']);

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

                                    <td rowspan="2">
                                   
                                         
                                        <img class="user-picture-advisor-pic" src="<?php print $src; ?>" onerror="this.onerror=null;this.src='<?php echo $noPic; ?>'" alt="image">
                                       
                                     
                                        <label><?php echo ucfirst($request['first_name'] .' '.$request['last_name']); ?></label>

                                    </td>

                                    <td><?php echo $request['destination']; ?></td>

                                    <td ><?php echo ucfirst($request['trip_type']); ?></td>

                                    <td><?php echo ucfirst($request['listing_type']); ?></td>

                                    <td><?php 
                                    if(empty($request['from_date']) && empty($request['to_date'])){
                                        echo "N.A";
                                    }else{
                                    echo date("M d", strtotime($request['from_date'])) . '-' . date("M d", strtotime($request['to_date'])) . ' ' . date("Y", strtotime($request['to_date'])); } ?></td>

                                    <!-- <td>Adults:<?php //echo $traveller['adult']; ?><br>Childs:<?php //echo $traveller['child']; ?></td> -->
                                    <td><?= !empty($request['travellers']) ? $request['travellers'] : 'N.A'; ?> </td>
                                    <?php if ($request['status'] == 1) { ?>

                                        <td class="green"><?php echo 'OPEN'; ?></td>

                                    <?php } else if ($request['status'] == 0) { ?>

                                        <td class="red"><?php echo 'CLOSE'; ?></td>

                                    <?php } else { ?>

                                        <td class="red"><?php echo 'DECLINE'; ?></td>

                                    <?php } ?>



                                </tr>

                                <tr>

        

                                    <td colspan="4"><div class="req_massage">

                                            <h1>Message</h1>

                                            <p><?php echo $request['message']; ?></p>

                                        </div></td>

                                    <td colspan="2"><div class="req_decline">Until <?php echo date("M d h:i", strtotime($request['to_date'])); ?> <br> 

                                            <?php if ($request['status'] == 1) { ?>

                                                    <a href="javascript:void(0)" onclick="decline_request('<?php echo base64_encode($request['rid']); ?>', '<?php echo $request['name']; ?>')">Decline  this request</a> </div></td>
                                                     <input type ="hidden" name="requester_id" id="requester_id" value="<?php echo $request['uid']; ?>">
                                    <?php } ?>

                                </tr>



                                <tr class="edit_recommendation_table">

                                    <td>

                                        <?php if (!empty($mutualStore)){ ?>

                                            <div class="request_social">

                                                <ul>

                                                    <?php
//echo "<pre>";Print_r($mutualStore);exit;
                                                    foreach ($mutualStore as $passion) {

                                                        $imageSrcPassion = $passion['pid'] . '.png';

                                                        ?>

                                                        <li><a href="#"> <img title="<?php echo $passion['passion']; ?>" src="<?php echo $base_url . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/images/passion/<?php echo $imageSrcPassion; ?>"></a> </li>

                                                    <?php } ?>

                                                </ul>

                                            </div>

                                        <?php } ?>

                                    </td>

                                    <?php if ($request['status'] == 1) { ?>

                                        <td colspan="2"><a href="javascript:void(0)" data-traveller-uid="<?php echo $request['traveller_uid'];?>" data-request="<?php echo $request['rid']; ?>" class="edit_by_recommendations">Edit my recommendation <div class="arrow_edit"><img src="<?php echo $base_url . '/' . drupal_get_path('theme', $GLOBALS['theme']) ?>/images/arrow.png" alt="image"></div></a></td>

                                        <td><a href="<?php echo $base_url; ?>/add-listing/<?php  echo $request['destination']; ?>/<?php echo base64_encode($request['uid']);?>/<?php echo base64_encode($request['rid']); ?>">Add a new list </a> </td>

                                        <!-- <td><a href="<?php //echo $base_url . '/advice/travel_guide/' . base64_encode($request['rid']); ?>">Create a new guide</a> </td>
 -->
                                        <!-- <td><a href="javascript:void(0)" onclick="addguide_to_traveller(<?php //echo $request['traveller_uid'];?>,<?php //echo ($request['rid']); ?>);"> Add a new guide</a> </td> -->
    
                                        <td></td>

                                        <td></td>

                                    <?php } ?>

                                </tr>



                            </tbody>

                        </table>

                    </div>



                </div>

            </div>

        </section>

         <section class="recv_list">
    <div class="dr-wrapper">
        <div class="map-search">
            <div class="row">
                <div class="sidebar">
                    <div class="listsection reciverequestclass"id="rocommendation_<?php echo $request['traveller_uid']?>">
                
                
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


        <!--LISTING AND TRAVEL GUIDE SECTION-->



        <?php

        $guideList = getListTrevelGuide($request['rid']);

        // if (!empty($guideList)) {

        //     $guideListDOM = theme('travel_guide_list', array('tGuideList' => $guideList, 'editable' => 'FALSE'));

        //     echo $guideListDOM;

        // }

    }

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

<section class="recv_list">
    <div class="dr-wrapper">
        <div class="map-search">
            <div class="row">
                <div class="sidebar">
                <div class="listsection reciverequestclass">
                
                
                </div>
                     
                    </div>
                </div>
           
            </div>
        </div>
    </div>    
</section>

<!--MODAL FOR ADD LISTING FOR TREVEL GUIDE-->
<div id="modalAddToGide" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
           <!--  <form id="removelisting_to_guide_form"> -->  
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Select Travel Guide</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <select id="_guideName" name="guideName" class="selectbox">
                                <option value =""> Select travel guide </option>                          
                            <?php foreach ($trevelGuideList as $guideList) { ?>
                                <option value="<?php echo $guideList['tgid'] ?>"><?php echo $guideList['title']; ?></option>
                            <?php } ?>
                        </select>
                        <input type="hidden" name="_listingGuideId" id="_listingGuideId">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary addguidetotraveller" value="Add Guide" data-loading-text="Working...">
                </div>
            <!-- </form> -->
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



$styleMenu = $base_url . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/js/stylemenu_main.js';

drupal_add_js($styleMenu, array(

    'type' => 'external',

    'scope' => 'footer',

    'group' => JS_THEME,

    'every_page' => FALSE,

    'weight' => -1,

));

?>
<script>
function edit_recommendation(id,location_req_id){

    jQuery.ajax({
            url: $baseUrl + '/advice/ajax/edit_my_recommendation',
            type: 'post',

            data: {'traveller_id':id,'location_req_id':location_req_id},
             beforeSend: function () {
                    preLoading('show', 'load-screen');
                },

            success: function (result) {
               jQuery("#rocommendation_"+id).html(result);
                preLoading('hide', 'load-screen');
                
                write_your_comment = function (listing_id,recommend_for_uid,location_req_id) {
                 var comment_data =jQuery("#textarea_"+listing_id).val(); 
                 jQuery.ajax({
                         type: 'POST',
                         url: $baseUrl + '/advice/ajax/write_comment',
                         data: {'listing_id':listing_id,'recommend_for_uid':recommend_for_uid,'request_id':location_req_id,'comment_data':comment_data},
                         success : function(result){
                            var res = jQuery.parseJSON(result);
                            if (res.status == 'success') {
                                jQuery.notify(res.message, {globalPosition: 'top center', className: 'success'});
                                }else{
                                jQuery.notify(res.message, {globalPosition: 'top center', className: 'error'});
                                }
                            }
                     });
                

                }


                jQuery(".listicon").click(function(event){
                event.preventDefault();
                jQuery(this).parent().parent().find(".listview").slideToggle("slow");
                Removelisting = function (eid,traveller_id,location_req_id) {
                //jQuery('#listingGuideId').val(eid);
                //jQuery('#_removelisting').modal();
                jQuery.ajax({
                    type: 'POST',
                    url: $baseUrl + '/advice/ajax/removelisting',
                    data: {'traveller_id':traveller_id,'listing_id':eid,'location_req_id':location_req_id},
                    beforeSend: function () {
                    preLoading('show', 'load-screen');
                    },
                    success: function (data) {
                        var res = jQuery.parseJSON(data);
                        preLoading('hide', 'load-screen');
                        if (res.status == 'success') {
                            jQuery.notify(res.message, {globalPosition: 'top center', className: 'success'});
                        }else{
                            jQuery.notify(res.message, {globalPosition: 'top center', className: 'error'});
                        }


                    },
                });   

                
                }
 
                });
            }
        });
}

function addguide_to_traveller(tid,lrid){
    jQuery('#modalAddToGide').modal();
    jQuery(".addguidetotraveller").click(function(event){
    var travel_guide_id =  jQuery( "#_guideName" ).val();
    jQuery.ajax({
                type: 'POST',
                url: $baseUrl + '/advice/ajax/addguide_to_traveller',
                beforeSend: function () {
                    preLoading('show', 'load-screen');
                    },
                data: {'travel_guide_id':travel_guide_id,'traveller_id':tid , 'location_req_id':lrid},
                success: function (data) {
                    var res = jQuery.parseJSON(data);
                    preLoading('hide', 'load-screen');
                    if (res.status == 'success') {
                            jQuery.notify(res.message, {globalPosition: 'top center', className: 'success'});
                        }else{
                            jQuery.notify(res.message, {globalPosition: 'top center', className: 'error'});
                        }
                },
                
            }); 
    });
}
</script>
<script>
/**
* for toggle edit my recommendations 
*/
jQuery(document).ready(function(){

    var click_no =0;
    jQuery(".edit_by_recommendations").click(function(){
    var my = jQuery(this);
    var traveller_id = my.attr("data-traveller-uid");
    var request_id = my.attr("data-request");
        
                if(click_no==1)
                {
                click_no = 0;
                  jQuery("#rocommendation_"+traveller_id ).html('');
                  return false;
                }
                
                
                click_no =1;
       
       
        var reco= edit_recommendation(traveller_id,request_id);
          
            

     });

jQuery("body").on("click",".delete_listing_li",function(){
    var me = jQuery(this);
    var val_listing_id =me.attr("data-listing-id");
    var val_recommend_id =me.attr("data-recommend-id");
    var val_location_id =me.attr("data-location-req-id");

  var response =   Removelisting(val_listing_id,val_recommend_id,val_location_id);
  setTimeout(function(){
    me.parent().parent().parent().parent().parent().parent().remove();
  },6000);
    });

});




    
</script>