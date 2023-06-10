<div class="container-fluid mt-4">

    <?php
        $actualDir = dirname($_SERVER["PHP_SELF"]);
        $notifications = $dbh->getUserNotifications($_SESSION["id"]);
        for($i = 0; $i < count($notifications); $i++):
    ?>

    <div class="row border-top border-bottom pt-2 pb-2 mb-3">
        <div class="col-1">
            <?php
                if($notifications[$i]["type"]=== 1) {
                    $image = UPLOAD_DIR.'like-icon.png';
                } elseif($notifications[$i]["type"] === 2) {
                    $image = UPLOAD_DIR.'comment-icon.png';
                } elseif($notifications[$i]["type"] === 3) {
                    $image = UPLOAD_DIR.'follow-icon.png';
                }
            ?>
            <img class="img-fluid" src="<?php echo $image;?>"/>
        </div>
        <div class="col-10">
            <?php
                $link = 'http://'.$_SERVER['HTTP_HOST'].$actualDir.'/single-post.php?postId='.$notifications[$i]["postId"];
                
                if($notifications[$i]["type"]=== 1) {
                    $message = " liked ";
                } elseif($notifications[$i]["type"] === 2) {
                    $message = " comment on ";
                } elseif($notifications[$i]["type"] === 3) {
                    $message = " started following";
                    $link = "";
                }
            ?>
            <p class="fs-5"><span class="fw-bold"><?php echo $notifications[$i]["userName"];?></span><?php echo $message;?><?php if($link!==""):?><a href="<?php echo $link; ?>">your post</a><?php endif; ?></p>
        </div>
    </div>

    <?php endfor;?>

</div>