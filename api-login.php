<?php
require_once 'bootstrap.php';
require_once 'utils/functions.php';

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
                $login_data = $dbh->checkLogin($_POST["email-username"], $_POST["password"]);
                $result["found-users"] = count($login_data);
    
                if($result["found-users"] > 0 &&
                    isset($login_data[0]["id"]) &&
                    isset($login_data[0]["email"]) &&
                    isset($login_data[0]["userName"])) {
                    registerLoginUser($login_data[0]["id"], $login_data[0]["email"], $login_data[0]["userName"]);
                                        
                    if($_POST["stay-signed-in"] === 'true') {
                        do {
                            $session_extension_code = random_str();
                        }while(count($dbh->getUsersBySessionExtensionCode($session_extension_code)) !== 0);
                        
                        $dbh->updateSessionExtensionCode($session_extension_code, $login_data[0]["id"]);
                        setcookie("session-extension-code", $session_extension_code, time() + (86400 * 30), '/');
                    }                    
                }
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