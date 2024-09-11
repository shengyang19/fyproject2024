<?php
// Define the path to the JSON file
$file = 'data.json';

// Read the file contents
$jsonData = file_get_contents($file);

// Set the correct content-type header for JSON output
header('Content-Type: application/json');

// Output the JSON data
echo $jsonData;
?>
