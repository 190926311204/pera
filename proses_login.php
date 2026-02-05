
<?php
session_start();
include "config/koneksi.php";

$user = $_POST['username'] ?? '';
$pass = $_POST['password'] ?? '';

$user = mysqli_real_escape_string($koneksi, $user);
$pass = mysqli_real_escape_string($koneksi, $pass);

$_result = mysqli_query($koneksi, "
    SELECT * FROM user 
    WHERE username='$user' AND password='$pass'
");

$data = mysqli_fetch_assoc($_result);

if ($data) {

    $_SESSION['id_user'] = $data['id_user'];
    $_SESSION['level'] = $data['level'];


    if ($data['level'] == 'admin') {
        header("Location: admin/dashboard.php");
        exit;
    } elseif ($data['level'] == 'petugas') {
        header("Location: petugas/dashboard.php");
        exit;
    } elseif ($data['level'] == 'peminjam') {
        header("Location: peminjam/dashboard.php");
        exit;
    } else {
        echo "Level user tidak dikenal.";
        exit;
    }
} else {
    echo "<script>
    alert('Login Gagal! Username atau Password salah');
    window.location='login.php';
    </script>";
    exit;
}
?>
