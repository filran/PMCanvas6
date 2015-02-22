<?php

$data = array('canvas_ticket'=>array('text'=>'fazendo um teste','canvas_box_id'=>'1','canvas_project_id'=>'14'));
                                                         
$data_string = json_encode($data);                                                                                   
 
$ch = curl_init('http://leonbsilva.ddns.net:8080/projects/10/canvas_projects/14/canvas_tickets.json?key=1708de85ebd115e4ab7c79824cdbdc849c79f6e9');                                                                      
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($data_string))                                                                       
);                                                                                                                   
 
$result = curl_exec($ch);

?>
