function carregandoon(){
	$("#carregando").show();
}
function carregandooff(){
	$("#carregando").hide();
}


function getProjetcs(){
	carregandoon();

	$.getJSON( path+"phpsoa/getprojects.php", {format:"json"} )
		.done(function(data){
			var project_id = [];
			var project_name = [];

			for(i=0; i<data.length; i++){
				project_id[i] = data[i].id;
				project_name[i] = data[i].name;
				$("#projetos").append('<option value="'+project_id[i]+'">'+project_name[i]+'</option>');
			}

			carregandooff();	
		})
	;
}



function getUsers( project_id ){
	carregandoon();

	$.getJSON( path+"phpsoa/getprojects.php", {format:"json"} )
		.done(function(data){

			for(i=0; i<data.length; i++){

				if( data[i].id == project_id ){

					for( j=0; j<data[i].members.length; j++ ){
					
						var nome = data[i].members[j].firstname;
						
						$("#menuitens")
						.append('<a href="#"><img id="" src="imagens/icones/user.png" width="40" height="40" alt="nome"><br>'+nome+'</a>');
					
					}


				}

			}

			carregandooff();	
		})
	;
}




function getCanvas(){
	carregandoon();

	$('#projetos').change(function() {
		var value = $('#projetos option:selected').attr("value");
		$("#papel").css("visibility","visible");

		if( value > 0 ){
			$.getJSON( path+"phpsoa/getcanvas.php?projects_id="+value ,function(data){
				var canvas_id = data.id;
				$('#canvas_id').attr("value",data.id);
				$("#gp").attr("value",data.gp);
				$("#pitch").attr("value",data.name);

				carregandooff();
			});
		}
	});
}


function getTickets_atualiza(project_id,canvas_id){
	var postit_bd_id = [];

	$.ajax({
		async: false,
		type: "GET",
		url: path+"phpsoa/gettickets.php?projects_id="+project_id +"&canvas_projects_id="+canvas_id,
		dataType: "json",
		success: function(json){
			if( json.length > 0){
				for( i=0; i<json.length; i++ ){
					postit_bd_id[i] = json[i].id;
				}
			}else{
				postit_bd_id[0] = 0;
			}	
		},
		beforeSend: function(){
			carregandoon();
		},
		complete: function(){
			carregandooff();
		}
	});
	return postit_bd_id;
}


function getOneTicket(project_id,canvas_id,id){

	carregandoon();

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


	var url = path+"phpsoa/getoneticket.php?projects_id="+project_id+"&canvas_projects_id="+canvas_id+"&id="+id;

	$.getJSON( url , {format:"json"} )
		.done(function(data){
			$("#postits ul").append('<li postit-id="'+data.id+'" class="postit" autor="" areacandidata="'+areacandidata[data.canvas_box_id]+'">'+data.text+'</li>');

			carregandooff();


			//mudar fundo do box quando receber algum post-it candidato
			var cbi = data.canvas_box_id; //areacandidata
			var coratencao = "#cc3333";
			var select = "#"+areacandidata[cbi];
			var coratual = $(select).css("background-color");

			$(select).animate({
				"backgroundColor": coratencao
			},750);

			$(select).animate({
				"backgroundColor": coratual
			},750);

		})
	;
	

//	$.ajax({
//		async: false,
//		type: "GET",
//		url: url,
//		dataType: "json",
//		success: function(json){
////			resp+=json.id; //test
//			$("#postits ul").append('<li postit-id="'+json.id+'" class="postit" autor="" areacandidata="'+areacandidata[json.canvas_box_id]+'">'+json.text+'</li>');
//		}
//	});		

}



function getTickets(){

	carregandoon();

	var project_id = $("#dados_projeto").attr("project_id");
	var canvas_id  = $("#dados_canvas").attr("canvas_id");

	$.getJSON( path+"phpsoa/gettickets.php?projects_id="+project_id +"&canvas_projects_id="+canvas_id , {format:"json"} )
		.done(function(data){
			for(i=0; i<data.length; i++){
				var box_id = data[i].canvas_box_id;
				var data_inicio = desktoborder(data[i].data_inicio);
				var data_fim = desktoborder(data[i].data_fim);				
				var postit_html = '<li postit-id="'+data[i].id+'" class="postit" autor="" areacandidata="" style="display: block; z-index: 1;">'+data[i].text+'</li>';

				//JUST
				if( box_id == 1 ){
					$("#just .receberpostit").append(postit_html);
				}else if( box_id == 2 ){
					$("#obj .receberpostit").append(postit_html);
				}else if( box_id == 3 ){
					$("#beneficios .receberpostit").append(postit_html);
				}else if( box_id == 4 ){
					$("#prod .receberpostit").append(postit_html);
				}else if( box_id == 5 ){
					$("#requisitos .receberpostit").append(postit_html);
				}else if( box_id == 6 ){
					$("#stake .receberpostit").append(postit_html);
				}else if( box_id == 7 ){
					$("#premissas .receberpostit").append(postit_html);
				}else if( box_id == 8 ){
					$("#equipe .receberpostit").append(postit_html);
				}else if( box_id == 9 ){
					$("#entregas .receberpostit").append(postit_html);
				}else if( box_id == 10 ){
					$("#restricoes .receberpostit").append(postit_html);
				}else if( box_id == 11 ){//RISCOS
					var riscos = "Risco:"+data[i].text+"<br>Causa:"+data[i].causa+"<br>Efeito:"+data[i].efeito;
					var postit_html = '<li postit-id="'+data[i].id+'" class="postit" autor="" areacandidata="" style="display: block; z-index: 1;">'+riscos+'</li>';				
					$("#riscos .receberpostit").append(postit_html);
				}else if( box_id == 12 ){ // TEMPO				
					var postit_html = '<li postit-id="'+data[i].id+'" canvas_ticket_id="'+data[i].canvas_ticket_id+'" class="postit" autor="" areacandidata="" style="display: block; z-index: 1;">'+data_inicio+' a '+data_fim+'</li>';				
					$("#tempo .receberpostit").append(postit_html);
				}else if( box_id == 13 ){
					var postit_html = '<li postit-id="'+data[i].id+'" class="postit" autor="" areacandidata="" style="display: block; z-index: 1;">'+data[i].text+': '+data[i].quantidade+' x R$ '+data[i].valor+'</li>';
					$("#custos .receberpostit").append(postit_html);
				}
			}
			carregandooff();
		})
	;
}


function postTicket(project_id,canvas_id,canvas_box_id,data_inicio,data_fim,depois,causa,efeito,quantidade,valor,canvas_ticket_id){
	
	$.ajax({
		type: "POST",
		url: path+"phpsoa/postticket.php?projects_id="+project_id+"&canvas_project_id="+canvas_id+"&canvas_box_id="+canvas_box_id+"&data_inicio="+data_inicio+"&data_fim="+data_fim+"&text="+depois+"&causa="+causa+"&efeito="+efeito+"&quantidade="+quantidade+"&valor="+valor+"&canvas_ticket_id="+canvas_ticket_id,
		contentType: "application/json",
		dataType: "jsonp"/*,
		error: function(jqXHR, textStatus, errorThrown){
			alert('addWine error: ' + textStatus+"novo post");
		}*/
	});
}


function deleteTicket(project_id,canvas_id,id){

	$.ajax({
		type: "delete",
		url: path+"phpsoa/deleteticket.php?projects_id="+project_id+"&canvas_project_id="+canvas_id+"&id="+id,
		contentType: "application/json",
		dataType: "jsonp",
		beforeSend: function(){
			carregandoon();
		},
		complete: function(){
			carregandooff();
		}
	});
	
}





function deleteTickets(project_id,canvas_id,ids){

	for( i=0; i<ids.length; i++ ){
	
		$.ajax({
			type: "delete",
			url: path+"phpsoa/deleteticket.php?projects_id="+project_id+"&canvas_project_id="+canvas_id+"&id="+ids[i],
			contentType: "application/json",
			dataType: "jsonp",
			beforeSend: function(){
				carregandoon();
			},
			complete: function(){
				carregandooff();
			}
		});

	}
	
}





function putTicket(project_id,canvas_id,canvas_box_id,data_inicio,data_fim,depois,causa,efeito,quantidade,valor,canvas_ticket_id,id){
	$.ajax({
		type: "PUT",
		url: path+"phpsoa/putticket.php?projects_id="+project_id+"&canvas_project_id="+canvas_id+"&canvas_box_id="+canvas_box_id+"&data_inicio="+data_inicio+"&data_fim="+data_fim+"&text="+depois+"&causa="+causa+"&efeito="+efeito+"&quantidade="+quantidade+"&valor="+valor+"&canvas_ticket_id="+canvas_ticket_id+"&id="+id,
		contentType: "application/json",
		dataType: "jsonp",
		beforeSend: function(){
			carregandoon();
		},
		complete: function(){
			carregandooff();
		}
	});
	
}


function getentregas(project_id,canvas_id){
	carregandoon();

	$.getJSON( path+"phpsoa/getentregas.php?projects_id="+project_id+"&canvas_projects_id="+canvas_id , {format:"json"} )
		.done(function(json){
			for(i=0; i<json.length; i++){
				$("#entrega").append("<option value='"+json[i].id+"'>"+json[i].text+"</option>");
			}
			carregandooff();									
		})
	;


}


function gettempo(project_id,canvas_id,id){
	carregandoon();

	$.getJSON( path+"phpsoa/gettempo.php?projects_id="+project_id+"&canvas_projects_id="+canvas_id+"&id="+id , {format:"json"} )
		.done(function(json){
			$("#data_inicio").val(troca(json[0].data_inicio));
			$("#data_fim").val(troca(json[0].data_fim));
			$("#entrega").val(json[0].canvas_ticket_id); //seleciona entrega que foi vinculado

			carregandooff();			
		})
	;
	
}


function getOneCusto(project_id,canvas_id,id){

	var url = path+"phpsoa/getoneticket.php?projects_id="+project_id+"&canvas_projects_id="+canvas_id+"&id="+id;

	$.ajax({
		async: false,
		type: "GET",
		url: url,
		dataType: "json",
		success: function(json){
			$("#text_custo").attr("value",json.text);
			$("#quantidade").attr("value",json.quantidade);
			$("#valor").attr("value",json.valor);
		},
		beforeSend: function(){
			carregandoon();
		},
		complete: function(){
			carregandooff();
		}
	});		

}

function putBox(project_id,canvas_id,canvas_box_id,id){
	$.ajax({
		type: "PUT",
		url: path+"phpsoa/putbox.php?projects_id="+project_id+"&canvas_project_id="+canvas_id+"&canvas_box_id="+canvas_box_id+"&id="+id,
		contentType: "application/json",
		dataType: "jsonp",
		beforeSend: function(){
			carregandoon();
		},
		complete: function(){
			carregandooff();
		}
	});	
}
