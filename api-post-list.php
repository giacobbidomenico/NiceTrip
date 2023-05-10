<?php
    require_once 'bootstrap.php';
    //$id = $_SESSION["id"];
    $id = 3;

    $result1 = $dbh->getFollowingUserDetails($id);
    //var_dump($result1);
    echo " </br>";
    echo " </br>";
    //var_dump(json_encode($result1));

    echo " </br>";
    echo " </br>";
    foreach ($result1 as $value){
    //    var_dump($value);
        echo " </br>";
        echo " </br>";
        $result2 = $dbh->getFollowingUserPosts($value["id"], $value["lastPost"], isset($value["lastPost"]) ? true : false);
    //    var_dump($result2);
        foreach ($result2 as $post){
            $result3 = $dbh->getFollowingUserPosts($value["id"], $value["lastPost"], isset($value["lastPost"]) ? true : false);
            $result2[$post["id"]]["images"] = $result3;
        }

        echo " </br>";
        echo " </br>";
        $result1[$value["id"]]["posts"] = $result2;
        $result4 = $dbh->getPostStats($value["id"], $value["lastPost"], isset($value["lastPost"]) ? true : false);
        $result1[$value["id"]]["posts"]["comment-number"] = $result4[0]["comment-number"];
        $result1[$value["id"]]["posts"]["like-number"] = $result4[0]["like-number"];
    }
    //var_dump($result1);
    echo json_encode($result1);

?>
