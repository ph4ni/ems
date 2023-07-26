<?php


	$conn = new mysqli('localhost', 'geon' , 'geon', 'formsdb');

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$Name = $_POST['Name'];
$Year = $_POST['Year'];
$Branch = $_POST['Branch'];

// insert data into database
$sql = "INSERT INTO Annual_day_registration_form (Name,Year,Branch) VALUES ('$Name','$Year','$Branch')";

if ($conn->query($sql) === FALSE) {
	echo "Error: " .$sql."$conn->error";
}

$id = $conn->insert_id;
if ($id) {
    include_once '../phpqrcode/qrlib.php';
	$sqll = "INSERT INTO Annual_day_registration_form_att (id) VALUES ($id)";	if ($conn->query($sqll) === FALSE) {
			echo "Error: " .$sql."$conn->error";
}

    $qrCodePath = 'qr_codes/'.$id . '.png';
    QRcode::png($id, $qrCodePath);
}

echo "<div class=\"text-center\">";echo "Your form has been submitted!<br>\n";
	echo "<img center src='" . $qrCodePath . "' alt='QR Code'>";
echo "Save this QR code for attendance
</div>"
?>