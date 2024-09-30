<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phmsdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch data
$sql = "SELECT username, role FROM staff_account";
$result = $conn->query($sql);

// Close connection
$conn->close();

$data = [];
if ($result->num_rows > 0) {

    // Loop through each row in the result set
    while ($row = $result->fetch_assoc()) {
        // Append each row's data to the array
        $data[] = [
            "name" => $row['username'],
            "role" => $row['role']
        ];
    }
	
}
file_put_contents('staffs.json', json_encode($data));

header("Location: hotelstaff.html");
exit;
?>
