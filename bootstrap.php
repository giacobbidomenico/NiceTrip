<?php

session_start();

define("UPLOAD_DIR", "./upload/");

require_once "db/database.php";

$dbh = new DatabaseHelper("localhost", "root", "", "nicetrip", 3306);

require_once "utils/functions.php";

if(isset($_COOKIE["session-extension-code"]) && !isSessionActive()) {
    $result = $dbh->getUsersBySessionExtensionCode($_COOKIE["session-extension-code"]);

    if(isset($result[0]["id"]) && isset($result[0]["email"]) && isset($result[0]["userName"])) {
        registerLoginUser($result[0]["id"], $result[0]["email"], $result[0]["userName"]);
    }
}

?>