<?php
		$servername = "localhost";
		$username = "geon";
		$password = "geon";
		$dbname = "formsdb";
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$dfgdgg = $_POST['dfgdgg'];
	$vvvvvvvv = $_POST['vvvvvvvv'];

// insert data into database
$sql = "INSERT INTO dfgd (dfgdgg,vvvvvvvv) VALUES ('$dfgdgg','$vvvvvvvv')";

if ($conn->query($sql) === FALSE) {
	echo "Error: " .$sql."$conn->error";
}

echo "Data inserted successfully.";
?>