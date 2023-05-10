<?php

define("TIME_SESSION_EXTENSION", "");

function registerLoginUser($id, $email, $username) {
    $_SESSION["id"] = $id;
    $_SESSION["email"] = $email;
    $_SESSION["username"] = $username;
}

function random_str($length = 30) {
    return bin2hex(random_bytes($length / 2));
}
?>