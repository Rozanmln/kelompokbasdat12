<?php
session_start();
require 'function.php';
if( isset($_POST["submit"])) {

    if (insert($_POST) > 0){
        echo "<script> alert('berhasil!'); </script>";
        header("Location: index.php");
    } else {
        echo mysqli_error($conn);
    }
} 
?>
<html>
    <head>
        <title>Adding Content</title>
        <link rel="stylesheet" type="text/css" href="addcont.css">
    </head>
    <body>
        <div class="konten">
            <h1>Add Content</h1>
            <form action="" method="post" enctype="multipart/form-data">
                <p>Nama Beasiswa</p>
                <input type="text" name="judul" placeholder="Nama Beasiswa">
                <p>Content</p>
                <input type="text" name="content" placeholder="Content">
                <p>Poster</p>
                <input type="file" name="poster" placeholder="Poster">
                <p>Contact</p>
                <input type="text" name="contact" placeholder="Nomor Telpon">

                <input type="submit" name="submit" value="Submit">
            </form>
        </div>
    </body>
</html>