<?php

	require_once 'bootstrap.php';

    
	//in case no session is active, redirects to login
	if(!isSessionActive()){
		header('Location: index.php');
	}

	$templateParams["title"] = "";
	$navBarParams["profile"] = "";
	$navBarParams["logOut"] = "";
	$navBarParams["feed"] = "";
	$navBarParams["search"] = "";
	$navBarParams["notifications"] = "";
	$navBarParams["newPost"] = "";
	$navBarParams["options"] = "";
    $templateParams["introduction"] = "New Post";
    $templateParams["mainArticle"] = 'post-creation.php';
	$templateParams["js"] = array(array("https://unpkg.com/axios/dist/axios.min.js"),
								  array("https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"),
								  array("https://www.bing.com/api/maps/mapcontrol?key=ApfT2xvKFGN88pRenIxehg4qyZ5OULOFUQhbXvP3jVvShecLtAsdF1oDFUjmI2XA&callback=loadMapScenario", array("async", "defer")), 
								  array("js/newpost.js"));

	require 'template/base2.php';
?>