<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['first_name'])) {

}
$i=$_SESSION['id'];
include('connection.php');
// MySQL database credentials

// Check for connection errors
if ($db->connect_error) {
    die('Connection failed: ' . $sb->connect_error);
}

// Retrieve the scanned QR code content from the request
$qrContent = $_POST['qrContent'];

// Perform check-in or check-out operations based on the QR code content
$isCheckIn = true; // Assuming it's a check-in event, change as needed

if ($isCheckIn) {
    $checkInTime = date('Y-m-d H:i:s');
    $sql = "INSERT INTO attendance (id, qr_code, check_in_time, users_id) VALUES ('Null', '$qrContent', '$checkInTime', '$checkOutTime', $i)";
} else {
    $checkOutTime = date('Y-m-d H:i:s');
    $sql = "UPDATE attendance SET check_out_time = '$checkOutTime' WHERE qr_code = '$qrContent' AND check_out_time IS NULL";
}

// Execute the SQL query
if ($db->query($sql) === TRUE) {
    echo "Check-in/Check-out successful.";
} else {
    echo "Error: " . $sql . "<br>" . $db->error;
}

// Close the database connection
$db->close();
?>