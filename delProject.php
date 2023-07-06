
<?php
       
       include('connection.php');      
        ?>  

<body>
	
<?php

// Create a PDO instance to connect to the database
$pdo = new PDO("mysql:host=localhost:3306;dbname=peopledb;charset=utf8mb4", 'root','');

// Prepare the SQL statement
$sql = "DELETE FROM projects WHERE id = :id";

// Retrieve the form data
$id = $_POST['id'];

// Bind the value to the parameter in the SQL statement
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id);

// Execute the SQL statement
if ($stmt->execute()) {
  echo "Data deleted successfully.";
} else {
  echo "Error deleting data.";
}					
?>

<script type="text/javascript">
	alert("Proyecto Borrado.");
	window.location = "project.php";
</script>				

</body>
</html>