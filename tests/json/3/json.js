//Função para ler JSON

// Classe para chamar o Json.
function json(){
	var qtd;
	var retorno;

	// Resgatar valores.
	json.prototype.resgatarValores = function(){
		$('#resultado').html('Carregando dados...');

		// Estrutura de resultado.
		$.getJSON('dados.json', function(data){
			$('#resultado').html(data.canvas_id);
		});

	}

}

// Objeto.
var obj = new json();
obj.resgatarValores();
