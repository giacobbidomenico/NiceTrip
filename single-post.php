<?php

	require_once 'bootstrap.php';

	//in case no session is active, redirects to login
	if(!isSessionActive()){
		header('Location: index.php');
	}

	$templateParams["title"] = "post";
	$templateParams["introduction"] = "generic-introduction.php";
	$templateParams["introductionTitle"] = "Post";
	$templateParams["mainArticle"] = "post-visualization.php";
	$templateParams["sideArticle"] = "side-itinerary.php";

	$templateParams["jsVars"] = array("const postId = ".$_GET["postId"].";", "const userId = ".$_SESSION["id"].";");
	$templateParams["js"] = array(array("https://unpkg.com/axios/dist/axios.min.js"),
		array("js/common.js"),
		array("js/single-post.js"),
		array("https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"));

	require 'template/base2.php';

?>
