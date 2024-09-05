<?php
//CREATE NEW USER
$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$phone=$_POST['phone'];
$mail=$_POST['signupemail'];
$cred=$_POST['signupkey'];
//update database
$con = mysqli_connect('localhost','root','','phmsdb');
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$sql="INSERT INTO account(firstname, phone, email, cred)VALUES ('$firstname', '$lastname', '$phone', '$mail', '$cred')";
$qry = mysqli_query($con,$sql);
mysqli_close($con);
// echo $sql; // to display sql
if(!$qry){
    return false; // error new user record was not added
    header("Location: /fyproject2024/Palladium-Hotel/login-form-15/login-form-15/SignUpV2.html");
}
else{
    header("Location: /fyproject2024/Palladium-Hotel/login-form-15/login-form-15/LoginV2.html");
}
exit;
?>