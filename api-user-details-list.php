<?php
    require_once 'bootstrap.php';
    $id = $_POST["followingUserId"];
    $result = $dbh->getPublicUserDetails($id);
    
    echo json_encode($result);

?>
