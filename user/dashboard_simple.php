<?php
session_start();
include '../function.php';
if (!isset($_SESSION['id_user'])) {
  $_SESSION['error'] = "Anda harus login terlebih dahulu.";
  header("Location: login_user.php");
  exit;
}

date_default_timezone_set('Asia/Jakarta');
$waktu = date('d-m-Y H:i:s');

$username = $_SESSION['username']; 



$search = isset($_GET['search']) ? $_GET['search'] : '';
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$items_per_page = 20;
$offset = ($page - 1) * $items_per_page;

if ($search) {
    $stmt = $conn->prepare("SELECT * FROM buku WHERE `judul` LIKE ? OR `genre` LIKE ? OR `pengarang` LIKE ? OR `penerbit` LIKE ? LIMIT ? OFFSET ?");
    $search_param = '%' . $search . '%';
    $stmt->bind_param("ssssii", $search_param, $search_param, $search_param, $search_param, $items_per_page, $offset);

    $total_stmt = $conn->prepare("SELECT COUNT(*) as total FROM buku WHERE `judul` LIKE ? OR `genre` LIKE ? OR `pengarang` LIKE ? OR `penerbit` LIKE ?");
    $total_stmt->bind_param("ssss", $search_param, $search_param, $search_param, $search_param);
} else {
    $stmt = $conn->prepare("SELECT * FROM buku LIMIT ? OFFSET ?");
    $stmt->bind_param("ii", $items_per_page, $offset);

    $total_stmt = $conn->prepare("SELECT COUNT(*) as total FROM buku");
}

$stmt->execute();
$result = $stmt->get_result();

$total_stmt->execute();
$total_result = $total_stmt->get_result();
$total_data = $total_result->fetch_assoc()['total'];
$total_pages = ceil($total_data / $items_per_page);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
    <title>Halaman dashboard Librarian</title>
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

<!-- start data buku -->
      <section class="mt-5 pt-4 mb-4">
        <div class="container">
          <div class="row mb-3">
            <div class="col-md-11">
          <p>Terakhir update : <?= $waktu ?></p>
          </div>
          
          <div class="col-md-1">
            <a href="refresh.php" class="btn btn-primary">Refresh</a>
          </div>
          </div>
        </div>

          <!-- start pagination -->
       <div class="centered">
      <div class="center-page">
        <nav aria-label="Page navigation example">
            <ul class="pagination m-2">
                <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $page - 1 ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
                
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
                
                <?php if ($page < $total_pages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $page + 1 ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
    </div>
    <!-- end pagination -->
    <div class="container my-3">
    <div class="shadow-lg p-3 mb-5 bg-body-tertiary rounded">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-5 g-3">
            <?php if ($result->num_rows > 0) :
                while ($data = $result->fetch_assoc()) :
                    $gambar = $data['gambar'] 
                        ? "<img src='../img/" . htmlspecialchars($data['gambar']) . "' style='width: 100%; height: auto; border-radius: 5px;'>"
                        : "Tidak ada gambar";
                    ?>
                    <div class="col">
                        <div class="card h-100 shadow-sm" style="padding: 10px; max-width: 200px; margin: auto;">
                        <a href="" onclick="ajukanPinjam(event, 'pinjam_buku_simple.php?id_buku=<?=htmlspecialchars($data['id_buku'] ?? '')?>')">
                                <?= $gambar ?>
                            </a>
                        </div>
                    </div>
                <?php endwhile;
            else : ?>
                <script>
                    alert('Buku yang anda cari tidak ada');
                    window.location.href = 'dashboard.php';
                </script>
            <?php endif; ?>
        </div>
    </div>
</div>


      </section>
      <!-- end data buku -->

      <!-- start pagination -->
       <div class="centered">
      <div class="center-page">
        <nav aria-label="Page navigation example">
            <ul class="pagination m-2">
                <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $page - 1 ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
                
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
                
                <?php if ($page < $total_pages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $page + 1 ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
    </div>
    <!-- end pagination -->
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
function ajukanPinjam(event, url) {
  event.preventDefault();
    Swal.fire({
      title: "Apakah anda sudah membaca peraturan dan ketentuan perpustakaan??",
      text: "Mohon untuk mena'ati peraturan yang ada!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, Saya sudah baca!"
    }).then((result) => {
      if (result.isConfirmed) {
        
         window.location.href = url;
      }
    });}
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>