<?php

	
	$conn = new mysqli('localhost', 'geon' , 'geon', 'formsdb');
	
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$rrhhh = $_POST['rrhhh'];
$hhh = $_POST['hhh'];
$dhdth = $_POST['dhdth'];

// insert data into database
$sql = "INSERT INTO Test (rrhhh,hhh,dhdth) VALUES ('$rrhhh','$hhh','$dhdth')";

if ($conn->query($sql) === FALSE) {
	echo "Error: " .$sql."$conn->error";
}

echo "Data inserted successfully.";
?>