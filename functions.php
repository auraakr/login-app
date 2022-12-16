<?php
//menyambungkan ke database

$db = mysqli_connect("localhost", "root", "", "login_app");

function query($query) {
    global $db;
    $result = mysqli_query($db, $query);
    $rows = [];
    while( $row= mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function addData($data) {
    global $db;
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    
    // upload gambar
    $gambar = upload();
    if(!$gambar){
        return false;
    }

    $query ="INSERT INTO karyawan 
        VALUES 
        ('', '$nama', '$email', '$gambar')
    ";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

function upload(){
    $filename = $_FILES['gambar']['name'];
    $filesize = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    //konfirmasi gambar kosong

    if($error === 4){
        echo "<script>
            alert('Gambar masih kosong');
        </script>";
        return false;
    }

    //konfirmasi file
    $ekstensiGambarValid = ['jpg', 'jpeg','png'];
    $ekstensiGambar = explode('.', $filename);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
            alert('Gambar salah!\nFile yang anda upload bukanlah gambar');
        </script>";
        return false;
    }

    //cek ukuran file
    if($filesize > 1000000) {
        echo "<script>
            alert('Ukuran gambar terlalu besar!');
        </script>";
        return false;
    }

    //gambar siap diupload
    //generate nama gambar baru
    $newFilename = uniqid();
    $newFilename .= '.';
    $newFilename .= $ekstensiGambar;


    move_uploaded_file($tmpName, 'aset/'.$newFilename);
    return $newFilename; 


}

function deleteData($id) {
    global $db;
    mysqli_query($db, "DELETE FROM karyawan WHERE id= $id");

    return mysqli_affected_rows($db);
}

function updateData($data){
    global $db;

    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $oldImage = htmlspecialchars($data['oldImage']);
    $gambar = htmlspecialchars($data["gambar"]);

    //memasukkan gambar baru atau bukan
    if($_FILES['gambar']['error']=== 4){
        $gambar = $oldImage;
    } ELSE {
        $gambar = upload();
    }

    $query ="UPDATE karyawan SET 
    nama='$nama',
    email='$email',
    gambar='$gambar'
    WHERE id=$id
    ";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

function search($keyword){
    $query = "SELECT * FROM karyawan WHERE
    nama LIKE '%$keyword%' OR
    email LIKE '%$keyword%'";

    return query($query);
}

function register($data){
    global $db;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($db, $data["password"]);
    $password2 = mysqli_real_escape_string($db, $data["password2"]);

    //cek username
    $result = mysqli_query($db, "SELECT username FROM user WHERE username = '$username'");
    if(mysqli_fetch_assoc($result)){
        echo "<script>
            alert('Username tersebut sudah terdaftar');
        </script>";
        return false;
    }

    if($password !== $password2){
        echo "<script>
            alert('Konfirmasi password tidak sesuai!');
        </script>";
        return false;
    }

    //enkripsi pass
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambah user baru ke db
    mysqli_query($db, "INSERT INTO user VALUES('', '$username', '$password')");

    return mysqli_affected_rows($db);


}

?>