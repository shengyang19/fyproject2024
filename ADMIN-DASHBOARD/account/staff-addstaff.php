<!DOCTYPE html>
<html lang="en">

<?php
session_start();

$username="";
$phone="";
$email="";
if(isset($_POST["confirm"])){
    $role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING);
    $username=$_POST['username'];
    $phone=$_POST['phone'];
    $password=$_POST['password'];
    $email1=$_POST['signupemail'];
    $email=strval($email1);
    if(strlen($password)>5){
        $con=mysqli_connect('localhost', 'u838201253_palladium', 'Azib277221', 'u838201253_phmsdb');
    
        if(!$con)
            echo ("failed to connect to database");
        $sql = "SELECT email FROM staff_account WHERE email='$email'";
        $row = mysqli_fetch_array(mysqli_query($con,$sql));
        if($row!=null){
            setcookie("error","default", time() + (60 * 30), "/");
        }
        else{
            if($row["email"]==$email){    
                setcookie("error","default", time() + (30 * 30), "/");
            }
            else{
                $hashedPassword = password_hash($newpass, PASSWORD_BCRYPT);
                $sql="INSERT INTO staff_account(role, username, phone, email, pass)VALUES ('$role', '$username', '$phone', '$email', '$hashedPassword')";
                $qry = mysqli_query($con,$sql);
                mysqli_close($con);
                header("Location: ../hotelstaff.html");
                exit;
            }
        }
        mysqli_close($con);
    }
    else {  setcookie("error","passlength", time() + (60 * 30), "/");}
}
?>

<head>
  	<title>Sign Up - Palladium Hotel</title>
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
                                    <h3 class="mb-4">New Staff</h3>
                                </div>
                            </div>
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" onsubmit="return validateForm()" method="POST" class="signin-form">
                                <div class="form-group mt-3">
                                    <select name="role" id="staffrole" class="form-control" required>
                                        <option value="admin">Admin</option>
                                        <option value="staff" selected>Staff</option>
                                    </select>
                                    <label class="form-control-placeholder" for="staffrole">Role</label>
                                </div>
                                <div class="form-group mt-3">
                                    <input type="text" name="username" value="<?php echo $username;?>" class="form-control" required>
                                    <label class="form-control-placeholder" for="username">Name</label>
                                </div>
                                <div class="form-group mt-3">
                                    <input type="text" name="phone" value="<?php echo $phone;?>" id="phone" class="form-control" required>
                                    <label class="form-control-placeholder" for="phonenum">Phone Number</label>
                                    <span id="phone-error" style="color: red;"></span>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="signupemail" value="<?php echo $email;?>" id="email" class="form-control" required>
                                    <label class="form-control-placeholder" for="email">Email</label>
                                    <span id="email-error" style="color: red;"></span>
                                </div>
                                <div class="form-group">
                                    <input id="password-field" name="password" type="password" class="form-control" required>
                                    <label class="form-control-placeholder" for="password">Password</label>
                                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div>
                                <!-- <div class="form-group">
                                    <input id="repeat-password-field" name="signuprekey" type="password" class="form-control" required>
                                    <label class="form-control-placeholder" for="repeat-password">Confirm Password</label>
                                    <span toggle="#repeat-password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div> -->
                                <div class="form-group">
                                    <button name="confirm" type="submit" class="form-control btn btn-primary rounded submit px-3">Confirm</button>
                                </div>
                                <div class="form-group">
                                    <a href="../hotelstaff.html" name="cancel" class="form-control btn btn-danger submit rounded px-3">Cancel</a>
                                </div>
                            </form>
		                    <!-- <p class="text-center">Already a member? <a data-toggle="tab" href="cust-login.php" onclick="event.preventDefault(); window.location.href='cust-login.php';">Sign In</a></p> -->
                            <!-- <p class="text-center">Continue as guest: <a href="..">Home</a></p> -->
                            <div class="modal fade my-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Sign Up Error</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Email already used.</p>
                                            <p>Please use another email.</p>
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
    <script>
        $("#login-button").click(function () {
            window.location.replace("index.php");
        });
    </script>
</body>

</html>
