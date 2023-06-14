<?php
    require_once 'bootstrap.php';
    
    $result["error"] = false;

    if(!isSessionActive()) {
        $result["error"] = true;
    } else {
        $id = $_SESSION["id"];
        $postId = $_POST["postId"];
        $result = $dbh->notifyLike($postId, $id);
        if($result["insert"]){
            $receiverEmail = $dbh->insertLikeNotification($postId, $id);
        }
    }
    
    header('Content-Type: application/json');
    echo json_encode($result);
?>