var idEdicao;
var idExclusao;

function cadastrar() {	
	console.log();
}

function excluir() {
	console.log(idExclusao);
}

function editar() {
	console.log(idEdicao);
}

function prepararExclusao(id) {
	idExclusao = id;
}

function prepararEdicao(id) {
	idEdicao = id;	
}
$("#editarCliente").click(function(ev){
	ev.preventDefault();
	editar();
});
