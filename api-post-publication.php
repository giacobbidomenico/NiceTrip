<?php
$result["error"] = false;

if(isset($_POST["title"]) && isset($_POST["description"])){
    if(isset($_POST["destinations"])) {
        $result["ris"] = 'j';
    }
    if(isset($_FILES["images"])) {
        for($i = 0; $i < count($_FILES['images']["name"]); $i++) {
            if(!file_exists($_FILES['images']["name"][$i])) {
                $result["ris"] = 'images';
            }
        }
    }
}else {
    $result["error"] = true;
}

header('Content-Type: application/json');
echo json_encode($result);
?>