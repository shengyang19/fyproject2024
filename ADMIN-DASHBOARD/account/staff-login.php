<!doctype html>
<html lang="en">
	
<?php
if(isset($_POST["signin"])){
session_start();
//$cookie_name = "user";
$email1 = $_POST['loginemail'];
$email=strval($email1);
$key1 = $_POST['loginkey'];
$key=json_encode($key1);

$con = mysqli_connect('localhost','root','','phmsdb');
if (mysqli_connect_errno()){echo "Failed to connect to MySQL: " . mysqli_connect_error();}

$sql="SELECT id,username,email,role,phone FROM staff_account WHERE email='$email' AND cred='$key'";
$row = mysqli_fetch_array(mysqli_query($con,$sql));
mysqli_close($con);
if($row!=null){
	$_SESSION["user"]=$row['id']; // for role & edit profile

	//* Store user data in JSON file * // for view profile
	$data = [
		"id" => $row['id'],
		"username" => $row['username'],
		"email" => $row['email'],
		"phone" => $row['phone'],
		"role" => $row['role']
	];
	// file_put_contents('../data.json', json_encode($data));
	$_SESSION['info']=json_encode($data);
    header("Location: ../index.html");
	exit;
}
else{
	setcookie("error","default", time() + (30 * 30), "/");
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
			      			<h3 class="mb-4">Sign In</h3>
			      		</div>
			      	</div>
							<form action="staff-login.php" onsubmit="return validateForm()"  method="POST" class="signin-form">
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
										<a href="staff-forgotpass.php" onclick="event.preventDefault(); window.location.href='staff-forgotpass.php';">Forgot Password</a>
									</div>
		            </div>
		          </form>
					<div class="modal fade my-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-sm">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Sign In Error</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<p>Your email or password is incorrect.</p>
									<p>Please try again.</p>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
									<!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
								</div>
							</div>
						</div>
					</div>
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

