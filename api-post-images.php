<?php
    require_once 'bootstrap.php';
    $id = $_SESSION["id"];
    $postId = $_POST["postId"];
    $dbh = new checkFollowDecorator($dbh);
    $result = $dbh->getPostImages($postId, $id);
    
    echo json_encode($result);

?>
