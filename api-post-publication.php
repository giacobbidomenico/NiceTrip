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

        for($i=0; $i < count($fileNames); $i++) {
            
            $extension = strtolower(pathinfo($fileNames[$i], PATHINFO_EXTENSION));
            if(in_array($extension, $allowedTypes)) {
                do {
                    $newFilePath = IMAGES_DIR . random_str() . '.' .$extension;
                }while(file_exists($newFilePath));

                if(move_uploaded_file($tmpNames[$i], $newFilePath)) {
                    var_dump($newFilePath);
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