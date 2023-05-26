<?php
    require_once 'bootstrap.php';
    $id = $_SESSION["id"];
    $dbh = new checkFollowDecorator($dbh);
    $result = $dbh->deletePost($_POST["postId"]);
    
    echo json_encode($result);

?>
