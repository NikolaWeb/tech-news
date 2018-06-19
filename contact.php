<?php

$messageE = "";
$messageS = "";
$messageM = "";
$messageSent = "";

if(isset($_POST["messageBtn"])){
	$email = $_POST["email"];
	$subject = $_POST["subject"];
	$message = $_POST["message"];
	
	$regEmail = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
	$regSubject = "/^[A-z0-9]{3,20}+$/";
	$regMessage = "/^[A-z0-9\s\.]{10,}$/";
	
	if(!preg_match($regEmail, $email)){
		$messageE = "<span class='text-danger'>Your email is not in a valid format!</span>";
	}
	elseif(!preg_match($regSubject, $subject)){
		$messageS = "<span class='text-danger'>Your subject is not in a valid format!</span>";
	}
	elseif(!preg_match($regMessage, $message)){
		$messageS = "<span class='text-danger'>Your Message is not in a valid format!</span>";
	}
	else{
		
		$to = "nikola.reljic.web@gmail.com";
		$headers = "From: Tech-World website";
		
		if(@mail($to, $subject, $message, $headers))
		{
		  mail($to, $subject, $message, $headers);
		  $messageSent = "<div class='alert alert-success'><strong>Message sent!</strong></div>";
		}
		else {
		  $messageSent = "<div class='alert alert-danger item-changed'><strong>Message was not sent!</strong></div>";
		}

	}

}
	
?>

<div class="container text-center">
<h1>Contact us</h1>
  <div class="row">
	<div class='col-md-6 text-left'>
		<h3>Contact Tech-World Support</h3>
		<p>Member Support is available<br/> <strong>Mondays to Fridays, 9AM - 5PM CET</strong></p>
		
		<p><strong>EMAIL:</strong> <a href="mailto:nikola.reljic.web@gmail.com">nikola.reljic.web@gmail.com</a></p>

		<p><strong>PHONE:</strong> +381 (0)62 123 456</p>

        <p><strong>TEXT MESSAGING:</strong> +381 (0)62 123 456</p>

    </div>
	<div class="col-md-6">
		<h3>Send us a message</h3>
		<div id="messageDiv">
			<form id="messageForm" class="form-signin" action="" method="POST">
			<div class="form-group">
				<label for="email" class="sr-only">Email</label>
				<input id="email" name="email" class="form-control" placeholder="Email" required="" autofocus="" type="email">
				<?php echo $messageE; ?>
			</div>
			<div class="form-group">
				<label for="subject" class="sr-only">Subject</label>
				<input id="subject" name="subject" class="form-control" placeholder="Subject" required="" type="text">
				<?php echo $messageS; ?>
			</div>
			<div class="form-group">
				<label for="message" class="sr-only">Message</label>
				<textarea id="message" name="message" class="form-control" placeholder="Type something here..."/></textarea>
				<?php echo $messageM; ?>
			</div>
			<button id="messageBtn" name="messageBtn" class="btn btn-lg btn-primary btn-block space-bottom" type="submit">Send</button>
		  </form>
		 <?php echo $messageSent; ?>
		</div>
	</div>
  </div>
</div>
<script src="js/validation.js"></script>