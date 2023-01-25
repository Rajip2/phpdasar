<?php 
session_start();

if ( !isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}
require 'Functions.php';
if( isset($_POST["submit"]) ){

  
  if(tambah($_POST) > 0 ){
    echo "
          <script>
          alert ('Data Berhasil Ditambahkan!');
          document.location.href = 'Index.php';
          </script>";
  }else{
    echo "<script>
          alert ('Data Gagal Ditambahkan!');
          document.location.href = 'Index.php';
          </script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Tambah Data</title>
</head>
<body>
  <h1>Tambah Data Mobil</h1>
  <form action="" method="post" enctype="multipart/form-data">
    <ul>
      <li><label for="nmrmbil">Nomor Kendaraan :</label>
        <input type="text" name="nmrmbil" id="nmrmbil"required></li>
      <li><label for="nama">Nama Mobil :</label>
        <input type="text" name="nama" id="nama"required></li>
      <li><label for="type">Type :</label>
        <input type="text" name="type" id="type"required></li>
      <li><label for="harga">Harga :</label>
        <input type="text" name="harga" id="harga"required></li>
      <li><label for="gambar">gambar :</label>
        <input type="file" name="gambar" id="gambar"></li>
      <li>
        <button type="submit" name="submit">Tambah Data</button>
      </li>
    </ul>
  
  </form>
   
  </body>
</html>