<?php
header('Content-Type: application/json');
include dirname(dirname(__FILE__)).'/database.php';

$nik = addslashes(htmlentities($_POST['nik']));
$sku = addslashes(htmlentities($_POST['sku']));
$qty = addslashes(htmlentities($_POST['qty']));
$harga = addslashes(htmlentities($_POST['harga']));
$total = addslashes(htmlentities($_POST['total']));

$insert = "INSERT INTO cart (
                nik,
                sku,
                qty,
                harga,
                total
            ) VALUES ('$nik','$sku','$qty','$harga','$total')";

$exeinsert = mysqli_query($koneksi, $insert);

$response = array();

if($exeinsert) {
    $response['code'] =1;
    $response['message'] = "Success! Data Inserted";
} else {
    $response['code'] = mysqli_errno();
    $response['message'] = "Data Not Inserted";
}

echo json_encode($response);