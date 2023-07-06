<!DOCTYPE html>
<?php
     session_start();

    if (isset($_SESSION['id']) && isset($_SESSION['first_name'])) {
    $i=$_SESSION['id'];   
     }
include('connection.php');
include('header.php');
?>
<html>

<head>
    <title>Search</title>
</head>
<body>

<a href="report.php" type="button" class="btn btn-xs btn-info">Back</a>

<div id="page-wrapper">

    <div class="container-fluid">


        <div class="row">
        <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Actividad</th>
                    <th>Descripción</th>
                    <th>Fecha del Reporte</th>                                     
                    <th>Editar</th>
                    <th>Borrar</th>
                </tr>
                </thead>
            <tbody>
            <?php
            include('connection.php');

            $search = $_GET ['search'];



            $sql = "SELECT * FROM reports 
            WHERE users_id =$i
            AND CONCAT(select_activity, activity_description, to_date)
            LIKE ('%" . $search ."%')";
            $run = mysqli_query($db,$sql);
            $foundnum = mysqli_num_rows($run);

            if($foundnum==0)
            {
                echo "We were unable to find a product with a search term of '<b>$search</b>'.";
            }
            else{
                
                echo "<h1><strong> $foundnum Results Found for \"" .$search."\" </strong></h1>";
                $sql = "SELECT * FROM reports 
                WHERE users_id =$i
                AND CONCAT(select_activity, activity_description, to_date)
                LIKE ('%" . $search ."%')";
                $getquery = mysqli_query($db,$sql);
                $count =1;
                while($runrows = mysqli_fetch_array($getquery))
                {
            ?>
                        <tr>  
                            <td><?php echo $count;?></td>
                            <td><?php echo $runrows['select_activity'];?></td>
                            <td><?php echo $runrows['activity_description'];?></td>
                            <td><?php echo $runrows['to_date'];?></td>
                            <td>
                                <?php echo '<a  type="button" class="btn btn-xs btn-primary" href="editReport1.php?action=edit & id='.$runrows['id'] . '"> Editar </a>'; ?>
                                </td>
                              <?php
                                echo "<td><form method='POST' action='delReport.php'>";
                                echo "<input type='hidden' name='id' value='{$runrows['id']}'>";
                                echo "<input type='submit' class='btn btn-xs btn-danger' value='Borrar'>";
                                echo "</form></td>";
                                ?>
                        </tr>     
           
            <?php
            $count = $count+1;
            }}
            ?>
            </tbody>
            </table>
        </div>
        </div>
        </div>
    </div>
</div>
<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Morris Charts JavaScript -->
<script src="js/plugins/morris/raphael.min.js"></script>
<script src="js/plugins/morris/morris.min.js"></script>
<script src="js/plugins/morris/morris-data.js"></script>

<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstarp/3.3.0/js/bootstrap.min.js"></script>
<link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap.min.css" rel="stylesheet"/>


</body>
</html>
