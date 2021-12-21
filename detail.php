<?php
session_start();
require 'function.php';

if( !isset($_SESSION["login"])) {
    header("Location: login.php");
            exit;
} 

$info_id = $_GET["info_id"];
if( isset($_POST["submitComment"])) {

    if (insertComment($_POST) > 0){
        header("Location: index.php");
    } else {
        echo mysqli_error($conn);
    }
}

$content = query("SELECT * FROM info_beasiswa WHERE info_id = $info_id")[0];
$comment = query("SELECT * FROM komentar WHERE info_id = $info_id");

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
                <li><a href="#">Home</a></li>
                <li><a href="#">Add content</a></li>
                <li><a href="#">Log out</a></li>
            </ul>   
        </nav>
<nav class="content">
    <ul>
    <h2><?= $content["Judul"];?></h2>
    <h3><?= $content["Kontak"];?></h3>
    <p><?= $content["Body"];?></p>
    <img class="poster" src="img/<?= $content["Poster"];?>" alt="" width="200px">
    <h5>Comment</h5>
    <form action="" method="post">
    <input type="hidden" name="info_id" value="<?= $content["Info_ID"] ?>">
    <?php foreach( $comment as $commentRow ) : ?>
        <h4><?= $commentRow["Body"];?></h4>
    <?php endforeach; ?>
    <input type="text" name="Comment" placeholder="Comment">
    <input type="submit" name="submitComment" value="Submit">
    <a href="index.php">Back</a>
    </form>
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
