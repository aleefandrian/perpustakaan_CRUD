<?php
require_once '../function.php';
$id_user = $_GET['id_user'];

if(deleteUser($id_user) > 0){
    echo "<script>alert('Berhasil menghapus akun');
    window.location.href = 'dashboard.php';
    </script>";
} else {
    echo "<script>alert('Gagal menghapus akun');
    window.location.href = 'dashboard.php';
    </script>";
}
?>