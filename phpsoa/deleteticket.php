<?php
include("../config/config.php");


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $_SESSION["dominio"]."projects/".$_GET["projects_id"]."/canvas_projects/".$_GET["canvas_project_id"]."/canvas_tickets/".$_GET["id"].".json?key=".$_SESSION["key"]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

// execute the request

$output = curl_exec($ch);

// output the profile information - includes the header

echo($output) . PHP_EOL;

// close curl resource to free up system resources

curl_close($ch);

?>
