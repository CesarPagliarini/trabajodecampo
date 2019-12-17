

$(document).ready(()=>{
    $('#orderCanvasListener').click(()=>{
        $('#orderCanvas').toggleClass('hidden');
    });
    const token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': token}
    });
    $.ajax({
        type: "POST",
        url: "reports",
        data: {
            'endpoint':'forCanvas',
            _method:'POST',
            'resource':'sale-order',
        },
        success:  function (response) {
            let dataset = [];
            let labels = [];
            response.forEach((item) => {
                dataset.push(item.quantity);
                labels.push(item.name);
            })
            let item = {'dataset': dataset, 'labels': labels};
            $(document).trigger('instanceChart', [ { item }]);
        }
    });
});

$(document).bind('instanceChart', function(e, obj) {
    let item = obj.item;
    const dataset = item.dataset;
    const labels = item.labels
    let ctx = document.getElementById('myChart');
    let myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Cantidad de ordenes',
                data: dataset,
                responsive: true,
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Chart.js Bar Chart'
                },
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 99, 132, 1)',
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
                yAxes: [{
                    ticks: {
                        max: 5,
                        min: 0,
                        stepSize: 1
                    }
                }]
            }
        }
    });
});
