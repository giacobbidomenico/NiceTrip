<?php

	require_once 'bootstrap.php';

    
	//in case no session is active, redirects to login
	if(!isSessionActive()){
		header('Location: index.php');
	}

	$templateParams["title"] = "new post";

	$templateParams["introductionTitle"] = "New Post";
	$templateParams["introduction"] = "generic-introduction.php";
    $templateParams["mainArticle"] = 'post-creation.php';
	$templateParams["js"] = array(array("https://unpkg.com/axios/dist/axios.min.js"),
								  array("https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"),
								  array("https://www.bing.com/api/maps/mapcontrol?key=ApfT2xvKFGN88pRenIxehg4qyZ5OULOFUQhbXvP3jVvShecLtAsdF1oDFUjmI2XA&callback=autosuggest", array("async", "defer")), 
								  array("js/common.js"),
								  array("js/new-post.js"));

	require 'template/base2.php';
?>