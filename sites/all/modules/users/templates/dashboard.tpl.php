<?php
	global $user,$base_url;

/*  jqblock = module_invoke('block', 'block_view', '7'); 
 echo jqblock['content']; */
 
	$userdetails = user_load($user->uid);
/* 	echo "<pre>";
	print_r(jquserdetails); */
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
   $profit=$totalProfit['grand_profit']-($totalProfit['refund_total']+$totalProfit['trans_fees_total']);	
?>
<div class="dm-dashboard-wrapper">
      <div class="row">
        <div class="col-md-12">
          <div id="console-btns">
            <div class="row">
              <div class="col-xs-6 col-md-3">
                <div class="console-btn">
                  <div class="console-icon divider-right"> <span class="glyphicons glyphicons-user_add"></span> </div>
                  <div class="console-text">
                    <div class="console-title">Visitors</div>
                    <div class="console-subtitle">2.532</div>
                  </div>
                </div>
              </div>
              <div class="col-xs-6 col-md-3">
                <div class="console-btn">
                  <div class="console-icon divider-right"> <span class="glyphicons glyphicons glyphicons-shopping_cart"></span> </div>
                  <div class="console-text">
                    <div class="console-title">Purchases</div>
                    <div class="console-subtitle">658</div>
                  </div>
                </div>
              </div>
              <div class="col-xs-6 col-md-3">
              <a href="<?php echo url('income/details');?>" title="View all your deals income details">    <div class="console-btn">
                  <div class="console-icon divider-right"> <span class="glyphicons glyphicons-credit_card"></span> </div>
                  <div class="console-text">
                    <div class="console-title">Income</div>
                    <div class="console-subtitle"><?php $profit=((100-$comm)*$profit)/100;echo " $".sprintf("%.2f",$profit);?></div>
                  </div>
                </div>
				</a>
              </div>
              <div class="col-xs-6 col-md-3">
                <div class="console-btn">
                  <div class="console-icon divider-right"> <span class="glyphicons glyphicons-eye_open"></span> </div>
                  <div class="console-text">
                    <div class="console-title">Monthly Visits</div>
                    <div class="console-subtitle">12.526</div>
                  </div>
                </div>
              </div>
              <div id="console-search-btn" class="col-lg-4">
                <div class="console-btn">
                  <div class="console-icon divider-right"> <span class="glyphicons glyphicons-search"></span> </div>
                  <div class="console-filter">
                    <input type="text" placeholder="Filter Events Below..." class="search-bar form-control" id="filterSearch">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-9 col-lg-10">
          <div class="main-box">
            <div class="row">
              <div class="col-md-9">
                <div class="graph-box emerald-bg">
                  <h2>Sales &amp; Earnings</h2>
                  <div style="max-height: 335px; position: relative;" id="graph-line" class="graph">
                    <svg height="335" version="1.1" width="651" xmlns="http://www.w3.org/2000/svg" style="overflow: hidden; position: relative; top: -0.299988px;">
                      <desc>Created with Raphaël 2.0.1</desc>
                      <defs/>
                      <text style="text-anchor: end; font: 12px sans-serif;" x="53.5" y="295" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#68869f" font-size="12px" font-family="sans-serif" font-weight="normal">
                        <tspan dy="4.5">0</tspan>
                      </text>
                      <path style="" fill="none" stroke="#68869f" d="M66,295H626" stroke-opacity="0.3" stroke-width="1"/>
                      <text style="text-anchor: end; font: 12px sans-serif;" x="53.5" y="227.5" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#68869f" font-size="12px" font-family="sans-serif" font-weight="normal">
                        <tspan dy="4.5">5,000</tspan>
                      </text>
                      <path style="" fill="none" stroke="#68869f" d="M66,227.5H626" stroke-opacity="0.3" stroke-width="1"/>
                      <text style="text-anchor: end; font: 12px sans-serif;" x="53.5" y="160" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#68869f" font-size="12px" font-family="sans-serif" font-weight="normal">
                        <tspan dy="4.5">10,000</tspan>
                      </text>
                      <path style="" fill="none" stroke="#68869f" d="M66,160H626" stroke-opacity="0.3" stroke-width="1"/>
                      <text style="text-anchor: end; font: 12px sans-serif;" x="53.5" y="92.5" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#68869f" font-size="12px" font-family="sans-serif" font-weight="normal">
                        <tspan dy="4.5">15,000</tspan>
                      </text>
                      <path style="" fill="none" stroke="#68869f" d="M66,92.5H626" stroke-opacity="0.3" stroke-width="1"/>
                      <text style="text-anchor: end; font: 12px sans-serif;" x="53.5" y="25" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#68869f" font-size="12px" font-family="sans-serif" font-weight="normal">
                        <tspan dy="4.5">20,000</tspan>
                      </text>
                      <path style="" fill="none" stroke="#68869f" d="M66,25H626" stroke-opacity="0.3" stroke-width="1"/>
                      <text style="text-anchor: middle; font: 12px sans-serif;" x="563.7777777777778" y="307.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#68869f" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,7.5)">
                        <tspan dy="4.5">2014-01-09</tspan>
                      </text>
                      <text style="text-anchor: middle; font: 12px sans-serif;" x="439.3333333333333" y="307.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#68869f" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,7.5)">
                        <tspan dy="4.5">2014-01-07</tspan>
                      </text>
                      <text style="text-anchor: middle; font: 12px sans-serif;" x="314.8888888888889" y="307.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#68869f" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,7.5)">
                        <tspan dy="4.5">2014-01-05</tspan>
                      </text>
                      <text style="text-anchor: middle; font: 12px sans-serif;" x="190.44444444444446" y="307.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#68869f" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,7.5)">
                        <tspan dy="4.5">2014-01-03</tspan>
                      </text>
                      <text style="text-anchor: middle; font: 12px sans-serif;" x="66" y="307.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#68869f" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,7.5)">
                        <tspan dy="4.5">2014-01-01</tspan>
                      </text>
                      <path style="" fill="none" stroke="#abc5db" d="M66,259.009C81.55555555555556,235.00600000000003,112.66666666666667,166.787125,128.22222222222223,162.997C143.77777777777777,159.20687500000003,174.8888888888889,218.5444375,190.44444444444446,228.688C206,238.8315625,237.11111111111111,247.348375,252.66666666666666,244.1455C268.22222222222223,240.942625,299.33333333333337,206.2763125,314.8888888888889,203.065C330.44444444444446,199.8536875,361.55555555555554,215.09687499999998,377.1111111111111,218.45499999999998C392.66666666666663,221.81312499999999,423.77777777777777,245.7975625,439.3333333333333,229.93C454.88888888888886,214.06243750000002,486,101.41506249999999,501.55555555555554,91.5145C517.1111111111111,81.61393749999999,548.2222222222223,139.5188125,563.7777777777778,150.7255C579.3333333333334,161.9321875,610.4444444444445,173.557375,626,181.168" stroke-width="3"/>
                      <circle cx="66" cy="259.009" r="3" fill="#68869f" stroke="#68869f" style="" stroke-width="1"/>
                      <circle cx="128.22222222222223" cy="162.997" r="3" fill="#68869f" stroke="#68869f" style="" stroke-width="1"/>
                      <circle cx="190.44444444444446" cy="228.688" r="3" fill="#68869f" stroke="#68869f" style="" stroke-width="1"/>
                      <circle cx="252.66666666666666" cy="244.1455" r="3" fill="#68869f" stroke="#68869f" style="" stroke-width="1"/>
                      <circle cx="314.8888888888889" cy="203.065" r="3" fill="#68869f" stroke="#68869f" style="" stroke-width="1"/>
                      <circle cx="377.1111111111111" cy="218.45499999999998" r="3" fill="#68869f" stroke="#68869f" style="" stroke-width="1"/>
                      <circle cx="439.3333333333333" cy="229.93" r="3" fill="#68869f" stroke="#68869f" style="" stroke-width="1"/>
                      <circle cx="501.55555555555554" cy="91.5145" r="3" fill="#68869f" stroke="#68869f" style="" stroke-width="1"/>
                      <circle cx="563.7777777777778" cy="150.7255" r="3" fill="#68869f" stroke="#68869f" style="" stroke-width="1"/>
                      <circle cx="626" cy="181.168" r="3" fill="#68869f" stroke="#68869f" style="" stroke-width="1"/>
                    </svg>
                    <div class="morris-hover morris-default-style" style="left: 208.667px; top: 180px; display: none;">
                      <div class="morris-hover-row-label">2014-01-04</div>
                      <div style="color: #ffffff" class="morris-hover-point"> iPhone:
                        3,767 </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="row graph-nice-legend">
                  <div class="graph-legend-row col-md-12 col-sm-4">
                    <div class="graph-legend-row-inner"> <span class="graph-legend-name"> Earnings </span> <span class="graph-legend-value"> $94.382 </span> </div>
                  </div>
                  <div class="graph-legend-row col-md-12 col-sm-4">
                    <div class="graph-legend-row-inner"> <span class="graph-legend-name"> Orders </span> <span class="graph-legend-value"> 3.930 </span> </div>
                  </div>
                  <div class="graph-legend-row col-md-12 col-sm-4">
                    <div class="graph-legend-row-inner"> <span class="graph-legend-name"> New Clients </span> <span class="graph-legend-value"> 894 </span> </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-lg-2">
          <div class="social-box-wrapper">
            <div class="social-box col-md-12 col-sm-4 facebook"> <i class="fa fa-facebook"></i>
              <div class="clearfix"> <span class="social-count">184k</span> <span class="social-action">likes</span> </div>
              <span class="social-name">facebook</span> </div>
            <div class="social-box col-md-12 col-sm-4 twitter"> <i class="fa fa-twitter"></i>
              <div class="clearfix"> <span class="social-count">49k</span> <span class="social-action">tweets</span> </div>
              <span class="social-name">twitter</span> </div>
            <div class="social-box col-md-12 col-sm-4 google"> <i class="fa fa-google-plus"></i>
              <div class="clearfix"> <span class="social-count">204</span> <span class="social-action">circles</span> </div>
              <span class="social-name">google+</span> </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="main-box clearfix">
            <header class="main-box-header clearfix">
              <h2 class="pull-left">Manage Users</h2>
              <div class="filter-block pull-right"><div class="btn-group btn-space">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    Users <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="#">Free and Plans Subscribed</a></li>
    <li><a href="#">New Subscriptions</a></li>
    <li><a href="#">Subscriptions by Country</a></li>
  </ul>
</div>
                <div class="form-group pull-right">
                  <input type="text" placeholder="Search..." class="form-control">
                  <i class="fa fa-search search-icon"></i> </div>
                <!--<a class="btn btn-primary pull-right" href="#"> <i class="fa fa-eye fa-lg"></i> View all orders </a>-->
                
                
                
                 </div>
            </header>
            <div class="main-box-body clearfix">
              <div class="table-responsive clearfix">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th><a href="#"><span>User Name</span></a></th>
                      <th><a class="desc" href="#"><span>Status</span></a></th>
                      <th><a class="asc" href="#"><span>Roles</span></a></th>
                      <th class="text-center"><span>Member For</span></th>
                      <th class="text-right"><span>Last Access</span></th>
                      <th class="text-right">Operations</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><a href="#">admin</a></td>
                      <td> active </td>
                      <td><a href="#">administrator</a></td>
                      <td class="text-center"><span class="label label-success">1 month 1 week</span></td>
                      <td class="text-right"> 46 sec ago </td>
                      <td style="width: 15%;" class="text-right"><a class="table-link" href="#"> <span class="fa-stack"> <i class="fa fa-square fa-stack-2x"></i> <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i> </span> </a></td>
                    </tr>
                    <tr>
                      <td><a href="#">Honey Singh</a></td>
                      <td> active </td>
                      <td><a href="#">administrator</a></td>
                      <td class="text-center"><span class="label label-warning">1 month 5 days</span></td>
                      <td class="text-right"> 1 month 5 days ago </td>
                      <td style="width: 15%;" class="text-right"><a class="table-link" href="#"> <span class="fa-stack"> <i class="fa fa-square fa-stack-2x"></i> <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i> </span> </a></td>
                    </tr>
                    <tr>
                      <td><a href="#">Rudy Abrahami</a></td>
                      <td> active </td>
                      <td><a href="#">administrator</a></td>
                      <td class="text-center"><span class="label label-info">4 weeks 1 day</span></td>
                      <td class="text-right"> 3 weeks 6 days ago </td>
                      <td style="width: 15%;" class="text-right"><a class="table-link" href="#"> <span class="fa-stack"> <i class="fa fa-square fa-stack-2x"></i> <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i> </span> </a></td>
                    </tr>
                    <tr>
                      <td><a href="#">honey</a></td>
                      <td> active </td>
                      <td><a href="#">administrator</a></td>
                      <td class="text-center"><span class="label label-danger">1 week 5 days</span></td>
                      <td class="text-right"> 1 week 5 days ago </td>
                      <td style="width: 15%;" class="text-right"><a class="table-link" href="#"> <span class="fa-stack"> <i class="fa fa-square fa-stack-2x"></i> <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i> </span> </a></td>
                    </tr>
                    <tr>
                      <td><a href="#">Robert</a></td>
                      <td> active </td>
                      <td><a href="#">administrator</a></td>
                      <td class="text-center"><span class="label label-success">1 week 2 days</span></td>
                      <td class="text-right"> 3 week 5 days ago </td>
                      <td style="width: 15%;" class="text-right"><a class="table-link" href="#"> <span class="fa-stack"> <i class="fa fa-square fa-stack-2x"></i> <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i> </span> </a></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      
      
      
      <div class="row">
        <div class="col-lg-12">
          <div class="main-box clearfix">
            <header class="main-box-header clearfix">
              <h2 class="pull-left">Listing</h2>
              <div class="filter-block pull-right"><div class="btn-group btn-space">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    Type of Listings <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="#">Number of Listings</a></li>
    <li><a href="#">Listing By Month</a></li>
    <li><a href="#">Listing By Country</a></li>
  </ul>
</div>
                <div class="form-group pull-right">
                  <input type="text" placeholder="Search..." class="form-control">
                  <i class="fa fa-search search-icon"></i> </div>
                <!--<a class="btn btn-primary pull-right" href="#"> <i class="fa fa-eye fa-lg"></i> View all orders </a>-->
                
                
                
                 </div>
            </header>
            <div class="main-box-body clearfix">
              <div class="table-responsive clearfix">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th><a href="#"><span>Listing Category</span></a></th>
                      <th><a class="desc" href="#"><span>Listing Type</span></a></th>
                      <th><a class="asc" href="#"><span>Title</span></a></th>
                      <th class="text-center"><span>Price</span></th>
                      <th class="text-right">&nbsp;</th>
                      <th class="text-right"><span>Operations</span></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><a href="#">Lorem Ipsum</a></td>
                      <td> Lipsum </td>
                      <td><a href="#">listing</a></td>
                      <td class="text-center"><span class="label label-success">$500.00</span></td>
                      <td class="text-right">&nbsp;  </td>
                      <td style="width: 15%;" class="text-right"><a class="table-link" href="#"> <span class="fa-stack"> <i class="fa fa-square fa-stack-2x"></i> <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i> </span> </a></td>
                    </tr>
                    <tr>
                      <td><a href="#">Lorem Ipsum</a></td>
                      <td> Lipsum </td>
                      <td><a href="#">listing</a></td>
                      <td class="text-center"><span class="label label-warning">$450.00</span></td>
                      <td class="text-right">&nbsp;  </td>
                      <td style="width: 15%;" class="text-right"><a class="table-link" href="#"> <span class="fa-stack"> <i class="fa fa-square fa-stack-2x"></i> <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i> </span> </a></td>
                    </tr>
                    <tr>
                      <td><a href="#">Lorem Ipsum</a></td>
                      <td> Lipsum </td>
                      <td><a href="#">listing</a></td>
                      <td class="text-center"><span class="label label-info">$1050.00</span></td>
                      <td class="text-right">&nbsp;  </td>
                      <td style="width: 15%;" class="text-right"><a class="table-link" href="#"> <span class="fa-stack"> <i class="fa fa-square fa-stack-2x"></i> <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i> </span> </a></td>
                    </tr>
                    <tr>
                      <td><a href="#">Lorem Ipsum</a></td>
                      <td> Lipsum </td>
                      <td><a href="#">listing</a></td>
                      <td class="text-center"><span class="label label-danger">$2000.00</span></td>
                      <td class="text-right">&nbsp;  </td>
                      <td style="width: 15%;" class="text-right"><a class="table-link" href="#"> <span class="fa-stack"> <i class="fa fa-square fa-stack-2x"></i> <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i> </span> </a></td>
                    </tr>
                    <tr>
                      <td><a href="#">Lorem Ipsum</a></td>
                      <td> Lipsum </td>
                      <td><a href="#">listing</a></td>
                      <td class="text-center"><span class="label label-success">$5000.00</span></td>
                      <td class="text-right">&nbsp;  </td>
                      <td style="width: 15%;" class="text-right"><a class="table-link" href="#"> <span class="fa-stack"> <i class="fa fa-square fa-stack-2x"></i> <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i> </span> </a></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
 </div>     
      
      
      
      
      <!--<div class="row">
        <div class="col-lg-12">
          <div class="main-box clearfix">
            <header class="main-box-header clearfix">
              <h2 class="pull-left">Manage Users</h2>
              <div class="filter-block pull-right"><div class="btn-group btn-space">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    Users <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="#">Free and Plans Subscribed</a></li>
    <li><a href="#">New Subscriptions</a></li>
    <li><a href="#">Subscriptions by Country</a></li>
  </ul>
</div>
                <div class="form-group pull-right">
                
                  <input type="text" placeholder="Search..." class="form-control">
                  <i class="fa fa-search search-icon"></i> </div>
               <a class="btn btn-primary pull-right" href="#"> <i class="fa fa-eye fa-lg"></i> View all orders </a>
                
                
                
                 </div>
            </header>
            <div class="main-box-body clearfix">
              <div class="table-responsive clearfix">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th><a href="#"><span>User Name</span></a></th>
                      <th><a class="desc" href="#"><span>Status</span></a></th>
                      <th><a class="asc" href="#"><span>Roles</span></a></th>
                      <th class="text-center"><span>Member For</span></th>
                      <th class="text-right"><span>Last Access</span></th>
                      <th class="text-right">Operations</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><a href="#">admin</a></td>
                      <td> active </td>
                      <td><a href="#">administrator</a></td>
                      <td class="text-center"><span class="label label-success">1 month 1 week</span></td>
                      <td class="text-right"> 46 sec ago </td>
                      <td style="width: 15%;" class="text-right"><a class="table-link" href="#"> <span class="fa-stack"> <i class="fa fa-square fa-stack-2x"></i> <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i> </span> </a></td>
                    </tr>
                    <tr>
                      <td><a href="#">Honey Singh</a></td>
                      <td> active </td>
                      <td><a href="#">administrator</a></td>
                      <td class="text-center"><span class="label label-warning">1 month 5 days</span></td>
                      <td class="text-right"> 1 month 5 days ago </td>
                      <td style="width: 15%;" class="text-right"><a class="table-link" href="#"> <span class="fa-stack"> <i class="fa fa-square fa-stack-2x"></i> <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i> </span> </a></td>
                    </tr>
                    <tr>
                      <td><a href="#">Rudy Abrahami</a></td>
                      <td> active </td>
                      <td><a href="#">administrator</a></td>
                      <td class="text-center"><span class="label label-info">4 weeks 1 day</span></td>
                      <td class="text-right"> 3 weeks 6 days ago </td>
                      <td style="width: 15%;" class="text-right"><a class="table-link" href="#"> <span class="fa-stack"> <i class="fa fa-square fa-stack-2x"></i> <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i> </span> </a></td>
                    </tr>
                    <tr>
                      <td><a href="#">honey</a></td>
                      <td> active </td>
                      <td><a href="#">administrator</a></td>
                      <td class="text-center"><span class="label label-danger">1 week 5 days</span></td>
                      <td class="text-right"> 1 week 5 days ago </td>
                      <td style="width: 15%;" class="text-right"><a class="table-link" href="#"> <span class="fa-stack"> <i class="fa fa-square fa-stack-2x"></i> <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i> </span> </a></td>
                    </tr>
                    <tr>
                      <td><a href="#">Robert</a></td>
                      <td> active </td>
                      <td><a href="#">administrator</a></td>
                      <td class="text-center"><span class="label label-success">1 week 2 days</span></td>
                      <td class="text-right"> 3 week 5 days ago </td>
                      <td style="width: 15%;" class="text-right"><a class="table-link" href="#"> <span class="fa-stack"> <i class="fa fa-square fa-stack-2x"></i> <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i> </span> </a></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>-->
      
      
      
      
      
      
  
	  
<script>
	var jq=jQuery.noConflict();
	jq(document).ready(function(){
		
		/* initialize the external events
		-----------------------------------------------------------------*/
	
		jq('#external-events div.external-event').each(function() {
		
			// create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
			// it doesn't need to have a start or end
			var eventObject = {
				title: jq.trim(jq(this).text()) // use the element's text as the event title
			};
			
			// store the Event Object in the DOM element so we can get to it later
			jq(this).data('eventObject', eventObject);
			
			// make the event draggable using jQuery UI
			jq(this).draggable({
				zIndex: 999,
				revert: true,      // will cause the event to go back to its
				revertDuration: 0  //  original position after the drag
			});
			
		});
	
	

/* 	    jq('.conversation-inner').slimScroll({
	        height: '332px',
	        alwaysVisible: false,
	        railVisible: true,
	        wheelStep: 5,
	        allowPageScroll: false
	    });
		
	    //CHARTS
		graphLine = Morris.Line({
			element: 'graph-line',
			data: [
				{period: '2014-01-01', iphone: 2666, ipad: null, itouch: 2647},
				{period: '2014-01-02', iphone: 9778, ipad: 2294, itouch: 2441},
				{period: '2014-01-03', iphone: 4912, ipad: 1969, itouch: 2501},
				{period: '2014-01-04', iphone: 3767, ipad: 3597, itouch: 5689},
				{period: '2014-01-05', iphone: 6810, ipad: 1914, itouch: 2293},
				{period: '2014-01-06', iphone: 5670, ipad: 4293, itouch: 1881},
				{period: '2014-01-07', iphone: 4820, ipad: 3795, itouch: 1588},
				{period: '2014-01-08', iphone: 15073, ipad: 5967, itouch: 5175},
				{period: '2014-01-09', iphone: 10687, ipad: 4460, itouch: 2028},
				{period: '2014-01-10', iphone: 8432, ipad: 5713, itouch: 1791}
			],
			lineColors: ['#68869f'],
			xkey: 'period',
			ykeys: ['iphone'],
			labels: ['iPhone'],
			pointSize: 3,
			hideHover: 'auto',
			gridTextColor: '#68869f',
			gridLineColor: 'rgba(255, 255, 255, 0.3)',
			resize: true
		});
	    
		//WORLD MAP
		jq('#world-map').vectorMap({
			map: 'world_merc_en',
			backgroundColor: '#68869f',
			zoomOnScroll: false,
			regionStyle: {
				initial: {
					fill: '#e1e1e1',
					stroke: 'none',
					"stroke-width": 0,
					"stroke-opacity": 1
				},
				hover: {
					"fill-opacity": 0.8
				},
				selected: {
					fill: '#8dc859'
				},
				selectedHover: {
				}
			},
			series: {
				regions: [{
					values: gdpData,
					scale: ['#6fc4fe', '#2980b9'],
					normalizeFunction: 'polynomial'
				}]
			},
			onRegionLabelShow: function(e, el, code){
				el.html(el.html()+' ('+gdpData[code]+')');
			}
		}); */
	});

  
	</script>
