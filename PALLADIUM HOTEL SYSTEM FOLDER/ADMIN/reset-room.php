<?php
// Database connection parameters
$host = 'localhost';
$db = 'u838201253_phmsdb';
$user = 'u838201253_palladium'; // Change if your username is different
$pass = 'Azib277221';     // Change if your password is different

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
    
    try {
        // Prepare and execute the deletion query
        $stmt = $pdo->prepare("UPDATE hotel_rooms SET guest_id=null,guest_name=null,start_date=null,end_date=null WHERE id=?");
        // $stmt = $pdo->prepare("DELETE FROM {$dbtable} WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);  // Bind the ID parameter to prevent SQL injection
        $stmt->execute();
        
        // Check if any row was affected (deleted)
        if ($stmt->rowCount() > 0) {
            header("Location: bookinglist.html"); // Redirect to avoid resubmission
            exit;
        } else {
            // If no rows were deleted, handle the case
            echo "No record found with ID {$id}.";
        }
    } catch (PDOException $e) {
        // Handle any errors during deletion
        echo "Error deleting record: " . $e->getMessage();
    }
}
?>
