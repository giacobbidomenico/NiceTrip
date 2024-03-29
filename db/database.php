<?php
/**
* Represents every interaction with database
*/
abstract class DatabaseHelper
{
    private $db;

    abstract public function prepareStmt($query);

    /**
     * Check if email/username matches a user's account.
     * 
     * @param $email_username
     *        user email/username       
     */
    abstract public function checkEmailOrUsername($email_username);

    /**
     * Check if email/username matches a user's account.
     * 
     * @param $email
     *        user email
     */
    abstract public function checkEmail($email);

    /**
     * Check if username matches a user's account.
     * 
     * @param $username
     *        user username
     */
    abstract public function checkUsername($username);

    /**
     * Function that check if the user's account has been activated, by seeing if the activation_code field is NULL
     * 
     * @param $email_username
     *        user email/username
     */
    abstract public function isAccountActivated($email_username);

    /**
     * Function that returns the user that corresponds to the credentials entered during login.
     * 
     * @param $email_username
     *        user email/username
     * @param $password
     *        user password
     */
    abstract public function checkLogin($email_username, $password);

    /**
    *  Function returns the followed users' posts id, sorteded starting from the most recent.
    *  @param $followerId - id of the followed user
    */
    abstract public function getFollowsPosts($followerId);

    /**
    *  Function that returns a list of posts of a given user.
    *  @param $userId - id of the given user
    */
    abstract public function getUserPosts($userId);

    /**
    *  Function that sends a request to database to delete a post.
    *  @param $postId - post to be deleted.
    */
    abstract public function deletePost($postId);

    /**
    *  Function that returns a user's public details.
    *  @param $userId - id of the user requesting the data
    *  @param $followerId - id of the user to get details of
    **/
    abstract public function getPublicUserDetails($usersId, $followerId);

     /**
     * Function that returns the images of a given post.
     * @param $postId - id of the post to get images of
     * @param $followerId - id of the user requesting the data
     **/
    abstract public function getPostImages($postId, $followerId);

    /**
     * Function that returns title, userId, description, time, date, likes number, comments number of a given post.
     * @param $postId - id of the post to get details of
     * @param $followerId - id of the user requesting the data
     **/
    abstract public function getPostDetails($postId, $followerId);

    /**
     * Function that registers a post visualization.
     * @param $postId - id of the post visualized
     * @param $followerId - id of the user 
     **/
    abstract public function notifyVisual($postId, $followerId);

    /**
     * Registers a like if absent, deletes it if present
     * @param $postId - id of the post liked
     * @param $followerId - id of the user 
     **/
    abstract public function notifyLike($postId, $followerId);

    /**
     * Function that registers a follow.
     * @param $followerId - id of the follower
     * @param $followId - id of the user to be followed
     * @param $register - true to register follow, false to delete
     **/
    abstract public function changeFollowState($followerId, $followId, $register);

    /*
     * Function that associates a new code to the user, which is also present in the cookie and will 
     * allow him to maintain his session even after closing the browser.
     * 
     * @param $session_extension_code
     *        code to restore the session after closing the browser through a cookie
     * @param $userId
     *        user id
     */
    abstract public function updateSessionExtensionCode($session_extension_code, $userId);

    /**
     * Function that returns the user from a code associated with him and also present in a cookie in 
     * the user's browser.
     * 
     * @param $session_extension_code
     *        code to restore the session after closing the browser through a cookie
     */
    abstract public function getUsersBySessionExtensionCode($session_extension_code);

    /**
     * Function that returns the user corresponding to a code assigned to activate the account.
     * 
     * @param $activation_code
     *        activation code
     */
    abstract public function getUsersByActivationCode($activation_code);

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
    abstract public function signUpUser($username, $name, $last_name, $email, $password, $activation_code);

    /**
     * Function that takes care of activating an account.
     * 
     * @param $activation_code
     *        activation code
     */
    abstract public function activateAccount($activation_code);

    /**
    *  Function that returns a list of followers (id, profile image, name)
    *  @param $userId - id of the user to get followers of 
    */
    abstract public function getFollowers($userId);

    /**
    *  Function that returns a list of followers (id, profile image, name)
    *  @param $userId - id of the user to get follow of 
    */
    abstract public function getFollows($userId);

    /**
    *  Function that returns comments of a post.
    *  @param $postId - id of the post to get comments of
    */
    abstract public function getComments($ids);

    /**
    *  Function that registers a comment.
    *  @param $postId - post to register the comment to
    *  @param $userId - id of the author of the comment
    *  @return the id of the comment registered
    */
    abstract public function setComment($postId, $userId, $date, $time, $description);

    /**
    *  Function that deletes a comment.
    *  @param $id - id of the post to be deleted
    */
    abstract public function deleteComment($id);

    /**
    *  Function that returns a list of comments id, ordered by Date and time of publication.
    *  @param $postId - id of the post to get comments of
    */
    abstract public function getListOfCommentsId($postId);

    /**
    *  Function that returns a list of posts which title contains all tokens given.
    *  @param $tokens - tokens to be matched
    */
    abstract public function getPostsFromTitle($tokens);

    /**
    *  Function that returns a list of users id whose name or username matches the one given.
    *  @param $name - name to be searched
    */
    abstract public function getUsersByMatch($name);

    /**
    *  Function that returns a random list of users id.
    *  @param $number - number of rows to get
    *  @param $userId - user to exclude from the list
    */
    abstract public function getRandomUsersId($number, $userId);

    /**
     * Function that takes care of inserting a new post into the db.
     * @param $title - title of the post
     * @param $description - description of the post
     * @param $userId - id of the user who publishes the post
     */
    abstract public function publishPost($title, $description, $userId);

    /**
     * Function that inserts one of the images belonging to the post.
     * @param $postId - id of the post the image refers to
     * @param $name - image filename
     */
    abstract public function insertImage($postId, $name);

    /**
     * Function that inserts one of the destinations belonging to post.
     * @param $description name with description of the destination
     * @param $postId id of the post to which the destination refers
     */
    abstract public function insertDestination($description, $postId);

    /**
     * Function that inserts a new generic notification into the database.
     * @param $type - type of notification
     * @param $senderId - id of the user performing the event to which the notification is associated
     * @param $receiverId - id of the user who will receive the notification
     * @param $postId - id of the post to which the notification is possibly associated
     */
    abstract public function insertNotification($type, $senderId, $receiverId, $postId);

    /**
     * Function that inserts a like notification into the database.
     * @param $postId - id of the post liked
     * @param $userId - id of the user liking the post
     */
    abstract public function insertLikeNotification($postId, $userId);

    /**
     * Function that inserts a follow notification into the database.
     * @param $senderId - id of the user who starts following
     * @param $receiverId - id of the user being followed
     */
    abstract public function insertFollowNotification($senderId, $receiverId);

    /**
     * Function that returns notifications of a specific user.
     * @param $userId - user id
     */
    abstract public function getUserNotifications($userId);

    /**
     * Function that returns notifications of a specific user that have not yet been sent via email.
     * @param $userId - user id
     */
    abstract public function getUserNotificationsNotSent($userId);

    /**
    *  Function that updates the username of a given user
    *  @param $userId - id of the user to update
    *  @param $newUserName - new name to update
    */
    abstract public function editUserName($userId, $newUserName);

    /**
    *  Function that updates the email of a given user
    *  @param $userId - id of the user to update
    *  @param $newEmail - new email to update
    */
    abstract public function editUserEmail($userId, $newEmail);

    /**
    *  Functin that updates the password of a given user
    *  @param $userId - id of the user to update
    *  @param $newPassword - new passord
    */
    abstract public function editUserPassword($userId, $newPassword);
    
    /**
    *  Functin that updates the profile image of a given user
    *  @param $userId - id of the user to update
    *  @param $imageName - name of the new image
    */
    abstract public function editUserImageProfile($userId, $imageName);

    /**
     * Function that returns a user's email address.
     * @param $userId - user id
     */
    abstract public function getEmailFromUserId($userId);

    /**
     * Function that deletes the notifications of a specific user.
     * @param $userId - user id
     */
    abstract public function deleteUserNotifications($userId);

    /**
     * Function that returns a user's notifications sent via email.
     * @param $userId - user id
     */
    abstract public function notificationsSent($userId);

    /**
    *  Function that returns the list of destination of a post.
    *  @param $postId - id of the post
    */
    abstract public function getPostItinerary($postId);
}

/**
* Implements DatabaseHelper
*/
class ConcreteDatabaseHelper extends DatabaseHelper{

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

    public function prepareStmt($query)
    {
        return $this->db->prepare($query);
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
    *  @param $usersId - array of id of the users to get
    *  @param $followerId - id of the user requesting the data
    **/
    public function getPublicUserDetails($usersId, $followerId){
        $query = 'SELECT U.id, U.userName, U.name, U.lastName, U.photoPath, U.email, (F.id IS NOT NULL) AS follow FROM users U LEFT OUTER JOIN follows F ON (F.follower = ? AND F.following = U.id)  WHERE U.id IN (?'.str_repeat(", ?", is_array($usersId)? count($usersId)-1 : 0).')';
        $stmt = $this->db->prepare($query);
        if(is_array($usersId)){
            $stmt->bind_param(str_repeat("s", count($usersId)+1 ), $followerId, ...$usersId);
        } else {
            $stmt->bind_param("ss", $followerId, $usersId);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
    *  Function that sends a request to database to delete a post.
    *  @param $postId - post to be deleted.
    */
    public function deletePost($postId){
        $queries = ['DELETE FROM likes WHERE `likes`.`postsId` = ?;',
        'DELETE FROM images WHERE `images`.`postsId` = ?;',
        'DELETE FROM comments WHERE `comments`.`postsId` = ?;',
        'DELETE FROM destinations WHERE `destinations`.`post_Id` = ?;',
        'DELETE FROM visualizations WHERE `visualizations`.`postId` = ?;',
        'DELETE FROM `posts` WHERE `posts`.`id` = ?;'];
        $result = [];
        foreach ($queries as $query){
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('s', $postId);
            $stmt->execute();
            array_push($result, $stmt->errno);
        }
        return $result;
    }

    /**
     * Function that returns the images of a given post.
     * @param $postId - id of the post to get images of
     * @param $followerId - id of the user requesting the data
     **/
    public function getPostImages($postId, $followerId){
        $query = 'SELECT * FROM images I WHERE I.postsId = ?';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $postId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);        
    }

    /**
     * Function that returns title, userId, description, time, date, likes number, comments number of a given post.
     * @param $postId - id of the post to get details of
     * @param $followerId - id of the user requesting the data
     **/
    public function getPostDetails($postId, $followerId){
        $query = 'SELECT PS.*, Comm.`commentNumber`, Likes.`likeNumber`, COUNT(LU.userId) AS liked FROM posts PS, ( SELECT P.id AS postId, COUNT(C.postsId) AS `commentNumber` FROM posts P LEFT OUTER JOIN comments C ON (C.postsId = P.id) WHERE P.id = ? GROUP BY P.id ) AS Comm, ( SELECT P.id AS postId, COUNT(L.postsId) AS `likeNumber` FROM posts P LEFT OUTER JOIN likes L ON (L.postsId = P.id) WHERE P.id = ? GROUP BY P.id ) AS Likes LEFT OUTER JOIN likes LU ON (LU.postsId = Likes.postId AND LU.userId = ?) WHERE PS.id = Likes.postId AND PS.id = Comm.postId';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sss', $postId, $postId, $followerId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Function that registers a post visualization.
     * @param $postId - id of the post visualized
     * @param $followerId - id of the user 
     **/
    public function notifyVisual($postId, $followerId){
        $query = 'INSERT INTO `visualizations` (`id`, `userId`, `postId`) VALUES (NULL, ?, ?);';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $followerId, $postId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Registers a like if absent, deletes it if present
     * @param $postId - id of the post liked
     * @param $followerId - id of the user 
     **/
    public function notifyLike($postId, $followerId){
        $query = 'SELECT * FROM `likes` L WHERE L.userId = ? AND L.postsId = ?';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $followerId, $postId);
        $stmt->execute();
        if(count($stmt->get_result()->fetch_all(MYSQLI_ASSOC))){
            $query = 'DELETE FROM `likes` WHERE `likes`.`userId` = ? AND `likes`.`postsId` = ?';
            $result["insert"] = false;
        } else {
            $query = 'INSERT INTO `likes` (`userId`, `postsId`) VALUES (?, ?);';
            $result["insert"] = true;
        }
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $followerId, $postId);
        $stmt->execute();
        $stmt = $this->db->prepare("SELECT L.postsId, COUNT(L.postsId) number FROM likes L WHERE L.postsId = ? ");
        $stmt->bind_param('s', $postId);
        $stmt->execute();
        $result["likes"] = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    /**
     * Function that registers a follow.
     * @param $followerId - id of the follower
     * @param $followId - id of the user to be followed
     * @param $register - true to register follow, false to delete
     **/
    public function changeFollowState($followerId, $followId, $register){
        if($register){
            $query = 'INSERT INTO `follows` (`id`, `follower`, `following`) VALUES (NULL, ?, ?);';
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ss', $followerId, $followId);
            $stmt->execute();
        } else {
            $query = 'DELETE FROM `follows` WHERE `follows`.`follower` = ? AND `follows`.`following` = ?';
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ss', $followerId, $followId);
            $stmt->execute();
        }
    }

    /*
     * Function that associates a new code to the user, which is also present in the cookie and will 
     * allow him to maintain his session even after closing the browser.
     * 
     * @param $session_extension_code
     *        code to restore the session after closing the browser through a cookie
     * @param $userId
     *        user id
     */
    public function updateSessionExtensionCode($session_extension_code, $userId) {
        $query = "UPDATE `users` SET `cookie` = ? WHERE `users`.`id` = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $session_extension_code, $userId);

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
        $query = 'INSERT INTO `users`(`userName`, `name`, `lastName`, `email`, `password`, `activation_code`, `photoPath`) VALUES (?,?,?,?,?,?, "genericProfilePhoto.jpg")';

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

    /**
    *  Function that returns a list of followers (id, profile image, name)
    *  @param $userId - id of the user to get followers of 
    */
    public function getFollowers($userId){
        $query = "SELECT U.id, U.userName, U.photoPath FROM follows F, users U WHERE F.following = ? AND U.id = F.follower";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
    *  Function that returns a list of followers (id, profile image, name)
    *  @param $userId - id of the user to get follow of 
    */
    public function getFollows($userId){
        $query = "SELECT U.id, U.userName, U.photoPath FROM follows F, users U WHERE F.follower = ? AND U.id = F.following";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
    *  Function that registers a comment.
    *  @param $postId - post to register the comment to
    *  @param $userId - id of the author of the comment
    *  @return the id of the comment registered
    */
    public function setComment($postId, $userId, $date, $time, $description){
        $query = "INSERT INTO `comments` (`id`, `description`, `date`, `time`, `postsId`, `userId`) VALUES (NULL, ?, ?, ?, ?, ?); ";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssss', $description, $date, $time, $postId, $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $stmt->insert_id;
    }

    /**
    *  Function that returns a list of comments id, ordered by Date and time of publication.
    *  @param $postId - id of the post to get comments of
    */
    public function getListOfCommentsId($postId)
    {
        $query = "SELECT C.id FROM `comments` C WHERE C.postsId = ? ORDER BY C.date DESC, C.time DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $postId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
    *  Function that deletes a comment.
    *  @param $id - id of the post to be deleted
    */
    public function deleteComment($id){
        $query = 'DELETE FROM `comments` WHERE `comments`.`id` = ?';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }

    public function getComments($ids)
    {
        $query = 'SELECT C.id, C.description, C.date, C.time, C.userId FROM `comments` C WHERE C.id IN(?'.str_repeat(", ?", is_array($ids)? count($ids)-1 : 0).') ORDER BY C.date DESC, C.time DESC';
        $stmt = $this->db->prepare($query);
        if(is_array($ids)){
            $stmt->bind_param(str_repeat("s", count($ids)), ...$ids);
        } else {
            $stmt->bind_param("s", $ids);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }


    /**
    *  Function that returns a list of posts which title contains all tokens given.
    *  @param $tokens - tokens to be matched
    */
    public function getPostsFromTitle($tokens)
    {
        $query = 'SELECT P.id FROM posts P WHERE P.title LIKE ? '.str_repeat("AND  P.title LIKE ?", is_array($tokens)? count($tokens)-1 : 0).';';
        $stmt = $this->db->prepare($query);
        if(is_array($tokens)){
            $vars = array_map(fn($token) => "%".$token."%", $tokens);
            $stmt->bind_param(str_repeat("s", count($vars)), ...$vars);
        } else {
            $var = "%".$tokens."%";
            $stmt->bind_param("s", $var);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Function that takes care of inserting a new post into the db.
     * @param $title - title of the post
     * @param $description - description of the post
     * @param $userId - id of the user who publishes the post
     */
    public function publishPost($title, $description, $userId) {
        $query = 'INSERT INTO `posts`(`id`, `title`, `description`, `userId`, `time`, `date`) VALUES (NULL, ?, ?, ?, CURRENT_TIME(), CURRENT_DATE());';

        $stmt = $this->db->prepare($query);

        $stmt->bind_param('sss', $title, $description, $userId);

        if(!$stmt->execute()) {
            die("Error in post publication");
        }
        return $stmt->insert_id;
    }

    /**
     * Function that inserts one of the images belonging to the post.
     * @param $postId - id of the post the image refers to
     * @param $name - image filename
     */
    public function insertImage($postId, $name) {
        $query = 'INSERT INTO `images` (`id`, `postsId`, `name`) VALUES (NULL, ?, ?);';

        $stmt = $this->db->prepare($query);

        $stmt->bind_param('ss', $postId, $name);

        return $stmt->execute();
    }

    /**
     * Function that inserts one of the destinations belonging to post.
     * @param $description name with description of the destination
     * @param $postId id of the post to which the destination refers
     */
    public function insertDestination($description, $postId) {
        $query = 'INSERT INTO `destinations`(`id`, `description`, `post_id`) VALUES (NULL, ?, ?);';

        $stmt = $this->db->prepare($query);

        $stmt->bind_param('ss', $description, $postId);
        
        return $stmt->execute();
    }


    /**
    *  Function that returns a list of users id whose name or username matches the one given.
    *  @param $name - name to be searched
    */
    public function getUsersByMatch($name)
    {
        $query = 'SELECT U.id FROM users U WHERE U.name LIKE ? OR U.userName LIKE ? OR U.lastName LIKE ?';
        $stmt = $this->db->prepare($query);
        $param = "%".$name."%";
        $stmt->bind_param("sss", $param, $param, $param);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }


    /**
    *  Function that returns a random list of users id.
    *  @param $number - number of rows to get
    *  @param $userId - user to exclude from the list
    */
    public function getRandomUsersId($number, $userId)
    {
        $query = 'SELECT U.id FROM users U WHERE U.id != ? ORDER BY RAND() LIMIT ?';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $userId, $number);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
    *  Function that updates the username of a given user
    *  @param $userId - id of the user to update
    *  @param $newUserName - new name to update
    */
    public function editUserName($userId, $newUserName){
        $query = 'UPDATE `users` SET `userName` = ? WHERE `users`.`id` = ?;';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $newUserName, $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }

   /**
    *  Function that updates the email of a given user
    *  @param $userId - id of the user to update
    *  @param $newEmail - new email to update
    */
    public function editUserEmail($userId, $newEmail){
        $query = 'UPDATE `users` SET `email` = ? WHERE `users`.`id` = ?;';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $newEmail, $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }

    /**
    *  Functin that updates the password of a given user
    *  @param $userId - id of the user to update
    *  @param $newPassword - new passord
    */
    public function editUserPassword($userId, $newPassword){
        $query = 'UPDATE `users` SET `password` = ? WHERE `users`.`id` = ?; ';
        $stmt = $this->db->prepare($query);
        $hash = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt->bind_param("ss", $hash, $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }

    /**
    *  Functin that updates the profile image of a given user
    *  @param $userId - id of the user to update
    *  @param $imageName - name of the new image
    */
    public function editUserImageProfile($userId, $imageName){
        $query = 'UPDATE `users` SET `photoPath` = ? WHERE `users`.`id` = ?;';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $imageName, $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }

    /**
     * Function that returns a user's email address.
     * @param $userId - user id
     */
    public function getEmailFromUserId($userId) {
        $query = 'SELECT `users`.`email` FROM `users` WHERE `users`.`id` = ?;';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }


    /**
     * Function that inserts a new generic notification into the database.
     * @param $type - type of notification
     * @param $senderId - id of the user performing the event to which the notification is associated
     * @param $receiverId - id of the user who will receive the notification
     * @param $postId - id of the post to which the notification is possibly associated
     */
    public function insertNotification($type, $senderId, $receiverId, $postId = NULL) {
        $query = 'INSERT INTO `notifications`(`id`, `type`, `senderId`, `receiverId`, `postId`, `datetime`, `sent`) VALUES (NULL,?,?,?,?,CURRENT_TIMESTAMP,0)';

        $stmt = $this->db->prepare($query);

        $stmt->bind_param('ssss', $type, $senderId, $receiverId, $postId);
        
        $stmt->execute();

        return $this->getEmailFromUserId($receiverId)[0]["email"];
    }

    /**
     * Function that inserts a like notification into the database.
     * @param $postId - id of the post liked
     * @param $userId - id of the user liking the post
     */
    public function insertLikeNotification($postId, $userId) {
        $receiverId = $this->getPostDetails($postId, $userId)[0]["userId"];
        return $this->insertNotification(1, $userId, $receiverId, $postId);
    }

    public function insertCommentNotification($postId, $userId) {
        $receiverId = $this->getPostDetails($postId, $userId)[0]["userId"];
        return $this->insertNotification(2, $userId, $receiverId, $postId);
    }

    /**
     * Function that inserts a follow notification into the database.
     * @param $senderId - id of the user who starts following
     * @param $receiverId - id of the user being followed
     */
    public function insertFollowNotification($senderId, $receiverId) {
        return $this->insertNotification(3, $senderId, $receiverId);
    }

    /**
     * Function that returns notifications of a specific user.
     * @param $userId - user id
     */
    public function getUserNotifications($userId) {
        $query = 'SELECT `notifications`.`type`,`notifications`.`postId`, `notifications`.`datetime`, `users`.`userName` FROM `notifications`, `users` WHERE `notifications`.`receiverId` = ? AND `users`.`id` = `notifications`.`senderId`;';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Function that returns notifications of a specific user that have not yet been sent via email.
     * @param $userId - user id
     */
    public function getUserNotificationsNotSent($userId) {
        $query = 'SELECT `notifications`.`type`,`notifications`.`postId`, `notifications`.`datetime`, SENDERS.`userName`, RECEIVERS.`email` AS emailReceiver FROM `notifications`, `users` AS SENDERS,`users` AS RECEIVERS WHERE SENDERS.`id` = `notifications`.`senderId` AND RECEIVERS.`id` = `notifications`.`receiverId` AND `notifications`.`senderId` = ? AND `notifications`.`sent` = 0;';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Function that deletes the notifications of a specific user.
     * @param $userId - user id
     */
    public function deleteUserNotifications($userId) {
        $query = 'DELETE FROM `notifications` WHERE `notifications`.`receiverId` = ?';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $userId);
        return $stmt->execute();
    }

    /**
     * Function that returns a user's notifications sent via email.
     * @param $userId - user id
     */
    public function notificationsSent($userId) {
        $query = 'UPDATE `notifications` SET `sent`= 1 WHERE `notifications`.`senderId` = ?;';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $userId);
        return $stmt->execute();
    }

    public function getPostItinerary($postId){
        $query = 'SELECT `id`, `description`, `post_id` FROM `destinations` WHERE `destinations`.`post_id` = ?';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $postId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

}

/**
* Represents a decorator for a DatabaseHelper
*/
abstract class DatabaseHelperDecorator extends DatabaseHelper
{
    protected $databaseHelper;
}

/**
* Decorates a DatabaseHelper by checking whether the requested data concerns a followed user
*/
class checkFollowDecorator extends DatabaseHelperDecorator
{
    
    public function __construct($databaseHelper)
    {
        $this->databaseHelper = $databaseHelper;
    }

    private function checkFollow($followerId, $id)
    {
        $query = 'SELECT U.id, (F.id IS NOT NULL) AS follow FROM users U LEFT OUTER JOIN follows F ON (U.id = F.following AND F.follower = ?) WHERE U.id IN  (?'.str_repeat(", ?", is_array($id)? count($id)-1 : 0).')';
        $stmt = $this->prepareStmt($query);
        if(is_array($id)){
            $stmt->bind_param(str_repeat("s", count($id)+1 ), $followerId, ...$id);
        } else {
            $stmt->bind_param("ss", $followerId, $id);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    private function checkFollowPost($followerId, $id)
    {
        $query = 'SELECT COUNT(F.id) FROM follows F, Posts P WHERE F.follower = ? AND P.id = ? AND P.userId = F.following';
        $stmt = $this->prepareStmt($query);
        $stmt->bind_param('ss', $followerId, $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return count($result->fetch_all(MYSQLI_ASSOC)) == 0? false : true;
    }

    private function checkIfOwnComment($commentId)
    {
        $commentDetails = $this->databaseHelper->getComments($commentId);
        return $commentDetails[0]["userId"] == $_SESSION["id"];
    }

    private function checkIfOwnPost($postId)
    {
        $postDetails = $this->databaseHelper->getPostDetails($postId, $_SESSION["id"]);
        return $postDetails[0]["userId"] == $_SESSION["id"];
    }

    public function getListOfCommentsId($postId)
    {
        return $this->databaseHelper->getListOfCommentsId($postId);
    }

    /**
    *  Function that deletes a comment.
    *  @param $id - id of the post to be deleted
    */
    public function deleteComment($id)
    {
        if($this->checkIfOwnComment($id)){
            return $this->databaseHelper->deleteComment($id);
        } else {
            return [];
        }
    }


    public function setComment($postId, $userId, $date, $time, $description)
    {
        return $this->databaseHelper->setComment($postId, $userId, $date, $time, $description);
    }


    public function getComments($ids)
    {
        return $this->databaseHelper->getComments($ids);
    }

    public function prepareStmt($query)
    {
        return $this->databaseHelper->prepareStmt($query);
    }

    public function checkEmailOrUsername($email_username)
    {
        return $this->databaseHelper->checkEmailOrUsername($email_username);
    }

    public function checkEmail($email)
    {
        return $this->databaseHelper->checkEmail($email);
    }

    public function checkUsername($username)
    {
        return $this->databaseHelper->checkUsername($username);
    }

    public function isAccountActivated($email_username)
    {
        return $this->databaseHelper->isAccountActivated($email_username);
    }

    public function checkLogin($email_username, $password)
    {
        return $this->databaseHelper->checkLogin($email_username, $password);
    }
    
    public function getFollowsPosts($followerId)
    {
        return $this->databaseHelper->getFollowsPosts($followerId);
    }

    public function getUserPosts($userId)
    {
        return $this->databaseHelper->getUserPosts($userId);
    }

    public function getPublicUserDetails($usersId, $followerId)
    {
        
        if(array_reduce($this->checkFollow($followerId, $usersId), fn($carry, $value) => $carry = $value["follow"] == 0 ? false : $carry, $carry = true)){
            return $this->databaseHelper->getPublicUserDetails($usersId, $followerId);
        }
        return [];
    }

    public function getPostImages($postId, $followerId)
    {
        if($this->checkFollowPost($postId, $followerId)){
            return $this->databaseHelper->getPostImages($postId, $followerId);
        }
        return array();
    }

    public function deletePost($postId){
        if($this->checkIfOwnPost($postId)){
            return $this->databaseHelper->deletePost($postId);
        }
        return [];
    }

    public function getPostDetails($postId, $followerId)
    {
        if($this->checkFollowPost($followerId, $postId)){
            return $this->databaseHelper->getPostDetails($postId, $followerId);
        }
        return [];
    }

    public function notifyVisual($postId, $followerId)
    {
        if($this->checkFollowPost($postId, $followerId)){
            return $this->databaseHelper->notifyVisual($postId, $followerId);
        }
        return [];
    }

    public function notifyLike($postId, $followerId)
    {
        if($this->checkFollowPost($postId, $followerId)){
            return $this->databaseHelper->notifyLike($postId, $followerId);
        }
        return [];
    }

    public function changeFollowState($followerId, $followId, $register)
    {
        return $this->databaseHelper->changeFollowState($followerId, $followId, $register);
    }

    public function updateSessionExtensionCode($session_extension_code, $userId)
    {
        return $this->databaseHelper->updateSessionExtensionCode($session_extension_code, $userId);
    }

    public function getUsersBySessionExtensionCode($session_extension_code)
    {
        return $this->databaseHelper->getUsersBySessionExtensionCode($session_extension_code);
    }

    public function getUsersByActivationCode($activation_code)
    {
        return $this->databaseHelper->getUsersByActivationCode($activation_code);
    }

    public function signUpUser($username, $name, $last_name, $email, $password, $activation_code)
    {
        return $this->databaseHelper->signUpUser($username, $name, $last_name, $email, $password, $activation_code);
    }

    public function activateAccount($activation_code)
    {
        return $this->databaseHelper->activateAccount($activation_code);
    }

    public function getFollowers($userId)
    {
        return $this->databaseHelper->getFollowers($userId);
    }

    public function getFollows($userId)
    {
        return $this->databaseHelper->getFollows($userId);
    }

    public function getPostsFromTitle($tokens)
    {
        return $this->databaseHelper->getPostsFromTitle($tokens);
    }

    public function getUsersByMatch($name){
        return $this->databaseHelper->getUsersByMatch($name);
    }

    public function getRandomUsersId($number, $userId)
    {
        return $this->databaseHelper->getRandomUsersId($number, $userId);
    }

    public function publishPost($title, $description, $userId) {
        return $this->databaseHelper->publishPost($title, $description, $userId);
    }

    public function insertImage($postId, $name) {
        return $this->databaseHelper->insertImage($postId, $name);
    }

    public function insertDestination($description, $postId) {
        return $this->databaseHelper->insertDestination($description, $postId);
    }

    public function insertNotification($type, $senderId, $receiverId, $postId) {
        return $this->databaseHelper->insertNotification($type, $senderId, $receiverId, $postId);
    }

    public function insertLikeNotification($postId, $userId) {
        return $this->databaseHelper->insertLikeNotification($postId, $userId);
    }

    public function insertCommentNotification($postId, $userId) {
        return $this->databaseHelper->insertCommentNotification($postId, $userId);
    }

    public function editUserName($userId, $newUserName){
        return $this->databaseHelper->editUserName($userId, $newUserName);
    }

    public function editUserEmail($userId, $newEmail){
        return $this->databaseHelper->editUserEmail($userId, $newEmail);
    }

    public function editUserPassword($userId, $newPassword){
        return $this->databaseHelper->editUserPassword($userId, $newPassword);
    }

    public function editUserImageProfile($userId, $imageName){
        return $this->databaseHelper->editUserImageProfile($userId, $imageName);
    }

    public function insertFollowNotification($senderId, $receiverId) {
        return $this->databaseHelper->insertFollowNotification($postId, $receiverId);
    }

    public function getEmailFromUserId($userId) {
        return $this->databaseHelper->getEmailFromUserId($userId);
    }

    public function deleteUserNotifications($userId) {
        return $this->databaseHelper->deleteUserNotifications($userId);
    }

    public function getUserNotifications($userId) {
        return $this->databaseHelper->getUserNotifications($userId);
    }
    
    public function getUserNotificationsNotSent($userId) {
        return $this->databaseHelper->getUserNotificationsNotSent($userId);
    }

    public function notificationsSent($userId) {
        return $this->databaseHelper->notificationSent($userId);
    }

    public function getPostItinerary($postId){
        return $this->databaseHelper->getPostItinerary($postId);
    }

}
?>