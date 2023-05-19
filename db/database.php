<?php
class DatabaseHelper{
    private $db;

    /**
     * Buld a new DatabaseHelper.
     * 
     * @param $servername
     *        address of the server
     * @param $username
     *        username to access the DB
     * @param $password
     *        password to access the DB
     * @param $dbname
     *        name of the database you want to access
     * @param $port
     *        port of the database server
     */
    public function __construct($servername, $username, $password, $dbname, $port) {
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        } 
    }

    /**
     * Check if email/username matches a user's account.
     * 
     * @param $email_username
     *        user email/username       
     */
    public function checkEmailOrUsername($email_username) {
        $query = "SELECT `users`.`id`, `users`.`userName`, `users`.`email` FROM `users` WHERE `users`.`email` = ? OR `users`.`username` = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $email_username, $email_username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Check if email/username matches a user's account.
     * 
     * @param $email
     *        user email
     */
    public function checkEmail($email) {
        $query = "SELECT `users`.`id`, `users`.`userName`, `users`.`email` FROM `users` WHERE `users`.`email` = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Check if username matches a user's account.
     * 
     * @param $username
     *        user username
     */
    public function checkUsername($username) {
        $query = "SELECT `users`.`id`, `users`.`userName`, `users`.`email` FROM `users` WHERE `users`.`username` = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Function that check if the user's account has been activated, by seeing if the activation_code field is NULL
     * 
     * @param $email_username
     *        user email/username
     */
    public function isAccountActivated($email_username) {
        $query = "SELECT `users`.id, `users`.`userName`, `users`.`email` FROM `users` WHERE (`users`.`email` = ? OR `users`.`userName` = ?) AND `users`.`activation_code` IS NULL";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $email_username,$email_username);
        $stmt->execute();
        $result = $stmt->get_result();

        return count($result->fetch_all(MYSQLI_ASSOC)) !== 0;
    }

    /**
     * Function that returns the user that corresponds to the credentials entered during login.
     * 
     * @param $email_username
     *        user email/username
     * @param $password
     *        user password
     */
    public function checkLogin($email_username, $password) {
        $query = "SELECT `users`.id, `users`.`userName`, `users`.`email` FROM `users` WHERE (`users`.`email` = ? OR `users`.`userName` = ?) AND `users`.`password` = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sss', $email_username, $email_username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
        
    }

    /**
     * Function that associates a new code to the user, which is also present in the cookie and will 
     * allow him to maintain his session even after closing the browser.
     * 
     */
    public function updateSessionExtensionCode($session_extension_code, $user_id) {
        $query = "UPDATE `users` SET `cookie` = ? WHERE `users`.`id` = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $session_extension_code, $user_id);

        return $stmt->execute();
    }

    /**
     * Function that returns the user from a code associated with him and also present in a cookie in 
     * the user's browser.
     * 
     */
    public function getUsersBySessionExtensionCode($session_extension_code) {
        $query = "SELECT `users`.`id`, `users`.`userName`, `users`.`email` FROM `users` WHERE `users`.`cookie` = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $session_extension_code);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Function that returns the user corresponding to a code assigned to activate the account.
     * 
     */
    public function getUsersByActivationCode($activation_code) {
        $query = "SELECT `users`.`id`, `users`.`userName`, `users`.`email` FROM `users` WHERE `users`.`activation_code` = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $activation_code);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Function that sign up a new user into the database.
     * 
     */
    public function signUpUser($username, $name, $last_name, $email, $password, $activation_code) {
        $query = 'INSERT INTO `users`(`userName`, `name`, `lastName`, `email`, `password`, `activation_code`) VALUES (?,?,?,?,?,?)';

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssssss', $username, $name, $last_name, $email, $password, $activation_code);

        return $stmt->execute();
    }
}
?>