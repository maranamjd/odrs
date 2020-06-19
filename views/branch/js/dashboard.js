$(document).ready(function(){
  var ctx = document.getElementById("doc_chart_main").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                datasets: [
                {
                    label: 'Claimed',
                    data: [14, 17, 12, 12, 14, 17],
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
                    label: 'Releasing',
                    data: [11, 15, 10, 10, 10, 15],
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
                    label: 'Pending',
                    data: [19, 11, 13, 14, 16, 16],
                    backgroundColor: [
                        'rgba(255, 193, 7, 0.2)',
                        //'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 193, 7, 1)',
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
                    label: 'Cancelled',
                    data: [3, 4, 2, 3, 3, 5],
                    backgroundColor: [
                        'rgb(108, 117, 125, 0.2)',
                        //'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(108, 117, 125, 1)',
                        //'rgba(255,99,132,1)',
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
        }); // odrs week

        var ctx2 = document.getElementById("doc_chart_today").getContext('2d');
        var myChart2 = new Chart(ctx2, {
            type: 'polarArea',
            data: {
                labels: ["Claimed", "Releasing", "Pending", "Cancelled"],
                datasets: [
                {
                    data: [14, 17, 12, 5],
                    backgroundColor: [
                        'rgba(0, 123, 255, 0.5)',
                        'rgba(40, 167, 69, 0.5)',
                        'rgba(255, 193, 7, 0.5)',
                        'rgba(108, 117, 125, 0.5)'
                    ],
                    borderColor: [
                        'rgba(255, 255, 255, 1)',
                        'rgba(255, 255, 255, 1)',
                        'rgba(255, 255, 255, 1)',
                        'rgba(255, 255, 255, 1)'
                    ],
                    borderWidth: 2
                }
            ]
            },
            options: {
                elements: {
                    line: {
                        tension: 0
                    }
                }
            }
        }); // odrs today

        var ctx3 = document.getElementById("graduate_chart_main").getContext('2d');
        var myChart3 = new Chart(ctx3, {
            type: 'line',
            data: {
                labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                datasets: [ {
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
                    label: 'Pending',
                    data: [29, 29, 18, 14, 14, 15],
                    backgroundColor: [
                        'rgba(255, 193, 7, 0.2)',
                        //'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 193, 7, 1)',
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
                    label: 'Cancelled',
                    data: [4, 5, 4, 3, 3, 4],
                    backgroundColor: [
                        'rgb(108, 117, 125, 0.2)',
                        //'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(108, 117, 125, 1)',
                        //'rgba(255,99,132,1)',
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
        }); // graduate main

        var ctx4 = document.getElementById("graduate_chart_today").getContext('2d');
        var myChart4 = new Chart(ctx4, {
            type: 'polarArea',
            data: {
                labels: ["For Verification", "Verified", "Pending", "Cancelled"],
                datasets: [
                {
                    data: [14, 20, 15, 5],
                    backgroundColor: [
                        'rgba(0, 123, 255, 0.5)',
                        'rgba(40, 167, 69, 0.5)',
                        'rgba(255, 193, 7, 0.5)',
                        'rgba(108, 117, 125, 0.5)'
                    ],
                    borderColor: [
                        'rgba(255, 255, 255, 1)',
                        'rgba(255, 255, 255, 1)',
                        'rgba(255, 255, 255, 1)',
                        'rgba(255, 255, 255, 1)'
                    ],
                    borderWidth: 2
                }
            ]
            },
            options: {
                elements: {
                    line: {
                        tension: 0
                    }
                }
            }
        }); // graduate today

        var ctx3 = document.getElementById("clearance_chart_main").getContext('2d');
        var myChart3 = new Chart(ctx3, {
            type: 'line',
            data: {
                labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                datasets: [ {
                    label: 'Cleared',
                    data: [13, 14, 15, 24, 28, 29],
                    backgroundColor: [
                        'rgba(40, 167, 69, 0.2)'
                    ],
                    borderColor: [
                        'rgba(40, 167, 69, 1)'
                    ],
                    borderWidth: 1
                },
                {
                    label: 'Marked',
                    data: [29, 29, 18, 14, 14, 15],
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
        }); // clearance main

        var ctx4 = document.getElementById("clearance_chart_today").getContext('2d');
        var myChart4 = new Chart(ctx4, {
            type: 'polarArea',
            data: {
                labels: ["Cleared", "Marked"],
                datasets: [
                {
                    data: [15, 6],
                    backgroundColor: [
                        'rgba(40, 167, 69, 0.5)',
                        'rgba(220, 53, 69, 0.5)',
                    ],
                    borderColor: [
                        'rgba(255, 255, 255, 1)',
                        'rgba(255, 255, 255, 1)',
                    ],
                    borderWidth: 2
                }
            ]
            },
            options: {
                elements: {
                    line: {
                        tension: 0
                    }
                }
            }
        }); // clearance today

        var ctx5 = document.getElementById("traffic_chart_main").getContext('2d');
        var myChart5 = new Chart(ctx5, {
            type: 'line',
            data: {
                labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                datasets: [ {
                    label: 'Online Document Request',
                    data: [179, 180, 320, 200, 171, 320],
                    backgroundColor: [
                        'rgba(220, 53, 69, 0.2)'
                    ],
                    borderColor: [
                        'rgba(220, 53, 69, 1)'
                    ],
                    borderWidth: 1
                },
                {
                    label: 'Graduate Verification',
                    data: [100, 102, 150, 120, 70, 123],
                    backgroundColor: [
                        'rgba(0, 123, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(0, 123, 255, 1)'
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
        }); // traffic main

        var ctx6 = document.getElementById("traffic_chart_today").getContext('2d');
        var myChart6 = new Chart(ctx6, {
            type: 'polarArea',
            data: {
                labels: ["Online Document Request", "Graduate Verification"],
                datasets: [
                {
                    data: [100, 50],
                    backgroundColor: [
                        'rgba(220, 53, 69, 0.5)',
                        'rgba(0, 123, 255, 0.5)'
                    ],
                    borderColor: [
                        'rgba(255, 255, 255, 1)',
                        'rgba(255, 255, 255, 1)'
                    ],
                    borderWidth: 2
                }
            ]
            },
            options: {
                elements: {
                    line: {
                        tension: 0
                    }
                }
            }
        }); // traffic today
});
