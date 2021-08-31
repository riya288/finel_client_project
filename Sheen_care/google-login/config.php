<?php
error_reporting(0);
//start session on web page
session_start();

//config.php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('13739961988-fh17uqi0krc1kb70sj29b572j1crr5f2.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('UbYGItqO4PeqGIXOCQ-ewkHL');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('https://www.sheencare.com/google-login/index.php');

// to get the email and profile 
$google_client->addScope('email');

$google_client->addScope('profile');

?> 