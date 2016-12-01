<?php
global $base_url,$user;
$commisson=getCommisionByuserForBooking("",$user->uid);	
	if($commisson['commission']!="")
		{
		$comm=$commisson['commission'];
		}
		else if(variable_get('commission')!="")
		{
		$comm=variable_get('commission');
		}
		else
		{
		$comm="0.0";
		}
	$totalProfit=getTotalAmountEarnedByUser($user->uid);
	$totalRefundAmout=($totalProfit['refund_total']+$totalProfit['trans_fees_total']);
   $profit=$totalProfit['grand_profit']-$refundAmout;
?>
<div class="dm-dashboard-wrapper">
<h2>My Wallet</h2>
<div class="row">
              <div class="col-xs-6 col-md-3">
                <div class="console-btn">
                  <div class="console-icon divider-right"> <span class="glyphicons glyphicons-user_add"></span> </div>
                  <div class="console-text">
                    <div class="console-title">Total Income</div>
                    <div class="console-subtitle"><?php $profit=((100-$comm)*$profit)/100;echo " $".sprintf("%.2f",$profit);?></div>
                  </div>
                </div>
              </div>
              <div class="col-xs-6 col-md-3">
                <div class="console-btn">
                  <div class="console-icon divider-right"> <span class="glyphicons glyphicons glyphicons-shopping_cart"></span> </div>
                  <div class="console-text">
                    <div class="console-title">Total Refund</div>
                    <div class="console-subtitle"><?php echo " $".sprintf("%.2f",$totalRefundAmout);?></div>
                  </div>
                </div>
              </div>
              <div class="col-xs-6 col-md-3">
               <a href="<?php echo url('income/details');?>" title="View all your deals income details"> <div class="console-btn">
                  <div class="console-icon divider-right"> <span class="glyphicons glyphicons-credit_card"></span> </div>
                  <div class="console-text">
                    <div class="console-title">Total Commission</div>
                    <div class="console-subtitle"><?php $profit=($comm*$profit)/100;echo " $".sprintf("%.2f",$profit);?></div>
                  </div>
                </div></a>
              </div>
              
              
            </div>



<?php 

print'<div class="search-list-booking">';
echo drupal_render($searchForm);
print '</div>';
?>
<div><h3><?php print $bookingsCount." "."Results Found";?></h3></div>
<?php
if(count($bookings)>0)
{
?>
     <div class="main-box-body clearfix">
              <div class="table-responsive clearfix">
                <table class="table table-hover">
                  <thead>
                    <tr>
					<th>Sr.no</th>
                      <th><span>Deal Title</span></th>
                      <th class="text-center"><a class="desc" href="#"><span>Customer name</span></a></th>
					    <th class="text-center"><span>Amount</span></th>
                      <th class="text-center"><a class="asc" href="#"><span>TransactionId</span></a></th>
                      <th class="text-center"><span>BookingId</span></th>
                      <th class="text-center"><span>Payment Status</span></th>
                      <th class="text-center">Transaction On</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php
				   if(isset($_GET['page']))
				  {
				  $pageno=$_GET['page'];
				  $noOfRecords=10;
				  $i=$noOfRecords*$pageno+1;
				  }
				  else
				  {
				  $i=1;
				  }
				  foreach($bookings as $booking)
				  {
				 
				  if($booking['first_name'])
				  {
				  $name=ucwords($booking['first_name']." ".$booking['last_name']);
				  }
				  else
				  {
				  $name=ucwords($booking['name']);
				  }
				     
				   switch($booking['payment_status'])
                     {
					 case "pending":		
			           $bookingClass='label-info';
		              break;
					  case "completed":		
			           $bookingClass='label-success';
		              break;
					  case "cancelled":		
			           $bookingClass='label-warning';
		              break;
					  case "refunded":		
			           $bookingClass='label-info';
		              break;
					  
					  default:
					   $bookingClass="";
					   break;
					 } 
				  ?>
                    <tr>
					<td><?php echo $i;?></td>
                      <td><a href="<?php echo url('experience/view/'.$booking['lid']);?>"><?php echo ucfirst($booking['title']);?></a></td>
                      <td class="text-center"><?php echo $name;?> </td>
					  <td class="text-center"><?php echo ($booking['amount'])?"$".$booking['amount']:"$0";?> </td>
                      <td class="text-center"><?php echo $booking['trans_id'];?></td>
                      <td class="text-center"><?php echo $booking['booking_id'];?></td>
                      <td class="text-center"> <span class="label <?php echo $bookingClass;?>"> <?php echo ucfirst($booking['payment_status']);?></span></td>
                        <td class="text-center"><?php echo date("d F Y H:i:s",strtotime($booking['payment_at']));?></td>
                    </tr>
                 <?php
				 $i++;
                 }
                 ?>				 
                  </tbody>
                </table>
              </div>
            </div>
<?php
}
else
{

?>
<div class="no-results"><p>No Transactions Details Found</p></div>
<?php
}
?>
</div>