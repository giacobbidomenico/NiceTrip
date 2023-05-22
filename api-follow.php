<?php
    require_once 'bootstrap.php';
    $id = $_SESSION["id"];
    $userId = $_POST["userId"];
    $result = $dbh->changeFollowState($id, $userId, $_POST["register"] == "true" ? true : false);
    
    echo json_encode($result);

?>
