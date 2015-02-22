<?php
$titulo = "Login";
include("../header.php");
include("../../bd/User.php");
?>

<?php
if( isset($_POST["btn-login"]) ){
	$user = new User();

	$dados = $user->login( $_POST["login"] , $_POST["email"] );

	//validar
	if( $dados ){
		$_SESSION["id"] = $dados["id"];
		$_SESSION["login"] = $dados["login"];
		$_SESSION["email"] = $dados["email"];
		$_SESSION["nome"] = $dados["nome"];
		$_SESSION["foto"] = $dados["foto"];

		$user->gravacanvas( $_SESSION["id"], $_SESSION["canvas_id"] );

		header("Location: ../enviapostit/");
	}else{
		echo '<div class="alert alert-danger" role="alert">Login ou e-mail não conferem. <button type="button" id="btn-cad" name="btn-cad" class="btn btn-danger">Cadastrar?</button></div>';
	}
}
?>

<form id="form-login" name="form-login" method="POST">
  <div class="form-group">
    <label for="login">Login</label>
    <input type="text" class="form-control" id="login" name="login" placeholder="">
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="">
  </div>
  <button type="submit" class="btn btn-primary" id="btn-login" name="btn-login">Enviar</button>
</form>

<script type="text/javascript">
$(function(){
	//validação
	$("#form-login").submit(function(){
		var login = $("#login").val();
		var email = $("#email").val();

		if( login=="" || email=="" ){
			alert("Digite os campos corretamente");
			return false;
		}
	});

	//ir para página de cadastro
	$("#btn-cad").click(function(){
		location.href = "../cadastrar/" ;
	});
});
</script>

<?php include("../foot.php"); ?>
