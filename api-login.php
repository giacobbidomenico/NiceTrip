<?php
    require_once 'bootstrap.php';

    $result["error"] = false;

    if(isset($_POST["type-request"])) {
        switch($_POST["type-request"]) {
            case "verify-email-username":
                if(isset($_POST["email-username"])) {
                    $result["found-emails-usernames"] = count($dbh->checkEmailOrUsername($_POST["email-username"]));
                } else {
                    $result["error"] = true;
                }
                break;
            case "login":
                if(isset($_POST["email-username"]) && isset($_POST["password"]) && isset($_POST["stay-signed-in"])) {
                    $result["found-emails-usernames"] = count($dbh->checkLogin($_POST["email-username"], $_POST["password"]));
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