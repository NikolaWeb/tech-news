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
                header("Location: admin.php");
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