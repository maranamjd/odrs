var ctx = document.getElementById("q1_chart").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ["Board Exam", "New job", "Transfer to another school", "Other"],
                    datasets: [
                    {
                        label: 'Male',
                        data: [24, 27, 22, 22, 24, 17],
                        backgroundColor: [
                            'rgba(0, 123, 255, 0.2)',
                            'rgba(0, 123, 255, 0.2)',
                            'rgba(0, 123, 255, 0.2)',
                            'rgba(0, 123, 255, 0.2)'
                        ],
                        borderColor: [
                            'rgba(0, 123, 255, 1)',
                            'rgba(0, 123, 255, 1)',
                            'rgba(0, 123, 255, 1)',
                            'rgba(0, 123, 255, 1)'
                        ],
                        borderWidth: 1
                    },
                    {
                        label: 'Female',
                        data: [21, 15, 22, 15, 19, 20],
                        backgroundColor: [
                            'rgba(220, 53, 69, 0.2)',
                            'rgba(220, 53, 69, 0.2)',
                            'rgba(220, 53, 69, 0.2)',
                            'rgba(220, 53, 69, 0.2)'
                        ],
                        borderColor: [
                            'rgba(220, 53, 69, 1)',
                            'rgba(220, 53, 69, 1)',
                            'rgba(220, 53, 69, 1)',
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
            }); // q1

            var ctx2 = document.getElementById("q2_chart").getContext('2d');
            var myChart2 = new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: ["Employed", "Unemployed"],
                    datasets: [
                    {
                        label: 'Male',
                        data: [184, 75],
                        backgroundColor: [
                            'rgba(0, 123, 255, 0.2)',
                            'rgba(0, 123, 255, 0.2)'
                        ],
                        borderColor: [
                            'rgba(0, 123, 255, 1)',
                            'rgba(0, 123, 255, 1)'
                        ],
                        borderWidth: 1
                    },
                    {
                        label: 'Female',
                        data: [119, 20],
                        backgroundColor: [
                            'rgba(220, 53, 69, 0.2)',
                            'rgba(220, 53, 69, 0.2)'
                        ],
                        borderColor: [
                            'rgba(220, 53, 69, 1)',
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
            }); // q2

            var ctx2 = document.getElementById("q3_chart").getContext('2d');
            var myChart2 = new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: ["Yes", "No", "Not Looking for a job"],
                    datasets: [
                    {
                        label: 'Male',
                        data: [184, 75, 40],
                        backgroundColor: [
                            'rgba(0, 123, 255, 0.2)',
                            'rgba(0, 123, 255, 0.2)',
                            'rgba(0, 123, 255, 0.2)'
                        ],
                        borderColor: [
                            'rgba(0, 123, 255, 1)',
                            'rgba(0, 123, 255, 1)',
                            'rgba(0, 123, 255, 1)'
                        ],
                        borderWidth: 1
                    },
                    {
                        label: 'Female',
                        data: [119, 90, 23],
                        backgroundColor: [
                            'rgba(220, 53, 69, 0.2)',
                            'rgba(220, 53, 69, 0.2)',
                            'rgba(220, 53, 69, 0.2)'
                        ],
                        borderColor: [
                            'rgba(220, 53, 69, 1)',
                            'rgba(220, 53, 69, 1)',
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
            }); // q3     
