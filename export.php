<?php
// Connect to MySQL
$mysqli = new mysqli('localhost', 'username', 'password', 'database');

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

// Retrieve data from MySQL
$result = $mysqli->query("SELECT * FROM your_table");

// Fetch data into DataTable or associative array
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Close the MySQL connection
$mysqli->close();

?>