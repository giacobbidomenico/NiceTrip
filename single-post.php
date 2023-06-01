<?php

	require_once 'bootstrap.php';

	//in case no session is active, redirects to login
	if(!isSessionActive()){
		header('Location: index.php');
	}

	$templateParams["title"] = "Post";
	$templateParams["mainArticle"] = "post-visualization.php";
	$templateParams["sideArticle"] = "side-itinerary.php";
	$navBarParams["profile"] = "profile.php";
	$navBarParams["logOut"] = "";
	$navBarParams["feed"] = "feed.php";
	$navBarParams["search"] = "";
	$navBarParams["notifications"] = "";
	$navBarParams["newPost"] = "newPost.php";
	$navBarParams["options"] = "";
	$templateParams["jsVars"] = array("const postId = ".$_GET["postId"].";", "const userId = ".$_SESSION["id"].";");
	$templateParams["js"] = array(array("https://unpkg.com/axios/dist/axios.min.js"),
		array("js/single-post.js"),
		array("https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"));

	require 'template/base2.php';

?>
