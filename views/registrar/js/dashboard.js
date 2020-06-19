$(document).ready(function(){

  function getDashboardData(){
    $.ajax({
      url: 'getDashboardData',
      method: 'post',
      dataType: 'json',
      data: {get: true},
      success: function(data){
        // console.log(data);
        $('#req_unpaid').text(data['requests']['today']['unpaid']);
        $('#req_processing').text(data['requests']['today']['processing']);
        $('#req_claimed').text(data['requests']['today']['claimed']);
        $('#req_releasing').text(data['requests']['today']['releasing']);
        $('#req_cancelled').text(data['requests']['today']['cancelled']);
        $('#ver_unpaid').text(data['verifications']['today']['unpaid']);
        $('#ver_verified').text(data['verifications']['today']['verified']);
        $('#ver_verification').text(data['verifications']['today']['verification']);
        $('#ver_approval').text(data['verifications']['today']['approval']);
        reqChart.data.labels = data['dates'];
        reqChart.data.datasets[0].data = data['requests']['week']['claimed'];
        reqChart.data.datasets[1].data = data['requests']['week']['releasing'];
        reqChart.data.datasets[2].data = data['requests']['week']['processing'];
        reqChart.data.datasets[3].data = data['requests']['week']['unpaid'];
        reqChart.data.datasets[4].data = data['requests']['week']['cancelled'];
        reqChart.update();
        verChart.data.labels = data['dates'];
        verChart.data.datasets[0].data = data['verifications']['week']['verified'];
        verChart.data.datasets[1].data = data['verifications']['week']['verification'];
        verChart.data.datasets[2].data = data['verifications']['week']['approval'];
        verChart.data.datasets[3].data = data['verifications']['week']['unpaid'];
        verChart.update();
      }
    });
  }
  getDashboardData();
  setInterval(function(){
    getDashboardData();
  },60000);


        var ctx = document.getElementById("requests_chart").getContext('2d');
        var reqChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                datasets: [
                {
                    label: 'Claimed',
                    data: [14, 17, 12, 12, 14, 17, 10],
                    backgroundColor: [
                        'rgba(40, 167, 69, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(40, 167, 69, 1)',
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                },
                {
                    label: 'Releasing',
                    data: [11, 15, 10, 10, 10, 15, 5],
                    backgroundColor: [
                        'rgba(0, 123, 255, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(0, 123, 255, 1)',
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                },
                {
                    label: 'Processing',
                    data: [19, 11, 13, 14, 16, 16, 12],
                    backgroundColor: [
                        'rgba(255, 193, 7, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 193, 7, 1)',
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                },
                {
                    label: 'Unpaid',
                    data: [19, 11, 13, 14, 16, 16, 19],
                    backgroundColor: [
                        'rgba(220, 53, 69, 0.2)'
                    ],
                    borderColor: [
                        'rgba(220, 53, 69, 1)'
                    ],
                    borderWidth: 1
                },
                {
                    label: 'Cancelled',
                    data: [3, 4, 2, 3, 3, 5, 2],
                    backgroundColor: [
                        'rgb(108, 117, 125, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(108, 117, 125, 1)',
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }
            ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                },
                elements: {
                    line: {
                        tension: 0
                    }
                }
            }
        });

        var ctx2 = document.getElementById("verifications_chart").getContext('2d');
        var verChart = new Chart(ctx2, {
            type: 'line',
            data: {
                labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                datasets: [
                  {
                    label: 'Verified',
                    data: [13, 14, 15, 24, 28, 29],
                    backgroundColor: [
                      'rgba(40, 167, 69, 0.2)',
                      //'rgba(255, 99, 132, 0.2)',
                      'rgba(54, 162, 235, 0.2)',
                      'rgba(255, 206, 86, 0.2)',
                      'rgba(75, 192, 192, 0.2)',
                      'rgba(153, 102, 255, 0.2)',
                      'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                      'rgba(40, 167, 69, 1)',
                      //'rgba(255,99,132,1)',
                      'rgba(54, 162, 235, 1)',
                      'rgba(255, 206, 86, 1)',
                      'rgba(75, 192, 192, 1)',
                      'rgba(153, 102, 255, 1)',
                      'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                  },
                  {
                    label: 'For Verification',
                    data: [17, 18, 32, 20, 21, 21],
                    backgroundColor: [
                        'rgba(0, 123, 255, 0.2)',
                        //'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(0, 123, 255, 1)',
                        //'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                },
                {
                    label: 'Payment Approval',
                    data: [29, 29, 18, 14, 14, 15],
                    backgroundColor: [
                        'rgba(255, 193, 7, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 193, 7, 1)',
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                },
                {
                    label: 'Waiting For Payment',
                    data: [4, 5, 4, 3, 3, 4],
                    backgroundColor: [
                        'rgba(220, 53, 69, 0.2)'
                    ],
                    borderColor: [
                        'rgba(220, 53, 69, 1)'
                    ],
                    borderWidth: 1
                }
            ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                },
                elements: {
                    line: {
                        tension: 0
                    }
                }
            }
        });
});
