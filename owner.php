<?php
include_once("header.php");
$query = "select * from products";
$products = mysqli_query($conn, $query);

if (isset($_POST["cash"])) {
  if (cash() > 0) {
    echo "<script>window.location.href='owner.php?cash'</script>";
  }
} else if (isset($_POST["add_products"])) {
  if (add_products() > 0) {
    echo "<script>window.location.href='owner.php?add'</script>";
  }
} else if (isset($_POST["edit_products"])) {
  if (edit_products() > 0) {
    echo "<script>window.location.href='owner.php?edit'</script>";
  }
} else if (isset($_POST["del"])) {
  if (delete_products() > 0) {
    echo "<script>window.location.href='owner.php?del'</script>";
  }
}

?>

<!-- tools -->
<div class="row">
  <?php if (isset($_POST["generate_form_add_products"])) : $total = $_POST["total_comfirm"]; ?>
    <!-- add  -->
    <div class="col-md-3 mt-3 pt-0">
      <div class="p-3 bg-dark text-white">
        <form method="POST">
          <h4>Tambah Barang</h4>
          <?php for ($i = 1; $i <= $total; $i++) : ?>
            <div class="mb-3">
              <input type="hidden" name="total" value="<?= $total; ?>">
              <label for="product_name" class="form-label">Nama Barang <?= $i; ?></label>
              <input type="text" class="form-control" id="product_name" name="product_name_<?= $i; ?>" required>
            </div>
          <?php endfor; ?>
          <div class="mb-3 d-grid">
            <button type="submit" class="btn btn-primary" name="add_products">Tambah</button>
          </div>
        </form>
      </div>
    </div>
    <!-- end add  -->
  <?php elseif (isset($_POST["checked"])) : $totals = $_POST; ?>
    <!-- edit  -->
    <div class="col-md-3 mt-3 pt-0">
      <div class="p-3 bg-dark text-white">
        <form method="POST">
          <h4>Edit Barang</h4>
          <?php
          foreach ($totals["checked"] as $total => $val) :
            for ($i = 1; $i <= $val; $i++) :
              $edits = mysqli_query($conn, "SELECT product_id,product_name,product_quantity FROM products WHERE product_id=$i");
              $edit = mysqli_fetch_assoc($edits);
            endfor;
          ?>
            <div class="mb-3 p-3 bg-dark-black">
              <div class="mb-3">
                <div class="mb-3">
                  <label for="product_name" class="form-label">Nama Barang</label>
                  <input type="text" class="form-control" id="product_name" name="product_name_<?= $total; ?>" value="<?= $edit["product_name"]; ?>" required>
                </div>
                <div class="mb-3">
                  <label for="quantity" class="form-label">Quantiti</label>
                  <input type="number" class="form-control" id="quantity" name="quantity_<?= $total; ?>" value="<?= $edit["product_quantity"]; ?>" required>
                </div>
                <input type="hidden" name="id_product_<?= $total; ?>" value="<?= $edit["product_id"]; ?>">
              </div>
            </div>
          <?php endforeach; ?>
          <input type="hidden" name="edit_total" value="<?= $total; ?>">
          <div class="mb-3 d-grid">
            <button type="submit" class="btn btn-primary" name="edit_products">Edit Barang</button>
          </div>
        </form>
      </div>
    </div>
    <!-- end edit  -->

  <?php else : ?>
    <!-- casher -->
    <div class="col-md-3 mt-3 pt-0">
      <div class="p-3 bg-dark text-white">
        <form method="POST">
          <h4>Kaunter Pembayaran</h4>
          <div class="mb-3">
            <label for="buy_product_name" class="form-label">Barang</label>
            <select class="form-select" id="buy_product_name" name="buy_product_name" required>
              <option selected>-- Pilih Barang --</option>
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
  <?php endif; ?>
  <!-- table -->
  <div class="col-md-9 mt-3">
    <div class="p-3 bg-dark text-white">
      <div class="col-lg-12 d-flex justify-content-between">
        <h4 class="">Status Terkini</h4>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><b>+</b></button>
      </div>
      <form method="POST">
        <div class="table-responsive">
          <table class="table table-dark table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Quantiti</th>
                <th scope="col">Total Jualan</th>
                <th scope="col">
                  <input type="checkbox" class="form-check-input" id="select_all" value="">
                </th>
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
                  <td>
                    <input class="form-check-input check" type="checkbox" name="checked[]" value="<?= $product["product_id"]; ?>">
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <div class=" d-flex justify-content-end  pt-3">
          <button type="submit" class="btn btn-warning" name="edit">Edit</button>
          <button type="submit" class="btn btn-danger ms-2" name="del" onclick="return confirm('Padam? Anda pasti?')">Padam</button>
        </div>
      </form>
    </div>
  </div>
  <!-- end table  -->

</div>
<!-- end tools  -->
</div>



<?php include_once("footer.php"); ?>
<script>
  if (window.location.href === "http://localhost/basic-crud-Vanilla-PHP/owner.php") {
    alert("Opps... Anda Admin? Halaman ini hanya boleh dibuka oleh Pengurus")
    let pass = prompt(`Halaman ini memerlukan password! Sila masukkan password anda dibawah! 'NOTE: Password = 1234'`)
    if (pass !== "1234") {
      alert("Maaf tidak dibenarkan disini")
      window.location.href = "index.php"
    } else {
      const param = "?admin"
      window.location.href = param
    }
  }

  $()
</script>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form action="" method="POST" class="modal-content bg-dark-black text-white">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Barang</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="col-12">
          <div class="mb-3">
            <label for="total_comfirm" class="form-label">Jumlah Barang</label>
            <input type="number" class="form-control" id="total_comfirm" name="total_comfirm" placeholder="10" required>
            <div id="total_comfirm" class="form-text text-info">*Masukkan jumlah barang yang ingin anda tambah</div>
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