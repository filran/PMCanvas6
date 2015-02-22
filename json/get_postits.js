//var dominio = "http://localhost/PMCanvas5.0/";
var project_id = $("#dados_projeto").attr("project_id");
var canvas_id  = $("#dados_canvas").attr("canvas_id");

$.getJSON(dominio+"projects/"+project_id+"/canvas_projects/"+canvas_id+"/canvas_tickets.json?key="+key,function(data){
	for(i=0; i<=data.length; i++){
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
});
