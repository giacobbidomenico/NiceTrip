<?php

    if(isset($_POST["type-request"])) {
        switch($_POST["type-request"]) {
            case "verify-email":
                $result["login"] = "hello";
                break;
            default:
                break;
        }
    }


    header('Content-Type: application/json');
    echo json_encode($result);
?>