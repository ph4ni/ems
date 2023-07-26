<?php


	$conn = new mysqli('localhost', 'geon' , 'geon', 'formsdb');

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$wert = $_POST['wert'];
$ewr = $_POST['ewr'];
$uhn = $_POST['uhn'];

// insert data into database
$sql = "INSERT INTO plss (wert,ewr,uhn) VALUES ('$wert','$ewr','$uhn')";

if ($conn->query($sql) === FALSE) {
	echo "Error: " .$sql."$conn->error";
}

$id = $conn->insert_id;
if ($id) {
    include_once '../phpqrcode/qrlib.php';
    $qrCodePath = 'qr_codes/'.$id . '.png';
    QRcode::png($id, $qrCodePath);
    echo '<img src="' . $qrCodePath . '" alt="QR Code">';
}

echo "Data inserted successfully.";
?>