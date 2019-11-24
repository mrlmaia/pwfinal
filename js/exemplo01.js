
$(document).ready(function(){
	exibirGrafico();
});	

function exibirGrafico(){

	var type = "bar";

	var data = {
        labels: ["Janeiro", "Fevereiro", "Março"],
        datasets : [
            {
				fillColor : false,
				backgroundColor:["#0000FF", "#FFFF00", "#FFA500"],
				data: [900, 840, 960]
        	}
        ]
    };              

	var options = {
		responsive:true,
        title: {
            display: true,
            text: 'Gastos por mês'
		},
        legend: {
            display: false,
 
        },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
	};

	var ctx = document.getElementById("grafico").getContext("2d");
	new Chart(ctx, {type, data, options});
	
}	
