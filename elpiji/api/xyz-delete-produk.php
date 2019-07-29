<?php
header('Content-Type: application/json');
include dirname(dirname(__FILE__)).'/database.php';

$sku = addslashes(htmlentities($_POST['sku']));

$insert = "DELETE FROM master_produk WHERE sku='$sku'";
            
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