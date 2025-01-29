<?php
session_start();
require_once("../function.php");

if (isset($_SESSION['id_user'])) {
  header("Location: dashboard.php");
  exit;
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
		
        $user = $result->fetch_assoc();
        
      if (password_verify($password, $user["password"])) {
        $_SESSION['id_user'] = $user['id_user'];
        $_SESSION['username'] = $user['username'];
       
        echo "<script>
        Swal.fire({
            title: 'Berhasil!',
            text: 'Berhasil login!',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'dashboard.php';
            }
        });</script>";
        exit;
      } else {
        echo "<script>
        Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Username atau password anda salah!',
        confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                window.location.href = 'login_user.php';
            }
            });</script>";
            exit;
      }
    } else {
      echo "<script>
      Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Username atau password anda salah!',
      confirmButtonText: 'OK'
          }).then((result) => {
              if (result.isConfirmed) {
              window.location.href = 'login_user.php';
          }
          });</script>";
          exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
    <title>Halaman Login Book Lovers</title>
</head>
<body>  
    <!-- Navbar -->
    
     <nav class="navbar navbar-expand-lg sticky-top mb-5" style="background-color:rgb(128, 255, 143);">
        <div class="container">
          <a class="navbar-brand ms-5" href="../index.html">Perpustakaan kita</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="../index.html">Beranda</a>
              </li>
           
              </ul>
              <ul class="navbar-nav ms-auto">
              <li class="nav-item">
                <a class="nav-link " href="registrasi_user.php" role="button">
                  Registrasi
                </a>
              </li>
              </ul>
              
          </div>
        </div>
      </nav>
     
    
<!-- Navbar End -->
 <!-- Form -->
  <form action="" method="post">
  <div class="centered">
  <div class="container-form">
    <h2 class="text-bold text-center">Halaman Login</h2>
    <div class="mb-3 mt-5">
          <label for="username" class="form-label" >Username</label>
          <input type="text" class="form-control" id="username" name="username" required>
          </div>
        <div class="mb-3">
          <label for="password" class="form-label" >Password</label>
          <input type="password" class="form-control" id="password" name="password" required>
            </div>
<button type="submit" class="btn bg-primary text-light mb-4" name="login">Login</button>
<p>Belum punya akun? <a href="registrasi_user.php">Daftar di Sini</a></p>

    </div>
  </div>
  </form>
    <!-- Akhir Form -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>