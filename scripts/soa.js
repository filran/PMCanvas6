function getProjetcs(){

	$.getJSON( path+"phpsoa/getprojects.php", {format:"json"} )
		.done(function(data){
			var project_id = [];
			var project_name = [];

			for(i=0; i<data.length; i++){
				project_id[i] = data[i].id;
				project_name[i] = data[i].name;
				$("#projetos").append('<option value="'+project_id[i]+'">'+project_name[i]+'</option>');
			}	
		})
	;
}


function getCanvas(){
	$('#projetos').change(function() {
		var value = $('#projetos option:selected').attr("value");
		$("#papel").css("visibility","visible");

		if( value > 0 ){
			$.getJSON( path+"phpsoa/getcanvas.php?projects_id="+value ,function(data){
				var canvas_id = data.id;
				$('#canvas_id').attr("value",data.id);
				$("#gp").attr("value",data.gp);
				$("#pitch").attr("value",data.name);
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
		}
	});
	return postit_bd_id;
}


function getOneTicket(project_id,canvas_id,id){
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

	$.ajax({
		async: false,
		type: "GET",
		url: url,
		dataType: "json",
		success: function(json){
//			resp+=json.id; //test
			$("#postits ul").append('<li postit-id="'+json.id+'" class="postit" autor="" areacandidata="'+areacandidata[json.canvas_box_id]+'">'+json.text+'</li>');
		}
	});		

}



function getTickets(){

	var project_id = $("#dados_projeto").attr("project_id");
	var canvas_id  = $("#dados_canvas").attr("canvas_id");

	$.getJSON( path+"phpsoa/gettickets.php?projects_id="+project_id +"&canvas_projects_id="+canvas_id , {format:"json"} )
		.done(function(data){
			for(i=0; i<data.length; i++){
				var box_id = data[i].canvas_box_id;
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
				}else if( box_id == 11 ){
					$("#riscos .receberpostit").append(postit_html);
				}else if( box_id == 12 ){
					$("#tempo .receberpostit").append(postit_html);
				}else if( box_id == 13 ){
					$("#custos .receberpostit").append(postit_html);
				}
			}
		})
	;
}


function postTicket(project_id,canvas_id,canvas_box_id,depois){
	$.ajax({
		type: "POST",
		url: path+"phpsoa/postticket.php?projects_id="+project_id+"&canvas_project_id="+canvas_id+"&canvas_box_id="+canvas_box_id+"&text="+depois,
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
		dataType: "jsonp"
	});
	
}


function putTicket(project_id,canvas_id,id,depois){
	$.ajax({
		type: "PUT",
		url: path+"phpsoa/putticket.php?projects_id="+project_id+"&canvas_project_id="+canvas_id+"&id="+id+"&text="+depois,
		contentType: "application/json",
		dataType: "jsonp"
	});
	
}


