
$(document).ready(function(){
	exibirGrafico();
});	
   

function exibirGrafico(){

	var type = 'bar';

	var data = {
        labels: ["Janeiro", "Fevereiro", "Março"],
        datasets : [
            {
				fillColor : false,
				backgroundColor: "#0000FF",
				data: [600, 600, 600],
				label: "Aluguel"
			},
            {
				fillColor : false,
				backgroundColor:"#FFFF00",
				data: [180, 150, 210],
				label : "Cemig"
			},
            {
				fillColor : false,
				backgroundColor: "#FFA500",
				data: [120, 90, 150],
				label : "Copasa"
			}						
        ]
    };              

	var options = {
		responsive:true,
        title: {
            display: true,
            text: 'Gastos por mês agrupados por tipo'
		},
        legend: {
            display: true,
 
        }
	};
	
	
	var ctx = document.getElementById("grafico").getContext("2d");
	new Chart(ctx, {type, data, options});

}	  



  