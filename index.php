<?php
session_start();

if(!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
require 'functions.php';
$karyawan = query("SELECT * FROM karyawan");

if(isset($_POST["search"])){
    $karyawan = search($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>

    <h1 class="mx-4 mt-4">Daftar Karyawan</h1><br>
    
    <a class="mx-4 btn btn-danger" href="logout.php">Log Out</a>

    <a class="btn btn-outline-primary" href="add.php">Tambah data karyawan</a>
    <br><br>

    <form class="mx-4" action="" method="post">
        <input type="text" name="keyword" size="50" autofocus placeholder="Cari karyawan..." autocomplete="off">
        <button class="btn btn-primary" type="submit" name="search">Search</button>
    </form>

    <br><br>

    <table class="p-2 bg-light border table mx-4 px-3" cellpadding="10" cellspacing="0">
        <tr>
            <th scope="col">No.</th>
            <th scope="col">Gambar</th>
            <th scope="col">Nama</th>
            <th scope="col">Email</th>
            <th scope="col">Aksi</th>
        </tr>

        <?php $i= 1; ?>
        <?php foreach($karyawan as $row ):?>
        <tr>
            <td  scope="col"><?= $i; ?></td>
            <td scope="col"><img src="aset/<?=$row["gambar"]; ?>" width="50"></td>
            <td scope="col"><?= $row["nama"]; ?></td>
            <td scope="col"><?= $row["email"]; ?></td>
            <td scope="col" class="btn-group" role="group" aria-label="Basic mixed styles example">
                <a class="btn btn-primary" href="update.php?id=<?=$row["id"]?>">Edit</a>
                <a class="btn btn-danger" href="delete.php?id=<?=$row["id"]; ?>" onclick="
                return confirm('Anda yakin ingin menghapus data ini?');">Hapus</a>
            </td>
        </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
    </table>
</body>
</html>