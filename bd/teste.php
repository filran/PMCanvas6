<?php
include("User.php");

$user = new User();

#echo $user->cadastrar("filran","filran@gmail.com","Filipe Arantes","picture");

$dados = $user->login("filran","filran@gmail.com");
if(!$dados){
	echo "Erro ao logar";
}

#$gravacanvas = $user->gravacanvas($dados["id"],44);
#if(!$gravacanvas){
#	echo "Erro cad Canvas";
#}

#$novosdados["login"] = "asdf";
#$novosdados["email"] = "asdfasdf";
#$novosdados["nome"] = "asdfasdfasdf";
#$novosdados["foto"] = "asdfasdfasdfasdf";

#$atualiza = $user->atualizadados( $dados["id"], $novosdados);
#if(!$atualiza){
#	echo "Erro ao atualizar";
#}

#$remove = $user->removecanvas($dados["id"]);
#if(!$remove){
#	echo "Erro ao remomver canvas";
#}

?>
