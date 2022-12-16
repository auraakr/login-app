<?php
session_start();

if(isset($_SESSION['login'])){
    header("Location: index.php");
    exit;
}
require 'functions.php';

    if(isset($_POST["login"])){
        $username =$_POST["username"];
        $password= $_POST["password"];

        $result = mysqli_query($db, "SELECT * FROM user WHERE username= '$username'");

        //cek username
        if(mysqli_num_rows($result) === 1){
            // cek pass
            $row = mysqli_fetch_assoc($result);

            if(password_verify($password, $row["password"])){
                //set session
                $_SESSION["login"]= true;

                header("Location: index.php");
                exit;
            }
        }

        $error = true; 

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body class="bg-success p-2 text-dark bg-opacity-25">
    <div class="container">
        <div class="row justify-content-center">
            <div class="border col-lg-5 bg-light mt-5 px-0">
                <h1 class="text-center text-light bg-success p-3">Halaman Login</h1>
                <?php if(isset($error)) : ?>
                    <p style="color: red; background: pink; padding: 8px;">Username atau password anda salah</p>
                <?php endif; ?>

                <form class="p-4" action="" method="post">
                    <ul>
                        <li class="list-group-item">
                            <label class="form-label" for="username">Username: </label>
                            <input class="form-control form-control-lg" type="text" name="username" id="password">
                        </li><br>
                        <li class="list-group-item">
                            <label class="form-label" for="password">Password</label>
                            <input class="form-control form-control-lg" type="password" name="password" id="password">
                        </li><br>
                        <li class="d-grid gap-2 list-group-item">
                            <button class="btn btn-outline-success" type="submit" name="login">Log In</button>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>