<?php
    require_once 'bootstrap.php';
    $id = $_SESSION["id"];
    $notifications =  $dbh->getUserNotificationsNotSent($id);
    
    for($i = 0; $i < count($notifications); $i++) {
        $link = 'http://'.$_SERVER['HTTP_HOST'].$actualDir.'/single-post.php?postId='.$notifications[$i]["postId"];
        $mailManager->setDestinationEmail($notifications[$i]["emailReceiver"]);
        $mailManager->sendNotification($notifications[$i]["userName"], "liked", $link);
    }
?>