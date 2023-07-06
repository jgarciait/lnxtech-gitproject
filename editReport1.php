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
            <a href="report.php" type="button" class="btn btn-xs btn-info">Volver a Inicio</a>
                <!-- Page Heading -->

                <!-- /.row -->
<?php 
$query = 'SELECT * FROM reports WHERE id='.$_GET['id'];
            $sql = mysqli_query($db, $query) or die(mysqli_error($db));
              while($row = mysqli_fetch_array($sql))
              {   
                $zz= $row['id'];
                $i= $row['from_date'];
                $a=$row['to_date'];
                $c=$row['select_activity'];
                $b=$row['notes'];
                $d=$row['users_id'];                   
              }
              
              $id = $_GET['id'];
         
?>

             <div class="col-md-12">
                  <h2>Edita el Reporte</h2>
                      <div>

                        <form role="form" method="post" action="editReport2.php">
                            
                            <div class="form-group">
                                <input type="hidden" name="id" value="<?php echo $zz; ?>" />
                            </div>
                            <div class="form-group">
                              <label>Desde: </label>
                              <input type="datetime-local" class="form-control" id="from_date" name="from_date" value="<?php echo $i; ?>">
                            </div>
                            <div class="form-group">
                            <label>Hasta: </label>
                              <input type="datetime-local" class="form-control" id="to_date"  placeholder="Hasta" name="to_date" value="<?php echo $a; ?>">
                            </div> 
                           
                            <br>
                            Seleccione Actividad
                            <select name="select_activity" id="select_activity">
                            <option value="<?php echo $c; ?>">Opción Anteriormente Seleccionada: <?php echo $c; ?></option>
                            <option value="Preparado">Preparado</option>
                            <option value="Escaneado">Escaneado</option>
                            <option value="Indexado">Indexado</option>
                            <option value="Re-Preparación">Re-preparación de Expedientes</option>
                            <option value="Otra Actividad">Otra (especifíque)</option>
                            </select>
                            <br><br>
                            <div class="form-group">
                            <label>Descripción de la Actividad: </label>
                              <input class="form-control" placeholder="Notes" id="notes" name="notes" value="<?php echo $b; ?>">
                            </div> 
                            </div>
                                <input type="hidden" name="users_id" value="<?php echo $d; ?>" />
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

