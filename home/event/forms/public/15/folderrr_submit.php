<?php


	$conn = new mysqli('localhost', 'geon' , 'geon', 'formsdb');

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$okok = $_POST['okok'];
$okokok = $_POST['okokok'];
$noo = $_POST['noo'];

// insert data into database
$sql = "INSERT INTO folderrr (okok,okokok,noo) VALUES ('$okok','$okokok','$noo')";

if ($conn->query($sql) === FALSE) {
	echo "Error: " .$sql."$conn->error";
}

$id = $conn->insert_id;
if ($id) {
    include_once '../phpqrcode/qrlib.php';
    $qrCodePath = qrcodes/.$id . '.png';
    QRcode::png($id, $qrCodePath);
    echo '<img src="' . $qrCodePath . '" alt="QR Code">';
}

echo "Data inserted successfully.";
?>