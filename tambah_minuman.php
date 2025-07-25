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
    <div class="container-fluid mx-5 my-3" >
      <a class="navbar-brand fs-3 fw-medium" href="#" style="color: rgb(0, 64, 255);">Alien Mart</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse " id="navbarText">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item mx-4">
            <a class="nav-link fs-4" href="index.php">Data Makanan</a>
          </li>
          <li class="nav-item mx-4">
            <a class="nav-link active fs-4 fw-medium" style="color: rgb(0, 0, 0);" aria-current="page" href="data_minuman.php">Data minuman</a>
          </li>
          <li class="nav-item mx-4">
            <a class="nav-link fs-4" href="data_pembersih.php">Data Pembersih</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container" >
    <div class="container-fluid mt-5 pt-3">
      <h1 class="text-center mb-4">Tambah data minuman</h1>
      <form action="controler_minuman.php" method="post" enctype="multipart/form-data" class="fs-5 fw-medium">
        <div class="mb-3">
          <label for="barcode" class="form-labe">Barcode</label>
          <input type="text" name="barcode" id="barcode" class="form-control" style="border: 1px solid rgb(49, 49, 49);" placeholder="8899.....">
        </div>
        <div class="mb-3">
          <label for="nama" class="form-labe">Nama</label>
          <input type="text" name="nama" id="nama" class="form-control" style="border: 1px solid rgb(49, 49, 49);" placeholder="Aqua 1L">
        </div>
        <div class="mb-3">
          <label for="gambar" class="form-labe">gambar</label>
          <input type="file" name="gambar" id="gambar" class="form-control" style="border: 1px solid rgb(49, 49, 49);">
        </div>
        <div class="mb-3">
          <label for="qty" class="form-labe">Quantity</label>
          <input type="text" name="qty" id="qty" class="form-control" style="border: 1px solid rgb(49, 49, 49);"  placeholder="100">
        </div>
        <button type="submit" name="tambah_minuman" class="btn btn-primary fw-medium">Tambah minuman</button>
      </form>
    </div>
  </div>
  <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>