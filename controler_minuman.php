<?php
$hostname = "localhost";
$user = "root";
$pw = "";
$db = "alien_mart";
$conn = mysqli_connect($hostname, $user, $pw, $db);

// Tambah Data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["tambah_minuman"])) {
  $barcode = $_POST["barcode"];
  $nama = $_POST["nama"];
  $qty = $_POST["qty"];

  $gambarNama = $_FILES["gambar"]["name"];
  $gambarTmp = $_FILES["gambar"]["tmp_name"];
  $gambarSize = $_FILES["gambar"]["size"];
  $gambarError = $_FILES["gambar"]["error"];

  if ($gambarError == 0) {
    $gambarText = strtolower(pathinfo($gambarNama, PATHINFO_EXTENSION));
    $gambarTipe = ['jpg', 'png', 'jpeg', 'webp'];

    if (in_array($gambarText, $gambarTipe)) {
      $newName = uniqid('IMG-', true) . "." . $gambarText;
      $uplodPath = "uplod/minuman/" . $newName;

      if (move_uploaded_file($gambarTmp, $uplodPath)) {
        $sql = "INSERT INTO minuman (barcode, nama, gambar, qty)
                VALUE ('$barcode', '$nama', '$newName', '$qty')";

        if (mysqli_query($conn, $sql)) {
          header('Location: data_minuman.php');
          exit;
        } else {
          echo "Gagal menambah data minuman " . mysqli_error($conn);
        }
      }
    }
  }
}

// Tampil data
$data = [];
$content = mysqli_query($conn, "SELECT * FROM minuman ");
while ($row = mysqli_fetch_assoc($content)) {
  $data[] = $row;
}

// Hapus data
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["hapus_minuman"])){
  $barcode = $_POST["barcode"];
  $gambar = $_POST["gambar"];

  $filePath = "uplod/minuman/" . $gambar;
  if(file_exists($filePath)){
    unlink($filePath);
  }

  $sql = "DELETE FROM minuman WHERE barcode = '$barcode'";
  if(mysqli_query($conn, $sql)){
    header('Location: data_minuman.php');
    exit;
  }else{
    echo "Gagal menghapus data " . mysqli_error($conn);
  }
}

// Edit data
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["edit_minuman"])){
  $barcode = $_POST['barcode'];
  $nama = $_POST['nama'];
  $qty = $_POST['qty'];

  $gambarName = $_FILES['gambar']['name'];
  $gambarTmp = $_FILES["gambar"]["tmp_name"];
  $uplod = "uplod/minuman/";
  
  if(!empty($gambarName)){
    $sql = "SELECT gambar FROM minuman WHERE barcode = '$barcode'";
    $getOld = mysqli_query($conn, $sql);
    $old = mysqli_fetch_assoc($getOld);
    $oldName = $uplod . $old['name'];

    if(file_exists($oldName)){
      unlink($oldName);
    }

    move_uploaded_file($gambarTmp, $uplod . $gambarName);
      $sql = "UPDATE minuman
              SET nama = '$nama', gambar = '$gambarName', qty = '$qty'
              WHERE barcode = '$barcode'";
  }else{
    $sql = "UPDATE minuman
              SET nama = '$nama', qty = '$qty'
              WHERE barcode = '$barcode'";
  }

  if(mysqli_query($conn, $sql)){
    header('Location: data_minuman.php');
    exit;
  }else{
    echo "Gagal edit data minuman" . mysqli_error($conn);
  }
}
