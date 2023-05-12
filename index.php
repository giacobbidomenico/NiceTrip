<?php

require_once "bootstrap.php";

//The user is redirected to the feed if the session already contains the account data
if(isSessionActive()) {
    header('Location: feed.php');
}

$templateParams["template-name"] = "login-form.php";
$templateParams["title"] = "NiceTrip";
$templateParams["subtitle"] = "Share your travels with your friends";
$templateParams["iconName"] = "icon.png";
$templateParams["iconDescription"] = "NiceTrip icon";
$templateParams["mainImageName"] = "group-travel.png";
$templateParams["mainImageDescription"] = "2 people packing their bags to go on a trip";

$templateParams["js"] = array(
    "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js",
    "https://unpkg.com/axios/dist/axios.min.js",
    "js/common.js",
    "js/login.js");

require("template/base1.php");

?>