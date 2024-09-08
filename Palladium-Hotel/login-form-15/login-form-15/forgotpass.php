<!doctype html>
<html lang="en">
    
<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $con=mysqli_connect('localhost',
        'root',
        '','phmsdb');

    if(!$con) echo ("failed to connect to database");

    $password=$_POST['pass'];
    $repassword=$_POST['repass'];
    $email1=$_POST['email'];
    $email=strval($email1);
    if($password!=$repassword){
        echo("<script>alert('password not matches')</script>");
    }
    else{
        if(strlen($password)<3){
            echo("<script>alert('password length must be atleast 8')</script>");
        }
        else{

            $sql = "SELECT email FROM account";
            $result = $con->query($sql);
            $email_already_exist=false;

            // Checking if user already exist
            if(($result->num_rows)> 0){
                while($row = $result->fetch_assoc()) {

                    if($row["email"]==$email){    
                        $email_already_exist=true;
                    }
                }
            }

            // echo($ok);
            if($email_already_exist==true){
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

                $mail->addAddress($email);

                $mail->isHTML(true);

                $mail->Subject='Email confirmation code';
                $mail->Body=$otp;

                //$mail->send();

                //if(mail($to,$subject,$message,$headers)){
                if($mail->send()){
                    $_SESSION["OTP"]=$otp;
                    $_SESSION["Email"]=$email;
                    $_SESSION["Password"]=$password;
                    $_SESSION["registration-going-on"]="1";
                    header("Location:verifyforgot.php");
                }
                else 
                    echo("mail send failed");
            }
            else{
                echo $email;
                //echo("<script>alert('wrong email address')</script>");
                echo("wrong email address");
            }
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
                      <form action="forgotpass.php" class="signin-form" method="POST">
					  <div class="form-group">
						<input type="email" name="email" id="email" class="form-control" required>
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
						<label class="form-control-placeholder" for="repeat-password">Repeat Password</label>
						<span toggle="#repeat-password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
					  </div>
		            <div class="form-group">
		            	<button type="submit" class="form-control btn btn-primary rounded submit px-3">Sign In</button>
		            </div>
		          </form>
		          <p class="text-center">Already a member? <a data-toggle="tab" href="LoginV2.html">Sign In</a></p>
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

