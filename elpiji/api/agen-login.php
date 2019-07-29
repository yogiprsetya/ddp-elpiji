<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

include dirname(dirname(__FILE__)).'/database.php';

$email      = addslashes(htmlentities($_POST['email']));
$katasandi  = md5(addslashes(htmlentities($_POST['katasandi'])));

$query      = "SELECT nik FROM agen WHERE email='$email' AND katasandi='$katasandi' AND status='aktif'";
$exeinsert  = mysqli_query($koneksi, $query);
$cek        = mysqli_num_rows($exeinsert);

$response   = array();

if($cek > 0) {
	while($baris = mysqli_fetch_assoc($exeinsert)) {
		$response[]=$baris;
	}
} else {
	$response['code'] = mysqli_errno($koneksi);
	$response['nikk'] = "Data NULL";
}

echo json_encode($response);