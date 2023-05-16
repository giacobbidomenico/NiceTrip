<?php
require_once 'utils/mail.php';
require_once 'bootstrap.php';

$activation_code = random_str();

if ($dbh->signUpUser($_GET["username"], $_GET["name"], $_GET["last-name"], $_GET["email"], $_GET["password"], $activation_code)) {

}

$mailManager = new MailManager('smtp.libero.it', 'nicetrip.social@libero.it', '@Iamgroot12', 'NiceTrip', $_GET["email"]);

$result["message"] = $mailManager->sendAccountVerificationEmail($activation_code);

/*
header('Content-Type: application/json');
echo json_encode($result);
*/
?>