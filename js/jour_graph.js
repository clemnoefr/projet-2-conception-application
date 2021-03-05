                    var ctx = document.getElementById('myChart').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: ['01H','02H','03H','04H','05H','06H','07H','08H','09H','10H','11H','12H','13H','14H','15H','16H','17H','18H','19H','20H','21H','22H','23H', '24H'],
                            datasets: [{
                                label: 'Température',
                                data: [3, 5, 13, 5, 2, 3, 4, 19, 22, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 44],
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
                                data: [13, 15, 3, 15, 21, 13, 19, 23, 4, 2, 1, 7, 6, 13, 15, 4, 19, 9, 14, 17, 20, 9, 2],
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