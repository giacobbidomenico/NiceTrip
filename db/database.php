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


    public function getFollowingUserDetails($followerName){
        $query = 'SELECT F.*,UF.* FROM users U, follows F, users UF WHERE U.id = ? AND U.id = F.follower AND F.following = UF.id';

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $followerName);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPostImages($followerId){
        $query = 'SELECT I.* FROM images I, posts P, follows F WHERE F.follower = ? AND P.id > IFNULL(F.lastPost,-1) AND I.postsId = P.id';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $postId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getFollowingUsersPosts($follower){
        $query = 'SELECT P.* FROM posts P, follows F WHERE F.follower = ? AND F.following = P.userId AND P.id > IFNULL(F.lastPost,-1);';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $followingId);

        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPostStats($follower){
        $query = 'SELECT  Likes.userId, Likes.postId, Comm.`comment-number`, Likes.`like-number` FROM ( SELECT F.following AS UserId, P.id AS postId, COUNT(C.postsId) AS `comment-number` FROM follows F JOIN posts P ON (F.following = P.userId) LEFT OUTER JOIN comments C ON (C.postsId = P.id) WHERE F.follower = ? AND P.id > IFNULL(F.lastPost,-1) GROUP BY F.following, P.id ) AS Comm, ( SELECT F.following AS UserId, P.id AS postId, COUNT(L.postsId) AS `like-number` FROM follows F JOIN posts P ON (F.following = P.userId) LEFT OUTER JOIN likes L ON (L.postsId = P.id) WHERE F.follower = ? AND P.id > IFNULL(F.lastPost,-1) GROUP BY F.following, P.id ) AS Likes WHERE Likes.postId = Comm.postId;';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $follower, $follower);
        
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>