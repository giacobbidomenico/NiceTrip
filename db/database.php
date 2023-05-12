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

    public function checkLogin($email_username, $password) {
        $query = "SELECT `users`.id, `users`.`email`, `users`.`userName` FROM `users` WHERE (`users`.`email` = ? OR `users`.`userName` = ?) AND `users`.`password` = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sss', $email_username, $email_username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
    *   returns the followed users' posts id, sorteded starting from the most recent
    **/
    public function getPostToVisualizeId($followerId){
        $query = '';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $followerId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
    *   returns a user's public details
    **/
    public function getPublicUserDetails($userId){
        $query = '';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $followerId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
    * returns the images of a given post
    **/
    public function getPostImages($followerId){
        $query = '';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $followerId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
    *   returns title, userId, description, time, date, likes number, comments number of a given post
    **/
    public function getPostDetails(){
        $query = '';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $followerId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>