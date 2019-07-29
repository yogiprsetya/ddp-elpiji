<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

include dirname(dirname(__FILE__)).'/database.php';

$id = addslashes(htmlentities($_POST['nik']));

$insert = "UPDATE agen SET status='aktif' WHERE nik='$id'";
$exeinsert = mysqli_query($koneksi, $insert);

$response = array();

if($exeinsert) {
    $response['message'] = "Akun Aktif";
} else {
    $response['code'] = mysqli_errno();
    $response['message'] = "Data Not Updated";
}

echo json_encode($response);