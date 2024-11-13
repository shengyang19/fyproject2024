<?php
$id = $_POST["booking_id"];
$ci = $_POST["checkin"];
$co = $_POST["checkout"];

// Database credentials
$host = 'localhost';
$username = 'u838201253_palladium';
$password = 'Azib277221';
$dbname = 'u838201253_phmsdb';

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to update data
$sql = "UPDATE hotel_rooms 
               SET start_date = ?, end_date = ? 
               WHERE id = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die('Error preparing the update query: ' . $conn->error);
}

// Bind parameters to the query
$stmt->bind_param("ssi", $ci, $co, $id);

// Execute the query
if ($stmt->execute()) {
    echo "Record updated successfully.";
} else {
    echo "Error updating record: " . $stmt->error;
}

// Close the prepared statement
$stmt->close();

// Close connection
$conn->close();
?>
