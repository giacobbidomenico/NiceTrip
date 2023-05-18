<?php
    require_once 'bootstrap.php';
    $id = $_SESSION["id"];
    $postId = $_POST["postId"];
    $result = $dbh->notifyVisual($postId, $id);
    
    echo json_encode($result);

?>
