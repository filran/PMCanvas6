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
$_SESSION["path"]= "http://odysseus-lens.ddns.net/PMCanvas6/";

?>
