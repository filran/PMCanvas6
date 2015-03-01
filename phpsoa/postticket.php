<?php
include("../config/config.php");


$data = array( $_SESSION["box"][0] => array(
			"data_inicio" => $_GET["data_inicio"],
			"data_fim" => $_GET["data_fim"],
			"text" => $_GET["text"],
			"quantidade" => $_GET["quantidade"],
			"valor" => $_GET["valor"],
			"causa" => $_GET["causa"],
			"efeito" => $_GET["efeito"],	
			"canvas_box_id" => $_GET["canvas_box_id"],
			"canvas_project_id" => $_GET["canvas_project_id"],
			"canvas_ticket_id" => $_GET["canvas_ticket_id"]          
        ));
                                                         
$data_string = json_encode($data);  

$url = $_SESSION["dominio"].'projects/'.$_GET["projects_id"].'/canvas_projects/'.$_GET["canvas_project_id"].'/canvas_tickets.json?key='.$_SESSION["key"];                                                                              
 
$ch = curl_init($url);                                                                      
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($data_string))                                                                       
);                                                                                                                   
 
echo $result = curl_exec($ch);
?>
