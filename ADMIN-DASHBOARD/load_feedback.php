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
$sql = "SELECT date, message, name, email, subject FROM feedback";
$result = $conn->query($sql);
$conn->close();
// Close connection

$data = [];
if ($result->num_rows > 0) {
    // Start the HTML table

    // Loop through each row in the result set
    while ($row = $result->fetch_assoc()) {
        // Append each row's data to the array
        $data[] = [
            "subject" => $row['subject'],
            "message" => $row['message'],
            "name" => $row['name'],
            "date" => $row['date'],
            "email" => $row['email']
        ];
    }
	
}
file_put_contents('feedback.json', json_encode($data));
// Convert PHP array to JSON and save it to a file
// $json_data = json_encode($data, JSON_PRETTY_PRINT);
// file_put_contents('feedback.json', json_encode($json_data));

header("Location: feedback.html");
exit;
?>
