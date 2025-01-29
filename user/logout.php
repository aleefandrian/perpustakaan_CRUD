<?php
session_start();

$_SESSION = [];
session_unset();
session_destroy();

echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <title>Logout</title>
</head>
<body>
    <script>
        Swal.fire({
            title: 'Berhasil!',
            text: 'Berhasil logout!',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '../index.html';
            }
        });
    </script>
</body>
</html>";
exit();
?>
