<?php
       session_start();

       if (isset($_SESSION['id']) && isset($_SESSION['first_name'])) {
       
       }
       include('connection.php');
     
        ?>


        
<html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<b>Chart Type</b>
<select id="job-role">
  <option value="none"></option>
</select>
<div style="position: relative; width:85vw">
  <canvas id="jobChart" height="110"></canvas>
</div>

<!-- Queries from tables  -->
<?php

$sql1 = "SELECT SUM(unit_qty) AS total1 FROM reports
WHERE select_unit = 'Cajas'";
$sql2 = "SELECT SUM(project_unit_qty) AS total2 FROM projects
WHERE project_unit = 'Cajas'";

$result1 = $db->query($sql1);
$result2 = $db->query($sql2);

// Fetch data from queries
$row1 = $result1->fetch_assoc();
$row2 = $result2->fetch_assoc();

$sumValue1 = $row1['total1'];
$sumValue2 = $row2['total2'];

$result1->free_result();
$result2->free_result();

?>


    <head>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    </head>
        <body>
            <canvas id="myChart"></canvas>
            <script>
                // PHP to JavaScript data transfer
                var data = <?php echo json_encode($combinedData); ?>;
            </script>
            <a href="project.php" type="button" class="btn btn-xs btn-success"><h5>Ir a Proyectos</h5></a>
        </body>
</html>

<script>
    // Chart creation and configuration
    Chart.defaults.font.size = 16;
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Total de Cajas'],
            datasets: [{
                label: 'Cajas Trabajadas en Reportes',
                data: [<?php echo $sumValue1; ?>],
                backgroundColor: '#0b807c',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                datalabels: {
                    color: 'white',
                    font: {
                        weight: 'bold',
                    },
                }

            }, {
                label: 'Total de Cajas de todos los Proyectos',
                data: [<?php echo $sumValue2; ?>],
                backgroundColor: '#105075',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1,
                datalabels: {
                    color: 'white',
                    font: {
                        weight: 'bold',                   
                    },
                }
            }]
        },
        options: {
            responsive: true,
            scales: {  
                y: {
                    beginAtZero: true,  
                }
            }
        },
        plugins: [ChartDataLabels],
    });

document.getElementById('job-role').addEventListener('change', function() {
chart.data.datasets = this.value == 'none' ? [] : jobDatasets[this.value];
chart.update();
});
</script>