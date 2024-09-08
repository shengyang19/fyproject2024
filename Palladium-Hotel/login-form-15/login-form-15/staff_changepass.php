<!doctype html>
<html lang="en">
    
<?php
if(isset($_POST["confirm"])){
//session_start();
$email=$_COOKIE["email"];
$savedpass="-";
$oldpass=$_POST["oldpass"];
$newpass=$_POST["newpass"];
$newpassrepeat=$_POST["newpassrepeat"];
if($newpass==$newpassrepeat){
    $cred=json_encode($newpass);
    //echo ("corect repeat password");
    $con = mysqli_connect('localhost','root','','phmsdb');
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    $sql="SELECT email,cred FROM staff_account WHERE email='$email'";
    $row = mysqli_fetch_array(mysqli_query($con,$sql));
    if($row!=null){
        $savedpass=$row['cred'];
    }
    else{
        echo ("<script>alert('$email')</script>");
    }
    if($savedpass==$oldpass){
    $sql="UPDATE account SET cred='$cred' WHERE email='$email'";
    $qry = mysqli_query($con,$sql);
    mysqli_close($con);
    // echo $sql; // to display sql
    if(!$qry){
        //return false; // error new user record was not added
        //header("Location: register.php");
    }
    else{
        echo ("<script>alert('Password changed')</script>");
        header("Location: /fyproject2024/Palladium-Hotel/ADMIN-DASHBOARD/index.html");
        exit;
    }

} else echo ("<script>alert('Incorrect current password')</script>");
}
else echo ("<script>alert('incorect repeat password')</script>");
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
	<body style="background-image: url('images/background.png'); background-size: cover; background-color: #000;">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<div class="logo-img">
						<a href="LoginV2.html">
							<img src="images/logo.png" alt="" width="100" height="100">
						</a>
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
			      			<h3 class="mb-4">Change Password</h3>
			      		</div>
					</div>
					<form action="staff_changepass.php" class="signin-form" method="POST">
						<div class="form-group">
                            <input id="current-password-field" name="oldpass" type="password" class="form-control" required>
							<label class="form-control-placeholder" for="password">Current Password</label>
							<span toggle="#current-password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
						</div>
		            <div class="form-group">
		              <input id="password-field" name="newpass" type="password" class="form-control" required>
		              <label class="form-control-placeholder" for="password">New Password</label>
		              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
		            </div>
					<div class="form-group">
						<input id="repeat-password-field" name="newpassrepeat" type="password" class="form-control" required>
						<label class="form-control-placeholder" for="repeat-password">Repeat Password</label>
						<span toggle="#repeat-password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
					  </div>
		            <div class="form-group">
		            	<button name="confirm" type="submit" class="form-control btn btn-primary rounded submit px-3">Confirm</button>
		            </div>
		          </form>
		          <div class="form-group">
					  <a class="btn btn-secondary" href="/fyproject2024/Palladium-Hotel/ADMIN-DASHBOARD/index.html">Cancel</a></p>
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

