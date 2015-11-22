<?php

/*Define constant to connect to database */
// DEFINE('DATABASE_USER', 'a8718191_sushant');
// DEFINE('DATABASE_PASSWORD', 'Sush1993');
// DEFINE('DATABASE_HOST', 'a8718191_000webhost.com');
// DEFINE('DATABASE_NAME', 'a8718191_abhivad');
DEFINE('DATABASE_USER', 'root');
DEFINE('DATABASE_PASSWORD', '');
DEFINE('DATABASE_HOST', 'localhost');
DEFINE('DATABASE_NAME', 'abhivaad');
/*Default time zone ,to be able to send mail */
date_default_timezone_set('UTC');

/*You might not need this */
ini_set('SMTP', "mail.myt.mu"); // Overide The Default Php.ini settings for sending mail


//This is the address that will appear coming from ( Sender )
define('EMAIL', 'sushantjadhav2010@gmail.com');

/*Define the root url where the script will be found such as http://website.com or http://website.com/Folder/ */
DEFINE('WEBSITE_URL', 'http://abhivaad.webuda.com');


// Make the connection:
$mysqli = @mysqli_connect(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD,
    DATABASE_NAME);

if (!$mysqli) {
    trigger_error('Could not connect to MySQL: ' . mysqli_connect_error());
}

?>