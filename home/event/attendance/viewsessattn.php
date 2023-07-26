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

<div class='container mt-5'>
<h2 style="text-align: center;">Attendance Data</h2>

<?php

    // Assuming $conn is the database connection object
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
    $studentsinfo = $tablename;
    $studentsattendance = $tablename.'_att';
    // Query to fetch all students from studentsinfo table
    $students_query = "SELECT id, name FROM $studentsinfo";

    // Execute the query
    $students_result = $conn->query($students_query);

    // Query to fetch all sessions from studentsattendance table
    $sessions_query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$studentsattendance' AND COLUMN_NAME != 'id'";

    // Execute the query
    $sessions_result = $conn->query($sessions_query);

    // Create an array to store the session names
    $sessions = array();

    // Iterate over the sessions_result object and add each session name to the sessions array
    while ($row = $sessions_result->fetch_assoc()) {
        $sessions[] = $row['COLUMN_NAME'];
    }

    // Create the bootstrap table
    echo '<table class="table table-striped">';
    echo '<thead>';
    echo '<tr>';
    echo '<th scope=\'col\' >Student Name</th>';

    // Iterate over the sessions array and add each session name as a table header
    foreach ($sessions as $session) {
        echo '<th scope=\'col\'>' . $session . '</th>';
    }

    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    // Iterate over the students_result object and create a table row for each student
    while ($row = $students_result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['name'] . '</td>';

        // Query to fetch attendance data for the current student from studentsattendance table
        $attendance_query = "SELECT * FROM $studentsattendance WHERE id = " . $row['id'];

        // Execute the query
        $attendance_result = $conn->query($attendance_query);

        // Iterate over the attendance_result object and add attendance data as table cells
        while ($attendance_row = $attendance_result->fetch_assoc()) {
            foreach ($sessions as $session) {
                echo '<td>' . $attendance_row[$session] . '</td>';
            }
        }

        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';

?>
</div>
</body>
</html>