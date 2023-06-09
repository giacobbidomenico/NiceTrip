<?php
    require_once 'bootstrap.php';

    $id = $_SESSION["id"];

    if(isset($_GET["userProfile"])){
        $result["isMyProfile"] = false;
        if($_GET["userProfile"] == $_SESSION["id"]){
            $result["isMyProfile"] = true;
        }
        $result["posts"] = $dbh->getUserPosts($_GET["userProfile"]);
        $result["posts"] = array_reverse($result["posts"]);
    } else {
        $result["posts"] = $dbh->getFollowsPosts($id);
    }

    echo json_encode($result);
?>
