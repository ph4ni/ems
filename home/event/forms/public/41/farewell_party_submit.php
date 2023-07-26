<?php


	$conn = new mysqli('localhost', 'geon' , 'geon', 'formsdb');

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$Name = $_POST['Name'];
$Year = $_POST['Year'];
$dob = $_POST['dob'];

// insert data into database
$sql = "INSERT INTO farewell_party (Name,Year,dob) VALUES ('$Name','$Year','$dob')";

if ($conn->query($sql) === FALSE) {
	echo "Error: " .$sql."$conn->error";
}

$id = $conn->insert_id;
if ($id) {
    include_once '../phpqrcode/qrlib.php';
	$sqll = "INSERT INTO farewell_party_att (id) VALUES ($id)";	if ($conn->query($sqll) === FALSE) {
			echo "Error: " .$sql."$conn->error";
}

    $qrCodePath = 'qr_codes/'.$id . '.png';
    QRcode::png($id, $qrCodePath);
}

echo "Your form has been submitted!<br>\n";
	echo "<img center src='" . $qrCodePath . "' alt='QR Code'>";
?>