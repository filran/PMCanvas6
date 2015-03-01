//converte aaaa/mm/dd para dd/mm/aaaa
function desktoborder(data){
	if(data == null){
		resp = "";
	}else{
		var quebra_data = data.split("/");
		data = quebra_data[2]+"/"+quebra_data[1]+"/"+quebra_data[0];
		return data;	
	}
}

//ao contrário da função acima
function bordertodesk(data){
	if(data == null || data == ""){
		resp = "";
	}else{
		var quebra_data = data.split("/");
		data = quebra_data[0]+"/"+quebra_data[1]+"/"+quebra_data[1];
		return data;	
	}
}


//convert de "dd/mm/aaaa a dd/mm/aaaa" para data_inicio e data_fim"
function bordertoinput(data){
	data = data.split(" a ");
	return data;
}

//troca aaaa/mm/dd por aaaa-mm-dd
function troca(data){
	if(data == null){
		resp = "";
	}else{
		var quebra_data = data.split("/");
		data = quebra_data[0]+"-"+quebra_data[1]+"-"+quebra_data[2];
		return data;	
	}
}

//aaaa-mm-dd para dd/mm/aaaa
function bigtocanvas(data){
	if(data == null){
		resp = "";
	}else{
		var quebra_data = data.split("-");
		data = quebra_data[2]+"/"+quebra_data[1]+"/"+quebra_data[0];
		return data;	
	}
}

//de aaaa-mm-dd para aaaa/mm/dd
function putdate(data){
	if(data == null){
		resp = "";
	}else{
		var quebra_data = data.split("-");
		data = quebra_data[0]+"/"+quebra_data[1]+"/"+quebra_data[2];
		return data;	
	}
}
