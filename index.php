<?php
include_once("header.php");
$query = "select * from products";
$products = mysqli_query($conn, $query);

if (isset($_POST["cash"])) {
  if (cash() > 0) {
    echo "<script>window.location.href='index.php'</script>";
  }
}

?>

<!-- tools -->
<div class="row">
  <!-- casher -->
  <div class="col-md-4 mt-3 pt-0">
    <div class="p-3 bg-dark text-white">
      <form method="POST">
        <h4>Kaunter Pembayaran</h4>
        <div class="mb-3">
          <label for="buy_product_name" class="form-label">Barang</label>
          <select class="form-select" id="buy_product_name" name="buy_product_name" required>
            <option value="" selected>-- Pilih Barang --</option>
            <?php foreach ($products as $product) : ?>
              <option value="<?= $product["product_id"]; ?>"><?= $product["product_name"]; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="mb-3">
          <label for="buy-quantity" class="form-label">Kuantiti Barang</label>
          <input type="number" class="form-control" id="buy-quantity" name="buy-quantity" required>
        </div>
        <div class="mb-3 d-grid">
          <button type="submit" class="btn btn-primary" name="cash" onclick="return confirm('Yakin?')">CASH</button>
        </div>
      </form>
    </div>
  </div>
  <!-- end casher  -->
  <!-- table -->
  <div class="col-md-8 mt-3">
    <div class="p-3 bg-dark text-white">
      <h4 class="">Status Terkini</h4>
      <form method="POST">
        <div class="table-responsive">
          <table class="table table-dark table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Quantiti</th>
                <th scope="col">Total Jualan</th>
              </tr>
            </thead>
            <tbody class="table-group-divider">
              <?php
              $i = 1;
              foreach ($products as $product) : ?>
                <tr>
                  <th scope="row"><?= $i++; ?></th>
                  <td><?= $product["product_name"]; ?></td>
                  <td>
                    <span class="badge bg-danger"><?= ($product["product_quantity"] !== null) ? $product["product_quantity"] . " Unit" : "0 Unit" ?></span>
                  </td>
                  <td><span class="badge bg-success"><?= ($product["product_sell"] !== null) ? $product["product_sell"] . " Unit</span>" : "Belum Terjual" ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </form>
    </div>
  </div>
  <!-- end table  -->

</div>
<!-- end tools  -->
</div>



<?php include_once("footer.php"); ?>

<!-- Modal -->
<div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form action="" method="POST" class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Barang</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="col-12">
          <div class="mb-3">
            <label for="total_comfirm" class="form-label">Jumlah Barang</label>
            <input type="number" class="form-control" id="total_comfirm" name="total_comfirm" placeholder="10" required>
            <div id="total_comfirm" class="form-text">*Masukkan jumlah barang yang ingin anda tambah</div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" name="generate_form_add_products">Teruskan</button>
      </div>
    </form>
  </div>
</div>
<!-- end modal  -->