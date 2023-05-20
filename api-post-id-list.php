<?php
    require_once 'bootstrap.php';
    $id = $_SESSION["id"];
    if(isset($_GET["userProfile"])){
        $result = $dbh->getUserPosts($_GET["userProfile"]);
    } else {
        $result = $dbh->getFollowsPosts($id);
    }
    
    echo json_encode($result);

?>
