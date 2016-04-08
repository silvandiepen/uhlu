<?php

include('vendor/autoload.php');

$instagram = new Instagram(array(
    'apiKey'      => '7606640fcd3a445490dcec00e46f02f2',
    'apiSecret'   => 'ad2d5d9e70994533aa4a659a4f93304b',
    'apiCallback' => 'http://uhlu.dev/callback.php'
));

// grab OAuth callback code
$code = $_GET['code'];
$data = $instagram->getOAuthToken($code);

echo 'Your username is: ' . $data->user->username;
