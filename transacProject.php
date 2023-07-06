
<?php
       
       include('connection.php');
       include('header.php');
       
?>
        
<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['first_name'])) {
}
?>  

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">CRUD Using PHP/MySQL</a>
            </div>
     
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">
             <div class="col-lg-12">
                
                <?php 
                $pdo = new PDO("mysql:host=localhost:3306;dbname=peopledb;charset=utf8mb4", 'root','');
                $sql = "INSERT INTO projects (id, project_name, project_activity, project_client, project_start, project_end, project_unit_qty, project_unit, project_notes) VALUES (Null, :project_name, :project_activity, :project_client, :project_start, :project_end, :project_unit_qty, :project_unit, :project_notes)";
                    
                        $project_name = $_POST['project_name'];
                        $selectedActivities = $_POST['activityOptions'];
                        $project_client = $_POST['project_client'];
                        $project_start = $_POST['project_start'];
                        $project_end = $_POST['project_end'];
                        $project_unit_qty = $_POST['project_unit_qty'];
                        $project_unit = $_POST['project_unit'];
                        $project_notes = $_POST['project_notes'];
                        
                           $valuePlaceholders = array();
                        foreach ($selectedActivities as $activityOptions) {
                            $option = $db->real_escape_string($activityOptions);
                            $valuePlaceholders[] = "('$activityOptions')";
                        }

                        $project_activity .= implode(", ", $valuePlaceholders);

                        $stmt = $pdo->prepare($sql);
                        $stmt->bindParam(':project_name', $project_name);
                        $stmt->bindParam(':project_client', $project_client);
                        $stmt->bindParam(':project_activity', $project_activity);
                        $stmt->bindParam(':project_start', $project_start);
                        $stmt->bindParam(':project_end', $project_end);
                        $stmt->bindParam(':project_unit_qty', $project_unit_qty);
                        $stmt->bindParam(':project_unit', $project_unit);
                        $stmt->bindParam(':project_notes', $project_notes);

                     
                    
                        // Combine the value placeholders into the SQL statement
                      


                        if ($stmt->execute()) {
                            echo "Data inserted successfully.";
                          } else {
                            echo "Error inserting data.";
                          }
                          
                          ?>
      <script type="text/javascript">
			alert("Nuevo Proyecto Creado");
			window.location = "project.php";
		</script>
   
                    </div>
                </div>
                
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>

