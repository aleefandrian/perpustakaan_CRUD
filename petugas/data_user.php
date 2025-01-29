<?php
session_start();
require_once '../function.php';
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

date_default_timezone_set('Asia/Jakarta');
$waktu = date('d-m-Y H:i:s');

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

<section class="pt-4 mt-5 mb-4">
<div class="container">
          <div class="row mb-3">
            <div class="col-md-11">
          <p>Terakhir update : <?= $waktu?></p>
          </div>
          
          <div class="col-md-1">
            <a href="refresh.php" class="btn btn-primary">Refresh</a>
          </div>
          </div>
        </div>
    <div class="container">

    <div class="table-responsive shadow-lg p-3 mb-5 bg-body-tertiary rounded">
        
    <h2 class="text-bold text-center">Halaman data akun</h2>
<table class="table table-light border-primary text-center">
    <thead>
  <tr>
    <td>No</td>
    <td>id_user</td>
    <td>Username</td>
    <td>Email</td>
    <td>No Handphone</td>
    <td>Aksi</td>
</tr>

  </thead>
  <?php 

  $search = isset($_GET['search']) ? $_GET['search'] : '';

  if($search){
    $stmt = $conn->prepare("SELECT * FROM user WHERE username LIKE ? OR email LIKE ? OR no_hp LIKE ? OR id_user LIKE ?");
    $search_param = '%' . $search . '%';
    $stmt->bind_param("sssi", $search_param, $search_param, $search_param, $search_param);
    $stmt->execute();
  } else {
    $stmt = $conn->prepare("SELECT * FROM user ORDER BY id_user ASC");
    $stmt->execute();
  }
  
  $result = $stmt->get_result();
  $angka = 1;

  if($result->num_rows > 0){
            while($data = $result->fetch_assoc()){

     ?>

     
<form action="" method="post">
  <tbody>
    <tr class="mt-2">
    <td><?= $angka++ ?></td>
    <td><?= htmlspecialchars($data['id_user'])  ?? '' ?></td>
    <td><?= htmlspecialchars($data['username'])  ?? '' ?></td>
    <td><?= htmlspecialchars($data['email'])  ?? '' ?></td>
    <td><?= htmlspecialchars($data['no_hp'])  ?? '' ?></td>
    
    <td>
   
    <a href="edit_user.php?id_user=<?=  htmlspecialchars($data['id_user'])  ?>" class="btn btn-primary" >Edit</a>
      <a href="#" class="btn btn-danger" onclick="hapusPengguna('delete_user.php?id_user=<?=  htmlspecialchars($data['id_user'])  ?>')">Hapus</a>
    </td>
     </form>
    </tr>
  </tbody>
  <?php 
            }
          } else { ?>
            <tr><td colspan="7" class="empty-book">Belum ada peminjaman buku</td></tr>;
       <?php } ?>
</table>
    </div>
</div>
</section>
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
    function hapusPengguna(url) {
    Swal.fire({
      title: "Apakah anda yakin?",
      text: "Data yang dihapus tidak dapat dikembalikan!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, Hapus!"
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