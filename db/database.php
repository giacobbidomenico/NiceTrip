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
        $query = "SELECT `users`.id, `users`.`userName`, `users`.`email`, `users`.`password` FROM `users` WHERE `users`.`email` = ? OR `users`.`userName` = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $email_username, $email_username);
        $stmt->execute();
        $result = $stmt->get_result();
        $match = $result->fetch_all(MYSQLI_ASSOC);
        if(isset($match[0]["password"])) {
            if(!password_verify($password, $match[0]["password"])) {
                return array();
            }
        }

        return $match;   
    }

    /**
    *  Function returns the followed users' posts id, sorteded starting from the most recent.
    *  @param $followerId - id of the followed user
    */
    public function getFollowsPosts($followerId){
        $query = 'SELECT P.id FROM posts P, follows F WHERE F.follower = ? AND F.following = P.userId AND P.id NOT IN (SELECT V.postId FROM visualizations V WHERE V.userId = F.follower)';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $followerId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
    *  Function that returns a list of posts of a given user.
    *  @param $userId - id of the given user
    */
    public function getUserPosts($userId){
        $query = 'SELECT P.id FROM posts P WHERE P.userId = ?';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
    *  Function that returns a user's public details.
    *  @param $userId - id of the user requesting the data
    *  @param $followerId - id of the user to get details of
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
     * Function that returns the images of a given post.
     * @param $postId - id of the post to get images of
     * @param $followerId - id of the user requesting the data
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
     * Function that returns title, userId, description, time, date, likes number, comments number of a given post.
     * @param $postId - id of the post to get details of
     * @param $followerId - id of the user requesting the data
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
     * Function that registers a post visualization.
     * @param $postId - id of the post visualized
     * @param $followerId - id of the user 
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
     * Function that registers a like to a post.
     * @param $postId - id of the post liked
     * @param $followerId - id of the user 
     * @param $register - true to register like, false to delete
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

    /*
     * Function that associates a new code to the user, which is also present in the cookie and will 
     * allow him to maintain his session even after closing the browser.
     * 
     * @param $session_extension_code
     *        code to restore the session after closing the browser through a cookie
     * @param $user_id
     *        user id
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
     * @param $session_extension_code
     *        code to restore the session after closing the browser through a cookie
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
     * @param $activation_code
     *        activation code
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
     * @param $username
     *        user username
     * @param $name
     *        user name
     * @param $last_name
     *        user last name
     * @param $email
     *        user email
     * @param $password
     *        user password
     * @param $activation_code
     *        user activation code
     */
    public function signUpUser($username, $name, $last_name, $email, $password, $activation_code) {
        $query = 'INSERT INTO `users`(`userName`, `name`, `lastName`, `email`, `password`, `activation_code`) VALUES (?,?,?,?,?,?)';

        $stmt = $this->db->prepare($query);
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt->bind_param('ssssss', $username, $name, $last_name, $email, $hash, $activation_code);

        return $stmt->execute();
    }

    /**
     * Function that takes care of activating an account.
     * 
     * @param $activation_code
     *        activation code
     */
    public function activateAccount($activation_code) {
        $query = "UPDATE `users` SET `activation_code` = NULL WHERE `users`.`activation_code` = ?";
        
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $activation_code);

        return $stmt->execute();
    }
}
?>