<?php
    require_once 'bootstrap.php';
    $id = $_SESSION["id"];
    $dbh = new checkFollowDecorator($dbh);
    switch ($_POST["option"]) {
	    case 'push':
            $postId = $_POST["postId"];
            $result = $dbh->setComment($postId, $id, date("Y-m-d"), date("H:i:s"), $_POST["description"]);
            $receivedEmail = $dbh->insertCommentNotification($postId, $id);
            $link = 'http://'.$_SERVER['HTTP_HOST'].$actualDir.'/single-post.php?postId='.$postId;
            $mailManager->setDestinationEmail($receivedEmail);
            $mailManager->sendNotification($_SESSION["userName"], "comment on", $link);
		    break;
	    case 'remove':
            $commentId = $_POST["commentId"];
            $result = $dbh->deleteComment($commentId);
		    break;
        case 'get':
            $commentIds = json_decode($_POST["commentIds"]);
            $result = $dbh->getComments($commentIds);
		    break;
        case 'list':
            $postId = $_POST["postId"];
            $result = $dbh->getListOfCommentsId($postId);
		    break;
    }

    header('Content-Type: application/json');
    echo json_encode($result);

?>
