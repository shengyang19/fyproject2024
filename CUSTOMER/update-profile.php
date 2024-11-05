<?php
$email=$_COOKIE["email"];
//Process Input
$name=$_POST["custNAME"];
$phone=$_POST['custPHONE'];
$birthday=$_POST['birthday'];
if(isset($_POST['cancel'])){
	header("Location: profile.html");
	exit;
}

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
    setcookie("user", $name, time() + (86400 * 30 * 30), "/"); // 86400 = 1 day
    setcookie("phone", $phone, time() + (86400 * 30 * 30), "/"); // 86400 = 1 day
    setcookie("birthday", $birthday, time() + (86400 * 30 * 30), "/"); // 86400 = 1 day
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