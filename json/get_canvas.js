//var dominio = "http://localhost/PMCanvas5.0/";
//var dominio = "http://odysseus-lens.ddns.net/PMCanvas5.0/";

$('#projetos').change(function() {
	var value = $('#projetos option:selected').attr("value");
	$("#papel").css("visibility","visible");

	if( value > 0 ){
		$.getJSON(dominio+"projects/"+value+"/canvas_projects/show.json?key="+key,function(data){
			var canvas_id = data.id;
			$('#canvas_id').attr("value",data.id);
			$("#gp").attr("value",data.gp);
			$("#pitch").attr("value",data.name);
		});
	}
});



