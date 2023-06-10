<?php
    require_once 'bootstrap.php';
    $id = $_SESSION["id"];
    if(isset($_POST["username"])){
        $result["username"] = $dbh->editUserName($id, $_POST["username"]);
    }
    if(isset($_POST["password"])){
        $result["password"] = $dbh->editUserPassword($userId, $_POST["password"]);
    }
    if(isset($_POST["email"])){
        $result["email"] = $dbh->editUserEmail($userId, $_POST["email"]);
    }
    if(isset($_FILES["image"])){
        $allowedTypes = ['jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt'];
        $fileName = $_FILES["image"]["name"];
        $tmpName = $_FILES["image"]["tmp_name"];
            
        $extension = strtolower(pathinfo($fileNames[$i], PATHINFO_EXTENSION));
        if(in_array($extension, $allowedTypes)) {
            do {
                $newFileName = random_str() . '.' .$extension;
                $newFilePath = IMAGES_DIR . $newFileName;
            }while(file_exists($newFilePath));

            if(move_uploaded_file($tmpNames[$i], $newFilePath)) {
               $result["image"] = $dbh->editUserImageProfile($userId, $imageName);
            }
        } else {
            $result["error"] = true;
        }

    }
    header('Content-Type: application/json');
    echo json_encode($result);

?>
