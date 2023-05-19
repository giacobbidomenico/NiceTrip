<?php
    require_once 'bootstrap.php';
    $id = $_SESSION["id"];
    $result = $dbh->deletePost($id, $_POST["postId"]);
    
    echo json_encode($result);

?>
