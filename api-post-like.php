<?php
    require_once 'bootstrap.php';
    $id = $_SESSION["id"];
    $postId = $_POST["postId"];
    $result = $dbh->notifyLike($postId, $id);
    $dbh->insertLikeNotification($postId, $id);
    
    header('Content-Type: application/json');
    echo json_encode($result);
?>
