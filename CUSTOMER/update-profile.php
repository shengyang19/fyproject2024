<?php
$email=$_COOKIE["email"];
//Process Input
$id=$_POST['custID'];
$name=$_POST['custName'];
$phone=$_POST['custPhone'];
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