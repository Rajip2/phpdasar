<?php 

session_start();

if ( !isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}
require 'Functions.php';
$id = $_GET["id"];
$mbl = query("SELECT * FROM mobilsport WHERE id = $id")[0];
if (isset($_POST["submit"])){
  if( ubah($_POST) > 0 ){
    echo "
          <script>
          alert ('Data Berhasil Diubah!');
          document.location.href = 'Index.php';
          </script>";
  }else{
    echo "<script>
          alert ('Data Gagal Diubah!');
          document.location.href = 'Index.php';
          </script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Tambah Data</title>
</head>
<body>
  <h1>Ubah Data Mobil</h1>
  <form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $mbl["id"]; ?>">
    <input type="hidden" name="gambarLama" value="<?= $mbl["gambar"]; ?>">
    <ul>
      <li><label for="nmrmbil">Nomor Kendaraan :</label>
        <input type="text" name="nmrmbil" id="nmrmbil"required value="<?= $mbl["nmrmbil"]; ?>"></li>
      <li><label for="nama">Nama Mobil :</label>
        <input type="text" name="nama" id="nama"required value="<?= $mbl["nama"]; ?>"></li>
      <li><label for="type"> Type :</label>
         <input type="text" name="type" id="type"required value="<?= $mbl["type"]; ?>"></li>
      <li><label for="harga">Harga :</label>
         <input type="text" name="harga" id="harga"required value="<?= $mbl["harga"]; ?>"></li>
      <li><label for="gambar">Gambar :</label>
        <img src= "img/<?= $mbl['gambar']; ?>" width="60">
        <input type="file" name="gambar" id="gambar"></li>
      <li>
        <button type="submit" name="submit">Ubah Data</button>
      </li>
    </ul>
  
  </form>
  
  
  
  
  </body>
</html>