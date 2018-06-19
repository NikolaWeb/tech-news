<?php
	@session_start();
	 include "../setup.php";
	 if ($_SESSION['role'] != "admin"){
		  header("Location: index.php");
	 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Guitarzoom | 
	<?php 
		
		if(!isset($_REQUEST['page'])){
			echo "Admin panel";
		}
		else{
			echo ucfirst($_REQUEST['page']) ." Admin Panel";
		}
	?>
  </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="shortcut icon" href="../images/favicon.png" />
</head>
<body class="admin-panel">

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="?page=home"><img src="../images/GZ-logo.png" alt="Logo"></a>
    </div>
	 <div class="admin-header">
		<h3>Admin Panel</h3>
	 </div>
  </div>
</nav>

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav">
      <ul class="nav nav-pills nav-stacked">
       	<?php
			$q = "SELECT * FROM admin_menu";
			$r = mysqli_query($conn, $q);
			while($nav = mysqli_fetch_array($r)) : ?>

			<li><a href="?page=<?php echo $nav['slug']; ?>"><?php echo $nav['name'] ?></a></li>

		<?php endwhile; ?>
		<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
		<li><a href="/novo"><span class="glyphicon glyphicon-arrow-left"></span> Back to Frontend</a></li>
      </ul>
    </div>
	<div class="col-sm-9">
<?php
	//load content
		if(isset($_GET['course']))
			include("single-item.php");
		elseif(isset($_REQUEST['page']))
			if(!is_numeric($_REQUEST['page']))
				include($_REQUEST['page'].".php");
			elseif($_GET['page'] != $pageinfo['id_menu'])
			include "404.php";
			else
				include $pageinfo['url'];
		
		else
			include $pageinfo['url'];
		
	include "../close.php";			
?>
	</div>
  </div>
</div>
<footer class="container-fluid text-center">
  <div class="collapse navbar-collapse" id="footerNavbar">
      <ul class="nav navbar-nav">
			<li><a target="_blank" href="../dokumentacija.pdf">Documentation</a></li>
			<li><a href="author.php">About author</a></li>
      </ul>
	  <p class="copy">&copy; Nikola Reljic, <?php echo date("Y") ?></p>
    </div>
</footer>
<div id="overlay">
	<div class="loader"></div>
</div>
</body>
</html>
<script language="JavaScript" src="scripts.js"></script>