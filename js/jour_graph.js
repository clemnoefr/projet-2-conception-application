                    var ctx = document.getElementById('myChart').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: heure,
                            datasets: [{
                                label: 'Température',
                                data: temperature,
                                yAxisID: 'A',
                                backgroundColor: [
                                    'rgba(255,255,255, 0)',
                                
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                            }, {
                                label: 'Humidité',
                                yAxisID: 'B',
                                data: humidite,
                                backgroundColor: [
                                    'rgba(255,255,255, 0)',
                                ],
                                borderColor: [
                                    'rgba(50, 99, 132, 1)',
                                ],
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    id: 'A',
                                    type: 'linear',
                                    position: 'left',
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Température'
                                    }
                                    }, {
                                    id: 'B',
                                    type: 'linear',
                                    position: 'right',
                                    ticks: {
                                        max: 100,
                                        min: 0
                                    },
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Humidité'
                                    }
                                }]
                            }
                          }
                    });