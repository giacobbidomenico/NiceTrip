<?php
	$followers = $dbh->getFollowers($_GET["userProfile"]);
	$follows = $dbh->getFollows($_GET["userProfile"]);
?>
<div class="container-fluid">
	<div class="row ">
		<div class="col gy-4">
			<div class="card follow-card">
				<div class="card-body">
					<h2 id="follower" class="card-title">Follower: <?php echo count($followers)?></h2>
				</div>
				<ul id="list-follower" class="list-group list-group-flush overflow-y-scroll">
					<?php
						foreach ($followers as $follower){
							echo '<li class="list-group-item">
									<div id="fer-'.$follower["id"].'" class="">
										<img id="fer-'.$follower["id"].'-author-image" class="desktop-icon" src="profilePhotos/'.$follower["photoPath"].'" />
										<a id="fer-'.$follower["id"].'author-username" class="link-secondary link-offset-2 link-offset-1-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="profile.php?userProfile='.$follower["id"].'">'.$follower["userName"].'</a>
									</div>
								</li>';
						}
					?>
				</ul>
			</div>
		</div>
	</div>
	<div class="row ">
		<div class="col gy-4">
			<div class="card follow-card">
				<div class="card-body">
					<h2 id="follow" class="card-title">Follow: <?php echo count($follows)?></h2>
				</div>
				<ul id="list-follow" class="list-group list-group-flush overflow-y-scroll">
					<?php
						foreach ($follows as $follow){
							echo '<li class="list-group-item">
									<div id="fer-'.$follow["id"].'" class="">
										<img id="fer-'.$follow["id"].'-author-image" class="desktop-icon" src="profilePhotos/'.$follow["photoPath"].'" />
										<a id="fer-'.$follow["id"].'author-username" class="link-secondary link-offset-2 link-offset-1-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="profile.php?userProfile='.$follow["id"].'">'.$follow["userName"].'</a>
									</div>
								</li>';
						}
					?>
				</ul>
			</div>
		</div>
	</div>
</div>
