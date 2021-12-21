<?php
session_start();
require 'function.php';
//dapetin id content yang ingin diubah
$info_id = $_GET["info_id"];
//dapetin isi konten yang ingin diubah
$infoBeasiswa = query("SELECT * FROM info_beasiswa WHERE info_id = $info_id")[0];
if( isset($_POST["submit"])) {

    if (edit($_POST) > 0){
        echo "<script> alert('berhasil!'); </script>";
        header("Location: index.php");
    } else {
        echo mysqli_error($conn);
    }
} 
?>
<html>
    <head>
        <title>Editing Content</title>
        <link rel="stylesheet" type="text/css" href="addcont.css">
    </head>
    <body>
        <div class="konten">
            <h1>Editing Content</h1>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="info_id" value="<?= $infoBeasiswa["Info_ID"] ?>">
                <input type="hidden" name="PosterLama" value="<?= $infoBeasiswa["Poster"] ?>">
                <p>Nama Beasiswa</p>
                <input type="text" name="judul" placeholder="Nama Beasiswa" require value = "<?= $infoBeasiswa["Judul"] ?>">
                <p>Content</p>
                <input type="text" name="content" placeholder="Conntent" require value = "<?= $infoBeasiswa["Body"] ?>">
                <p>Poster</p>
                <img src="img/<?= $infoBeasiswa["Poster"] ?>" width = "100" alt="">
                <input type="file" name="poster" placeholder="Poster">
                <p>Contact</p>
                <input type="text" name="contact" placeholder="Nomor Telpon" require value = "<?= $infoBeasiswa["Kontak"] ?>">

                <input type="submit" name="submit" value="Submit">
            </form>
        </div>
    </body>
</html>