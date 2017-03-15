<?php
global $user,$base_url;
$userDetails=user_load($user->uid);
drupal_add_js(drupal_get_path('theme',$GLOBALS['theme']) .'/js/autocomplete.js',array('scope' => 'footer')); 
drupal_add_js(drupal_get_path('theme',$GLOBALS['theme']) .'/js/jquery.validate.js',array('scope' => 'footer')); 
$current_path = current_path();
//drupal_add_css(drupal_get_path('theme',$GLOBALS['theme']) .'/css/landing_page.css'); 
//drupal_add_css(drupal_get_path('theme',$GLOBALS['theme']) .'/fonts/stylesheet.css'); 

define('BASE_CURRENCY_NAME', '$');

$notifiationBadge = unread_notification(1);
//echo $notifiationBadge;die;

$notifiationStore = (json_decode($notifiationBadge));

echo "<pre>";Print_r($page['banner']);exit;
print render($page['banner']); 
 /* if ($messages): 
 ?>
		<div id="messages"><div class="section clearfix">
		  <?php print $messages; ?>
		</div></div> <!-- /.section, /#messages -->
	  <?php endif;  */
if($page['how_it_works'])
{	
 print render($page['how_it_works']);
}
if($page['popular_destination'])
{
  print render($page['popular_destination']);  
}
if($page['passionate'])
{
  print render($page['passionate']);  
}

if($page['join_tribe'])
{
  print render($page['join_tribe']);  
}
if($page['recommend_professional'])
{
  print render($page['recommend_professional']);  
}

?>
<script type="text/javascript">

        function readnotifications(recipient_id){
            jQuery.ajax({
        
				 url:'<?php echo $base_url; ?>/advice/readnotifications',
				 type:'post',
				 data:{'recipientid':recipient_id ,'isAjax':1},
				 success: function(result){
					//alert(result);

					window.location.href='<?php echo $base_url;?>/advice/notification';
				 }

			});
            
        }
</script>