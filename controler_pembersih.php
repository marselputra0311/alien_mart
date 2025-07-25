<?php
$host = "localhost";
$user = "root";
$pw = "";
$db = "alien_mart";
$conn = mysqli_connect($host, $user, $pw, $db);


// tambah data pembersih
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["tambah_pembersih"])) {
  $barcode = $_POST["barcode"];
  $nama = $_POST["nama"];
  $qty = $_POST["qty"];

  $gambarNama = $_FILES["gambar"]["name"];
  $gambarTmp = $_FILES["gambar"]["tmp_name"];
  $gambarSize = $_FILES["gambar"]["size"];
  $gambarError = $_FILES["gambar"]["error"];

  if ($gambarError === 0) {
    $gambarText = strtolower(pathinfo($gambarNama, PATHINFO_EXTENSION));
    $gambarTipe = ["jpg", "png", "webp", "jpeg"];

    if (in_array($gambarText, $gambarTipe)) {
      $newName = uniqid('IMG-', true) . "." . $gambarText;
      $uplod = "uplod/pembersih/" . $newName;

      if (move_uploaded_file($gambarTmp, $uplod)) {
        $sql = "INSERT INTO pembersih (barcode, nama, gambar, qty) value ('$barcode', '$nama', '$newName', '$qty')";

        if (mysqli_query($conn, $sql)) {
          header("Location: data_pembersih.php");
          exit;
        } else {
          echo "Gagal menambah data pembersih" . mysqli_error($conn);
        }
      }
    }
  }
}

// tampil data pembersih
$data = [];
$sql = mysqli_query($conn, "SELECT * FROM pembersih");
while ($row = mysqli_fetch_assoc($sql)) {
  $data[] = $row;
}

// hapus data pembersih
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["hapus_pembersih"])) {
  $barcode = $_POST["barcode"];
  $gambar = $_POST["gambar"];

  $uplod = "uplod/pembersih/" . $gambar;

  if (file_exists($uplod)) {
    unlink($uplod);
  }

  $sql = "DELETE FROM pembersih WHERE barcode = '$barcode'";
  if (mysqli_query($conn, $sql)) {
    header("Location: data_pembersih.php");
    exit;
  } else {
    echo "Gagal menghapus data pembesih" . mysqli_error($conn);
  }
}

// edit data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_pembersih"])) {
  $barcode = $_POST["barcode"];
  $nama = $_POST["nama"];
  $qty = $_POST["qty"];

  $gambarName = $_FILES["gambar"]["name"];
  $gambarTmp = $_FILES["gambar"]["tmp_name"];

  $uplod = "uplod/pembersih/";

  if (!empty($gambarName)) {
    $sql = "SELECT gambar FROM pembersih WHERE barcode = '$barcode'";
    $getOld = mysqli_query($conn, $sql);
    $old = mysqli_fetch_assoc($getOld);
    $oldName = $uplod . $old["name"];

    if (file_exists($oldName)) {
      unlink($oldName);
    }

    move_uploaded_file($gambarTmp, $uplod . $gambarName);
      $sql = "UPDATE pembersih SET 
                barcode = '$barcode', nama = '$nama', gambar = '$gambarName', qty = '$qty'
                WHERE barcode = '$barcode'";
  } else {
    $sql = "UPDATE pembersih SET 
                barcode = '$barcode', nama = '$nama', qty = '$qty'
                WHERE barcode = '$barcode'";
  }

  if(mysqli_query($conn, $sql)){
    header("Location: data_pembersih.php");
    exit;
  }else{
    echo "Gagal edit data pembesih" . mysqli_error($conn);
  }
}
