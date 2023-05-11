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

    public function getPostImages($postId){
        $query = 'SELECT * FROM images I WHERE I.postsId = ?';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $postId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getFollowingUsersPosts($follower, $lastPost, $isLastPostSet){
        if($isLastPostSet){
            $query = 'SELECT P.* FROM posts P, users U, follows F WHERE U.id = "3" AND U.id = F.follower AND F.following = P.userId AND P.id > ?;';
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ss', $followingId, $lastPost);
        } else {
            $query = 'SELECT P.* FROM posts P, users U, follows F WHERE U.id = "3" AND U.id = F.follower AND F.following = P.userId ;';
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('s', $followingId);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPostStats($followingId, $lastPost, $isLastPostSet){
        if($isLastPostSet){
            $query = 'SELECT Likes.postId, Comm.`comment-number`, Likes.`like-number` FROM (SELECT P.id AS postId, Count(P.id) AS `comment-number` FROM posts P, comments C WHERE P.userId = ? AND P.id > ?  AND C.postsId = P.id GROUP BY P.id) AS Comm, (SELECT P.id AS postId, Count(P.id) AS `like-number` FROM posts P, likes L WHERE P.userId = ? AND P.id > ? AND L.postsId = P.id GROUP BY P.id) AS Likes WHERE Likes.postId = Comm.postId';
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ssss', $followingId, $lastPost, $followingId, $lastPost);
        } else {
            $query = 'SELECT Likes.postId, Comm.`comment-number`, Likes.`like-number` FROM (SELECT P.id AS postId, Count(P.id) AS `comment-number` FROM posts P, comments C WHERE P.userId = ? AND C.postsId = P.id GROUP BY P.id) AS Comm, (SELECT P.id AS postId, Count(P.id) AS `like-number` FROM posts P, likes L WHERE P.userId = ? AND L.postsId = P.id GROUP BY P.id) AS Likes WHERE Likes.postId = Comm.postId';
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ss', $followingId, $followingId);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>