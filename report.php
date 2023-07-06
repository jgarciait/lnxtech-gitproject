
<?php
       session_start();

       if (isset($_SESSION['id']) && isset($_SESSION['first_name'])) {
       
       }
       include('connection.php');
       include('header.php');
        ?>  
<html>
    


<script>
    $(document).ready(function(){
        $("#myInput").on("keyup",function(){
            var value=$(this).val().toLowerCase();
            $("#myTable tr").filter(function(){
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
<style>
    /* Enable text wrapping for the table cells */
    #myTable td {
        white-space: normal !important;
        word-wrap: break-word;
    }
</style>

<body>



<style>
  .profile-container {
    position: relative;
    text-align: right;
  }

  .profile-name {
    position: absolute;
    top: 0;
    right: 0;
    padding: 10px;
    background-color: #FFFFFF;
    font-weight: bold;
  }

  /* Adjust for smartphones */
  @media screen and (max-width: 480px) {
    .profile-container {
      text-align: right;
    }

    .profile-name {
      position: static;
      margin-top: 10px;
    }
  }
</style>

        <div id="page-wrapper">
            

<h3><?php

 $i=$_SESSION['id'];
?></h3>

<div class="profile-container">
  <div class="profile-name"><h4>Hola, <?php echo $_SESSION['first_name']; echo " "; echo $_SESSION['last_name'];?>!</h4></div>
</div>

<a href="home.php" type="button" class="btn btn-xs btn-danger">Logout</a>

            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                         Reporte de Producción Diaria
                        </h1>
                       
                    </div>
                </div>
                <!-- /.row -->

        <div class="row">
            <div class="col-lg-12">
                <form name=" form1" method="get" action="searchReport.php">
                   <input type="text" name="search" placeholder="Search..." required class="form-control">
                </form> 
                
                <h2>Reportes</h2> <a href="checkInOut.php" type="button" class="btn btn-xs btn-primary"><h5>Añada Nuevo Reporte</h5></a>
                <a href="addReport2.php?action=add" type="button" class="btn btn-xs btn-primary"><h5>Añada Nuevo Reporte (test)</h5></a>
                <a href="addProject.php?action=add" type="button" class="btn btn-xs btn-info"><h5>Añada Proyecto</h5></a>
                 <a href="project.php" type="button" class="btn btn-xs btn-success"><h5>Ir a Proyectos</h5></a>
                    <div class="table-responsive">
                            <table id="myTable" class="w-auto table table-bordered table-striped" >
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Actividad</th>
                                        <th>QTY</th>
                                        <th>Unidad</th>
                                        <th>Proyecto</th>
                                        <th>Fecha del Reporte</th>                                     
                                        <th>Editar</th>
                                        <th>Borrar</th>
                                    </tr>
                                </thead>
                        <tbody name="myTable">
                        <?php   
                        $sql = mysqli_query($db, "SELECT * FROM users
                           INNER JOIN reports ON reports.users_id = users.id
                           WHERE users_id = $i
                           ORDER BY report_timestamp DESC
                        ");
                          $sql = mysqli_query($db, "SELECT * FROM projects
                          INNER JOIN reports ON reports.projects_id = projects.id
                          WHERE users_id = $i
                       ");
                        
                        $count =1;
                        $row = mysqli_num_rows($sql);
                       
                        if($row > 0){
                             while($row = $sql->fetch_assoc()) {
                        ?>                 
                              <tr>
                                <td><?php echo $count;?></td>
                                <td><?php echo $row['select_activity'];?></td>
                                <td><?php echo $row['unit_qty'];?></td>
                                <td><?php echo $row['select_unit'];?></td>
                                <td><?php echo $row['project_name'];?><?php echo " de "?><?php echo $row['project_client'];?></td>
                                <td><?php  echo $row['to_date'];?></td>
                                                         
                                <td>
                                <?php echo '<a  type="button" class="btn btn-xs btn-primary" href="editReport1.php?action=edit & id='.$row['id'] . '"> Editar </a>'; ?>
                                </td>
                              <?php
                                echo "<td><form method='POST' action='delReport.php'>";
                                echo "<input type='hidden' name='id' value='{$row['id']}'>";
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
            <!-- /.container-fluid -->
        </div>
        </div>
        <!-- /#page-wrapper -->

 
    <!-- /#wrapper -->

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

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
  
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>



    
</body>

</html>
