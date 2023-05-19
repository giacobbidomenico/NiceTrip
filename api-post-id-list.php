<?php
    require_once 'bootstrap.php';
    $id = $_SESSION["id"];
    if(isset($_POST["ownPosts"])){
        $result = $dbh->getUserPosts($id);
    } else {
        $result = $dbh->getFollowsPosts($id);
    }
    
    echo json_encode($result);

?>
