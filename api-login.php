<?php
require_once 'bootstrap.php';
require_once 'utils/functions.php';

$result["error"] = false;

$session_extension_code = random_str();

if(isset($_GET["type-request"])) {
    switch($_GET["type-request"]) {
        case "verify-email-username":
            if(isset($_GET["email-username"])) {
                $result["found-emails-usernames"] = count($dbh->checkEmailOrUsername($_GET["email-username"]));
            } else {
                $result["error"] = true;
            }
            break;
        case "login":
            if(isset($_GET["email-username"]) && isset($_GET["password"]) && isset($_GET["stay-signed-in"])) {
                $login_data = $dbh->checkLogin($_GET["email-username"], $_GET["password"]);
                $result["found-users"] = count($login_data);
    
                if($result["found-users"] > 0 &&
                    isset($login_data[0]["id"]) &&
                    isset($login_data[0]["email"]) &&
                    isset($login_data[0]["userName"])) {
                    registerLoginUser($login_data[0]["id"], $login_data[0]["email"], $login_data[0]["userName"]);
                                        
                    if($_GET["stay-signed-in"] === 'true') {
                        do {
                            $session_extension_code = random_str();
                        }while(count($dbh->getUsersBySessionExtensionCode($session_extension_code)) !== 0);
                        
                        $dbh->updateSessionExtensionCode($session_extension_code, $login_data[0]["id"]);
                        if (!isset($_COOKIE["session-extension-code"])) {
                            setcookie("session-extension-code", $session_extension_code, 3600 * 4);
                        }
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


//header('Content-Type: application/json');
//echo json_encode($result);
?>