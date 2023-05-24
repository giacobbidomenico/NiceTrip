<?php
	
	//$postId = $_GET["postId"]; 
	$postId = 6;
	$postDetails = $dbh->getPostDetails($postId, $_SESSION["id"]);
	$authorDetails = $dbh->getPublicUserDetails($postDetails[0]["userId"], $_SESSION["id"]);
	$postImages = $dbh->getPostImages($postId, $_SESSION["id"]);
?>

<div class="col">
	<article class="px-5">
        <header class="my-4">
            <h1 class=""><?php echo $postDetails[0]["title"]?></h2>
			<section class="my-3">
				<!-- Author details -->
				<img id="author-image" class="desktop-icon" src="profilePhotos/<?php echo $authorDetails[0]["photoPath"]?>">
				<a id="author-username" class="link-secondary link-offset-2 link-offset-1-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="profile.php?userProfile=<?php echo $authorDetails[0]["id"]?>"><?php echo $authorDetails[0]["userName"]?></a>
			</section>
        </header>
		<section  class="my-4">
			<!-- Images -->
            <div id="carouselExample" class="carousel slide rounded-2 ">
				<div class="carousel-inner">
					<?php 
						foreach($postImages as $image){
							echo '<div class="carousel-item '.($image === $postImages[0]?"active":"").'">
								<img id="image" src="img/'.$image["path"].'" class="d-block w-100" alt="">
							</div>';
						}
					?>
				</div>
				<button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="visually-hidden">Previous</span>
				</button>
				<button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="visually-hidden">Next</span>
				</button>
			</div>
        </section>
        <section  class="my-4">
			<!-- Description -->
            <p class="text-break"><?php echo $postDetails[0]["description"]?></p>
        </section>
        <section class="my-4">
			<!-- Comments -->
        </section>
    </article>
</div>
