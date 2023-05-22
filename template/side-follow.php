<?php
	if(isset($_SESSION["id"])){
		$followers = $dbh->getFollowers($_SESSION["id"]);
		$follows = $dbh->getFollows($_SESSION["id"]);
	}
?>
<div class="container-fluid">
	<div class="row ">
		<div class="card" style="width: 18rem; max-height:25%;">
			<div class="card-body">
				<h2 class="card-title">Followers: 31</h2>
			</div>
			<?php
				foreach ($followers as $follower){

				}
			?>
			<ul class="list-group list-group-flush overflow-y-scroll">
				<li class="list-group-item">
					<div id="" class="">
						<img id="author-image" class="desktop-icon" src="profilePhotos/genericProfilePhoto.jpg" />
						<a id="author-username" class="link-secondary link-offset-2 link-offset-1-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="">Domebbi Giaconico</a>
					</div>
				</li>
			</ul>
		</div>
	</div>
	<div class="row ">
		<div class="card" style="width: 18rem; max-height:25%;">
			<div class="card-body">
				<h2 class="card-title">Follow: </h2>
			</div>
			<ul class="list-group list-group-flush overflow-y-scroll">
				<li class="list-group-item">
					<div id="" class="">
						<img id="author-image" class="desktop-icon" src="profilePhotos/genericProfilePhoto.jpg" />
						<a id="author-username" class="link-secondary link-offset-2 link-offset-1-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="">Domebbi Giaconico</a>
					</div>
				</li>
			</ul>
		</div>
	</div>
</div>
