<?php
// update.php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phmsdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['message' => 'Connection failed: ' . $conn->connect_error]));
}

$tablename = $_POST['tablename'];
$id = $_POST['id'];
$username = $_POST['username'];
$phone = $_POST['phone'];

if($tablename=="customer_account"){
    $birthday = $_POST['birthday'];
    $membership = $_POST['membership'];
    $sql = "UPDATE customer_account SET username=?, phone=?, birthday=?, membership=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $username, $phone, $birthday, $membership, $id);
}
else if($tablename=="staff_account"){
    $role = $_POST['role'];
    $sql = "UPDATE staff_account SET username=?, phone=?, role=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $username, $phone, $role, $id);
}

if ($stmt->execute()) {
    echo json_encode(['message' => 'Update successful']);
} else {
    echo json_encode(['message' => 'Update failed: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
