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

if (isset($_POST['tambahBuku'])) {
    if (tambahBuku($_POST) > 0) {
      echo "
        <script>
        alert('Berhasil menambahkan buku');
        document.location.href = 'dashboard.php';
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
    <title>Halaman tambah buku</title>
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
<form class="pt-5 mt-5" action="" method="post" enctype="multipart/form-data">
        <div class="centered">
        
            <div class="container"> 
            <h2 class="text-bold text-center">Halaman tambah buku</h2>
              
  <div class="mb-3">
    <label for="judul" class="form-label">Judul buku</label>
    <input type="text" class="form-control" name="judul" id="judul" placeholder="Judul buku" required>
  </div>
  <div class="mb-3">
    <label for="pengarang" class="form-label">Pengarang</label>
    <input type="text" class="form-control" name="pengarang" id="pengarang" placeholder="Pengarang" required>
  </div>
  <div class="mb-3">
    <label for="penerbit" class="form-label">Penerbit</label>
    <input type="text" class="form-control" name="penerbit" id="penerbit" placeholder="Penerbit" required>
  </div>
  <div class="mb-3">
    <label for="genre" class="form-label">Genre</label>
    <input type="text" class="form-control" name="genre" id="genre" placeholder="Genre" required>
  </div>
  <div class="form mb-3">
  <label for="sinopsis" class="form-label">Sinopsis</label>
  <textarea class="form-control" placeholder="Sinopsis" name="sinopsis" id="sinopsis" style="height: 200px" required></textarea>
</div>
<div class="form mb-3">
  <label for="stok_buku" class="form-label">Stok buku</label>
  <input type="number" class="form-control" placeholder="Stok Buku" name="stok_buku" id="stok_buku" value="<?= intval($info_buku['stok_buku']) ?>" required>
</div>
  <div class="mb-3">
    <label for="gambar" class="form-label">Upload Gambar</label>
    <input type="file" class="form-control" name="gambar" id="gambar" placeholder="Upload Gambar" required>
  </div>

  <button type="submit" class="btn btn-primary" name="tambahBuku">Submit</button>
</div>
    </div>
    </form>
    <!-- end tambah buku -->

<script>
  function logout(url) {
    Swal.fire({
      title: "Apakah anda yakin?",
      text: "Jika anda logout, anda harus login kembali jika ingin mengakses akun ini!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, logout!"
    }).then((result) => {
      if (result.isConfirmed) {
         window.location.href = url;
      }
    });
  }
</script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>