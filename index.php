<?php
include 'controler_makanan.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Alien Mart</title>
  <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-primary-subtle" style="border-bottom: 2px solid rgb(119, 124, 161);">
    <div class="container-fluid mx-5 my-3">
      <a class="navbar-brand fs-3 fw-medium" href="#" style="color: rgb(0, 64, 255);">Alien Mart</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse " id="navbarText">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item mx-4">
            <a class="nav-link active fs-4 fw-medium" style="color: rgb(0, 0, 0);" aria-current="page" href="data_makanan.php">Data Makanan</a>
          </li>
          <li class="nav-item mx-4">
            <a class="nav-link fs-4" href="data_minuman.php">Data Minuman</a>
          </li>
          <li class="nav-item mx-4">
            <a class="nav-link fs-4" href="data_pembersih.php">Data Pembersih</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <div class="container-fluid mt-3">
      <table class="table text-center table-hover table-striped table-dark">
        <thead>
          <tr>
            <th>No</th>
            <th>Barcode</th>
            <th>Nama</th>
            <th>Gambar</th>
            <th>Qty</th>
            <th colspan="2">Aksi</th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          <?php
          $no = 1;
          foreach ($data as $makanan):
          ?>
            <tr class="text-center align-middle">
              <td><?php echo $no++; ?></td>
              <td><?php echo $makanan["barcode"] ?></td>
              <td><?php echo $makanan["nama"] ?></td>
              <td><img src="uplod/<?php echo $makanan["gambar"] ?>" alt="gambar kosong" width="100px"></td>
              <td><?php echo $makanan["qty"] ?></td>
              <td>
                <a href="edit_makanan.php?barcode=<?php echo $makanan['barcode']; ?>" class="btn bg-warning fw-medium" style="border: 2px solid rgb(255, 255, 255);">Edit</a>
              </td>
              <td>
                <form action="controler_makanan.php" method="post">
                  <input type="hidden" name="barcode" value="<?php echo $makanan["barcode"] ?>" >
                  <input type="hidden" name="gambar" value="<?php echo $makanan["gambar"] ?>" >
                  <button type="submit" name="hapus_makanan" class="btn bg-danger fw-medium" style="border: 2px solid rgb(255, 255, 255);">Hapus</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <a href="tambah_makanan.php" class="btn btn-primary fw-medium ">Tambah data</a>
    </div>
  </div>
  <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>