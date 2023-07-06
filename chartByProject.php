<?php
       session_start();

       if (isset($_SESSION['id']) && isset($_SESSION['first_name'])) {
       }
       include('connection.php');
     
 ?>  
<html>

<form method="POST" action="chartByProject.php">

<select type="number" name="search">
<option value="0" selected>-- Seleccione Proyecto --</option>
<?php

// Query to select options from the table
$sql = "SELECT id, project_name, project_client FROM projects
WHERE project_unit = 'Cajas'
";   
// Execute the query
$result = $db->query($sql);

// Check if any rows were returned
if ($result->num_rows > 0) {
   
    // Loop through the rows and create an option for each record
    while ($row = $result->fetch_assoc()) {
        // Output the option HTML
        echo '<option value="' . $row["id"] . '">' . $row["project_name"] . ',' . $row["project_client"] . '</option>';
    }
}
$search = $_POST ['search'];
?>

</select>
<input type="submit" name="submit">

</form>  
<!-- Queries from tables  -->
<?php


$sql1 = "SELECT SUM(unit_qty) AS total1 FROM reports
WHERE select_unit = 'Cajas'
AND CONCAT(projects_id)
AND projects_id = $search
";
$sql2 = "SELECT SUM(project_unit_qty) AS total2 FROM projects
WHERE CONCAT(id, project_name)
AND id = $search";

$sql3 = "SELECT project_name AS projectName FROM projects
WHERE CONCAT(id, project_name)
AND id = $search";

$sql4 = "SELECT project_client AS projectClient FROM projects
WHERE CONCAT(id, project_name)
AND id = $search";

if ($search == 0) {
    $sumValue1 = "0";
    $sumValue2 = "0";
    $projectName3 = "";
    $projectClient4 = "";
    $proyecto = "Seleccione Proyecto";
    $de = "";

}
else {
$result1 = $db->query($sql1);
$result2 = $db->query($sql2);
$result3 = $db->query($sql3);
$result4 = $db->query($sql4);

// Fetch data from queries
$row1 = $result1->fetch_assoc();
$row2 = $result2->fetch_assoc();
$row3 = $result3->fetch_assoc();
$row4 = $result4->fetch_assoc();

$sumValue1 = $row1['total1'];
$sumValue2 = $row2['total2'];
$projectName3 = $row3['projectName'];
$projectClient4 = $row4['projectClient'];

$result1->free_result();
$result2->free_result();
$result3->free_result();
$result4->free_result();
$proyecto = "Proyecto ";
$de = " de ";
}
?>


    <head>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    </head>
    <h2 style="text-align:center"><?php echo $proyecto ?><?php echo $projectName3; ?><?php echo $de ?><?php echo $projectClient4; ?></h2>
        <body>
            <canvas id="myChart"></canvas>
           
            <script>
                // PHP to JavaScript data transfer
               
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
</script>