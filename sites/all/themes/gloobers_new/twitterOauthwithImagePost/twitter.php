<?php

require_once 'twitteroauth.php';

define("CONSUMER_KEY", "E5sEfM0RyMNcDFKH6ZcQLQTtY");
define("CONSUMER_SECRET", "mHy4kNZEfqXKX4EyY7rmgnDRhU3UBiIwhWa4lCBRjdfXxufGhv");
define("OAUTH_TOKEN", "763301564878512128-9hl5P44mgtavi6qLafL72jH31Mjat18");
define("OAUTH_SECRET", "j2aQhk3frXin8vUUBxDk1q7Ci9Xa12AtbFLUIKS7tSC6k");


$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, OAUTH_TOKEN, OAUTH_SECRET);

//$twitter_msg=$_GET['msg'];
//$twitter_media=$_GET['media'];
// $twitter_msg="test";
// $twitter_media="";
print_r($twitter_msg);
print_r($twitter_media);

$content = $connection->get('account/verify_credentials');
$image = $twitter_media;
$status_message = $twitter_msg;
$status = $connection->upload('statuses/update_with_media', array('status' => $status_message, 'media[]' => file_get_contents($image)));
json_encode($status);


?>