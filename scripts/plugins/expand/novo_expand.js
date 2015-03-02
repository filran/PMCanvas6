/*This plugin is for expand o postit or canvas's area*/


(function($){  

    //open expand
    $.fn.expand = function( tipo ){
        //o tipo é se for para amplicar post ou área

		//var dominio = "http://localhost/PMCanvas5.0/";

        var time = 100; 

        $("<div id='backgroundexpand' class='backgroundexpand'></div>").appendTo("body");
        
        //EXPAND BACKGROUND
        $(".backgroundexpand").css({"z-index":"1","opacity":0}).addClass("com_fundo");
        $(".backgroundexpand").animate({"opacity":1},time);

        if( tipo=="postit" || tipo=="newpostit"){
            //create elements
            $("<div bigpostit-id='' class='bigpostit'></div>").appendTo(".backgroundexpand");

            var id = $(this).attr("postit-id");
            var autor = $(this).attr("autor");
            var areacandidata = $(this).attr("areacandidata");
            
            var selector = "li[postit-id="+id+"]";
            var selectorbig = "div[bigpostit-id="+id+"]";
            var time = 100; 
            var content = $(selector).html(); 

			var project_id = $("#dados_projeto").attr("project_id");
			var canvas_id  = $("#dados_canvas").attr("canvas_id"); 
			var canvas_box_id = $(this).parent().parent().attr("canvas_box_id");

			var data_inicio = null;
			var data_fim = null;
			var causa = null;
			var efeito = null;
			var valor = null;
			var quantidade = null;
			var canvas_ticket_id = null;

			var fechar_tipo = "fechar"; 

            $(selector).animate({"opacity":"0"});
            $("div[bigpostit-id]").attr("bigpostit-id",id);            
            $(selectorbig).animate({"opacity":"1"},time);

            //inserindo icones e conteudo do postit
            $(".bigpostit")
                .append("<div id='autor'>Autor:"+autor+"</div>")
                .append("<div><a href='#' id='fechar'><img src='imagens/icones/right.png'/></a></div>") //Botão Fechar
                .append("<div><a href='#' id='abrirteclado'><img src='imagens/icones/keyboard.png'/></a></div>")
                .append("<div><a href='#' id='excluir'><img src='imagens/icones/dustbin.png'/></a></div>")

				if( canvas_box_id==12 ){ //LINHA DO TEMPO
					if( content != "" ){
						d = bordertoinput(content);
						data_inicio = bordertodesk(d[0]);
						data_fim = bordertodesk(d[1]);
					}
				
					conteudo_data = "<div id='data_div' name='data_div'><div><label>Grupo de Entregas:</label><br><select id='entrega' name='entrega'><select></div><div><label>Data início:</label><br><input type='date' id='data_inicio' name='data_inicio' value='"+data_inicio+"'/></div><div><label>Data fim:</label><br><input type='date' id='data_fim' name='data_fim' value='"+data_fim+"'/></div></div>";
					getentregas(project_id,canvas_id); //carrega as Entregas
					gettempo(project_id,canvas_id,id); //carrega das datas e selecioa entrega
					
					$(".bigpostit").append("<div id='wrapconteudopostit'>"+conteudo_data+"</div>");

				}else if(canvas_box_id==13){ //CUSTOS
					conteudo_data = "<div id='custos_div'><div><label>Texto:</label><br><input type='text' id='text_custo' name='text_custo' value=''></div><div><label>Quantidade:</label><br><input type='number' id='quantidade' name='quantidade' value=''></div><div><label>Valor:</label><br><input type='number' id='valor' name='valor' value=''></div></div>";
					
					$(".bigpostit").append("<div id='wrapconteudopostit'>"+conteudo_data+"</div>");

					getOneCusto(project_id,canvas_id,id);

				}else{

					$(".bigpostit").append("<div id='wrapconteudopostit'><p id='conteudopostit' class='write' contenteditable='true'>"+content+"</p></div>");
				}
                
               

            //CENTRALIZAR CONTEUDO DO POST-IT
            centralizar_conteudopostit();
            $("#conteudopostit")
                .keydown(function(){
                    centralizar_conteudopostit();
                }).mouseout(function(){
                    centralizar_conteudopostit();
                }).mouseover(function(){
                    centralizar_conteudopostit();
                }).click(function(){
                    $(this).attr("contenteditable","true");
                });

            $("#keyboard > li").click(function(){
                centralizar_conteudopostit();
            });

            if( tipo=="newpostit" ){
                //Indicar local para digitar
                $("#conteudopostit").focus();
            }

            //EXCLUIR POSTIT
            $("#excluir").click(function(){
				deleteTicket(project_id,canvas_id,id);
                fechar_postit("excluir"); 
            });  

            //ABRIR TECLADO
            $("#abrirteclado").click(function(){
                tecladovisivel = $("#teclado").css("display");
                if( tecladovisivel=="block" ){
                    $("#teclado").css("display","none");
                }else{
                    $("#teclado").css("display","block");                   
                }                
            });              

            //CLOSE
            $(".bigpostit > div").on("click","#fechar",function(){
            	
				if( tipo=="postit" ){
					//ATUALIZAR EDIÇÃO DE POSTIT NO SERVIDOR
					if( content == "" ){
						//NOVO POSTIT
					}else{
						//POSTIT RECUPERADO DO SERVIDOR
						var depois = $("#conteudopostit").html();

						if ( canvas_box_id == 12 ){ //TEMPO
							data_inicio = putdate($("#data_inicio").val());
							data_fim = putdate($("#data_fim").val());
							canvas_ticket_id = $("#entrega option:selected").attr("value");
							fechar_tipo = "tempo";

							//alert(canvas_ticket_id);

							putTicket(project_id,canvas_id,canvas_box_id,data_inicio,data_fim,depois,causa,efeito,quantidade,valor,canvas_ticket_id,id);
						}

						if( canvas_box_id == 13 ){	
							depois = $("#text_custo").val();
							quantidade = $("#quantidade").val();
							valor = $("#valor").val();
							fechar_tipo = "custos";

							putTicket(project_id,canvas_id,canvas_box_id,data_inicio,data_fim,depois,causa,efeito,quantidade,valor,canvas_ticket_id,id);
						}
			
						//se houver diferença enviar para servidor
						if( content != depois ){
							//putTicket(project_id,canvas_id,id,depois);

							if( canvas_box_id==11 ){
								t = separaterisk(depois);
								depois = t["risco"];
								causa = t["causa"];
								efeito = t["efeito"];
							}

							putTicket(project_id,canvas_id,canvas_box_id,data_inicio,data_fim,depois,causa,efeito,quantidade,valor,canvas_ticket_id,id);
						}
					}
				}else if( tipo=="newpostit" ){
				
					var depois = $("#conteudopostit").html();

					if( canvas_box_id==11 ){ //RISCO
					
						if( depois=="" ){
							alert("Digite todos os campos! Você deve seguir o exemplo:\nRisco:<texto>\nCausa:<texto>\nEfeito:<texto>");
							return false;
						}

						t = separaterisk_post(depois);
						depois = t["risco"];
						causa = t["causa"];
						efeito = t["efeito"];
					}

					if( canvas_box_id==12 ){ //TEMPO
						data_inicio = bordertodesk($("#data_inicio").val());
						data_fim = bordertodesk($("#data_fim").val());
						canvas_ticket_id = $("#entrega option:selected").attr("value");
						fechar_tipo = "tempo";

						if( !data_inicio || !data_fim || !canvas_ticket_id){
							alert("Digite todos os campos!");
							return false;
						}
					}

					if( canvas_box_id == 13 ){	
						depois = $("#text_custo").val();
						quantidade = $("#quantidade").val();
						valor = $("#valor").val();
						fechar_tipo = "custos";

						if( depois=="" || quantidade=="" || valor=="" ){
							alert("Digite todos os campos!");
							return false;
						}
					}
					
					//gravar ticket soa
					postTicket(project_id,canvas_id,canvas_box_id,data_inicio,data_fim,depois,causa,efeito,quantidade,valor,canvas_ticket_id);
				}
                fechar_postit(fechar_tipo);  
            });
            
        }else if(tipo=="area"){
 //create elements
            $("<div bigareacanvas-id='' class='bigareacanvas'><h1></h1></div>").appendTo(".backgroundexpand");

            var id = $(this).attr("id");
            var id = id.replace("zoomarea_","");
            var selector = "#area li[id="+id+"]";
            var selectorbig = "div[bigareacanvas-id=big_"+id+"]";
            var time = 100; 
            var tituloarea = $(selector+" h1").html();
            var conteudo = $(selector+" > ul.receberpostit > li");  

            $(selector).animate({"opacity":"0"});
            $("div[bigareacanvas-id]").attr("bigareacanvas-id","big_"+id);
            $(selectorbig).animate({"opacity":"1"},time).append(conteudo);
            $(selectorbig+" h1").append(tituloarea);

            //close
            $(".backgroundexpand").click(function(){
                $(selectorbig+".bigareacanvas").animate({"opacity":"0"},time, function(){
                    $(this).remove();     
                    $(".backgroundexpand").animate({"background-color":"rgba(0,0,0,0)"}).css({"z-index":"-1"},time,function(){
                        $(".backgroundexpand").addClass("sem_fundo");
                        $(this).remove();
                    });  
                });
                $(selector).animate({"opacity":"1"},time,function(){
                    $(".backgroundexpand").remove();
                });
                $(selector+" > ul.receberpostit").append(conteudo);
            });
        }

        //FUNÇÕES==================================
        //centralizar conteudopostit
        function centralizar_conteudopostit(){
            var wrapconteudopostit = "#wrapconteudopostit";
            var conteudopostit = "#conteudopostit";
        
            var altura_wrapconteudopostit = $(wrapconteudopostit).height(); // T      100%
            var altura_conteudopostit = $(conteudopostit).height();         // P      x%      
            var top_conteudopostit = Math.round( (((altura_wrapconteudopostit-altura_conteudopostit)/2)*100)/altura_wrapconteudopostit)-4+"%";

            if( altura_conteudopostit > altura_wrapconteudopostit-80 ){
                var tecla = window.event.keyCode;
                if( tecla==8 || tecla==46 ){
                    $(conteudopostit).attr("contenteditable","true");
                }else{
                    $(conteudopostit).attr("contenteditable","false");
                }
            }else{
                $(conteudopostit)
                    .css({"top":top_conteudopostit});


            }
        }

        //fechar postit
        function fechar_postit(tipo){

            if( tipo=="fechar" || tipo=="excluir" || tipo=="tempo" || tipo=="custos"){  
                $(selectorbig+".bigpostit").animate({"opacity":"0"},time, function(){
                    $(this).remove();     
                    $(".backgroundexpand").animate({"background-color":"rgba(0,0,0,0)"}).css({"z-index":"-1"},time,function(){
                        $(".backgroundexpand").addClass("sem_fundo");
                        $(this).remove();
                    });  
                });
                $(selector).animate({"opacity":"1"},time,function(){
                    $(".backgroundexpand").remove();
                });

                $("#teclado").css("display","none");
                //$("#container_keyboard").removeAttr("style");
        
                //atualizar conteudo do postit OU excluir
                conteudo = $("#conteudopostit").html();
                if(conteudo=="" || tipo=="excluir"){
                    $(selector).remove();
                }else if ( tipo=="fechar" ){
                    $(selector).html(conteudo);
                }else if( tipo=="tempo" ){
                	data_inicio = bigtocanvas($("#data_inicio").val());
                	data_fim = bigtocanvas($("#data_fim").val());
                	$(selector).html(data_inicio+" a "+data_fim);               	
                }else if( tipo=="custos" ){
					depois = $("#text_custo").val();
					quantidade = $("#quantidade").val();
					valor = $("#valor").val();
					$(selector).html( depois+": "+quantidade+" x "+"R$ "+valor );
                }
            }
        }
            
    }    
})(jQuery);

