<?php
session_start();
require_once "../function.php";

if (!isset($_SESSION['id_user'])) {
  $_SESSION['error'] = "Anda harus login terlebih dahulu.";
  header("Location: login_user.php");
  exit;
}

$username = $_SESSION['username']; 


$id_buku = $_GET['id_buku'];
$stmt = $conn->prepare("SELECT * FROM buku WHERE id_buku = ?");
$stmt->bind_param("i", $id_buku);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Buku tidak ditemukan!";
    exit();
}

$info_buku = $result->fetch_assoc();

if (isset($_POST['pinjamBukuSimple'])) {
    if (pinjamBukuSimple($_POST) > 0) {
      echo "
        <script>
        alert('Berhasil meminjam buku');
        document.location.href = 'histori_pinjam.php';
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
    <title>Halaman pengajuan peminjaman buku</title>
</head>
<body>
<!-- start navbar -->
<nav class="navbar navbar-expand-lg fixed-top"  style="background-color:rgb(128, 255, 143);">
        <div class="container">
          <a class="navbar-brand ms-5" href="../index.html">Perpustakaan Kita</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Tampilan
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="dashboard_simple.php">Tambah Sederhana</a></li>
                  <li><a class="dropdown-item" href="dashboard.php">Tambah Advanced</a></li>
                 </ul>
                </li>
              <li class="nav-item">
                <a class="nav-link" href="histori_pinjam.php">Histori Peminjaman Buku</a>
              </li>
              <li class="nav-item">
                <a class="nav-link " href="rules.php" role="button" >
                  Peraturan Peminjaman Buku
                </a>
              </li>
              
            </ul>
            <ul class="navbar-nav ms-auto">
            <form class="d-flex me-5" role="search" method="get" action="">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            
              <li class="nav-item">
                <a class="nav-link">
                  <?= $username; ?>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link " href="" role="button" onclick="return logout(event, 'logout.php')">
                  Logout
                </a>
              </li>
              </ul>
          </div>
        </div>
      </nav>
<!-- end navbar -->

<!-- start tambah buku -->
<form class="pt-5 mt-4" action="" method="post">
        <div class="centered">
        
            <div class="container-form">
            <h2 class="text-bold text-center mb-3">Halaman pengajuan peminjaman buku</h2>
               
  <div class="mb-3">
    <label for="judul" class="form-label">Judul buku</label>
    <input type="text" class="form-control" name="judul" id="judul" value="<?= htmlspecialchars($info_buku['judul']) ?>" placeholder="Judul buku" readonly>
  </div>
  <div class="mb-3">
    <label for="pengarang" class="form-label">Pengarang</label>
    <input type="text" class="form-control" name="pengarang" id="pengarang" value="<?= htmlspecialchars($info_buku['pengarang']) ?>" placeholder="Pengarang" readonly>
  </div>
  <div class="mb-3">
    <label for="penerbit" class="form-label">Penerbit</label>
    <input type="text" class="form-control" name="penerbit" id="penerbit" value="<?= htmlspecialchars($info_buku['penerbit']) ?>" placeholder="Penerbit" readonly>
  </div>
  <div class="mb-3">
    <label for="genre" class="form-label">Genre</label>
    <input type="text" class="form-control" name="genre" id="genre" value="<?= htmlspecialchars($info_buku['genre']) ?>" placeholder="Genre" readonly>
  </div>
  <div class="mb-3">
    <label for="sinopsis" class="form-label">Sinopsis</label>
    <textarea type="text" class="form-control" name="sinopsis" id="sinopsis" placeholder="Sinopsis" readonly><?= htmlspecialchars($info_buku['sinopsis']) ?></textarea>
  </div>

  <div class="mb-3">
    <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
    <input type="date" class="form-control" name="tanggal_pinjam" id="tanggal_pinjam" placeholder="Tanggal Pinjam" required>
  </div>

  <div class="mb-3">
    <label for="tanggal_deadline" class="form-label">Tanggal Kembali</label>
    <input type="date" class="form-control" name="tanggal_deadline" id="tanggal_kembali" placeholder="Tanggal deadline" required>
  </div>

  <button type="submit" class="btn btn-primary" name="pinjamBukuSimple">Submit</button>
</div>
    </div>
    </form>
    <!-- end tambah buku -->
    <script>
         function logout(event, url) {
      event.preventDefault();
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