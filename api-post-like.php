<?php
    require_once 'bootstrap.php';
    $id = $_SESSION["id"];
    $postId = $_POST["postId"];
    $result = $dbh->notifyLike($postId, $id);
    if($result["insert"]){
        $receiverEmail = $dbh->insertLikeNotification($postId, $id);
        $link = 'http://'.$_SERVER['HTTP_HOST'].$actualDir.'/single-post.php?postId='.$postId;
        $mailManager->setDestinationEmail($receiverEmail);
        $mailManager->sendNotification($_SESSION["email"], "like", $link);
    }
    
    header('Content-Type: application/json');
    echo json_encode($result);
?>