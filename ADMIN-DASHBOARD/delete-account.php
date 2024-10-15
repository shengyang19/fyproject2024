<?php
// Database connection parameters
$host = 'localhost';
$db = 'phmsdb';
$user = 'root'; // Change if your username is different
$pass = '';     // Change if your password is different

// Create a new PDO instance
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

// Handle the delete action
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $tablename = $_GET['tablename'];
    $dbtable = $tablename."_account";
    if($tablename=="customer")
        $stmt = $pdo->prepare("DELETE FROM customer_account WHERE id = ?");
    else
        $stmt = $pdo->prepare("DELETE FROM staff_account WHERE id = ?");
    $stmt->execute();
    header("Location: hotel$tablename.html"); // Redirect to avoid resubmission
    exit;
}
?>