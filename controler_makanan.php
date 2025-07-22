<?php
$conn = mysqli_connect("localhost", "root", "", "php");

if ($_SERVER["REQUEST_METHOD"] = "POST" && isset($_POST["tambah_makanan"])) {
  $barcode = $_POST["barcode"];
  $nama = $_POST["nama"];
  $qty = $_POST["qty"];

  $sql = "INSERT INTO alien_mart (barcode, nama, gambar, qty) VALUE ('$barcode', '$nama', '$gambar', '$qty')";
  if (mysqli_query($conn, $sql)) {
    header("Location: index.php");
    exit;
  } else {
    echo "Gagal menambah data " . mysqli_error($conn);
  }
}
