<?php
    require_once 'bootstrap.php';
    $id = $_SESSION["id"];
    $userId = $_POST["followingUserId"];
    $result = $dbh->getPublicUserDetails($userId, $id);
    
    echo json_encode($result);

?>
