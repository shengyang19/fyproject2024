<?php
header('Content-Type: application/json');

// Database connection parameters
$host = 'localhost';
$dbname = 'phmsdb';
$user = 'root';
$pass = '';

// Create a connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(['error' => 'Connection failed: ' . $conn->connect_error]);
    exit;
}

// Get the filename parameter
$tablename = isset($_GET['tablename']) ? $_GET['tablename'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';

// Prepare the SQL statement based on the filename
// Ensure to sanitize and validate the table name to prevent SQL injection
$validTables = ['customer_account', 'staff_account','feedback']; // Example valid tables
if (!in_array($tablename, $validTables)) {
    echo json_encode(['error' => 'Invalid table name']);
    exit;
}
$stmt = $conn->prepare("SELECT * FROM $tablename"); // Select all columns from the specified table
if($id!=""){
    $stmt = $conn->prepare("SELECT * FROM $tablename WHERE id=$id"); // Select column from the specified table
}
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Fetch all results
$data = $result->fetch_all(MYSQLI_ASSOC);

// Return the results as a JSON array
echo json_encode($data);

// Close the statement and connection
$stmt->close();
$conn->close();
?>
