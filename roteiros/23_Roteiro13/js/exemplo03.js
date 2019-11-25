	$(document).ready(function() {
	    exibirGrafico();
	});

	function exibirGrafico() {
	    $.ajax({
	        type: 'POST',
	        url: 'gerarExemplo03.php',
	        success: function(retorno) {
	            dados = JSON.parse(retorno);

	            var type = 'doughnut'

	            var data = {
	                labels: dados.meses,
	                datasets: [{
	                    fillColor: false,
	                    backgroundColor: ["#0000FF", "#FFFF00", "#FFA500"],
	                    data: dados.valores
	                }]
	            };

	            var options = {
	                responsive: true,
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
	            new Chart(ctx, { type, data, options });
	        }
	    });
	    return false;
	}