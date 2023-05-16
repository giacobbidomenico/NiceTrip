<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'libs/PHPMailer/src/Exception.php';
require_once 'libs/PHPMailer/src/PHPMailer.php';
require_once 'libs/PHPMailer/src/SMTP.php';
require_once 'bootstrap.php';

class MailManager {
    public function __construct($email_address, $password, $host, $port, $fromName, $destination_email) {
        $this->mail = new PhpMailer(true);
        $this->mail->IsSMTP();
        $this->mail->Host = $host;
        $this->mail->Port = $port;
        $this->mail->SMTPSecure = 'tls';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = $email_address;
        $this->mail->Password = $password;

        $this->mail->From = $email_address;
        $this->mail->FromName = $fromName;
        $this->mail->AddAddress($destination_email);
         
        $this->mail->IsHTML(true);
    }

    public function sendAccountVerificationEmail() {
        $this->mail->Subject = 'NiceTrip';
        $this->mail->Body    = 'NiceTrip sign up';
        $this->mail->AltBody = 'fejfo';
        
        if(!$this->mail->Send()) {
            return false;
        }
        return true;
    } 
}

?>