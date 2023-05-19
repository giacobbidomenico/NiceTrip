<?php

require_once "bootstrap.php";

if(isSessionActive()) {
    header('Location: feed.php');
}

$templateParams["template-name"] = "sign-up-form.php";
$templateParams["pageName"] = 'Sign Up';
$templateParams["title"] = "NiceTrip";
$templateParams["subtitle"] = "Share your travels with your friends";
$templateParams["iconName"] = "icon.png";
$templateParams["iconDescription"] = "NiceTrip icon";
$templateParams["mainImageName"] = "person-run.png";
$templateParams["mainImageDescription"] = "running traveller";

$templateParams["js"] = array(
    "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js",
    "https://unpkg.com/axios/dist/axios.min.js",
    "js/common.js",
    "js/sign-up.js");

require("template/base1.php");

?>