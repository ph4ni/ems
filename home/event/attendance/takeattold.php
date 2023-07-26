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
		<title>Take attendance</title>
		<link href="homestyle.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
		<style>

			.tile {
				display: inline-block;
				width: 23%;
				margin-right: 2%;
				margin-bottom: 20px;
				vertical-align: top;
				box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
				border-radius: 5px;
				background-color: #fff;
			}

			@media only screen and (max-width: 768px) {
				.tile {
					width: 48%;
					margin-right: 2%;
				}
			}

			@media only screen and (max-width: 480px) {
				.tile {
					width: 100%;
					margin-right: 0;
				}
			}
			/*
			.tile {
				border: 1px solid black;
				padding: 10px;
				margin: 10px;
				width: 200px;
				height: 300px;
				display: inline-block;
			}
			.add-tile {
				border: 1px solid black;
				padding: 10px;
				margin: 10px;
				width: 200px;
				height: 300px;
				display: inline-block;
				
			}*/
		</style>
	</head>
	<body class="loggedin">
		<div class="content">
			<?php
				// Connect to the database
				$servername = "localhost";
				$username = "geon";
				$password = "geon";
				$dbname = "formsdb";

				$conn = new mysqli($servername, $username, $password, $dbname);

				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				}

                $eventid = $_GET['eventid'];
				echo $eventid;
                $sql = "SELECT form_name FROM events_table WHERE event_id = $eventid";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                $form_name = $row["form_name"];
                $dbname = $form_name . "_sessions";

				// Fetch events from the events_table
				$sql = "SELECT * FROM $dbname";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
				// Display events as tiles
					while($row = $result->fetch_assoc()) {
						echo '<div class="tile">';
						echo '<h2>' . $row['sname'] . '</h2>';
						echo '<p>' . $row['sdate'] . ' from ' . $row['stimestart'] . 'to' . $row['stimeend'] . '</p>';
						echo '<form action="scanneratt.php" method="get">';
						echo '<input type="hidden" name="eventid" value="' . $eventid . '">';
                        echo '<input type="hidden" name="sid" value="' . $row['sid'] . '">';
						echo '<input type="submit" value="Start">';
						echo '</form>';
						echo '</div>';
					}
				} else {
					echo "No sessions found.";
				}
				
			?>
			<div class="tile">
				<!-- HTML code for add event button -->
				<button id="add-button" onclick="window.location.href='addsession.php'">
				<i class="fas fa-plus"></i>
				<span>Add Session</span>
				</button>
			</div>

		</div>
		<?php
			$conn->close();
		?>
	</body>
</html>