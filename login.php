<?php
    include 'php/login.php';
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