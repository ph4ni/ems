<?php

	
	$conn = new mysqli(localhost, geon, geon, formsdb);
	
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$hello = $_POST['hello'];
$ok = $_POST['ok'];

// insert data into database
$sql = "INSERT INTO newone (hello,ok) VALUES ('$hello','$ok')";

if ($conn->query($sql) === FALSE) {
	echo "Error: " .$sql."$conn->error";
}

echo "Data inserted successfully.";
?>