<?php
include_once("header.php");
$query = "select * from products";
$products = mysqli_query($conn, $query);

if (isset($_POST["header_search_button"])) {
  $products = header_search();
  if (mysqli_num_rows($products) < 1) {
    $noData = true;
  }
}

if (isset($_POST["cash"])) {
  if (cash() > 0) {
    echo "<script>window.location.href='index.php'</script>";
  }
}

?>

<!-- tools -->
<div class="row">
  <!-- casher -->
  <div class="col-lg-3 mt-3 pt-0">
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
  <div class="col-lg-9 mt-3">
    <div class="p-3 bg-dark text-white">
      <h4 class="">Status Terkini</h4>
      <?php include_once("table.php") ?>
    </div>
  </div>
  <!-- end table  -->

</div>
<!-- end tools  -->
</div>



<?php include_once("footer.php"); ?>
<script>
  // hide checkbox and clear session  
  if (window.location.href == fileUrl || window.location.href == fileUrl + "index.php") {
    sessionStorage.clear()
    document.querySelector("thead tr th:last-child").remove()
    let mat = document.querySelectorAll("tbody tr td:last-child")
    for (i = 0; i < mat.length; i++) {
      mat[i].remove()
    }
  }
  // end hide clear session 
</script>