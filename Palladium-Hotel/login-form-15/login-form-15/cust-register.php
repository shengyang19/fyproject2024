<!DOCTYPE html>
<html lang="en">

<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$username="";
$phone="";
$email="";
if(isset($_POST["confirm"])){
    $username=$_POST['username'];
    $phone=$_POST['phone'];
    $password=$_POST['signupkey'];
    $repassword=$_POST['signuprekey'];
    $email1=$_POST['signupemail'];
    $email=strval($email1);
    if(strlen($password)>5){
        if($password!=$repassword){
            setcookie("error","difpassword", time() + (30 * 30), "/");
            //echo("<script>alert('password not matches')</script>");
        }
        else{
            $con=mysqli_connect('localhost', 'root', '','phmsdb');
        
            if(!$con)
                echo ("failed to connect to database");
            $sql = "SELECT email,username, cred FROM account WHERE email='$email'";
            $result = $con->query($sql);
            mysqli_close($con);
            $email_already_exist=false;

            // Checking if user already exist
            if(($result->num_rows)> 0){
                while($row = $result->fetch_assoc()) {
                    if($row["email"]==$email){    
                        $email_already_exist=true;
                        setcookie("error","default", time() + (30 * 30), "/");
                        break;
                    }
                }
            }
            if($email_already_exist==false){
                //Send otp to entered email
                $otp=rand(100000,999999);
                
                require 'phpmailer/src/Exception.php';
                require 'phpmailer/src/PHPMailer.php';
                require 'phpmailer/src/SMTP.php';
                
                $mail = new PHPMailer(true);
                
                $mail->isSMTP();
                $mail->Host='smtp.gmail.com';
                $mail->SMTPAuth=true;
                $mail->Username='mypalladiumhotel@gmail.com';
                $mail->Password='jqabtnpxssakrlvw';
                $mail->SMTPSecure='ssl';
                $mail->Port=465;
                
                $mail->setFrom('mypalladiumhotel@gmail.com');
                $mail->addAddress($_POST['signupemail']);
                $mail->isHTML(true);
                $mail->Subject='Email verification code';
                $mail->Body=$otp;
                
                //$mail->send();
                if($mail->send()){
                    $_SESSION["username"]=$username;
                    $_SESSION["OTP"]=$otp;
                    $_SESSION["Phone"]=$phone;
                    $_SESSION["Email"]=$email;
                    $_SESSION["Password"]=$password;
                    $_SESSION["registration-going-on"]="1";
                    header("Location:cust-verify.php");
                    exit;
                }
                else echo("mail send failed");
            }
        }
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
                            <form action="cust-register.php" onsubmit="return validateForm()" method="POST" class="signin-form">
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
                                    <input id="password-field" name="signupkey" type="password" class="form-control" required>
                                    <label class="form-control-placeholder" for="password">Password</label>
                                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div>
                                <div class="form-group">
                                    <input id="repeat-password-field" name="signuprekey" type="password" class="form-control" required>
                                    <label class="form-control-placeholder" for="repeat-password">Repeat Password</label>
                                    <span toggle="#repeat-password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div>
                                <div class="form-group">
                                    <button name="confirm" type="submit" class="form-control btn btn-primary rounded submit px-3">Confirm</button>
                                </div>
                            </form>
		                    <p class="text-center">Already a member? <a data-toggle="tab" href="cust-login.php" onclick="event.preventDefault(); window.location.href='cust-login.php';">Sign In</a></p>
                            <p class="text-center">Continue as guest: <a href="\fyproject2024\Palladium-Hotel\index.html">Home</a></p>
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
