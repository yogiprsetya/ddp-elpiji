<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

include dirname(dirname(__FILE__)).'/database.php';

$status = addslashes(htmlentities($_POST['status']));
$id = addslashes(htmlentities($_POST['id']));

$insert = "UPDATE pembelian SET status='$status' WHERE id_order_item='$id'";
$exeinsert = mysqli_query($koneksi, $insert);

$response = array();

if($exeinsert) {
    $response['code'] = 1;
    $response['message'] = "Success! Data Inserted";
} else {
    $response['code'] = mysqli_errno();
    $response['message'] = "Data Not Updated";
}

echo json_encode($response);