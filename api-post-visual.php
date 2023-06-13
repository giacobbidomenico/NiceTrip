<?php
    require_once 'bootstrap.php';

    $result["error"] = false;

    if(!isSessionActive()) {
        $result["error"] = true;
    } else {
        $id = $_SESSION["id"];
        $postId = $_POST["postId"];
        $dbh = new checkFollowDecorator($dbh);
        $result = $dbh->notifyVisual($postId, $id);
    }

    header('Content-Type: application/json');
    echo json_encode($result);

?>
