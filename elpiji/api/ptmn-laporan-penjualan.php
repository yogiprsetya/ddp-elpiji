<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

include dirname(dirname(__FILE__)).'/database.php';

$atribut = addslashes(htmlentities($_GET['atribut']));

$sql = "SELECT
		master_produk.sku, master_produk.nama, master_produk.atribut,
		order_item.id_order_item, order_item.nik, order_item.qty, order_item.harga, order_item.total
		FROM order_item
		INNER JOIN master_produk ON order_item.sku = master_produk.sku
		WHERE master_produk.atribut = '$atribut'";

$result = mysqli_query($koneksi, $sql);
$output = array();

while($row = mysqli_fetch_assoc($result)) {
	$output[] = $row;
}

$koneksi->close();

echo json_encode($output);