<?php
    require_once 'bootstrap.php';

    $result["error"] = false;

    if(isset($_POST["type-request"])) {
        switch($_POST["type-request"]) {
            case "verify-email":
                if(isset($_POST["email"])) {
                    $result["found-emails-usernames"] = count($dbh->checkEmailOrUsername($_POST["email"]));
                } else {
                    $result["error"] = true;
                }
                break;
            default:
                break;
        }
    } else {
        $result["error"] = true;
    }


    header('Content-Type: application/json');
    echo json_encode($result);
?>