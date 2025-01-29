<?php
session_start();
require_once '../function.php';
if (!isset($_SESSION['id_user'])) {
    $_SESSION['error'] = "Anda harus login terlebih dahulu.";
    header("Location: login_user.php");
    exit;
  }

  
$username = $_SESSION['username']; 

 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
    <title>Halaman data akun user</title>
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

<section class="pt-4 mt-5 mb-4">
          <div class="container">
      
          <div class="shadow-lg p-3 mb-5 bg-body-tertiary rounded">
              
          <h2 class="text-bold text-center">Peraturan peminjaman buku</h2>
      <table class="table table-light border-primary text-center">
        <tbody>
          <tr class="mt-2">
          <td>
          <strong>1. Jam Operasional Perpustakaan</strong>
              <br>-Buka: 08.00 pagi
              <br>-Tutup: 22.00 malam
      </td>
          </tr>
          
          <tr class="mt-2">
          <td>
          <strong>2. Pengembalian Buku</strong>
              <br>-Buku harus dikembalikan paling lambat pada tanggal yang telah ditentukan.
              <br>-Buku yang dikembalikan melewati batas waktu akan dikenakan denda Rp1.000 per hari per buku.
              <br>-Anggota yang memiliki denda lebih dari Rp100.000 tidak diizinkan meminjam buku sebelum melunasi denda tersebut.
      </td>
          </tr>
          <tr>
              <td>
              <strong>3. Perawatan Buku</strong>
              <br>-Anggota wajib menjaga buku yang dipinjam agar tetap dalam kondisi baik.
              <br>-Buku yang rusak atau hilang harus diganti dengan buku serupa atau membayar biaya sesuai harga buku.
              </td>
          </tr>
          <tr>
              <td>
              <strong>4. Tata Tertib di Perpustakaan</strong>
                  <br>-Dilarang makan, minum, atau membuat keributan di dalam perpustakaan.
                  <br>-Barang bawaan seperti tas dan jaket wajib dititipkan di tempat yang telah disediakan.
                  <br>-Pengguna perpustakaan diminta menjaga kebersihan dan kerapihan.
              </td>
          </tr>
          <tr>
            <td>
            <strong>5. Keanggotaan</strong>
                  <br>-Hanya anggota perpustakaan yang dapat meminjam buku.
                  <br>-Kartu anggota wajib ditunjukkan setiap kali melakukan peminjaman.
                  <br>
                  <strong>Peraturan ini dibuat untuk kenyamanan bersama dan berlaku efektif mulai [tanggal dibuat].
                  Terima kasih atas kerja samanya!</strong>
            </td>
          </tr>
        </tbody>
        
      </table>
          </div>
      </div>
      </section>
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