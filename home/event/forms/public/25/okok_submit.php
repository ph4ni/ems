<?php


	$conn = new mysqli('localhost', 'geon' , 'geon', 'formsdb');

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$name = $_POST['name'];
$da = $_POST['da'];
$fefewf = $_POST['fefewf'];

// insert data into database
$sql = "INSERT INTO okok (name,da,fefewf) VALUES ('$name','$da','$fefewf')";

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