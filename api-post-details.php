<?php
    require_once 'bootstrap.php';
    $result["error"] = false;

    if(!isSessionActive()) {
        $result["error"] = true;
    } else {
        $id = $_SESSION["id"];
        $postId = $_POST["postId"];
        $dbh = new checkFollowDecorator($dbh);
        $result = $dbh->getPostDetails($postId, $id);
        if($result[0]["userId"] == $_SESSION["id"]){
            $result["ownPost"] = true;
        } else {
            $result["ownPost"] = false;
        }
    }

    header('Content-Type: application/json');
    echo json_encode($result);
?>
