<!doctype html>
<html lang="en">
<?php
if(isset($_POST["signin"])){
session_start();
$cookie_name = "user";
$email1 = $_POST['loginemail'];
$email=strval($email1);
$key1 = $_POST['loginkey'];
$key=JSON.stringify($key1);

$con = mysqli_connect('localhost','root','','phmsdb');
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$sql="SELECT username,email,cred FROM staff_account WHERE email='$email' AND cred='$key'";
$row = mysqli_fetch_array(mysqli_query($con,$sql));
if($row!=null){
    $_COOKIE["tempname"]=$row['username'];
    $_COOKIE["tempmail"]=$row['email'];

	//echo ("alert('success')");
    /*setcookie($cookie_name, $row['username'], time() + (86400 * 30), "/"); // 86400 = 1 day
    setcookie("phone", $row['phone'], time() + (86400 * 30), "/"); // 86400 = 1 day
    setcookie("email", $email, time() + (86400 * 30), "/"); // 86400 = 1 day*/
    header("Location: /fyproject2024/Palladium-Hotel/ADMIN-DASHBOARD/index.html");
	exit;
}
}


?>
  <head>
  	<title>Login - Palladium Hotel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">

	</head>
	<body style="background-image: url('images/background.png'); background-size: cover; background-color: #000;">
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
			      			<h3 class="mb-4">Sign In</h3>
			      		</div>
			      	</div>
							<form action="stafflogin.php"  method="POST" class="signin-form">
								<div class="form-group">
									<input type="email" name="loginemail" id="email" class="form-control" required>
									<label class="form-control-placeholder" for="email">Email</label>
									<span id="email-error" style="color: red;"></span>
								  </div>
		            <div class="form-group">
		              <input id="password-field" name="loginkey" type="password" class="form-control" required>
		              <label class="form-control-placeholder" for="password">Password</label>
		              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
		            </div>
		            <div class="form-group">
		            	<button type="submit" name="signin" class="form-control btn btn-primary rounded submit px-3">Sign In</button>
		            </div>
		            <div class="form-group d-md-flex">
									<div class="w-50  text-center">
										<a href="staff_forgotpass.php" onclick="event.preventDefault(); window.location.href='staff_forgotpass.php';">Forgot Password</a>
									</div>
		            </div>
		          </form>
				  <!-- <p class="text-center">Not a member? <a data-toggle="tab" href="SignUpV2.html" onclick="event.preventDefault(); window.location.href='SignUpV2.html';">Sign Up</a></p> -->
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

