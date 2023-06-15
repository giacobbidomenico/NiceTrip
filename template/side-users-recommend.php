<?php
	$number = 10;
	$id = $_SESSION["id"];
	$response = $dbh->getRandomUsersId($number, $id);
	if(count($response) >= 1):
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
									<div id="fer-'.$user["id"].'" class="d-flex flex-row">
										<div class="ratio ratio-1x1 square-desktop-icon">
											<div class="border d-flex align-items-center">
												<img id="fer-'.$user["id"].'-author-image" src="profilePhotos/'.$user["photoPath"].'" class="img-fluid mx-auto align-middle profile-image-introduction" alt="'.$user["userName"].'"/>
											</div>
										</div>
										<div class="ms-3">
											<a id="fer-'.$user["id"].'author-username" class="link-secondary link-offset-2 link-offset-1-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="profile.php?userProfile='.$user["id"].'">'.$user["userName"].'</a>
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
<?php
	endif
?>