<?php
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

// SQL query to fetch booking history along with room name
// $sql = "SELECT bh.id, r.room_name, bh.start_date, bh.end_date
//         FROM booking_history bh
//         JOIN hotel_rooms r ON bh.room_id = r.id";  // Join with the hotel_rooms table to get the room name
        
$sql = "SELECT * FROM hotel_rooms ";  // Join with the hotel_rooms table to get the room name

$result = $conn->query($sql);

$bookings = [];
if ($result->num_rows > 0) {
    // Fetch all rows as an associative array
    while ($row = $result->fetch_assoc()) {
        $bookings[] = $row;
    }
}

// Set the header for JSON response
header('Content-Type: application/json');

// Output the data as JSON
echo json_encode($bookings);

// Close the connection
$conn->close();
?>
