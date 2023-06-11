<?php
    require_once 'bootstrap.php';
    $id = $_SESSION["id"];
    $userId = $_POST["userId"];

    $result = $dbh->changeFollowState($id, $userId, $_POST["register"] == "true" ? true : false);
    
    if($_POST["register"] == 'true') {
        $receiverEmail = $dbh->insertFollowNotification($id, $userId);
        var_dump($receiverEmail);
        $mailManager->setDestinationEmail($receiverEmail);
        $mailManager->sendNotification($_SESSION["userName"], "started following", "");
    }

    header('Content-Type: application/json');
    echo json_encode($result);
?>
