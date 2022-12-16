<?php
session_start();

if(!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';
// menyambungkan ke database
$db = mysqli_connect("localhost","root", "", "login_app");

$id = $_GET["id"];

$karyawan = query("SELECT * FROM karyawan WHERE id= $id")[0];

if( isset($_POST["submit"]) ) {

    // cek data berhasil diupdate
    if(updateData($_POST) > 0) {
        echo "<script>
                alert('Data berhasil diganti!');
                document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
                alert('Data gagal diganti!');
                document.location.href = 'index.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body class="bg-primary p-2 text-dark bg-opacity-25">
    <div class="container">
        <div class="row justify-content-center">
            <div class="border col-lg-5 bg-light mt-5 px-0">
                <h1 class="text-center text-light bg-primary p-3">Edit data karyawan</h1>
                <form class="p-4" action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $karyawan["id"];?>">
                    <input type="hidden" name="oldImage" value="<?= $karyawan["gambar"];?>">
                    <ul>
                        <li class="list-group-item">
                            <label class="form-label" for="nama">Nama: </label>
                            <input class="form-control form-control-lg" type="text" name="nama" id="nama" require
                            value="<?= $karyawan["nama"];?>">
                        </li><br>
                        <li class="list-group-item">
                            <label class="form-label" for="email">Email: </label>
                            <input class="form-control form-control-lg" type="text" name="email" id="email" value="<?= $karyawan["email"];?>">
                        </li><br>
                        <li class="list-group-item">
                            <label for="gambar">Gambar: </label><br><br>
                            <img src="aset/<?= $karyawan['gambar']; ?>" width="70"><br><br>
                            <input class="btn btn-outline-primary" type="file" name="gambar" id="gambar">
                        </li><br>
                        <li class="d-grid gap-2 list-group-item">
                            <button class="btn btn-outline-primary" type="submit" name="submit">Update</button>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>