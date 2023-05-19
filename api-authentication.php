<?php

require_once 'bootstrap.php';

$result["error"] = '';

//Take certain actions based on the type of request, otherwise an error is returned
if(isset($_POST["type-request"])) {
    switch($_POST["type-request"]) {


        case "verify-email-username":
            if(isset($_POST["email-username"])) {
                $result["num-email-username"] = count($dbh->checkEmailOrUsername($_POST["email-username"]));
            } else {
                $result["error"] = 'error-verify-email-username';
            }
            break;

        //Check that an email is associated with a certain account, otherwise an error is returned
        case "verify-email":
            if(isset($_POST["email"])) {
                $result["num-email"] = count($dbh->checkEmail($_POST["email"]));
            } else {
                $result["error"] = 'error-email';
            }
            break;

        //Check that an username is associated with a certain account, otherwise an error is returned
        case "verify-username":
            if(isset($_POST["username"])) {
                $result["num-username"] = count($dbh->checkUsername($_POST["username"]));
            } else {
                $result["error"] = 'error-verify-username';
            }
            break;

        //Verify that email and password are associated with a certain account, otherwise an error is returned
        case "login":
            if(isset($_POST["email-username"]) && isset($_POST["password"]) && isset($_POST["stay-signed-in"])) {
                
                $hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
                $login_data = $dbh->checkLogin($_POST["email-username"], $hash);
                $result["found-users"] = count($login_data);
        
                if($result["found-users"] > 0 &&
                    isset($login_data[0]["id"]) &&
                    isset($login_data[0]["email"]) &&
                    isset($login_data[0]["userName"])) {

                    if(!$dbh->isAccountActivated($_POST["email-username"])) {
                        $result["error"] = 'error-account-not-activated';
                    } else {
                        //If the credentials are correct, the user data are recorded in specific session variables
                        registerLoginUser($login_data[0]["id"], $login_data[0]["email"], $login_data[0]["userName"]);

                        /*In case the request to maintain the connection is received, a code is associated with 
                        *the user and inserted in the user's entry in the db and then in a cookie
                        */
                        if($_POST["stay-signed-in"] === 'true') {
                            do {
                                $session_extension_code = random_str();
                            }while(count($dbh->getUsersBySessionExtensionCode($session_extension_code)) !== 0);
                            
                            $dbh->updateSessionExtensionCode($session_extension_code, $login_data[0]["id"]);
                            setcookie("session-extension-code", $session_extension_code, time() + TIME_SESSION_EXTENSION, '/');
                        }
                    }
                } else {
                    $result["error"] = 'error-login-data';
                }
            } else {
                $result["error"] = 'error-login-data';
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