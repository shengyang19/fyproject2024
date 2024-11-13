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

// Debugging: Check if cookies are set
var_dump($_COOKIE['user_id'], $_COOKIE['user'], $_COOKIE['room_id']);
$booking = json_decode($_COOKIE['booking'], true);
var_dump($booking);  // Check if booking cookie is valid

// Get cookie values
$user_id = $_COOKIE['user_id'];
$room_id = $_COOKIE['room_id'];
$ci = $booking['checkin'];
$co = $booking['checkout'];

// Use prepared statement for inserting data
$sql_insert = "INSERT INTO booking_history (guest_id, room_id, start_date, end_date) VALUES (?, ?, ?, ?)";
$stmt_insert = $conn->prepare($sql_insert);
if ($stmt_insert === false) {
    die('Error preparing the insert query: ' . $conn->error);
}

// Bind parameters to the query
$stmt_insert->bind_param("iiss", $user_id, $room_id, $ci, $co);

// Execute the query
if ($stmt_insert->execute()) {
    echo "New record created successfully";
} else {
    echo "Error inserting record: " . $stmt_insert->error;
}

// Close the prepared statement
$stmt_insert->close();

// SQL query to update data
$sql_update = "UPDATE hotel_rooms 
               SET guest_id = ?, guest_name = ?, start_date = ?, end_date = ? 
               WHERE id = ?";
$stmt_update = $conn->prepare($sql_update);
if ($stmt_update === false) {
    die('Error preparing the update query: ' . $conn->error);
}

// Bind parameters to the query
$stmt_update->bind_param("isssi", $user_id, $_COOKIE['user'], $ci, $co, $room_id);

// Execute the query
if ($stmt_update->execute()) {
    echo "Record updated successfully.";
} else {
    echo "Error updating record: " . $stmt_update->error;
}

// Close the prepared statement
$stmt_update->close();

// Close connection
$conn->close();
header("Location: rooms.html");
exit;
?>
