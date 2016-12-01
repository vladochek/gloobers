<?php 
global $base_url;
$adviceStatus=0;
 $advisorSearch=$_SESSION['advisor_search'];
 if(isset($advisorSearch['location']) && $advisorSearch['location']!="")
 {
 $location=trim($advisorSearch['location']);
 }
    $adviceForm=drupal_get_form('gloobers_finder_form');
 ?>
     <div class="">
	   <?php 
	   echo drupal_render($adviceForm);
	  
	   ?>
	   </div> 
 
<div class="advisor-options">
<input class="advisorCheck" type="checkbox" name="fb" value="fb">Facebook friends</input>
<input class="advisorCheck" type="checkbox" name="passion" value="passion">Common passion friends</input>
<input class="advisorCheck" type="checkbox" name="native" value="native">Native place people</input>
<input class="advisorCheck" type="checkbox" name="past" value="past">People who has been there</input>
</div>
<div class="advisor-wrapper">
	<div class="friends">
		<?php	
		if(count($mergedArray)>0)
		{
		foreach($mergedArray as $passionAdvisor)
		{
        $userdetails=user_load($passionAdvisor['uid']);
		
      if($userdetails->field_first_name["und"][0]["value"] != "" && isset($userdetails->field_first_name["und"][0]["value"])){
				$name=$userdetails->field_first_name["und"][0]["value"]." ".$userdetails->field_last_name["und"][0]["value"];
				}
				else{
				$name= $userdetails->name;
				}
             				
		?>
	<div class="user-details" id="results_<?php echo $passionAdvisor['uid'] ?>">	
		<div class="user-img" alt="<?php echo $name?>">
		<?php 
		if($userdetails->picture){
			$file = file_load($userdetails->picture->fid);
			$imgpath = $file->uri;
			$style="thumbnail";
			
	?>
	<img  src="<?php print image_style_url($style,$imgpath); ?>">
		
	<?php 
		}
		else{
	?>
			<img src="<?php echo $base_url."/".drupal_get_path('theme',$GLOBALS['theme']).'/images/no-profile-male-img.jpg'; ?>" alt="<?php echo $name;?>" width="100px">
	<?php 
		}		
	?> 
	
		</div>
			<div>
			<span><?php echo $name;?></span>
			</div>
	<?php 
	if(isset($_SESSION['advisor_location_search']))
	{
    $requestId=$_SESSION['advisor_location_search'];
    $adviceStatus=check_advice_status($requestId,$passionAdvisor['uid']);
	}
   $commonPassions=getCommonPassions($user->uid,$passionAdvisor['uid']);
   if(count($commonPassions)>0)
	{
    $userPassion=array();
    $passionStr="";
	foreach($commonPassions as $passions)
	{
	array_push($userPassion,$passions['passion']);
	}
	$passionStr=implode(",",$userPassion);
	echo $passionStr;
	?>
	
	<?php
	}
	if($adviceStatus)
	{
		echo "Request Send";
	}else
	{
 ?>
   	
	<a href="#advice<?php echo $passionAdvisor['uid'];?>" class="get-advice inline" id="advice-<?php echo $passionAdvisor['uid'];?>">SELECT</a>
   	 <div style='display:none'>
	   <div id="advice<?php echo $passionAdvisor['uid'];?>"  class="advice-msg" style='padding:10px; background:#fff;'>
	     <?php
		 $msgForm=drupal_get_form('get_advice_message_form');
          echo drupal_render($msgForm);	 
		 ?>
	     <script>
					 var jq = jQuery.noConflict();
						jq(document).ready(function(){
						jq('#advice<?php echo $passionAdvisor['uid'];?>').find(".requestId").val(<?php echo $passionAdvisor['uid'];?>);
						});
					 </script>
	   </div>
	 </div>
   <?php 
	}
	?>
   
	</div>
		<?php 
		}
	}
    else 
    {	
	?>
	<div class="error-result">No match found</div>
	<?php 
    }
	?> 
  	<div class="tableRow">
				<div class="secondColumn" id="loaderImg" style="display:none;"></div>
			</div> 
	</div>
	
	
	
</div>
<script>
var jq = jQuery.noConflict();
jq(document).ready(function(){
	jq(".send-request-msg").on('click',function(e){			
		//alert(jq(".advice-msg .requestId").val());
		//alert(jq(".advice-msg .form-textarea").text());
	e.preventDefault();
	user_id =jq(this).closest("form");	
	 var values={};
	jq.each(jq(user_id).serializeArray(), function(i, field) {
		values[field.name] = field.value;
	});
	var requestId = values.requestId;
	var msg       = values.msg; 
	 
	jq.ajax({
    type: "POST",
	url: "<?php echo $base_url; ?>/advice/user",
	data: "typeId="+encodeURI(requestId)+"&msg="+encodeURI(msg),
	success: function(result){
		if(result==1)
		{
	     jq("#cboxClose").click();	
	     alert(result);
		}
	},
	error: function() {
       	alert("ajax error occured…"+data);
      }
	
	});
	
	});
	/****************************************************************************/
	jq(".advisorCheck").on('click',function(){
	var items=[];
	  jq('.advisorCheck').each(function () {
      sThisVal = (this.checked ? items.push(jq(this).val()) : ""); 
	  
      });
	  if((items.length)>0)
       {
       var advisors=JSON.stringify(items);	  
       /******************send request to server for results**************************/	 
		   jq.ajax({
		   type: "POST",
			url: "<?php echo $base_url; ?>/gloobers/finder",
			data: "advisors=" + encodeURI(advisors),
			success: function(msg){
			alert(msg);
			}
			}); 	   
       } 	   
	});
	/*******************************************************/
	jq(".inline").colorbox({inline:true, width:"50%"});
/******************************Load more data**********************************************************/
jQuery(window).on('scroll', function(){
	scrollMoreResults();
});

function scrollMoreResults(){	
	if(jQuery(window).scrollTop() == (jQuery(document).height() - jQuery(window).height())){	
		var offset = jQuery('[id^="results_"]').length; // here we find out total records on page.  
		jQuery(window).unbind("scroll");
		jQuery("#loaderImg").html('<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/gloober-preeloader-f1.gif" />');
		jQuery("#loaderImg").show();
		loadMoreResult(offset);		
	}
}	
function loadMoreResult(offset){
jQuery.ajax({
		type: 'POST',
		async:false,
		url : "<?php echo $base_url; ?>/gloobers/finder",
		data : "resultSet="+encodeURI(offset),
		success: function(data){
			alert(data);
			jQuery("#loaderImg").empty();
			if(data.length > 0){
				jQuery("#loaderImg").hide();
			}
			else{
				jQuery("#loaderImg").html("<span>No more results..</span>");
			}
			//$(".loadData :last").after(data);
			jQuery(".result-row").append(data);
		},
		error: function(data){
			alert("ajax error occured…"+data);
		 }
	   }).done(function(){
		jQuery(window).on("scroll",function(){
		scrollMoreResults();	
	    });
	  });
   }
/**********************************************************/
jq('.datepicker').datepicker({minDate: 0});
});
					
</script>
