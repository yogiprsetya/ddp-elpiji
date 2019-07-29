<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

include dirname(dirname(__FILE__)).'/database.php';

$query = "SELECT * FROM agen";

$result = mysqli_query($koneksi, $query);
$output = array();

while($row = mysqli_fetch_assoc($result)) {
  $output[] = $row;
}

$koneksi->close();

echo json_encode($output);