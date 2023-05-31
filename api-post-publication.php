<?php

require_once 'utils/functions.php';
require_once 'bootstrap.php';

$result["error"] = false;

if(isset($_POST["title"]) && isset($_POST["description"])){
    if(isset($_POST["destinations"])) {
        $result["ris"] = 'j';
    }
    if(isset($_FILES["images"])) {
        $allowedTypes = ['jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt'];

        $fileNames = $_FILES["images"]["name"];
        $tmpNames = $_FILES["images"]["tmp_name"];


        $postId = $dbh->publishPost($_POST["title"], $_POST["description"], $_SESSION["id"]);

        for($i=0; $i < count($fileNames); $i++) {
            
            $extension = strtolower(pathinfo($fileNames[$i], PATHINFO_EXTENSION));
            if(in_array($extension, $allowedTypes)) {
                do {
                    $newFileName = random_str() . '.' .$extension;
                    $newFilePath = IMAGES_DIR . $newFileName;
                }while(file_exists($newFilePath));

                if(move_uploaded_file($tmpNames[$i], $newFilePath)) {
                    $dbh->insertImage($postId, $newFileName);
                    $result["post"] = $postId;
                }
            }
        }
    }
} else {
    $result["error"] = true;
}

header('Content-Type: application/json');
echo json_encode($result);
?>