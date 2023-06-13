<?php
    require_once 'bootstrap.php';

    $result["error"] = false;

    if(!isSessionActive()) {
        $result["error"] = true;
    } else {
        $id = $_SESSION["id"];
        $dbh = new checkFollowDecorator($dbh);
        $result = $dbh->deletePost($_POST["postId"]);
    }

    header('Content-Type: application/json');
    echo json_encode($result);
?>
