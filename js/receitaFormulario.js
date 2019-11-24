$(document).ready(function(){
	$('#rendimento').mask('#,##0.00', {reverse: true});
});

$("#formulario").validate(
	{
		rules:{
			nome:{
				required:true			   
			},
			rendimento:{
				required:true,
				number:true
			},	
		}, 
		messages:{
			nome:{
				required:"Campo obrigatório"
			},
			rendimento:{
				required:"Campo obrigatório"
			}			
		}
	}
);
function doPost(nomeForm, nomeAcao){
	console.log(nomeForm)
	console.log(nomeAcao)
	var hiddenControl = document.getElementById('action');
	var theForm = document.getElementById(nomeForm);

	hiddenControl.value = nomeAcao;
	theForm.submit();
}