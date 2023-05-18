<?php
    require_once 'bootstrap.php';
    $id = $_SESSION["id"];
    $postId = $_POST["postId"];
    $result = $dbh->notifyLike($postId, $id, $_POST["like"] == "true" ? true : false);
    
    echo json_encode($result);

?>
