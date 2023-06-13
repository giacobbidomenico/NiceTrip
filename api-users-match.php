<?php
    require_once 'bootstrap.php';

    $result["error"] = false;

    if(!isSessionActive()) {
        $result["error"] = true;
    } else {
        $id = $_SESSION["id"];
        $name = $_POST["name"];
        $result = $dbh->getUsersByMatch($name);
    }

    header('Content-Type: application/json');
    echo json_encode($result);
?>
