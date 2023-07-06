
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
                $sql = "INSERT INTO reports (id, from_date, to_date, select_activity, unit_qty, select_unit, notes, users_id, projects_id) VALUES (Null, :from_date, :to_date, :select_activity, :unit_qty, :select_unit, :notes, :users_id, :projects_id)";
                      
                
                        $from_date = $_POST['from_date'];
                        $to_date = $_POST['to_date'];
                        $selectedActivities = $_POST['selectActivities'];  
                        $unit_qty = $_POST['unit_qty'];   
					    $select_unit = $_POST['select_unit'];	   
                        $notes = $_POST['notes'];
                        $users_id = $_POST['users_id'];
                        $projects_id = $_POST['projects_id'];

                        $valuePlaceholders = array();
                        foreach ($selectedActivities as $selectActivities) {
                            $option = $db->real_escape_string($selectActivities);
                            $valuePlaceholders[] = "('$selectActivities')";
                        }

                        $select_activity .= implode(", ", $valuePlaceholders);

                        $stmt = $pdo->prepare($sql);
                        $stmt->bindParam(':from_date', $from_date);
                        $stmt->bindParam(':to_date', $to_date);
                        $stmt->bindParam(':select_activity', $select_activity);
                        $stmt->bindParam(':unit_qty', $unit_qty);
                        $stmt->bindParam(':select_unit', $select_unit);
                        $stmt->bindParam(':notes', $notes);
                        $stmt->bindParam(':users_id', $users_id);
                        $stmt->bindParam(':projects_id', $projects_id);

                        if ($stmt->execute()) {
                            echo "Data inserted successfully.";
                          } else {
                            echo "Error inserting data.";
                          }
                          ?>
      <script type="text/javascript">
			alert("Nuevo Reporte Creado");
			window.location = "report.php";
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

