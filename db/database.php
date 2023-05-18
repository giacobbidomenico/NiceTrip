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
        $query = 'SELECT P.id FROM posts P, follows F WHERE F.follower = ? AND F.following = P.userId AND P.id NOT IN (SELECT V.postId FROM visualizations V WHERE V.userId = F.follower)';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $followerId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
    *   returns a user's public details
    **/
    public function getPublicUserDetails($userId, $followerId){
        if($this->checkFollow($followerId, $userId, false)){
            $query = 'SELECT U.id, U.userName, U.name, U.lastName, U.photoPath FROM users U WHERE U.id = ?';
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('s', $userId);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array();
        }
    }

    /**
    * returns the images of a given post
    **/
    public function getPostImages($postId, $followerId){
        if($this->checkFollow($followerId, $postId, true)){
            $query = 'SELECT * FROM images I WHERE I.postsId = ?';
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('s', $postId);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);        
        } else {
            return array();
        }
    }

    /**
    *   returns title, userId, description, time, date, likes number, comments number of a given post
    **/
    public function getPostDetails($postId, $followerId){
        if($this->checkFollow($followerId, $postId, true)){
            $query = 'SELECT PS.*, Comm.`commentNumber`, Likes.`likeNumber`, COUNT(LU.userId) AS liked FROM posts PS, ( SELECT P.id AS postId, COUNT(C.postsId) AS `commentNumber` FROM posts P LEFT OUTER JOIN comments C ON (C.postsId = P.id) WHERE P.id = ? GROUP BY P.id ) AS Comm, ( SELECT P.id AS postId, COUNT(L.postsId) AS `likeNumber` FROM posts P LEFT OUTER JOIN likes L ON (L.postsId = P.id) WHERE P.id = ? GROUP BY P.id ) AS Likes LEFT OUTER JOIN likes LU ON (LU.postsId = Likes.postId AND LU.userId = ?) WHERE PS.id = Likes.postId AND PS.id = Comm.postId';
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('sss', $postId, $postId, $followerId);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array();
        }
    }

    /**
    *   registers that $followerId has visualized $postId
    **/
    public function notifyVisual($postId, $followerId){
        if($this->checkFollow($followerId, $postId, true)){
            $query = 'INSERT INTO `visualizations` (`id`, `userId`, `postId`) VALUES (NULL, ?, ?);';
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ss', $followerId, $postId);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array();
        }
    }

    /**
    *   registers that $followerId reacted to $psotId post
    **/
    public function notifyLike($postId, $followerId, $register){
        if($this->checkFollow($followerId, $postId, true)){
            if($register){
                $query = 'INSERT INTO `likes` (`userId`, `postsId`) VALUES (?, ?);';
                $stmt = $this->db->prepare($query);
                $stmt->bind_param('ss', $followerId, $postId);
                $stmt->execute();
            } else {
                $query = 'DELETE FROM `likes` WHERE `likes`.`userId` = ? AND `likes`.`postsId` = ?';
                $stmt = $this->db->prepare($query);
                $stmt->bind_param('ss', $followerId, $postId);
                $stmt->execute();
            }
        }
    }


    private function checkFollow($followerId, $id, $isIdAPost){
        if($isIdAPost){
            $query = 'SELECT COUNT(F.id) FROM follows F, Posts P WHERE F.follower = ? AND P.id = ? AND P.userId = F.following';
        } else {
            $query = 'SELECT COUNT(F.id) FROM follows F WHERE F.follower = ? AND F.following = ?';
        }
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $followerId, $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return count($result->fetch_all(MYSQLI_ASSOC)) == 0? false : true;
    }

}
?>