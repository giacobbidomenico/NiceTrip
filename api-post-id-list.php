<?php
    require_once 'bootstrap.php';
    $id = $_SESSION["id"];
    $result = $dbh->getPostToVisualizeId($id);
    
    echo json_encode($result);

?>
