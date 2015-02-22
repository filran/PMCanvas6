<?php
include("../config/config.php");

/**
 *  Example API call
 *  GET profile information
 */

// the ID of the profile

$json_url = $_SESSION["dominio"].'projects/'.$_GET["projects_id"].'/canvas_projects/'.$_GET["canvas_projects_id"].'/canvas_tickets.json?key='.$_SESSION["key"];

// Initializing curl
$ch = curl_init( $json_url );

// Configuring curl options
$options = array(
CURLOPT_RETURNTRANSFER => true,
CURLOPT_HTTPHEADER => array('Content-type: application/json') ,
);

// Setting curl options
curl_setopt_array( $ch, $options );

// Getting results
$result =  curl_exec($ch); // Getting JSON result string

$data = json_decode($result,true);
$data = json_encode($data);

echo $data;
curl_close($ch);

?>
