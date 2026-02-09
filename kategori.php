Kategori.php
<?php
 session_start();

 include "../config/koneksi.php";

 if($_SESSION['level']!= 'admin') {
    header("location:../login.php");
    exit;
 }

 //fungsi tambah kategori

 if(isset($_POST['tambah'])) {
    $nama_kategori = $_POST['nama_kategori'];

    //cek data berhasil disimpan
    $data = mysqli_query($koneksi,)
    INSERT INTO kategori (nama_kategori)
    VALUES ('$nama_kategori')
    ");

    echo"<script>
    alert('Kategori Behasil Disimpan');
    window.location='kategori.php';
    </script>;

    
 }

 //fungsi hapus

 if(isset($_GET['hapus'])) {

 $id = $_GET['hapus'];
 mysqli_query($koneksi, "DELETE FROM kategori WHERE id_kategori='$id'");
      echo"<script>
    alert('Kategori Behasil Dihapus');
    window.location='kategori.php';
    </script>;
 }

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>CRUD Kategori</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>

<body class="bg-light">

<div class="container mt-4">

    <h4 class="mb-3">CRUD Kategori</h4>

    <!-- FORM TAMBAH KATEGORI -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <form method="POST">

                <div class="mb-3">
                    <label class="form-label">Nama Kategori</label>
                    <input type="text" name="nama_kategori"
                           class="form-control"
                           placeholder="Masukkan nama kategori"
                           required>
                </div>

                <button name="tambah" class="btn btn-primary">
                    Tambah Kategori
                </button>

                <a href="dashboard.php" class="btn btn-primary">back</a>

            </form>

        </div>
    </div>

    <!-- TABEL DATA KATEGORI -->
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th width="50">No</th>
                <th>Nama Kategori</th>
                <th width="150">Aksi</th>
            </tr>
        </thead>
        <tbody>
<?php

   $no = 1;
   $query = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY id_kategori DESC");
   while($data = mysqli_fetch_assoc($query)) {

   

?>
            <tr>
                <td><?= $no++;?></td>
                <td><?= $data['nama_kategori'];?></td>
                <td>
                    <a href="edit_kategori.php?id=<?= $data['id_kategori'];?>"
                       class="btn btn-warning btn-sm">
                        Edit
                    </a>
                    <a href="kategori.php?hapus=<?= $data['id_kategori'];?>"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                        Hapus
                    </a>
                </td>
            </tr>

<?php }
        </tbody>
    </table>

</div>

</body>
</html>
