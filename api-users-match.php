<?php
    require_once 'bootstrap.php';
    $id = $_SESSION["id"];
    $name = $_POST["name"];
    $result = $dbh->getUsersByMatch($name);

    header('Content-Type: application/json');
    echo json_encode($result);
?>
