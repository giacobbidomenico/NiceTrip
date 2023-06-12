<?php

	require_once 'bootstrap.php';

    
	//in case no session is active, redirects to login
	if(!isSessionActive()){
		header('Location: index.php');
	}

	$templateParams["title"] = "";
	
	$templateParams["introductionTitle"] = "Notifications";
	$templateParams["introduction"] = "generic-introduction.php";
    $templateParams["mainArticle"] = 'notifications-list.php';
	$templateParams["js"] = array(array("https://unpkg.com/axios/dist/axios.min.js"),
								  array("https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"));

	require 'template/base2.php';
?>