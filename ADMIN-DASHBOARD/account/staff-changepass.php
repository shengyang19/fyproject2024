<!doctype html>
<html lang="en">
    
<?php
session_start();
if(isset($_POST["confirm"])){
$user=$_SESSION["user"];
$newpass=$_POST["newpass"];
$newpassrepeat=$_POST["newpassrepeat"];

if(strlen($newpass)>5){
if($newpass==$newpassrepeat){
	// $newpass = json_encode($newpass);
	$hashedPassword = password_hash($newpass, PASSWORD_BCRYPT);
	$con = mysqli_connect('localhost', 'u838201253_palladium', 'Azib277221', 'u838201253_phmsdb');
	if (mysqli_connect_errno())
	{	echo "Failed to connect to MySQL: " . mysqli_connect_error();	}
	$sql="UPDATE staff_account SET pass='$hashedPassword' WHERE id='$user'";
	$qry = mysqli_query($con,$sql);
	mysqli_close($con);
	if(!$qry){
		setcookie("error","changepassfail", time() + (30 * 30), "/");
	}
	else{
		header("Location: ../index.html");
		exit;
	}
} else {setcookie("error","difpassword", time() + (30 * 30), "/");}
} else {setcookie("error","passlength", time() + (30 * 30), "/");}
}

?>

<head>
  	<title>Change Password - Palladium Hotel</title>
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
					<h2 class="heading-section">Palladium Hotel Management System</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="wrap">
						<div class="img" style="background-image: url(images/bg-1.png);"></div>
						<div class="login-wrap p-4 p-md-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4">Change Password</h3>
			      		</div>
					</div>
					<form action="staff-changepass.php" class="signin-form" method="POST">
		            <div class="form-group">
		              <input id="password-field" name="newpass" type="password" class="form-control" required>
		              <label class="form-control-placeholder" for="password">New Password</label>
		              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
		            </div>
					<div class="form-group">
						<input id="repeat-password-field" name="newpassrepeat" type="password" class="form-control" required>
						<label class="form-control-placeholder" for="repeat-password">Confirm Password</label>
						<span toggle="#repeat-password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
					  </div>
		            <div class="form-group">
		            	<button name="confirm" type="submit" class="form-control btn btn-primary rounded submit px-3">Confirm</button>
		            </div>
		            <div class="form-group">
		            	<a href=".." class="form-control btn btn-secondary rounded submit px-3">Cancel</a>
		            </div>
		          </form>
				  <div class="modal fade my-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-sm">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Error</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<p>Current password is incorrect.</p>
									<p>Please enter correct password.</p>
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

