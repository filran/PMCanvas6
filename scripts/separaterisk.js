//esta função recebe a string inteira e separa em Texto, Causa e Efeito

function separaterisk(text){
	//quebrar por <br>
	var text = text.split("<br>");
	var resp = [];

	//separar cabeçalho (Risco, Causa ou Efeito) do Conteúdo
	for( i=0; i<text.length; i++ ){
		text[i] = text[i].split(":"); //text[0][1] , text[1][1] e text[2][1]
	}

	resp["risco"] = text[0][1];
	resp["causa"] = text[1][1];
	resp["efeito"] = text[2][1];

	//retornar Risco, Causa e Efeito
	return resp;	
}


function separaterisk_post(text){
	resp = [];
	text = text.split("</div><div>");

	text[0] = text[0].split("<div>");
	text[1] = text[1].split("</div>");

	text[0][0] = text[0][0].split(":");
	text[0][1] = text[0][1].split(":");
	text[1][0] = text[1][0].split(":");

	resp["risco"] = text[0][0][1];
	resp["causa"] = text[0][1][1];
	resp["efeito"] = text[1][0][1];

	return resp;

}
