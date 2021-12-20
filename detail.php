<?php
session_start();
require 'function.php';

if( !isset($_SESSION["login"])) {
    header("Location: login.php");
            exit;
} 

$info_id = $_GET["info_id"];
$content = query("SELECT * FROM info_beasiswa WHERE info_id = $info_id")[0];
$comment = query("SELECT * FROM komentar WHERE info_id = $info_id");
// var_dump($content["Info_ID"]); die;


if( isset($_POST["submitComment"])) {

    if (insertComment($_POST) > 0){
        header("Location: detail.php");
    } else {
        echo mysqli_error($conn);
    }
}

// if( isset($_POST["submitAnswer"])) {

//     if (insertAnswer($_POST) > 0){
//         header("Location: index.php");
//     } else {
//         echo mysqli_error($conn);
//     }
// } 

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
<?php

?>
<nav>
    <ul>
    <h2><?= $content["Judul"];?></h2>
    <p><?= $content["Body"];?></p>
    <img src="img/<?= $content["Poster"];?>" alt="" width="200px">
    <p><?= $content["Kontak"];?></p>
    <p>Comment</p>
    <form action="" method="post">
    <input type="hidden" name="info_id" value="<?= $content["Info_ID"] ?>">
    <?php foreach( $comment as $commentRow ) : ?>
        <p><?= $commentRow["Body"];?></p>
    <?php endforeach; ?>
    <input type="text" name="Comment" placeholder="Comment">
    <input type="submit" name="submitComment" value="Submit">
    </form>
    </ul>
</nav>

</body>
</html>