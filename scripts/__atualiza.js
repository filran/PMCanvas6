//LÊ TODOS OS POSTITS DO CANVAS E VERIFICA SE HÁ ALGUM NOVO NO BANCO DE DADOS E ATUALIZA AUTOMATICAMENTE

(function atualiza(){
	//var dominio = "http://localhost/ws_gestaointegrada/";
	var time = 5000;
	var project_id = $("#dados_projeto").attr("project_id");
	var canvas_id  = $("#dados_canvas").attr("canvas_id");
	var url = dominio+"projects/"+project_id+"/canvas_projects/"+canvas_id+"/canvas_tickets.json?key="+key;
	var postit_bd_id = [];
	var postit_canvas_id = [];
	var postit_candidato_id = [];
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

		//STEP: get postis of the areacandidata
		

		//STEP: compare if anything postit was added
		for( i=0; i<postit_bd_id.length; i++ ){
	//		alert( postit_bd_id[i] );
			for( j=0; j<postit_canvas_id.length; j++  ){
	//				alert( postit_canvas_id[j] );
				for( k=0; k<postit_candidato_id.length; k++  ){
					if( postit_canvas_id[j] == postit_bd_id[i] || postit_bd_id[i] == postit_candidato_id[k]){
		//				$("li[postit-id='"+postit_canvas_id[j]+"']").css("background-color","red"); //TESTE
		//				resp+= postit_bd_id[i]+" = "+postit_canvas_id[j]+"\n"; //TESTE
						postit_equal.push( postit_bd_id[i] );
					}
				}
			}
		}	

		//STEP: delete old postit
	//	resp+=postit_equal.length; //test

		if( postit_equal.length > 0 ){
			for( i=0; i<postit_equal.length; i++ ){
				//remove os postits antigos e deixa somente os novos
				index = postit_bd_id.indexOf( postit_equal[i] );
				postit_bd_id.splice(index, 1);
			}
		}
//		resp+=postit_bd_id.length; //test

		resp="";
		//STEP: get new postit
		if( postit_bd_id.length > 0 ){
			$.each(postit_bd_id,function(k,v){
				getOneTicket(project_id,canvas_id,v);
				//resp+=v;
			});
		}

		//alert(resp);
	},time);

	

	//STEP: time for refresh
	setTimeout(atualiza,time);
}());

