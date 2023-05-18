<?php
    require_once 'bootstrap.php';
//    $id = $_SESSION["id"];
    $id = 3;
    $postId = $_POST["postId"];
    $result = $dbh->notifyLike($postId, $id, $_POST["like"] == "true" ? true : false);
    
    echo json_encode($result);

?>
