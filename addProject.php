
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



        <div id="page-wrapper">
        <a href="report.php" type="button" class="btn btn-xs btn-info">Volver a Inicio</a>
<?php; 
 $f=$_SESSION['first_name'];
 ?>

            <div >

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                        <small>Proyecto</small>
                        </h1>
                       
                    </div>
                </div>
                <!-- /.row -->
             <div>
                      <div >
                        <form role="form" method="post" action="transacProject.php?action=addProject">                         
                            <div class="col-md-6">
                              <input class="form-control" placeholder="Nombre del Proyecto" name="project_name" id="project_name">
                            </div>
                               <br>
                            <div class="col-md-6">
                            <label>Seleccione Actividad:</label>
                            <br> 
                            <select name="activityOptions[]" multiple>
                            <option value="Preparado">Preparado</option>
                            <option value="Escaneado">Escaneado</option>
                            <option value="Indexado">Indexado</option>
                            <option value="Re-Preparación de Expedientes">Re-Preparación de Expedientes</option>
                            <option value="Otra Actividad">Otra Actividad</option>
                            </select>

                            </select>
                            </div>
                            <br>
                            <div class="col-md-6">
                            <label>Cliente :</label>
                              <input class="form-control" placeholder="Cliente del Proyecto" name="project_client" id="project_client">
                            </div>
                            <div class="col-md-6">
                            <label>Proyecto Comienza: </label>
                            <input type="date" name="project_start" id="project_start" class="form-control">
                            </div>
                            <br>
                            <div class="col-md-6">
                            <label>Proyecto Termina: </label>
                            <input type="date" name="project_end" id="project_end" class="form-control">
                            </div>
                            <br>
                            <div class="col-md-6">
                            <label>Cantidad de Unidades del Proyecto</label>
                            <br>
                            <select type="number" name="project_unit_qty">
                                <?php
                                // Generate numbers 1 to 10
                                for ($n = 0; $n <= 5000; $n++) {
                                    echo "<option value='$n'>$n</option>";
                                }
                                ?>
                            </select>
                            </div>
                            <br>
                            <div class="col-md-6">
                            <label>Unidades del Proyecto</label>
                            <br>
                            <select name="project_unit" id="project_unit">
                            <option value="">Select...</option>
                            <option value="Cajas">Caja/s</option>
                            <option value="Documentos">Documento/s</option>
                            <option value="Imágenes">Imágen/es</option>
                            <option value="Formas">Forma/s</option>
                            <option value="Horas">Hora/s</option>
                            <option value="Otro">Otro (especifíque)</option>
                            </select>
                            </div> 
                            <br>
                            <div class="col-md-6">
                              <input class="form-control" placeholder="Notas" name="project_notes" id="project_notes">
                            </div>
                            <br>
                            <div class="col-md-6">
                            <button type="submit" class="btn btn-default btn-primary">Someter Proyecto</button>
                            </div>
                            <br>
                            <div>
                            <br>
                          </form>  
                    </div>
                </div>
                
            </div>
            <!-- /.container-fluid -->

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

</body>

</html>

