<?php


	$conn = new mysqli('localhost', 'geon' , 'geon', 'formsdb');

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$names = $_POST['names'];
$phons = $_POST['phons'];
$birt = $_POST['birt'];

// insert data into database
$sql = "INSERT INTO vildiss (names,phons,birt) VALUES ('$names','$phons','$birt')";

if ($conn->query($sql) === FALSE) {
	echo "Error: " .$sql."$conn->error";
}

$id = $conn->insert_id;
if ($id) {
    include_once '../phpqrcode/qrlib.php';
	$sqll = "INSERT INTO vildissatt (id) VALUES ()";	if ($conn->query($sqll) === FALSE) {
			echo "Error: " .$sql."$conn->error";
}

    $qrCodePath = 'qr_codes/'.$id . '.png';
    QRcode::png($id, $qrCodePath);
}

echo "Your form has been submitted!.\<br>
 echo '<img center src="' . $qrCodePath . '" alt="QR Code">';
?>