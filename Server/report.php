<?php

require_once('phpexecution/uniretrieve.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="server-css/server-dashboards1.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="icon" type="image/x-icon" href="server-css/pictures/Logo/brgylogo.svg">
    <title>Server-Report</title>
    <style>
        #chartContainer {
            width: 100%;
            height:390px;
            max-height:390px;
            margin: 0;
            border: 2.5px solid black;
            border-radius: 5px;
        }
        .h1button{
            display:flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom:10px;
        }
        .h1button h1{
            margin:0;
        }
        .h1button img{
            max-height:14px;
            max-width:14px;
            margin-right:8px;
        }
        .h1button button{
            font-size: 15px;
            font-weight: bold;
            color: white;
            border-radius: 8px;
            background-color: #088e71;
            padding: 8px 16px;
            border: none;
            align-self: center; /* Align button vertically */
        }
        #totalsContainer {
            text-align: center;
            margin-top: 10px;
        }
        #totalsContainer div {
            display: inline-flex;
            align-items: center;
            margin: 0 10px;
        }
        #totalsContainer div div {
            width: 20px;
            height: 20px;
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div id="sidebartopa">
            <a href="server-dashboard.php">
                <div id="sidebartopwimg" class="sidebartopwimg">
                    <img src="server-css/pictures/sidebar/home.svg" alt="home">
                    <span>Home</span>    
                </div>
            </a>
            
            <a href="report.php">
                <div id="sidebartopwimg" class="sidebartopwimg active" onclick="toggleActive('sidebartopwimg1')">
                    <img src="server-css/pictures/sidebar/active_bar_chart.svg" alt="home">
                    <span>Report</span>    
                </div>
            </a>

            <a href="server-profile.php">
                <div id="sidebartopwimg" class="sidebartopwimg">
                    <img src="server-css/pictures/sidebar/profile.svg" alt="Profile">
                    <span>Profile</span>   
                </div>
            </a>

            <a href="server-add-admin.php">
                <div id="sidebartopwimg" class="sidebartopwimg">
                    <img src="server-css/pictures/sidebar/addmin.svg" alt="Profile">
                    <span>New Admin</span>   
                </div>
            </a>
        </div>
        
        <div id="sidebarbottoma">
            <a href="phpexecution/endsession.php">
                <div id="sidebartopwimg" class="sidebartopwimg">
                    <img src="server-css/pictures/sidebar/logout.svg" alt="Logout">
                    <span>Logout</span>  
                </div>
            </a>
        </div>

        <hr>

        <div id="profilebox">
            <div id="profileimage"></div>

            <div id="namebox">
                <h5 id="firstname"><?php echo ucfirst($user['username']);?></h5>
            </div>
        </div>
    </div>
    
    <script>
        $(document).ready(function(){
            var firstname = $('#firstname').text();
            var intials = firstname.charAt(0).toUpperCase();
            $('#profileimage').text(intials);
        });
    </script>
            
    <section id="for100vh chartSection">
        <div id="aboutsection">
            <div class="h1button">
                <h1>REPORT</h1>
                <button id="printChartButton"><img src="server-css/pictures/sidebar/report_save.svg" alt="save.svg">SAVE</button>
            </div>
            <div id="chartContainer">
                <canvas id="fileRequestChart"></canvas>
            </div>
        </div>
    </section>
    
    <script>
        $(document).ready(function() {
            function fetchData() {
                $.ajax({
                    url: 'phpexecution/report-fetch-data.php',
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        const data = response.data;
                        const fileCodeTotals = response.totals;

                        const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                        const fileCodes = [...new Set(data.map(item => item.file_code))];
                        const monthlyData = {};

                        // Initialize monthly data
                        months.forEach((month, index) => {
                            monthlyData[month] = {
                                total: 0,
                                fileCounts: {}
                            };
                            fileCodes.forEach(fileCode => {
                                monthlyData[month].fileCounts[fileCode] = 0;
                            });
                        });

                        // Populate monthly data
                        data.forEach(item => {
                            const month = months[item.month - 1];
                            monthlyData[month].fileCounts[item.file_code] = item.count;
                            monthlyData[month].total += item.count;
                        });

                        // Prepare data for chart
                        const labels = months;
                        const datasets = fileCodes.map(fileCode => {
                            return {
                                label: fileCode,
                                data: months.map(month => monthlyData[month].fileCounts[fileCode]),
                                borderColor: getRandomColor(),
                                backgroundColor: getRandomColor(),
                                fill: false
                            };
                        });

                        renderChart(labels, datasets, months.map(month => monthlyData[month].total));
                        displayTotals(fileCodeTotals, datasets);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }

            function getRandomColor() {
                const letters = '0123456789ABCDEF';
                let color = '#';
                for (let i = 0; i < 6; i++) {
                    color += letters[Math.floor(Math.random() * 16)];
                }
                return color;
            }

            function renderChart(labels, datasets, totals) {
                var ctx = document.getElementById('fileRequestChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: datasets
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            title: {
                                display: true,
                                text: 'File Requests Statistics for the Year',
                                font: {
                                    size: 20
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        let label = context.dataset.label || '';
                                        if (label) {
                                            label += ': ';
                                        }
                                        if (context.parsed.y !== null) {
                                            label += context.parsed.y;
                                        }
                                        return label;
                                    },
                                    title: function(tooltipItem, data) {
                                        return data.labels[tooltipItem[0].index];
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Number of Requests'
                                }
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'Months'
                                },
                                ticks: {
                                    font: {
                                        weight: 'bold',
                                        color: 'black'
                                    }
                                }
                            }
                        },
                        plugins: {
                            datalabels: {
                                display: true,
                                align: 'end',
                                anchor: 'end',
                                formatter: (value, context) => {
                                    const index = context.dataIndex;
                                    const total = totals[index];
                                    return total ? `${total} total` : '';
                                },
                                font: {
                                    size: 10,
                                }
                            }
                        }
                    }
                });
            }

            function displayTotals(fileCodeTotals, datasets) {
                let totalsContainer = $('<div id="totalsContainer" style="text-align: center;"></div>');
                
                for (const [index, dataset] of datasets.entries()) {
                    let fileCode = dataset.label;
                    let total = fileCodeTotals[fileCode];
                    let color = dataset.backgroundColor;

                    let totalItem = $(
                        `<div style="display: inline-flex; align-items: center; margin: 0 10px;">
                            <div style="width: 20px; height: 20px; background-color: ${color}; margin-right: 5px;"></div>
                            <span>${fileCode}: ${total}</span>
                        </div>`
                    );
                    totalsContainer.append(totalItem);
                }

                $('#chartContainer').after(totalsContainer);
            }

            fetchData();

            $('#printChartButton').on('click', function() {
                var canvas = document.getElementById('fileRequestChart');
                var imgData = canvas.toDataURL('image/png');

                var link = document.createElement('a');
                link.download = 'chart.png';
                link.href = imgData;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            });
        });
    </script>
</body>
</html>