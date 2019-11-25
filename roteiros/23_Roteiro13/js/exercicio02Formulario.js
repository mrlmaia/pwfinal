
$(document).ready(function() {
  $('.valores').mask("#.##0,00", {reverse: true});
});

$("#formMorador").validate({
  rules:{
    idMorador:{
          required:true
      }
  }, 	   
  messages:{	
    idMorador:{
          required:"Campo obrigatório"
      }    
  }
});