<?php
	$messageFN = "";
	$messageE = "";
	$messageU = "";
	$messageP = "";
	$messagePA = "";
	$message = "";
if(isset($_POST["btnRegister"]))
{
	$fullName = $_POST["fullName"];
	$email = $_POST["email"];
	$username = $_POST["username"];
	$password = $_POST["password"];
	$passwordAgain = $_POST["passwordAgain"];
	
	$regFullName = "/^[A-z\s]{2,30}(\s[A-z]{2,30})+$/";
	$regEmail = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
	$regUsername = "/^[A-z0-9]{2,30}$/";
	$regPassword = "/^[A-z0-9]{5,20}$/";

	
	if(!preg_match($regFullName, $fullName)){
		$messageFN = "<span class='text-danger'>Your full name is not in a valid format!</span>";
		
	}
	else{
		$fullName = mysqli_real_escape_string($conn, $fullName);
	}
	
	if(!preg_match($regEmail, $email)){
		$messageE = "<span class='text-danger'>Your email is not in a valid format!</span>";
	}
	else{
		$email = mysqli_real_escape_string($conn, $email);
	}
	
	if(!preg_match($regUsername, $username)){
		$messageU = "<span class='text-danger'>Your username is not in a valid format!</span>";
	}
	else{
		$username = mysqli_real_escape_string($conn, $username);
	}
	
	if(!preg_match($regPassword, $password)){
		$messageP = "<span class='text-danger'>Your password is not good enough!</span>";
	}
	elseif ($password != $passwordAgain){
		$messagePA = "<span class='text-danger'>Your password and confirmation password do not match!</span>";
	}
	else{
		$password = md5(mysqli_real_escape_string($conn, $password));
		$query = "INSERT INTO user VALUES (NULL, '$fullName', '$password', 2, '$username', '$email')";
		if(mysqli_query($conn, $query)){
			$message = "<span class='text-success'>Registration succesful! Please go to login page to sign in.</span>";
		}
		else{
			$message = "<span class='text-danger'>Registration failed!</span>".mysqli_error();
		}
	}	
}
?>
<div class="container text-center">    
  <h1>Please register</h1>
  <div class="row col-md-6 col-md-offset-3">
	<div id="register" class="space-bottom">
		<form id="registerForm" class="form-signin space-bottom" action="" method="POST">
		<p>
			<label for="fullName" class="sr-only">Full Name</label>
			<input id="fullName" name="fullName" class="form-control" placeholder="Full Name" required="" autofocus="" type="text">
			<?php echo $messageFN; ?>
		</p>
		<p>
			<label for="email" class="sr-only">Email</label>
			<input id="email" name="email" class="form-control" placeholder="Email (required)" required="" autofocus="" type="text">
			<?php echo $messageE; ?>
		</p>
		<p>
			<label for="username" class="sr-only">Username</label>
			<input id="username" name="username" class="form-control" placeholder="Username (required)" required="" autofocus="" type="text">
			<?php echo $messageU; ?>
		</p>
		<p>
			<label for="password" class="sr-only">Password</label>
			<input id="password" name="password" class="form-control" placeholder="Password (required)" required="" type="password">
			<?php echo $messageP; ?>
		</p>
		<p>
			<label for="passwordAgain" class="sr-only">Password again</label>
			<input id="passwordAgain" name="passwordAgain" class="form-control" placeholder="Password again (required)" required="" type="password">
			<?php echo $messagePA; ?>
		</p>
        <button name="btnRegister" class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
      </form>
	  <?php echo $message; ?>
	</div>
  </div>
</div>