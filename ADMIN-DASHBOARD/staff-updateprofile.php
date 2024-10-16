<?php
session_start();
$user=$_SESSION["user"];
//Process Input
$name=$_POST["nameInput"];
$phone=$_POST['phoneInput'];
//update database
$con = mysqli_connect('localhost','root','','phmsdb');
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$sql="SELECT email,staff_id,role FROM staff_account WHERE staff_id='$user'";
$row = mysqli_fetch_array(mysqli_query($con,$sql));
if($row!=null){
    $sql="UPDATE staff_account SET username='$name',phone='$phone' WHERE staff_id='$user'";
    $data = [
		"staff_id" => $row['staff_id'],
		"username" => $name,
		"email" => $row['email'],
		"phone" => $phone,
		"role" => $row['role']
	];
	
	$_SESSION['info']=json_encode($data);
	// $file = 'data.json';
	
	// Convert PHP array to JSON and save it to a file
	// file_put_contents($file, json_encode($data));
    // echo "hi";
}
$qry = mysqli_query($con,$sql);
mysqli_close($con);
// echo $sql; // to display sql
if(!$qry){
    //return false; // error new user record was not added
    }
else{}
header("Location: profile.html");
exit;
?>