<?php
    require_once 'bootstrap.php';
    $id = $_SESSION["postId"];
    $result = $dbh->deletePost($id, $postId);
    
    echo json_encode($result);

?>
