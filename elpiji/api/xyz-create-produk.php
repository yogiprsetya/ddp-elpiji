<?php
header('Content-Type: application/json');
include dirname(dirname(__FILE__)).'/database.php';

$nama = addslashes(htmlentities($_POST['nama']));
$atribut = addslashes(htmlentities($_POST['atribut']));
$harga = addslashes(htmlentities($_POST['harga']));
$stok = addslashes(htmlentities($_POST['stok']));

$insert = "INSERT INTO master_produk (
                sku,
                nama,
                atribut,
                harga,
                stok
            ) VALUES ('','$nama','$atribut','$harga','$stok')";

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