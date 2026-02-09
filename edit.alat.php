Edit alat.php
<?php
  session_start();
  include "../config/koneksi.php";
  if($_SESSION['level']!= 'admin'){
    header("location:../login.php");
    exit;
  }
// ambil data id
$id = $_GET [ ' id '] ;
$query = mysqli_query( $koneksi ,  "
SELECT * FROM alat WHERE id_alat = ' $id' " ) ;

$tampil = mysqli_ fetch_assoc($query) ;

// Fungsi edit 
If ( isset ($_POST[ ' update '] ) )  {
  $nama_ alat = $_POST['nama_alat'] ;
  $kategori = $_POST['kategori'] ;
  $stok= $_POST['stok'] ;
  $kondisi = $_POST['kondisi] ;

$ data = mysqli_ query ( $ koneksi , "
      UPDATE alat SET
nama_ alat = ' $ nama_alat ' ,
Id_ kategori = '$kategori' ,
Stok = ' stok' ,
Kondisi = ' kondisi ' 
WHERE id _alat ='$ id'
") ;
If($ data) {
echo" <script>"
alert(' data berhasil di update');
window.location= ' alat.php' ;
</script> " ;

}


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

    <h4 class="mb-3">edit Alat</h4>

    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <form method="POST">

                <div class="mb-3">
                    <label class="form-label">Nama Alat</label>
                    <input type="text" name="nama alat"
                           class="form-control"   placeholder="Masukkan nama alat" value= "<? = $tampil [' nama_alat'] ; ?>" 
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kategori</label>      <select name="kategori" class="form-control" required>
    <option value="">-- Pilih Kategori --</option>
        <?php
$ kategori = mysqli_query($ koneksi, "SELECT * FROM kategori");
while($ data  = mysqli_ fetch_ assoc ($ kategori)) {

$ selected = ($ data [ ' nama_kategori '] == $tampil [ ' id_ kategori '] ) ? " selected" : " " ;
?>
<option value ="<?=$data[' id_ kategori'] ;"?> " <?= $selected; ?> >
<? = $data [' nama_kategori' ];?>
</option>
<?phh } ?>
                 </select>
              </div>

                <div class="mb-3">
                    <label class="form-label">Stok</label>
         <input type="number" name="stok        class="form-control"
               placeholder="Masukkan jumlah stok" value= "<? = $tampil [' stok'] ; ?>"      min="0"
             required>
                </div>

                 <div class="mb-3">
                    <label class="form-label">Kondisi</label>
                    <input type="text" name="kondisi"
              class="form-control"
            placeholder="Masukkan Kondisi"value= "<? = $tampil [' kondisi '] ; ?>" 
                     min="0"
                    required>
                </div>


         <button name="update" class="btn btn-primary">
          Ubah Alat     </button>
<a href="dashboard.php" class="btn btn-primary">back</a>
            </form>
        </div>
    </div>
