<?php
session_start();
require_once '../function.php';
if (!isset($_SESSION['id_user'])) {
    $_SESSION['error'] = "Anda harus login terlebih dahulu.";
    header("Location: login_user.php");
    exit;
  }

  date_default_timezone_set('Asia/Jakarta');
  $waktu = date('d-m-Y H:i:s');
  
$username = $_SESSION['username']; 


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
    <title>Halaman histori peminjaman buku</title>
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

<section class="pt-4 mt-5 mb-4">
<div class="container">
          <div class="row mb-3">
            <div class="col-md-11">
          <p>Terakhir update : <?= $waktu ?></p>
          </div>
          
          <div class="col-md-1">
            <a href="refresh.php" class="btn btn-primary">Refresh</a>
          </div>
          </div>
    <div class="container">

    <div class="table-responsive shadow-lg p-3 mb-5 bg-body-tertiary rounded">
        
    <h2 class="text-bold text-center">Halaman histori peminjaman</h2>
<table class="table table-light border-primary text-center">
    <thead>
  <tr>
    <td>No</td>
    <td>Judul Buku</td>
    <td>Username</td>
    <td>Tanggal Pinjam</td>
    <td>Tanggal deadline</td>
    <td>Tanggal Kembali</td>
    <td>Denda</td>
   
    <td>Status buku</td>
    <td>Status bayar</td>

</tr>

  </thead>
  <?php 

  $search = isset($_GET['search']) ? $_GET['search'] : '';
  $id_user = $_SESSION['id_user'];
  if($search){
    $stmt = $conn->prepare("SELECT peminjaman.*, buku.judul, user.username 
    FROM peminjaman 
    INNER JOIN buku ON peminjaman.id_buku = buku.id_buku 
    INNER JOIN user ON peminjaman.id_user = user.id_user 
    WHERE judul LIKE ? OR tanggal_pinjam LIKE ? OR tanggal_deadline LIKE ?");
    $search_param = '%' . $search . '%';
    $stmt->bind_param("sss", $search_param, $search_param, $search_param);
    $stmt->execute();
  } else {
    $stmt = $conn->prepare("SELECT peminjaman.*, buku.judul, user.username 
    FROM peminjaman 
    INNER JOIN buku ON peminjaman.id_buku = buku.id_buku 
    INNER JOIN user ON peminjaman.id_user = user.id_user 
    WHERE peminjaman.id_user = ?");
    $stmt->bind_param("i", $id_user);
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
    <td><?= htmlspecialchars($data['judul'])  ?? '' ?></td>
    <td><?= htmlspecialchars($data['username'])  ?? '' ?></td>
    <td><?= htmlspecialchars($data['tanggal_pinjam'])  ?? '' ?></td>
    <td><?= htmlspecialchars($data['tanggal_deadline'])  ?? '' ?></td>
    <td><?= ($data['tanggal_kembali'])  ?? '' ?></td>
    <td>Rp. <?= intval($data['denda'])  ?? '' ?></td>
    
    <?php if($data['status_peminjaman'] === 'Belum Dikembalikan'){
      ?>
    <td><button class="btn btn-danger" disabled><?= htmlspecialchars($data['status_peminjaman'] )  ?? '' ?></button></td>
    <?php } elseif($data['status_peminjaman'] === 'Sudah Dikembalikan'){ 
      ?>
      <td><button class="btn btn-success" disabled><?= htmlspecialchars($data['status_peminjaman'] )  ?? '' ?></button></td>
      <?php }?>
    
      <?php if ($data['denda'] == 0) { ?>
    <td><button class="btn btn-success" disabled>Tidak ada denda</button></td>
<?php } else { 
    if ($data['status_bayar'] === 'Belum Dibayar') { ?>
        <td><button class="btn btn-danger" disabled><?= htmlspecialchars($data['status_bayar']) ?? '' ?></button></td>
    <?php } elseif ($data['status_bayar'] === 'Sudah Dibayar') { ?>
        <td><button class="btn btn-success" disabled><?= htmlspecialchars($data['status_bayar']) ?? '' ?></button></td>
    <?php }
} ?>


    </tr>
    </tbody>
  <?php 
            }
          } else { ?>
            <tr><td colspan="9" class="empty-book">Belum ada peminjaman buku</td></tr>
       <?php }?>
       </form> 
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