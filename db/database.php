<?php
class DatabaseHelper{
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port) {
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        } 
    }

    public function checkEmailOrUsername($email_username) {
        $query = "SELECT `users`.`id`, `users`.`userName`, `users`.`email` FROM `users` WHERE `users`.`email` = ? OR `users`.`username` = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $email_username, $email_username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function checkEmail($email) {
        $query = "SELECT `users`.`id`, `users`.`userName`, `users`.`email` FROM `users` WHERE `users`.`email` = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function checkUsername($username) {
        $query = "SELECT `users`.`id`, `users`.`userName`, `users`.`email` FROM `users` WHERE `users`.`username` = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function isAccountActivated($email_username) {
        $query = "SELECT `users`.id, `users`.`userName`, `users`.`email` FROM `users` WHERE (`users`.`email` = ? OR `users`.`userName` = ?) AND `users`.`activation_code` IS NULL";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $email_username,$email_username);
        $stmt->execute();
        $result = $stmt->get_result();

        return count($result->fetch_all(MYSQLI_ASSOC)) !== 0;
    }

    public function checkLogin($email_username, $password) {
        $query = "SELECT `users`.id, `users`.`userName`, `users`.`email` FROM `users` WHERE (`users`.`email` = ? OR `users`.`userName` = ?) AND `users`.`password` = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sss', $email_username, $email_username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateSessionExtensionCode($session_extension_code, $user_id) {
        $query = "UPDATE `users` SET `cookie` = ? WHERE `users`.`id` = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $session_extension_code, $user_id);

        return $stmt->execute();
    }

    public function getUsersBySessionExtensionCode($session_extension_code) {
        $query = "SELECT `users`.`id`, `users`.`userName`, `users`.`email` FROM `users` WHERE `users`.`cookie` = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $session_extension_code);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUsersByActivationCode($activation_code) {
        $query = "SELECT `users`.`id`, `users`.`userName`, `users`.`email` FROM `users` WHERE `users`.`activation_code` = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $activation_code);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function signUpUser($username, $name, $last_name, $email, $password, $activation_code) {
        $query = 'INSERT INTO `users`(`userName`, `name`, `lastName`, `email`, `password`, `activation_code`) VALUES (?,?,?,?,?,?)';

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssssss', $username, $name, $last_name, $email, $password, $activation_code);

        return $stmt->execute();
    }
}
?>