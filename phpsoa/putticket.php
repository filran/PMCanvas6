<?php
include("../config/config.php");

$update = array( "canvas_ticket"=>array(
            "text" => $_GET["text"] 
        ));

// make the POST fields

$data_string = json_encode($update); 

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $_SESSION["dominio"]."projects/".$_GET["projects_id"]."/canvas_projects/".$_GET["canvas_project_id"]."/canvas_tickets/".$_GET["id"].".json?key=".$_SESSION["key"]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT"); // note the PUT here

curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_HEADER, true);

curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($data_string)                                                                       
));       

// execute the request

$output = curl_exec($ch);

// output the profile information - includes the header

echo "<pre>";
echo($output) . PHP_EOL;
echo curl_error($ch);
echo "</pre>";

// close curl resource to free up system resources

curl_close($ch);

?>
