<?php
    require_once 'bootstrap.php';
    
    $result["error"] = false;

    if(!isSessionActive()) {
        $result["error"] = true;
    } else {
        $id = $_SESSION["id"];
        $userId = $_POST["userId"];

        $result = $dbh->changeFollowState($id, $userId, $_POST["register"] == "true" ? true : false);
        
        if($_POST["register"] == 'true') {
            $receiverEmail = $dbh->insertFollowNotification($id, $userId);
        }
    }

    header('Content-Type: application/json');
    echo json_encode($result);
?>
