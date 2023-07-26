<?php


	$conn = new mysqli('localhost', 'geon' , 'geon', 'formsdb');

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$Name = $_POST['Name'];
$Year = $_POST['Year'];
$College = $_POST['College'];

// insert data into database
$sql = "INSERT INTO Freedom_Fest_registration (Name,Year,College) VALUES ('$Name','$Year','$College')";

if ($conn->query($sql) === FALSE) {
	echo "Error: " .$sql."$conn->error";
}

$id = $conn->insert_id;
if ($id) {
    include_once '../phpqrcode/qrlib.php';
	$sqll = "INSERT INTO Freedom_Fest_registration_att (id) VALUES ($id)";	if ($conn->query($sqll) === FALSE) {
			echo "Error: " .$sql."$conn->error";
}

    $qrCodePath = 'qr_codes/'.$id . '.png';
    QRcode::png($id, $qrCodePath);
}

echo "Your form has been submitted!<br>\n";
	echo "<img center src='" . $qrCodePath . "' alt='QR Code'>";
echo "Save this QR code for attendance"
?>