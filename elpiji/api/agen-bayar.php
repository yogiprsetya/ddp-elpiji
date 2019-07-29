<?php
header('Content-Type: application/json');
include dirname(dirname(__FILE__)).'/database.php';

$ids = addslashes(htmlentities($_POST['ids']));
$nik = addslashes(htmlentities($_POST['nik']));
$sku = addslashes(htmlentities($_POST['sku']));
$qty = addslashes(htmlentities($_POST['qty']));
$harga = addslashes(htmlentities($_POST['harga']));
$total = addslashes(htmlentities($_POST['total']));

$order_item = "INSERT INTO order_item (id_order_item,nik,sku,qty,harga,total) VALUES ('$ids','$nik','$sku','$qty','$harga','$total')";
$exeinsert = mysqli_query($koneksi, $order_item);

$clear_cart = "DELETE FROM cart WHERE nik='$nik'";

$response = array();

if($order_item) {
    $response['code'] =1;
    mysqli_query($koneksi, $clear_cart);
} else {
    $response['code'] = mysqli_errno($order_item);
}

echo json_encode($response);