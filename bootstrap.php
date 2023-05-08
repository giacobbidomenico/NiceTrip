<?php
define("UPLOAD_DIR", "./upload/");
require_once("db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "nicetrip", 3306);
?>