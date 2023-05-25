<?php
    require_once 'bootstrap.php';
    $id = $_SESSION["id"];
    $dbh = new checkFollowDecorator($dbh);
    switch ($_POST["option"]) {
	    case 'push':
            $postId = $_POST["postId"];
            $result = $dbh->setComment($postId, $id, date("Y-m-d"), date("H:i:s"), $_POST["description"]);
		    break;
	    case 'remove':
            $postId = $_POST["postId"];
            $result = $dbh->deleteComment($postId);
		    break;
        case 'get':
            $result = $dbh->getComments($_POST["commentIds"]);
		    break;
    }

    echo json_encode($result);

?>
