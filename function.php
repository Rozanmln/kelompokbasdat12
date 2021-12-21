<?php
$conn = mysqli_connect("localhost", "root", "", "basdatlagikel1");
//fungsi register
function register($data) {
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    //cek username udah ada ato blom
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
    if(mysqli_fetch_assoc($result)) {
        echo "<script> alert('username udh ada'); </script>";
        return false;
    }

    //cek konfirmasi pass
    if ( $password !== $password2) {
        echo "<script> alert('password tidak sesuai'); </script>";
        return false;
    }
    
    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    //nambah user baru
    mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");

    return mysqli_affected_rows($conn);

}

function insert($data) {
    global $conn;   

    //siapkan variable
    $user_id = $_SESSION['user_id'];
    $judul = htmlspecialchars($data["judul"]);
    $content = htmlspecialchars($data["content"]);
    $contact = htmlspecialchars($data["contact"]);
    $poster = upload();
    if (!$poster) { 
        return false; 
    }

    //jalankan query insert
    $q = "INSERT INTO info_beasiswa VALUES ('', '$judul', '$content', '$poster', '$contact', '$user_id')";
    mysqli_query($conn, $q);
    return mysqli_affected_rows($conn);
}

function upload() {
    
    $namaFile = $_FILES['poster']['name'];
    $ukuranFile = $_FILES['poster']['size'];
    $error = $_FILES['poster']['error'];
    $tmpName = $_FILES['poster']['tmp_name'];

    //cek yang diaplot gambar bukan
    $ekstensiValid = ['jpg', 'jpeg', 'png'];
    $ekstensiPoster = explode('.', $namaFile);
    $ekstensiPoster = strtolower(end($ekstensiPoster));
    if( !in_array($ekstensiPoster, $ekstensiValid) ) {
        echo "<script> alert('file bukan image'); </script>";
        return false;
    }

    //cek ukuran
    if( $ukuranFile > 10000000 ) {
        echo "<script> alert('file kegedean'); </script>";
        return false;
    }

    //bikin nama gambar yang baru
    $namaBaru = uniqid();
    $namaBaru .= '.';
    $namaBaru .= $ekstensiPoster;
    
    //pindahin ke folder
    move_uploaded_file($tmpName, 'img/' . $namaBaru);

    return $namaBaru;

}

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $allData = [];
    while ( $data = mysqli_fetch_assoc($result) ) {
        $allData[] = $data;
    }
    return $allData;
}

function delete($info_id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM info_beasiswa WHERE info_id = $info_id");
    return mysqli_affected_rows($conn);
}

function edit($data) {
    global $conn;   

    //siapkan variable
    $user_id = $_SESSION['user_id'];
    $info_id = $data["info_id"];
    $judul = htmlspecialchars($data["judul"]);
    $content = htmlspecialchars($data["content"]);
    $contact = htmlspecialchars($data["contact"]);
    $posterLama = htmlspecialchars($data["PosterLama"]);

    //cek masukin gambar baru apa engga
    if ( $_FILES['poster']['error'] === 4) {
        $poster = $posterLama;
    } else {
        $poster = upload();
    }

    //jalankan query update
    $q = "UPDATE info_beasiswa SET 
            judul = '$judul', 
            body = '$content',
            poster = '$poster',
            kontak = '$contact'
            WHERE info_id = $info_id
            ";
    mysqli_query($conn, $q);
    return mysqli_affected_rows($conn);
}

function insertComment($data) {
    global $conn;   

    //siapkan variable
    $user_id = $_SESSION['user_id'];
    $info_id = $data["info_id"];
    $comment = htmlspecialchars($data["Comment"]);

    //jalankan query insert
    $q = "INSERT INTO komentar VALUES ('', '$comment', '$user_id', '$info_id')";
    mysqli_query($conn, $q);
    return mysqli_affected_rows($conn);
}

function insertProfile($data) {
    global $conn;   

    //siapkan variable
    $user_id = $data["user_id"];
    $name = htmlspecialchars($data["name"]);
    $email = htmlspecialchars($data["email"]);
    $phone_number = htmlspecialchars($data["phone_number"]);
    $address = htmlspecialchars($data["address"]);

    //jalankan query insert
    $q = "INSERT INTO datadiri VALUES ('$user_id', '$name', '$email', '$phone_number', '$address')";
    mysqli_query($conn, $q);
    return mysqli_affected_rows($conn);
}
?>