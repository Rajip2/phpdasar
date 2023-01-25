<?php
$conn = mysqli_connect("localhost","root","","phpdasar");

function query($query){
  global $conn;
  $result = mysqli_query($conn,$query);
  $rows = [] ;
  while ($row = mysqli_fetch_assoc($result) ) {
    $rows[] = $row;
  }
  return $rows;
}

 function tambah ($data){
   global $conn;
   
  $nmrmbil = htmlspecialchars($data["nmrmbil"]);
  $nama = htmlspecialchars($data["nama"]);
  $type = htmlspecialchars($data["type"]);
  $harga = htmlspecialchars($data["harga"]);
   
   $gambar = upload();
   if (!$gambar){
     return false;
   }
   
   $query = "INSERT INTO mobilsport VALUES ('','$nmrmbil','$nama','$type','$harga','$gambar')";
  mysqli_query($conn,$query);
  
  return mysqli_affected_rows($conn);
 }

 
 function upload(){
   $namaFile = $_FILES['gambar']['name'];
   $ukuranFile = $_FILES['gambar']['size'];
   $error = $_FILES['gambar']['error'];
   $tmpName = $_FILES['gambar']['tmp_name'];
   
    if ($error === 4 ){
      echo "<script>
      alert ('Masukan gambar!!');
      </script>";
      return false;
    }
   $ekstensiGambarValid = ['jpg','jpeg','png'];
   $ekstensiGambar = explode('.',$namaFile);
   $ekstensiGambar = strtolower(end($ekstensiGambar));
   
   if(!in_array($ekstensiGambar,$ekstensiGambarValid)){
     echo "<script>
      alert ('Yang anda masukan bukan gambar!!');
      </script>";
      return false;
   }
   
   if($ukuranFile > 1000000){
     echo "<script>
      alert ('Ukuran gambar terlalu besar!!');
      </script>";
      return false;
   }
   $namaFileBaru = uniqid();
   $namaFileBaru .='.';
   $namaFileBaru .= $ekstensiGambar;
   move_uploaded_file($tmpName,'img/'. $namaFileBaru);
   return $namaFileBaru;
 }

function hapus($id) {
  global $conn;
  mysqli_query($conn,"DELETE FROM mobilsport WHERE id = $id");
  return mysqli_affected_rows($conn);
}


function ubah($data){
global $conn;
  $id = $data["id"];
  $nmrmbil = htmlspecialchars($data["nmrmbil"]);
  $nama = htmlspecialchars($data["nama"]);
  $type = htmlspecialchars($data["type"]);
  $harga = htmlspecialchars($data["harga"]);
  $gambarLama = htmlspecialchars($data["gambarLama"]);



 if ( $_FILES['gambar']['error'] === 4){
    $gambar = $gambarLama;
  } else {
    $gambar = upload();
  }
  
   
   $query = "UPDATE mobilsport SET
             nmrmbil = '$nmrmbil',
             nama = '$nama',
             type = '$type',
             harga = '$harga',
             gambar = '$gambar'
             WHERE id = $id
             
             ";
  mysqli_query($conn,$query);
  
  return mysqli_affected_rows($conn);

}

function cari($keyword){
  $query = "SELECT * FROM mobilsport WHERE
           nama LIKE '%$keyword%' OR
           nmrmbil LIKE '%$keyword%' OR
           harga LIKE '%$keyword%' OR
           type LIKE '%$keyword%' 
           ";
        return query($query);   
}

function registrasi($data) {
  global $conn;

  $username = strtolower(stripcslashes($data["username"]));
  $password = mysqli_real_escape_string($conn, $data["password"]);
  $password2 = mysqli_real_escape_string($conn, $data["password2"]);


    $result=mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

    if (mysqli_fetch_assoc($result) ) {
      echo "<script>
              alert ('username Sudah Dipakai!');
              </script>";

        return false;
    }




  if ( $password !== $password2) {
    echo "<script>
            alert('Konfirmasi password tidak sesuai!!');
            </script>";
      return false;
  }

  $password = password_hash($password, PASSWORD_DEFAULT);


  mysqli_query($conn,"INSERT INTO user VALUES ('','$username','$password')");

  return mysqli_affected_rows($conn);

}


?>