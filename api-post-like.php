<?php
    require_once 'bootstrap.php';
    $id = $_SESSION["id"];
    $postId = $_POST["postId"];
    $result = $dbh->notifyLike($postId, $id);
    $dbh->insertLikeNotification($id);
    echo json_encode($result);

?>
