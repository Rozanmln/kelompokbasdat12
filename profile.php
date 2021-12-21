<?php
session_start();
require 'function.php';
//dapetin id content yang ingin diubah
$user_id = $_GET["user_id"];
if( isset($_POST["submit"])) {

    if (insertProfile($_POST) > 0){
        echo "<script> alert('berhasil!'); </script>";
        header("Location: index.php");
    } else {
        echo mysqli_error($conn);
    }
} 
?>
<html>
    <head>
        <title>insert profile</title>
        <link rel="stylesheet" type="text/css" href="addcont.css">
    </head>
    <body>
        <div class="konten">
            <h1>insert profile</h1>
            <form action="" method="post">
                <input type="hidden" name="user_id" value="<?= $user_id ?>">
                <p>Name</p>
                <input type="text" name="name" placeholder="name">
                <p>Email</p>
                <input type="text" name="email" placeholder="email">
                <p>Phone Number</p>
                <input type="text" name="phone_number" placeholder="phone_number">
                <p>Address</p>
                <input type="text" name="address" placeholder="address">

                <input type="submit" name="submit" value="Submit">
            </form>
        </div>
    </body>
</html>