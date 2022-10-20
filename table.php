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
      $start = '<span class="badge bg-info">';
      $started = '<span class="badge bg-success">';
      foreach ($products as $product) : ?>

        <tr>
          <th scope="row"><?= $i++; ?></th>
          <td><?= $product["product_name"]; ?></td>
          <td>
            <?php if ($product["product_quantity"] == 0) : ?>
              <span class="badge bg-danger"><?= ($product["product_quantity"] !== null) ? $product["product_quantity"] . " Unit</span>" : "0 Unit" ?>
              <?php else : ?>
                <span class="badge bg-warning"><?= ($product["product_quantity"] !== null) ? $product["product_quantity"] . " Unit</span>" : "0 Unit" ?>
                <?php endif; ?>
          </td>
          <td>
            <?php if ($product["product_sell"] == null) : ?>
              <span class="badge bg-info text-dark"><?= ($product["product_sell"] !== null) ? $product["product_sell"] . " Unit</span>" : "Belum Terjual" ?>
              <?php else : ?>
                <span class="badge bg-success"><?= ($product["product_sell"] !== null) ? $product["product_sell"] . " Unit</span>" : "Belum Terjual" ?>
                <?php endif; ?>
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