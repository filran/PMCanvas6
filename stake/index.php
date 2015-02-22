<?php
$titulo = "Página Principal";
include("header.php");
include("../bd/User.php");

$_SESSION["project_id"] = $_GET["projetos"];
$_SESSION["canvas_id"] = $_GET["canvas_id"];

//1- IF não está logado THEN

	//2-Mostrar botões de login e cadastrar

	//3- IF cadastrar THEN
		//3.1- mostrar formulário para cadastrar e validar cadstro
		//3.2 ir para a página Enviar Postit
		
	//4- ELSE IF Login THEN
		//4.1 mostrar form para logar e validar
		//4.2 IF não conter login, ir para cadastrar
		//4.3 IF logado ir para a página Enviar Postit

//5 - Mostrar página Enviar Postit

if( !isset($_SESSION["id"]) ){
?>

<div class="alert alert-warning" role="alert">Você ainda não está logado. Clique em uma das opções abaixo</div>

<div class="form-group">
	<button type="button" class="btn btn-primary" id="btn-logar" name="btn-logar">Login</button> ou 
	<button type="button" class="btn btn-primary" id="btn-cad" name="btn-cad">Cadastro</button>
</div>

<script type="text/javascript">
$(function(){
	$("#btn-logar").click(function(){
		location.href = "login/" ;
	});

	$("#btn-cad").click(function(){
		location.href = "cadastrar/" ;
	});
});
</script>

<?php
}else{
	$user = new User();
	echo $_GET["canvas_id"];
	
	$canvas = $user->gravacanvas( $_SESSION["id"], $_GET["canvas_id"] );

	if( $canvas ){
		header("Location: enviapostit/");
	}else{
		echo "Ops! Alguma coisa não está funcionando bem :( <br>Volte em breve!";
		header("Location: logoff.php");
	}
	
	
}
?>

<?php include("foot.php"); ?>
