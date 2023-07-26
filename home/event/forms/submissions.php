<!DOCTYPE html>
<html>
<head>
	<title>Form Submissions</title>
	<!-- Import Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<!-- Import jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<!-- Import Bootstrap JS -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
	<?php
	// Connect to MySQL database
	$servername = "localhost";
    $username = "geon";
    $password = "geon";
    $dbname = "formsdb";
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	// Retrieve table name from variable
	$eventid = $_GET['eventid'];

    $sql = "SELECT form_name FROM events_table WHERE event_id = $eventid";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $tablename = $row["form_name"];

	// Retrieve column names from table
	$sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$tablename'";
	$result = $conn->query($sql);
	$columns = array();
	while ($row = $result->fetch_assoc()) {
	    $columns[] = $row['COLUMN_NAME'];
	}

	// Retrieve form submission data from table
	$sql = "SELECT * FROM $tablename";
	$result = $conn->query($sql);
	$data = array();
	while ($row = $result->fetch_assoc()) {
	    $data[] = $row;
	}

	// Display data in table
	echo "<div class='container mt-5'>";
	echo "<h2>Form Submissions</h2>";
	echo "<table class='table table-striped'>";
	// Display table headers
	echo "<thead>";
	echo "<tr>";
	foreach ($columns as $column) {
		if ($column != 'cert') {
            echo "<th scope='col'>$column</th>";
        }
	}
	echo "<th scope='col'>QR</th><th scope='col'>Edit</th><th scope='col'>Delete</th>";
	echo "</tr>";
	echo "</thead>";
	// Display table rows
	echo "<tbody>";
	foreach ($data as $row) {
	    echo "<tr>";
	    foreach ($row as $key => $value) {
			if($key != 'cert'){
	            echo "<td>$value</td>";
            }
	       
	    }
	    // Display qr image
	    $id = $row['id'];
	    $qr = "<img src='public/$eventid/qr_codes/$id.png' alt='qr code' class='img-thumbnail'>";
	    echo "<td>$qr</td>";
	    // Display edit button
	    echo "<td><button class='btn btn-secondary' disabled>Edit</button></td>";
	    // Display delete button
	    echo "<td><form method='POST' action='delete.php'><input type='hidden' name='id' value='$id'><button type='submit' class='btn btn-danger'>Delete</button></form></td>";
	    echo "</tr>";
	}
	echo "</tbody>";
	echo "</table>";
	echo "</div>";

	// Close MySQL connection
	$conn->close();
	?>
</body>
</html>
