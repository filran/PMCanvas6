<?php
$titulo = "Cadastro de Usuário";
include("../header.php");
include("../../bd/User.php");

if( isset($_POST["btn-cad"]) ){
	$user = new User();
	$dados = $user->cadastra( $_POST["login"], $_POST["email"], $_POST["nome"] , $_SESSION["canvas_id"], "");

	if( !$dados ){
		echo '<div class="alert alert-danger" role="alert">Esses dados já foram cadastrados. <button type="button" class="btn btn-danger" id="btn-logar" name="btn-logar">Tente logar!</button></div>';
	}else{
		$dados = $user->login($_POST["login"],$_POST["email"]);
	
		$_SESSION["id"] = $dados["id"];
		$_SESSION["login"] = $dados["login"];
		$_SESSION["email"] = $dados["email"];
		$_SESSION["nome"] = $dados["nome"];
		$_SESSION["foto"] = $dados["foto"];
	
		echo '<div class="alert alert-success" role="alert">Perfeito! Dados cadastrados com sucesso. <button type="button" class="btn btn-success" id="btn-enviapostit" name="btn-enviapostit">Enviar post-its!</button></div>';
	}
}

?>

<form id="form-cad" name="form-cad" method="POST">
  <div class="form-group">
    <label for="login">Login</label>
    <input type="text" class="form-control" id="login" name="login" placeholder="">
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="">
  </div>
  <div class="form-group">
    <label for="nome">Nome</label>
    <input type="text" class="form-control" id="nome" name="nome" placeholder="">
  </div>
  <div class="form-group">
    <label for="foto">Foto</label>
    <input type="file" class="form-control" id="foto" name="foto" placeholder="">
  </div>  
  <button type="submit" class="btn btn-primary" id="btn-cad" name="btn-cad">Enviar</button>
</form>

<script type="text/javascript">
$(function(){
	//validação
	$("#form-cad").submit(function(){
		var login = $("#login").val();
		var email = $("#email").val();
		var nome = $("#nome").val();
		//var foto = $("#foto").val();

		if( login=="" || email=="" || nome == "" ){
			alert("Digite os campos corretamente");
			return false;
		}
	});

	$("#btn-logar").click(function(){
		location.href = "../login/" ;
	});

	$("#btn-enviapostit").click(function(){
		location.href = "../enviapostit/" ;
	});

	
});
</script>


<?php include("../foot.php"); ?>
