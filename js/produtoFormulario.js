$(document).ready(function(){
	$('#precoCusto').mask('#,##0.00', {reverse: true});
	$('#precoVenda').mask('#,##0.00', {reverse: true});
	$('#quantidade').mask('###0');		
	$('#precoCusto').mask('0000.00', {reverse: true});
	$('#preco').mask('#.##0,00', {reverse: true});
	
});
$("#formulario").validate(
	{
		rules:{
			nome:{
				required:true			   
			},
			precoCusto:{
				required:true
			},
			precoVenda:{
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
			precoCusto:{
				required:"Campo obrigatório"
            },
            precoVenda:{
				required:"Campo obrigatório"
			},
			quantidade:{
				required:"Campo obrigatório",
				number:"Digite um número válido"
			}			
		}
	}
);