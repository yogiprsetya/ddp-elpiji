<?php
header('Content-Type: application/json');
include dirname(dirname(__FILE__)).'/database.php';

$ids = addslashes(htmlentities($_POST['ids']));
$nik = addslashes(htmlentities($_POST['nik']));

$pembelian = "INSERT INTO pembelian (id_order_item, nik, status) VALUES ('$ids','$nik','pending payment')";
$order_item = mysqli_query($koneksi, $pembelian);

$response = array();

if($order_item) {
    $response['code'] =1;
} else {
    $response['code'] = mysqli_errno($order_item);
}

echo json_encode($pembelian);