<?php 
session_start();
require_once('twitteroauth.php');
require_once('twitter-config.php');

if(isset($_GET["redirect"]))
{
    $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);	
    $request_token = $connection->getRequestToken(OAUTH_CALLBACK);
    echo $request_token['oauth_token'];
    
    $_SESSION['oauth_token'] =  $token = $request_token['oauth_token'];
    $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
     
    switch ($connection->http_code) {
      case 200:
        $url = $connection->getAuthorizeURL($token);
       
   		header('Location: ' . $url); 
        break;
      	default:
        echo 'Could not connect to Twitter. Refresh the page or try again later.';
    }
		$_SESSION['twitter_msg']=$_GET['msg'];
		$_SESSION['twitter_media']=$_GET['media'];
	    exit;
}
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

	$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
	//save new access tocken array in session
	$_SESSION['access_token'] = $access_token;
//	print_r($_SESSION);
	unset($_SESSION['oauth_token']);
	unset($_SESSION['oauth_token_secret']);	
	$_SESSION['screen_name']=$access_token['screen_name'];

    $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
		$content = $connection->get('account/verify_credentials');
		$image = $_SESSION['twitter_media'];
		$status_message = $_SESSION['twitter_msg'];
		$status = $connection->upload('statuses/update_with_media', array('status' => $status_message, 'media[]' => file_get_contents($image)));
		json_encode($status);
	if(isset($_GET['oauth_token']) && $_GET['oauth_verifier']){
		    header( "Location: /" ); die;
	}			
?>