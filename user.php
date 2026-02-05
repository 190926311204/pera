<?php
session_start();
include "../config/koneksi.php";
if($_SESSION['level'] != 'admin'){
    header("location:../login.php");
    exit;
}


//fungsi tambah data

if(isset($_POST['tambah'])){
  $nama = $_POST['nama'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $level= $_POST['level'];

  //cek data berhasil disimpan
  $data = mysqli_query($koneksi, "
  INSERT INTO user(nama, username, password, level)
  VALUES ('$nama', '$username', '$password', '$level')");

  echo "<script>
  alert('User berhasil ditambahkan');
  window.location='user.php';
  </script>";

}

//fungsi hapus data
if(isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM user WHERE id_user='$id'");
   
    echo "<script>
  alert('User berhasil dihapus');
  window.location='user.php';
  </script>";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>CRUD User</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-4">
    <h4 class="mb-3">CRUD User</h4>

    <!-- FORM TAMBAH USER -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="POST">

                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="nama"
                           class="form-control"
                           placeholder="Masukkan nama"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username"
                           class="form-control"
                           placeholder="Masukkan username"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password"
                           class="form-control"
                           placeholder="Masukkan password"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Level</label>
                    <select name="level" class="form-control" required>
                        <option value="">-- Pilih Level --</option>
                        <option value="admin">Admin</option>
                        <option value="petugas">Petugas</option>
                        <option value="peminjam">Peminjam</option>
                    </select>
                </div>

                <button name="tambah" class="btn btn-primary">
                    Tambah User
                </button>

                <a href="dashboard.php" class="btn btn-primary">back</a>

            </form>
        </div>
    </div>

    <!-- TABEL USER -->
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th width="50">No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Level</th>
                <th width="150">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $query = mysqli_query($koneksi, "SELECT * FROM user ORDER BY id_user DESC");
            while($data=mysqli_fetch_assoc($query)){
           ?>

            <tr>
                <td><?= $no++;?></td>
                <td><?= $data['nama'];?></td>
                <td><?= $data['username'];?></td>
                <td><?= $data['level'];?></td>
                <td>
                    <a href="edit_user.php?id=<?= $data['id_user'];?>" class="btn btn-warning btn-sm">
                        Edit
                    </a>
                    <a href="user.php?hapus=<?= $data['id_user'];?>"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Yakin ingin menghapus data ini?')">
                        Hapus
                    </a>
                </td>
            </tr>
          <?php } ?> 
        </tbody>
    </table>

</div>

</body>
</html>
