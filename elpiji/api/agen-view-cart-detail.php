<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

include dirname(dirname(__FILE__)).'/database.php';

$id = isset($_GET['nik']) ? $_GET['nik'] : 0;

$query = "SELECT cart.*, master_produk.*
          FROM cart
          INNER JOIN master_produk ON cart.sku = master_produk.sku
          WHERE cart.nik = $id ";

$result = mysqli_query($koneksi, $query);
$output = array();

while($row = mysqli_fetch_assoc($result)) {
  $output[] = $row;
}

$koneksi->close();

echo json_encode($output);