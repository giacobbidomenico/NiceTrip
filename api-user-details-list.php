<?php
    require_once 'bootstrap.php';
    $id = $_SESSION["id"];
    $userId = json_decode($_POST["userId"]);
    if($_POST["checkFollow"] == "true"){
        $dbh = new checkFollowDecorator($dbh);
    }
    $result = $dbh->getPublicUserDetails($userId, $id);
    
    echo json_encode($result);

?>
