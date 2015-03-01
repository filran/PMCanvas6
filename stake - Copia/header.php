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
    	body{
    		background-color: lightyellow;
    		padding: 20px;

    		background: -webkit-radial-gradient(ellipse cover, #fff, #bbb); /*web kit*/
			background: -moz-radial-gradient(ellipse cover, #fff, #bbb);/*mozilla*/
			background: -ms-radial-gradient(circle cover, #fff, #bbb); /*internet explorer*/
    	}

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

	<div class="page-header">
		<h1><?php echo $titulo; ?></h1>
	</div>
