<?php
    require_once 'bootstrap.php';
    $id = $_SESSION["id"];
    $name = $_POST["name"];
    $result = $dbh->getUsersByMatch($name);

    echo json_encode($result);

?>
