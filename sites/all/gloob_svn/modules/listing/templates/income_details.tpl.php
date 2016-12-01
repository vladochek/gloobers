<style>
.dm-listing-wrapper {
    margin: 50px 0;
}
</style>
<?php


?>
<div class="dm-listing-wrapper">
<h2>My Earnings</h2>
<div class="tab-pane active">
                  <table class="table table-striped table-widget table-checklist">
                    <thead>
                      <tr>
                        <th>Sr.no</th>
                        <th>Deal Title</th>
                        <th>Total Amount Paid</th>
                        <th>Commission</th>
                        <th>Gloobers Earned</th>
                        <th>Owner Earned</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
					if(count($listings)>0)
                    {  
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
                    foreach($listings as $listing)	
                   {	
				   
				   $totalProfit=$profit=0;
				   $commisson=getCommisionByuserForBooking($listing['eid']);	
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
								   
                     $totalProfit=getAmountEarnedBydeal($listing['eid']);
					
                      $profit=$totalProfit['grand_profit']-($totalProfit['refund_total']+$totalProfit['trans_fees_total']);					 
					?>
                      <tr>
                       <td><?php echo $i;?></td>
                        <td><a href="<?php echo url('experience/view/'.$listing['eid'])?>"><?php echo ucfirst($listing['title']);?></a></td>
                        <td><?php echo "$".sprintf("%.2f",$profit);?></td>
                        <td><?php echo $comm."%";?></td>
                        <td><?php $siteamount=($comm*$profit)/100;echo "$".sprintf("%.2f",$siteamount);?></td>
                        <td><?php $ownerAmount=((100-$comm)*$profit)/100;echo "$".sprintf("%.2f",$ownerAmount);?></td>
                      </tr>
				 <?php 
				 $i++;
                 }
				 ?>
				   </tbody>
                  </table>
                </div>
				<?php
				 print '<div class="pagination">'.$pagination.'</div>';
				 }
				 else{
				 ?>	
                 <div>No results Found</div>				 
                 <?php
				 }
                  ?>				 
                  
</div>