<?php
session_start();
require_once __DIR__ . '/php-graph-sdk/src/Facebook/autoload.php';

//use getting_started.md line 84 110
$fb = new Facebook\Facebook([
    'app_id' => '664317253903398',
    'app_secret' => '949d3fa9cf7d738d85505dbfe468b1e4',
    'default_graph_version' => 'v3.0',
    ]);
//use getting_started.md line 113
$helper = $fb->getRedirectLoginHelper();
$permissions = ['email', 'user_photos']; // optional
$loginUrl = $helper->getLoginUrl('http://localhost:8000/scratchpad/appmonstaAPITest/user/login-callback.php', $permissions);

echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';

?>

hello Facebook