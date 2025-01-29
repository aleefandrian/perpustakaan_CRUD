<?php
session_start();
require_once "../function.php";
$username = $_SESSION['username'];

if (
  isset($_SESSION['status']) &&  
  isset($_SESSION['id_petugas'])
) {
  $id_petugas = $_SESSION['id_petugas'];
  $info_status = $conn->prepare("SELECT status FROM petugas WHERE id_petugas = ?");
  $info_status->bind_param("i", $id_petugas);
  
  $info_status->execute();
  $hasil_status = $info_status->get_result();

  if($hasil_status && $hasil_status->num_rows > 0){
    $data = $hasil_status->fetch_assoc();

    if($data['status'] === 'Tidak Aktif'){
      $_SESSION = [];
      session_unset();
      session_destroy();

      echo"<script>alert('Login atau akun anda tidak valid');
      window.location.href = 'login_petugas.php';</script>";
      exit(); 
    }
  }
} else {
  echo"<script>alert('Login atau akun anda tidak valid');
  window.location.href = 'login_petugas.php';</script>";
  exit(); 
}

$id_petugas = $_GET['id_petugas'];
$stmt = $conn->prepare("SELECT * FROM petugas WHERE id_petugas = ?");
$stmt->bind_param("i", $id_petugas);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Akun petugas tidak ditemukan!";
    exit();
}

$info_petugas = $result->fetch_assoc();

if (isset($_POST['editPetugas'])) {
    if (editPetugas($_POST) > 0) {
      echo "
        <script>
        alert('Berhasil mengedit akun petugas');
        document.location.href = 'data_petugas.php';
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
    <title>Halaman edit Librarian</title>
</head>
<body>
  <!-- start navbar -->
<nav class="navbar navbar-expand-lg fixed-top" style="background-color: #80caff;">
        <div class="container">
          <a class="navbar-brand ms-5" href="../index.html">Perpustakaan Kita</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="../index.html">Beranda</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="dashboard.php">Data buku</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="data_pinjam.php">Data Peminjaman</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Data Akun
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="data_petugas.php">Akun Librarian</a></li>
                  <li><a class="dropdown-item" href="data_user.php">Akun Book Lovers</a></li>
                 </ul>
                </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Aksi
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="tambah_buku.php">Tambah Buku</a></li>
                  <li><a class="dropdown-item" href="tambah_petugas.php">Tambah Librarian</a></li>
                  <li><a class="dropdown-item" href="tambah_user.php">Tambah Book Lovers</a></li>
                 
                 </ul>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
            <form class="d-flex me-5" role="search" method="get" action="">
              <input class="form-control me-2" type="search" placeholder="Search" name="search" aria-label="Search">
              <button class="btn btn-outline-primary" type="submit">Search</button>
            </form>
            <li class="nav-item">
                <a class="nav-link"><?= $username?></a>
              </li>
              <li class="nav-item">
                <a class="nav-link " role="button" onclick="return logout('logout.php')">
                  Logout
                </a>
              </li>
              </ul>
          </div>
        </div>
      </nav>
<!-- end navbar -->

<!-- start tambah buku -->
<form class="pt-5 mt-5" action="" method="post">
        <div class="centered">
            <div class="container-form">           
            <h2 class="text-bold text-center">Halaman edit akun Librarian</h2>
    
            <div class="mb-3 mt-5">
          <label for="username" class="form-label" >Username</label>
          <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($info_petugas['username']) ?>" required>
        </div>
      <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label" >Email address</label>
          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="<?= htmlspecialchars($info_petugas['email']) ?>" required>
          <div id="emailHelp" class="form-text">Kami tidak akan membagikan email anda ke siapapun</div>
        </div>
        <div class="mb-3">
          <label for="no_hp" class="form-label" >No. Hp</label>
          <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= htmlspecialchars($info_petugas['no_hp']) ?>" required>
        </div>
        <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect01">Status Akun</label>
                <select class="form-select" id="inputGroupSelect01" name="status">
                    <option value="Aktif">Aktif</option>
                    <option value="Tidak Aktif">Tidak Aktif</option>
                </select>
</div>
  <button type="submit" class="btn btn-primary" name="editPetugas">Submit</button>
</div>
    </div>
    </form>
    <!-- end tambah buku -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>