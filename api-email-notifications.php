<?php
    require_once 'bootstrap.php';
    
    $result["error"] = false;

    if(!isSessionActive()) {
        $result["error"] = true;
    } else {
        $id = $_SESSION["id"];
        $notifications =  $dbh->getUserNotificationsNotSent($id);
        
        for($i = 0; $i < count($notifications); $i++) {
            $link = 'http://'.$_SERVER['HTTP_HOST'].$actualDir.'/single-post.php?postId='.$notifications[$i]["postId"];
            
            if($notifications[$i]["type"]=== 1) {
                $message = "liked";
            } elseif($notifications[$i]["type"] === 2) {
                $message = "comment on";
            } elseif($notifications[$i]["type"] === 3) {
                $message = "started following";
                $link = "";
            }

            //Sending of the email containing the notification
            $mailManager->setDestinationEmail($notifications[$i]["emailReceiver"]);
            $mailManager->sendNotification($notifications[$i]["userName"], $message, $link);
        }

        //Update the database field that shows whether or not the email notification was sent
        $dbh->notificationsSent($id);
    }

    header('Content-Type: application/json');    
    echo json_encode($result);
?>