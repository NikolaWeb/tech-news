<?php

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

	$errors = [];
	
	if(!preg_match($regFullName, $fullName)){
		array_push($errors, "Your full name is not in a valid format!");
	}

	
	if(!preg_match($regEmail, $email)){
        array_push($errors, "Your email is not in a valid format!");
	}

	
	if(!preg_match($regUsername, $username)){
        array_push($errors, "Your username is not in a valid format!");
	}
	
	if(!preg_match($regPassword, $password)){
        array_push($errors, "Your password is not good enough!");
	}
	elseif ($password != $passwordAgain){
        array_push($errors, "Your password and confirmation password do not match!");
	}
	else{
	    $password = md5($password);
    }

    if(count($errors) == 0) {
        try {
            $query = "INSERT INTO user VALUES (NULL, :username, :password, 2, :fullName, :email)";

            $stmt = $conn->prepare($query);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $password);
            $stmt->bindParam(":fullName", $fullName);
            $stmt->bindParam(":email", $email);

            $register = $stmt->execute();

            if ($register) {
                $_SESSION['success'] = "Registration successful!";
            } else {
                array_push($errors, "Registration failed!");
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
    else{
	    $_SESSION['errors'] = $errors;
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
		</p>
		<p>
			<label for="email" class="sr-only">Email</label>
			<input id="email" name="email" class="form-control" placeholder="Email (required)" required="" autofocus="" type="text">
		</p>
		<p>
			<label for="username" class="sr-only">Username</label>
			<input id="username" name="username" class="form-control" placeholder="Username (required)" required="" autofocus="" type="text">
		</p>
		<p>
			<label for="password" class="sr-only">Password</label>
			<input id="password" name="password" class="form-control" placeholder="Password (required)" required="" type="password">
		</p>
		<p>
			<label for="passwordAgain" class="sr-only">Password again</label>
			<input id="passwordAgain" name="passwordAgain" class="form-control" placeholder="Password again (required)" required="" type="password">
		</p>
        <button name="btnRegister" class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
      </form>
	</div>
      <?php
        if(isset($errors)):
      ?>
            <ul>
      <?php
            foreach($errors as $e):
      ?>
                <li><span class="text-danger"><?= $e; ?></span></li>
      <?php
            endforeach;
      ?>
            </ul>
      <?php
        endif;
        if(isset($_SESSION['success'])):
       ?>
            <span class="text-success"><?= $_SESSION['success']; ?></span>
            <a href="?page=login">Go to login page</a>
      <?php
        endif;
        unset ($_SESSION['success']);
      ?>
  </div>
</div>