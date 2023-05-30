<?php

require_once 'utils/functions.php';
require_once 'bootstrap.php';

$result["error"] = false;

if(isset($_POST["title"]) && isset($_POST["description"])){
    if(isset($_POST["destinations"])) {
        $result["ris"] = 'j';
    }
    if(isset($_FILES["images"])) {
        $allowedTypes = ['jpeg', 'jpg', 'png'];

        $fileNames = $_FILES["images"]["name"];
        for($i=0; $i < count($fileNames); $i++) {
            $extension = pathinfo($fileNames[$i], PATHINFO_EXTENSION);
            if(in_array($extension, $allowedTypes)) {
                $result["ris"]  = 'ok';
            }
        }
    }
}else {
    $result["error"] = true;
}

header('Content-Type: application/json');
echo json_encode($result);
?>