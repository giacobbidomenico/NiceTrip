<?php
    require_once 'bootstrap.php';
    
    $result["error"] = false;

    if(!isSessionActive()) {
        $result["error"] = true;
    } else {
        $id = $_SESSION["id"];
        $tokens = json_decode($_POST["tokens"]);
        $result = $dbh->getPostsFromTitle($tokens);
    }

    header('Content-Type: application/json');
    echo json_encode($result);

?>
