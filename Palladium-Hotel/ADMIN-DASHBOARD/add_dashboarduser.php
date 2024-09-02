<?php
//CREATE NEW USER
$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$mail=$_POST['signupemail'];
$cred=$_POST['signupkey'];
//update database
$con = mysqli_connect('localhost','root','','phmsdb');
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
if ($mail != ""){
    $sql="INSERT INTO dashboard_user(firstname, lastname, email, cred)VALUES ('$firstname', '$lastname', '$mail', '$cred')";
    $qry = mysqli_query($con,$sql);
    mysqli_close($con);
    // echo $sql; // to display sql
    if(!$qry){
        return false; // error new user record was not added
    }
    else{
        header("Location: index.html");
        exit;
    }
}
header("Location: register.html");
exit;
?>