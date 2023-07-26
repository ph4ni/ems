<?php


	$conn = new mysqli('localhost', 'geon' , 'geon', 'formsdb');

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$namepls = $_POST['namepls'];
$numbbbbb = $_POST['numbbbbb'];
$time = $_POST['time'];

// insert data into database
$sql = "INSERT INTO mangos (namepls,numbbbbb,time) VALUES ('$namepls','$numbbbbb','$time')";

if ($conn->query($sql) === FALSE) {
	echo "Error: " .$sql."$conn->error";
}

$id = $conn->insert_id;
if ($id) {
    include_once '../phpqrcode/qrlib.php';
	$sqll = "INSERT INTO mangosatt (id) VALUES ($id)";	if ($conn->query($sqll) === FALSE) {
			echo "Error: " .$sql."$conn->error";
}

    $qrCodePath = 'qr_codes/'.$id . '.png';
    QRcode::png($id, $qrCodePath);
}

echo "Your form has been submitted!<br>\n";
	echo "<img center src='" . $qrCodePath . "' alt='QR Code'>";
?>