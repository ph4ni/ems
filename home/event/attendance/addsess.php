<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Home Page</title>
		<link href="homestyle.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <style>
			
		</style>
	</head>
	<body class="loggedin">
    <nav class="navtop">
			<div>
				<h1>Events Management System</h1>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Settings</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
        <?php
            // Check if form is submitted
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Connect to the database
            $servername = "localhost";
            $username = 'geon';
            $password = 'geon';
            $dbname = 'formsdb';

            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Get form data
            $event_name = $_POST["event_name"];
            $duration = $_POST["duration"];
            $start_date = $_POST["start_date"];
            $end_date = $_POST["end_date"];
            //$form_name = NULL; // Concatenate event name with _submit.php

            // Insert data into events table
            $sql = "INSERT INTO events_table (event_name, duration, start_date, end_date)
                    VALUES ('$event_name', '$duration', '$start_date', '$end_date')";

            if ($conn->query($sql) === TRUE) {
                // Redirect back to myevents page
                header("Location: home.php");
                exit;
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
            }
        ?>
		
        
        <!-- Link to Bootstrap JS -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

		<div class="content">
            <!-- HTML code for add event form using Bootstrap -->
            <div class="container mt-5">
                <h2>Create New Event</h2>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label for="event_name">Event Name:</label>
                    <input type="text" class="form-control" id="event_name" name="event_name" required>
                </div>
                <div class="form-group">
                    <label for="duration">Duration (in days):</label>
                    <input type="number" class="form-control" id="duration" name="duration" required>
                </div>
                <div class="form-group">
                    <label for="start_date">Start Date:</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" required>
                </div>
                <div class="form-group">
                    <label for="end_date">End Date:</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
		</div>
	</body>
</html>