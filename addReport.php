
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
                        <small>Reporte de Producción Diaria</small>
                        </h1>
                       
                    </div>
                </div>
                <!-- /.row -->
             <div>
                      <div >
                        <form role="form" method="post" action="transacReport.php?action=addReport">                         
                            <div class="col-md-6">
                            <label>Desde :</label>
                            <span class="error">*</span><br>
                            <input type="datetime-local" name="from_date" id="from_date" class="form-control">
                            </div>
                            <div class="col-md-6">
                            <label>Hasta :</label>
                            <span class="error">*</span><br>
                            <input type="datetime-local" name="to_date" id="to_date" class="form-control">
                            </div>
                            <br>
                            <div class="col-md-6">
                            <label>Seleccione Actividad:</label>
                            <br>
                            <select name="select_activity" id="select_activity">
                            <option value="">Select...</option>
                            <option value="Preparado">Preparado</option>
                            <option value="Escaneado">Escaneado</option>
                            <option value="Indexado">Indexado</option>
                            <option value="Re-preparación de Expedientes">Re-preparación de Expedientes</option>
                            <option value="Otra Actividad">Otra (especifíque)</option>
                            </select>
                            </div>
                            <br>
                            <div class="col-md-6">
                            <label>Cantidad de Unidades Trabajadas:</label>
                            <br>
                            <select type="number" name="unit_qty">
                                <?php
                                // Generate numbers 1 to 10
                                for ($n = 1; $n <= 200; $n++) {
                                    echo "<option value='$n'>$n</option>";
                                }
                                ?>
                            </select>
                            </div>
                            <br>
                            <div class="col-md-6">
                            <label>Seleccione Unidad:</label>
                            <br>
                            <select name="select_unit" id="select_unit">
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
                            <label>Seleccione Proyecto:</label>
                            <br>
                    
                            <select name="projects_id">
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
                                    echo '<option value="' . $row["id"] . '">' . $row["project_name"] . ', ' . $row["project_client"] . '</option>';
                                }
                            }
                            ?>
                            </select>    

                            </div>
                            <br>
                            <div class="col-md-6">
                              <input class="form-control" placeholder="Notas" name="notes" id="notes">
                            </div>
                            <br>
                            <div class="col-md-6">
                            <button type="submit" class="btn btn-default btn-primary">Enviar Reporte</button>
                            </div>
                            <br>
                            <div>
                            <?php
                             $i=$_SESSION['id'];
                            ?>
                            <input type="hidden" name="users_id" id="users_id" value="<?php echo $i; ?>"></input>
                       
                            </div>
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

