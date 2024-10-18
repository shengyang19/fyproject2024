<!doctype html>
<html lang="en">
    
<?php
session_start();
$email="";
if(isset($_POST["confirm"])){
    $debugmail=false;
    
    $password=$_POST['pass'];
    $repassword=$_POST['repass'];
    $email1=$_POST['email'];
    $email=strval($email1);
    if($password!=$repassword){
        setcookie("error","difpassword", time() + (10 * 30), "/");
        //echo("<script>alert('password not matches')</script>");
    }
    else{
        $con=mysqli_connect('localhost','root','','phmsdb');
        if(!$con) echo ("failed to connect to database");
    
        if(strlen($password)<6){
            setcookie("error","passlength", time() + (10 * 30), "/");
            //echo("<script>alert('password length must be atleast 8')</script>");
        }
        
        else{
            $sql = "SELECT email FROM staff_account WHERE email='$email'";
            $row = mysqli_fetch_array(mysqli_query($con,$sql));
            // Checking if user already exist
            if($row!=null){
				$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                $sql="UPDATE staff_account SET cred='$password', pass='$hashedPassword' WHERE email='$email'";
                $qry = mysqli_query($con,$sql);
                mysqli_close($con);
                header("Location: staff-login.php");
                exit();
            }
            mysqli_close($con);
            setcookie("error","default", time() + (30 * 30), "/");
            $email="";
        }
    }
}
?>

  <head>
  	<title>Forgot - Palladium Hotel</title>
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
					<h2 class="heading-section">Forgot the password ? don't worry we can help you..</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="wrap">
						<div class="img" style="background-image: url(images/bg-1.png);"></div>
						<div class="login-wrap p-4 p-md-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4">Forgot Password</h3>
			      		</div>
			      	</div>
                      <form action="staff-forgotpass.php" class="signin-form" method="POST">
					  <div class="form-group">
						<input type="email" name="email" id="email" value="<?php echo $email;?>" class="form-control" required>
						<label class="form-control-placeholder" for="email">Email</label>
						<span id="email-error" style="color: red;"></span>
					  </div>
		            <div class="form-group">
		              <input id="password-field" name="pass" type="password" class="form-control" required>
		              <label class="form-control-placeholder" for="password">Password</label>
		              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
		            </div>
					<div class="form-group">
						<input id="repeat-password-field" name="repass" type="password" class="form-control" required>
						<label class="form-control-placeholder" for="repeat-password">Confrim Password</label>
						<span toggle="#repeat-password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
					  </div>
		            <div class="form-group">
		            	<button name="confirm" type="submit" class="form-control btn btn-primary rounded submit px-3">Confirm</button>
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
									<p>Account not exist.</p>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
									<!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
								</div>
							</div>
						</div>
					</div>
		          <p class="text-center">Already a member? <a href="staff-login.php">Sign In</a></p>
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

