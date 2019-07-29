<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include dirname(dirname(__FILE__)).'/database.php';

$id = isset($_GET['id']) ? $_GET['id'] : 0;

$query = "SELECT * FROM agen WHERE nik = $id";

$result = mysqli_query($koneksi, $query);

while($row = mysqli_fetch_assoc($result)) {
  $output = array($row);
}

$koneksi->close();

echo json_encode($output);