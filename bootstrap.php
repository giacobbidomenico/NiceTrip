<?php

/**
*  Change the following variables to set database credentials:
*/
$host = "localhost";
$username = "root";
$password = "";
$dbname = "nicetrip";
$port = 3306;

/**
*  Change the following variables to set e-mail credentials:
*/
$serverMail = 'smtp.libero.it';
$email = 'nicetrip.social@libero.it';
$emailPassword = '@Iamgroot12';
$nameFrom = 'NiceTrip';



if(!session_id())  
    session_start();

define("UPLOAD_DIR", "./upload/");
define("IMAGES_DIR", "./img/");
define("PROFILE_IMAGES_DIR", "./profilePhotos/");
define("TIME_SESSION_EXTENSION", "86400 * 30");

$actualDir = dirname($_SERVER["PHP_SELF"]);

require_once "db/database.php";
require_once "utils/mail.php";

$dbh = new ConcreteDatabaseHelper($host, $username, $password, $dbname, $port);
$mailManager = new MailManager($serverMail, $email, $emailPassword, $nameFrom);


require_once "utils/functions.php";


/*
 * In case consent has been given in the login to maintain the connection, 
 * a code corresponding to a user is stored in a cookie.
 */
if(isset($_COOKIE["session-extension-code"]) && !isSessionActive()) {

    /*
     * Fetch user data from the database and insert them into appropriate session variables
     */
    $result = $dbh->getUsersBySessionExtensionCode($_COOKIE["session-extension-code"]);

    if(isset($result[0]["id"]) && isset($result[0]["email"]) && isset($result[0]["userName"])) {
        registerLoginUser($result[0]["id"], $result[0]["email"], $result[0]["userName"]);
    }
}

if(isSessionActive()) {
    $mailManager->setDestinationEmail($_SESSION["email"]);
}

//default parameters of the navbar
$navBarParams["profile"] = "profile.php";
$navBarParams["logOut"] = "";
$navBarParams["feed"] = "feed.php";
$navBarParams["search"] = "search.php";
$navBarParams["notifications"] = "notifications.php";
$navBarParams["newPost"] = "new-post.php";
$navBarParams["options"] = "settings.php";

?>