<?php

require_once "bootstrap.php";

$templateParams["error"] = false;
$templateParams["message"] = "cdjsijsimeimi";

$templateParams["template-name"] = "reporting-page.php";
$templateParams["pageName"] = 'Account Verification';
$templateParams["title"] = "NiceTrip";
$templateParams["subtitle"] = "Share your travels with your friends";
$templateParams["iconName"] = "icon.png";

$templateParams["iconDescription"] = "NiceTrip icon";
$templateParams["mainImageName"] = "people-travelling.png";
$templateParams["mainImageDescription"] = "people who are travelling";
$templateParams["js"] = array(
    "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js",
    "https://unpkg.com/axios/dist/axios.min.js");

require("template/base1.php");

?>