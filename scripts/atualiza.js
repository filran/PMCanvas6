//LÊ TODOS OS POSTITS DO CANVAS E VERIFICA SE HÁ ALGUM NOVO NO BANCO DE DADOS E ATUALIZA AUTOMATICAMENTE

(function atualiza(){
	//var dominio = "http://localhost/ws_gestaointegrada/";
	var time = 5000;
	var project_id = $("#dados_projeto").attr("project_id");
	var canvas_id  = $("#dados_canvas").attr("canvas_id");
	var url = dominio+"projects/"+project_id+"/canvas_projects/"+canvas_id+"/canvas_tickets.json?key="+key;
	var postit_bd_id = []; //todos os post-its que estão no BD
	var postit_canvas_id = []; //todos os que estão alocados em algum BOX
	var postit_candidato_id = []; //post-its que estão aguardando serem add ao BOX
	var postit_equal = []; //armazena os indices dos postits iguais (postit_bd_id)
	var areacandidata = [];
		areacandidata[1] = "just";
		areacandidata[2] = "obj";
		areacandidata[3] = "beneficios";
		areacandidata[4] = "prod";
		areacandidata[5] = "requisitos";
		areacandidata[6] = "stake";
		areacandidata[7] = "premissas";
		areacandidata[8] = "equipe";
		areacandidata[9] = "entregas";
		areacandidata[10] = "restricoes";
		areacandidata[11] = "riscos";
		areacandidata[12] = "tempo";
		areacandidata[13] = "custos";			
	var resp = "";

	setTimeout(function(){
		//STEP: get postits of the database
		postit_bd_id = getTickets_atualiza(project_id,canvas_id);

		//resp+="\nTotal de Postit: "+postit_bd_id.length+"\n";

		//STEP: get postis of the canvas
		var qtd_postit_canvas = $("#area .postit").size();
		if( qtd_postit_canvas >0  ){
			$("#area .postit").each(function(index){
				postit_canvas_id[index] = $(this).attr("postit-id");
//				alert( postit_canvas_id[index] );
			});
		}else{
			postit_canvas_id[0] = 0;
//			alert("zero");
		}
		//resp+="\nPostit nos boxes: "+postit_canvas_id.length+"\n";

		

		var qtd_postit_cand = $("#postits ul li").size();
		if( qtd_postit_cand > 0 ){
			$("#postits ul li").each(function(index){
				postit_candidato_id[index] = $(this).attr("postit-id");
//				alert( postit_candidato_id[index] );
			});
		}else{
			postit_candidato_id[0] = 0;
//			alert("zero");
		}
		//resp+="\nPostit em P's: "+postit_candidato_id.length+"\n";

		//////////////////////////////////////////////////////////////////////////////////////////////////
		///// FUNÇÃO QUE ESTARÁ 
		


		//DIFF BD e CANVAS
		if( postit_bd_id.length > qtd_postit_canvas ){
			resp+="\nBD: "; for(i=0; i<postit_bd_id.length; i++){ resp+=postit_bd_id[i]+", "; } //TESTE
			
			resp+="\nCV: "; for(j=0; j<postit_canvas_id.length; j++){ resp+=postit_canvas_id[j]+", "; }
		
			for(i=0; i<postit_bd_id.length; i++){

				for(j=0; j<postit_canvas_id.length; j++){

					if( postit_bd_id[i] == postit_canvas_id[j] ){
						postit_bd_id.splice(i,1);
					}
				
				}
			
			}

			if( postit_bd_id.length > 0 ){ //verificar novamente
				for(j=0; j<postit_canvas_id.length; j++){
					for(i=0; i<postit_bd_id.length; i++){
						if( postit_bd_id[i] == postit_canvas_id[j] ){
							postit_bd_id.splice(i,1);
						}
					}
				}
			}

			resp+="\nCA: ";
			for(i=0; i<postit_bd_id.length; i++){ resp+=postit_bd_id[i]+", "; }


			//DIFF BD e CAND
			if( postit_candidato_id.length > 0 && postit_candidato_id[0] != 0){
				for(i=0; i<postit_bd_id.length; i++){

					for(j=0; j<postit_candidato_id.length; j++){

						if(  postit_bd_id[i] == postit_candidato_id[j] ){
							postit_bd_id.splice(i,1);	
						}

					}

				}
			}


			if( postit_bd_id.length > 0){

				for(i=0; i<postit_bd_id.length; i++){

					getOneTicket(project_id,canvas_id,postit_bd_id[i]);

					//$("#postits ul").append('<li postit-id="'+postit_bd_id[i]+'" class="postit" autor="" areacandidata="just">'+postit_bd_id[i]+'</li>');

				}

			}

		
		}//---------------------




		//alert(resp);
		
	},time);

	//STEP: time for refresh
	setTimeout(atualiza,time);
}());

