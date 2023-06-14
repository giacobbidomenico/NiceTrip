<?php
    require_once 'bootstrap.php';
    
    $result["error"] = false;

    if(!isSessionActive()) {
        $result["error"] = true;
    } else {
        $id = $_SESSION["id"];
        $postId = $_POST["postId"];
        $receiverEmail = $dbh->insertLikeNotification($postId, $id);
    }
    
    header('Content-Type: application/json');
    echo json_encode($result);
?>