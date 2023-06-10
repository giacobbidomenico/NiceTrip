<div class="container-fluid mt-4">

    <?php
        $notifications = $dbh->getUserNotifications($_SESSION["id"]);
        for($i = 0; $i < count($notifications); $i++):
    ?>

    <div class="row border-top border-bottom pt-2 pb-2 mb-3">
        <div class="col-1">
            <?php if($notifications[$i]["type"]=== 1): ?>
                <img class="img-fluid" src="<?php echo UPLOAD_DIR.'like-icon.png';?>"/>
            <?php elseif($notifications[$i]["type"] === 2): ?>
                <img class="img-fluid" src="<?php echo UPLOAD_DIR.'comment-icon.png';?>"/>
            <?php elseif($notifications[$i]["type"] === 3): ?>
                <img class="img-fluid" src="<?php echo UPLOAD_DIR.'follow-icon.png';?>"/>
            <?php endif;?>
        </div>
        <div class="col-10">
            <?php if($notifications[$i]["type"]=== 1): ?>
                <p class="fs-5"><span class="fw-bold"><?php echo $notifications[$i]["userName"]; ?></span> liked <a href="<?php echo 'single-post.php?postId='.$notifications[$i]["postId"]; ?>">your post</a></p>
            <?php elseif($notifications[$i]["type"] === 2): ?>
                <p class="fs-5"><span class="fw-bold"><?php echo $notifications[$i]["userName"]; ?></span> commented on <a href="<?php echo 'single-post.php?postId='.$notifications[$i]['postId']; ?>">your post</a></p>
            <?php elseif($notifications[$i]["type"] === 3): ?>
                <p class="fs-5"><span class="fw-bold"><?php echo $notifications[$i]["userName"]; ?></span> started following you</p>
            <?php endif;?>
        </div>
    </div>

    <?php endfor;?>

</div>