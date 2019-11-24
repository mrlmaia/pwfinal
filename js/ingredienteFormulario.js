$(document).ready(function(){
	$('#preco').mask('0000.00', {reverse: true});
	$('#quantidade').mask('#####0');		
});
$("#formulario").validate(
	{
		rules:{
			nome:{
				required:true			   
			},
			preco:{
				required:true
			},
			quantidade:{
				required:true,
				number: true			   
			}			
		}, 
		messages:{
			nome:{
				required:"Campo obrigatório"
			},
			preco:{
				required:"Campo obrigatório"
			},
			quantidade:{
				required:"Campo obrigatório",
				number:"Digite um número válido"
			}			
		}
	}
);