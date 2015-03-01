<?php
include("../config/config.php");


if($_GET["canvas_box_id"] == 9){ //entregas
	$form = $_SESSION["box"][1];
}else if($_GET["canvas_box_id"] == 11){ //riscos
	$form = $_SESSION["box"][3];
}else if($_GET["canvas_box_id"] == 12){ //linha do tempo
	$form = $_SESSION["box"][2];
}else if($_GET["canvas_box_id"] == 13){ //custos
	$form = $_SESSION["box"][4];
}else{
	$form = $_SESSION["box"][0];
}


$update = array( $_SESSION["box"][0] => array(
			"data_inicio" => $_GET["data_inicio"],
			"data_fim" => $_GET["data_fim"],
			"text" => $_GET["text"],
			"quantidade" => $_GET["quantidade"],
			"valor" => $_GET["valor"],
			"causa" => $_GET["causa"],
			"efeito" => $_GET["efeito"],	
			"canvas_box_id" => $_GET["canvas_box_id"],
			"canvas_ticket_id" => $_GET["canvas_ticket_id"]          
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
