<?php
	$number = 10;
	$id = $_SESSION["id"];
	$response = $dbh->getRandomUsersId($number, $id);
	$usersId = array_map(fn($value) => $value["id"], $response);
	$suggested = $dbh->getPublicUserDetails($usersId, $id);
?>
<div class="container-fluid">
	<div class="row ">
		<div class="col gy-4">
			<div class="card follow-card">
				<div class="card-body">
					<h2 class="card-title">Suggested: </h2>
				</div>
				<ul class="list-group list-group-flush overflow-y-scroll">
					<?php
						foreach ($suggested as $user){
							echo '<li class="list-group-item">
									<div id="fer-'.$user["id"].'" class="">
										<img id="fer-'.$user["id"].'-author-image" class="desktop-icon" src="profilePhotos/'.$user["photoPath"].'" />
										<a id="fer-'.$user["id"].'author-username" class="link-secondary link-offset-2 link-offset-1-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="profile.php?userProfile='.$user["id"].'">'.$user["userName"].'</a>
									</div>
								</li>';
						}
					?>
				</ul>
			</div>
		</div>
	</div>
</div>
