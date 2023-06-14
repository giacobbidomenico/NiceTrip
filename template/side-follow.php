<?php
	$followers = $dbh->getFollowers($_GET["userProfile"]);
	$follows = $dbh->getFollows($_GET["userProfile"]);
?>
<div class="container-fluid">
	<div class="row ">
		<div class="col my-4">
			<div class="card follow-card">
				<div class="card-body">
					<h2 id="follower" class="card-title">Follower: <?php echo count($followers)?></h2>
				</div>
				<ul id="list-follower" class="list-group list-group-flush overflow-y-scroll">
					<?php
						foreach ($followers as $follower){
							echo '<li class="list-group-item">
									<div id="fer-'.$follower["id"].'" class="d-flex flex-row">
										<div class="ratio ratio-1x1 square-desktop-icon">
											<div class="border d-flex align-items-center">
												<img id="fer-'.$follower["id"].'-author-image" src="profilePhotos/'.$follower["photoPath"].'" class="img-fluid mx-auto align-middle profile-image-introduction" alt="...">
											</div>
										</div>
										<div class="ms-3">
											<a id="fer-'.$follower["id"].'author-username" class="link-secondary link-offset-2 link-offset-1-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="profile.php?userProfile='.$follower["id"].'">'.$follower["userName"].'</a>
										</div>
									</div>
								</li>';
						}
					?>
				</ul>
			</div>
		</div>
	</div>
	<div class="row mb-4">
		<div class="col">
			<div class="card follow-card">
				<div class="card-body">
					<h2 id="follow" class="card-title">Follow: <?php echo count($follows)?></h2>
				</div>
				<ul id="list-follow" class="list-group list-group-flush overflow-y-scroll">
					<?php
						foreach ($follows as $follow){
							echo '<li class="list-group-item">
									<div id="fer-'.$follow["id"].'" class="d-flex flex-row">
										<div class="ratio ratio-1x1 square-desktop-icon">
											<div class="border d-flex align-items-center">
												<img id="fer-'.$follow["id"].'-author-image" src="profilePhotos/'.$follow["photoPath"].'" class="img-fluid mx-auto align-middle profile-image-introduction" alt="...">
											</div>
										</div>
										<div class="ms-3">
											<a id="fer-'.$follow["id"].'author-username" class="link-secondary link-offset-2 link-offset-1-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="profile.php?userProfile='.$follow["id"].'">'.$follow["userName"].'</a>
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
