<?php
require_once '../function.php';
$id_buku = $_GET['id_buku'];

if(deleteBuku($id_buku) > 0){
    echo "<script>alert('Berhasil menghapus buku');
    window.location.href = 'dashboard.php';
    </script>";
} else {
    echo "<script>alert('Gagal menghapus buku');
    window.location.href = 'dashboard.php';
    </script>";
}
?>