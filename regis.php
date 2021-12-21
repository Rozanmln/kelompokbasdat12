<?php
session_start();
require 'function.php';

if( isset($_POST["register"])) {

    if (register($_POST) > 0){
        echo "<script> alert('berhasil!'); </script>";
        header("Location: login.php");
    } else {
        echo mysqli_error($conn);
    }
    
} 

?>
<html>
    <head>
        <title>Login Beasiswa Yayasan Sabil</title>
        <link rel="stylesheet" type="text/css" href="registyle.css">
        <body>
            <div class="loginbox">
                <h1>Create Account</h1>
                <form action="" method="post">
                    <p>Username</p>
                    <input type="text" name="username" id="username" placeholder="Enter Username">
                    <p>Password</p>
                    <input type="password" name="password" id="password"placeholder="Enter Password">
                    <p>Confirm Password</p>
                    <input type="password" name="password2" id="password2"placeholder="Re-enter Password">
                    <input type="submit" name="register" value="Confirm">
                </form>
            </div>
        </body>
    </head>
</html>