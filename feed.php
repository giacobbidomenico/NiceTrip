<?php

require_once 'bootstrap.php';
$templateParams["title"] = "";
$navBarParams["profile"] = "";
$navBarParams["logOut"] = "";
$navBarParams["feed"] = "";
$navBarParams["search"] = "";
$navBarParams["notifications"] = "";
$navBarParams["newPost"] = "";
$navBarParams["options"] = "";
$templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js","js/post-list.js");

require 'template/base2.php';

?>
