<?php require_once("function.php"); ?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kaunter Dashboard</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Kaunter Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="owner.php">Owner</a>
            </li>
          </ul>
          <form class="d-flex" role="search">
            <div class="input-group mb-3">
              <input class="form-control" type="search" placeholder="Cari">
              <select class="form-select" id="inputGroupSelect01">
                <option selected>Pilih...</option>
                <option value="1">Nama Barang</option>
                <option value="2">Quantiti</option>
                <option value="3">Jualan</option>
              </select>
              <button class="btn btn-success" type="submit">Cari</button>
            </div>
          </form>
        </div>
      </div>
    </nav>
  </header>
  <main>
    <div class="container-fluid">