//Função para ler JSON

// Classe para chamar o Json.
function json(){

    var box = ["justificativas","objsmart","beneficios","produto","requisitos","stakeholders","equipe","premissas","entregas","restricoes","riscos","tempo","custos"];


	// Resgatar valores.
	json.prototype.resgatarValores = function(){

		// Estrutura de resultado.
		$.getJSON('json/dados.json', function(data){
		
			$('#srv_gp').html(data.manager_name); //GP
			$('#srv_pitch').html(data.canvas_name); //PITCH

			//verificar os post-its
			this.qtd_postit = data.Postit.length;

            for (i = 0; i < this.qtd_postit; i++){

                if( data.Postit[i].box_id == 0 ){ //JUSTIFICATIVAS
                    $("#just .receberpostit").append('<li postit-id="'+data.Postit[i].postit_id+'" class="postit" autor="'+data.Postit[i].user_id+'" areacandidata="just" style="display: block; z-index: 1;">'+data.Postit[i].postit_text+'</li>');
                }

                if( data.Postit[i].box_id == 1 ){ //OBJ SMART
                    $("#obj .receberpostit").append('<li postit-id="'+data.Postit[i].postit_id+'" class="postit" autor="'+data.Postit[i].user_id+'" areacandidata="obj" style="display: block; z-index: 1;">'+data.Postit[i].postit_text+'</li>');
                }

                if( data.Postit[i].box_id == 2 ){ //BENEFÍCIOS
                    $("#beneficios .receberpostit").append('<li postit-id="'+data.Postit[i].postit_id+'" class="postit" autor="'+data.Postit[i].user_id+'" areacandidata="beneficios" style="display: block; z-index: 1;">'+data.Postit[i].postit_text+'</li>');
                }

                if( data.Postit[i].box_id == 3 ){ //PRODUTOS
                    $("#prod .receberpostit").append('<li postit-id="'+data.Postit[i].postit_id+'" class="postit" autor="'+data.Postit[i].user_id+'" areacandidata="prod" style="display: block; z-index: 1;">'+data.Postit[i].postit_text+'</li>');
                }

                if( data.Postit[i].box_id == 4 ){ //REQUISITOS
                    $("#requisitos .receberpostit").append('<li postit-id="'+data.Postit[i].postit_id+'" class="postit" autor="'+data.Postit[i].user_id+'" areacandidata="requisitos" style="display: block; z-index: 1;">'+data.Postit[i].postit_text+'</li>');
                }

                if( data.Postit[i].box_id == 5 ){ //STAKEHOLDERS
                    $("#stake .receberpostit").append('<li postit-id="'+data.Postit[i].postit_id+'" class="postit" autor="'+data.Postit[i].user_id+'" areacandidata="stake" style="display: block; z-index: 1;">'+data.Postit[i].postit_text+'</li>');
                }

                if( data.Postit[i].box_id == 6 ){ //EQUIPE
                    $("#equipe .receberpostit").append('<li postit-id="'+data.Postit[i].postit_id+'" class="postit" autor="'+data.Postit[i].user_id+'" areacandidata="equipe" style="display: block; z-index: 1;">'+data.Postit[i].postit_text+'</li>');
                }

                if( data.Postit[i].box_id == 7 ){ //PREMISSAS
                    $("#premissas .receberpostit").append('<li postit-id="'+data.Postit[i].postit_id+'" class="postit" autor="'+data.Postit[i].user_id+'" areacandidata="premissas" style="display: block; z-index: 1;">'+data.Postit[i].postit_text+'</li>');
                }

                if( data.Postit[i].box_id == 8 ){ //ENTREGAS
                    $("#entregas .receberpostit").append('<li postit-id="'+data.Postit[i].postit_id+'" class="postit" autor="'+data.Postit[i].user_id+'" areacandidata="entregas" style="display: block; z-index: 1;">'+data.Postit[i].postit_text+'</li>');
                }

                if( data.Postit[i].box_id == 9 ){ //RESTRIÇÕES
                    $("#restricoes .receberpostit").append('<li postit-id="'+data.Postit[i].postit_id+'" class="postit" autor="'+data.Postit[i].user_id+'" areacandidata="restricoes" style="display: block; z-index: 1;">'+data.Postit[i].postit_text+'</li>');
                }

                if( data.Postit[i].box_id == 10 ){ //RISCOS
                    $("#riscos .receberpostit").append('<li postit-id="'+data.Postit[i].postit_id+'" class="postit" autor="'+data.Postit[i].user_id+'" areacandidata="riscos" style="display: block; z-index: 1;">'+data.Postit[i].postit_text+'</li>');
                }

                if( data.Postit[i].box_id == 11 ){ //TEMPO
                    $("#tempo .receberpostit").append('<li postit-id="'+data.Postit[i].postit_id+'" class="postit" autor="'+data.Postit[i].user_id+'" areacandidata="tempo" style="display: block; z-index: 1;">'+data.Postit[i].postit_text+'</li>');
                }

                if( data.Postit[i].box_id == 12 ){ //CUSTOS
                    $("#custos .receberpostit").append('<li postit-id="'+data.Postit[i].postit_id+'" class="postit" autor="'+data.Postit[i].user_id+'" areacandidata="custos" style="display: block; z-index: 1;">'+data.Postit[i].postit_text+'</li>');
                }
                            
            }
	
		});

	}

}


// Objeto.

var obj = new json();
obj.resgatarValores();
