<?php
include("../config/config.php");

#$data = array('canvas_ticket'=>array(
#		'text'=>$_GET["text"],
#		'canvas_box_id'=>$_GET["canvas_box_id"],
#		'canvas_project_id'=>$_GET["canvas_projects_id"])
#	);

$data = array('canvas_ticket'=>array(
		'text'=>$_GET["text"],
		'canvas_box_id'=>$_GET["canvas_box_id"],
		'canvas_project_id'=>$_GET["canvas_project_id"])
	);
                                                         
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
 
$result = curl_exec($ch);
?>
