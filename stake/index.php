<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Enviar Post-it</title>

    <style>
    	.alinha_form{
    		position: absolute;
    	}

    	.alinha_form2{
    		margin-left: 70px;
    	}

    	#menu{
    		position:absolute;
    		top:5px;
    		right:20px;
    		text-align:right;
    	}
    	
    </style>

    <!-- Bootstrap -->
    <link href="<?php echo $_SESSION['path']; ?>scripts/bootstrap/css/bootstrap.min.css" rel="stylesheet">


	<!-- Theme Redmine -->
	<link href="<?php echo $_SESSION['path']; ?>stake/css/application.css" rel="stylesheet">
    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo $_SESSION['path']; ?>scripts/bootstrapjs/bootstrap.min.js"></script>  

	<!--Mock-->
	<script type="text/javascript" src="<?php echo $_SESSION['path']; ?>scripts/mockjax/jquery.mockjax.js"></script>
	<script type="text/javascript" src="<?php echo $_SESSION['path']; ?>scripts/mockjax/lib/json2.js"></script>

	<!--SOA JS-->
	<script type="text/javascript" src="<?php echo $_SESSION['path']; ?>scripts/soa.js"></script> 

	<!--CONFIG-->
	<script type="text/javascript" src="<?php echo $_SESSION['path']; ?>config/config.js"></script> 
      
  </head>
  <body>
  <div id="menu" name="menu">
	<a href="" id="fechar" onClick="window.close()"><img src="css/images/icons/cross-circle.png" /></a>
  </div>

	<div class="page-header">
		<h1>Enviar Post-it</h1>
	</div>


	<div id="dados" name="dados">
		<div id="dados_projeto" name="dados_projeto" project_id="<?php echo $_SESSION['project_id']; ?>" ></div>
		<div id="dados_canvas" name="dados_canvas" canvas_id="<?php echo $_SESSION['canvas_id']; ?>" ></div>
	</div>
	
	<form name="form-enviapostit" id="form-enviapostit">
	<fieldset>
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
	  	<button type="submit" name="submit-enviapostit" id="submit-enviapostit" class="btn btn-primary btn-lg btn-block">Enviar</button>
	  </div>
	</form>
	</fieldset>
	
	<script type="text/javascript">
	
	$(function(){
		//var dominio = "http://localhost/PMCanvas5.0/";
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

  </body>
</html>
