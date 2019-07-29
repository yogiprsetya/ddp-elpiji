<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

$EmailTo = addslashes(htmlentities($_POST['email']));
$Subject = "PT. XYZ - Email Verifiaksi";
$Nama = Trim(stripslashes($_POST['nama']));
$Message = Trim(stripslashes($_POST['link']));
$headers = "From PT. XYZ";

// validation
$validationOK = true;

if (!$validationOK) {
  print "<meta http-equiv=\"refresh\" content=\"0;URL=error.htm\">";
  exit;
}

// prepare email body text
$Body = "";
$Body .= "Halo ";
$Body .= $Nama;
$Body .= " Selamat bergabung dan bekerjasama sebagai mitra kami!";
$Body .= "\n";
$Body .= "Kunjungi link dibawah ini untuk melakukan aktifasi:";
$Body .= "\n";
$Body .= $Message;
$Body .= "\n";

// send email 
$success = mail($EmailTo, $Subject, $Body, $headers);

// redirect to success page 
$response = array();

if($success) {
		$response['pesan'] = "Terkirim";
		$response['pesan1'] = $success;
} else {
  $response['code'] = mysqli_errno($success);
  $response['pesan1'] = $validationOK;
  
}

echo json_encode($response);
?>