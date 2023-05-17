<?php

require_once 'utils/mail.php';
require_once 'bootstrap.php';


$mailManager = new MailManager('smtp.libero.it', 'nicetrip.social@libero.it', '@Iamgroot12', 'NiceTrip', $_POST["email"]);

$result["error"] = false;

try {

    do{
        $activation_code = random_str();
    }while(count($dbh->getUsersByActivationCode($activation_code)) !== 0);

    $dbh->signUpUser($_POST["username"], $_POST["name"], $_POST["last-name"], $_POST["email"], $_POST["password"], $activation_code);
    $mailManager->sendAccountVerificationEmail($activation_code);

} catch(mysqli_sql_exception $e) {
    $result["error"] = true;
}

header('Content-Type: application/json');
echo json_encode($result);

?>