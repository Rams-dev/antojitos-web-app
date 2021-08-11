let api = "http://localhost:8000/api"
// let api = "http://antojitos.halconesutvcoacyd.online/api"
let countSalesDiv = document.getElementById('count-sales')
let productsSalesDiv = document.getElementById('productsSales')

function getData(){
    fetch(`${api}/getData`)
    .then(response => response.json())
    .then(data => createCharts(data))
}



function createCharts(data){
    console.log(data)
    const { sales, productsSales, salesLastWeek} = data
    countSalesDiv.innerHTML = sales.length
    getClientFrequent(sales)
    productsSalesDiv.innerHTML = productsSales.length
    createLineChartLastWeekSales(salesLastWeek)
}

function getClientFrequent(sales){
    let clientFrequent = []
    sales.forEach(sale => {
        if(clientFrequent[sale.client_name]){
            clientFrequent[sale.client_name]++

        }else{
            clientFrequent[sale.client_name] = 1
        }       
    });

    clientsFrequent = Object.keys(clientFrequent)
    .map(client => ({name: client, times: clientFrequent[client]}))
    .sort((a,b) => b.times - a.times)
    .slice(0, 3)

     createBarChart(clientsFrequent)
    console.log(clientsFrequent)
}


function createLineChartLastWeekSales(totalSales){
    let salest = []
    let labels = []
    let countSales = []
    totalSales.forEach(sale => {
        // labels.push(sale.created_At)
        if(salest[sale.created_at.split(" ")[0]]){
            salest[sale.created_at.split(" ")[0]]++
        }else{
            salest[sale.created_at.split(" ")[0]] = 1
        }
    })
    
    labels = Object.keys(salest)
    countSales = Object.entries(salest)
    console.log(labels)

      const data = {
        labels: labels,
        datasets: [{
          label: 'Ventas de los ultimos dias',
          backgroundColor: 'rgb(255, 99, 132)',
          borderColor: 'rgb(255, 99, 132)',
          data: countSales,
        }]
      };

      const config = {
        type: 'line',
        data,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
                }
        }
      };

      var myChart = new Chart(
        document.getElementById('chart_sales_week'),
        config
      );


}


function createBarChart(data){
    let ctx = document.getElementById('chart_client').getContext('2d');

    let clients = []
    let labels = []

    data.forEach(element => {
        clients.push(element.times)
        labels.push(element.name)
        
    });

    let myChart = new Chart(ctx
        , {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Clientes con mas compras',
                data: clients,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
   



}

getData()

