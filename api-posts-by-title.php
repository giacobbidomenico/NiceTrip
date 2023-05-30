<?php
    require_once 'bootstrap.php';
    $id = $_SESSION["id"];
    $tokens = json_decode($_POST["tokens"]);
    $result = $dbh->getPostsFromTitle($tokens);

    echo json_encode($result);

?>
