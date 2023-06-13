<?php
    require_once 'bootstrap.php';

    $result["error"] = false;

    if(!isSessionActive()) {
        $result["error"] = true;
    } else {
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
    }

    header('Content-Type: application/json');
    echo json_encode($result);
?>
