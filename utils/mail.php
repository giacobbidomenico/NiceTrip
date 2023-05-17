<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once 'libs/PHPMailer/src/Exception.php';
require_once 'libs/PHPMailer/src/PHPMailer.php';
require_once 'libs/PHPMailer/src/SMTP.php';
require_once 'bootstrap.php';

class MailManager {
    public function __construct($host, $email_address, $password, $fromName, $destination_email) {
        $this->mail = new PHPMailer(true);
 
        $this->mail->IsSMTP();
        $this->mail->Host = $host;
        $this->mail->Port = 587;

        $this->mail->SMTPSecure = 'tls';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = $email_address;
        $this->mail->Password = $password;
        
        $this->mail->From = $email_address;
        $this->mail->FromName = $fromName;
        $this->mail->AddAddress($destination_email);        
    }

    public function sendAccountVerificationEmail($activation_code) {
        $this->mail->IsHTML(true);
        
        $actualDir = dirname($_SERVER["PHP_SELF"]);

        $message = "
            <html>
                <head>
                    <meta charset='utf-8' />
                </head>
                <body>
                    <p>NiceTrip - share your travels</p>
                    <p>To verify your account press the following <a href='http://$_SERVER[HTTP_HOST]$actualDir/account-verification.php?activation-code=$activation_code'>link</a></p>
                </body>
            </html>
        ";

        $textMessage = "
            NiceTrip - share your travels
            To verify your account press the following link
        ";

        $this->mail->Subject = 'NiceTrip';
        $this->mail->Body = $message;
        $this->mail->AltBody = $textMessage;

        return $this->mail->Send();
    }
}

?>