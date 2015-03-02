<!DOCTYPE>
<html>
<head>
    <meta charset="utf-8"/>

	<!--configurção da API-->
	<?php include("config/config.php"); ?>
	<script type="text/javascript" src="config/config.js"></script>     

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

    <!--Proportion-->
    <script type="text/javascript" src="scripts/proportion.js"></script>

    <!--Redimensionar-->
    <script type="text/javascript" src="scripts/plugins/redimensionar.js"></script>

    <!--Expand-->
    <script type="text/javascript" src="scripts/plugins/expand/expand.js"></script>
    <link type="text/css" rel="stylesheet" href="scripts/plugins/expand/expand.css" >

    <!--Cortar texto-->
    <script type="text/javascript" src="scripts/plugins/cortar_texto.js"></script>

    <!--Canvas-->
    <link type="text/css" rel="stylesheet" href="styles/canvas.css">

	<!-- keyboard-->
	<script type="text/javascript" src="scripts/plugins/keyboard/keyboard_files/keyboard.js"></script>
	<link type="text/css" rel="stylesheet" href="scripts/plugins/keyboard/keyboard_files/style.css">

    <!--Fonts-->
	<link href='fontes/honey/stylesheet.css' rel='stylesheet' type='text/css'>

    <!--Cursor-->
    <script type="text/javascript" src="scripts/plugins/cursor/cursor.js"></script>   

	<!--Mock-->
	<script type="text/javascript" src="scripts/mockjax/jquery.mockjax.js"></script>
	<script type="text/javascript" src="scripts/mockjax/lib/json2.js"></script> 

	<!--Convertdate-->
	<script type="text/javascript" src="scripts/convertdate.js"></script>

	<!--Sparete Risk-->
	<script type="text/javascript" src="scripts/separaterisk.js"></script>
    
    <script type="text/javascript">              
        $(function(){  

        	//var fundo = $("#just").css("background-color");
        	//alert(fundo);
        
        	//obtendo os tickets
			getTickets();
        
			//var dominio = "http://localhost/PMCanvas5.0/";
			//var dominio = "http://odysseus-lens.ddns.net/PMCanvas5.0/";
			var project_id = $("#dados_projeto").attr("project_id");
			var canvas_id  = $("#dados_canvas").attr("canvas_id"); 
                 
            //#WRAP=======================================
            //Redimensionar
            $("#wrap").redimensionar();
            window.onresize = function(){
                $("#wrap").redimensionar();
            }


            //.RECEBERPOST-IT=======================================
            $(".receberpostit")
                .addClass("scrollable")//add scrollable
                .disableSelection(); // disable sortable


            //UL.RECEBERPOSTIT=======================================
            //sortable
            $( "ul.receberpostit" )
                .sortable({
                    connectWith: "ul.receberpostit",
                    stop: function(event,ui){ //Atualizar quando mudar de BOX
	                    item = ui.item;	                    
                    	canvas_box_id = $(item).parent().parent().attr("canvas_box_id"); //Box que está recebendo novo post-it
                    	id = $(item).attr("postit-id"); 

						if( canvas_box_id==11 || canvas_box_id==12 || canvas_box_id==13 ){
							alert("Não é possível receber este post-it!");
						}else if(canvas_box_id==1 || canvas_box_id==2 || canvas_box_id==3 || canvas_box_id==4 || canvas_box_id==5 || canvas_box_id==6 || canvas_box_id==7 || canvas_box_id==8 || canvas_box_id==9 || canvas_box_id==10){
							putBox(project_id,canvas_id,canvas_box_id,id); 
						}						                   	
                    }
                })
                .on("dblclick","li",function(){ //expand (o método ON é para aplicar nos objetos criados dinamicamente)
                    $(this).expand("postit");
                    fechar_lixeira(100);
                })
                .on("mousedown","li",function(){
                    abrir_lixeira(100);
                })
                .on("mouseup","li",function(){
                    fechar_lixeira(100);
                });

            //#AREA > LI > UL.RECEBERPOSTIT=======================================
            $( "#area > li > ul.receberpostit" )
                .on("mouseup","li",function(){
                	//o this é o <li class=postit>
                    atualizar_areacandidata(this);
                })



            //.POSTITS=======================================
            //abrir e fechar openpostits
            $(".postits")
                .css({"visibility":"hidden"})
                .draggable({})
                .dblclick(function(){
                    $(this).fadeOut(100,function(){
                        $(this).css({"visibility":"hidden"});
                    });
                });
                                
            //AUTOAJUSTAR POSTITS================================
            /*
            ler quantidade de colunas
            ler largura,margin e padding de cada postit
            ler margin e padding do wrap
            descobrir largura para caber os postits{
                largura postit = margim e padding da dir e esq + largura
                largura total dos post-its = largura postit * quantidade de postit + padding da esq e da dir do wrap                
            }           
            */


            //.POSTITS .POSTIT=======================================
            $(".postits .postit")
                .hide();


            //.OPENPOSTIT=======================================
            $(".openpostits")
                .draggable({
                    containment:"window",
                })
                .mousedown(function(){
                    $("#area > li")
                        .droppable({
                            accept:".openpostits",
                            activate:function(event,ui){
                                ocultarPostits();
                                $(".postits").attr("drop","auto");
                            },
                            drop:function(event,ui){
                                id = $(this).attr("id");
                                mostrarPostits(id);
                            }
                        });                                      
                })
                .click(function(event,ui){
                    visibility = $(".postits").css("visibility");
                    drop = $(".postits").attr("drop");

                    //mostrar somente quando estiver na área
                    if( drop!="auto" && drop!="out" ){
                        if( visibility=="visible" ){
                            ocultarPostits();
                        }else{
                            mostrarPostits(drop);
                        }
                    }                
                });
                        function mostrarPostits(id){       
                            var cont=0; 
                            $(".postits .postit[areacandidata="+id+"]")             
                                .each(function(i){
                                    if( i>=0 ){
                                        $(this).show();
                                        $(".postits").css({"visibility":"show"}).fadeIn(100);
                                        $(".postits").attr("drop",id);
                                        cont++;
                                    }
                                });
                            if( cont==0 ){
                                alert("Não há post-it.");
                            }
                        }
                        function ocultarPostits(){
                            $(".postits").fadeOut(100,function(){
                                $(this).css({"visibility":"hidden"});
                                $(".postits .postit").hide();
                            });                
                        }  

            //NEWPOSTIT=======================================
            //draggable
            $(".newpostit")
                .draggable({
                    containment:"window",                
                })
                .mousedown(function(){
                    criar_novopostit();
                })
                .mouseenter(function(){
                    //criar_novopostit_com_click();
                });
                                                          

            //#AREA > LI=======================================
            $("#area > li")
                .each(function(){ //inserir ícone de zoom nas áreas do canvas
                    idarea = $(this).attr("id");
                    $(this).append("<div class='zoomarea'><a href='#' id='zoomarea_"+idarea+"'>+</a></div>");
                });               
                        



            //DIV.ZOOMAREA A=======================================                               
            $("div.zoomarea a")
                .dblclick(function(){ //expand   
                    $(this).expand("area");
                });
                

            //CORTAR TEXTO DOS POST-IT=======================================
            //$(".postit")
                //.cortar_texto(50);
                    

            //.TEXTO=======================================
            $(".texto")
                .css({"visibility":"hidden"});  

            //CONTEINER_KEYBOARD=======================================
            $("#container_keyboard")
                .draggable(); 


            //LIXEIRA=======================================
            $("#lixeira").droppable({
                accept:".postit",
                tolerance:"touch",
                drop:function(event,ui){
					var id = $(ui.draggable).attr("postit-id");
                    $(ui.draggable).remove();
					deleteTicket(project_id,canvas_id,id);
                }
            });

			//MENU LATERAL
			$("#seta a").click(function(event,ui){
				if( $("#menuitens").attr("status")=="hidden" ){
					$("#menuitens").attr("status","show");
					$("#menuitens").css("width","140");
				}else{
					$("#menuitens").attr("status","hidden");
					$("#menuitens").css("width","80");
				}
			});


            //FUNÇÕES==============================
            //ID ÚNICO (construido por data, mês, ano, hora, minuto, segundos, milisegundos e index)
            function idunico(dom){
                var data = new Date();
                var id_unico_data = data.getDate()+""+data.getMonth()+""+data.getYear()+""+data.getHours()+""+ data.getMinutes()+""+data.getSeconds()+""+data.getMilliseconds();  
                var index = $(dom).index();
                
                return id_unico_data+index;
            }
            
            //CRIAR NOVO POST-IT
            function cerne_para_criar_post_it(id){
                //cria o postit
                $("#"+id+" > ul.receberpostit")
                    .append('<li class="postit" autor="Filipe Arantes" areacandidata="'+id+'"></li>');
                var ultimo_postit = "#"+id+" > ul.receberpostit > li:last"; //ultimo post-it
                var id_unico = idunico(ultimo_postit); //cria id unico

                //set o id do post-it
                $(ultimo_postit).attr("postit-id",id_unico);
                
                //expande o post-it        
                $(ultimo_postit)
                    .expand("newpostit");                
            }            
            function criar_novopostit(){ // criar novo post-it com mousedown
                $("#area > li")
                    .droppable({
                        accept:".newpostit",
                        drop: function(event,ui){ 
                            var id = $(this).attr("id");  //id da area
                            cerne_para_criar_post_it(id);
                        }                           
                    });    
            }
            function criar_novopostit_com_click(){
                var id_unico = idunico();
                $("#area > li")
                    .droppable({
                        over: function(event,ui){
                            var id = $(this).attr("id");                             
                            $(ui.draggable).click(function(){
                                cerne_para_criar_post_it(id);
                            });
                        }
                    });
            }
            
            //LIXEIRA
            function abrir_lixeira(time){
                clearTimeout(this.downTimer);
                this.downTimer = setTimeout(function() {
                    $("#lixeira").animate({"top":"0"},time);
                },500);
            }
            function fechar_lixeira(time){
                clearTimeout(this.downTimer);
                $("#lixeira").animate({"top":"-50"},time);
            }


            function atualizar_areacandidata(seletor){
                var id = $(seletor).parent().parent().get(0).id; //id area
                $(seletor).attr("areacandidata",id);

                /*if( id!="riscos" || id!="tempo" || id!="custos" ){
		            data_inicio = null;
		            data_fim = null; 
		            causa = null;
		            efeito = null;
		            quantidade = null;
		            valor = null;
		            canvas_ticket_id = null;		                           	
                }

                if(id=="just"){
					canvas_box_id = 1;
                }else if(id=="obj"){
                	canvas_box_id = 2;
                }

	            depois = $(seletor).html();
				idpostit = $(seletor).attr("postit-id");*/

				//alert( id+"-"+canvas_box_id );

                //putTicket(project_id,canvas_id,canvas_box_id,data_inicio,data_fim,depois,causa,efeito,quantidade,valor,canvas_ticket_id,idpostit);
            }


        });
     </script>

<style type="text/css">

	#menulateral{
		background-color:;
		position:absolute;
		top:80px;
		left:-80px;
		z-index:1;
	}

	#menulateral a{
		display:block;
		padding:6px;
	}

	#seta{
		background-color:white;
		float:left;
		width:40px;
		height:40px;
		border-radius: 0 50% 50% 0;
	}

	#seta img{
		margin-top:6;
		margin-left:4;
	}

	#menuitens{
		background-color:white;
		float:left;
		width:80px;
		text-align:right;

		-webkit-transition: width 0.75s; /* For Safari 3.1 to 6.0 */
		transition: width 0.75s;
	}
</style>
</head>
<body>
<div id="dados" style="visibility:visible; position:none">
	<span id="dados_projeto" project_id="<?php echo $_POST['projetos']; ?>"></span>
	<span id="dados_canvas" canvas_id="<?php echo $_POST['canvas_id']; ?>"></span>
</div>


<div id="menulateral">
	<div id="menuitens" status="hidden">
		<a href="#"><img src="imagens/icones/save.png" width="40" height="40"></a>
		<a href="#"><img src="imagens/icones/user.png" width="40" height="40"></a>
		<a href="#"><img src="imagens/icones/user.png" width="40" height="40"></a>
		<a href="#"><img src="imagens/icones/user.png" width="40" height="40"></a>
		<a href="#"><img src="imagens/icones/user.png" width="40" height="40"></a>
		<a href="#"><img src="imagens/icones/user.png" width="40" height="40"></a>
		<a href="#"><img src="imagens/icones/user.png" width="40" height="40"></a>
		
	</div>
	<div id="seta"><a href="#"><img src="imagens/icones/menulateral.png" /></a></div>
</div>

<div class="openpostits"><span>P's</span></div>
<div class="newpostit"><span>NP</span></div>
<div id="lixeira"><img src='imagens/icones/dustbin.png'/></div>

<div id="teclado">
    <div id="container_keyboard">
	    <ul id="keyboard">
		    <li class="symbol"><span class="off">`</span><span class="on">~</span></li>
		    <li class="symbol"><span class="off">1</span><span class="on">!</span></li>
		    <li class="symbol"><span class="off">2</span><span class="on">@</span></li>
		    <li class="symbol"><span class="off">3</span><span class="on">#</span></li>
		    <li class="symbol"><span class="off">4</span><span class="on">$</span></li>
		    <li class="symbol"><span class="off">5</span><span class="on">%</span></li>
		    <li class="symbol"><span class="off">6</span><span class="on">^</span></li>
		    <li class="symbol"><span class="off">7</span><span class="on">&amp;</span></li>
		    <li class="symbol"><span class="off">8</span><span class="on">*</span></li>
		    <li class="symbol"><span class="off">9</span><span class="on">(</span></li>
		    <li class="symbol"><span class="off">0</span><span class="on">)</span></li>
		    <li class="symbol"><span class="off">-</span><span class="on">_</span></li>
		    <li class="symbol"><span class="off">=</span><span class="on">+</span></li>
		    <li class="delete lastitem">delete</li>
		    <li class="tab">tab</li>
		    <li class="letter">q</li>
		    <li class="letter">w</li>
		    <li class="letter">e</li>
		    <li class="letter">r</li>
		    <li class="letter">t</li>
		    <li class="letter">y</li>
		    <li class="letter">u</li>
		    <li class="letter">i</li>
		    <li class="letter">o</li>
		    <li class="letter">p</li>
		    <li class="symbol"><span class="off">[</span><span class="on">{</span></li>
		    <li class="symbol"><span class="off">]</span><span class="on">}</span></li>
		    <li class="symbol lastitem"><span class="off">\</span><span class="on">|</span></li>
		    <li class="capslock">caps lock</li>
		    <li class="letter">a</li>
		    <li class="letter">s</li>
		    <li class="letter">d</li>
		    <li class="letter">f</li>
		    <li class="letter">g</li>
		    <li class="letter">h</li>
		    <li class="letter">j</li>
		    <li class="letter">k</li>
		    <li class="letter">l</li>
		    <li class="symbol"><span class="off">;</span><span class="on">:</span></li>
		    <li class="symbol"><span class="off">'</span><span class="on">"</span></li>
		    <li class="return lastitem">return</li>
		    <li class="left-shift">shift</li>
		    <li class="letter">z</li>
		    <li class="letter">x</li>
		    <li class="letter">c</li>
		    <li class="letter">v</li>
		    <li class="letter">b</li>
		    <li class="letter">n</li>

		    <li class="letter">m</li>
		    <li class="symbol"><span class="off">,</span><span class="on">&lt;</span></li>
		    <li class="symbol"><span class="off">.</span><span class="on">&gt;</span></li>
		    <li class="symbol"><span class="off">/</span><span class="on">?</span></li>
		    <li class="right-shift lastitem">shift</li>
		    <li class="space lastitem">&nbsp;</li>
	    </ul>
    </div>
</div>


<ul id="postits" class="postits" drop="auto">
    <ul class="receberpostit"> 
    	<!--<li postit-id="999" class="postit" autor="" areacandidata="just" style="display: block; z-index: 1;">teste</li>
    	<li postit-id="888" class="postit" autor="" areacandidata="obj" style="display: block; z-index: 1;">teste</li>-->
    </ul>        
</ul>

<div id="wrap" class="centralizar_div">
    <ul id="pmcanvas">
        <ul id="header">
            <li id="gp"><div><h1>GP</h1><span id="srv_gp"><?php echo $_POST["gp"]; ?></span></div></li>
            <li id="pitch"><div><h1>PITCH</h1><span id="srv_pitch"><?php echo $_POST["pitch"]; ?></span></div></li>
        </ul>

        <ul id="area" class="area">
            <li id="just" canvas_box_id="1" class="margem_direita margem_embaixo">
                <img src="imagens/icones/chat.png"/>
                <h1>JUSTIFICATIVAS<span id="passado">Passado</span></h1>
                <ul class="receberpostit"></ul>
            </li>

            <li id="prod" canvas_box_id="4" class="margem_direita margem_embaixo">
                <img src="imagens/icones/gift.png"/>         
                <h1>PRODUTO</h1>
                <ul class="receberpostit"></ul>
            </li>
            
            <li id="stake" canvas_box_id="6" class="margem_direita margem_embaixo">
                <img src="imagens/icones/stake.png"/> 
                <h1>STAKEHOLDERS<span id="externos">EXTERNOS</span><span id="fatores_externos">& Fatores Externos</span></h1>
                <ul class="receberpostit"></ul>
            </li>
            
            <li id="premissas" canvas_box_id="7" class="margem_direita margem_embaixo">
                <img src="imagens/icones/cloud.png"/>
                <h1>PREMISSAS</h1>
                <ul class="receberpostit"></ul>
            </li>
            
            <li id="riscos" canvas_box_id="11" canvas_box_id="" class="margem_embaixo">
                <img src="imagens/icones/bombtext.png"/>
                <h1>RISCOS</h1>
                <ul class="receberpostit"></ul>
            </li>


            <li id="obj" canvas_box_id="2" class="margem_direita margem_embaixo">
                <img src="imagens/icones/target.png"/>
                <h1>OBJ SMART</h1>
                <ul class="receberpostit"></ul>
            </li>

            <li id="requisitos" canvas_box_id="5" class="margem_direita">
                <img src="imagens/icones/doc.png"/>  
                <h1>REQUISITOS</h1>
                <ul class="receberpostit"></ul>
            </li>
            
            <li id="equipe" canvas_box_id="8" class="margem_direita margem_embaixo margem_esquerda">
                <img src="imagens/icones/users.png"/>
                <h1>EQUIPE</h1>
                <ul class="receberpostit"></ul>
            </li>
            
            <li id="entregas" canvas_box_id="9" class="margem_direita margem_embaixo">
                <img src="imagens/icones/box.png"/>
                <h1>GRUPO DE <br>ENTREGAS</h1>
                <ul class="receberpostit"></ul>
            </li>
            
            <li id="tempo" canvas_box_id="12" class="margem_embaixo">
                <img src="imagens/icones/timeline.png"/>
                <h1>LINHA DO TEMPO</h1>
                <ul class="receberpostit"></ul>
            </li>


            <li id="beneficios" canvas_box_id="3" >
                <img src="imagens/icones/chart.png"/>
                <h1>BENEFÍCIOS</h1>
                <ul class="receberpostit"></ul>
            </li>
         
            <li id="restricoes" canvas_box_id="10" >
                <img src="imagens/icones/blocked.png"/>
                <h1>RESTRIÇÕES</h1>
                <ul class="receberpostit"></ul>
            </li> 

            <li id="custos" canvas_box_id="13" >
                <img src="imagens/icones/custos.png"/>
                <h1>CUSTOS</h1>
                <ul class="receberpostit"></ul>
            </li>          
        </ul>     
    </ul>
</div>

<script type="text/javascript" src="scripts/soa.js"></script>

<!--LER JSON-->
<!--<script type="text/javascript" src="json/get_postits.js"></script>-->

<!--Atualiza -->
<script type="text/javascript" src="scripts/atualiza.js"></script>

</body>
</html>
