<!doctype html>
<html lang="en">

<?php
if (isset($_POST["signin"])) {
    // session_start();
    // User input
    $cookie_name = "user";
    $email1 = $_POST['loginemail'];
    $email = strval($email1); // Ensure $email is a string
    $key = $_POST['loginkey']; // The plain text password entered by the user

    // MySQL database connection
    $con = new mysqli('localhost', 'u838201253_palladium', 'Azib277221', 'u838201253_phmsdb');
    
    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // Prepare SQL query using prepared statements
    $sql = "SELECT id,username, membership, birthday, phone, email, pass FROM customer_account WHERE email = ?";
    
    // Prepare the statement
    if ($stmt = $con->prepare($sql)) {
        // Bind parameters to the prepared statement
        $stmt->bind_param("s", $email); // "s" indicates the parameter is a string

        // Execute the statement
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Check if there are any matching rows
        if ($result && $result->num_rows > 0) {
            // Fetch the result as an associative array
            $row = $result->fetch_array(MYSQLI_ASSOC);

            // Verify the password using password_verify() function
            if (password_verify($key, $row['pass'])) {
                // Password is correct, store user data in cookies and redirect
                setcookie($cookie_name, $row['username'], time() + (86400 * 30 * 30), "/");
                setcookie("user_id", $row['id'], time() + (86400 * 30 * 30), "/");
                setcookie("phone", $row['phone'], time() + (86400 * 30 * 30), "/");
                setcookie("membership", $row['membership'], time() + (86400 * 30 * 30), "/");
                setcookie("birthday", $row['birthday'], time() + (86400 * 30 * 30), "/");
                setcookie("email", $email, time() + (86400 * 30 * 30), "/");

                // Redirect to the homepage after login
                header("Location: ..");
                exit;
            } else {
                // Invalid password
                setcookie("error", "default", time() + (30 * 30), "/");
            }
        } else {
            // Handle login failure (e.g., wrong email)
            setcookie("error", "default", time() + (86400 * 30), "/");
            // echo "No results found or query error!";
        }

        // Close the statement
        $stmt->close();
    } else {
        // If statement preparation fails, print error
        // echo "Error preparing the query: " . $con->error;
    }

    // Close the database connection
    $con->close();
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
							<form action="cust-login.php" onsubmit="return validateForm()" method="POST" class="signin-form">
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
		            	<button name="signin" type="submit" class="form-control btn btn-primary rounded submit px-3">Sign In</button>
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
		            <div class="form-group d-md-flex">
						<a href="cust-forgotpass.php" onclick="event.preventDefault(); window.location.href='cust-forgotpass.php';">Forgot Password</a>
					</div>
		          <p class="text-center">Not a member? <a data-toggle="tab" href="cust-register.php" onclick="event.preventDefault(); window.location.href='cust-register.php';">Sign Up</a></p>
		          <p class="text-center">Continue as guest: <a href="..">Home</a></p>
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

