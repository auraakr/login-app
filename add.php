<?php
session_start();

if(!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';
// menyambungkan ke database
$db = mysqli_connect("localhost","root", "", "login_app");

if( isset($_POST["submit"]) ) {

    // cek data berhasil ditambahkan
    if(addData($_POST) > 0) {
        echo "<script>
                alert('Data berhasil ditambahkan!');
                document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
                alert('Data gagal ditambahkan!');
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
    <title>Data Karyawan</title>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body class="bg-success p-2 text-dark bg-opacity-25">
    <div class="container">
        <div class="row justify-content-center">
            <div class="border col-lg-5 bg-light mt-5 px-0">
                <h1 class="text-center text-light bg-success p-3">Tambah data karyawan</h1>
                <form action="" method="post" class="p-4" enctype="multipart/form-data">
                    <ul>
                        <li class="list-group-item">
                            <label class="form-label" for="nama">Nama: </label>
                            <input type="text" name="nama" id="nama" class="form-control form-control-lg" placeholder="Nama anda" required>
                        </li><br>
                        <li class="list-group-item">
                            <label class="form-label" for="email">Email: </label>
                            <input type="text" name="email" id="email" class="form-control form-control-lg" placeholder="Email anda" required>
                        </li><br>
                        <li class="list-group-item">
                            <label for="gambar">Gambar: </label><br>
                            <input class="btn btn-outline-primary" type="file" name="gambar" id="gambar">
                        </li><br>
                        <li class="d-grid gap-2 list-group-item">
                            <button class="btn btn-outline-success" type="submit" name="submit">Tambah</button>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </div>
    

    
</body>
</html>