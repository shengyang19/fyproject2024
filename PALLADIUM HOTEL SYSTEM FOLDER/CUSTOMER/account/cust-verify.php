<!doctype html>
<html lang="en">
<?php 
session_start();

if(isset($_POST["verify"])){
//$_SESSION["OTP"]="123456";
$otp_entered=$_POST["verification"];
if($otp_entered==$_SESSION["OTP"]){
//if(isset($_SESSION["OTP"])){
    $username=$_SESSION["username"];
    $phone=$_SESSION["Phone"];
    $mail=$_SESSION["Email"];
    $pass=$_SESSION["Password"];

    $con = mysqli_connect('localhost', 'u838201253_palladium', 'Azib277221', 'u838201253_phmsdb');
    if (mysqli_connect_errno())
    {    echo "Failed to connect to MySQL: " . mysqli_connect_error();    }
    $sql="INSERT INTO customer_account(username, phone, email, pass)VALUES ('$username', '$phone', '$mail', '$pass')";
    $qry = mysqli_query($con,$sql);
    mysqli_close($con);
    // echo $sql; // to display sql
    if(!$qry){
        //return false; // error new user record was not added
        setcookie("error","insertfail", time() + (30 * 30), "/");
        header("Location: cust-register.php");
        exit;
    }
    else{
        header("Location: cust-login.php");
        exit;
    }
}
setcookie("error","default", time() + (30 * 30), "/");
}
?>

<head>
<title>Verify Email - Palladium Hotel</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="css/style.css">

</head>
<body onload="displayModal()" style="background-image: url('images/background.png'); background-size: cover; background-color: #000;">
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <div class="logo-img">
                    <img src="images/logo.png" alt="" width="100" height="100">
                </div>
                <h2 class="heading-section">Welcome to Palladium Hotel</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                <div class="wrap">
                    <div class="img" style="background-image: url(images/bg-1.png);"></div>
                    <div class="login-wrap p-4 p-md-5">
                <div class="d-flex">
                    <div class="w-100">
                        <h2 class="mb-4">Verify email address</h2>
                        <p>We've sent a code to verify your email.</p>
                    </div>
                </div>
            <form action="cust-verify.php" class="signin-form" method="POST">
                    <div class="form-group">
                        <label class="form-label" for="verification">Code</label>
                        <input name="verification" type="text" class="form-control" required>
                </div>
                <div class="form-group">
                    <button type="submit" name="verify" class="form-control btn btn-primary rounded submit px-3">Verify</button>
                </div>
                </form>
                <div class="modal fade my-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-sm">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Verification Error</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<p>Incorrect code.</p>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
									<!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
								</div>
							</div>
						</div>
					</div>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>

<script src="js/jquery.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>

</body>
</html>

