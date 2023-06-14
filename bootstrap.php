<?php

if(!session_id())  
    session_start();

define("UPLOAD_DIR", "./upload/");
define("IMAGES_DIR", "./img/");
define("PROFILE_IMAGES_DIR", "./profilePhotos/");
define("TIME_SESSION_EXTENSION", "86400 * 30");

$actualDir = dirname($_SERVER["PHP_SELF"]);

require_once "db/database.php";
require_once "utils/mail.php";

$dbh = new ConcreteDatabaseHelper("localhost", "root", "", "nicetrip", 3306);
$mailManager = new MailManager('smtp.libero.it', 'nicetrip.social@libero.it', '@Iamgroot12', 'NiceTrip');


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