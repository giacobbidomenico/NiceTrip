<?php
	
	$postId = $_GET["postId"]; 
	$postDetails = $dbh->getPostDetails($postId, $_SESSION["id"]);
	$authorDetails = $dbh->getPublicUserDetails($postDetails[0]["userId"], $_SESSION["id"]);
	$postImages = $dbh->getPostImages($postId, $_SESSION["id"]);
    $destinations = $dbh->getPostItinerary($postId);
?>

<div class="col">
	<article class="mx-3">
        <header class="my-4">
            <h2 class=""><?php echo $postDetails[0]["title"]?></h2>
			<section class="my-3 d-flex">
				<!-- Author details -->
				<div id="p-131-author-details" class="">
					<div id="p-131-author" class="d-flex flex-row">
						<div class="ratio ratio-1x1 square-desktop-icon align-self-end">
							<div class="border d-flex align-items-center">
								<img src="profilePhotos/<?php echo $authorDetails[0]["photoPath"]?>" class="img-fluid mx-auto align-middle profile-image-introduction" alt="User profile image">
							</div>
						</div>
						<h3 class="ms-3 mb-0 fs-6">
							<a id="author-username" class="link-secondary link-offset-2 link-offset-1-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="profile.php?userProfile=<?php echo $authorDetails[0]["id"]?>"><?php echo $authorDetails[0]["userName"]?></a>
						</h3>
					</div>
				</div>
			</section>
        </header>
		<div  class="my-4">
			<!-- Images -->
            <div id="carouselExample" class="carousel slide rounded-2 ">
				<div class="carousel-inner">
					<?php 
						foreach($postImages as $image){
							echo '<div class="carousel-item '.($image === $postImages[0]?"active":"").'">
								<img id="image" src="img/'.$image["name"].'" class="d-block w-100" alt="Post image">
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
        </div>
		<div class="itinerary d-block d-md-none">
			<div class="outerDiv" >
				<div class="mvh-25 middleDiv">
					<div class="innerDiv">
						<div class="" style="max-height:60%; position:inherit;">
							<ul class="">
								<?php
									foreach($destinations as $place){
										echo '
										<li class="dot">
											<div class="container-fluid">
												<div class="row">
													<div class="col-12 col-lg-9 pe-0">
														<p class="mb-1">'.$place["description"].'</p>
													</div>
												</div>
											</div>
										</li>';
									}
								?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr/>
        <section class="my-4 container-fluid">
			<!-- Description -->
			<div class="row">
				<div class="col p-0">
					<h3>Description</h3>
					<p class="text-break"><?php echo $postDetails[0]["description"]?></p>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<button id="p-likes" class="float-end btn btn-light my-2" <?php echo ($postDetails[0]["id"] === $_SESSION["id"])? "" : "disabled"?>>
						<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-balloon-heart desktop-icon <?php echo ($postDetails[0]["liked"] == 1 ? "d-none" : "") ?>" viewBox="0 0 16 16">
							<path fill-rule="evenodd" d="m8 2.42-.717-.737c-1.13-1.161-3.243-.777-4.01.72-.35.685-.451 1.707.236 3.062C4.16 6.753 5.52 8.32 8 10.042c2.479-1.723 3.839-3.29 4.491-4.577.687-1.355.587-2.377.236-3.061-.767-1.498-2.88-1.882-4.01-.721L8 2.42Zm-.49 8.5c-10.78-7.44-3-13.155.359-10.063.045.041.089.084.132.129.043-.045.087-.088.132-.129 3.36-3.092 11.137 2.624.357 10.063l.235.468a.25.25 0 1 1-.448.224l-.008-.017c.008.11.02.202.037.29.054.27.161.488.419 1.003.288.578.235 1.15.076 1.629-.157.469-.422.867-.588 1.115l-.004.007a.25.25 0 1 1-.416-.278c.168-.252.4-.6.533-1.003.133-.396.163-.824-.049-1.246l-.013-.028c-.24-.48-.38-.758-.448-1.102a3.177 3.177 0 0 1-.052-.45l-.04.08a.25.25 0 1 1-.447-.224l.235-.468ZM6.013 2.06c-.649-.18-1.483.083-1.85.798-.131.258-.245.689-.08 1.335.063.244.414.198.487-.043.21-.697.627-1.447 1.359-1.692.217-.073.304-.337.084-.398Z"></path>
						</svg>
						<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-balloon-heart-fill desktop-icon <?php echo ($postDetails[0]["liked"] == 1 ? "" : "d-none") ?>" viewBox="0 0 16 16">
							<path fill-rule="evenodd" d="M8.49 10.92C19.412 3.382 11.28-2.387 8 .986 4.719-2.387-3.413 3.382 7.51 10.92l-.234.468a.25.25 0 1 0 .448.224l.04-.08c.009.17.024.315.051.45.068.344.208.622.448 1.102l.013.028c.212.422.182.85.05 1.246-.135.402-.366.751-.534 1.003a.25.25 0 0 0 .416.278l.004-.007c.166-.248.431-.646.588-1.115.16-.479.212-1.051-.076-1.629-.258-.515-.365-.732-.419-1.004a2.376 2.376 0 0 1-.037-.289l.008.017a.25.25 0 1 0 .448-.224l-.235-.468ZM6.726 1.269c-1.167-.61-2.8-.142-3.454 1.135-.237.463-.36 1.08-.202 1.85.055.27.467.197.527-.071.285-1.256 1.177-2.462 2.989-2.528.234-.008.348-.278.14-.386Z"></path>
						</svg>
						<span>
							likes: <?php echo $postDetails[0]["likeNumber"]?>
						</span>
					</button>
				</div>
			</div>
        </section>
		<hr/>
        <section class="my-4">
			<!-- Comments -->
			<div id="comments" class="container-fluid p-0">
				<div class="row">
					<h3>Comments</h3>
					<form>
						<div class="form-floating">
							<textarea class="form-control" placeholder="Leave a comment here" id="c-area" style="height: 100px"></textarea>
							<label for="c-area" hidden>Comments</label>
						</div>
						<button id="c-submit" type="button" class="my-3 btn btn-primary float-end">Add comment</button>
					</form>
				</div>
				<div id="c-m-deletion" class="modal" tabindex="-1">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<p class="modal-title">Are you sure?</p>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<p>You cannot restore posts that have been deleted.</p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
								<button id="c-deleteConfirm" type="button" class="btn btn-primary" data-bs-dismiss="modal">Delete</button>
							</div>
						</div>
					</div>
				</div>
				<div id="commentSection" class="border border-light-subtle">
				</div>
				

			</div>
        </section>
    </article>
</div>
