<?php

//config.php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('529302459286-f2fhubc46s3kvuaj4bg2gl0srhf3fkba.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('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');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('https://datn.io.vn/login.php');

// to get the email and profile 
$google_client->addScope('email');

$google_client->addScope('profile');

?>