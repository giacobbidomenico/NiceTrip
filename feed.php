<?php

	require_once 'bootstrap.php';

	//in case no session is active, redirects to login
	if(!isSessionActive()){
		header('Location: index.php');
	}

	$templateParams["title"] = "feed";

	$templateParams["js"] = array(
		array("https://unpkg.com/axios/dist/axios.min.js"),
		array("js/post-preview.js"),
		array("js/feed.js"),
		array("https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"));

	require 'template/base2.php';
?>
