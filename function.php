<?php
$conn = mysqli_connect("localhost", "root", "", "projek_perpustakaan");


// fungsi yang berhubungan dengan petugas
// start registrasi petugas
function registrasiPetugas($data) {
    global $conn;

    $username = htmlspecialchars( $data['username']);
    $email = htmlspecialchars($data['email']);
    $no_hp = htmlspecialchars($data['no_hp']);
    $password = mysqli_real_escape_string($conn, $data["password"]);

    $result = mysqli_query($conn, "SELECT username FROM petugas WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
        Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Username sudah digunakan, mohon pilih username lain!',
        confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                window.location.href = 'registrasi_petugas.php';
            }
            });</script>";
        return false;
    }
        $password = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("INSERT INTO petugas (username, email, no_hp, password) VALUES (?,?,?,?)");
        $stmt->bind_param("ssss", $username, $email, $no_hp, $password);

        if ($stmt->execute()) {
            echo "<script>
            Swal.fire({
                title: 'Berhasil!',
                text: 'Berhasil mendaftarkan akun, tunggu admin menyetujuinya!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'login_petugas.php';
                }
            });</script>";
            exit();
        }
}
// end registrasi petugas


// start tambah petugas
function tambahPetugas($data) {
    global $conn;

    $username = htmlspecialchars( $data['username']);
    $email = htmlspecialchars($data['email']);
    $no_hp = htmlspecialchars($data['no_hp']);
    $status = htmlspecialchars($data['status']);
    $password = mysqli_real_escape_string($conn, $data["password"]);

    $result = mysqli_query($conn, "SELECT username FROM petugas WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
        Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Username sudah digunakan, mohon pilih username lain!',
        confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                window.location.href = 'tambah_petugas.php';
            }
            });</script>";
            return false;
    }
        $password = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("INSERT INTO petugas (username, email, no_hp, password, status) VALUES (?,?,?,?, ?)");
        $stmt->bind_param("sssss", $username, $email, $no_hp, $password, $status);

        if ($stmt->execute()) {
            echo "<script>
            Swal.fire({
                title: 'Berhasil!',
                text: 'Berhasil menambahkan petugas!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'data_petugas.php';
                }
            });</script>";
            exit();
        }
}
// end tambah petugas

// start aktifkan akun petugas
function aktifPetugas ($data){
    global $conn;
    $id_petugas = htmlspecialchars($data['id_petugas']);
    $stmt = $conn->prepare("UPDATE petugas SET status = 'Aktif' WHERE id_petugas = ?");
    $stmt->bind_param("i", $id_petugas);
    
    if ($stmt->execute()) {
        echo "<script>
            Swal.fire({
                title: 'Berhasil!',
                text: 'Berhasil mengaktifkan petugas!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'data_petugas.php';
                }
            });</script>";
            exit();
    } else {
        echo "Error: " . $conn->error;
    }
    
}
// end aktifkan akun petugas

// start nonakttif akun petugas
function nonaktifPetugas($data){
    global $conn;
    $id_petugas = htmlspecialchars($data['id_petugas']);
    $stmt = $conn->prepare("UPDATE petugas SET status = 'Tidak Aktif' WHERE id_petugas = ?");
    $stmt->bind_param("i", $id_petugas);
    
    if ($stmt->execute()) {
        echo "<script>
        Swal.fire({
            title: 'Berhasil!',
            text: 'Berhasil menonaktifkan petugas!',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'data_petugas.php';
            }
        });</script>";
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
// end nonaktif akun petugas

// start hapus petugas
function deletePetugas($data){
    global $conn;

    $id_petugas = $_GET['id_petugas'];
    if (is_numeric($id_petugas)) {
        $stmt = "DELETE FROM petugas WHERE id_petugas = $id_petugas";

        if ($conn->query($stmt) === TRUE) {
            echo "<script>
            Swal.fire({
                title: 'Berhasil!',
                text: 'Berhasil menghapus petugas!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'data_petugas.php';
                }
            });</script>";
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "<script>
        Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Id petugas tidak valid!',
        confirmButtonText: 'OK'
                }).then((result) => {
                if (result.isConfirmed) {
                window.location.href = 'data_petugas.php';
                }
        });</script>";
    }
}
// end hapus petugas

// start edit petugas
function editPetugas($data){
    global $conn;

    $id_petugas = $_GET['id_petugas'];
    $username = htmlspecialchars($data['username']);
    $email = htmlspecialchars($data['email']);
    $no_hp = htmlspecialchars($data['no_hp']);
    $status = htmlspecialchars($data['status']);

    $stmt = $conn->prepare("UPDATE petugas SET username = ?, email = ?, no_hp = ?, status = ? WHERE id_petugas = ?");
    $stmt->bind_param("ssssi", $username, $email, $no_hp, $status, $id_petugas);

    if ($stmt->execute()) {
        echo "<script>
            Swal.fire({
                title: 'Berhasil!',
                text: 'Berhasil mengedit akun petugas!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'data_petugas.php';
                }
            });</script>";
            exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
// end edit petugas

// fungsi yang berhubungan dengan buku
// start tambah buku
function tambahBuku($data){
    global $conn;

    $judul = htmlspecialchars($data['judul']);
    $pengarang = htmlspecialchars($data['pengarang']);
    $penerbit = htmlspecialchars($data['penerbit']);
    $sinopsis = htmlspecialchars($data['sinopsis']);
    $genre = htmlspecialchars($data['genre']);
    $stok = intval($data['stok_buku']);
    $gambar = $_FILES['gambar'];

    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === 0) {
        $gambar = time() . "_" . basename($_FILES['gambar']['name']); 
        $upload_dir = "../img/";

        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        if (!move_uploaded_file($_FILES['gambar']['tmp_name'], $upload_dir . $gambar)) {
            echo "<script>
            Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Gagal mengupload gambar!',
            confirmButtonText: 'OK'
                    }).then((result) => {
                    if (result.isConfirmed) {
                    window.location.href = 'data_petugas.php';
                    }
            });</script>";
            exit;
        }
    }

    $stmt = $conn->prepare("INSERT INTO buku (judul, pengarang, penerbit, genre, sinopsis, gambar, stok_buku) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssi", $judul, $pengarang, $penerbit, $genre, $sinopsis, $gambar, $stok);


    if($stmt->execute()){
        echo "<script>
            Swal.fire({
                title: 'Berhasil!',
                text: 'Berhasil menambahkan buku!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'dashboard.php';
                }
            });</script>";
            exit();
    } else {
        echo "<script>
        Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Gagal menambahkan buku',
        confirmButtonText: 'OK'
                }).then((result) => {
                if (result.isConfirmed) {
                window.location.href = 'tambah_buku.php';
                }
        });</script>";
        exit;
    }
    $stmt->close();
}
// end tambah buku

// start edit buku
function editBuku($data){
    global $conn;

    
if (!isset($_GET['id_buku']) || !$id_buku = intval($_GET['id_buku'])) {
    echo "ID Buku tidak valid!";
    exit();
}
    $judul = htmlspecialchars($data['judul']);
    $pengarang = htmlspecialchars($data['pengarang']);
    $penerbit = htmlspecialchars($data['penerbit']);
    $sinopsis = htmlspecialchars($data['sinopsis']);
    $genre = htmlspecialchars($data['genre']);
    $stok = intval($data['stok_buku']);
    $gambar = $_FILES['gambar']['name'] ?? '';


    if (!isset($_GET['id_buku']) || !$id_buku = intval($_GET['id_buku'])) {
        echo "<script>
        Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Id buku tidak valid',
        confirmButtonText: 'OK'
                }).then((result) => {
                if (result.isConfirmed) {
                window.location.href = 'dashboard.php';
                }
        });</script>";
        exit();
    }
    if ($gambar) {
        $target_dir = "../img/";
        $target_file = $target_dir . basename($gambar);

        if (!move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
            echo "Lampiran gagal diupload!";
            exit();
        }  
        $stmt = $conn->prepare("UPDATE buku SET judul = ?, pengarang = ?, penerbit = ?, genre = ?, sinopsis = ?, gambar = ?, stok_buku = ? WHERE id_buku = ?");
        $stmt->bind_param("ssssssii", $judul, $pengarang, $penerbit, $genre, $sinopsis, $gambar, $stok, $id_buku);
    } else {
        $sql = "UPDATE buku SET judul = ?, pengarang = ?, penerbit = ?, genre = ?, sinopsis = ?, stok_buku = ? WHERE id_buku = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssii", $judul, $pengarang, $penerbit, $genre, $sinopsis, $stok, $id_buku);
    }
    if ($stmt->execute()) {
        echo "<script>
            Swal.fire({
                title: 'Berhasil!',
                text: 'Berhasil mengedit buku!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'dashboard.php';
                }
            });
        </script>";
        exit();
    } else {
        echo "Error: " . $conn->error;
    }

}
// end edit buku

// start hapus buku
function deleteBuku($data){
    global $conn;

    $id_buku = $_GET['id_buku'];
    if (is_numeric($id_buku)) {
        $stmt = "DELETE FROM buku WHERE id_buku = $id_buku";

        if ($conn->query($stmt) === TRUE) {
            $_SESSION['hapus'] = "Data buku berhasil dihapus!";
            echo "<script>
            Swal.fire({
                title: 'Berhasil!',
                text: 'Berhasil menghapus buku!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'dashboard.php';
                }
            });
        </script>";
        exit();
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "<script>
        Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Id buku tidak valid',
        confirmButtonText: 'OK'
                }).then((result) => {
                if (result.isConfirmed) {
                window.location.href = 'dashboard.php';
                }
        });</script>";
    }
}
// end hapus buku


// fungsi yang berhubungan dengan user book lovers
// start hapus user
function deleteUser($data){
    global $conn;

    $id_user = $_GET['id_user'];
    if (is_numeric($id_user)) {
        $stmt = "DELETE FROM user WHERE id_user = $id_user";

        if ($conn->query($stmt) === TRUE) {
            echo "<script>
            Swal.fire({
                title: 'Berhasil!',
                text: 'Berhasil menghapus akun!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'dashboard.php';
                }
            });
        </script>";
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "<script>
        Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Id user tidak valid',
        confirmButtonText: 'OK'
                }).then((result) => {
                if (result.isConfirmed) {
                window.location.href = 'dashboard.php';
                }
        });</script>"; exit();
        
    }
}
// end hapus user

// start edit user
function editUser($data){
    global $conn;

    $id_user = $_GET['id_user'];
    $username = htmlspecialchars($data['username']);
    $email = htmlspecialchars($data['email']);
    $no_hp = htmlspecialchars($data['no_hp']);

    $stmt = $conn->prepare("UPDATE user SET username = ?, email = ?, no_hp = ? WHERE id_user = ?");
    $stmt->bind_param("sssi", $username, $email, $no_hp, $id_user);

    if ($stmt->execute()) {
        echo "<script>
            Swal.fire({
                title: 'Berhasil!',
                text: 'Berhasil mengedit user!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'data_user.php';
                }
            });
        </script>";
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
// end edit user

// start registrasi book lovers
function registrasiU($data) {
    global $conn;

    $username = htmlspecialchars($data['username']);
    $email = htmlspecialchars($data['email']);
    $no_hp = htmlspecialchars($data['no_hp']);
    $password = mysqli_real_escape_string($conn, $data["password"]);

    $sql = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
    if (mysqli_fetch_assoc($sql)) {
        echo "<script>
        Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Username sudah digunakan, mohon pilih username lain!',
        confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                window.location.href = 'registrasi_user.php';
            }
            });</script>";
        return false;
    }
        $password = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("INSERT INTO user (username, email, no_hp, password) VALUES (?,?,?,?)");
        $stmt->bind_param("ssss", $username, $email, $no_hp, $password);

    if ($stmt->execute()) {
        echo "<script>
            Swal.fire({
                title: 'Berhasil!',
                text: 'Berhasil mendaftarkan akun!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'login_user.php';
                }
            });</script>";
            exit();
    }
}
// end registrasi book lovers

// start tambah book lovers
function tambahUser($data) {
    global $conn;

    $username = htmlspecialchars($data['username']);
    $email = htmlspecialchars($data['email']);
    $no_hp = htmlspecialchars($data['no_hp']);
    $password = mysqli_real_escape_string($conn, $data["password"]);

    $sql = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
    if (mysqli_fetch_assoc($sql)) {
        echo "<script>
        Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Username sudah digunakan, mohon pilih username lain!',
        confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                window.location.href = 'tambah_user.php';
            }
            });</script>";
            return false;
    }
        $password = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("INSERT INTO user (username, email, no_hp, password) VALUES (?,?,?,?)");
        $stmt->bind_param("ssss", $username, $email, $no_hp, $password);

    if ($stmt->execute()) {
        echo "<script>
        Swal.fire({
            title: 'Berhasil!',
            text: 'Berhasil menambahkan akun!',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'data_user.php';
            }
        });</script>";
        exit();
    }
}
// end tambah book lovers

// start pinjam buku
function pinjamBuku($data){
    global $conn;    
    $id_buku =$_GET['id_buku'];
    $cek_stok = $conn->prepare("SELECT stok_buku FROM buku WHERE id_buku = ?");
    $cek_stok->bind_param("i", $id_buku);
    $cek_stok->execute();
    $cek_stok->store_result();
    $cek_stok->bind_result($stok);
    $cek_stok->fetch();

    if($stok > 0){
        $update_stok = $conn->prepare("UPDATE buku SET stok_buku = stok_buku - 1 WHERE id_buku = ?");
        $update_stok->bind_param("i", $id_buku);

        if($update_stok->execute()){
            $update_stok->close();

            $tanggal_pinjam = $_POST['tanggal_pinjam'] ?? '';
            $tanggal_deadline = $_POST['tanggal_deadline'] ?? '';
        
            $stmt = $conn->prepare("INSERT INTO peminjaman (id_user, id_buku, tanggal_pinjam, tanggal_deadline) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("iiss", $_SESSION['id_user'], $id_buku, $tanggal_pinjam, $tanggal_deadline);
        
            if ($stmt->execute()) {
                echo "<script>
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Berhasil meminjam buku!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'histori_pinjam.php';
                    }
                });</script>";
                exit();
            } else {
                echo "<script>
                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Gagal meminjam buku!',
                confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                        window.location.href = 'dashboard_simple.php';
                    }
                    });</script>";
            }
        } 
        } else {
            echo "<script>
            Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Buku habis, mohon tunggu buku restock lagi yahhh!',
            confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                    window.location.href = 'dashboard_simple.php';
                }
                });</script>";
        }
        
}

// end pinjam buku

// start pinjam buku simple
function pinjamBukuSimple($data){
    global $conn;    
    $id_buku =$_GET['id_buku'];
    $cek_stok = $conn->prepare("SELECT stok_buku FROM buku WHERE id_buku = ?");
    $cek_stok->bind_param("i", $id_buku);
    $cek_stok->execute();
    $cek_stok->store_result();
    $cek_stok->bind_result($stok);
    $cek_stok->fetch();

    if($stok > 0){
        $update_stok = $conn->prepare("UPDATE buku SET stok_buku = stok_buku - 1 WHERE id_buku = ?");
        $update_stok->bind_param("i", $id_buku);

        if($update_stok->execute()){
            $update_stok->close();

            $tanggal_pinjam = $_POST['tanggal_pinjam'] ?? '';
            $tanggal_deadline = $_POST['tanggal_deadline'] ?? '';
        
            $stmt = $conn->prepare("INSERT INTO peminjaman (id_user, id_buku, tanggal_pinjam, tanggal_deadline) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("iiss", $_SESSION['id_user'], $id_buku, $tanggal_pinjam, $tanggal_deadline);
        
            if ($stmt->execute()) {
                echo "<script>
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Berhasil meminjam buku!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'histori_pinjam.php';
                    }
                });</script>";
                exit();
            } else {
                echo "<script>
                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Gagal meminjam buku!',
                confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                        window.location.href = 'dashboard.php';
                    }
                    });</script>";
            }
        } 
        } else {
            echo "<script>
            Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Buku habis, mohon tunggu buku restock lagi yahhh!',
            confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                    window.location.href = 'dashboard.php';
                }
                });</script>";
        }
        
}
// end pinjam buku simple

// start konfirmasi pengembalian buku
function kembaliBuku($data){
    global $conn;
    $id_pinjam = $_POST['id_pinjam'];
    $id_buku =$_POST['id_buku'];
    $tanggal_kembali = date('Y-m-d');
    $deadline = new DateTime($_POST['tanggal_deadline']);
    $tanggal_kembali_buku = new DateTime($tanggal_kembali);
    $selisih = $deadline->diff($tanggal_kembali_buku)->days;
    $denda = 0;
    if($tanggal_kembali_buku > $deadline){
        $denda = $selisih * 1000;
    }
    $stmt = $conn->prepare("UPDATE peminjaman SET status_peminjaman = 'Sudah Dikembalikan', tanggal_kembali = ?, denda = ? WHERE id_pinjam = ?");
    $stmt->bind_param("sii", $tanggal_kembali, $denda, $id_pinjam);


    if($stmt->execute()){
        $update_stok = $conn->prepare("UPDATE buku SET stok_buku = stok_buku + 1 WHERE id_buku = ?");
        $update_stok->bind_param("i", $id_buku);
        if($update_stok->execute()){
        echo "<script>
        Swal.fire({
            title: 'Berhasil!',
            text: 'Berhasil!',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'data_pinjam.php';
            }
        });</script>";
        exit();
        }
    } else {
        echo "<script>
        Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Gagal!',
        confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                window.location.href = 'data_pinjam.php';
            }
            });</script>";
        }
}
// end pengembalian buku

function bayarDenda($data){
    global $conn;
    $id_pinjam = $_POST['id_pinjam'];
    $stmt = $conn->prepare("UPDATE peminjaman SET status_bayar = 'Sudah Dibayar' WHERE id_pinjam = ?");
    $stmt->bind_param("i", $id_pinjam);


    if($stmt->execute()){
        echo "<script>
        Swal.fire({
            title: 'Berhasil!',
            text: 'Berhasil!',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'data_pinjam.php';
            }
        });</script>";
        exit();
    } else{
        echo "<script>
        Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Gagal!',
        confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                window.location.href = 'data_pinjam.php';
            }
            });</script>";}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>