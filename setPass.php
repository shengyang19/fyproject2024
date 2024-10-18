<?php
if(isset($_GET['tablename'])){
    $tablename=$_GET['tablename'];
    $con = mysqli_connect('localhost','root','','phmsdb');
    if (mysqli_connect_errno()){echo "Failed to connect to MySQL: " . mysqli_connect_error();}
    
    $sql="SELECT cred FROM $tablename";
    $result = $con->query($sql);
    while ($row = $result->fetch_column()) {
        $hashedPassword = password_hash($row, PASSWORD_BCRYPT);
        if ($hashedPassword) {
            $sql="UPDATE $tablename SET pass='$hashedPassword' WHERE cred='$row'";
            $qry = $con->query($sql);
        } else {
            echo "Error hashing password.";
        }
    }
    mysqli_close($con);
    echo $tablename;
}
else echo  "Error: No table name provided.";

?>