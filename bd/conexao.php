<?php
$conexao = @mysql_connect("localhost","root","")or die("Erro ao conectar<br>".mysql_error());
$db = @mysql_select_db("pmcanvas")or die("Erro ao selecionar o BD<br>".mysql_error());
?>
