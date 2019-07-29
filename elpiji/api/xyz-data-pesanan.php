<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include dirname(dirname(__FILE__)).'/database.php';

$id = isset($_GET['id']) ? $_GET['id'] : 0;

$query = "SELECT
		order_item.id_order_item, order_item.nik, order_item.sku, order_item.qty, order_item.harga, order_item.total,
		master_produk.nama, master_produk.atribut,
		agen.nik, agen.nama, agen.alamat, agen.no_telp,
		pembelian.faktur, pembelian.tanggal, pembelian.id_order_item, pembelian.status
		FROM pembelian
		INNER JOIN order_item ON pembelian.id_order_item = order_item.id_order_item
		INNER JOIN master_produk ON order_item.sku = master_produk.sku
		INNER JOIN agen ON order_item.nik = agen.nik
		WHERE pembelian.id_order_item = $id";

$result = $koneksi->query($query);

$output = array();

// if($result->num_rows > 0) { 
	while($row = $result->fetch_array()) {
		$output[] = array(
			$row[13],
			$row[9],
			$row[11],
			$row[10],
			$row[12],
			$row[6],
			$row[4],
			$row[3],
			$row[5],
			$row[15],
		);
	}
//}

$koneksi->close();

echo json_encode($output);