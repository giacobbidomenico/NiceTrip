<?php
    require_once 'bootstrap.php';
    //$id = $_SESSION["id"];
    $id = 3;

    $result = $dbh->getPostToVisualizeId($id);
    
    echo json_encode($result);

?>
