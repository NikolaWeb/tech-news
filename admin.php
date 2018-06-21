<?php
	@session_start();
	 include "admin/php/connection.php";
	 if ($_SESSION['role'] != "admin"){
		  header("Location: index.php");
	 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Tech-world |
	<?php 
		
		if(!isset($_REQUEST['page'])){
			echo "Admin panel";
		}
		else{
			echo ucfirst($_REQUEST['page']) ." -"." Admin Panel";
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
  <link rel="stylesheet" type="text/css" href="admin/style.css">
  <link rel="shortcut icon" href="images/favicon.png" />
  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
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
        <a class="navbar-brand" href="admin.php?page=home"><img src="images/logo-st.png" alt="Logo"></a>
    </div>
	 <div class="admin-header">
		<h3><span class="glyphicon glyphicon-cog"></span> Admin Panel</h3>
	 </div>
  </div>
</nav>

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-2 sidenav">

      <ul class="nav nav-pills nav-stacked">
          <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">Slider <span class="caret"></span></a>
              <ul class="dropdown-menu">
                  <li><a href="?page=slider">Slider</a></li>
                  <li><a href="?page=slider-add">Add new</a></li>
              </ul>
          </li>
          <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">News <span class="caret"></span></a>
              <ul class="dropdown-menu">
                  <li><a href="?page=news">News</a></li>
                  <li><a href="?page=news-add">Add new</a></li>
              </ul>
          </li>
          <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">Users <span class="caret"></span></a>
              <ul class="dropdown-menu">
                  <li><a href="?page=users">Users</a></li>
                  <li><a href="?page=users-add">Add new</a></li>
              </ul>
          </li>
          <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">Comments <span class="caret"></span></a>
              <ul class="dropdown-menu">
                  <li><a href="?page=comments">Comments</a></li>
                  <li><a href="?page=comments-add">Add new</a></li>
              </ul>
          </li>
		  <li><a href="php/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
		  <li><a href="/novo"><span class="glyphicon glyphicon-arrow-left"></span> Back to Frontend</a></li>
      </ul>
    </div>
	<div class="col-sm-9">
<?php
	//load content
		if(isset($_GET['item']))
			include 'admin/'.$_GET['page']."-edit.php";
		elseif(isset($_REQUEST['page']))
			if(!is_numeric($_REQUEST['page']))
				include 'admin/'. ($_REQUEST['page'].".php");
		
		else
			include 'admin/'. $pageinfo['url'];
		
	include "php/close.php";
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
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
<script language="JavaScript" src="admin/scripts.js"></script>