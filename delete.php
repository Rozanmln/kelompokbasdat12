<?php 
require 'function.php';
$info_id = $_GET["info_id"];
if ( delete($info_id) > 0 ) {
    header("Location: index.php");
} else {
    echo mysqli_error($conn);
}
?>