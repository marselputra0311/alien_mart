<?php
$conn = mysqli_connect("localhost", "root", "", "php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["tambah_makanan"])) {
  $barcode = $_POST["barcode"];
  $nama = $_POST["nama"];
  $qty = $_POST["qty"];

  // uplod foto
  $fotonama = $_FILES["foto"]["name"];
  $fototmp = $_FILES["foto"]["tmp_name"];
  $fotosize = $_FILES["foto"]["size"];
  $fotoerror = $_FILES["foto"]["error"];

  if ($fotoerror === 0) {
    $fotoext = strtolower(pathinfo($fotonama, PATHINFO_EXTENSION));
    $allowedext = ['jpg', 'png', 'jpeg', 'webp'];

    if (in_array($fotoext, $allowedext)) {
      $newname = uniqid("IMG-", true) . "." . $fotoext;
      $uplodpath = "uplod/" . $newname;

      if (move_uploaded_file($fototmp, $uplodpath)) {
        $sql = "INSERT INTO alien_mart (barcode, nama, gambar, qty) VALUE ('$barcode', '$nama', '$newname', '$qty')";
        if (mysqli_query($conn, $sql)) {
          header("Location: index.php");
          exit;
        } else {
          echo "Gagal menambah data " . mysqli_error($conn);
        }
      } else {
        echo "Data harus terisi semua" . mysqli_error($conn);
      }
    } else {
      echo "Data harus terisi semua" . mysqli_error($conn);
    }
  } else {
    echo "Data harus terisi semuaaaaa" . mysqli_error($conn);
  }
}

// tampil data
$data = [];
$result = mysqli_query($conn, "SELECT * FROM alien_mart");
while ($row = mysqli_fetch_assoc($result)) {
  $data[] = $row;
}

// hapus data

if ($_SERVER["REQUEST_METHOD"] == "POST" &&  isset($_POST["hapus_makanan"])) {
  $barcode = $_POST["barcode"];
  $gambar = $_POST["gambar"];

  $filepath = "uplod/" . $gambar;

  if (file_exists($filepath)) {
    unlink($filepath);
  }

  $sql = "DELETE FROM alien_mart where barcode = '$barcode'";
  if (mysqli_query($conn, $sql)) {
    header("Location: index.php");
    exit;
  } else {
    echo "Data gagal di hapus" . mysqli_error($conn);
  }
}

// edit data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_makanan"])) {
  $barcode = $_POST["barcode"];
  $nama = $_POST["nama"];
  $qty = $_POST["qty"];

  $gambarNama = $_FILES['gambar']['name'];
  $gambartmp = $_FILES['gambar']['tmp_name'];
  $uplod = "uplod/";

  if (!empty($gambarNama)) {
    $getOld = mysqli_query($conn, "SELECT gambar FROM alien_mart WHERE barcode  = '$barcode'");
    $old = mysqli_fetch_assoc($getOld);
    $oldFile = $uplod . $old['gambar'];
    
    if(file_exists($oldFile)){
      unlink($oldFile);
    }

    move_uploaded_file($gambartmp, $uplod . $gambarNama);
    $sql = "UPDATE alien_mart
          set nama = '$nama', gambar = '$gambarNama', qty = '$qty'
          WHERE barcode = '$barcode'";
  }else{
    $sql = "UPDATE alien_mart
          set nama = '$nama', qty = '$qty'
          WHERE barcode = '$barcode'";
  }

  
  if (mysqli_query($conn, $sql)) {
    header('Location: index.php');
    exit;
  } else {
    echo "Gagal mengedit data " . mysqli_error($conn);
  }
}
