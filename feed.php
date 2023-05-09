<?php

require_once 'bootstrap.php';
$templateParams["title"] = "Blog TW - Contatti";
$navBarParams["profile"] = "";
$navBarParams["logOut"] = "";
$navBarParams["feed"] = "";
$navBarParams["search"] = "";
$navBarParams["notifications"] = "";
$navBarParams["newPost"] = "";
$navBarParams["options"] = "";
$templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js","js/");

require 'template/base2.php';

?>
