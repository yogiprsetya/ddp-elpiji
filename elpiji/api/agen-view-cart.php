<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include dirname(dirname(__FILE__)).'/database.php';

$nik = isset($_GET['nik']) ? $_GET['nik'] : 0;

$query = "SELECT * FROM cart WHERE nik = $nik";

$result = mysqli_query($koneksi, $query);
$cek    = mysqli_num_rows($result);

$response   = array();

if($cek > 0) {
	while($baris = mysqli_fetch_assoc($result)) {
    		$response[]=$baris;
	}
} else {
	$response['code'] = mysqli_errno($koneksi);
	$response['pesan'] = 404;
}

echo json_encode($response);