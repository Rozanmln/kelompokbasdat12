<?php
session_start();
require 'function.php';

if( !isset($_SESSION["login"])) {
    header("Location: login.php");
            exit;
} 
$content = query("SELECT * FROM info_beasiswa");

if( isset($_POST["submitComment"])) {

    if (insertComment($_POST) > 0){
        header("Location: index.php");
    } else {
        echo mysqli_error($conn);
    }
} 

?>

<html>
    <head>
        <title> Dropdown Menu </title>
        <link rel="stylesheet" href="styleindex.css" type="text/css">
    </head>
<body>

<nav class="menu">
    <label>Beasiswa</label>
    <ul> 
         <li><a href="#">Home</a></li>
        <li><a href="#">Gallery</a>
            <ul class="dropdown"></ul>
                <li><a href="#">Photo</a></li>
                <li><a href="#">Image</a></li>
                <li><a href="#">Document</a></li>
            </ul>
        </li>
         <li><a href="#">Contact Us</a></li>
         <li><a href="#">About Us</a></li>
    </ul>   
</nav>

<nav>
    <ul>
        <?php foreach( $content as $row ) : ?>
        <a href="edit.php?info_id=<?= $row["Info_ID"];?>">Edit</a> 
        <a href="delete.php?info_id=<?= $row["Info_ID"];?>">Delete</a>
        <h2><?= $row["Judul"];?></h2>
        <p><?= $row["Body"];?></p>
        <img src="img/<?= $row["Poster"];?>" alt="" width="200px">
        <p><?= $row["Kontak"];?></p>
        <p>disini komenya ntr</p>
        <form action="" method="post">
        <p>Comment</p>
        <input type="hidden" name="info_id" value="<?= $row["Info_ID"];?>">
        <input type="text" name="Comment" placeholder="Comment"> 
        <input type="submit" name="submitComment" value="Submit">
        </form>
        <?php endforeach; ?>
    </ul>
</nav>


</body>
</html>