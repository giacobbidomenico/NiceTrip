<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'libs/PHPMailer/src/Exception.php';
require_once 'libs/PHPMailer/src/PHPMailer.php';
require_once 'libs/PHPMailer/src/SMTP.php';
require_once 'bootstrap.php';

$outlook_mail = new PHPMailer(true);
$result["error"] = false;
 
$outlook_mail->IsSMTP();
$outlook_mail->Host = 'smtp-mail.outlook.com';
$outlook_mail->Port = 587;
$outlook_mail->SMTPSecure = 'tls';
$outlook_mail->SMTPDebug = 1;
$outlook_mail->SMTPAuth = true;
$outlook_mail->Username = 'nicetrip.social@outlook.com';
$outlook_mail->Password = '';
 
$outlook_mail->From = 'nicetrip.social@outlook.com';
$outlook_mail->FromName = 'NiceTrip';
$outlook_mail->AddAddress($_GET["email"], 'To Name');
$outlook_mail->AddAddress('to-Outlook-address@Outlook.com');
 
$outlook_mail->IsHTML(true);
 
$outlook_mail->Subject = '';
$outlook_mail->Body    = '';
$outlook_mail->AltBody = '';
 
if(!$outlook_mail->Send()) {
echo 'Message could not be sent.';
echo 'Mailer Error: ' . $outlook_mail->ErrorInfo;
exit;
}
else
{
echo 'Message of Send email using Outlook SMTP server has been sent';
}

header('Content-Type: application/json');
echo json_encode($result);

?>