<?php
	$message="";
	$messageU="";
	$messageP="";
	if(isset($_POST['btnLogin']))
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
		$regUsername = "/^[A-z0-9]{3,30}$/";
		$regPassword = "/^[A-z0-9]{6,20}$/";
		
		if(!preg_match($regUsername, $username))
		{
			$messageU = "<span class='text-danger'>Username is in the wrong format!</span>";
		}
		else if(!preg_match($regPassword, $password))
		{
			$messageP = "<span class='text-danger'>Password is in the wrong format!</span>";
		}
		else
		{
            $password = md5($password);

			$query = "SELECT * FROM user u
					  INNER JOIN role r
				      ON u.role_id = r.id_role
				      WHERE username = :username AND password = :password";

            $stmt = $conn->prepare($query);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $password);

            $stmt->execute();

            $user = $stmt->fetch();

			if($user)
			{
				if($_POST["rememberMe"]=='1' || $_POST["rememberMe"]=='on')
                {
                $hour = time() + 3600 * 24 * 30;
                setcookie('username', $username, $hour);
                     setcookie('password', $password, $hour);
                }

				$role = $user->role_name;

                $_SESSION['user'] = $user;

				$_SESSION['role'] = $role;
				if ($_SESSION['role'] == "admin"){
					    header("Location: admin/admin.php");
				}
				else{
					 header("Location: index.php");
				}
				
				
			}
			else
			{
				$message = "<span class='text-danger'>There is no user with given username and password!</span>";
			}
		 }
	}
?>
<div class="container text-center">    
  <h1>Please sign in</h1>
  <div class="row col-md-6 col-md-offset-3">
	<div id="login">
		<form id="loginForm" class="form-signin" action="" method="POST">
		<p>
			<label for="username" class="sr-only">Username</label>
			<input id="username" name="username" class="form-control" placeholder="Username" required="" autofocus="" type="text">
			<?php echo $messageU; ?>
		</p>
		<p>
			<label for="password" class="sr-only">Password</label>
			<input id="password" name="password" class="form-control" placeholder="Password" required="" type="password">
			<?php echo $messageP; ?>
		</p>
        <div class="checkbox">
          <label>
            <input name="rememberMe" type="checkbox"> Remember me
          </label>
        </div>
        <button form="loginForm" id="loginBtn" name="btnLogin" class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>
	  <?php echo $message; ?>
	</div>
  </div>
  <div class="row col-md-6 col-md-offset-3 top20">
      <a href="?page=register">Not registered?</a>
  </div>
</div>