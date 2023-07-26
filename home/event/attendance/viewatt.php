

<!DOCTYPE html>
<html>
<head>
	<title>Attendees list</title>
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
	$sql = "SELECT * FROM $tablename WHERE att = 1";
	$result = $conn->query($sql);
	$data = array();
	while ($row = $result->fetch_assoc()) {
	    $data[] = $row;
	}

	// Display attendees list data in table
	echo "<div class='container mt-5'>";
	echo "<h2 style=\"text-align: center;\">Attendees list</h2>";
	echo "<table class='table table-striped'>";
	// Display table headers
	echo "<thead>";
	echo "<tr>";
	foreach ($columns as $column) {
        if ($column != 'att') {
            echo "<th scope='col'>$column</th>";
        }
	}
	echo "</tr>";
	echo "</thead>";
	// Display table rows
	echo "<tbody>";
	foreach ($data as $row) {
	    echo "<tr>";
	    foreach ($row as $key => $value) {
            if($key != 'att'){
	            echo "<td>$value</td>";
            }
	    }
	}
	echo "</tbody>";
	echo "</table>";
	echo "</div>";

	// Retrieve form submission data from table
	$sql = "SELECT * FROM $tablename WHERE att = 0";
	$result = $conn->query($sql);
	$data = array();
	while ($row = $result->fetch_assoc()) {
	    $data[] = $row;
	}

	// Display non-attendees list data in table
	echo "<div class='container mt-5'>";
	echo "<h2 style=\"text-align: center;\">Absentees list</h2>";
	echo "<table class='table table-striped'>";
	// Display table headers
	echo "<thead>";
	echo "<tr>";
	foreach ($columns as $column) {
        if ($column != 'att') {
            echo "<th scope='col'>$column</th>";
        }
	}
	echo "</tr>";
	echo "</thead>";
	// Display table rows
	echo "<tbody>";
	foreach ($data as $row) {
	    echo "<tr>";
	    foreach ($row as $key => $value) {
            if($key != 'att'){
	            echo "<td>$value</td>";
            }
	    }
	}
	echo "</tbody>";
	echo "</table>";
	echo "</div>";

	// Close MySQL connection
	$conn->close();
	?>
</body>
</html>
