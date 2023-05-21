<?php
    require_once 'bootstrap.php';
    $id = $_SESSION["id"];
    $userId = $_POST["userId"];
    $result = $dbh->getPublicUserDetails($userId, $id, $_POST["checkFollow"] == "true" ? true : false);
    
    echo json_encode($result);

?>
