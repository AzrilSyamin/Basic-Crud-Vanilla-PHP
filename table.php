<div class="table-responsive">
  <table class="table table-dark table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nama Barang</th>
        <th scope="col">Harga Barang</th>
        <th scope="col">Quantiti</th>
        <th scope="col">Unit Terjual</th>
        <th scope="col">Jumlah Jualan</th>
        <th scope="col">
          <input type="checkbox" class="form-check-input" id="select_all" value="">
        </th>
      </tr>
    </thead>
    <tbody class="table-group-divider">
      <?php
      $i = 1;
      $start = '<span class="badge bg-info">';
      $started = '<span class="badge bg-success">';
      foreach ($products as $product) : ?>

        <tr>
          <th scope="row"><?= $i++; ?></th>
          <td><?= $product["product_name"]; ?></td>
          <td>
            <?= $product["product_price"] == null ? "" : "RM " . $product["product_price"] ?>
          </td>
          <td>
            <?php if ($product["product_quantity"] == null) : ?>
              <span class="badge">Belum Ada</span>
            <?php elseif ($product["product_quantity"] == 0) : ?>
              <span class="badge bg-danger">Habis Dijual</span>
            <?php else : ?>
              <span class="badge bg-warning"><?= $product["product_quantity"] . " Unit" ?>
              <?php endif; ?>
          </td>
          <td>
            <?php if ($product["product_sell"] == null) : ?>
              <span class="badge">Belum Terjual</span>
            <?php else : ?>
              <span class="badge bg-success"><?= $product["product_sell"] . " Unit" ?></span>
            <?php endif; ?>
          </td>
          <td>
            <?= $product["product_sales"] == null ? "RM 0" : "RM " . $product["product_sales"] ?>
          </td>
          <td>
            <input class="form-check-input check" type="checkbox" name="checked[]" value="<?= $product["product_id"]; ?>">
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php if (isset($noData)) : ?>
    <p class="text-center">No Result !</p>
  <?php endif; ?>
</div>