<?php
session_start();
include("../bd/User.php");

$user = new User();
$user->removecanvas( $_SESSION["id"] );

session_destroy();
header("Location: ../");
?>
