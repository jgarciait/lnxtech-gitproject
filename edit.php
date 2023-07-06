<!DOCTYPE html>
<html lang="en">


<?php
       
       include('connection.php');
       include('header.php');
       
        ?>  
<body>
    <div>
        <div id="page-wrapper">

            <div class="container-fluid">
            <a href="index.php" type="button" class="btn btn-xs btn-info">Back</a>
                <!-- Page Heading -->

                <!-- /.row -->
<?php 
$query = 'SELECT * FROM users WHERE id='.$_GET['id'];
            $sql = mysqli_query($db, $query) or die(mysqli_error($db));
              while($row = mysqli_fetch_array($sql))
              {   
                $zz= $row['id'];
                $i= $row['first_name'];
                $a=$row['last_name'];
                $b=$row['to_date'];
                $c=$row['address'];
                $d=$row['contact'];
                $e=$row['comment'];
                <tr>
       
              }
              
              $id = $_GET['id'];
         
?>

             <div class="col-md-12">
                  <h2>Edit Records</h2>
                      <div>

                        <form role="form" method="post" action="edit1.php">
                            
                            <div class="form-group">
                                <input type="hidden" name="id" value="<?php echo $zz; ?>" />
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="First Name" name="firstname" value="<?php echo $i; ?>">
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="Last Name" name="lastname" value="<?php echo $a; ?>">
                            </div> 
                            <div class="form-group">
                              <input class="form-control" placeholder="Middle Name" name="Middlename" value="<?php echo $b; ?>">
                            </div> 
                            <div class="form-group">
                              <input class="form-control" placeholder="Address" name="Address" value="<?php echo $c; ?>">
                            </div> 
                            <div class="form-group">
                             <label>Comment</label>
                              <textarea class="form-control" rows="3"  name="comment"><?php echo $e; ?></textarea>
                            </div>
                            <button type="submit" class="btn btn-default">Update Record</button>
                         


                      </form>  
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

