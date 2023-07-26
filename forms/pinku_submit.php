<?php

	
	$conn = new mysqli('localhost', 'geon' , 'geon', 'formsdb');
	
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$hai = $_POST['hai'];
$oiiid = $_POST['oiiid'];

// insert data into database
$sql = "INSERT INTO pinku (hai,oiiid) VALUES ('$hai','$oiiid')";

if ($conn->query($sql) === FALSE) {
	echo "Error: " .$sql."$conn->error";
}

echo "Data inserted successfully.";
?>