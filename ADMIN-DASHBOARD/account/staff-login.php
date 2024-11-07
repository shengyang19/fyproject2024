<!doctype html>
<html lang="en">
	
<?php
session_start();
$_SESSION['info']="";
if(isset($_POST["signin"])){
//$cookie_name = "user";
$email1 = $_POST['loginemail'];
$email=strval($email1);
$key = $_POST['loginkey'];
//# start - auth
$conn = new mysqli('localhost', 'u838201253_palladium', 'Azib277221', 'u838201253_phmsdb');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute the SQL statement
$stmt = $conn->prepare("SELECT pass FROM staff_account WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // User exists, fetch the hashed password
    $stmt->bind_result($hashedPassword);
    $stmt->fetch();

    // Verify the entered password
    if (password_verify($key, $hashedPassword)) {
        // echo "Login successful!";
        
        // Fetch user data
        $sql = "SELECT id, username, email, role, phone FROM staff_account WHERE email = ?";
        $userStmt = $conn->prepare($sql);
        $userStmt->bind_param("s", $email);
        $userStmt->execute();
        $result = $userStmt->get_result();
        
        if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
            $_SESSION["user"] = $row['id']; // for role & edit profile
			
            // Store user data in JSON format for profile view
            $data = [
				"id" => $row['id'],
                "username" => $row['username'],
                "email" => $row['email'],
                "phone" => $row['phone'],
                "role" => $row['role']
            ];
            $_SESSION['info'] = json_encode($data);

			$userStmt->close();
			$stmt->close();
			$conn->close();
            header("Location: ../index.html");
            exit;
        }
        
        $userStmt->close();

    } else {
        // echo "Invalid password.";
        setcookie("error", "default", time() + (30 * 30), "/");
    }
} else {
    // echo "User not found.";
    setcookie("error", "default", time() + (30 * 30), "/");
}

$stmt->close();
$conn->close();
//# end - auth

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
									<div class="text-center">
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

