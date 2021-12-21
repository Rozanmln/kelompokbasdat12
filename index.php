<?php
session_start();
require 'function.php';

if( !isset($_SESSION["login"])) {
    header("Location: login.php");
            exit;
} 

$content = query("SELECT * FROM info_beasiswa");

?>

<html>
    <head>
        <title> Dropdown Menu </title>
        <link rel="stylesheet" href="style1.css" type="text/css">
    </head>
    <body>
        <nav class="menu">
            <div class="logo">
                <img src="asset/hehe.png"/>
            </div>
            <ul class="header"> 
                
                <li><a href="profile.php?user_id=<?= $_SESSION['user_id'];?>">Profile</a></li>
                <li><a href="content.php">Add content</a></li>
                <li><a href="logout.php">Log out</a></li>
            </ul>   
        </nav>
<nav class="content">
    <ul>
        <?php foreach( $content as $row ) : ?>
        <h2><?= $row["Judul"];?></h2>
        <h3><?= $row["Kontak"];?></h3>
        <p><?= $row["Body"];?></p>
        <img src="img/<?= $row["Poster"];?>" alt="" width="200px">
        <a href="edit.php?info_id=<?= $row["Info_ID"];?>">Edit</a> 
        <a href="delete.php?info_id=<?= $row["Info_ID"];?>">Delete</a>
        <a href="detail.php?info_id=<?= $row["Info_ID"];?>">Detail</a>
        <br><br>
        <?php endforeach; ?>
    </ul>
</nav>
</body>
<footer id="contact">
        <div class="layar-dalam">
            <div>
                <h5>Info</h5>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore,
                sequi.
            </div>
            <div>
                <h5>Contact</h5>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore,
                sequi.
            </div>
            <div>
                <h5>Help</h5>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore,
                sequi.
            </div>
            <div>
                <h5>Sitemap</h5>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore,
                sequi.
            </div>
        </div>
        <div class="layar-dalam">
            <div class="copyright">
                &copy; 2021 Yukbeasiswa
            </div>
        </div>
    </footer>
</html>
