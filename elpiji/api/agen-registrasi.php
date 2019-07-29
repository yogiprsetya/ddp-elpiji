<?php
header('Content-Type: application/json');
include dirname(dirname(__FILE__)).'/database.php';

$nik = addslashes(htmlentities($_POST['nik']));
$nama = addslashes(htmlentities($_POST['nama']));
$siup = addslashes(htmlentities($_POST['siup']));
$email = addslashes(htmlentities($_POST['email']));
$no_telp = addslashes(htmlentities($_POST['no_telp']));
$alamat = addslashes(htmlentities($_POST['alamat']));
$katasandi = md5(addslashes(htmlentities($_POST['katasandi'])));

$insert = "INSERT INTO agen (
                nik,
                nama,
                siup,
                email,
                no_telp,
                alamat,
                katasandi,
                status
            ) VALUES ('$nik','$nama','$siup','$email','$no_telp','$alamat','$katasandi','pending')";

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