<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once 'libs/PHPMailer/src/Exception.php';
require_once 'libs/PHPMailer/src/PHPMailer.php';
require_once 'libs/PHPMailer/src/SMTP.php';
require_once 'bootstrap.php';

/**
 * Class dealing with email management.
 * 
 */
class MailManager {

    /**
     * Build a new MailManager
     * 
     * @param $host
     *        smtp server
     * @param $email_address
     *        email address
     * @param $password
     *        email account password
     * @param $fromName
     *        Sender
     */
    public function __construct($host, $email_address, $password, $fromName) {
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
    }


    /**
     * Set the destination email.
     * 
     * @param $destination_email
     *        destinationEmail
     */
    public function setDestinationEmail($destinationEmail) {
        $this->mail->clearAllRecipients();
        $this->mail->AddAddress($destinationEmail);
    }

    /**
     * Send account confirmation email.
     * 
     * 
     */
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
        try{
            $this->mail->Send();
        } catch(Exception $e) {
            $this->mail->getSMTPInstance()->reset();
        }
    }

    /**
     * Send notification email.
     * 
     * @param $notification
     *         notification
     */
    public function sendNotification($userName, $message, $link) {
        $this->mail->IsHTML(true);

        $message = "
            <html>
                <head>
                    <meta charset='utf-8' />
                </head>
                <body>
                    <p>NiceTrip - share your travels</p>
                    <p class='fs-5'><span class='fw-bold'>$userName</span> $message <a href='$link'>your post</a></p>
                </body>
            </html>
        ";

        $textMessage = "
            NiceTrip - share your travels
            $userName $message your post
        ";

        $this->mail->Subject = 'NiceTrip';
        $this->mail->Body = $message;
        $this->mail->AltBody = $textMessage;
        try{
            $this->mail->Send();
        } catch(Exception $e) {
            $this->mail->getSMTPInstance()->reset();
        }
    }

}

?>