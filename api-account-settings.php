<?php
    require_once 'bootstrap.php';

    $result["error"] = false;

    if(!isSessionActive()) {
        $result["error"] = true;        
    } else {
        $id = $_SESSION["id"];
        if(isset($_POST["username"])){
            $result["username"] = $dbh->editUserName($id, $_POST["username"]);
        }
        if(isset($_POST["password"])){
            $result["password"] = $dbh->editUserPassword($id, $_POST["password"]);
        }
        if(isset($_POST["email"])){
            $result["email"] = $dbh->editUserEmail($id, $_POST["email"]);
        }
        if(isset($_FILES["image"])){
            $allowedTypes = ['jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt'];
            $fileName = $_FILES["image"]["name"];
            $tmpName = $_FILES["image"]["tmp_name"];
                
            $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            if(in_array($extension, $allowedTypes)) {
                do {
                    $newFileName = random_str() . '.' .$extension;
                    $newFilePath = PROFILE_IMAGES_DIR . $newFileName;
                }while(file_exists($newFilePath));
    
                if(move_uploaded_file($tmpName, $newFilePath)) {
                    //$result["image"] = var_dump($dbh->insertImage($postId, $newFileName));
                    $dbh->editUserImageProfile($id, $newFileName);
                    $result["image"] = $newFileName;
                }
            } else {
                $result["error"] = true;
            }
    
        }
    }

    header('Content-Type: application/json');
    echo json_encode($result);

?>
