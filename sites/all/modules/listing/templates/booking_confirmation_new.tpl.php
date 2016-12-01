<?php
global $base_url;
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/stylesheet/for-head-foot.css','file');
drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/gloobers.css','file');
//drupal_add_css(drupal_get_path('theme', 'gloobers_new') .'/css/landing_custom.css','file');
$userDetails=user_load($OverviewData['uid']);

// if($rulesDetail['security_options'] == 'booking_%'){
//     $security = '%';
// }else{
//     $security = '$';
// }

$bookIngId=arg(2);

$address = unserialize($bookingData['address_field']);

    if(!empty($rulesDetail['cancellation_policies_type'])){
    
            switch ($rulesDetail['cancellation_policies_type']){
                case "Relaxed":
                    $decriptionofpolicy=t('Guests will receive a full refund if they cancel at least two weeks before the start of their reservation.');
                break;
                case "Flexible":
                    $decriptionofpolicy=t('Guests will receive their full refundable deposit :').'<p>'.t('A 50% refund of their paid rental costs if they cancel at least four weeks before the start of their reservation. OR').'</p><p>'.t('A 25% refund of their paid rental costs if they cancel up to two weeks before the start of their reservation.').'</p>';
                break;
                case "Moderate":
                    $decriptionofpolicy=t('Guests will receive their full refundable deposit.<p> A 50% refund of their paid rental costs, if they cancel at least four weeks before the start of their reservation.').'</p>';
                    break;
                case "Strict":
                    $decriptionofpolicy=t('Guests will receive their full refundable deposit :').'<p>'.t('A 50% refund of their paid rental costs if they cancel at least eight weeks before the start of their reservation OR').'</p><p>'.t('A 25% refund of their paid rental costs if they cancel up to four weeks before the start of their reservation.').'</p>';
                    break;
                case "Super-Strict":
                    $decriptionofpolicy=t('If the guest cancels, any money they have paid cannot be refunded.');
                    break;
                case "Custom":
                    $decriptionofpolicy=t('Guests will receive their full refundable deposit:').'<p>'.t($rulesDetail['amount_week'].'% refund of their paid rental costs if they cancel at least '.$rulesDetail['amount_week_rental']." ".$rulesDetail['amount_week_select']. ' prior to reservation. OR').'</p><p>'.t($rulesDetail['amount_day'].'% refund of their paid rental costs if they cancel at least '.$rulesDetail['amount_day_rental']." ".$rulesDetail['amount_day_select'].'  prior to reservation').'</p>';
                default:
                $decriptionofpolicy= t('No Cancellation policy.');
            }
    }else{
    
        $decriptionofpolicy=t('No Cancellation policy.');
    
    }
    
    
?>



<script type="text/javascript">

function printconfirmation() 
{
    var divToPrint = document.getElementById("ele11");
           var popupWin = window.open('', '_blank', 'width=300,height=300');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
    //window.print();
     var mywindow = window.open('', 'my div', 'height=400,width=600');
      mywindow.close();
    
   /* jQuery(mywindow.document.head).html( '<title>PressReleases</title><link rel="stylesheet" href="css/main.css" type="text/css" />'); 
    jQuery(mywindow.document.body).html( '<body>' + data.innerHTML + '</body>'); 
    
    mywindow.document.close();
    mywindow.focus(); // necessary for IE >= 10
    mywindow.print();
    mywindow.close();

    return true;*/
 
 }

</script>
<div class="min-wrapper"><?php print $messages; ?>
  <section class="confirm-sec">
    <div class="col-lg-12">
      <h1>Reservation Confirmed</h1>      <?php if(isset($_SESSION['payment_message'])){ echo '<h1 class="payment_message">'.$_SESSION['payment_message'].'</h1>';}?>
      <div class="reserv">
        <p></p>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-6 info">
        <a class="print-link no-print" href="#" onclick="printconfirmation();">Print This Confirmation</a>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-6 info"><a href="<?php echo $base_url; ?>/booking/mailsendtoprovider/<?php echo $bookIngId; ?>">Send Via Email</a></div>
    </div>
    <?php
        $photo  = unserialize($photos[0]["value1"]);
        $file   = file_load($photo["fid"]);
        $imgpath = $file->uri;
        $style='summary_img_style';
    ?>
    <div id="ele1" class="printdiv">
    <div class="col-lg-12 confirmimg"> <img src="<?php print image_style_url($style,$imgpath);?>" alt=" "> </div>
    <div class="col-lg-12 tourinfo">
      <div class="col-lg-12 statusbar">
        <div class="col-md-12">
          <p><span><?php echo  $bookingData['title']; ?></span></p>
        </div>
      </div>
      <div class="col-lg-12 statusbar bgcolor">
        <div class="col-xs-12 col-sm-3 col-md-3">
          <p class="leftalign"><span>Date</span></p>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
          <p><?php echo  $bookingData['arrive_at_date'].' '.$bookingData['arrive_at_time'];?></p>
        </div>
      </div>
      <div class="col-lg-12 statusbar">
        <div class="col-xs-12 col-sm-3 col-md-3">
        <?php
        $Travelers_title ="Items";
        $quantity_details=unserialize($bookingData['quantity_details']);
        if (array_key_exists('Adult', $quantity_details) || array_key_exists('Child', $quantity_details)) {
        $Travelers_title ="Travelers";
        }
        ?>
          <p class="leftalign"><span><?php echo $Travelers_title; ?></span></p>
        </div>
        <div class="col-md-12  col-sm-6 col-md-6">
            <p><?php if($Travelers_title =="Travelers"){echo $bookingData['quantity'].'x<i class="fa fa-user"></i>'; } ?> 
                (
                <?php
                    $bookingData['quantity_details']=unserialize($bookingData['quantity_details']);
                    $sizepersontype=sizeof($bookingData['quantity_details']);
                    $i=1;
                    foreach($bookingData['quantity_details'] as $qtytype=>$qtyval){
                        if($sizepersontype==$i){$comma=' ';}else{$comma=' , ';}
                        echo $qtyval['qty'].' '.ucfirst($qtytype).$comma;
                        $i++;
                    }
                ?>
                )
            </p>
        </div>
      </div>
       <div class="col-lg-12 statusbar bgcolor">
        <div class="col-xs-12 col-sm-3 col-md-3">
          <p class="leftalign"><span>Booking Id</span></p>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
          <p class="title"><?php echo $bookingData['booking_id']; ?></p>
        </div>
      </div>
      <div class="col-lg-12 statusbar bgcolor">
        <div class="col-xs-12 col-sm-3 col-md-3">
          <p class="leftalign"><span>Location</span></p>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
          <p class="title"><?php echo $exp_addres; ?></p>
        </div>
      </div>
      <div class="col-lg-12 statusbar">
        <div class="col-xs-12 col-sm-3 col-md-3">
          <p class="leftalign"><span>Additional Services</span></p>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <p>
                <?php $additional_services=unserialize($bookingData['additional_services']); 
                       $sizeadditional=sizeof($additional_services);
                        $i=1;
                        if(!empty($additional_services)){
                            foreach($additional_services as $additional_service){
                                
                                if($sizeadditional==$i){$comma='.';}else{$comma=',';}
                                echo ucfirst($additional_service['title']).$comma;
                                $i++;
                            }
                        }else{
                            echo "N/A";
                        }
                ?>
            </p>
        </div>
      </div>
      <div class="col-lg-12 statusbar bgcolor">
        <div class="col-xs-12 col-sm-3 col-md-3">
          <p class="leftalign"><span>Operator</span></p>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
          <p><?php 
          //echo "<pre>";Print_r($operatordetail);exit;
          //echo $operatordetail->field_first_name['und'][0]['value'];exit;
          if(!empty($operatordetail->field_first_name) && !empty($operatordetail->field_last_name)){
                echo $operatordetail->field_first_name['und'][0]['value'].' '.$operatordetail->field_last_name['und'][0]['value'].'  ';
          }else{
                echo $operatordetail->name.'  '; 
          }
          echo $operatordetail->field_phone_number['und'][0]['value'].' - '.$operatordetail->mail;
          ?> </p>
        </div>
      </div>
      <div class="col-lg-12 statusbar">
        <div class="col-xs-12 col-sm-3 col-md-3">
          <p class="leftalign"><span>Cancellation Policy</span></p>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
          <p><?php  echo ($rulesDetail['cancellation_policies_type'])?$rulesDetail['cancellation_policies_type']:'No Policy'; ?></p>
        </div>
      </div>
      <div class="col-lg-12 statusbar bgcolor">
        <div class="col-xs-12 col-sm-3 col-md-3">
          <p class="leftalign"><span>Deposit</span></p>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
          <p><?php  if($rulesDetail['security_options'] != 'booking_%'){ echo '$';}?><?php if(empty($bookingData['security'])){echo " 0";}else{echo $bookingData['security']; } ?><?php  if($rulesDetail['security_options'] == 'booking_%'){ echo '%'; }?></p>
        </div>
      </div>
      <div class="col-lg-12 statusbar">
        <div class="col-xs-12 col-sm-3 col-md-3">
          <p class="leftalign"><span>Total Amount</span></p>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
          <p><span>$<?php if(empty($bookingData['grand_total'])){echo "0";} else{ echo $bookingData['grand_total'];} ?></span></p>
        </div>
      </div>
    </div>
    </div>
  </section>
</div>

<div style="display:none">
<div class="min-wrapper" style="width:80%; margin:auto;"><?php print $messages; ?>
  <section class="confirm-sec">
    <div class="col-lg-12">
      <h1>Reservation Confirmed</h1>      <?php if(isset($_SESSION['payment_message'])){ echo '<h1 class="payment_message">'.$_SESSION['payment_message'].'</h1>';}?>
      <div class="reserv">
        <p></p>
      </div>     
      <div class="col-xs-12 col-sm-6 col-md-6 info"><a href="<?php echo $base_url; ?>/booking/mailsendtoprovider/<?php echo $bookIngId; ?>">Send Via Email</a></div>
    </div>
    <?php
        $photo  = unserialize($photos[0]["value1"]);
        $file   = file_load($photo["fid"]);
        $imgpath = $file->uri;
        $style='summary_img_style';
    ?>
    <div id="ele11" class="printdiv" style="width:100% !important; float:left !important; margin:50px 0 0 0 !important;  padding:10px 0 !important;">
    <div class="col-lg-12 confirmimg" style="float:left; width:100%;"> <img style="width:100%; float:left !important;" src="<?php print image_style_url($style,$imgpath);?>" alt=" "> </div>
    <div class="col-lg-12 tourinfo" style="float:left; width:100% !important;">
      <div class="col-lg-12 statusbar" style="float:left !important; width:100% !important; border:1px solid #7e8075 !important; min-height:40px; padding:10px 0 !important;">
        <div class="col-md-12">
          <p style="font-size:18px !important; color:#424242 !important; text-align:center !important;"><span><?php echo  $bookingData['title']; ?></span></p>
        </div>
      </div>
      <div class="col-lg-12 statusbar bgcolor" style="float:left !important; width:100% !important; border:1px solid #7e8075 !important; min-height:40px; padding:10px 0 !important;">
        <div class="col-xs-12 col-sm-3 col-md-3" style="width:25%; float:left; padding-left:15px; padding-right:15px;box-sizing:border-box;">
          <p class="leftalign" style="text-align:left !important; font-weight:500; font-size:18px; font-family:arial; margin:0;"><span>Date</span></p>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6" style="width:50%;float:left;padding-left:15px; padding-right:15px;box-sizing:border-box; ">
          <p style=" color:#424242 !important;margin:0; text-align:center !important; font-family:arial; font-weight:500;"><?php echo  $bookingData['arrive_at_date'].' '.$bookingData['arrive_at_time'];?></p>
        </div>
      </div>
      <div class="col-lg-12 statusbar" style="float:left !important; width:100% !important; border:1px solid #7e8075 !important; min-height:35px; padding:10px 0 !important;">
        <div class="col-xs-12 col-sm-3 col-md-3" style="width:25%; float:left; padding-left:15px; padding-right:15px;box-sizing:border-box;">
          <p class="leftalign" style="text-align:left !important;margin:0;font-weight:500; font-size:18px; font-family:arial;"><span>Travellers</span></p>
        </div>
        <div class="col-md-12  col-sm-6 col-md-6" style="float:left !important;width:50%;float:left;padding-left:15px; padding-right:15px;box-sizing:border-box; font-family:arial;">
            <p style="margin:0;text-align:center;font-weight:500;"><?php echo $bookingData['quantity']; ?> x <i class="fa fa-user"></i>
                (
                <?php
                    $bookingData['quantity_details']=unserialize($bookingData['quantity_details']);
                    $sizepersontype=sizeof($bookingData['quantity_details']);
                    $i=1;
                    foreach($bookingData['quantity_details'] as $qtytype=>$qtyval){
                        if($sizepersontype==$i){$comma=' ';}else{$comma=' , ';}
                        echo $qtyval['qty'].' '.ucfirst($qtytype).$comma;
                        $i++;
                    }
                ?>
                )
            </p>
        </div>
      </div>
       <div class="col-lg-12 statusbar bgcolor" style="float:left !important; width:100% !important; border:1px solid #7e8075 !important; min-height:35px; padding:10px 0 !important;">
        <div class="col-xs-12 col-sm-3 col-md-3" style="width:25%; float:left; padding-left:15px; padding-right:15px;box-sizing:border-box;">
          <p class="leftalign" style="text-align:left !important;margin:0; font-weight:500; font-size:18px; font-family:arial; "><span>Booking Id</span></p>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6"  style="width:50%;float:left;padding-left:15px; padding-right:15px;box-sizing:border-box; ">
          <p class="title" style="font-size:18px !important;margin:0;font-weight:500;  text-align:center !important; font-family:arial;color:#51b8d7;"><?php echo $bookingData['booking_id']; ?></p>
        </div>
      </div>
      <div class="col-lg-12 statusbar bgcolor" style="float:left !important; width:100% !important; border:1px solid #7e8075 !important; min-height:35px; padding:10px 0 !important;">
        <div class="col-xs-12 col-sm-3 col-md-3" style="width:25%; float:left; padding-left:15px; padding-right:15px;box-sizing:border-box;">
          <p class="leftalign" style="text-align:left !important;margin:0; font-weight:500; font-size:18px; font-family:arial; "><span>Location</span></p>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6"  style="width:50%;float:left;padding-left:15px; padding-right:15px;box-sizing:border-box; ">
          <p class="title" style="font-size:18px !important;font-weight:500; margin:0; text-align:center !important; font-family:arial;color:#51b8d7;"><?php echo $exp_addres; ?></p>
        </div>
      </div>
      <div class="col-lg-12 statusbar" style="float:left !important; width:100% !important; border:1px solid #7e8075 !important; min-height:35px; padding:10px 0 !important;">
        <div class="col-xs-12 col-sm-3 col-md-3"style="width:25%; float:left; padding-left:15px; padding-right:15px;box-sizing:border-box; font-family:arial;
        ">
          <p class="leftalign" style="font-weight:500;margin:0; font-size:18px; font-family:arial;"><span>Additional Services</span></p>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6"  style="width:50%;float:left;padding-left:15px; padding-right:15px;box-sizing:border-box; font-family:arial; ">
            <p style="margin:0;text-align:center;font-weight:500;">
                <?php $additional_services=unserialize($bookingData['additional_services']); 
                       $sizeadditional=sizeof($additional_services);
                        $i=1;
                        if(!empty($additional_services)){
                            foreach($additional_services as $additional_service){
                                
                                if($sizeadditional==$i){$comma='.';}else{$comma=',';}
                                echo ucfirst($additional_service['title']).$comma;
                                $i++;
                            }
                        }else{
                            echo "N/A";
                        }
                ?>
            </p>
        </div>
      </div>
      <div class="col-lg-12 statusbar bgcolor" style="float:left !important; width:100% !important; border:1px solid #7e8075 !important; min-height:35px; padding:10px 0 !important;">
        <div class="col-xs-12 col-sm-3 col-md-3" style="width:25%; float:left; padding-left:15px; padding-right:15px;box-sizing:border-box;">
          <p class="leftalign" style="text-align:left !important;margin:0; font-weight:500; font-size:18px; font-family:arial;"><span>Operator</span></p>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6"  style="width:50%;float:left;padding-left:15px; padding-right:15px;box-sizing:border-box;  font-family:arial;">
          <p style="margin:0;text-align:center;font-weight:500;"><?php 
          //echo "<pre>";Print_r($operatordetail);exit;
          //echo $operatordetail->field_first_name['und'][0]['value'];exit;
          if(!empty($operatordetail->field_first_name) && !empty($operatordetail->field_last_name)){
                echo $operatordetail->field_first_name['und'][0]['value'].' '.$operatordetail->field_last_name['und'][0]['value'].'  ';
          }else{
                echo $operatordetail->name.'  '; 
          }
          echo $operatordetail->field_phone_number['und'][0]['value'].' - '.$operatordetail->mail;
          ?> </p>
        </div>
      </div>
      <div class="col-lg-12 statusbar" style="float:left !important; width:100% !important; border:1px solid #7e8075 !important; min-height:35px; padding:10px 0 !important;">
        <div class="col-xs-12 col-sm-3 col-md-3" style="width:25%; float:left; padding-left:15px; padding-right:15px;box-sizing:border-box;">
          <p class="leftalign" style="text-align:left !important;margin:0; font-weight:500; font-size:18px; font-family:arial;"><span>Cancellation Policy</span></p>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6"  style="width:50%;float:left;padding-left:15px; padding-right:15px;box-sizing:border-box; font-family:arial; ">
          <p style="margin:0;text-align:center;font-weight:500;"><?php  echo ($rulesDetail['cancellation_policies_type'])?$rulesDetail['cancellation_policies_type']:'No Policy'; ?></p>
        </div>
      </div>
      <div class="col-lg-12 statusbar bgcolor" style="float:left !important; width:100% !important; border:1px solid #7e8075 !important; min-height:35px; padding:10px 0 !important;">
        <div class="col-xs-12 col-sm-3 col-md-3" style="width:25%; float:left; padding-left:15px; padding-right:15px;box-sizing:border-box;">
          <p class="leftalign" style="text-align:left !important;margin:0;font-weight:500; font-size:18px; font-family:arial;"><span>Deposit</span></p>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6"  style="width:50%;float:left;padding-left:15px; padding-right:15px;box-sizing:border-box; ">
          <p style="margin:0;font-weight:500; color:#424242 !important; text-align:center !important; font-family:arial;"><?php  if($rulesDetail['security_options'] != 'booking_%'){ echo '$';}?><?php if(empty($bookingData['security'])){echo " 0";}else{echo $bookingData['security']; } ?><?php  if($rulesDetail['security_options'] == 'booking_%'){ echo '%'; }?></p>
        </div>
      </div>
      <div class="col-lg-12 statusbar" style="float:left !important; width:100% !important; border:1px solid #7e8075 !important; min-height:35px; padding:10px 0 !important;">
        <div class="col-xs-12 col-sm-3 col-md-3" style="width:25%; float:left; padding-left:15px; padding-right:15px;box-sizing:border-box;">
          <p class="leftalign" style="text-align:left !important;margin:0;font-weight:500; font-size:18px; font-family:arial;"><span>Total Amount</span></p>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6"  style="width:50%;float:left;padding-left:15px; padding-right:15px;box-sizing:border-box; font-family:arial; ">
          <p style="margin:0;text-align:center;font-weight:500;"><span>$<?php if(empty($bookingData['grand_total'])){echo "0";} else{ echo $bookingData['grand_total'];} ?></span></p>
        </div>
      </div>
    </div>
    </div>
  </section>
</div>
</div>
<div class="modal fade" id="recommend" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="padding-right:0px !important;">
  <div class="modal-dialog recommend">
    <div class="recommend2">
      <div class="modal-content loginpop">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="exampleModalLabel">New message</h4>
          <p>You Are About To Recommend This Listing To A friend. You Will Be Notified As Soon As Your Friend Follows Your
            Recommendation And Rewarded After He Reviewed His Trip.</p>
        </div>
        <div class="modal-body">
          <div class="tabbable">
            <ul class="nav nav-tabs">
              <li><a href="#tab1" data-toggle="tab">Share A Link</a></li>
              <li class="active"><a href="#tab2" data-toggle="tab">Add To</a></li>
              <li><a href="#tab3" data-toggle="tab">Embed</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab1">
                <form>
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">A Travel Guide</label>
                    <input type="text" class="form-control" id="recipient-name">
                  </div>
                  <div class="form-group">
                    <label for="message-text" class="control-label">Add Your Comment</label>
                    <textarea class="form-control" id="message-text">Why do you recommend this listing?</textarea>
                  </div>
                </form>
                    <div class="modal-footer">
                  <button type="submit" class="btn btn-default btncncl" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary btnsend">Send</button>
                </div>
              </div>
              <div class="tab-pane active" id="tab2">
                <form>
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">A Travel Guide</label>
                    <input type="text" class="form-control" id="recipient-name">
                  </div>
                </form>
              </div>
              <div class="tab-pane active" id="tab3">
                <form>
                  <div class="form-group">
                    <label for="message-text" class="control-label">Add Your Comment</label>
                    <textarea class="form-control" id="message-text">Why do you recommend this listing?</textarea>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$('.first.circle').circleProgress({
    value: 0.98,
    //animation: false,
    fill: { color: '#00aeef' }
});
$('.second.circle').circleProgress({
    startAngle: -Math.PI / 4 * 3,
    value: 0.73,
    fill: { color: '#00aeef' }
});

$('.third.circle').circleProgress({
    startAngle: -Math.PI / 4 * 3,
    value: 0.73,
    fill: { color: '#00aeef' }
});

$('.forth.circle').circleProgress({
    startAngle: -Math.PI / 4 * 3,
    value: 0.67,
    fill: { color: '#00aeef' }
});

jQuery(document).ready(function () {
jQuery('nav').meanmenu();
});
var jq=jQuery.noConflict();

//Start of Script for Sticky header
jq(window).scroll(function() {
if (jq(this).scrollTop() > 1){  
jq('header').addClass("sticky");
}
else{
jq('header').removeClass("sticky");
}
});


jq(document).ready(function(){  

/************** for filter toggle **************/       

jq(".filterbutton").click(function(){
jq(".formsec").slideToggle("slow");
}); 


jq(".notifi").click(function(){
jq(".ndropmenu").slideToggle("slow");
}); 

jq(".admin-sec").click(function(){
jq(".nadminmenu").slideToggle("slow");
}); 


/************** for filter toggle **************/       

jq(".clickarrow").click(function(){
jq(".checksec").slideToggle("slow");
}); 


/************** for options toggle **************/

jq(".listicon").click(function(event){
 event.preventDefault();
 jq(this).parent().parent().find(".listview").slideToggle("slow");
 
});


jq('#recommend').on('show.bs.modal', function (event) {
  var button = jq(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  var modal = jq(this)
  modal.find('.modal-title').text('Recommend << Big Five Safari >> To A Friend' + recipient)
  //modal.find('.modal-body input').val(recipient)
})

jq(function () {
                jq('#datetimepicker1').datetimepicker({
                    pickTime: false
                });
            });

/**************************For experience detail page *********Price div*************/
width = jq(window).width();
if(width>1025)
{
    jq(window).scroll(function() {
    var scroll = jq(window).scrollTop();

    if (scroll >= 300 && scroll < 500) {
        jq(".booking-sec").addClass("darkHeader");
    }
    else if (scroll >= 500 || scroll < 300) {
        
        jq(".booking-sec").removeClass("darkHeader");
    }
    
});
}jQuery('.payment_message').fadeOut(10000);
});
</script>