<?php
session_start();
// Allow from any origin
header('Access-Control-Allow-Origin: *');
?>

<!DOCTYPE>
<html>
<head>
    <meta charset="utf-8"/>

	<style>

		body{
			font-family:"Arial";
			margin:0;
			padding:0;
			overflow:hidden;     
			background: -webkit-radial-gradient(ellipse cover, #fff, #bbb); /*web kit*/
			background: -moz-radial-gradient(ellipse cover, #fff, #bbb);/*mozilla*/
			background: -ms-radial-gradient(circle cover, #fff, #bbb); /*internet explorer*/
		}

		#main{
			background-color:;
			width:700px;
			height:250px;
			position:absolute;
			margin-top:-125px;
			margin-left:-350px;
			top:50%;
			left:50%;
			text-align:center;
		}

		select, #submit{
			font-size:14pt;
			padding:8px;
			margin: 4px;
			border:0;
			background-color:lightblue;
		}

	</style>

	<!--configurção da API-->
	<?php include("config/config.php"); ?>
	<script type="text/javascript" src="config/config.js"></script> 
	<script type="text/javascript" src="scripts/soa.js"></script> 

    <!--jQuery + jQuery UI-->
    <!--jQuery 1.8-->
<!--	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>-->
<!--	<script type="text/javascript">-->
<!--	    var jq18 = jQuery.noConflict();-->
<!--    </script>-->
        
    <!--jQuery 2.1-->
    <script type="text/javascript" src="scripts/jquery/jquery-2.1.0.js"></script>        
	 
    <script type="text/javascript" src="scripts/jquery-ui/jquery-ui-1.10.4.custom.js"></script>
    <link type="text/css" rel="stylesheet" href="scripts/jquery-ui/jquery-ui-1.10.4.custom.css">
    
    <!--Ler dados do JSON-->
	<!--Obter projetos
	<script type="text/javascript" src="json/get_projects.js"></script>-->

	<script type="text/javascript">
	
		$(function(){
			$.support.cors = true;
			//var dominio = "http://localhost/PMCanvas5.0/";
			//var dominio = "http://odysseus-lens.ddns.net/PMCanvas5.0/";
		
			$('#papel').change(function() {
				var papel = $('#papel option:selected').attr("value");
				
				if( papel == "gp" ){
					$("form").attr("action","canvas.php");
					$("form").attr("method","POST");
					$("#submit").css("visibility","visible");
				}else if(papel == "stake"){
					$("form").attr("action","stake");
					$("form").attr("method","GET");
					$("#submit").css("visibility","visible");
				}
			});

			//chama os projetos e seus canvas
			getProjetcs();
			getCanvas();
		});
		
	</script> 

</head>
<body>
	<div id="main">
		<div id="header"><img src="imagens/pmcanvas.png" /><h1>PMCanvas<br>Modo Quadro Interatito</h1></div>
		<div id="formulario">
			<form method="" target="_blank">
				<select name="projetos" id="projetos">
					<option value="-1">Escolha um projeto</option>
					<option value="0">----------</option>					
				</select>
				<input type="hidden" id="canvas_id" name="canvas_id" value="0" />
				<input type="hidden" id="gp" name="gp" value="0" />
				<input type="hidden" id="pitch" name="pitch" value="0" />
				<br><select name="papel" id="papel" style="visibility:hidden">
					<option value="0">Entrar como</option>
					<option value="0">---------</option>
					<option value="gp">Gerente</option>
					<option value="stake">Stakeholder</option>
				</select>
				<br><input id="submit" type="submit" name="submit" value="Abrir" style="visibility:hidden">
			</form>
		</div>
	</div>
</body>
<!--<script type="text/javascript" src="json/get_canvas.js"></script>-->
</html>
