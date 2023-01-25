<?php
session_start();

if ( !isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

require 'Functions.php';
$datamobil = query("SELECT * FROM mobilsport");
if (isset ($_POST["cari"] )){
    $data = cari($_POST["keyword"]);
    }

?>
<!DOCTYPE html>
<html>
<head>
  <title>Latihan</title>
</head>
<body>
  <a href="logout.php">logout</a>
  <h1>Daftar Mobil Sport</h1>
  <a href="tambah.php">Tambah Data Mobil</a>
  <br><br>
  
  <form action="" method="post">
    <input type="text" name="keyword" size="30" autofocus placeholder="silahkan masukan pencarian..." autocomplete="off">
    <button type="submit" name="cari">Cari</button>
    
  </form>
  <br>
  <table border="1" cellpadding="10" cellspacing="0">
    
    <tr>
      <th>No.</th>
      <th>Aksi</th>
      <th>Nomor Kendaraan</th>
      <th>Gambar</th>
      <th>Nama</th>
      <th>Type</th>
      <th>Harga</th>
    </tr>
    <?php $i =1; ?>
    <?php foreach( $datamobil as $row) : ?>
    <tr>
      <td><?= $i; ?></td>
      <td>
        <a href="ubah.php?id=<?= $row["id"]; ?>">Ubah</a> |
        <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?');">Hapus</a>
      </td>

      <td><img src="img/<?= $row["gambar"]; ?>"></td>
      <td><?= $row["nmrmbil"];?></td>
      <td><?= $row["nama"];?></td>
      <td><?= $row["type"];?></td>
      <td><?= $row["harga"];?></td>
    </tr>
    
    <?php $i++; ?>
    <?php endforeach; ?>
    
    </table>
</body>
</html>