<?php
@session_start();
include "php/setup.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php include("head.php"); ?>
<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="?page=home"><img src="images/logo-st.png" alt="Logo"></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <?php
                $q = "SELECT * FROM menu";

                $navigation = $conn->query($q)->fetchAll();

                foreach($navigation as $nav) : ?>

                    <li><a class="<?php echo ($pageinfo->name == $nav->name) ? "active" : ""; ?> nav-link" href="?page=<?php echo $nav->id_menu; ?>"><?php echo $nav->name; ?></a></li>

                <?php endforeach; ?>

                <?php if(isset($_SESSION['user'])): ?>
                <li><a href="?page=favorites"><span class="glyphicon glyphicon-heart"></span> Favorites</a></li>
                <?php endif; ?>

                <?php if(isset($_SESSION['role'])) : ?>
                    <li><a href="php/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                    <?php if ($_SESSION['role'] == "admin"): ?>
                        <li><a href="admin.php"><span class="glyphicon glyphicon-cog"></span> Admin</a></li>
                    <?php
                    endif;
                else:
                    ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="?page=login">Login</a></li>
                            <li><a href="?page=register">Register</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>