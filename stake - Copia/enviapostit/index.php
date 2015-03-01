<?php
$titulo = "Enviar Post-it";
include("../header.php");

if( isset($_SESSION["id"]) ){
?>

<div id="dados" name="dados">
	<div id="dados_projeto" name="dados_projeto" project_id="<?php echo $_SESSION['project_id']; ?>" ></div>
	<div id="dados_canvas" name="dados_canvas" canvas_id="<?php echo $_SESSION['canvas_id']; ?>" ></div>
</div>

<div id="menu" name="menu">
	<form name="form-enviapostit" id="form-enviapostit">
	<span><em>Olá, <?php echo $_SESSION["nome"];?></em></span>
	<div class="form-group" style="text-align:right">
	<button type="button" class="btn btn-default btn-sm btn-info " id="btn-edit" name="btn-edit"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar seus dados</button>
	<button type="button" class="btn btn-default btn-sm btn-info" id="btn-logoff" name="btn-logoff"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Logoff</button>
	</div>
</div>

  <div class="form-group">  
    <label for="canvas_box">Escolha uma área do Canvas</label>
	<select id="canvas_box" class="form-control">
		<option value="0"></option>
		<option value="1">Justificativas</option>
		<option value="2">Obj Smart</option>
		<option value="3">Benefícios</option>
		<option value="4">Produto</option>
		<option value="5">Requisitos</option>
		<option value="6">Stakeholders</option>
		<option value="8">Equipe</option>
		<option value="7">Premissas</option>
		<option value="9">Grupo de Entregas</option>
		<option value="10">Restrições</option>
		<option value="11">Riscos</option>
		<option value="12">Linha do Tempo</option>
		<option value="13">Custos</option>
	</select>
  </div>
  <div class="form-group">
    <label for="texto">Digite o texto do post-it</label>
 	<textarea id="texto" class="form-control" rows="6"></textarea>
 	<span><span id="content-countdown" title="150">150</span></span>
  </div>
  <div class="form-group">
  	<button type="submit" name="submit-enviapostit" id="submit-enviapostit" class="btn btn-primary btn-lg btn-block"><span class="glyphicon glyphicon-send" aria-hidden="true"></span> Enviar</button>
  </div>

  <div class="form-group">
	<button type="button" class="btn btn-default btn-lg btn-block" id="btn-outro" name="btn-outro"><span class="glyphicon glyphicon-random" aria-hidden="true"></span> Escolher outro projeto</button>
  </div>
</form>

<script type="text/javascript">
$(function(){
	var dominio = "http://localhost/PMCanvas5.0/";
	//var dominio = "http://odysseus-lens.ddns.net/PMCanvas5.0/";
	var project_id = $("#dados_projeto").attr("project_id");
	var canvas_id  = $("#dados_canvas").attr("canvas_id"); 
	var url = dominio+"projects/"+project_id+"/canvas_projects/"+canvas_id+"/canvas_tickets.json";

	//validar formulario
	$("#submit-enviapostit").click(function(){
		var canvas_box = $("#canvas_box").val();
		var texto = $("#texto").val();

		if( canvas_box == 0 ||  texto==""){
			alert("Digite os dados corretamente");
			return false;
		}else{
			postTicket(project_id,canvas_id,canvas_box,texto);
			/*$.mockjax({
			//$.ajax({
				url: url,
				type: "POST",
				dataType: "json",
				data: '{"text":"'+texto+'", "canvas_box_id":'+canvas_box+', "canvas_project_id":'+canvas_id+'}'
			});
			
			alert('Mock OK\n'+'{"text":"'+texto+'", "canvas_box_id":'+canvas_box+', "canvas_project_id":'+canvas_id+'}');*/
		}
	});

	$("#btn-outro").click(function(){
		location.href = "../outroprojeto.php";
	});

	$("#btn-logoff").click(function(){
		location.href = "../logoff.php";
	});

	$("#btn-edit").click(function(){
		location.href = "../editar/";
	});
	

	//contador regressivo
	$("textarea").keyup(function(event){		 
		// abaixo algumas variáveis que iremos utilizar.
		// pega a span onde esta a quantidade máxima de caracteres.
		var target    = $("#content-countdown");
		// pego pelo atributo title a quantidade maxima permitida.
		var max        = target.attr('title');
		// tamanho da string dentro da textarea.
		var len     = $(this).val().length;
		// quantidade de caracteres restantes dentro da textarea.
		var remain    = max - len;
		// caso a quantidade dentro da textarea seja maior que
		// a quantidade maxima.
		if(len > max)
		{
			// abaixo vamos pegar tudo que tiver na string e limitar
			// a quantidade de caracteres para o máximo setado.
			// isso significa que qualquer coisa que seja maior que
			// o máximo será cortado.
			var val = $(this).val();
			$(this).val(val.substr(0, max));

			// setamos o restante para 0.
			remain = 0;
		}
		// atualizamos a quantidade de caracteres restantes.
		target.html(remain);
	});
});
</script>
<?php }else{ ?>
<div class="alert alert-danger" role="alert"><b>Página restrita!</b></div>
<button type="button" class="btn btn-danger" id="btn-logar" name="btn-logar">Logue-se</button> ou 
<button type="button" class="btn btn-danger" id="btn-cad" name="btn-cad">Cadastre-se</button>

<script type="text/javascript">
$(function(){
	$("#btn-logar").click(function(){
		location.href = "../login/" ;
	});

	$("#btn-cad").click(function(){
		location.href = "../cadastrar/" ;
	});
});
</script>


<?php } ?>
<?php include("../foot.php"); ?>
