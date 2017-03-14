<?php
define('DRUPAL_ROOT', getcwd());
include_once DRUPAL_ROOT . '/includes/bootstrap.inc';
// Load Drupal
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

$email = filter_input(INPUT_POST, 'email');

if ($email) {
    $to = 'contact@gloobers.com';
//    $to = 'zingeon1@gmail.com';
    $key = 'Gloobers Team';
    $body = 'User\'s email: ' . $email;
    $headers = 'From: developers@gloobers.com' . "\r\n" .
        'Content-Type: text/html; charset=UTF-8; format=flowed' . "\r\n" .
        'Content-Transfer-Encoding: 8Bit' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    mail($to, $key, $body, $headers);
}
