<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'utils/mail.php';

$mailManager = new MailManager('nicetrip.social@outlook.com', 'Superlori?', 'smtp-mail.outlook.com', 587, 'NiceTrip', $_GET["email"]);

$result["message"] = $mailManager->sendAccountVerificationEmail();

header('Content-Type: application/json');
echo json_encode($result);

?>