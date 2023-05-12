<?php
    require_once 'bootstrap.php';
    $id = $_POST["postId"];
    $result = $dbh->getPostImages($id);
    
    echo json_encode($result);

?>
