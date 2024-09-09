<?php
$cookie_name = "user";
$email1 = $_POST['loginemail'];
$email=strval($email1);
$key = $_POST['loginkey'];

$con = mysqli_connect('localhost','root','','phmsdb');
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$sql="SELECT username,phone,email,cred FROM account WHERE email='$email' AND cred='$key'";
$row = mysqli_fetch_array(mysqli_query($con,$sql));
if($row!=null){
    setcookie($cookie_name, $row['username'], time() + (86400 * 30), "/"); // 86400 = 1 day
    setcookie("phone", $row['phone'], time() + (86400 * 30), "/"); // 86400 = 1 day
    setcookie("email", $email, time() + (86400 * 30), "/"); // 86400 = 1 day
    header("Location: /fyproject2024/Palladium-Hotel/index.html");
    exit;
}
mysqli_close($con);
header("Location: /fyproject2024/Palladium-Hotel/login-form-15/login-form-15/LoginV2.html");
exit;
?>