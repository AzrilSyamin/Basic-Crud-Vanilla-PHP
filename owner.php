<?php
include_once("header.php");
$query = "select * from products";
$products = mysqli_query($conn, $query);

if (isset($_POST["header_search_button"])) {
  $products = header_search();
  if (mysqli_num_rows($products) < 1) {
    $noData = true;
  }
} elseif (isset($_POST["cash"])) {
  if (cash() > 0) {
    echo "<script>window.location.href='owner.php'</script>";
  }
} else if (isset($_POST["add_products"])) {
  if (add_products() > 0) {
    echo "<script>window.location.href='owner.php'</script>";
  }
} else if (isset($_POST["edit_products"])) {
  if (edit_products() > 0) {
    echo "<script>window.location.href='owner.php'</script>";
  }
} else if (isset($_POST["del"])) {
  if (!isset($_POST["checked"])) {
    echo "<script>alert('Sila pilih barang terlebih dahulu')
    window.location.href='?error'
    </script>";
    return false;
  }
  if (delete_products() > 0) {
    echo "<script>window.location.href='owner.php'</script>";
  }
}

?>

<!-- tools -->
<div class="row">
  <?php if (isset($_POST["generate_form_add_products"])) : if ($_POST["total_comfirm"] > 10) {
      echo "<script>
      alert('Maaf anda tidak boleh tambah lebih 10 produk!')
      window.location.href='?error'
      </script>";
      return false;
    }
    $total = $_POST["total_comfirm"]; ?>
    <!-- add  -->
    <div class="col-lg-3 mt-3 pt-0">
      <div class="p-3 bg-dark text-white">
        <form method="POST">
          <h4>Tambah Barang</h4>
          <?php for ($i = 1; $i <= $total; $i++) : ?>
            <div class="mb-3 p-3 bg-dark-black">
              <div class="mb-3">
                <div class="mb-3">
                  <input type="hidden" name="total" value="<?= $total; ?>">
                  <label for="product_name" class="form-label">Nama Barang <?= $i; ?></label>
                  <input type="text" class="form-control" id="product_name" name="product_name_<?= $i; ?>" placeholder="Kasut Adidas" required>
                </div>
                <div class="mb-3">
                  <label for="product_price" class="form-label">Harga Barang <?= $i; ?></label>
                  <input type="text" class="form-control" id="product_price" name="product_price_<?= $i; ?>" placeholder="20" required>
                  <span class="form-text text-info">* masukkan angka sahaja contoh untuk RM20, masukkan 20</span>
                </div>
              </div>
            </div>
          <?php endfor; ?>
          <div class="mb-3 d-grid">
            <button type="submit" class="btn btn-primary" name="add_products">Tambah</button>
          </div>
        </form>
      </div>
    </div>
    <!-- end add  -->
  <?php elseif (isset($_POST["edit"])) : if (!isset($_POST["checked"])) {
      if (!isset($_POST["checked"])) {
        echo "<script>alert('Sila pilih barang terlebih dahulu')
      window.location.href='?error'
      </script>";
        return false;
      }
    }
    $totals = $_POST; ?>
    <!-- edit  -->
    <div class="col-lg-3 mt-3 pt-0">
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
  <?php endif; ?>
  <!-- table -->
  <div class="col-lg-9 my-3">
    <div class="p-3 bg-dark text-white">
      <div class="col-lg-12 d-flex justify-content-between">
        <h4 class="">Status Terkini</h4>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#generateFormAddProduct"><b>+</b></button>
      </div>
      <form method="POST">
        <?php include_once("table.php") ?>
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


<!-- Modal -->
<div class="modal fade" id="generateFormAddProduct" tabindex="-1" aria-labelledby="generateFormAddProductLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form action="" method="POST" class="modal-content bg-dark-black text-white">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="generateFormAddProductLabel">Tambah Barang</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="col-12">
          <div class="mb-3">
            <label for="total_comfirm" class="form-label">Jumlah Barang</label>
            <input type="number" class="form-control" id="total_comfirm" name="total_comfirm" placeholder="10" max="10" required>
            <div id="total_comfirm" class="form-text text-info">*Masukkan jumlah barang yang ingin anda tambah, max 10 data saja</div>
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

<?php include_once("footer.php"); ?>
<script>
  for (let i = 0; i < path.length; i++) {
    if (path[i] == "owner.php") {
      owner = path[i]
    }
  }

  // simple alert
  if (window.location.href == fileUrl + owner) {
    let owner = sessionStorage.getItem("name")

    if (!owner) {
      // if not isset owner
      let question = confirm("Opps... Anda Owner? Halaman ini hanya boleh dibuka oleh Owner")

      if (question !== true) {
        // if question == false 
        window.location.href = fileUrl
      } else {
        // if question == true
        let pass = prompt("Halaman ini memerlukan password! Sila masukkan password anda dibawah!")

        if (pass !== "Owner") {
          alert("Maaf anda tidak dibenarkan disini")
          window.location.href = fileUrl
        } else {
          sessionStorage.setItem("name", "owner")
          window.location.href
        }
      }

    } else {
      // if isset owner 
      window.location.href
    }

  }
  // end simple alert 
</script>