<?php
//Process Input
$message=$_POST['message'];
$name=$_POST['name'];
$email=$_POST['email'];
$subject=$_POST['subject'];
$date=date('Y-m-d');
//update database
$con = mysqli_connect('localhost','root','','phmsdb');
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$sql="INSERT INTO feedback(date,message,name,email,subject)VALUES ('$date','$message','$name','$email',$subject')";
$qry = mysqli_query($con,$sql);
mysqli_close($con);
// echo $sql; // to display sql
if(!$qry){
    //return false; // error new user record was not added
    //header("Location: /fyproject2024/Palladium-Hotel/login-form-15/login-form-15/SignUpV2.html");
}
else{
    //header("Location: /fyproject2024/Palladium-Hotel/login-form-15/login-form-15/LoginV2.html");
}
header("Location: contact.html");
exit;
?>