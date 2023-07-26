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
		<!-- Import Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<!-- Import jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<!-- Import Bootstrap JS -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
		<style>

			.card {
				margin-right: 2%;
				margin-bottom: 20px;
				box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
				border-radius: 5px;
				background-color: #fff;
				height: 220px;
			}

			@media only screen and (max-width: 768px) {
				.card {
					margin-right: 2%;
				
				}
			}

            .navtop div {
                display: flex;
                margin: 0 auto;
                width: 73%;
                height: 100%;
            }

			@media only screen and (max-width: 480px) {
				.card {
					margin-right: 0;
				}
			}

			.card-header {
				background-color: #fff;
				border-bottom: none;
			}

			.card-body {
				padding: 20px;
			}

			.card-title {
				margin-bottom: 10px;
			}

			.card-text {
				margin-bottom: 20px;
			}

			.add-card {
				margin-right: 2%;
				margin-bottom: 20px;
			}

			@media only screen and (max-width: 768px) {
				.add-card {
					margin-right: 2%;
				}
			}

			@media only screen and (max-width: 480px) {
				.add-card {
					margin-right: 0;
				}
			}
		</style>
	</head>
	<body class="loggedin">
		<div class="container">
			<br><h3>Select a session to take attendance</h3><br>
			<div class="row">
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
				//echo $eventid;
                $sql = "SELECT form_name FROM events_table WHERE event_id = $eventid";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                $form_name = $row["form_name"];
                $sessdbname = $form_name . "_sessions";
                $attdbname = $form_name . "_att";

                // Fetch sessions from sessionstable
                $sql = "SELECT * FROM $sessdbname";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="card text-center">';
                        echo '<div class="card-body">';
                        echo '<h5 class="card-title">' . $row['sname'] . '</h5>';
						echo '<hr class="hr" />';
                        echo '<p class = "card-text">'.$row['sday'].'</p>';
                        echo '<p class="card-text">'. $row['stimestart'] . ' to ' . $row['stimeend'] . '</p>';
                        echo '<form action="scansessatt.php" method="get">';
                        echo '<input type="hidden" name="attdbname" value="' . $attdbname . '">';
                        echo '<input type="hidden" name="sid" value="' . $row['sid'] . '">';
                        echo '<button type="submit" class="btn btn-primary">Take Attendance</button>';
                        echo '</form>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
					echo "No sessions found.";
				}

				$conn->close();
			?>
			<div class="card add-tile text-center">
            <div class="card-body">
                <h5 class="card-title">Add Session </h5><br>
                <p class="card-text">Add a new session here</p>
                <p class="card-text"></p><br>
                <form method="post" action="addsession.php">
                    <input type="hidden" name="sdbn" value="<?php echo $sessdbname; ?>">
                    <input type="hidden" name="eventid" value="<?php echo $eventid; ?>">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        <span>Add Session</span>
                    </button>
                </form>
            </div>
            </div>
		</div>
	</body>
</html> 
