<?php
    require_once 'bootstrap.php';
//    $id = $_SESSION["id"];
    $id = 3;
    $postId = $_POST["postId"];
    $result = $dbh->notifyVisual($postId, $id);
    
    echo json_encode($result);

?>
