<?php
global $base_url;
?>
<div class="search-user-form">
<?php echo drupal_render($searchForm);?>
</div>
<div class="main-box-body clearfix">
 <div class="row">
        <div class="col-md-12">
          <div class="panel">
            <div class="panel-heading">
              <div class="panel-title"> <i class="fa fa-table"></i>Users Details And Earnings</div>
            </div>
            <div class="panel-body">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>User Name</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Total Trips Booked</th>
                      <th>Total Listings</th>
                      <th>Commission</th>
                      <th>Total Owner earned</th>
                      <th>Total Gloobers earned</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php
				  if(count($userList)>0)
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
					 					 
					 foreach($userList as $list)
                     {					 
				  $totalBooked=getTotalListBookedByUser($list['uid']);
				  $totalListAdded=getTotalListAddedByuser($list['uid']);
				  $comm=getCommisionByuserForBooking($list['uid']);
						if($comm['commission']!="")
						{
						$commission=$comm['commission'];
						}
						else if(variable_get('commission')!="")
						{
						$commission=variable_get('commission');
						}
						else
						{
						$commission="0.0";
						}
					$totalProfit=getTotalAmountEarnedByUser($list['uid']);
                    $profit=$totalProfit['grand_profit']-($totalProfit['refund_total']+$totalProfit['trans_fees_total']);
                     $ownerProfit=((100-$commission)*$profit)/100;					
                     $siteProfit=($commission*$profit)/100;					
				  ?>
                    <tr>
                      <td><?php echo $i;?></td>
                      <td><a href="<?php echo url('profile/view/'.$list['uid']);?>"><?php echo $list['name'];?></a></td>
                      <td><a href="<?php echo url('profile/view/'.$list['uid']);?>"><?php echo ucwords($list['first_name']." ".$list['last_name']);?></a></td>
                      <td><?php echo $list['mail'];?></td>
                      <td><a href="<?php echo url('admin/user/trips/'.$list['uid']);?>"><?php echo "View ".$totalBooked." trips";?></a></td>
                      <td><a href="<?php echo url('admin/deal/list')."?criteria=u.name&search=".$list['name'];?>"><?php echo "View ".$totalListAdded." lists";?></a></td>
                      <td><?php echo $commission."%";?></td>
                      <td><?php echo " $".sprintf("%.2f",$ownerProfit);?></td>
                      <td><?php echo " $".sprintf("%.2f",$siteProfit); ?></td>
                    </tr>
                   <?php
				    $i++;
                      }
					
					}
					else {
                    ?>
					<h4>No Results Found</h4>
					<?php 
					}
					
					?>
                      					
                  </tbody>
                </table>
              </div>
            </div>
			<?php 
			print '<div class="pagination">'.$pagination.'</div>';
			?>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>