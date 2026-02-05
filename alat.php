
<?php
  session_start();
  include "../config/koneksi.php";
  if($_SESSION['level']!= 'admin'){
    header("location:../login.php");
    exit;
  }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>CRUD Alat</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>

<body class="bg-light">

<div class="container mt-4">

    <h4 class="mb-3">CRUD Alat</h4>

    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <form method="POST">

                <div class="mb-3">
                    <label class="form-label">Nama Alat</label>
                    <input type="text" name="nama alat"
                           class="form-control"
                           placeholder="Masukkan nama alat"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="kategori" class="form-control" required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Elektronik">Elektronik</option>
                        <option value="Alat Tulis">Alat Tulis</option>
                        <option value="Laboratorium">Laboratorium</option>
                        <option value="Olahraga">Olahraga</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Stok</label>
                    <input type="number" name="stok"
                           class="form-control"
                           placeholder="Masukkan jumlah stok"
                           min="0"
                           required>
                </div>

                 <div class="mb-3">
                    <label class="form-label">Kondisi</label>
                    <input type="text" name="kondisi"
                           class="form-control"
                           placeholder="Masukkan Kondisi"
                           min="0"
                           required>
                </div>

               

                <button name="tambah" class="btn btn-primary">
                    Tambah Alat
                </button>

                <a href="dashboard.php" class="btn btn-primary">back</a>

            </form>

        </div>
    </div>

    <!-- TABEL DATA ALAT -->
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th width="50">No</th>
                <th>Nama Alat</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Kondisi</th>
                <th width="150">Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
$no = 1;
$query = mysqli_query($koneksi, "
    SELECT alat.*, kategori.nama_kategori
    FROM alat 
    JOIN kategori ON alat.id_kategori = kategori.id_kategori
    ORDER BY id_alat DESC
");
while ($data = mysqli_fetch_assoc($query)) {
    ?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= $data['nama_alat']; ?></td>
        <td><?= $data['nama_kategori']; ?></td>
        <td><?= $data['stok']; ?></td>
        <!-- add other columns as needed -->
    </tr>
    <?php
}
?>
          <a href="edit.php?id=<?= $data['id_alat']; ?>" class="btn btn-warning btn-sm">Edit</a>
            <a href="delete.php?id=<?= $data['id_alat']; ?>" 
               class="btn btn-danger btn-sm"
               onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
        </td>
    </tr>
    <?php

?>
        </tbody>
    </table>

</div>

</body>
</html>
