
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
<body>

 

        <!-- Navigation
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        Brand and toggle get grouped for better mobile display 
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">PHP CRUD using MySQLi Database</a>
            </div>
     
        Sidebar Menu Items - These collapse to the responsive navigation menu on small screens
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                 <li class="active">
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li> 
                
                </ul>
            </div>
             
        </nav> -->

        <div id="page-wrapper">
            
<h1>Hello, <?php echo $_SESSION['first_name']; ?>!</h1>
<a href="logout.php"><h4>Logout</h4></a>

            <div class="container-fluid">
    
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                    <img src="/phpcrud/src/logo.jpg" alt="alternatetext">
                        <h1 class="page-header">
                         Administración
                        </h1>
                       
                    </div>
                </div>
                <!-- /.row -->

        <div class="row">
            <div class="col-md-12">
                <form name=" form1" method="get" action="search.php">
                   <input type="text" name="search" placeholder="Search..." required class="form-control">
                   <input type="submit" value="Search" name="submit"></input>
                </form> 
                
                <h2>Lista de Usuarios</h2> <a href="add.php?action=add" type="button" class="btn btn-xs btn-info">Añada Nuevo Usuario</a>
                 
                    <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>First Name</th>
                                        <th>Las Name</th>
                                        <th>Middle Name</th>
                                        <th>Address</th>
                                        <th>Comment</th>
                                        <th>PIN</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                        <tbody name="myTable">
                        <?php   
                        $sql = mysqli_query($db, "SELECT * FROM users ORDER BY first_name");
                        $count =1;
                        $row = mysqli_num_rows($sql);
                        if($row > 0){
                             while($row = mysqli_fetch_array($sql)) {
                        ?>                 
                              <tr>
                                <td><?php echo $count;?></td>
                                <td><?php echo $row['first_name'];?></td>
                                <td><?php echo $row['last_name'];?></td>
                                <td><?php echo $row['mid_name'];?></td>
                                <td><?php echo $row['address'];?></td>
                                <td><?php echo $row['comment'];?></td>
                                <td><?php echo $row['password'];?></td>
                                <td>
                                <?php echo '<a  type="button" class="btn btn-xs btn-success" href="profile.php?action=edit & id='.$row['id'] . '"> View </a>'; ?>
                                <?php echo '<a  type="button" class="btn btn-xs btn-primary" href="edit.php?action=edit & id='.$row['id'] . '"> Edit </a>'; ?>
                                <?php echo '<a  type="button" class="btn btn-xs btn-danger" href="del.php?type=users&delete & id='. $row['id'] . '">Delete </a>'; ?>
                                </td>
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





    
</body>

</html>
