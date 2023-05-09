<?php
function registerLoginUser($id, $email, $username) {
    $_SESSION["id"] = $id;
    $_SESSION["email"] = $email;
    $_SESSION["username"] = $username;
}
?>