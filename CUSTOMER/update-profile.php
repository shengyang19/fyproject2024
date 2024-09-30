<?php
$email=$_COOKIE["email"];
//Process Input
$name=$_POST["custNAME"];
$phone=$_POST['custPHONE'];
// echo $name;
//update database
$con = mysqli_connect('localhost','root','','phmsdb');
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$sql="SELECT email FROM account WHERE email='$email'";
$row = mysqli_fetch_array(mysqli_query($con,$sql));
if($row!=null){
    $sql="UPDATE account SET username='$name',phone='$phone' WHERE email='$email'";
    $data = [
		"name" => $name,
		"phone" => $phone,
		"email" => $email
	];
	
	$file = 'js/data.json';
	
	// Convert PHP array to JSON and save it to a file
	file_put_contents($file, json_encode($data));
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