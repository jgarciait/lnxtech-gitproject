<?php
       session_start();

       if (isset($_SESSION['id']) && isset($_SESSION['first_name'])) {
       }
       include('connection.php');
     
 ?>  
<html>
<?php echo $search; ?>
<form method="POST" action="chartByProject.php">

<select type="number" name="search" onchange="submitForm()">
<option value="<?php echo $search; ?>" selected>-- Total de Cajas --</option>
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
WHERE CONCAT(id)
AND id = $search";

if ($search == 0) {
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
}
else {
$result1 = $db->query($sql1);
$result2 = $db->query($sql2);

// Fetch data from queries
$row1 = $result1->fetch_assoc();
$row2 = $result2->fetch_assoc();

$sumValue1 = $row1['total1'];
$sumValue2 = $row2['total2'];

$result1->free_result();
$result2->free_result();
}
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
</script>