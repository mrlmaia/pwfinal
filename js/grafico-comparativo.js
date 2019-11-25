$(document).ready(function(){
    exibirGrafico();
});	

function exibirGrafico(){
    $.ajax({
        type:'POST',
        url:'graficos/gerarComparativo.php',			
        success:function(retorno){								
            dados = JSON.parse(retorno);

            console.log(dados.valores[0])

            var type = 'bar';

            var data = {
                labels: dados.nomes,
                datasets : [
                    {
                        fillColor : false,
                        backgroundColor: "#0000FF",
                        data: dados.valores[0],
                        label: "Aluguel"
                    },
                    {
                        fillColor : false,
                        backgroundColor:"#FFFF00",
                        data: dados.valores[1],
                        label : "Cemig"
                    },
                    {
                        fillColor : false,
                        backgroundColor: "#FFA500",
                        data: dados.valores[2],
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
            
            
            var ctx = document.getElementById("grafico-comparativo").getContext("2d");
            new Chart(ctx, {type, data, options});

        }
    });
    console.log("falha")
    return false;
}