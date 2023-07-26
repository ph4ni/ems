<?php
// Get the image data from the POST request
$image = $_POST['image'];

// Convert the image data to a file
list($type, $image) = explode(';', $image);
list(, $image) = explode(',', $image);
$image = base64_decode($image);

// Save the image to a file
$file_name = 'qr_code.png';
file_put_contents($file_name, $image);

// Read the QR code from the image file
require_once 'phpqrcode/qrlib.php';
$qr_text = QRcode::text($file_name);

// Get the sid from the QR code text
$parts = explode(',', $qr_text);
$sid = trim($parts[0]);

// Get the event ID from the GET request
$event_id = $_GET['event_id'];

// Connect to the database
$servername = "localhost";
				$username = "geon";
				$password = "geon";
				$dbname = "formsdb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Find the form_name from the events_table using the event_id
$sql = "SELECT form_name FROM events_table WHERE event_id = '$event_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Get the form_name from the query result
    $row = $result->fetch_assoc();
    $form_name = $row['form_name'];

    // Update the att column in the $form_name table with 1 for the matching SID
    $sql = "UPDATE $form_name SET att = 1 WHERE sid = '$sid'";
    if ($conn->query($sql) === TRUE) {
        echo "Attendance for $sid updated successfully.";
    } else {
        echo "Error updating attendance: " . $conn->error;
    }
} else {
    // Display an error message if the event_id is not found
    echo "Event ID not found.";
}

// Close the database connection
$conn->close();
?>
