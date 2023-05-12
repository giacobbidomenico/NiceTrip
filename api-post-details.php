<?php
    require_once 'bootstrap.php';
    $id = $_POST["postId"];
    $result = $dbh->getPostDetails($id);
    
    echo json_encode($result);

?>
