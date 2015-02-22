//var dominio = "http://localhost/PMCanvas5.0/";
//var dominio = "http://odysseus-lens.ddns.net/PMCanvas5.0/";


//$.getJSON( "phpsoa/get.php", {format:"json"} )
//	.done(function(data){
//		var project_id = [];
//		var project_name = [];

//		for(i=0; i<data.length; i++){
//			project_id[i] = data[i].id;
//			project_name[i] = data[i].name;
//			$("#projetos").append('<option value="'+project_id[i]+'">'+project_name[i]+'</option>');
//		}	
//	})
//;



//$.getJSON(dominio+"projects.json?key="+key, {format:"jsonp"} )
//	.done(function(data){
//		var project_id = [];
//		var project_name = [];

//		for(i=0; i<data.length; i++){
//			project_id[i] = data[i].id;
//			project_name[i] = data[i].name;
//			$("#projetos").append('<option value="'+project_id[i]+'">'+project_name[i]+'</option>');
//		}	
//	})
//;

//$.getJSON(dominio+"projects.json?key="+key,function(data){
//	var project_id = [];
//	var project_name = [];

//	for(i=0; i<data.length; i++){
//		project_id[i] = data[i].id;
//		project_name[i] = data[i].name;
//		$("#projetos").append('<option value="'+project_id[i]+'">'+project_name[i]+'</option>');
//	}
//});

//var project_id = [];
//var project_name = [];

//$.ajax({
//    url: "http:odysseus-lens.ddns.net/ws_gestaointegrada/projects.json?key=1708de85ebd115e4ab7c79824cdbdc849c79f6e9",
//    dataType:"jsonp",
//    contentType : 'application/json; charset=utf-8',
//    type: "GET",
//    beforeSend: function (xhr) {
//        xhr.setRequestHeader("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
//        xhr.setRequestHeader("Access-Control-Allow-Origin", "*");
//        xhr.setRequestHeader("Access-Control-Allow-Methods", "GET,PUT,POST,DELETE");
//        xhr.setRequestHeader("Content-Type", "text/plain");
//        xhr.setRequestHeader("Access-Control-Allow-Credentials", "true");
//    },
//    success:function(data){
//			$("body").append("asfasf");
//    }
//    error: function(jqXHR, textStatus, errorThrown){
//		alert('addWine error: ' + textStatus);
//	}
//});
