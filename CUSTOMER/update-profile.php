<?php
$email=$_COOKIE["email"];
//Process Input
$name=$_POST["custNAME"];
$phone=$_POST['custPHONE'];
$birthday=$_POST['birthday'];
$membership=$_POST['custMEMBER'];
if(isset($_POST['cancel'])){
	header("Location: profile.html");
	exit;
}
// echo $name;
//update database
$con = mysqli_connect('localhost','root','','phmsdb');
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$sql="SELECT email FROM customer_account WHERE email='$email'";
$row = mysqli_fetch_array(mysqli_query($con,$sql));
if($row!=null){
    $sql="UPDATE customer_account SET username='$name',phone='$phone',birthday='$birthday' WHERE email='$email'";
    $data = [
		"name" => $name,
		"phone" => $phone,
		"birthday" => $birthday,
		"membership" => $membership,
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