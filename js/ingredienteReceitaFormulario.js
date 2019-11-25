/* VALIDACAO */
$(document).ready(function() {
    $('#quantidadeIngrediente').mask('##0.00');
});
$("#formulario").validate({
    rules: {
        quantidadeIngrediente: {
            required: true,
            number: true
        }
    },
    messages: {
        quantidadeIngrediente: {
            required: "Campo obrigatório",
            number: "Digite um número positivo"
        }
    }
});

function doPost(formName, actionName) {
    console.log(formName)
    console.log(actionName)
    var hiddenControl = document.getElementById('action');
    var theForm = document.getElementById(formName);

    hiddenControl.value = actionName;
    theForm.submit();
}