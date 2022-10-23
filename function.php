<?php
if (!file_exists("conf.php")) {
  echo "File Conf.php tidak ada laaa";
} else {
  include_once("conf.php");
}
$conn = mysqli_connect($host, $user, $pass);
if (!$conn) {
  echo "gagal connect" . mysqli_connect_error();
}

$create_db = "CREATE DATABASE IF NOT EXISTS $db_name";
if (!mysqli_query($conn, $create_db) === true) {
  echo "Gagal buat database: " . mysqli_error($conn);
} else {
  $conn = mysqli_connect($host, $user, $pass, $db_name);
  create_tabel();
}

// create table 
function create_tabel()
{
  global $conn;
  $sql = "CREATE TABLE IF NOT EXISTS products (
  product_id int NOT NULL AUTO_INCREMENT,
  product_name varchar(45) DEFAULT NULL,
  product_quantity varchar(45) DEFAULT NULL,
  product_sell varchar(45) DEFAULT NULL,
  product_price varchar(100) DEFAULT NULL,
  product_sales varchar(100) DEFAULT NULL,
  PRIMARY KEY (product_id)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
  return mysqli_query($conn, $sql);
}
// end create table 

function cash()
{
  global $conn;
  $id = $_POST["buy_product_name"];
  if ($_POST["buy_product_name"] == null) {
    echo "<script>alert('Sila pilih barang terlebih dahulu!')</script>";
    return false;
  }

  $get = mysqli_query($conn, "SELECT product_name,product_price,product_quantity,product_sell FROM products WHERE product_id=$id");
  $result = mysqli_fetch_assoc($get);
  $product_name = $result["product_name"];
  $quantity = $result["product_quantity"];
  $price = $result["product_price"];
  if ($_POST["buy-quantity"] > $result["product_quantity"]) {
    echo "<script>alert('Jumlah barang yang anda inginkan tidak mencukupi, stock terkini $product_name adalah $quantity')</script>";
    return false;
  } else {
    $quantity = $result["product_quantity"] - $_POST["buy-quantity"];
  }
  $tambah = $_POST["buy-quantity"] + $result["product_sell"];
  $sales = $price * $tambah;

  $query = "UPDATE products SET
  product_quantity='$quantity',
  product_sell='$tambah',
  product_sales = '$sales'
  WHERE product_id=$id";
  mysqli_query($conn, $query) or die(mysqli_error($conn));

  return mysqli_affected_rows($conn);
}

function add_products()
{
  global $conn;
  $total = $_POST["total"];
  for ($products = 1; $products <= $total; $products++) {
    $product_name = $_POST["product_name_" . $products];
    $product_price = $_POST["product_price_" . $products];

    mysqli_query($conn, "INSERT INTO products (product_name,product_price) VALUE ('$product_name','$product_price')") or die(mysqli_error($conn));
  }
  return mysqli_affected_rows($conn);
}

function edit_products()
{
  global $conn;
  for ($i = 0; $i <= $_POST["edit_total"]; $i++) {
    $product_name = $_POST["product_name_" . $i];
    $quantity = $_POST["quantity_" . $i];
    $quantity = $_POST["quantity_" . $i];
    $id = $_POST["id_product_" . $i];

    $query = "UPDATE products SET
    product_name='$product_name',
    product_quantity='$quantity'
    WHERE product_id=$id";
    mysqli_query($conn, $query) or die(mysqli_error($conn));
  }
  return mysqli_affected_rows($conn);
}

function delete_products()
{
  global $conn;
  if (!isset($_POST["checked"])) {
    return false;
  }
  foreach ($_POST["checked"] as $product) {
    $query = "DELETE FROM products WHERE product_id = '$product'";
    $result = mysqli_query($conn, $query);
  }
  if ($result) {
    return mysqli_affected_rows($conn);
  }
}

function header_search()
{
  global $conn;
  $keyword = $_POST["header_search_input"];
  $table = $_POST["header_search_select"];
  // var_dump($table);
  // die;
  if ($table !== "") {
    $query = "SELECT * FROM products WHERE
          $table LIKE '%$keyword%'
          ";
  } else {
    $query = "SELECT * FROM products WHERE
          product_name LIKE '%$keyword%' OR
          product_quantity LIKE '%$keyword%' OR
          product_sell LIKE '%$keyword%'
          ";
  }
  return mysqli_query($conn, $query);
}
