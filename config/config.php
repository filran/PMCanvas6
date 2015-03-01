<?php

if( empty(session_id()) ){
	session_start();
}

//url do webservice
$_SESSION["dominio"] = "http://leonbsilva.ddns.net:8080/";
//$_SESSION["dominio"] = "http://odysseus-lens.ddns.net/ws_gestaointegrada/";
//$_SESSION["dominio"] = "http://localhost/ws_gestaointegrada/"; 

//key do webservice
$_SESSION["key"] = "1708de85ebd115e4ab7c79824cdbdc849c79f6e9";

//url da API
//$_SESSION["path"]= "http://odysseus-lens.ddns.net/PMCanvas6/";
$_SESSION["path"]= "http://localhost:8080/PMCanvas6/";


//form especialização para usar no json
$_SESSION["box"] = array("canvas_ticket","entrega_canvas_ticket","linha_tempo_canvas_ticket","risco_canvas_ticket","custo_canvas_ticket");

?>
