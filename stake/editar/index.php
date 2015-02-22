<?php
$titulo = "Atualizar seus dados";
include("../header.php");
include("../../bd/User.php");

if( isset($_POST["btn-edit"]) ){
	$dados["login"] = $_POST["login"];
	$dados["email"] = $_POST["email"];
	$dados["nome"] = $_POST["nome"];
	$dados["foto"] = "";

	$user = new User();
	$edit = $user->atualizadados( $_SESSION["id"] , $dados );

	if( !$edit ){
		echo '<div class="alert alert-danger" role="alert"><b>Ops!</b> Algo deu errado.</div>';
	}else{
		$dados = $user->login($_POST["login"],$_POST["email"]);
	
		$_SESSION["id"] = $dados["id"];
		$_SESSION["login"] = $dados["login"];
		$_SESSION["email"] = $dados["email"];
		$_SESSION["nome"] = $dados["nome"];
		$_SESSION["foto"] = $dados["foto"];
	
		echo '<div class="alert alert-success" role="alert">Perfeito! Dados atualizados com sucesso. <button type="button" class="btn btn-success" id="btn-enviapostit" name="btn-enviapostit">Enviar post-its!</button></div>';
	}
}

if( !isset($_SESSION["id"]) ){
?>
<div class="alert alert-danger" role="alert">Você não está logado. <button type="button" class="btn btn-danger">Logue-se!</button></div>
<?php
}else{
?>

<form id="form-edit" name="form-edit" method="POST">
  <div class="form-group">
    <label for="login">Login</label>
    <input type="text" class="form-control" id="login" name="login" placeholder="" value="<?php echo $_SESSION['login']; ?>">
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="" value="<?php echo $_SESSION['email']; ?>">
  </div>
  <div class="form-group">
    <label for="nome">Nome</label>
    <input type="text" class="form-control" id="nome" name="nome" placeholder="" value="<?php echo $_SESSION['nome']; ?>">
  </div>
  <div class="form-group">
    <label for="foto">Foto</label>
    <input type="file" class="form-control" id="foto" name="foto" placeholder="">
  </div>  
  <button type="submit" class="btn btn-primary" id="btn-edit" name="btn-edit">Atualizar</button>
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

	$("#btn-enviapostit").click(function(){
		location.href = "../enviapostit/" ;
	});

	
});
</script>

<?php } ?>
<?php include("../foot.php"); ?>
