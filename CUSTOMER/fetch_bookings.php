<?php
header('Content-Type: application/json');
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

$user_id=$_COOKIE['user_id'];
        
$sql = "SELECT * FROM hotel_rooms WHERE guest_id='$user_id'";  // Join with the hotel_rooms table to get the room name

$result = $conn->query($sql);

$bookings = [];
if ($result->num_rows > 0) {
    // Fetch all rows as an associative array
    while ($row = $result->fetch_assoc()) {
        $bookings[] = $row; 
    }
}

// Set the header for JSON response
$conn->close();

// Output the data as JSON
echo json_encode($bookings);

// Close the connection
?>
