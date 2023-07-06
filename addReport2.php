
<?php
       
       include('connection.php');

?>  
<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['first_name'])) {

}
?> 
<html>
    <head>
        <meta charset="UTF-8">
        <title>iReport</title>
        <link href='https://fonts.googleapis.com/css?family=Lato:300,400' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/reportstyle.css">
    </head>
<body>
<div class="testbox">

        


                <form role="form" method="post" action="transacReport.php?action=addReport">
                    <div class="banner">
                        <h1>Reporte de Producción</h1>
                    </div>
                    
                    <p class="top-info">Document Control Systems Inc.</p>  
                    <hr> 
             
                    <div class="name-item">
                    <p>Desde: </p>    
                    <input  type="datetime-local" name="from_date">
                    </div>
                    <div class="name-item">
                    <p>Hasta: </p>  
                    <input  type="datetime-local" name="to_date">
                    </div>
                        
                  
                    <div class="select-item">
                
                            <select name="selectActivities[]" multiple>
                                <option value="" selected>Seleccione Actividad --</option>
                                <option value="Preparado">Preparado</option>
                                <option value="Escaneado">Escaneado</option>
                                <option value="Indexado">Indexado</option>
                                <option value="Re-Preparación de Expedientes">Re-Preparación de Expedientes</option>
                                <option value="Otra Actividad">Otra Actividad</option>
                            </select>
                                   
                            <select id="input-4" type="number" name="unit_qty">
                            <option value="">Cantidad de Unidades Trabajadas: </option>
                                <?php
                                // Generate numbers 1 to 10
                                for ($n = 1; $n <= 200; $n++) {
                                    echo "<option value='$n'>$n</option>";
                                }
                                ?>
                            </select>
             
                            <select id="input-5" name="select_unit">
                            <option value="">Unidad: </option>
                            <option value="Cajas">Caja/s</option>
                            <option value="Documentos">Documento/s</option>
                            <option value="Imágenes">Imágen/es</option>
                            <option value="Formas">Forma/s</option>
                            <option value="Horas">Hora/s</option>
                            <option value="Otro">Otro (especifíque)</option>
                            </select>
                            <select id="input-6" name="projects_id">
                            <option value="">Proyecto: </option>
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
                    <div class="item">
                       
                    <input type="text" placeholder="Notas:" name="notes"/>
                  
                    </div>

                            <?php
                             $i=$_SESSION['id'];
                            ?>
                            <input type="hidden" name="users_id" id="users_id" value="<?php echo $i; ?>"></input>
                            <div class="btn-block">
                                <button type="submit" href="/">Someter Reporte</button>
                            </div>
                        </form>
                        <script src="js/index.js"></script>
</div>
</body>
</html>

