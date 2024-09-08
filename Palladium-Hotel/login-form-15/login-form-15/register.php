<!DOCTYPE html>
<html lang="en">

<?php
    session_start();

    /*$username="sign up";
    $login_btn="Login";
    if(isset($_SESSION["username"])){
        $username=$_SESSION["username"];
        $login_btn="Logout";
    }*/
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $con=mysqli_connect('localhost',
            'root',
            '','phmsdb');

        if(!$con)
            echo ("failed to connect to database");
        $username=$_POST['username'];

        //$prefix="_";
        //$username=$prefix.$username1;
        $phone=$_POST['phone'];
        $password=$_POST['signupkey'];
        $repassword=$_POST['signuprekey'];
        $email1=$_POST['signupemail'];
        $email=strval($email1);
        if($password!=$repassword){
            echo("<script>alert('password not matches')</script>");
        }
        else{
            if(strlen($password)<3){
                echo("<script>alert('password length must be atleast 8')</script>");
            }
            else{
                //$query="insert into 1_user(username,email,password)values('$username','$email','$password')";

                $sql = "SELECT email,username, cred FROM account";
                $result = $con->query($sql);
                $username_already_exist=false;
                $email_already_exist=false;

                // Checking if user already exist
                if(($result->num_rows)> 0){
                    while($row = $result->fetch_assoc()) {

                        //echo "<br> id: " . $row["customer_id"] . " - username= " . $row["username"] . " password= " . $row["cred"] . "<br>";

                        /*if($row["username"]==$username){    
                            $username_already_exist=true;
                            break;
                        }*/
                        if($row["email"]==$email){    
                            $email_already_exist=true;
                            break;
                        }
                    }
                }

                // echo($ok);
                if($username_already_exist==false){

                    // This is my hosting mail
                    $from ="sawax45227@janfab.com";
                    $to=$email;
                    $subject="verify-account-otp";

                    // Generating otp with php rand variable
                    $otp=rand(100000,999999);
                    $message=strval($otp);
                    $headers="From:" .$from;
                    if(mail($to,$subject,$message,$headers)){
                        $_SESSION["username"]=$username;
                        $_SESSION["OTP"]=$otp;
                        $_SESSION["Email"]=$email;
                        $_SESSION["Password"]=$password;
                        $_SESSION["registration-going-on"]="1";
                        header("Location:VerifyEmail.html");
                    }
                    else 
                        echo("mail send failed");
                }
                else{
                    echo("<script>alert('username  already taken')</script>");
                }
            }
        }
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

	<body style="background-image: url('images/background.png'); background-size: cover; background-color: #000;">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<div class="logo-img">
						<a href="/fyproject2024/Palladium-Hotel/index.html">
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
			      			<h3 class="mb-4">Sign Up</h3>
			      		</div>
			      	</div>
					  		<form action="register.php" method="POST" class="signin-form">
						<div class="form-group mt-3">
							<input type="text" name="username" class="form-control" required>
							<label class="form-control-placeholder" for="username">Name</label>
						</div>
							<div class="form-group mt-3">
								<input type="int" name="phone" class="form-control" required>
								<label class="form-control-placeholder" for="phonenum">Phone Number</label>
							</div>
							<div class="form-group">
								<input type="email" name="signupemail" id="email" class="form-control" required>
								<label class="form-control-placeholder" for="email">Email</label>
								<span id="email-error" style="color: red;"></span>
							  </div>
		            <div class="form-group">
		              <input id="password-field" name="signupkey" type="password" class="form-control" required>
		              <label class="form-control-placeholder" for="password">Password</label>
		              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
		            </div>
					<div class="form-group">
						<input id="repeat-password-field" name="signuprekey" type="password" class="form-control" required>
						<label class="form-control-placeholder" for="repeat-password">Repeat Password</label>
						<span toggle="#repeat-password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
					  </div>
		            <div class="button-container">
		            	<button type="submit" class="btn btn-primary">
							Sign Up
						  </button>
		            </div>
		          </form>
		          <p class="text-center">Already a member? <a data-toggle="tab" href="LoginV2.html" onclick="event.preventDefault(); window.location.href='LoginV2.html';">Sign In</a></p>
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
