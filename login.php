<?php
session_start();
require 'function.php';
if ( isset($_SESSION["login"])) {
    header("Location: index.php");
            exit;
}
if( isset($_POST["login"])) {

   $username = $_POST["username"];
   $password = $_POST["password"];

   $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
    // cek username ada apa engga
    if ( mysqli_num_rows($result) === 1 ) {
        //cek password
        $row = mysqli_fetch_assoc($result);
        if ( password_verify($password, $row["Password"]) ) {
            $_SESSION["login"] = true;
            $_SESSION["user_id"] = $row["User_ID"];
            header("Location: index.php");
            exit;
        } else {
            echo "<script> alert('Password salah'); </script>";
        }
    }
} 
?>

<html>
    <head>
        <title>Login Yukbeasiswa.id</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <body>
            <div class="loginbox">
                <img src="icon.jpeg" class="avatar">
                <h1>Login Here</h1>
                <form action="" method="post">
                    <p>Username</p>
                    <input type="text" name="username" id="username" placeholder="Enter Username">
                    <p>Password</p>
                    <input type="password" name="password" id="password" placeholder="Enter Password">
                    <input type="submit" name="login" value="Login">
                    <a href="#">Forgot Password?</a><br>
                    <a href="regis.php">Create Account</a>
                </form>
            </div>


        </body>
    </head>
</html>