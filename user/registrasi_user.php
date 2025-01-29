<?php 
session_start();
require "../function.php";
if (isset($_SESSION['id_user'])) {
  header("Location: dashboard.php");
  exit;
}
if (isset($_POST['daftar'])) {
  if (registrasiU($_POST) > 0) {
    echo "
      <script>
      alert('User baru berhasil ditambahkan');
      document.location.href = 'loginuser.php';
      </script>
     ";
     
  } else {
    echo mysqli_error($conn);
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
    <title>Halaman Registrasi Book Lovers</title>
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
                <a class="nav-link " href="login_user.php" role="button">
                  Login
                </a>
              </li>
              </ul>
              
          </div>
        </div>
      </nav>
     
    
<!-- Navbar End -->
 <!-- Form -->
  <div class="centered">
  <div class="container-form">
    <h2 class="text-bold text-center">Halaman Registrasi</h2>
    <form action="" method="post">
    <div class="mb-3 mt-5">
          <label for="username" class="form-label" >Username</label>
          <input type="text" class="form-control" id="username" name="username" required>
        </div>
      <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label" >Email address</label>
          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" required>
          <div id="emailHelp" class="form-text">Kami tidak akan membagikan email anda ke siapapun</div>
        </div>

        <div class="mb-3">
          <label for="no_hp" class="form-label" >No. Hp</label>
          <input type="text" class="form-control" id="no_hp" name="no_hp" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label" >Password</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" name="daftar" class="btn bg-primary text-light mb-4">Daftar</button>
        <p>Sudah punya akun? <a href="login_user.php">Login di Sini</a></p>
    </form>
    
       </div>
  </div>
    <!-- Akhir Form -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>