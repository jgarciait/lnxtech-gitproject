<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
	        <?php 

				include('connection.php');

                $pdo = new PDO("mysql:host=localhost:3306;dbname=peopledb;charset=utf8mb4", 'root','');
                $sql = "UPDATE reports SET from_date = :from_date, to_date = :to_date, activity_description = :activity_description, select_activity = :select_activity, users_id = :users_id WHERE id = :id";     
						$id = $_POST['id'];
                        $from_date = $_POST['from_date'];
                        $to_date = $_POST['to_date'];
                        $activity_description = $_POST['activity_description'];
					    $select_activity = $_POST['select_activity'];	
                        $users_id = $_POST['users_id'];

                        $stmt = $pdo->prepare($sql);
						$stmt->bindParam(':id', $id);
                        $stmt->bindParam(':from_date', $from_date);
                        $stmt->bindParam(':to_date', $to_date);
                        $stmt->bindParam(':activity_description', $activity_description);
                        $stmt->bindParam(':select_activity', $select_activity);
                        $stmt->bindParam(':users_id', $users_id);

                        if ($stmt->execute()) {
                            echo "Data inserted successfully.";
                          } else {
                            echo "Error inserting data.";
                          }
                          ?>
      		<script type="text/javascript">
			alert("Reporte Actualizado.");
			window.location = "report.php";
		</script>
 </body>
</html>