<?php
session_start();
// Ensure proper headers for JSON response
header('Content-Type: application/json');

// Read the incoming JSON data from POST
$data = json_decode(file_get_contents("php://input"), true);

// Validate the data (e.g., check that 'id' and 'new_value' are set)
if (isset($data['id']) && isset($data['checkin']) && isset($data['checkout'])) {
    $id = (int)$data['id'];           // ID of the row to update
    $checkin = htmlspecialchars($data['new_value']); // Sanitize the new value
    $checkout = htmlspecialchars($data['new_value']); // Sanitize the new value

    $_SESSION['id']=$id;
    $_SESSION['checkin']=$id;
    $_SESSION['checkout']=$id;
?>
