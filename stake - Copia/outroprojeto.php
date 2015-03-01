<?php
session_start();
include("../bd/User.php");

#echo "outro projeto";

$user = new User();
$remove = $user->removecanvas($_SESSION["id"]);
if( $remove ){
	header("Location: ../");
}else{
	echo "Erro!";
}
?>
