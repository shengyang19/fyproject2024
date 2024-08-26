<?php
$cookie_name = "user";
$email = $_POST['loginemail'];
$key = $_POST['loginkey'];

$con = mysqli_connect('localhost','root','','phmsdb');
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$sql="SELECT firstname,email,cred FROM account WHERE email='$email' AND cred='$key'";
$row = mysqli_fetch_array(mysqli_query($con,$sql));
if($row!=null){
    setcookie($cookie_name, $row['firstname'], time() + (86400 * 30), "/"); // 86400 = 1 day
    header("Location: /fyproject2024/Palladium-Hotel/index.html");
}
mysqli_close($con);
exit;
?>