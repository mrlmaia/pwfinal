/* VALIDACAO */
$(document).ready(function(){
	$('#quantidadeIngrediente').mask('######0');		
});
$("#formulario").validate(
	{
		rules:{
			quantidadeIngrediente:{
				required:true,
				number: true			   
			}			
		}, 
		messages:{
			quantidadeIngrediente:{
				required:"Campo obrigatório",
				number:"Digite um número positivo"
			}			
		}
	}
);



function doPost(formName, actionName){
	console.log(formName)
	console.log(actionName)
	var hiddenControl = document.getElementById('action');
	var theForm = document.getElementById(formName);

	hiddenControl.value = actionName;
	theForm.submit();
}

function doGet(ingrediente, quantidade, acao) {
	alert('entrou denovo xis')
	location.href='ingredienteReceitaAcao.php?ingrediente='+ingrediente+'&quantidade'+quantidade;
}

function adicionar(){
	alert("entrou xiiiis")
	var acao = "adicionar"
	var ingrediente = document.getElementById('ingrediente').value
	var quantidade = document.getElementById('quantidadeIngrediente').value
	doGet(ingrediente, quantidade, acao)
}
