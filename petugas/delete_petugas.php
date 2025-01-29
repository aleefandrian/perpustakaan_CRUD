<?php
require_once '../function.php';
$id_petugas = $_GET['id_petugas'];

if(deletePetugas($id_petugas) > 0){
    echo "<script>alert('Berhasil menghapus akun petugas');
    window.location.href = 'dashboard.php';
    </script>";
} else {
    echo "<script>alert('Gagal menghapus akun petugas');
    window.location.href = 'dashboard.php';
    </script>";
}
?>