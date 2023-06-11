<?php

/**
 * Function that records user data in specific session variables
 * 
 * @param $id
 *        user id
 * @param $email
 *        user email
 * @param $userName
 *        user name
 */
function registerLoginUser($id, $email, $userName) {
    $_SESSION["id"] = $id;
    $_SESSION["email"] = $email;
    $_SESSION["userName"] = $userName;
}

/**
 * Function that generates a random string.
 * 
 * @param $lenght
 *        string length
 */
function random_str($length = 30) {
    return bin2hex(random_bytes($length / 2));
}

/**
 * Function that checks if user data has been entered in specific session variables
 * 
 */
function isSessionActive() {
    return isset($_SESSION["id"]) && isset($_SESSION["email"]) && isset($_SESSION["userName"]);
}
?>